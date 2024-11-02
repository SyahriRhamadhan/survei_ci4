<?php

namespace App\Controllers\Pimpinan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
          
       

        ];
        return view('pimpinan/dashboard', $data);
    }
}
