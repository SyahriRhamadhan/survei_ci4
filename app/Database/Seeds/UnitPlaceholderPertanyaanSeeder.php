<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitPlaceholderPertanyaanSeeder extends Seeder
{
    public function run()
    {
        // Data UPPS
        $uppsData = [
            'Fakultas Ekonomi dan Bisnis Maritim (FEBM)' => [
                'Akuntansi',
                'Manajemen',
                'Bisnis Digital',
                'Kewirausahaan'
            ],
            'Fakultas Ilmu Kelautan dan Perikanan (FIKP)' => [
                'Ilmu Kelautan',
                'Manajemen Sumberdaya Perairan',
                'Budidaya Perairan',
                'Teknologi Hasil Perikanan',
                'Sosial Ekonomi Perikanan'
            ],
            'Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)' => [
                'Ilmu Pemerintahan',
                'Administrasi Publik',
                'Sosiologi',
                'Ilmu Hukum',
                'Hubungan Internasional',
                'Kajian Film, Televisi, dan Media'
            ],
            'Fakultas Keguruan dan Ilmu Pendidikan (FKIP)' => [
                'Pendidikan Bahasa dan Sastra Indonesia',
                'Pendidikan Bahasa Inggris',
                'Pendidikan Matematika',
                'Pendidikan Biologi',
                'Pendidikan Kimia',
                'Pendidikan Profesi Guru (Profesi)'
            ],
            'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)' => [
                'Teknik Informatika',
                'Teknik Elektro',
                'Teknik Perkapalan',
                'Kimia',
                'Teknik Industri'
            ],
            'Program Pascasarjana (PPS)' => [
                'Magister Administrasi Publik',
                'Magister Ilmu Lingkungan',
                'Magister Pedagogi FKIP UMRAH'
            ],
            'Fakultas Kedokteran (FK)' => [
                'Kedokteran',
                'Pendidikan Profesi Dokter'
            ],
        ];

        // Format data UPPS menjadi baris terpisah
        $formattedUppsData = [];
        $currentTime = date('Y-m-d H:i:s');

        foreach ($uppsData as $namaUnit => $layananList) {
            foreach ($layananList as $layanan) {
                $formattedUppsData[] = [
                    'jenis_unit' => 'UPPS',
                    'nama_unit' => $namaUnit,
                    'jenis_layanan_yang_diterima' => $layanan,
                    'created_at' => $currentTime,
                    'updated_at' => $currentTime,
                ];
            }
        }

        // Data Unit Layanan
        $unitLayananData = [
            'Fakultas Ekonomi dan Bisnis Maritim (FEBM)' => [
                'Layanan Akademik Fakultas',
                'Sertifikat Akreditasi',
                'Layanan Alumni (Legalisir)'
            ],
            'Fakultas Ilmu Kelautan dan Perikanan (FIKP)' => [
                'Layanan Akademik dan Kemahasiswaan',
                'Layanan Pengelolaan Keuangan dan Sumberdaya Manusia',
                'Layanan Pengelolaan Sarana dan Prasarana'
            ],
            'Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)' => [
                'Layanan Administrasi Mahasiswa Satu Pintu',
                'Layanan Pengumpulan Dokumen TriDharma / Kebutuhan Pengajuan Angka Kredit',
                'Layanan Studio Podcast dan Fotography',
                'Layanan Penerbitan Buku',
                'Layanan Kehumasan dan Publikasi Majalah JENDELA FISIP',
                'Layanan BIMBINGAN SKRIPSI dan PERWALIAN (on Progress Hosting)',
                'Layanan Pengaduan (Sarana dan Prasarana)',
                'Layanan Kelompok Kepakaran (KERJASAMA, PENELITIAN DAN PKM)',
                'Layanan Pendidikan Khusus Profesi Advokat (PKPA)'
            ],
            'Program Pascasarjana (PPS)' => [
                'Layanan administrasi akademik dan kemahasiswaan',
                'Layanan pengelolaan keuangan dan sumber daya manusia',
                'Layanan Umum dan kerjasama'
            ],
            'Biro Akademik, Perencanaan, Kemahasiswaan, dan Kerja Sama (BAPKK)' => [
                'Penerimaan Mahasiswa Baru (PMB)',
                'Penerimaan Mahasiswa Program Alih Jenjang',
                'Perpindah Mahasiswa dari Perguruan Tinggi Lain ke Universitas Maritim Raja Ali Haji',
                'Perpindah Mahasiswa dari Universitas Maritim Raja Ali Haji Ke Perguruan Tinggi Lain',
                'Pindah Antar Mahasiswa antar Prodi di UMRAH',
                'Penerbitan Nomor Induk Mahasiswa (NIM)',
                'Pengurusan KTM (Kartu Tanda Mahasiswa)',
                'Perubahan Data SIPA (Sistem Informasi Pengelolaan Akademik)',
                'Perubahan Data Mahasiswa Di PDDIKTI',
                'Konversi Nilai Matakuliah',
                'Perubahan atau Penambahan Matakuliah dan Nilai Mahasiswa',
                'Surat Keterangan/Rekomendasi Mahasiswa',
                'Pengurusan Aktif Akademik setelah Cuti Kuliah dan Alpha Studi',
                'Pengurusan Cuti Akademik',
                'Pengurusan Alpa Studi',
                'Pendaftaran Wisuda',
                'Pengurusan Ijazah/Transkrip Nilai',
                'Permohonan Data Statistik Penerimaan Mahasiswa Baru (PMB)',
                'Permohonan Data Mahasiswa Aktif, Cuti, Alpa Studi, Mengundurkan Diri, Lulus',
                'Permohonan Data Statistik Wisuda',
                'Layanan Fasilitasi Kegiatan Ormawa',
                'Layanan Ekstrakurikuler',
                'Layanan Fasilitasi Kegiatan Ormawa',
                'Layanan Pembentukan dan Pengesahan Pengurus Ormawa',
                'Layanan Penyelenggaraan Lomba',
                'Layanan Pengajuan Beasiswa',
            ],
            'Lembaga Penelitian dan Pengabdian Masyarakat (LPPM)' => [
                'Layanan Membuat Akun Bima',
                'Layanan Akun Erispro',
                'Layanan Membuat Akun lupa Password aplikasi Bima',
                'Layanan Membuat Akun Syngkron Aplikasi Sinta',
                'Layanan Membuat Akun Syngkron Aplikasi Bima',
                'Layanan Akun Syngkron Garuda',
                'Layanan Akun Syngkron Scopus',
                'Layanan Akun Syngkron Aplikasi',
                'Layanan Informasi Penelitian Pendanaan Internal',
                'Layanan Informasi Pendanaan Penelitian Mandiri',
                'Layanan Informasi Usulan Proposal Penelitian Internal',
                'Layanan Informasi Laporan Kemajuan Penelitian Internal',
                'Layanan Informasi Laporan Akhir Penelitian Internal',
                'Layanan Informasi SPT Penelitian',
                'Layanan Laporan Keuangan Penelitian',
                'Layanan Pendanaan Penelitian DRTPM',
                'Layanan Aplikasi Bima',
                'Layanan Informasi PKM Pendanaan Internal',
                'Layanan Informasi Pendanaan PKM Mandiri',
                'Layanan Informasi Usulan Proposal PKM Internal',
                'Layanan Informasi Laporan Kemajuan PKM Internal',
                'Layanan Informasi Laporan Akhir PKM Internal',
                'Layanan Informasi SPT PKM',
                'Layanan Laporan Keuangan PKM',
                'Layanan Pendanaan PKM DRTPM',
                'Layanan KUKERTA mahasiswa',
            ],
            'Lembaga Penjaminan Mutu dan Pengembangan Pembelajaran (LPMPP)' => [
                'Pembukaan Prodi Baru',
                'Pendampingan Akreditasi',
                'AMI Akademik',
                'AMI Non Akademik',
                'Pengembangan Pembelajaran',
                'MBKM',
                'IKU',
                'SPMI',
                'Layanan MKWK',
                'Akreditas',
            ],
            'Unit Penunjang Akademik Laboratorium Terpadu (UPA Lab Terpadu)' => [
                'Electron Microscopy & Microanalysis',
                'Analytical Spectroscopy & Diffraction',
                'Advanced Separation & Analytical',
                'Thermal Treatment & Processing Laboratory',
                'Thermal & Particle Analysis',
                'Molecular Identification & Spectroscopy',
                'Electrochemical Research & Analysis',
                'Computational Analysis',
            ],
            'Unit Penunjang Akademik Teknologi Informasi dan Komunikasi (UPA TIK)' => [
                'Layanan teknis perbaikan jaringan internet',
                'Layanan teknis email umrah.ac.id',
                'Layanan penyediaan hosting web',
                'Layanan teknis perbaikan aplikasi institusi',
            ],
            'Fakultas Teknik dan Teknologi Kemaritiman (FTTK)' => [
                'Layanan Akademik dan Kemahasiswaan',
                'Layanan Pengelolaan Keuangan dan Sumberdaya Manusia',
                'Layanan Pengelolaan Sarana dan Prasarana',
                'Layanan Umum dan Kerjasama',
                'Layanan Alumni (Legalisir)',
            ],
            'Unit Penunjang Akademik Perpustakaan (UPA Perpus)' => [
                'Layanan Front Office',
                'Layanan Loker',
                'Layanan Sirkulasi',
                'Layanan Referensi',
                'Layanan Multimedia',
                'E-Journal',
                'E-Book',
                'Turnitin',
                'Layanan Ruang Diskusi',
                'Layanan Pojok Statistik',
                'Layanan Baca Ditempat',
                'Layanan Repository',
                'Layanan Pendaftaran Anggota Perpustakaan',
                'Layanan Peringatan Jatuh Tempo Pengembalian',
                'Layanan Helpdesk Perpustakaan',
                'Layanan OPAC',
                'Layanan UMRAH Digital Library (playstore)',
                'Layanan SKBP',
                'Layanan Publikasi Jurnal Mahasiswa (SOJ)',
                'Layanan Offline Database',
                'Layanan Perpustakaan Digital',
                'Layanan Reference Desk',
                'Layanan SKBP Secara Online',
                'China, Singapore, Melayu Corner',
                'Layanan Printing',
                'Layanan Li & Co (Library Coffee) Café',
                'Layanan Book Reservation',
                'Layanan Promosi (Live Instagram)',
                'Pojok Baca Fakultas',
            ],
        ];

        // Format ulang data Unit Layanan
        $formattedUnitLayananData = [];
        foreach ($unitLayananData as $namaUnit => $layananList) {
            foreach ($layananList as $layanan) {
                $formattedUnitLayananData[] = [
                    'jenis_unit' => 'Unit Layanan',
                    'nama_unit' => $namaUnit,
                    'jenis_layanan_yang_diterima' => $layanan,
                    'created_at' => $currentTime,
                    'updated_at' => $currentTime,
                ];
            }
        }

        // Gabungkan data UPPS dan Unit Layanan
        $data = array_merge($formattedUppsData, $formattedUnitLayananData);

        // Insert data ke tabel `unit_placeholder_pertanyaan`
        $this->db->table('unit_placeholder_pertanyaan')->insertBatch($data);
    }
}
