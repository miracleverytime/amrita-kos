<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaporanKeuanganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan'   => ['type' => 'INT', 'auto_increment' => true],
            'tahun'        => ['type' => 'YEAR'],
            'bulan'        => ['type' => 'TINYINT', 'constraint' => 2],
            'total_masuk'  => ['type' => 'INT'],
            'total_keluar' => ['type' => 'INT'],
            'id_admin'     => ['type' => 'INT', 'constraint' => 20],
        ]);
        $this->forge->addKey('id_laporan', true);
        $this->forge->createTable('laporan_keuangan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_keuangan');
    }
}
