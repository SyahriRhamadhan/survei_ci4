<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SurveyTokens extends Migration
{
    public function up()
    {
        // Membuat tabel survey_tokens
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true, // Token harus unik
            ],
            'id_survei' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'used' => [
                'type'       => 'BOOLEAN',
                'default'    => false, // Status token, default belum digunakan
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
        // Menambahkan primary key
        $this->forge->addPrimaryKey('id');
        // Menambahkan foreign key ke tabel survei
        $this->forge->addForeignKey('id_survei', 'survei', 'id', 'CASCADE', 'CASCADE');
        // Membuat tabel
        $this->forge->createTable('survey_tokens');
    }

    public function down()
    {
        // Menghapus tabel survey_tokens
        $this->forge->dropTable('survey_tokens');
    }
}
