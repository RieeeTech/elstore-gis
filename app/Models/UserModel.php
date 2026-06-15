<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * User Model
 * ELStore GIS
 */
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;       // soft delete pakai deleted_at

    protected $allowedFields = [
        'nama_lengkap',
        'username',
        'email',
        'no_hp',
        'password',
        'role',              // admin | pemilik_toko | pengguna
        'status',            // aktif | pending | nonaktif
        'foto_profil',
        'remember_token',
        'last_login',
    ];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validasi di model (backup dari controller)
    protected $validationRules = [
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'email'        => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'     => 'required|min_length[8]',
        'role'         => 'required|in_list[admin,pemilik_toko,pengguna]',
        'status'       => 'required|in_list[aktif,pending,nonaktif]',
    ];

    protected $validationMessages = [
        'username' => ['is_unique' => 'Username sudah digunakan.'],
        'email'    => ['is_unique' => 'Email sudah terdaftar.'],
    ];

    protected $skipValidation = false;

    // Jangan return password ke view
    protected $hiddenFields = ['password', 'remember_token'];

    // ----------------------------------------------------------------
    /**
     * Cari user aktif by email atau username
     */
    public function findByCredential(string $loginId): ?array
    {
        return $this->where('status', 'aktif')
                    ->groupStart()
                        ->where('email', $loginId)
                        ->orWhere('username', $loginId)
                    ->groupEnd()
                    ->first();
    }

    // ----------------------------------------------------------------
    /**
     * Cari user by remember token
     */
    public function findByRememberToken(string $token): ?array
    {
        return $this->where('remember_token', $token)
                    ->where('status', 'aktif')
                    ->first();
    }

    // ----------------------------------------------------------------
    /**
     * Ambil semua user (tanpa password) untuk admin panel
     */
    public function getAllForAdmin(): array
    {
        return $this->select('id, nama_lengkap, username, email, no_hp, role, status, last_login, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}