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
    <form>
        <?= csrf_field() ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <h3 class="text-dark font-weight-medium">Cek Hasil Berdasarkan Filter</h3>
                        <div class="row">
                            <!-- Tambahkan Select Jenis Layanan -->
                            <div class="col-md-3">
                                <div class="input-style-1 mt-3">
                                    <label class="text-dark mb-2 fs-6">Jenis Layanan</label>
                                    <select class="form-control fs-6" id="jenis_unit" name="jenis_unit" onchange="filterJenisLayanan2()">
                                        <option value=""></option>
                                        <option value="UPPS">UPPS</option>
                                        <option value="Unit Layanan">Unit Layanan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-style-1 mt-3">
                                    <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                    <svg data-toggle="tooltip" title="Jika Kosong/Tak Tampil Berarti Survei Tidak Tersedia" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M12 9h.01" />
                                        <path d="M11 12h1v4h1" />
                                    </svg>
                                    <select class="form-control fs-6" id="unit_layanan2" name="unit_layanan" onchange="filterJenisLayanan2()">
                                        <option value=""></option>
                                        <?php
                                        $unitSeen = [];
                                        foreach ($unitList as $unit):
                                            if (in_array($unit['nama_unit'], $unitSeen)) {
                                                continue;
                                            }
                                            $unitSeen[] = $unit['nama_unit'];
                                        ?>
                                            <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                                <?= htmlspecialchars($unit['nama_unit']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-style-1 mt-3">
                                    <!-- Tambahkan tooltip pada label -->
                                    <label class="text-dark mb-2 fs-6">
                                        Jenis Layanan yang Diterima
                                    </label>
                                    <svg data-toggle="tooltip" title="Jika Kosong/Tak Tampil Berarti Survei Tidak Tersedia" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                        <path d="M12 9h.01" />
                                        <path d="M11 12h1v4h1" />
                                    </svg>

                                    <select class="form-control fs-6" id="jenis_layanan_yang_diterima2" name="jenis_layanan_yang_diterima">
                                        <option value=""></option>
                                        <?php foreach ($unitList as $unit): ?>
                                            <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                                <option class="jenis-option2" value="<?= htmlspecialchars($unit['id']) ?>" data-unit2="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_unit']) ?>">
                                                    <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-success" onclick="goToDetail2()">Cek Survei</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function filterJenisLayanan2() {
            const jenisLayanan = document.getElementById('jenis_unit').value;
            const unitLayanan = document.getElementById('unit_layanan2').value;
            const jenisLayananSelect = document.getElementById('jenis_layanan_yang_diterima2');
            const jenisOptions = document.querySelectorAll('.jenis-option2');

            jenisLayananSelect.value = '';
            jenisOptions.forEach(option => {
                // Filter berdasarkan jenis layanan dan unit layanan
                const optionJenis = option.getAttribute('data-jenis');
                const optionUnit = option.getAttribute('data-unit2');
                option.style.display = (optionJenis === jenisLayanan && optionUnit === unitLayanan) ? 'block' : 'none';
            });
        }

        function goToDetail2() {
            const unitLayanan = document.getElementById('unit_layanan2').value;
            const jenisLayananYangDiterima = document.getElementById('jenis_layanan_yang_diterima2').value;

            if (unitLayanan && jenisLayananYangDiterima) {
                const url = `<?= base_url('responden/chartfilter') ?>/${jenisLayananYangDiterima}`;
                window.location.href = url;
            } else {
                alert("Silakan pilih Jenis Layanan, Unit Layanan, dan Jenis Layanan yang Diterima terlebih dahulu.");
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>


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
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                <sup class="set-doller"></sup><?= $averageIKM; ?>%
                            </h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Rata-Rata IKM UMRAH</h6>
                        </div>

                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                                    </svg>
                                </i></span>
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
                            <span class="opacity-7 text-muted"><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                        <rect height="4" rx="1" ry="1" width="8" x="8" y="2" />
                                    </svg></i></span>
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
                    <canvas id="barChartGender" width="40" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Keseluruhan Pengguna Layanan Survei</h4>
                    <div class="d-flex align-items-center">
                        <!-- Canvas untuk Chart -->
                        <div style="flex: 1;">
                            <canvas id="doughnutChart" width="150" height="150"></canvas>
                        </div>
                        <!-- List keterangan disamping chart -->
                        <div style="flex: 1;">
                            <ul class=" mb-0 ms-3">
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
            </div>
        </div>

        <!-- Grafik Fakultas Dosen -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asal Fakultas Responden Dosen</h4>
                    <canvas id="barChartFakultasDosen" width="850" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Program Studi Mahasiswa -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asal Program Studi Responden Mahasiswa</h4>
                    <canvas id="barChartProdiMahasiswa" width="1800" height="900"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Unit Kerja Tendik -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asal Unit Kerja Responden Tendik</h4>
                    <canvas id="barChartUnitTendik" width="4900" height="1600"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Indeks Kepuasan Mayarakat (IKM) Berdasarkan Nama Unit Kerja</h4>
                    <canvas id="ikmChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Indeks Kepuasan Mayarakat (IKM) Berdasarkan Pelayanan Yang diberikan</h4>

                    <div id="chart"></div>

                </div>
            </div>
        </div>
    </div>


</div>
<style>
    #chart,
    #ikmChart {
        overflow-x: scroll;
        white-space: nowrap;
    }
</style>



<script>
    // Data dari Controller
    const labels = <?= $ikmUnitLabels; ?>;
    const data = <?= $ikmUnitData; ?>;

    // Setting ukuran chart
    const margin = {
            top: 40,
            right: 10,
            bottom: 470,
            left: 50
        },
        width = 1800 - margin.left - margin.right,
        height = 900 - margin.top - margin.bottom;

    // Membuat SVG
    const svg = d3.select("#chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left}, ${margin.top})`);


    // Skala X dan Y
    const x = d3.scaleBand()
        .domain(labels)
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data)])
        .nice()
        .range([height, 0]);

    svg.append("g")
        .attr("class", "x-axis")
        .attr("transform", `translate(0, ${height})`) // Menambahkan translate untuk sumbu X
        .call(d3.axisBottom(x))
        .selectAll("text") // Mengatur rotasi teks di sumbu X
        .attr("transform", "rotate(-85)") // Rotasi teks
        .style("text-anchor", "end")
        .attr("dx", "-5") // Menambah jarak horizontal di akhir label
        .attr("dy", "-8")
        .style("font-size", "11px");

    svg.append("g")
        .attr("class", "y-axis")
        .call(d3.axisLeft(y));

    // Membuat barchart
    svg.selectAll(".bar")
        .data(data)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", (d, i) => x(labels[i]))
        .attr("y", d => y(d))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d))
        .attr("fill", "steelblue");

    // Label nilai pada bar
    svg.selectAll(".text")
        .data(data)
        .enter()
        .append("text")
        .attr("class", "label")
        .attr("x", (d, i) => x(labels[i]) + x.bandwidth() / 5 + 15) // Menambah 5 untuk menggeser ke kanan
        .attr("y", d => y(d) - 0) // Menempatkan label sedikit lebih tinggi
        .attr("text-anchor", "middle")
        .text(d => d.toFixed(2))
        .style("font-size", "11px")
        .attr("transform", function(d, i) {
            const xPos = x(labels[i]) + x.bandwidth() / 2 - 5; // Geser ke kanan
            const yPos = y(d) - 10;
            return `rotate(-90, ${xPos}, ${yPos})`; // Rotasi 90 derajat pada titik baru
        });
</script>
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
            cutout: '80%', // Menentukan lebar bagian tengah (misalnya 70%)
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

    // Grafik Fakultas Dosen
    var ctxFakultasDosen = document.getElementById('barChartFakultasDosen').getContext('2d');
    new Chart(ctxFakultasDosen, {
        type: 'bar',
        data: {
            labels: <?= $fakultasDosenLabels ?>,
            datasets: [{
                label: 'Jumlah Responden <?= $respondenByKategori['dosen'] ?? 0; ?>',
                data: <?= $fakultasDosenData ?>,
                backgroundColor: '#3498db'
            }]
        },
        options: {
            indexAxis: 'y', // Membuat grafik horizontal
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Program Studi Mahasiswa
    var ctxProdiMahasiswa = document.getElementById('barChartProdiMahasiswa').getContext('2d');
    new Chart(ctxProdiMahasiswa, {
        type: 'bar',
        data: {
            labels: <?= $prodiMahasiswaLabels ?>,
            datasets: [{
                label: 'Jumlah Responden <?= $respondenByKategori['mahasiswa'] ?? 0; ?>',
                data: <?= $prodiMahasiswaData ?>,
                backgroundColor: '#2ecc71'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Unit Kerja Tendik
    var ctxUnitTendik = document.getElementById('barChartUnitTendik').getContext('2d');
    new Chart(ctxUnitTendik, {
        type: 'bar',
        data: {
            labels: <?= $unitTendikLabels ?>,
            datasets: [{
                label: 'Jumlah Responden <?= $respondenByKategori['tendik'] ?? 0; ?>',
                data: <?= $unitTendikData ?>,
                backgroundColor: '#e74c3c'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });

    const ikmLabels = <?php echo $ikmLabels; ?>;
    const ikmValues = <?php echo $ikmValues; ?>;

    // Inisialisasi chart IKM
    const ctxIkm = document.getElementById('ikmChart').getContext('2d');
    new Chart(ctxIkm, {
        type: 'bar',
        data: {
            labels: ikmLabels,
            datasets: [{
                label: 'Nilai IKM',
                data: ikmValues,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'IKM'
                    }
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>