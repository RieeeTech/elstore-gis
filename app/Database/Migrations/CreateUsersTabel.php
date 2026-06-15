<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Users Table
 * Jalankan dengan: php spark migrate
 */
class CreateUsersTable extends Migration
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
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'pemilik_toko', 'pengguna'],
                'default'    => 'pengguna',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['aktif', 'pending', 'nonaktif'],
                'default'    => 'aktif',
            ],
            'foto_profil' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'remember_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->addKey('role');
        $this->forge->addKey('status');

        $this->forge->createTable('users');

        // Seed: akun admin default
        $this->db->table('users')->insert([
            'nama_lengkap' => 'Administrator',
            'username'     => 'admin',
            'email'        => 'admin@elstore-gis.id',
            'password'     => password_hash('Admin@12345', PASSWORD_BCRYPT),
            'role'         => 'admin',
            'status'       => 'aktif',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }

    // ----------------------------------------------------------------
    public function down(): void
    {
        $this->forge->dropTable('users', true);
    }
}