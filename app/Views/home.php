<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survei UMRAH</title>
    <meta name="description" content="Website Survei UMRAH untuk peningkatan kualitas pelayanan perguruan tinggi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #004085;
            --secondary-color: #0056b3;
            --background-color: #f4f4f9;
            --text-color: #333;
            --white: #fff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: var(--transition);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1.5rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: var(--white);
            font-size: 2rem;
            font-weight: 700;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        nav ul li a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: var(--transition);
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .hero-section {
            margin-top: 4rem;
            background-image: url("<?= base_url('assets/images/BG - Home.jpeg') ?>");
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            color: var(--white);
            position: relative; /* This allows positioning of the overlay */
        }

/* Add a dark overlay */
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
            z-index: 1; /* Place overlay below text */
        }

        .hero-content {
            position: relative; /* Ensures the content appears above the overlay */
            z-index: 2;
            max-width: 800px;
        }

        .hero-section h2 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        footer {
            background-color: var(--primary-color);
            color: var(--white);
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            color: var(--white);
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--background-color);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            header {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            nav {
                flex-direction: column;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .hero-section h2 {
                font-size: 2rem;
            }

            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-content">
        <h1>Survei UMRAH</h1>
        <nav>
            <ul>
                <li><a href="<?= base_url('/responden/dashboard') ?>"><i class="fas fa-poll"></i> Survei Sekarang!</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero-section" data-aos="fade-in">
    <div class="hero-content">
        <h2>Selamat Datang di Survei UMRAH</h2>
        <p>Partisipasi Anda sangat berarti dalam meningkatkan kualitas pelayanan di Universitas Maritim Raja Ali Haji. Mari bersama membangun UMRAH yang lebih baik!</p>
        <a href="#survey-section" class="btn">Mulai Survei Sekarang</a>
    </div>
</section>

<div class="container">
    <div id="survey-section" class="card" data-aos="fade-up">
        <i class="fas fa-clipboard-list"></i>
        <h3>Survei Kepuasan</h3>
        <p>Berikan masukan Anda untuk membantu meningkatkan kualitas pelayanan di UMRAH. Setiap pendapat sangat berharga bagi kemajuan institusi.</p>
        <a href="<?= base_url('/responden/dashboard') ?>" class="btn">Mulai Survei</a>
    </div>
</div>

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Tentang Kami</h4>
            <p>Survei UMRAH adalah platform untuk mengumpulkan dan menganalisis feedback demi peningkatan kualitas pelayanan perguruan tinggi.</p>
        </div>
        <div class="footer-section">
            <h4>Kontak</h4>
            <p>Email: email@umrah.ac.id</p>
            <p>Telepon: (0771) 4500089</p>
        </div>
        <div class="footer-section">
            <h4>Ikuti Kami</h4>
            <div class="social-links">
                <a href="<?= base_url('https://www.facebook.com/official.umrah.page/') ?>"><i class="fab fa-facebook"></i></a>
                <a href="<?= base_url('https://www.youtube.com/@umrahtv.official') ?>"><i class="fab fa-youtube"></i></a>
                <a href="<?= base_url('https://www.instagram.com/umrah.official') ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?= base_url('https://www.linkedin.com/school/univ-maritim-raja-ali-haji/') ?>"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <p style="margin-top: 2rem;">&copy; 2024 Survei UMRAH. All rights reserved.</p>
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