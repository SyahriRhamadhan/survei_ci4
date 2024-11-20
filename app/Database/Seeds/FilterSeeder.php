<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FilterSeeder extends Seeder
{
    public function run()
    {
        // Insert data dengan status 'on'
        $data = [
            'id' => 1,
            'key'   => 'status',
            'value' => 'off',
        ];

        // Insert data ke dalam tabel 'settings'
        $this->db->table('settings')->insert($data);
    }
}
