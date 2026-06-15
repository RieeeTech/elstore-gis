<style>
  /* ========== TOKO LIST PAGE ========== */
  #tokoPage {
    padding-top: 100px;
    padding-bottom: 80px;
    background: var(--surface-2);
    min-height: 100vh;
  }

  .toko-filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 28px;
    align-items: center;
  }

  .search-input-wrap {
    position: relative;
    flex: 1;
    min-width: 240px;
  }

  .search-input-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 14px;
  }

  .search-input-wrap input {
    width: 100%;
    padding: 12px 14px 12px 42px;
    font-family: var(--font-body);
    font-size: 14px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    outline: none;
    transition: all var(--transition-fast);
    color: var(--text-primary);
  }

  .search-input-wrap input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
  }

  .filter-select-pub {
    padding: 12px 36px 12px 14px;
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    font-family: var(--font-body);
    font-size: 14px;
    color: var(--text-primary);
    outline: none;
    cursor: pointer;
    transition: all var(--transition-fast);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2394A3B8' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    -webkit-appearance: none;
  }

  .filter-select-pub:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
  }

  .stores-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
  }

  .store-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all var(--transition-smooth);
    display: flex;
    flex-direction: column;
  }

  .store-card:hover {
    border-color: var(--primary-light);
    box-shadow: 0 16px 48px rgba(37,99,235,0.12);
    transform: translateY(-5px);
  }

  .store-card-img {
    height: 160px;
    background: linear-gradient(135deg, #0F172A, #1E3A5F);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .store-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .store-cat-badge {
    position: absolute;
    bottom: 10px;
    left: 10px;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 999px;
    background: rgba(37,99,235,0.9);
    color: #fff;
    backdrop-filter: blur(8px);
  }

  .store-card-body {
    padding: 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .store-card-name {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 6px;
    line-height: 1.3;
  }

  .store-card-addr {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
    gap: 6px;
  }

  .store-card-addr i { color: var(--primary); margin-top: 2px; flex-shrink: 0; }

  .store-card-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 12px;
    color: var(--text-muted);
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid var(--border);
  }

  .store-card-rating {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .store-card-rating i { color: #F59E0B; }

  .store-card-cta {
    margin-top: 14px;
    display: flex;
    gap: 8px;
  }

  .btn-view-map {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    background: var(--primary-10);
    color: var(--primary);
    border-radius: var(--radius-sm);
    font-size: 13px;
    font-weight: 600;
    transition: all var(--transition-fast);
    flex: 1;
    justify-content: center;
    border: 1px solid rgba(37,99,235,0.2);
  }

  .btn-view-map:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
  }

  .no-results {
    grid-column: 1/-1;
    text-align: center;
    padding: 60px 24px;
    color: var(--text-muted);
  }

  .no-results i { font-size: 48px; display: block; margin-bottom: 12px; }

  /* ========== PAGINATION ========== */
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
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    background: var(--surface);
    color: var(--text-secondary);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: 14px;
    font-weight: 600;
    font-family: var(--font-body);
    transition: all var(--transition-fast);
  }
  .pagination li a:hover {
    background: rgba(37,99,235,0.1);
    color: var(--primary);
    border-color: var(--primary-light);
    transform: translateY(-2px);
  }
  .pagination li.active a,
  .pagination li.active span {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
  }
  .pagination li.disabled a,
  .pagination li.disabled span {
    opacity: 0.5;
    cursor: not-allowed;
    background: var(--surface-2);
  }

  @media (max-width: 600px) {
    .stores-grid { grid-template-columns: 1fr; }
    .toko-filter-bar { flex-direction: column; }
    .search-input-wrap, .filter-select-pub { width: 100%; }
  }
</style>

<!-- ================================================
     DAFTAR TOKO
================================================ -->
<section id="tokoPage">
  <div class="container">

    <!-- Header -->
    <div style="margin-bottom:28px;">
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
          <h1 style="font-family:var(--font-display);font-size:clamp(26px,3.5vw,36px);font-weight:900;color:var(--text-primary);">
            Daftar Toko Elektronik
          </h1>
          <p style="color:var(--text-secondary);font-size:15px;margin-top:4px;">
            <?php echo count($stores); ?> toko ditemukan di Kisaran, Asahan, Sumatera Utara
          </p>
        </div>
        <a href="<?php echo base_url('peta'); ?>" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:var(--primary);color:#fff;border-radius:var(--radius-md);font-weight:700;font-size:14px;transition:all var(--transition-smooth);"
           onmouseover="this.style.background='var(--primary-dark)'"
           onmouseout="this.style.background='var(--primary)'">
          <i class="fas fa-map"></i> Lihat di Peta
        </a>
      </div>
    </div>

    <!-- Filter Bar -->
    <form method="get" action="<?php echo current_url(); ?>" class="toko-filter-bar">
      <div class="search-input-wrap">
        <i class="fas fa-search"></i>
        <input type="text" name="q" placeholder="Cari nama toko, alamat..."
               value="<?php echo esc($q); ?>">
      </div>
      <select name="kategori" class="filter-select-pub" onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategoris as $k): ?>
          <option value="<?php echo $k; ?>"
            <?php echo ($kategori === $k) ? 'selected' : ''; ?>>
            <?php echo $k; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit" style="padding:12px 22px;background:var(--primary);color:#fff;border-radius:var(--radius-md);font-size:14px;font-weight:600;cursor:pointer;border:none;font-family:var(--font-body);">
        <i class="fas fa-filter"></i> Filter
      </button>
      <?php if (!empty($q) || !empty($kategori)): ?>
        <a href="<?php echo base_url('toko'); ?>" style="padding:12px 18px;background:var(--surface-3);color:var(--text-secondary);border-radius:var(--radius-md);font-size:13px;font-weight:600;">
          <i class="fas fa-times"></i> Reset
        </a>
      <?php endif; ?>
    </form>

    <!-- Store Cards -->
    <div class="stores-grid">
      <?php if (empty($stores)): ?>
        <div class="no-results">
          <i class="fas fa-store-slash"></i>
          <h3 style="font-size:18px;font-weight:700;margin-bottom:8px;">Tidak ada toko ditemukan</h3>
          <p>Coba ubah kata kunci atau filter kategori.</p>
          <a href="<?php echo base_url('toko'); ?>" style="display:inline-flex;align-items:center;gap:8px;margin-top:16px;padding:10px 20px;background:var(--primary);color:#fff;border-radius:var(--radius-md);font-weight:600;font-size:14px;">
            Lihat Semua Toko
          </a>
        </div>
      <?php else: ?>
        <?php foreach ($stores as $t): ?>
        <div class="store-card" data-aos="fade-up">
          <!-- Image -->
          <div class="store-card-img">
            <?php if (!empty($t['foto'])): ?>
              <img src="<?php echo base_url('foto/'.$t['foto']); ?>" alt="<?php echo esc($t['nama_toko']); ?>">
            <?php else: ?>
              <i class="fas fa-store" style="font-size:44px;color:rgba(255,255,255,0.2);"></i>
            <?php endif; ?>
            <div class="store-cat-badge"><?php echo esc($t['kategori']); ?></div>
          </div>

          <!-- Body -->
          <div class="store-card-body">
            <h3 class="store-card-name"><?php echo esc($t['nama_toko']); ?></h3>
            <div class="store-card-addr">
              <i class="fas fa-location-dot"></i>
              <?php echo esc($t['alamat']); ?>
            </div>

            <?php if (!empty($t['jam_buka'])): ?>
            <div style="font-size:12px;color:var(--text-muted);margin-bottom:8px;">
              <i class="fas fa-clock" style="color:var(--primary);margin-right:4px;"></i>
              <?php echo esc($t['jam_buka']); ?>
            </div>
            <?php endif; ?>

            <div class="store-card-meta">
              <div class="store-card-rating">
                <i class="fas fa-star"></i>
                <strong><?php echo $t['rating']; ?></strong>
                <span>(<?php echo $t['total_ulasan']; ?>)</span>
              </div>
              <?php if (!empty($t['no_telepon'])): ?>
              <div>
                <i class="fas fa-phone" style="color:var(--primary);margin-right:4px;"></i>
                <?php echo esc($t['no_telepon']); ?>
              </div>
              <?php endif; ?>
            </div>

            <div class="store-card-cta">
              <a href="<?php echo base_url('toko/'.$t['id']); ?>" class="btn-view-map">
                <i class="fas fa-info-circle"></i> Detail
              </a>
              <a href="<?php echo base_url('peta?lat='.$t['latitude'].'&lng='.$t['longitude']); ?>"
                 title="Lihat di Peta"
                 style="display:flex;align-items:center;justify-content:center;width:38px;height:38px;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-sm);color:var(--text-muted);transition:all var(--transition-fast);"
                 onmouseover="this.style.background='var(--primary)';this.style.color='#fff'"
                 onmouseout="this.style.background='var(--surface-2)';this.style.color='var(--text-muted)'">
                <i class="fas fa-map-pin"></i>
              </a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($pager): ?>
      <div style="margin-top: 50px; display: flex; justify-content: center;">
        <?php echo $pager->links('stores', 'default_full'); ?>
      </div>
    <?php endif; ?>

  </div>
</section>
