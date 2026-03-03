<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        // Hanya admin yang bisa akses
        if ($_SESSION['user_role'] != 'admin') {
            header('Location: index.php?controller=DashboardController&action=index');
            exit();
        }

        $users = $this->userModel->getAllUsers();
        require_once 'views/user/index.php';
    }

    public function create()
    {
        if ($_SESSION['user_role'] != 'admin') {
            header('Location: index.php?controller=DashboardController&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => trim($_POST['role'])
            ];

            // Validasi
            if (empty($data['username']) || empty($data['full_name']) || empty($data['email']) || empty($data['password'])) {
                die('Harap isi semua field yang wajib diisi');
            }

            if ($data['password'] != $data['confirm_password']) {
                die('Password dan konfirmasi password tidak cocok');
            }

            if (strlen($data['password']) < 6) {
                die('Password minimal 6 karakter');
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
                die('Email sudah digunakan');
            }

            if ($this->userModel->register($data)) {
                header('Location: index.php?controller=UserController&action=index&success=user_created');
            } else {
                die('Terjadi kesalahan saat menyimpan data');
            }
        } else {
            require_once 'views/user/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SESSION['user_role'] != 'admin') {
            header('Location: index.php?controller=DashboardController&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'username' => trim($_POST['username']),
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role'])
            ];

            if ($this->userModel->updateUser($data)) {
                header('Location: index.php?controller=UserController&action=index');
            } else {
                die('Terjadi kesalahan');
            }
        } else {
            $user = $this->userModel->getUserById($id);
            require_once 'views/user/edit.php';
        }
    }

    public function delete($id)
    {
        if ($_SESSION['user_role'] != 'admin') {
            header('Location: index.php?controller=DashboardController&action=index');
            exit();
        }

        if ($this->userModel->deleteUser($id)) {
            header('Location: index.php?controller=UserController&action=index');
        } else {
            die('Terjadi kesalahan');
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = trim($_POST['current_password']);
            $newPassword = trim($_POST['new_password']);
            $confirmPassword = trim($_POST['confirm_password']);

            // Verify current password
            $user = $this->userModel->getUserById($_SESSION['user_id']);
            if (!password_verify($currentPassword, $user->password)) {
                die('Password saat ini salah');
            }

            if ($newPassword != $confirmPassword) {
                die('Password baru tidak cocok');
            }

            if ($this->userModel->changePassword($_SESSION['user_id'], $newPassword)) {
                header('Location: index.php?controller=DashboardController&action=index&message=password_changed');
            } else {
                die('Terjadi kesalahan');
            }
        } else {
            require_once 'views/user/change_password.php';
        }
    }
}
