<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <h2>Dashboard <?php echo $_SESSION['user_role'] == 'admin' ? 'Admin' : 'Guru'; ?></h2>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <h2 class="card-text"><?php echo $totalStudents; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Nilai</h5>
                    <h2 class="card-text"><?php echo $totalGrades; ?></h2>
                </div>
            </div>
        </div>

        <?php if ($_SESSION['user_role'] == 'admin'): ?>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Guru</h5>
                        <h2 class="card-text"><?php echo $totalTeachers; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Siswa Need Attention</h5>
                        <h2 class="card-text"><?php echo count($studentsNeedAttention); ?></h2>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Nilai Terinput</h5>
                        <h2 class="card-text"><?php echo $totalGrades; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Perlu Perhatian</h5>
                        <h2 class="card-text"><?php echo count($studentsNeedAttention); ?></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content Berdasarkan Role -->
    <?php if ($_SESSION['user_role'] == 'admin'): ?>
        <!-- DASHBOARD ADMIN -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h5>📋 Siswa Perlu Perhatian Khusus</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($studentsNeedAttention)): ?>
                            <div class="list-group">
                                <?php foreach ($studentsNeedAttention as $student): ?>
                                    <a href="index.php?controller=PredictionController&action=index&student_id=<?php echo $student['id']; ?>"
                                        class="list-group-item list-group-item-action">
                                        <strong><?php echo $student['name']; ?></strong> (<?php echo $student['class']; ?>)
                                        <span class="badge bg-danger float-end"><?php echo $student['average']; ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-success">✅ Semua siswa dalam kondisi baik</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5>⚡ Quick Actions</h5>
                    </div>
                    <div class="card-body text-center">
                        <a href="index.php?controller=UserController&action=create" class="btn btn-success m-2">Tambah Guru</a>
                        <a href="index.php?controller=StudentController&action=create" class="btn btn-primary m-2">Tambah Siswa</a>
                        <a href="index.php?controller=PredictionController&action=classPerformance" class="btn btn-warning m-2">Lihat Prediksi</a>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- DASHBOARD GURU -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5>🎯 Tugas Prioritas</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Input Nilai UH2 Matematika</strong>
                            <p>Kelas 10A - Deadline: 30 November 2024</p>
                            <a href="index.php?controller=GradeController&action=add" class="btn btn-sm btn-success">Input Sekarang</a>
                        </div>

                        <?php if (!empty($studentsNeedAttention)): ?>
                            <div class="alert alert-warning">
                                <strong>⚠️ <?php echo count($studentsNeedAttention); ?> Siswa Perlu Perhatian</strong>
                                <a href="index.php?controller=PredictionController&action=index" class="btn btn-sm btn-warning">Lihat Detail</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success">
                        <h5>🚀 Quick Actions</h5>
                    </div>
                    <div class="card-body text-center">
                        <a href="index.php?controller=GradeController&action=add" class="btn btn-primary m-2">Input Nilai</a>
                        <a href="index.php?controller=PredictionController&action=index" class="btn btn-warning m-2">Lihat Prediksi</a>
                        <a href="index.php?controller=StudentController&action=index" class="btn btn-info m-2">Data Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>