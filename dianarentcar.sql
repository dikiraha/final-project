-- --------------------------------------------------------
-- Host:                         dikiraha.my.id
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_cars: ~4 rows (approximately)
INSERT INTO `tm_cars` (`id`, `uuid`, `merk`, `tipe`, `jumlah_kursi`, `jumlah_pintu`, `warna`, `no_plat`, `tahun`, `km`, `jenis_bensin`, `harga`, `denda`, `transmisi`, `status`, `photo`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'cbb64a84-ac8d-420e-b9a8-42ecc645ecd4', 'Daihatsu', 'Sigra', 6, 4, 'Putih', 'T 1234 TT', '2020', 2134124, 'Pertamax', 20000, 2000, 'Automatic', 'Active', '676ce2a44a6d5-sigra.png', 15, 15, '2024-12-26 11:59:16', '2024-12-27 03:02:52'),
	(3, '695ccf4d-6c29-4650-aba3-a2117191c3e3', 'Toyota', 'Avanza', 6, 4, 'Putih', 'T 2345 PP', '2020', 231231, 'Pertamax', 200000, 2000, 'Automatic', 'Active', '676ce7c67a446-avanza.png', 15, 15, '2024-12-26 12:21:10', '2024-12-27 03:02:44'),
	(4, 'a34923d4-5433-4783-9c0d-94bf9b358ab9', 'Toyota', 'Calya', 4, 4, 'Putih', 'T 1234 PP', '2024', 231312, 'Pertamax', 200000, 25000, 'Automatic', 'Active', '676ceb64ddff3-calya.png', 15, NULL, '2024-12-26 12:36:36', '2024-12-26 12:36:36'),
	(5, 'c39ad506-79ff-4d9a-8bb0-6c9639a79534', 'Honda', 'Mobilio', 6, 4, 'Putih', 'T 3218 SI', '2022', 21391, 'Pertamax', 1000000, 100000, 'Automatic', 'Active', '676db69ebf003-mobilio.png', 15, NULL, '2024-12-27 03:03:42', '2024-12-27 03:03:42');

-- Dumping structure for table dianarentcar.tm_discounts
CREATE TABLE IF NOT EXISTS `tm_discounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `car_id` int NOT NULL,
  `discount` int NOT NULL,
  `condition` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tm_discounts_car_id` (`car_id`),
  CONSTRAINT `fk_tm_discounts_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_discounts: ~0 rows (approximately)

-- Dumping structure for table dianarentcar.tm_photos
CREATE TABLE IF NOT EXISTS `tm_photos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_id` int NOT NULL,
  `file` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tm_photos_car_id` (`car_id`),
  CONSTRAINT `fk_tm_photos_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_photos: ~0 rows (approximately)

-- Dumping structure for table dianarentcar.tm_profiles
CREATE TABLE IF NOT EXISTS `tm_profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `photo_profile` varchar(50) NOT NULL,
  `ktp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kk` varchar(50) NOT NULL,
  `buku_nikah` varchar(50) DEFAULT NULL,
  `akte` varchar(50) NOT NULL,
  `ijazah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_card` varchar(50) DEFAULT NULL,
  `surat_keterangan` varchar(50) DEFAULT NULL,
  `slip_gaji` varchar(50) DEFAULT NULL,
  `bpjs` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tm_profiles_user_id` (`user_id`),
  CONSTRAINT `fk_tm_profiles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_profiles: ~1 rows (approximately)
INSERT INTO `tm_profiles` (`id`, `uuid`, `user_id`, `address`, `gender`, `photo_profile`, `ktp`, `sim`, `kk`, `buku_nikah`, `akte`, `ijazah`, `id_card`, `surat_keterangan`, `slip_gaji`, `bpjs`, `created_at`, `updated_at`) VALUES
	(2, '217b7f23-7013-433e-9d04-a3692547b28d', 26, 'Ajo', 'Laki-laki', 'ada', 'ada', 'ada', 'ada', NULL, 'ada', 'ada', NULL, NULL, NULL, NULL, '2024-12-28 09:34:02', '2024-12-28 09:34:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tm_settings: ~1 rows (approximately)
INSERT INTO `tm_settings` (`id`, `uuid`, `owner`, `photo`, `bank`, `account_number`, `account_name`, `address`, `email`, `phone_number_1`, `phone_number_2`, `agreement_1`, `agreement_2`, `visi`, `misi`, `about_company`, `history_company`, `about_footer`, `facebook`, `instagram`, `twitter`, `tiktok`, `created_at`, `updated_at`) VALUES
	(4, '3fca549e-6ead-48d9-ba41-726d8e8dcb60', 'Diki', '3fca549e-6ead-48d9-ba41-726d8e8dcb60_Capture.jpg', 'Maybank', '1232001543', 'M. Diki Dwi Nugraha', 'Perum de Palumbon Residence Blok E No. 18 Jl. Manunggal VII RT. 04/12, Kel. Palumbonsari, Kec. Karawang Timur, Kab. Karawang', 'diki@aiia.co.id', '082125008160', '0881081929629', '<ol style="margin-top: 0cm;" start="1" type="1">\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;">Wajib Memiliki SIM A</li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;">KTP, KK, Buku Nikah, Akte Kelahiran</li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;">Ijazah Terakhir Min. SMA / Sederajat</li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;">Nyimpan Motor STNK Pajak Hidup Min. Tahun 2018</li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;">Karyawan ID Card, Surat Pengangkatan / Surat Kontrak, Slip Gaji Terakhir, BPJS Ketenagakerjaan</li>\r\n</ol>', '<p class="MsoNormal"><strong>PENTING DIKETAHUI POIN POIN KETENTUAN SEBAGAI BERIKUT</strong></p>\r\n<ol style="margin-top: 0cm;" start="1" type="1">\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;"><strong>Kendaraan Mobil yang disewa oleh penyewa tidak boleh diserahkan atau dipindah tangankan</strong></li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;"><strong>Kendaraan Monil yang disewa tidak boleh dijadikan jaminan atau digadaikan dengan alasan apapun</strong></li>\r\n<li class="MsoNormal" style="mso-list: l0 level1 lfo1; tab-stops: list 36.0pt;"><strong>Tidak boleh digunakan untuk kegiatan kejahatan atau membantu kegiatan kejahatan dan hal-hal terlarang dalam hukum, baik hukum adat maupun hukum positif yang berlaku di Indonesia</strong></li>\r\n</ol>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; text-align: center; background-color: #f2f2f2;">Menjadi penyedia layanan sewa mobil terbaik di Indonesia dengan mengutamakan kepuasan pelanggan dan pelayanan yang profesional.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; text-align: center; background-color: #f2f2f2;">Memberikan solusi transportasi yang aman dan nyaman bagi pelanggan, serta memastikan setiap perjalanan menjadi pengalaman yang menyenangkan.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">Kami adalah perusahaan penyedia layanan sewa mobil dan jasa supir profesional. Dengan pengalaman lebih dari 8 tahun, kami selalu berusaha memberikan kenyamanan dan keamanan terbaik untuk setiap perjalanan Anda. Kami menawarkan berbagai pilihan kendaraan dengan harga terjangkau, serta supir yang berpengalaman dan ramah.</span></p>', '<p><span style="color: #6e7684; font-family: Lato, sans-serif; font-size: 16px; background-color: #ffffff;">Kami percaya bahwa setiap perjalanan membutuhkan kenyamanan dan keandalan. Oleh karena itu, kami selalu memastikan bahwa setiap kendaraan yang kami sediakan dalam kondisi terbaik dan supir kami memiliki pengalaman yang cukup untuk menemani perjalanan Anda. Dengan layanan kami, Anda dapat merasa tenang dan menikmati perjalanan tanpa khawatir.</span></p>', '<p>Kami menyediakan layanan penyewaan mobil berkualitas dan jasa supir profesional untuk memenuhi kebutuhan perjalanan Anda. Dengan armada yang terawat dan layanan terbaik, kami siap menemani perjalanan Anda dengan nyaman dan aman.</p>', '', '', '', '', '2024-12-27 16:39:25', '2024-12-27 17:34:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_bookings: ~3 rows (approximately)
INSERT INTO `tt_bookings` (`id`, `uuid`, `no_booking`, `car_id`, `user_id`, `is_driver`, `driver_id`, `date_start`, `date_end`, `destination`, `harga_mobil`, `total_harga`, `denda_mobil`, `total_denda`, `status`, `created_at`, `updated_at`) VALUES
	(19, '38a1b575-12c2-45d6-bb47-f6f9458dcbbd', 'DRC/BOOK/2412001', 2, 26, 1, NULL, '2024-12-28 07:27:00', '2024-12-31 07:27:00', 'Bandung', 20000, 510000, 2000, NULL, 'Belum Bayar', '2024-12-27 21:27:30', '2024-12-27 21:27:30'),
	(20, '1c93fd63-6dc3-4f34-9d5d-9ca423957b02', 'DRC/BOOK/2412002', 2, 26, 1, NULL, '2024-12-28 07:27:00', '2024-12-31 07:27:00', 'Bandung', 20000, 510000, 2000, NULL, 'Belum Bayar', '2024-12-27 21:27:57', '2024-12-27 21:27:57'),
	(21, '206afdb5-76cd-4a7c-9a70-6dcc82758d43', 'DRC/BOOK/2412003', 5, 26, 1, NULL, '2024-12-28 07:32:00', '2024-12-31 08:33:00', 'Bandung', 1000000, 4600000, 100000, NULL, 'Belum Bayar', '2024-12-27 21:33:21', '2024-12-27 21:33:21');

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
  `evidence` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_payments: ~1 rows (approximately)
INSERT INTO `tt_payments` (`id`, `uuid`, `booking_id`, `user_id`, `car_id`, `method`, `type`, `amount`, `evidence`, `created_at`, `updated_at`) VALUES
	(7, '38b1408d-15a1-463d-aa61-63d960e3797a', 20, 26, 2, 'Cash', NULL, NULL, NULL, '2024-12-27 21:27:57', '2024-12-27 21:27:57'),
	(8, '079e1be8-d28c-479d-9357-5a757c66882b', 21, 26, 5, 'Cash', NULL, NULL, NULL, '2024-12-27 21:33:21', '2024-12-27 21:33:21');

-- Dumping structure for table dianarentcar.tt_reviews
CREATE TABLE IF NOT EXISTS `tt_reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(40) NOT NULL,
  `car_id` int NOT NULL,
  `user_id` int NOT NULL,
  `grade` int NOT NULL,
  `desciption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_tt_reviews_car_id` (`car_id`),
  KEY `fk_tt_reviews_user_id` (`user_id`),
  CONSTRAINT `fk_tt_reviews_car_id` FOREIGN KEY (`car_id`) REFERENCES `tm_cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tt_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.tt_reviews: ~0 rows (approximately)

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
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dianarentcar.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `phone_number`, `role`, `password`, `code`, `is_verified`, `created_at`, `updated_at`) VALUES
	(15, 'a72c4551-846e-42b8-a0d3-d1417d630050', 'Diki Nugraha', 'admin@admin.com', '082125008160', 'admin', '$2y$10$bBylPZFyCmZKih7jw2.0MepdXwlaYGoRNy.FqCHbYWRI7XrJiY0Xm', NULL, NULL, '2024-12-14 05:16:59', '2024-12-14 05:17:11'),
	(25, 'e621ddc1-1cdd-4d3f-9386-5df1ba707b47', 'Emul Mulyana', 'emul@drc.com', '082125008160', 'user', '$2y$10$2bopaKjk4yBergNDw7/R9OO0UqvNFSFnrBtpvNjVELPfKUovFU4ye', NULL, NULL, '2024-12-16 13:37:29', '2024-12-16 13:37:29'),
	(26, '217b7f23-7013-433e-9d04-a3692547b282', 'Muhammad Diki Dwi Nugraha', 'diki@aiia.co.id', '082125008160', 'user', '$2y$10$TWFdjW9b8GxDepiCe3viOeKRLWhs.yVtrN7LVhMuC/fv7b3sjeeHq', NULL, NULL, '2024-12-27 18:13:25', '2024-12-27 18:13:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
