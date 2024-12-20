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
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function updateByUuid($uuid, $data)
    {
        $query = "UPDATE " . $this->table . " 
                SET name = ?, email = ?, phone_number = ?, role = ?" .
            (isset($data['password']) ? ", password = ?" : "") .
            " WHERE uuid = ?";
        $params = [
            $data['name'],
            $data['email'],
            $data['phone_number'],
            $data['role']
        ];

        // Tambahkan password ke parameter jika ada
        if (isset($data['password'])) {
            $params[] = $data['password'];
        }

        $params[] = $uuid; // UUID sebagai parameter terakhir
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        $query = "DELETE FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$uuid]);
    }

    public function getByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
