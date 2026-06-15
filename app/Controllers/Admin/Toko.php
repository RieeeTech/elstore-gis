<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Admin Toko Controller — CRUD toko oleh admin
 * Route: /admin/toko
 */
class Toko extends BaseController
{
    protected TokoModel $tokoModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->userModel = new UserModel();
        helper('form');
    }

    private function getKategoris(): array
    {
        return [
            'Smartphone', 'Komputer & Laptop', 'Audio & Video',
            'Peralatan Listrik', 'Elektronik Umum', 'Apple Authorized',
            'Gaming', 'Kamera & Optik', 'Lainnya',
        ];
    }

    // ----------------------------------------------------------------
    /** GET /admin/toko */
    public function index(): string
    {
        $perPage = 10;
        $page = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;
        
        $pendingCount = $this->tokoModel->where('status', 'pending')->countAllResults();

        $data = [
            'page_title' => 'Kelola Toko',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'toko'       => $this->tokoModel->withDeleted(false)->orderBy('created_at','DESC')->paginate($perPage),
            'pager'      => $this->tokoModel->pager,
            'page'       => $page,
            'perPage'    => $perPage,
            'pendingCount'=> $pendingCount,
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/toko/index', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/toko/persetujuan */
    public function persetujuan(): string
    {
        $perPage = 10;
        $page = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;

        $data = [
            'page_title' => 'Persetujuan Toko',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'toko'       => $this->tokoModel->withDeleted(false)->where('status', 'pending')->orderBy('created_at','DESC')->paginate($perPage),
            'pager'      => $this->tokoModel->pager,
            'page'       => $page,
            'perPage'    => $perPage,
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/toko/persetujuan', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/toko/tambah */
    public function tambah(): string
    {
        $data = [
            'page_title' => 'Tambah Toko',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'kategoris'  => $this->getKategoris(),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/toko/form', $data);
    }

    // ----------------------------------------------------------------
    /** POST /admin/toko/simpan */
    public function simpan(): ResponseInterface
    {
        $rules = [
            'nama_toko' => 'required|min_length[3]',
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
            'provinsi'   => 'Sumatera Utara',
            'latitude'   => $this->request->getPost('latitude'),
            'longitude'  => $this->request->getPost('longitude'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email_toko' => $this->request->getPost('email_toko'),
            'jam_buka'   => $this->request->getPost('jam_buka'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'status'     => $this->request->getPost('status') ?: 'aktif',
            'rating'     => $this->request->getPost('rating') ?: 0,
            'total_ulasan'=> $this->request->getPost('total_ulasan') ?: 0,
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->tokoModel->insert($data);

        return redirect()->to(base_url('admin/toko'))
                         ->with('success', 'Toko berhasil ditambahkan.');
    }

    // ----------------------------------------------------------------
    /** GET /admin/toko/edit/(:num) */
    public function edit(int $id): string
    {
        $toko = $this->tokoModel->find($id);
        if (! $toko) {
            return redirect()->to(base_url('admin/toko'))->with('error', 'Toko tidak ditemukan.');
        }

        $data = [
            'page_title' => 'Edit Toko',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'toko'       => $toko,
            'kategoris'  => $this->getKategoris(),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/toko/form', $data);
    }

    // ----------------------------------------------------------------
    /** POST /admin/toko/update/(:num) */
    public function update(int $id): ResponseInterface
    {
        $toko = $this->tokoModel->find($id);
        if (! $toko) {
            return redirect()->to(base_url('admin/toko'))->with('error', 'Toko tidak ditemukan.');
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
            'status'     => $this->request->getPost('status') ?: 'aktif',
            'rating'     => $this->request->getPost('rating') ?: 0,
            'total_ulasan'=> $this->request->getPost('total_ulasan') ?: 0,
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->tokoModel->update($id, $data);

        return redirect()->to(base_url('admin/toko'))
                         ->with('success', 'Toko berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    /** GET /admin/toko/hapus/(:num) */
    public function hapus(int $id): ResponseInterface
    {
        $this->tokoModel->delete($id);
        return redirect()->to(base_url('admin/toko'))
                         ->with('success', 'Toko berhasil dihapus.');
    }

    // ----------------------------------------------------------------
    /** POST /admin/toko/toggle/(:num) */
    public function toggleStatus(int $id): ResponseInterface
    {
        $toko = $this->tokoModel->find($id);
        if (! $toko) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan.');
        }

        $newStatus = $toko['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        $this->tokoModel->update($id, ['status' => $newStatus]);

        return redirect()->back()->with('success', "Status toko berhasil diubah ke {$newStatus}.");
    }
}
