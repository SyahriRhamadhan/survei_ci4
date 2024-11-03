<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitPlaceholderPertanyaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'jenis_unit' => [ //unit layanan(setiap melakukan pelayanan) / upps(setahun sekali di desember)
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_unit' => [ 
                'type' => 'VARCHAR', //contoh input di hal 7-8 pdf
                'constraint' => '255',
            ],
            'jenis_layanan_yang_diterima' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

  
        $this->forge->addPrimaryKey('id');
   
        $this->forge->createTable('unit_placeholder_pertanyaan');
    }

    public function down()
    {
        $this->forge->dropTable('unit_placeholder_pertanyaan');
    }
}
