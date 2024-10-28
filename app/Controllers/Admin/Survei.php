<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PertanyaanModel;
use App\Models\SurveiModel;
use App\Models\UnitPlaceholderPertanyaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Survei extends BaseController
{
    public function index()
    {

        $surveiModel = new SurveiModel();

        $data = [
            'title' => 'Survei',
            'survei' => $surveiModel->findAll(),
        ];

        return view('admin/survei/survei', $data);
    }

    public function create(){

        $unitPlaceholderPertanyaanModel = new UnitPlaceholderPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();

        $data = [
            'title' => 'Tambah survei',
            'unit_placeholder' => $unitPlaceholderPertanyaanModel->findAll(),
            'pertanyaan' => $pertanyaanModel->findAll(),
            'validation' => \Config\Services::validation()

        ];
        
        return view('admin/survei/create', $data);
    }

    public function store(){
        
        $survei = new SurveiModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'dekripsi' => $this->request->getVar('deskripsi'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'status' => $this->request->getVar('status'),
            'id_unit_placeholder' => $this->request->getVar('unit'),
            'id_pertanyaan' => $this->request->getVar('pertanyaan'),
        ];
        $survei->insert($data);
        session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('/admin/survei'));

    }

    public function edit($id){

        $survei = new SurveiModel();
        $unitPlaceholderPertanyaanModel = new UnitPlaceholderPertanyaanModel();
        $pertanyaanModel = new PertanyaanModel();
        $survei = $survei->select('survei.id as id_survei, unit_placeholder_pertanyaan.nama_unit as nama_unit, unit_placeholder_pertanyaan.jenis_unit as jenis_unit, survei.judul as judul_survei, survei.dekripsi as deskripsi_survei, tgl_mulai, tgl_selesai, status, id_unit_placeholder, id_pertanyaan, pertanyaan.pertanyaan as pertanyaan')
                        ->where('survei.id', $id)
                        ->join('unit_placeholder_pertanyaan', 'unit_placeholder_pertanyaan.id = survei.id_unit_placeholder')
                        ->join('pertanyaan', 'pertanyaan.id = survei.id_pertanyaan')
                        ->first();

        $data = [
            'title' => "Edit Survei",
            'survei' => $survei,
            'id' => $id,
            'unit_placeholder' => $unitPlaceholderPertanyaanModel->findAll(),
            'pertanyaan' => $pertanyaanModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/survei/edit', $data);
    }

    public function update($id){
        $survei = new SurveiModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'dekripsi' => $this->request->getVar('deskripsi'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_selesai' => $this->request->getVar('tgl_selesai'),
            'status' => $this->request->getVar('status'),
            'id_unit_placeholder' => $this->request->getVar('unit'),
            'id_pertanyaan' => $this->request->getVar('pertanyaan'),
        ];
        $survei->set($data)->where('id', $id)->update();
        session()->setFlashdata('berhasil', 'Data berhasil diupdate');
        return redirect()->to(base_url('/admin/survei'));

    }

    public function delete($id){
        $survei = new SurveiModel();
        $survei->where('id', $id)->delete();
        session()->setFlashdata('berhasil', 'Data berhasil dihapus');
        return redirect()->to(base_url('/admin/survei'));
    }

}
