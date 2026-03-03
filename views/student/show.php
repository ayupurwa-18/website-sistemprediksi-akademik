<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📋 Detail Data Siswa</h2>
        <a href="index.php?controller=StudentController&action=index" class="btn btn-secondary">↩️ Kembali</a>
    </div>

    <div class="row">
        <!-- Informasi Siswa -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>👤 Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">NIS</th>
                            <td><?php echo $student->nis; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?php echo $student->name; ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>
                                <span class="badge bg-info"><?php echo $student->class; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Didaftarkan</th>
                            <td><?php echo date('d F Y', strtotime($student->created_at)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>⚡ Aksi Cepat</h5>
                </div>
                <div class="card-body text-center">
                    <div class="d-grid gap-2">
                        <a href="index.php?controller=GradeController&action=add&student_id=<?php echo $student->id; ?>"
                            class="btn btn-primary btn-lg">
                            📝 Input Nilai
                        </a>
                        <a href="index.php?controller=PredictionController&action=index&student_id=<?php echo $student->id; ?>"
                            class="btn btn-warning btn-lg">
                            🔮 Lihat Prediksi
                        </a>
                        <?php if ($_SESSION['user_role'] == 'admin'): ?>
                            <a href="index.php?controller=StudentController&action=edit&id=<?php echo $student->id; ?>"
                                class="btn btn-info">
                                ✏️ Edit Data
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Nilai Siswa -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>📊 Data Nilai <?php echo $student->name; ?></h5>
                </div>
                <div class="card-body">
                    <?php
                    // Include model Grade untuk mengambil data nilai
                    require_once 'models/Grade.php';
                    $gradeModel = new Grade();
                    $grades = $gradeModel->getGradesByStudent($student->id);
                    ?>

                    <?php if (empty($grades)): ?>
                        <div class="alert alert-warning text-center">
                            <h6>📝 Belum Ada Data Nilai</h6>
                            <p>Siswa ini belum memiliki data nilai. Silakan input nilai terlebih dahulu.</p>
                            <a href="index.php?controller=GradeController&action=add&student_id=<?php echo $student->id; ?>"
                                class="btn btn-primary">Input Nilai Pertama</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Kehadiran</th>
                                        <th>UH1</th>
                                        <th>UH2</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($grades as $grade): ?>
                                        <tr>
                                            <td><strong><?php echo $grade->subject; ?></strong></td>
                                            <td>
                                                <span class="badge bg-<?php echo $grade->attendance >= 80 ? 'success' : ($grade->attendance >= 60 ? 'warning' : 'danger'); ?>">
                                                    <?php echo $grade->attendance; ?>%
                                                </span>
                                            </td>
                                            <td><?php echo $grade->uh1; ?></td>
                                            <td><?php echo $grade->uh2; ?></td>
                                            <td><?php echo $grade->uts; ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $grade->uas >= 80 ? 'success' : ($grade->uas >= 60 ? 'warning' : 'danger'); ?>">
                                                    <?php echo $grade->uas; ?>
                                                </span>
                                            </td>
                                            <td><?php echo ucfirst($grade->semester); ?></td>
                                            <td><?php echo $grade->school_year; ?></td>
                                            <td>
                                                <a href="index.php?controller=PredictionController&action=index&student_id=<?php echo $student->id; ?>&subject=<?php echo urlencode($grade->subject); ?>"
                                                    class="btn btn-sm btn-outline-primary">
                                                    🔍 Prediksi
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Prediksi Cepat -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5>🔮 Prediksi Cepat</h5>
                </div>
                <div class="card-body text-center">
                    <a href="index.php?controller=PredictionController&action=index&student_id=<?php echo $student->id; ?>"
                        class="btn btn-warning btn-lg">
                        📈 Lihat Prediksi Lengkap
                    </a>
                    <p class="mt-2 text-muted">Lihat analisis prediksi akademik berdasarkan semua nilai yang telah diinput</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>