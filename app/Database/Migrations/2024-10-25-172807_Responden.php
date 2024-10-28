<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Responden extends Migration
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
            'umur' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Laki-laki', 
                    'Perempuan',
                ],
                'null' => true,
            ],
            'kategori_responden' => [
                'type' => 'ENUM',
                'constraint' => [
                    'mahasiswa', 
                    'dosen dan staff pengajar',
                    'alumni',
                    'mitra atau masyarakat'
                ],
                'null' => true,
            ],
            'id_unit_placeholder' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addForeignKey('id_unit_placeholder', 'unit_placeholder_pertanyaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('responden');
    }

    public function down()
    {
        $this->forge->dropTable('responden');
    }
}
