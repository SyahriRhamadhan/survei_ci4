<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitPlaceholderPertanyaan extends Migration
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
            'jenis_unit' => [ 
                'type' => 'ENUM',
                'constraint' => [
                    'UPPS', //setahun sekali
                    'Unit Layanan', //sehabis survei
                ],
                'null' => true,
            ],
            'nama_unit' => [ 
                'type' => 'ENUM',
                'constraint' => [ // hal 7-8 pdf
                    //Unit Pengelola Program Studi (UPPS)
                    'Fakultas Ekonomi dan Bisnis Maritim (FEBM)',
                    'Fakultas Ilmu Kelautan dan Perikanan (FIKP)',
                    'Fakultas Ilmu Sosial dan Ilmu Pemerintahan (FISIP)',
                    'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)',
                    'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)',
                    'Magister Ilmu Lingkungan (MIL)',
                    'Magister Administrasi Publik (MAP)',
                    'Biro Akademik, Perencanaan, dan Kemahasiswaan',
                    //biro
                    'Layanan umum',
                    'Layanan keuangan',
                    'Layanan kepegawaian',
                    'Layanan akademik', 
                    'Layanan kemahasiswaan', 
                    'Layanan perencanaan',
                    //lembaga
                    'Lembaga Penelitian dan Pengabdian Masyarakat',
                    'Lembaga Penjaminan Mutu dan Pusat Pembelajaran',
                    //Unit Penunjang Akademik (UPA)
                    'UPA Teknologi, Informasi, dan Komunikasi (TIK)',
                    'UPA Bahasa',
                    'UPA Karir',
                    'UPA Perpustakaan',
                    'UPA Lab Terpadu',
                ],
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
   
        $this->forge->createTable('unit_placeholder_pertanyaan');
    }

    public function down()
    {
        $this->forge->createTable('unit_placeholder_pertanyaan');
    }
}
