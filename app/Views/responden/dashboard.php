<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>

<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h3 class="page-title  text-center text-dark font-weight-medium mb-1">Selamat Datang di Survei Universitas Maritim Raja Ali Haji (UMRAH)</h3>
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
                                    <i class="fas fa-circle" style="color: rgba(255, 99, 132, 0.5);"></i>
                                    <span class="text-muted">Mahasiswa</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['mahasiswa'] ?? 0; ?></span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle" style="color: rgba(54, 162, 235, 0.5);"></i>
                                    <span class="text-muted">Dosen</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['dosen'] ?? 0; ?></span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle" style="color:  rgba(255, 206, 86, 0.5);"></i>
                                    <span class="text-muted">Tendik</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['tendik'] ?? 0; ?></span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle" style="color: rgba(75, 192, 192, 0.5);;"></i>
                                    <span class="text-muted">Mitra</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['mitra'] ?? 0; ?></span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle" style="color:  rgb(204, 178, 255);;"></i>
                                    <span class="text-muted">Umum</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['umum'] ?? 0; ?></span>
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle" style="color: rgb(255,207,159);"></i>
                                    <span class="text-muted">Alumni</span>
                                    <span class="text-dark float-end font-weight-medium"><?= $respondenByKategori['alumni'] ?? 0; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <?php if (isset($filter2['value']) && $filter2['value'] === 'on'): ?>
                <div class="row m-2 justify-content-center">
                    <div class="card col-md-6">
                        <div class="card-body">
                            <h4 class="card-title text-start">Hasil Survei Tingkat Unit Layanan</h4>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cek Survei
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p></p>
            <?php endif; ?>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalToggleLabel">Filter Hasil Survei</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div id="example-table1"></div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.5.1/js/tabulator.min.js"></script>

                                    <script>
                                        // Tabulator configuration
                                        var table = new Tabulator("#example-table1", {
                                            height: "500px",
                                            layout: "fitColumns",
                                            columns: [{
                                                    title: "No",
                                                    field: "no",
                                                    width: 50,
                                                    headerFilter: "input"
                                                },
                                                {
                                                    title: "Judul",
                                                    field: "judul",
                                                    headerFilter: "input"
                                                },
                                                {
                                                    title: "Nama Unit",
                                                    field: "nama_unit",
                                                    headerFilter: "input"
                                                },
                                                {
                                                    title: "Jenis Unit",
                                                    field: "jenis_unit",
                                                    headerFilter: "input"
                                                },
                                                {
                                                    title: "Jenis Layanan/Prodi",
                                                    field: "jenis_layanan",
                                                    headerFilter: "input"
                                                },
                                                {
                                                    title: "Cek Hasil",
                                                    field: "cek_hasil",
                                                    formatter: "html",
                                                    headerFilter: false
                                                },
                                            ],
                                            data: [
                                                <?php foreach ($unitList as $no => $s) : ?> {
                                                        no: <?= $no + 1 ?>,
                                                        judul: "<?= htmlspecialchars($s['judul']) ?>",
                                                        nama_unit: "<?= htmlspecialchars($s['nama_unit']) ?>",
                                                        jenis_unit: "<?= htmlspecialchars($s['jenis_unit']) ?>",
                                                        jenis_layanan: "<?= htmlspecialchars($s['jenis_layanan_yang_diterima']) ?>",
                                                        cek_hasil: '<a href="<?= base_url('responden/chartfilter/' . $s['id']) ?>" class="btn btn-primary">Hasil Survei</a>',
                                                    }
                                                    <?php if ($no !== count($unitList) - 1) echo ','; ?>
                                                <?php endforeach; ?>
                                            ],
                                        });
                                    </script>
                                </div>
                            </div>
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

    // Gabungkan labels dan data dalam array objek
    const combinedData = labels.map((label, index) => {
        return {
            label: label,
            value: data[index]
        };
    });

    // Mengelompokkan berdasarkan kategori (misalnya 'BAPKK', 'FEBM', dll.)
    const groupedData = {};
    combinedData.forEach(item => {
        const category = item.label.split(' - ')[0]; // Mengambil kategori sebelum tanda '-'
        if (!groupedData[category]) {
            groupedData[category] = [];
        }
        groupedData[category].push(item);
    });

    // Urutkan setiap kategori berdasarkan nilai secara menurun
    Object.keys(groupedData).forEach(category => {
        groupedData[category].sort((a, b) => b.value - a.value);
    });

    // Mengurutkan kategori berdasarkan nilai tertinggi di dalam kategori
    const sortedCategories = Object.keys(groupedData).sort((a, b) => {
        const sumA = groupedData[a].reduce((acc, item) => acc + item.value, 0);
        const sumB = groupedData[b].reduce((acc, item) => acc + item.value, 0);
        return sumB - sumA; // Mengurutkan kategori berdasarkan total nilai tertinggi
    });

    // Flatten data kembali ke dalam array dengan urutan kategori dan nilai yang benar
    const finalSortedData = [];
    sortedCategories.forEach(category => {
        finalSortedData.push(...groupedData[category]);
    });

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
        .domain(finalSortedData.map(d => d.label))
        .range([0, width])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(finalSortedData, d => d.value)])
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

    // Warna bergantian antara biru tua dan biru muda
    const getColor = (index) => {
        return index % 2 === 0 ? "#1f77b4" : "#add8e6"; // Biru tua untuk indeks genap, biru muda untuk ganjil
    };

    // Membuat barchart dengan warna bergantian
    svg.selectAll(".bar")
        .data(finalSortedData)
        .enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", (d, i) => x(d.label))
        .attr("y", d => y(d.value))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.value))
        .attr("fill", (d, i) => getColor(i)); // Set warna berdasarkan indeks

    // Label nilai pada bar
    svg.selectAll(".text")
        .data(finalSortedData)
        .enter()
        .append("text")
        .attr("class", "label")
        .attr("x", (d, i) => x(d.label) + x.bandwidth() / 5 + 15) // Menambah 5 untuk menggeser ke kanan
        .attr("y", d => y(d.value) - 0) // Menempatkan label sedikit lebih tinggi
        .attr("text-anchor", "middle")
        .text(d => d.value.toFixed(2))
        .style("font-size", "11px")
        .attr("transform", function(d, i) {
            const xPos = x(d.label) + x.bandwidth() / 2 - 5; // Geser ke kanan
            const yPos = y(d.value) - 10;
            return `rotate(-90, ${xPos}, ${yPos})`; // Rotasi 90 derajat pada titik baru
        });
</script>


<!-- <script>
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
</script> -->
<script>
    var ctx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= $chartLabels ?>, // Menampilkan label kategori responden
            datasets: [{
                label: 'Jumlah Responden',
                data: <?= $chartValues ?>, // Menampilkan jumlah responden per kategori
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 4
            }]

        },
        options: {
            responsive: true,
            cutout: '50%', // Menentukan lebar bagian tengah (misalnya 70%)
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
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
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