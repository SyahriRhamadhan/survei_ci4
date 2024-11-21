<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row mx-3">
    <div class="container mt-5">
        <div class="row mb-5 ">
            <div class="col-md-6">
                <button class="btn ms-2 btn-success" id="downloadButton">
                    Unduh Hasil
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-jpg">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M11 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                        <path d="M20 15h-1a2 2 0 0 0 -2 2v2a2 2 0 0 0 2 2h1v-3" />
                        <path d="M5 15h3v4.5a1.5 1.5 0 0 1 -3 0" />
                    </svg>
                </button>
                <a href="#download" class="btn ms-2 btn-success">Download as PDF</a>
            </div>
            <div class="col-md-6">
                <form action="<?= base_url('admin/chartfilterunit/' . urlencode($nama_unit)) ?>" method="get">
                    <div class="input-group">
                        <select class="form-select" name="tahun" id="tahun" required>
                            <?php
                            $currentYear = date('Y');
                            for ($year = 2024; $year <= $currentYear; $year++) {
                                $selected = ($tahun == $year) ? 'selected' : '';
                                echo "<option value='$year' $selected>$year</option>";
                            }
                            ?>
                        </select>
                        <button class="btn ms-2 btn-success" type="submit">Terapkan
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div id="halaman1">
        <div class=" mx-3 card downloadhasil">
            <div class="card-label m-3 d-flex justify-content-center align-items-center" style="position: relative; ">
                <img src="<?= base_url('assets/images/logo_umrah.png') ?>" alt="Logo UMRAH" style="width: 100px; height: auto; position: absolute; left: 0;">
                <div class="text-center" style="flex: 1;">
                    <h3 class="fw-bold card-title">INDEKS KEPUASAN MASYARAKAT (IKM)</h3>
                    <h3 class="fw-bold card-title"><?= htmlspecialchars($nama_unit) ?></h3>
                    <h3 class="fw-bold card-title">UNIVERSITAS MARITIM RAJA ALI HAJI (UMRAH)</h3>
                    <h3 class="fw-bold card-title">Priode <?= $tahun ?></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Indeks Kepuasan Masyarakat -->
                    <div class="col-md-6 d-flex">
                        <div class="card flex-fill">
                            <h3 class="card-title text-center fw-bold mt-3">Indeks Kepuasan Masyarakat</h3>
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 60%;">
                                <div class="text-center">
                                    <h2><strong>Nilai IKM:</strong> <?= $ikmUnitDataAvg ?></h2>
                                    <h2 class="mt-2"><strong>Performa Pelayanan:</strong> </h2>
                                    <h2> <?= $kategori ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keseluruhan Pengguna Layanan -->
                    <div class="col-md-6 d-flex">
                        <div class="card border-5 flex-fill">
                            <div class="card-body">
                                <div class="text-center card-title mb-4">
                                    <h3 class="fw-bold">Keseluruhan Pengguna Layanan Survei</h3>
                                    <h3><strong>Total Responden:</strong> <?= $totalResponden ?></h3>
                                </div>
                                <div class="d-flex align-items-center">
                                    <!-- Canvas untuk Chart -->
                                    <div style="flex: 1;">
                                        <canvas id="doughnutChart" width="200" height="200"></canvas>
                                    </div>
                                    <!-- List keterangan disamping chart -->
                                    <div style="flex: 1;">
                                        <ul class="mb-0 ms-3">
                                            <li>
                                                <i class="fas fa-circle" style="color: rgba(255, 99, 132, 0.5);"></i>
                                                <span class="text-muted">Mahasiswa</span>
                                                <span class="text-dark float-end font-weight-medium" id="mahasiswa-count">0</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle" style="color: rgba(54, 162, 235, 0.5);"></i>
                                                <span class="text-muted">Dosen</span>
                                                <span class="text-dark float-end font-weight-medium" id="dosen-count">0</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle" style="color: rgba(255, 206, 86, 0.5);"></i>
                                                <span class="text-muted">Tendik</span>
                                                <span class="text-dark float-end font-weight-medium" id="tendik-count">0</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle" style="color: rgba(75, 192, 192, 0.5);"></i>
                                                <span class="text-muted">Mitra</span>
                                                <span class="text-dark float-end font-weight-medium" id="mitra-count">0</span>
                                            </li>
                                            <li class="mt-3">
                                                <i class="fas fa-circle" style="color: rgba(255, 159, 64, 0.5);"></i>
                                                <span class="text-muted">Umum</span>
                                                <span class="text-dark float-end font-weight-medium" id="umum-count">0</span>
                                            </li>
                                        </ul>

                                        <!-- Display Gender Counts -->
                                        <!-- Gender Counts Section -->
                                        <div class="mt-4 ms-3">
                                            <h5>Jenis Kelamin Responden:</h5>
                                            <ul>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mars">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                        <path d="M19 5l-5.4 5.4" />
                                                        <path d="M19 5l-5 0" />
                                                        <path d="M19 5l0 5" />
                                                    </svg><strong>Laki-laki:</strong> <?= $genderCounts['Laki-laki'] ?? 0 ?></li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-gender-female">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                        <path d="M12 14v7" />
                                                        <path d="M9 18h6" />
                                                    </svg><strong>Perempuan:</strong> <?= $genderCounts['Perempuan'] ?? 0 ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-label text-center">
                <h4 class="fw-bold card-title">TERIMA KASIH ATAS PENILAIAN YANG TELAH ADA BERIKAN </h4>
                <h4 class="fw-bold card-title"> MASUKAN ANDA SANGAT BERMANFAAT UNTUK KEMAJUAN UNIT KAMI AGAR TERUS MEMPERBAIKI</h4>
                <h4 class="fw-bold card-title">DAN MENINGKATKAN KUALITAS PELAYANAN BAGI MASYARAKAT</h4>
                <h4 class="fw-bold card-title">UNIVERSITAS MARITIM RAJA ALI HAJI (UMRAH)</h4>
                <h4 class="fw-bold card-title">Priode <?= $tahun ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ms-3 d-flex">
                <div class="card border-5 flex-fill">
                    <div class="card-body">
                        <h3 class="fw-bold text-center">Tahun Angkatan Responden Mahasiswa</h3>
                        <canvas id="angkatanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex">
                <div class="card border-5 flex-fill">
                    <div class="card-body">
                        <h3 class="fw-bold text-center">Asal Prodi Responden Mahasiswa</h3>
                        <canvas id="prodiChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex">
                <div class="card border-5 flex-fill">
                    <div class="card-body ">
                        <h3 class="fw-bold text-center">Asal Fakultas Responden Dosen</h3>
                        <canvas id="fakultasChart" width="100" height="25"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="halaman2">
        <div class="col-md-12 m-3 d-flex">
            <div class="card border-5 flex-fill">
                <div class="card-body">
                    <h3 class="fw-bold text-center">Asal Unit Kerja Responden Tendik</h3>
                    <canvas id="unitChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 m-3 d-flex">
            <div class="card border-5 flex-fill">
                <div class="card-body">
                    <h3 class="fw-bold text-center">IKM per Jenis Layanan</h3>
                    <canvas id="ikmPerLayananChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div id="halaman3">
        <div class="col-md-12 mx-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Saran dan Masukan dari Responden
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="entriesSelector">Show entries: </label>
                            <select id="entriesSelector" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="kategoriFilter">Kategori </label>
                            <select id="kategoriFilter" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value=""></option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="tendik">Tendik</option>
                                <option value="mitra">Mitra</option>
                                <option value="umum">Umum</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="unitLayananFilter">Unit Layanan </label>
                            <select class="form-select mr-sm-2" id="unitLayananFilter">
                                <option value="">All</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 mx-5" id="respondenTable"></div>
                </div>
            </div>
            <section id="download" class="my-5">
                <button class="btn ms-2 btn-success" id="downloadPdf">Download as PDF</button>
            </section>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.5.1/js/tabulator.min.js"></script>
            <script type="text/javascript">
                // Data dari PHP
                var respondenData = <?= json_encode($respondenData) ?>;
                console.log(respondenData);

                // Mendapatkan nilai unik untuk dropdown Unit Layanan
                var unitLayananValues = [...new Set(respondenData.map(item => item.jenis_layanan_yang_diterima))];

                // Isi Dropdown Unit Layanan
                var unitDropdown = document.getElementById("unitLayananFilter");
                unitLayananValues.forEach(value => {
                    var option = document.createElement("option");
                    option.value = value;
                    option.textContent = value;
                    unitDropdown.appendChild(option);
                });

                // Definisi kolom Tabulator
                var columns = [{
                        title: "Kategori Responden",
                        field: "kategori_responden",
                        width: 200,
                        headerFilter: "input"
                    },
                    {
                        title: "Unit Layanan",
                        field: "jenis_layanan_yang_diterima",
                        width: 200,
                        headerFilter: "input"
                    },
                    {
                        title: "Saran Masukan",
                        field: "saran_masukan",
                        headerFilter: "input"
                    },
                ];

                // Inisialisasi Tabulator
                var table = new Tabulator("#respondenTable", {
                    data: respondenData,
                    layout: "fitColumns",
                    columns: columns,
                    pagination: "local",
                    paginationSize: 10, // Default rows per page
                    paginationSizeSelector: [10, 25, 50, 100, "all"],
                    resizableRows: true,
                    movableColumns: true,
                });
                document.getElementById('kategoriFilter').addEventListener('change', function() {
                    var filterValue = this.value;

                    table.setFilter("kategori_responden", "like", filterValue);
                });

                document.getElementById("unitLayananFilter").addEventListener("change", function() {
                    var filterValue = this.value;
                    table.setFilter("jenis_layanan_yang_diterima", "like", filterValue);
                });

                document.getElementById("entriesSelector").addEventListener("change", function() {
                    var entriesValue = this.value;

                    if (entriesValue === "all") {
                        table.setPageSize(respondenData.length);
                    } else {
                        table.setPageSize(parseInt(entriesValue));
                    }
                });
            </script>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.2/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.getElementById('downloadPdf').addEventListener('click', function() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4',
        });

        function addPageToPDF(element, isLastPage) {
            return html2canvas(element, {
                scale: 2,
                willReadFrequently: true,
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/jpeg', 0.7);
                const pageWidth = 210;
                const pageHeight = 297;
                const imgWidth = pageWidth;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                pdf.addImage(imgData, 'JPEG', 0, 0, imgWidth, imgHeight);

                if (!isLastPage) {
                    pdf.addPage();
                }
            });
        }

        const halaman1 = document.getElementById('halaman1');
        const halaman2 = document.getElementById('halaman2');
        const halaman3 = document.getElementById('halaman3');

        addPageToPDF(halaman1, false)
            .then(() => addPageToPDF(halaman2, false))
            .then(() => addPageToPDF(halaman3, true))
            .then(() => {
                pdf.save('download.pdf');
            });
    });
</script>



<script>
    const ctxUnit = document.getElementById('unitChart').getContext('2d');
    const unitChart = new Chart(ctxUnit, {
        type: 'bar',
        data: {
            labels: JSON.parse('<?= $unitLabels ?>'), // Nama fakultas
            datasets: [{
                label: 'Jumlah Responden Tendik per Unit Kerja <?= $totalUnitResponden ?>',
                data: JSON.parse('<?= $unitCounts ?>'), // Jumlah responden
                backgroundColor: 'rgba(200, 50, 150, 0.2)',
                borderColor: 'rgba(200, 50, 150, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctxFakultas = document.getElementById('fakultasChart').getContext('2d');
    const fakultasChart = new Chart(ctxFakultas, {
        type: 'bar',
        data: {
            labels: JSON.parse('<?= $fakultasLabels ?>'), // Nama fakultas
            datasets: [{
                label: 'Jumlah Responden Dosen per Fakultas <?= $totalFakultasResponden ?>',
                data: JSON.parse('<?= $fakultasCounts ?>'), // Jumlah responden
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctxProdMhs = document.getElementById('prodiChart').getContext('2d');
    const prodiChart = new Chart(ctxProdMhs, {
        type: 'bar',
        data: {
            labels: JSON.parse('<?= $prodiLabels ?>'), // Nama program studi
            datasets: [{
                label: 'Jumlah Responden per Program Studi <?= $totalProdiResponden ?>',
                data: JSON.parse('<?= $prodiCounts ?>'), // Jumlah responden
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctxAngkatan = document.getElementById('angkatanChart').getContext('2d');
    const angkatanChart = new Chart(ctxAngkatan, {
        type: 'bar',
        data: {
            labels: <?= $angkatanLabels ?>,
            datasets: [{
                label: 'Jumlah Responden Mahasiswa',
                data: <?= $angkatanCounts ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                },
            }
        }
    });
</script>
<script>
    const ikmUnitLabels = <?= $ikmUnitLabels ?>;
    const ikmUnitData = <?= $ikmUnitData ?>;

    function groupAndAverageData(labels, data) {
        const groupedData = {};

        for (let i = 0; i < labels.length; i++) {
            if (!groupedData[labels[i]]) {
                groupedData[labels[i]] = [];
            }
            groupedData[labels[i]].push(data[i]);
        }
        const newLabels = [];
        const newData = [];

        for (const label in groupedData) {
            newLabels.push(label);
            const average = groupedData[label].reduce((acc, val) => acc + val, 0) / groupedData[label].length;
            newData.push(average);
        }

        return {
            labels: newLabels,
            data: newData
        };
    }

    const grouped = groupAndAverageData(ikmUnitLabels, ikmUnitData);
    console.log("IKM Unit Labels:", ikmUnitLabels);
    console.log("IKM Unit Data:", ikmUnitData);
    // Menampilkan data di console untuk debugging
    console.log("p", grouped);

    var ctx = document.getElementById('ikmPerLayananChart').getContext('2d');
    var ikmPerLayananChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: grouped.labels,
            datasets: [{
                label: 'IKM per Jenis Layanan',
                data: grouped.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>

<script>
    var kategoriLabels = <?= $kategoriLabels ?>;
    var kategoriCounts = <?= $kategoriCounts ?>;
    document.getElementById('mahasiswa-count').textContent = kategoriCounts[0] || 0;
    document.getElementById('dosen-count').textContent = kategoriCounts[1] || 0;
    document.getElementById('tendik-count').textContent = kategoriCounts[2] || 0;
    document.getElementById('mitra-count').textContent = kategoriCounts[3] || 0;
    document.getElementById('umum-count').textContent = kategoriCounts[4] || 0;

    var ctx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: kategoriLabels,
            datasets: [{
                label: 'Jumlah Responden per Kategori',
                data: kategoriCounts,
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
                borderWidth: 1,
                hoverOffset: 4
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
                            return kategoriLabels[tooltipItem.dataIndex] + ': ' + kategoriCounts[tooltipItem.dataIndex] + ' responden';
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    document.getElementById("downloadButton").addEventListener("click", function() {
        var element = document.querySelector(".downloadhasil");

        if (!element) {
            console.error("Element not found!");
            return;
        }

        html2canvas(element).then(function(canvas) {
            var image = canvas.toDataURL("image/jpeg");

            var link = document.createElement('a');
            link.href = image;
            link.download = "ikm_<?= htmlspecialchars($nama_unit) ?>.jpg";
            link.click();
        }).catch(function(error) {
            console.error("Error capturing screenshot: ", error);
        });
    });
</script>
<?= $this->endSection() ?>