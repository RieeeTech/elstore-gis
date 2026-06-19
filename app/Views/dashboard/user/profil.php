<?php echo view('templates/header', $data ?? []); ?>

<style>
  /* Base reset for the profile page */
  body {
    background: #05060f;
    min-height: 100vh;
  }
  
  /* Decorative glow */
  body::before {
    content: '';
    position: fixed;
    top: -10%; right: -5%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 60%);
    filter: blur(60px);
    pointer-events: none;
    z-index: 0;
  }

  .profile-container {
    max-width: 900px;
    margin: 140px auto 80px;
    padding: 0 24px;
    position: relative;
    z-index: 2;
  }

  .profile-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 32px;
    align-items: start;
  }
  @media (max-width: 768px) {
    .profile-grid {
      grid-template-columns: 1fr;
    }
  }
  
  /* Force Navbar to match dark theme */
  #mainNavbar {
    background: rgba(5, 6, 15, 0.8) !important;
    backdrop-filter: blur(20px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
    border-bottom: 1px solid rgba(255,255,255,0.05) !important;
  }
  
  .card-box {
    background: rgba(15,23,42,0.4);
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    overflow: hidden;
  }

  .profile-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-weight: 800;
    margin: 0 auto 20px;
    box-shadow: 0 12px 24px rgba(59,130,246,0.3);
  }

  .form-control-custom {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    background: rgba(255,255,255,0.03);
    color: #f8fafc;
    font-family: inherit;
    font-size: 14px;
    transition: all 0.2s ease;
  }
  .form-control-custom:focus {
    outline: none;
    border-color: #60a5fa;
    background: rgba(96,165,250,0.05);
    box-shadow: 0 0 0 3px rgba(96,165,250,0.15);
  }
  .form-control-custom:disabled {
    background: rgba(255,255,255,0.01);
    color: #64748b;
    border-color: rgba(255,255,255,0.05);
    cursor: not-allowed;
  }

  .btn-save {
    background: #60a5fa;
    color: #0f172a;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
  }
  .btn-save:hover {
    background: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(96,165,250,0.4);
  }

  .alert-box {
    padding: 16px 20px;
    border-radius: 16px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    font-size: 14px;
  }
  .alert-success {
    background: rgba(45,212,191,0.1);
    color: #2dd4bf;
    border: 1px solid rgba(45,212,191,0.3);
  }
  .alert-error {
    background: rgba(251,113,133,0.1);
    color: #fb7185;
    border: 1px solid rgba(251,113,133,0.3);
  }

  .info-list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #cbd5e1;
    font-size: 14px;
  }
  .info-list-item i {
    color: #60a5fa;
    width: 20px;
    text-align: center;
  }
</style>

<div class="profile-container" data-aos="fade-up">
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert-box alert-success">
      <i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?>
    </div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert-box alert-error">
      <i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?>
    </div>
  <?php endif; ?>

  <a href="<?php echo base_url('#beranda'); ?>" style="display:inline-flex; align-items:center; gap:8px; color:#94a3b8; text-decoration:none; font-weight:600; margin-bottom: 24px; font-size: 14px; transition: color 0.2s;" onmouseover="this.style.color='#60a5fa'" onmouseout="this.style.color='#94a3b8'">
    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
  </a>

  <h1 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:clamp(32px, 4vw, 40px);font-weight:900;color:#f8fafc;margin-bottom:32px;line-height:1.2;">Akun Saya</h1>

  <div class="profile-grid">
    <!-- Left: Profile Info -->
    <div class="card-box" style="padding: 40px 32px; text-align: center; height:fit-content;">
      <div class="profile-avatar-large">
        <?php echo strtoupper(substr($user['nama_lengkap'] ?? 'U', 0, 1)); ?>
      </div>
      <h2 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:24px;font-weight:800;color:#f8fafc;margin-bottom:6px;"><?php echo esc($user['nama_lengkap']); ?></h2>
      <div style="color:#60a5fa;font-size:13px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:24px;">
        <i class="fas fa-user-circle" style="margin-right:4px;"></i> Pengguna Biasa
      </div>
      
      <div style="text-align:left; border-top:1px dashed rgba(255,255,255,0.1); padding-top:24px; display:flex; flex-direction:column; gap:16px;">
        <div class="info-list-item"><i class="fas fa-at"></i> <?php echo esc($user['username']); ?></div>
        <div class="info-list-item"><i class="fas fa-envelope"></i> <?php echo esc($user['email']); ?></div>
        <?php if (!empty($user['no_hp'])): ?>
          <div class="info-list-item"><i class="fas fa-phone"></i> <?php echo esc($user['no_hp']); ?></div>
        <?php endif; ?>
        <div class="info-list-item"><i class="fas fa-calendar"></i> Bergabung <?php echo date('d M Y', strtotime($user['created_at'])); ?></div>
      </div>
    </div>

    <!-- Right: Edit Form -->
    <div class="card-box">
      <div style="padding: 24px 32px; border-bottom: 1px dashed rgba(255,255,255,0.1); background: rgba(0,0,0,0.2);">
        <h3 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:20px;font-weight:800;color:#f8fafc;margin:0;display:flex;align-items:center;">
          <div style="width:32px;height:32px;background:rgba(96,165,250,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-right:12px;color:#60a5fa;font-size:14px;">
            <i class="fas fa-user-pen"></i>
          </div>
          Informasi Pribadi
        </h3>
      </div>
      <div style="padding: 32px;">
        <form method="post" action="<?php echo base_url('dashboard/profil'); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <div style="margin-bottom: 24px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:#cbd5e1;">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control-custom" required value="<?php echo esc($user['nama_lengkap']); ?>">
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
            <div>
              <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:#cbd5e1;">Username <span style="font-weight:400;color:#64748b;">(Paten)</span></label>
              <input type="text" class="form-control-custom" disabled value="<?php echo esc($user['username']); ?>">
            </div>
            <div>
              <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:#cbd5e1;">Email <span style="font-weight:400;color:#64748b;">(Paten)</span></label>
              <input type="email" class="form-control-custom" disabled value="<?php echo esc($user['email']); ?>">
            </div>
          </div>

          <div style="margin-bottom: 32px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:#cbd5e1;">Nomor HP</label>
            <input type="tel" name="no_hp" class="form-control-custom" value="<?php echo esc($user['no_hp'] ?? ''); ?>" placeholder="Contoh: 08123456789">
          </div>

          <hr style="border:none;border-top:1px dashed rgba(255,255,255,0.1);margin:32px 0;">

          <h4 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:18px;font-weight:800;margin-bottom:24px;color:#f8fafc;display:flex;align-items:center;">
            <i class="fas fa-lock" style="color:#60a5fa;margin-right:10px;"></i> Ganti Kata Sandi
          </h4>

          <div style="margin-bottom: 32px;">
            <label style="display:block;margin-bottom:8px;font-weight:600;font-size:14px;color:#cbd5e1;">Kata Sandi Baru <span style="font-weight:400;color:#64748b;">(Kosongkan jika tidak diubah)</span></label>
            <input type="password" name="password_baru" class="form-control-custom" placeholder="Minimal 8 karakter" minlength="8">
          </div>

          <div style="text-align:right;">
            <button type="submit" class="btn-save">
              <i class="fas fa-floppy-disk" style="margin-right:8px;"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo view('templates/footer'); ?>
