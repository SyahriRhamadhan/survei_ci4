<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UnitPlaceholderPertanyaanModel;

class Placeholder extends BaseController
{
    public function index()
    {
        $plaheholderModel = new UnitPlaceholderPertanyaanModel();
        $data = [
            'title' => 'Data Placeholder',
            'placeholder' => $plaheholderModel->findAll(),
        ];
        return view('admin/placeholder/placeholder', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Unit/Layanan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/placeholder/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama unit tidak boleh kosong'
                ]
            ],
            'jenis_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis unit tidak boleh kosong'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Unit/Layanan',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/placeholder/create', $data);
        } else {
            $plaheholderModel = new UnitPlaceholderPertanyaanModel();
            $plaheholderModel->insert([
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil  ditambahkan');
            return redirect()->to(base_url('/admin/placeholder'));
        }
    }
    public function edit($id)
    {
        $plaheholderModel = new UnitPlaceholderPertanyaanModel();
        $data = [
            'title' => 'Edit Placeholder',
            'placeholder' => $plaheholderModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/placeholder/edit', $data);
    }
    public function update($id)
    {
        $plaheholderModel = new UnitPlaceholderPertanyaanModel();
        $rules = [
            'nama_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama unit tidak boleh kosong'
                ]
            ],
            'jenis_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis unit pertanyaan tidak boleh kosong'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Pertanyaan',
                'placeholder' => $plaheholderModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/placeholder/edit', $data);
        } else {
            $plaheholderModel = new UnitPlaceholderPertanyaanModel();
            $plaheholderModel->update($id, [
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/placeholder'));
        }
    }
    function delete($id)
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $placeholder = $placeholderModel->find($id);
        if ($placeholder) {
            $placeholderModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/placeholder'));
        }
    }
}
