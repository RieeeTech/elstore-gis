<style>
  /* =============================================
     FOOTER STYLES
  ============================================= */
  #siteFooter {
    background: var(--dark);
    color: rgba(255,255,255,0.65);
    padding: 72px 0 0;
  }

  .footer-grid {
    display: grid;
    grid-template-columns: 1.6fr 1fr 1fr 1fr;
    gap: 48px;
    padding-bottom: 56px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  /* Brand column */
  .footer-brand .nav-brand { margin-bottom: 16px; }
  .footer-brand .brand-name { font-size: 20px; }
  .footer-brand p {
    font-size: 14px;
    line-height: 1.75;
    color: rgba(255,255,255,0.5);
    margin-bottom: 24px;
  }

  .social-links {
    display: flex;
    gap: 10px;
  }

  .social-link {
    width: 38px; height: 38px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.55);
    font-size: 15px;
    transition: all var(--transition-smooth);
  }

  .social-link:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px var(--primary-glow);
  }

  /* Link columns */
  .footer-col h4 {
    font-family: var(--font-display);
    font-size: 14px;
    font-weight: 800;
    color: #fff;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-bottom: 20px;
  }

  .footer-col ul { display: flex; flex-direction: column; gap: 10px; }

  .footer-col a {
    font-size: 14px;
    color: rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all var(--transition-fast);
  }

  .footer-col a i {
    font-size: 11px;
    color: var(--primary-light);
    transition: transform var(--transition-fast);
  }

  .footer-col a:hover {
    color: #fff;
    padding-left: 4px;
  }

  .footer-col a:hover i { transform: translateX(3px); }

  /* Contact column */
  .contact-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
  }

  .contact-item i {
    color: var(--primary-light);
    font-size: 14px;
    margin-top: 2px;
    flex-shrink: 0;
  }

  .contact-item span {
    font-size: 14px;
    color: rgba(255,255,255,0.5);
    line-height: 1.5;
  }

  /* Bottom bar */
  .footer-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
    flex-wrap: wrap;
    gap: 12px;
  }

  .footer-bottom p {
    font-size: 13px;
    color: rgba(255,255,255,0.35);
  }

  .footer-bottom p span { color: var(--primary-light); }

  .footer-bottom-links {
    display: flex;
    gap: 20px;
  }

  .footer-bottom-links a {
    font-size: 13px;
    color: rgba(255,255,255,0.35);
    transition: color var(--transition-fast);
  }

  .footer-bottom-links a:hover { color: rgba(255,255,255,0.7); }

  /* Back to Top */
  #backToTop {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 46px; height: 46px;
    background: var(--primary);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    box-shadow: 0 6px 20px var(--primary-glow);
    cursor: pointer;
    z-index: 900;
    opacity: 0;
    transform: translateY(20px) scale(0.8);
    transition: all var(--transition-smooth);
    border: none;
  }

  #backToTop.visible {
    opacity: 1;
    transform: translateY(0) scale(1);
  }

  #backToTop:hover {
    background: var(--primary-dark);
    transform: translateY(-3px) scale(1.08);
  }

  /* ---- Responsive ---- */
  @media (max-width: 960px) {
    .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
  }

  @media (max-width: 600px) {
    .footer-grid { grid-template-columns: 1fr; }
    .footer-bottom { flex-direction: column; text-align: center; }
  }
</style>


<!-- ================================================
     FOOTER
================================================ -->
<footer id="siteFooter" id="kontak">
  <div class="container">
    <div class="footer-grid">

      <!-- Brand Column -->
      <div class="footer-brand">
        <a href="<?php echo base_url(); ?>" class="nav-brand" style="display:inline-flex; margin-bottom:16px;">
          <div class="brand-logo">
            <i class="fas fa-map-location-dot"></i>
          </div>
          <span class="brand-name">EL<span class="accent">Store</span></span>
        </a>
        <p data-i18n="footer_desc">
          Sistem Informasi Geografis untuk pemetaan toko elektronik
          di Provinsi Sumatera Utara.
          Dikembangkan oleh Mahasiswa Program Studi Sistem Informasi, Universitas Royal.
        </p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="social-link" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="social-link" aria-label="YouTube">
            <i class="fab fa-youtube"></i>
          </a>
          <a href="#" class="social-link" aria-label="GitHub">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="footer-col">
        <h4 data-i18n="footer_nav">Navigasi</h4>
        <ul>
          <li><a href="#beranda"><i class="fas fa-chevron-right"></i><span data-i18n="nav_home">Beranda</span></a></li>
          <li><a href="#tentang"><i class="fas fa-chevron-right"></i><span data-i18n="nav_about">Tentang</span></a></li>
          <li><a href="#peta"><i class="fas fa-chevron-right"></i><span data-i18n="nav_map">Peta GIS</span></a></li>
          <li><a href="#toko"><i class="fas fa-chevron-right"></i><span data-i18n="nav_stores">Toko</span></a></li>
          <li><a href="#ulasan"><i class="fas fa-chevron-right"></i><span data-i18n="nav_reviews">Ulasan</span></a></li>
        </ul>
      </div>

      <!-- Layanan -->
      <div class="footer-col">
        <h4 data-i18n="footer_service">Layanan</h4>
        <ul>
          <li><a href="<?php echo base_url('peta'); ?>"><i class="fas fa-chevron-right"></i><span data-i18n="svc_map">Peta Interaktif</span></a></li>
          <li><a href="<?php echo base_url('toko'); ?>"><i class="fas fa-chevron-right"></i><span data-i18n="svc_search">Cari Toko</span></a></li>
          <li><a href="<?php echo base_url('auth/register'); ?>"><i class="fas fa-chevron-right"></i><span data-i18n="svc_register">Daftar Toko</span></a></li>
          <li><a href="<?php echo base_url('auth/login'); ?>"><i class="fas fa-chevron-right"></i><span data-i18n="svc_admin">Admin Panel</span></a></li>
          <li><a href="<?php echo base_url('api'); ?>"><i class="fas fa-chevron-right"></i><span data-i18n="svc_api">API Publik</span></a></li>
        </ul>
      </div>

      <!-- Kontak -->
      <div class="footer-col">
        <h4 data-i18n="footer_contact">Kontak</h4>
        <div class="contact-item">
          <i class="fas fa-location-dot"></i>
          <span data-i18n="contact_address">
            Universitas Royal, Jl. Jenderal Ahmad Yani No.57,
            Kisaran, Asahan, Sumatera Utara 21214
          </span>
        </div>
        <div class="contact-item">
          <i class="fas fa-envelope"></i>
          <span>gis@universitas-royal.ac.id</span>
        </div>
        <div class="contact-item">
          <i class="fas fa-phone"></i>
          <span>+62 623 41234</span>
        </div>
      </div>

    </div><!-- /.footer-grid -->

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <p data-i18n="footer_copy">
        &copy; <?php echo date('Y'); ?> <span>ELStore GIS</span> — Universitas Royal. Hak Cipta Dilindungi.
      </p>
      <div class="footer-bottom-links">
        <a href="#" data-i18n="footer_privacy">Kebijakan Privasi</a>
        <a href="#" data-i18n="footer_terms">Syarat & Ketentuan</a>
      </div>
    </div>

  </div>
</footer>

<!-- Back to Top -->
<button id="backToTop" title="Kembali ke atas" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <i class="fas fa-chevron-up"></i>
</button>


<!-- ================================================
     SCRIPTS
================================================ -->



<!-- AOS (Animate On Scroll) -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
/* =====================================================
   1. AOS INIT
===================================================== */
AOS.init({
  duration: 700,
  easing: 'ease-out-cubic',
  once: true,
  offset: 60
});


/* =====================================================
   2. NAVBAR — SCROLL BEHAVIOUR
===================================================== */
const navbar    = document.getElementById('mainNavbar');
const backToTop = document.getElementById('backToTop');

window.addEventListener('scroll', () => {
  const y = window.scrollY;

  // Navbar glass toggle
  if (y > 60) {
    navbar.classList.remove('nav-top');
    navbar.classList.add('nav-scrolled');
  } else {
    navbar.classList.add('nav-top');
    navbar.classList.remove('nav-scrolled');
  }

  // Back-to-top button
  if (y > 400) {
    backToTop.classList.add('visible');
  } else {
    backToTop.classList.remove('visible');
  }

  // Active nav link highlight
  highlightActiveSection();
}, { passive: true });


/* =====================================================
   3. ACTIVE NAV LINK (Scroll Spy)
===================================================== */
const sections  = ['beranda','tentang','peta','toko','ulasan'];
const navAnchors = document.querySelectorAll('.nav-links a, #mobileDrawer a');

function highlightActiveSection() {
  let current = '';
  sections.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    const rect = el.getBoundingClientRect();
    if (rect.top <= 100) current = id;
  });
  navAnchors.forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
  });
}


/* =====================================================
   4. MOBILE DRAWER
===================================================== */
const hamburger    = document.getElementById('hamburger');
const mobileDrawer = document.getElementById('mobileDrawer');

function toggleDrawer() {
  const isOpen = mobileDrawer.classList.toggle('drawer-open');
  hamburger.classList.toggle('open', isOpen);
  mobileDrawer.setAttribute('aria-hidden', !isOpen);
  document.body.style.overflow = isOpen ? 'hidden' : '';
}

function closeDrawer() {
  mobileDrawer.classList.remove('drawer-open');
  hamburger.classList.remove('open');
  mobileDrawer.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
}

// Close drawer on outside click
document.addEventListener('click', e => {
  if (!mobileDrawer.contains(e.target) && !hamburger.contains(e.target)) {
    closeDrawer();
  }
});
/* =====================================================
   6. TESTIMONIAL CAROUSEL
===================================================== */
(function() {
  const track      = document.getElementById('testiTrack');
  const dotsWrap   = document.getElementById('testiDots');
  if (!track) return;

  const cards     = track.querySelectorAll('.testi-card');
  const total     = cards.length;
  let   current   = 1;          // start on index 1 (the "center" card)
  let   autoTimer = null;

  // Build dots
  cards.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = 'dot' + (i === current ? ' active' : '');
    dot.onclick   = () => goTo(i);
    dotsWrap.appendChild(dot);
  });

  function getCardWidth() {
    if (!cards[0]) return 340;
    return cards[0].offsetWidth + 24; // card width + gap
  }

  function goTo(idx) {
    // Clamp
    idx = Math.max(0, Math.min(total - 1, idx));
    current = idx;

    // Center the active card
    const wrapper = track.parentElement;
    const wrapW   = wrapper.offsetWidth;
    const cardW   = getCardWidth();
    const offset  = (wrapW / 2) - (cardW / 2) - idx * cardW;
    track.style.transform = `translateX(${offset}px)`;

    // Highlight center card
    cards.forEach((c, i) => c.classList.toggle('center', i === idx));

    // Update dots
    dotsWrap.querySelectorAll('.dot').forEach((d, i) => {
      d.classList.toggle('active', i === idx);
    });
  }

  // Initial render (wait for layout)
  window.addEventListener('load', () => goTo(current));
  window.addEventListener('resize', () => goTo(current));

  // Auto-play
  function startAuto() {
    autoTimer = setInterval(() => {
      goTo(current >= total - 1 ? 0 : current + 1);
    }, 4500);
  }

  function stopAuto() { clearInterval(autoTimer); }

  startAuto();
  track.parentElement.addEventListener('mouseenter', stopAuto);
  track.parentElement.addEventListener('mouseleave', startAuto);

  // Touch / swipe
  let startX = 0;
  track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
  track.addEventListener('touchend', e => {
    const dx = e.changedTouches[0].clientX - startX;
    if (Math.abs(dx) > 40) goTo(current + (dx < 0 ? 1 : -1));
  });

  // Expose control functions
  window.testiNext = () => { stopAuto(); goTo(current + 1); startAuto(); };
  window.testiPrev = () => { stopAuto(); goTo(current - 1); startAuto(); };
})();


/* =====================================================
   7. LEAFLET MAP INIT (Kisaran, Asahan)
===================================================== */
(function() {
  const mapEl = document.getElementById('gisMap');
  if (!mapEl) return;

  // Clear placeholder
  mapEl.innerHTML = '';

  // Kisaran city center coordinates
  const kisaran = [2.9834, 99.6167];

  const map = L.map('gisMap', {
    center: kisaran,
    zoom: 13,
    zoomControl: true,
    scrollWheelZoom: false
  });

  var peta1 = L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', { attribution: '© Google Maps', maxZoom: 20 });
  var peta2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });
  var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap', maxZoom: 19 });
  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 });
  var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', { attribution: 'Map data &copy; ArcGIS' });
  var peta6 = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });
  var peta7 = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', { maxZoom: 20, subdomains: ['mt0', 'mt1', 'mt2', 'mt3'] });

  peta3.addTo(map); // Default

  const baseLayers = {
      'Google': peta1, 'Satellite': peta2, 'OSM': peta3, 'Carto': peta4,
      'ESRI': peta5, 'Hybrid': peta6, 'Terrain': peta7,
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

  const storeIcon = (color = '#2563EB') => L.divIcon({
    html: `<div style="background:${color};width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><div style="transform:rotate(45deg);color:#fff;font-size:14px;">🏪</div></div>`,
    iconSize: [32,32], iconAnchor: [16,32], popupAnchor: [0,-36], className: ''
  });

  const categoryColors = {
    'Smartphone':       '#2563EB', 'Komputer & Laptop':'#7C3AED', 'Audio & Video':    '#059669',
    'Peralatan Listrik':'#D97706', 'Elektronik Umum':  '#0891B2', 'Apple Authorized': '#1D4ED8',
    'Gaming':           '#DC2626', 'Kamera & Optik':   '#9333EA', 'Lainnya':          '#64748B',
  };

  fetch('<?php echo base_url("api/stores"); ?>')
    .then(r => r.json())
    .then(data => {
      data.features.forEach(f => {
        const p = f.properties;
        const coords = f.geometry.coordinates;
        const color = categoryColors[p.category] || '#2563EB';
        
        L.marker([coords[1], coords[0]], { icon: storeIcon(color) })
          .addTo(map)
          .bindPopup(`
            <div style="font-family:'Space Grotesk',sans-serif;min-width:200px;">
              ${p.foto ? `<div style="margin-bottom:10px; border-radius:8px; overflow:hidden; height:120px; background:#f1f5f9;"><img src="<?php echo base_url('foto/'); ?>${p.foto}" style="width:100%;height:100%;object-fit:cover;" alt="Foto Toko"></div>` : ''}
              <strong style="font-size:14px;color:#0F172A;">${p.name}</strong><br>
              <span style="font-size:11px;color:#1D4ED8;background:#EFF6FF;padding:2px 8px;border-radius:99px;display:inline-block;margin-top:6px;">
                ${p.category}
              </span>
              <br>
              <a href="<?php echo base_url('toko/'); ?>${p.id}" style="font-size:12px;color:#2563EB;margin-top:8px;display:inline-block;">
                Lihat Detail →
              </a>
            </div>
          `, { maxWidth: 240 });
      });
    });
})();


/* =====================================================
   8. ANIMATED COUNTER (Hero Stats)
===================================================== */
function animateCounter(el, target, suffix, duration) {
  let start = 0;
  const step = target / (duration / 16);
  const timer = setInterval(() => {
    start += step;
    if (start >= target) { start = target; clearInterval(timer); }
    el.textContent = Math.floor(start) + suffix;
  }, 16);
}

// Run counters when hero is visible
const counterObs = new IntersectionObserver(entries => {
  if (entries[0].isIntersecting) {
    const storeEl = document.getElementById('stat-stores');
    if (storeEl) animateCounter(storeEl, 150, '+', 1500);
    counterObs.disconnect();
  }
}, { threshold: 0.3 });

const heroEl = document.getElementById('beranda');
if (heroEl) counterObs.observe(heroEl);

</script>

<!-- Page-specific scripts slot -->
<?php if (isset($extra_js)) echo $extra_js; ?>
</body>
</html>

