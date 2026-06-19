<?php /* ELStore GIS — Landing Page Redesign (visionOS Glassmorphism Style) */ ?>

<style>
/* ================================================================
   VISION OS GLASSMORPHISM DESIGN SYSTEM
   ELStore GIS — Redesigned Landing Page
================================================================ */

/* ---- FORCE DARK BODY (override header white background) ---- */
html, body {
  background-color: #05060f !important;
  color: #f3f4f6 !important;
}

/* ---- RESET & BASE ---- */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ---- ROOT DESIGN TOKENS ---- */
:root {
  /* Core Palette */
  --void:           #05060f;
  --deep:           #080c18;
  --surface-0:      #0d1120;
  --surface-1:      rgba(255,255,255,0.04);
  --surface-2:      rgba(255,255,255,0.07);
  --surface-3:      rgba(255,255,255,0.10);
  --surface-hover:  rgba(255,255,255,0.13);

  /* Glass borders */
  --glass-stroke:   rgba(255,255,255,0.09);
  --glass-stroke-2: rgba(255,255,255,0.16);
  --glass-stroke-3: rgba(255,255,255,0.30);

  /* Glow Colors */
  --glow-blue:    #60a5fa;
  --glow-indigo:  #818cf8;
  --glow-violet:  #a78bfa;
  --glow-teal:    #2dd4bf;
  --glow-rose:    #fb7185;

  /* Semantic */
  --accent:         #60a5fa;
  --accent-2:       #818cf8;
  --accent-glow:    rgba(96,165,250,0.25);

  /* Text */
  --text-1: #f8fafc;
  --text-2: #cbd5e1;
  --text-3: #64748b;
  --text-4: #334155;

  /* Radius */
  --r-sm:   10px;
  --r-md:   16px;
  --r-lg:   24px;
  --r-xl:   32px;
  --r-2xl:  40px;
  --r-full: 9999px;

  /* Blur */
  --blur-sm:  blur(8px);
  --blur-md:  blur(16px);
  --blur-lg:  blur(32px);
  --blur-xl:  blur(60px);

  /* Font */
  --font-display: 'Outfit', sans-serif;
  --font-body:    'Space Grotesk', sans-serif;

  /* Transitions */
  --ease:     cubic-bezier(0.4, 0, 0.2, 1);
  --ease-out: cubic-bezier(0, 0, 0.2, 1);
  --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
  --t-fast:   0.15s;
  --t-base:   0.25s;
  --t-slow:   0.45s;
}

/* ================================================================
   AMBIENT GLOW ORBS (Background Decoration)
================================================================ */
.orb {
  position: fixed;
  border-radius: 50%;
  filter: var(--blur-xl);
  pointer-events: none;
  z-index: 0;
  will-change: transform;
  animation: orb-drift 20s ease-in-out infinite alternate;
}
.orb-1 {
  width: 600px; height: 600px;
  top: -200px; left: -200px;
  background: radial-gradient(circle, rgba(96,165,250,0.18) 0%, transparent 70%);
  animation-delay: 0s;
}
.orb-2 {
  width: 500px; height: 500px;
  top: 30%; right: -150px;
  background: radial-gradient(circle, rgba(167,139,250,0.16) 0%, transparent 70%);
  animation-delay: -7s;
}
.orb-3 {
  width: 700px; height: 700px;
  bottom: -200px; left: 30%;
  background: radial-gradient(circle, rgba(45,212,191,0.12) 0%, transparent 70%);
  animation-delay: -14s;
}
@keyframes orb-drift {
  0%   { transform: translate(0,0) scale(1); }
  100% { transform: translate(40px, 30px) scale(1.1); }
}

/* ================================================================
   SECTION SPACING & LAYOUT
================================================================ */
.lp-section {
  position: relative;
  z-index: 2;
  padding: 120px 0;
}
.lp-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 32px;
}

/* ================================================================
   TYPOGRAPHY HELPERS
================================================================ */
.tag-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  background: rgba(96,165,250,0.08);
  border: 1px solid rgba(96,165,250,0.25);
  border-radius: var(--r-full);
  color: var(--glow-blue);
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  backdrop-filter: var(--blur-sm);
}
.heading-xl {
  font-family: var(--font-display);
  font-size: clamp(48px, 6vw, 80px);
  font-weight: 900;
  color: var(--text-1);
  line-height: 1.05;
  letter-spacing: -2px;
}
.heading-lg {
  font-family: var(--font-display);
  font-size: clamp(32px, 4vw, 52px);
  font-weight: 900;
  color: var(--text-1);
  line-height: 1.15;
  letter-spacing: -1.5px;
}
.text-gradient-blue {
  background: linear-gradient(135deg, var(--glow-blue) 0%, var(--glow-violet) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.body-lg { font-size: 18px; color: var(--text-2); line-height: 1.8; }
.body-md { font-size: 16px; color: var(--text-3); line-height: 1.7; }

/* ================================================================
   GLASS CARD COMPONENT
================================================================ */
.glass {
  background: var(--surface-1);
  border: 1px solid var(--glass-stroke);
  border-radius: var(--r-lg);
  backdrop-filter: var(--blur-md);
  -webkit-backdrop-filter: var(--blur-md);
  transition: background var(--t-base) var(--ease),
              border-color var(--t-base) var(--ease),
              transform var(--t-slow) var(--ease-spring),
              box-shadow var(--t-base) var(--ease);
}
.glass:hover {
  background: var(--surface-2);
  border-color: var(--glass-stroke-2);
  transform: translateY(-6px);
  box-shadow: 0 24px 48px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05);
}
.glass-elevated {
  background: var(--surface-2);
  border: 1px solid var(--glass-stroke-2);
  border-radius: var(--r-xl);
  backdrop-filter: var(--blur-lg);
  -webkit-backdrop-filter: var(--blur-lg);
  box-shadow: 0 32px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.08);
}

/* Sheen sweep effect on glass cards */
.glass-sheen {
  position: relative;
  overflow: hidden;
}
.glass-sheen::after {
  content: '';
  position: absolute;
  top: -50%; left: -60%;
  width: 40%; height: 200%;
  background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.04) 50%, transparent 60%);
  transform: skewX(-20deg);
  transition: left 0.7s var(--ease);
}
.glass-sheen:hover::after { left: 130%; }

/* ================================================================
   SECTION 1 — HERO
================================================================ */
#beranda {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: var(--void);
}

/* Background photo */
.hero-bg-photo {
  position: absolute;
  inset: 0;
  background-image: url('<?= base_url("public/gambar/map_dark.png"); ?>');
  background-size: cover;
  background-position: center;
  transform: scale(1.06);
  transition: transform 10s var(--ease-out);
  z-index: 0;
}
#beranda:hover .hero-bg-photo { transform: scale(1.00); }

/* Multi-layer overlay for depth */
.hero-overlay-1 {
  position: absolute; inset: 0; z-index: 1;
  background: radial-gradient(ellipse 80% 60% at 30% 40%,
    rgba(96,165,250,0.08) 0%, transparent 60%);
}
.hero-overlay-2 {
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(180deg,
    rgba(5,6,15,0.3) 0%,
    rgba(5,6,15,0.6) 60%,
    rgba(5,6,15,1) 100%);
}
.hero-overlay-3 {
  position: absolute; inset: 0; z-index: 1;
  background: linear-gradient(90deg,
    rgba(5,6,15,0.5) 0%,
    transparent 60%);
}

/* Scanline Texture */
.hero-scanlines {
  position: absolute; inset: 0; z-index: 2;
  background-image: repeating-linear-gradient(
    0deg,
    rgba(255,255,255,0.015) 0px,
    rgba(255,255,255,0.015) 1px,
    transparent 1px,
    transparent 3px
  );
  pointer-events: none;
}

.hero-content-wrap {
  position: relative;
  z-index: 10;
  max-width: 1000px;
  width: 100%;
  padding: 0px;
  padding-top: 100px;
  padding-bottom: 120px;
}

/* Animated entry */
.anim-in { animation: anim-in 0.9s var(--ease) both; }
.anim-in-d1 { animation-delay: 0.1s; }
.anim-in-d2 { animation-delay: 0.25s; }
.anim-in-d3 { animation-delay: 0.4s; }
.anim-in-d4 { animation-delay: 0.55s; }
.anim-in-d5 { animation-delay: 0.7s; }
@keyframes anim-in {
  from { opacity: 0; transform: translateY(28px) scale(0.98); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* Hero CTA Buttons */
.hero-btns {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}
.btn-vision-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 36px;
  background: rgba(255,255,255,0.12);
  color: var(--text-1);
  border: 1px solid rgba(255,255,255,0.25);
  border-radius: var(--r-full);
  font-family: var(--font-display);
  font-size: 15px;
  font-weight: 700;
  backdrop-filter: var(--blur-md);
  -webkit-backdrop-filter: var(--blur-md);
  transition: all var(--t-base) var(--ease-spring);
  box-shadow: 0 4px 24px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.12);
}
.btn-vision-primary:hover {
  background: rgba(255,255,255,0.2);
  border-color: rgba(255,255,255,0.4);
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 8px 32px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.18);
}
.btn-vision-accent {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 36px;
  background: linear-gradient(135deg, rgba(96,165,250,0.3), rgba(167,139,250,0.25));
  color: var(--text-1);
  border: 1px solid rgba(96,165,250,0.4);
  border-radius: var(--r-full);
  font-family: var(--font-display);
  font-size: 15px;
  font-weight: 700;
  backdrop-filter: var(--blur-md);
  -webkit-backdrop-filter: var(--blur-md);
  transition: all var(--t-base) var(--ease-spring);
  box-shadow: 0 4px 24px rgba(96,165,250,0.15), inset 0 1px 0 rgba(255,255,255,0.1);
}
.btn-vision-accent:hover {
  background: linear-gradient(135deg, rgba(96,165,250,0.45), rgba(167,139,250,0.4));
  border-color: rgba(96,165,250,0.6);
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 8px 32px rgba(96,165,250,0.3), inset 0 1px 0 rgba(255,255,255,0.15);
}

/* Hero stats bar */
.hero-stats-glass {
  display: flex;
  align-items: center;
  gap: 0;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: var(--r-full);
  backdrop-filter: var(--blur-md);
  -webkit-backdrop-filter: var(--blur-md);
  overflow: hidden;
  margin-top: 44px;
  width: fit-content;
}
.stat-pill {
  padding: 14px 32px;
  text-align: center;
  position: relative;
}
.stat-pill:not(:last-child)::after {
  content: '';
  position: absolute;
  right: 0; top: 25%; height: 50%;
  width: 1px;
  background: rgba(255,255,255,0.12);
}
.stat-pill .num {
  font-family: var(--font-display);
  font-size: 22px;
  font-weight: 900;
  color: var(--text-1);
  display: block;
  line-height: 1;
  margin-bottom: 4px;
}
.stat-pill .lbl {
  font-size: 11px;
  color: var(--text-3);
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: 600;
}

/* Scroll pill */
.scroll-pill {
  position: absolute;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 6;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  animation: scroll-bounce 2.5s ease infinite;
  pointer-events: none;
}
.scroll-pill .pill-ring {
  width: 44px; height: 44px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255,255,255,0.5);
  font-size: 14px;
  backdrop-filter: var(--blur-sm);
}
.scroll-pill .pill-text {
  font-size: 10px;
  color: rgba(255,255,255,0.35);
  text-transform: uppercase;
  letter-spacing: 3px;
}
@keyframes scroll-bounce {
  0%, 100% { transform: translateX(-50%) translateY(0); }
  50%       { transform: translateX(-50%) translateY(10px); }
}

/* ================================================================
   SECTION 3.5 — SHOWCASE GRID CSS
================================================================ */
.showcase-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
}

.showcase-card {
  display: flex;
  flex-direction: column;
  background: var(--surface-1);
  border: 1px solid var(--glass-stroke);
  border-radius: var(--r-xl);
  overflow: hidden;
  backdrop-filter: var(--blur-md);
  -webkit-backdrop-filter: var(--blur-md);
  transition: all var(--t-base) var(--ease-spring);
}
.showcase-card:hover {
  background: var(--surface-2);
  border-color: var(--glass-stroke-2);
  transform: translateY(-8px);
  box-shadow: 0 24px 48px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.1);
}

.showcase-img {
  position: relative;
  width: 100%;
  height: 220px;
  background: #0f172a;
  overflow: hidden;
}
.showcase-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--t-slow) var(--ease);
}
.showcase-card:hover .showcase-img img {
  transform: scale(1.05);
}
.img-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(0deg, rgba(5,6,15,1) 0%, rgba(5,6,15,0) 50%);
  pointer-events: none;
}

.showcase-body {
  padding: 24px;
  display: flex;
  flex-direction: column;
  flex: 1;
}
.showcase-cat {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--glow-blue);
  margin-bottom: 8px;
}
.showcase-name {
  font-family: var(--font-display);
  font-size: 20px;
  font-weight: 800;
  color: var(--text-1);
  margin-bottom: 12px;
  line-height: 1.3;
}
.showcase-addr {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 13px;
  color: var(--text-2);
  line-height: 1.6;
  margin-bottom: 24px;
}
.showcase-link {
  margin-top: auto;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  color: var(--text-1);
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  padding: 12px 20px;
  border-radius: var(--r-full);
  width: fit-content;
  transition: all var(--t-base) var(--ease);
}
.showcase-link:hover {
  background: var(--glow-blue);
  color: #0f172a;
  border-color: var(--glow-blue);
  box-shadow: 0 4px 16px rgba(96,165,250,0.4);
}

/* ================================================================
   SECTION 2 — ABOUT / FEATURES
================================================================ */
#tentang {
  background: #05060f;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

.feat-glass {
  background: var(--surface-1);
  border: 1px solid var(--glass-stroke);
  border-radius: var(--r-lg);
  padding: 36px;
  position: relative;
  overflow: hidden;
  backdrop-filter: var(--blur-md);
  transition: all var(--t-slow) var(--ease-spring);
}
.feat-glass::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg,
    transparent 0%, rgba(255,255,255,0.15) 50%, transparent 100%);
}
.feat-glass::after {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle 180px at var(--mx,50%) var(--my,0%),
    rgba(96,165,250,0.06) 0%, transparent 60%);
  opacity: 0;
  transition: opacity var(--t-base) var(--ease);
  pointer-events: none;
}
.feat-glass:hover {
  background: var(--surface-2);
  border-color: var(--glass-stroke-2);
  transform: translateY(-8px);
  box-shadow: 0 28px 56px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.06);
}
.feat-glass:hover::after { opacity: 1; }

/* Icon Orb */
.icon-orb {
  width: 60px; height: 60px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 24px;
  position: relative;
  background: var(--surface-2);
  border: 1px solid var(--glass-stroke-2);
}
.icon-orb::before {
  content: '';
  position: absolute;
  inset: -1px;
  border-radius: 19px;
  background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
  z-index: -1;
}
.icon-orb.blue  { box-shadow: 0 0 24px rgba(96,165,250,0.25); }
.icon-orb.violet { box-shadow: 0 0 24px rgba(167,139,250,0.25); }
.icon-orb.teal  { box-shadow: 0 0 24px rgba(45,212,191,0.25); }

.feat-title {
  font-family: var(--font-display);
  font-size: 20px;
  font-weight: 800;
  color: var(--text-1);
  margin-bottom: 12px;
}
.feat-body { font-size: 15px; color: var(--text-3); line-height: 1.7; }
.feat-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 24px;
  font-size: 13px;
  font-weight: 700;
  color: var(--glow-blue);
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: gap var(--t-base) var(--ease);
}
.feat-link:hover { gap: 10px; }
</style>

<!-- ================================================================
     SECTION 1 — HERO
================================================================ -->
<section id="beranda">
  <!-- Background & Overlays -->
  <div class="hero-bg-photo"></div>
  <div class="hero-overlay-1"></div>
  <div class="hero-overlay-2"></div>
  <div class="hero-overlay-3"></div>
  <div class="hero-scanlines"></div>

  <!-- Content -->
  <div class="hero-content-wrap">
    <div class="tag-pill anim-in" style="margin-bottom:24px;">
      <i class="fas fa-satellite-dish"></i> Sistem Informasi Geografis
    </div>
    
    <h1 class="heading-xl anim-in anim-in-d1" style="margin-bottom:20px;">
      Pemetaan Toko Elektronik<br>
      <span class="text-gradient-blue">Sumatera Utara</span>
    </h1>
    
    <p class="body-lg anim-in anim-in-d2" style="margin-bottom:40px; max-width:600px;">
      Mempermudah masyarakat dan pengelola dalam menemukan, mencari,
      serta mengelola data koordinat geografis toko elektronik di seluruh
      wilayah Provinsi Sumatera Utara secara presisi.
    </p>

    <div class="hero-btns anim-in anim-in-d3">
      <?php if (session()->get('is_logged_in')): ?>
        <a href="#peta" class="btn-vision-accent">
          <i class="fas fa-rocket"></i> Coba Sekarang
        </a>
      <?php else: ?>
        <a href="<?= base_url('auth/login') ?>" class="btn-vision-accent">
          <i class="fas fa-rocket"></i> Coba Sekarang
        </a>
        <a href="#peta" class="btn-vision-primary">
          <i class="fas fa-map"></i> Tampilkan Peta
        </a>
      <?php endif; ?>
    </div>

    <!-- Stats -->
    <div class="hero-stats-glass anim-in anim-in-d4">
      <div class="stat-pill">
        <span class="num" id="stat-stores"><?= $total_stores ?? '150' ?>+</span>
        <span class="lbl">Toko Terdaftar</span>
      </div>
      <div class="stat-pill">
        <span class="num"><?= $total_cities ?? '2' ?></span>
        <span class="lbl">Kabupaten/Kota</span>
      </div>
      <div class="stat-pill">
        <span class="num">100%</span>
        <span class="lbl">Data Akurat</span>
      </div>
    </div>
  </div>

  <!-- Scroll Down Indicator -->
  <a href="#tentang" class="scroll-pill anim-in anim-in-d5">
    <div class="pill-ring"><i class="fas fa-chevron-down"></i></div>
    <span class="pill-text">Scroll</span>
  </a>
</section>

<!-- ================================================================
     SECTION 2 — ABOUT / FEATURES
================================================================ -->
<section id="tentang" class="lp-section">
  <div class="lp-container">
    <div class="text-center" style="margin-bottom:60px;" data-aos="fade-up">
      <div class="tag-pill" style="margin-bottom:20px; background:rgba(167,139,250,0.08); border-color:rgba(167,139,250,0.3); color:var(--glow-violet);">
        <i class="fas fa-info-circle"></i> Tentang Aplikasi
      </div>
      <h2 class="heading-lg" style="margin-bottom:16px;">Kenapa Menggunakan ELStore GIS?</h2>
      <p class="body-lg" style="max-width:600px; margin:0 auto;">
        Platform ini dirancang khusus untuk pemetaan dan pengelolaan data
        lokasi toko elektronik di Sumatera Utara secara akurat dan real-time.
      </p>
    </div>

    <div class="features-grid">
      <!-- Feature 1 -->
      <div class="feat-glass" data-aos="fade-up" data-aos-delay="0">
        <div class="icon-orb blue"><i class="fas fa-map-marked-alt" style="color:var(--glow-blue)"></i></div>
        <h3 class="feat-title">Pemetaan Real-Time</h3>
        <p class="feat-body">
          Visualisasikan lokasi toko elektronik secara real-time di atas peta
          interaktif dengan data koordinat yang selalu diperbarui.
        </p>
        <a href="#peta" class="feat-link">
          Lihat Peta <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Feature 2 -->
      <div class="feat-glass" data-aos="fade-up" data-aos-delay="100">
        <div class="icon-orb violet"><i class="fas fa-magnifying-glass-location" style="color:var(--glow-violet)"></i></div>
        <h3 class="feat-title">Pencarian Cerdas</h3>
        <p class="feat-body">
          Temukan toko elektronik terdekat dengan filter berdasarkan kategori
          produk, jarak, rating, dan jam operasional dengan mudah.
        </p>
        <a href="<?= base_url('toko') ?>" class="feat-link" style="color:var(--glow-violet)">
          Cari Toko <i class="fas fa-arrow-right"></i>
        </a>
      </div>

      <!-- Feature 3 -->
      <div class="feat-glass" data-aos="fade-up" data-aos-delay="200">
        <div class="icon-orb teal"><i class="fas fa-database" style="color:var(--glow-teal)"></i></div>
        <h3 class="feat-title">Manajemen Data</h3>
        <p class="feat-body">
          Pengelola dapat menambah, memperbarui, dan menghapus data toko
          beserta koordinat GPS dan informasi lengkap lainnya dengan aman.
        </p>
        <?php if (session()->get('is_logged_in') && session()->get('role') === 'admin'): ?>
          <a href="<?= base_url('admin/toko') ?>" class="feat-link" style="color:var(--glow-teal)">
            Kelola Data <i class="fas fa-arrow-right"></i>
          </a>
        <?php else: ?>
          <a href="#" class="feat-link" style="color:var(--glow-teal)" onclick="return showAdminAlert(event)">
            Kelola Data <i class="fas fa-arrow-right"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ================================================================
     SECTION 3 — MAP PREVIEW
================================================================ -->
<style>
  #peta { background: #080c18; border-top: 1px solid rgba(255,255,255,0.06); }

  /* Controls bar above map */
  .map-topbar { display:flex; align-items:center; gap:12px; margin-bottom:16px; flex-wrap:wrap; }
  .map-topbar select {
    background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); color: #f8fafc;
    padding: 10px 16px; border-radius: 10px; font-family: inherit; font-size: 14px;
    font-weight: 500; outline: none; cursor: pointer; min-width: 180px;
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
  }
  .map-topbar select:hover { border-color: rgba(96,165,250,0.5); }
  .map-topbar select option { background: #0f172a; color: #f8fafc; }
  
  .btn-reset-map {
    display:inline-flex; align-items:center; gap:8px;
    padding:10px 20px; background: rgba(96,165,250,0.15); color: #60a5fa; 
    border: 1px solid rgba(96,165,250,0.3);
    border-radius:10px; font-family:inherit; font-size:14px; font-weight:600;
    cursor:pointer; transition:all 0.2s; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
  }
  .btn-reset-map:hover { background: rgba(96,165,250,0.25); border-color: rgba(96,165,250,0.5); }

  /* Map + Sidebar layout */
  .map-layout-grid {
    display:grid; grid-template-columns:1fr 280px;
    border-radius:16px; overflow:hidden;
    border:1px solid rgba(255,255,255,0.1);
    box-shadow:0 24px 64px rgba(0,0,0,0.5);
    background: rgba(15,23,42,0.6);
    backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
  }
  #gisMapAuth { height:520px; z-index:1; }
  #gisMapGuest { height:500px; z-index:1; }
  
  /* Sidebar Daftar Toko */
  .map-store-sidebar {
    background: rgba(15,23,42,0.5); display:flex; flex-direction:column;
    padding:0; border-left:1px solid rgba(255,255,255,0.08); height:520px;
  }
  .sidebar-header {
    padding:18px 20px; border-bottom:1px solid rgba(255,255,255,0.08);
    display:flex; align-items:center; gap:10px;
    font-family:var(--font-display); font-size:15px; font-weight:800;
    color:#f8fafc; background: transparent; flex-shrink:0;
  }
  .sidebar-header i { color:#60a5fa; font-size:16px; }
  .sidebar-count {
    margin-left:auto; background:rgba(96,165,250,0.15);
    border:1px solid rgba(96,165,250,0.3); color:#60a5fa;
    border-radius:99px; padding:2px 12px; font-size:13px; font-weight:700;
  }
  .sidebar-list { flex:1; overflow-y:auto; padding:12px; }
  .sidebar-list::-webkit-scrollbar { width:4px; }
  .sidebar-list::-webkit-scrollbar-track { background:transparent; }
  .sidebar-list::-webkit-scrollbar-thumb { background:#2563eb; border-radius:4px; }
  .store-card-sidebar {
    background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.06);
    border-radius:10px; padding:12px 14px; margin-bottom:8px; cursor:pointer;
    transition:all 0.2s ease; border-left:3px solid transparent;
  }
  .store-card-sidebar:hover {
    background:rgba(96,165,250,0.08); border-color:rgba(96,165,250,0.3);
    border-left-color:#60a5fa; transform:translateX(3px);
  }
  .store-card-name { font-weight:700; font-size:13px; color:#f8fafc; margin-bottom:3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  .store-card-cat  { font-size:11px; font-weight:600; margin-bottom:3px; }
  .store-card-loc  { font-size:11px; color:#94a3b8; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
  
  /* Leaflet popup overrides — Dark VisionOS style */
  .leaflet-popup-content-wrapper {
    background: rgba(13,17,32,0.95) !important; color: #f8fafc !important;
    border-radius: 14px !important; box-shadow: 0 16px 40px rgba(0,0,0,0.6) !important;
    border: 1px solid rgba(255,255,255,0.15) !important; padding: 0 !important; overflow: hidden;
    backdrop-filter: blur(16px) !important; -webkit-backdrop-filter: blur(16px) !important;
  }
  .leaflet-popup-content { margin:0 !important; min-width:220px !important; }
  .leaflet-popup-tip { background: rgba(13,17,32,0.95) !important; }
  .leaflet-popup-close-button { color: #94a3b8 !important; font-size:20px !important; top:8px !important; right:10px !important; z-index:10 !important; }
  
  .leaflet-control-layers {
    background: rgba(13,17,32,0.9) !important;
    border: 1px solid rgba(255,255,255,0.15) !important;
    color: #f8fafc !important;
    border-radius: 10px !important;
    backdrop-filter: blur(10px) !important;
  }
  
  /* Guest map */
  .map-guest-frame { border-radius:16px; overflow:hidden; border:1px solid rgba(255,255,255,0.1); box-shadow:0 24px 64px rgba(0,0,0,0.5); position:relative; }
  .map-login-banner {
    position:absolute; bottom:16px; left:50%; transform:translateX(-50%);
    z-index:1000; background:rgba(13,17,32,0.85); backdrop-filter:blur(16px);
    border:1px solid rgba(96,165,250,0.3); border-radius:50px; padding:10px 24px;
    display:flex; align-items:center; gap:12px; box-shadow:0 8px 32px rgba(0,0,0,0.4); white-space:nowrap;
  }
  .map-login-banner span { font-size:13px; font-weight:600; color:#f8fafc; }
  .map-login-banner a { font-size:13px; font-weight:700; color:#0f172a; background:#60a5fa; padding:6px 16px; border-radius:50px; transition:background 0.2s; }
  .map-login-banner a:hover { background:#3b82f6; }
  
  @media (max-width:900px) {
    .map-layout-grid { grid-template-columns:1fr; }
    .map-store-sidebar { height:240px; border-left:none; border-top:1px solid rgba(255,255,255,0.08); }
    #gisMapAuth { height:380px; }
  }
</style>

<section id="peta" class="lp-section">
  <div class="lp-container">
    <div class="text-center" style="margin-bottom:48px;" data-aos="fade-up">
      <div class="tag-pill" style="margin-bottom:20px;background:rgba(45,212,191,0.08);border-color:rgba(45,212,191,0.3);color:var(--glow-teal);">
        <i class="fas fa-map-location-dot"></i> Peta Interaktif
      </div>
      <h2 class="heading-lg" style="margin-bottom:16px;">Temukan Toko di Peta</h2>
      <p class="body-lg" style="max-width:480px;margin:0 auto;">
        Jelajahi toko elektronik di Kota Kisaran &amp; Tanjung Balai langsung dari browser Anda.
      </p>
    </div>

    <?php if (session()->get('is_logged_in')): ?>
    <!-- Controls Bar -->
    <div class="map-topbar" data-aos="fade-up">
      <select id="pilihWilayah" onchange="gantiWilayah()">
        <option value="kisaran">Kota Kisaran, Asahan</option>
        <option value="tanjungbalai">Kota Tanjung Balai</option>
      </select>
      <select id="filterKategori" onchange="filterMap()">
        <option value="">Semua Kategori</option>
        <option>Smartphone</option>
        <option>Komputer &amp; Laptop</option>
        <option>Audio &amp; Video</option>
        <option>Peralatan Listrik</option>
        <option>Elektronik Umum</option>
        <option>Apple Authorized</option>
        <option>Gaming</option>
        <option>Kamera &amp; Optik</option>
        <option>Lainnya</option>
      </select>
      <button onclick="resetView()" class="btn-reset-map">
        <i class="fas fa-crosshairs"></i> <span>Reset Tampilan</span>
      </button>
    </div>

    <!-- Map + Sidebar -->
    <div class="map-layout-grid" data-aos="fade-up" data-aos-delay="100">
      <div id="gisMapAuth"></div>
      <div class="map-store-sidebar">
        <div class="sidebar-header">
          <i class="fas fa-store"></i>
          <span>Daftar Toko</span>
          <span class="sidebar-count" id="storeCount">0</span>
        </div>
        <div class="sidebar-list" id="storeList">
          <p style="color:#64748b;text-align:center;font-size:13px;padding:20px 0;">Memuat data...</p>
        </div>
      </div>
    </div>
    <p style="text-align:center;margin-top:14px;font-size:13px;color:#64748b;">
      <i class="fas fa-info-circle" style="color:var(--glow-blue);margin-right:6px;"></i>
      Klik marker untuk melihat detail toko.
    </p>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const kisaran = [2.9834, 99.6167], tanjungbalai = [2.9649, 99.8016];
      const pmap = L.map('gisMapAuth', { center: kisaran, zoom: 13, scrollWheelZoom: false });
      
      /* Dark mode map tiles */
      var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { attribution:'CartoDB', maxZoom:19 });
      var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',             { attribution:'Google Maps', maxZoom:20 });
      var peta2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',             { maxZoom:20, subdomains:['mt0','mt1','mt2','mt3'] });
      var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',              { attribution:'OpenStreetMap', maxZoom:19 });
      
      dark.addTo(pmap); /* Dark default */
      L.control.layers({'Dark':dark, 'OSM':peta3, 'Satellite':peta2, 'Google':peta1},{},{collapsed:false}).addTo(pmap);
      
      const catColors = {
        'Smartphone':'#60a5fa','Komputer & Laptop':'#a78bfa','Audio & Video':'#2dd4bf',
        'Peralatan Listrik':'#fbbf24','Elektronik Umum':'#f472b6','Apple Authorized':'#4ade80',
        'Gaming':'#f87171','Kamera & Optik':'#e879f9','Lainnya':'#94a3b8'
      };
      
      /* Glowing marker */
      const mkIcon = c => L.divIcon({
        html: `<div style="width:16px;height:16px;border-radius:50%;background:${c};border:2px solid rgba(255,255,255,0.8);box-shadow:0 0 12px ${c}, 0 0 24px ${c}66;"></div>`,
        iconSize:[16,16], iconAnchor:[8,8], popupAnchor:[0,-10], className:''
      });
      
      /* Store Pin marker (for OSM) */
      const storePinIcon = c => L.divIcon({
        html: `<div style="background:${c};width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 3px 6px rgba(0,0,0,0.4);position:relative;">
                 <i class="fas fa-store" style="color:#fff;font-size:12px;"></i>
                 <div style="position:absolute;bottom:-6px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid ${c};"></div>
               </div>`,
        iconSize:[28,34], iconAnchor:[14,34], popupAnchor:[0,-34], className:''
      });
      
      let allStores=[], markers=[], currentIsOsm=false;
      
      pmap.on('baselayerchange', function(e) {
        currentIsOsm = (e.name === 'OSM');
        markers.forEach(obj => obj.m.setIcon(currentIsOsm ? storePinIcon(obj.col) : mkIcon(obj.col)));
      });

      fetch('<?= base_url("api/stores") ?>').then(r=>r.json()).then(data=>{ allStores=data.features; renderMap(allStores); }).catch(()=>{
        document.getElementById('storeList').innerHTML='<p style="color:#64748b;text-align:center;font-size:13px;padding:16px;">Gagal memuat data.</p>';
      });
      
      function renderMap(features){
        markers.forEach(obj=>pmap.removeLayer(obj.m)); markers=[];
        document.getElementById('storeCount').textContent=features.length;
        const list=document.getElementById('storeList'); list.innerHTML='';
        if(!features.length){ list.innerHTML='<p style="color:#64748b;text-align:center;font-size:13px;padding:16px;">Tidak ada toko.</p>'; return; }
        
        features.forEach(f=>{
          const p=f.properties, [lng,lat]=f.geometry.coordinates, col=catColors[p.category]||'#60a5fa';
          const popup = '<div style="min-width:230px;font-family:inherit;">'
            +(p.foto?'<div style="height:120px;overflow:hidden;border-radius:14px 14px 0 0;"><img src="<?= base_url("foto/") ?>'+p.foto+'" style="width:100%;height:100%;object-fit:cover;"></div>':'')
            +'<div style="padding:14px 16px;">'
            +'<div style="font-weight:800;font-size:15px;color:#f8fafc;margin-bottom:8px;">'+p.name+'</div>'
            +'<a href="<?= base_url("toko/") ?>'+p.id+'" style="font-size:11px;font-weight:700;color:'+col+';background:'+col+'22;border:1px solid '+col+'44;padding:3px 10px;border-radius:99px;display:inline-block;margin-bottom:8px;">'+p.category+'</a>'
            +'<div style="font-size:12px;color:#cbd5e1;display:flex;align-items:flex-start;gap:6px;margin-bottom:6px;"><i class=\"fas fa-location-dot\" style=\"color:'+col+';margin-top:2px;\"></i>'+(p.kecamatan||p.address)+'</div>'
            +'<div style="font-size:12px;color:#94a3b8;display:flex;align-items:center;gap:4px;"><i class=\"fas fa-star\" style=\"color:#f59e0b;\"></i><strong style=\"color:#f8fafc;\">'+p.rating+'</strong><span>('+p.total_ulasan+' ulasan)</span></div>'
            +'</div></div>';
          
          const m=L.marker([lat,lng],{icon: currentIsOsm ? storePinIcon(col) : mkIcon(col)}).addTo(pmap).bindPopup(popup,{maxWidth:280});
          markers.push({m: m, col: col});
          
          const card=document.createElement('div'); card.className='store-card-sidebar'; card.style.borderLeftColor=col;
          card.innerHTML='<div class="store-card-name">'+p.name+'</div><div class="store-card-cat" style="color:'+col+';">'+p.category+'</div><div class="store-card-loc"><i class="fas fa-location-dot" style="margin-right:4px;"></i>'+(p.kecamatan||p.address)+'</div>';
          card.onclick=()=>{ pmap.setView([lat,lng],16); m.openPopup(); };
          list.appendChild(card);
        });
      }
      
      window.filterMap=()=>{ const c=document.getElementById('filterKategori').value; renderMap(c?allStores.filter(f=>f.properties.category===c):allStores); };
      window.resetView=()=>{ document.getElementById('pilihWilayah').value='kisaran'; document.getElementById('filterKategori').value=''; pmap.setView(kisaran,13); renderMap(allStores); };
      window.gantiWilayah=()=>{ const w=document.getElementById('pilihWilayah').value; pmap.setView(w==='kisaran'?kisaran:tanjungbalai,13); };
    });
    </script>

    <?php else: ?>
    <!-- Guest: Simple map with controls -->
    
    <!-- Controls Bar (Added for Guest) -->
    <div class="map-topbar" data-aos="fade-up">
      <select id="pilihWilayahGuest" onchange="gantiWilayahGuest()">
        <option value="kisaran">Kota Kisaran, Asahan</option>
        <option value="tanjungbalai">Kota Tanjung Balai</option>
      </select>
      <button onclick="resetViewGuest()" class="btn-reset-map">
        <i class="fas fa-crosshairs"></i> <span>Reset Tampilan</span>
      </button>
    </div>
    
    <div class="map-guest-frame" data-aos="zoom-in">
      <div id="gisMapGuest"></div>
      <div class="map-login-banner">
        <i class="fas fa-unlock-alt" style="color:#60a5fa;"></i>
        <span>Login untuk akses direktori &amp; filter kategori toko</span>
        <a href="<?= base_url('auth/login') ?>">Login Sekarang</a>
      </div>
    </div>
    <p style="text-align:center;margin-top:14px;font-size:13px;color:#64748b;">
      <i class="fas fa-info-circle" style="color:var(--glow-blue);margin-right:6px;"></i>
      Klik marker untuk melihat informasi toko.
    </p>
    
    <script>
    let gmap;
    const kisaran = [2.9834, 99.6167], tanjungbalai = [2.9649, 99.8016];
    
    document.addEventListener('DOMContentLoaded', function () {
      gmap = L.map('gisMapGuest',{center:kisaran,zoom:13,scrollWheelZoom:false});
      
      /* Dark mode map tiles */
      var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { attribution:'CartoDB', maxZoom:19 });
      var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',              { attribution:'OpenStreetMap', maxZoom:19 });
      
      dark.addTo(gmap);
      L.control.layers({'Dark':dark, 'OSM':peta3},{},{collapsed:false}).addTo(gmap);
      
      const catColors={'Smartphone':'#60a5fa','Komputer & Laptop':'#a78bfa','Audio & Video':'#2dd4bf','Peralatan Listrik':'#fbbf24','Elektronik Umum':'#f472b6','Apple Authorized':'#4ade80','Gaming':'#f87171','Kamera & Optik':'#e879f9','Lainnya':'#94a3b8'};
      
      /* Glowing marker */
      const mkIcon = c => L.divIcon({
        html: `<div style="width:16px;height:16px;border-radius:50%;background:${c};border:2px solid rgba(255,255,255,0.8);box-shadow:0 0 12px ${c}, 0 0 24px ${c}66;"></div>`,
        iconSize:[16,16], iconAnchor:[8,8], popupAnchor:[0,-10], className:''
      });
      
      /* Store Pin marker (for OSM) */
      const storePinIcon = c => L.divIcon({
        html: `<div style="background:${c};width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 3px 6px rgba(0,0,0,0.4);position:relative;">
                 <i class="fas fa-store" style="color:#fff;font-size:12px;"></i>
                 <div style="position:absolute;bottom:-6px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:5px solid transparent;border-right:5px solid transparent;border-top:6px solid ${c};"></div>
               </div>`,
        iconSize:[28,34], iconAnchor:[14,34], popupAnchor:[0,-34], className:''
      });
      
      let markersGuest = [], currentIsOsmGuest = false;
      
      gmap.on('baselayerchange', function(e) {
        currentIsOsmGuest = (e.name === 'OSM');
        markersGuest.forEach(obj => obj.m.setIcon(currentIsOsmGuest ? storePinIcon(obj.col) : mkIcon(obj.col)));
      });
      
      fetch('<?= base_url("api/stores") ?>').then(r=>r.json()).then(data=>{
        data.features.forEach(f=>{
          const p=f.properties,[lng,lat]=f.geometry.coordinates,col=catColors[p.category]||'#60a5fa';
          
          const popup = '<div style="min-width:210px;font-family:inherit;">'
            +(p.foto?'<div style="height:120px;overflow:hidden;border-radius:14px 14px 0 0;"><img src="<?= base_url("foto/") ?>'+p.foto+'" style="width:100%;height:100%;object-fit:cover;"></div>':'')
            +'<div style="padding:12px 14px;">'
            +'<div style="font-weight:800;font-size:14px;color:#f8fafc;margin-bottom:6px;">'+p.name+'</div>'
            +'<span style="font-size:11px;font-weight:700;color:'+col+';background:'+col+'22;border:1px solid '+col+'44;padding:2px 8px;border-radius:99px;display:inline-block;margin-bottom:8px;">'+p.category+'</span>'
            +'<div style="font-size:12px;color:#cbd5e1;display:flex;align-items:flex-start;gap:5px;margin-bottom:6px;"><i class=\"fas fa-location-dot\" style=\"color:'+col+';margin-top:2px;\"></i>'+(p.kecamatan||p.address)+'</div>'
            +'<div style="font-size:12px;color:#94a3b8;display:flex;align-items:center;gap:4px;"><i class=\"fas fa-star\" style=\"color:#f59e0b;\"></i><strong style=\"color:#f8fafc;\">'+p.rating+'</strong><span>('+p.total_ulasan+' ulasan)</span></div>'
            +'</div></div>';
            
          const m = L.marker([lat,lng],{icon: currentIsOsmGuest ? storePinIcon(col) : mkIcon(col)}).addTo(gmap).bindPopup(popup, {maxWidth:260});
          markersGuest.push({m: m, col: col});
        });
      });
    });
    
    window.gantiWilayahGuest = () => {
      const w = document.getElementById('pilihWilayahGuest').value;
      gmap.setView(w === 'kisaran' ? kisaran : tanjungbalai, 13);
    };
    
    window.resetViewGuest = () => {
      document.getElementById('pilihWilayahGuest').value = 'kisaran';
      gmap.setView(kisaran, 13);
    };
    </script>
    <?php endif; ?>

  </div>
</section>

<!-- ================================================================
     SECTION 3.5 — STORE SHOWCASE (Logged-in Only)
================================================================ -->
<?php if (session()->get('is_logged_in') && !empty($recent_stores)): ?>
<section id="toko" class="lp-section" style="background: #05060f; padding-top: 60px;">
  <div class="lp-container">
    <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:48px; flex-wrap:wrap; gap:20px;" data-aos="fade-up">
      <div>
        <div class="tag-pill" style="margin-bottom:16px; background:rgba(251,113,133,0.08); border-color:rgba(251,113,133,0.3); color:var(--glow-rose);">
          <i class="fas fa-store"></i> Toko Terdaftar
        </div>
        <h2 class="heading-lg">Toko Elektronik Terbaru</h2>
      </div>
      <a href="<?= base_url('toko') ?>" class="btn-vision-accent" style="flex-shrink:0;">
        Lihat Semua <i class="fas fa-arrow-right"></i>
      </a>
    </div>

    <div class="showcase-grid" data-aos="fade-up" data-aos-delay="100">
      <?php foreach ($recent_stores as $st): ?>
        <div class="showcase-card glass-sheen">
          <div class="showcase-img">
            <?php if (!empty($st['foto'])): ?>
              <img src="<?= base_url('foto/' . $st['foto']) ?>" alt="<?= esc($st['nama_toko']) ?>">
            <?php else: ?>
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:48px;color:var(--text-4);">
                <i class="fas fa-store"></i>
              </div>
            <?php endif; ?>
            <div class="img-overlay"></div>
          </div>
          <div class="showcase-body">
            <div class="showcase-cat"><?= esc($st['kategori']) ?></div>
            <div class="showcase-name"><?= esc($st['nama_toko']) ?></div>
            <div class="showcase-addr">
              <i class="fas fa-location-dot" style="color:var(--glow-blue);margin-top:2px;flex-shrink:0;"></i>
              <?= esc($st['alamat']) ?>, <?= esc($st['kota'] ?? '') ?>
            </div>
            <a href="<?= base_url('toko/' . $st['id']) ?>" class="showcase-link">
              Lihat Detail <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
/* ================================================================
   SECTION 4 — REVIEWS / TESTIMONIALS CSS
================================================================ */
.rating-hero-glass {
  background: rgba(15,23,42,0.4);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: var(--r-xl, 24px);
  padding: 32px 40px;
  display: flex;
  align-items: center;
  gap: 24px;
  backdrop-filter: var(--blur-lg, blur(24px));
  -webkit-backdrop-filter: var(--blur-lg, blur(24px));
  margin-bottom: 40px;
}
.rating-hero-glass .big-rating {
  font-family: var(--font-display, 'Outfit', sans-serif);
  font-size: 56px;
  font-weight: 800;
  color: #fbbf24;
  line-height: 1;
}
.stars-row { color: #fbbf24; font-size: 16px; display:flex; gap:4px; }
.stars-row .dim { color: rgba(255,255,255,0.2); }
.review-count { font-size: 14px; color: var(--text-3, #94a3b8); }

.own-review-glass {
  background: rgba(96,165,250,0.05);
  border: 1px solid rgba(96,165,250,0.2);
  border-radius: var(--r-lg, 16px);
  padding: 24px 32px;
  margin-bottom: 40px;
}

.review-form-glass {
  background: rgba(15,23,42,0.6);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: var(--r-xl, 24px);
  padding: 32px;
  margin-bottom: 40px;
  backdrop-filter: blur(16px);
}
.form-input-glass {
  width: 100%;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 12px;
  padding: 16px;
  color: var(--text-1, #f8fafc);
  font-family: inherit;
  font-size: 15px;
  resize: vertical;
  outline: none;
  transition: border-color 0.2s;
}
.form-input-glass:focus { border-color: var(--glow-blue, #60a5fa); }

.testi-track-wrap {
  position: relative;
  overflow: hidden;
  margin: 0 -20px;
  padding: 0 20px 40px;
}
.testi-track {
  display: flex;
  transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  gap: 24px;
}
.testi-card-v {
  flex: 0 0 calc(100% - 40px);
  max-width: 600px;
  background: var(--surface-1, rgba(30,41,59,0.5));
  border: 1px solid var(--glass-stroke, rgba(255,255,255,0.08));
  border-radius: var(--r-xl, 24px);
  padding: 40px;
  opacity: 0.4;
  transform: scale(0.9);
  transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  backdrop-filter: var(--blur-md, blur(12px));
}
@media (min-width: 768px) {
  .testi-card-v { flex: 0 0 540px; }
}
.testi-card-v.active {
  opacity: 1;
  transform: scale(1);
  background: var(--surface-2, rgba(51,65,85,0.6));
  border-color: var(--glass-stroke-2, rgba(255,255,255,0.15));
  box-shadow: 0 24px 48px rgba(0,0,0,0.5);
}
.testi-quote {
  font-size: 16px;
  line-height: 1.6;
  color: var(--text-2, #cbd5e1);
  margin-bottom: 24px;
  font-style: italic;
}
.testi-avatar {
  width: 48px; height: 48px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  color: rgba(255,255,255,0.5); font-size: 20px;
  overflow: hidden;
}
.testi-name-v { font-weight: 700; color: var(--text-1, #f8fafc); font-size: 15px; margin-bottom: 2px; }
.testi-date { font-size: 12px; color: var(--text-3, #94a3b8); }

.carousel-ctrl-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 24px;
  margin-top: 16px;
  position: relative;
  z-index: 50;
  pointer-events: auto;
}
.carousel-btn-v {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: var(--text-1, #f8fafc);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}
.carousel-btn-v:hover {
  background: var(--glow-blue, #60a5fa);
  color: #0f172a;
  border-color: var(--glow-blue, #60a5fa);
}
.testi-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,0.2);
  transition: all 0.3s;
  cursor: pointer;
}
.testi-dot.active {
  width: 24px;
  background: var(--glow-blue, #60a5fa);
  border-radius: 4px;
}

@media (max-width: 640px) {
  .rating-hero-glass { flex-direction: column; text-align: center; }
  .rating-hero-glass > div:last-child { margin: 16px auto 0; }
}

/* ================================================================
   SECTION 5 — CTA CSS
================================================================ */
.cta-band-vision {
  position: relative;
  padding: 100px 0;
  background: #05060f;
  overflow: hidden;
  text-align: center;
}
.cta-glow-bg {
  position: absolute;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 800px; height: 400px;
  background: radial-gradient(ellipse at center, rgba(96,165,250,0.15) 0%, transparent 70%);
  filter: blur(40px);
  pointer-events: none;
}
.cta-glass-box {
  background: rgba(15,23,42,0.4);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 32px;
  padding: 64px 40px;
  backdrop-filter: var(--blur-lg, blur(24px));
  -webkit-backdrop-filter: var(--blur-lg, blur(24px));
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 32px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.1);
}
</style>

<!-- ================================================================
     SECTION 4 — TESTIMONIALS / USER REVIEWS
================================================================ -->
<section id="ulasan" class="lp-section" style="background: #080c18; border-top: 1px solid rgba(255,255,255,0.06);">
  <div class="lp-container">
    <div class="text-center" style="margin-bottom: 48px;" data-aos="fade-up">
      <div class="tag-pill" style="margin-bottom:20px; background:rgba(251,191,36,0.08); border-color:rgba(251,191,36,0.3); color:#fbbf24;">
        <i class="fas fa-star"></i> Ulasan Pengguna
      </div>
      <h2 class="heading-lg">Kata Mereka</h2>
    </div>

    <!-- Overall Rating -->
    <div class="rating-hero-glass" data-aos="fade-up">
      <div class="big-rating"><?= $rating_info['avg_rating'] ?></div>
      <div>
        <div class="stars-row" style="margin-bottom:6px;">
          <?php
            $avg = round($rating_info['avg_rating']);
            for($i=1;$i<=5;$i++) echo $i<=$avg ? '<i class="fas fa-star"></i>' : '<i class="far fa-star dim"></i>';
          ?>
        </div>
        <div class="review-count">Berdasarkan <?= $rating_info['total_reviews'] ?> ulasan pengguna</div>
      </div>
      <div style="margin-left: auto;">
        <?php if(session()->get('is_logged_in') && empty($user_review)): ?>
          <button onclick="document.getElementById('reviewFormWrap').style.display='block'" class="btn-vision-accent">
            <i class="fas fa-pencil"></i> Tulis Ulasan
          </button>
        <?php elseif(!session()->get('is_logged_in')): ?>
          <a href="<?= base_url('auth/login') ?>" class="btn-vision-primary">
            Login untuk Ulasan
          </a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('success')): ?>
      <div style="background:rgba(45,212,191,0.1);border:1px solid rgba(45,212,191,0.3);color:#2dd4bf;padding:16px 20px;border-radius:var(--r-md);margin-bottom:24px;text-align:center;">
        <i class="fas fa-check-circle" style="margin-right:8px;"></i><?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
      <div style="background:rgba(251,113,133,0.1);border:1px solid rgba(251,113,133,0.3);color:var(--glow-rose);padding:16px 20px;border-radius:var(--r-md);margin-bottom:24px;text-align:center;">
        <i class="fas fa-exclamation-circle" style="margin-right:8px;"></i><?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- User's Own Review -->
    <?php if(session()->get('is_logged_in') && !empty($user_review)): ?>
      <div class="own-review-glass" data-aos="fade-up">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
          <div>
            <div style="font-family:var(--font-display);font-size:17px;font-weight:800;color:var(--text-1);margin-bottom:6px;">Ulasan Anda</div>
            <div class="stars-row">
              <?php for($i=1;$i<=5;$i++) echo ($i<=$user_review['rating']) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star dim"></i>'; ?>
            </div>
          </div>
          <button onclick="document.getElementById('reviewFormWrap').style.display='block'" class="btn-vision-primary" style="padding:10px 20px;font-size:13px;">
            <i class="fas fa-edit"></i> Edit
          </button>
        </div>
        <p style="color:var(--text-2);font-size:15px;line-height:1.7;font-style:italic;">"<?= esc($user_review['ulasan']) ?>"</p>
      </div>
    <?php endif; ?>

    <!-- Review Form (hidden by default) -->
    <?php $ratingVal = !empty($user_review) ? $user_review['rating'] : 5; $ulasanTxt = !empty($user_review) ? $user_review['ulasan'] : ''; ?>
    <div id="reviewFormWrap" style="display:none;" data-aos="fade-up">
      <div class="review-form-glass">
        <h3 style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--text-1);margin-bottom:24px;">
          <?= !empty($user_review) ? 'Edit Ulasan Anda' : 'Tulis Ulasan' ?>
        </h3>
        <form action="<?= base_url('submit-rating') ?>" method="POST">
          <div style="margin-bottom:24px;">
            <label style="display:block;color:var(--text-2);font-size:14px;font-weight:600;margin-bottom:10px;">Rating Bintang</label>
            <div id="starRow" style="display:flex;gap:10px;font-size:32px;cursor:pointer;color:#f59e0b;">
              <i class="fas fa-star star-btn" data-value="1"></i>
              <i class="fas fa-star star-btn" data-value="2"></i>
              <i class="fas fa-star star-btn" data-value="3"></i>
              <i class="fas fa-star star-btn" data-value="4"></i>
              <i class="fas fa-star star-btn" data-value="5"></i>
            </div>
            <input type="hidden" name="rating" id="ratingValue" value="<?= $ratingVal ?>">
          </div>
          <div style="margin-bottom:24px;">
            <label style="display:block;color:var(--text-2);font-size:14px;font-weight:600;margin-bottom:10px;">Komentar (Opsional)</label>
            <textarea name="ulasan" rows="4" class="form-input-glass" placeholder="Ceritakan pengalaman Anda menggunakan ELStore GIS…"><?= esc($ulasanTxt) ?></textarea>
          </div>
          <div style="display:flex;gap:12px;justify-content:flex-end;">
            <button type="button" onclick="document.getElementById('reviewFormWrap').style.display='none'" class="btn-vision-primary" style="padding:12px 24px;">Batal</button>
            <button type="submit" class="btn-vision-accent" style="padding:12px 24px;">
              <?= !empty($user_review) ? 'Simpan Perubahan' : 'Kirim Ulasan' ?>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Testimonial Carousel -->
    <div class="testi-track-wrap" data-aos="fade-up" data-aos-delay="100">
      <div class="testi-track" id="testiTrack">
        <?php if(!empty($recent_ratings)): ?>
          <?php foreach($recent_ratings as $idx => $r): ?>
            <div class="testi-card-v <?= $idx===1||count($recent_ratings)==1 ? 'active' : '' ?>">
              <div class="stars-row" style="margin-bottom:12px;">
                <?php for($i=1;$i<=5;$i++) echo ($i<=$r['rating']) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star dim"></i>'; ?>
              </div>
              <p class="testi-quote">"<?= htmlspecialchars($r['ulasan'] ?? 'Tidak ada komentar.') ?>"</p>
              <div style="display:flex;align-items:center;gap:12px;padding-top:16px;border-top:1px solid var(--glass-stroke);">
                <div class="testi-avatar">
                  <?php if(!empty($r['foto_profil'])): ?>
                    <img src="<?= base_url('foto/'.$r['foto_profil']) ?>" alt="User" style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                  <?php else: ?>
                    <i class="fas fa-user"></i>
                  <?php endif; ?>
                </div>
                <div>
                  <div class="testi-name-v"><?= esc($r['nama_lengkap']) ?></div>
                  <div class="testi-date"><?= date('d M Y', strtotime($r['created_at'])) ?></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="testi-card-v active">
            <p class="testi-quote">"Jadilah yang pertama memberikan ulasan untuk ELStore GIS!"</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Carousel Controls -->
    <div class="carousel-ctrl-bar" data-aos="fade-up">
      <button type="button" class="carousel-btn-v" id="btnTestiPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>
      <div id="testiDots" style="display:flex;gap:8px;"></div>
      <button type="button" class="carousel-btn-v" id="btnTestiNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>


<!-- ================================================================
     SECTION 5 — CTA BAND
================================================================ -->
<div class="cta-band-vision" data-aos="fade-up">
  <div class="cta-glow-bg"></div>
  <div class="lp-container" style="position:relative;z-index:2;">
    <div class="cta-glass-box">
      <div class="tag-pill" style="margin-bottom:24px;">
        <i class="fas fa-satellite"></i> Bergabung Sekarang
      </div>
      <h2 class="heading-lg" style="margin-bottom:16px;">
        Siap Menjelajahi<br>
        <span class="text-gradient-blue">Peta GIS Kami?</span>
      </h2>
      <p class="body-lg" style="max-width:520px;margin:0 auto 40px;">
        Daftarkan toko elektronik Anda atau eksplorasi ribuan lokasi di Sumatera Utara — sepenuhnya gratis.
      </p>
      <?php
        $role = session()->get('role');
        $ctaUrl = base_url('auth/register');
        $ctaOnclick = '';
        if ($role === 'pemilik_toko')     { $ctaUrl = base_url('dashboard/toko'); }
        elseif ($role === 'admin')         { $ctaUrl = base_url('admin/toko'); }
        elseif (session()->get('is_logged_in')) { $ctaUrl = '#'; $ctaOnclick = 'return showDaftarTokoAlert(event)'; }
      ?>
      <a href="<?= $ctaUrl ?>" class="btn-vision-accent" style="font-size:16px; padding:18px 48px;"
         <?= $ctaOnclick ? 'onclick="'.$ctaOnclick.'"' : '' ?>>
        <i class="fas fa-store"></i> Daftarkan Toko Anda
      </a>
    </div>
  </div>
</div>


<!-- ================================================================
     SCRIPTS
================================================================ -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
/* --- Star Rating Form --- */
(function () {
  const stars = document.querySelectorAll('.star-btn');
  const input = document.getElementById('ratingValue');
  if (!stars.length || !input) return;

  function paintStars(val) {
    stars.forEach(s => {
      const v = parseInt(s.getAttribute('data-value'));
      s.style.color = v <= val ? '#f59e0b' : '#334155';
    });
  }
  paintStars(parseInt(input.value) || 5);

  stars.forEach(s => {
    s.addEventListener('click', function () {
      input.value = this.getAttribute('data-value');
      paintStars(parseInt(input.value));
    });
    s.addEventListener('mouseover', function () { paintStars(parseInt(this.getAttribute('data-value'))); });
    s.addEventListener('mouseout',  function () { paintStars(parseInt(input.value)); });
  });
})();

/* --- Testimonial Carousel --- */
(function () {
  const track = document.getElementById('testiTrack');
  const dotsW = document.getElementById('testiDots');
  if (!track) return;
  const cards = track.querySelectorAll('.testi-card-v');
  const total = cards.length;
  let cur = Math.min(1, total - 1);
  let auto;

  cards.forEach((_, i) => {
    const d = document.createElement('div');
    d.className = 'testi-dot' + (i === cur ? ' active' : '');
    d.onclick = () => { stopAuto(); goTo(i); startAuto(); };
    dotsW.appendChild(d);
  });

  function goTo(i) {
    i = Math.max(0, Math.min(total - 1, i));
    cur = i;
    const wrap = track.parentElement;
    const cardW = (cards[0]?.offsetWidth || 340) + 20;
    const offset = (wrap.offsetWidth / 2) - (cardW / 2) - i * cardW;
    track.style.transform = `translateX(${offset}px)`;
    cards.forEach((c, j) => c.classList.toggle('active', j === i));
    dotsW.querySelectorAll('.testi-dot').forEach((d, j) => d.classList.toggle('active', j === i));
  }

  window.addEventListener('load',   () => goTo(cur));
  window.addEventListener('resize', () => goTo(cur));

  function startAuto() { auto = setInterval(() => goTo(cur >= total - 1 ? 0 : cur + 1), 4500); }
  function stopAuto()  { clearInterval(auto); }
  startAuto();
  track.parentElement.addEventListener('mouseenter', stopAuto);
  track.parentElement.addEventListener('mouseleave', startAuto);

  let tx = 0;
  track.addEventListener('touchstart', e => { tx = e.touches[0].clientX; }, { passive: true });
  track.addEventListener('touchend',   e => { const d = e.changedTouches[0].clientX - tx; if (Math.abs(d) > 40) { stopAuto(); goTo(cur + (d < 0 ? 1 : -1)); startAuto(); } });

  const btnNext = document.getElementById('btnTestiNext');
  const btnPrev = document.getElementById('btnTestiPrev');
  if (btnNext) btnNext.addEventListener('click', (e) => { e.preventDefault(); stopAuto(); goTo(cur >= total - 1 ? 0 : cur + 1); startAuto(); });
  if (btnPrev) btnPrev.addEventListener('click', (e) => { e.preventDefault(); stopAuto(); goTo(cur <= 0 ? total - 1 : cur - 1); startAuto(); });
})();

/* --- Hero Stat Counter Animation --- */
(function () {
  const el = document.getElementById('stat-stores');
  if (!el) return;
  const target = parseInt(el.textContent) || <?= $total_stores ?>;
  let start = 0;
  const obs = new IntersectionObserver(entries => {
    if (!entries[0].isIntersecting) return;
    obs.disconnect();
    const step = target / (1500 / 16);
    const t = setInterval(() => {
      start = Math.min(start + step, target);
      el.textContent = Math.floor(start) + '+';
      if (start >= target) clearInterval(t);
    }, 16);
  }, { threshold: 0.5 });
  obs.observe(el);
})();

/* --- Glassmorphism Card Mouse Glow Effect --- */
document.querySelectorAll('.feat-glass').forEach(card => {
  card.addEventListener('mousemove', e => {
    const r = card.getBoundingClientRect();
    const x = ((e.clientX - r.left) / r.width * 100).toFixed(1);
    const y = ((e.clientY - r.top)  / r.height * 100).toFixed(1);
    card.style.setProperty('--mx', x + '%');
    card.style.setProperty('--my', y + '%');
  });
});

/* --- SweetAlert Modals --- */
function showAdminAlert(e) {
  e.preventDefault();
  Swal.fire({
    title: 'Akses Terbatas',
    html: '<div style="color:#94a3b8;line-height:1.7;">Fitur <strong style="color:#f8fafc;">Kelola Data</strong> hanya tersedia untuk akun <strong style="color:#fb7185;">Administrator</strong>.</div>',
    background: 'rgba(13,17,32,0.98)',
    color: '#f8fafc',
    confirmButtonText: 'Login Admin',
    cancelButtonText: 'Batal',
    showCancelButton: true,
    buttonsStyling: false,
    customClass: { popup: 'sv-popup-v', title: 'sv-title-v', confirmButton: 'sv-btn-a', cancelButton: 'sv-btn-b' }
  }).then(r => { if (r.isConfirmed) window.location.href = '<?= base_url("auth/logout?redirect=auth/login") ?>'; });
}

function showDaftarTokoAlert(e) {
  e.preventDefault();
  Swal.fire({
    title: 'Upgrade Akun',
    html: '<div style="color:#94a3b8;line-height:1.7;">Anda masuk sebagai <strong style="color:#f8fafc;">Pengguna Biasa</strong>. Gunakan akun <strong style="color:#60a5fa;">Pemilik Toko</strong> untuk mendaftarkan toko.</div>',
    background: 'rgba(13,17,32,0.98)',
    color: '#f8fafc',
    showCancelButton: true,
    showDenyButton: true,
    confirmButtonText: 'Register',
    denyButtonText: 'Login Pemilik',
    cancelButtonText: 'Batal',
    buttonsStyling: false,
    customClass: { popup: 'sv-popup-v', title: 'sv-title-v', confirmButton: 'sv-btn-a', denyButton: 'sv-btn-c', cancelButton: 'sv-btn-b' }
  }).then(r => {
    if (r.isConfirmed) window.location.href = '<?= base_url("auth/logout?redirect=auth/register") ?>';
    else if (r.isDenied) window.location.href = '<?= base_url("auth/logout?redirect=auth/login") ?>';
  });
  return false;
}
</script>

<style>
/* ================================================================
   SWEETALERT CUSTOM CSS
================================================================ */
.sv-popup-v {
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 24px !important;
  box-shadow: 0 32px 64px rgba(0,0,0,0.7);
  backdrop-filter: blur(20px);
  padding: 24px;
}
.sv-title-v {
  font-family: var(--font-display, 'Outfit', sans-serif);
  font-size: 24px;
  font-weight: 800;
}
.sv-btn-a, .sv-btn-b, .sv-btn-c {
  font-family: inherit;
  font-size: 14px;
  font-weight: 700;
  padding: 12px 24px;
  border-radius: 12px;
  cursor: pointer;
  margin: 4px;
  transition: all 0.2s;
  border: none;
}
.sv-btn-a {
  background: var(--glow-blue, #60a5fa);
  color: #0f172a;
  box-shadow: 0 4px 16px rgba(96,165,250,0.4);
}
.sv-btn-a:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(96,165,250,0.6); }

.sv-btn-b {
  background: rgba(255,255,255,0.05);
  color: #cbd5e1;
  border: 1px solid rgba(255,255,255,0.1);
}
.sv-btn-b:hover { background: rgba(255,255,255,0.1); color: #fff; }

.sv-btn-c {
  background: rgba(251,113,133,0.1);
  color: #fb7185;
  border: 1px solid rgba(251,113,133,0.3);
}
.sv-btn-c:hover { background: rgba(251,113,133,0.2); }

/* ================================================================
   RESPONSIVE DESIGN / MEDIA QUERIES (Mobile & Tablet)
================================================================ */
@media (max-width: 1024px) {
  .features-grid { grid-template-columns: repeat(2, 1fr); }
  .heading-xl { font-size: clamp(40px, 6vw, 64px); }
  .heading-lg { font-size: clamp(28px, 5vw, 42px); }
  .hero-content-wrap { padding-top: 80px; padding-bottom: 80px; }
}

@media (max-width: 768px) {
  .lp-section { padding: 80px 0; }
  .lp-container { padding: 0 20px; }
  
  .features-grid { grid-template-columns: 1fr; }
  .feat-glass { padding: 24px; }
  
  .hero-stats-glass { flex-wrap: wrap; justify-content: center; border-radius: var(--r-xl); margin-top: 30px; }
  .stat-pill:not(:last-child)::after { display: none; }
  .stat-pill { padding: 12px 20px; flex: 1 1 40%; border-bottom: 1px solid rgba(255,255,255,0.05); }
  
  .hero-btns { justify-content: center; }
  .hero-content-wrap { text-align: center; }
  .tag-pill { margin: 0 auto 20px; }
  .body-lg { margin: 0 auto 30px; font-size: 16px; }
  
  .showcase-grid { grid-template-columns: 1fr; }
  .showcase-img { height: 200px; }
  
  .map-topbar { 
    flex-direction: row; 
    flex-wrap: nowrap; 
    align-items: center; 
    background: transparent;
    border: none;
    padding: 0;
    gap: 8px;
    width: 100%;
    overflow: visible;
  }
  
  .map-topbar select { 
    flex: 1; 
    min-width: 0;
    width: 0;
    background: rgba(30,41,59,0.8);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    font-size: 12px; 
    padding: 10px 8px 10px 12px; 
    text-overflow: ellipsis;
    backdrop-filter: blur(10px);
  }
  
  .map-topbar .btn-reset-map { 
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    background: rgba(30,41,59,0.8);
    border: 1px solid rgba(96,165,250,0.3);
    border-radius: 12px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
  }
  .map-topbar .btn-reset-map span { display: none; }
  .map-topbar .btn-reset-map i { font-size: 16px; margin: 0; }
  
  .map-login-banner {
    width: calc(100% - 32px);
    border-radius: 16px;
    flex-direction: column;
    padding: 16px;
    white-space: normal;
    text-align: center;
  }
  .map-login-banner span { white-space: normal; line-height: 1.5; }
  
  .cta-glass-box { padding: 40px 24px; border-radius: 24px; }
  .cta-band-vision { padding: 60px 0; }
  
  .testi-track-wrap { padding: 0 0 40px; margin: 0; }
  .testi-card-v { padding: 24px 20px; flex: 0 0 100%; }
  .rating-hero-glass { padding: 24px 20px; border-radius: 20px; }
}

@media (max-width: 480px) {
  .heading-xl { font-size: 32px; letter-spacing: -1px; }
  .heading-lg { font-size: 24px; }
  
  .stat-pill { flex: 1 1 100%; }
  .stat-pill:last-child { border-bottom: none; }
  
  .btn-vision-primary, .btn-vision-accent { width: 100%; justify-content: center; font-size: 14px; padding: 14px 24px; }
  
  .rating-hero-glass .big-rating { font-size: 48px; }
}
</style>
