<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tingkatsppd extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'tingkat_id' => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tingkat_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'tingkat_uraian' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            
        ]);
        $this->forge->addKey('tingkat_id', true);
   
        $this->forge->createTable('tingkats');
    }

    public function down()
    {
        $this->forge->dropTable('tingkats');
    }
}
