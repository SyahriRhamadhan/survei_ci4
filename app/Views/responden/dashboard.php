<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>

<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h3 class="page-title text-truncate  text-center text-dark font-weight-medium mb-1">Selamat Datang di Survei Universitas Maritim Raja Ali Haji</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium"><?= esc($totalResponden) ?></h2>
                                <span class="badge <?= esc($percentageClass) ?> font-12 text-white font-weight-medium rounded-pill ms-2 d-md-none d-lg-block">
                                    <?= esc($percentageSymbol) ?><?= number_format(abs($percentageChange), 2) ?>%
                                </span>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Responden</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <!-- <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                    class="set-doller"></sup>80%</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rata Rata Kepuasan
                            </h6> -->
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium"><?= esc($totalSurveiOn) ?></h2>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Survei Berjalan
                            </h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium"><?= esc($responseHariIni) ?></h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Responden Hari Ini</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End First Cards -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Sales Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Jumlah Responden Berdasarkan Jenis Kelamin</h4>
                    <canvas id="barChartGender" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Keseluruhan Pengguna Layanan Survei</h4>
                    <canvas id="doughnutChart" width="400" height="400"></canvas>
                    <ul class="list-style-none mb-0">
                        <li>
                            <i class="fas fa-circle" style="color: #FF5733;"></i>
                            <span class="text-muted">Mahasiswa</span>
                            <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['mahasiswa'] ?? 0; ?></span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle" style="color: #33FF57;"></i>
                            <span class="text-muted">Dosen</span>
                            <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['dosen'] ?? 0; ?></span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle" style="color: #3357FF;"></i>
                            <span class="text-muted">Tendik</span>
                            <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['tendik'] ?? 0; ?></span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle" style="color: #F1C40F;"></i>
                            <span class="text-muted">Mitra</span>
                            <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['mitra'] ?? 0; ?></span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle" style="color: #9B59B6;"></i>
                            <span class="text-muted">Umum</span>
                            <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['umum'] ?? 0; ?></span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Net Income</h4> -->
                    <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                    <ul class="list-inline text-center mt-5 mb-2">
                        <!-- <li class="list-inline-item text-muted fst-italic">Sales for this month</li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Earning by Location</h4>
                    <div class="" style="height:180px">
                        <div id="visitbylocate" style="height:100%"></div>
                    </div>
                    <div class="row mb-3 align-items-center mt-1 mt-5">
                        <div class="col-4 text-end">
                            <span class="text-muted font-14">India</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-4 text-end">
                            <span class="text-muted font-14">UK</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-4 text-end">
                            <span class="text-muted font-14">USA</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4 text-end">
                            <span class="text-muted font-14">China</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    var ctx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= $chartLabels ?>, // Menampilkan label kategori responden
            datasets: [{
                label: 'Jumlah Responden',
                data: <?= $chartValues ?>, // Menampilkan jumlah responden per kategori
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6'], // Pilih warna yang sesuai
                borderColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' responden';
                        }
                    }
                }
            }
        }
    });

    var ctxGender = document.getElementById('barChartGender').getContext('2d');
    var barChartGender = new Chart(ctxGender, {
        type: 'bar',
        data: {
            labels: <?= $chartLabelsGender ?>, // Labels untuk jenis kelamin
            datasets: [{
                label: 'Jumlah Responden',
                data: <?= $chartValuesGender ?>, // Data jumlah responden per jenis kelamin
                backgroundColor: ['#3498DB', '#E74C3C'], // Warna untuk masing-masing jenis kelamin
                borderColor: ['#2980B9', '#C0392B'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' responden';
                        }
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>