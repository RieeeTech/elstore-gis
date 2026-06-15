<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Admin Dashboard Controller
 * Route: /admin
 */
class Dashboard extends BaseController
{
    protected TokoModel $tokoModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->userModel = new UserModel();
    }

    // ----------------------------------------------------------------
    /** GET /admin */
    public function index(): string
    {
        $tokoStats  = $this->tokoModel->getDashboardStats();
        $userStats  = [
            'total'        => $this->userModel->countAll(),
            'pemilik_toko' => $this->userModel->where('role', 'pemilik_toko')->countAllResults(),
            'pengguna'     => $this->userModel->where('role', 'pengguna')->countAllResults(),
        ];

        $perKategori = $this->tokoModel->getStatsPerKategori();
        $recentToko  = $this->tokoModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
        $recentUsers = $this->userModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        $data = [
            'page_title'   => 'Admin Dashboard',
            'user'         => $this->userModel->find(session()->get('user_id')),
            'toko_stats'   => $tokoStats,
            'user_stats'   => $userStats,
            'per_kategori' => $perKategori,
            'recent_toko'  => $recentToko,
            'recent_users' => $recentUsers,
            'lang'         => session()->get('lang') ?? 'id',
        ];

        return view('dashboard/admin/index', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/peta */
    public function peta(): string
    {
        $data = [
            'page_title' => 'Peta Admin',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'stores'     => $this->tokoModel->getForMap(),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/peta', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/laporan */
    public function laporan(): string
    {
        $data = [
            'page_title'   => 'Laporan',
            'user'         => $this->userModel->find(session()->get('user_id')),
            'per_kategori' => $this->tokoModel->getStatsPerKategori(),
            'total_toko'   => $this->tokoModel->countAktif(),
            'semua_toko'   => $this->tokoModel->findAll(),
            'lang'         => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/laporan', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/profil */
    public function profil(): string
    {
        $userId = session()->get('user_id');
        $data = [
            'page_title' => 'Profil Admin',
            'user'       => $this->userModel->find($userId),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/profil', $data);
    }

    /** POST /admin/profil */
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
}
