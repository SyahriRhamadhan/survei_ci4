<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Ilmu Pemerintahan'],
            ['nama' => 'Sosiologi'],
            ['nama' => 'Ilmu Administrasi Negara'],
            ['nama' => 'Teknik Informatika'],
            ['nama' => 'Teknik Elektro'],
            ['nama' => 'Teknik Sipil'],
            ['nama' => 'Manajemen Sumber Daya Perairan'],
            ['nama' => 'Teknologi Hasil Perikanan'],
            ['nama' => 'Budidaya Perikanan'],
            ['nama' => 'Pendidikan Bahasa Indonesia'],
            ['nama' => 'Pendidikan Matematika'],
            ['nama' => 'Pendidikan Biologi'],
            ['nama' => 'Ekonomi Pembangunan'],
            ['nama' => 'Manajemen'],
            ['nama' => 'Akuntansi'],
            ['nama' => 'Sastra Inggris'],
        ];

        // Using Query Builder
        $this->db->table('prodi')->insertBatch($data);
    }
}
