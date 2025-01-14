<?php
require_once 'Database.php';

class Review
{
    private $conn;
    private $table = 'tt_reviews';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function list()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (
        uuid, booking_id, car_id, user_id, grade, description
    ) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['booking_id'],
            $data['car_id'],
            $data['user_id'],
            $data['grade'],
            $data['description'],
        ]);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE booking_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalReviews()
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $this->table . " WHERE grade > 3";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
