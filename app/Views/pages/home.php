<style>
  /* =============================================
     HOME PAGE — STYLES
  ============================================= */

  /* ---- HERO ---- */
  #beranda {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  /* Background image layer */
  .hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('<?= base_url("public/gambar/hero.jpg"); ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transform: scale(1.05);
    transition: transform 8s ease;
  }

  #beranda:hover .hero-bg { transform: scale(1.00); }

  /* Glass overlay — the requested effect */
  .hero-glass-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      135deg,
      rgba(10, 15, 30, 0.82) 0%,
      rgba(15, 40, 80, 0.72) 40%,
      rgba(10, 15, 30, 0.55) 100%
    );
    backdrop-filter: blur(4px) brightness(0.85) saturate(1.2);
    -webkit-backdrop-filter: blur(4px) brightness(0.85) saturate(1.2);
  }

  /* Decorative particles */
  .hero-particles {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
  }

  .particle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
    animation: float-up linear infinite;
  }
  .particle:nth-child(1)  { width:6px;height:6px;   left:10%; background:#60A5FA; animation-duration:7s;  animation-delay:0s;   }
  .particle:nth-child(2)  { width:10px;height:10px; left:25%; background:#93C5FD; animation-duration:10s; animation-delay:1.5s; }
  .particle:nth-child(3)  { width:4px;height:4px;   left:45%; background:#BFDBFE; animation-duration:6s;  animation-delay:3s;   }
  .particle:nth-child(4)  { width:8px;height:8px;   left:65%; background:#60A5FA; animation-duration:9s;  animation-delay:0.8s; }
  .particle:nth-child(5)  { width:5px;height:5px;   left:80%; background:#93C5FD; animation-duration:8s;  animation-delay:2.2s; }

  @keyframes float-up {
    0%   { transform: translateY(100vh) scale(0); opacity:0; }
    10%  { opacity: 0.15; }
    90%  { opacity: 0.15; }
    100% { transform: translateY(-100px) scale(1); opacity:0; }
  }

  /* Hero Content */
  .hero-content {
    position: relative;
    z-index: 5;
    width: 100%;
    padding-top: 120px;
    padding-bottom: 80px;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(37,99,235,0.2);
    border: 1px solid rgba(96,165,250,0.4);
    border-radius: var(--radius-full);
    color: var(--primary-light);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 24px;
    backdrop-filter: blur(8px);
    animation: badge-in 0.8s ease forwards;
  }

  @keyframes badge-in {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .hero-title {
    font-family: var(--font-display);
    font-size: clamp(36px, 5vw, 64px);
    font-weight: 900;
    color: #fff;
    line-height: 1.15;
    letter-spacing: -1px;
    margin-bottom: 20px;
    animation: hero-title-in 1s ease 0.2s both;
  }

  .hero-title .highlight {
    background: linear-gradient(135deg, #60A5FA 0%, #a78bfa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  @keyframes hero-title-in {
    from { opacity:0; transform:translateY(28px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .hero-subtitle {
    font-size: clamp(15px, 2vw, 18px);
    color: rgba(255,255,255,0.72);
    max-width: 560px;
    line-height: 1.75;
    margin-bottom: 40px;
    animation: hero-sub-in 1s ease 0.4s both;
  }

  @keyframes hero-sub-in {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    animation: hero-actions-in 1s ease 0.6s both;
  }

  @keyframes hero-actions-in {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .btn-primary-hero {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    background: var(--primary);
    color: #fff;
    border-radius: var(--radius-md);
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 700;
    border: 2px solid transparent;
    transition: all var(--transition-smooth);
    box-shadow: 0 4px 24px rgba(37,99,235,0.4);
  }

  .btn-primary-hero:hover {
    background: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(37,99,235,0.55);
  }

  .btn-outline-hero {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    background: rgba(255,255,255,0.08);
    color: #fff;
    border-radius: var(--radius-md);
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 700;
    border: 2px solid rgba(255,255,255,0.35);
    backdrop-filter: blur(8px);
    transition: all var(--transition-smooth);
  }

  .btn-outline-hero:hover {
    background: rgba(255,255,255,0.18);
    border-color: rgba(255,255,255,0.6);
    transform: translateY(-3px);
  }



  /* Hero Stats (bottom row) */
  .hero-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid rgba(255,255,255,0.12);
    animation: hero-stats-in 1s ease 0.8s both;
  }

  @keyframes hero-stats-in {
    from { opacity:0; }
    to   { opacity:1; }
  }

  .stat-item .stat-value {
    font-family: var(--font-display);
    font-size: 28px;
    font-weight: 900;
    color: #fff;
    line-height: 1;
  }

  .stat-item .stat-label {
    font-size: 13px;
    color: rgba(255,255,255,0.55);
    margin-top: 4px;
  }

  /* Hero scroll indicator */
  .scroll-indicator {
    position: absolute;
    bottom: 36px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    z-index: 5;
    animation: scroll-bounce 2s ease infinite;
  }

  .scroll-indicator span {
    font-size: 11px;
    color: rgba(255,255,255,0.5);
    letter-spacing: 2px;
    text-transform: uppercase;
  }

  .scroll-arrow {
    width: 36px; height: 36px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.6);
  }

  @keyframes scroll-bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50%       { transform: translateX(-50%) translateY(8px); }
  }

  /* ---- ABOUT SECTION ---- */
  #tentang {
    background: var(--surface-2);
    padding: 100px 0;
  }

  .section-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: 14px;
  }

  .section-label::before,
  .section-label::after {
    content: '';
    height: 2px;
    width: 24px;
    background: var(--primary);
    border-radius: 2px;
  }

  .section-title {
    font-family: var(--font-display);
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 900;
    color: var(--text-primary);
    line-height: 1.2;
    letter-spacing: -0.5px;
    margin-bottom: 16px;
  }

  .section-desc {
    font-size: 17px;
    color: var(--text-secondary);
    max-width: 540px;
    margin: 0 auto;
    line-height: 1.75;
  }

  .section-head { margin-bottom: 64px; }

  /* Feature Cards */
  .cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .feat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 36px 28px;
    transition: all var(--transition-smooth);
    position: relative;
    overflow: hidden;
  }

  .feat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform var(--transition-smooth);
  }

  .feat-card:hover {
    border-color: var(--primary-light);
    box-shadow: 0 16px 48px rgba(37,99,235,0.12);
    transform: translateY(-6px);
  }

  .feat-card:hover::before { transform: scaleX(1); }

  .card-icon-wrap {
    width: 56px; height: 56px;
    background: linear-gradient(135deg, rgba(37,99,235,0.12), rgba(96,165,250,0.08));
    border: 1px solid rgba(37,99,235,0.15);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    transition: all var(--transition-smooth);
  }

  .feat-card:hover .card-icon-wrap {
    background: var(--primary);
    border-color: var(--primary);
    box-shadow: 0 8px 24px var(--primary-glow);
  }

  .card-icon-wrap i {
    font-size: 22px;
    color: var(--primary);
    transition: color var(--transition-fast);
  }

  .feat-card:hover .card-icon-wrap i { color: #fff; }

  .card-title {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 12px;
  }

  .card-body {
    font-size: 15px;
    color: var(--text-secondary);
    line-height: 1.7;
  }

  .card-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 20px;
    font-size: 14px;
    font-weight: 600;
    color: var(--primary);
    transition: gap var(--transition-smooth);
  }

  .card-link:hover { gap: 10px; }

  /* ---- MAP PREVIEW SECTION ---- */
  #peta {
    padding: 100px 0;
    background: var(--dark-2);
  }

  .map-section-label { color: var(--primary-light); }
  .map-section-label::before,
  .map-section-label::after { background: var(--primary-light); }

  .map-section-title { color: #fff; }
  .map-section-desc  { color: rgba(255,255,255,0.6); }

  #gisMap {
    height: 500px;
    border-radius: var(--radius-xl);
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 24px 64px rgba(0,0,0,0.4);
    position: relative;
  }

  .map-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    color: rgba(255,255,255,0.5);
    font-size: 16px;
    border-radius: var(--radius-xl);
  }

  .map-placeholder i { font-size: 48px; color: var(--primary-light); opacity: 0.6; }

  /* ---- TESTIMONIALS ---- */
  #ulasan {
    padding: 100px 0;
    background: var(--surface);
    overflow: hidden;
  }

  .testimonial-track-wrapper {
    position: relative;
    overflow: hidden;
    padding: 24px 0;
  }

  .testimonial-track {
    display: flex;
    gap: 24px;
    transition: transform var(--transition-smooth);
    will-change: transform;
  }

  .testi-card {
    flex-shrink: 0;
    width: 340px;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px;
    transition: all var(--transition-smooth);
    position: relative;
  }

  .testi-card.center {
    background: var(--primary);
    border-color: var(--primary);
    box-shadow: 0 20px 48px rgba(37,99,235,0.35);
    transform: scale(1.04);
  }

  .testi-card.center .testi-text,
  .testi-card.center .testi-name,
  .testi-card.center .testi-role { color: #fff; }
  .testi-card.center .testi-meta { border-color: rgba(255,255,255,0.2); }
  .testi-card.center .testi-more { color: rgba(255,255,255,0.75); }

  .stars {
    display: flex;
    gap: 3px;
    margin-bottom: 14px;
  }

  .stars i {
    font-size: 16px;
    color: var(--text-muted);
  }

  .stars i.filled { color: var(--star-gold); }

  .testi-text {
    font-size: 15px;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 20px;
  }

  .testi-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
  }

  .avatar {
    width: 44px; height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .avatar i { font-size: 18px; color: #fff; }

  .testi-name {
    font-weight: 700;
    font-size: 15px;
    color: var(--text-primary);
  }

  .testi-role {
    font-size: 13px;
    color: var(--text-muted);
    margin-top: 2px;
  }

  .testi-more {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    color: var(--primary);
    margin-top: 12px;
    font-weight: 600;
    cursor: pointer;
  }

  /* Carousel Controls */
  .carousel-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-top: 40px;
  }

  .carousel-btn {
    width: 48px; height: 48px;
    background: var(--surface-3);
    border: 1px solid var(--border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: var(--text-secondary);
    transition: all var(--transition-smooth);
    cursor: pointer;
  }

  .carousel-btn:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
    box-shadow: 0 4px 16px var(--primary-glow);
    transform: scale(1.1);
  }

  .carousel-dots {
    display: flex;
    gap: 8px;
  }

  .dot {
    width: 8px; height: 8px;
    border-radius: var(--radius-full);
    background: var(--border);
    cursor: pointer;
    transition: all var(--transition-smooth);
  }

  .dot.active {
    width: 24px;
    background: var(--primary);
  }

  /* ---- CALL TO ACTION BAND ---- */
  .cta-band {
    padding: 80px 0;
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 50%, #6366F1 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .cta-band::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><circle cx="30" cy="30" r="1" fill="white" opacity=".15"/></svg>') repeat;
    background-size: 40px 40px;
  }

  .cta-title {
    font-family: var(--font-display);
    font-size: clamp(26px, 3.5vw, 40px);
    font-weight: 900;
    color: #fff;
    margin-bottom: 16px;
    position: relative;
  }

  .cta-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.8);
    margin-bottom: 36px;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
  }

  .btn-cta-white {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 34px;
    background: #fff;
    color: var(--primary-dark);
    border-radius: var(--radius-md);
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    transition: all var(--transition-smooth);
    position: relative;
  }

  .btn-cta-white:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 10px 40px rgba(0,0,0,0.25);
  }

  /* ---- RESPONSIVE ---- */
  @media (max-width: 1024px) {
    .cards-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 768px) {
    .cards-grid { grid-template-columns: 1fr; }
    .hero-title  { font-size: 32px; }
    .hero-stats  { gap: 20px; }
    .testi-card  { width: 280px; }
  }

  @media (max-width: 480px) {
    .hero-actions { flex-direction: column; }
    .btn-primary-hero, .btn-outline-hero { width: 100%; justify-content: center; }
    #gisMap { height: 300px; }
  }
</style>

<!-- ================================================
     SECTION 1 — HERO
================================================ -->
<section id="beranda">
  <!-- Background image -->
  <div class="hero-bg"></div>

  <!-- Glass overlay -->
  <div class="hero-glass-overlay"></div>

  <!-- Floating particles -->
  <div class="hero-particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>

  <!-- Content -->
  <div class="container hero-content">
    <div class="hero-badge">
      <i class="fas fa-satellite-dish"></i>
      <span data-i18n="hero_badge">Sistem Informasi Geografis</span>
    </div>

    <h1 class="hero-title" data-i18n="hero_title">
      Pemetaan Toko Elektronik<br>
      <span class="highlight">Sumatera Utara</span>
    </h1>

    <p class="hero-subtitle" data-i18n="hero_subtitle">
      Mempermudah masyarakat dan pengelola dalam menemukan, mencari,
      serta mengelola data koordinat geografis toko elektronik di seluruh
      wilayah Kota Kisaran, Asahan secara presisi.
    </p>

    <div class="hero-actions">
      <?php if (session()->get('is_logged_in')): ?>
        <a href="#peta" class="btn-primary-hero">
          <i class="fas fa-rocket"></i>
          <span data-i18n="hero_cta1">Coba Sekarang</span>
        </a>
      <?php else: ?>
        <a href="<?php echo base_url('auth/login'); ?>" class="btn-primary-hero">
          <i class="fas fa-rocket"></i>
          <span data-i18n="hero_cta1">Coba Sekarang</span>
        </a>
        <a href="#peta" class="btn-outline-hero">
          <i class="fas fa-map"></i>
          <span data-i18n="hero_cta2">Tampilkan Peta</span>
        </a>
      <?php endif; ?>
    </div>

    <div class="hero-stats">
      <div class="stat-item">
        <div class="stat-value" id="stat-stores">150+</div>
        <div class="stat-label" data-i18n="stat_stores">Toko Terdaftar</div>
      </div>
      <div class="stat-item">
        <div class="stat-value">2</div>
        <div class="stat-label" data-i18n="stat_areas">Kabupaten/Kota</div>
      </div>
      <div class="stat-item">
        <div class="stat-value">100%</div>
        <div class="stat-label" data-i18n="stat_geo">Data Akurat</div>
      </div>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="scroll-indicator">
    <span data-i18n="scroll_down">SCROLL</span>
    <div class="scroll-arrow"><i class="fas fa-chevron-down"></i></div>
  </div>
</section>


<!-- ================================================
     SECTION 2 — TENTANG APLIKASI
================================================ -->
<section id="tentang">
  <div class="container">
    <div class="section-head text-center" data-aos="fade-up">
      <div class="section-label" style="justify-content:center;">
        <span data-i18n="about_label">TENTANG APLIKASI</span>
      </div>
      <h2 class="section-title" data-i18n="about_title">Kenapa Menggunakan ELStore GIS?</h2>
      <p class="section-desc" data-i18n="about_desc">
        Platform ini dirancang khusus untuk pemetaan dan pengelolaan data
        lokasi toko elektronik di Sumatera Utara secara akurat dan real-time.
      </p>
    </div>

    <div class="cards-grid">

      <!-- Card 1 -->
      <div class="feat-card" data-aos="fade-up" data-aos-delay="0">
        <div class="card-icon-wrap">
          <i class="fas fa-map-marked-alt"></i>
        </div>
        <h3 class="card-title" data-i18n="feat1_title">Pemetaan Real-Time</h3>
        <p class="card-body" data-i18n="feat1_body">
          Visualisasikan lokasi toko elektronik secara real-time di atas peta
          interaktif dengan data koordinat yang selalu diperbarui.
        </p>
        <a href="#peta" class="card-link" data-i18n="feat1_link">
          Lihat Peta <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Card 2 -->
      <div class="feat-card" data-aos="fade-up" data-aos-delay="100">
        <div class="card-icon-wrap">
          <i class="fas fa-magnifying-glass-location"></i>
        </div>
        <h3 class="card-title" data-i18n="feat2_title">Pencarian Cerdas</h3>
        <p class="card-body" data-i18n="feat2_body">
          Temukan toko elektronik terdekat dengan filter berdasarkan kategori
          produk, jarak, rating, dan jam operasional dengan mudah.
        </p>
        <a href="<?php echo base_url('toko'); ?>" class="card-link" data-i18n="feat2_link">
          Cari Toko <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Card 3 -->
      <div class="feat-card" data-aos="fade-up" data-aos-delay="200">
        <div class="card-icon-wrap">
          <i class="fas fa-database"></i>
        </div>
        <h3 class="card-title" data-i18n="feat3_title">Manajemen Data</h3>
        <p class="card-body" data-i18n="feat3_body">
          Pengelola dapat menambah, memperbarui, dan menghapus data toko
          beserta koordinat GPS dan informasi lengkap lainnya dengan aman.
        </p>
        <?php if (session()->get('is_logged_in') && session()->get('role') === 'admin'): ?>
          <a href="<?php echo base_url('admin/toko'); ?>" class="card-link" data-i18n="feat3_link">
            Kelola Data <i class="fas fa-arrow-right"></i>
          </a>
        <?php else: ?>
          <a href="#" class="card-link" onclick="showAdminAlert(event)" data-i18n="feat3_link">
            Kelola Data <i class="fas fa-arrow-right"></i>
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>


<!-- ================================================
     SECTION 3 — MAP PREVIEW
================================================ -->
<section id="peta">
  <div class="container">
    <div class="section-head text-center" data-aos="fade-up">
      <div class="section-label map-section-label" style="justify-content:center;">
        <span data-i18n="map_label">PETA INTERAKTIF</span>
      </div>
      <h2 class="section-title map-section-title" data-i18n="map_title">
        Temukan Toko di Peta
      </h2>
      <p class="section-desc map-section-desc" data-i18n="map_desc">
        Jelajahi ratusan toko elektronik di Kota Kisaran dan Asahan
        langsung dari browser Anda.
      </p>
    </div>

    <?php if (session()->get('is_logged_in')): ?>
      <!-- ADVANCED MAP FOR LOGGED IN USERS -->
      <style>
        .map-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }
        .store-mini-card { background: rgba(15,23,42,0.5); border: 1px solid rgba(255,255,255,0.05); border-radius: var(--radius-md); padding: 12px; cursor: pointer; transition: all 0.3s; margin-bottom: 8px; }
        .store-mini-card:hover { background: rgba(37,99,235,0.15); border-color: rgba(96,165,250,0.3); }
        .store-mini-name { font-weight: 700; font-size: 13px; color: #fff; margin-bottom: 3px; }
        .store-mini-cat { font-size: 11px; color: var(--primary-light); margin-bottom: 3px; }
        .store-mini-addr { font-size: 11px; color: rgba(255,255,255,0.6); }
        
        #storeList::-webkit-scrollbar { width: 6px; }
        #storeList::-webkit-scrollbar-track { background: transparent; }
        #storeList::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 10px; }
        @media (max-width: 900px) { .map-layout { grid-template-columns: 1fr !important; } #publicMap { height: 400px !important; } }
      </style>
      
      <div class="peta-controls" style="display:flex;gap:12px;margin-bottom:16px;">
        <select id="pilihWilayah" onchange="gantiWilayah()" style="background:var(--surface);border:1px solid var(--border);color:var(--text-primary);padding:8px 14px;border-radius:var(--radius-sm);font-family:inherit;font-size:13px;outline:none;cursor:pointer;">
          <option value="kisaran">📍 Kota Kisaran, Asahan</option>
          <option value="tanjungbalai">📍 Kota Tanjung Balai</option>
        </select>
        <select id="filterKategori" onchange="filterMap()" style="background:var(--surface);border:1px solid var(--border);color:var(--text-primary);padding:8px 14px;border-radius:var(--radius-sm);font-family:inherit;font-size:13px;outline:none;cursor:pointer;">
          <option value="">Semua Kategori</option>
          <option>Smartphone</option>
          <option>Komputer & Laptop</option>
          <option>Audio & Video</option>
          <option>Peralatan Listrik</option>
          <option>Elektronik Umum</option>
          <option>Apple Authorized</option>
          <option>Gaming</option>
          <option>Kamera & Optik</option>
          <option>Lainnya</option>
        </select>
        <button onclick="resetView()" style="padding:8px 16px;background:rgba(37,99,235,0.1);border:1px solid rgba(37,99,235,0.3);border-radius:var(--radius-sm);color:var(--primary);font-size:13px;cursor:pointer;font-family:inherit;">
          <i class="fas fa-crosshairs"></i> Reset Tampilan
        </button>
      </div>

      <div class="map-layout" data-aos="zoom-in" data-aos-delay="100">
        <div>
          <div id="publicMap" style="height:580px;border-radius:var(--radius-xl);overflow:hidden;border:1px solid var(--border);box-shadow:var(--shadow-md);z-index:1;"></div>
          <p style="font-size:11px;color:var(--text-muted);margin-top:8px;">
            <i class="fas fa-info-circle"></i> Klik marker untuk melihat detail toko.
          </p>
        </div>
        <div style="background:#1E293B;border:1px solid rgba(255,255,255,0.1);border-radius:var(--radius-xl);padding:20px;text-align:left;color:#F8FAFC;">
          <div style="font-family:var(--font-display);font-size:14px;font-weight:700;color:#fff;margin-bottom:12px;display:flex;align-items:center;gap:8px;">
            <i class="fas fa-store" style="color:var(--primary-light);"></i>
            Daftar Toko (<span id="storeCount">0</span>)
          </div>
          <div id="storeList" style="max-height:500px;overflow-y:auto;padding-right:8px;">
            <p style="font-size:13px;color:rgba(255,255,255,0.6);text-align:center;padding:16px;">Memuat data...</p>
          </div>
        </div>
      </div>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        const kisaran = [2.9834, 99.6167];
        const pmap = L.map('publicMap', { center: kisaran, zoom: 13, scrollWheelZoom: false });

        var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { attribution: '© Google Maps', maxZoom: 20 });
        var peta2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });
        var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap', maxZoom: 19 });
        var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 });
        var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', { attribution: 'Map data &copy; ArcGIS' });
        var peta6 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });
        var peta7 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });

        peta3.addTo(pmap);

        const baseLayers = { 'Google': peta1, 'Satellite': peta2, 'OSM': peta3, 'Carto': peta4, 'ESRI': peta5, 'Hybrid': peta6, 'Terrain': peta7 };
        L.control.layers(baseLayers, null, {collapsed: false}).addTo(pmap);

        const storeIcon = (color = '#2563EB') => L.divIcon({
          html: `<div style="background:${color};width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><div style="transform:rotate(45deg);color:#fff;font-size:14px;">🏪</div></div>`,
          iconSize: [32,32], iconAnchor: [16,32], popupAnchor: [0,-36], className: ''
        });

        const catColors = {
          'Smartphone': '#2563EB', 'Komputer & Laptop':'#7C3AED', 'Audio & Video': '#059669',
          'Peralatan Listrik':'#D97706', 'Elektronik Umum': '#0891B2', 'Apple Authorized': '#1D4ED8',
          'Gaming': '#DC2626', 'Kamera & Optik': '#9333EA', 'Lainnya': '#64748B'
        };

        let allStores = [];
        let markers   = [];

        fetch('<?php echo base_url("api/stores"); ?>').then(r => r.json()).then(data => {
            allStores = data.features;
            renderMap(allStores);
        }).catch(() => {
            document.getElementById('storeList').innerHTML = '<p style="color:var(--text-muted);text-align:center;font-size:13px;">Gagal memuat data.</p>';
        });

        function renderMap(features) {
          markers.forEach(m => pmap.removeLayer(m));
          markers = [];
          document.getElementById('storeCount').textContent = features.length;
          const listEl = document.getElementById('storeList');
          listEl.innerHTML = '';
          if (features.length === 0) {
            listEl.innerHTML = '<p style="color:var(--text-muted);text-align:center;font-size:13px;padding:16px;">Tidak ada toko.</p>';
            return;
          }
          features.forEach(f => {
            const p = f.properties; const lngs = f.geometry.coordinates;
            const lat = lngs[1], lng = lngs[0];
            const color = catColors[p.category] || '#2563EB';
            const marker = L.marker([lat, lng], { icon: storeIcon(color) }).addTo(pmap).bindPopup(`
                <div style="font-family:inherit;min-width:210px;">
                  ${p.foto ? `<div style="margin-bottom:10px; border-radius:8px; overflow:hidden; height:120px; background:#f1f5f9;"><img src="<?php echo base_url('foto/'); ?>${p.foto}" style="width:100%;height:100%;object-fit:cover;"></div>` : ''}
                  <div style="font-weight:700;font-size:14px;color:#0F172A;margin-bottom:6px;">${p.name}</div>
                  <span style="font-size:11px;background:#EFF6FF;color:#1D4ED8;padding:2px 8px;border-radius:99px;">${p.category}</span>
                  <div style="margin-top:8px;font-size:12px;color:#475569;">
                    <i class="fas fa-location-dot" style="color:#2563EB;margin-right:4px;"></i>${p.kecamatan || p.address}
                  </div>
                  <div style="margin-top:8px;display:flex;align-items:center;gap:4px;font-size:12px;">
                    <i class="fas fa-star" style="color:#F59E0B;"></i><strong>${p.rating}</strong>
                    <span style="color:#94A3B8;">(${p.total_ulasan} ulasan)</span>
                  </div>
                </div>
              `, { maxWidth: 260 });
            markers.push(marker);
            const li = document.createElement('div');
            li.className = 'store-mini-card';
            li.style.borderLeft = `3px solid ${color}`;
            li.innerHTML = `<div class="store-mini-name">${p.name}</div><div class="store-mini-cat">${p.category}</div><div class="store-mini-addr">${p.kecamatan || p.address}</div>`;
            li.onclick = () => { pmap.setView([lat, lng], 16); marker.openPopup(); };
            listEl.appendChild(li);
          });
        }

        window.filterMap = function() {
          const cat = document.getElementById('filterKategori').value;
          renderMap(cat ? allStores.filter(f => f.properties.category === cat) : allStores);
        };
        window.resetView = function() {
          const w = document.getElementById('pilihWilayah').value;
          pmap.setView(w === 'kisaran' ? kisaran : [2.9649, 99.8016], 13);
          document.getElementById('filterKategori').value = '';
          renderMap(allStores);
        };
        window.gantiWilayah = function() {
          const w = document.getElementById('pilihWilayah').value;
          if (w === 'kisaran') pmap.setView(kisaran, 13);
          if (w === 'tanjungbalai') pmap.setView([2.9649, 99.8016], 13);
        };
      });
      </script>

    <?php else: ?>
      <!-- DEFAULT MAP FOR NON-LOGGED IN USERS -->
      <div id="gisMap" data-aos="zoom-in" data-aos-delay="100">
        <!-- Leaflet Map will be injected here by JS -->
        <div class="map-placeholder">
          <i class="fas fa-spinner fa-spin"></i>
          <span data-i18n="map_loading">Memuat peta…</span>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ================================================
     SECTION 3.5 — TOKO TERDAFTAR (LOGGED IN ONLY)
================================================ -->
<?php if (session()->get('is_logged_in')): ?>
<section id="toko" style="padding: 100px 0; background: var(--surface-2);">
  <div class="container">
    <div class="section-head text-center" data-aos="fade-up">
      <div class="section-label" style="justify-content:center;">
        <span>TOKO TERDAFTAR</span>
      </div>
      <h2 class="section-title">Eksplorasi Toko Elektronik Terbaru</h2>
      <p class="section-desc">Lihat toko-toko terbaru yang telah bergabung di platform kami.</p>
    </div>

    <div class="toko-grid" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;" data-aos="fade-up" data-aos-delay="100">
      <?php if (!empty($recent_stores)): ?>
        <?php foreach ($recent_stores as $st): ?>
          <div class="toko-card" style="background:var(--surface); border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow-md); border:1px solid var(--border); transition:transform 0.3s;">
            <div class="toko-img" style="height: 200px; background: var(--surface-2);">
              <?php if (!empty($st['foto'])): ?>
                <img src="<?php echo base_url('foto/' . $st['foto']); ?>" alt="<?php echo $st['nama_toko']; ?>" style="width:100%; height:100%; object-fit:cover;">
              <?php else: ?>
                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--text-muted); font-size:48px;"><i class="fas fa-store"></i></div>
              <?php endif; ?>
            </div>
            <div class="toko-info" style="padding: 24px;">
              <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                <h3 style="color:var(--text-primary); font-size:18px; font-weight:700; margin:0;"><?php echo $st['nama_toko']; ?></h3>
                <span style="background:rgba(37,99,235,0.1); color:var(--primary); padding:4px 8px; border-radius:4px; font-size:12px; font-weight:600;"><?php echo $st['kategori']; ?></span>
              </div>
              <p style="color:var(--text-secondary); font-size:14px; margin-bottom:16px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                <i class="fas fa-location-dot" style="margin-right:6px; color:var(--primary);"></i><?php echo $st['alamat']; ?>, <?php echo $st['kota']; ?>
              </p>
              <a href="<?php echo base_url('toko/' . $st['id']); ?>" style="display:inline-flex; align-items:center; color:var(--primary); font-size:14px; font-weight:600; transition:color 0.3s;">Lihat Detail <i class="fas fa-arrow-right" style="margin-left:8px; font-size:12px;"></i></a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="grid-column: 1 / -1; text-align:center; color:var(--text-secondary); padding: 40px;">Belum ada toko yang terdaftar.</div>
      <?php endif; ?>
    </div>
    
    <div class="text-center" style="margin-top: 50px;" data-aos="fade-up" data-aos-delay="200">
      <a href="<?php echo base_url('toko'); ?>" class="btn-primary" style="padding: 14px 32px; border-radius: 99px;">Lihat Semua Toko <i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ================================================
     SECTION 4 — TESTIMONIALS
================================================ -->
<section id="ulasan">
  <div class="container">
    <div class="section-head text-center" data-aos="fade-up">
      <div class="section-label" style="justify-content:center;">
        <span data-i18n="testi_label">ULASAN PENGGUNA</span>
      </div>
      <h2 class="section-title" data-i18n="testi_title">
        Pendapat Mereka Tentang Aplikasi Ini!
      </h2>
    </div>

    <div class="testimonial-track-wrapper" data-aos="fade-up" data-aos-delay="100">
      <div style="margin-bottom: 40px;">
        <div style="display:flex; justify-content:center; align-items:center; gap: 15px; flex-wrap:wrap;">
          <div style="font-size: 48px; font-weight: 800; color: var(--dark, #0F172A);"><?php echo $rating_info['avg_rating']; ?></div>
          <div>
            <div class="stars" style="color: #FBBF24; font-size: 20px;">
              <?php 
                $avg = round($rating_info['avg_rating']);
                for($i=1; $i<=5; $i++) {
                  if($i <= $avg) echo '<i class="fas fa-star"></i>';
                  else echo '<i class="far fa-star" style="color:#CBD5E1;"></i>';
                }
              ?>
            </div>
            <div style="color: var(--text-2, #475569); font-size: 14px; font-weight: 500;">Berdasarkan <?php echo $rating_info['total_reviews']; ?> ulasan</div>
          </div>
          
          <?php if(session()->get('is_logged_in')): ?>
            <?php if(empty($user_review)): ?>
              <button onclick="document.getElementById('ratingFormWrapper').style.display='block'" class="btn-primary" style="margin-left:20px; padding: 12px 28px; border-radius:99px; font-weight:600; box-shadow:0 4px 15px rgba(37,99,235,0.4); display:flex; align-items:center; gap:8px;">
                <i class="fas fa-pencil-alt"></i> Tulis Ulasan Anda
              </button>
            <?php endif; ?>
          <?php else: ?>
            <a href="<?php echo base_url('auth/login'); ?>" class="btn-primary" style="margin-left:20px; padding: 10px 20px; border-radius:8px; opacity:0.8;">Login untuk Ulasan</a>
          <?php endif; ?>
        </div>
      </div>

      <?php if(session()->getFlashdata('success')): ?>
        <div style="background: rgba(16,185,129,0.1); color: #10B981; border: 1px solid #10B981; padding: 15px; border-radius: 8px; margin-bottom: 30px; text-align: center;">
          <?php echo session()->getFlashdata('success'); ?>
        </div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('error')): ?>
        <div style="background: rgba(239,68,68,0.1); color: #EF4444; border: 1px solid #EF4444; padding: 15px; border-radius: 8px; margin-bottom: 30px; text-align: center;">
          <?php echo session()->getFlashdata('error'); ?>
        </div>
      <?php endif; ?>

      <?php if(session()->get('is_logged_in') && !empty($user_review)): ?>
      <!-- Kartu Ulasan Anda Sendiri -->
      <div style="max-width: 600px; margin: 0 auto 30px; background: var(--surface); padding: 25px; border-radius: var(--radius-lg); text-align:left; border:1px solid var(--border); box-shadow:var(--shadow-sm); position:relative; overflow:hidden;">
        <div style="position:absolute; top:0; left:0; width:4px; height:100%; background:var(--primary);"></div>
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:15px; flex-wrap:wrap; gap:15px;">
          <div>
            <h4 style="color:var(--text-primary); margin:0 0 5px 0; font-family:var(--font-display); font-size:18px;">Ulasan Anda</h4>
            <div style="color: #FBBF24; font-size: 14px;">
              <?php for($i=1; $i<=5; $i++) echo ($i <= $user_review['rating']) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>'; ?>
            </div>
          </div>
          
          <div style="display:flex; align-items:center; gap:12px; background:var(--surface-2); padding:6px 12px; border-radius:8px; border:1px solid var(--border);">
            <div class="star-trigger" style="display:flex; gap:4px; font-size:18px; cursor:pointer; color:var(--text-muted);">
              <i class="fas fa-star" data-val="1"></i>
              <i class="fas fa-star" data-val="2"></i>
              <i class="fas fa-star" data-val="3"></i>
              <i class="fas fa-star" data-val="4"></i>
              <i class="fas fa-star" data-val="5"></i>
            </div>
            <button onclick="openFormAndSetRating(0)" class="btn-primary" style="padding: 6px 14px; border-radius:6px; font-size:13px; font-weight:600;">Edit Ulasan</button>
          </div>
        </div>
        
        <p style="color:var(--text-secondary); font-size:15px; margin:0; line-height:1.6; font-style:italic;">
          "<?php echo esc($user_review['ulasan']); ?>"
        </p>
      </div>

      <script>
        document.querySelectorAll('.star-trigger i').forEach(star => {
          star.addEventListener('click', function() {
            openFormAndSetRating(this.getAttribute('data-val'));
          });
          star.addEventListener('mouseover', function() {
            let val = this.getAttribute('data-val');
            document.querySelectorAll('.star-trigger i').forEach(s => {
              if (s.getAttribute('data-val') <= val) {
                s.style.color = '#FBBF24';
              } else {
                s.style.color = 'var(--text-muted)';
              }
            });
          });
          star.addEventListener('mouseout', function() {
            document.querySelectorAll('.star-trigger i').forEach(s => {
              s.style.color = 'var(--text-muted)';
            });
          });
        });
        
        function openFormAndSetRating(val) {
          document.getElementById('ratingFormWrapper').style.display = 'block';
          if(val > 0) {
            document.getElementById('ratingValue').value = val;
            if(typeof window.updateFormStars === 'function') {
              window.updateFormStars(val);
            }
          }
        }
      </script>
      <?php else: ?>
      <script>
        function openFormAndSetRating(val) {
          document.getElementById('ratingFormWrapper').style.display = 'block';
        }
      </script>
      <?php endif; ?>

      <!-- Inline Form Like Before -->
      <div id="ratingFormWrapper" style="display:none; max-width: 600px; margin: 0 auto 40px; background: var(--surface); padding: 30px; border-radius: var(--radius-lg); text-align:left; border:1px solid var(--border); box-shadow:var(--shadow-md);">
        <?php 
          $ratingVal = !empty($user_review) ? $user_review['rating'] : 5;
          $ulasanTxt = !empty($user_review) ? $user_review['ulasan'] : '';
        ?>
        <h3 style="color:var(--text-primary); margin-bottom:20px;">
          <?php echo !empty($user_review) ? 'Edit Ulasan Anda' : 'Tulis Ulasan Anda'; ?>
        </h3>
        <form action="<?php echo base_url('submit-rating'); ?>" method="POST">
          <div style="margin-bottom: 15px;">
            <label style="color: var(--text-secondary); display:block; margin-bottom: 8px;">Rating Bintang</label>
            <div class="star-rating" style="display:flex; gap:8px; font-size:28px; cursor:pointer; color:var(--star-gold);">
              <i class="fas fa-star star-btn" data-value="1"></i>
              <i class="fas fa-star star-btn" data-value="2"></i>
              <i class="fas fa-star star-btn" data-value="3"></i>
              <i class="fas fa-star star-btn" data-value="4"></i>
              <i class="fas fa-star star-btn" data-value="5"></i>
            </div>
            <input type="hidden" name="rating" id="ratingValue" value="<?php echo $ratingVal; ?>" required>
            
            <script>
              (function() {
                const stars = document.querySelectorAll('.star-rating .star-btn');
                const ratingInput = document.getElementById('ratingValue');
                
                window.updateFormStars = function(val) {
                  stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= val) {
                      s.classList.remove('far');
                      s.classList.add('fas');
                    } else {
                      s.classList.remove('fas');
                      s.classList.add('far');
                    }
                  });
                };

                // Initialize stars on load
                window.updateFormStars(ratingInput.value);

                stars.forEach(star => {
                  star.addEventListener('click', function() {
                    ratingInput.value = this.getAttribute('data-value');
                    window.updateFormStars(ratingInput.value);
                  });
                  star.addEventListener('mouseover', function() {
                    window.updateFormStars(this.getAttribute('data-value'));
                  });
                });
                
                const starContainer = document.querySelector('.star-rating');
                if (starContainer) {
                  starContainer.addEventListener('mouseout', function() {
                    window.updateFormStars(ratingInput.value);
                  });
                }
              })();
            </script>
          </div>
          <div style="margin-bottom: 20px;">
            <label style="color: var(--text-secondary); display:block; margin-bottom: 8px;">Ulasan / Komentar (Opsional)</label>
            <textarea name="ulasan" rows="3" placeholder="Tuliskan pengalaman Anda..." style="width:100%; padding: 12px; background: var(--surface-2); border: 1px solid var(--border); border-radius: 8px; color: var(--text-primary); outline:none;"><?php echo esc($ulasanTxt); ?></textarea>
          </div>
          <div style="display:flex; gap: 15px; justify-content: flex-end;">
            <button type="button" onclick="document.getElementById('ratingFormWrapper').style.display='none'" style="padding: 10px 20px; background: transparent; color: var(--text-secondary); border: 1px solid var(--border); border-radius:8px; cursor:pointer;">Batal</button>
            <button type="submit" class="btn-primary" style="padding: 10px 20px; border-radius:8px;"><?php echo !empty($user_review) ? 'Simpan Perubahan' : 'Kirim Ulasan'; ?></button>
          </div>
        </form>
      </div>

      <div class="testimonial-track" id="testiTrack">

        <?php if(!empty($recent_ratings)): ?>
          <?php foreach($recent_ratings as $idx => $rating): ?>
          <div class="testi-card <?php echo $idx === 1 || count($recent_ratings) == 1 ? 'center' : ''; ?>">
            <div class="stars">
              <?php 
                for($i=1; $i<=5; $i++) {
                  if($i <= $rating['rating']) echo '<i class="fas fa-star filled"></i>';
                  else echo '<i class="far fa-star"></i>';
                }
              ?>
            </div>
            <p class="testi-text">
              "<?php echo htmlspecialchars($rating['ulasan'] ?? 'Tidak ada komentar'); ?>"
            </p>
            <div class="testi-meta">
              <div class="avatar">
                <?php if(!empty($rating['foto_profil'])): ?>
                  <img src="<?php echo base_url('foto/' . $rating['foto_profil']); ?>" alt="User" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                <?php else: ?>
                  <i class="fas fa-user"></i>
                <?php endif; ?>
              </div>
              <div>
                <div class="testi-name"><?php echo $rating['nama_lengkap']; ?></div>
                <div class="testi-role"><?php echo date('d M Y', strtotime($rating['created_at'])); ?></div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="testi-card center">
            <p class="testi-text">Belum ada ulasan pengguna. Jadilah yang pertama memberikan ulasan!</p>
          </div>
        <?php endif; ?>

      </div><!-- /.testimonial-track -->
    </div>

    <!-- Carousel Controls -->
    <div class="carousel-controls" data-aos="fade-up" data-aos-delay="200">
      <button class="carousel-btn" onclick="testiPrev()" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>
      <div class="carousel-dots" id="testiDots"></div>
      <button class="carousel-btn" onclick="testiNext()" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>


<!-- ================================================
     SECTION 5 — CTA BAND
================================================ -->
<div class="cta-band" data-aos="fade-up">
  <div class="container">
    <h2 class="cta-title" data-i18n="cta_title">
      Siap Menjelajahi Peta GIS?
    </h2>
    <p class="cta-desc" data-i18n="cta_desc">
      Daftarkan toko elektronik Anda atau mulai eksplorasi ribuan toko
      di Sumatera Utara sekarang juga — gratis!
    </p>
    <?php
    $role = session()->get('role');
    $ctaUrl = base_url('auth/register');
    $ctaOnclick = '';
    
    if ($role === 'pemilik_toko') {
        $ctaUrl = base_url('dashboard/toko');
    } elseif ($role === 'admin') {
        $ctaUrl = base_url('admin/toko');
    } elseif (session()->get('is_logged_in')) {
        $ctaUrl = '#';
        $ctaOnclick = 'return showDaftarTokoAlert(event)';
    }
    ?>
    <a href="<?php echo $ctaUrl; ?>" class="btn-cta-white" <?php if($ctaOnclick) echo 'onclick="'.$ctaOnclick.'"'; ?>>
      <i class="fas fa-store"></i>
      <span data-i18n="cta_btn">Daftarkan Toko Anda</span>
    </a>
  </div>
</div>

<style>
.swal-premium-popup { border: 1px solid rgba(255,255,255,0.1); border-radius: 24px !important; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5) !important; padding: 2rem !important; }
.swal-premium-title { font-family: var(--font-display, sans-serif); font-size: 26px !important; font-weight: 800 !important; color: #ffffff !important; letter-spacing: -0.5px; }
.swal-btn-primary { background: linear-gradient(135deg, #2563eb, #3b82f6); color: #fff; border: none; border-radius: 12px; padding: 12px 24px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease; margin: 5px; }
.swal-btn-primary:hover { box-shadow: 0 8px 20px rgba(37,99,235,0.4); transform: translateY(-2px); }
.swal-btn-success { background: linear-gradient(135deg, #059669, #10b981); color: #fff; border: none; border-radius: 12px; padding: 12px 24px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease; margin: 5px; }
.swal-btn-success:hover { box-shadow: 0 8px 20px rgba(16,185,129,0.4); transform: translateY(-2px); }
.swal-btn-secondary { background: transparent; color: #94a3b8; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 12px 24px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease; margin: 5px; }
.swal-btn-secondary:hover { background: rgba(255,255,255,0.05); color: #fff; border-color: rgba(255,255,255,0.2); }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showAdminAlert(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Akses Ditolak',
        html: '<div style="font-size:15px;color:#cbd5e1;line-height:1.7;margin-top:10px;">Fitur <strong style="color:#ffffff;">Kelola Data</strong> hanya diperuntukkan bagi akun <strong style="color:#EF4444;">Administrator</strong>.<br><br>Jika Anda adalah pengelola sistem, silakan login menggunakan akun Admin.</div>',
        background: '#0f172a',
        color: '#f8fafc',
        showCancelButton: true,
        confirmButtonText: 'Login Admin',
        cancelButtonText: 'Batal',
        buttonsStyling: false,
        customClass: {
            popup: 'swal-premium-popup',
            title: 'swal-premium-title',
            confirmButton: 'swal-btn-primary',
            cancelButton: 'swal-btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo base_url("auth/logout?redirect=auth/login"); ?>';
        }
    });
}

function showDaftarTokoAlert(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Akses Ditolak',
        html: '<div style="font-size:15px;color:#cbd5e1;line-height:1.7;margin-top:10px;">Anda saat ini masuk sebagai <strong style="color:#ffffff;">Pengguna Biasa</strong>.<br><br>Untuk mendaftarkan toko ke dalam sistem, Anda harus beralih ke akun <strong style="color:#60A5FA;">Pemilik Toko</strong>. Silakan pilih opsi di bawah ini:</div>',
        background: '#0f172a',
        color: '#f8fafc',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: 'Register Akun',
        denyButtonText: 'Login Pemilik',
        cancelButtonText: 'Batal',
        buttonsStyling: false,
        customClass: {
            popup: 'swal-premium-popup',
            title: 'swal-premium-title',
            confirmButton: 'swal-btn-primary',
            denyButton: 'swal-btn-success',
            cancelButton: 'swal-btn-secondary'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?php echo base_url("auth/logout?redirect=auth/register"); ?>';
        } else if (result.isDenied) {
            window.location.href = '<?php echo base_url("auth/logout?redirect=auth/login"); ?>';
        }
    });
    return false;
}
</script>

