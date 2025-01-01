<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    public function run()
    {
        // Daftar tipe pertanyaan
        $questionTypes = [
            'none' => [
                'Persyaratan teknis dan administratif yang ditetapkan <tag> sudah sesuai untuk memenuhi layanannya.',
                'Prosedur pelayanan di <tag> mudah, sesuai dengan aturan.',
                'Layanan <tag> memiliki kejelasan alur layanan yang sesuai dengan aturan.',
                '<tag> memiliki kepastian jadwal layanan.',
                '<tag> memberikan pelayanan yang cepat.',
                'Petugas pemberi layanan di <tag> selalu disiplin dalam melaksanakan tugas-tugasnya.',
                'Pelayanan yang diberikan oleh <tag> telah sesuai dengan standar ketentuan yang berlaku.',
                'Petugas pemberi layanan di <tag> memiliki kompetensi yang baik dalam hal pengetahuan, keahlian, keterampilan, dan pengalaman.',
                'Petugas pemberi layanan di <tag> memberikan layanan dengan sopan, ramah dan responsif.',
                '<tag> memberikan pelayanan yang adil kepada semua pihak yang datang.',
                '<tag> membuka jalur pengaduan dan saran yang berfungsi baik serta melakukan tindaklanjut atas pengaduan dan saran terkait dengan layanannya.',
                '<tag> memiliki lingkungan pelayanan yang nyaman.',
                '<tag> memiliki lingkungan yang aman dan mendukung pemberian layanan.',
                'Layanan di <tag> didukung dengan sarana dan prasarana (termasuk teknologi informasi) yang baik dan memadai.',
                'Tidak ada pungutan liar (pungli) pada unit layanan <tag>'
            ],
            'Tata Kelola, Tata Pamong, dan Kerjasama' => [
                'Sistem Informasi Akademik (SIPA) bekerja dengan handal dan mudah diakses.',
                'Pemimpin <tag> memberikan solusi yang inovatif dalam menyelesaikan permasalahan mahasiswa.',
                'Pemimpin <tag> menerima pendapat atau saran dari mahasiswa dengan sikap terbuka.',
                'Pemberian sanksi bagi mahasiswa yang melanggar peraturan yang telah ditetapkan dan berlaku untuk semua mahasiswa tanpa terkecuali.',
                '<tag> memiliki kepedulian dalam memahami kepentingan dan kesulitan mahasiswa.',
                'Kegiatan kerjasama yang dilakukan <tag> dengan berbagai instansi sangat bermanfaat untuk peningkatan kualitas pembelajaran.',
                'Kegiatan kerjasama yang dilakukan <tag> mendukung kegiatan skripsi.'
            ],
            'Bidang Kemahasiswaan' => [
                'Fasilitasi Unit Kemahasiswaan untuk pembinaan pengembangan kepribadian dan kepemimpinan.',
                'Fasilitasi Unit Kemahasiswaan untuk kegiatan pelatihan terkait leadership, public speaking, critical thinking, creativity, dan nasionalism.',
                'Fasilitasi Unit Kemahasiswaan untuk kegiatan pelatihan terkait edupreneur.',
                'Fasilitasi Unit Kemahasiswaan untuk kegiatan penguasaan teknologi informasi.',
                'Fasilitasi Unit Kemahasiswaan untuk kegiatan minat dan bakat di bidang olah raga, seni, sosial, dan kerohanian.',
                'Fasilitasi Unit Kemahasiswaan untuk mengikuti kompetisi baik di bidang akademik maupun nonakademik.',
                'Fasilitasi Unit Kemahasiswaan untuk kegiatan Program Kreativitas Mahasiswa (PKM).',
                'Fasilitasi Unit Kemahasiswaan untuk layanan bimbingan konseling kepada mahasiswa.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan akses beasiswa bagi mahasiswa berprestasi maupun kurang mampu.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan kesehatan bagi mahasiswa.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan asuransi/santunan kecelakaan bagi mahasiswa.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan bimbingan karir.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan pelatihan kewirausahaan.',
                'Fasilitasi Unit Kemahasiswaan untuk layanan pelatihan Job Seeker.'
            ],
            'Bidang Sarana dan Prasarana' => [
                'Aksesibilitas menggunakan ruang kelas, ruang laboratorium dan ruang auditorium.',
                'Keberadaan laboratorium relevan dengan kebutuhan keilmuan mahasiswa.',
                'Pencahayaan ruang kelas, ruang laboratorium dan ruang auditorium.',
                'Kebersihan dan kenyamanan ruang kelas, ruang laboratorium dan ruang auditorium.',
                'Ketersediaan makanan yang bervariasi dengan harga yang terjangkau pada Kantin dan Koperasi Mahasiswa.',
                'Kenyamanan, kebersihan dan keamanan ruang Layanan Kesehatan Mahasiswa.',
                'Ketersediaan buku wajib dan referensi yang digunakan dalam proses belajar mengajar di perpustakaan.',
                'Ketersediaan, kenyamanan dan kebersihan Sarana ibadah.',
                'Kecukupan, ketertiban, dan keamanan tempat parkir kendaraan.',
                'Kemudahan mengakses fasilitas hotspot/Wifi.'
            ],
            'Sistem Tata Pamong' => [
                'Bagaimana pendapat Anda tentang kredibilitas <tag>?',
                'Bagaimana pendapat Anda tentang transparansi dalam mengelola dan pengawasan yang dilakukan <tag>?',
                'Bagaimana pendapat Anda tentang akuntabilitas <tag>?',
                'Bagaimana pendapat Anda tentang tanggung jawab <tag> dalam menjalankan fungsi pengelolaan dan pengawasan?',
                'Bagaimana pelaksanaan prinsip keadilan <tag> dalam menjalankan fungsi pengelolaan dan pengawasan?'
            ],
            'Kepemimpinan dan Kemampuan Manajerial' => [
                'Bagaimana pendapat Anda tentang kapabilitas pimpinan <tag> dalam melakukan perencanaan (planning)?',
                'Bagaimana pendapat Anda tentang kapabilitas pimpinan <tag> dalam melakukan fungsi pengorganisasian (organizing)?',
                'Bagaimana pendapat Anda tentang kapabilitas pimpinan <tag> dalam melakukan fungsi penempatan (staffing)?',
                'Bagaimana pendapat Anda tentang kapabilitas pimpinan <tag> dalam melakukan fungsi pelaksanaan (leading)?',
                'Bagaimana pendapat Anda tentang kapabilitas pimpinan <tag> dalam melakukan fungsi pengendalian dan pengawasan (controlling)?',
                'Bagaimana pendapat Anda tentang kinerja <tag> dalam menjalankan fungsi pengelolaan dan pengawasan?'
            ],
            'Kerjasama' => [
                'Terlaksananya kerjasama <tag> dengan mitra baik di dalam dan luar negeri mendukung pelaksanaan pengajaran, penelitian, dan pengabdian kepada masyarakat.',
                'Terlaksananya kerjasama <tag> dengan mitra baik di dalam dan luar negeri mendukung proses pengembangan karier.'
            ],
            'Layanan dan Sumber Daya Manusia' => [
                'Kesempatan dosen untuk mengikuti pelatihan, workshop, atau seminar yang dibutuhkan untuk pengembangan diri.',
                'Dosen mendapatkan informasi, layanan, dan kesempatan untuk kenaikan jabatan fungsional dan struktural secara periodik.',
                'Dosen mendapatkan informasi, layanan, dan kesempatan untuk meningkatkan jabatan non-struktural.',
                'Upaya sungguh-sungguh pimpinan <tag> dalam memperhatikan kesejahteraan dosen melalui kebijakan dan program yang mendukung.',
                '<tag> memiliki dan menjalankan sistem pembinaan pegawai dalam bentuk pemberian penghargaan dan sanksi hukuman.'
            ],
            'Layanan Keuangan' => [
                '<tag> memfasilitasi dosen untuk memperoleh dana penelitian dan pengabdian kepada masyarakat.'
            ],
            'Layanan Sarana dan Prasarana' => [
                '<tag> menyediakan fasilitas pendukung yang memadai untuk mendukung tanggung jawab pekerjaan yang dijalankan.',
                'Fasilitas yang tersedia di <tag> nyaman dan menjamin keamanan.'
            ],
            'Kerjasama UPPS Dengan Mitra' => [
                'Kerjasama dengan <tag> memberikan kemanfaatan untuk pengembangan instansi kami',
                '<tag> menindaklanjuti kerjasama dengan menerbitkan nota kesepakatan',
                '<tag> melaksanakan kerjasama sesuai dengan nota kesepakatan.',
                '<tag> melakukan evaluasi kerjasama yang telah dilakukan.',
                '<tag> menindaklanjuti hasil evaluasi untuk perbaikan kerjasama selanjutnya.',
                '<tag> melibatkan instansi kami dalam pelaksanaan kegiatan',
                'Kegiatan kerjasama dengan <tag> memberikan kontribusi dalam pengembangan instansi kami',
                'Keberlanjutan kerjasama dengan <tag> memberikan kontribusi dalam pengembangan instansi kami'
            ],
        ];

        $data = [];
        $id = 1;

        foreach ($questionTypes as $type => $questions) {
            foreach ($questions as $pertanyaan) {
                $data[] = [
                    'id' => $id++,
                    'pertanyaan' => $pertanyaan,
                    'tipe_pertanyaan' => $type,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        $this->db->table('pertanyaan')->insertBatch($data);
    }
}
