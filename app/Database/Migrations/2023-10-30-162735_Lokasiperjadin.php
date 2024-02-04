<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lokasiperjadin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lokasiperjadin_id' => [
                'type'           => 'INT',
                'constraint'     => 4,
                'unsigned'       => true,
                'auto_increment' => true,

            ],
            'jenisperjadin_id' => [
                'type'          => 'INT',
                'constraint'    => 4,
            ],
            'lokasiperjadin_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => 60,
            ],
        ]);
        $this->forge->addKey('lokasiperjadin_id', true);
        $this->forge->addForeignKey('jenisperjadin_id','jenisperjadins','jenisperjadin_id','','','fkjenisperjadinlokasi');

        $this->forge->createTable('lokasiperjadins');
    }

    public function down()
    {
        $this->forge->dropTable('lokasiperjadins');
    }
}
