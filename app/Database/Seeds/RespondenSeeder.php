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
        $startTimestamp = strtotime('2024-01-01');
        $endTimestamp = strtotime('2025-12-31');

        for ($i = 1; $i <= 15000; $i++) {
            $randomTimestamp = rand($startTimestamp, $endTimestamp);
            $createdAt = date('Y-m-d H:i:s', $randomTimestamp);
            $updatedAt = date('Y-m-d H:i:s', $randomTimestamp);

            $tanggalSurveiTimestamp = rand($startTimestamp, $endTimestamp);
            $tanggalSurvei = date('Y-m-d', $tanggalSurveiTimestamp);

            $umur = rand(18, 60);
            $angkatan = "20" . rand(10, 23);
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
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ];

            if ($kategoriResponden === 'mahasiswa') {
                $dataResponden['angkatan'] = $angkatan;
                $dataResponden['id_prodi'] = rand(1, 31);
            } elseif ($kategoriResponden === 'dosen') {
                $dataResponden['id_fakultas'] = rand(1, 7);
            } elseif ($kategoriResponden === 'tendik') {
                $dataResponden['id_unit'] = rand(1, 16);
            }

            $this->db->table('responden')->insert($dataResponden);
            $respondenId = $this->db->insertID();

            $jawabanSurvei = [];
            for ($pertanyaanId = 1; $pertanyaanId <= 25; $pertanyaanId++) {
                $jawabanTimestamp = rand($startTimestamp, $endTimestamp);
                $jawabanCreatedAt = date('Y-m-d H:i:s', $jawabanTimestamp);
                $jawabanUpdatedAt = date('Y-m-d H:i:s', $jawabanTimestamp);

                $jawabanSurvei[] = [
                    'id_responden' => $respondenId,
                    'id_pertanyaan' => $pertanyaanId,
                    'jawaban' => rand(2, 4),
                    'id_survei' => $dataResponden['id_survei'],
                    'created_at' => $jawabanCreatedAt,
                    'updated_at' => $jawabanUpdatedAt,
                ];
            }
            $this->db->table('jawaban_survei')->insertBatch($jawabanSurvei);
            $kategoriJawaban = [];
            foreach ($jawabanSurvei as $jawaban) {
                $kategoriJawaban[$jawaban['id_pertanyaan']][] = $jawaban['jawaban'];
            }

            $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1];
            $totalNilai = 0;
            $totalKategori = 0;

            foreach ($kategoriJawaban as $jawabans) {
                $totalBobot = array_sum(array_map(fn($jawaban) => $bobotJawaban[$jawaban], $jawabans));
                $totalJawaban = count($jawabans);
                if ($totalJawaban > 0) {
                    $totalNilai += $totalBobot / $totalJawaban;
                    $totalKategori++;
                }
            }

            $ikm = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;

            $this->db->table('survei')->where('id', $dataResponden['id_survei'])->update([
                'ikm' => $ikm
            ]);


            if ($i % 1000 === 0) {
                echo "Proses $i responden selesai...\n";
            }
        }
    }
}
