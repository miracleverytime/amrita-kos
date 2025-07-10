<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKamarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kamar'   => ['type' => 'INT', 'constraint' => 20, 'auto_increment' => true],
            'no_kamar'  => ['type' => 'INT', 'constraint' => 20],
            'harga'     => ['type' => 'INT', 'constraint' => 20],
            'fasilitas' => ['type' => 'VARCHAR', 'constraint' => 99],
            'status'    => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->forge->addKey('id_kamar', true);
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
