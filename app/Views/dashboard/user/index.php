<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<!-- Welcome Banner -->
<div style="background:linear-gradient(135deg,#0F172A 0%,#1E3A5F 60%,#2563EB 100%);border-radius:var(--radius-xl);padding:32px;margin-bottom:24px;position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,0.05) 1px,transparent 1px);background-size:28px 28px;"></div>
  <div style="position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
    <div>
      <div style="font-size:12px;font-weight:700;letter-spacing:2px;color:rgba(255,255,255,0.5);text-transform:uppercase;margin-bottom:8px;">Dashboard Pengguna</div>
      <h1 style="font-family:var(--font-display);font-size:26px;font-weight:900;color:#fff;margin-bottom:8px;">
        Selamat datang, <?php echo esc(session()->get('nama_lengkap')); ?>! 👋
      </h1>
      <p style="color:rgba(255,255,255,0.6);font-size:14px;">Jelajahi peta toko elektronik di Sumatera Utara.</p>
    </div>
    <a href="<?php echo base_url('peta'); ?>" style="display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);border-radius:var(--radius-md);color:#fff;font-weight:700;font-size:14px;backdrop-filter:blur(8px);transition:all .25s;">
      <i class="fas fa-map-location-dot"></i> Buka Peta GIS
    </a>
  </div>
</div>

<!-- Stats -->
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
  <div class="stat-card" style="--card-color:#2563EB;">
    <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-store"></i></div>
    <div class="stat-value"><?php echo $stats['total_toko']; ?></div>
    <div class="stat-label">Toko Terdaftar</div>
    <div class="stat-change up"><i class="fas fa-arrow-up"></i> Aktif di peta</div>
  </div>
  <div class="stat-card" style="--card-color:#22C55E;">
    <div class="stat-icon" style="background:#F0FDF4;color:#22C55E;"><i class="fas fa-map"></i></div>
    <div class="stat-value"><?php echo $stats['total_kota']; ?></div>
    <div class="stat-label">Kabupaten/Kota</div>
    <div class="stat-change up"><i class="fas fa-map-pin"></i> Kisaran & Asahan</div>
  </div>
  <div class="stat-card" style="--card-color:#6366F1;">
    <div class="stat-icon" style="background:#EEF2FF;color:#6366F1;"><i class="fas fa-database"></i></div>
    <div class="stat-value"><?php echo $stats['data_akurat']; ?></div>
    <div class="stat-label">Data Akurat</div>
    <div class="stat-change up"><i class="fas fa-check-circle"></i> Terverifikasi</div>
  </div>
</div>

<!-- Recent Stores Grid -->
<div class="section-head">
  <span class="section-title"><i class="fas fa-store" style="color:var(--primary);margin-right:8px;"></i>Toko Terdekat</span>
  <a href="<?php echo base_url('toko'); ?>" class="section-link">Lihat Semua <i class="fas fa-arrow-right"></i></a>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;margin-bottom:24px;">
  <?php foreach (array_slice($recent_toko, 0, 6) as $t): ?>
  <a href="<?php echo base_url('toko/'.$t['id']); ?>"
     style="border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;background:var(--surface);display:block;transition:all .25s;"
     onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 36px rgba(0,0,0,0.1)'"
     onmouseout="this.style.transform='';this.style.boxShadow=''">
    <div style="height:120px;background:linear-gradient(135deg,#0F172A,#1E3A5F);display:flex;align-items:center;justify-content:center;overflow:hidden;">
      <?php if (!empty($t['foto'])): ?>
        <img src="<?php echo base_url('foto/'.$t['foto']); ?>" style="width:100%;height:100%;object-fit:cover;">
      <?php else: ?>
        <i class="fas fa-store" style="font-size:36px;color:rgba(255,255,255,0.2);"></i>
      <?php endif; ?>
    </div>
    <div style="padding:14px;">
      <div style="font-weight:700;font-size:14px;color:var(--text-primary);margin-bottom:4px;"><?php echo esc($t['nama_toko']); ?></div>
      <div style="margin-bottom:8px;"><span class="badge badge-primary" style="font-size:11px;"><?php echo esc($t['kategori']); ?></span></div>
      <div style="font-size:12px;color:var(--text-muted);">
        <i class="fas fa-location-dot" style="color:var(--primary);margin-right:4px;"></i>
        <?php echo esc($t['kecamatan'] ? $t['kecamatan'] : $t['kota']); ?>
      </div>
      <div style="margin-top:6px;display:flex;align-items:center;gap:4px;">
        <i class="fas fa-star" style="color:#F59E0B;font-size:11px;"></i>
        <span style="font-weight:600;font-size:13px;"><?php echo $t['rating']; ?></span>
        <span style="font-size:11px;color:var(--text-muted);">(<?php echo $t['total_ulasan']; ?>)</span>
      </div>
    </div>
  </a>
  <?php endforeach; ?>
</div>

<!-- Quick Actions -->
<div class="dash-card">
  <div class="dash-card-header">
    <span class="dash-card-title"><i class="fas fa-bolt" style="color:var(--primary);margin-right:8px;"></i>Akses Cepat</span>
  </div>
  <div style="padding:20px;display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px;">
    <a href="<?php echo base_url('peta'); ?>"
       style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border:1px solid var(--border);border-radius:var(--radius-md);text-align:center;transition:all .25s;"
       onmouseover="this.style.borderColor='var(--primary)';this.style.background='var(--primary-10)'"
       onmouseout="this.style.borderColor='';this.style.background=''">
      <div style="width:44px;height:44px;background:#EFF6FF;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;">
        <i class="fas fa-map-location-dot"></i>
      </div>
      <div style="font-weight:600;font-size:13px;color:var(--text-primary);">Peta GIS</div>
      <div style="font-size:11px;color:var(--text-muted);">Tampilkan peta interaktif</div>
    </a>
    <a href="<?php echo base_url('toko'); ?>"
       style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border:1px solid var(--border);border-radius:var(--radius-md);text-align:center;transition:all .25s;"
       onmouseover="this.style.borderColor='var(--primary)';this.style.background='var(--primary-10)'"
       onmouseout="this.style.borderColor='';this.style.background=''">
      <div style="width:44px;height:44px;background:#EFF6FF;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;">
        <i class="fas fa-store"></i>
      </div>
      <div style="font-weight:600;font-size:13px;color:var(--text-primary);">Daftar Toko</div>
      <div style="font-size:11px;color:var(--text-muted);">Cari toko terdekat</div>
    </a>
    <a href="<?php echo base_url('dashboard/profil'); ?>"
       style="display:flex;flex-direction:column;align-items:center;gap:10px;padding:20px 16px;border:1px solid var(--border);border-radius:var(--radius-md);text-align:center;transition:all .25s;"
       onmouseover="this.style.borderColor='var(--primary)';this.style.background='var(--primary-10)'"
       onmouseout="this.style.borderColor='';this.style.background=''">
      <div style="width:44px;height:44px;background:#EFF6FF;border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:20px;">
        <i class="fas fa-user-gear"></i>
      </div>
      <div style="font-weight:600;font-size:13px;color:var(--text-primary);">Profil Saya</div>
      <div style="font-size:11px;color:var(--text-muted);">Edit informasi akun</div>
    </a>
  </div>
</div>

<?php echo view('templates/dashboard_footer'); ?>
