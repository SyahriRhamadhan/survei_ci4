<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SurveiSeeder extends Seeder
{
    public function run()
    {
        // Variabel survei untuk Unit Layanan
        $judul1 = 'Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH';
        $status1 = 'on';
        $idUnitPlaceholderRange1 = range(32, 200);

        // Variabel survei tambahan untuk UPPS
        $judul2 = 'Instrumen survei kepuasan mahasiswa di UPPS';
        $judul3 = 'Instrumen survei kepuasan dosen di UPPS';
        $judul4 = 'Instrumen survei kepuasan tenaga kependidikan di UPPS';
        $judul5 = 'Instrumen survei kepuasan mitra di UPPS';
        $status2 = 'on';
        $idUnitPlaceholderRange2 = range(1, 31);

        // Proses untuk Unit Layanan
        foreach ($idUnitPlaceholderRange1 as $idUnitPlaceholder) {
            $this->db->table('survei')->insert([
                'judul' => $judul1,
                'dekripsi' => null,
                'tgl_mulai' => '2025-01-01',
                'tgl_selesai' => '2025-12-31',
                'status' => $status1,
                'id_unit_placeholder' => $idUnitPlaceholder,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $surveiId = $this->db->insertID();

            $idPertanyaanRange = range(1, 15);

            foreach ($idPertanyaanRange as $idPertanyaan) {
                $this->db->table('survei_pertanyaan')->insert([
                    'id_survei' => $surveiId,
                    'id_pertanyaan' => $idPertanyaan,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // Proses untuk UPPS dengan 4 judul berbeda dan pertanyaan yang spesifik
        $surveiConfigs = [
            ['judul' => $judul2, 'idPertanyaanRange' => range(16, 46)],
            ['judul' => $judul3, 'idPertanyaanRange' => range(47, 67)],
            ['judul' => $judul4, 'idPertanyaanRange' => array_merge(range(47, 64), range(66, 67))],
            ['judul' => $judul5, 'idPertanyaanRange' => range(68, 75)]
        ];

        foreach ($surveiConfigs as $config) {
            foreach ($idUnitPlaceholderRange2 as $idUnitPlaceholder) {
                $this->db->table('survei')->insert([
                    'judul' => $config['judul'],
                    'dekripsi' => null,
                    'tgl_mulai' => '2025-12-01',
                    'tgl_selesai' => '2025-12-31',
                    'status' => $status2,
                    'id_unit_placeholder' => $idUnitPlaceholder,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $surveiId = $this->db->insertID();

                foreach ($config['idPertanyaanRange'] as $idPertanyaan) {
                    $this->db->table('survei_pertanyaan')->insert([
                        'id_survei' => $surveiId,
                        'id_pertanyaan' => $idPertanyaan,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
