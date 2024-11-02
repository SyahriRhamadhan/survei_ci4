<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SurveiPertanyaan extends Migration
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
        $this->forge->addForeignKey('id_pertanyaan', 'pertanyaan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_survei', 'survei', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('survei_pertanyaan');
    }

    public function down()
    {
        $this->forge->dropTable('survei_pertanyaan');
    }
}
