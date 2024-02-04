<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perbups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'perbup_id' => [
                'type'           => 'INT',
                'constraint'     => 2,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'perbup_tingkatid' => [
                'type'       => 'INT',
            ],
            'perbup_lokasiid' => [
                'type'       => 'INT',
            ],
            'perbup_kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'perbup_hotel' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_uh' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_uhdiklat' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_uhrapat_fullboad' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_uhrapat_fullday' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_uhrapat_residencedlmkota' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_taksi_transportdarat' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_representasi' => [
                'type'       => 'DOUBLE',
            ],
            'perbup_sewakendaraan' => [
                'type'       => 'DOUBLE',
            ],
            
        ]);
        $this->forge->addKey('perbup_id', true);
        $this->forge->addForeignKey('perbup_tingkatid', 'tingkats', 'tingkat_id', '', '', 'perbuptingkatidFK');
        $this->forge->addForeignKey('perbup_lokasiid', 'lokasiperjadins', 'lokasiperjadin_id', '', '', 'perbuplokasiidFK');

        $this->forge->createTable('perbups');

    }

    public function down()
    {
        $this->forge->dropForeignKey('perbups', 'perbuptingkatidFK');
        $this->forge->dropForeignKey('perbups', 'perbuplokasiidFK');

        $this->forge->dropTable('perbups');
    }
}
