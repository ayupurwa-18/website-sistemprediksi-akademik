<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Siswa</h2>
        <?php if ($_SESSION['user_role'] == 'admin'): ?>
            <a href="index.php?controller=StudentController&action=create" class="btn btn-primary">Tambah Siswa</a>
        <?php endif; ?>
    </div>

    <?php if (empty($students)): ?>
        <div class="alert alert-info">
            Belum ada data siswa. <a href="index.php?controller=StudentController&action=create" class="alert-link">Tambah siswa pertama</a>.
        </div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student->nis; ?></td>
                        <td><?php echo $student->name; ?></td>
                        <td><?php echo $student->class; ?></td>
                        <td>
                            <a href="index.php?controller=StudentController&action=show&id=<?php echo $student->id; ?>"
                                class="btn btn-info btn-sm">📋 Detail</a>

                            <?php if ($_SESSION['user_role'] == 'admin'): ?>
                                <a href="index.php?controller=StudentController&action=edit&id=<?php echo $student->id; ?>"
                                    class="btn btn-warning btn-sm">✏️ Edit</a>
                                <a href="index.php?controller=StudentController&action=delete&id=<?php echo $student->id; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus siswa <?php echo $student->name; ?>?')">🗑️ Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>