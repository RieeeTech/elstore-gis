<style>
  /* ========== TOKO LIST PAGE (GLASSMORPHISM) ========== */
  #tokoPage {
    padding-top: 120px;
    padding-bottom: 80px;
    background: #05060f; /* Dark background from landing page */
    min-height: 100vh;
    position: relative;
    overflow: hidden;
  }

  /* Decorative glow */
  #tokoPage::before {
    content: '';
    position: absolute;
    top: -10%; right: -5%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 60%);
    filter: blur(60px);
    pointer-events: none;
    z-index: 0;
  }
  
  .lp-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
  }

  /* Filter Bar Glassmorphism */
  .toko-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 40px;
    align-items: center;
    background: rgba(15,23,42,0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 20px;
    padding: 20px;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
  }

  .search-input-wrap {
    position: relative;
    flex: 1;
    min-width: 240px;
  }

  .search-input-wrap i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
  }

  .search-input-wrap input {
    width: 100%;
    padding: 14px 16px 14px 46px;
    font-family: var(--font-body, 'Inter', sans-serif);
    font-size: 14px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    outline: none;
    transition: all 0.2s ease;
    color: #f8fafc;
  }
  .search-input-wrap input::placeholder { color: #64748b; }
  .search-input-wrap input:focus {
    border-color: #60a5fa;
    background: rgba(96,165,250,0.05);
    box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
  }

  .filter-select-pub {
    padding: 14px 40px 14px 16px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    font-family: var(--font-body, 'Inter', sans-serif);
    font-size: 14px;
    color: #f8fafc;
    outline: none;
    cursor: pointer;
    transition: all 0.2s ease;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394A3B8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    -webkit-appearance: none;
  }
  .filter-select-pub:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
  }
  .filter-select-pub option { background: #0f172a; color: #f8fafc; }

  .btn-filter {
    padding: 14px 24px;
    background: #60a5fa;
    color: #0f172a;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
  }
  .btn-filter:hover { background: #3b82f6; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(96,165,250,0.3); }

  .btn-reset {
    padding: 14px 20px;
    background: rgba(251,113,133,0.1);
    color: #fb7185;
    border: 1px solid rgba(251,113,133,0.3);
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s;
  }
  .btn-reset:hover { background: rgba(251,113,133,0.2); }

  /* Store Cards (Glassmorphism) */
  .stores-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
  }

  .showcase-card {
    background: rgba(30,41,59,0.5);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    backdrop-filter: blur(12px);
  }
  .showcase-card:hover {
    background: rgba(51,65,85,0.6);
    border-color: rgba(255,255,255,0.15);
    transform: translateY(-8px);
    box-shadow: 0 24px 48px rgba(0,0,0,0.5);
  }

  .showcase-img {
    height: 180px;
    position: relative;
    overflow: hidden;
    background: #0f172a;
  }
  .showcase-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
  }
  .showcase-card:hover .showcase-img img { transform: scale(1.05); }
  
  .img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15,23,42,1) 0%, transparent 80%);
  }

  .showcase-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .showcase-cat {
    font-size: 12px;
    font-weight: 700;
    color: #60a5fa;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
  }
  .showcase-name {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 20px;
    font-weight: 800;
    color: #f8fafc;
    margin-bottom: 12px;
    line-height: 1.3;
  }
  .showcase-addr {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: #cbd5e1;
    line-height: 1.6;
    margin-bottom: 16px;
  }
  .store-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    font-size: 12px;
    color: #94a3b8;
  }

  .showcase-link {
    margin-top: auto;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #f8fafc;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    padding: 12px 20px;
    border-radius: 99px;
    width: 100%;
    transition: all 0.3s;
  }
  .showcase-link:hover {
    background: #60a5fa;
    color: #0f172a;
    border-color: #60a5fa;
    box-shadow: 0 4px 16px rgba(96,165,250,0.4);
  }

  /* No Results */
  .no-results {
    grid-column: 1/-1;
    text-align: center;
    padding: 80px 24px;
    background: rgba(15,23,42,0.4);
    border-radius: 24px;
    border: 1px dashed rgba(255,255,255,0.15);
  }
  .no-results i { font-size: 48px; color: #475569; margin-bottom: 16px; display: block; }
  .no-results h3 { color: #f8fafc; font-size: 20px; font-weight: 800; margin-bottom: 8px; }
  .no-results p { color: #94a3b8; font-size: 14px; }

  /* Pagination */
  .pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
  }
  .pagination li a,
  .pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 14px;
    background: rgba(255,255,255,0.05);
    color: #cbd5e1;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    transition: all 0.2s;
  }
  .pagination li a:hover {
    background: rgba(96,165,250,0.1);
    color: #60a5fa;
    border-color: rgba(96,165,250,0.3);
  }
  .pagination li.active a,
  .pagination li.active span {
    background: #60a5fa;
    color: #0f172a;
    border-color: #60a5fa;
  }

  @media (max-width: 600px) {
    .stores-grid { grid-template-columns: 1fr; }
    .toko-filter-bar { flex-direction: column; }
    .search-input-wrap, .filter-select-pub { width: 100%; }
  }
</style>

<!-- ================================================
     DAFTAR TOKO (REDESIGN)
================================================ -->
<section id="tokoPage">
  <div class="lp-container">

    <!-- Header & Back Button -->
    <div style="margin-bottom:32px; display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:20px;">
      <div>
        <a href="<?= base_url('#beranda') ?>" style="display:inline-flex; align-items:center; gap:8px; color:#94a3b8; font-size:14px; font-weight:600; margin-bottom:16px; transition:color 0.2s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#94a3b8'">
          <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
        <h1 style="font-family:var(--font-display, 'Outfit', sans-serif); font-size:clamp(32px, 4vw, 44px); font-weight:900; color:#f8fafc; line-height:1.1;">
          Daftar Toko Elektronik
        </h1>
        <p style="color:#cbd5e1; font-size:15px; margin-top:8px;">
          <?= count($stores) ?> toko ditemukan di Kisaran, Asahan, Sumatera Utara
        </p>
      </div>
      <a href="<?= base_url('peta') ?>" style="display:inline-flex; align-items:center; gap:8px; padding:14px 28px; background:#60a5fa; color:#0f172a; border-radius:99px; font-weight:700; font-size:15px; transition:all 0.3s;" onmouseover="this.style.background='#3b82f6';this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#60a5fa';this.style.transform='translateY(0)';">
        <i class="fas fa-map"></i> Lihat di Peta
      </a>
    </div>

    <!-- Filter Bar -->
    <form method="get" action="<?= current_url() ?>" class="toko-filter-bar" data-aos="fade-up">
      <div class="search-input-wrap">
        <i class="fas fa-search"></i>
        <input type="text" name="q" placeholder="Cari nama toko, alamat..." value="<?= esc($q) ?>">
      </div>
      <select name="kategori" class="filter-select-pub" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategoris as $k): ?>
          <option value="<?= $k ?>" <?= ($kategori === $k) ? 'selected' : '' ?>><?= $k ?></option>
        <?php endforeach; ?>
      </select>
      <select name="kota" class="filter-select-pub" onchange="this.form.submit()">
        <option value="">Semua Kota</option>
        <?php foreach ($kotas as $k): ?>
          <option value="<?= esc($k) ?>" <?= ($kota === $k) ? 'selected' : '' ?>><?= esc($k) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="btn-filter">
        <i class="fas fa-filter"></i> Filter
      </button>
      <?php if (!empty($q) || !empty($kategori) || !empty($kota)): ?>
        <a href="<?= base_url('toko') ?>" class="btn-reset">
          <i class="fas fa-times"></i> Reset
        </a>
      <?php endif; ?>
    </form>

    <!-- Store Cards -->
    <div class="stores-grid" data-aos="fade-up" data-aos-delay="100">
      <?php if (empty($stores)): ?>
        <div class="no-results">
          <i class="fas fa-store-slash"></i>
          <h3>Tidak ada toko ditemukan</h3>
          <p>Coba ubah kata kunci pencarian atau filter kategori lainnya.</p>
          <a href="<?= base_url('toko') ?>" style="display:inline-flex; align-items:center; gap:8px; margin-top:20px; padding:12px 24px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#f8fafc; border-radius:12px; font-weight:600; font-size:14px; transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
            Reset Pencarian
          </a>
        </div>
      <?php else: ?>
        <?php foreach ($stores as $t): ?>
        <div class="showcase-card">
          <!-- Image -->
          <div class="showcase-img">
            <?php if (!empty($t['foto'])): ?>
              <img src="<?= base_url('foto/'.$t['foto']) ?>" alt="<?= esc($t['nama_toko']) ?>">
            <?php else: ?>
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:48px;color:rgba(255,255,255,0.1);">
                <i class="fas fa-store"></i>
              </div>
            <?php endif; ?>
            <div class="img-overlay"></div>
          </div>

          <!-- Body -->
          <div class="showcase-body">
            <div class="showcase-cat"><?= esc($t['kategori']) ?></div>
            <div class="showcase-name"><?= esc($t['nama_toko']) ?></div>
            
            <div class="showcase-addr">
              <i class="fas fa-location-dot" style="color:#60a5fa;margin-top:2px;flex-shrink:0;"></i>
              <?= esc($t['alamat']) ?>
            </div>

            <div class="store-meta">
              <?php if (!empty($t['jam_buka'])): ?>
                <div><i class="fas fa-clock" style="color:#f87171;margin-right:4px;"></i> <?= esc($t['jam_buka']) ?></div>
              <?php endif; ?>
              <div>
                <i class="fas fa-star" style="color:#f59e0b;margin-right:4px;"></i> 
                <strong style="color:#f8fafc;"><?= $t['rating'] ?></strong> (<?= $t['total_ulasan'] ?>)
              </div>
            </div>

            <a href="<?= base_url('toko/'.$t['id']) ?>" class="showcase-link">
              Lihat Detail <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
      <div style="margin-top: 64px; display: flex; justify-content: center;" data-aos="fade-up">
        <?= $pager->links('stores', 'default_full') ?>
      </div>
    <?php endif; ?>

  </div>
</section>
