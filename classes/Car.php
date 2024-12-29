<?php
require_once 'Database.php';

class Car
{
    private $conn;
    private $table = 'tm_cars';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function list()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY merk ASC";
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
        uuid, merk, tipe, jumlah_kursi, jumlah_pintu, warna, no_plat, tahun, km, jenis_bensin, harga, denda, transmisi, status, photo, created_by
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['merk'],
            $data['tipe'],
            $data['jumlah_kursi'],
            $data['jumlah_pintu'],
            $data['warna'],
            $data['no_plat'],
            $data['tahun'],
            $data['km'],
            $data['jenis_bensin'],
            $data['harga'],
            $data['denda'],
            $data['transmisi'],
            $data['status'],
            $data['photo'],
            $data['created_by']
        ]);
    }

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

    public function getTotalCars()
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $this->table . " WHERE status = 'Active'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTotalKilometers()
    {
        $sql = "SELECT SUM(km) AS total_km FROM " . $this->table . " WHERE status = 'Active'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_km'] ?? 0;
    }

    public function bestBooking()
    {
        $query = "SELECT car_id, COUNT(*) as booking_count 
                    FROM tt_bookings 
                    GROUP BY car_id 
                    ORDER BY booking_count DESC 
                    LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $carId = $result['car_id'];
            $carQuery = "SELECT * FROM " . $this->table . " WHERE id = ?";
            $carStmt = $this->conn->prepare($carQuery);
            $carStmt->execute([$carId]);
            $car = $carStmt->fetch(PDO::FETCH_ASSOC);
            return $car;
        }

        return null;
    }

    public function getTotalRevenueForCurrentMonth($carId)
    {
        $query = "SELECT SUM(tt_payments.amount) + SUM(tt_bookings.total_denda) as total_revenue 
                    FROM tt_payments 
                    INNER JOIN tt_bookings ON tt_payments.booking_id = tt_bookings.id
                    WHERE tt_payments.car_id = ? 
                    AND MONTH(tt_payments.created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(tt_payments.created_at) = YEAR(CURRENT_DATE())
                    AND tt_bookings.status = 'Selesai'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$carId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_revenue'] ?? 0;
    }

    public function getCarById($id)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
