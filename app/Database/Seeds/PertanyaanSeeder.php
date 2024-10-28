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
                'pertanyaan' => 'Persyaratan teknis dan administratif yang ditetapkan <unit layanan> sudah sesuai untuk memenuhi layanannya.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'pertanyaan' => 'Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'pertanyaan' => 'Layanan <unit layanan> memiliki kejelasan alur layanan yang sesuai dengan aturan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'pertanyaan' => '<unit layanan> memiliki kepastian jadwal layanan.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'pertanyaan' => '<unit layanan> memberikan pelayanan yang cepat.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'pertanyaan' => 'Petugas pemberi layanan di <unit layanan> selalu disiplin dalam melaksanakan tugas-tugasnya.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'pertanyaan' => 'Pelayanan yang diberikan oleh <unit layanan> telah sesuai dengan standar ketentuan yang berlaku.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'pertanyaan' => 'Petugas pemberi layanan di <unit layanan> memiliki kompetensi yang baik dalam hal pengetahuan, keahlian, keterampilan, dan pengalaman.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 9,
                'pertanyaan' => 'Petugas pemberi layanan di <unit layanan> memberikan layanan dengan sopan, ramah dan responsif.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'pertanyaan' => '<unit layanan> memberikan pelayanan yang adil kepada semua pihak yang datang.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'pertanyaan' => '<unit layanan> membuka jalur pengaduan dan saran yang berfungsi baik serta melakukan tindaklanjut atas pengaduan dan saran terkait dengan layanannya',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 12,
                'pertanyaan' => '<unit layanan> memiliki lingkungan pelayanan yang nyaman',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'pertanyaan' => '<unit layanan> memiliki lingkungan yang aman dan mendukung pemberian layanan',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 14,
                'pertanyaan' => 'Layanan di <unit layanan> didukung dengan sarana dan prasarana (termasuk teknologi informasi) yang baik dan memadai.',
                'tipe_pertanyaan' => 'none',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('pertanyaan')->insertBatch($data);
    }
}
