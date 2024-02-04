<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'user_nmlengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
            ],
            'user_password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_active' => [
                'type' => 'INT',
                'default'       => 1,
            ],
            'user_roleid' => [
                'type' => 'BIGINT',
            ],
            'user_created_at'        => [
                'type'          => 'TIMESTAMP',
                'default'       => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'user_updated_at'        => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'user_deleted_at'        => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->addForeignKey('user_roleid', 'roles', 'role_id','','','roleidFK');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users','roleidFK');
        $this->forge->dropTable('users');
    }
}
