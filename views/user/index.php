<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen User Guru</h2>
        <a href="index.php?controller=UserController&action=create" class="btn btn-primary">+ Tambah Guru</a>
    </div>

    <?php if (empty($users)): ?>
        <div class="alert alert-info">Belum ada data user.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->full_name; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td>
                                <span class="badge bg-<?php echo $user->role == 'admin' ? 'danger' : 'success'; ?>">
                                    <?php echo ucfirst($user->role); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($user->created_at)); ?></td>
                            <td>
                                <a href="index.php?controller=UserController&action=edit&id=<?php echo $user->id; ?>"
                                    class="btn btn-warning btn-sm">✏️ Edit</a>

                                <?php if ($user->id != $_SESSION['user_id']): ?>
                                    <a href="index.php?controller=UserController&action=delete&id=<?php echo $user->id; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus user <?php echo $user->full_name; ?>?')">🗑️ Hapus</a>
                                <?php else: ?>
                                    <span class="text-muted">User aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>