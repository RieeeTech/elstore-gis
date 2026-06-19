<?php
// Shared profil view — works for admin, pemilik_toko, and pengguna
$role       = session()->get('role');
$formAction = match($role) {
    'admin'        => base_url('admin/profil'),
    'pemilik_toko' => base_url('dashboard/toko/profil'),
    default        => base_url('dashboard/profil'),
};
?>
<?php echo view('templates/dashboard_header', $data ?? []); ?>

<style>
  .profil-grid {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 20px;
    align-items: start;
    max-width: 800px;
  }
  .profile-card {
    text-align: center;
  }
  .profil-info-list {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid var(--border);
  }
  .profil-info-list div {
    font-size: 12px;
    color: var(--text-muted);
    text-align: left;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .profil-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-secondary);
    word-break: break-all;
  }
  .profil-info-item i {
    color: var(--primary);
    width: 16px;
    flex-shrink: 0;
  }
  @media (max-width: 640px) {
    .profil-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }
    .profile-card {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profil-info-list {
      width: 100%;
    }
    .profil-info-list div {
      align-items: flex-start;
    }
    .profil-page-title {
      font-size: clamp(16px, 4vw, 22px) !important;
    }
  }
</style>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div style="max-width:800px;">
  <h1 class="profil-page-title" style="font-family:var(--font-display);font-size:22px;font-weight:900;margin-bottom:20px;">Profil Saya</h1>

  <div class="profil-grid">
    <!-- Profile Card -->
    <div class="profile-card">
      <div class="profile-avatar">
        <?php echo strtoupper(substr($user['nama_lengkap'] ?? 'U', 0, 1)); ?>
      </div>
      <div class="profile-name"><?php echo esc($user['nama_lengkap']); ?></div>
      <div class="profile-role">
        <?php echo match($user['role']) {
          'admin'        => 'Administrator',
          'pemilik_toko' => 'Pemilik Toko',
          default        => 'Pengguna',
        }; ?>
      </div>

      <div class="profil-info-list">
        <div>
          <div class="profil-info-item"><i class="fas fa-at"></i> <?php echo esc($user['username']); ?></div>
          <div class="profil-info-item"><i class="fas fa-envelope"></i> <?php echo esc($user['email']); ?></div>
          <?php if (!empty($user['no_hp'])): ?>
          <div class="profil-info-item"><i class="fas fa-phone"></i> <?php echo esc($user['no_hp']); ?></div>
          <?php endif; ?>
          <div class="profil-info-item"><i class="fas fa-calendar"></i> Bergabung <?php echo date('d M Y', strtotime($user['created_at'])); ?></div>
        </div>
      </div>

      <div style="margin-top:16px;">
        <span class="badge <?php echo $user['status'] === 'aktif' ? 'badge-success' : 'badge-danger'; ?>" style="font-size:12px;padding:6px 14px;">
          <i class="fas fa-circle" style="font-size:8px;"></i>
          Akun <?php echo ucfirst($user['status']); ?>
        </span>
      </div>
    </div>

    <!-- Edit Form -->
    <div class="dash-card">
      <div class="dash-card-header">
        <span class="dash-card-title"><i class="fas fa-user-pen" style="color:var(--primary);margin-right:8px;"></i>Edit Informasi Profil</span>
      </div>
      <div style="padding:24px;">
        <form method="post" action="<?php echo $formAction; ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required
                   value="<?php echo esc($user['nama_lengkap']); ?>">
          </div>

          <div class="form-group">
            <label>Username <span style="color:var(--text-muted);font-weight:400;font-size:12px;">(tidak dapat diubah)</span></label>
            <input type="text" class="form-control" disabled value="<?php echo esc($user['username']); ?>">
          </div>

          <div class="form-group">
            <label>Email <span style="color:var(--text-muted);font-weight:400;font-size:12px;">(tidak dapat diubah)</span></label>
            <input type="email" class="form-control" disabled value="<?php echo esc($user['email']); ?>">
          </div>

          <div class="form-group">
            <label>Nomor HP</label>
            <input type="tel" name="no_hp" class="form-control"
                   value="<?php echo esc($user['no_hp'] ?? ''); ?>"
                   placeholder="Contoh: 08123456789">
          </div>

          <hr style="border:none;border-top:1px solid var(--border);margin:20px 0;">

          <h4 style="font-size:14px;font-weight:700;margin-bottom:16px;color:var(--text-primary);">
            <i class="fas fa-lock" style="color:var(--primary);margin-right:6px;"></i>Ganti Kata Sandi
          </h4>

          <div class="form-group">
            <label>Kata Sandi Baru <span style="color:var(--text-muted);font-weight:400;font-size:12px;">(kosongkan jika tidak ingin ganti)</span></label>
            <input type="password" name="password_baru" class="form-control"
                   placeholder="Minimal 8 karakter" minlength="8">
          </div>

          <div style="margin-top:8px;display:flex;justify-content:flex-end;">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-floppy-disk"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= view('templates/dashboard_footer'); ?>

