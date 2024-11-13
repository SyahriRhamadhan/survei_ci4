<?php

namespace App\Controllers\Responden;

use App\Controllers\BaseController;
use App\Models\RespondenModel;
use App\Models\SurveiModel;
use App\Models\UnitKerjaModel;
use App\Models\ProdiModel;
use App\Models\FakultasModel;
use App\Models\JawabanSurveiModel;
use App\Models\UnitPlaceholderPertanyaanModel;
use App\Models\SurveiPertanyaanModel;
use App\Models\PertanyaanModel;

class Dashboard extends BaseController
{
    private function limitWords($text, $limit = 4)
    {
        $words = explode(' ', $text); // Pisahkan teks menjadi array kata
        if (count($words) > $limit) {
            return implode(' ', array_slice($words, 0, $limit)) . '...'; // Gabungkan 4 kata pertama dengan '...'
        }
        return $text; // Jika kata kurang dari atau sama dengan 4, kembalikan teks asli
    }

    public function index()
    {
        $respondenModel = new RespondenModel();
        $totalResponden = $respondenModel->countAllResults();

        // Mendapatkan tanggal hari ini
        $today = date('Y-m-d');
        $responseHariIni = $respondenModel->where('tanggal_survei', $today)->countAllResults();

        // Mengambil jumlah responden bulan ini
        $totalRespondenThisMonth = $respondenModel->where('MONTH(tanggal_survei)', date('m'))->countAllResults();

        // Mengambil jumlah responden bulan lalu
        $lastMonth = date('m', strtotime('-1 month'));
        $totalRespondenLastMonth = $respondenModel->where('MONTH(tanggal_survei)', $lastMonth)->countAllResults();

        // Menghitung persentase perubahan
        if ($totalRespondenLastMonth > 0) {
            $percentageChange = (($totalRespondenThisMonth - $totalRespondenLastMonth) / $totalRespondenLastMonth) * 100;
        } else {
            $percentageChange = 0; // Jika tidak ada responden bulan lalu, set persentase perubahan ke 0
        }

        // Tentukan apakah penurunan atau kenaikan
        $percentageClass = $percentageChange >= 0 ? 'bg-success' : 'bg-danger';
        $percentageSymbol = $percentageChange >= 0 ? '+' : '';

        // Mengambil jumlah survei yang sedang berjalan dengan status 'on'
        $surveiModel = new SurveiModel();
        $totalSurveiOn = $surveiModel->where('status', 'on')->countAllResults();

        // Ambil jumlah responden berdasarkan kategori_responden
        $kategoriRespondenCounts = $respondenModel
            ->select('kategori_responden, COUNT(*) as total')
            ->groupBy('kategori_responden')
            ->findAll();

        // Data untuk chart Doughnut
        $chartData = [];
        foreach ($kategoriRespondenCounts as $kategori) {
            $chartData[] = [
                'label' => ucfirst($kategori['kategori_responden']),
                'count' => $kategori['total']
            ];
        }

        // Data untuk chart dalam format JS
        $chartLabels = json_encode(array_column($chartData, 'label'));
        $chartValues = json_encode(array_column($chartData, 'count'));

        $respondenByKategori = [];
        foreach ($kategoriRespondenCounts as $kategori) {
            $respondenByKategori[$kategori['kategori_responden']] = $kategori['total'];
        }

        // Tambahkan logika di dalam metode index() di Dashboard controller
        $jenisKelaminCounts = $respondenModel
            ->select('jenis_kelamin, COUNT(*) as total')
            ->groupBy('jenis_kelamin')
            ->findAll();

        $jenisKelaminData = [];
        foreach ($jenisKelaminCounts as $gender) {
            $jenisKelaminData[] = [
                'label' => ucfirst($gender['jenis_kelamin']),
                'count' => $gender['total']
            ];
        }

        $chartLabelsGender = json_encode(array_column($jenisKelaminData, 'label'));
        $chartValuesGender = json_encode(array_column($jenisKelaminData, 'count'));

        // Menambahkan data untuk jenis kelamin ke $data yang dikirim ke view
        $data['chartLabelsGender'] = $chartLabelsGender;
        $data['chartValuesGender'] = $chartValuesGender;
        // Inisialisasi model baru untuk join
        $respondenModel = new RespondenModel();
        $unitModel = new UnitKerjaModel();
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();

        // Contoh query dengan join untuk mendapatkan nama fakultas dosen
        $fakultasDosenCounts = $respondenModel
            ->select('fakultas.nama AS fakultas_nama, COUNT(responden.id) as total')
            ->join('fakultas', 'responden.id_fakultas = fakultas.id')
            ->where('kategori_responden', 'dosen')
            ->groupBy('fakultas_nama')
            ->findAll();

        $fakultasDosenLabels = [];
        $fakultasDosenData = [];
        foreach ($fakultasDosenCounts as $fakultas) {
            $fakultasDosenLabels[] = $fakultas['fakultas_nama'];
            $fakultasDosenData[] = $fakultas['total'];
        }

        // Sama halnya untuk Prodi Mahasiswa dan Unit Tendik
        $prodiMahasiswaCounts = $respondenModel
            ->select('prodi.nama AS prodi_nama, COUNT(responden.id) as total')
            ->join('prodi', 'responden.id_prodi = prodi.id')
            ->where('kategori_responden', 'mahasiswa')
            ->groupBy('prodi_nama')
            ->findAll();

        $prodiMahasiswaLabels = [];
        $prodiMahasiswaData = [];
        foreach ($prodiMahasiswaCounts as $prodi) {
            $prodiMahasiswaLabels[] = $prodi['prodi_nama'];
            $prodiMahasiswaData[] = $prodi['total'];
        }

        $unitTendikCounts = $respondenModel
            ->select('unit_kerja.nama_unit AS unit_nama, COUNT(responden.id) as total')
            ->join('unit_kerja', 'responden.id_unit = unit_kerja.id')
            ->where('kategori_responden', 'tendik')
            ->groupBy('unit_nama')
            ->findAll();

        $unitTendikLabels = [];
        $unitTendikData = [];
        foreach ($unitTendikCounts as $unit) {
            $unitTendikLabels[] = $unit['unit_nama'];
            $unitTendikData[] = $unit['total'];
        }

        $averageIKM = $surveiModel->selectAvg('ikm')->first()['ikm'];

        // Ambil data IKM berdasarkan unit placeholder
        $unitIKMData = $surveiModel
            ->select('unit_placeholder_pertanyaan.nama_unit, AVG(survei.ikm) as ikm_avg')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->groupBy('unit_placeholder_pertanyaan.nama_unit')
            ->findAll();

        $ikmLabels = [];
        $ikmValues = [];

        foreach ($unitIKMData as $ikmRow) {
            // Ambil nama unit
            $namaUnit = $ikmRow['nama_unit'];

            // Cek apakah ada singkatan dalam tanda kurung
            if (preg_match('/\(([^)]+)\)/', $namaUnit, $matches)) {
                // Jika ada, gunakan singkatan di dalam tanda kurung
                $ikmLabels[] = $matches[1];
            } else {
                // Jika tidak ada singkatan, gunakan nama unit secara penuh
                $ikmLabels[] = $namaUnit;
            }

            // Tambahkan nilai IKM
            $ikmValues[] = round($ikmRow['ikm_avg'], 2);
        }


        // Data IKM berdasarkan unit dan layanan
        $ikmDataByUnit = $surveiModel
            ->select('unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima, AVG(survei.ikm) as ikm_avg')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->groupBy(['unit_placeholder_pertanyaan.nama_unit', 'unit_placeholder_pertanyaan.jenis_layanan_yang_diterima'])
            ->findAll();

        // Strukturkan data untuk chart
        $ikmUnitLabels = [];
        $ikmUnitData = [];

        foreach ($ikmDataByUnit as $ikmRow) {
            // Ambil nama unit
            $namaUnit = $ikmRow['nama_unit'];

            // Cek apakah ada singkatan dalam tanda kurung
            if (preg_match('/\(([^)]+)\)/', $namaUnit, $matches)) {
                // Jika ada, gunakan singkatan di dalam tanda kurung
                $singkatanNamaUnit = $matches[1];
            } else {
                // Jika tidak ada singkatan, gunakan nama unit secara penuh
                $singkatanNamaUnit = $namaUnit;
            }

            // Gabungkan singkatan nama unit dengan jenis layanan yang diterima
            $ikmUnitLabels[] = "{$singkatanNamaUnit} - {$ikmRow['jenis_layanan_yang_diterima']}";
            $ikmUnitData[] = round($ikmRow['ikm_avg'], 2);
        }

        // Mengambil nama unit unik setelah disingkat jika perlu
        $unitNames = array_unique(array_column($ikmDataByUnit, 'nama_unit'));;
        $unitModel = new SurveiModel();
        // Ambil data dari model
        // $unitList = $unitModel->getSurveiWithUnitFilter();

        // // Proses data
        // foreach ($unitList as &$unit) {
        //     // Ambil singkatan nama_unit
        //     if (preg_match('/\(([^)]+)\)/', $unit['nama_unit'], $matches)) {
        //         $unit['nama_unit'] = $matches[1];
        //     }

        //     // Batasi kata pada judul dan jenis_layanan_yang_diterima
        //     $unit['judul'] = $this->limitWords($unit['judul'], 5);
        //     $unit['jenis_layanan_yang_diterima'] = $this->limitWords($unit['jenis_layanan_yang_diterima'], 4);
        // }
        $placeholder = new UnitPlaceholderPertanyaanModel();
        // Kirim data ke view
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
            'filter' => $placeholder->getSortedUnits(),
            'unitList' => $unitModel->getSurveiWithUnitFilter(),
            'totalResponden' => $totalResponden,
            'responseHariIni' => $responseHariIni,
            'percentageChange' => $percentageChange,
            'percentageClass' => $percentageClass,
            'percentageSymbol' => $percentageSymbol,
            'totalSurveiOn' => $totalSurveiOn,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'respondenByKategori' => $respondenByKategori,
            'chartLabelsGender' => $chartLabelsGender,
            'chartValuesGender' => $chartValuesGender,
            'fakultasDosenLabels' => json_encode($fakultasDosenLabels),
            'fakultasDosenData' => json_encode($fakultasDosenData),
            'prodiMahasiswaLabels' => json_encode($prodiMahasiswaLabels),
            'prodiMahasiswaData' => json_encode($prodiMahasiswaData),
            'unitTendikLabels' => json_encode($unitTendikLabels),
            'unitTendikData' => json_encode($unitTendikData),
            'averageIKM' => round($averageIKM, 2),
            'ikmLabels' => json_encode($ikmLabels),
            'ikmValues' => json_encode($ikmValues),
            'ikmUnitLabels' => json_encode($ikmUnitLabels),
            'ikmUnitData' => json_encode($ikmUnitData),
            'unitNames' => $unitNames,
        ];

        return view('responden/dashboard', $data);
    }

    public function filter($id)
    {
        $surveiModel = new SurveiModel();
        $jawabanSurveiModel = new JawabanSurveiModel();
        $respondenModel = new RespondenModel();
        $pertanyaanModel = new PertanyaanModel();
        $unitModel = new UnitKerjaModel();
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();
        $placeholder = new UnitPlaceholderPertanyaanModel();

        // Fetch the survey data
        $survei = $surveiModel
            ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->find($id);

        if (!$survei) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Survei dengan ID $id tidak ditemukan.");
        }

        $questionIds = $jawabanSurveiModel
            ->select('id_pertanyaan')
            ->where('id_survei', $id)
            ->groupBy('id_pertanyaan')
            ->findColumn('id_pertanyaan');

        $namaUnit = $survei['nama_unit'];
        $singkatan = '';
        if (preg_match('/\((.*?)\)/', $namaUnit, $matches)) {
            $singkatan = $matches[1];
        } else {
            $singkatan = $namaUnit;
        }

        if (!empty($questionIds)) {
            $questions = $pertanyaanModel->whereIn('id', $questionIds)->findAll();

            foreach ($questions as &$question) {
                $question['pertanyaan'] = str_replace('<tag>', $singkatan, $question['pertanyaan']);
            }
            $responseCounts = $jawabanSurveiModel
                ->select('id_pertanyaan, jawaban, COUNT(*) as count')
                ->where('id_survei', $id)
                ->whereIn('id_pertanyaan', $questionIds)
                ->groupBy('id_pertanyaan, jawaban')
                ->findAll();
        } else {
            $questions = [];
            $responseCounts = [];
        }

        // Untuk chart kategori responden
        $kategoriRespondenCounts = $respondenModel
            ->select('kategori_responden, COUNT(DISTINCT responden.id) as count')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('jawaban_survei.id_survei', $id)
            ->groupBy('kategori_responden')
            ->findAll();


        $kategoriLabels = [];
        $kategoriCounts = [];
        foreach ($kategoriRespondenCounts as $kategori) {
            $kategoriLabels[] = $kategori['kategori_responden'];
            $kategoriCounts[] = $kategori['count'];
        }

        // Menghitung total responden 
        $totalResponden = $respondenModel
            ->select('COUNT(DISTINCT responden.id) as total_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('jawaban_survei.id_survei', $id)
            ->first();

        $totalResponden = $totalResponden ? $totalResponden['total_responden'] : 0;

        // Angkatan mahasiswa
        $angkatanCounts = $respondenModel
            ->select('angkatan, COUNT(DISTINCT responden.id) as count')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('jawaban_survei.id_survei', $id)
            ->where('kategori_responden', 'mahasiswa')
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'ASC')
            ->findAll();

        $angkatanLabels = [];
        $angkatanData = [];
        foreach ($angkatanCounts as $angkatan) {
            $angkatanLabels[] = $angkatan['angkatan'];
            $angkatanData[] = $angkatan['count'];
        }


        // Untuk chart jenis kelamin
        $genderCounts = $respondenModel
            ->select('jenis_kelamin, COUNT(DISTINCT responden.id) as count')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('jawaban_survei.id_survei', $id)
            ->groupBy('jenis_kelamin')
            ->findAll();

        $genderLabels = [];
        $genderData = [];
        foreach ($genderCounts as $gender) {
            $genderLabels[] = $gender['jenis_kelamin'];
            $genderData[] = $gender['count'];
        }

        $totalUnsur = $pertanyaanModel->select('DISTINCT tipe_pertanyaan')->countAllResults();
        $bobot = 1 / $totalUnsur; // Bobot tertimbang untuk setiap unsur

        // Ambil semua jawaban berdasarkan tipe_pertanyaan
        $jawabanPerKategori = $jawabanSurveiModel->select('pertanyaan.tipe_pertanyaan, jawaban')
            ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
            ->where('jawaban_survei.id_survei', $id)
            ->findAll();

        $kategoriJawaban = [];
        foreach ($jawabanPerKategori as $jawaban) {
            $kategoriJawaban[$jawaban['tipe_pertanyaan']][] = $jawaban['jawaban'];
        }

        // Menghitung rata-rata tertimbang berdasarkan jawaban
        $rataRataTertimbang = [];
        $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1]; // Bobot untuk setiap nilai jawaban (1-4)
        foreach ($kategoriJawaban as $kategori => $jawabans) {
            $totalBobot = 0;
            $totalJawaban = 0;
            foreach ($jawabans as $jawaban) {
                $totalBobot += $bobotJawaban[$jawaban]; // Kalikan jawaban dengan bobotnya
                $totalJawaban++;
            }
            $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
        }

        // Menghitung total nilai rata-rata tertimbang
        $totalNilai = array_sum($rataRataTertimbang);
        $totalKategori = count($rataRataTertimbang);
        $IKM = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0; // Konversi ke skala 25-100

        // Menentukan kategori IKM berdasarkan nilai
        if ($IKM >= 1 && $IKM <= 64.99) {
            $ikmCategory = 'Tidak Baik';
        } elseif ($IKM >= 65 && $IKM <= 76.60) {
            $ikmCategory = 'Kurang Baik';
        } elseif ($IKM >= 76.61 && $IKM <= 88.30) {
            $ikmCategory = 'Baik';
        } elseif ($IKM >= 88.31 && $IKM <= 100) {
            $ikmCategory = 'Sangat Baik';
        } else {
            $ikmCategory = 'Nilai IKM tidak valid';
        }

        $data = [
            'title' => 'Hasil Survei',
            'survei' => $survei,
            'questions' => $questions,
            'responseCounts' => $responseCounts,
            'kategoriLabels' => $kategoriLabels,
            'kategoriCounts' => $kategoriCounts,
            'totalResponden' => $totalResponden,
            'angkatanLabels' => $angkatanLabels,
            'angkatanData' => $angkatanData,
            'genderLabels' => $genderLabels,
            'genderData' => $genderData,
            'typeLabels' => array_keys($rataRataTertimbang),
            'weightedAverageValues' => array_values($rataRataTertimbang),
            'IKM' => round($IKM, 2), // Bulatkan nilai IKM
            'ikmCategory' => $ikmCategory, // Kategori IKM
        ];
        return view('responden/chartfilter', $data);
    }
    //bro ini lemot
    // public function hitungIKMUnit($namaUnit)
    // {
    //     $placeholderModel = new UnitPlaceholderPertanyaanModel();
    //     $surveiModel = new SurveiModel();
    //     $jawabanSurveiModel = new JawabanSurveiModel();
    //     $pertanyaanModel = new PertanyaanModel();

    //     // Cari semua unit placeholder berdasarkan nama_unit
    //     $unitPlaceholders = $placeholderModel->where('nama_unit', urldecode($namaUnit))->findAll();

    //     if (empty($unitPlaceholders)) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException("Unit dengan nama '$namaUnit' tidak ditemukan");
    //     }

    //     // Ambil semua ID unit placeholder
    //     $unitPlaceholderIds = array_column($unitPlaceholders, 'id');

    //     // Cari survei terkait dengan semua unit placeholder
    //     $surveiList = $surveiModel
    //         ->select('survei.*, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima as jenis_layanan')
    //         ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
    //         ->whereIn('survei.id_unit_placeholder', $unitPlaceholderIds)
    //         ->findAll();

    //     if (empty($surveiList)) {
    //         return view('responden/chartfilterunit', [
    //             'nama_unit' => $namaUnit,
    //             'ikm' => 0,
    //             'kategori' => 'Tidak ada data survei',
    //         ]);
    //     }

    //     // Inisialisasi variabel untuk hasil
    //     $totalIKM = 0;
    //     $totalSurvei = 0;
    //     $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1];

    //     foreach ($surveiList as $survei) {
    //         if (!isset($survei['jenis_layanan'])) {
    //             continue;
    //         }

    //         $jawabanSurvei = $jawabanSurveiModel
    //             ->select('pertanyaan.tipe_pertanyaan, jawaban_survei.jawaban')
    //             ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
    //             ->where('jawaban_survei.id_survei', $survei['id'])
    //             ->findAll();

    //         if (empty($jawabanSurvei)) {
    //             continue; // Lewati survei tanpa data jawaban
    //         }

    //         $kategoriJawaban = [];
    //         foreach ($jawabanSurvei as $jawaban) {
    //             $kategoriJawaban[$jawaban['tipe_pertanyaan']][] = $jawaban['jawaban'];
    //         }

    //         $rataRataTertimbang = [];
    //         foreach ($kategoriJawaban as $kategori => $jawabans) {
    //             $totalBobot = 0;
    //             $totalJawaban = 0;
    //             foreach ($jawabans as $jawaban) {
    //                 $totalBobot += $bobotJawaban[$jawaban];
    //                 $totalJawaban++;
    //             }
    //             $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
    //         }

    //         $totalNilai = array_sum($rataRataTertimbang);
    //         $totalKategori = count($rataRataTertimbang);
    //         $IKM = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;

    //         $totalIKM += $IKM;
    //         $totalSurvei++;
    //     }

    //     // Hitung rata-rata IKM
    //     $averageIKM = $totalSurvei > 0 ? $totalIKM / $totalSurvei : 0;

    //     // Menentukan kategori rata-rata IKM
    //     $ikmCategory = match (true) {
    //         $averageIKM >= 1 && $averageIKM <= 64.99 => 'Tidak Baik',
    //         $averageIKM >= 65 && $averageIKM <= 76.60 => 'Kurang Baik',
    //         $averageIKM >= 76.61 && $averageIKM <= 88.30 => 'Baik',
    //         $averageIKM >= 88.31 && $averageIKM <= 100 => 'Sangat Baik',
    //         default => 'Nilai IKM tidak valid',
    //     };

    //     // Tampilkan hasil ke view
    //     return view('responden/chartfilterunit', [
    //         'nama_unit' => $namaUnit,
    //         'ikm' => number_format($averageIKM, 2),
    //         'kategori' => $ikmCategory,
    //     ]);
    // }

    public function hitungIKMUnit($namaUnit)
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $surveiModel = new SurveiModel();
        $jawabanSurveiModel = new JawabanSurveiModel();
        $pertanyaanModel = new PertanyaanModel();

        $unitPlaceholders = $placeholderModel->where('nama_unit', urldecode($namaUnit))->findAll();

        if (empty($unitPlaceholders)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Unit dengan nama '$namaUnit' tidak ditemukan");
        }

        $unitPlaceholderIds = array_column($unitPlaceholders, 'id');

        $surveiList = $surveiModel
            ->select('survei.id, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima as jenis_layanan')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->whereIn('survei.id_unit_placeholder', $unitPlaceholderIds)
            ->findAll();

        if (empty($surveiList)) {
            return view('responden/chartfilterunit', [
                'nama_unit' => $namaUnit,
                'ikm' => 0,
                'kategori' => 'Tidak ada data survei',
            ]);
        }

        $surveiIds = array_column($surveiList, 'id');
        $jawabanSurvei = $jawabanSurveiModel
            ->select('jawaban_survei.id_survei, pertanyaan.tipe_pertanyaan, jawaban_survei.jawaban')
            ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->findAll();

        $groupedJawaban = [];
        foreach ($jawabanSurvei as $jawaban) {
            $groupedJawaban[$jawaban['id_survei']][] = $jawaban;
        }

        $totalIKM = 0;
        $totalSurvei = 0;
        $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1];

        foreach ($surveiList as $survei) {
            $jawabanSurvei = $groupedJawaban[$survei['id']] ?? [];
            if (empty($jawabanSurvei)) {
                continue;
            }

            $kategoriJawaban = [];
            foreach ($jawabanSurvei as $jawaban) {
                $kategoriJawaban[$jawaban['tipe_pertanyaan']][] = $jawaban['jawaban'];
            }

            $rataRataTertimbang = [];
            foreach ($kategoriJawaban as $kategori => $jawabans) {
                $totalBobot = 0;
                $totalJawaban = count($jawabans);
                foreach ($jawabans as $jawaban) {
                    $totalBobot += $bobotJawaban[$jawaban];
                }
                $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
            }

            $totalNilai = array_sum($rataRataTertimbang);
            $totalKategori = count($rataRataTertimbang);
            $IKM = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;

            $totalIKM += $IKM;
            $totalSurvei++;
        }

        $averageIKM = $totalSurvei > 0 ? $totalIKM / $totalSurvei : 0;

        $ikmCategory = match (true) {
            $averageIKM >= 1 && $averageIKM <= 64.99 => 'Tidak Baik',
            $averageIKM >= 65 && $averageIKM <= 76.60 => 'Kurang Baik',
            $averageIKM >= 76.61 && $averageIKM <= 88.30 => 'Baik',
            $averageIKM >= 88.31 && $averageIKM <= 100 => 'Sangat Baik',
            default => 'Nilai IKM tidak valid',
        };

        return view('responden/chartfilterunit', [
            'nama_unit' => $namaUnit,
            'ikm' => number_format($averageIKM, 2),
            'kategori' => $ikmCategory,
        ]);
    }
}
