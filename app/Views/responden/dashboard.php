<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="p-6">
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Responden</p>
                    <h3 class="text-2xl font-bold mt-1">2,547</h3>
                    <p class="text-green-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-blue-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Rata-rata Kepuasan</p>
                    <h3 class="text-2xl font-bold mt-1">87%</h3>
                    <p class="text-green-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i> 3% dari bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-smile text-green-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Survei Aktif</p>
                    <h3 class="text-2xl font-bold mt-1">12</h3>
                    <p class="text-gray-500 text-sm mt-2">Total survei berjalan</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-purple-500"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Respons Hari Ini</p>
                    <h3 class="text-2xl font-bold mt-1">124</h3>
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-arrow-down mr-1"></i> 5% dari kemarin
                    </p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Status Pengisian</h3>
                <select class="px-3 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="updateLoadingChart(this.value)">
                    <option value="all">Semua Survei</option>
                    <option value="service">Survei Layanan</option>
                    <option value="upps">Survei UPPS</option>
                </select>
            </div>
            <canvas id="loadingChart" class="max-h-80"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Statistik Responden</h3>
                <select class="px-3 py-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="updateBarChart(this.value)">
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                </select>
            </div>
            <canvas id="barChart" class="max-h-80"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow col-span-1 lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Tren Kepuasan</h3>
                <div class="flex items-center space-x-2">
                    <button onclick="updateLineChart('daily')" class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm transition-colors">Harian</button>
                    <button onclick="updateLineChart('weekly')" class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 text-sm transition-colors">Mingguan</button>
                    <button onclick="updateLineChart('monthly')" class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm transition-colors">Bulanan</button>
                </div>
            </div>
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Charts initialization
    const loadingChart = new Chart(
        document.getElementById('loadingChart'),
        {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Dalam Proses', 'Belum Mulai'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        }
    );

    const barChart = new Chart(
        document.getElementById('barChart'),
        {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
                datasets: [{
                    label: 'Responden',
                    data: [65, 59, 80, 81, 56],
                    backgroundColor: '#2196F3',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    );

    const lineChart = new Chart(
        document.getElementById('lineChart'),
        {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Tingkat Kepuasan',
                    data: [85, 87, 84, 86, 89, 88, 87, 90, 88, 87, 86, 87],
                    borderColor: '#2196F3',
                    backgroundColor: 'rgba(33, 150, 243, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 80,
                        max: 100,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    );

    // Chart update functions
    function updateLoadingChart(surveyType) {
        // Example data - in production, this would fetch from backend
        const data = {
            'all': [65, 25, 10],
            'service': [70, 20, 10],
            'upps': [60, 30, 10]
        };
        
        loadingChart.data.datasets[0].data = data[surveyType];
        loadingChart.update();
    }

    function updateBarChart(timeframe) {
        // Example data - in production, this would fetch from backend
        const data = {
            'week': [65, 59, 80, 81, 56],
            'month': [70, 65, 85, 75, 60],
            'year': [75, 70, 90, 85, 65]
        };
        
        barChart.data.datasets[0].data = data[timeframe];
        barChart.update();
    }

    function updateLineChart(period) {
        // Example data - in production, this would fetch from backend
        const data = {
            'daily': {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                data: [87, 85, 88, 86, 89, 87, 88]
            },
            'weekly': {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                data: [85, 87, 84, 86, 89, 88, 87, 90, 88, 87, 86, 87]
            },
            'monthly': {
                labels: ['2023', '2024'],
                data: [86, 88]
            }
        };
        
        lineChart.data.labels = data[period].labels;
        lineChart.data.datasets[0].data = data[period].data;
        lineChart.update();
        
        // Update button styles
        const buttons = document.querySelectorAll('[onclick^="updateLineChart"]');
        buttons.forEach(button => {
            if (button.getAttribute('onclick').includes(period)) {
                button.classList.remove('bg-gray-100');
                button.classList.add('bg-blue-500', 'text-white');
            } else {
                button.classList.remove('bg-blue-500', 'text-white');
                button.classList.add('bg-gray-100');
            }
        });
    }
</script>
<?= $this->endSection() ?>