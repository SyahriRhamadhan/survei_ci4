<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="row m-3">
    <div class="card col-md text-center">
        <h3 class="m-3 fw-bold">Hasil Survei <?= $survei['nama_unit'] ?> - <?= $survei['jenis_layanan_yang_diterima'] ?> </h3>
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
                    <td>Ideks Kepuasan Masyarakat</td>
                    <td>:</td>
                    <td><?= $survei['ikm'] ?></td>
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
<div class="row card">
    <div class="card-body">
        <canvas id="surveyChart"></canvas>
    </div>
</div>
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

        const originalTitle = 'Penilaian Terkait Pertanyaan <?= $survei['nama_unit'] ?>-<?= $survei['jenis_layanan_yang_diterima'] ?>(Skala 1-4)';
        const wrappedTitle = wrapText(originalTitle, 7);

        const chartData = {
            labels: Object.values(questions), // Labels menggunakan teks pertanyaan
            datasets: [{
                    label: 'Sangat Tidak Setuju',
                    backgroundColor: '#FF0000', // Warna merah
                    data: dataForQuestions.map(data => data[0]) // Skala 1
                },
                {
                    label: 'Kurang Setuju',
                    backgroundColor: '#FFA500', // Warna oranye
                    data: dataForQuestions.map(data => data[1]) // Skala 2
                },
                {
                    label: 'Setuju',
                    backgroundColor: '#00FF00', // Warna hijau
                    data: dataForQuestions.map(data => data[2]) // Skala 3
                },
                {
                    label: 'Sangat Setuju',
                    backgroundColor: '#0000FF', // Warna biru
                    data: dataForQuestions.map(data => data[3]) // Skala 4
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

                                // Pisahkan label berdasarkan spasi agar setiap kata tetap utuh
                                let words = label.split(" ");
                                let lines = [];
                                let currentLine = "";

                                words.forEach((word) => {
                                    if ((currentLine + word).length <= 50) {
                                        currentLine += word + " ";
                                    } else {
                                        lines.push(currentLine.trim());
                                        currentLine = word + " ";
                                    }
                                });

                                // Tambahkan baris terakhir
                                lines.push(currentLine.trim());

                                // Batasi output hanya pada 2 baris pertama jika terlalu banyak
                                return lines.slice(0, 2);
                            },
                            maxRotation: -90, // Atur rotasi ke vertikal
                            minRotation: 45, // Atur rotasi awal
                            autoSkip: false, // Agar semua label tampil
                        },
                        grid: {
                            display: true,
                            drawOnChartArea: true, // Garis batas akan muncul pada area chart
                            color: '#e0e0e0', // Warna garis batas antar label
                            lineWidth: 1, // Lebar garis
                        },
                        title: {
                            display: true,
                            text: 'Pertanyaan',
                            font: {
                                size: 16,
                            }
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Responden',
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