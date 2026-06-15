<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Dashboard Controller — User (Pengguna Umum)
 * Route: /dashboard
 */
class Dashboard extends BaseController
{
    protected UserModel $userModel;
    protected TokoModel $tokoModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->tokoModel = new TokoModel();
    }

    // ----------------------------------------------------------------
    /** GET /dashboard */
    public function index()
    {
        if (session()->get('role') === 'pengguna') {
            return redirect()->to(base_url('/'));
        }

        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        $stats = [
            'total_toko'   => $this->tokoModel->countAktif(),
            'total_kota'   => 2,
            'data_akurat'  => '100%',
        ];

        $data = [
            'page_title'   => 'Dashboard Pengguna',
            'user'         => $user,
            'stats'        => $stats,
            'recent_toko'  => $this->tokoModel->getForMap(),
            'lang'         => session()->get('lang') ?? 'id',
        ];

        return view('dashboard/user/index', $data);
    }

    // ----------------------------------------------------------------
    /** GET/POST /dashboard/profil */
    public function profil()
    {

        $userId = session()->get('user_id');
        $user   = $this->userModel->find($userId);

        $data = [
            'page_title' => 'Profil Saya',
            'user'       => $user,
            'lang'       => session()->get('lang') ?? 'id',
        ];

        return view('dashboard/user/profil', $data);
    }

    // ----------------------------------------------------------------
    /** POST /dashboard/profil */
    public function updateProfil(): ResponseInterface
    {
        $userId = session()->get('user_id');

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'no_hp'        => 'permit_empty|min_length[9]|max_length[15]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'no_hp'        => $this->request->getPost('no_hp'),
        ];

        // Handle foto upload
        $foto = $this->request->getFile('foto_profil');
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(FCPATH . 'foto', $namaFoto);
            $updateData['foto_profil'] = $namaFoto;
        }

        // Ganti password jika diisi
        $pwBaru = $this->request->getPost('password_baru');
        if ($pwBaru) {
            $updateData['password'] = password_hash($pwBaru, PASSWORD_BCRYPT);
        }

        $this->userModel->skipValidation(true)->update($userId, $updateData);

        // Update session nama
        session()->set('nama_lengkap', $updateData['nama_lengkap']);

        return redirect()->to(base_url('dashboard/profil'))
                         ->with('success', 'Profil berhasil diperbarui.');
    }
}
