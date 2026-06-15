<?php echo view('templates/dashboard_header', $data ?? []); ?>

<div class="section-head" style="margin-bottom:20px;">
  <h1 style="font-family:var(--font-display);font-size:22px;font-weight:900;">Peta GIS — Admin</h1>
</div>

<div class="dash-card">
  <div class="dash-card-header">
    <span class="dash-card-title">
      <i class="fas fa-map-location-dot" style="color:var(--primary);margin-right:8px;"></i>
      Sebaran Toko Elektronik — Kisaran, Asahan
    </span>
    <span style="font-size:13px;color:var(--text-muted);"><?php echo count($stores); ?> toko terpetakan</span>
  </div>
  <div style="padding:20px;">
    <div id="dashMap" style="height:560px;"></div>
  </div>
</div>

<script>
(function() {
  const stores = <?php echo json_encode($stores); ?>;
  const map = L.map('dashMap', { center: [2.9834, 99.6167], zoom: 13, scrollWheelZoom: false });

  var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      attribution: '© Google Maps',
      maxZoom: 20,
  });

  var peta2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  });

  var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      maxZoom: 19
  });

  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      maxZoom: 19,
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
          '<a href="https://carto.com/attributions">CARTO</a>'
  });

  var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
      attribution: 'Map data &copy; <a href="https://www.arcgis.com/">ArcGIS</a>'
  });

  var peta6 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
  });

  var peta7 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
      attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google Maps</a>'
  });

  peta3.addTo(map); // Default layer

  const baseLayers = {
      'Google': peta1,
      'Satellite': peta2,
      'OSM': peta3,
      'Carto': peta4,
      'ESRI': peta5,
      'Hybrid': peta6,
      'Terrain': peta7,
  };

  L.control.layers(baseLayers, null, {collapsed: false}).addTo(map);

  const regionControl = L.control({position: 'topleft'});
  regionControl.onAdd = function () {
      var div = L.DomUtil.create('div', 'leaflet-control leaflet-bar');
      var select = L.DomUtil.create('select', '', div);
      select.style.cssText = "padding:6px 12px;border:none;outline:none;font-weight:600;font-size:13px;cursor:pointer;background:#fff;color:#0F172A;";
      
      var opt1 = document.createElement('option');
      opt1.value = 'kisaran';
      opt1.text = '📍 Kisaran, Asahan';
      select.appendChild(opt1);
      
      var opt2 = document.createElement('option');
      opt2.value = 'tanjungbalai';
      opt2.text = '📍 Tanjung Balai';
      select.appendChild(opt2);
      
      select.onchange = function() {
          if(this.value === 'kisaran') {
              map.setView([2.9834, 99.6167], 13);
          } else {
              map.setView([2.9649, 99.8016], 13);
          }
      };
      
      L.DomEvent.disableClickPropagation(div);
      return div;
  };
  regionControl.addTo(map);

  const catColors = {
    'Smartphone': '#2563EB', 'Komputer & Laptop':'#7C3AED', 'Audio & Video': '#059669',
    'Peralatan Listrik':'#D97706', 'Elektronik Umum': '#0891B2', 'Apple Authorized': '#1D4ED8',
    'Gaming': '#DC2626', 'Kamera & Optik': '#9333EA', 'Lainnya': '#64748B'
  };

  const storeIcon = (color = '#2563EB') => L.divIcon({
    html: `<div style="background:${color};width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><div style="transform:rotate(45deg);color:#fff;font-size:14px;">🏪</div></div>`,
    iconSize: [32,32], iconAnchor: [16,32], popupAnchor: [0,-36], className: ''
  });

  stores.forEach(s => {
    if (!s.latitude || !s.longitude) return;

    const color = catColors[s.kategori] || '#2563EB';

    L.marker([parseFloat(s.latitude), parseFloat(s.longitude)], { icon: storeIcon(color) })
      .addTo(map)
      .bindPopup(`
        <div style="font-family:'Space Grotesk',sans-serif;min-width:200px;">
          ${s.foto ? `<div style="margin-bottom:10px; border-radius:8px; overflow:hidden; height:120px; background:#f1f5f9;"><img src="<?php echo base_url('foto/'); ?>${s.foto}" style="width:100%;height:100%;object-fit:cover;" alt="Foto Toko"></div>` : ''}
          <div style="font-weight:700;font-size:14px;color:#0F172A;margin-bottom:6px;">${s.nama_toko}</div>
          <span style="font-size:11px;background:#EFF6FF;color:#2563EB;padding:2px 8px;border-radius:99px;">${s.kategori}</span>
          <div style="margin-top:8px;font-size:12px;color:#475569;">
            <i class="fas fa-location-dot" style="color:#2563EB;margin-right:4px;"></i>${s.alamat}
          </div>
          ${s.no_telepon ? `<div style="margin-top:4px;font-size:12px;color:#475569;"><i class="fas fa-phone" style="color:#2563EB;margin-right:4px;"></i>${s.no_telepon}</div>` : ''}
          <div style="margin-top:8px;">
            <a href="<?php echo base_url('admin/toko/edit/'); ?>${s.id}" style="font-size:12px;color:#2563EB;font-weight:600;">Edit Toko →</a>
          </div>
        </div>
      `);
  });
})();
</script>

<?php echo view('templates/dashboard_footer'); ?>
