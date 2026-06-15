<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success"><i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<!-- Header Row -->
<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Daftar Persetujuan Toko Baru</h1>
  <div style="display:flex; gap:12px;">
    <a href="<?php echo base_url('admin/toko'); ?>" class="btn btn-outline">
      <i class="fas fa-arrow-left"></i> Kembali ke Kelola Toko
    </a>
  </div>
</div>

<div class="dash-card">
  <!-- Search bar -->
  <div style="padding:16px 20px;border-bottom:1px solid var(--border);">
    <input type="text" id="searchToko" class="form-control"
           placeholder="🔍  Cari pengajuan toko..."
           style="max-width:400px;"
           onkeyup="filterTable()">
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
          <tr><td colspan="8" style="text-align:center;color:var(--text-muted);padding:48px;">
            <i class="fas fa-clipboard-check" style="font-size:48px;display:block;margin-bottom:16px;color:#cbd5e1;"></i>
            <h3 style="font-family:var(--font-display);font-size:18px;margin-bottom:8px;color:var(--text-primary);">Tidak ada pengajuan toko</h3>
            <p>Saat ini tidak ada toko yang menunggu persetujuan Anda.</p>
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
              <span class="badge badge-warning">Menunggu</span>
            </td>
            <td>
              <div class="btn-actions">
                <form method="post" action="<?php echo base_url('admin/toko/toggle/'.$t['id']); ?>" style="display:inline;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="btn btn-sm btn-success" title="Setujui dan Aktifkan">
                    <i class="fas fa-check"></i> Setujui
                  </button>
                </form>
                <a href="<?php echo base_url('admin/toko/hapus/'.$t['id']); ?>"
                   class="btn btn-sm btn-danger" title="Tolak dan Hapus"
                   onclick="return confirm('Tolak dan hapus pengajuan toko \'<?php echo esc($t['nama_toko']); ?>\'?')">
                  <i class="fas fa-times"></i> Tolak
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
  const rows  = document.querySelectorAll('#tokoTable tbody tr');

  rows.forEach(row => {
    // skip if it's the empty row
    if(row.cells.length < 8) return;
    
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(input) ? '' : 'none';
  });
}
</script>

<?php echo view('templates/dashboard_footer'); ?>
