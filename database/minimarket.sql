-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table school_minimarket.admins: ~4 rows (approximately)
INSERT INTO `admins` (`id`, `name`, `created_at`, `update_at`) VALUES
	(1, 'Sumanto', '2025-11-18 06:49:46', '2025-11-18 06:49:46'),
	(2, 'Naits', '2025-11-18 06:49:46', '2025-11-18 06:49:46'),
	(3, 'Nurul', '2025-11-18 06:50:15', '2025-11-18 06:50:15'),
	(4, 'William', '2025-11-18 06:50:15', '2025-11-18 06:50:15');

-- Dumping data for table school_minimarket.cashiers: ~6 rows (approximately)
INSERT INTO `cashiers` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(55, 'Ambatukam', 0, '2025-11-28 11:27:31', '2025-11-28 11:48:38'),
	(56, 'Vincent', 1, '2025-11-28 11:37:08', '2025-11-28 11:37:08'),
	(57, 'Agus Ketapel', 1, '2025-11-28 11:37:18', '2025-11-28 11:37:18'),
	(58, 'Ryan Kopling', 1, '2025-11-28 11:37:25', '2025-11-28 11:37:25'),
	(59, 'Wicak Boyolali', 1, '2025-11-28 11:37:34', '2025-11-28 11:37:34'),
	(60, 'Mas Metro Jaya', 1, '2025-11-28 11:38:01', '2025-11-28 11:38:01');

-- Dumping data for table school_minimarket.categories: ~11 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Garden', '2025-08-19 14:36:05', '2025-11-13 07:52:05'),
	(2, 'Snacks', '2025-08-19 14:36:05', '2025-11-28 18:32:11'),
	(6, 'Electronics', '2025-08-19 14:36:05', '2025-08-19 14:36:05'),
	(7, 'Outdoor', '2025-08-19 14:36:05', '2025-08-19 14:36:05'),
	(8, 'Accessories', '2025-08-19 14:36:05', '2025-08-19 14:36:05'),
	(9, 'Home', '2025-08-19 14:36:05', '2025-08-19 14:36:05'),
	(11, 'Sembako', '2025-11-13 02:42:34', '2025-11-13 02:42:34'),
	(12, 'Kitchen', '2025-11-13 07:51:44', '2025-11-13 07:51:44'),
	(14, 'Instant Food', '2025-11-28 18:17:21', '2025-11-28 18:17:21'),
	(15, 'Coffee', '2025-11-28 18:31:59', '2025-11-28 18:31:59'),
	(16, 'Drinks', '2025-11-28 18:32:04', '2025-11-28 18:32:04');

-- Dumping data for table school_minimarket.customers: ~10 rows (approximately)
INSERT INTO `customers` (`id`, `name`, `contact`, `created_at`, `updated_at`) VALUES
	(1, 'rtipple0', '827-989-1833', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(2, 'uarderne1', '792-718-8552', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(3, 'ctimblett2', '695-349-7587', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(4, 'ckerrich3', '617-414-1381', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(5, 'cfarlamb4', '736-383-0264', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(6, 'rneagle5', '759-381-3268', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(7, 'jizen6', '807-656-3433', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(8, 'mtoffetto7', '357-222-2275', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(9, 'tmcmorran8', '756-261-3378', '2025-08-19 14:37:09', '2025-08-19 14:37:09'),
	(10, 'csympson9', '960-851-2316', '2025-08-19 14:37:09', '2025-08-19 14:37:09');

-- Dumping data for table school_minimarket.products: ~9 rows (approximately)
INSERT INTO `products` (`id`, `barcode`, `name`, `description`, `category_id`, `supplier_id`, `voucher_id`, `buy_price`, `sell_price`, `stock`, `created_at`, `updated_at`) VALUES
	(1, 'bb8f3105395f03f31', 'Indomie Mi Instan Goreng 84 g', 'Indomie mini beli 2 baru kenyang', 14, 9, 9, 2800.00, 3200.00, 200, '2025-11-29 04:52:56', '2025-11-29 04:52:56'),
	(2, 'ece6b422aab6de842', 'Indomie Mi Instan Goreng Aceh 90 g', 'Mie goreng aceh enak tapi jarang yang beli', 14, 9, NULL, 2800.00, 3200.00, 450, '2025-11-28 18:37:30', '2025-11-28 18:37:30'),
	(3, 'a607369a358dbd95f', 'Indomie Mi Instan Goreng Jumbo 129 g', 'Goreng jumbo rek, kenyang ni', 14, 9, NULL, 3800.00, 4200.00, 800, '2025-11-28 18:37:40', '2025-11-28 18:37:40'),
	(4, '7a142bc9a83f4ddc0', 'Indomilk Susu Steril Plain Kaleng 189 ml', 'Hmm, tak pernah nampak ni bende', 16, 14, NULL, 7000.00, 7900.00, 400, '2025-11-28 18:38:47', '2025-11-28 18:38:47'),
	(5, 'ead9079f0c54650c2', 'Indomilk Susu Cair Rasa Cokelat 190 ml', 'Nah... ini nih, kesukaan pas masih kecil', 16, 14, NULL, 3000.00, 5000.00, 440, '2025-11-29 04:51:49', '2025-11-29 04:51:49'),
	(6, '3b1bca28656b8d5cc', 'Indomilk Susu UHT Full Cream Kotak 950 ml', 'Woilah, ini gede bet njir', 16, 14, 1, 17800.00, 18900.00, 880, '2025-11-29 04:53:16', '2025-11-29 04:53:16'),
	(7, 'dd22ac6f06cb758f5', 'Kapal Api Signature Strong Kopi Hitam 200 ml', 'hmm, pernah lihat tapi tidak pernah ambil', 15, 8, NULL, 4000.00, 5000.00, 969, '2025-11-29 04:47:34', '2025-11-29 04:47:34'),
	(8, 'f0d3f69cf8189e830', 'Kapal Api Special Kopi Bubuk 250 g', 'Hmm... ini nih, kopi hitam yang siap menemani malam', 15, 8, NULL, 40000.00, 43000.00, 750, '2025-11-28 18:39:58', '2025-11-28 18:39:58'),
	(9, '62a245d4768002005', 'Pocky Biskuit Stik Matcha 33 g', 'Menarik... tapi dikit sekali', 2, 20, NULL, 9000.00, 9900.00, 0, '2025-11-28 18:34:05', '2025-11-28 18:34:05'),
	(10, '119680dac9ef0afe6', 'Kopi Kenangan Hanya Untukmu Caffe Latte 200 ml', 'Hmm... well, lumayan', 15, 22, NULL, 4500.00, 6500.00, 0, '2025-11-28 18:36:14', '2025-11-28 18:36:14');

-- Dumping data for table school_minimarket.purchases: ~2 rows (approximately)
INSERT INTO `purchases` (`id`, `code`, `supplier_id`, `admin_id`, `transaction_date`, `status`, `total`, `cash`, `cash_change`, `created_at`, `updated_at`) VALUES
	(1, 'PTRX0001', 9, 1, '2025-11-29 02:37:13', 'PAID', 5824000.00, 6000000.00, 176000.00, '2025-11-28 18:37:13', '2025-11-28 18:38:18'),
	(2, 'PTRX0002', 14, 4, '2025-11-29 02:38:40', 'PAID', 22170000.00, 25000000.00, 2830000.00, '2025-11-28 18:38:40', '2025-11-28 18:39:13'),
	(3, 'PTRX0003', 8, 2, '2025-11-29 02:39:36', 'PAID', 37245000.00, 50000000.00, 12755000.00, '2025-11-28 18:39:36', '2025-11-28 18:40:07');

-- Dumping data for table school_minimarket.purchase_items: ~8 rows (approximately)
INSERT INTO `purchase_items` (`purchase_id`, `product_id`, `quantity`, `price`, `discount`, `sub_total`, `created_at`, `updated_at`) VALUES
	(1, 1, 320, 3200.00, 0, 1024000.00, '2025-11-28 18:37:24', '2025-11-28 18:37:24'),
	(1, 2, 450, 3200.00, 0, 1440000.00, '2025-11-28 18:37:30', '2025-11-28 18:37:30'),
	(1, 3, 800, 4200.00, 0, 3360000.00, '2025-11-28 18:37:40', '2025-11-28 18:37:40'),
	(2, 4, 400, 7900.00, 0, 3160000.00, '2025-11-28 18:38:47', '2025-11-28 18:38:47'),
	(2, 5, 500, 4000.00, 0, 2000000.00, '2025-11-28 18:38:54', '2025-11-28 18:38:54'),
	(2, 6, 900, 18900.00, 0, 17010000.00, '2025-11-28 18:39:00', '2025-11-28 18:39:00'),
	(3, 7, 999, 5000.00, 0, 4995000.00, '2025-11-28 18:39:49', '2025-11-28 18:39:49'),
	(3, 8, 750, 43000.00, 0, 32250000.00, '2025-11-28 18:39:58', '2025-11-28 18:39:58');

-- Dumping data for table school_minimarket.sales: ~1 rows (approximately)
INSERT INTO `sales` (`id`, `code`, `customer_id`, `cashier_id`, `transaction_date`, `status`, `total`, `cash`, `cash_change`, `created_at`, `updated_at`) VALUES
	(10, 'STRX0001', 7, 56, '2025-11-29 12:43:23', 'PAID', 168800.00, 200000.00, 31200.00, '2025-11-29 04:43:23', '2025-11-29 04:49:27'),
	(11, 'STRX0002', 10, 59, '2025-11-29 12:52:48', 'PAID', 369000.00, 400000.00, 31000.00, '2025-11-29 04:52:48', '2025-11-29 04:53:37');

-- Dumping data for table school_minimarket.sale_items: ~4 rows (approximately)
INSERT INTO `sale_items` (`sale_id`, `product_id`, `quantity`, `price`, `discount`, `sub_total`, `created_at`, `updated_at`) VALUES
	(10, 1, 10, 3200.00, 10, 32000.00, '2025-11-29 04:47:05', '2025-11-29 04:47:05'),
	(10, 5, 10, 4000.00, 0, 40000.00, '2025-11-29 04:47:13', '2025-11-29 04:47:13'),
	(10, 7, 20, 5000.00, 0, 100000.00, '2025-11-29 04:47:24', '2025-11-29 04:47:34'),
	(11, 1, 10, 3200.00, 10, 32000.00, '2025-11-29 04:52:56', '2025-11-29 04:52:56'),
	(11, 6, 20, 18900.00, 10, 378000.00, '2025-11-29 04:53:03', '2025-11-29 04:53:16');

-- Dumping data for table school_minimarket.suppliers: ~8 rows (approximately)
INSERT INTO `suppliers` (`id`, `name`, `contact`, `address`, `status`, `created_at`, `updated_at`) VALUES
	(8, 'Kapal Api', '788-667-7254', '584 Lindbergh Terrace', 1, '2025-08-19 14:36:28', '2025-11-13 01:48:28'),
	(9, 'Indomie', '597-197-3661', '8990 Marcy Junction', 1, '2025-08-19 14:36:28', '2025-11-13 01:48:05'),
	(14, 'Indomilk', '564-098-1761', 'Jl. Merak Merpati', 1, '2025-11-13 01:50:31', '2025-11-13 01:50:31'),
	(16, 'Sosro', '125-423-1542', 'PT. Sinar Sosro', 1, '2025-11-28 18:05:10', '2025-11-28 18:05:10'),
	(17, 'ABC', '857-019-1756', 'PT. ABCD', 1, '2025-11-28 18:07:18', '2025-11-28 18:07:18'),
	(18, 'Mayora Indah', '142-098-7564', 'PT. Mayora Indah', 1, '2025-11-28 18:08:38', '2025-11-28 18:08:38'),
	(19, 'Frisian Flag', '876-018-5324', 'Jl. Merdeka No. 14', 1, '2025-11-28 18:10:18', '2025-11-28 18:10:18'),
	(20, 'Pocky', '987-098-1235', 'Jl. Subroto No. 09', 1, '2025-11-28 18:10:57', '2025-11-28 18:10:57'),
	(21, 'Chitato', '584-019-8401', 'Jl. Monochrome No. 56', 1, '2025-11-28 18:11:33', '2025-11-28 18:11:33'),
	(22, 'Kopi Kenangan', '7859-176-857', 'Jl. Kenangan Masa Lalu No. 12', 1, '2025-11-28 18:12:56', '2025-11-28 18:12:56');

-- Dumping data for table school_minimarket.vouchers: ~4 rows (approximately)
INSERT INTO `vouchers` (`id`, `code`, `name`, `max_discount`, `expired_date`, `discount`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'VCR001', 'Voucher Indomilk', 1500.00, '2025-11-19', 10, 'ACTIVE', '2025-11-14 14:01:02', '2025-11-14 14:04:44'),
	(2, 'VCR002', 'Voucher China Xiaomi', 10000.00, '2025-11-22', 5, 'ACTIVE', '2025-11-15 05:48:47', '2025-11-15 05:48:47'),
	(4, 'VCR004', 'Voucher Natal 2024 Asus', 50000.00, '2024-12-30', 25, 'EXPIRED', '2025-11-15 06:14:07', '2025-11-15 06:14:07'),
	(7, 'VCR006', 'Voucer Apalah ASW', 2000.00, '2025-11-05', 100, 'ACTIVE', '2025-11-15 14:05:25', '2025-11-15 14:09:55'),
	(9, 'VCR007', 'Voucher Indomie Original', 2000.00, '2025-12-06', 10, 'ACTIVE', '2025-11-28 19:03:57', '2025-11-28 19:03:57');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
