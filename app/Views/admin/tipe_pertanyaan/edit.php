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
        <form method="POST" action="<?= base_url('admin/tipe_pertanyaan/update/' . $tipe_pertanyaan['id']) ?>">
            <?= csrf_field() ?>
            <h6 class="mb-25">Input Fields</h6>
            <div class="input-style-1">
                <label>Tipe/Kategori Pertanyaan</label>
                <input value="<?= $tipe_pertanyaan['tipe_pertanyaan'] ?>" class=" form-control <?= ($validation->hasError('tipe_pertanyaan')) ? 'is-invalid' : '' ?>" type="text" name="tipe_pertanyaan" placeholder="*Contoh " />
                <div class="invalid-feedback"><?= $validation->getError('tipe_pertanyaan') ?></div>
            </div>
            <button type="submit" class="btn btn-primary m-5">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>