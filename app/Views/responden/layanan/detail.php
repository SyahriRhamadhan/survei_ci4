<?= $this->extend('responden/layout') ?>

<?= $this->section('content') ?>

<div class="row m-3">
    <h1>Detail Survei</h1>
    <div class="card col-md-12">
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
                <tr>
                    <td>Jenis Layanan</td>
                    <td>:</td>
                    <td><?= $survei['jenis_layanan_yang_diterima'] ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row m-3 justify-content-center">
    <form method="post" action="<?= base_url('responden/layanan/store') ?>" class="row mt-2">
        <?= csrf_field() ?>

        <!-- Bagian Data Responden (Setengah Layar) -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Data Responden</h3>

                    <div class="input-style-1">
                        <label class="text-dark mb-2 fs-6">Kategori Pengguna Layanan</label>
                        <select class="form-control" name="kategori_responden" id="kategori_responden" required>
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
                            <select class="form-control fs-6" name="id_prodi">
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
                            <select class="form-control fs-6" name="id_fakultas">
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
                            <select class="form-control fs-6" name="id_unit">
                                <option value="">Pilih Unit Kerja</option>
                                <?php foreach ($unitKerja as $unit): ?>
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
                        <input class="fs-6 form-control" type="number" name="umur" placeholder="Umur" required />
                    </div>
                    <input type="hidden" name="id_survei" value="<?= $survei['id'] ?>">
                </div>
            </div>
        </div>

        <!-- Bagian Pertanyaan (Setengah Layar) -->
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h3>Pertanyaan</h3>
                    <p class="text-dark">4 = Sangat Setuju, 3 = Setuju, 2 = Kurang Setuju, 1 = Sangat Tidak Setuju</p>
                    <?php
                    $kategoriIndex = 0;
                    foreach ($pertanyaanGrouped as $kategori => $pertanyaans):
                        $kategoriLetter = chr(97 + $kategoriIndex);
                        $kategoriIndex++;
                    ?>
                        <h5 class="fw-bold">Kategori <?= htmlspecialchars($kategoriLetter) ?> = <?= htmlspecialchars($kategori) ?></h5>
                        <?php
                        $pertanyaanIndex = 1;
                        foreach ($pertanyaans as $pertanyaan):
                        ?>
                            <div class="mb-3 ms-3">
                                <!-- Label Pertanyaan -->
                                <label class="text-dark">
                                    <?= $pertanyaanIndex ?>. <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                                </label>

                                <!-- Radio button untuk penilaian (1-4) -->
                                <div class="d-flex">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                        <div class="form-check form-check-inline ms-3">
                                            <input class="form-check-input" type="radio" name="penilaian[<?= $pertanyaan['id'] ?>]" value="<?= $i ?>" required>
                                            <label class="form-check-label"><?= $i ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php $pertanyaanIndex++; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="input-style-1 mt-3">
                    <label class=" mb-2 fs-6">
                        <h3>Saran & Masukan</h3>
                    </label>
                    <textarea class="fs-6 form-control" name="saran_masukan" placeholder="Tulis saran dan masukan Anda di sini..." rows="4"></textarea>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


<?= $this->endSection() ?>