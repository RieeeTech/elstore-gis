<?php

namespace App\Controllers;

helper(['form']);

use App\Models\ModelLokasi;

class Lokasi extends BaseController
{
    protected $ModelLokasi;

    public function __construct()
    {
        $this->ModelLokasi = new ModelLokasi();
        helper('form');
    }

    // Menampilkan Data Lokasi
    public function index()
    {
        $data = [
            'judul'  => 'Data Lokasi',
            'page'   => 'lokasi/v_data_lokasi',
            'lokasi' => $this->ModelLokasi->getAllData(),
        ];

        return view('v_template', $data);
    }

    // Menampilkan Form Input Lokasi
    public function inputLokasi()
    {
        $data = [
            'judul' => 'Input Lokasi',
            'page'  => 'lokasi/v_input_lokasi',
        ];

        return view('v_template', $data);
    }

    // Insert Data
    public function insertData()
    {
        if ($this->validate([

            'nama_lokasi' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],

            'alamat_lokasi' => [
                'label' => 'Alamat Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],

            'latitude' => [
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],

            'longitude' => [
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong!'
                ]
            ],

            'foto_lokasi' => [
                'label' => 'Foto Lokasi',
                'rules' => 'uploaded[foto_lokasi]|max_size[foto_lokasi,1024]|mime_in[foto_lokasi,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => '{field} Tidak Boleh Kosong!',
                    'max_size' => 'Ukuran {field} Maksimal 1024 KB!',
                    'mime_in'  => 'Format {field} Harus JPG/JPEG/PNG!'
                ]
            ]

        ])) {

            // Ambil File Foto
            $foto_lokasi = $this->request->getFile('foto_lokasi');

            // Nama Random Foto
            $nama_file_foto = $foto_lokasi->getRandomName();

            // Data Yang Akan Disimpan
            $data = [
                'nama_lokasi'   => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'latitude'      => $this->request->getPost('latitude'),
                'longitude'     => $this->request->getPost('longitude'),
                'foto_lokasi'   => $nama_file_foto,
            ];

            // Upload Foto
            $foto_lokasi->move('foto', $nama_file_foto);

            // Insert Database
            $this->ModelLokasi->insertData($data);

            // Flashdata
            session()->setFlashdata('pesan', 'Data Berhasil Disimpan!');

            return redirect()->to(base_url('Lokasi/inputLokasi'));

        } else {

            return redirect()->to(base_url('Lokasi/inputLokasi'))->withInput();

        }
    }
    public function pemetaanLokasi()
    {
        $data = [
            'judul' => 'Pemetaan Lokasi',
            'page' => 'lokasi/v_pemetaan_lokasi',
            'lokasi' => $this->ModelLokasi->getAllData(),
        ];
        return view('v_template', $data);
    }
}