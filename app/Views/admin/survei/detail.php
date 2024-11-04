<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="row m-3">
    <h1>Detail Survei</h1>
    <div class="card col-md-12">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?= $survei['judul'] ?></td>
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
<div class="row m-3">
    <h1>Pertanyaan</h1>

    <?php
    $kategoriIndex = 0;
    foreach ($pertanyaanGrouped as $kategori => $pertanyaans):
        $kategoriLetter = chr(97 + $kategoriIndex);
        $kategoriIndex++;
    ?>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold text-dark"><?= htmlspecialchars($kategoriLetter) ?>: <?= htmlspecialchars($kategori) ?></h5>

                    <?php
                    $pertanyaanIndex = 1;
                    foreach ($pertanyaans as $pertanyaan):
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pertanyaan[]" value="<?= htmlspecialchars($pertanyaan['id']) ?>" disabled>
                            <label class="form-check-label text-dark">
                                <?= $pertanyaanIndex ?>. <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                            </label>
                        </div>
                        <?php $pertanyaanIndex++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>