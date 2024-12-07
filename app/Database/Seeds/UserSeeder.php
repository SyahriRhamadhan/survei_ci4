<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Role Admin
        $this->db->table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'admin',
            'akses' => 'yes'
        ]);
        // Role Unit
        $this->db->table('users')->insert([
            'name' => 'Rektor',
            'email' => 'rektor@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'admin',
            'akses' => 'no'
        ]);
        
    }
}