<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StatusFilterModel;
use App\Models\RespondenModel;
use App\Models\SurveiModel;
use App\Models\JawabanSurveiModel;
use App\Models\UnitPlaceholderPertanyaanModel;
use App\Models\PertanyaanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $filter = new StatusFilterModel();

        $dataId1 = $filter->find(1);

        $session = session();
        $userId = $session->get('id');
        $userName = $session->get('name');
        $userRole = $session->get('role_id');

        $placeholder = new UnitPlaceholderPertanyaanModel();
        $unitModel = new SurveiModel();
        $data = [
            'title' => 'Dashboard',
            'unitList' => $unitModel->getSurveiWithUnitFilter(),
            'filter2' => $placeholder->getSortedUnits(),
            'filter' => $dataId1,
            'user_id' => $userId,
            'user_name' => $userName,
            'user_role' => $userRole
        ];

        return view('admin/dashboard', $data);
    }

    public function updateStatus()
    {
        $status = $this->request->getPost('status');
        $id = 1;

        $filter = new StatusFilterModel();

        if (in_array($status, ['on', 'off'])) {
            $filter->update($id, ['value' => $status]);

            return redirect()->to('/admin/dashboard')->with('status', 'Status updated successfully');
        }

        return redirect()->to('/admin/dashboard')->with('error', 'Invalid status value');
    }

    public function hitungIKMUnit($namaUnit)
    {
        ini_set('max_execution_time', 500);
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $surveiModel = new SurveiModel();
        $jawabanSurveiModel = new JawabanSurveiModel();
        $pertanyaanModel = new PertanyaanModel();
        $respondenModel = new RespondenModel();

        $tahun = $this->request->getGet('tahun');
        $tahun = $tahun ?: date('Y');

        $unitPlaceholders = $placeholderModel->where('nama_unit', urldecode($namaUnit))->findAll();
        if (empty($unitPlaceholders)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Unit dengan nama '$namaUnit' tidak ditemukan");
        }

        $unitPlaceholderIds = array_column($unitPlaceholders, 'id');

        // Ambil data survei berdasarkan unit placeholder
        $surveiList = $surveiModel
            ->select('survei.id, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima as jenis_layanan')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->whereIn('survei.id_unit_placeholder', $unitPlaceholderIds)
            ->findAll();

        if (empty($surveiList)) {
            return view('admin/chartfilterunit', [
                'nama_unit' => $namaUnit,
                'ikm' => 0,
                'kategori' => 'Tidak ada data survei',
                'totalResponden' => 0,
                'tahun' => $tahun,
                'kategoriLabels' => '[]',
                'kategoriCounts' => '[]',
                'ikmUnitLabels' => '[]',
                'ikmUnitData' => '[]',
                'ikmUnitDataAvg' => '[]',
                'genderCounts' => '[]',
                'angkatanLabels' => '[]',
                'angkatanCounts' => '[]',
                'alumniLabels' => '[]',
                'alumniCounts' => '[]',
                'prodiLabels' => '[]',
                'prodiCounts' => '[]',
                'fakultasLabels' => '[]',
                'fakultasCounts' => '[]',
                'unitLabels' => '[]',
                'unitCounts' => '[]',
                'respondenData' => '[]',
                'totalFakultasResponden' => '[]',
                'totalUnitResponden' => '[]',
                'totalAngkatanResponden' => '[]',
                'totalProdiResponden' => '[]',
            ]);
        }

        $surveiIds = array_column($surveiList, 'id');

        $totalResponden = $jawabanSurveiModel
            ->select('id_responden')
            ->whereIn('id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('id_responden')
            ->countAllResults();

        $respondenKategoriCount = $respondenModel->select('kategori_responden, COUNT(DISTINCT jawaban_survei.id_responden) as count')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('kategori_responden')
            ->findAll();

        $kategoriRespondenData = [];
        foreach ($respondenKategoriCount as $item) {
            $kategoriRespondenData[$item['kategori_responden']] = $item['count'];
        }

        // Define kategori responden dan hitung jumlah kategori
        $kategoriLabels = ['Mahasiswa', 'Dosen', 'Tendik', 'Mitra', 'Umum', 'Alumni'];
        $kategoriCounts = [
            $kategoriRespondenData['mahasiswa'] ?? 0,
            $kategoriRespondenData['dosen'] ?? 0,
            $kategoriRespondenData['tendik'] ?? 0,
            $kategoriRespondenData['mitra'] ?? 0,
            $kategoriRespondenData['umum'] ?? 0,
            $kategoriRespondenData['alumni'] ?? 0,
        ];

        $jawabanSurvei = $jawabanSurveiModel
            ->select('jawaban_survei.id_survei, pertanyaan.tipe_pertanyaan, jawaban_survei.jawaban')
            ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->findAll();

        $groupedJawaban = [];
        foreach ($jawabanSurvei as $jawaban) {
            $groupedJawaban[$jawaban['id_survei']][] = $jawaban;
        }


        $genderCount = $respondenModel
            ->select('jenis_kelamin, COUNT(DISTINCT responden.id) as count')  // COUNT DISTINCT on respondents
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('jenis_kelamin')
            ->findAll();

        $genderCounts = [
            'Laki-laki' => 0,
            'Perempuan' => 0
        ];
        foreach ($genderCount as $item) {
            if ($item['jenis_kelamin'] == 'Laki-laki') {
                $genderCounts['Laki-laki'] = $item['count'];
            } elseif ($item['jenis_kelamin'] == 'Perempuan') {
                $genderCounts['Perempuan'] = $item['count'];
            }
        }
        $ikmDataByUnit = $jawabanSurveiModel
            ->select('unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit,
             unit_placeholder_pertanyaan.jenis_layanan_yang_diterima, 
             AVG(jawaban_survei.jawaban) as ikm_avg, 
             pertanyaan.tipe_pertanyaan')
            ->join('survei', 'survei.id = jawaban_survei.id_survei')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
            ->whereIn('survei.id_unit_placeholder', $unitPlaceholderIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy([
                'unit_placeholder_pertanyaan.jenis_unit',
                'unit_placeholder_pertanyaan.nama_unit',
                'unit_placeholder_pertanyaan.jenis_layanan_yang_diterima',
                'pertanyaan.tipe_pertanyaan'
            ])
            ->findAll();

        $kategoriJawaban = [];

        foreach ($ikmDataByUnit as $ikmRow) {
            $jenisLayanan = $ikmRow['jenis_layanan_yang_diterima'];
            $ikmAvg = $ikmRow['ikm_avg'];
            $kategoriJawaban[$jenisLayanan][] = $ikmAvg;
        }

        $rataRataTertimbang = [];
        foreach ($kategoriJawaban as $kategori => $ikmAverages) {
            $totalBobot = 0;
            $totalJawaban = 0;

            foreach ($ikmAverages as $ikmAvg) {
                $totalBobot += $ikmAvg;
                $totalJawaban++;
            }

            $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
        }
        $totalNilai = array_sum($rataRataTertimbang);
        $totalKategori = count($rataRataTertimbang);

        $IKM = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;
        if ($IKM >= 1 && $IKM <= 64.99) {
            $ikmCategory = 'Tidak Baik/Kurang';
        } elseif ($IKM >= 65 && $IKM <= 76.60) {
            $ikmCategory = 'Kurang Baik/Cukup';
        } elseif ($IKM >= 76.61 && $IKM <= 88.30) {
            $ikmCategory = 'Baik';
        } elseif ($IKM >= 88.31 && $IKM <= 100) {
            $ikmCategory = 'Sangat Baik';
        } else {
            $ikmCategory = 'Nilai IKM tidak valid';
        }

        $ikmUnitLabels = [];
        $ikmUnitData = [];
        foreach ($ikmDataByUnit as $ikmRow) {
            $namaUnit = $ikmRow['nama_unit'];
            $jenisLayanan = $ikmRow['jenis_layanan_yang_diterima'];
            $jenisLayanan1 = $ikmRow['jenis_unit'];
            $ikmAvg = $ikmRow['ikm_avg'];

            if (isset($kategoriJawaban[$jenisLayanan])) {
                $totalJawaban = count($kategoriJawaban[$jenisLayanan]);
                $rataIkm = array_sum($kategoriJawaban[$jenisLayanan]) / $totalJawaban;
            } else {
                $rataIkm = 0;
            }

            if (preg_match('/\(([^)]+)\)/', $namaUnit, $matches)) {
                $singkatanNamaUnit = $matches[1];
            } else {
                $singkatanNamaUnit = $namaUnit;
            }

            $ikmUnitLabels[] = "{$jenisLayanan1} - {$singkatanNamaUnit} - {$jenisLayanan}";
            $ikmUnitData[] = round($rataIkm * 25, 2); // Multiply by 25 to scale
        }

        // Data responden kategori mahasiswa dengan filtering berdasarkan survei dan tahun
        $angkatanMahasiswa = $respondenModel
            ->select('angkatan, COUNT(DISTINCT responden.id) as jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('responden.kategori_responden', 'mahasiswa')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'ASC')
            ->findAll();

        $angkatanLabels = array_column($angkatanMahasiswa, 'angkatan');
        $angkatanCounts = array_column($angkatanMahasiswa, 'jumlah_responden');

        // Data responden kategori mahasiswa dengan filtering berdasarkan survei dan tahun
        $alumniMahasiswa = $respondenModel
            ->select('angkatan, COUNT(DISTINCT responden.id) as jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->where('responden.kategori_responden', 'alumni')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'ASC')
            ->findAll();

        $alumniLabels = array_column($alumniMahasiswa, 'angkatan');
        $alumniCounts = array_column($alumniMahasiswa, 'jumlah_responden');

        // Data responden kategori mahasiswa berdasarkan survei, tahun, dan program studi
        $prodiMahasiswa = $respondenModel
            ->select('prodi.nama, COUNT(DISTINCT responden.id) as jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->join('prodi', 'prodi.id = responden.id_prodi', 'left') // Gabungkan dengan tabel prodi
            ->where('responden.kategori_responden', 'mahasiswa')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('prodi.nama')
            ->orderBy('prodi.nama', 'ASC')
            ->findAll();

        $prodiLabels = array_column($prodiMahasiswa, 'nama');
        $prodiCounts = array_column($prodiMahasiswa, 'jumlah_responden');

        // Data responden kategori dosen berdasarkan survei, tahun, dan fakultas
        $fakultasDosen = $respondenModel
            ->select('fakultas.nama, COUNT(DISTINCT responden.id) as jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->join('fakultas', 'fakultas.id = responden.id_fakultas', 'left') // Gabungkan dengan tabel fakultas
            ->where('responden.kategori_responden', 'dosen')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('fakultas.nama')
            ->orderBy('fakultas.nama', 'ASC')
            ->findAll();

        // Pisahkan data fakultas menjadi labels dan counts
        $fakultasLabels = array_column($fakultasDosen, 'nama');
        $fakultasCounts = array_column($fakultasDosen, 'jumlah_responden');

        // Data responden kategori tendik berdasarkan survei, tahun, dan unit kerja
        $unitKerjaTendik = $respondenModel
            ->select('unit_kerja.nama_unit, COUNT(DISTINCT responden.id) as jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->join('unit_kerja', 'unit_kerja.id = responden.id_unit', 'left') // Gabungkan dengan tabel unit_kerja
            ->where('responden.kategori_responden', 'tendik')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('YEAR(jawaban_survei.created_at)', $tahun)
            ->groupBy('unit_kerja.nama_unit')
            ->orderBy('unit_kerja.nama_unit', 'ASC')
            ->findAll();

        $unitLabels = [];
        $unitCounts = [];

        foreach ($unitKerjaTendik as $unit) {
            if (preg_match('/\((.*?)\)/', $unit['nama_unit'], $matches)) {
                $unitLabels[] = $matches[1];
            } else {
                $unitLabels[] = $unit['nama_unit'];
            }

            $unitCounts[] = $unit['jumlah_responden'];
        }

        // Hitung total angkatan responden
        $totalAngkatanResponden = array_sum($angkatanCounts);

        // Hitung total responden dari prodi
        $totalProdiResponden = array_sum($prodiCounts);

        // Hitung total responden dari fakultas
        $totalFakultasResponden = array_sum($fakultasCounts);
        $totalUnitResponden = array_sum($unitCounts);

        // $respondenData = $respondenModel
        //     ->select('responden.kategori_responden, responden.saran_masukan, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima,unit_placeholder_pertanyaan.nama_unit, COUNT(DISTINCT responden.id) as jumlah_responden')
        //     ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
        //     ->join('survei', 'jawaban_survei.id_survei = survei.id')
        //     ->join('unit_placeholder_pertanyaan', 'survei.id_unit_placeholder = unit_placeholder_pertanyaan.id')
        //     ->whereIn('jawaban_survei.id_survei', $surveiIds)
        //     ->where('YEAR(jawaban_survei.created_at)', $tahun)
        //     ->groupBy('responden.kategori_responden, responden.saran_masukan, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
        //     ->orderBy('responden.kategori_responden', 'ASC')
        //     ->findAll();
        $respondenData = $respondenModel
            ->select('responden.kategori_responden, responden.saran_masukan, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima, unit_placeholder_pertanyaan.nama_unit, COUNT(DISTINCT responden.id) AS jumlah_responden')
            ->join('jawaban_survei', 'jawaban_survei.id_responden = responden.id')
            ->join('survei', 'jawaban_survei.id_survei = survei.id')
            ->join('unit_placeholder_pertanyaan', 'survei.id_unit_placeholder = unit_placeholder_pertanyaan.id')
            ->whereIn('jawaban_survei.id_survei', $surveiIds)
            ->where('jawaban_survei.created_at >=', $tahun . '-01-01') // Membatasi secara eksplisit dengan tanggal
            ->where('jawaban_survei.created_at <=', $tahun . '-12-31')
            ->groupBy(['responden.kategori_responden', 'responden.saran_masukan', 'unit_placeholder_pertanyaan.jenis_layanan_yang_diterima'])
            ->orderBy('responden.kategori_responden', 'ASC')
            ->findAll();


        return view('admin/chartfilterunit', [
            'nama_unit' => $namaUnit,
            // 'ikm' => round($averageIKM, 2),
            'kategori' => $ikmCategory,
            'totalResponden' => $totalResponden,
            'tahun' => $tahun,
            'kategoriLabels' => json_encode($kategoriLabels),
            'genderCounts' => $genderCounts,
            'kategoriCounts' => json_encode($kategoriCounts),
            'ikmUnitLabels' => json_encode($ikmUnitLabels),
            'ikmUnitData' => json_encode($ikmUnitData),
            'ikmUnitDataAvg' => round($IKM, 2),
            'angkatanLabels' => json_encode($angkatanLabels),
            'angkatanCounts' => json_encode($angkatanCounts),
            'alumniLabels' => json_encode($alumniLabels),
            'alumniCounts' => json_encode($alumniCounts),
            'prodiLabels' => json_encode($prodiLabels),
            'prodiCounts' => json_encode($prodiCounts),
            'fakultasLabels' => json_encode($fakultasLabels),
            'fakultasCounts' => json_encode($fakultasCounts),
            'unitLabels' => json_encode($unitLabels),
            'unitCounts' => json_encode($unitCounts),
            'totalAngkatanResponden' => $totalAngkatanResponden,
            'totalProdiResponden' => $totalProdiResponden,
            'totalFakultasResponden' => $totalFakultasResponden,
            'totalUnitResponden' => $totalUnitResponden,
            'respondenData' => $respondenData,
        ]);
    }
}
