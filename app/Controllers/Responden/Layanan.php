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

class Layanan extends BaseController
{
    public function index()
    {
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();
        $unitModel = new SurveiModel();
        $surveiModel = new SurveiModel();
        $data = [
            'title' => 'Layanan',
            'currentPage' => 'layanan',
            'prodiList' => $prodiModel->findAll(),
            'fakultasList' => $fakultasModel->findAll(),
            'unitList' => $unitModel->getSurveiWithUnit(),
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

        $survei = $surveiModel
            ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
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
        ];
        return view('responden/layanan/detail', $data);
    }


    public function store()
    {
        $respondenModel = new RespondenModel();
        $jawabanSurveiModel = new JawabanSurveiModel();

        // Menyimpan data responden
        $dataResponden = [
            'kategori_responden' => $this->request->getPost('kategori_responden'),
            'asal_prodi' => $this->request->getPost('asal_prodi'),
            'angkatan' => $this->request->getPost('angkatan'),
            'asal_fakultas' => $this->request->getPost('asal_fakultas'),
            'asal_unit_kerja' => $this->request->getPost('asal_unit_kerja'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'unit_layanan' => $this->request->getPost('unit_layanan'),
            'jenis_layanan_diterima' => $this->request->getPost('jenis_layanan_yang_diterima'),
            'tanggal_survei' => date('Y-m-d'),
            'jam_survei' => $this->request->getPost('jam_survei'),
            'saran_masukan' => $this->request->getPost('saran_masukan'),
            'id_survei' => $this->request->getPost('id_survei'),
        ];

        // Insert data responden dan dapatkan ID-nya
        $respondenId = $respondenModel->insert($dataResponden);

        // Menyimpan jawaban survei
        $jawabanSurvei = $this->request->getPost('penilaian');
        foreach ($jawabanSurvei as $pertanyaanId => $jawaban) {
            $jawabanSurveiModel->insert([
                'id_responden' => $respondenId,
                'id_pertanyaan' => $pertanyaanId,
                'jawaban' => $jawaban
            ]);
        }

        // Redirect setelah sukses
        return redirect()->to(base_url('responden/layanan'))->with('success', 'Survei berhasil disimpan.');
    }
}
