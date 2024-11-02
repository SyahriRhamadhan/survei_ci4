<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Prodi extends BaseController
{
    public function index()
    {
        $ProdiModel = new ProdiModel();
        $data = [
            'title' => 'Data Prodi',
            'prodi' => $ProdiModel->findAll()
        ];
        return view('admin/prodi/prodi', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Prodi',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/prodi/create', $data);
    }

    public function store()
    {
        $rules = [
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Prodi tidak boleh kosong'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Tambah Prodi',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/prodi/create', $data);
        } else {
            $ProdiModel = new ProdiModel();
            $ProdiModel->insert([
                'nama' => $this->request->getPost('prodi')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil  ditambahkan');
            return redirect()->to(base_url('/admin/prodi'));
        }
    }
    public function edit($id)
    {
        $ProdiModel = new ProdiModel();
        $data = [
            'title' => 'Edit Prodi',
            'prodi' => $ProdiModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/prodi/edit', $data);
    }
    public function update($id)
    {
        $ProdiModel = new ProdiModel();
        $rules = [
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Prodi tidak boleh kosong'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'title' => 'Edit Pertanyaan',
                'prodi' => $ProdiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/prodi/edit', $data);
        } else {
            $ProdiModel = new ProdiModel();
            $ProdiModel->update($id, [
                'nama' => $this->request->getPost('prodi')
            ]);
            session()->setFlashdata('berhasil', 'Data berhasil diupdate');
            return redirect()->to(base_url('/admin/prodi'));
        }
    }
    function delete($id){
        $ProdiModel = new ProdiModel();
        $jabatan = $ProdiModel->find($id);
        if($jabatan){
            $ProdiModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/prodi'));
        }
    }
}