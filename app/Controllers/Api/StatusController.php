<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StatusController extends BaseController
{
    private $modellamp;
    function __construct()
    {
        $this->modellamp = new \App\Models\Lamp();
    }

    public function index()
    {
        //get all lamp
        $lamps = $this->modellamp->findAll();

        //make variable array
        $lamp_status = [];

        //loop lamp and assign to variable
        foreach ($lamps as $lamp) {
            $lamp_status[$lamp['id']] = $lamp['status'];
        }

        //return response
        return json_encode($lamp_status);
    }
}
