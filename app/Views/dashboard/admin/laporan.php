<?php echo view('templates/dashboard_header', $data ?? []); ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<style>
/* Adjust datatable styles to fit dashboard theme */
.dataTables_wrapper {
  font-family: var(--font-b);
  font-size: 14px;
}
.dataTables_wrapper .dataTables_filter input {
  border: 1px solid var(--border);
  border-radius: 6px;
  padding: 4px 10px;
  margin-left: 8px;
}
.dataTables_wrapper .dt-buttons .dt-button {
  background: var(--surface-2);
  border: 1px solid var(--border);
  border-radius: 6px;
  color: var(--text-2);
  font-weight: 600;
  transition: all 0.2s;
}
.dataTables_wrapper .dt-buttons .dt-button:hover {
  background: var(--primary);
  color: #fff;
  border-color: var(--primary);
}
table.dataTable thead th, table.dataTable thead td {
  border-bottom: 2px solid var(--border);
}
table.dataTable.no-footer {
  border-bottom: 1px solid var(--border);
}
</style>
<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Laporan & Statistik</h1>
</div>

<!-- Summary Stats -->
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr);">
  <div class="stat-card" style="--card-color:#2563EB;">
    <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="fas fa-store"></i></div>
    <div class="stat-value"><?php echo $total_toko; ?></div>
    <div class="stat-label">Total Toko Aktif</div>
  </div>
  <div class="stat-card" style="--card-color:#22C55E;">
    <div class="stat-icon" style="background:#F0FDF4;color:#22C55E;"><i class="fas fa-map-marker-alt"></i></div>
    <div class="stat-value">2</div>
    <div class="stat-label">Wilayah Terpetakan</div>
  </div>
  <div class="stat-card" style="--card-color:#F59E0B;">
    <div class="stat-icon" style="background:#FFFBEB;color:#F59E0B;"><i class="fas fa-tags"></i></div>
    <div class="stat-value"><?php echo count($per_kategori); ?></div>
    <div class="stat-label">Kategori Toko</div>
  </div>
</div>

<!-- Detailed Table -->
<div class="dash-card">
  <div class="dash-card-header">
    <span class="dash-card-title"><i class="fas fa-list" style="color:var(--primary);margin-right:8px;"></i>Detail Semua Toko</span>
  </div>
  <div style="padding:24px; overflow-x:auto;">
    <table id="laporanTable" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Foto</th>
          <th>Nama Toko</th>
          <th>Kategori</th>
          <th>Kota/Kabupaten</th>
          <th>Jam Buka</th>
          <th>Status</th>
          <th>Rating</th>
          <th>Ulasan</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($semua_toko as $t): ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td style="text-align:center;">
            <?php if(!empty($t['foto']) && file_exists(FCPATH . 'foto/' . $t['foto'])): ?>
              <img src="<?php echo base_url('foto/'.$t['foto']); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:6px;" alt="Foto <?php echo esc($t['nama_toko']); ?>">
              <span style="display:none;">[Ada Gambar]</span>
            <?php else: ?>
              <span style="color:#94a3b8;font-size:12px;font-style:italic;">Tidak Ada</span>
            <?php endif; ?>
          </td>
          <td style="font-weight:600;"><?php echo esc($t['nama_toko']); ?></td>
          <td><?php echo esc($t['kategori']); ?></td>
          <td><?php echo esc($t['kota']); ?></td>
          <td><?php echo esc($t['jam_buka']); ?></td>
          <td>
            <?php if($t['status'] === 'aktif'): ?>
              <span style="color:#10B981;font-weight:600;"><i class="fas fa-check-circle"></i> Aktif</span>
            <?php elseif($t['status'] === 'pending'): ?>
              <span style="color:#F59E0B;font-weight:600;"><i class="fas fa-clock"></i> Pending</span>
            <?php else: ?>
              <span style="color:#EF4444;font-weight:600;"><i class="fas fa-times-circle"></i> Nonaktif</span>
            <?php endif; ?>
          </td>
          <td><i class="fas fa-star" style="color:#FBBF24;"></i> <?php echo $t['rating']; ?></td>
          <td><?php echo $t['total_ulasan']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Category Table -->
<div class="dash-card" style="margin-top:24px;">
  <div class="dash-card-header">
    <span class="dash-card-title"><i class="fas fa-chart-bar" style="color:var(--primary);margin-right:8px;"></i>Distribusi per Kategori</span>
  </div>
  <div style="padding:24px;">
    <?php
    $totalAll = array_sum(array_column($per_kategori, 'total'));
    $colors = ['#2563EB','#22C55E','#F59E0B','#EF4444','#6366F1','#06B6D4','#EC4899','#14B8A6','#F97316'];
    ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Kategori</th>
          <th>Jumlah Toko</th>
          <th>Persentase</th>
          <th>Grafik</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($per_kategori as $i => $k): ?>
        <tr>
          <td><?php echo $i+1; ?></td>
          <td style="font-weight:600;"><?php echo esc($k['kategori']); ?></td>
          <td>
            <span style="font-family:var(--font-display);font-size:18px;font-weight:900;color:<?php echo $colors[$i % count($colors)]; ?>;">
              <?php echo $k['total']; ?>
            </span>
          </td>
          <td><?php echo round(($k['total']/$totalAll)*100, 1); ?>%</td>
          <td style="width:200px;">
            <div style="height:8px;background:var(--surface-3);border-radius:999px;overflow:hidden;">
              <div style="height:100%;width:<?php echo ($k['total']/$totalAll)*100; ?>%;background:<?php echo $colors[$i % count($colors)]; ?>;border-radius:999px;"></div>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr style="background:var(--surface-2);">
          <td colspan="2" style="font-weight:700;color:var(--text-primary);">TOTAL</td>
          <td style="font-family:var(--font-display);font-size:18px;font-weight:900;"><?php echo $totalAll; ?></td>
          <td>100%</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php ob_start(); ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#laporanTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                title: 'Laporan Data Toko ELStore GIS',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8], // Exclude index 1 (Foto)
                    format: {
                        body: function ( data, row, column, node ) {
                            return $(node).text().trim();
                        }
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                title: 'Laporan Data Toko ELStore GIS',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    format: {
                        body: function ( data, row, column, node ) {
                            if (column === 1) {
                                var img = $(node).find('img')[0];
                                if (img) {
                                    var canvas = document.createElement("canvas");
                                    canvas.width = 40;
                                    canvas.height = 40;
                                    var ctx = canvas.getContext("2d");
                                    ctx.drawImage(img, 0, 0, 40, 40);
                                    return '[IMG_BASE64:' + canvas.toDataURL("image/jpeg") + ']';
                                }
                                return 'Tidak Ada';
                            }
                            return $(node).text().trim();
                        }
                    }
                },
                customize: function(doc) {
                    doc.styles.title = {
                        color: '#1e293b',
                        fontSize: '20',
                        alignment: 'center',
                        bold: true,
                        margin: [0, 0, 0, 20]
                    };
                    doc.styles.tableHeader = {
                        fillColor: '#2563eb',
                        color: 'white',
                        alignment: 'center',
                        bold: true,
                        margin: [0, 5, 0, 5]
                    };
                    // Set proportional widths for all 9 columns
                    doc.content[1].table.widths = ['auto','auto','*','*','*','auto','auto','auto','auto'];
                    
                    var body = doc.content[1].table.body;
                    for (var i = 1; i < body.length; i++) {
                        var cellData = body[i][1];
                        if (cellData && cellData.text && cellData.text.toString().indexOf('[IMG_BASE64:') === 0) {
                            var base64 = cellData.text.toString().replace('[IMG_BASE64:', '').replace(']', '');
                            body[i][1] = {
                                image: base64,
                                width: 30,
                                height: 30,
                                alignment: 'center'
                            };
                        }
                    }
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Cetak Tabel',
                title: '<div style="text-align:center; margin-bottom:20px;"><h2 style="color:#1e293b; margin:0;">Laporan Data Toko ELStore GIS</h2><p style="color:#64748b; margin-top:5px; font-size:14px;">Dicetak pada: '+new Date().toLocaleDateString('id-ID')+'</p></div>',
                exportOptions: {
                    stripHtml: false
                },
                customize: function (win) {
                    $(win.document.body).css('font-family', 'sans-serif').css('background', '#fff');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', '13px')
                        .css('border-collapse', 'collapse')
                        .css('width', '100%');
                    $(win.document.body).find('th, td')
                        .css('border', '1px solid #cbd5e1')
                        .css('padding', '10px');
                    $(win.document.body).find('th')
                        .css('background-color', '#2563eb')
                        .css('color', '#ffffff')
                        .css('font-weight', '700');
                    $(win.document.body).find('img')
                        .css('border-radius', '4px')
                        .css('width', '40px').css('height', '40px').css('object-fit', 'cover');
                    
                    // Hide header action/print button if exists in body
                    $(win.document.body).find('.section-head, .dt-buttons, .dataTables_filter, .dataTables_info, .dataTables_paginate').css('display', 'none');
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });
});
</script>
<?php $extra_js = ob_get_clean(); ?>

<?php echo view('templates/dashboard_footer', ['extra_js' => $extra_js]); ?>
