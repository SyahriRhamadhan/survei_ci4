<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-3"><?= esc($title) ?></h3>
        </div>
    </div>
    <div class="card col-md-12">
        <div class="card-body">
            <a href="<?= base_url('admin/placeholder') ?>" class="btn btn-primary mb-3 fs-6">
                <svg width="16" height="15" fill="#ffffff" viewBox="0 0 199.404 199.404" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876 199.404,117.876"></polygon>
                </svg>
                Kembali
            </a>
            <form method="POST" action="<?= base_url('admin/placeholder/update/' . esc($placeholder['id'])) ?>">
                <?= csrf_field() ?>
                <div class="input-style-1 my-2">
                    <label class="text-dark mb-2 fs-6">Tipe/Kategori Unit</label>
                    <select id="" class="fs-6 form-control <?= ($validation->hasError('jenis_unit')) ? 'is-invalid' : '' ?>" name="jenis_unit">
                        <option value="" disabled>Pilih Tipe/Kategori Unit</option>
                        <option value="UPPS" <?= ($placeholder['jenis_unit'] == 'UPPS') ? 'selected' : '' ?>>UPPS (Setahun Sekali)</option>
                        <option value="Unit Layanan" <?= ($placeholder['jenis_unit'] == 'Unit Layanan') ? 'selected' : '' ?>>Unit Layanan</option>
                    </select>
                    <div class="invalid-feedback"><?= esc($validation->getError('jenis_unit')) ?></div>
                </div>
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Nama Unit/Layanan <span class="text-success">*Tambahkan juga singkatannya cth: FTTK</span></label>
                    <input value="<?= esc($placeholder['nama_unit']) ?>" class="fs-6 form-control <?= ($validation->hasError('nama_unit')) ? 'is-invalid' : '' ?>" type="text" name="nama_unit" placeholder="" />
                    <div class="invalid-feedback"><?= esc($validation->getError('nama_unit')) ?></div>
                </div>

                <!-- The Jenis Layanan section -->
                <div class="input-style-1" id="jenis_layanan_div">
                    <label class="text-dark mb-2 fs-6">Jenis Layanan/Nama Prodi (jika tipe unit UPPS)</label>
                    <input value="<?= esc($placeholder['jenis_layanan_yang_diterima']) ?>" class="fs-6 form-control <?= ($validation->hasError('jenis_layanan_yang_diterima')) ? 'is-invalid' : '' ?>" type="text" name="jenis_layanan_yang_diterima" placeholder="*Contoh Layanan Akademik Fakultas, Sertifikat Akreditasi, Layanan Alumni (Legalisir)" />
                    <div class="invalid-feedback"><?= esc($validation->getError('jenis_layanan_yang_diterima')) ?></div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to toggle the visibility of Jenis Layanan field -->
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const jenisUnitSelect = document.getElementById('jenis_unit_select');
    //     const jenisLayananDiv = document.getElementById('jenis_layanan_div');

    //     // Function to toggle visibility based on selection
    //     function toggleJenisLayanan() {
    //         if (jenisUnitSelect.value === 'Unit Layanan') {
    //             jenisLayananDiv.style.display = 'block';
    //         } else {
    //             jenisLayananDiv.style.display = 'none';
    //         }
    //     }

    //     // Initial check in case a value is already selected
    //     toggleJenisLayanan();

    //     // Event listener for changes
    //     jenisUnitSelect.addEventListener('change', toggleJenisLayanan);
    // });
</script>

<?= $this->endSection() ?>