<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StatusFilterModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $filter = new StatusFilterModel();

        $dataId1 = $filter->find(1);

        $data = [
            'title' => 'Dashboard',
            'filter' => $dataId1,
        ];
        return view('admin/dashboard', $data);
    }

    public function updateStatus()
    {
        $status = $this->request->getPost('status');
        $id = 1;

        $filter = new StatusFilterModel();

        if (in_array($status, ['on', 'off'])) {
            $filter->update($id, ['value' => $status]);

            return redirect()->to('/admin/dashboard')->with('status', 'Status updated successfully');
        }

        return redirect()->to('/admin/dashboard')->with('status', 'Invalid status value');
    }
}
