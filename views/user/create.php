<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Data Guru Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text" class="form-control" name="username" required>
                            <small class="text-muted">Username untuk login</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="full_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Role *</label>
                            <select name="role" class="form-select" required>
                                <option value="guru">Guru</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password *</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        💾 Simpan Data Guru
                    </button>
                    <a href="index.php?controller=UserController&action=index" class="btn btn-secondary">
                        ↩️ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>