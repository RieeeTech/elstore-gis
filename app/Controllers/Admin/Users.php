<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Admin Users Controller — kelola pengguna
 * Route: /admin/users
 */
class Users extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ----------------------------------------------------------------
    /** GET /admin/users */
    public function index(): string
    {
        $data = [
            'page_title' => 'Kelola Pengguna',
            'user'       => $this->userModel->find(session()->get('user_id')),
            'users'      => $this->userModel->getAllForAdmin(),
            'lang'       => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/users/index', $data);
    }

    // ----------------------------------------------------------------
    /** GET /admin/users/edit/(:num) */
    public function edit(int $id): string
    {
        $targetUser = $this->userModel->find($id);
        if (! $targetUser) {
            return redirect()->to(base_url('admin/users'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'page_title'  => 'Edit Pengguna',
            'user'        => $this->userModel->find(session()->get('user_id')),
            'target_user' => $targetUser,
            'lang'        => session()->get('lang') ?? 'id',
        ];
        return view('dashboard/admin/users/form', $data);
    }

    // ----------------------------------------------------------------
    /** POST /admin/users/update/(:num) */
    public function update(int $id): ResponseInterface
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role'         => $this->request->getPost('role'),
            'status'       => $this->request->getPost('status'),
        ];

        $this->userModel->skipValidation(true)->update($id, $data);

        return redirect()->to(base_url('admin/users'))
                         ->with('success', 'Pengguna berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    /** GET /admin/users/hapus/(:num) */
    public function hapus(int $id): ResponseInterface
    {
        // Jangan hapus diri sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $this->userModel->delete($id);
        return redirect()->to(base_url('admin/users'))
                         ->with('success', 'Pengguna berhasil dihapus.');
    }

    // ----------------------------------------------------------------
    /** POST /admin/users/toggle/(:num) */
    public function toggleStatus(int $id): ResponseInterface
    {
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'Tidak bisa mengubah status akun sendiri.');
        }

        $targetUser = $this->userModel->find($id);
        if (! $targetUser) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $newStatus = $targetUser['status'] === 'aktif' ? 'nonaktif' : 'aktif';
        $this->userModel->skipValidation(true)->update($id, ['status' => $newStatus]);

        return redirect()->back()->with('success', "Status pengguna diubah ke {$newStatus}.");
    }
}
