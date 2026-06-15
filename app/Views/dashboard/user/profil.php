<?php echo view('templates/header', $data ?? []); ?>

<style>
  /* Base reset for the profile page */
  body {
    background: var(--surface-2);
  }
  .profile-container {
    max-width: 900px;
    margin: 140px auto 80px;
    padding: 0 20px;
  }
  .profile-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    align-items: start;
  }
  @media (max-width: 768px) {
    .profile-grid {
      grid-template-columns: 1fr;
    }
  }
  
  /* Force Navbar to be dark on this page because background is light */
  #mainNavbar {
    background: var(--glass-bg-dark) !important;
    backdrop-filter: blur(20px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
    border-bottom: 1px solid var(--glass-border) !important;
    box-shadow: 0 4px 40px rgba(0,0,0,0.4) !important;
  }
  
  .card-box {
    background: var(--surface);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    overflow: hidden;
  }
  .profile-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    font-weight: 800;
    margin: 0 auto 16px;
  }
  .form-control-custom {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background: var(--surface);
    color: var(--text-primary);
    font-family: inherit;
    font-size: 14px;
    transition: var(--transition-fast);
  }
  .form-control-custom:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px var(--primary-glow);
  }
  .form-control-custom:disabled {
    background: var(--surface-2);
    color: var(--text-muted);
  }
  .btn-save {
    background: var(--primary);
    color: #fff;
    padding: 12px 24px;
    border-radius: var(--radius-md);
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
  }
  .btn-save:hover {
    background: var(--primary-dark);
    box-shadow: 0 4px 12px var(--primary-glow);
  }
</style>

<div class="profile-container">
  <?php if (session()->getFlashdata('success')): ?>
    <div style="background: rgba(16,185,129,0.1); color: #10B981; border: 1px solid rgba(16,185,129,0.3); padding: 15px; border-radius: var(--radius-md); margin-bottom: 24px; display:flex; align-items:center; gap:10px;">
      <i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?>
    </div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('error')): ?>
    <div style="background: rgba(239,68,68,0.1); color: #EF4444; border: 1px solid rgba(239,68,68,0.3); padding: 15px; border-radius: var(--radius-md); margin-bottom: 24px; display:flex; align-items:center; gap:10px;">
      <i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?>
    </div>
  <?php endif; ?>

  <a href="<?php echo base_url('/'); ?>" style="display:inline-flex; align-items:center; gap:8px; color:var(--primary); text-decoration:none; font-weight:600; margin-bottom: 24px; font-size: 15px; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
  </a>

  <h1 style="font-family:var(--font-display);font-size:32px;font-weight:900;color:var(--text-primary);margin-bottom:30px;">Akun Saya</h1>

  <div class="profile-grid">
    <!-- Left: Profile Info -->
    <div class="card-box" style="padding: 30px; text-align: center;">
      <div class="profile-avatar-large">
        <?php echo strtoupper(substr($user['nama_lengkap'] ?? 'U', 0, 1)); ?>
      </div>
      <h2 style="font-size:20px;font-weight:700;color:var(--text-primary);margin-bottom:4px;"><?php echo esc($user['nama_lengkap']); ?></h2>
      <div style="color:var(--text-secondary);font-size:14px;margin-bottom:20px;">👤 Pengguna</div>
      
      <div style="text-align:left; border-top:1px solid var(--border); padding-top:20px; font-size:14px; color:var(--text-secondary); display:flex; flex-direction:column; gap:12px;">
        <div style="display:flex;align-items:center;gap:10px;"><i class="fas fa-at" style="color:var(--primary);width:16px;text-align:center;"></i> <?php echo esc($user['username']); ?></div>
        <div style="display:flex;align-items:center;gap:10px;"><i class="fas fa-envelope" style="color:var(--primary);width:16px;text-align:center;"></i> <?php echo esc($user['email']); ?></div>
        <?php if (!empty($user['no_hp'])): ?>
          <div style="display:flex;align-items:center;gap:10px;"><i class="fas fa-phone" style="color:var(--primary);width:16px;text-align:center;"></i> <?php echo esc($user['no_hp']); ?></div>
        <?php endif; ?>
        <div style="display:flex;align-items:center;gap:10px;"><i class="fas fa-calendar" style="color:var(--primary);width:16px;text-align:center;"></i> Bergabung <?php echo date('d M Y', strtotime($user['created_at'])); ?></div>
      </div>
    </div>

    <!-- Right: Edit Form -->
    <div class="card-box">
      <div style="padding: 24px 30px; border-bottom: 1px solid var(--border); background: var(--surface-2);">
        <h3 style="font-size:18px;font-weight:700;color:var(--text-primary);margin:0;"><i class="fas fa-user-pen" style="color:var(--primary);margin-right:8px;"></i>Informasi Pribadi</h3>
      </div>
      <div style="padding: 30px;">
        <form method="post" action="<?php echo base_url('dashboard/profil'); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <div style="margin-bottom: 20px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:var(--text-primary);">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control-custom" required value="<?php echo esc($user['nama_lengkap']); ?>">
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div>
              <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:var(--text-primary);">Username <span style="font-weight:400;color:var(--text-muted);">(paten)</span></label>
              <input type="text" class="form-control-custom" disabled value="<?php echo esc($user['username']); ?>">
            </div>
            <div>
              <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:var(--text-primary);">Email <span style="font-weight:400;color:var(--text-muted);">(paten)</span></label>
              <input type="email" class="form-control-custom" disabled value="<?php echo esc($user['email']); ?>">
            </div>
          </div>

          <div style="margin-bottom: 30px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:var(--text-primary);">Nomor HP</label>
            <input type="tel" name="no_hp" class="form-control-custom" value="<?php echo esc($user['no_hp'] ?? ''); ?>" placeholder="Contoh: 08123456789">
          </div>

          <hr style="border:none;border-top:1px solid var(--border);margin:30px 0;">

          <h4 style="font-size:16px;font-weight:700;margin-bottom:20px;color:var(--text-primary);">
            <i class="fas fa-lock" style="color:var(--primary);margin-right:6px;"></i>Ganti Kata Sandi
          </h4>

          <div style="margin-bottom: 30px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:var(--text-primary);">Kata Sandi Baru <span style="font-weight:400;color:var(--text-muted);">(kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password_baru" class="form-control-custom" placeholder="Minimal 8 karakter" minlength="8">
          </div>

          <div style="text-align:right;">
            <button type="submit" class="btn-save">
              <i class="fas fa-floppy-disk" style="margin-right:6px;"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo view('templates/footer'); ?>
