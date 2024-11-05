<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JawabanSurvei extends Migration
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
            'id_pertanyaan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_responden' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'jawaban' => [
                'type' => 'TINYINT',  // atau gunakan INT jika rentang jawaban lebih besar
                'constraint' => 4,    // Nilai 1 sampai 4
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
        $this->forge->addForeignKey('id_responden', 'responden', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jawaban_survei');
    }

    public function down()
    {
        $this->forge->dropTable('jawaban_survei');
    }
}
