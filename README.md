![Alt Text](https://camo.githubusercontent.com/c5b3937f91571ee5f08666616aba844deff3b6d173a3aff153a3b9647136a3f0/68747470733a2f2f75706c6f61642e77696b696d656469612e6f72672f77696b6970656469612f636f6d6d6f6e732f7468756d622f322f32372f5048502d6c6f676f2e7376672f35303070782d5048502d6c6f676f2e7376672e706e67 "PHP")

# **_Diana Rent Car_**

**Aplikasi Sewa Mobil dan Jasa Supir**

Diana Rent Car adalah aplikasi berbasis web yang dirancang menggunakan PHP Native untuk menyediakan layanan penyewaan mobil dan jasa supir secara efisien dan mudah digunakan.

## Fitur Utama

1. Manajemen Mobil

- Tambah, edit, dan hapus data mobil.
- Upload gambar mobil untuk tampilan yang menarik.

2. Penyewaan Mobil

- Lihat detail mobil beserta syarat dan ketentuan.
- Booking mobil dengan konfirmasi pemesanan.

3. Manajemen Jasa Supir

- Pilih jasa supir sebagai tambahan dalam penyewaan.

4. Manajemen Pengguna

- Login, logout, dan akses berdasarkan role (admin dan pengguna).
- CRUD pengguna (admin dapat mengelola pengguna).

5. Dashboard Statistik

- Menampilkan statistik penyewaan mobil secara real-time.

6. Syarat dan Ketentuan

- Ditampilkan saat melihat detail mobil dan konfirmasi booking.

## Struktur Folder

- /admin: Panel admin untuk mengelola aplikasi.
- /pages: Halaman utama untuk pengguna, seperti daftar mobil dan formulir booking.
- /classes: Kelas PHP untuk manajemen database dan logika aplikasi.
- /assets: Folder untuk file statis, seperti CSS, JavaScript, dan gambar.
- /vendor: Library eksternal yang digunakan (jika ada, seperti UUID).

## Teknologi yang Digunakan

- Frontend: HTML, CSS, JavaScript.
- Backend: PHP Native.
- Database: MySQL.
- Library:
  - Ramsey/UUID untuk pembuatan UUID unik.

## Cara Instalasi

1. Clone atau Download Proyek

```bash
git clone https://github.com/dikiraha/final-project.git
```

2. Konfigurasi Database

- Buat database baru di MySQL, misalnya diana_rent_car.
- Import file diana_rent_car.sql yang terdapat di folder database.

3. Konfigurasi Koneksi Database
   Edit file classes/Database.php dan sesuaikan dengan pengaturan server:

```bash
private $host = 'localhost';
private $dbname = 'dianarentcar';
private $username = 'root';
private $password = '';
```

4. Jalankan Proyek

- Pastikan server lokal (XAMPP/Laragon) aktif.
- Akses aplikasi melalui http://localhost/final-project.

## Cara Penggunaan

1. Admin

- Login melalui http://localhost/final-project/login.

```bash
email   : admin@drc.ocm
password: admin
```

- Kelola data mobil, pengguna, dan penyewaan.

2. Pengguna

- Daftar akun baru melalui halaman pendaftaran.
- Pilih mobil yang ingin disewa, lihat detailnya, dan lakukan booking.

## Catatan Penting

- Pastikan PHP versi 7.4 atau lebih baru digunakan.
- Aktifkan modul PDO pada server lokal untuk mendukung koneksi database.
- Jika ada kendala, periksa log error di logs/error.log (jika diaktifkan).

## Pengembang

Diana Rent Car dikembangkan oleh:

1. Muhammad Diki Dwi Nugraha (if23.muhammadnugraha189@mhs.ubpkarawang.ac.id)
2. Huda Akbar Nugraha (if23.hudanugraha@mhs.ubpkarawang.ac.id)
3. Emul Mulyana (if23.emulmulyana@mhs.ubpkarawang.ac.id)

## Lisensi

Proyek ini dilisensikan di bawah MIT License. Anda bebas untuk menggunakan, memodifikasi, dan mendistribusikan proyek ini dengan tetap mencantumkan atribusi kepada pengembang asli.
