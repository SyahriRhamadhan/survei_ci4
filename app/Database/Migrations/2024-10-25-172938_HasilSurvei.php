<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HasilSurvei extends Migration
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
            'saran_masukan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'jawaban' => [ 
                'type' => 'ENUM',
                'constraint' => [
                    '1',
                    '2',
                    '3',
                    '4',
                ],
                'null' => true,
            ],
            'id_responden' => [
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
            'id_survei' => [
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
        $this->forge->addForeignKey('id_responden', 'responden', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pertanyaan', 'pertanyaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_survei', 'survei', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hasil_survei');
    }

    public function down()
    {
        $this->forge->dropTable('hasil_survei');
    }
}
