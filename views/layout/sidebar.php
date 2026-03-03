<div class="sidebar bg-light border-end" style="width: 250px; min-height: calc(100vh - 56px);">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['controller'] == 'DashboardController') ? 'active' : ''; ?>"
                    href="index.php?controller=DashboardController&action=index">
                    📊 Dashboard
                </a>
            </li>

            <?php if ($_SESSION['user_role'] == 'admin'): ?>
                <!-- MENU ADMIN -->
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['controller'] == 'UserController') ? 'active' : ''; ?>"
                        href="index.php?controller=UserController&action=index">
                        👨‍🏫 Manajemen Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['controller'] == 'StudentController') ? 'active' : ''; ?>"
                        href="index.php?controller=StudentController&action=index">
                        👥 Data Siswa
                    </a>
                </li>
            <?php else: ?>
                <!-- MENU GURU -->
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_GET['controller'] == 'StudentController') ? 'active' : ''; ?>"
                        href="index.php?controller=StudentController&action=index">
                        👥 Siswa Kelas Saya
                    </a>
                </li>
            <?php endif; ?>

            <!-- MENU UMUM (Bisa diakses Admin dan Guru) -->
            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['controller'] == 'GradeController') ? 'active' : ''; ?>"
                    href="index.php?controller=GradeController&action=index">
                    📝 Input Nilai
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['controller'] == 'PredictionController' && $_GET['action'] == 'index') ? 'active' : ''; ?>"
                    href="index.php?controller=PredictionController&action=index">
                    🔮 Prediksi Siswa
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['controller'] == 'PredictionController' && $_GET['action'] == 'classPerformance') ? 'active' : ''; ?>"
                    href="index.php?controller=PredictionController&action=classPerformance">
                    📊 Prediksi Kelas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo ($_GET['controller'] == 'UserController' && $_GET['action'] == 'changePassword') ? 'active' : ''; ?>"
                    href="index.php?controller=UserController&action=changePassword">
                    🔐 Ganti Password
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="index.php?controller=AuthController&action=logout">
                    🚪 Logout
                </a>
            </li>
        </ul>
    </div>
</div>