<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2><?= $title ?></h2>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<div class="card col-md-12">
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/placeholder/update/' . $placeholder['id']) ?>">
            <?= csrf_field() ?>
            <h6 class="mb-25">Input Fields</h6>
            <div class="input-style-1">
                <label>Nama Unit/Layanan</label>
                <input value="<?= $placeholder['nama_unit'] ?>" class=" form-control <?= ($validation->hasError('nama_unit')) ? 'is-invalid' : '' ?>" type="text" name="nama_unit" placeholder="" />
                <div class="invalid-feedback"><?= $validation->getError('nama_unit') ?></div>
            </div>
            <div class="input-style-1 my-2">
                <label>Tipe/Kategori Unit</label>
                <select class="form-control <?= ($validation->hasError('jenis_unit')) ? 'is-invalid' : '' ?>" name="jenis_unit">
                    <option value="" disabled>Pilih Tipe/Kategori Unit</option>
                    <option value="UPPS" <?= ($placeholder['jenis_unit'] == 'UPPS') ? 'selected' : '' ?>>UPPS</option>
                    <option value="Unit Layanan" <?= ($placeholder['jenis_unit'] == 'Unit Layanan') ? 'selected' : '' ?>>Unit Layanan</option>
                    <option value="Lainnya" <?= ($placeholder['jenis_unit'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>

                </select>
                <div class="invalid-feedback"><?= $validation->getError('jenis_unit') ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>