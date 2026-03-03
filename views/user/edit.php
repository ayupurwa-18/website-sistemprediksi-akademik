<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>Edit Data Guru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text" class="form-control" name="username"
                                value="<?php echo $user->username; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="full_name"
                                value="<?php echo $user->full_name; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email"
                                value="<?php echo $user->email; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Role *</label>
                            <select name="role" class="form-select" required>
                                <option value="guru" <?php echo $user->role == 'guru' ? 'selected' : ''; ?>>Guru</option>
                                <option value="admin" <?php echo $user->role == 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="alert alert-info">
                                <small>⚠️ Untuk mengganti password, gunakan menu <strong>Ganti Password</strong></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-warning me-md-2">
                        ✏️ Update Data
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