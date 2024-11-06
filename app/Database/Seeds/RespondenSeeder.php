<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RespondenSeeder extends Seeder
{
    public function run()
    {
        $kategoriRespondenOptions = ['mahasiswa', 'dosen', 'tendik', 'mitra', 'umum'];
        $jenisKelaminOptions = ['Laki-laki', 'Perempuan'];
        $jamSurveiOptions = ['08.00 - 12.00', '13.00 - 17.00'];
        
        // Insert data responden dan jawaban survei
        for ($i = 1; $i <= 5000; $i++) {
            $umur = rand(18, 60);
            $angkatan = "20" . rand(10, 23);
            $tanggalSurvei = date('Y-m-d', strtotime("-" . rand(1, 365) . " days"));
            // $tanggalSurvei = "2024-11-07";
            $saranMasukan = "Saran dan masukan dummy untuk responden " . $i;
            $kategoriResponden = $kategoriRespondenOptions[array_rand($kategoriRespondenOptions)];

            $dataResponden = [
                'umur' => $umur,
                'jenis_kelamin' => $jenisKelaminOptions[array_rand($jenisKelaminOptions)],
                'jam_survei' => $jamSurveiOptions[array_rand($jamSurveiOptions)],
                'tanggal_survei' => $tanggalSurvei,
                'saran_masukan' => $saranMasukan,
                'kategori_responden' => $kategoriResponden,
                'id_survei' => rand(1, 88),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($kategoriResponden === 'mahasiswa') {
                $dataResponden['angkatan'] = $angkatan;
                $dataResponden['id_prodi'] = rand(1, 31);
            } elseif ($kategoriResponden === 'dosen') {
                $dataResponden['id_fakultas'] = rand(1, 7);
            } elseif ($kategoriResponden === 'tendik') {
                $dataResponden['id_unit'] = rand(1, 16);
            }

            $respondenId = $this->db->table('responden')->insert($dataResponden);

            // Insert jawaban survei untuk pertanyaan id 1-14
            for ($pertanyaanId = 1; $pertanyaanId <= 14; $pertanyaanId++) {
                $this->db->table('jawaban_survei')->insert([
                    'id_responden' => $respondenId,
                    'id_pertanyaan' => $pertanyaanId,
                    'jawaban' => rand(1, 4)
                ]);
            }
        }
    }
}
