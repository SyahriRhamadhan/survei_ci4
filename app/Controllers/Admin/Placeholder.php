<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UnitPlaceholderPertanyaanModel;

class Placeholder extends BaseController
{
    public function index()
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $data = [
            'title' => 'Data Placeholder',
            'placeholder' => $placeholderModel->findAll(),
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
        // Kondisi validasi dinamis untuk `jenis_layanan_yang_diterima`
        $jenisUnit = $this->request->getPost('jenis_unit');
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
            ]
        ];

        // Tambahkan validasi `jenis_layanan_yang_diterima` hanya jika `jenis_unit` bukan "UPPS"
        if ($jenisUnit !== 'UPPS') {
            $rules['jenis_layanan_yang_diterima'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis layanan tidak boleh kosong/isi dengan none'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Unit/Layanan',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/placeholder/create', $data);
        } else {
            $placeholderModel = new UnitPlaceholderPertanyaanModel();
            $placeholderModel->insert([
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit'),
                'jenis_layanan_yang_diterima' => $this->request->getPost('jenis_layanan_yang_diterima')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('/admin/placeholder'));
        }
    }

    public function edit($id)
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $data = [
            'title' => 'Edit Placeholder',
            'placeholder' => $placeholderModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/placeholder/edit', $data);
    }

    public function update($id)
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        
        // Kondisi validasi dinamis untuk `jenis_layanan_yang_diterima`
        $jenisUnit = $this->request->getPost('jenis_unit');
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
            ]
        ];

        // Tambahkan validasi `jenis_layanan_yang_diterima` hanya jika `jenis_unit` bukan "UPPS"
        if ($jenisUnit !== 'UPPS') {
            $rules['jenis_layanan_yang_diterima'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis layanan tidak boleh kosong/isi dengan none'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Pertanyaan',
                'placeholder' => $placeholderModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/placeholder/edit', $data);
        } else {
            $placeholderModel->update($id, [
                'nama_unit' => $this->request->getPost('nama_unit'),
                'jenis_unit' => $this->request->getPost('jenis_unit'),
                'jenis_layanan_yang_diterima' => $this->request->getPost('jenis_layanan_yang_diterima')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/placeholder'));
        }
    }

    public function delete($id)
    {
        $placeholderModel = new UnitPlaceholderPertanyaanModel();
        $placeholder = $placeholderModel->find($id);
        
        if ($placeholder) {
            $placeholderModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan');
        }
        
        return redirect()->to(base_url('/admin/placeholder'));
    }
}
