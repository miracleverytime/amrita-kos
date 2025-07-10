<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'   => ['type' => 'INT', 'constraint' => 20, 'auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'password'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'no_hp'     => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
