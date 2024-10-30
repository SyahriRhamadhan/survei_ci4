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
</head>
<body class="bg-gray-100 text-gray-800 font-sans leading-normal tracking-normal">

<header class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-md fixed w-full z-10">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a href="/" class="flex items-center">
            <img src="<?= base_url('assets/images/Header.png') ?>" alt="Survei UMRAH Logo" class="h-20 w-full">
        </a>
        <nav>
            <ul class="flex space-x-6">
                <li>
                    <a href="<?= base_url('/responden/dashboard') ?>" class="hover:text-blue-300 transition duration-200">
                        <i class="fas fa-poll mr-1"></i> Survei Sekarang!
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero-section relative flex items-center justify-center bg-cover bg-center h-screen text-white" 
         style="background-image: url('<?= base_url('assets/images/BG - Home.jpeg') ?>');" data-aos="fade-in">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-center max-w-2xl px-6">
        <h2 class="text-4xl font-extrabold mb-4 drop-shadow-lg">Selamat Datang di Survei UMRAH</h2>
        <p class="text-lg mb-8 drop-shadow-md">
            Partisipasi Anda sangat berarti dalam meningkatkan kualitas pelayanan di Universitas Maritim Raja Ali Haji. Mari bersama membangun UMRAH yang lebih baik!
        </p>
        <a href="#survey-section" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transition duration-200">
            Mulai Survei Sekarang
        </a>
    </div>
</section>

<div class="flex items-center justify-center my-12">
    <div id="survey-section" class="bg-white rounded-lg shadow-lg p-8 text-center max-w-lg" data-aos="fade-up">
        <i class="fas fa-clipboard-list text-5xl text-blue-900 mb-4"></i>
        <h3 class="text-2xl font-semibold text-blue-900 mb-4">Survei Kepuasan</h3>
        <p class="text-gray-700 mb-6">
            Berikan masukan Anda untuk membantu meningkatkan kualitas pelayanan di UMRAH. Setiap pendapat sangat berharga bagi kemajuan institusi.
        </p>
        <a href="<?= base_url('/responden/dashboard') ?>" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
            Mulai Survei
        </a>
    </div>
</div>

<footer class="bg-blue-900 text-white py-8">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-6 text-center md:text-left">
        <div>
            <h4 class="text-lg font-semibold mb-4">Tentang Kami</h4>
            <p>Survei UMRAH adalah platform untuk mengumpulkan dan menganalisis feedback demi peningkatan kualitas pelayanan perguruan tinggi.</p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">Kontak</h4>
            <p>Email: email@umrah.ac.id</p>
            <p>Telepon: (0771) 4500089</p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
            <div class="flex justify-center md:justify-start space-x-4">
                <a href="<?= base_url('https://www.facebook.com/official.umrah.page/') ?>" class="hover:text-blue-300"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="<?= base_url('https://www.youtube.com/@umrahtv.official') ?>" class="hover:text-blue-300"><i class="fab fa-youtube fa-2x"></i></a>
                <a href="<?= base_url('https://www.instagram.com/umrah.official') ?>" class="hover:text-blue-300"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="<?= base_url('https://www.linkedin.com/school/univ-maritim-raja-ali-haji/') ?>" class="hover:text-blue-300"><i class="fab fa-linkedin fa-2x"></i></a>
            </div>
        </div>
    </div>
    <div class="mt-8 text-center text-white-400">
        &copy; 2024 <a href="<?= base_url('/') ?>" class="hover:text-gray-300 font-semibold transition duration-200">Survei UMRAH</a>. All rights reserved.
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
</body>
</html>
