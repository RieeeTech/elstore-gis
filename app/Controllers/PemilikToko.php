<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * PemilikToko Controller
 * Route: /dashboard/toko
 * Hanya untuk role pemilik_toko
 */
class PemilikToko extends BaseController
{
    protected TokoModel $tokoModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->userModel = new UserModel();
        helper('form');
    }

    // ----------------------------------------------------------------
    /** Cek apakah user adalah pemilik_toko */
    private function checkRole(): ?ResponseInterface
    {
        $role = session()->get('role');
        if (! in_array($role, ['pemilik_toko', 'admin'], true)) {
            return redirect()->to(base_url('dashboard'))
                             ->with('error', 'Akses ditolak.');
        }
        return null;
    }

    // ----------------------------------------------------------------
    /** GET /dashboard/toko */
    public function index(): string
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $userId = session()->get('user_id');
        $role   = session()->get('role');

        // Admin bisa lihat semua, pemilik hanya tokonya sendiri
        $toko = ($role === 'admin')
            ? $this->tokoModel->findAll()
            : $this->tokoModel->getByOwner($userId);

        $data = [
            'page_title' => 'Dashboard Pemilik Toko',
            'user'       => $this->userModel->find($userId),
            'toko'       => $toko,
            'lang'       => session()->get('lang') ?? 'id',
        ];

        return view('dashboard/pemilik/index', $data);
    }

    // ----------------------------------------------------------------
    /** GET /dashboard/toko/tambah */
    public function tambah(): string
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $data = [
            'page_title'  => 'Tambah Toko',
            'user'        => $this->userModel->find(session()->get('user_id')),
            'lang'        => session()->get('lang') ?? 'id',
            'kategoris'   => $this->getKategoris(),
        ];

        return view('dashboard/pemilik/form_toko', $data);
    }

    // ----------------------------------------------------------------
    /** POST /dashboard/toko/simpan */
    public function simpan(): ResponseInterface
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $rules = [
            'nama_toko' => 'required|min_length[3]|max_length[150]',
            'kategori'  => 'required',
            'alamat'    => 'required',
            'latitude'  => 'required|decimal',
            'longitude' => 'required|decimal',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');

        $data = [
            'user_id'    => $userId,
            'nama_toko'  => $this->request->getPost('nama_toko'),
            'kategori'   => $this->request->getPost('kategori'),
            'alamat'     => $this->request->getPost('alamat'),
            'kecamatan'  => $this->request->getPost('kecamatan'),
            'kota'       => $this->request->getPost('kota') ?: 'Kisaran',
            'provinsi'   => 'Sumatera Utara',
            'latitude'   => $this->request->getPost('latitude'),
            'longitude'  => $this->request->getPost('longitude'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email_toko' => $this->request->getPost('email_toko'),
            'jam_buka'   => $this->request->getPost('jam_buka'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'status'     => session()->get('role') === 'admin' ? 'aktif' : 'pending',
        ];

        // Handle foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->tokoModel->insert($data);

        return redirect()->to(base_url('dashboard/toko'))
                         ->with('success', 'Toko berhasil ditambahkan.');
    }

    // ----------------------------------------------------------------
    /** GET /dashboard/toko/edit/(:num) */
    public function edit(int $id): string
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $toko   = $this->tokoModel->find($id);
        $userId = session()->get('user_id');

        if (! $toko || ($toko['user_id'] != $userId && session()->get('role') !== 'admin')) {
            return redirect()->to(base_url('dashboard/toko'))
                             ->with('error', 'Toko tidak ditemukan.');
        }

        $data = [
            'page_title' => 'Edit Toko',
            'user'       => $this->userModel->find($userId),
            'toko'       => $toko,
            'kategoris'  => $this->getKategoris(),
            'lang'       => session()->get('lang') ?? 'id',
        ];

        return view('dashboard/pemilik/form_toko', $data);
    }

    // ----------------------------------------------------------------
    /** POST /dashboard/toko/update/(:num) */
    public function update(int $id): ResponseInterface
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $toko   = $this->tokoModel->find($id);
        $userId = session()->get('user_id');

        if (! $toko || ($toko['user_id'] != $userId && session()->get('role') !== 'admin')) {
            return redirect()->to(base_url('dashboard/toko'))
                             ->with('error', 'Toko tidak ditemukan.');
        }

        $rules = [
            'nama_toko' => 'required|min_length[3]|max_length[150]',
            'kategori'  => 'required',
            'alamat'    => 'required',
            'latitude'  => 'required|decimal',
            'longitude' => 'required|decimal',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_toko'  => $this->request->getPost('nama_toko'),
            'kategori'   => $this->request->getPost('kategori'),
            'alamat'     => $this->request->getPost('alamat'),
            'kecamatan'  => $this->request->getPost('kecamatan'),
            'kota'       => $this->request->getPost('kota') ?: 'Kisaran',
            'latitude'   => $this->request->getPost('latitude'),
            'longitude'  => $this->request->getPost('longitude'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email_toko' => $this->request->getPost('email_toko'),
            'jam_buka'   => $this->request->getPost('jam_buka'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
        ];

        // Handle foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->tokoModel->update($id, $data);

        return redirect()->to(base_url('dashboard/toko'))
                         ->with('success', 'Toko berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    /** GET /dashboard/toko/hapus/(:num) */
    public function hapus(int $id): ResponseInterface
    {
        $redirect = $this->checkRole();
        if ($redirect) return $redirect;

        $toko   = $this->tokoModel->find($id);
        $userId = session()->get('user_id');

        if (! $toko || ($toko['user_id'] != $userId && session()->get('role') !== 'admin')) {
            return redirect()->to(base_url('dashboard/toko'))
                             ->with('error', 'Toko tidak ditemukan.');
        }

        $this->tokoModel->delete($id);

        return redirect()->to(base_url('dashboard/toko'))
                         ->with('success', 'Toko berhasil dihapus.');
    }

    // ----------------------------------------------------------------
    /** GET /dashboard/toko/profil */
    public function profil(): string
    {
        $userId = session()->get('user_id');
        $data = [
            'page_title' => 'Profil Pemilik Toko',
            'user'       => $this->userModel->find($userId),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/pemilik/profil', $data);
    }

    /** POST /dashboard/toko/profil */
    public function updateProfil(): ResponseInterface
    {
        $userId = session()->get('user_id');
        $data   = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_hp'        => $this->request->getPost('no_hp'),
        ];
        $this->userModel->skipValidation(true)->update($userId, $data);
        session()->set('nama_lengkap', $data['nama_lengkap']);
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    private function getKategoris(): array
    {
        return [
            'Smartphone', 'Komputer & Laptop', 'Audio & Video',
            'Peralatan Listrik', 'Elektronik Umum', 'Apple Authorized',
            'Gaming', 'Kamera & Optik', 'Lainnya',
        ];
    }
}
