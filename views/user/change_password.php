<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4>🔐 Ganti Password</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini *</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru *</label>
                            <input type="password" class="form-control" name="new_password" required>
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru *</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                🔄 Ganti Password
                            </button>
                            <a href="index.php?controller=DashboardController&action=index" class="btn btn-secondary">
                                ↩️ Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>