<?php

namespace App\Controllers\Admin;

use App\Models\FakultasModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Fakultas extends BaseController
{
    public function index()
    {
        $fakultasModel = new FakultasModel();
        $data = [
            'title' => 'Data Fakultas',
            'fakultas' => $fakultasModel->findAll()
        ];
        return view('admin/fakultas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Fakultas',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/fakultas/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama fakultas tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Fakultas',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/fakultas/create', $data);
        } else {
            $fakultasModel = new FakultasModel();
            $fakultasModel->insert([
                'nama' => $this->request->getPost('nama')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/admin/fakultas'));
        }
    }

    public function edit($id)
    {
        $fakultasModel = new FakultasModel();
        $data = [
            'title' => 'Edit Fakultas',
            'fakultas' => $fakultasModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/fakultas/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama fakultas tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $fakultasModel = new FakultasModel();
            $data = [
                'title' => 'Edit Fakultas',
                'fakultas' => $fakultasModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/fakultas/edit', $data);
        } else {
            $fakultasModel = new FakultasModel();
            $fakultasModel->update($id, [
                'nama' => $this->request->getPost('nama')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/fakultas'));
        }
    }

    public function delete($id)
    {
        $fakultasModel = new FakultasModel();
        $fakultas = $fakultasModel->find($id);
        if ($fakultas) {
            $fakultasModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/fakultas'));
        }
    }
}
