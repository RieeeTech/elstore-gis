<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Kelola Pengguna</h1>
  <span style="font-size:13px;color:var(--text-muted);">Total: <?php echo count($users); ?> pengguna</span>
</div>

<div class="dash-card">
  <div style="padding:16px 20px;border-bottom:1px solid var(--border);">
    <input type="text" id="searchUser" class="form-control"
           placeholder="Cari nama, email, username..."
           style="max-width:400px;"
           onkeyup="filterUsers()">
  </div>
  <div class="table-wrap">
    <table id="userTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Pengguna</th>
          <th>Username</th>
          <th>Email</th>
          <th>No. HP</th>
          <th>Role</th>
          <th>Status</th>
          <th>Login Terakhir</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($users)): ?>
          <tr><td colspan="9" style="text-align:center;color:var(--text-muted);padding:36px;">
            Belum ada pengguna terdaftar
          </td></tr>
        <?php else: ?>
          <?php foreach ($users as $i => $u): ?>
          <tr>
            <td style="color:var(--text-muted);"><?php echo $i+1; ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;background:var(--primary-10);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--primary);flex-shrink:0;">
                  <?php echo strtoupper(substr($u['nama_lengkap'], 0, 1)); ?>
                </div>
                <div style="font-weight:600;color:var(--text-primary);"><?php echo esc($u['nama_lengkap']); ?></div>
              </div>
            </td>
            <td style="color:var(--text-muted);">@<?php echo esc($u['username']); ?></td>
            <td style="font-size:13px;"><?php echo esc($u['email']); ?></td>
            <td style="font-size:13px;"><?php echo esc($u['no_hp'] ?? '-'); ?></td>
            <td>
              <?php
              $roleBadge = match($u['role']) {
                'admin'        => ['class'=>'badge-danger', 'label'=>'Admin'],
                'pemilik_toko' => ['class'=>'badge-info', 'label'=>'Pemilik Toko'],
                default        => ['class'=>'badge-primary', 'label'=>'Pengguna'],
              };
              ?>
              <span class="badge <?php echo $roleBadge['class']; ?>"><?php echo $roleBadge['label']; ?></span>
            </td>
            <td>
              <?php if ($u['status'] === 'aktif'): ?>
                <span class="badge badge-success">Aktif</span>
              <?php elseif ($u['status'] === 'pending'): ?>
                <span class="badge badge-warning">Pending</span>
              <?php else: ?>
                <span class="badge badge-danger">Nonaktif</span>
              <?php endif; ?>
            </td>
            <td style="font-size:12px;color:var(--text-muted);">
              <?php echo $u['last_login'] ? date('d M Y H:i', strtotime($u['last_login'])) : 'Belum pernah'; ?>
            </td>
            <td>
              <div class="btn-actions">
                <a href="<?php echo base_url('admin/users/edit/'.$u['id']); ?>"
                   class="btn btn-sm btn-outline" title="Edit">
                  <i class="fas fa-pen"></i>
                </a>
                <?php if ($u['id'] != session()->get('user_id')): ?>
                <form method="post" action="<?php echo base_url('admin/users/toggle/'.$u['id']); ?>" style="display:inline;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-sm <?php echo $u['status']==='aktif' ? 'btn-warning' : 'btn-success'; ?>"
                          title="<?php echo $u['status']==='aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>">
                    <i class="fas <?php echo $u['status']==='aktif' ? 'fa-lock' : 'fa-lock-open'; ?>"></i>
                  </button>
                </form>
                <a href="<?php echo base_url('admin/users/hapus/'.$u['id']); ?>"
                   class="btn btn-sm btn-danger" title="Hapus"
                   onclick="return confirm('Hapus pengguna \'<?php echo esc($u['nama_lengkap']); ?>\'?')">
                  <i class="fas fa-trash"></i>
                </a>
                <?php endif; ?>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function filterUsers() {
  const input = document.getElementById('searchUser').value.toLowerCase();
  const rows = document.querySelectorAll('#userTable tbody tr');
  rows.forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
  });
}
</script>

<?php echo view('templates/dashboard_footer'); ?>
