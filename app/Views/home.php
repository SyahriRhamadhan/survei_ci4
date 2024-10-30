<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survei UMRAH</title>
    <meta name="description" content="Website Survei UMRAH untuk peningkatan kualitas pelayanan perguruan tinggi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/logo.png') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.95), rgba(29, 78, 216, 0.85));
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .modal.show {
            display: flex;
        }
        .modal-content {
            max-height: 80vh;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans leading-normal tracking-normal">

<header class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-md fixed w-full z-10">
    <div class="container mx-auto">
        <div class="flex justify-between items-center py-3 px-6">
            <a href="/" class="flex items-center space-x-3">
                <img src="<?= base_url('assets/images/Header.png') ?>" alt="Survei UMRAH Logo" class="h-16">
            </a>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-white hover:text-gray-200 font-medium transition duration-200">Beranda</a>
                <a href="#about" class="text-white hover:text-gray-200 font-medium transition duration-200">Tentang</a>
                <a href="<?= base_url('/responden/dashboard') ?>" 
                   class="bg-white hover:bg-gray-200 text-blue-900 px-6 py-2 rounded-full font-medium transition duration-200">
                    <i class="fas fa-poll mr-2"></i>Survei Sekarang
                </a>
            </nav>
            <button class="md:hidden text-gray-700 hover:text-blue-900">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </div>
</header>

<section class="hero-section relative flex items-center justify-center min-h-screen bg-cover bg-center text-white" 
         style="background-image: url('<?= base_url('assets/images/BG - Home.jpeg') ?>');">
    <div class="absolute inset-0 hero-gradient"></div>
    <div class="relative z-10 container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-4xl font-bold mb-6 leading-tight">
                Selamat Datang di Survei UMRAH
            </h1>
            <p class="text-xl md:text-2xl mb-10 text-gray-100">
                Partisipasi Anda sangat berarti dalam meningkatkan kualitas pelayanan di Universitas Maritim Raja Ali Haji
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#survey-section" 
                   class="glass-effect px-8 py-4 rounded-full text-lg font-semibold hover-scale inline-flex items-center justify-center">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    Mulai Survei
                </a>
                <a href="#about" 
                   class="bg-white text-blue-900 px-8 py-4 rounded-full text-lg font-semibold hover-scale inline-flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</section>

<section id="survey-section" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl shadow-xl p-10 text-white" data-aos="fade-up">
                <div class="text-center mb-8">
                    <div class="bg-white/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clipboard-list text-4xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4">Survei Kepuasan</h2>
                    <p class="text-lg text-gray-100">
                        Berikan masukan Anda untuk membantu meningkatkan kualitas pelayanan di UMRAH. 
                        Setiap pendapat sangat berharga bagi kemajuan institusi.
                    </p>
                </div>
                <div class="flex justify-center">
                    <a href="<?= base_url('/responden/dashboard') ?>" 
                       class="bg-white text-blue-900 px-8 py-4 rounded-full text-lg font-semibold hover-scale inline-flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Mulai Survei
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- New About Section -->
<section id="about" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Tentang Survei UMRAH</h2>
                <p class="text-gray-600">Memahami dan Meningkatkan Kualitas Pendidikan Bersama</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12" data-aos="fade-up" data-aos="delay-200">
                <div class="prose max-w-none">
                    <div class="space-y-6 text-gray-700">
                        <p class="lead text-lg">
                            Pendidikan yang berkualitas adalah tujuan utama dari setiap perguruan tinggi. Dalam rangka mencapai hal ini, penting untuk memahami bagaimana pengalaman belajar diakui oleh mahasiswa, dosen, dan pihak terkait lainnya.
                        </p>
                        
                        <div class="grid md:grid-cols-2 gap-8 my-12">
                            <div class="bg-blue-50 p-6 rounded-xl">
                                <h3 class="text-xl font-semibold text-blue-900 mb-4">
                                    <i class="fas fa-users mr-2"></i>
                                    Komunitas Akademik
                                </h3>
                                <p>
                                    Perguruan tinggi adalah komunitas yang melibatkan banyak pihak, termasuk mahasiswa, dosen, staf administrasi, alumni, dan mitra eksternal. Masing-masing kelompok memiliki pandangan unik tentang pengalaman dan kualitas pendidikan.
                                </p>
                            </div>
                            
                            <div class="bg-blue-50 p-6 rounded-xl">
                                <h3 class="text-xl font-semibold text-blue-900 mb-4">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    Adaptasi Berkelanjutan
                                </h3>
                                <p>
                                    Kebutuhan dan harapan stakeholder terhadap perguruan tinggi dapat berubah seiring waktu. Survei kepuasan stakeholder membantu dalam mengidentifikasi perubahan ini dan menyesuaikan strategi perguruan tinggi.
                                </p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white p-8 rounded-xl my-8">
                            <h3 class="text-2xl font-bold mb-4">Tujuan Survei</h3>
                            <p class="text-gray-100">
                                Survei ini dilakukan sebagai bentuk umpan balik dari stakeholder terhadap kualitas pelayanan di lingkungan Universitas Maritim Raja Ali Haji (UMRAH).
                            </p>
                        </div>

                        <button onclick="openModal()" class="bg-blue-900 text-white px-6 py-3 rounded-full hover:bg-blue-800 transition duration-200 mx-auto block">
                            Baca Lebih Lanjut
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="aboutModal" class="modal">
    <div class="modal-content bg-white w-full max-w-4xl mx-4 md:mx-auto my-8 rounded-2xl shadow-2xl p-6 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-blue-900">Tentang Survei Kepuasan Stakeholder</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <div class="prose max-w-none space-y-6 text-gray-700">
            <p>
                Survei kepuasan stakeholder memberikan gambaran tentang apa yang berfungsi dengan baik dan di mana ada potensi perbaikan. Perguruan tinggi adalah komunitas yang melibatkan banyak pihak, termasuk mahasiswa, dosen, staf administrasi, alumni, dan mitra eksternal.
            </p>
            
            <h4 class="text-xl font-semibold text-blue-900">Mengapa Survei Penting?</h4>
            <ul class="list-disc pl-6 space-y-4">
                <li>
                    <strong>Perspektif Beragam:</strong> Masing-masing kelompok memiliki pandangan unik tentang pengalaman dan kualitas pendidikan.
                </li>
                <li>
                    <strong>Adaptasi Terhadap Perubahan:</strong> Kebutuhan dan harapan stakeholder dapat berubah seiring waktu, dipengaruhi oleh teknologi, tren pendidikan, dan tantangan sosial.
                </li>
                <li>
                    <strong>Transparansi dan Akuntabilitas:</strong> Melibatkan stakeholder dalam proses evaluasi menunjukkan komitmen perguruan tinggi untuk mendengarkan dan bertindak.
                </li>
                <li>
                    <strong>Reputasi Institusi:</strong> Survei kepuasan yang positif dapat meningkatkan citra perguruan tinggi di mata masyarakat.
                </li>
            </ul>
            
            <div class="bg-blue-50 p-6 rounded-xl my-6">
                <h4 class="text-xl font-semibold text-blue-900 mb-4">Dampak Jangka Panjang</h4>
                <p>
                    Reputasi sebuah perguruan tinggi memiliki dampak besar pada daya tarik bagi mahasiswa baru, dosen berkualitas, dana penelitian, dan kemitraan bisnis.
                </p>
            </div>
        </div>
    </div>
</div>

<footer class="bg-blue-900 text-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h4 class="text-xl font-bold mb-6">Tentang Kami</h4>
                <p class="text-gray-300 leading-relaxed">
                    Survei UMRAH adalah platform untuk mengumpulkan dan menganalisis feedback 
                    demi peningkatan kualitas pelayanan perguruan tinggi.
                </p>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-6">Kontak</h4>
                <div class="space-y-4 text-gray-300">
                    <p class="flex items-center">
                        <i class="far fa-envelope mr-3"></i>
                        email@umrah.ac.id
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-phone mr-3"></i>
                        (0771) 4500089
                    </p>
                </div>
            </div>
            <div>
                <h4 class="text-xl font-bold mb-6">Ikuti Kami</h4>
                <div class="flex space-x-6">
                    <a href="<?= base_url('https://www.facebook.com/official.umrah.page/') ?>" 
                       class="hover:text-blue-300 transition duration-200">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="<?= base_url('https://www.youtube.com/@umrahtv.official') ?>" 
                       class="hover:text-red-400 transition duration-200">
                        <i class="fab fa-youtube fa-2x"></i>
                    </a>
                    <a href="<?= base_url('https://www.instagram.com/umrah.official') ?>" 
                       class="hover:text-pink-400 transition duration-200">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="<?= base_url('https://www.linkedin.com/school/univ-maritim-raja-ali-haji/') ?>" 
                       class="hover:text-blue-300 transition duration-200">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-blue-800 text-center text-gray-300">
            &copy; 2024 <a href="<?= base_url('/') ?>" class="hover:text-white font-semibold transition duration-200">
                Survei UMRAH
            </a>. All rights reserved.
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    function openModal() {
        document.getElementById('aboutModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('aboutModal').classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('aboutModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
</body>
</html>