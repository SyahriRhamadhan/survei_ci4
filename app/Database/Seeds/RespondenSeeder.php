<?php
// $tanggalSurvei = "2024-11-07";
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
            $jawabanSurvei = [];
            for ($pertanyaanId = 1; $pertanyaanId <= 25; $pertanyaanId++) {
                $jawaban = rand(2, 4);
                $jawabanSurvei[] = [
                    'id_responden' => $respondenId,
                    'id_pertanyaan' => $pertanyaanId,
                    'jawaban' => $jawaban
                ];
            }
            $this->db->table('jawaban_survei')->insertBatch($jawabanSurvei);

            // Ambil jawaban untuk hitung IKM
            $kategoriJawaban = [];
            foreach ($jawabanSurvei as $jawaban) {
                $kategoriJawaban[$jawaban['id_pertanyaan']][] = $jawaban['jawaban'];
            }

            // Hitung rata-rata tertimbang
            $rataRataTertimbang = [];
            $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1];
            foreach ($kategoriJawaban as $kategori => $jawabans) {
                $totalBobot = 0;
                $totalJawaban = 0;
                foreach ($jawabans as $jawaban) {
                    $totalBobot += $bobotJawaban[$jawaban];
                    $totalJawaban++;
                }
                $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
            }

            // Menghitung nilai IKM
            $totalNilai = array_sum($rataRataTertimbang);
            $totalKategori = count($rataRataTertimbang);
            $ikm = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;

            // Update IKM di tabel survei
            $this->db->table('survei')->where('id', $dataResponden['id_survei'])->update([
                'ikm' => $ikm
            ]);
        }
    }
}
