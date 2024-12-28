<?php
require_once 'Database.php';

class Payment
{
    private $conn;
    private $table = 'tt_payments';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function list()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY status ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetail($uuid)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function edit($uuid)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (
        uuid, booking_id, car_id, user_id, method, type, amount, evidence_file
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['booking_id'],
            $data['car_id'],
            $data['user_id'],
            $data['method'],
            $data['type'],
            $data['amount'],
            $data['evidence_file'],
        ]);
    }

    // public function update($uuid, $data)
    // {
    //     $query = "UPDATE " . $this->table . " SET 
    //         photo = ?, 
    //         booking_id = ?, 
    //         car_id = ?, 
    //         user_id = ?, 
    //         method = ?, 
    //         type = ?, 
    //         amount = ?, 
    //         evidence = ?, 
    //     WHERE uuid = ?";
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute([
    //         $data['photo'],
    //         $data['booking_id'],
    //         $data['car_id'],
    //         $data['user_id'],
    //         $data['method'],
    //         $data['type'],
    //         $data['amount'],
    //         $data['evidence'],
    //         $uuid
    //     ]);
    // }

    public function update($uuid, $data)
    {
        $setClause = [];
        $params = [];

        foreach ($data as $column => $value) {
            $setClause[] = "$column = ?";
            $params[] = $value;
        }

        $params[] = $uuid;
        $setClause = implode(', ', $setClause);

        $query = "UPDATE " . $this->table . " SET $setClause WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        $query = "DELETE FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$uuid]);
    }

    public function getTotalCompletedBookings()
    {
        $query = "SELECT COUNT(*) as total_completed 
                    FROM " . $this->table . " 
                    WHERE status = 'Selesai'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_completed'] ?? 0;
    }

    public function getTotalAmount()
    {
        $sql = "SELECT SUM(tt_payments.amount) + SUM(tt_bookings.total_denda) AS total_amount 
            FROM " . $this->table . " 
            INNER JOIN tt_bookings ON tt_bookings.id = " . $this->table . ".booking_id 
            WHERE tt_bookings.status = 'Selesai'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_amount'] ?? 0;
    }

    public function getMonthlyPaymentsForCurrentYear()
    {
        $query = "SELECT MONTH(tt_bookings.created_at) as month, SUM(tt_payments.amount) as total_amount 
                    FROM tt_payments 
                    INNER JOIN tt_bookings ON tt_bookings.id = tt_payments.booking_id 
                    WHERE tt_bookings.status = 'Selesai' AND YEAR(tt_bookings.created_at) = YEAR(CURRENT_DATE())
                    GROUP BY MONTH(tt_bookings.created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaymentByBookingId($id)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE booking_id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvidence($data)
    {
        $query = "UPDATE tt_payments SET evidence_file = ? WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$data['evidence_file'], $data['uuid']]);
    }
}
