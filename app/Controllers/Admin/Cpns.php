<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsulcpnsModel;

class Cpns extends BaseController
{
    public function index()
    {
        $model = new UsulcpnsModel;
        $data['satker'] = $model->getrekapsatker();
        return view('admin/cpns/index', $data);
    }
}
