<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Histories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'lamp_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'status' => [
                'type'           => 'ENUM',
                'constraint'     => ['ON', 'OFF'],
                'default'        => 'OFF',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('lamp_id', 'lamps', 'id', 'NULL', "CASCADE");
        $this->forge->createTable('histories');
    }

    public function down()
    {
        $this->forge->dropTable('histories');
    }
}
