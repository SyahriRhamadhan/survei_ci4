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
                <label>Tipe/Kategori Pertanyaan</label>
                <select class="form-control <?= ($validation->hasError('tipe_pertanyaan')) ? 'is-invalid' : '' ?>" name="tipe_pertanyaan">
                    <option value="" disabled selected>Pilih Tipe/Kategori Pertanyaan</option>
                    <option default value="none">None</option>
                    <option value="Tata Kelola, Tata Pamong, dan Kerjasama">Tata Kelola, Tata Pamong, dan Kerjasama</option>
                    <option value="Bidang Kemahasiswaan">Bidang Kemahasiswaan</option>
                    <option value="Bidang Sarana dan Prasarana">Bidang Sarana dan Prasarana</option>
                    <option value="Sistem Tata Pamong">Sistem Tata Pamong</option>
                    <option value="Kepemimpinan dan Kemampuan Manajerial">Kepemimpinan dan Kemampuan Manajerial</option>
                    <option value="Kerjasama">Kerjasama</option>
                    <option value="Layanan dan Sumber Daya Manusia">Layanan dan Sumber Daya Manusia</option>
                    <option value="Layanan Keuangan">Layanan Keuangan</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('tipe_pertanyaan') ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>