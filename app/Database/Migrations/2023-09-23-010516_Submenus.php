<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Submenus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'submenu_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'menu_id' => [
                'type' => 'INT',
            ],
            'submenu_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'submenu_icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'submenu_link' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'submenu_active' => [
                'type' => 'INT',
                'default' => 1,
            ],
            'role_id' => [
                'type' => 'INT',
                'default' => 0,
            ],
            
        ]);
        $this->forge->addKey('submenu_id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'menu_id','','','menuidFK');
        $this->forge->createTable('submenus');
    }

    public function down()
    {
        $this->forge->dropForeignKey('submenus','menuidFK');
        $this->forge->dropTable('submenus');
    }
}
