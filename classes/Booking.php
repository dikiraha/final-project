<?php
require_once 'Database.php';

class Booking
{
    private $conn;
    private $table = 'tt_bookings';

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
        uuid, no_booking, car_id, user_id, is_driver, driver_id, date_start, date_end, destination, total_harga, harga, denda, status
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
            $data['harga'],
            $data['denda'],
            $data['status'],
        ]);
    }

    public function update($uuid, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            photo = ?, 
            no_booking = ?, 
            car_id = ?, 
            user_id = ?, 
            is_driver = ?, 
            driver_id = ?, 
            date_start = ?, 
            date_end = ?, 
            destination = ?, 
            total_harga = ?, 
            harga = ?, 
            denda = ?, 
            status = ?, 
        WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['photo'],
            $data['no_booking'],
            $data['car_id'],
            $data['user_id'],
            $data['is_driver'],
            $data['driver_id'],
            $data['date_start'],
            $data['date_end'],
            $data['destination'],
            $data['total_harga'],
            $data['harga'],
            $data['denda'],
            $data['status'],
            $uuid
        ]);
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
}
