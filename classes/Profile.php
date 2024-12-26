<?php
require_once 'Database.php';

class Profile
{
    private $conn;
    private $table = 'tm_profiles';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getByUserId($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
