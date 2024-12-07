<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container row m-3 d-flex justify-content-center">
    <div class="card col-md">
        <div class="card-body">
            <h1 class="text-center">Welcome, <?= esc($user_name); ?>! <span>as <?= esc($user_role); ?></span></h1>
            <?php if (session('akses') == 'yes'): ?>
                <?php if ($filter): ?>
                    <div class="filter-details col-md">
                        <form action="/admin/update-status" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <div class="row mx-5">
                                    <div class="col-md mx-5">
                                        <!-- Menampilkan pesan error jika ada -->
                                        <?php if (session()->getFlashdata('error')): ?>
                                            <div class="alert alert-danger">
                                                <?= session()->getFlashdata('error') ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (session()->getFlashdata('status')): ?>
                                            <div class="alert alert-success">
                                                <?= session()->getFlashdata('status') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <label for="status">Atur Visibilitas Filter:</label>
                                <span class="text-success">*Harap Menonaktifkan Filter jika trafik sedang tinggi</span>
                                <select name="status" id="status" class="form-control">
                                    <option value="on" <?= ($filter['value'] == 'on') ? 'selected' : '' ?>>On</option>
                                    <option value="off" <?= ($filter['value'] == 'off') ? 'selected' : '' ?>>Off</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p>No filter data found with ID = 1.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="card col-md-6">
        <div class="card-body justify-content-center">
            <h4 class="card-title text-center">Hasil Survei Tingkat Unit</h4>
            <form class="mt-4" action="<?= base_url('admin/chartfilterunit') ?>" method="get" onsubmit="showLoading(); return redirectToRoute(this)">
                <div class="input-group">
                    <select class="form-select" name="unit_name" id="unit_name" required>
                        <option selected disabled>Choose...</option>
                        <?php
                        $addedUnits = []; // Array untuk melacak nama unit yang sudah ditambahkan
                        foreach ($filter2 as $unit):
                            if (!in_array($unit['nama_unit'], $addedUnits)): // Periksa apakah unit sudah ditambahkan
                        ?>
                                <option value="<?= urlencode($unit['nama_unit']) ?>"><?= $unit['nama_unit'] ?></option>
                                <?php
                                $addedUnits[] = $unit['nama_unit']; // Tambahkan nama unit ke array pelacakan
                                ?>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </select>
                    <button class="btn ms-2 btn-success" type="submit">Submit</button>
                </div>
            </form>

            <div id="loading" style="display:none; text-align: center; margin-top: 10px;">
                <p><span class="text-success">Data di proses & direkap secara realtime, mohon tunggu...</span></p>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showLoading() {
            document.getElementById('loading').style.display = 'block';

            document.querySelector('button[type="submit"]').disabled = true;
        }
    </script>


    <div class="card col-md-6">
        <div class="card-body justify-content-center">
            <h4 class="card-title text-start">Hasil Survei Tingkat Unit Layanan</h4>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Cek Survei
                </button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalToggleLabel">Filter Hasil Survei</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="example-table1"></div>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.5.1/js/tabulator.min.js"></script>

                                        <script>
                                            // Tabulator configuration
                                            var table = new Tabulator("#example-table1", {
                                                height: "500px",
                                                layout: "fitColumns",
                                                columns: [{
                                                        title: "No",
                                                        field: "no",
                                                        width: 50,
                                                        headerFilter: "input"
                                                    },
                                                    {
                                                        title: "Judul",
                                                        field: "judul",
                                                        headerFilter: "input"
                                                    },
                                                    {
                                                        title: "Nama Unit",
                                                        field: "nama_unit",
                                                        headerFilter: "input"
                                                    },
                                                    {
                                                        title: "Jenis Unit",
                                                        field: "jenis_unit",
                                                        headerFilter: "input"
                                                    },
                                                    {
                                                        title: "Jenis Layanan/Prodi",
                                                        field: "jenis_layanan",
                                                        headerFilter: "input"
                                                    },
                                                    {
                                                        title: "Cek Hasil",
                                                        field: "cek_hasil",
                                                        formatter: "html",
                                                        headerFilter: false
                                                    },
                                                ],
                                                data: [
                                                    <?php foreach ($unitList as $no => $s) : ?> {
                                                            no: <?= $no + 1 ?>,
                                                            judul: "<?= htmlspecialchars($s['judul']) ?>",
                                                            nama_unit: "<?= htmlspecialchars($s['nama_unit']) ?>",
                                                            jenis_unit: "<?= htmlspecialchars($s['jenis_unit']) ?>",
                                                            jenis_layanan: "<?= htmlspecialchars($s['jenis_layanan_yang_diterima']) ?>",
                                                            cek_hasil: '<a href="<?= base_url('responden/chartfilter/' . $s['id']) ?>" class="btn btn-primary" target="_blank" >Hasil Survei</a>',
                                                        }
                                                        <?php if ($no !== count($unitList) - 1) echo ','; ?>
                                                    <?php endforeach; ?>
                                                ],
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function redirectToRoute(form) {
        const selectedUnitName = document.getElementById('unit_name').value;
        if (!selectedUnitName) return false;
        window.location.href = `<?= base_url('admin/chartfilterunit') ?>/${selectedUnitName}`;
        return false;
    }
</script>

<?= $this->endSection() ?>