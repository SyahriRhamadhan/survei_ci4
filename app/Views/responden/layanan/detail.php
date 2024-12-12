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
        <input type="hidden" name="token" value="<?= $token ?>">
        <?php if (isset($survei['jenis_unit']) && $survei['jenis_unit'] === 'Unit Layanan'): ?>
            <!-- <div class="col-md-3">
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
                                <option value="alumni">Alumni</option>
                                <option value="mitra">Mitra</option>
                                <option value="umum">Umum</option>
                            </select>
                        </div>

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
                                <select class="fs-6 form-control" name="angkatan">
                                    <option value="" disabled selected>Pilih Tahun</option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="alumniFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Angkatan</label>
                                <select class="fs-6 form-control" name="angkatan">
                                    <option value="" disabled selected>Pilih Tahun</option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
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

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jam Survei</label>
                            <select class="form-control fs-6" name="jam_survei" required>
                                <option value="">Pilih Jam Survei</option>
                                <option value="08.00 - 12.00">08.00 - 12.00</option>
                                <option value="13.00 - 17.00">13.00 - 17.00</option>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('kategori_responden').addEventListener('change', function() {
                        var category = this.value;
                        document.getElementById('mahasiswaFields').style.display = category === 'mahasiswa' ? 'block' : 'none';
                        document.getElementById('dosenFields').style.display = category === 'dosen' ? 'block' : 'none';
                        document.getElementById('tendikFields').style.display = category === 'tendik' ? 'block' : 'none';
                        document.getElementById('alumniFields').style.display = category === 'alumni' ? 'block' : 'none';
                    });
                });
            </script> -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Data Responden</h3>
                        <div class="input-style-1">
                            <label class="text-dark mb-2 fs-6">Kategori Pengguna Layanan<span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori_responden" id="kategori_responden" required>
                                <option value="">Pilih Kategori</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="tendik">Tendik</option>
                                <option value="alumni">Alumni</option>
                                <option value="mitra">Mitra</option>
                                <option value="umum">Umum</option>
                            </select>
                        </div>

                        <div id="mahasiswaFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Prodi<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_prodi" id="id_prodi">
                                    <option value=""></option>
                                    <?php foreach ($prodiList as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>"><?= $prodi['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Angkatan<span class="text-danger">*</span></label>
                                <select class="fs-6 form-control" name="angkatan" id="angkatan_mahasiswa">
                                    <option value="" disabled selected></option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="alumniFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Angkatan<span class="text-danger">*</span></label>
                                <select class="fs-6 form-control" name="angkatan" id="angkatan_alumni">
                                    <option value="" disabled selected></option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="dosenFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Fakultas<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_fakultas" id="id_fakultas">
                                    <option value=""></option>
                                    <?php foreach ($fakultasList as $fakultas): ?>
                                        <option value="<?= $fakultas['id'] ?>"><?= $fakultas['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div id="tendikFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Unit Kerja<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_unit" id="id_unit">
                                    <option value=""></option>
                                    <?php foreach ($unitKerja as $unit): ?>
                                        <option value="<?= $unit['id'] ?>"><?= $unit['nama_unit'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jam Survei<span class="text-danger">*</span></label>
                            <select class="form-control fs-6" name="jam_survei" id="jam_survei" required>
                                <option value="">Pilih Jam Survei</option>
                                <option value="08.00 - 12.00">08.00 - 12.00</option>
                                <option value="13.00 - 17.00">13.00 - 17.00</option>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Umur<span class="text-danger">*</span></label>
                            <input class="fs-6 form-control" type="number" name="umur" id="umur" placeholder="Umur" required />
                        </div>
                        <input type="hidden" name="id_survei" value="<?= $survei['id'] ?>">
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('kategori_responden').addEventListener('change', function() {
                        var category = this.value;

                        // Menyembunyikan semua fields terlebih dahulu
                        document.getElementById('mahasiswaFields').style.display = 'none';
                        document.getElementById('dosenFields').style.display = 'none';
                        document.getElementById('tendikFields').style.display = 'none';
                        document.getElementById('alumniFields').style.display = 'none';

                        // Resetkan atribut required
                        document.getElementById('id_prodi').removeAttribute('required');
                        document.getElementById('angkatan_mahasiswa').removeAttribute('required');
                        document.getElementById('id_fakultas').removeAttribute('required');
                        document.getElementById('id_unit').removeAttribute('required');
                        document.getElementById('angkatan_alumni').removeAttribute('required');

                        // Menampilkan field sesuai kategori yang dipilih
                        if (category === 'mahasiswa') {
                            document.getElementById('mahasiswaFields').style.display = 'block';
                            document.getElementById('id_prodi').setAttribute('required', 'required');
                            document.getElementById('angkatan_mahasiswa').setAttribute('required', 'required');
                        } else if (category === 'dosen') {
                            document.getElementById('dosenFields').style.display = 'block';
                            document.getElementById('id_fakultas').setAttribute('required', 'required');
                        } else if (category === 'tendik') {
                            document.getElementById('tendikFields').style.display = 'block';
                            document.getElementById('id_unit').setAttribute('required', 'required');
                        } else if (category === 'alumni') {
                            document.getElementById('alumniFields').style.display = 'block';
                            document.getElementById('angkatan_alumni').setAttribute('required', 'required');
                        }
                    });
                });
            </script>

        <?php else: ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Data Responden</h3>
                        <div class="input-style-1">
                            <label class="text-dark mb-2 fs-6">Kategori Pengguna Layanan <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori_responden" id="kategori_responden" required>
                                <option value="">Pilih Kategori</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="tendik">Tendik</option>
                                <option value="alumni">Alumni</option>
                                <option value="mitra">Mitra</option>
                                <option value="umum">Umum</option>
                            </select>
                        </div>

                        <div id="mahasiswaFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Prodi<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_prodi" id="prodiDropdown">
                                    <option value="" disabled selected></option>
                                    <?php foreach ($prodiList as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>" <?= ($prodi['nama'] == $survei['jenis_layanan_yang_diterima']) ? 'selected' : '' ?>>
                                            <?= $prodi['nama'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Angkatan<span class="text-danger">*</span></label>
                                <select class="fs-6 form-control" name="angkatan" id="angkatan">
                                    <option value="" disabled selected></option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="alumniFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Angkatan<span class="text-danger">*</span></label>
                                <select class="fs-6 form-control" name="angkatan" id="angkatan1">
                                    <option value="" disabled selected></option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2016; $year--) {
                                        echo "<option value=\"$year\">$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="dosenFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Fakultas<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_fakultas" id="dosenDropdown">
                                    <option value=""></option>
                                    <?php foreach ($fakultasList as $fakultas): ?>
                                        <option value="<?= $fakultas['id'] ?>" <?= ($fakultas['nama'] == $survei['nama_unit']) ? 'selected' : '' ?>>
                                            <?= $fakultas['nama'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div id="tendikFields" style="display: none;">
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Asal Unit Kerja<span class="text-danger">*</span></label>
                                <select class="form-control fs-6" name="id_unit" id="tendikDropdown">
                                    <option value=""></option>
                                    <?php foreach ($unitKerja as $unit): ?>
                                        <option value="<?= $unit['id'] ?>" <?= ($unit['nama_unit'] == $survei['nama_unit']) ? 'selected' : '' ?>>
                                            <?= $unit['nama_unit'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jam Survei<span class="text-danger">*</span></label>
                            <select class="form-control fs-6" name="jam_survei" required>
                                <option value="">Pilih Jam Survei</option>
                                <option value="08.00 - 12.00">08.00 - 12.00</option>
                                <option value="13.00 - 17.00">13.00 - 17.00</option>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="input-style-1 mt-3">
                            <label class="text-dark mb-2 fs-6">Umur<span class="text-danger">*</span></label>
                            <input class="fs-6 form-control" type="number" name="umur" placeholder="Umur" required />
                        </div>
                        <input type="hidden" name="id_survei" value="<?= $survei['id'] ?>">
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Fungsi untuk memilih opsi berdasarkan teks
                    function selectOptionByText(dropdownId, text) {
                        var dropdown = document.getElementById(dropdownId);
                        if (dropdown) {
                            var found = false;
                            for (var i = 0; i < dropdown.options.length; i++) {
                                if (dropdown.options[i].text === text) {
                                    dropdown.options[i].selected = true;
                                    found = true;
                                    break;
                                }
                            }
                            if (!found) {
                                dropdown.value = "";
                            }
                        }
                    }

                    // Event listener untuk menangani perubahan kategori responden
                    document.getElementById('kategori_responden').addEventListener('change', function() {
                        var category = this.value;

                        // Menyembunyikan semua fields terlebih dahulu
                        document.getElementById('mahasiswaFields').style.display = 'none';
                        document.getElementById('dosenFields').style.display = 'none';
                        document.getElementById('tendikFields').style.display = 'none';
                        document.getElementById('alumniFields').style.display = 'none';

                        // Resetkan atribut required hanya jika elemen ada
                        var prodiElement = document.getElementById('prodiDropdown');
                        var angkatanMahasiswaElement = document.getElementById('angkatan');
                        var fakultasElement = document.getElementById('dosenDropdown');
                        var unitElement = document.getElementById('tendikDropdown');
                        var angkatanAlumniElement = document.getElementById('angkatan1');

                        // Hapus atribut required
                        if (prodiElement) prodiElement.removeAttribute('required');
                        if (angkatanMahasiswaElement) angkatanMahasiswaElement.removeAttribute('required');
                        if (fakultasElement) fakultasElement.removeAttribute('required');
                        if (unitElement) unitElement.removeAttribute('required');
                        if (angkatanAlumniElement) angkatanAlumniElement.removeAttribute('required');

                        // Menampilkan field sesuai kategori yang dipilih
                        if (category === 'mahasiswa') {
                            document.getElementById('mahasiswaFields').style.display = 'block';
                            if (prodiElement) prodiElement.setAttribute('required', 'required');
                            if (angkatanMahasiswaElement) angkatanMahasiswaElement.setAttribute('required', 'required');
                        } else if (category === 'dosen') {
                            document.getElementById('dosenFields').style.display = 'block';
                            if (fakultasElement) fakultasElement.setAttribute('required', 'required');
                        } else if (category === 'tendik') {
                            document.getElementById('tendikFields').style.display = 'block';
                            if (unitElement) unitElement.setAttribute('required', 'required');
                        } else if (category === 'alumni') {
                            document.getElementById('alumniFields').style.display = 'block';
                            if (angkatanAlumniElement) angkatanAlumniElement.setAttribute('required', 'required');
                        }
                    });

                    // Menentukan kategori berdasarkan judul survei
                    var judulSurvei = '<?= $survei['judul'] ?>';
                    var kategori = '';

                    if (judulSurvei.includes('mahasiswa')) {
                        kategori = 'mahasiswa';
                    } else if (judulSurvei.includes('dosen')) {
                        kategori = 'dosen';
                    } else if (judulSurvei.includes('tenaga kependidikan')) {
                        kategori = 'tendik';
                    } else if (judulSurvei.includes('mitra')) {
                        kategori = 'mitra';
                    }

                    // Jika kategori ditemukan, pilih kategori dan tampilkan field yang relevan
                    if (kategori) {
                        document.getElementById('kategori_responden').value = kategori;

                        // Tampilkan fields yang relevan berdasarkan kategori
                        document.getElementById('mahasiswaFields').style.display = kategori === 'mahasiswa' ? 'block' : 'none';
                        document.getElementById('dosenFields').style.display = kategori === 'dosen' ? 'block' : 'none';
                        document.getElementById('tendikFields').style.display = kategori === 'tendik' ? 'block' : 'none';
                        document.getElementById('alumniFields').style.display = kategori === 'alumni' ? 'block' : 'none';
                    }

                    // Mengatur nilai dropdown sesuai dengan data dari server
                    selectOptionByText('prodiDropdown', '<?= $survei['jenis_layanan_yang_diterima'] ?>');
                    selectOptionByText('dosenDropdown', '<?= $survei['nama_unit'] ?>');
                    selectOptionByText('tendikDropdown', '<?= $survei['nama_unit'] ?>');
                });
            </script>
            <!-- <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Fungsi untuk memilih opsi berdasarkan teks
                    function selectOptionByText(dropdownId, text) {
                        var dropdown = document.getElementById(dropdownId);
                        var found = false;
                        for (var i = 0; i < dropdown.options.length; i++) {
                            if (dropdown.options[i].text === text) {
                                dropdown.options[i].selected = true;
                                found = true;
                                break;
                            }
                        }
                        if (!found) {
                            dropdown.value = "";
                        }
                    }

                    // Event listener untuk menangani perubahan kategori responden
                    document.getElementById('kategori_responden').addEventListener('change', function() {
                        var category = this.value;

                        // Menampilkan atau menyembunyikan field berdasarkan kategori yang dipilih
                        document.getElementById('mahasiswaFields').style.display = category === 'mahasiswa' ? 'block' : 'none';
                        document.getElementById('dosenFields').style.display = category === 'dosen' ? 'block' : 'none';
                        document.getElementById('tendikFields').style.display = category === 'tendik' ? 'block' : 'none';
                        document.getElementById('alumniFields').style.display = category === 'alumni' ? 'block' : 'none';
                        
                    });


                    // Menentukan kategori berdasarkan judul survei
                    var judulSurvei = '<?= $survei['judul'] ?>';
                    var kategori = '';

                    if (judulSurvei.includes('mahasiswa')) {
                        kategori = 'mahasiswa';
                    } else if (judulSurvei.includes('dosen')) {
                        kategori = 'dosen';
                    } else if (judulSurvei.includes('tenaga kependidikan')) {
                        kategori = 'tendik';
                    } else if (judulSurvei.includes('mitra')) {
                        kategori = 'mitra';
                    }

                    // Jika kategori ditemukan, pilih kategori dan tampilkan field yang relevan
                    if (kategori) {
                        document.getElementById('kategori_responden').value = kategori;

                        document.getElementById('mahasiswaFields').style.display = kategori === 'mahasiswa' ? 'block' : 'none';
                        document.getElementById('dosenFields').style.display = kategori === 'dosen' ? 'block' : 'none';
                        document.getElementById('tendikFields').style.display = kategori === 'tendik' ? 'block' : 'none';
                        document.getElementById('alumniFields').style.display = kategori === 'alumni' ? 'block' : 'none';
                    }

                    // Mengatur nilai dropdown sesuai dengan data dari server
                    selectOptionByText('prodiDropdown', '<?= $survei['jenis_layanan_yang_diterima'] ?>');
                    selectOptionByText('dosenDropdown', '<?= $survei['nama_unit'] ?>');
                    selectOptionByText('tendikDropdown', '<?= $survei['nama_unit'] ?>');
                });
            </script> -->
        <?php endif; ?>

        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h3>Pertanyaan</h3>
                    <p class="text-dark">4 = Sangat Setuju/Sangat Baik, 3 = Setuju/Baik, 2 = Kurang Setuju/Cukup, 1 = Sangat Tidak Setuju/kurang</p>
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
                                <label class="text-dark">
                                    <?= $pertanyaanIndex ?>. <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                                </label>

                                <div class="d-flex">
                                    <?php for ($i = 4; $i >= 1; $i--): ?>
                                        <div class="form-check form-check-inline ms-3">
                                            <input class="form-check-input border border-dark border-1" type="radio" name="penilaian[<?= $pertanyaan['id'] ?>]" value="<?= $i ?>" required>
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

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kategori_responden').addEventListener('change', function() {
            var category = this.value;
            document.getElementById('mahasiswaFields').style.display = category === 'mahasiswa' ? 'block' : 'none';
            document.getElementById('dosenFields').style.display = category === 'dosen' ? 'block' : 'none';
            document.getElementById('tendikFields').style.display = category === 'tendik' ? 'block' : 'none';
            document.getElementById('alumniFields').style.display = category === 'alumni' ? 'block' : 'none';
        });
    });
</script> -->
<?= $this->endSection() ?>