<style>
  #tokoDetailPage {
    padding-top: 100px;
    padding-bottom: 80px;
    background: var(--surface-2);
    min-height: 100vh;
  }

  .detail-hero {
    height: 300px;
    border-radius: var(--radius-xl);
    overflow: hidden;
    background: linear-gradient(135deg, #0F172A, #1E3A5F);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 24px;
  }

  .detail-hero img {
    width: 100%; height: 100%;
    object-fit: cover;
  }

  .detail-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);
  }

  .detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 28px;
    margin-bottom: 20px;
  }

  .detail-map { height: 320px; border-radius: var(--radius-lg); overflow: hidden; }

  .info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
    font-size: 14px;
  }

  .info-row:last-child { border-bottom: none; }

  .info-row i {
    width: 18px;
    color: var(--primary);
    margin-top: 1px;
    flex-shrink: 0;
  }

  .info-row-label {
    font-weight: 600;
    color: var(--text-muted);
    min-width: 120px;
  }

  .info-row-val { color: var(--text-primary); }
</style>

<section id="tokoDetailPage">
  <div class="container">

    <!-- Breadcrumb -->
    <div style="margin-bottom:20px;font-size:13px;color:var(--text-muted);">
      <a href="<?php echo base_url(); ?>" style="color:var(--primary);">Beranda</a>
      &rsaquo;
      <a href="<?php echo base_url('toko'); ?>" style="color:var(--primary);">Toko</a>
      &rsaquo;
      <?php echo esc($toko['nama_toko']); ?>
    </div>

    <div style="display:grid;grid-template-columns:1fr 360px;gap:24px;align-items:start;">
      <div>
        <!-- Hero Image -->
        <div class="detail-hero">
          <?php if (!empty($toko['foto'])): ?>
            <img src="<?php echo base_url('foto/'.$toko['foto']); ?>" alt="<?php echo esc($toko['nama_toko']); ?>">
          <?php else: ?>
            <i class="fas fa-store" style="font-size:64px;color:rgba(255,255,255,0.15);"></i>
          <?php endif; ?>
          <div class="detail-hero-overlay"></div>
          <div style="position:absolute;bottom:16px;left:20px;">
            <span style="font-size:12px;background:rgba(37,99,235,0.9);color:#fff;padding:4px 12px;border-radius:999px;">
              <?php echo esc($toko['kategori']); ?>
            </span>
          </div>
        </div>

        <!-- Info Card -->
        <div class="detail-card">
          <h1 style="font-family:var(--font-display);font-size:28px;font-weight:900;color:var(--text-primary);margin-bottom:8px;">
            <?php echo esc($toko['nama_toko']); ?>
          </h1>

          <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:4px;">
              <?php for($i=1;$i<=5;$i++): ?>
                <i class="fas fa-star" style="color:<?php echo $i <= round($toko['rating']) ? '#F59E0B' : '#E2E8F0'; ?>;font-size:14px;"></i>
              <?php endfor; ?>
              <span style="font-weight:700;margin-left:4px;"><?php echo $toko['rating']; ?></span>
              <span style="color:var(--text-muted);font-size:13px;">(<?php echo $toko['total_ulasan']; ?> ulasan)</span>
            </div>
            <?php if ($toko['status'] === 'aktif'): ?>
              <span style="font-size:12px;font-weight:600;padding:4px 12px;border-radius:999px;background:#DCFCE7;color:#15803D;">
                <i class="fas fa-circle" style="font-size:8px;"></i> Aktif
              </span>
            <?php endif; ?>
          </div>

          <?php if (!empty($toko['deskripsi'])): ?>
            <p style="color:var(--text-secondary);line-height:1.75;margin-bottom:20px;font-size:15px;">
              <?php echo esc($toko['deskripsi']); ?>
            </p>
          <?php endif; ?>

          <div>
            <div class="info-row">
              <i class="fas fa-location-dot"></i>
              <div class="info-row-label">Alamat</div>
              <div class="info-row-val"><?php echo esc($toko['alamat']); ?></div>
            </div>
            <?php if (!empty($toko['kecamatan'])): ?>
            <div class="info-row">
              <i class="fas fa-map"></i>
              <div class="info-row-label">Kecamatan</div>
              <div class="info-row-val"><?php echo esc($toko['kecamatan'].', '.$toko['kota']); ?></div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['no_telepon'])): ?>
            <div class="info-row">
              <i class="fas fa-phone"></i>
              <div class="info-row-label">Telepon</div>
              <div class="info-row-val">
                <a href="tel:<?php echo $toko['no_telepon']; ?>" style="color:var(--primary);"><?php echo esc($toko['no_telepon']); ?></a>
              </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['email_toko'])): ?>
            <div class="info-row">
              <i class="fas fa-envelope"></i>
              <div class="info-row-label">Email</div>
              <div class="info-row-val">
                <a href="mailto:<?php echo $toko['email_toko']; ?>" style="color:var(--primary);"><?php echo esc($toko['email_toko']); ?></a>
              </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['jam_buka'])): ?>
            <div class="info-row">
              <i class="fas fa-clock"></i>
              <div class="info-row-label">Jam Buka</div>
              <div class="info-row-val"><?php echo esc($toko['jam_buka']); ?></div>
            </div>
            <?php endif; ?>
            <div class="info-row">
              <i class="fas fa-map-pin"></i>
              <div class="info-row-label">Koordinat</div>
              <div class="info-row-val" style="font-family:monospace;font-size:13px;">
                <?php echo $toko['latitude']; ?>, <?php echo $toko['longitude']; ?>
              </div>
            </div>
          </div>
        </div>

        <a href="<?php echo base_url('toko'); ?>" style="display:inline-flex;align-items:center;gap:8px;font-size:14px;color:var(--text-secondary);">
          <i class="fas fa-arrow-left"></i> Kembali ke Daftar Toko
        </a>
      </div>

      <!-- Map Sidebar -->
      <div>
        <div class="detail-card">
          <h3 style="font-family:var(--font-display);font-size:16px;font-weight:700;margin-bottom:16px;">
            <i class="fas fa-map-location-dot" style="color:var(--primary);margin-right:8px;"></i>
            Lokasi di Peta
          </h3>
          <div class="detail-map" id="detailMap"></div>
          <a href="https://www.google.com/maps?q=<?php echo $toko['latitude']; ?>,<?php echo $toko['longitude']; ?>"
             target="_blank"
             style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:14px;padding:10px;background:var(--surface-2);border:1px solid var(--border);border-radius:var(--radius-md);font-size:13px;font-weight:600;color:var(--text-secondary);transition:all var(--transition-fast);"
             onmouseover="this.style.borderColor='var(--primary)';this.style.color='var(--primary)'"
             onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-secondary)'">
            <i class="fab fa-google"></i> Buka di Google Maps
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  const lat  = parseFloat('<?php echo $toko['latitude']; ?>');
  const lng  = parseFloat('<?php echo $toko['longitude']; ?>');
  const name = '<?php echo esc($toko['nama_toko']); ?>';

  if (isNaN(lat) || isNaN(lng)) return;

  const map = L.map('detailMap', { center: [lat, lng], zoom: 16, zoomControl: true, scrollWheelZoom: false });

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap', maxZoom: 19
  }).addTo(map);

  const icon = L.divIcon({
    html: '<div style="background:#2563EB;width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(37,99,235,0.5);"></div>',
    iconSize: [30,30], iconAnchor: [15,30], className: ''
  });

  L.marker([lat, lng], { icon }).addTo(map)
   .bindPopup(`<strong style="font-size:13px;">${name}</strong>`).openPopup();
})();
</script>

<style>
  @media (max-width: 900px) {
    #tokoDetailPage .container > div > div:first-child + div { display: none; }
    #tokoDetailPage .container > div { grid-template-columns: 1fr !important; }
  }
</style>
