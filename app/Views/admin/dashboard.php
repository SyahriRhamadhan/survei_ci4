<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container row">
    <div class="card col-md-6">
        <div class="card-body">
            <h1>Welcome, <?= esc($user_name); ?>! <span>as <?= esc($user_role); ?></span>
            </h1>
        </div>
        <?php if ($filter): ?>
            <div class="filter-details col-md m-5 ">
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
    <div class="card col-md-6">
        <div class="card-body justify-content-center">
            <h4 class="card-title text-center">Hasil Survei Tingkat Unit</h4>
            <form class="mt-4" action="<?= base_url('admin/chartfilterunit') ?>" method="get" onsubmit="return redirectToRoute(this)">
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