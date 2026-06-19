<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-alert flash-success">
    <i class="fas fa-circle-check"></i> <?php echo session()->getFlashdata('success'); ?>
  </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error">
    <i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?>
  </div>
<?php endif; ?>

<!-- Stats Grid -->
<div class="stats-grid">
  <div class="stat-card" style="--card-color: #2563EB;">
    <div class="stat-icon" style="background:#EFF6FF; color:#2563EB;">
      <i class="fas fa-store"></i>
    </div>
    <div class="stat-value"><?php echo $toko_stats['total']; ?></div>
    <div class="stat-label">Total Toko</div>
    <div class="stat-change up"><i class="fas fa-arrow-up"></i> Aktif: <?php echo $toko_stats['aktif']; ?></div>
  </div>

  <div class="stat-card" style="--card-color: #22C55E;">
    <div class="stat-icon" style="background:#F0FDF4; color:#22C55E;">
      <i class="fas fa-check-circle"></i>
    </div>
    <div class="stat-value"><?php echo $toko_stats['aktif']; ?></div>
    <div class="stat-label">Toko Aktif</div>
    <div class="stat-change up"><i class="fas fa-signal"></i> Live di Peta</div>
  </div>

  <div class="stat-card" style="--card-color: #F59E0B;">
    <div class="stat-icon" style="background:#FFFBEB; color:#F59E0B;">
      <i class="fas fa-clock"></i>
    </div>
    <div class="stat-value"><?php echo $toko_stats['pending']; ?></div>
    <div class="stat-label">Menunggu Persetujuan</div>
    <?php if ($toko_stats['pending'] > 0): ?>
      <div class="stat-change down"><i class="fas fa-exclamation"></i> Perlu ditinjau</div>
    <?php endif; ?>
  </div>

  <div class="stat-card" style="--card-color: #6366F1;">
    <div class="stat-icon" style="background:#EEF2FF; color:#6366F1;">
      <i class="fas fa-users"></i>
    </div>
    <div class="stat-value"><?php echo $user_stats['total']; ?></div>
    <div class="stat-label">Total Pengguna</div>
    <div class="stat-change up">
      <i class="fas fa-store"></i> <?php echo $user_stats['pemilik_toko']; ?> Pemilik Toko
    </div>
  </div>
</div>

<!-- Grid Row -->
<div class="content-grid">

  <!-- Toko Terbaru -->
  <div class="dash-card">
    <div class="dash-card-header">
      <span class="dash-card-title"><i class="fas fa-store" style="color:var(--primary);margin-right:8px;"></i>Toko Terbaru</span>
      <a href="<?php echo base_url('admin/toko'); ?>" class="section-link">Lihat Semua <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nama Toko</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($recent_toko)): ?>
            <tr><td colspan="4" style="text-align:center;color:var(--text-muted);padding:24px;">Belum ada data toko</td></tr>
          <?php else: ?>
            <?php foreach ($recent_toko as $t): ?>
            <tr>
              <td>
                <div style="font-weight:600;color:var(--text-primary);"><?php echo esc($t['nama_toko']); ?></div>
                <div style="font-size:11px;color:var(--text-muted);"><?php echo esc($t['kota']); ?></div>
              </td>
              <td><span class="badge badge-primary"><?php echo esc($t['kategori']); ?></span></td>
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
                  <a href="<?php echo base_url('admin/toko/edit/'.$t['id']); ?>" class="btn btn-sm btn-outline">
                    <i class="fas fa-pen"></i>
                  </a>
                  <a href="<?php echo base_url('admin/toko/hapus/'.$t['id']); ?>"
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Hapus toko ini?')">
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
  </div>

  <!-- Statistik Kategori -->
  <div class="dash-card">
    <div class="dash-card-header">
      <span class="dash-card-title"><i class="fas fa-chart-pie" style="color:var(--primary);margin-right:8px;"></i>Per Kategori</span>
    </div>
    <div style="padding:20px;">
      <?php if (empty($per_kategori)): ?>
        <p style="text-align:center;color:var(--text-muted);">Belum ada data</p>
      <?php else: ?>
        <?php
        $maxTotal = max(array_column($per_kategori, 'total'));
        $colors = ['#2563EB','#22C55E','#F59E0B','#EF4444','#6366F1','#06B6D4','#EC4899','#14B8A6','#F97316'];
        ?>
        <?php foreach ($per_kategori as $i => $k): ?>
        <div style="margin-bottom:14px;">
          <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:5px;">
            <span style="font-weight:600;"><?php echo esc($k['kategori']); ?></span>
            <span style="color:var(--text-muted);"><?php echo $k['total']; ?> toko</span>
          </div>
          <div style="height:6px;background:var(--surface-3);border-radius:999px;overflow:hidden;">
            <div style="height:100%;width:<?php echo ($k['total']/$maxTotal)*100; ?>%;background:<?php echo $colors[$i % count($colors)]; ?>;border-radius:999px;transition:width 1s ease;"></div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Recent Users -->
<div class="dash-card">
  <div class="dash-card-header">
    <span class="dash-card-title"><i class="fas fa-users" style="color:var(--primary);margin-right:8px;"></i>Pengguna Terbaru</span>
    <a href="<?php echo base_url('admin/users'); ?>" class="section-link">Lihat Semua <i class="fas fa-arrow-right"></i></a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Bergabung</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recent_users)): ?>
          <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:24px;">Belum ada pengguna</td></tr>
        <?php else: ?>
          <?php foreach ($recent_users as $u): ?>
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:32px;height:32px;background:var(--primary-10);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--primary);font-size:13px;">
                  <?php echo strtoupper(substr($u['nama_lengkap'], 0, 1)); ?>
                </div>
                <div style="font-weight:600;"><?php echo esc($u['nama_lengkap']); ?></div>
              </div>
            </td>
            <td style="color:var(--text-muted);"><?php echo esc($u['email']); ?></td>
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
              <?php else: ?>
                <span class="badge badge-danger">Nonaktif</span>
              <?php endif; ?>
            </td>
            <td style="color:var(--text-muted);font-size:12px;">
              <?php echo date('d M Y', strtotime($u['created_at'])); ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php echo view('templates/dashboard_footer'); ?>
