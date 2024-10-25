<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
       

        ];
        return view('admin/dashboard', $data);
    }
}
