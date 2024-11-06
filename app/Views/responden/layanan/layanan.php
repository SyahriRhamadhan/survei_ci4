<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-3">Survei Kepuasan Layanan</h3>
        </div>
    </div>
    <div class="card col-md-6">
        <div class="card-body">
            <form>
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md">
                        <h3>Tujuan Survei</h3>
                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                            <select class="form-control fs-6" id="unit_layanan" name="unit_layanan" onchange="filterJenisLayanan()">
                                <option value="">Pilih Unit Layanan</option>
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


                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                            <select class="form-control fs-6" id="jenis_layanan_yang_diterima" name="jenis_layanan_yang_diterima">
                                <option value="">Pilih Jenis Layanan yang Diterima</option>
                                <?php foreach ($unitList as $unit): ?>
                                    <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                        <option class="jenis-option" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                            <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="button" class="btn btn-primary" onclick="goToDetail()">Detail</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>