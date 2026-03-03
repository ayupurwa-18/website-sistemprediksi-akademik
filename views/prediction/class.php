<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <h2>Prediksi Performa Kelas</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <input type="hidden" name="controller" value="PredictionController">
                <input type="hidden" name="action" value="classPerformance">
                <div class="col-md-6">
                    <label class="form-label">Pilih Kelas</label>
                    <select name="class" class="form-select" required>
                        <option value="7A" <?php echo ($class == '7A') ? 'selected' : ''; ?>>7A</option>
                        <option value="7B" <?php echo ($class == '7B') ? 'selected' : ''; ?>>7B</option>
                        <option value="8C" <?php echo ($class == '8C') ? 'selected' : ''; ?>>8C</option>
                        <option value="8A" <?php echo ($class == '8A') ? 'selected' : ''; ?>>8A</option>
                        <option value="8B" <?php echo ($class == '8B') ? 'selected' : ''; ?>>8B</option>
                        <option value="9A" <?php echo ($class == '9A') ? 'selected' : ''; ?>>9A</option>
                        <option value="9B" <?php echo ($class == '9B') ? 'selected' : ''; ?>>9B</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block">Tampilkan Prediksi</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($performance['students'])): ?>
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Hasil Prediksi Kelas <?php echo $class; ?></h4>
            </div>
            <div class="card-body">
                <h5>Rata-rata per Mata Pelajaran:</h5>
                <div class="row mb-4">
                    <?php foreach ($performance['subjects'] as $subject => $data): ?>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6><?php echo $subject; ?></h6>
                                    <div class="h4 text-primary"><?php echo $data['average']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h5>Performa Siswa:</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Rata-rata</th>
                            <th>Prediksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($performance['students'] as $student): ?>
                            <tr>
                                <td><?php echo $student['student_name']; ?></td>
                                <td><?php echo $student['nis']; ?></td>
                                <td><?php echo $student['average']; ?></td>
                                <td>
                                    <?php
                                    if ($student['average'] >= 85) {
                                        echo '<span class="badge bg-success">Sangat Baik</span>';
                                    } elseif ($student['average'] >= 75) {
                                        echo '<span class="badge bg-info">Baik</span>';
                                    } elseif ($student['average'] >= 65) {
                                        echo '<span class="badge bg-warning">Cukup</span>';
                                    } else {
                                        echo '<span class="badge bg-danger">Perlu Perhatian</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Tidak ada data untuk kelas <?php echo $class; ?>.
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>