<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LampController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model = new \App\Models\Lamp();
    }

    public function index()
    {
        $lamps = $this->model->orderBy('id', 'DESC')->findAll();

        return view('lamps/index', compact('lamps'));
    }
}
