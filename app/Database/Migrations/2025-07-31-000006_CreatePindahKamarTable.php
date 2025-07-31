<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePindahKamarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pindah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_kamar_lama' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_kamar_baru' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'alasan' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM("Pending", "Disetujui", "Ditolak")',
                'default'    => 'Pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id_pindah', true);
        $this->forge->createTable('pindah_kamar');
    }

    public function down()
    {
        $this->forge->dropTable('pindah_kamar');
    }
}
