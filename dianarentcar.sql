-- --------------------------------------------------------
-- Host:                         103.176.79.109
-- Server version:               8.0.40 - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table drc.cars
CREATE TABLE IF NOT EXISTS `cars` (
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
  `harga` decimal(15,2) NOT NULL,
  `denda` decimal(15,2) NOT NULL,
  `transmisi` varchar(50) NOT NULL,
  `photo` text,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table drc.cars: ~1 rows (approximately)
INSERT INTO `cars` (`id`, `uuid`, `merk`, `tipe`, `jumlah_kursi`, `jumlah_pintu`, `warna`, `no_plat`, `tahun`, `km`, `jenis_bensin`, `harga`, `denda`, `transmisi`, `photo`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '123123-adasda', 'Toyota', 'Avanza', 6, 4, 'Hitam', 'T 1234 AA', '2024', 12312, 'Pertamax', 12000.00, 2000.00, 'Manual', '6769bcf58a9ef-avanza.png', 14, 14, '2024-12-25 12:57:31', '2024-12-25 00:57:52');

-- Dumping structure for table drc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` enum('admin','driver','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table drc.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `phone_number`, `password`, `created_at`, `updated_at`, `role`) VALUES
	(14, '7bfbd118-445a-4ada-a51e-7dac56ed5236', 'Administrator', 'admin@drc.com', '082125008160', '$2y$10$ADOZVnkndWGNmAw32BRc.e42A7LvYTQ2DHiZkUn5BqS/6w3qUtE9K', '2024-12-19 13:20:12', '2024-12-19 13:20:44', 'admin'),
	(15, 'c044d9be-03ce-498d-b9fe-a45507834806', 'Huda Akbar Nugraha', 'hudaakbarnugraha@drc.com', '0808080808123', '$2y$10$N/aa1bEdpZHNJkAOWcRcX.1H6xo6q.BVROVwNqR31miJ9mWk5GogC', '2024-12-23 10:10:33', '2024-12-23 10:10:33', 'user'),
	(16, 'adc5cde9-6c87-4993-aa03-6d6d4e7d9d64', 'Muhammad Diki Dwi Nugraha', 'diki@aiia.co.id', '082125008160', '$2y$10$DyJ6ck3k0WPl8bAzytO56uehC3AkVxL.QPQf9rqfbraT6/liGLCEa', '2024-12-23 23:00:57', '2024-12-23 23:00:57', 'user'),
	(17, 'a0ad3f96-bcda-445f-926d-da2de0d866eb', 'Emul Mulyana', 'emul@drc.com', '082125008160', '$2y$10$U59QfjseKrzdrJeJLXOqpeoWkSQyBfRWJg09NXLm4V2L.DCSdmONK', '2024-12-25 05:49:11', '2024-12-25 05:49:11', 'driver');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
