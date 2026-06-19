<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Auth Controller
 * ELStore GIS — Autentikasi Pengguna
 *
 * @package App\Controllers
 */
class Auth extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ----------------------------------------------------------------
    /** GET  /auth/login */
    public function login()
    {
        // Kalau sudah login → redirect ke dashboard
        if (session()->get('is_logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/login');
    }

    // ----------------------------------------------------------------
    /** POST  /auth/login-process */
    public function loginProcess(): ResponseInterface
    {
        // Validasi input
        $rules = [
            'login_id' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
        ];

        $messages = [
            'login_id' => [
                'required'   => 'Email atau username wajib diisi.',
                'min_length' => 'Minimal 3 karakter.',
            ],
            'password' => [
                'required'   => 'Kata sandi wajib diisi.',
                'min_length' => 'Kata sandi minimal 6 karakter.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $loginId  = $this->request->getPost('login_id');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Cari user berdasarkan email ATAU username
        $user = $this->userModel
                     ->where('email', $loginId)
                     ->orWhere('username', $loginId)
                     ->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Email/username atau kata sandi salah.');
        }

        // Cek status akun
        if ($user['status'] !== 'aktif') {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Akun Anda belum diaktifkan atau telah dinonaktifkan.');
        }

        // Simpan session
        $sessionData = [
            'user_id'      => $user['id'],
            'nama_lengkap' => $user['nama_lengkap'],
            'username'     => $user['username'],
            'email'        => $user['email'],
            'role'         => $user['role'],
            'is_logged_in' => true,
        ];

        session()->set($sessionData);

        // Update last_login
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s'),
        ]);

        // Remember me — simpan token di cookie (opsional)
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            $this->userModel->update($user['id'], ['remember_token' => $token]);
            set_cookie('elstore_remember', $token, 60 * 60 * 24 * 30); // 30 hari
        }

        // Redirect berdasarkan role
        $redirect = match ($user['role']) {
            'admin'        => base_url('admin'),
            'pemilik_toko' => base_url('dashboard/toko'),
            default        => base_url('/'),
        };

        return redirect()->to($redirect)
                         ->with('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
    }

    // ----------------------------------------------------------------
    /** GET  /auth/register */
    public function register()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('auth/register');
    }

    // ----------------------------------------------------------------
    /** POST  /auth/register-process */
    public function registerProcess(): ResponseInterface
    {
        $rules = [
            'nama_lengkap'          => 'required|min_length[3]|max_length[100]',
            'username'              => 'required|min_length[3]|max_length[50]|alpha_numeric_punct|is_unique[users.username]',
            'email'                 => 'required|valid_email|max_length[150]|is_unique[users.email]',
            'no_hp'                 => 'permit_empty|min_length[9]|max_length[15]',
            'password'              => 'required|min_length[8]',
            'konfirmasi_password'   => 'required|matches[password]',
            'role'                  => 'required|in_list[pengguna,pemilik_toko]',
            'setuju_syarat'         => 'required',
        ];

        $messages = [
            'nama_lengkap'        => ['required' => 'Nama lengkap wajib diisi.'],
            'username'            => [
                'required'         => 'Username wajib diisi.',
                'alpha_numeric_punct' => 'Username hanya boleh huruf, angka, dan simbol _ - .',
                'is_unique'        => 'Username sudah digunakan.',
            ],
            'email'               => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar.',
            ],
            'password'            => [
                'required'   => 'Kata sandi wajib diisi.',
                'min_length' => 'Kata sandi minimal 8 karakter.',
            ],
            'konfirmasi_password' => [
                'required' => 'Konfirmasi kata sandi wajib diisi.',
                'matches'  => 'Konfirmasi kata sandi tidak cocok.',
            ],
            'role'           => ['required' => 'Pilih jenis akun Anda.'],
            'setuju_syarat'  => ['required' => 'Anda harus menyetujui syarat & ketentuan.'],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        // Simpan user baru
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => strtolower($this->request->getPost('username')),
            'email'        => strtolower($this->request->getPost('email')),
            'no_hp'        => $this->request->getPost('no_hp'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'         => $this->request->getPost('role'),
            'status'       => 'aktif',   // ubah ke 'pending' kalau pakai verifikasi email
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $userId = $this->userModel->insert($data);

        if (! $userId) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }

        // Auto-login setelah register
        session()->set([
            'user_id'      => $userId,
            'nama_lengkap' => $data['nama_lengkap'],
            'username'     => $data['username'],
            'email'        => $data['email'],
            'role'         => $data['role'],
            'is_logged_in' => true,
        ]);

        $redirect = $data['role'] === 'pemilik_toko'
            ? base_url('dashboard/toko')
            : base_url('/');

        return redirect()->to($redirect)
                         ->with('success', 'Akun berhasil dibuat. Selamat datang, ' . $data['nama_lengkap'] . '!');
    }

    // ----------------------------------------------------------------
    /** GET  /auth/logout */
    public function logout(): ResponseInterface
    {
        // Hapus remember-me cookie
        helper('cookie');
        delete_cookie('elstore_remember');

        // Hapus semua session data
        session()->destroy();

        $redirect = $this->request->getGet('redirect') ?: base_url('/');
        return redirect()->to($redirect)
                         ->with('success', 'Anda telah berhasil keluar.');
    }

    // ----------------------------------------------------------------
    /** GET  /auth/forgot-password */
    public function forgotPassword(): string
    {
        return view('auth/forgot_password');   // buat view ini terpisah
    }
}