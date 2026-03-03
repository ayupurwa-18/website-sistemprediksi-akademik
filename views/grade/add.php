<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <h2>Tambah Data Nilai</h2>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Siswa</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo $student->id; ?>">
                                <?php echo $student->name . ' - ' . $student->class . ' (' . $student->nis . ')'; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mata Pelajaran</label>
                    <select name="subject" class="form-select" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        <option value="Matematika">Matematika</option>
                        <option value="IPA">IPA</option>
                        <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                        <option value="Bahasa Inggris">Bahasa Inggris</option>
                        <option value="IPS">IPS</option>
                        <option value="PKN">PKN</option>
                        <option value="Seni Budaya">Seni Budaya</option>
                        <option value="PJOK">PJOK</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select" required>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Ajaran</label>
                    <input type="text" class="form-control" name="school_year" value="2024/2025" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Kehadiran (%)</label>
                    <input type="number" class="form-control" name="attendance" min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai UH1</label>
                    <input type="number" step="0.01" class="form-control" name="uh1" min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai UH2</label>
                    <input type="number" step="0.01" class="form-control" name="uh2" min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai UTS</label>
                    <input type="number" step="0.01" class="form-control" name="uts" min="0" max="100" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nilai UAS</label>
                    <input type="number" step="0.01" class="form-control" name="uas" min="0" max="100" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php?controller=GradeController&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>