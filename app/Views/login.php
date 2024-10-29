<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survei UMRAH - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gradient min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Left side - Image -->
            <div class="md:w-1/2 relative hidden md:block">
                <div class="absolute inset-0 bg-gradient opacity-90"></div>
                <img src="<?= base_url('assets/images/big/3.jpg') ?>" alt="Login Background" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-white text-center p-8">
                        <h2 class="text-3xl font-bold mb-4">Selamat Datang!</h2>

                    </div>
                </div>
            </div>
            
            <!-- Right side - Login Form -->
            <div class="md:w-1/2 p-8 md:p-12 glass-effect">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">SURVEI UMRAH</h1>
                    <p class="text-gray-600 mt-2">Masukkan alamat email dan kata sandi Anda</p>
                </div>
                
                <!-- Flash Messages -->
                <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                    <div class="mb-4 p-4 rounded-lg <?= session()->getFlashdata('alert_type') === 'danger' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' ?>" role="alert">
                        <?= session()->getFlashdata('pesan') ?>
                    </div>
                <?php endif ?>

                <!-- Maintaining the original form action and CSRF token -->
                <form class="space-y-6" method="POST" action="<?= base_url('/auth/login') ?>">
                    <?= csrf_field() ?>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                            Alamat Email
                        </label>
                        <input type="email" id="email" name="email" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                               placeholder="Masukan Email Anda">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                            Kata Sandi
                        </label>
                        <input type="password" id="password" name="password"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200"
                               placeholder="Masukan Password Anda">
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox text-blue-600">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lupa kata sandi?</a>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 font-semibold hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden" id="loader">
        <div class="flex items-center justify-center h-full">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>
        </div>
    </div>

    <script>
        // Show/hide loader
        function toggleLoader(show) {
            const loader = document.getElementById('loader');
            loader.classList.toggle('hidden', !show);
        }

        // Form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            toggleLoader(true);
            // Form will submit normally since we removed preventDefault()
        });
    </script>
</body>
</html>