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

        $session = session();
        $userId = $session->get('id');
        $userName = $session->get('name');
        $userRole = $session->get('role_id');

        $data = [
            'title' => 'Dashboard',
            'filter' => $dataId1,
            'user_id' => $userId,
            'user_name' => $userName,
            'user_role' => $userRole
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
