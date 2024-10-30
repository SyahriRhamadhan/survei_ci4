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
        <form method="post" action="<?= base_url('admin/pertanyaan/store') ?>">
            <?= csrf_field() ?>
            <h6 class="mb-25">Input Fields</h6>
            <div class="input-style-1">
                <label>Pertanyaan</label>
                <input class=" form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : '' ?>" type="text" name="pertanyaan" placeholder="*Contoh Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan. ==> <UPPS> atau <unit layanan> sebagai placeholder" />
                <div class="invalid-feedback"><?= $validation->getError('pertanyaan') ?></div>
            </div>
            <div class="input-style-1 my-2">
                <label>Pilih Tipe/Kategori Pertanyaan</label>
                <select class="form-control <?= ($validation->hasError('tipe_pertanyaan')) ? 'is-invalid' : '' ?>" name="tipe_pertanyaan">
                    <option value="">Pilih Tipe/Kategori Pertanyaan</option>
                    <?php foreach ($tipe_pertanyaan as $jab) : ?>
                        <option value="<?= $jab['tipe_pertanyaan'] ?>">
                            <?= $jab['tipe_pertanyaan'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('tipe_pertanyaan') ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>