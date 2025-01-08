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

    public function saveOrUpdate($data)
    {
        $existingProfile = $this->getByUserId($data['user_id']);
        if ($existingProfile) {
            $query = "UPDATE " . $this->table . "
                    SET 
                        address = :address,
                        gender = :gender,
                        photo_profile = :photo_profile,
                        ktp = :ktp,
                        sim = :sim,
                        kk = :kk,
                        buku_nikah = :buku_nikah,
                        akte = :akte,
                        ijazah = :ijazah,
                        id_card = :id_card,
                        surat_keterangan = :surat_keterangan,
                        slip_gaji = :slip_gaji,
                        bpjs = :bpjs
                    WHERE user_id = :user_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':photo_profile', $data['photo_profile']);
            $stmt->bindParam(':ktp', $data['ktp']);
            $stmt->bindParam(':sim', $data['sim']);
            $stmt->bindParam(':kk', $data['kk']);
            $stmt->bindParam(':buku_nikah', $data['buku_nikah']);
            $stmt->bindParam(':akte', $data['akte']);
            $stmt->bindParam(':ijazah', $data['ijazah']);
            $stmt->bindParam(':id_card', $data['id_card']);
            $stmt->bindParam(':surat_keterangan', $data['surat_keterangan']);
            $stmt->bindParam(':slip_gaji', $data['slip_gaji']);
            $stmt->bindParam(':bpjs', $data['bpjs']);
            $stmt->bindParam(':user_id', $data['user_id']);
        } else {
            $query = "INSERT INTO " . $this->table . " 
                (uuid, user_id, address, gender, photo_profile, ktp, sim, kk, buku_nikah, akte, ijazah, id_card, surat_keterangan, slip_gaji, bpjs) VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($query);

            return $stmt->execute([
                $data['uuid'],
                $data['user_id'],
                $data['address'],
                $data['gender'],
                $data['photo_profile'],
                $data['ktp'],
                $data['sim'],
                $data['kk'],
                $data['buku_nikah'],
                $data['akte'],
                $data['ijazah'],
                $data['id_card'],
                $data['surat_keterangan'],
                $data['slip_gaji'],
                $data['bpjs']
            ]);
        }

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Profile Save/Update Error: ' . $e->getMessage());
            return false;
        }
    }
}
