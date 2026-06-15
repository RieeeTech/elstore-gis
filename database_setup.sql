-- ============================================================
-- ELStore GIS — Database Setup SQL
-- Jalankan file ini di phpMyAdmin atau MySQL CLI
-- ============================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS elstore_gis
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE elstore_gis;

-- ============================================================
-- Tabel: users
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id`             INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_lengkap`   VARCHAR(100) NOT NULL,
  `username`       VARCHAR(50) NOT NULL,
  `email`          VARCHAR(150) NOT NULL,
  `no_hp`          VARCHAR(15) DEFAULT NULL,
  `password`       VARCHAR(255) NOT NULL,
  `role`           ENUM('admin','pemilik_toko','pengguna') NOT NULL DEFAULT 'pengguna',
  `status`         ENUM('aktif','pending','nonaktif') NOT NULL DEFAULT 'aktif',
  `foto_profil`    VARCHAR(255) DEFAULT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `last_login`     DATETIME DEFAULT NULL,
  `created_at`     DATETIME DEFAULT NULL,
  `updated_at`     DATETIME DEFAULT NULL,
  `deleted_at`     DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: toko_elektronik
-- ============================================================
CREATE TABLE IF NOT EXISTS `toko_elektronik` (
  `id`            INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`       INT(11) UNSIGNED DEFAULT NULL COMMENT 'Pemilik toko (FK users.id)',
  `nama_toko`     VARCHAR(150) NOT NULL,
  `slug`          VARCHAR(200) DEFAULT NULL,
  `kategori`      ENUM(
    'Smartphone','Komputer & Laptop','Audio & Video',
    'Peralatan Listrik','Elektronik Umum','Apple Authorized',
    'Gaming','Kamera & Optik','Lainnya'
  ) NOT NULL DEFAULT 'Elektronik Umum',
  `alamat`        TEXT NOT NULL,
  `kecamatan`     VARCHAR(100) DEFAULT NULL,
  `kota`          VARCHAR(100) NOT NULL DEFAULT 'Kisaran',
  `provinsi`      VARCHAR(100) NOT NULL DEFAULT 'Sumatera Utara',
  `latitude`      DECIMAL(11,8) NOT NULL,
  `longitude`     DECIMAL(11,8) NOT NULL,
  `no_telepon`    VARCHAR(20) DEFAULT NULL,
  `email_toko`    VARCHAR(150) DEFAULT NULL,
  `website`       VARCHAR(255) DEFAULT NULL,
  `jam_buka`      VARCHAR(50) DEFAULT NULL COMMENT 'Contoh: 08:00-21:00',
  `deskripsi`     TEXT DEFAULT NULL,
  `foto`          VARCHAR(255) DEFAULT NULL,
  `rating`        DECIMAL(3,1) NOT NULL DEFAULT '0.0',
  `total_ulasan`  INT(11) NOT NULL DEFAULT 0,
  `status`        ENUM('aktif','nonaktif','pending') NOT NULL DEFAULT 'aktif',
  `created_at`    DATETIME DEFAULT NULL,
  `updated_at`    DATETIME DEFAULT NULL,
  `deleted_at`    DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `kategori` (`kategori`),
  KEY `status` (`status`),
  KEY `koordinat` (`latitude`, `longitude`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: migrations (wajib untuk CodeIgniter 4)
-- ============================================================
CREATE TABLE IF NOT EXISTS `migrations` (
  `id`        BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version`   VARCHAR(255) NOT NULL,
  `class`     TEXT NOT NULL,
  `group`     VARCHAR(255) NOT NULL,
  `namespace` VARCHAR(255) NOT NULL,
  `time`      INT(11) NOT NULL,
  `batch`     INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SEED: Akun Admin Default
-- Password: Admin@12345
-- ============================================================
INSERT INTO `users` (`nama_lengkap`, `username`, `email`, `password`, `role`, `status`, `created_at`) VALUES
('Administrator', 'admin', 'admin@elstore-gis.id',
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
 'admin', 'aktif', NOW());

-- CATATAN: Password di atas adalah hash dari "password" untuk demo.
-- Untuk Admin@12345, jalankan: php spark db:seed UserSeeder
-- Atau update manual: UPDATE users SET password = '...' WHERE username = 'admin';

-- ============================================================
-- SEED: Data Toko Elektronik Sample
-- ============================================================
INSERT INTO `toko_elektronik`
  (`nama_toko`,`kategori`,`alamat`,`kecamatan`,`kota`,`provinsi`,`latitude`,`longitude`,`no_telepon`,`jam_buka`,`deskripsi`,`rating`,`total_ulasan`,`status`,`created_at`)
VALUES
  ('Samsung Store Kisaran','Smartphone','Jl. Ahmad Yani No.10, Kisaran Barat','Kisaran Barat','Kisaran','Sumatera Utara',2.98400000,99.61800000,'0623-12345','08:00-21:00','Toko resmi Samsung menyediakan smartphone, tablet, dan aksesori Samsung.',4.5,32,'aktif',NOW()),
  ('Elektronik Sinar Jaya','Elektronik Umum','Jl. Sudirman No.22, Kisaran Timur','Kisaran Timur','Kisaran','Sumatera Utara',2.98050000,99.61450000,'0623-11111','09:00-20:00','Pusat elektronik terlengkap dengan berbagai merek dan produk.',4.2,18,'aktif',NOW()),
  ('iBox Asahan','Apple Authorized','Jl. Imam Bonjol No.5, Kisaran','Kisaran Barat','Kisaran','Sumatera Utara',2.98700000,99.62000000,'0623-22222','10:00-21:00','Reseller resmi Apple di Asahan. iPhone, iPad, MacBook tersedia.',4.8,55,'aktif',NOW()),
  ('Toko Listrik Maju','Peralatan Listrik','Jl. Cut Nyak Dien No.3','Kisaran Barat','Kisaran','Sumatera Utara',2.97900000,99.61100000,'0623-33333','07:30-18:00','Menyediakan berbagai peralatan listrik dan instalasi rumah tangga.',3.9,12,'aktif',NOW()),
  ('PC World Kisaran','Komputer & Laptop','Jl. Diponegoro No.14','Kisaran Timur','Kisaran','Sumatera Utara',2.98250000,99.62300000,'0623-44444','08:00-20:00','Spesialis komputer, laptop, dan aksesoris IT terlengkap.',4.3,27,'aktif',NOW()),
  ('Audio Vision','Audio & Video','Jl. Veteran No.7','Kisaran Barat','Kisaran','Sumatera Utara',2.98600000,99.61550000,'0623-55555','09:00-21:00','Audio system, home theater, speaker, dan aksesoris audio berkualitas.',4.0,9,'aktif',NOW()),
  ('Gaming Zone Asahan','Gaming','Jl. Pahlawan No.3','Kisaran Timur','Kisaran','Sumatera Utara',2.98300000,99.61900000,'0623-66666','10:00-22:00','Console gaming, PC gaming, aksesori, dan rental game terlengkap.',4.6,41,'aktif',NOW());

-- ============================================================
-- Seed akun demo untuk testing
-- Password semua: Test@12345
-- ============================================================
-- Hash untuk Test@12345 (gunakan php spark seeder atau ganti manual)
INSERT INTO `users` (`nama_lengkap`, `username`, `email`, `no_hp`, `password`, `role`, `status`, `created_at`) VALUES
('Budi Santoso',  'pemilik1', 'pemilik@elstore.id',  '081234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pemilik_toko', 'aktif', NOW()),
('Andi Wijaya',   'user1',    'user@elstore.id',     '082345678901', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pengguna',     'aktif', NOW());

-- Update password yang benar (jalankan via phpMyAdmin QUERY atau PHP):
-- UPDATE users SET password = '$2y$10$...' WHERE username IN ('admin','pemilik1','user1');
