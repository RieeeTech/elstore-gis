<style>
  #tokoDetailPage {
    padding-top: 120px;
    padding-bottom: 80px;
    background: #05060f;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
  }

  #tokoDetailPage::before {
    content: '';
    position: absolute;
    top: -10%; right: -5%;
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 60%);
    filter: blur(60px);
    pointer-events: none;
    z-index: 0;
  }

  .lp-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
  }

  .breadcrumb-v {
    margin-bottom: 32px;
    font-size: 14px;
    color: #94a3b8;
    font-weight: 600;
  }
  .breadcrumb-v a {
    color: #60a5fa;
    transition: all 0.2s;
  }
  .breadcrumb-v a:hover { color: #93c5fd; }

  .detail-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 32px;
    align-items: start;
  }

  .detail-hero {
    height: 360px;
    border-radius: 24px;
    overflow: hidden;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-bottom: 32px;
    border: 1px solid rgba(255,255,255,0.08);
  }

  .detail-hero img {
    width: 100%; height: 100%;
    object-fit: cover;
  }

  .detail-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(5,6,15,1) 0%, transparent 70%);
  }

  .detail-card {
    background: rgba(15,23,42,0.4);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px;
    padding: 32px;
    margin-bottom: 24px;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
  }

  .detail-map { 
    height: 340px; 
    border-radius: 16px; 
    overflow: hidden; 
    border: 1px solid rgba(255,255,255,0.1);
  }

  .info-row {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px dashed rgba(255,255,255,0.1);
    font-size: 15px;
  }

  .info-row:last-child { border-bottom: none; }

  .info-row i {
    width: 20px;
    color: #60a5fa;
    margin-top: 2px;
    flex-shrink: 0;
    font-size: 16px;
    text-align: center;
  }

  .info-row-label {
    font-weight: 600;
    color: #94a3b8;
    min-width: 120px;
  }

  .info-row-val { color: #f8fafc; line-height: 1.6; }
  .info-row-val a { color: #60a5fa; transition: color 0.2s; }
  .info-row-val a:hover { color: #93c5fd; }

  .btn-outline-glass {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    color: #f8fafc;
    transition: all 0.3s;
    width: 100%;
    margin-top: 20px;
  }
  .btn-outline-glass:hover {
    background: #60a5fa;
    color: #0f172a;
    border-color: #60a5fa;
    box-shadow: 0 4px 16px rgba(96,165,250,0.4);
  }

  @media (max-width: 900px) {
    .detail-grid { grid-template-columns: 1fr; }
  }
</style>

<section id="tokoDetailPage">
  <div class="lp-container">

    <!-- Breadcrumb -->
    <div class="breadcrumb-v" data-aos="fade-in">
      <a href="<?= base_url('#beranda') ?>">Beranda</a>
      <span style="margin:0 8px;color:#475569;">&rsaquo;</span>
      <a href="<?= base_url('toko') ?>">Daftar Toko</a>
      <span style="margin:0 8px;color:#475569;">&rsaquo;</span>
      <span style="color:#f8fafc;"><?= esc($toko['nama_toko']) ?></span>
    </div>

    <div class="detail-grid">
      <div data-aos="fade-up">
        <!-- Hero Image -->
        <div class="detail-hero">
          <?php if (!empty($toko['foto'])): ?>
            <img src="<?= base_url('foto/'.$toko['foto']) ?>" alt="<?= esc($toko['nama_toko']) ?>">
          <?php else: ?>
            <i class="fas fa-store" style="font-size:80px;color:rgba(255,255,255,0.05);"></i>
          <?php endif; ?>
          <div class="detail-hero-overlay"></div>
          <div style="position:absolute;bottom:24px;left:32px;">
            <span style="font-size:13px; font-weight:700; letter-spacing:1px; text-transform:uppercase; background:rgba(96,165,250,0.2); color:#60a5fa; padding:6px 16px; border-radius:999px; backdrop-filter:blur(8px); border:1px solid rgba(96,165,250,0.3);">
              <?= esc($toko['kategori']) ?>
            </span>
          </div>
        </div>

        <!-- Info Card -->
        <div class="detail-card">
          <h1 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:clamp(28px, 4vw, 36px);font-weight:900;color:#f8fafc;margin-bottom:12px;line-height:1.2;">
            <?= esc($toko['nama_toko']) ?>
          </h1>

          <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:6px;">
              <?php for($i=1;$i<=5;$i++): ?>
                <i class="fas fa-star" style="color:<?= $i <= round($toko['rating']) ? '#F59E0B' : '#334155' ?>;font-size:16px;"></i>
              <?php endfor; ?>
              <span style="font-weight:800; color:#f8fafc; margin-left:4px; font-size:16px;"><?= $toko['rating'] ?></span>
              <span style="color:#94a3b8;font-size:14px;">(<?= $toko['total_ulasan'] ?> ulasan)</span>
            </div>
            <?php if ($toko['status'] === 'aktif'): ?>
              <span style="font-size:13px;font-weight:700;padding:4px 12px;border-radius:999px;background:rgba(45,212,191,0.1);color:#2dd4bf;border:1px solid rgba(45,212,191,0.3);">
                <i class="fas fa-circle" style="font-size:8px;margin-right:4px;"></i> Aktif
              </span>
            <?php endif; ?>
          </div>

          <?php if (!empty($toko['deskripsi'])): ?>
            <div style="padding:24px; background:rgba(255,255,255,0.03); border-radius:16px; border:1px solid rgba(255,255,255,0.05); margin-bottom:32px;">
              <p style="color:#cbd5e1;line-height:1.8;font-size:15px; margin:0;">
                <?= esc($toko['deskripsi']) ?>
              </p>
            </div>
          <?php endif; ?>

          <div>
            <div class="info-row">
              <i class="fas fa-location-dot"></i>
              <div class="info-row-label">Alamat</div>
              <div class="info-row-val"><?= esc($toko['alamat']) ?></div>
            </div>
            <?php if (!empty($toko['kecamatan'])): ?>
            <div class="info-row">
              <i class="fas fa-map"></i>
              <div class="info-row-label">Kecamatan</div>
              <div class="info-row-val"><?= esc($toko['kecamatan'].', '.$toko['kota']) ?></div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['no_telepon'])): ?>
            <div class="info-row">
              <i class="fas fa-phone"></i>
              <div class="info-row-label">Telepon</div>
              <div class="info-row-val">
                <a href="tel:<?= $toko['no_telepon'] ?>"><?= esc($toko['no_telepon']) ?></a>
              </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['email_toko'])): ?>
            <div class="info-row">
              <i class="fas fa-envelope"></i>
              <div class="info-row-label">Email</div>
              <div class="info-row-val">
                <a href="mailto:<?= $toko['email_toko'] ?>"><?= esc($toko['email_toko']) ?></a>
              </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($toko['jam_buka'])): ?>
            <div class="info-row">
              <i class="fas fa-clock" style="color:#fb7185;"></i>
              <div class="info-row-label">Jam Buka</div>
              <div class="info-row-val"><?= esc($toko['jam_buka']) ?></div>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Back Button -->
        <a href="<?= base_url('#beranda') ?>" style="display:inline-flex; align-items:center; gap:8px; padding:14px 24px; background:rgba(255,255,255,0.05); color:#94a3b8; border:1px solid rgba(255,255,255,0.1); border-radius:12px; font-weight:600; font-size:14px; transition:all 0.2s; margin-top: 8px;" onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#f8fafc';" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#94a3b8';">
          <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

      </div>

      <!-- Map Sidebar -->
      <div data-aos="fade-up" data-aos-delay="100">
        <div class="detail-card" style="position:sticky; top:120px;">
          <h3 style="font-family:var(--font-display, 'Outfit', sans-serif);font-size:18px;font-weight:800;color:#f8fafc;margin-bottom:20px;display:flex;align-items:center;">
            <div style="width:36px;height:36px;background:rgba(96,165,250,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-right:12px;color:#60a5fa;">
              <i class="fas fa-map-location-dot"></i>
            </div>
            Lokasi di Peta
          </h3>
          <div class="detail-map" id="detailMap"></div>
          <a href="https://www.google.com/maps?q=<?= $toko['latitude'] ?>,<?= $toko['longitude'] ?>"
             target="_blank"
             class="btn-outline-glass">
            <i class="fab fa-google"></i> Buka di Google Maps
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  const lat  = parseFloat('<?= $toko['latitude'] ?>');
  const lng  = parseFloat('<?= $toko['longitude'] ?>');
  const name = '<?= esc(addslashes($toko['nama_toko'])) ?>';

  if (isNaN(lat) || isNaN(lng)) return;

  const map = L.map('detailMap', { center: [lat, lng], zoom: 16, zoomControl: true, scrollWheelZoom: false });

  L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap & CARTO', maxZoom: 19
  }).addTo(map);

  const icon = L.divIcon({
    html: '<div style="width:24px;height:24px;border-radius:50%;background:#60a5fa;border:4px solid rgba(255,255,255,0.9);box-shadow:0 0 16px rgba(96,165,250,0.8), 0 0 32px rgba(96,165,250,0.4);position:relative;"><div style="content:\'\';position:absolute;bottom:-12px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:8px solid transparent;border-right:8px solid transparent;border-top:12px solid rgba(255,255,255,0.9);"></div></div>',
    iconSize: [24,36], iconAnchor: [12,36], popupAnchor: [0,-36], className: ''
  });

  L.marker([lat, lng], { icon }).addTo(map)
   .bindPopup(`<div style="font-family:\'Outfit\',sans-serif;font-weight:700;color:#0f172a;padding:4px;">${name}</div>`).openPopup();
})();
</script>
