<!DOCTYPE html>
<html lang="<?= esc(session()->get('lang') ?? 'id') ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar — ELStore GIS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary:       #2563EB;
      --primary-light: #60A5FA;
      --primary-dark:  #1D4ED8;
      --primary-glow:  rgba(37,99,235,0.4);
      --dark:          #0A0F1E;
      --surface:       #FFFFFF;
      --surface-2:     #F8FAFC;
      --border:        #E2E8F0;
      --text:          #0F172A;
      --text-2:        #475569;
      --text-3:        #94A3B8;
      --error:         #EF4444;
      --success:       #22C55E;
      --font-d: 'Outfit', sans-serif;
      --font-b: 'Space Grotesk', sans-serif;
      --ease:   cubic-bezier(0.4, 0, 0.2, 1);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    body {
      font-family: var(--font-b);
      display: flex;
      min-height: 100vh;
      background: var(--dark);
      overflow-x: hidden;
    }

    /* =========== LEFT PANEL (reversed — accent-right) =========== */
    .auth-left {
      flex: 1;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 48px;
      overflow: hidden;
    }

    .auth-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 70% 55% at 70% 35%, rgba(99,102,241,0.2) 0%, transparent 65%),
        radial-gradient(ellipse 50% 45% at 20% 70%, rgba(37,99,235,0.18) 0%, transparent 60%),
        var(--dark);
    }

    .dot-grid {
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
      background-size: 36px 36px;
    }

    /* Animated rings — top-left origin this time */
    .radar-wrap {
      position: absolute;
      top: -60px;
      left: -60px;
      width: 420px;
      height: 420px;
      pointer-events: none;
    }
    .radar-ring {
      position: absolute; inset: 0;
      border-radius: 50%;
      border: 1px solid rgba(96,165,250,0.15);
      animation: radar-pulse 4.5s ease-out infinite;
    }
    .radar-ring:nth-child(2) { animation-delay: 1.5s; }
    .radar-ring:nth-child(3) { animation-delay: 3s; }

    @keyframes radar-pulse {
      0%   { transform: scale(0.2); opacity: 0.7; }
      100% { transform: scale(1.0); opacity: 0; }
    }

    /* Map dots */
    .map-dot {
      position: absolute;
      width: 8px; height: 8px;
      background: var(--primary-light);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--primary-light);
      animation: dot-blink 3s ease-in-out infinite;
    }
    .map-dot::after {
      content: '';
      position: absolute;
      inset: -6px;
      border-radius: 50%;
      border: 1px solid rgba(96,165,250,0.35);
      animation: dot-ping 3s ease-in-out infinite;
    }
    .map-dot:nth-child(1) { top: 30%; left: 25%; animation-delay: 0s; }
    .map-dot:nth-child(2) { top: 60%; left: 55%; animation-delay: 1s; }
    .map-dot:nth-child(3) { top: 20%; left: 68%; animation-delay: 2s; }
    .map-dot:nth-child(4) { top: 75%; left: 35%; animation-delay: 0.7s; }

    @keyframes dot-blink {
      0%,100% { opacity:.5; transform:scale(1); }
      50%      { opacity:1;  transform:scale(1.3); }
    }
    @keyframes dot-ping {
      0%   { transform:scale(1); opacity:.6; }
      100% { transform:scale(3); opacity:0; }
    }

    /* Left text elements */
    .left-top, .left-mid, .left-bot { position: relative; z-index: 2; }

    .brand-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .brand-icon {
      width: 44px; height: 44px;
      background: var(--primary);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 20px var(--primary-glow);
    }
    .brand-icon i { color: #fff; font-size: 20px; }
    .brand-name {
      font-family: var(--font-d);
      font-size: 24px;
      font-weight: 900;
      color: #fff;
      letter-spacing: -0.5px;
    }
    .brand-name span { color: var(--primary-light); }

    .left-mid { padding-bottom: 40px; }

    .panel-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: var(--primary-light);
      background: rgba(96,165,250,0.1);
      border: 1px solid rgba(96,165,250,0.25);
      border-radius: 999px;
      padding: 6px 14px;
      margin-bottom: 28px;
    }

    .panel-title {
      font-family: var(--font-d);
      font-size: clamp(26px, 2.8vw, 42px);
      font-weight: 900;
      color: #fff;
      line-height: 1.15;
      letter-spacing: -1px;
      margin-bottom: 18px;
    }
    .panel-title .grad {
      background: linear-gradient(135deg, #60A5FA, #a78bfa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .panel-desc {
      font-size: 15px;
      color: rgba(255,255,255,0.5);
      line-height: 1.75;
      max-width: 360px;
    }

    /* Benefits list */
    .benefits {
      margin-top: 32px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .benefit-item {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .benefit-ico {
      width: 32px; height: 32px;
      background: rgba(37,99,235,0.2);
      border: 1px solid rgba(96,165,250,0.25);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .benefit-ico i { font-size: 13px; color: var(--primary-light); }

    .benefit-text {
      font-size: 14px;
      color: rgba(255,255,255,0.6);
    }

    .left-bot a {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: rgba(255,255,255,0.4);
      transition: color .2s;
    }
    .left-bot a:hover { color: rgba(255,255,255,0.8); }

    /* =========== RIGHT PANEL =========== */
    .auth-right {
      width: 580px;
      flex-shrink: 0;
      background: var(--surface);
      display: flex;
      flex-direction: column;
      padding: 48px 52px;
      position: relative;
      overflow-y: auto;
    }

    /* Language pill */
    .lang-pill-fixed {
      position: absolute;
      top: 24px;
      right: 28px;
      display: flex;
      background: var(--surface-2);
      border: 1px solid var(--border);
      border-radius: 999px;
      overflow: hidden;
    }
    .lang-pill-fixed button {
      font-family: var(--font-b);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.8px;
      color: var(--text-3);
      background: transparent;
      border: none;
      padding: 6px 13px;
      cursor: pointer;
      transition: all .2s;
    }
    .lang-pill-fixed button.lp-active {
      background: var(--primary);
      color: #fff;
    }
    .lang-pill-fixed .lp-sep {
      width: 1px;
      background: var(--border);
      align-self: stretch;
    }

    /* Progress bar (visual only) */
    .reg-progress {
      display: flex;
      align-items: center;
      gap: 0;
      margin-bottom: 32px;
    }

    .prog-step {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      font-weight: 600;
      color: var(--text-3);
      flex: 1;
    }

    .prog-step.active { color: var(--primary); }
    .prog-step.done   { color: var(--success); }

    .prog-circle {
      width: 26px; height: 26px;
      border-radius: 50%;
      border: 2px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 800;
      flex-shrink: 0;
      transition: all .3s;
    }

    .prog-step.active .prog-circle {
      border-color: var(--primary);
      background: var(--primary);
      color: #fff;
    }

    .prog-step.done .prog-circle {
      border-color: var(--success);
      background: var(--success);
      color: #fff;
    }

    .prog-line {
      flex: 1;
      height: 2px;
      background: var(--border);
      margin: 0 4px;
    }

    /* Form head */
    .form-head { margin-bottom: 28px; }
    .form-step {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--primary);
      margin-bottom: 8px;
    }
    .form-title {
      font-family: var(--font-d);
      font-size: 28px;
      font-weight: 900;
      color: var(--text);
      letter-spacing: -0.5px;
      margin-bottom: 6px;
    }
    .form-sub { font-size: 14px; color: var(--text-2); }

    /* Flash alert */
    .flash-alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 14px 16px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 20px;
      animation: flash-in .3s ease;
    }
    @keyframes flash-in {
      from { opacity:0; transform:translateY(-8px); }
      to   { opacity:1; transform:translateY(0); }
    }
    .flash-error   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .flash-success { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }

    /* Two-column grid for some fields */
    .form-grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    /* Form groups */
    .form-group { margin-bottom: 18px; position: relative; }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 7px;
    }

    .input-wrap { position: relative; display: flex; align-items: center; }

    .input-icon {
      position: absolute;
      left: 14px;
      color: var(--text-3);
      font-size: 14px;
      pointer-events: none;
      transition: color .2s;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group input[type="tel"],
    .form-group select {
      width: 100%;
      padding: 12px 42px 12px 42px;
      font-family: var(--font-b);
      font-size: 14px;
      color: var(--text);
      background: var(--surface-2);
      border: 1.5px solid var(--border);
      border-radius: 12px;
      outline: none;
      transition: all .25s var(--ease);
      -webkit-appearance: none;
    }

    .form-group select {
      padding-right: 36px;
      cursor: pointer;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394A3B8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 4px rgba(37,99,235,0.08);
    }

    .form-group input:focus ~ .input-icon,
    .input-wrap:focus-within .input-icon { color: var(--primary); }

    .form-group input.is-invalid,
    .form-group select.is-invalid {
      border-color: var(--error);
    }

    .field-error {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 12px;
      color: var(--error);
      margin-top: 5px;
    }

    /* Password strength bar */
    .pw-strength { margin-top: 8px; }
    .pw-strength-bar {
      height: 4px;
      border-radius: 4px;
      background: var(--border);
      overflow: hidden;
      margin-bottom: 5px;
    }
    .pw-strength-fill {
      height: 100%;
      width: 0%;
      border-radius: 4px;
      transition: width .3s, background .3s;
    }
    .pw-strength-text { font-size: 11px; color: var(--text-3); }

    /* Toggle pw */
    .toggle-pw {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: var(--text-3);
      font-size: 14px;
      cursor: pointer;
      padding: 4px;
      transition: color .2s;
    }
    .toggle-pw:hover { color: var(--primary); }

    /* Role cards */
    .role-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-bottom: 20px;
    }

    .role-card {
      position: relative;
      cursor: pointer;
    }

    .role-card input[type="radio"] {
      position: absolute;
      opacity: 0;
      width: 0; height: 0;
    }

    .role-label {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      padding: 16px 12px;
      background: var(--surface-2);
      border: 1.5px solid var(--border);
      border-radius: 14px;
      cursor: pointer;
      transition: all .2s;
      text-align: center;
    }

    .role-label i {
      font-size: 22px;
      color: var(--text-3);
      transition: color .2s;
    }

    .role-label .role-name {
      font-size: 13px;
      font-weight: 700;
      color: var(--text);
    }

    .role-label .role-desc {
      font-size: 11px;
      color: var(--text-3);
      line-height: 1.4;
    }

    .role-card input:checked + .role-label {
      border-color: var(--primary);
      background: rgba(37,99,235,0.05);
    }

    .role-card input:checked + .role-label i { color: var(--primary); }

    .role-check {
      position: absolute;
      top: 8px; right: 10px;
      width: 18px; height: 18px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity .2s;
    }

    .role-check i { font-size: 9px; color: #fff; }

    .role-card input:checked ~ .role-check { opacity: 1; }

    /* Terms checkbox */
    .check-label {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 13px;
      color: var(--text-2);
      cursor: pointer;
      line-height: 1.5;
      user-select: none;
      margin-bottom: 20px;
    }

    .check-label input[type="checkbox"] {
      appearance: none;
      width: 18px; height: 18px;
      border: 1.5px solid var(--border);
      border-radius: 5px;
      background: var(--surface-2);
      cursor: pointer;
      position: relative;
      flex-shrink: 0;
      margin-top: 1px;
      transition: all .2s;
    }

    .check-label input[type="checkbox"]:checked {
      background: var(--primary);
      border-color: var(--primary);
    }

    .check-label input[type="checkbox"]:checked::after {
      content: '';
      position: absolute;
      top: 2px; left: 5px;
      width: 5px; height: 9px;
      border: 2px solid #fff;
      border-top: 0;
      border-left: 0;
      transform: rotate(45deg);
    }

    .check-label a { color: var(--primary); font-weight: 600; }

    /* Submit button */
    .btn-submit {
      width: 100%;
      padding: 14px;
      background: var(--primary);
      color: #fff;
      font-family: var(--font-d);
      font-size: 15px;
      font-weight: 800;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all .25s var(--ease);
    }

    .btn-submit:hover {
      background: var(--primary-dark);
      box-shadow: 0 8px 28px var(--primary-glow);
      transform: translateY(-2px);
    }

    .btn-submit:active { transform: translateY(0); }

    /* Footer */
    .form-foot {
      text-align: center;
      font-size: 14px;
      color: var(--text-2);
      margin-top: 20px;
    }
    .form-foot a { font-weight: 700; color: var(--primary); text-decoration: none; }
    .form-foot a:hover { text-decoration: underline; }

    /* =========== RESPONSIVE =========== */
    @media (max-width: 960px) {
      .auth-left { display: none; }
      .auth-right { width: 100%; padding: 40px 28px; }
      .form-grid-2 { grid-template-columns: 1fr; }
    }
    @media (max-width: 480px) {
      .auth-right { padding: 32px 20px; }
      .role-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- ======== LEFT PANEL ======== -->
<div class="auth-left">
  <div class="dot-grid"></div>
  <div class="radar-wrap">
    <div class="radar-ring"></div>
    <div class="radar-ring"></div>
    <div class="radar-ring"></div>
  </div>
  <div class="map-dot"></div>
  <div class="map-dot"></div>
  <div class="map-dot"></div>
  <div class="map-dot"></div>

  <div class="left-top">
    <a href="<?= base_url('/') ?>" style="text-decoration:none;">
      <div class="brand-row">
        <div class="brand-icon"><i class="fas fa-map-location-dot"></i></div>
        <span class="brand-name">EL<span>Store</span></span>
      </div>
    </a>
  </div>

  <div class="left-mid">
    <div class="panel-eyebrow">
      <i class="fas fa-user-plus"></i>
      Buat Akun Baru
    </div>
    <h2 class="panel-title">
      Bergabung dengan<br>
      <span class="grad">ELStore GIS</span>
    </h2>
    <p class="panel-desc">
      Daftarkan diri Anda untuk mengelola data toko,
      memantau sebaran geografis, dan mengakses fitur lengkap platform GIS kami.
    </p>
    <div class="benefits">
      <div class="benefit-item">
        <div class="benefit-ico"><i class="fas fa-map-pin"></i></div>
        <span class="benefit-text">Kelola koordinat GPS toko Anda</span>
      </div>
      <div class="benefit-item">
        <div class="benefit-ico"><i class="fas fa-chart-bar"></i></div>
        <span class="benefit-text">Akses laporan dan statistik wilayah</span>
      </div>
      <div class="benefit-item">
        <div class="benefit-ico"><i class="fas fa-shield-halved"></i></div>
        <span class="benefit-text">Data aman & terenkripsi penuh</span>
      </div>
    </div>
  </div>

  <div class="left-bot">
    <a href="<?= base_url('/') ?>">
      <i class="fas fa-arrow-left"></i>
      Kembali ke Beranda
    </a>
  </div>
</div>


<!-- ======== RIGHT PANEL ======== -->
<div class="auth-right">



  <!-- Progress indicator -->
  <div class="reg-progress">
    <div class="prog-step active">
      <div class="prog-circle">1</div>
      <span>Akun</span>
    </div>
    <div class="prog-line"></div>
    <div class="prog-step">
      <div class="prog-circle">2</div>
      <span>Profil</span>
    </div>
    <div class="prog-line"></div>
    <div class="prog-step">
      <div class="prog-circle">3</div>
      <span>Selesai</span>
    </div>
  </div>

  <!-- Title -->
  <div class="form-head">
    <div class="form-step">LANGKAH <span id="stepNum">1</span> DARI 3</div>
    <h1 class="form-title" data-i18n="auth_register_title">Daftar Akun Baru</h1>
    <p class="form-sub">
      Sudah punya akun?
      <a href="<?= base_url('auth/login') ?>">Masuk di sini</a>
    </p>
  </div>

  <!-- Flash Messages -->
  <?php if (session()->getFlashdata('error')): ?>
    <div class="flash-alert flash-error">
      <i class="fas fa-circle-exclamation"></i>
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="flash-alert flash-success">
      <i class="fas fa-circle-check"></i>
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <!-- Register Form -->
  <?= form_open('auth/register-process', ['id' => 'registerForm']) ?>

    <!-- Nama + Username -->
    <div class="form-grid-2">
      <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <div class="input-wrap">
          <i class="fas fa-id-card input-icon"></i>
          <input type="text" id="nama_lengkap" name="nama_lengkap"
            placeholder="Nama Lengkap"
            value="<?= old('nama_lengkap') ?>"
            class="<?= session('errors.nama_lengkap') ? 'is-invalid' : '' ?>"
            autocomplete="name" required>
        </div>
        <?php if (session('errors.nama_lengkap')): ?>
          <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.nama_lengkap') ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrap">
          <i class="fas fa-at input-icon"></i>
          <input type="text" id="username" name="username"
            placeholder="username_unik"
            value="<?= old('username') ?>"
            class="<?= session('errors.username') ? 'is-invalid' : '' ?>"
            autocomplete="username" required>
        </div>
        <?php if (session('errors.username')): ?>
          <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.username') ?></div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Email -->
    <div class="form-group">
      <label for="email">Alamat Email</label>
      <div class="input-wrap">
        <i class="fas fa-envelope input-icon"></i>
        <input type="email" id="email" name="email"
          placeholder="email@domain.com"
          value="<?= old('email') ?>"
          class="<?= session('errors.email') ? 'is-invalid' : '' ?>"
          autocomplete="email" required>
      </div>
      <?php if (session('errors.email')): ?>
        <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.email') ?></div>
      <?php endif; ?>
    </div>

    <!-- No HP -->
    <div class="form-group">
      <label for="no_hp">Nomor HP (WhatsApp)</label>
      <div class="input-wrap">
        <i class="fas fa-phone input-icon"></i>
        <input type="tel" id="no_hp" name="no_hp"
          placeholder="08xxxxxxxxxx"
          value="<?= old('no_hp') ?>"
          class="<?= session('errors.no_hp') ? 'is-invalid' : '' ?>"
          autocomplete="tel">
      </div>
      <?php if (session('errors.no_hp')): ?>
        <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.no_hp') ?></div>
      <?php endif; ?>
    </div>

    <!-- Password + Konfirmasi -->
    <div class="form-grid-2">
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <div class="input-wrap">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="password" name="password"
            placeholder="Min. 8 karakter"
            class="<?= session('errors.password') ? 'is-invalid' : '' ?>"
            autocomplete="new-password"
            oninput="checkStrength(this.value)"
            required>
          <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
            <i class="fas fa-eye"></i>
          </button>
        </div>
        <div class="pw-strength">
          <div class="pw-strength-bar">
            <div class="pw-strength-fill" id="strengthFill"></div>
          </div>
          <span class="pw-strength-text" id="strengthText">Masukkan kata sandi</span>
        </div>
        <?php if (session('errors.password')): ?>
          <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.password') ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="konfirmasi_password">Konfirmasi Sandi</label>
        <div class="input-wrap">
          <i class="fas fa-lock-open input-icon"></i>
          <input type="password" id="konfirmasi_password" name="konfirmasi_password"
            placeholder="Ulangi kata sandi"
            class="<?= session('errors.konfirmasi_password') ? 'is-invalid' : '' ?>"
            autocomplete="new-password"
            oninput="checkMatch()"
            required>
          <button type="button" class="toggle-pw" onclick="togglePw('konfirmasi_password', this)" tabindex="-1">
            <i class="fas fa-eye"></i>
          </button>
        </div>
        <?php if (session('errors.konfirmasi_password')): ?>
          <div class="field-error"><i class="fas fa-triangle-exclamation"></i><?= session('errors.konfirmasi_password') ?></div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Role -->
    <div class="form-group">
      <label>Daftar Sebagai</label>
      <div class="role-grid">
        <label class="role-card">
          <input type="radio" name="role" value="pengguna" checked>
          <div class="role-label">
            <i class="fas fa-user"></i>
            <span class="role-name">Pengguna</span>
            <span class="role-desc">Cari & eksplorasi toko elektronik</span>
          </div>
          <div class="role-check"><i class="fas fa-check"></i></div>
        </label>
        <label class="role-card">
          <input type="radio" name="role" value="pemilik_toko">
          <div class="role-label">
            <i class="fas fa-store"></i>
            <span class="role-name">Pemilik Toko</span>
            <span class="role-desc">Daftarkan & kelola toko Anda</span>
          </div>
          <div class="role-check"><i class="fas fa-check"></i></div>
        </label>
      </div>
    </div>

    <!-- Terms -->
    <label class="check-label">
      <input type="checkbox" name="setuju_syarat" required>
      Saya menyetujui
      <a href="<?= base_url('syarat-ketentuan') ?>">Syarat & Ketentuan</a>
      serta <a href="<?= base_url('kebijakan-privasi') ?>">Kebijakan Privasi</a>
      ELStore GIS
    </label>

    <!-- Submit -->
    <button type="submit" class="btn-submit">
      <i class="fas fa-user-plus"></i>
      Buat Akun Sekarang
    </button>

  <?= form_close() ?>

  <!-- Footer -->
  <p class="form-foot">
    Sudah punya akun?
    <a href="<?= base_url('auth/login') ?>">Masuk di sini →</a>
  </p>

</div><!-- /.auth-right -->


<script>
  /* ---- Toggle password visibility ---- */
  function togglePw(id, btn) {
    const inp  = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (inp.type === 'password') {
      inp.type = 'text';
      icon.classList.replace('fa-eye','fa-eye-slash');
    } else {
      inp.type = 'password';
      icon.classList.replace('fa-eye-slash','fa-eye');
    }
  }

  /* ---- Password strength meter ---- */
  function checkStrength(val) {
    const fill = document.getElementById('strengthFill');
    const text = document.getElementById('strengthText');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const map = [
      { w:'0%',   bg:'#E2E8F0', t:'Masukkan kata sandi' },
      { w:'25%',  bg:'#EF4444', t:'Lemah' },
      { w:'50%',  bg:'#F59E0B', t:'Cukup' },
      { w:'75%',  bg:'#3B82F6', t:'Kuat' },
      { w:'100%', bg:'#22C55E', t:'Sangat Kuat ✓' },
    ];
    const s = val.length === 0 ? 0 : score;
    fill.style.width      = map[s].w;
    fill.style.background = map[s].bg;
    text.textContent      = map[s].t;
    text.style.color      = map[s].bg;
  }

  /* ---- Password match check ---- */
  function checkMatch() {
    const pw  = document.getElementById('password').value;
    const kpw = document.getElementById('konfirmasi_password');
    if (kpw.value && kpw.value !== pw) {
      kpw.classList.add('is-invalid');
    } else {
      kpw.classList.remove('is-invalid');
    }
  }
</script>
</body>
</html>