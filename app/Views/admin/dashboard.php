<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container row">
    <h1><?= esc($title) ?></h1>

    <?php if ($filter): ?>
        <div class="filter-details col-md-4 ">
            <form action="/admin/update-status" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="status">Atur Visibilitas Filter:</label>
                    <span class="text-success">*Harap Menonaktifkan Filter jika trafic sedang tinggi</span>
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

</div>

<?= $this->endSection() ?>