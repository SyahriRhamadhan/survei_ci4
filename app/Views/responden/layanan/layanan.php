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

                <div class="row">
                    <div class="col-md-6">
                        <!-- Field Kategori Pengguna Layanan -->
                        <h3>Data Responden</h3>
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
                    </div>
                    <div class="col-md-6">
                        <h3>Tujuan Survei</h3>
                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                            <select class="form-control fs-6" id="unit_layanan" name="unit_layanan" onchange="filterJenisLayanan()">
                                <option value="">Pilih Unit Layanan</option>
                                <?php foreach ($unitList as $unit): ?>
                                    <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                        <?= htmlspecialchars($unit['nama_unit']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                            <select class="form-control fs-6" id="jenis_layanan_yang_diterima" name="jenis_layanan_yang_diterima">
                                <option value="">Pilih Jenis Layanan yang Diterima</option>
                                <?php foreach ($unitList as $unit): ?>
                                    <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                        <option class="jenis-option" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                            <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
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

    function filterJenisLayanan() {
        const unitLayanan = document.getElementById('unit_layanan').value;
        const jenisLayananSelect = document.getElementById('jenis_layanan_yang_diterima');
        const jenisOptions = document.querySelectorAll('.jenis-option');

        jenisLayananSelect.value = '';
        jenisOptions.forEach(option => {
            option.style.display = option.getAttribute('data-unit') === unitLayanan ? 'block' : 'none';
        });
    }
</script>
<?= $this->endSection() ?>