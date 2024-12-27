<?php
require_once 'Database.php';

class Setting
{
    private $conn;
    private $table = 'tm_settings';

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

    public function detail($uuid)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        $query = "INSERT INTO " . $this->table . " (uuid, owner, photo, bank, account_number, account_name, address, email, phone_number_1, phone_number_2, agreement_1, agreement_2, visi, misi, about_company, history_company, about_footer, facebook, instagram, twitter, tiktok) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $data['uuid'],
            $data['owner'],
            $data['photo'],
            $data['bank'],
            $data['account_number'],
            $data['account_name'],
            $data['address'],
            $data['email'],
            $data['phone_number_1'],
            $data['phone_number_2'],
            $data['agreement_1'],
            $data['agreement_2'],
            $data['visi'],
            $data['misi'],
            $data['about_company'],
            $data['history_company'],
            $data['about_footer'],
            $data['facebook'],
            $data['instagram'],
            $data['twitter'],
            $data['tiktok']
        ]);
    }

    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " 
                SET owner = ?, photo = ?, bank = ?, account_number = ?, account_name = ?, address = ?, email = ?, phone_number_1 = ?, phone_number_2 = ?, agreement_1 = ?, agreement_2 = ?, visi = ?, misi = ?, about_company = ?, history_company = ?, about_footer = ?, facebook = ?, instagram = ?, twitter = ?, tiktok = ? 
                WHERE id = ?";
        $params = [
            $data['owner'],
            $data['profile'],
            $data['bank'],
            $data['account_number'],
            $data['account_name'],
            $data['address'],
            $data['email'],
            $data['phone_number_1'],
            $data['phone_number_2'],
            $data['agreement_1'],
            $data['agreement_2'],
            $data['visi'],
            $data['misi'],
            $data['about_company'],
            $data['history_company'],
            $data['about_footer'],
            $data['facebook'],
            $data['instagram'],
            $data['twitter'],
            $data['tiktok'],
            $id
        ];

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        $query = "DELETE FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$uuid]);
    }

    public function getFirstSetting()
    {
        $query = "SELECT * FROM " . $this->table . " LIMIT 1";
        $stmt = $this->conn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
