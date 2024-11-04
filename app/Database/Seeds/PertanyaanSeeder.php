<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'pertanyaan' => 'Persyaratan teknis dan administratif yang ditetapkan <tag> sudah sesuai untuk memenuhi layanannya.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'pertanyaan' => 'Prosedur pelayanan di <tag> mudah, sesuai dengan aturan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'pertanyaan' => 'Layanan <tag> memiliki kejelasan alur layanan yang sesuai dengan aturan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'pertanyaan' => '<tag> memiliki kepastian jadwal layanan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'pertanyaan' => '<tag> memberikan pelayanan yang cepat.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'pertanyaan' => 'Petugas pemberi layanan di <tag> selalu disiplin dalam melaksanakan tugas-tugasnya.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'pertanyaan' => 'Pelayanan yang diberikan oleh <tag> telah sesuai dengan standar ketentuan yang berlaku.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'pertanyaan' => 'Petugas pemberi layanan di <tag> memiliki kompetensi yang baik dalam hal pengetahuan, keahlian, keterampilan, dan pengalaman.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'pertanyaan' => 'Petugas pemberi layanan di <tag> memberikan layanan dengan sopan, ramah dan responsif.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'pertanyaan' => '<tag> memberikan pelayanan yang adil kepada semua pihak yang datang.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'pertanyaan' => '<tag> membuka jalur pengaduan dan saran yang berfungsi baik serta melakukan tindaklanjut atas pengaduan dan saran terkait dengan layanannya',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 12,
                'pertanyaan' => '<tag> memiliki lingkungan pelayanan yang nyaman',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'pertanyaan' => '<tag> memiliki lingkungan yang aman dan mendukung pemberian layanan',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 14,
                'pertanyaan' => 'Layanan di <tag> didukung dengan sarana dan prasarana (termasuk teknologi informasi) yang baik dan memadai.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('pertanyaan')->insertBatch($data);
    }
}