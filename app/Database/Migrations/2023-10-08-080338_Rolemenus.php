<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Rolemenus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'rolemenu_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_id' => [
                'type'       => 'BIGINT',
            ],
            'menu_id' => [
                'type'          => 'BIGINT',
            ],
            'submenu_id' => [
                'type'          => 'BIGINT',
            ],
            'lihat' => [
                'type'          => 'ENUM',
                'constraint'    => ['true','false'],
                'default'       =>  'false',
            ],
            'tambah' => [
                'type'          => 'ENUM',
                'constraint'    => ['true','false'],
                'default'       =>  'false',
            ],
            'ubah' => [
                'type'          => 'ENUM',
                'constraint'    => ['true','false'],
                'default'       =>  'false',
            ],
            'hapus' => [
                'type'          => 'ENUM',
                'constraint'    => ['true','false'],
                'default'       =>  'false',
            ],
            
        ]);
        $this->forge->addKey('rolemenu_id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'role_id','','','roleidmenuFK');
        $this->forge->addForeignKey('menu_id', 'menus', 'menu_id','','','menuidroleFK');
        $this->forge->addForeignKey('submenu_id', 'submenus', 'submenu_id','','','submenuidroleFK');

        $this->forge->createTable('rolemenus');
    }

    public function down()
    {
        $this->forge->dropForeignKey('rolemenus','roleidmenuFK');
        $this->forge->dropForeignKey('rolemenus','menuidroleFK');
        $this->forge->dropForeignKey('rolemenus','submenuidroleFK');

        $this->forge->dropTable('rolemenus');
    }
}
