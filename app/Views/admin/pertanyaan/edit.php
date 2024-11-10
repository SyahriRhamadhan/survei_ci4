<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-3"><?= $title ?></h3>
        </div>
    </div>
    <div class="card col-md-12">
        <div class="card-body">
            <a href="<?= base_url('admin/pertanyaan') ?>" class="btn btn-primary mb-3 fs-6">

                <svg width="16" height="15" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 199.404 199.404" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876 199.404,117.876 "></polygon>
                        </g>
                    </g>
                </svg>
                Kembali
            </a>
            <form method="POST" action="<?= base_url('admin/pertanyaan/update/' . $pertanyaan['id']) ?>">
                <?= csrf_field() ?>

                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Pertanyaan                     <label class="text-dark mb-2 fs-6">Pertanyaan <span class="text-success">*Tambahkan pada pertanyaan jika ingin untuk semua unit &lt;tag&gt; </span></label></label>
                    <input value="<?= $pertanyaan['pertanyaan'] ?>" class="fs-6  form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : '' ?>" type="text" name="pertanyaan" placeholder="*Contoh Prosedur pelayanan di <unit layanan> mudah, sesuai dengan aturan. ==> <UPPS> atau <unit layanan> sebagai placeholder" />
                    <div class="invalid-feedback"><?= $validation->getError('pertanyaan') ?></div>
                </div>
                <div class="input-style-1 my-2">
                    <label class="text-dark mb-2 fs-6">Tipe/Kategori Pertanyaan <a href="<?= base_url('admin/tipe_pertanyaan') ?>">tambah kategori</a></label>
                    <select class=" fs-6 form-control <?= ($validation->hasError('tipe_pertanyaan')) ? 'is-invalid' : '' ?>" name="tipe_pertanyaan">
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

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>