<?php
require_once 'Database.php';

class User
{
    private $conn;
    private $table = 'users';

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function list()
    {
        $query = "SELECT id, name, email, role, created_at FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (uuid, name, email, password, phone_number, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT); // Hash password
        return $stmt->execute([
            $data['uuid'],
            $data['name'],
            $data['email'],
            $data['password'],
            $data['phone_number'],
            $data['role']
        ]);
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " SET name = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['role'],
            $id
        ]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
