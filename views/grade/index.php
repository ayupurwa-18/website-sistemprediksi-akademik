<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Nilai Siswa</h2>
        <?php if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'guru'): ?>
            <a href="index.php?controller=GradeController&action=add" class="btn btn-primary">Tambah Nilai</a>
        <?php endif; ?>
    </div>

    <?php if (empty($grades)): ?>
        <div class="alert alert-info">
            Belum ada data nilai. <a href="index.php?controller=GradeController&action=add" class="alert-link">Tambah nilai pertama</a>.
        </div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Kehadiran</th>
                    <th>UH1</th>
                    <th>UH2</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $grade): ?>
                    <tr>
                        <td><?php echo $grade->nis; ?></td>
                        <td><?php echo $grade->student_name; ?></td>
                        <td><?php echo $grade->class; ?></td>
                        <td><?php echo $grade->subject; ?></td>
                        <td><?php echo $grade->attendance; ?>%</td>
                        <td><?php echo $grade->uh1; ?></td>
                        <td><?php echo $grade->uh2; ?></td>
                        <td><?php echo $grade->uts; ?></td>
                        <td><?php echo $grade->uas; ?></td>
                        <td><?php echo ucfirst($grade->semester); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>