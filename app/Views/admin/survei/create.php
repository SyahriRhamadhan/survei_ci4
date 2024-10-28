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
        <a href="/admin/survei" class="btn btn-warning mb-3">Kembali</a>
        <form method="post" action="<?= base_url('admin/survei/store') ?>">
            <?= csrf_field() ?>
            <!-- <h6 class="mb-25">Input Fields</h6> -->
            <div class="input-style-1">
                <label>Judul</label>
                <select class="form-select mr-sm-2" id="inlineFormCustomSelect" name="judul" required>
                    <option selected value="">Pilih Judul</option>
                    <option value="Instrumen survei kepuasan mahasiswa di UPPS">Instrumen survei kepuasan mahasiswa di UPPS</option>
                    <option value="Instrumen survei kepuasan dosen di UPPS">Instrumen survei kepuasan dosen di UPPS</option>
                    <option value="Instrumen survei kepuasan tenaga kependidikan di UPPS">Instrumen survei kepuasan tenaga kependidikan di UPPS</option>
                    <option value="Instrumen survei kepuasan mitra di UPPS">Instrumen survei kepuasan mitra di UPPS</option>
                    <option value="Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH">Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH</option>
                </select>
            </div>
            <div class="input-style-1 my-1">
                <label>Deskripsi</label>
                <textarea class=" form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" type="text" name="deskripsi" placeholder="" required></textarea>
                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
            </div>
            <div class="input-style-1 my-1">
                <label>Tanggal Mulai</label>
                <input class=" form-control <?= ($validation->hasError('tgl_mulai')) ? 'is-invalid' : '' ?>" type="date" name="tgl_mulai" placeholder="" required />
                <div class="invalid-feedback"><?= $validation->getError('tgl_mulai') ?></div>
            </div>
            <div class="input-style-1 my-1">
                <label>Tanggal Selesai</label>
                <input class=" form-control <?= ($validation->hasError('tgl_selesai')) ? 'is-invalid' : '' ?>" type="date" name="tgl_selesai" placeholder="" required />
                <div class="invalid-feedback"><?= $validation->getError('tgl_selesai') ?></div>
            </div>
            <div class="input-style-1 my-1">
                <h4 class="card-title">Status</h4>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation2" name="status" value="on" checked>
                        <label class="custom-control-label" for="customControlValidation2">On</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customControlValidation3" name="status" value="off">
                        <label class="custom-control-label" for="customControlValidation3">Off</label>
                    </div>
                </div>
            </div>
            <div class="input-style-1 my-1">
                <div class="form-group mb-4">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Unit</label>
                    <select class="form-select mr-sm-2" id="inlineFormCustomSelect" name="unit" required>
                        <option selected value="">Pilih Unit</option>
                        <?php foreach ($unit_placeholder as $key) { ?>
                            <option value="<?= $key['id'] ?>"> <?= $key['jenis_unit'] ?> - <?= $key['nama_unit'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php foreach ($pertanyaanGrouped as $kategori => $pertanyaans): ?>
                <div class="category-group">
                    <h5 class="fw-bold">Kategori = <?= htmlspecialchars($kategori) ?></h5>
                    <?php foreach ($pertanyaans as $pertanyaan): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pertanyaan[]" value="<?= htmlspecialchars($pertanyaan['id']) ?>">
                            <label class="form-check-label"><?= htmlspecialchars($pertanyaan['pertanyaan']) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>