<?php
require_once 'Database.php';

class Booking extends Database
{
    // private $conn;
    private $table = 'tt_bookings';

    public function __construct()
    {
        // $db = new Database();
        // $this->conn = $db->connect();
        $this->conn = $this->connect();
    }

    public function list()
    {
        $query = "SELECT * FROM " . $this->table . " 
                    ORDER BY 
                    CASE 
                        WHEN status = 'Menunggu Konfirmasi' THEN 1 
                        WHEN status = 'Belum Bayar' THEN 2
                        WHEN status = 'Disetujui' THEN 3 
                        WHEN status = 'Berjalan' THEN 4
                        WHEN status = 'Ditolak' THEN 5
                        ELSE 6
                    END,
                    no_booking ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingOnProgress()
    {
        $query = "SELECT * FROM " . $this->table . " 
                    WHERE status = 'Berjalan'
                    ORDER BY 
                    date_end ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listDriver($id)
    {
        $query = "SELECT * FROM " . $this->table . " 
                    WHERE driver_id = :id
                    ORDER BY 
                    CASE 
                        WHEN status = 'Menunggu Konfirmasi' THEN 1 
                        WHEN status = 'Belum Bayar' THEN 2
                        WHEN status = 'Disetujui' THEN 3 
                        WHEN status = 'Berjalan' THEN 4
                        WHEN status = 'Ditolak' THEN 5
                        ELSE 6
                    END,
                    no_booking ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByQuery($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingByUuid($uuid)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getBookingById($id)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->execute(['id' => $id]);
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
        uuid, no_booking, car_id, user_id, is_driver, driver_id, date_start, date_end, destination, total_harga, harga_mobil, denda_mobil, status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['no_booking'],
            $data['car_id'],
            $data['user_id'],
            $data['is_driver'],
            $data['driver_id'],
            $data['date_start'],
            $data['date_end'],
            $data['destination'],
            $data['total_harga'],
            $data['harga_mobil'],
            $data['denda_mobil'],
            $data['status'],
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

    public function getTotalCompletedBookings($month, $year)
    {
        $query = "SELECT COUNT(*) as total_completed 
                    FROM " . $this->table . " 
                    WHERE status = 'Selesai' 
                    AND MONTH(date_start) = :month 
                    AND YEAR(date_start) = :year";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':month', $month, PDO::PARAM_INT);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_completed'] ?? 0;
    }

    public function getTotalBookings()
    {
        $query = "SELECT COUNT(*) as total_completed 
                    FROM " . $this->table . " 
                    WHERE status IN ('Menunggu Konfirmasi', 'Belum Bayar')";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_completed'] ?? 0;
    }

    public function getNoBooking()
    {
        $currentYear = date('y');
        $currentMonth = date('m');

        $query = "SELECT no_booking FROM " . $this->table . " WHERE no_booking LIKE 'DRC/BOOK/$currentYear$currentMonth%' ORDER BY no_booking DESC LIMIT 1";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByUserId($user_id)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE user_id = :user_id" . " ORDER BY created_at DESC");
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByStatusesAndUuid(array $statuses, $uuid)
    {
        $placeholders = implode(',', array_fill(0, count($statuses), '?'));
        $query = "SELECT * FROM " . $this->table . " WHERE status IN ($placeholders) AND car_id = (SELECT id FROM tm_cars WHERE uuid = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array_merge($statuses, [$uuid]));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookingsByCarId($car_id)
    {
        $query = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE car_id = :car_id");
        $query->execute(['car_id' => $car_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatus($uuid, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            status = ? 
            WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['status'],
            $uuid
        ]);
    }

    public function getBookingsByCarAndStatuses($carId, array $statuses)
    {
        $placeholders = implode(',', array_fill(0, count($statuses), '?'));
        $query = "SELECT * FROM " . $this->table . " WHERE car_id = ? AND status IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        $params = array_merge([$carId], $statuses);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
