<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jenisperjadin extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'jenisperjadin_id' => [
                'type'           => 'INT',
                'constraint'     => 4,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'jenisperjadin_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100'
            ],
        ]);
        $this->forge->addKey('jenisperjadin_id', true);

        $this->forge->createTable('jenisperjadins');
    }

    public function down()
    {
        $this->forge->dropTable('jenisperjadins');
    }
}
