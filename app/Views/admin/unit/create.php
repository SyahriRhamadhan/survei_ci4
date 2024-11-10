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
            <a href="<?= base_url('admin/unit') ?>" class="btn btn-primary mb-3 fs-6">

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
            <form method="post" action="<?= base_url('admin/unit/store') ?>">
                <?= csrf_field() ?>

                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Nama Unit <span class="text-success">*Tambahkan juga singkatannya cth: FTTK</span></label>
                    <input class="fs-6 form-control <?= ($validation->hasError('nama_unit')) ? 'is-invalid' : '' ?>" type="text" name="nama_unit" placeholder="Fakultas Teknik dan Teknologi Kemaritman (FTTK)" />
                    <div class="invalid-feedback"><?= $validation->getError('nama_unit') ?></div>
                </div>

                <div class="input-style-1 my-2">
                    <label class="text-dark mb-2 fs-6">Tipe/Kategori Unit</label>
                    <select class="fs-6 form-control <?= ($validation->hasError('jenis_unit')) ? 'is-invalid' : '' ?>" name="jenis_unit" onchange="toggleJenisLayanan()">
                        <option value="" disabled selected>Pilih Tipe/Kategori Unit</option>
                        <option default value="UPPS">UPPS (Setahun Sekali)</option>
                        <option value="Unit Layanan">Unit Layanan</option>
                    </select>
                    <div class="invalid-feedback"><?= $validation->getError('jenis_unit') ?></div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>