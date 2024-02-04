<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Pegawais extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pegawai_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pegawai_nip' => [
                'type'           => 'VARCHAR',
                'constraint'     => '18',
            ],
            'pegawai_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100'
            ],
            'pegawai_jabatan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'eselon_id' => [
                'type'          => 'INT',
                'constraint'    => 2
            ],
            'pangkat_id' => [
                'type'          => 'INT',
                'constraint'    => 2,
            ],
            'pegawai_tingkat' => [
                'type'          => 'INT',
                'constraint'    => 2,
            ],
            'pegawai_foto' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            
        ]);
        $this->forge->addKey('pegawai_id', true);
        $this->forge->addForeignKey('eselon_id', 'eselons', 'eselon_id','','','pegawaieselonidFK');
        $this->forge->addForeignKey('pangkat_id', 'pangkats', 'pangkat_id','','','pegawaipangkatidFK');
        $this->forge->addForeignKey('pegawai_tingkat', 'tingkats', 'tingkat_id','','','pegawaitingkatidFK');

        $this->forge->createTable('pegawais');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pegawais','pegawaieselonidFK');
        $this->forge->dropForeignKey('pegawais','pegawaipangkatidFK');
        $this->forge->dropForeignKey('pegawais','pegawaitingkatidFK');

        $this->forge->dropTable('pegawais');
    }
}
