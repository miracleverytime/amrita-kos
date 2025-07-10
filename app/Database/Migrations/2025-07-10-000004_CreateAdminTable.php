<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin'  => ['type' => 'INT', 'constraint' => 20, 'auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'password'  => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
