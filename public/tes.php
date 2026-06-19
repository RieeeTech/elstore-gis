<?php
// ============================================================
// FILE TES KONEKSI DATABASE - ELStore GIS
// Upload ke: htdocs/tes.php
// Akses via browser: http://gis-elstore.free.je/tes.php
// HAPUS file ini setelah selesai testing!
// ============================================================

$host = 'sql307.infinityfree.com';
$db   = 'if0_42184961_elstore_gis';
$user = 'if0_42184961';
$pass = 'ILJxudZk9t2Apd';
$port = 3306;

echo '<h2>🔍 Tes Koneksi Database ELStore GIS</h2>';
echo '<hr>';

// Test 1: Koneksi ke MySQL
echo '<h3>Test 1: Koneksi ke Server MySQL</h3>';
$conn = @mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    echo '<p style="color:red;">❌ GAGAL KONEK! Error: ' . mysqli_connect_error() . '</p>';
    echo '<p>Error Number: ' . mysqli_connect_errno() . '</p>';
} else {
    echo '<p style="color:green;">✅ BERHASIL KONEK ke database!</p>';

    // Test 2: Cek tabel users
    echo '<h3>Test 2: Cek Tabel Users</h3>';
    $result = mysqli_query($conn, "SELECT id, username, email, role, status FROM users LIMIT 5");
    if ($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($rows) > 0) {
            echo '<p style="color:green;">✅ Tabel users ditemukan! Jumlah data: ' . count($rows) . '</p>';
            echo '<table border="1" cellpadding="5">';
            echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th></tr>';
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['role'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p style="color:orange;">⚠️ Tabel users ADA tapi KOSONG! Silakan import ulang database_setup.sql</p>';
        }
    } else {
        echo '<p style="color:red;">❌ Tabel users TIDAK ADA! Error: ' . mysqli_error($conn) . '</p>';
    }

    // Test 3: Cek tabel toko
    echo '<h3>Test 3: Cek Tabel Toko Elektronik</h3>';
    $result2 = mysqli_query($conn, "SELECT COUNT(*) as total FROM toko_elektronik WHERE status='aktif'");
    if ($result2) {
        $row2 = mysqli_fetch_assoc($result2);
        echo '<p style="color:green;">✅ Tabel toko_elektronik ada. Jumlah toko aktif: <strong>' . $row2['total'] . '</strong></p>';
        if ($row2['total'] == 0) {
            echo '<p style="color:orange;">⚠️ Tidak ada data toko! Silakan import ulang database_setup.sql</p>';
        }
    } else {
        echo '<p style="color:red;">❌ Tabel toko_elektronik TIDAK ADA! Error: ' . mysqli_error($conn) . '</p>';
    }

    // Test 4: Cek versi PHP
    echo '<h3>Test 4: Versi PHP Server</h3>';
    echo '<p>PHP Version: <strong>' . phpversion() . '</strong></p>';
    if (version_compare(PHP_VERSION, '8.1.0', '>=')) {
        echo '<p style="color:green;">✅ Versi PHP sudah memenuhi syarat CI4 (minimal 8.1)</p>';
    } else {
        echo '<p style="color:red;">❌ Versi PHP terlalu lama! CI4 butuh minimal PHP 8.1. Silakan ubah di cPanel.</p>';
    }

    mysqli_close($conn);
}

echo '<hr>';
echo '<p style="color:red;"><strong>⚠️ PENTING: Hapus file tes.php ini setelah selesai!</strong></p>';
