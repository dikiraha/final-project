<?php
require_once 'Database.php';

class Sk
{
    private $conn;
    private $table = 'terms_conditions';

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
        $query = "INSERT INTO " . $this->table . " (uuid, context, content) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['context'],
            $data['content'],
        ]);
    }

    public function updateByUuid($uuid, $data)
    {
        $query = "UPDATE " . $this->table . " 
                SET context = ?, content = ?" .
            " WHERE uuid = ?";
        $params = [
            $data['name'],
            $data['context'],
            $data['content'],
        ];

        $params[] = $uuid;
        $stmt = $this->conn->prepare($query);

        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        $query = "DELETE FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$uuid]);
    }
}
