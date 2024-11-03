<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitPlaceholderPertanyaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Fakultas Ekonomi dan Bisnis Maritim (FEBM)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Fakultas Ilmu Kelautan dan Perikanan (FIKP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Fakultas Ilmu Sosial dan Ilmu Pemerintahan (FISIP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Magister Ilmu Lingkungan (MIL)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'jenis_unit' => 'UPPS',
                'nama_unit' => 'Magister Administrasi Publik (MAP)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan umum',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan keuangan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan kepegawaian',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan akademik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 12,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan kemahasiswaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Layanan perencanaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 14,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Lembaga Penelitian dan Pengabdian Masyarakat',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 15,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'Lembaga Penjaminan Mutu dan Pusat Pembelajaran',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 16,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'UPA Teknologi, Informasi, dan Komunikasi (TIK)',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 17,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'UPA Bahasa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 18,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'UPA Karir',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 19,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'UPA Perpustakaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 20,
                'jenis_unit' => 'Unit Layanan',
                'nama_unit' => 'UPA Lab Terpadu',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel `unit_placeholder_pertanyaan`
        $this->db->table('unit_placeholder_pertanyaan')->insertBatch($data);
    }
}
