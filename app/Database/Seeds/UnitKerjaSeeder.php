<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    public function run()
    {
        $unitLayanan = [
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Biro Akademik, Perencanaan, Kemahasiswaan, dan Kerja Sama (BAPKK)'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Biro Keuangan dan Umum (BKU)'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Lembaga Penelitian dan Pengabdian Masyarakat (LPPM)'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Lembaga Penjaminan Mutu dan Pengembangan Pembelajaran (LPMPP)'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Unit Penunjang Akademik Teknologi Informasi dan Komunikasi'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Unit Penunjang Akademik Bahasa'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Unit Penunjang Akademik Perpustakaan'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Unit Penunjang Akademik Pengembangan Karir dan Kewirausahaan'],
            ['jenis_unit' => 'Unit Layanan', 'nama_unit' => 'Unit Penunjang Akademik Laboratorium Terpadu'],
        ];

        $upps = [
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Ekonomi dan Bisnis Maritim (FEBM)'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Ilmu Kelautan dan Perikanan (FIKP)'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Program Pascasarjana'],
            ['jenis_unit' => 'UPPS', 'nama_unit' => 'Fakultas Kedokteran (FK)'],
        ];

        $data = array_merge($unitLayanan, $upps);

        $this->db->table('unit_kerja')->insertBatch($data);
    }
}
