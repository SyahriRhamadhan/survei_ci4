<?php

namespace App\Controllers\Responden;

use App\Controllers\BaseController;
use App\Models\FakultasModel;
use App\Models\ProdiModel;
use App\Models\RespondenModel;
use App\Models\SurveiModel;

class Layanan extends BaseController
{
    public function index()
    {
        $prodiModel = new ProdiModel();
        $fakultasModel = new FakultasModel();
        $unitModel = new SurveiModel();

        $data = [
            'title' => 'Layanan',
            'currentPage' => 'layanan',
            'prodiList' => $prodiModel->findAll(),
            'fakultasList' => $fakultasModel->findAll(),
            'unitList' => $unitModel->getSurveiWithUnit(), 
        ];

        return view('responden/layanan/layanan', $data);
    }

    public function store()
    {
        $model = new RespondenModel();

        $data = [
            'kategori_responden' => $this->request->getPost('kategori_responden'),
            'asal_prodi' => $this->request->getPost('asal_prodi'),
            'angkatan' => $this->request->getPost('angkatan'),
            'asal_fakultas' => $this->request->getPost('asal_fakultas'),
            'asal_unit_kerja' => $this->request->getPost('asal_unit_kerja'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'umur' => $this->request->getPost('umur'),
            'unit_layanan' => $this->request->getPost('unit_layanan'),
            'jenis_layanan_yang_diterima' => $this->request->getPost('jenis_layanan_yang_diterima'),
            'tanggal_survei' => date('Y-m-d'),  // Format tanggal saja
            'jam_survei' => $this->request->getPost('jam_survei'),
        ];

        $model->insert($data);

        return redirect()->to(base_url('responden/layanan'))->with('success', 'Survei berhasil disimpan.');
    }
}
