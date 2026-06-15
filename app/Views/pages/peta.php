<style>
  /* ========== PETA PAGE ========== */
  #petaSection {
    padding-top: 100px;
    padding-bottom: 60px;
    background: var(--dark-2);
    min-height: 100vh;
  }

  .peta-header {
    margin-bottom: 24px;
  }

  .peta-controls {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
  }

  #publicMap {
    height: 580px;
    border-radius: var(--radius-xl);
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 24px 64px rgba(0,0,0,0.4);
  }

  /* Map sidebar panel */
  .map-layout {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 20px;
    align-items: start;
  }

  .map-panel {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius-xl);
    padding: 20px;
    color: rgba(255,255,255,0.7);
  }

  .map-panel-title {
    font-family: var(--font-display);
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .store-mini-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: var(--radius-md);
    padding: 12px;
    cursor: pointer;
    transition: all var(--transition-smooth);
    margin-bottom: 8px;
  }
  
  #storeList::-webkit-scrollbar { width: 6px; }
  #storeList::-webkit-scrollbar-track { background: transparent; }
  #storeList::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 10px; }

  .store-mini-card:hover {
    background: rgba(37,99,235,0.15);
    border-color: rgba(96,165,250,0.3);
  }

  .store-mini-name {
    font-weight: 700;
    font-size: 13px;
    color: #fff;
    margin-bottom: 3px;
  }

  .store-mini-cat {
    font-size: 11px;
    color: var(--primary-light);
    margin-bottom: 3px;
  }

  .store-mini-addr {
    font-size: 11px;
    color: rgba(255,255,255,0.4);
  }

  .filter-select {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--radius-sm);
    color: #fff;
    padding: 8px 14px;
    font-family: var(--font-body);
    font-size: 13px;
    outline: none;
    cursor: pointer;
  }

  @media (max-width: 900px) {
    .map-layout { grid-template-columns: 1fr; }
    #publicMap { height: 400px; }
  }
</style>

<!-- ================================================
     PETA GIS PUBLIK
================================================ -->
<section id="petaSection">
  <div class="container">
    <div class="peta-header">
      <div class="section-label" style="color:var(--primary-light);margin-bottom:10px;">
        <i class="fas fa-satellite-dish"></i>
        <span>PETA INTERAKTIF</span>
      </div>
      <h1 style="font-family:var(--font-display);font-size:clamp(28px,3.5vw,40px);font-weight:900;color:#fff;margin-bottom:10px;">
        Peta Toko Elektronik — <span style="background:linear-gradient(135deg,#60A5FA,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Sumatera Utara</span>
      </h1>
      <p style="color:rgba(255,255,255,0.55);font-size:15px;">
        Jelajahi sebaran toko elektronik di Kota Kisaran, Kabupaten Asahan secara interaktif.
      </p>
    </div>

    <!-- Filters -->
    <div class="peta-controls">
      <select class="filter-select" id="pilihWilayah" onchange="gantiWilayah()">
        <option value="kisaran">📍 Kota Kisaran, Asahan</option>
        <option value="tanjungbalai">📍 Kota Tanjung Balai</option>
      </select>
      <select class="filter-select" id="filterKategori" onchange="filterMap()">
        <option value="">Semua Kategori</option>
        <option>Smartphone</option>
        <option>Komputer & Laptop</option>
        <option>Audio & Video</option>
        <option>Peralatan Listrik</option>
        <option>Elektronik Umum</option>
        <option>Apple Authorized</option>
        <option>Gaming</option>
        <option>Kamera & Optik</option>
        <option>Lainnya</option>
      </select>

      <button onclick="resetView()" style="padding:8px 16px;background:rgba(37,99,235,0.2);border:1px solid rgba(96,165,250,0.3);border-radius:var(--radius-sm);color:var(--primary-light);font-size:13px;cursor:pointer;font-family:var(--font-body);">
        <i class="fas fa-crosshairs"></i> Reset Tampilan
      </button>
    </div>

    <div class="map-layout">
      <!-- MAP -->
      <div>
        <div id="publicMap"></div>
        <p style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:8px;">
          <i class="fas fa-info-circle"></i> Klik marker untuk melihat detail toko.
          Data bersumber dari: OpenStreetMap.
        </p>
      </div>

      <!-- STORE LIST PANEL -->
      <div class="map-panel">
        <div class="map-panel-title">
          <i class="fas fa-store" style="color:var(--primary-light);"></i>
          Daftar Toko (<span id="storeCount">0</span>)
        </div>
        <div id="storeList" style="max-height:500px;overflow-y:auto;">
          <p style="font-size:13px;color:rgba(255,255,255,0.35);text-align:center;padding:16px;">Memuat data...</p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  const kisaran = [2.9834, 99.6167];
  const map = L.map('publicMap', {
    center: kisaran, zoom: 13, scrollWheelZoom: false
  });

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

  const storeIcon = (color = '#2563EB') => L.divIcon({
    html: `<div style="background:${color};width:30px;height:30px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><div style="transform:rotate(45deg);color:#fff;font-size:12px;">🏪</div></div>`,
    iconSize: [30,30], iconAnchor: [15,30], popupAnchor: [0,-34], className: ''
  });

  const categoryColors = {
    'Smartphone':       '#2563EB',
    'Komputer & Laptop':'#7C3AED',
    'Audio & Video':    '#059669',
    'Peralatan Listrik':'#D97706',
    'Elektronik Umum':  '#0891B2',
    'Apple Authorized': '#1D4ED8',
    'Gaming':           '#DC2626',
    'Kamera & Optik':   '#9333EA',
    'Lainnya':          '#64748B',
  };

  let allStores = [];
  let markers   = [];

  // Fetch from GeoJSON API
  fetch('<?php echo base_url('api/stores'); ?>')
    .then(r => r.json())
    .then(data => {
      allStores = data.features;
      renderMap(allStores);
    })
    .catch(() => {
      document.getElementById('storeList').innerHTML =
        '<p style="color:rgba(255,255,255,0.3);text-align:center;font-size:13px;">Gagal memuat data.</p>';
    });

  function renderMap(features) {
    // Clear existing
    markers.forEach(m => map.removeLayer(m));
    markers = [];

    document.getElementById('storeCount').textContent = features.length;

    const listEl = document.getElementById('storeList');
    listEl.innerHTML = '';

    if (features.length === 0) {
      listEl.innerHTML = '<p style="color:rgba(255,255,255,0.3);text-align:center;font-size:13px;padding:16px;">Tidak ada toko ditemukan.</p>';
      return;
    }

    features.forEach((f, i) => {
      const p    = f.properties;
      const lngs = f.geometry.coordinates;
      const lat  = lngs[1], lng = lngs[0];
      const color= categoryColors[p.category] || '#2563EB';

      const marker = L.marker([lat, lng], { icon: storeIcon(color) })
        .addTo(map)
        .bindPopup(`
          <div style="font-family:'Space Grotesk',sans-serif;min-width:210px;">
            ${p.foto ? `<div style="margin-bottom:10px; border-radius:8px; overflow:hidden; height:120px; background:#f1f5f9;"><img src="<?php echo base_url('foto/'); ?>${p.foto}" style="width:100%;height:100%;object-fit:cover;" alt="Foto Toko"></div>` : ''}
            <div style="font-weight:700;font-size:14px;color:#0F172A;margin-bottom:6px;">${p.name}</div>
            <span style="font-size:11px;background:#EFF6FF;color:#1D4ED8;padding:2px 8px;border-radius:99px;">${p.category}</span>
            <div style="margin-top:8px;font-size:12px;color:#475569;">
              <i class="fas fa-location-dot" style="color:#2563EB;margin-right:4px;"></i>${p.address}
            </div>
            ${p.phone ? `<div style="margin-top:4px;font-size:12px;color:#475569;"><i class="fas fa-phone" style="color:#2563EB;margin-right:4px;"></i>${p.phone}</div>` : ''}
            ${p.open ? `<div style="margin-top:4px;font-size:12px;color:#475569;"><i class="fas fa-clock" style="color:#2563EB;margin-right:4px;"></i>${p.open}</div>` : ''}
            <div style="margin-top:8px;display:flex;align-items:center;gap:4px;font-size:12px;">
              <i class="fas fa-star" style="color:#F59E0B;"></i>
              <strong>${p.rating}</strong>
              <span style="color:#94A3B8;">(${p.total_ulasan} ulasan)</span>
            </div>
          </div>
        `, { maxWidth: 260 });

      markers.push(marker);

      // List item
      const li = document.createElement('div');
      li.className = 'store-mini-card';
      li.style.borderLeft = `3px solid ${color}`;
      li.innerHTML = `
        <div class="store-mini-name">${p.name}</div>
        <div class="store-mini-cat">${p.category}</div>
        <div class="store-mini-addr">${p.kecamatan || p.address}</div>
      `;
      li.onclick = () => {
        map.setView([lat, lng], 16);
        marker.openPopup();
      };
      listEl.appendChild(li);
    });
  }

  window.filterMap = function() {
    const cat = document.getElementById('filterKategori').value;
    const filtered = cat
      ? allStores.filter(f => f.properties.category === cat)
      : allStores;
    renderMap(filtered);
  };

  window.resetView = function() {
    const w = document.getElementById('pilihWilayah').value;
    map.setView(w === 'kisaran' ? kisaran : [2.9649, 99.8016], 13);
    document.getElementById('filterKategori').value = '';
    renderMap(allStores);
  };

  window.gantiWilayah = function() {
    const w = document.getElementById('pilihWilayah').value;
    if (w === 'kisaran') map.setView(kisaran, 13);
    if (w === 'tanjungbalai') map.setView([2.9649, 99.8016], 13);
  };
})();
</script>
