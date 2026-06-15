<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLokasi extends Model
{
    // Fungsi Insert Data
    public function insertData($data)
    {
        $this->db->table('tbl_lokasi')->insert($data);
    }

    // Fungsi Mengambil Seluruh Data
    public function getAllData()
    {
        return $this->db->table('tbl_lokasi')
        ->get()->getResultArray();
    }
}

?>