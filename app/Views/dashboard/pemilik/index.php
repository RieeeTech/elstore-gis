<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<!-- Welcome Banner -->
<div style="background:linear-gradient(135deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%);border-radius:var(--radius-xl);padding:32px;margin-bottom:24px;position:relative;overflow:hidden;">
  <div style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,0.05) 1px,transparent 1px);background-size:28px 28px;"></div>
  <div style="position:relative;z-index:2;">
    <div style="font-size:12px;font-weight:700;letter-spacing:2px;color:rgba(255,255,255,0.5);text-transform:uppercase;margin-bottom:8px;">Dashboard Pemilik Toko</div>
    <h1 style="font-family:var(--font-display);font-size:26px;font-weight:900;color:#fff;margin-bottom:8px;">
      Selamat datang, <?php echo esc(session()->get('nama_lengkap')); ?>! 🏪
    </h1>
    <p style="color:rgba(255,255,255,0.6);font-size:14px;">Kelola toko elektronik Anda di ELStore GIS — Sumatera Utara.</p>
  </div>
</div>

<!-- Stats -->
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:24px;">
  <div class="stat-card" style="--card-color:#2563EB;">
    <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-store"></i></div>
    <div class="stat-value"><?php echo count($toko); ?></div>
    <div class="stat-label">Toko Anda</div>
  </div>
  <div class="stat-card" style="--card-color:#22C55E;">
    <div class="stat-icon" style="background:#F0FDF4;color:#22C55E;"><i class="fas fa-check-circle"></i></div>
    <div class="stat-value"><?php echo count(array_filter($toko, fn($t) => $t['status']==='aktif')); ?></div>
    <div class="stat-label">Toko Aktif</div>
  </div>
  <div class="stat-card" style="--card-color:#F59E0B;">
    <div class="stat-icon" style="background:#FFFBEB;color:#F59E0B;"><i class="fas fa-clock"></i></div>
    <div class="stat-value"><?php echo count(array_filter($toko, fn($t) => $t['status']==='pending')); ?></div>
    <div class="stat-label">Menunggu Persetujuan</div>
  </div>
</div>

<!-- Store List -->
<div class="dash-card">
  <div class="dash-card-header">
    <span class="dash-card-title"><i class="fas fa-store" style="color:var(--primary);margin-right:8px;"></i>Toko Saya</span>
    <a href="<?php echo base_url('dashboard/toko/tambah'); ?>" class="btn btn-primary btn-sm">
      <i class="fas fa-plus"></i> Tambah Toko
    </a>
  </div>

  <?php if (empty($toko)): ?>
    <div style="padding:48px;text-align:center;">
      <i class="fas fa-store" style="font-size:48px;color:var(--text-muted);display:block;margin-bottom:12px;"></i>
      <h3 style="font-family:var(--font-display);font-size:18px;margin-bottom:8px;">Belum Ada Toko</h3>
      <p style="color:var(--text-muted);margin-bottom:20px;">Mulai daftarkan toko elektronik Anda di sini.</p>
      <a href="<?php echo base_url('dashboard/toko/tambah'); ?>" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Tambah Toko Pertama
      </a>
    </div>
  <?php else: ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;padding:20px;">
      <?php foreach ($toko as $t): ?>
      <div style="border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;transition:all var(--transition);" class="toko-card">
        <!-- Foto -->
        <div style="height:150px;background:linear-gradient(135deg,#0F172A,#1E3A5F);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">
          <?php if (!empty($t['foto'])): ?>
            <img src="<?php echo base_url('foto/'.$t['foto']); ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php else: ?>
            <i class="fas fa-store" style="font-size:40px;color:rgba(255,255,255,0.2);"></i>
          <?php endif; ?>
          <!-- Status badge -->
          <div style="position:absolute;top:10px;right:10px;">
            <?php if ($t['status'] === 'aktif'): ?>
              <span class="badge badge-success">Aktif</span>
            <?php elseif ($t['status'] === 'pending'): ?>
              <span class="badge badge-warning">Pending</span>
            <?php else: ?>
              <span class="badge badge-danger">Nonaktif</span>
            <?php endif; ?>
          </div>
        </div>
        <!-- Info -->
        <div style="padding:16px;">
          <h3 style="font-family:var(--font-display);font-size:16px;font-weight:700;margin-bottom:4px;"><?php echo esc($t['nama_toko']); ?></h3>
          <div style="font-size:12px;color:var(--text-muted);margin-bottom:8px;">
            <span class="badge badge-primary" style="font-size:11px;"><?php echo esc($t['kategori']); ?></span>
          </div>
          <div style="font-size:12px;color:var(--text-muted);margin-bottom:12px;">
            <i class="fas fa-location-dot" style="color:var(--primary);margin-right:4px;"></i>
            <?php echo esc($t['kecamatan'] ? $t['kecamatan'].', '.$t['kota'] : $t['kota']); ?>
          </div>
          <div style="display:flex;align-items:center;gap:4px;margin-bottom:12px;">
            <i class="fas fa-star" style="color:#F59E0B;font-size:12px;"></i>
            <span style="font-weight:600;font-size:13px;"><?php echo $t['rating']; ?></span>
            <span style="color:var(--text-muted);font-size:12px;">(<?php echo $t['total_ulasan']; ?> ulasan)</span>
          </div>
          <div class="btn-actions">
            <a href="<?php echo base_url('dashboard/toko/edit/'.$t['id']); ?>" class="btn btn-sm btn-outline" style="flex:1;justify-content:center;">
              <i class="fas fa-pen"></i> Edit
            </a>
            <a href="<?php echo base_url('dashboard/toko/hapus/'.$t['id']); ?>"
               class="btn btn-sm btn-danger"
               onclick="return confirm('Hapus toko \'<?php echo esc($t['nama_toko']); ?>\'?')">
              <i class="fas fa-trash"></i>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<style>
.toko-card:hover { box-shadow:0 12px 36px rgba(0,0,0,0.1); transform:translateY(-3px); }
</style>

<?php echo view('templates/dashboard_footer'); ?>
