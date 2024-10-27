<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2><?= $title ?></h2>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<a href="<?= base_url('admin/pertanyaan/create') ?>" class="btn btn-primary">
    <svg class='me-2' xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
        <path d="M13.5 6.5l4 4" />
        <path d="M16 19h6" />
        <path d="M19 16v6" />
    </svg>
    Add Data
</a>

<table class="table" id="datatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Pertanyaan</th>
            <th>Tipe/Kategori Pertanyaan</th>
            <th>No Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($pertanyaan as $per) : ?>
            <tr>
                <td><?= $no++ ?>.</td>
                <td><?= $per['pertanyaan'] ?></td>
                <td><?= $per['tipe_pertanyaan'] ?></td>
                <td>
                    <a href="<?= base_url('admin/pertanyaan/edit/' . $per['id']) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= base_url('admin/pertanyaan/delete/' . $per['id']) ?>" class="btn btn-danger tombol-hapus">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>