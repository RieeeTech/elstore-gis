<!DOCTYPE html>
<html lang="<?= esc(session()->get('lang') ?? 'id') ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — ELStore GIS</title>
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
      --dark-2:        #111827;
      --dark-3:        #1e2d4a;
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

    /* ===================== LEFT PANEL ===================== */
    .auth-left {
      flex: 1;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 48px;
      overflow: hidden;
      min-height: 100vh;
    }

    /* Grid dot background */
    .auth-left::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 80% 60% at 30% 40%, rgba(37,99,235,0.25) 0%, transparent 70%),
        radial-gradient(ellipse 50% 40% at 70% 70%, rgba(99,102,241,0.15) 0%, transparent 60%),
        var(--dark);
    }

    .dot-grid {
      position: absolute;
      inset: 0;
      background-image:
        radial-gradient(circle, rgba(255,255,255,0.07) 1px, transparent 1px);
      background-size: 36px 36px;
    }

    /* Radar / sonar rings — signature element */
    .radar-wrap {
      position: absolute;
      bottom: -80px;
      right: -80px;
      width: 480px;
      height: 480px;
      pointer-events: none;
    }

    .radar-ring {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      border: 1px solid rgba(96,165,250,0.18);
      animation: radar-pulse 4s ease-out infinite;
    }
    .radar-ring:nth-child(2) { animation-delay: 1.2s; }
    .radar-ring:nth-child(3) { animation-delay: 2.4s; }

    @keyframes radar-pulse {
      0%   { transform: scale(0.2); opacity: 0.7; }
      100% { transform: scale(1.0); opacity: 0; }
    }

    /* Floating marker dots */
    .map-dot {
      position: absolute;
      width: 8px; height: 8px;
      background: var(--primary-light);
      border-radius: 50%;
      box-shadow: 0 0 12px var(--primary-light);
      animation: dot-blink 3s ease-in-out infinite;
    }
    .map-dot::after {
      content: '';
      position: absolute;
      inset: -6px;
      border-radius: 50%;
      border: 1px solid rgba(96,165,250,0.4);
      animation: dot-ping 3s ease-in-out infinite;
    }
    .map-dot:nth-child(1) { top: 22%; left: 18%; animation-delay: 0s; }
    .map-dot:nth-child(2) { top: 55%; left: 60%; animation-delay: 1s; }
    .map-dot:nth-child(3) { top: 35%; left: 72%; animation-delay: 2s; }
    .map-dot:nth-child(4) { top: 68%; left: 28%; animation-delay: 1.5s; }

    @keyframes dot-blink {
      0%, 100% { opacity: 0.5; transform: scale(1); }
      50%       { opacity: 1;   transform: scale(1.3); }
    }
    @keyframes dot-ping {
      0%   { transform: scale(1); opacity: 0.6; }
      100% { transform: scale(3); opacity: 0; }
    }

    /* Left content */
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

    /* Center text */
    .left-mid { padding: 0 0 40px; }

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
      font-size: clamp(28px, 3.2vw, 44px);
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
      color: rgba(255,255,255,0.55);
      line-height: 1.75;
      max-width: 360px;
    }

    /* Stats row */
    .panel-stats {
      display: flex;
      gap: 32px;
      margin-top: 40px;
      padding-top: 32px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }

    .ps-item .ps-val {
      font-family: var(--font-d);
      font-size: 26px;
      font-weight: 900;
      color: #fff;
    }

    .ps-item .ps-lbl {
      font-size: 12px;
      color: rgba(255,255,255,0.45);
      margin-top: 3px;
    }

    /* Bottom back link */
    .left-bot a {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
      color: rgba(255,255,255,0.45);
      transition: color .2s;
    }
    .left-bot a:hover { color: rgba(255,255,255,0.85); }

    /* ===================== RIGHT PANEL ===================== */
    .auth-right {
      width: 520px;
      flex-shrink: 0;
      background: var(--surface);
      display: flex;
      flex-direction: column;
      padding: 56px 52px;
      position: relative;
      overflow-y: auto;
    }

    /* Top-right lang pill */
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

    /* Form head */
    .form-head { margin-bottom: 36px; }

    .form-step {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--primary);
      margin-bottom: 10px;
    }

    .form-title {
      font-family: var(--font-d);
      font-size: 30px;
      font-weight: 900;
      color: var(--text);
      letter-spacing: -0.5px;
      margin-bottom: 8px;
    }

    .form-sub {
      font-size: 15px;
      color: var(--text-2);
    }

    /* Flash alert */
    .flash-alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 14px 16px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 24px;
      animation: flash-in .3s ease;
    }
    @keyframes flash-in {
      from { opacity:0; transform: translateY(-8px); }
      to   { opacity:1; transform: translateY(0); }
    }
    .flash-error   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .flash-success { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }

    /* Form groups */
    .form-group { margin-bottom: 20px; position: relative; }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 8px;
      letter-spacing: 0.2px;
    }

    .input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      color: var(--text-3);
      font-size: 15px;
      pointer-events: none;
      transition: color .2s;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 13px 44px 13px 42px;
      font-family: var(--font-b);
      font-size: 15px;
      color: var(--text);
      background: var(--surface-2);
      border: 1.5px solid var(--border);
      border-radius: 12px;
      outline: none;
      transition: all .25s var(--ease);
      -webkit-appearance: none;
    }

    .form-group input:focus {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 0 0 4px rgba(37,99,235,0.10);
    }

    .form-group input:focus + .input-icon,
    .input-wrap:focus-within .input-icon {
      color: var(--primary);
    }

    .form-group input.is-invalid {
      border-color: var(--error);
      background: #fff;
    }

    .form-group input.is-invalid:focus {
      box-shadow: 0 0 0 4px rgba(239,68,68,0.10);
    }

    .field-error {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 12px;
      color: var(--error);
      margin-top: 6px;
    }

    /* Toggle password */
    .toggle-pw {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: var(--text-3);
      font-size: 15px;
      cursor: pointer;
      padding: 4px;
      transition: color .2s;
    }
    .toggle-pw:hover { color: var(--primary); }

    /* Remember + Forgot row */
    .form-row-aux {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px;
    }

    .check-label {
      display: flex;
      align-items: center;
      gap: 9px;
      font-size: 14px;
      color: var(--text-2);
      cursor: pointer;
      user-select: none;
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

    .forgot-link {
      font-size: 14px;
      font-weight: 600;
      color: var(--primary);
      text-decoration: none;
      transition: color .2s;
    }
    .forgot-link:hover { color: var(--primary-dark); }

    /* Submit button */
    .btn-submit {
      width: 100%;
      padding: 15px;
      background: var(--primary);
      color: #fff;
      font-family: var(--font-d);
      font-size: 16px;
      font-weight: 800;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all .25s var(--ease);
      letter-spacing: 0.2px;
    }

    .btn-submit:hover {
      background: var(--primary-dark);
      box-shadow: 0 8px 28px var(--primary-glow);
      transform: translateY(-2px);
    }

    .btn-submit:active { transform: translateY(0); }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 14px;
      margin: 28px 0;
      color: var(--text-3);
      font-size: 13px;
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* Social login row */
    .social-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-bottom: 28px;
    }

    .btn-social {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 9px;
      padding: 12px;
      background: var(--surface-2);
      border: 1.5px solid var(--border);
      border-radius: 12px;
      font-family: var(--font-b);
      font-size: 14px;
      font-weight: 600;
      color: var(--text);
      cursor: pointer;
      transition: all .2s;
      text-decoration: none;
    }

    .btn-social:hover {
      background: #fff;
      border-color: var(--primary-light);
      color: var(--primary);
      box-shadow: 0 2px 12px rgba(37,99,235,0.08);
    }

    /* Footer text */
    .form-foot {
      text-align: center;
      font-size: 14px;
      color: var(--text-2);
    }

    .form-foot a {
      font-weight: 700;
      color: var(--primary);
      text-decoration: none;
    }
    .form-foot a:hover { text-decoration: underline; }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 900px) {
      .auth-left { display: none; }
      .auth-right {
        width: 100%;
        padding: 40px 28px;
      }
    }

    @media (max-width: 480px) {
      .auth-right { padding: 32px 20px; }
      .social-row { grid-template-columns: 1fr; }
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

  <!-- Brand -->
  <div class="left-top">
    <div class="brand-row">
      <div class="brand-icon"><i class="fas fa-map-location-dot"></i></div>
      <span class="brand-name">EL<span>Store</span></span>
    </div>
  </div>

  <!-- Hero copy -->
  <div class="left-mid">
    <div class="panel-eyebrow">
      <i class="fas fa-satellite-dish"></i>
      Sistem Informasi Geografis
    </div>
    <h2 class="panel-title">
      Peta Toko Elektronik<br>
      <span class="grad">Sumatera Utara</span>
    </h2>
    <p class="panel-desc">
      Masuk ke dashboard untuk mengelola data toko, koordinat GPS,
      dan laporan sebaran elektronik di Kota Kisaran, Asahan.
    </p>
    <div class="panel-stats">
      <div class="ps-item">
        <div class="ps-val">150+</div>
        <div class="ps-lbl">Toko Terdaftar</div>
      </div>
      <div class="ps-item">
        <div class="ps-val">2</div>
        <div class="ps-lbl">Wilayah Kota</div>
      </div>
      <div class="ps-item">
        <div class="ps-val">100%</div>
        <div class="ps-lbl">Data Akurat</div>
      </div>
    </div>
  </div>

  <!-- Back to home -->
  <div class="left-bot">
    <a href="<?= base_url('/') ?>">
      <i class="fas fa-arrow-left"></i>
      Kembali ke Beranda
    </a>
  </div>
</div>


<!-- ======== RIGHT PANEL ======== -->
<div class="auth-right">



  <!-- Head -->
  <div class="form-head">
    <div class="form-step" data-i18n="step">SELAMAT DATANG KEMBALI</div>
    <h1 class="form-title" data-i18n="auth_login_title">Masuk ke Akun</h1>
    <p class="form-subtitle">
      <span data-i18n="sub">Belum punya akun?</span>
      <a href="<?= base_url('auth/register') ?>" data-i18n="sub_link">Daftar sekarang</a>
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

  <!-- Login Form -->
  <?= form_open('auth/login-process', ['id' => 'loginForm']) ?>

    <!-- Email / Username -->
    <div class="form-group">
      <label for="login_id" class="form-label" data-i18n="lbl_id">Email atau Username</label>
      <div class="input-wrap">
        <i class="fas fa-user input-icon"></i>
        <input
          type="text"
          id="login_id"
          name="login_id"
          placeholder="email@domain.com"
          data-i18n="ph_id"
          value="<?= old('login_id') ?>"
          autocomplete="username"
          class="<?= session('errors.login_id') ? 'is-invalid' : '' ?>"
          required>
      </div>
      <?php if (session('errors.login_id')): ?>
        <div class="field-error">
          <i class="fas fa-triangle-exclamation"></i>
          <?= session('errors.login_id') ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Password -->
    <div class="form-group">
      <label for="password" class="form-label" data-i18n="lbl_pw">Kata Sandi</label>
      <div class="input-wrap">
        <i class="fas fa-lock input-icon"></i>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Masukkan kata sandi"
          data-i18n="ph_pw"
          autocomplete="current-password"
          class="<?= session('errors.password') ? 'is-invalid' : '' ?>"
          required>
        <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
          <i class="fas fa-eye"></i>
        </button>
      </div>
      <?php if (session('errors.password')): ?>
        <div class="field-error">
          <i class="fas fa-triangle-exclamation"></i>
          <?= session('errors.password') ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Remember + Forgot -->
    <div class="form-row-aux">
      <label class="check-label">
        <input type="checkbox" name="remember" value="1">
        <span data-i18n="remember">Ingat saya</span>
      </label>
      <a href="<?= base_url('auth/forgot-password') ?>" class="forgot-link" data-i18n="auth_forgot_title">Lupa kata sandi?</a>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn-submit">
      <i class="fas fa-right-to-bracket"></i>
      <span data-i18n="submit">Masuk Sekarang</span>
    </button>

  <?= form_close() ?>



  <!-- Footer -->
  <p class="form-foot">
    <span data-i18n="foot">Belum punya akun?</span>
    <a href="<?= base_url('auth/register') ?>" data-i18n="foot_link">Daftar sekarang →</a>
  </p>

</div><!-- /.auth-right -->


<script>
  /* Toggle password visibility */
  function togglePw(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  }

</script>
</body>
</html>