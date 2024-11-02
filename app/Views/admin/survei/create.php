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
        <a href="<?= base_url('admin/survei') ?>" class="btn btn-primary mb-3 fs-6">
                                   
                                   <svg width="16" height="15" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 199.404 199.404" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876 199.404,117.876 "></polygon> </g> </g></svg>
                                                               Kembali
                                           </a>
            <form method="post" action="<?= base_url('admin/survei/store') ?>">
                <?= csrf_field() ?>
                
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Judul</label>
                    <select class="form-select fs-6  mr-sm-2" id="inlineFormCustomSelect" name="judul" required>
                        <option selected value="">Pilih Judul</option>
                        <option value="Instrumen survei kepuasan mahasiswa di UPPS">Instrumen survei kepuasan mahasiswa di UPPS</option>
                        <option value="Instrumen survei kepuasan dosen di UPPS">Instrumen survei kepuasan dosen di UPPS</option>
                        <option value="Instrumen survei kepuasan tenaga kependidikan di UPPS">Instrumen survei kepuasan tenaga kependidikan di UPPS</option>
                        <option value="Instrumen survei kepuasan mitra di UPPS">Instrumen survei kepuasan mitra di UPPS</option>
                        <option value="Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH">Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH</option>
                    </select>
                </div>
                <div class="input-style-1 my-1">
                    <label class="text-dark mb-2 fs-6">Deskripsi</label>
                    <textarea class="fs-6 form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" type="text" name="deskripsi" placeholder="" required></textarea>
                    <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
                </div>
                <div class="input-style-1 my-1">
                    <label class="text-dark mb-2 fs-6">Tanggal Mulai</label>
                    <input class="fs-6 form-control <?= ($validation->hasError('tgl_mulai')) ? 'is-invalid' : '' ?>" type="date" name="tgl_mulai" placeholder="" required />
                    <div class="invalid-feedback"><?= $validation->getError('tgl_mulai') ?></div>
                </div>
                <div class="input-style-1 my-1">
                    <label class="text-dark mb-2 fs-6">Tanggal Selesai</label>
                    <input class="fs-6 form-control <?= ($validation->hasError('tgl_selesai')) ? 'is-invalid' : '' ?>" type="date" name="tgl_selesai" placeholder="" required />
                    <div class="invalid-feedback"><?= $validation->getError('tgl_selesai') ?></div>
                </div>
                <div class="input-style-1 my-2">
                    <h4 class="text-dark mb-2 fs-6">Status</h4>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="status" value="on" checked>
                            <label class="custom-control-label fs-6" for="customControlValidation2">On</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="status" value="off">
                            <label class="custom-control-label fs-6" for="customControlValidation3">Off</label>
                        </div>
                    </div>
                </div>
                <div class="input-style-1 my-2">
                    <div class="form-group ">
                        <label class="mr-sm-2 text-dark fs-6 mb-2" for="inlineFormCustomSelect">Unit</label>
                        <select class="form-select fs-6 mr-sm-2" id="inlineFormCustomSelect" name="unit" required>
                            <option selected value="">Pilih Unit</option>
                            <?php foreach ($unit_placeholder as $key) { ?>
                                <option value="<?= $key['id'] ?>"> <?= $key['jenis_unit'] ?> - <?= $key['nama_unit'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php foreach ($pertanyaanGrouped as $kategori => $pertanyaans): ?>
                    <div class="category-group mt-5">
                        <h5 class="fw-semibold text-dark ">Kategori = <?= htmlspecialchars($kategori) ?></h5>
                        <?php foreach ($pertanyaans as $pertanyaan): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pertanyaan[]" value="<?= htmlspecialchars($pertanyaan['id']) ?>">
                                <label class="form-check-label text-dark"><?= htmlspecialchars($pertanyaan['pertanyaan']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>