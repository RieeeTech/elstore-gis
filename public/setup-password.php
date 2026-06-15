<?php
/**
 * ELStore GIS — Password Seeder Helper
 * File ini digunakan untuk generate hash password yang benar
 * untuk dimasukkan ke database via phpMyAdmin.
 *
 * Akses: http://localhost/elstore-gis/public/setup-password.php
 * (Hapus file ini setelah selesai setup!)
 *
 * PERINGATAN: Hapus file ini setelah selesai!
 */

// Hanya bisa diakses dari localhost
if (!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    http_response_code(403);
    die('Forbidden');
}

$passwords = [
    'Admin@12345' => password_hash('Admin@12345', PASSWORD_BCRYPT),
    'Test@12345'  => password_hash('Test@12345',  PASSWORD_BCRYPT),
];

?><!DOCTYPE html>
<html>
<head>
  <title>ELStore GIS — Setup Password</title>
  <style>
    body { font-family: monospace; background: #0F172A; color: #94A3B8; padding: 40px; }
    h1 { color: #60A5FA; font-size: 20px; }
    .card { background: #1E293B; border-radius: 10px; padding: 24px; margin: 20px 0; }
    .label { color: #F8FAFC; font-weight: bold; margin-bottom: 8px; }
    .hash { color: #4ADE80; word-break: break-all; margin-bottom: 16px; font-size: 13px; }
    .sql { background: #0F172A; border: 1px solid #334155; border-radius: 8px; padding: 16px; margin: 16px 0; font-size: 13px; color: #F59E0B; overflow-x: auto; }
    .warning { background: #7F1D1D; color: #FCA5A5; padding: 16px; border-radius: 8px; font-weight: bold; }
  </style>
</head>
<body>
  <h1>🔐 ELStore GIS — Password Hash Generator</h1>
  <div class="warning">⚠️ PERINGATAN: Hapus file ini setelah setup selesai!</div>

  <?php foreach ($passwords as $plain => $hash): ?>
  <div class="card">
    <div class="label">Password: <?php echo htmlspecialchars($plain); ?></div>
    <div class="hash"><?php echo htmlspecialchars($hash); ?></div>
  </div>
  <?php endforeach; ?>

  <div class="card">
    <div class="label">📋 SQL untuk phpMyAdmin — Jalankan di tab "SQL":</div>
    <div class="sql">
UPDATE `users` SET `password` = '<?php echo htmlspecialchars($passwords['Admin@12345']); ?>' WHERE `username` = 'admin';<br><br>
UPDATE `users` SET `password` = '<?php echo htmlspecialchars($passwords['Test@12345']); ?>' WHERE `username` IN ('pemilik1', 'user1');
    </div>
    <div style="margin-top:16px;color:#94A3B8;font-size:12px;">
      Atau gunakan perintah Spark setelah MySQL aktif:<br>
      <span style="color:#60A5FA;">php spark migrate --all</span>
    </div>
  </div>

  <div style="margin-top:20px;color:#64748B;font-size:12px;">
    Akun Default setelah import database_setup.sql:<br>
    • admin / Admin@12345 (role: admin)<br>
    • pemilik1 / Test@12345 (role: pemilik_toko)<br>
    • user1 / Test@12345 (role: pengguna)
  </div>
</body>
</html>
