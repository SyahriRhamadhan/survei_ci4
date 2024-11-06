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
                'null' => true,
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Laki-laki',
                    'Perempuan',
                ],
                'null' => true,
            ],
            'jam_survei' => [
                'type' => 'ENUM',
                'constraint' => [
                    '08.00 - 12.00',
                    '13.00 - 17.00',
                ],
                'null' => true,
            ],
            'tanggal_survei' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'saran_masukan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kategori_responden' => [
                'type' => 'ENUM',
                'constraint' => [
                    'mahasiswa',
                    'dosen',
                    'tendik',
                    'mitra',
                    'umum'
                ],
                'null' => true,
            ],
            'id_survei' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_prodi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_fakultas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_unit' => [
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
        $this->forge->addForeignKey('id_survei', 'survei', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fakultas', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_unit', 'unit_kerja', 'id', 'CASCADE', 'CASCADE');


        $this->forge->createTable('responden');
    }

    public function down()
    {
        $this->forge->dropTable('responden');
    }
}
