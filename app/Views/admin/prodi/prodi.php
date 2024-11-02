<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-2"><?=$title?></h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/auth/login">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/admin/prodi">Prodi</a>
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
                                
                                <a href="<?= base_url('admin/prodi/create') ?>" class="btn btn-primary mb-3 fs-6">
                                    <svg class='me-1' xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                    </svg>
                                    Tambah Prodi
                                </a>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Prodi</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1;
                                            foreach ($prodi as $per) : ?>
                                                <tr>
                                                    <td><?= $no++ ?>.</td>
                                                    <td><?= htmlspecialchars($per['nama']) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('admin/prodi/edit/' . $per['id']) ?>" class="btn btn-primary">Edit</a>
                                                        <a href="<?= base_url('admin/prodi/delete/' . $per['id']) ?>" class="btn btn-danger tombol-hapus">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>No</th>
                                            <th>Prodi</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>


<?= $this->endSection() ?>