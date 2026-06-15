<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<!-- Header Row -->
<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Kelola Toko Elektronik</h1>
  <div style="display:flex; gap:12px;">
    <a href="<?php echo base_url('admin/toko/tambah'); ?>" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Toko
    </a>
  </div>
</div>

<div class="dash-card">
  <!-- Search bar & Filter -->
  <div style="padding:16px 20px;border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
    <input type="text" id="searchToko" class="form-control"
           placeholder="Cari nama toko, alamat, kecamatan..."
           style="max-width:400px; flex:1;"
           onkeyup="filterTable()">
           
    <!-- Link to Persetujuan -->
    <div>
      <a href="<?php echo base_url('admin/toko/persetujuan'); ?>" class="btn" style="background:#FFFBEB; color:#D97706; border:1px solid #FDE68A; display:flex; align-items:center; gap:8px; font-weight:600; font-size:13px; padding:8px 16px; transition:all var(--transition);">
        <i class="fas fa-clipboard-check"></i> Menunggu Persetujuan : <?php echo $pendingCount; ?>
      </a>
    </div>
  </div>


  <div class="table-wrap">
    <table id="tokoTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Toko</th>
          <th>Kategori</th>
          <th>Koordinat</th>
          <th>Telepon</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($toko)): ?>
          <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:36px;">
            <i class="fas fa-store" style="font-size:32px;display:block;margin-bottom:8px;"></i>
            Belum ada data toko
          </td></tr>
        <?php else: ?>
          <?php $no = ($page - 1) * $perPage + 1; foreach ($toko as $t): ?>
          <tr>
            <td style="color:var(--text-muted);"><?php echo $no++; ?></td>
            <td>
              <div style="font-weight:700;color:var(--text-primary);"><?php echo esc($t['nama_toko']); ?></div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">
                <i class="fas fa-location-dot" style="color:var(--primary);"></i>
                <?php echo esc($t['kecamatan'] ?? $t['kota']); ?>
              </div>
            </td>
            <td><span class="badge badge-primary" style="font-size:11px;"><?php echo esc($t['kategori']); ?></span></td>
            <td style="font-size:12px;color:var(--text-muted);">
              <div><?php echo $t['latitude']; ?></div>
              <div><?php echo $t['longitude']; ?></div>
            </td>
            <td style="font-size:13px;"><?php echo esc($t['no_telepon'] ?? '-'); ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:4px;">
                <i class="fas fa-star" style="color:#F59E0B;font-size:12px;"></i>
                <span style="font-weight:600;"><?php echo $t['rating']; ?></span>
                <span style="color:var(--text-muted);font-size:11px;">(<?php echo $t['total_ulasan']; ?>)</span>
              </div>
            </td>
            <td>
              <?php if ($t['status'] === 'aktif'): ?>
                <span class="badge badge-success">Aktif</span>
              <?php elseif ($t['status'] === 'pending'): ?>
                <span class="badge badge-warning">Pending</span>
              <?php else: ?>
                <span class="badge badge-danger">Nonaktif</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="btn-actions">
                <a href="<?php echo base_url('admin/toko/edit/'.$t['id']); ?>"
                   class="btn btn-sm btn-outline" title="Edit">
                  <i class="fas fa-pen"></i>
                </a>
                <form method="post" action="<?php echo base_url('admin/toko/toggle/'.$t['id']); ?>" style="display:inline;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-sm <?php echo $t['status']==='aktif' ? 'btn-warning' : 'btn-success'; ?>"
                          title="<?php echo $t['status']==='aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>">
                    <i class="fas <?php echo $t['status']==='aktif' ? 'fa-eye-slash' : 'fa-eye'; ?>"></i>
                  </button>
                </form>
                <a href="<?php echo base_url('admin/toko/hapus/'.$t['id']); ?>"
                   class="btn btn-sm btn-danger" title="Hapus"
                   onclick="return confirm('Hapus toko \'<?php echo esc($t['nama_toko']); ?>\'?')">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
  <div style="padding:16px 20px; border-top:1px solid var(--border); display:flex; justify-content:center;">
    <?php echo $pager->links('default', 'custom_pager'); ?>
  </div>
</div>

<script>
function filterTable() {
  const input = document.getElementById('searchToko').value.toLowerCase();
  const rows = document.querySelectorAll('#tokoTable tbody tr');
  rows.forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
  });
}
</script>

<?php echo view('templates/dashboard_footer'); ?>
