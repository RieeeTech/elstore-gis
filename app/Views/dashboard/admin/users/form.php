<?php echo view('templates/dashboard_header', $data ?? []); ?>

<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Edit Pengguna</h1>
  <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<div style="max-width:600px;">
  <div class="dash-card">
    <div class="dash-card-header">
      <span class="dash-card-title">
        <i class="fas fa-user-pen" style="color:var(--primary);margin-right:8px;"></i>
        Edit: <?php echo esc($target_user['nama_lengkap']); ?>
      </span>
    </div>
    <div style="padding:24px;">
      <form method="post" action="<?php echo base_url('admin/users/update/'.$target_user['id']); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" required
                 value="<?php echo esc($target_user['nama_lengkap']); ?>">
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" disabled
                 value="<?php echo esc($target_user['username']); ?>">
          <small style="color:var(--text-muted);font-size:12px;">Username tidak dapat diubah dari sini.</small>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" disabled
                 value="<?php echo esc($target_user['email']); ?>">
        </div>

        <div class="form-group">
          <label>Role</label>
          <select name="role" class="form-control">
            <option value="pengguna" <?php echo $target_user['role'] === 'pengguna' ? 'selected' : ''; ?>>Pengguna</option>
            <option value="pemilik_toko" <?php echo $target_user['role'] === 'pemilik_toko' ? 'selected' : ''; ?>>Pemilik Toko</option>
            <option value="admin" <?php echo $target_user['role'] === 'admin' ? 'selected' : ''; ?>>Administrator</option>
          </select>
        </div>

        <div class="form-group">
          <label>Status Akun</label>
          <select name="status" class="form-control">
            <option value="aktif" <?php echo $target_user['status'] === 'aktif' ? 'selected' : ''; ?>>Aktif</option>
            <option value="pending" <?php echo $target_user['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="nonaktif" <?php echo $target_user['status'] === 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
          </select>
        </div>

        <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:8px;">
          <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-outline">Batal</a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-floppy-disk"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php echo view('templates/dashboard_footer'); ?>
