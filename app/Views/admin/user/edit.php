<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-3"><?= $title ?></h3>
        </div>
    </div>
    <div class="card col-md-6 mx-auto">
        <div class="card-body">
            <a href="<?= base_url('admin/user') ?>" class="btn btn-primary mb-3 fs-6">
                <svg width="16" height="15" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 199.404 199.404" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876 199.404,117.876 "></polygon>
                        </g>
                    </g>
                </svg>
                Kembali
            </a>
            <form method="post" action="<?= base_url('admin/user/update/' . $user['id']) ?>">
                <?= csrf_field() ?>

                <!-- Nama -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Nama User</label>
                    <input class="fs-6 form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>"
                        type="text"
                        name="name"
                        placeholder="Budi"
                        value="<?= old('name', $user['name']) ?>" />
                    <div class="invalid-feedback">
                        <?= session('validation') ? session('validation')->getError('name') : '' ?>
                    </div>
                </div>

                <!-- Email -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Email</label>
                    <input class="fs-6 form-control <?= session('validation') && session('validation')->hasError('email') ? 'is-invalid' : '' ?>"
                        type="email"
                        name="email"
                        placeholder="Email"
                        value="<?= old('email', $user['email']) ?>" />
                    <div class="invalid-feedback">
                        <?= session('validation') ? session('validation')->getError('email') : '' ?>
                    </div>
                </div>

                <!-- Role -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Role</label>
                    <select class="fs-6 form-control <?= session('validation') && session('validation')->hasError('role') ? 'is-invalid' : '' ?>"
                        name="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('validation') ? session('validation')->getError('role') : '' ?>
                    </div>
                </div>

                <!-- Yes/No Dropdown -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Full Akses?</label>
                    <select class="fs-6 form-control <?= session('validation') && session('validation')->hasError('akses') ? 'is-invalid' : '' ?>"
                        name="akses">
                        <option value="yes" <?= old('akses', $user['akses']) == 'yes' ? 'selected' : '' ?>>Yes</option>
                        <option value="no" <?= old('akses', $user['akses']) == 'no' ? 'selected' : '' ?>>No</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('validation') ? session('validation')->getError('akses') : '' ?>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Password</label>
                    <div class="input-group">
                        <input id="password"
                            class="fs-6 form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>"
                            type="password"
                            name="password"
                            placeholder="Password" />
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                        <div class="invalid-feedback">
                            <?= session('validation') ? session('validation')->getError('password') : '' ?>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-style-1">
                    <label class="text-dark mb-2 fs-6">Konfirmasi Password</label>
                    <div class="input-group">
                        <input id="password_confirmation"
                            class="fs-6 form-control <?= session('validation') && session('validation')->hasError('password_confirmation') ? 'is-invalid' : '' ?>"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi Password" />
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                            <i class="fa fa-eye"></i>
                        </button>
                        <div class="invalid-feedback">
                            <?= session('validation') ? session('validation')->getError('password_confirmation') : '' ?>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk Toggle Password -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const passwordInput = document.getElementById('password_confirmation');
        const toggleIcon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    });
</script>

<?= $this->endSection() ?>