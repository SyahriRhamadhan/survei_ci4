<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UnitKerjaModel;

class Unit extends BaseController
{
    public function index()
    {
        $UnitKerjaModel = new UnitKerjaModel();
        $data = [
            'title' => 'Data Unit Kerja',
            'unit' => $UnitKerjaModel->findAll()
        ];
        return view('admin/unit/unit', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Unit Kerja',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/unit/create', $data);
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
                'title' => 'Tambah Unit Kerja',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/unit/create', $data);
        } else {
            $UnitKerjaModel = new UnitKerjaModel();
            $UnitKerjaModel->insert([
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/admin/unit'));
        }
    }
    public function edit($id)
    {
        $UnitKerjaModel = new UnitKerjaModel();
        $data = [
            'title' => 'Edit Unit Kerja',
            'unit' => $UnitKerjaModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/unit/edit', $data);
    }
    public function update($id)
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
            $UnitKerjaModel = new UnitKerjaModel();
            $data = [
                'title' => 'Edit Unit Kerja',
                'unit' => $UnitKerjaModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/unit/edit', $data);
        } else {
            $UnitKerjaModel = new UnitKerjaModel();
            $UnitKerjaModel->update($id, [
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/unit'));
        }
    }
    public function delete($id)
    {
        $UnitKerjaModel = new UnitKerjaModel();
        $fakultas = $UnitKerjaModel->find($id);
        if ($fakultas) {
            $UnitKerjaModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/unit'));
        }
    }
}
