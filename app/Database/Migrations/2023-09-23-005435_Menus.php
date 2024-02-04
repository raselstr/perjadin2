<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Menus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'menu_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'menu_icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'menu_link' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'menu_active' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'role_id' => [
                'type' => 'INT',
                'default' => 0,
            ],
            
        ]);
        $this->forge->addKey('menu_id', true);
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}
