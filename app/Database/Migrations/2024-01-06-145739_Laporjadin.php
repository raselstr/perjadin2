<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporjadin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'laporjadin_id'         => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
                'auto_increment'    => true, 
            ],   
            'laporjadin_sptid' => [
                'type'          => 'BIGINT',
            ],
            'laporjadin_nodpa' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'laporjadin_pembuka' => [
                'type'          => 'LONGTEXT',
            ],
            'laporjadin_hasil' => [
                'type'          => 'LONGTEXT',
            ],
            'laporjadin_penutup' => [
                'type'          => 'LONGTEXT',
            ],
            'laporjadin_foto1' => [
                'type'          => 'VARCHAR',
                'constraint'    => 40,
            ],
            'laporjadin_foto2' => [
                'type'          => 'VARCHAR',
                'constraint'    => 40,
            ],
            'laporjadin_foto3' => [
                'type'          => 'VARCHAR',
                'constraint'    => 40,
            ],
            'laporjadin_verif' => [
                'type'          => 'INT',
                'default'       => 0,
            ],
            'laporjadin_created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'laporjadin_updated_at' =>[
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'laporjadin_deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            
        ]);
        $this->forge->addKey('laporjadin_id', true);
        $this->forge->addForeignKey('laporjadin_sptid', 'spts', 'spt_id', 'CASCADE', 'CASCADE', 'FKlaporjadinsptid');

        $this->forge->createTable('laporjadins');
    }

    public function down()
    {
        $this->forge->dropForeignKey('laporjadins', 'FKlaporjadinsptid');
        $this->forge->dropTable('laporjadins');
    }
}

