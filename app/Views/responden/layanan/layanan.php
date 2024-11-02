<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-3">Survei Kepuasan Layanan</h3>
        </div>            
    </div>
    <div class="card col-md-12">
        <div class="card-body">
            <form method="post" action="<?= base_url('responden/layanan/store') ?>">
                <?= csrf_field() ?>

                <!-- Field Kategori Pengguna Layanan -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Kategori Pengguna Layanan</label>
                    <select class="form-control" name="kategori_responden" id="kategori_responden">
                        <option value="">Pilih Kategori</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="tendik">Tendik</option>
                        <option value="mitra">Mitra</option>
                        <option value="umum">Umum</option>
                    </select>
                </div>

                <!-- Field untuk kategori tertentu -->
                <div id="mahasiswaFields" style="display: none;">
                    <div class="input-style-1">
                        <label class="text-dark mb-2 fs-6">Asal Prodi</label>
                        <select class="form-control fs-6" name="asal_prodi">
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($prodiList as $prodi): ?>
                                <option value="<?= $prodi['id'] ?>"><?= $prodi['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-style-1">
                        <label class="text-dark mb-2 fs-6">Angkatan</label>
                        <input class="fs-6 form-control" type="text" name="angkatan" placeholder="Contoh: 2020" />
                    </div>
                </div>

                <div id="dosenFields" style="display: none;">
                    <div class="input-style-1">
                        <label class="text-dark mb-2 fs-6">Asal Fakultas</label>
                        <select class="form-control fs-6" name="asal_fakultas">
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($fakultasList as $fakultas): ?>
                                <option value="<?= $fakultas['id'] ?>"><?= $fakultas['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div id="tendikFields" style="display: none;">
                    <div class="input-style-1">
                        <label class="text-dark mb-2 fs-6">Asal Unit Kerja</label>
                        <select class="form-control fs-6" name="asal_unit_kerja">
                            <option value="">Pilih Unit Kerja</option>
                            <?php foreach ($unitList as $unit): ?>
                                <option value="<?= $unit['id'] ?>"><?= $unit['nama_unit'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Field Jam Survei -->
                <div class="input-style-1 mt-3">
                    <label class="text-dark mb-2 fs-6">Jam Survei</label>
                    <select class="form-control fs-6" name="jam_survei" required>
                        <option value="">Pilih Jam Survei</option>
                        <option value="08.00 - 12.00">08.00 - 12.00</option>
                        <option value="13.00 - 17.00">13.00 - 17.00</option>
                    </select>
                </div>

                <!-- Field Lainnya -->
                <div class="input-style-1 mt-3">
                    <label class="text-dark mb-2 fs-6">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="input-style-1 mt-3">
                    <label class="text-dark mb-2 fs-6">Umur</label>
                    <input class="fs-6 form-control" type="number" name="umur" placeholder="Umur" />
                </div>

                <div class="input-style-1 mt-3">
                    <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                    <select class="form-control fs-6" name="unit_layanan">
                        <option value="">Pilih Unit Layanan</option>
                        <?php foreach ($unitList as $unit): ?>
                            <option value="<?= $unit['id'] ?>"><?= $unit['nama_unit'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-style-1 mt-3">
                    <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                    <input class="fs-6 form-control" type="text" name="jenis_layanan_diterima" placeholder="Contoh: Pendaftaran wisuda" />
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('kategori_responden').addEventListener('change', function() {
        var category = this.value;
        document.getElementById('mahasiswaFields').style.display = category === 'mahasiswa' ? 'block' : 'none';
        document.getElementById('dosenFields').style.display = category === 'dosen' ? 'block' : 'none';
        document.getElementById('tendikFields').style.display = category === 'tendik' ? 'block' : 'none';
    });
</script>
<?= $this->endSection() ?>
