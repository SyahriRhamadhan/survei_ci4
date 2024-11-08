<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        // Data fakultas sesuai dengan struktur yang diberikan
        $data = [
            [
                'nama' => 'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Ekonomi dan Bisnis Maritim (FEBM)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Ilmu Kelautan dan Perikanan (FIKP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Program Pascasarjana (Magister)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fakultas Kedokteran (FK)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Menyimpan data ke tabel fakultas
        $this->db->table('fakultas')->insertBatch($data);
    }
}