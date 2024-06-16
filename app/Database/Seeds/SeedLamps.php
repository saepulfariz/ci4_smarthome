<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedLamps extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Lampu Teras',
            ],
            [
                'name' => 'Lampu Tengah',
            ],
            [
                'name' => 'Lampu Kamar',
            ],
        ];

        $this->db->table('lamps')->insertBatch($data);
    }
}
