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
            'key'   => 'status',  // Kamu bisa sesuaikan key-nya dengan kebutuhan
            'value' => 'on',      // Set status menjadi 'on' untuk satu data
        ];

        // Insert data ke dalam tabel 'settings'
        $this->db->table('settings')->insert($data);
    }
}
