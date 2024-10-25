<?php

namespace App\Controllers\Unit;

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
        return view('unit/dashboard', $data);
    }
}
