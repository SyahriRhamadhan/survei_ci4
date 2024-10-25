<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            $role = session()->get('role_id');
            return redirect()->to("$role/dashboard");
        }
        
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('login', $data);
    }
    public function login_action()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
    
        if (!$this->validate($rules)) {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
    
            if ($email == "" || $email == null || $password == "" || $password == null) {
                session()->setFlashdata('pesan', 'Email atau Password masih kosong');
                session()->setFlashdata('alert_type', 'danger');
                return redirect()->to('/auth/login')->withInput();
            }
    
            $data['validation'] = $this->validator;
            return view('login', $data);
    
        } else {
            $session = session();
            $userModel = new UserModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
    
            $cekEmail = $userModel->where('email', $email)->first();
    
            if ($cekEmail) {
                $password_db = $cekEmail['password'];
                $cekPassword = password_verify($password, $password_db);
    
                if ($cekPassword) {
                    switch ($cekEmail['role']) {
                        case 'admin':
                            $session_data = [
                                'logged_in' => TRUE,
                                'id' => $cekEmail['id'],
                                'role_id' => $cekEmail['role'],
                                'name' => $cekEmail['name'],
                            ];
                            $session->set($session_data);
                            return redirect()->to('admin/dashboard');
                        case 'unit':
                            $session_data = [
                                'logged_in' => TRUE,
                                'id' => $cekEmail['id'],
                                'role_id' => $cekEmail['role'],
                                'name' => $cekEmail['name'],
                            ];
                            $session->set($session_data);
                            return redirect()->to('unit/dashboard');
                        case 'pimpinan':
                            $session_data = [
                                'logged_in' => TRUE,
                                'id' => $cekEmail['id'],
                                'role_id' => $cekEmail['role'],
                                'name' => $cekEmail['name'],
                            ];
                            $session->set($session_data);
                            return redirect()->to('pimpinan/dashboard');
                        default:
                            session()->setFlashdata('pesan', 'Anda belum terdaftar !!!');
                            session()->setFlashdata('alert_type', 'danger');
                            return redirect()->to('/auth/login');
                    }
                } else {
                    session()->setFlashdata('pesan', 'Email atau password Anda salah');
                    session()->setFlashdata('alert_type', 'danger');
                    return redirect()->to('/auth/login')->withInput();
                }
            } else {
                session()->setFlashdata('pesan', 'Email atau password Anda salah');
                session()->setFlashdata('alert_type', 'danger');
                return redirect()->to('/auth/login')->withInput();
            }
        }
    }
    

    public function logout()
    {
        $session = session();
        // menghapus semua session yang telah di simpan 
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}
