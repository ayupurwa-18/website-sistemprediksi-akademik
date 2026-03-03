<?php
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4>Tambah Data Siswa Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIS (Nomor Induk Siswa) *</label>
                            <input type="text" class="form-control" name="nis" required>
                            <small class="text-muted">Nomor induk siswa yang unik</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap Siswa *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas *</label>
                            <select name="class" class="form-select" required>
                                <option value="">-- Pilih Kelas --</option>
                                <option value="7A">7A</option>
                                <option value="7B">7B</option>
                                <option value="7C">7C</option>
                                <option value="8A">8A</option>
                                <option value="8B">8B</option>
                                <option value="9A">9A</option>
                                <option value="9B">9B</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6>📝 Informasi</h6>
                            <p class="mb-0">Data siswa akan digunakan untuk input nilai dan prediksi akademik. Pastikan data yang dimasukkan akurat.</p>
                        </div>

                        <div class="alert alert-warning">
                            <h6>⚠️ Perhatian</h6>
                            <p class="mb-0">NIS harus unik dan tidak boleh sama dengan siswa lain.</p>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success me-md-2">
                        💾 Simpan Data Siswa
                    </button>
                    <a href="index.php?controller=StudentController&action=index" class="btn btn-secondary">
                        ↩️ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>