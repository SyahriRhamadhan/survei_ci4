<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipePertanyaan extends Migration
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
            'tipe_pertanyaan' => [ 
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
   
        $this->forge->createTable('tipe_pertanyaan');
    }

    public function down()
    {
        $this->forge->dropTable('tipe_pertanyaan');
    }
}
