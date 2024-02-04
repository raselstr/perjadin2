<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelaksana extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pelaksana_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'spt_id' => [
                'type'          => 'INT',
                'constraint'    => 20
            ],
            'pegawai_id' => [
                'type'          => 'INT',
                'constraint'    => 20
            ],
            'pelaksana_utama' => [
                'type'          => 'INT',
                'constraint'    => 1,
                'default'       => 0,
            ],
        ]);
        $this->forge->addKey('pelaksana_id', true);
        $this->forge->addForeignKey('spt_id','spts','spt_id','RESCRICT', '', 'my_fk_pelaksanaspt');
        $this->forge->addForeignKey('pegawai_id','pegawais','pegawai_id','','','my_fk_pelaksanapegawai');
        $this->forge->addUniqueKey(['spt_id','pegawai_id'],'uniqkey');

        $this->forge->createTable('pelaksanas');
    }

    public function down()
    {
        
        $this->forge->dropForeignKey('pelaksanas','my_fk_pelaksanaspt');
        $this->forge->dropForeignKey('pelaksanas','my_fk_pelaksanapegawai');

        $this->forge->dropTable('pelaksanas');
    }
}
