<?php
// ============================================================
// DEBUG LOGIN - ELStore GIS
// Upload ke: htdocs/debug_login.php
// HAPUS setelah selesai!
// ============================================================
session_start();

$host = 'sql307.infinityfree.com';
$db   = 'if0_42184961_elstore_gis';
$user = 'if0_42184961';
$pass = 'ILJxudZk9t2Apd';
$port = 3306;

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginId  = $_POST['login_id'] ?? '';
    $password = $_POST['password'] ?? '';

    $conn = mysqli_connect($host, $user, $pass, $db, $port);

    if (!$conn) {
        $msg = '<p style="color:red;">❌ Gagal konek DB: ' . mysqli_connect_error() . '</p>';
    } else {
        $loginId = mysqli_real_escape_string($conn, $loginId);
        $sql = "SELECT * FROM users WHERE (email='$loginId' OR username='$loginId') AND status='aktif' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $dbUser = mysqli_fetch_assoc($result);

        if (!$dbUser) {
            $msg = '<p style="color:red;">❌ User tidak ditemukan di database! Periksa username/email.</p>';
        } elseif (!password_verify($password, $dbUser['password'])) {
            $msg = '<p style="color:red;">❌ Password SALAH! Hash di DB: <code>' . substr($dbUser['password'],0,20) . '...</code></p>';
            $msg .= '<p>Coba password: <strong>password</strong></p>';
        } else {
            $_SESSION['test_login'] = true;
            $_SESSION['test_user']  = $dbUser['username'];
            $_SESSION['test_role']  = $dbUser['role'];
            $msg = '<p style="color:green;">✅ LOGIN BERHASIL! Username: <strong>' . $dbUser['username'] . '</strong> | Role: <strong>' . $dbUser['role'] . '</strong></p>';
            $msg .= '<p style="color:green;">✅ Session PHP juga BERHASIL disimpan! (Session ID: ' . session_id() . ')</p>';
            $msg .= '<p><strong>Artinya: Masalah ada di konfigurasi Session CodeIgniter 4, bukan di database.</strong></p>';
        }
        mysqli_close($conn);
    }
}

// Cek apakah session PHP native bekerja
$sessionWorks = isset($_SESSION['test_login']) ? '✅ Session aktif: User=' . ($_SESSION['test_user']??'-') : '⚠️ Belum ada session login';
?>
<!DOCTYPE html>
<html>
<head><title>Debug Login ELStore</title></head>
<body style="font-family:Arial;max-width:600px;margin:40px auto;padding:20px;">
<h2>🔧 Debug Login ELStore GIS</h2>
<hr>

<h3>Status Session PHP Saat Ini:</h3>
<p><?= $sessionWorks ?></p>

<hr>
<?= $msg ?>

<h3>Form Test Login:</h3>
<form method="POST">
    <p>
        <label>Username / Email:</label><br>
        <input type="text" name="login_id" value="admin" style="width:100%;padding:8px;">
    </p>
    <p>
        <label>Password:</label><br>
        <input type="text" name="password" value="password" style="width:100%;padding:8px;">
        <small>(Coba: <b>password</b>)</small>
    </p>
    <button type="submit" style="padding:10px 20px;background:blue;color:white;border:none;cursor:pointer;">
        Test Login
    </button>
</form>

<hr>
<p style="color:red;"><strong>⚠️ HAPUS file debug_login.php setelah selesai!</strong></p>
</body>
</html>
