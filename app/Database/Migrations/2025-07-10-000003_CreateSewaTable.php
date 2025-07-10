<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSewaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sewa'      => ['type' => 'INT', 'constraint' => 20, 'auto_increment' => true],
            'id_user'      => ['type' => 'INT', 'constraint' => 20],
            'id_kamar'     => ['type' => 'INT', 'constraint' => 20],
            'tgl_awal'     => ['type' => 'DATE'],
            'tgl_berhenti' => ['type' => 'DATE'],
        ]);
        $this->forge->addKey('id_sewa', true);
        $this->forge->createTable('sewa');
    }

    public function down()
    {
        $this->forge->dropTable('sewa');
    }
}
