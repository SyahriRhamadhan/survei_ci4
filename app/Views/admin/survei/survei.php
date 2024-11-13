<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-2"><?= $title ?></h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="/auth/login">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/admin/survei">Survei</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class=" fs-3">Pertanyaan</h4> -->
                    <a href="<?= base_url('admin/survei/create') ?>" class="btn btn-primary mb-3 fs-6">
                        <svg class='me-1' xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                            <path d="M13.5 6.5l4 4" />
                            <path d="M16 19h6" />
                            <path d="M19 16v6" />
                        </svg>
                        Tambah Survei
                    </a>
                    <div id="example-table2"></div>
                    <!-- <div class="table-responsive">
                        <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Survei</th>
                                    <th>Nama Unit</th>
                                    <th>Jenis Unit</th>
                                    <th>Status</th>
                                    <th>Jenis Layanan/Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($survei as $s) : ?>
                                    <tr>
                                        <td><?= $no++ ?>.</td>
                                        <td><?= htmlspecialchars($s['tahun_ajaran']) ?> - <?= htmlspecialchars($s['semester']) ?></td>
                                        <td><?= htmlspecialchars($s['judul']) ?></td>
                                        <td><?= htmlspecialchars($s['nama_unit']) ?></td>
                                        <td><?= htmlspecialchars($s['jenis_unit']) ?></td>
                                        <td>
                                            <?php if ($s['status'] === 'on'): ?>
                                                <span class="badge bg-success">On</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Off</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($s['jenis_layanan_yang_diterima']) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/survei/edit/' . $s['id']) ?>" class="btn btn-primary">Edit</a>
                                            <a href="<?= base_url('admin/survei/delete/' . $s['id']) ?>" class="btn btn-danger tombol-hapus">Delete</a>
                                            <a href="<?= base_url('admin/survei/detail/' . $s['id']) ?>" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Survei</th>
                                    <th>Nama Unit</th>
                                    <th>Jenis Unit</th>
                                    <th>Status</th>
                                    <th>Jenis Layanan/Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.5.1/js/tabulator.min.js"></script>
<script>
    // Konfigurasi Tabulator
    var table = new Tabulator("#example-table2", {
        height: "900px",
        layout: "fitColumns",
        columns: [{
                title: "No",
                field: "no",
                width: 50,
                headerFilter: "input"
            },
            {
                title: "Survei",
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
                width: 100,
                headerFilter: "input"
            },
            {
                title: "Status",
                field: "status",
                formatter: "html",
                width: 85,
                headerFilter: false
            },
            {
                title: "Jenis Layanan/Prodi",
                field: "jenis_layanan",
                headerFilter: "input"
            },
            {
                title: "Aksi",
                field: "aksi",
                formatter: "html",
                headerFilter: false
            },
        ],
        data: [
            <?php foreach ($survei as $no => $s) : ?> {
                    no: <?= $no + 1 ?>,
                    judul: "<?= htmlspecialchars($s['judul']) ?>",
                    nama_unit: "<?= htmlspecialchars($s['nama_unit']) ?>",
                    jenis_unit: "<?= htmlspecialchars($s['jenis_unit']) ?>",
                    status: `<?php if ($s['status'] === 'on'): ?>
                             <span class="badge bg-success">On</span>
                         <?php else: ?>
                             <span class="badge bg-danger">Off</span>
                         <?php endif; ?>`,
                    jenis_layanan: "<?= htmlspecialchars($s['jenis_layanan_yang_diterima']) ?>",
                    aksi: `<a href="<?= base_url('admin/survei/edit/' . $s['id']) ?>" class="btn btn-primary">Edit</a>
                       <a href="<?= base_url('admin/survei/delete/' . $s['id']) ?>" class="btn btn-danger tombol-hapus">Delete</a>
                       <a href="<?= base_url('admin/survei/detail/' . $s['id']) ?>" class="btn btn-primary">Detail</a>`,
                },
            <?php endforeach; ?>
        ],
    });
</script>

<?= $this->endSection() ?>