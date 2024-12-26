<?php
require_once 'Database.php';

class Photo
{
    private $conn;
    private $table = 'tm_photos';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
