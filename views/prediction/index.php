<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <h2>Prediksi Performa Akademik Siswa</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <input type="hidden" name="controller" value="PredictionController">
                <input type="hidden" name="action" value="index">
                <div class="col-md-6">
                    <label class="form-label">Pilih Siswa</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo $student->id; ?>"
                                <?php echo isset($_GET['student_id']) && $_GET['student_id'] == $student->id ? 'selected' : ''; ?>>
                                <?php echo $student->name . ' - ' . $student->class . ' (' . $student->nis . ')'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Tampilkan Prediksi</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($predictions) && isset($student)): ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Hasil Prediksi untuk <?php echo $student->name; ?> (<?php echo $student->nis; ?>)</h4>
            </div>
            <div class="card-body">
                <?php foreach ($predictions as $prediction): ?>
                    <div class="prediction-item mb-4 p-3 border rounded">
                        <h5 class="text-<?php echo $prediction['color']; ?>">
                            <?php echo $prediction['subject']; ?> - Semester <?php echo ucfirst($prediction['semester']); ?>
                        </h5>

                        <div class="row">
                            <div class="col-md-3">
                                <strong>Data Nilai:</strong>
                                <ul class="list-unstyled">
                                    <li>Kehadiran: <?php echo $prediction['attendance']; ?>%</li>
                                    <li>UH1: <?php echo $prediction['uh1']; ?></li>
                                    <li>UH2: <?php echo $prediction['uh2']; ?></li>
                                    <li>UTS: <?php echo $prediction['uts']; ?></li>
                                    <li>UAS: <?php echo $prediction['uas']; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <strong>Skor Tertimbang:</strong>
                                <div class="display-6 text-primary"><?php echo $prediction['weighted_score']; ?></div>
                            </div>
                            <div class="col-md-3">
                                <strong>Prediksi:</strong>
                                <div class="h4 text-<?php echo $prediction['color']; ?>">
                                    <?php echo $prediction['prediction']; ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <strong>Rekomendasi:</strong>
                                <p><?php echo $prediction['recommendation']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php elseif (isset($_GET['student_id'])): ?>
        <div class="alert alert-warning">
            Tidak ada data nilai untuk siswa yang dipilih.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>