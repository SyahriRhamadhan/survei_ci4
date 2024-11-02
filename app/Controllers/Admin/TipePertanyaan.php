<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipePertanyaanModel;
class TipePertanyaan extends BaseController
{
    public function index()
    {
        $TipePertanyaanModel = new TipePertanyaanModel();
        $data = [
            'title' => 'Data Tipe/Kategori Pertanyaan',
            'tipe_pertanyaan' => $TipePertanyaanModel->findAll()
        ];
        return view('admin/tipe_pertanyaan/tipe_pertanyaan', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Tipe/Kategori Pertanyaan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/tipe_pertanyaan/create', $data);
    }

    public function store()
    {
        $rules = [
            'tipe_pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe pertanyaan tidak boleh kosong'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Tipe/Kategori Pertanyaan',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/tipe_pertanyaan/create', $data);
        } else {
            $TipePertanyaanModel = new TipePertanyaanModel();
            $TipePertanyaanModel->insert([
                'tipe_pertanyaan' => $this->request->getPost('tipe_pertanyaan')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil  ditambahkan');
            return redirect()->to(base_url('/admin/tipe_pertanyaan'));
        }
    }
    public function edit($id)
    {
        $TipePertanyaanModel = new TipePertanyaanModel();
        $data = [
            'title' => 'Edit Tipe/Kategori Peratanyaan',
            'tipe_pertanyaan' => $TipePertanyaanModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/tipe_pertanyaan/edit', $data);
    }
    public function update($id)
    {
        $TipePertanyaanModel = new TipePertanyaanModel();
        $rules = [
            'tipe_pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe pertanyaan tidak boleh kosong'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Pertanyaan',
                'tipe_pertanyaan' => $TipePertanyaanModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/tipe_pertanyaan/edit', $data);
        } else {
            $TipePertanyaanModel = new TipePertanyaanModel();
            $TipePertanyaanModel->update($id, [
                'tipe_pertanyaan' => $this->request->getPost('tipe_pertanyaan')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/tipe_pertanyaan'));
        }
    }
    function delete($id){
        $TipePertanyaanModel = new TipePertanyaanModel();
        $jabatan = $TipePertanyaanModel->find($id);
        if($jabatan){
            $TipePertanyaanModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/tipe_pertanyaan'));
        }
    }
}