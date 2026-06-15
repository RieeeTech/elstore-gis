<?php
$isEdit   = isset($toko) && !empty($toko);
$formAction = $isEdit
    ? (session()->get('role') === 'admin' ? base_url('admin/toko/update/'.$toko['id']) : base_url('dashboard/toko/update/'.$toko['id']))
    : (session()->get('role') === 'admin' ? base_url('admin/toko/simpan') : base_url('dashboard/toko/simpan'));
?>
<?php echo view('templates/dashboard_header', $data ?? []); ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-alert flash-error"><i class="fas fa-circle-exclamation"></i> <?php echo session()->getFlashdata('error'); ?></div>
<?php endif; ?>
<?php if (isset($errors) && !empty($errors)): ?>
  <div class="flash-alert flash-error">
    <i class="fas fa-circle-exclamation"></i>
    <ul style="list-style:disc;padding-left:16px;">
      <?php foreach ($errors as $e): ?><li><?php echo esc($e); ?></li><?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">
    <?php echo $isEdit ? 'Edit Toko' : 'Tambah Toko Baru'; ?>
  </h1>
  <?php $backUrl = session()->get('role') === 'admin' ? base_url('admin/toko') : base_url('dashboard/toko'); ?>
  <a href="<?php echo $backUrl; ?>" class="btn btn-outline">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
</div>

<form method="post" action="<?php echo $formAction; ?>" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>

  <div style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start;">

    <!-- Left: Form Fields -->
    <div>
      <!-- Info Dasar -->
      <div class="dash-card" style="margin-bottom:20px;">
        <div class="dash-card-header">
          <span class="dash-card-title"><i class="fas fa-store" style="color:var(--primary);margin-right:8px;"></i>Informasi Dasar</span>
        </div>
        <div style="padding:24px;">
          <div class="form-grid">
            <div class="form-group col-span-2">
              <label>Nama Toko <span class="req">*</span></label>
              <input type="text" name="nama_toko" class="form-control" required
                     value="<?php echo old('nama_toko', $toko['nama_toko'] ?? ''); ?>"
                     placeholder="Contoh: Samsung Store Kisaran">
            </div>

            <div class="form-group">
              <label>Kategori <span class="req">*</span></label>
              <select name="kategori" class="form-control" required>
                <option value="">— Pilih Kategori —</option>
                <?php foreach ($kategoris as $k): ?>
                  <option value="<?php echo $k; ?>"
                    <?php echo old('kategori', $toko['kategori'] ?? '') === $k ? 'selected' : ''; ?>>
                    <?php echo $k; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" name="no_telepon" class="form-control"
                     value="<?php echo old('no_telepon', $toko['no_telepon'] ?? ''); ?>"
                     placeholder="0623-12345">
            </div>

            <div class="form-group">
              <label>Email Toko</label>
              <input type="email" name="email_toko" class="form-control"
                     value="<?php echo old('email_toko', $toko['email_toko'] ?? ''); ?>"
                     placeholder="toko@email.com">
            </div>

            <div class="form-group">
              <label>Jam Operasional</label>
              <input type="text" name="jam_buka" class="form-control"
                     value="<?php echo old('jam_buka', $toko['jam_buka'] ?? ''); ?>"
                     placeholder="08:00-21:00">
            </div>

            <div class="form-group col-span-2">
              <label>Alamat Lengkap <span class="req">*</span></label>
              <textarea name="alamat" class="form-control" rows="2" required
                        placeholder="Jl. Ahmad Yani No.10, ..."><?php echo old('alamat', $toko['alamat'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
              <label>Kecamatan</label>
              <input type="text" name="kecamatan" class="form-control"
                     value="<?php echo old('kecamatan', $toko['kecamatan'] ?? ''); ?>"
                     placeholder="Kisaran Barat">
            </div>

            <div class="form-group">
              <label>Kota/Kabupaten</label>
              <input type="text" name="kota" class="form-control"
                     value="<?php echo old('kota', $toko['kota'] ?? 'Kisaran'); ?>"
                     placeholder="Kisaran">
            </div>

            <div class="form-group col-span-2">
              <label>Deskripsi Toko</label>
              <textarea name="deskripsi" class="form-control" rows="3"
                        placeholder="Jelaskan produk/layanan yang tersedia..."><?php echo old('deskripsi', $toko['deskripsi'] ?? ''); ?></textarea>
            </div>

            <?php if (session()->get('role') === 'admin'): ?>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="aktif" <?php echo (old('status', $toko['status'] ?? 'aktif')) === 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                <option value="pending" <?php echo (old('status', $toko['status'] ?? '')) === 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="nonaktif" <?php echo (old('status', $toko['status'] ?? '')) === 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
              </select>
            </div>
            <div class="form-group">
              <label>Rating (Bintang 1-5)</label>
              <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control"
                     value="<?php echo old('rating', $toko['rating'] ?? '0'); ?>" placeholder="Misal: 4.8">
            </div>
            <div class="form-group">
              <label>Total Ulasan</label>
              <input type="number" min="0" name="total_ulasan" class="form-control"
                     value="<?php echo old('total_ulasan', $toko['total_ulasan'] ?? '0'); ?>" placeholder="Misal: 150">
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Koordinat & Peta -->
      <div class="dash-card">
        <div class="dash-card-header">
          <span class="dash-card-title"><i class="fas fa-map-pin" style="color:var(--primary);margin-right:8px;"></i>Koordinat GPS</span>
          <button type="button" class="btn btn-sm btn-outline" onclick="getMyLocation()">
            <i class="fas fa-crosshairs"></i> Lokasi Saya
          </button>
        </div>
        <div style="padding:20px;">
          <div class="form-grid" style="margin-bottom:16px;">
            <div class="form-group">
              <label>Latitude <span class="req">*</span></label>
              <input type="text" name="latitude" id="latInput" class="form-control" required
                     value="<?php echo old('latitude', $toko['latitude'] ?? ''); ?>"
                     placeholder="2.9840"
                     oninput="updateMapPin()">
            </div>
            <div class="form-group">
              <label>Longitude <span class="req">*</span></label>
              <input type="text" name="longitude" id="lngInput" class="form-control" required
                     value="<?php echo old('longitude', $toko['longitude'] ?? ''); ?>"
                     placeholder="99.6180"
                     oninput="updateMapPin()">
            </div>
          </div>
          <p style="font-size:12px;color:var(--text-muted);margin-bottom:12px;">
            <i class="fas fa-info-circle"></i> Klik langsung di peta untuk mengisi koordinat otomatis.
          </p>
          <div id="pickMap" style="height:300px;border-radius:var(--radius-md);border:1px solid var(--border);overflow:hidden;"></div>
        </div>
      </div>
    </div>

    <!-- Right: Foto -->
    <div>
      <div class="dash-card">
        <div class="dash-card-header">
          <span class="dash-card-title"><i class="fas fa-image" style="color:var(--primary);margin-right:8px;"></i>Foto Toko</span>
        </div>
        <div style="padding:20px;">
          <div id="fotoPreview" style="width:100%;height:200px;border:2px dashed var(--border);border-radius:var(--radius-md);display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--text-muted);cursor:pointer;transition:all var(--transition);overflow:hidden;margin-bottom:12px;"
               onclick="document.getElementById('fotoInput').click()"
               ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
               ondragleave="this.style.borderColor='var(--border)'"
               ondrop="handleDrop(event)">
            <?php if (!empty($toko['foto'])): ?>
              <img src="<?php echo base_url('foto/'.$toko['foto']); ?>" style="width:100%;height:100%;object-fit:cover;" id="fotoImg">
            <?php else: ?>
              <i class="fas fa-cloud-upload-alt" style="font-size:32px;margin-bottom:8px;" id="uploadIcon"></i>
              <span style="font-size:13px;" id="uploadText">Klik atau drag foto di sini</span>
              <span style="font-size:11px;margin-top:4px;">JPG, JPEG, PNG — Maks 2MB</span>
              <img id="fotoImg" style="display:none;width:100%;height:100%;object-fit:cover;">
            <?php endif; ?>
          </div>
          <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none"
                 onchange="previewFoto(this)">
          <button type="button" class="btn btn-outline" style="width:100%;" onclick="document.getElementById('fotoInput').click()">
            <i class="fas fa-upload"></i> Pilih Foto
          </button>
        </div>
      </div>

      <!-- Informasi tambahan -->
      <div class="dash-card" style="margin-top:16px;">
        <div style="padding:20px;">
          <h4 style="font-size:13px;font-weight:700;margin-bottom:12px;color:var(--text-primary);">
            <i class="fas fa-circle-info" style="color:var(--primary);margin-right:6px;"></i>Panduan Pengisian
          </h4>
          <ul style="font-size:12px;color:var(--text-muted);display:flex;flex-direction:column;gap:8px;">
            <li><i class="fas fa-check" style="color:var(--success);margin-right:6px;"></i>Isi nama toko secara lengkap</li>
            <li><i class="fas fa-check" style="color:var(--success);margin-right:6px;"></i>Koordinat GPS diperlukan untuk peta</li>
            <li><i class="fas fa-check" style="color:var(--success);margin-right:6px;"></i>Gunakan tombol "Lokasi Saya" untuk koordinat otomatis</li>
            <li><i class="fas fa-check" style="color:var(--success);margin-right:6px;"></i>Foto membantu pengguna mengenali toko</li>
            <?php if (session()->get('role') !== 'admin'): ?>
            <li><i class="fas fa-info-circle" style="color:var(--warning);margin-right:6px;"></i>Data akan di-review admin sebelum aktif</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Submit -->
  <div style="margin-top:20px;display:flex;gap:12px;justify-content:flex-end;">
    <a href="<?php echo $backUrl; ?>" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary" style="min-width:160px;">
      <i class="fas fa-<?php echo $isEdit ? 'floppy-disk' : 'plus-circle'; ?>"></i>
      <?php echo $isEdit ? 'Simpan Perubahan' : 'Tambah Toko'; ?>
    </button>
  </div>
</form>

<script>
// ---- Foto preview ----
function previewFoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const img = document.getElementById('fotoImg');
      img.src = e.target.result;
      img.style.display = 'block';
      const icon = document.getElementById('uploadIcon');
      const text = document.getElementById('uploadText');
      if (icon) icon.style.display = 'none';
      if (text) text.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function handleDrop(e) {
  e.preventDefault();
  const file = e.dataTransfer.files[0];
  if (file && file.type.startsWith('image/')) {
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('fotoInput').files = dt.files;
    previewFoto(document.getElementById('fotoInput'));
  }
}

// ---- Leaflet Pick-a-point map ----
const initLat = parseFloat(document.getElementById('latInput').value) || 2.9834;
const initLng = parseFloat(document.getElementById('lngInput').value) || 99.6167;

const pickMap = L.map('pickMap', {
  center: [initLat, initLng],
  zoom: 14,
  zoomControl: true,
  scrollWheelZoom: false
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap', maxZoom: 19
}).addTo(pickMap);

const markerIcon = L.divIcon({
  html: '<div style="background:#2563EB;width:24px;height:24px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 10px rgba(37,99,235,0.5);"></div>',
  iconSize: [24, 24], iconAnchor: [12, 24], className: ''
});

let marker = L.marker([initLat, initLng], { icon: markerIcon, draggable: true }).addTo(pickMap);

marker.on('dragend', e => {
  const latlng = e.target.getLatLng();
  document.getElementById('latInput').value = latlng.lat.toFixed(7);
  document.getElementById('lngInput').value = latlng.lng.toFixed(7);
});

pickMap.on('click', e => {
  marker.setLatLng(e.latlng);
  document.getElementById('latInput').value = e.latlng.lat.toFixed(7);
  document.getElementById('lngInput').value = e.latlng.lng.toFixed(7);
});

function updateMapPin() {
  const lat = parseFloat(document.getElementById('latInput').value);
  const lng = parseFloat(document.getElementById('lngInput').value);
  if (!isNaN(lat) && !isNaN(lng)) {
    marker.setLatLng([lat, lng]);
    pickMap.setView([lat, lng], pickMap.getZoom());
  }
}

function getMyLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(pos => {
      const lat = pos.coords.latitude;
      const lng = pos.coords.longitude;
      document.getElementById('latInput').value = lat.toFixed(7);
      document.getElementById('lngInput').value = lng.toFixed(7);
      marker.setLatLng([lat, lng]);
      pickMap.setView([lat, lng], 15);
    }, () => alert('Gagal mendapatkan lokasi.'));
  } else {
    alert('Browser tidak mendukung geolokasi.');
  }
}
</script>

<?php echo view('templates/dashboard_footer'); ?>
