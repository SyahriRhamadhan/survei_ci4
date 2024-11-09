<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SurveiSeeder extends Seeder
{
    public function run()
    {
        // Daftar judul survei yang diinginkan
        $judul = 'Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH';
        $status = 'on';
        $idUnitPlaceholderRange = range(8, 95);
        $tahunAjaranOptions = [
            '2024/2025',
            '2025/2026',
        ];
        $semesterOptions = ['Ganjil', 'Genap'];

        foreach ($idUnitPlaceholderRange as $idUnitPlaceholder) {
            // Pilih tahun ajaran dan semester secara acak
            $tahunAjaran = $tahunAjaranOptions[array_rand($tahunAjaranOptions)];
            $semester = $semesterOptions[array_rand($semesterOptions)];

            $this->db->table('survei')->insert([
                'judul' => $judul,
                'dekripsi' => null,
                'tgl_mulai' => '2024-12-01',
                'tgl_selesai' => '2025-12-01',
                'status' => $status,
                'tahun_ajaran' => $tahunAjaran,
                'semester' => $semester,
                'id_unit_placeholder' => $idUnitPlaceholder,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $surveiId = $this->db->insertID();

            $idPertanyaanRange = range(1, 25);


            foreach ($idPertanyaanRange as $idPertanyaan) {
                $this->db->table('survei_pertanyaan')->insert([
                    'id_survei' => $surveiId,
                    'id_pertanyaan' => $idPertanyaan,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        // foreach ($idUnitPlaceholderRange as $idUnitPlaceholder) {
        //     foreach ($tahunAjaranOptions as $tahunAjaran) {
        //         foreach ($semesterOptions as $semester) {
        //             $this->db->table('survei')->insert([
        //                 'judul' => $judul,
        //                 'dekripsi' => null,
        //                 'tgl_mulai' => '2024-12-01',
        //                 'tgl_selesai' => '2025-12-01',
        //                 'status' => $status,
        //                 'tahun_ajaran' => $tahunAjaran,
        //                 'semester' => $semester,
        //                 'id_unit_placeholder' => $idUnitPlaceholder,
        //                 'created_at' => date('Y-m-d H:i:s'),
        //                 'updated_at' => date('Y-m-d H:i:s')
        //             ]);
        
        //             $surveiId = $this->db->insertID();
        
        //             $idPertanyaanRange = range(1, 25);
        
        //             foreach ($idPertanyaanRange as $idPertanyaan) {
        //                 $this->db->table('survei_pertanyaan')->insert([
        //                     'id_survei' => $surveiId,
        //                     'id_pertanyaan' => $idPertanyaan,
        //                     'created_at' => date('Y-m-d H:i:s'),
        //                     'updated_at' => date('Y-m-d H:i:s')
        //                 ]);
        //             }
        //         }
        //     }
        // }
        
    }
}
