<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="row m-3">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>INDEKS KEPUASAN MASYARAKAT UNIVERSITAS MARITIM RAJA ALI HAJI (UMRAH)</h3>
                <h3>Unit Layanan/UPPS <?= htmlspecialchars($nama_unit) ?></h3>
                <h3>Priode </h3>
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
<?= $this->endSection() ?>