<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="row mx-3">
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-4">
                <button class="btn ms-2 btn-success" id="downloadButton">Unduh Hasil <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-jpg">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M11 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                        <path d="M20 15h-1a2 2 0 0 0 -2 2v2a2 2 0 0 0 2 2h1v-3" />
                        <path d="M5 15h3v4.5a1.5 1.5 0 0 1 -3 0" />
                    </svg></button>
            </div>
            <div class="div col-md-4">
                <form action="<?= base_url('responden/chartfilterunit/' . urlencode($nama_unit)) ?>" method="get">
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
                        <button class="btn ms-2 btn-success" type="submit">Terapkan <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                            </svg></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card downloadhasil">
            <div class="card-label m-3 text-center">
                <h3>INDEKS KEPUASAN MASYARAKAT (IKM)</h3>
                <h3> <?= htmlspecialchars($nama_unit) ?></h3>
                <h3>UNIVERSITAS MARITIM RAJA ALI HAJI (UMRAH)</h3>
                <h3>Priode <?= $tahun ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-label text-center">
                                    <h3 class="fw-bold">Indeks Kepuasan Masyarakat</h3>
                                </div>
                                <p><strong>Nilai IKM:</strong> <?= $ikm ?></p>
                                <p><strong>Kategori:</strong> <?= $kategori ?></p>
                                <p><strong>Total Responden:</strong> <?= $totalResponden ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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