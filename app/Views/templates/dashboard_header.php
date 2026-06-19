<!DOCTYPE html>
<html lang="<?php echo isset($lang) ? $lang : 'id'; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELStore GIS — <?php echo isset($page_title) ? esc($page_title) : 'Dashboard'; ?></title>
  <meta name="description" content="Dashboard ELStore GIS - Sistem Informasi Geografis Toko Elektronik Sumatera Utara">
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="<?php echo base_url('favicon.svg'); ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    /* ============================================================
       DASHBOARD CSS — ELStore GIS
    ============================================================ */
    :root {
      --primary:        #2563EB;
      --primary-light:  #60A5FA;
      --primary-dark:   #1D4ED8;
      --primary-glow:   rgba(37,99,235,0.35);
      --primary-10:     rgba(37,99,235,0.10);
      --dark:           #0A0F1E;
      --dark-2:         #111827;
      --sidebar-bg:     #0F172A;
      --sidebar-w:      260px;
      --surface:        #FFFFFF;
      --surface-2:      #F8FAFC;
      --surface-3:      #F1F5F9;
      --border:         #E2E8F0;
      --text-primary:   #0F172A;
      --text-secondary: #475569;
      --text-muted:     #94A3B8;
      --success:        #22C55E;
      --warning:        #F59E0B;
      --danger:         #EF4444;
      --info:           #06B6D4;
      --font-display:   'Outfit', sans-serif;
      --font-body:      'Space Grotesk', sans-serif;
      --radius-sm:      8px;
      --radius-md:      14px;
      --radius-lg:      20px;
      --radius-xl:      28px;
      --radius-full:    9999px;
      --transition:     0.25s cubic-bezier(0.4, 0, 0.2, 1);
      --header-h:       64px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: var(--font-body);
      background: var(--surface-2);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
    }
    a { text-decoration: none; color: inherit; }
    ul, ol { list-style: none; }
    img { max-width: 100%; display: block; }
    button { cursor: pointer; border: none; background: none; font-family: inherit; }

    /* Scrollbar */
    ::-webkit-scrollbar        { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track  { background: transparent; }
    ::-webkit-scrollbar-thumb  { background: #CBD5E1; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary-light); }

    /* ========== SIDEBAR ========== */
    #sidebar {
      width: var(--sidebar-w);
      background: var(--sidebar-bg);
      height: 100vh;
      height: 100dvh; /* Dynamic viewport height — fixes iOS browser chrome */
      position: fixed;
      top: 0; left: 0;
      bottom: 0;
      display: flex;
      flex-direction: column;
      z-index: 1020;
      transition: transform var(--transition);
    }

    /* Sidebar brand */
    .sb-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 24px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .sb-logo {
      width: 38px; height: 38px;
      background: var(--primary);
      border-radius: var(--radius-sm);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 0 16px var(--primary-glow);
      flex-shrink: 0;
    }
    .sb-logo i { color: #fff; font-size: 16px; }

    .sb-brand-name {
      font-family: var(--font-display);
      font-size: 18px;
      font-weight: 900;
      color: #fff;
      letter-spacing: -0.5px;
    }
    .sb-brand-name span { color: var(--primary-light); }

    /* Role badge */
    .sb-role-badge {
      margin: 16px 20px;
      padding: 6px 12px;
      background: rgba(37,99,235,0.15);
      border: 1px solid rgba(96,165,250,0.2);
      border-radius: var(--radius-full);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--primary-light);
      text-align: center;
    }

    /* Sidebar nav */
    .sb-nav {
      flex: 1;
      padding: 8px 12px;
      overflow-y: auto;
    }

    .sb-section-title {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.8px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.25);
      padding: 12px 8px 6px;
      margin-top: 8px;
    }

    .sb-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: var(--radius-sm);
      font-size: 14px;
      font-weight: 500;
      color: rgba(255,255,255,0.55);
      transition: all var(--transition);
      margin-bottom: 2px;
      position: relative;
    }

    .sb-link i {
      width: 20px;
      text-align: center;
      font-size: 15px;
      flex-shrink: 0;
    }

    .sb-link:hover {
      background: rgba(255,255,255,0.06);
      color: rgba(255,255,255,0.85);
    }

    .sb-link.active {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 4px 16px var(--primary-glow);
    }

    .sb-link.active i { color: #fff; }

    .sb-badge {
      margin-left: auto;
      background: var(--danger);
      color: #fff;
      font-size: 10px;
      font-weight: 700;
      padding: 2px 7px;
      border-radius: var(--radius-full);
    }

    /* Sidebar footer (user info) */
    .sb-footer {
      padding: 16px 20px;
      /* Tambah ruang aman untuk navigation bar iPhone/iOS */
      padding-bottom: calc(16px + env(safe-area-inset-bottom, 0px));
      border-top: 1px solid rgba(255,255,255,0.06);
      flex-shrink: 0; /* Jangan pernah dikompres */
    }

    .sb-user {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sb-avatar {
      width: 38px; height: 38px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      font-size: 15px;
      color: #fff;
      font-weight: 700;
    }

    .sb-user-info { flex: 1; min-width: 0; }
    .sb-user-name {
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .sb-user-role {
      font-size: 11px;
      color: rgba(255,255,255,0.4);
    }

    .sb-logout {
      width: 32px; height: 32px;
      background: rgba(239,68,68,0.12);
      border-radius: var(--radius-sm);
      display: flex; align-items: center; justify-content: center;
      color: #EF4444;
      transition: all var(--transition);
      flex-shrink: 0;
    }
    .sb-logout:hover {
      background: #EF4444;
      color: #fff;
    }

    /* ========== MAIN CONTENT ========== */
    #main {
      margin-left: var(--sidebar-w);
      flex: 1;
      min-width: 0; /* Crucial for responsive flex children */
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    /* Top header bar */
    #dashHeader {
      height: var(--header-h);
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 28px;
      position: sticky;
      top: 0;
      z-index: 1010;
      box-shadow: 0 1px 8px rgba(0,0,0,0.05);
    }

    .dh-left {
      display: flex;
      align-items: center;
      gap: 16px;
      min-width: 0; /* Let breadcrumbs shrink */
    }

    .menu-toggle {
      display: none;
      width: 36px; height: 36px;
      background: var(--surface-2);
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      align-items: center;
      justify-content: center;
      font-size: 16px;
      color: var(--text-secondary);
      flex-shrink: 0;
    }

    .page-title-bar {
      font-family: var(--font-display);
      font-size: clamp(14px, 4vw, 18px);
      font-weight: 800;
      color: var(--text-primary);
      line-height: 1.2;
    }

    .page-breadcrumb {
      font-size: clamp(10px, 2.5vw, 12px);
      color: var(--text-muted);
      margin-top: 2px;
      line-height: 1.2;
    }

    .dh-right {
      display: flex;
      align-items: center;
      gap: 12px;
      flex-shrink: 0;
    }

    .dh-btn {
      display: flex;
      align-items: center;
      gap: 7px;
      padding: 8px 16px;
      background: var(--primary);
      color: #fff;
      border-radius: var(--radius-sm);
      font-size: 13px;
      font-weight: 600;
      font-family: var(--font-display);
      transition: all var(--transition);
      white-space: nowrap;
    }
    .dh-btn:hover {
      background: var(--primary-dark);
      box-shadow: 0 4px 14px var(--primary-glow);
      transform: translateY(-1px);
    }

    /* ========== PAGE CONTENT ========== */
    .page-content {
      padding: 28px;
      flex: 1;
      min-width: 0; /* Crucial for responsive inner content */
      width: 100%;
    }

    /* ========== FLASH ALERTS ========== */
    .flash-alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 14px 18px;
      border-radius: var(--radius-md);
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 20px;
      animation: flash-in 0.3s ease;
    }
    @keyframes flash-in {
      from { opacity:0; transform:translateY(-8px); }
      to   { opacity:1; transform:translateY(0); }
    }
    .flash-success { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }
    .flash-error   { background: #FEF2F2; color: #B91C1C; border: 1px solid #FECACA; }
    .flash-warning { background: #FFFBEB; color: #92400E; border: 1px solid #FDE68A; }

    /* ========== STAT CARDS & GRID ========== */
    .content-grid {
      display: grid;
      grid-template-columns: 1.4fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 28px;
    }

    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 24px;
      position: relative;
      overflow: hidden;
      transition: all var(--transition);
    }

    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 36px rgba(0,0,0,0.08);
      border-color: var(--primary-light);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--card-color, var(--primary)), transparent);
    }

    .stat-icon {
      width: 48px; height: 48px;
      border-radius: var(--radius-md);
      display: flex; align-items: center; justify-content: center;
      font-size: 20px;
      margin-bottom: 16px;
    }

    .stat-value {
      font-family: var(--font-display);
      font-size: 32px;
      font-weight: 900;
      color: var(--text-primary);
      line-height: 1;
    }

    .stat-label {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    .stat-change {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: 12px;
      font-weight: 600;
      margin-top: 10px;
      padding: 3px 8px;
      border-radius: var(--radius-full);
    }
    .stat-change.up   { color: #16A34A; background: #F0FDF4; }
    .stat-change.down { color: #DC2626; background: #FEF2F2; }

    /* ========== SECTION HEADER ========== */
    .section-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .section-title {
      font-family: var(--font-display);
      font-size: 16px;
      font-weight: 800;
      color: var(--text-primary);
    }

    .section-link {
      font-size: 13px;
      font-weight: 600;
      color: var(--primary);
      transition: gap var(--transition);
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .section-link:hover { gap: 8px; }

    /* ========== PAGINATION ========== */
    .pagination {
      display: flex;
      padding-left: 0;
      list-style: none;
      gap: 6px;
      margin: 0;
      align-items: center;
    }
    .pagination li {
      display: inline-block;
    }
    .pagination li a, .pagination li span {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 36px;
      height: 36px;
      padding: 0 12px;
      background: transparent;
      color: var(--text-secondary);
      border-radius: var(--radius-sm);
      font-size: 14px;
      font-weight: 600;
      transition: all var(--transition);
      text-decoration: none;
    }
    .pagination li a:hover {
      background: rgba(37,99,235,0.08);
      color: var(--primary);
    }
    .pagination li.active a {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 4px 12px var(--primary-glow);
    }
    .pagination li a span, .pagination li span span {
      font-size: 13px;
    }

    /* ========== CARD ========== */
    .dash-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
    }

    .dash-card-header {
      padding: 18px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .dash-card-title {
      font-family: var(--font-display);
      font-size: 15px;
      font-weight: 700;
      color: var(--text-primary);
    }

    /* ========== TABLE ========== */
    .table-wrap {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table thead th {
      padding: 12px 16px;
      text-align: left;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--text-muted);
      background: var(--surface-2);
      border-bottom: 1px solid var(--border);
      white-space: nowrap;
    }

    table tbody td {
      padding: 13px 16px;
      font-size: 13px;
      color: var(--text-secondary);
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
      white-space: nowrap;
    }

    table tbody tr:last-child td { border-bottom: none; }
    table tbody tr:hover { background: var(--surface-2); }

    /* ========== BADGE ========== */
    .badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 10px;
      border-radius: var(--radius-full);
      font-size: 11px;
      font-weight: 600;
    }
    .badge-success { background: #DCFCE7; color: #15803D; }
    .badge-danger  { background: #FEE2E2; color: #B91C1C; }
    .badge-warning { background: #FEF3C7; color: #92400E; }
    .badge-info    { background: #E0F2FE; color: #075985; }
    .badge-primary { background: #EFF6FF; color: #1D4ED8; }

    /* ========== BUTTONS ========== */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: var(--radius-sm);
      font-family: var(--font-body);
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: all var(--transition);
      border: 1.5px solid transparent;
    }
    .btn-sm { padding: 5px 11px; font-size: 12px; }

    .btn-primary {
      background: var(--primary);
      color: #fff;
    }
    .btn-primary:hover {
      background: var(--primary-dark);
      box-shadow: 0 4px 14px var(--primary-glow);
    }

    .btn-outline {
      background: transparent;
      border-color: var(--border);
      color: var(--text-secondary);
    }
    .btn-outline:hover {
      border-color: var(--primary);
      color: var(--primary);
    }

    .btn-danger {
      background: #FEE2E2;
      color: #B91C1C;
      border-color: #FECACA;
    }
    .btn-danger:hover { background: #DC2626; color: #fff; border-color: #DC2626; }

    .btn-success {
      background: #DCFCE7;
      color: #15803D;
      border-color: #BBF7D0;
    }
    .btn-success:hover { background: #16A34A; color: #fff; border-color: #16A34A; }

    .btn-warning {
      background: #FEF3C7;
      color: #92400E;
      border-color: #FDE68A;
    }
    .btn-warning:hover { background: #D97706; color: #fff; }

    .btn-actions {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* ========== FORM ========== */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .form-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
    .col-span-2  { grid-column: span 2; }
    .col-span-3  { grid-column: span 3; }

    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 7px;
    }
    .form-group label .req { color: var(--danger); }

    .form-control {
      width: 100%;
      padding: 11px 14px;
      font-family: var(--font-body);
      font-size: 14px;
      color: var(--text-primary);
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: var(--radius-sm);
      outline: none;
      transition: all var(--transition);
      -webkit-appearance: none;
    }
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
    }
    .form-control.is-invalid { border-color: var(--danger); }

    select.form-control {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394A3B8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      padding-right: 32px;
      cursor: pointer;
    }

    textarea.form-control { resize: vertical; min-height: 100px; }

    .field-error {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 12px;
      color: var(--danger);
      margin-top: 5px;
    }

    /* ========== MAP ========== */
    #dashMap {
      height: 480px;
      border-radius: var(--radius-md);
      overflow: hidden;
    }

    /* ========== PROFILE CARD ========== */
    .profile-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-xl);
      padding: 32px;
      text-align: center;
    }

    .profile-avatar {
      width: 80px; height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      display: flex; align-items: center; justify-content: center;
      font-size: 32px;
      color: #fff;
      font-weight: 700;
      margin: 0 auto 16px;
      box-shadow: 0 8px 24px var(--primary-glow);
    }

    .profile-name {
      font-family: var(--font-display);
      font-size: 20px;
      font-weight: 800;
      color: var(--text-primary);
    }

    .profile-role {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 4px;
    }

    /* ========== RESPONSIVE ========== */
    .dataTables_wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .dataTables_wrapper .dataTables_paginate { margin-top: 10px; }

    @media (max-width: 992px) {
      #sidebar {
        transform: translateX(-100%);
      }
      #sidebar.sb-open {
        transform: translateX(0);
        box-shadow: 0 0 40px rgba(0,0,0,0.5);
      }
      #main {
        margin-left: 0;
      }
      .menu-toggle { display: flex; }
      .form-grid { grid-template-columns: 1fr; }
      .form-grid .col-span-2 { grid-column: span 1; }
      .content-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
      .dh-right .dh-btn { padding: 6px 10px; font-size: 12px; }
      .stats-grid { grid-template-columns: 1fr; gap: 16px; }
      #dashHeader { height: auto; min-height: var(--header-h); padding: 12px 20px; }
    }

    @media (max-width: 600px) {
      .page-content { padding: 16px; }
      .dh-right { display: none; } /* Hide top right buttons, already in sidebar */
      .stats-grid { grid-template-columns: 1fr; }
      .profile-card { padding: 20px; }
    }

    @media (max-width: 400px) {
      .stats-grid { grid-template-columns: 1fr; }
    }

    /* Sidebar overlay */
    #sbOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 190;
    }
    #sbOverlay.active { display: block; }
  </style>

  <?php if (isset($extra_css)) echo $extra_css; ?>
</head>
<body>

<!-- Sidebar Overlay (mobile) -->
<div id="sbOverlay" onclick="closeSidebar()"></div>

<!-- ============================================================
     SIDEBAR
============================================================ -->
<aside id="sidebar">
  <!-- Brand -->
  <a href="<?php echo base_url(); ?>" class="sb-brand">
    <div class="sb-logo"><i class="fas fa-map-location-dot"></i></div>
    <span class="sb-brand-name">EL<span>Store</span></span>
  </a>

  <!-- Role badge -->
  <?php
  $role = session()->get('role') ?? 'pengguna';
  $roleLabels = [
    'admin'        => 'Administrator',
    'pemilik_toko' => 'Pemilik Toko',
    'pengguna'     => 'Pengguna',
  ];
  ?>
  <div class="sb-role-badge"><?php echo $roleLabels[$role] ?? '👤 Pengguna'; ?></div>

  <!-- Navigation -->
  <nav class="sb-nav">
    <?php if ($role === 'admin'): ?>
      <!-- ADMIN MENU -->
      <div class="sb-section-title" data-i18n="dash_utama">Utama</div>
      <a href="<?php echo base_url('admin'); ?>" class="sb-link <?php echo current_url() === base_url('admin') ? 'active' : ''; ?>">
        <i class="fas fa-gauge-high"></i> <span data-i18n="dash_nav_dash">Dashboard</span>
      </a>
      <a href="<?php echo base_url('admin/peta'); ?>" class="sb-link <?php echo str_contains(current_url(), 'admin/peta') ? 'active' : ''; ?>">
        <i class="fas fa-map-location-dot"></i> <span data-i18n="dash_nav_map">Peta GIS</span>
      </a>

      <div class="sb-section-title" data-i18n="dash_kelola_data">Kelola Data</div>
      <a href="<?php echo base_url('admin/toko'); ?>" class="sb-link <?php echo str_contains(current_url(), 'admin/toko') ? 'active' : ''; ?>">
        <i class="fas fa-store"></i> <span data-i18n="dash_nav_toko">Kelola Toko</span>
      </a>
      <a href="<?php echo base_url('admin/users'); ?>" class="sb-link <?php echo str_contains(current_url(), 'admin/users') ? 'active' : ''; ?>">
        <i class="fas fa-users"></i> <span data-i18n="dash_nav_users">Kelola Pengguna</span>
      </a>
      <a href="<?php echo base_url('admin/laporan'); ?>" class="sb-link <?php echo str_contains(current_url(), 'admin/laporan') ? 'active' : ''; ?>">
        <i class="fas fa-chart-bar"></i> Laporan
      </a>

      <div class="sb-section-title" data-i18n="dash_pengaturan">Akun</div>
      <a href="<?php echo base_url('admin/profil'); ?>" class="sb-link <?php echo str_contains(current_url(), 'admin/profil') ? 'active' : ''; ?>">
        <i class="fas fa-user-gear"></i> <span data-i18n="dash_nav_profile">Profil</span>
      </a>

    <?php elseif ($role === 'pemilik_toko'): ?>
      <!-- PEMILIK TOKO MENU -->
      <div class="sb-section-title" data-i18n="dash_utama">Utama</div>
      <a href="<?php echo base_url('dashboard/toko'); ?>" class="sb-link <?php echo current_url() === base_url('dashboard/toko') ? 'active' : ''; ?>">
        <i class="fas fa-gauge-high"></i> <span data-i18n="dash_nav_dash">Dashboard</span>
      </a>
      <a href="<?php echo base_url('peta'); ?>" class="sb-link">
        <i class="fas fa-map"></i> <span data-i18n="dash_nav_map">Peta Publik</span>
      </a>

      <div class="sb-section-title" data-i18n="dash_nav_mystores">Toko Saya</div>
      <a href="<?php echo base_url('dashboard/toko/tambah'); ?>" class="sb-link <?php echo str_contains(current_url(), 'tambah') ? 'active' : ''; ?>">
        <i class="fas fa-plus-circle"></i> Tambah Toko
      </a>

      <div class="sb-section-title" data-i18n="dash_pengaturan">Akun</div>
      <a href="<?php echo base_url('dashboard/toko/profil'); ?>" class="sb-link <?php echo str_contains(current_url(), 'profil') ? 'active' : ''; ?>">
        <i class="fas fa-user-gear"></i> <span data-i18n="dash_nav_profile">Profil</span>
      </a>

    <?php else: ?>
      <!-- USER MENU -->
      <div class="sb-section-title" data-i18n="dash_utama">Utama</div>
      <a href="<?php echo base_url('dashboard'); ?>" class="sb-link <?php echo current_url() === base_url('dashboard') ? 'active' : ''; ?>">
        <i class="fas fa-gauge-high"></i> <span data-i18n="dash_nav_dash">Dashboard</span>
      </a>
      <a href="<?php echo base_url('peta'); ?>" class="sb-link">
        <i class="fas fa-map"></i> <span data-i18n="dash_nav_map">Peta GIS</span>
      </a>
      <a href="<?php echo base_url('toko'); ?>" class="sb-link">
        <i class="fas fa-store"></i> Daftar Toko
      </a>

      <div class="sb-section-title" data-i18n="dash_pengaturan">Akun</div>
      <a href="<?php echo base_url('dashboard/profil'); ?>" class="sb-link <?php echo str_contains(current_url(), 'profil') ? 'active' : ''; ?>">
        <i class="fas fa-user-gear"></i> <span data-i18n="dash_nav_profile">Profil</span>
      </a>
    <?php endif; ?>

    <div class="sb-section-title" data-i18n="footer_nav">Navigasi</div>
    <a href="<?php echo base_url(); ?>" class="sb-link">
      <i class="fas fa-globe"></i> <span data-i18n="dash_kembali">Beranda</span>
    </a>
  </nav>

  <!-- User Footer -->
  <div class="sb-footer">
    <div class="sb-user">
      <div class="sb-avatar">
        <?php echo strtoupper(substr(session()->get('nama_lengkap') ?? 'U', 0, 1)); ?>
      </div>
      <div class="sb-user-info">
        <div class="sb-user-name"><?php echo esc(session()->get('nama_lengkap') ?? 'Pengguna'); ?></div>
        <div class="sb-user-role"><?php echo esc($roleLabels[$role] ?? 'Pengguna'); ?></div>
      </div>
      <a href="<?php echo base_url('auth/logout'); ?>" class="sb-logout" title="Keluar">
        <i class="fas fa-right-from-bracket" style="font-size:14px;"></i>
      </a>
    </div>
  </div>
</aside>

<!-- ============================================================
     MAIN AREA
============================================================ -->
<div id="main">
  <!-- Top Header -->
  <header id="dashHeader">
    <div class="dh-left">
      <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <div>
        <div class="page-title-bar"><?php echo isset($page_title) ? esc($page_title) : 'Dashboard'; ?></div>
        <div class="page-breadcrumb">
          ELStore GIS &rsaquo; <?php echo isset($page_title) ? esc($page_title) : 'Dashboard'; ?>
        </div>
      </div>
    </div>
    <div class="dh-right">


      <?php if ($role === 'admin'): ?>
        <a href="<?php echo base_url('admin/toko/tambah'); ?>" class="dh-btn">
          <i class="fas fa-plus"></i> Tambah Toko
        </a>
      <?php elseif ($role === 'pemilik_toko'): ?>
        <a href="<?php echo base_url('dashboard/toko/tambah'); ?>" class="dh-btn">
          <i class="fas fa-plus"></i> Tambah Toko
        </a>
      <?php else: ?>
        <a href="<?php echo base_url('peta'); ?>" class="dh-btn">
          <i class="fas fa-map"></i> Lihat Peta
        </a>
      <?php endif; ?>
      <a href="<?php echo base_url('auth/logout'); ?>" class="dh-btn" style="background: #FEE2E2; color: #B91C1C; margin-left: 10px;">
        <i class="fas fa-right-from-bracket"></i> Keluar
      </a>
    </div>
  </header>

  <!-- Page content area -->
  <main class="page-content">
