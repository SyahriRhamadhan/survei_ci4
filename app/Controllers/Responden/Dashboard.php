<?php

namespace App\Controllers\Responden;

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
        return view('responden/dashboard', $data);
    }
}
