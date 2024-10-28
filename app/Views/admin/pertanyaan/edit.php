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
        <form method="POST" action="<?= base_url('admin/pertanyaan/update/' . $pertanyaan['id']) ?>">
            <?= csrf_field() ?>
            <h6 class="mb-25">Input Fields</h6>
            <div class="input-style-1">
                <label>Pertanyaan</label>
                <input value="<?= $pertanyaan['pertanyaan'] ?>" class=" form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : '' ?>" type="text" name="pertanyaan" placeholder="*Contoh Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan. ==> <UPPS> atau <unit layanan> sebagai placeholder" />
                <div class="invalid-feedback"><?= $validation->getError('pertanyaan') ?></div>
            </div>
            <div class="input-style-1 my-2">
                <label>Tipe/Kategori Pertanyaan</label>
                <select class="form-control <?= ($validation->hasError('tipe_pertanyaan')) ? 'is-invalid' : '' ?>" name="tipe_pertanyaan">
                    <option value="" disabled>Pilih Tipe/Kategori Pertanyaan</option>
                    <option value="none" <?= ($pertanyaan['tipe_pertanyaan'] == 'none') ? 'selected' : '' ?>>None</option>
                    <option value="Tata Kelola, Tata Pamong, dan Kerjasama" <?= ($pertanyaan['tipe_pertanyaan'] == 'Tata Kelola, Tata Pamong, dan Kerjasama') ? 'selected' : '' ?>>Tata Kelola, Tata Pamong, dan Kerjasama</option>
                    <option value="Bidang Kemahasiswaan" <?= ($pertanyaan['tipe_pertanyaan'] == 'Bidang Kemahasiswaan') ? 'selected' : '' ?>>Bidang Kemahasiswaan</option>
                    <option value="Bidang Sarana dan Prasarana" <?= ($pertanyaan['tipe_pertanyaan'] == 'Bidang Sarana dan Prasarana') ? 'selected' : '' ?>>Bidang Sarana dan Prasarana</option>
                    <option value="Sistem Tata Pamong" <?= ($pertanyaan['tipe_pertanyaan'] == 'Sistem Tata Pamong') ? 'selected' : '' ?>>Sistem Tata Pamong</option>
                    <option value="Kepemimpinan dan Kemampuan Manajerial" <?= ($pertanyaan['tipe_pertanyaan'] == 'Kepemimpinan dan Kemampuan Manajerial') ? 'selected' : '' ?>>Kepemimpinan dan Kemampuan Manajerial</option>
                    <option value="Kerjasama" <?= ($pertanyaan['tipe_pertanyaan'] == 'Kerjasama') ? 'selected' : '' ?>>Kerjasama</option>
                    <option value="Layanan dan Sumber Daya Manusia" <?= ($pertanyaan['tipe_pertanyaan'] == 'Layanan dan Sumber Daya Manusia') ? 'selected' : '' ?>>Layanan dan Sumber Daya Manusia</option>
                    <option value="Layanan Keuangan" <?= ($pertanyaan['tipe_pertanyaan'] == 'Layanan Keuangan') ? 'selected' : '' ?>>Layanan Keuangan</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('tipe_pertanyaan') ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>