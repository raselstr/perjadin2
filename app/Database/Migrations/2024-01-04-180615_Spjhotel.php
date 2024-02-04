<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spjhotel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'spjhotel_id'         => [
                'type'              => 'BIGINT',
                'constraint'         => 20,
                'unsigned'          => true,
                'auto_increment'     => true, 
            ],   
            'spjhotel_pelaksanaid' => [
                'type'              => 'INT',
                'unsigned'          => true,
            ],
            'spjhotel_nama'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 20,
            ],
            'spjhotel_lokasi'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 20,
            ],
            'spjhotel_nokamar'        => [
                'type'              => 'VARCHAR',
                'constraint'         => 25,
            ],
            'spjhotel_typekamar'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 25,
            ],
            'spjhotel_checkin'   => [
                'type'              => 'date',
            ],
            'spjhotel_checkout'   => [
                'type'              => 'date',
            ],
            'spjhotel_mlm'      => [
                'type'              => 'INT',
            ],
            'spjhotel_hargapermalam'      => [
                'type'              => 'DOUBLE',
            ],
            'spjhotel_hargatotal'      => [
                'type'              => 'DOUBLE',
            ],
            'spjhotel_verif'      => [
                'type'              => 'INT',
                'default'           => 0,
            ],
            'spjhotel_bill'    => [
                'type'              => 'VARCHAR',
                'constraint'         => 50,
            ],
            'spjhotel_created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'spjhotel_updated_at' =>[
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'spjhotel_deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('spjhotel_id', true);
        $this->forge->addForeignKey('spjhotel_pelaksanaid','pelaksanas','pelaksana_id','CASCADE','CASCADE','FKspjhotelpelaksanaid');

        $this->forge->createTable('spjhotels');
    }

    public function down()
    {
        $this->forge->dropForeignKey('spjhotels','FKspjhotelpelaksanaid');

        $this->forge->dropTable('spjhotels');
    }
}
