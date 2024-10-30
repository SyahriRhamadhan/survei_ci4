<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei UMRAH - <?= $title ?? 'Dashboard' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            background-color: #EDF2F7;
            transform: translateX(10px);
        }
        .chart-container {
            transition: all 0.3s ease;
        }
        .chart-container:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .dropdown {
            display: none;
        }
        .dropdown.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 flex items-center space-x-3">
                <img src="/api/placeholder/48/48" alt="UMRAH Logo" class="w-12 h-12 rounded-full">
                <h1 class="text-xl font-bold text-gray-800">SURVEI UMRAH</h1>
            </div>
            <nav class="mt-6">
                <a href="<?= base_url('admin/dashboard') ?>" class="nav-item flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 <?= url_is('admin/dashboard*') ? 'bg-blue-50 text-blue-600' : '' ?>">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
                <a href="<?= base_url('admin/survei-layanan') ?>" class="nav-item flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 <?= url_is('admin/survei-layanan*') ? 'bg-blue-50 text-blue-600' : '' ?>">
                    <i class="fas fa-star mr-3"></i> Survei Kepuasan Layanan
                </a>
                <a href="<?= base_url('admin/survei-upps') ?>" class="nav-item flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 <?= url_is('admin/survei-upps*') ? 'bg-blue-50 text-blue-600' : '' ?>">
                    <i class="fas fa-university mr-3"></i> Survei Kepuasan UPPS
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <h2 class="text-xl font-semibold text-gray-800"><?= $title ?? 'Dashboard' ?></h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari..." class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                            </div>
                            
                            <!-- Notifications -->
                            <div class="relative">
                                <button class="p-2 rounded-full hover:bg-gray-100">
                                    <i class="fas fa-bell text-gray-600"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- Welcome Message Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 mx-6 my-4">
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
            document.getElementById('profileDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown') && !event.target.closest('button')) {
                var dropdowns = document.getElementsByClassName('dropdown');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
