<?php

namespace App\Controllers\Responden;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\RespondenModel;
use App\Models\SurveiModel;

use App\Models\PertanyaanModel;
use App\Models\JawabanSurveiModel;
use App\Models\SurveiPertanyaanModel;
use App\Models\UnitKerjaModel;

class Layanan extends BaseController
{
    public function index()
    {
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();
        $unitModel = new SurveiModel();
        $surveiModel = new SurveiModel();
        $unitKerja = new UnitKerjaModel();
        $data = [
            'title' => 'Layanan',
            'currentPage' => 'layanan',
            'prodiList' => $prodiModel->findAll(),
            'fakultasList' => $fakultasModel->findAll(),
            'unitList' => $unitModel->getSurveiWithUnit(),
            'unitKerja' => $unitKerja->findAll(),
            'mahasiswa' => $unitModel->getSurveiWithUnitMahasiswa(),
            'dosen' => $unitModel->getSurveiWithUnitDosen(),
            'tendik' => $unitModel->getSurveiWithUnitTendik(),
            'mitra' => $unitModel->getSurveiWithUnitMitra(),
            'survei' => $surveiModel
                ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit')
                ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
                ->findAll()
        ];

        return view('responden/layanan/layanan', $data);
    }

    public function detail($id)
    {
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();
        $surveiModel = new SurveiModel();
        $unitModel = new SurveiModel();
        $surveiPertanyaanModel = new SurveiPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();
        $unitKerja = new UnitKerjaModel();

        $survei = $surveiModel
            ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->where('survei.status', 'on')
            ->find($id);

        if (!$survei) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Survei dengan ID $id tidak ditemukan.");
        }

        $pertanyaanTerkait = $surveiPertanyaanModel
            ->where('id_survei', $id)
            ->findAll();

        $pertanyaanGrouped = [];
        foreach ($pertanyaanTerkait as $pertanyaan) {
            $detailPertanyaan = $pertanyaanModel->find($pertanyaan['id_pertanyaan']);
            $kategori = $detailPertanyaan['tipe_pertanyaan'];

            $detailPertanyaan['pertanyaan'] = str_replace('<tag>', $survei['nama_unit'], $detailPertanyaan['pertanyaan']);

            $pertanyaanGrouped[$kategori][] = $detailPertanyaan;
        }

        $data = [
            'title' => 'Detail Survei',
            'survei' => $survei,
            'pertanyaanGrouped' => $pertanyaanGrouped,
            'unitList' => $unitModel->getSurveiWithUnit(),
            'prodiList' => $prodiModel->findAll(),
            'fakultasList' => $fakultasModel->findAll(),
            'unitKerja' => $unitKerja->findAll()
        ];
        return view('responden/layanan/detail', $data);
    }


    public function store()
    {
        $respondenModel = new RespondenModel();
        $jawabanSurveiModel = new JawabanSurveiModel();
        $surveiModel = new SurveiModel();

        // Menyimpan data responden
        $dataResponden = [
            'kategori_responden' => $this->request->getPost('kategori_responden'),
            'angkatan' => $this->request->getPost('angkatan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'tanggal_survei' => date('Y-m-d'),
            'jam_survei' => $this->request->getPost('jam_survei'),
            'saran_masukan' => $this->request->getPost('saran_masukan'),
            'id_survei' => $this->request->getPost('id_survei'),
            'id_fakultas' => $this->request->getPost('id_fakultas') ?: null,
            'id_prodi' => $this->request->getPost('id_prodi') ?: null,
            'id_unit' => $this->request->getPost('id_unit') ?: null,
        ];

        // Insert data responden dan dapatkan ID-nya
        $respondenId = $respondenModel->insert($dataResponden);

        // Menyimpan jawaban survei
        $jawabanSurvei = $this->request->getPost('penilaian');
        foreach ($jawabanSurvei as $pertanyaanId => $jawaban) {
            $jawabanSurveiModel->insert([
                'id_responden' => $respondenId,
                'id_pertanyaan' => $pertanyaanId,
                'jawaban' => $jawaban,
                'id_survei' => $this->request->getPost('id_survei')
            ]);
        }

        $jawabanPerKategori = $jawabanSurveiModel->select('pertanyaan.tipe_pertanyaan, jawaban')
            ->join('pertanyaan', 'pertanyaan.id = jawaban_survei.id_pertanyaan')
            ->where('jawaban_survei.id_survei', $this->request->getPost('id_survei'))
            ->findAll();

        $kategoriJawaban = [];
        foreach ($jawabanPerKategori as $jawaban) {
            $kategoriJawaban[$jawaban['tipe_pertanyaan']][] = $jawaban['jawaban'];
        }

        $rataRataTertimbang = [];
        foreach ($kategoriJawaban as $kategori => $jawabans) {
            $bobotJawaban = [4 => 4, 3 => 3, 2 => 2, 1 => 1];
            $totalBobot = 0;
            $totalJawaban = 0;
            foreach ($jawabans as $jawaban) {
                $totalBobot += $bobotJawaban[$jawaban];
                $totalJawaban++;
            }
            $rataRataTertimbang[$kategori] = $totalJawaban > 0 ? $totalBobot / $totalJawaban : 0;
        }


        $totalNilai = 0;
        $totalKategori = count($rataRataTertimbang);

        foreach ($rataRataTertimbang as $kategori => $nilai) {
            $totalNilai += $nilai;
        }


        $ikm = $totalKategori > 0 ? ($totalNilai / $totalKategori) * 25 : 0;


        $surveiModel->update($this->request->getPost('id_survei'), [
            'rata_rata_tertimbang' => json_encode($rataRataTertimbang),
            'ikm' => $ikm
        ]);


        // Redirect setelah sukses
        return redirect()->to(base_url('responden/layanan'))->with('success', 'Survei berhasil disimpan.');
    }
}
