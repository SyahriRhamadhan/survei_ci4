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

     <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Kategori Pengguna Layanan Chart -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Kategori Pengguna Layanan</h3>
            <canvas id="kategoriChart" class="max-h-80"></canvas>
        </div>

        <!-- Jenis Kelamin Charts -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Jenis Kelamin</h3>
            <canvas id="genderChart" class="max-h-80"></canvas>
        </div>

        <!-- Angkatan Responden Chart 
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Angkatan Responden Mahasiswa</h3>
            <canvas id="angkatanChart" class="max-h-80"></canvas>
        </div>

        <!-- Fakultas Dosen Chart 
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Asal Fakultas Responden Dosen</h3>
            <canvas id="departemenChart" class="max-h-80"></canvas>
        </div>

        <!-- Fakultas 
        <div class="bg-white p-6 rounded-xl shadow col-span-1 lg:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Asal Program Studi Responden Mahasiswa</h3>
            <div style="height: 400px;">
                <canvas id="prodiChart"></canvas>
            </div>
        </div>

        <!-- Leadership Assessment Chart with fixed height
        <div class="bg-white p-6 rounded-xl shadow col-span-1 lg:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Penilaian Terkait Pimpinan FEB UI, 2023 (Skala 1-4)</h3>
            <div style="height: 400px;">
                <canvas id="leadershipChart"></canvas>
            </div>
        </div>
        -->
    </div>
</div>

<script>
// Kategori Pengguna Layanan Chart
const kategoriData = <?= json_encode(array_column($kategoriRespondenData, 'total')) ?>;
const kategoriLabels = <?= json_encode(array_column($kategoriRespondenData, 'kategori_responden')) ?>;
const kategoriChart = new Chart(
    document.getElementById('kategoriChart'),
    {
        type: 'bar',
        data: {
            labels: kategoriLabels,
            datasets: [{
                data: kategoriData,
                backgroundColor: ['#60A5FA', '#DC2626', '#15803D'],
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    }
);

// Jenis Kelamin Chart
const genderData = <?= json_encode(array_column($jenisKelaminData, 'total')) ?>;
const genderLabels = <?= json_encode(array_column($jenisKelaminData, 'jenis_kelamin')) ?>;

const genderChart = new Chart(
    document.getElementById('genderChart'),
    {
        type: 'doughnut',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ['#60A5FA', '#DC2626']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    }
);

// Angkatan Responden Chart
const angkatanChart = new Chart(
    document.getElementById('angkatanChart'),
    {
        type: 'bar',
        data: {
            labels: ['2023', '2022', '2021', '2020', 'Other'],
            datasets: [{
                data: [47, 16, 23, 9, 1],
                backgroundColor: '#60A5FA',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
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
            }
        }
    }
);

// Departemen Chart
const departemenChart = new Chart(
    document.getElementById('departemenChart'),
    {
        type: 'bar',
        data: {
            labels: ['Departemen Manajemen', 'Departemen Ilmu Ekonomi', 'Departemen Akuntansi'],
            datasets: [{
                data: [35, 7, 6],
                backgroundColor: '#60A5FA',
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    }
);

// Program Studi Chart
const prodiChart = new Chart(
    document.getElementById('prodiChart'),
    {
        type: 'bar',
        data: {
            labels: [
                'S2 MPKP', 'S1 Manajemen', 'S1 Akuntansi', 'S2 Maksi/PPAk',
                'S1 Ilmu Ekonomi', 'S2 MM', 'S1 Bisnis Islam', 'S2 PPIM',
                'S1 Ekstensi Akuntansi', 'S2 MEKK', 'S1 Ilmu Ekonomi Islam'
            ],
            datasets: [{
                data: [16, 15, 11, 9, 8, 6, 5, 5, 4, 4, 2],
                backgroundColor: ['#60A5FA', '#DC2626', '#15803D'],
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    }
);// Leadership Assessment Chart
const leadershipChart = new Chart(
    document.getElementById('leadershipChart'),
    {
        type: 'bar',
        data: {
            labels: [
                'Visi-Misi FEB UI sudah tersosialisasikan dengan baik',
                'Visi-Misi FEB UI selaras dengan kepentingan FEB UI dan masyarakat Indonesia',
                'Program kerja Dekan FEB UI sudah tersosialisasikan dengan baik',
                'Program kerja Dekan FEB UI sesuai dengan kebutuhan civitas akademika FEB UI',
                'Program kerja Dekan FEB UI akan berhasil merealisasikan Visi-Misi FEB UI'
            ],
            datasets: [
                {
                    label: 'Tidak Tahu',
                    data: [4.2, 2, 1, 3, 3],
                    backgroundColor: '#6B7280', // gray-500
                    borderRadius: 5
                },
                {
                    label: 'Tidak Setuju',
                    data: [5.2, 1, 3, 2, 1],
                    backgroundColor: '#DC2626', // red-600
                    borderRadius: 5
                },
                {
                    label: 'Kurang Setuju',
                    data: [12, 4, 16, 10, 7],
                    backgroundColor: '#65A30D', // lime-600
                    borderRadius: 5
                },
                {
                    label: 'Setuju',
                    data: [57, 63, 57, 62, 66],
                    backgroundColor: '#2563EB', // blue-600
                    borderRadius: 5
                },
                {
                    label: 'Sangat Setuju',
                    data: [27, 30, 22, 23, 23],
                    backgroundColor: '#1E293B', // slate-800
                    borderRadius: 5
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: false
                }
            },
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                y: {
                    stacked: true,
                    grid: {
                        display: false
                    }
                }
            }
        }
    }
);
</script>
<?= $this->endSection() ?>