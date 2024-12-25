<?php
require_once 'Database.php';

class Car
{
    private $conn;
    private $table = 'tm_cars';

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
        $query = "INSERT INTO " . $this->table . " (
        uuid, merk, tipe, jumlah_kursi, jumlah_pintu, warna, no_plat, tahun, km, jenis_bensin, harga, denda, transmisi, photo, created_by
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['uuid'],
            $data['merk'],
            $data['tipe'],
            $data['jumlah_kursi'],
            $data['jumlah_pintu'],
            $data['warna'],
            $data['no_plat'],
            $data['tahun'],
            $data['km'],
            $data['jenis_bensin'],
            $data['harga'],
            $data['denda'],
            $data['transmisi'],
            $data['photo'],
            $data['created_by']
        ]);
    }

    public function update($uuid, $data)
    {
        $query = "UPDATE " . $this->table . " SET 
            photo = ?, 
            merk = ?, 
            tipe = ?, 
            jumlah_kursi = ?, 
            jumlah_pintu = ?, 
            warna = ?, 
            no_plat = ?, 
            tahun = ?, 
            km = ?, 
            jenis_bensin = ?, 
            harga = ?, 
            denda = ?, 
            transmisi = ?, 
            updated_by = ? 
        WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['photo'],
            $data['merk'],
            $data['tipe'],
            $data['jumlah_kursi'],
            $data['jumlah_pintu'],
            $data['warna'],
            $data['no_plat'],
            $data['tahun'],
            $data['km'],
            $data['jenis_bensin'],
            $data['harga'],
            $data['denda'],
            $data['transmisi'],
            $data['updated_by'],
            $uuid
        ]);
    }

    public function delete($uuid)
    {
        $query = "DELETE FROM " . $this->table . " WHERE uuid = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$uuid]);
    }

    public function getTotalCars()
    {
        $sql = "SELECT COUNT(*) AS total FROM tm_cars";
        // Jalankan query dan kembalikan hasilnya
        // Misalnya menggunakan PDO
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Fungsi untuk mendapatkan total kilometer
    public function getTotalKilometers()
    {
        $sql = "SELECT SUM(km) AS total_km FROM tm_cars";
        // Jalankan query dan kembalikan hasilnya
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_km'];
    }
}
