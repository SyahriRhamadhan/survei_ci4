<?= $this->extend('responden/layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="card col-md-4">
            <div class="card-body">
                <div class=" align-self-center">
                    <h3 class="page-title text-truncate text-dark font-weight-medium mb-3">Survei Kepuasan Layanan</h3>
                </div>
                <form>
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md">
                            <h3>Instrumen survei kepuasan Unit Layanan di lingkungan UMRAH</h3>
                            <div class="input-style-1 mt-3">
                                <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                <select class="form-control fs-6" id="unit_layanan" name="unit_layanan" onchange="filterJenisLayanan()">
                                    <option value="">Pilih Unit Layanan</option>
                                    <?php
                                    $unitSeen = [];
                                    foreach ($unitList as $unit):
                                        if (in_array($unit['nama_unit'], $unitSeen)) {
                                            continue;
                                        }
                                        $unitSeen[] = $unit['nama_unit'];
                                    ?>
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
                        <button type="button" class="btn btn-primary" onclick="goToDetail1()">Isi Survei</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- sisi setengahnya -->
        <div class="card col-md-7 ms-3">
            <div class="card-body">
                <div class="row">
                    <div class="align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-3">Instrumen Survei Kepuasan UPPS</h3>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Data Responden</h3>
                            <div class="input-style-1">
                                <label class="text-dark mb-2 fs-6">Kategori Pengguna Layanan</label>
                                <select class="form-control" id="kategori_responden" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="mahasiswa">Mahasiswa</option>
                                    <option value="dosen">Dosen</option>
                                    <option value="tendik">Tendik</option>
                                    <option value="mitra">Mitra</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Instrumen survei kepuasan mahasiswa di UPPS -->
                    <div class="card " id="card_mahasiswa" style="display: none;">
                        <div class="card-body">
                            <form>
                                <?= csrf_field() ?>
                                <div class="col-md">
                                    <h3>Instrumen survei kepuasan mahasiswa di UPPS</h3>
                                    <div class="input-style-1 mt-3">
                                        <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                        <select class="form-control fs-6" id="unit_layanan_mhs" name="unit_layanan" onchange="filterJenisLayanan('mhs')">
                                            <option value="">Pilih Unit Layanan</option>
                                            <?php
                                            $unitSeen = [];
                                            foreach ($mahasiswa as $unit):
                                                if (in_array($unit['nama_unit'], $unitSeen)) {
                                                    continue;
                                                }
                                                $unitSeen[] = $unit['nama_unit'];
                                            ?>
                                                <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                                    <?= htmlspecialchars($unit['nama_unit']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="input-style-1 mt-3">
                                        <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                                        <select class="form-control fs-6" id="jenis_layanan_yang_diterima_mhs" name="jenis_layanan_yang_diterima">
                                            <option value="">Pilih Jenis Layanan yang Diterima</option>
                                            <?php foreach ($mahasiswa as $unit): ?>
                                                <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                                    <option class="jenis-option-mhs" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                                        <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-primary" onclick="goToDetail('mhs')">Isi Survei</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Dosen -->
                    <div class="card " id="card_dosen" style="display: none;">
                        <div class="card-body">
                            <form>
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md">
                                        <h3>Instrumen survei kepuasan dosen di UPPS</h3>
                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                            <select class="form-control fs-6" id="unit_layanan_dosen" name="unit_layanan" onchange="filterJenisLayanan('dosen')">
                                                <option value="">Pilih Unit Layanan</option>
                                                <?php
                                                $unitSeen = [];
                                                foreach ($dosen as $unit):
                                                    if (in_array($unit['nama_unit'], $unitSeen)) {
                                                        continue;
                                                    }
                                                    $unitSeen[] = $unit['nama_unit'];
                                                ?>
                                                    <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                                        <?= htmlspecialchars($unit['nama_unit']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                                            <select class="form-control fs-6" id="jenis_layanan_yang_diterima_dosen" name="jenis_layanan_yang_diterima">
                                                <option value="">Pilih Jenis Layanan yang Diterima</option>
                                                <?php foreach ($dosen as $unit): ?>
                                                    <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                                        <option class="jenis-option-dosen" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                                            <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-primary" onclick="goToDetail('dosen')">Isi Survei</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- tendik -->
                    <div class="card " id="card_tendik" style="display: none;">
                        <div class="card-body">
                            <form>
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md">
                                        <h3>Instrumen survei kepuasan tenaga pendidikan di UPPS</h3>
                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                            <select class="form-control fs-6" id="unit_layanan_tendik" name="unit_layanan" onchange="filterJenisLayanan('tendik')">
                                                <option value="">Pilih Unit Layanan</option>
                                                <?php
                                                $unitSeen = [];
                                                foreach ($tendik as $unit):
                                                    if (in_array($unit['nama_unit'], $unitSeen)) {
                                                        continue;
                                                    }
                                                    $unitSeen[] = $unit['nama_unit'];
                                                ?>
                                                    <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                                        <?= htmlspecialchars($unit['nama_unit']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                                            <select class="form-control fs-6" id="jenis_layanan_yang_diterima_tendik" name="jenis_layanan_yang_diterima">
                                                <option value="">Pilih Jenis Layanan yang Diterima</option>
                                                <?php foreach ($tendik as $unit): ?>
                                                    <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                                        <option class="jenis-option-tendik" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                                            <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-primary" onclick="goToDetail('tendik')">Isi Survei</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- mitra -->
                    <div class="card " id="card_mitra" style="display: none;">
                        <div class=" card-body">
                            <form>
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md">
                                        <h3>Instrumen survei kepuasan mitra di UPPS</h3>
                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Unit Layanan</label>
                                            <select class="form-control fs-6" id="unit_layanan_mitra" name="unit_layanan" onchange="filterJenisLayanan('mitra')">
                                                <option value="">Pilih Unit Layanan</option>
                                                <?php
                                                $unitSeen = [];
                                                foreach ($mitra as $unit):
                                                    if (in_array($unit['nama_unit'], $unitSeen)) {
                                                        continue;
                                                    }
                                                    $unitSeen[] = $unit['nama_unit'];
                                                ?>
                                                    <option value="<?= htmlspecialchars($unit['nama_unit']) ?>" data-jenis="<?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>">
                                                        <?= htmlspecialchars($unit['nama_unit']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="input-style-1 mt-3">
                                            <label class="text-dark mb-2 fs-6">Jenis Layanan yang Diterima</label>
                                            <select class="form-control fs-6" id="jenis_layanan_yang_diterima_mitra" name="jenis_layanan_yang_diterima">
                                                <option value="">Pilih Jenis Layanan yang Diterima</option>
                                                <?php foreach ($mitra as $unit): ?>
                                                    <?php if (!empty($unit['jenis_layanan_yang_diterima'])): ?>
                                                        <option class="jenis-option-mitra" value="<?= htmlspecialchars($unit['id']) ?>" data-unit="<?= htmlspecialchars($unit['nama_unit']) ?>">
                                                            <?= htmlspecialchars($unit['jenis_layanan_yang_diterima']) ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="button" class="btn btn-primary" onclick="goToDetail('mitra')">Isi Survei</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function filterJenisLayanan() {
            const unitLayanan = document.getElementById('unit_layanan').value; // Ambil nilai Unit Layanan
            const jenisLayananSelect = document.getElementById('jenis_layanan_yang_diterima'); // Dropdown Jenis Layanan
            const jenisOptions = document.querySelectorAll('.jenis-option'); // Semua opsi di dropdown Jenis Layanan

            jenisLayananSelect.value = '';
            jenisOptions.forEach(option => {
                option.style.display = 'none';
            });
            if (unitLayanan) {
                jenisOptions.forEach(option => {
                    if (option.getAttribute('data-unit') === unitLayanan) {
                        option.style.display = 'block';
                    }
                });
            }
        }

        function goToDetail1() {
            const unitLayanan = document.getElementById('unit_layanan').value;
            const jenisLayananYangDiterima = document.getElementById('jenis_layanan_yang_diterima').value;

            if (unitLayanan && jenisLayananYangDiterima) {
                const url = `<?= base_url('responden/survei/detail') ?>/${jenisLayananYangDiterima}`;
                window.location.href = url;
            } else {
                alert("Silakan pilih Unit Layanan dan Jenis Layanan yang Diterima terlebih dahulu.");
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function filterJenisLayanan(type) {
                const unitLayanan = document.getElementById(`unit_layanan_${type}`);
                const jenisLayananSelect = document.getElementById(`jenis_layanan_yang_diterima_${type}`);
                const jenisOptions = document.querySelectorAll(`.jenis-option-${type}`);

                if (unitLayanan && jenisLayananSelect && jenisOptions) {
                    jenisLayananSelect.value = '';
                    jenisOptions.forEach(option => {
                        option.style.display = option.getAttribute('data-unit') === unitLayanan.value ? 'block' : 'none';
                    });
                }
            }

            function goToDetail(type) {
                const unitLayanan = document.getElementById(`unit_layanan_${type}`).value;
                const jenisLayananYangDiterima = document.getElementById(`jenis_layanan_yang_diterima_${type}`).value;

                if (!unitLayanan) {
                    alert("Silakan pilih Unit Layanan terlebih dahulu.");
                    return; // Hentikan eksekusi
                }

                if (!jenisLayananYangDiterima) {
                    alert("Silakan pilih Jenis Layanan yang Diterima terlebih dahulu.");
                    return; // Hentikan eksekusi
                }

                // Redirect jika semua validasi terpenuhi
                const url = `<?= base_url('responden/survei/detail') ?>/${jenisLayananYangDiterima}`;
                window.location.href = url;
            }

            // Attach onchange handlers dynamically for each form
            ['mhs', 'dosen', 'tendik', 'mitra'].forEach(type => {
                const unitLayanan = document.getElementById(`unit_layanan_${type}`);
                if (unitLayanan) {
                    unitLayanan.addEventListener('change', () => filterJenisLayanan(type));
                }

                const goToDetailButton = document.querySelector(`button[onclick="goToDetail('${type}')"]`);
                if (goToDetailButton) {
                    goToDetailButton.addEventListener('click', () => goToDetail(type));
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const kategoriDropdown = document.getElementById("kategori_responden");

            // Function to handle visibility of cards
            function handleCardVisibility() {
                const kategori = kategoriDropdown.value;

                document.getElementById("card_mahasiswa").style.display = "none";
                document.getElementById("card_dosen").style.display = "none";
                document.getElementById("card_tendik").style.display = "none";
                document.getElementById("card_mitra").style.display = "none";

                if (kategori === "mahasiswa") {
                    document.getElementById("card_mahasiswa").style.display = "block";
                } else if (kategori === "dosen") {
                    document.getElementById("card_dosen").style.display = "block";
                } else if (kategori === "tendik") {
                    document.getElementById("card_tendik").style.display = "block";
                } else if (kategori === "mitra" || kategori === "umum") {
                    document.getElementById("card_mitra").style.display = "block";
                }
            }

            // Attach event listener to dropdown
            kategoriDropdown.addEventListener("change", handleCardVisibility);
        });
    </script>
</div>
<?= $this->endSection() ?>