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
        ]);
        // Role Unit
        $this->db->table('users')->insert([
            'name' => 'Unit 1',
            'email' => 'unit1@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'unit'
        ]);
        // Role Pimpinan
        $this->db->table('users')->insert([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'role' => 'pimpinan'
        ]);
        
    }
}