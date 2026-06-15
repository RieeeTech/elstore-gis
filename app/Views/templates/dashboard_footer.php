  </main>
</div><!-- /#main -->



<script>
/* ====================================================
   SIDEBAR TOGGLE (Mobile)
==================================================== */
const sidebar   = document.getElementById('sidebar');
const sbOverlay = document.getElementById('sbOverlay');

function toggleSidebar() {
  const isOpen = sidebar.classList.toggle('sb-open');
  sbOverlay.classList.toggle('active', isOpen);
  document.body.style.overflow = isOpen ? 'hidden' : '';
}

function closeSidebar() {
  sidebar.classList.remove('sb-open');
  sbOverlay.classList.remove('active');
  document.body.style.overflow = '';
}

// Close on resize to desktop
window.addEventListener('resize', () => {
  if (window.innerWidth > 992) closeSidebar();
});

/* ====================================================
   AUTO-DISMISS FLASH ALERTS
==================================================== */
document.querySelectorAll('.flash-alert').forEach(el => {
  setTimeout(() => {
    el.style.transition = 'opacity 0.4s';
    el.style.opacity = '0';
    setTimeout(() => el.remove(), 400);
  }, 5000);
});
</script>

<?php if (isset($extra_js)) echo $extra_js; ?>
</body>
</html>
