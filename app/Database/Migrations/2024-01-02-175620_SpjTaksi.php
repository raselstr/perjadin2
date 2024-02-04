<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SpjTaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'spjtaksi_id'         => [
                'type'              => 'BIGINT',
                'constraint'         => 20,
                'unsigned'          => true,
                'auto_increment'     => true, 
            ],   
            'spjtaksi_pelaksanaid' => [
                'type'              => 'INT',
                'unsigned'          => true,
            ],
            'spjtaksi_jenis'      => [
                'type'              => 'VARCHAR',
                'constraint'         => 15,
            ],
            'spjtaksi_tgl'        => [
                'type'              => 'date',
            ],
            'spjtaksi_dari'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 25,
            ],
            'spjtaksi_ke'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 25,
            ],
            'spjtaksi_harga'      => [
                'type'              => 'DOUBLE',
            ],
            'spjtaksi_verif'      => [
                'type'              => 'INT',
            ],
            'spjtaksi_fototiket'   => [
                'type'              => 'VARCHAR',
                'constraint'         => 50,
            ],
            'spjtaksi_created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'spjtaksi_updated_at' =>[
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'spjtaksi_deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
        ]);
        $this->forge->addKey('spjtaksi_id', true);
        $this->forge->addForeignKey('spjtaksi_pelaksanaid','pelaksanas','pelaksana_id','CASCADE','CASCADE','FKspjtaksipelaksanaid');

        $this->forge->createTable('spjtaksis');
    }

    public function down()
    {
        $this->forge->dropForeignKey('spjtaksis','FKspjtaksipelaksanaid');

        $this->forge->dropTable('spjtaksis');
    }
}
