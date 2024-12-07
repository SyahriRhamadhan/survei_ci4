<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PertanyaanModel;
use App\Models\SurveiModel;
use App\Models\UnitPlaceholderPertanyaanModel;
use App\Models\SurveiPertanyaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Survei extends BaseController
{
    public function index()
    {
        $surveiModel = new SurveiModel();
        $data = [
            'title' => 'Daftar Survei',
            'survei' => $surveiModel
                ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
                ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
                ->findAll()
        ];

        return view('admin/survei/survei', $data);
    }

    public function detail($id)
    {
        $surveiModel = new SurveiModel();
        $surveiPertanyaanModel = new SurveiPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();

        $survei = $surveiModel
            ->select('survei.*, unit_placeholder_pertanyaan.nama_unit, unit_placeholder_pertanyaan.jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima')
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->find($id);

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
        ];

        return view('admin/survei/detail', $data);
    }

    public function create()
    {
        $unitPlaceholderPertanyaanModel = new UnitPlaceholderPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();

        // Mengelompokkan pertanyaan berdasarkan kategori
        $pertanyaanGrouped = [];
        foreach ($pertanyaanModel->findAll() as $pertanyaan) {
            $pertanyaanGrouped[$pertanyaan['tipe_pertanyaan']][] = $pertanyaan;
        }

        $data = [
            'title' => 'Tambah survei',
            'unit_placeholder' => $unitPlaceholderPertanyaanModel
                ->orderBy('jenis_unit', 'ASC')
                ->orderBy('nama_unit', 'ASC')
                ->orderBy('jenis_layanan_yang_diterima', 'ASC')
                ->findAll(),
            'pertanyaanGrouped' => $pertanyaanGrouped,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/survei/create', $data);
    }


    public function store()
    {
        $surveiModel = new SurveiModel();
        $surveiPertanyaanModel = new SurveiPertanyaanModel();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'dekripsi' => $this->request->getVar('deskripsi'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'status' => $this->request->getVar('status'),
            'id_unit_placeholder' => $this->request->getVar('unit'),
        ];

        $surveiModel->insert($data);
        $surveiId = $surveiModel->insertID(); // Mendapatkan ID survei yang baru

        $pertanyaanIds = $this->request->getVar('pertanyaan');
        foreach ($pertanyaanIds as $pertanyaanId) {
            $surveiPertanyaanModel->insert([
                'id_survei' => $surveiId,
                'id_pertanyaan' => $pertanyaanId
            ]);
        }

        session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('/admin/survei'));
    }



    public function edit($id)
    {
        $surveiModel = new SurveiModel();
        $unitPlaceholderPertanyaanModel = new UnitPlaceholderPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();
        $surveiPertanyaanModel = new SurveiPertanyaanModel();

        $survei = $surveiModel->select('survei.id as id_survei, unit_placeholder_pertanyaan.nama_unit as nama_unit, unit_placeholder_pertanyaan.jenis_unit as jenis_unit, unit_placeholder_pertanyaan.jenis_layanan_yang_diterima, survei.judul as judul_survei, survei.dekripsi as deskripsi_survei, tgl_mulai, tgl_selesai, status, id_unit_placeholder')
            ->where('survei.id', $id)
            ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
            ->first();


        // Ambil daftar ID pertanyaan terkait dengan survei
        $pertanyaanTerkait = $surveiPertanyaanModel->where('id_survei', $id)->findColumn('id_pertanyaan');

        // Jika $pertanyaanTerkait kosong, beri nilai array kosong untuk menghindari error
        $selectedPertanyaan = $pertanyaanTerkait ?? [];

        // Mengelompokkan pertanyaan berdasarkan kategori
        $pertanyaanGrouped = [];
        foreach ($pertanyaanModel->findAll() as $pertanyaan) {
            $pertanyaanGrouped[$pertanyaan['tipe_pertanyaan']][] = $pertanyaan;
        }

        $data = [
            'title' => "Edit Survei",
            'survei' => $survei,
            'id' => $id,
            'unit_placeholder' => $unitPlaceholderPertanyaanModel->findAll(),
            'pertanyaanGrouped' => $pertanyaanGrouped, // Tambahkan variabel ini
            'selectedPertanyaan' => $selectedPertanyaan, // Tambahkan variabel ini
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/survei/edit', $data);
    }



    public function update($id)
    {
        $surveiModel = new SurveiModel();
        $surveiPertanyaanModel = new SurveiPertanyaanModel();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'dekripsi' => $this->request->getVar('deskripsi'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'status' => $this->request->getVar('status'),
            'id_unit_placeholder' => $this->request->getVar('unit'),
        ];
        $surveiModel->set($data)->where('id', $id)->update();

        // Perbarui hubungan survei dengan pertanyaan di tabel `survei_pertanyaan`
        $pertanyaanIds = $this->request->getVar('pertanyaan'); // Ambil daftar pertanyaan yang dipilih

        // Hapus semua hubungan lama untuk survei ini
        $surveiPertanyaanModel->where('id_survei', $id)->delete();

        if (!empty($pertanyaanIds)) {
            foreach ($pertanyaanIds as $pertanyaanId) {
                $surveiPertanyaanModel->insert([
                    'id_survei' => $id,
                    'id_pertanyaan' => $pertanyaanId,
                ]);
            }
        }

        session()->setFlashdata('berhasil', 'Data berhasil diupdate');
        return redirect()->to(base_url('/admin/survei'));
    }


    public function delete($id)
    {
        $survei = new SurveiModel();
        $survei->where('id', $id)->delete();
        session()->setFlashdata('berhasil', 'Data berhasil dihapus');
        return redirect()->to(base_url('/admin/survei'));
    }
}
