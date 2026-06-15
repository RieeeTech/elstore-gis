<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Toko Elektronik Table
 * Jalankan dengan: php spark migrate
 */
class CreateStoresTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'Pemilik toko (FK users.id)',
            ],
            'nama_toko' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Smartphone', 'Komputer & Laptop', 'Audio & Video',
                    'Peralatan Listrik', 'Elektronik Umum', 'Apple Authorized',
                    'Gaming', 'Kamera & Optik', 'Lainnya'
                ],
                'default'    => 'Elektronik Umum',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Kisaran',
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Sumatera Utara',
            ],
            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
            ],
            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email_toko' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'jam_buka' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'comment'    => 'Contoh: 08:00-21:00',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'rating' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,1',
                'default'    => '0.0',
            ],
            'total_ulasan' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'nonaktif', 'pending'],
                'default'    => 'aktif',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('user_id');
        $this->forge->addKey('kategori');
        $this->forge->addKey('status');
        $this->forge->addKey(['latitude', 'longitude']);

        $this->forge->createTable('toko_elektronik');

        // Seed data sample
        $sampleData = [
            [
                'nama_toko'   => 'Samsung Store Kisaran',
                'kategori'    => 'Smartphone',
                'alamat'      => 'Jl. Ahmad Yani No.10, Kisaran Barat',
                'kecamatan'   => 'Kisaran Barat',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.98400000',
                'longitude'   => '99.61800000',
                'no_telepon'  => '0623-12345',
                'jam_buka'    => '08:00-21:00',
                'deskripsi'   => 'Toko resmi Samsung menyediakan smartphone, tablet, dan aksesori Samsung.',
                'rating'      => '4.5',
                'total_ulasan'=> 32,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_toko'   => 'Elektronik Sinar Jaya',
                'kategori'    => 'Elektronik Umum',
                'alamat'      => 'Jl. Sudirman No.22, Kisaran Timur',
                'kecamatan'   => 'Kisaran Timur',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.98050000',
                'longitude'   => '99.61450000',
                'no_telepon'  => '0623-11111',
                'jam_buka'    => '09:00-20:00',
                'deskripsi'   => 'Pusat elektronik terlengkap dengan berbagai merek dan produk.',
                'rating'      => '4.2',
                'total_ulasan'=> 18,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_toko'   => 'iBox Asahan',
                'kategori'    => 'Apple Authorized',
                'alamat'      => 'Jl. Imam Bonjol No.5, Kisaran',
                'kecamatan'   => 'Kisaran Barat',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.98700000',
                'longitude'   => '99.62000000',
                'no_telepon'  => '0623-22222',
                'jam_buka'    => '10:00-21:00',
                'deskripsi'   => 'Reseller resmi Apple di Asahan. iPhone, iPad, MacBook tersedia.',
                'rating'      => '4.8',
                'total_ulasan'=> 55,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_toko'   => 'Toko Listrik Maju',
                'kategori'    => 'Peralatan Listrik',
                'alamat'      => 'Jl. Cut Nyak Dien No.3',
                'kecamatan'   => 'Kisaran Barat',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.97900000',
                'longitude'   => '99.61100000',
                'no_telepon'  => '0623-33333',
                'jam_buka'    => '07:30-18:00',
                'deskripsi'   => 'Menyediakan berbagai peralatan listrik dan instalasi rumah tangga.',
                'rating'      => '3.9',
                'total_ulasan'=> 12,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_toko'   => 'PC World Kisaran',
                'kategori'    => 'Komputer & Laptop',
                'alamat'      => 'Jl. Diponegoro No.14',
                'kecamatan'   => 'Kisaran Timur',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.98250000',
                'longitude'   => '99.62300000',
                'no_telepon'  => '0623-44444',
                'jam_buka'    => '08:00-20:00',
                'deskripsi'   => 'Spesialis komputer, laptop, dan aksesoris IT terlengkap.',
                'rating'      => '4.3',
                'total_ulasan'=> 27,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_toko'   => 'Audio Vision',
                'kategori'    => 'Audio & Video',
                'alamat'      => 'Jl. Veteran No.7',
                'kecamatan'   => 'Kisaran Barat',
                'kota'        => 'Kisaran',
                'provinsi'    => 'Sumatera Utara',
                'latitude'    => '2.98600000',
                'longitude'   => '99.61550000',
                'no_telepon'  => '0623-55555',
                'jam_buka'    => '09:00-21:00',
                'deskripsi'   => 'Audio system, home theater, speaker, dan aksesoris audio berkualitas.',
                'rating'      => '4.0',
                'total_ulasan'=> 9,
                'status'      => 'aktif',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('toko_elektronik')->insertBatch($sampleData);
    }

    public function down(): void
    {
        $this->forge->dropTable('toko_elektronik', true);
    }
}
