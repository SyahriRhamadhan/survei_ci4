<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei UMRAH - <?= $title ?? 'Dashboard' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jersey-m54" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        .navbar-title {
            font-family: 'Jersey M54', sans-serif;
            font-size: 25px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo Container -->
            <div class="p-6 flex justify-center items-center border-b border-gray-100">
                <div class="flex flex-col items-center space-y-3">
                     <a href="<?= base_url('/') ?>">
                         <img src="<?= base_url('assets/images/sidebar-logo.png') ?>" alt="UMRAH Logo" class="h-24 w-auto hover:opacity-80 transition-opacity">
                    </a>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-8 flex-1">
                <div class="px-4 mb-4">
                    <h2 class="text-xs uppercase tracking-wider text-gray-500 font-semibold px-3">Menu Utama</h2>
                </div>
                
                <!-- Dashboard Link -->
                <a href="<?= base_url('admin/dashboard') ?>" 
                   class="group flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-300 ease-in-out transform hover:translate-x-2 
                   <?= base_url('/responden/dashboard') ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-600' : '' ?>">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <!-- Survei Layanan Link -->
                <a href="<?= base_url('admin/survei-layanan') ?>" 
                   class="group flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-300 ease-in-out transform hover:translate-x-2
                   <?= url_is('admin/survei-layanan*') ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-600' : '' ?>">
                    <i class="fas fa-star w-5"></i>
                    <span class="ml-3">Survei Kepuasan Layanan</span>
                </a>
                
                <!-- Survei UPPS Link -->
                <a href="<?= base_url('admin/survei-upps') ?>" 
                   class="group flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-300 ease-in-out transform hover:translate-x-2
                   <?= url_is('admin/survei-upps*') ? 'bg-blue-50 border-r-4 border-blue-500 text-blue-600' : '' ?>">
                    <i class="fas fa-university w-5"></i>
                    <span class="ml-3">Survei Kepuasan UPPS</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <div class="bg-blue-900 shadow-sm">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <a class="navbar-title text-white" href="<?= base_url('/') ?>">SURVEI UMRAH</a>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" 
                                       placeholder="Cari..." 
                                       class="px-4 py-2 rounded-lg border w-64 focus:outline-none focus:ring-2 focus:ring-white transition-all duration-300">
                                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 mx-6 my-4 transform transition-all duration-300 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-gray-800 text-center">
                    Selamat Datang di Survei Universitas Maritim Raja Ali Haji
                </h3>
            </div>

            <!-- Content Section -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown') && !event.target.closest('button')) {
                const dropdowns = document.querySelectorAll('.dropdown:not(.hidden)');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        }
    </script>
</body>
</html>