<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pertanyaan extends Migration
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
            'pertanyaan' => [ 
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tipe_pertanyaan' => [
                'type' => 'ENUM',
                'constraint' => [ //hall 22-29 pdf patokan
                    'none', 
                    'Tata Kelola, Tata Pamong, dan Kerjasama', 
                    'Bidang Kemahasiswaan',
                    'Bidang Sarana dan Prasarana',
                    'Sistem Tata Pamong',
                    'Kepemimpinan dan Kemampuan Manajerial',
                    'Kerjasama',
                    'Layanan dan Sumber Daya Manusia',
                    'Layanan Keuangan',
                ],
                'null' => true,
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
   
        $this->forge->createTable('pertanyaan');
    }

    public function down()
    {
        $this->forge->dropTable('pertanyaan');
    }
}
