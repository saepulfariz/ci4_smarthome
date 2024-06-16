<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LampController extends BaseController
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

    public function updateLamp($id)
    {
        $lamp = $this->modellamp->find($id);

        if ($lamp['status'] == 1) {
            $data = [
                'status' => 0
            ];

            $this->modellamp->update($id, $data);

            $data_history = [
                'lamp_id' => $id,
                'status' => 'OFF'
            ];
            $this->modelhistory->save($data_history);

            $lamp = $this->modellamp->find($id);

            $result = [
                'success' => true,
                'message' => $lamp['name'] . ' Berhasil Dimatikan!',
                'data'    => $lamp
            ];
            return json_encode($result);
        } else if ($lamp['status'] == 0) {
            $data = [
                'status' => 1
            ];

            $this->modellamp->update($id, $data);

            $data_history = [
                'lamp_id' => $id,
                'status' => 'ON'
            ];
            $this->modelhistory->save($data_history);

            $lamp = $this->modellamp->find($id);

            $result = [
                'success' => true,
                'message' => $lamp['name'] . ' Berhasil Dihidupkan!',
                'data'    => $lamp
            ];
            return json_encode($result);
        }
    }
}
