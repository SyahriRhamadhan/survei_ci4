<?php

namespace App\Controllers\Responden;

use App\Controllers\BaseController;
use App\Models\RespondenModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Create instance of the model
        $respondenModel = new RespondenModel();

        // Query to fetch gender data
        $jenisKelaminData = $respondenModel->select('jenis_kelamin, COUNT(*) as total')
                                           ->groupBy('jenis_kelamin')
                                           ->get()
                                           ->getResultArray();

        // Query to fetch service category data
        $kategoriRespondenData = $respondenModel->select('kategori_responden, COUNT(*) as total')
                                                     ->groupBy('kategori_responden')
                                                     ->get()
                                                     ->getResultArray();

        // Prepare data for the view
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
            'jenisKelaminData' => $jenisKelaminData,               // Gender data for chart
            'kategoriRespondenData' => $kategoriRespondenData  // Service category data for chart
        ];

        return view('responden/dashboard', $data);
    }
}
