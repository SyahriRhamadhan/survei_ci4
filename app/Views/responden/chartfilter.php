<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="row m-3">
    <div class="card col-md-8 text-center">
        <h3 class="mx-3 mt-3 fw-bold">Hasil Survei <?= $survei['nama_unit'] ?> - <?= $survei['jenis_layanan_yang_diterima'] ?> </h3>
        <h3 class=" mb-3 fw-bold"> Tahun <?= $tahun ?></h3>
    </div>
    <div class="col-md-4">
        <form action="<?= base_url('responden/chartfilter/' . urlencode($id)) ?>" method="get">
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
    <div class="card col-md-12">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?= $survei['judul'] ?></td>
                </tr>
                <tr>
                    <td>Tahun/Priode</td>
                    <td>:</td>
                    <td><?= $tahun ?></td>
                </tr>
                <tr>
                    <td>Indeks Kepuasan Masyarakat</td>
                    <td>:</td>
                    <td id="ikmValue"><?= $IKM ?> (<span id="ikmCategory"></span>)
                    </td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><?= $survei['dekripsi'] ?></td>
                </tr>
                <tr>
                    <td>Jadwal Survei</td>
                    <td>:</td>
                    <td><?= $survei['tgl_mulai'] ?> Sampai <?= $survei['tgl_selesai'] ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                        <?php if ($survei['status'] === 'on'): ?>
                            <span class="badge bg-success">On</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Off</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama Unit</td>
                    <td>:</td>
                    <td><?= $survei['nama_unit'] ?></td>
                </tr>
                <tr>
                    <td>Jenis Unit</td>
                    <td>:</td>
                    <td><?= $survei['jenis_unit'] ?></td>
                </tr>
                <tr>
                    <td>Jenis Layanan</td>
                    <td>:</td>
                    <td><?= $survei['jenis_layanan_yang_diterima'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="row m-1">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <canvas id="genderChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <canvas id="kategoriRespondenChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <canvas id="angkatanChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row m-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <canvas id="surveyChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-label">
                    Indeks Kepuasan Masyarakat (IKM): <strong><?= $IKM ?> (<?= $ikmCategory ?>)</strong>
                </div>
                <canvas id="weightedAverageChart" width="410" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    const ctx3 = document.getElementById('weightedAverageChart').getContext('2d');
    const weightedAverageChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?= json_encode($typeLabels) ?>,
            datasets: [{
                label: 'Rata-Rata Tertimbang',
                data: <?= json_encode($weightedAverageValues) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Rata-Rata Tertimbang Aspek Unsur Yang Diukur'
                }
            }
        }
    });
</script>

<script>
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(genderCtx, {
        type: 'pie', // atau 'doughnut' untuk tipe chart yang berbeda
        data: {
            labels: <?= json_encode($genderLabels) ?>,
            datasets: [{
                label: 'Distribusi Jenis Kelamin',
                data: <?= json_encode($genderData) ?>,
                backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1 // Ketebalan border
            }]

        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jenis Kelamin Responden',
                    font: {
                        size: 20,
                    },
                    padding: {
                        top: 10,
                        bottom: 5
                    }
                },
                subtitle: {
                    display: true,
                    text: 'Dari Total Responden: <?= $totalResponden ?>',
                    padding: {
                        top: 10,
                        bottom: 5
                    }
                },
                tooltip: {
                    enabled: true,
                },
            }
        }
    });
</script>
<script>
    const ctx1 = document.getElementById('angkatanChart').getContext('2d');
    const angkatanChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?= json_encode($angkatanLabels) ?>,
            datasets: [{
                label: 'Jumlah Responden',
                font: {
                    size: 20,
                },
                data: <?= json_encode($angkatanData) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Angkatan Responden Mahasiswa',
                    font: {
                        size: 20,
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Responden',
                        font: {
                            size: 16,
                        }
                    }
                },
                x: {
                    title: {
                        display: false,
                        text: 'Angkatan',
                        font: {
                            size: 16,
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    const ikmValueElement = document.getElementById('ikmValue');
    const ikmCategoryElement = document.getElementById('ikmCategory');

    const ikmValue = parseFloat(ikmValueElement.textContent);

    let ikmCategory = '';
    if (ikmValue >= 1 && ikmValue <= 64.99) {
        ikmCategory = 'Tidak Baik';
    } else if (ikmValue >= 65 && ikmValue <= 76.60) {
        ikmCategory = 'Kurang Baik';
    } else if (ikmValue >= 76.61 && ikmValue <= 88.30) {
        ikmCategory = 'Baik';
    } else if (ikmValue >= 88.31 && ikmValue <= 100) {
        ikmCategory = 'Sangat Baik';
    } else {
        ikmCategory = 'Nilai IKM tidak valid';
    }

    ikmCategoryElement.textContent = ikmCategory;
</script>
<script>
    const ctx = document.getElementById('kategoriRespondenChart').getContext('2d');
    const kategoriRespondenChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($kategoriLabels) ?>,
            datasets: [{
                label: 'Asal Responden',
                data: <?= json_encode($kategoriCounts) ?>,
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
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Asal Responden Survei',
                    font: {
                        size: 20,
                    },
                    padding: {
                        top: 10,
                        bottom: 5
                    }
                },
                subtitle: {
                    display: true,
                    text: 'Dari Total Responden: <?= $totalResponden ?>',
                    padding: {
                        top: 10,
                        bottom: 5
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('surveyChart').getContext('2d');

        const questions = <?php echo json_encode(array_column($questions, 'pertanyaan', 'id')); ?>;
        const responseCounts = <?php echo json_encode($responseCounts); ?>;

        function wrapText(text, maxWordsPerLine) {
            const words = text.split(' ');
            let lines = [];
            let line = [];

            words.forEach((word) => {
                line.push(word);
                if (line.length === maxWordsPerLine) {
                    lines.push(line.join(' '));
                    line = [];
                }
            });

            if (line.length > 0) {
                lines.push(line.join(' '));
            }

            return lines.join('\n');
        }

        const dataForQuestions = Object.keys(questions).map(id_pertanyaan => {
            const questionResponses = responseCounts.filter(rc => rc.id_pertanyaan == id_pertanyaan);
            const responseCountsArray = [0, 0, 0, 0];

            questionResponses.forEach(response => {
                responseCountsArray[response.jawaban - 1] = response.count;
            });

            return responseCountsArray;
        });

        const originalTitle = 'Penilaian Terkait Pertanyaan <?= $survei['nama_unit'] ?>-<?= $survei['jenis_layanan_yang_diterima'] ?>(Skala 4-1)';
        const wrappedTitle = wrapText(originalTitle, 7);

        const chartData = {
            labels: Object.values(questions),
            datasets: [{
                    label: 'Sangat Tidak Setuju',
                    backgroundColor: 'rgba(255, 0, 0, 0.5)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 2,
                    data: dataForQuestions.map(data => data[0])
                },
                {
                    label: 'Kurang Setuju',
                    backgroundColor: 'rgba(255, 165, 0, 0.5)',
                    borderColor: 'rgba(255, 165, 0, 1)',
                    borderWidth: 2,
                    data: dataForQuestions.map(data => data[1])
                },
                {
                    label: 'Setuju',
                    backgroundColor: 'rgba(0, 255, 0, 0.5)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 2,
                    data: dataForQuestions.map(data => data[2])
                },
                {
                    label: 'Sangat Setuju',
                    backgroundColor: 'rgba(0, 0, 255, 0.5)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 2,
                    data: dataForQuestions.map(data => data[3])
                }
            ]


        };

        // Konfigurasi Chart.js
        const surveyChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: wrappedTitle,
                        font: {
                            size: 20,
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            callback: function(value) {
                                let label = this.getLabelForValue(value);
                                let words = label.split(" ");
                                let lines = [];
                                let currentLine = "";

                                words.forEach((word) => {
                                    if ((currentLine + word).length <= 70) {
                                        currentLine += word + " ";
                                    } else {
                                        lines.push(currentLine.trim());
                                        currentLine = word + " ";
                                    }
                                });

                                lines.push(currentLine.trim());
                                return lines.slice(0, 2);
                            },
                            maxRotation: -90,
                            minRotation: 45,
                            autoSkip: false,
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Responden <?= $totalResponden ?>',
                            font: {
                                size: 16,
                            },
                            padding: {
                                top: 10,
                                left: 10
                            }
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' responden';
                            }
                        }
                    }
                }
            }
        });

    });
</script>


<?= $this->endSection() ?>