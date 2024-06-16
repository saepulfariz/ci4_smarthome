<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HistoryController extends BaseController
{
    public function index()
    {
        $periode = $this->request->getVar('periode') ? $this->request->getVar('periode') : 1;
        $start = date('Y-m-d', strtotime('-' . $periode . ' Days'));
        $end = date('Y-m-d');

        $lampsData = db_connect()->table('lamps as a')->join('histories as b', 'a.id = b.lamp_id')->select('COUNT(b.lamp_id) as total, a.name, b.status, DATE(b.created_at) as tanggal')->groupBy('DATE(b.created_at), a.name, b.lamp_id, b.status')->where('DATE(b.created_at) >=', $start)->where('DATE(b.created_at) <=', $end)->orderBy('DATE(b.created_at)', 'asc')->get()->getResultArray();

        //init variable array
        $chartData = [
            'labels' => [],
            'total' => []
        ];

        //loop data
        foreach ($lampsData as $data) {
            $chartData['labels'][] = $data['name'] . ' ' . $data['status'] . ' (' . $data['tanggal'] . ')';
            $chartData['total'][] = $data['total'];
        }

        return view('histories/index', compact('chartData', 'periode'));
    }
}
