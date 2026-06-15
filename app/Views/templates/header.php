<!DOCTYPE html>
<html lang="<?php echo isset($lang) ? $lang : 'id'; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELStore GIS — <?php echo isset($page_title) ? $page_title : 'Sistem Informasi Geografis'; ?></title>
  <meta name="description" content="Sistem Informasi Geografis Pemetaan Toko Elektronik Sumatera Utara — Kota Kisaran, Asahan">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Leaflet CSS & JS (GIS Map) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- AOS Animation -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

  <style>
    /* =============================================
       CSS CUSTOM PROPERTIES
    ============================================= */
    :root {
      --primary:        #2563EB;
      --primary-light:  #60A5FA;
      --primary-dark:   #1D4ED8;
      --primary-glow:   rgba(37,99,235,0.35);
      --dark:           #0A0F1E;
      --dark-2:         #111827;
      --dark-3:         #1F2937;
      --surface:        #FFFFFF;
      --surface-2:      #F8FAFC;
      --surface-3:      #F1F5F9;
      --border:         #E2E8F0;
      --text-primary:   #0F172A;
      --text-secondary: #475569;
      --text-muted:     #94A3B8;
      --text-white:     #FFFFFF;
      --star-gold:      #F59E0B;

      /* Glass Morphism */
      --glass-bg:       rgba(255,255,255,0.08);
      --glass-bg-dark:  rgba(10,15,30,0.75);
      --glass-border:   rgba(255,255,255,0.15);
      --glass-shadow:   0 8px 32px rgba(0,0,0,0.25);

      /* Shadows */
      --shadow-sm:  0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
      --shadow-md:  0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.05);
      --shadow-lg:  0 20px 48px rgba(0,0,0,0.10), 0 8px 16px rgba(0,0,0,0.06);
      --shadow-xl:  0 32px 64px rgba(0,0,0,0.15);

      /* Radius */
      --radius-sm:  8px;
      --radius-md:  14px;
      --radius-lg:  20px;
      --radius-xl:  28px;
      --radius-full: 9999px;

      /* Typography */
      --font-display: 'Outfit', sans-serif;
      --font-body:    'Space Grotesk', sans-serif;

      /* Transitions */
      --transition-fast:   0.15s cubic-bezier(0.4, 0, 0.2, 1);
      --transition-smooth: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
      --transition-bounce: 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);

      /* Navbar */
      --navbar-h: 72px;
    }

    /* =============================================
       RESET & BASE
    ============================================= */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html   { scroll-behavior: smooth; font-size: 16px; }
    body   {
      font-family: var(--font-body);
      color: var(--text-primary);
      background: var(--surface);
      overflow-x: hidden;
      line-height: 1.6;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }
    ul, ol { list-style: none; }
    button { cursor: pointer; border: none; background: none; font-family: inherit; }

    /* =============================================
       SCROLLBAR
    ============================================= */
    ::-webkit-scrollbar        { width: 6px; }
    ::-webkit-scrollbar-track  { background: var(--surface-3); }
    ::-webkit-scrollbar-thumb  { background: var(--primary); border-radius: 4px; }

    /* =============================================
       UTILITY
    ============================================= */
    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
    }
    .section-pad { padding: 96px 0; }
    .text-center { text-align: center; }

    /* =============================================
       NAVBAR
    ============================================= */
    #mainNavbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1050;
      height: var(--navbar-h);
      display: flex;
      align-items: center;
      transition: background var(--transition-smooth),
                  box-shadow var(--transition-smooth),
                  backdrop-filter var(--transition-smooth),
                  height var(--transition-smooth);
    }

    /* Before scroll → fully transparent only on home */
    body.is-home #mainNavbar.nav-top {
      background: transparent;
    }

    /* Before scroll → solid dark on non-home to ensure text visibility */
    body.not-home #mainNavbar.nav-top {
      background: var(--dark-2);
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    /* After scroll → glass morphism */
    #mainNavbar.nav-scrolled {
      background: var(--glass-bg-dark);
      backdrop-filter: blur(20px) saturate(180%);
      -webkit-backdrop-filter: blur(20px) saturate(180%);
      border-bottom: 1px solid var(--glass-border);
      box-shadow: 0 4px 40px rgba(0,0,0,0.4);
      height: 64px;
    }

    .nav-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    /* --- Brand --- */
    .nav-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand-logo {
      width: 40px; height: 40px;
      background: var(--primary);
      border-radius: var(--radius-sm);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 16px var(--primary-glow);
      transition: transform var(--transition-bounce),
                  box-shadow var(--transition-smooth);
      flex-shrink: 0;
    }

    .brand-logo:hover { transform: rotate(-8deg) scale(1.08); }
    .brand-logo i { color: #fff; font-size: 18px; }

    .brand-name {
      font-family: var(--font-display);
      font-size: 22px;
      font-weight: 900;
      color: #fff;
      letter-spacing: -0.5px;
    }
    .brand-name .accent { color: var(--primary-light); }

    /* --- Nav Links --- */
    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .nav-links a {
      font-size: 14px;
      font-weight: 500;
      color: rgba(255,255,255,0.75);
      padding: 8px 14px;
      border-radius: var(--radius-sm);
      transition: all var(--transition-fast);
      position: relative;
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 4px; left: 50%; right: 50%;
      height: 2px;
      background: var(--primary-light);
      border-radius: var(--radius-full);
      transition: all var(--transition-smooth);
    }
    .nav-links a:hover {
      color: #fff;
      background: rgba(255,255,255,0.10);
    }
    .nav-links a:hover::after,
    .nav-links a.active::after {
      left: 14px; right: 14px;
    }
    .nav-links a.active { color: #fff; }

    /* --- Right Actions --- */
    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* Language Switcher */
    .lang-pill {
      display: flex;
      align-items: center;
      background: rgba(255,255,255,0.10);
      border: 1px solid rgba(255,255,255,0.18);
      border-radius: var(--radius-full);
      overflow: hidden;
      height: 36px;
    }

    .lang-pill button {
      font-family: var(--font-body);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.8px;
      color: rgba(255,255,255,0.55);
      background: transparent;
      border: none;
      padding: 0 14px;
      height: 100%;
      transition: all var(--transition-fast);
    }

    .lang-pill button.lang-active {
      background: var(--primary);
      color: #fff;
    }

    .lang-sep {
      width: 1px;
      height: 18px;
      background: rgba(255,255,255,0.2);
      flex-shrink: 0;
    }

    /* Login Button */
    .btn-login {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 22px;
      background: var(--primary);
      color: #fff;
      border-radius: var(--radius-md);
      font-family: var(--font-display);
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 0.3px;
      border: 2px solid transparent;
      transition: all var(--transition-smooth);
      white-space: nowrap;
    }

    .btn-login:hover {
      background: var(--primary-dark);
      box-shadow: 0 6px 20px var(--primary-glow);
      transform: translateY(-2px);
    }

    /* Hamburger */
    .hamburger {
      display: none;
      width: 38px; height: 38px;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 5px;
      background: rgba(255,255,255,0.1);
      border-radius: var(--radius-sm);
      border: 1px solid rgba(255,255,255,0.15);
      padding: 8px;
      cursor: pointer;
      transition: background var(--transition-fast);
    }
    .hamburger:hover { background: rgba(255,255,255,0.18); }

    .hamburger span {
      display: block;
      width: 20px; height: 2px;
      background: #fff;
      border-radius: 2px;
      transition: all var(--transition-smooth);
      transform-origin: center;
    }
    .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* =============================================
       MOBILE MENU DRAWER
    ============================================= */
    #mobileDrawer {
      position: fixed;
      top: var(--navbar-h);
      left: 0; right: 0;
      z-index: 1040;
      background: rgba(10,15,30,0.97);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border-bottom: 1px solid rgba(255,255,255,0.08);
      padding: 16px 20px 24px;
      display: flex;
      flex-direction: column;
      gap: 4px;
      transform: translateY(-120%);
      opacity: 0;
      transition: transform var(--transition-smooth),
                  opacity var(--transition-smooth);
      pointer-events: none;
    }

    #mobileDrawer.drawer-open {
      transform: translateY(0);
      opacity: 1;
      pointer-events: auto;
    }

    #mobileDrawer a {
      font-size: 15px;
      font-weight: 500;
      color: rgba(255,255,255,0.8);
      padding: 13px 16px;
      border-radius: var(--radius-sm);
      transition: all var(--transition-fast);
      border: 1px solid transparent;
    }

    #mobileDrawer a:hover {
      color: #fff;
      background: rgba(255,255,255,0.06);
      border-color: rgba(255,255,255,0.08);
    }

    .drawer-footer {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px 0;
      margin-top: 8px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }

    /* =============================================
       RESPONSIVE BREAKPOINTS
    ============================================= */
    @media (max-width: 960px) {
      .nav-links { display: none; }
      .hamburger { display: flex; }
    }

    @media (max-width: 600px) {
      .btn-login .btn-label { display: none; }
      .btn-login { padding: 9px 14px; }
    }
  </style>

  <!-- Page-specific styles slot -->
  <?php if (isset($extra_css)) echo $extra_css; ?>
</head>
<body class="<?php echo (isset($page_title) && $page_title === 'Beranda') ? 'is-home' : 'not-home'; ?>">

<!-- =============================================
     NAVBAR
============================================= -->
<nav id="mainNavbar" class="nav-top">
  <div class="container nav-inner">

    <!-- Brand -->
    <a href="<?php echo base_url(); ?>" class="nav-brand">
      <div class="brand-logo">
        <i class="fas fa-map-location-dot"></i>
      </div>
      <span class="brand-name">EL<span class="accent">Store</span></span>
    </a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links">
      <li><a href="#beranda"  class="active" data-i18n="nav_home">Beranda</a></li>
      <li><a href="#tentang"  data-i18n="nav_about">Tentang</a></li>
      <li><a href="#peta"     data-i18n="nav_map">Peta GIS</a></li>
      <?php if (session()->get('is_logged_in')): ?>
        <li><a href="#toko"     data-i18n="nav_stores">Toko</a></li>
      <?php endif; ?>
      <li><a href="#ulasan"   data-i18n="nav_reviews">Ulasan</a></li>
      <li><a href="#kontak"   data-i18n="nav_contact">Kontak</a></li>
    </ul>

    <!-- Actions: Language + Login + Hamburger -->
    <div class="nav-actions">


      <!-- Login / Dashboard -->
      <?php if (session()->get('is_logged_in')): ?>
        <?php if (session()->get('role') === 'admin'): ?>
          <a href="<?php echo base_url('admin'); ?>" class="btn-login" style="background: rgba(37,99,235,0.1); border-color: rgba(37,99,235,0.25); color: var(--primary);">
            <i class="fas fa-table-columns"></i>
            <span class="btn-label">Dashboard</span>
          </a>
        <?php else: ?>
          <?php
          $profilUrl = match(session()->get('role')) {
            'pemilik_toko' => base_url('dashboard/toko/profil'),
            default        => base_url('dashboard/profil'),
          };
          ?>
          <a href="<?php echo $profilUrl; ?>" class="btn-login" style="background: rgba(37,99,235,0.1); border-color: rgba(37,99,235,0.25); color: var(--primary);">
            <i class="fas fa-user-circle"></i>
            <span class="btn-label">Profil</span>
          </a>
        <?php endif; ?>
        <a href="<?php echo base_url('auth/logout'); ?>" class="btn-login" style="background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); color: #EF4444;">
          <i class="fas fa-sign-out-alt"></i>
          <span class="btn-label">Logout</span>
        </a>
      <?php else: ?>
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-login">
          <i class="fas fa-right-to-bracket"></i>
          <span class="btn-label" data-i18n="nav_login">Login</span>
        </a>
      <?php endif; ?>

      <!-- Hamburger (mobile) -->
      <div class="hamburger" id="hamburger"
           onclick="toggleDrawer()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>
</nav>

<!-- =============================================
     MOBILE DRAWER
============================================= -->
<div id="mobileDrawer" aria-hidden="true">
  <a href="#beranda" onclick="closeDrawer()" data-i18n="nav_home">🏠&nbsp; Beranda</a>
  <a href="#tentang" onclick="closeDrawer()" data-i18n="nav_about">ℹ️&nbsp; Tentang</a>
  <a href="#peta"    onclick="closeDrawer()" data-i18n="nav_map">🗺️&nbsp; Peta GIS</a>
  <?php if (session()->get('is_logged_in')): ?>
    <a href="#toko"    onclick="closeDrawer()" data-i18n="nav_stores">🏪&nbsp; Toko</a>
  <?php endif; ?>
  <a href="#ulasan"  onclick="closeDrawer()" data-i18n="nav_reviews">⭐&nbsp; Ulasan</a>
  <a href="#kontak"  onclick="closeDrawer()" data-i18n="nav_contact">📞&nbsp; Kontak</a>

  <div class="drawer-footer">

    <?php if (session()->get('is_logged_in')): ?>
      <a href="<?php echo $profilUrl ?? base_url('dashboard/profil'); ?>"
         class="btn-login" style="flex:1; justify-content:center; background: rgba(37,99,235,0.1); border-color: rgba(37,99,235,0.25); color: var(--primary);">
        <i class="fas fa-user-circle"></i>
        <span>Profil</span>
      </a>
      <a href="<?php echo base_url('auth/logout'); ?>"
         class="btn-login" style="flex:1; justify-content:center; background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); color: #EF4444;">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    <?php else: ?>
      <a href="<?php echo base_url('auth/login'); ?>"
         class="btn-login" style="flex:1; justify-content:center;">
        <i class="fas fa-right-to-bracket"></i>
        <span data-i18n="nav_login">Login</span>
      </a>
    <?php endif; ?>
  </div>
</div>

