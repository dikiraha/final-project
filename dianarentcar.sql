-- --------------------------------------------------------
-- Host:                         103.176.79.109
-- Server version:               8.0.40 - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table dianarentcar.tm_cars
CREATE TABLE IF NOT EXISTS `tm_cars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `jumlah_pintu` int NOT NULL,
  `warna` varchar(50) NOT NULL,
  `no_plat` varchar(50) NOT NULL,
  `tahun` year NOT NULL,
  `km` int NOT NULL,
  `jenis_bensin` varchar(50) NOT NULL,
  `harga` int NOT NULL DEFAULT (0),
  `denda` int NOT NULL DEFAULT (0),
  `transmisi` varchar(50) NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `no_plat` (`no_plat`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_cars: ~8 rows (approximately)
INSERT INTO `tm_cars` (`id`, `uuid`, `merk`, `tipe`, `jumlah_kursi`, `jumlah_pintu`, `warna`, `no_plat`, `tahun`, `km`, `jenis_bensin`, `harga`, `denda`, `transmisi`, `status`, `photo`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'cbb64a84-ac8d-420e-b9a8-42ecc645ecd4', 'Daihatsu', 'Sigra', 6, 4, 'Putih', 'T 1234 TT', '2020', 2201000, 'Pertamax', 350000, 20000, 'Automatic', 'Active', '676ce2a44a6d5-sigra.png', 15, 15, '2024-12-26 11:59:16', '2024-12-28 23:07:30'),
	(3, '695ccf4d-6c29-4650-aba3-a2117191c3e3', 'Toyota', 'Avanza', 6, 4, 'Hitam', 'T 2345 PP', '2020', 231231, 'Pertamax', 350000, 2000, 'Automatic', 'Active', '676ce7c67a446-avanza.png', 15, 15, '2024-12-26 12:21:10', '2024-12-29 05:42:26'),
	(4, 'a34923d4-5433-4783-9c0d-94bf9b358ab9', 'Toyota', 'Calya', 4, 4, 'Putih', 'T 1234 PP', '2024', 231312, 'Pertamax', 350000, 25000, 'Automatic', 'Active', '676ceb64ddff3-calya.png', 15, 15, '2024-12-26 12:36:36', '2024-12-28 21:18:31'),
	(5, 'c39ad506-79ff-4d9a-8bb0-6c9639a79534', 'Honda', 'Mobilio', 6, 4, 'Putih', 'T 3218 SI', '2022', 22000, 'Pertamax', 400000, 20000, 'Automatic', 'Active', '676db69ebf003-mobilio.png', 15, 15, '2024-12-27 03:03:42', '2024-12-28 21:18:15'),
	(6, 'b56bc0b2-4ee1-4360-84c5-5c6a5989bf79', 'Daihatsu', 'Xenia', 6, 4, 'Putih', 'T 7812 GH', '2019', 222777, 'Pertalite', 350000, 20000, 'Automatic', 'Active', '6770b1a8c34d7-xenia.png', 15, NULL, '2024-12-28 21:19:21', '2025-01-05 06:44:27'),
	(7, '83420b8f-9dcc-4b08-900d-a85a704aff16', 'Suzuki', 'Ertiga', 6, 4, 'Putih', 'T 9181 SA', '2020', 21320, 'Pertamax', 400000, 35000, 'Automatic', 'Active', '6770b1cacecc2-ertiga.png', 15, NULL, '2024-12-28 21:19:54', '2024-12-28 21:19:54'),
	(8, 'edbcbc4c-1bcf-4a52-8b5a-c38454971eca', 'Toyota', 'Rush', 6, 4, 'Putih', 'T 7261 JA', '2017', 22222, 'Pertamax', 450000, 35000, 'Automatic', 'Active', '6770b1e5593a2-rush.png', 15, NULL, '2024-12-28 21:20:21', '2025-01-04 03:26:51'),
	(9, '4911f98a-2588-45df-9e23-e8a5eaa75cb8', 'Suzuki', 'XL7', 6, 4, 'Putih', 'T 5526 LP', '2017', 212222, 'Pertalite', 450000, 23000, 'Automatic', 'Active', '6770b20485bff-xl7.png', 15, NULL, '2024-12-28 21:20:52', '2024-12-28 21:20:52');

-- Dumping structure for table dianarentcar.tm_profiles
CREATE TABLE IF NOT EXISTS `tm_profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `buku_nikah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `akte` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ijazah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `surat_keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `slip_gaji` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bpjs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tm_profiles_user_id` (`user_id`),
  CONSTRAINT `fk_tm_profiles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_profiles: ~3 rows (approximately)
INSERT INTO `tm_profiles` (`id`, `uuid`, `user_id`, `address`, `gender`, `photo_profile`, `ktp`, `sim`, `kk`, `buku_nikah`, `akte`, `ijazah`, `id_card`, `surat_keterangan`, `slip_gaji`, `bpjs`, `created_at`, `updated_at`) VALUES
	(5, '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5', 28, 'Jalan Raya Ciranggon No. 11', 'Laki-laki', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_Foto.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_KTP.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_SIM A.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_KK.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_Buku Nikah.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_Akte Kelahiran.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_Ijazah.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_ID Card.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_SK.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_Slip Gaji.jpg', '2e5edd6a-3cd3-45d7-9e42-c735e3b30bc5_BPJS.jpg', '2024-12-29 02:30:53', '2024-12-29 02:30:53'),
	(7, '1c33e104-102a-41bc-b522-6391ed663e66', 31, 'Jl. Paledang Gg. Serang Sari No. 26 RT07/17\r\nKel. Karawang Kulon, Kec. Karawang Barat', 'Laki-laki', '1c33e104-102a-41bc-b522-6391ed663e66_WhatsApp Image 2024-11-23 at 11.26.18.jpeg', '1c33e104-102a-41bc-b522-6391ed663e66_ktp.png', '1c33e104-102a-41bc-b522-6391ed663e66_sim.png', '1c33e104-102a-41bc-b522-6391ed663e66_kk.png', '1c33e104-102a-41bc-b522-6391ed663e66_buku_nikah.png', '1c33e104-102a-41bc-b522-6391ed663e66_akte.png', '1c33e104-102a-41bc-b522-6391ed663e66_ijazah.jpg', '1c33e104-102a-41bc-b522-6391ed663e66_id_card.jpg', '1c33e104-102a-41bc-b522-6391ed663e66_surat_keterangan.png', '1c33e104-102a-41bc-b522-6391ed663e66_slip_gaji.png', '1c33e104-102a-41bc-b522-6391ed663e66_bpjs.jpg', '2024-12-29 04:04:00', '2024-12-29 04:04:00'),
	(9, 'a6529be2-ca05-46f5-aa3f-96d9507f560f', 35, 'pati rt/rw 003/090 JAWA timur ', 'Laki-laki', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_Foto.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_KTP.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_SIM A.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_KK.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_Buku Nikah.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_Akte Kelahiran.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_Ijazah.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_ID Card.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_SK.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_Slip Gaji.jpg', 'a6529be2-ca05-46f5-aa3f-96d9507f560f_BPJS.jpg', '2025-01-05 08:25:54', '2025-01-05 08:25:54');

-- Dumping structure for table dianarentcar.tm_settings
CREATE TABLE IF NOT EXISTS `tm_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `owner` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(255) NOT NULL,
  `bank` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `account_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number_1` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number_2` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `agreement_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `agreement_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `visi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `misi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `about_company` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `history_company` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `about_footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_settings: ~1 rows (approximately)
INSERT INTO `tm_settings` (`id`, `uuid`, `owner`, `photo`, `bank`, `account_number`, `account_name`, `address`, `email`, `phone_number_1`, `phone_number_2`, `agreement_1`, `agreement_2`, `visi`, `misi`, `about_company`, `history_company`, `about_footer`, `facebook`, `instagram`, `twitter`, `tiktok`, `created_at`, `updated_at`) VALUES
	(5, 'be84d101-2cc8-4c30-9779-4672ca5e6918', 'Habudin', 'be84d101-2cc8-4c30-9779-4672ca5e6918_habudin.png', 'Mandiri', '5316718291', 'Habudin', 'Perum de Palumbon Residence Blok E No. 18 Jl. Manunggal VII RT. 04/12, Kel. Palumbonsari, Kec. Karawang Timur, Kab. Karawang', 'cs@dianarentcar.my.id', '08561344499', '0895369715444', '<ol>\r\n<li>\r\n<h3>Wajib Memiliki SIM A</h3>\r\n</li>\r\n<li>\r\n<h3>KTP, KK, Buku Nikah, Akte Kelahiran</h3>\r\n</li>\r\n<li>\r\n<h3>Ijazah Terakhir Min. SMA / Sederajat</h3>\r\n</li>\r\n<li>\r\n<h3>Nyimpan Motor STNK Pajak Hidup Min. Tahun 2018</h3>\r\n</li>\r\n<li>\r\n<h3>Karyawan ID Card, Surat Pengangkatan / Surat Kontrak, Slip Gaji Terakhir, BPJS Ketenagakerjaan</h3>\r\n</li>\r\n</ol>', '<p class="MsoNormal" style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; font-weight: bold; background-color: #ffffff;"><span style="box-sizing: border-box; font-weight: bolder;">PENTING DIKETAHUI POIN POIN KETENTUAN SEBAGAI BERIKUT</span></p>\r\n<ol style="box-sizing: border-box; padding-left: 2rem; margin-top: 0cm; margin-bottom: 1rem; color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; font-weight: bold; background-color: #ffffff;" start="1" type="1">\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Kendaraan Mobil yang disewa oleh penyewa tidak boleh diserahkan atau dipindah tangankan</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Kendaraan Monil yang disewa tidak boleh dijadikan jaminan atau digadaikan dengan alasan apapun</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Tidak boleh digunakan untuk kegiatan kejahatan atau membantu kegiatan kejahatan dan hal-hal terlarang dalam hukum, baik hukum adat maupun hukum positif yang berlaku di Indonesia</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Jika penyewa ingin memperpanjang masa pakai harus konfirmasi 2 jam sebelum masa pakai selesai dan harus seizin pengelola rental untuk dapat memperpanjang masa pakai</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Jika ada perubah tujuan dari yang disampaikan dalam surat perjanjian sewa kendaraan, maka harus disampaikan kepada pihak pengelola rental untuk mendapat persetujuan, dan apabila tidak disetujui oleh pengelola rental maka mobil wajib dikembalikan atau menuju tujuan awal</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Untuk penggalaran poin 1 s/d 5 pihak pengelola berhak menarik kendaraan (mobil) secara sepihak dan jika diperlukan pihak pengelola akan melaporkan penyewa kepada pihak yang berwenang kepolisian dalam bentuk tindak kejahatan</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Setiap kerusakan yang diakibatkan pemakaian penyewa adalah tanggung jawab sepenuhnya dari penyewa</span></li>\r\n<li class="MsoNormal" style="box-sizing: border-box;"><span style="box-sizing: border-box; font-weight: bolder;">Jika pada saat kembali, bensin (BBM) berkurang dari saat berangkat maka akan dikenakan denda dari pihak pengelola</span></li>\r\n</ol>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; text-align: center; background-color: #f2f2f2;">Menjadi penyedia layanan sewa mobil terbaik di Indonesia dengan mengutamakan kepuasan pelanggan dan pelayanan yang profesional.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; text-align: center; background-color: #f2f2f2;">Memberikan solusi transportasi yang aman dan nyaman bagi pelanggan, serta memastikan setiap perjalanan menjadi pengalaman yang menyenangkan.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">Kami adalah perusahaan penyedia layanan sewa mobil dan jasa supir profesional. Kami selalu berusaha memberikan kenyamanan dan keamanan terbaik untuk setiap perjalanan Anda. Kami menawarkan berbagai pilihan kendaraan dengan harga terjangkau, serta supir yang berpengalaman dan ramah.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">Kami percaya bahwa setiap perjalanan membutuhkan kenyamanan dan keandalan. Oleh karena itu, kami selalu memastikan bahwa setiap kendaraan yang kami sediakan dalam kondisi terbaik dan supir kami memiliki pengalaman yang cukup untuk menemani perjalanan Anda. Dengan layanan kami, Anda dapat merasa tenang dan menikmati perjalanan tanpa khawatir.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px;">Kami menyediakan layanan penyewaan mobil berkualitas dan jasa supir profesional untuk memenuhi kebutuhan perjalanan Anda. Dengan armada yang terawat dan layanan terbaik, kami siap menemani perjalanan Anda dengan nyaman dan aman.</span></p>', '', '', '', '', '2024-12-29 02:37:11', '2025-01-05 12:48:28');

-- Dumping structure for table dianarentcar.tt_bookings
CREATE TABLE IF NOT EXISTS `tt_bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_booking` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `car_id` int NOT NULL,
  `user_id` int NOT NULL,
  `is_driver` int DEFAULT NULL,
  `driver_id` int DEFAULT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_mobil` int NOT NULL,
  `total_harga` int NOT NULL,
  `denda_mobil` int DEFAULT NULL,
  `total_denda` int DEFAULT NULL,
  `status` enum('Belum Bayar','Menunggu Konfirmasi','Disetujui','Ditolak','Berjalan','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tt_bookings_car_id` (`car_id`),
  KEY `fk_tt_bookings_user_id` (`user_id`),
  KEY `fk_tt_bookings_driver_id` (`driver_id`),
  CONSTRAINT `fk_tt_bookings_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_bookings_driver_id` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_bookings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_bookings: ~7 rows (approximately)
INSERT INTO `tt_bookings` (`id`, `uuid`, `no_booking`, `car_id`, `user_id`, `is_driver`, `driver_id`, `date_start`, `date_end`, `destination`, `harga_mobil`, `total_harga`, `denda_mobil`, `total_denda`, `status`, `note`, `created_at`, `updated_at`) VALUES
	(29, '57b54592-62e2-4331-ad30-8042826e1129', 'DRC/BOOK/2412005', 6, 28, 1, 27, '2024-12-29 10:30:00', '2024-12-30 10:30:00', 'Bali', 350000, 500000, 20000, 0, 'Selesai', NULL, '2024-12-29 02:32:43', '2024-12-29 07:50:40'),
	(31, 'd134d5b7-77fd-439e-b9e9-feb84b4750f8', 'DRC/BOOK/2412006', 2, 31, 1, 27, '2024-12-29 11:04:00', '2024-12-30 11:04:00', 'Bandung', 350000, 500000, 20000, 0, 'Selesai', NULL, '2024-12-29 04:05:03', '2024-12-29 04:07:30'),
	(32, '89d8bea6-12bb-45cd-bf2c-32ab558215b6', 'DRC/BOOK/2412007', 6, 31, 1, 27, '2024-12-29 20:44:00', '2024-12-30 20:44:00', 'Bandung', 350000, 500000, 20000, 2280000, 'Selesai', NULL, '2024-12-29 13:44:50', '2025-01-04 08:27:04'),
	(33, '0b95a5b7-eabe-45d2-a632-4960af952ea6', 'DRC/BOOK/2412008', 8, 31, 0, NULL, '2024-12-29 21:00:00', '2025-01-02 21:00:00', 'Bandung', 450000, 1800000, 35000, 1470000, 'Selesai', NULL, '2024-12-29 13:59:30', '2025-01-04 08:26:52'),
	(35, 'b1265f8d-fee1-47f0-b0da-8ea07114463f', 'DRC/BOOK/2501001', 6, 35, 1, 27, '2025-01-31 15:00:00', '2026-01-05 15:00:00', 'malaysia', 350000, 169500000, 20000, 0, 'Selesai', NULL, '2025-01-05 08:31:37', '2025-01-05 11:42:46'),
	(38, '0d67ff5b-6bb5-440c-b4d1-7169e9c095f7', 'DRC/BOOK/2501002', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:28:54', '2025-01-05 09:28:54'),
	(39, '495c3236-470c-409e-a984-6b252d075bcf', 'DRC/BOOK/2501003', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:36:11', '2025-01-05 09:36:11'),
	(40, 'a2c2dff6-55b1-43a9-abe3-07c011c8863a', 'DRC/BOOK/2501004', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:41:27', '2025-01-05 09:41:27'),
	(41, '4d826470-34e9-4088-b13f-565067a1ee28', 'DRC/BOOK/2501005', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:41:42', '2025-01-05 09:41:42'),
	(42, 'bb645664-e8a7-4f3b-b9c3-dc386c95f576', 'DRC/BOOK/2501006', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:42:11', '2025-01-05 09:42:11'),
	(43, '9d5f9417-378a-467d-9618-91afa7c7e0b4', 'DRC/BOOK/2501007', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 09:55:20', '2025-01-05 09:55:20'),
	(44, 'bfe9a5cc-86d5-475c-a556-75c7ce12f3b3', 'DRC/BOOK/2501008', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 10:04:42', '2025-01-05 10:04:42'),
	(45, 'c64b6af8-78b9-4cc0-aec4-53c939f7c212', 'DRC/BOOK/2501009', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 10:05:16', '2025-01-05 10:05:16'),
	(46, 'b87b310b-9e6d-4a8f-b040-91455d7cc66b', 'DRC/BOOK/2501010', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 10:07:41', '2025-01-05 10:07:41'),
	(47, '54203e50-3d4a-458c-a8bd-024f920f9c5e', 'DRC/BOOK/2501011', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 11:30:30', '2025-01-05 11:30:30'),
	(48, '8018646b-eaa6-4f9f-8ddb-b037e6e27bd5', 'DRC/BOOK/2501012', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 11:32:36', '2025-01-05 11:32:36'),
	(49, 'a5c03002-56ef-4771-b3aa-43d8cd81786a', 'DRC/BOOK/2501013', 2, 31, 1, 27, '2025-01-05 18:34:00', '2025-01-06 18:34:00', 'Bandung', 350000, 500000, 20000, 0, 'Ditolak', NULL, '2025-01-05 11:34:31', '2025-01-05 11:41:40'),
	(50, 'f4a87aea-505a-4375-bfc3-32eb119f4fc1', 'DRC/BOOK/2501014', 5, 28, 1, NULL, '2025-01-05 16:30:00', '2025-01-06 16:30:00', 'Wonogiri', 400000, 550000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 11:34:47', '2025-01-05 11:34:47'),
	(51, '69eb2964-9cbd-4f6d-ac9d-5f5ce1a08ee2', 'DRC/BOOK/2501015', 6, 28, 1, NULL, '2025-01-06 18:35:00', '2025-01-07 18:35:00', 'Wonogiri', 350000, 500000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 11:35:54', '2025-01-05 11:35:54'),
	(52, 'ab5e6765-5f8f-41bc-915e-70e2c8e9d253', 'DRC/BOOK/2501016', 6, 28, 1, 27, '2025-01-06 19:00:00', '2025-01-07 19:00:00', 'Wonogiri', 350000, 500000, 20000, 0, 'Selesai', NULL, '2025-01-05 11:37:57', '2025-01-05 11:44:27'),
	(53, 'b1957c13-4e4b-4c2c-8933-bf3eb288fd49', 'DRC/BOOK/2501017', 2, 28, 1, NULL, '2025-01-06 18:00:00', '2025-01-07 18:00:00', 'Wonogiri', 350000, 500000, 20000, NULL, 'Belum Bayar', NULL, '2025-01-05 11:39:02', '2025-01-05 11:39:02');

-- Dumping structure for table dianarentcar.tt_payments
CREATE TABLE IF NOT EXISTS `tt_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL,
  `car_id` int NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `evidence_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tt_payments_booking_id` (`booking_id`),
  KEY `fk_tt_payments_user_id` (`user_id`),
  KEY `fk_tt_payments_car_id` (`car_id`),
  CONSTRAINT `fk_tt_payments_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `tt_bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_payments_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_payments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_payments: ~7 rows (approximately)
INSERT INTO `tt_payments` (`id`, `uuid`, `booking_id`, `user_id`, `car_id`, `method`, `type`, `amount`, `evidence_file`, `created_at`, `updated_at`) VALUES
	(14, 'c8c2341d-3f64-4831-97fd-ea548283a9c3', 29, 28, 6, 'Cash', NULL, 500000, NULL, '2024-12-29 02:32:44', '2024-12-29 05:51:08'),
	(16, '6f1503e7-3a41-4d12-a417-3c71fbb3ab8f', 31, 31, 2, 'Transfer', 'DP (Uang Muka)', 500000, '6f1503e7-3a41-4d12-a417-3c71fbb3ab8f_kk.png', '2024-12-29 04:05:04', '2024-12-29 04:06:43'),
	(17, 'd43b4de7-2ab8-4590-b977-1c7a4706d38d', 32, 31, 6, 'Cash', NULL, 500000, NULL, '2024-12-29 13:44:51', '2024-12-29 13:45:24'),
	(18, '1cfea183-cced-42bb-8a68-8e0791682cbf', 33, 31, 8, 'Cash', NULL, 1800000, NULL, '2024-12-29 13:59:30', '2024-12-29 14:00:12'),
	(20, '2befd8dc-b851-4efa-bdc7-5ef518b894fb', 35, 35, 6, 'Cash', NULL, 1000000, NULL, '2025-01-05 08:31:37', '2025-01-05 11:42:46'),
	(23, '42e0ec08-3f3d-46fc-8a4b-6a7a67f51e80', 49, 31, 2, 'Cash', NULL, 500000, NULL, '2025-01-05 11:34:31', '2025-01-05 11:41:40'),
	(24, 'f84cd632-ae9d-4557-8270-980d50a80549', 52, 28, 6, 'Cash', NULL, 500000, NULL, '2025-01-05 11:37:57', '2025-01-05 11:41:02'),
	(25, '1518f50b-facf-479c-bd9f-4eb197d27ee0', 53, 28, 2, 'Transfer', 'DP (Uang Muka)', 200000, NULL, '2025-01-05 11:39:02', '2025-01-05 11:39:02');

-- Dumping structure for table dianarentcar.tt_reviews
CREATE TABLE IF NOT EXISTS `tt_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `booking_id` int NOT NULL,
  `car_id` int NOT NULL,
  `user_id` int NOT NULL,
  `grade` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tt_reviews_car_id` (`car_id`),
  KEY `fk_tt_reviews_user_id` (`user_id`),
  KEY `fk_tt_reviews_booking_id` (`booking_id`),
  CONSTRAINT `fk_tt_reviews_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `tt_bookings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_reviews_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_reviews: ~1 rows (approximately)
INSERT INTO `tt_reviews` (`id`, `uuid`, `booking_id`, `car_id`, `user_id`, `grade`, `description`, `created_at`, `updated_at`) VALUES
	(6, '9aeb432f-50c3-4131-a5cb-ca7362e19096', 31, 2, 31, 4, 'Layanan baik, mobil bagus', '2024-12-29 04:09:10', '2024-12-29 04:09:10');

-- Dumping structure for table dianarentcar.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('admin','driver','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_verified` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `phone_number`, `role`, `password`, `code`, `is_verified`, `created_at`, `updated_at`) VALUES
	(15, 'a72c4551-846e-42b8-a0d3-d1417d630050', 'Admin', 'admin@dianarentcar.my.id', '082125008162', 'admin', '$2y$10$bBylPZFyCmZKih7jw2.0MepdXwlaYGoRNy.FqCHbYWRI7XrJiY0Xm', NULL, NULL, '2024-12-14 05:16:59', '2024-12-28 16:08:50'),
	(27, '69a4a059-8115-4a47-8c13-ef59aab88142', 'Huda Akbar Nugraha', 'huda@dianarentcar.my.id', '082125008167', 'driver', '$2y$10$DP9AiL4Sjcfi3J8WyI4DrORtqirgz8Rum5VOzZM0wL5l/FmIeXsYC', NULL, NULL, '2024-12-28 06:58:57', '2025-01-05 11:33:11'),
	(28, 'a19b3c3e-5176-464e-9738-9daee9aa504a', 'Agus', 'agus66@gmail.com', '081314233299', 'user', '$2y$10$YZ5W3BYkHtZrpL5/Dbnvt.uWUiWerQKgZUJM0ukidF/Mwv5tXIXLi', NULL, NULL, '2024-12-29 02:22:20', '2025-01-05 09:27:49'),
	(31, 'd61043b2-316e-4e2c-ba74-91784d25ab2c', 'Muhammad Diki Dwi Nugraha', 'diki@dianarentcar.my.id', '082125008160', 'user', '$2y$10$K2MbqUFHFcSdJweoq.iJAelxiabV3.PvM7Z1oB4cTW8sZ86YVMtam', NULL, NULL, '2024-12-29 04:01:09', '2024-12-29 04:01:09'),
	(33, 'f597824e-f284-4cc5-8acb-3a28ab44380e', 'Huda Akbar Nugraha', 'hudaakbarnugraha@grc.com', '090909090909', 'user', '$2y$10$DFXkSHJ8.nN0lSIs/Z.iHOkX/TJIrB4Y8Nd3eoZDR47keP5VbAXxu', NULL, NULL, '2024-12-30 12:35:24', '2024-12-30 12:35:24'),
	(35, '8e68671d-61ea-4993-bdd5-e27b67048f4a', 'Muhibhabudin', 'muhibhabudin@gmail.com', '087564231134', 'user', '$2y$10$iYNg6V2INGfiAxMKXIBmEeOJ01UhR9mgVa9tUL9QV99ioUt30W.Ja', NULL, NULL, '2025-01-05 08:13:36', '2025-01-05 11:35:14');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
