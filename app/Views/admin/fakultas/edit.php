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
        <form method="POST" action="<?= base_url('admin/fakultas/update/' . $fakultas['id']) ?>">
            <?= csrf_field() ?>
            <h6 class="mb-25">Input Fields</h6>
            <div class="input-style-1">
                <label>Nama Fakultas</label>
                <input value="<?= $fakultas['nama'] ?>" class=" form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" type="text" name="pertanyaan" placeholder="*Contoh Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan. ==> <UPPS> atau <unit layanan> sebagai placeholder" />
                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>