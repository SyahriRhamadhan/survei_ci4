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
        // $surveiModel = new SurveiModel();
        // Kirim data ke view
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
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

        if (!empty($questionIds)) {
            $questions = $pertanyaanModel->whereIn('id', $questionIds)->findAll();

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

        $data = [
            'title' => 'Hasil Survei',
            'survei' => $survei,
            'questions' => $questions,
            'responseCounts' => $responseCounts,
        ];
        return view('responden/chartfilter', $data);
    }
}
