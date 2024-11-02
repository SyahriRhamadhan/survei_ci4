<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipePertanyaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'tipe_pertanyaan' => 'Tata Kelola, Tata Pamong, dan Kerjasama',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'tipe_pertanyaan' => 'Bidang Kemahasiswaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'tipe_pertanyaan' => 'Bidang Sarana dan Prasarana',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'tipe_pertanyaan' => 'Sistem Tata Pamong',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'tipe_pertanyaan' => 'Kepemimpinan dan Kemampuan Manajerial',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'tipe_pertanyaan' => 'Kerjasama',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'tipe_pertanyaan' => 'Layanan dan Sumber Daya Manusia',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'tipe_pertanyaan' => 'Layanan Keuangan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('tipe_pertanyaan')->insertBatch($data);
    }
}