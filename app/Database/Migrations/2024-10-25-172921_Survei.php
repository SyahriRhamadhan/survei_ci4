<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Survei extends Migration
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
            'judul' => [ 
                'type' => 'ENUM',
                'constraint' => [ // patokan hal 22-29 pdf
                    'Instrumen survei kepuasan mahasiswa di UPPS', 
                    'Instrumen survei kepuasan dosen di UPPS',
                    'Instrumen survei kepuasan tenaga kependidikan di UPPS',
                    'Instrumen survei kepuasan mitra di UPPS',
                    'Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH',
                ],
                'null' => true,
            ],
            'dekripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tgl_mulai' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tgl_selesai' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [ 
                'type' => 'ENUM',
                'constraint' => [
                    'on',
                    'off',
                ],
                'null' => true,
            ],
            'id_unit_placeholder' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_pertanyaan' => [
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
        $this->forge->addForeignKey('id_pertanyaan', 'pertanyaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_unit_placeholder', 'unit_placeholder_pertanyaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('survei');
    }

    public function down()
    {
        $this->forge->dropTable('survei');
    }
}
