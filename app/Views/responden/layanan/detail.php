<?= $this->extend('responden/layout') ?>

<?= $this->section('content') ?>

<div class="row m-3">
    <h1>Detail Survei</h1>
    <div class="card col-md-6">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td><?= $survei['judul'] ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td><?= $survei['dekripsi'] ?></td>
                </tr>
                <tr>
                    <td>Jadwal Survei</td>
                    <td>:</td>
                    <td><?= $survei['tgl_mulai'] ?> Sampai <?= $survei['tgl_selesai'] ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                        <?php if ($survei['status'] === 'on'): ?>
                            <span class="badge bg-success">On</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Off</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nama Unit</td>
                    <td>:</td>
                    <td><?= $survei['nama_unit'] ?></td>
                </tr>
                <tr>
                    <td>Jenis Unit</td>
                    <td>:</td>
                    <td><?= $survei['jenis_unit'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row m-3 bg-warning">
    <form method="post" action="<?= base_url('responden/layanan/store') ?>" class="row mt-2">
        <?= csrf_field() ?>

        <!-- Bagian Data Responden (Setengah Layar) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
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
            </div>
        </div>

        <!-- Bagian Pertanyaan (Setengah Layar) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>Pertanyaan</h3>
                    <?php
                    $kategoriIndex = 0;
                    foreach ($pertanyaanGrouped as $kategori => $pertanyaans):
                        $kategoriLetter = chr(97 + $kategoriIndex);
                        $kategoriIndex++;
                    ?>
                        <h5 class="fw-bold text-dark"><?= htmlspecialchars($kategoriLetter) ?>: <?= htmlspecialchars($kategori) ?></h5>
                        <?php
                        $pertanyaanIndex = 1;
                        foreach ($pertanyaans as $pertanyaan):
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pertanyaan[]" value="<?= htmlspecialchars($pertanyaan['id']) ?>" disabled>
                                <label class="form-check-label text-dark">
                                    <?= $pertanyaanIndex ?>. <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                                </label>
                            </div>
                            <?php $pertanyaanIndex++; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="col-12 text-center m-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


<?= $this->endSection() ?>