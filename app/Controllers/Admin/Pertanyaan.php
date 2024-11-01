<?php

namespace App\Controllers\Admin;

use App\Models\PertanyaanModel;
use App\Controllers\BaseController;
use App\Database\Seeds\PertanyaanSeeder;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipePertanyaanModel;

class Pertanyaan extends BaseController
{
    public function index()
    {
        $pertanyaanModel = new PertanyaanModel();
        $data = [
            'title' => 'Data Pertanyaan',
            'pertanyaan' => $pertanyaanModel->findAll(),
            'tipe_pertanyaan' => $pertanyaanModel->findAll()
        ];
        return view('admin/pertanyaan/pertanyaan', $data);
    }
    public function create()
    {
        $tipePertanyaanModel = new TipePertanyaanModel();
        $data = [
            'title' => 'Tambah Pertanyaan',
            'tipe_pertanyaan' => $tipePertanyaanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/pertanyaan/create', $data);
    }

    public function store()
    {
        $rules = [
            'pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pertanyaan tidak boleh kosong'
                ]
            ],
            'tipe_pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe pertanyaan tidak boleh kosong'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $tipePertanyaanModel = new TipePertanyaanModel();
            $data = [
                'title' => 'Tambah Pertanyaan',
                'tipe_pertanyaan' => $tipePertanyaanModel->findAll(),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/pertanyaan/create', $data);
        } else {
            $pertanyaanModel = new PertanyaanModel();
            $pertanyaanModel->insert([
                'pertanyaan' => $this->request->getPost('pertanyaan'),
                'tipe_pertanyaan' => $this->request->getPost('tipe_pertanyaan')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil  ditambahkan');
            return redirect()->to(base_url('/admin/pertanyaan'));
        }
    }
    public function edit($id)
    {
        $pertanyaanModel = new PertanyaanModel();
        $data = [
            'title' => 'Edit Pertanyaan',
            'pertanyaan' => $pertanyaanModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/pertanyaan/edit', $data);
    }
    public function update($id)
    {
        $pertanyaanModel = new PertanyaanModel();
        $rules = [
            'pertanyaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pertanyaan tidak boleh kosong'
                ]
            ],
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
                'pertanyaan' => $pertanyaanModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/pertanyaan/edit', $data);
        } else {
            $pertanyaanModel = new PertanyaanModel();
            $pertanyaanModel->update($id, [
                'pertanyaan' => $this->request->getPost('pertanyaan'),
                'tipe_pertanyaan' => $this->request->getPost('tipe_pertanyaan')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/pertanyaan'));
        }
    }
    function delete($id)
    {
        $pertanyaanModel = new PertanyaanModel();
        $jabatan = $pertanyaanModel->find($id);
        if ($jabatan) {
            $pertanyaanModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/pertanyaan'));
        }
    }
}
