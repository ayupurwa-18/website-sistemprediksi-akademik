<?php
class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => trim($_POST['role'])
            ];

            if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
                die('Please fill all fields');
            }

            if ($data['password'] != $data['confirm_password']) {
                die('Passwords do not match');
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
                die('Email already exists');
            }

            if ($this->userModel->register($data)) {
                header('Location: index.php?controller=AuthController&action=login');
            } else {
                die('Something went wrong');
            }
        } else {
            require_once 'views/auth/register.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $loggedInUser = $this->userModel->login($username, $password);

            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
                header('Location: index.php?controller=DashboardController&action=index');
            } else {
                die('Invalid credentials');
            }
        } else {
            require_once 'views/auth/login.php';
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['full_name'] = $user->full_name;
        $_SESSION['email'] = $user->email;
        $_SESSION['user_role'] = $user->role;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['full_name']);
        unset($_SESSION['email']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('Location: index.php?controller=AuthController&action=login');
    }
}
