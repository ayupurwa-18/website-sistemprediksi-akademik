<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Prediksi Akademik Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Prediksi Akademik</a>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="navbar-text me-3">
                        👋 Hello,
                        <?php
                        // Gunakan full_name jika ada, jika tidak gunakan username
                        if (!empty($_SESSION['full_name'])) {
                            echo $_SESSION['full_name'];
                        } else {
                            echo $_SESSION['username'];
                        }
                        ?>
                        (<?php echo $_SESSION['user_role']; ?>)
                    </span>
                    <a class="nav-link" href="index.php?controller=AuthController&action=logout">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="index.php?controller=AuthController&action=login">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid">