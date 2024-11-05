<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Teknik Informatika'],
            ['nama' => 'Teknik Elektro'],
            ['nama' => 'Teknik Perkapalan'],
            ['nama' => 'Kimia'],
            ['nama' => 'Teknik Industri'],
            ['nama' => 'Akuntansi'],
            ['nama' => 'Manajemen'],
            ['nama' => 'Bisnis Digital'],
            ['nama' => 'Kewirausahaan'],
            ['nama' => 'Ilmu Kelautan'],
            ['nama' => 'Manajemen Sumberdaya Perairan'],
            ['nama' => 'Budidaya Perairan'],
            ['nama' => 'Teknologi Hasil Perikanan'],
            ['nama' => 'Sosial Ekonomi Perikanan'],
            ['nama' => 'Pendidikan Bahasa dan Sastra Indonesia'],
            ['nama' => 'Pendidikan Bahasa Inggris'],
            ['nama' => 'Pendidikan Matematika'],
            ['nama' => 'Pendidikan Biologi'],
            ['nama' => 'Pendidikan Kimia'],
            ['nama' => 'Pendidikan Profesi Guru (Profesi)'],
            ['nama' => 'Ilmu Pemerintahan'],
            ['nama' => 'Administrasi Publik'],
            ['nama' => 'Sosiologi'],
            ['nama' => 'Ilmu Hukum'],
            ['nama' => 'Hubungan Internasional'],
            ['nama' => 'Kajian Film, Televisi, dan Media'],
            ['nama' => 'Magister Administrasi Publik'],
            ['nama' => 'Magister Ilmu Lingkungan'],
            ['nama' => 'Magister Pedagogi FKIP UMRAH'],
            ['nama' => 'Kedokteran'],
            ['nama' => 'Pendidikan Profesi Dokter'],
        ];

        // Using Query Builder
        $this->db->table('prodi')->insertBatch($data);
    }
}
