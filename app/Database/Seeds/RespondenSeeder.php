<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RespondenSeeder extends Seeder
{
    public function run()
    {
        $categories = ['mahasiswa', 'dosen dan staff pengajar', 'alumni', 'mitra atau masyarakat'];
        $genders = ['Laki-laki', 'Perempuan'];
        $data = [];
        $idCounter = 1; // Mulai id dari 1

        foreach ($categories as $category) {
            for ($i = 0; $i < 20; $i++) {
                $data[] = [
                    'id' => $idCounter++, // Increment id setiap kali iterasi
                    'umur' => rand(7, 60), // random umur antara 7 dan 60 tahun
                    'jenis_kelamin' => $genders[array_rand($genders)], // random gender
                    'kategori_responden' => $category,
                    'id_unit_placeholder' => rand(1, 20), // random id between 1 and 20
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        // Insert data ke tabel `responden`
        $this->db->table('responden')->insertBatch($data);
    }
}
