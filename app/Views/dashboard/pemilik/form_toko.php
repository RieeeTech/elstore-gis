<?php
// Pemilik toko form — reuses the admin toko form since it's role-aware
echo view('dashboard/admin/toko/form', $data ?? []);
?>
