<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $UserModel = new UserModel();
        $data = [
            'title' => 'Data Akun Admin',
            'user' => $UserModel->findAll()
        ];
        return view('admin/user/user', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email harus valid',
                    'is_unique' => 'Email sudah digunakan'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 8 karakter',
                    'regex_match' => 'Password harus mengandung minimal 1 huruf besar dan 1 angka'
                ]
            ],
            'password_confirmation' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Konfirmasi password harus sama dengan password'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $UserModel = new UserModel();

        // Hash password before saving
        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

        $UserModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'password' => $hashedPassword
        ]);

        session()->setFlashdata('berhasil', 'Data berhasil ditambahkan');
        return redirect()->to('/admin/user');
    }

    public function edit($id)
    {
        // Mendapatkan session user id
        $session = session();
        $sessionId = $session->get('id');

        // Cek apakah user yang login id-nya sama dengan id yang ingin diedit
        if ($sessionId != $id && $sessionId != 1) {
            // Jika tidak, tampilkan pesan atau redirect
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk mengedit user ini.');
            return redirect()->to('/admin/user'); // Redirect sesuai kebutuhan
        }

        $UserModel = new UserModel();
        $user = $UserModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User not found");
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/user/edit', $data);
    }

    public function update($id)
    {
        // Mendapatkan session user id
        $session = session();
        $sessionId = $session->get('id');

        // Cek apakah user yang login id-nya sama dengan id yang ingin diupdate atau admin
        if ($sessionId != $id && $sessionId != 1) {
            // Jika tidak, tampilkan pesan atau redirect
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk mengupdate user ini.');
            return redirect()->to('/admin/user'); // Redirect sesuai kebutuhan
        }

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role tidak boleh kosong'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email harus valid',
                    'is_unique' => 'Email sudah digunakan oleh user lain'
                ]
            ],
            'password' => [
                'rules' => 'permit_empty|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*\d).+$/]',
                'errors' => [
                    'min_length' => 'Password minimal 8 karakter',
                    'regex_match' => 'Password harus mengandung minimal 1 huruf besar dan 1 angka'
                ]
            ],
            'password_confirmation' => [
                'rules' => 'permit_empty|matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password harus sama dengan password'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $UserModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        // Only hash the password if it was provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $UserModel->update($id, $data);

        session()->setFlashdata('berhasil', 'Data berhasil diupdate');
        return redirect()->to('/admin/user');
    }



    public function delete($id)
    {
        // Mendapatkan session user id
        $session = session();
        $sessionId = $session->get('id');

        // Cek apakah user yang login id-nya sama dengan id yang ingin dihapus atau admin
        if ($sessionId != $id && $sessionId != 1) {
            // Jika tidak, tampilkan pesan atau redirect
            session()->setFlashdata('error', 'Anda tidak memiliki akses untuk menghapus user ini.');
            return redirect()->to('/admin/user'); // Redirect sesuai kebutuhan
        }

        $UserModel = new UserModel();
        $user = $UserModel->find($id);
        if ($user) {
            $UserModel->delete($id);
            session()->setFlashdata('berhasil', 'Data berhasil dihapus');
            return redirect()->to(base_url('/admin/user'));
        }
    }
}
