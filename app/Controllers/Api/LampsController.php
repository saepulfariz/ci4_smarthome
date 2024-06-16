<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LampsController extends BaseController
{
    private $modellamp;
    private $modelhistory;
    function __construct()
    {
        $this->modellamp = new \App\Models\Lamp();
        $this->modelhistory = new \App\Models\History();
    }

    public function index()
    {
        $lamps = $this->modellamp->orderBy('id', 'DESC')->findAll();

        return json_encode([
            'success' => true,
            'message' => 'List Data Lamps',
            'data'    => $lamps
        ]);
    }
}
