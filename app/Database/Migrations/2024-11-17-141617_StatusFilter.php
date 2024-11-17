<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusFilter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('settings');
    }

    public function down()
    {
        // Drop tabel 'settings'
        $this->forge->dropTable('settings');
    }
}
