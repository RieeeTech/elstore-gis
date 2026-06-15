<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Toko Model — ELStore GIS
 */
class TokoModel extends Model
{
    protected $table            = 'toko_elektronik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'user_id', 'nama_toko', 'slug', 'kategori',
        'alamat', 'kecamatan', 'kota', 'provinsi',
        'latitude', 'longitude', 'no_telepon', 'email_toko',
        'website', 'jam_buka', 'deskripsi', 'foto',
        'rating', 'total_ulasan', 'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // ----------------------------------------------------------------
    /** Semua toko aktif untuk peta */
    public function getForMap(): array
    {
        return $this->where('status', 'aktif')
                    ->select('id,nama_toko,kategori,alamat,kecamatan,kota,latitude,longitude,no_telepon,jam_buka,rating,total_ulasan,foto')
                    ->findAll();
    }

    // ----------------------------------------------------------------
    /** Statistik per kategori */
    public function getStatsPerKategori(): array
    {
        return $this->db
                    ->table($this->table)
                    ->select('kategori, COUNT(*) as total')
                    ->where('status', 'aktif')
                    ->where('deleted_at IS NULL')
                    ->groupBy('kategori')
                    ->orderBy('total', 'DESC')
                    ->get()
                    ->getResultArray();
    }

    // ----------------------------------------------------------------
    /** Toko milik pemilik tertentu */
    public function getByOwner(int $userId): array
    {
        return $this->where('user_id', $userId)->findAll();
    }

    // ----------------------------------------------------------------
    /** Search/filter */
    public function search(string $q = '', string $kategori = '', string $kota = '')
    {
        $builder = $this->where('status', 'aktif');

        if ($q !== '') {
            $builder->groupStart()
                    ->like('nama_toko', $q)
                    ->orLike('alamat', $q)
                    ->orLike('kecamatan', $q)
                    ->groupEnd();
        }

        if ($kategori !== '') {
            $builder->where('kategori', $kategori);
        }

        if ($kota !== '') {
            $builder->where('kota', $kota);
        }

        return $this->orderBy('rating', 'DESC');
    }

    // ----------------------------------------------------------------
    /** Total toko aktif */
    public function countAktif(): int
    {
        return $this->where('status', 'aktif')->countAllResults();
    }

    // ----------------------------------------------------------------
    /** Dashboard stats */
    public function getDashboardStats(): array
    {
        $total   = $this->countAllResults();
        $aktif   = $this->where('status', 'aktif')->countAllResults();
        $pending = $this->where('status', 'pending')->countAllResults();

        return [
            'total'   => $total,
            'aktif'   => $aktif,
            'pending' => $pending,
        ];
    }
}
