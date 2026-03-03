<?php
session_start();

// Load configuration
require_once 'config/database.php';

// Load models
require_once 'models/Database.php';
require_once 'models/Student.php';
require_once 'models/User.php';
require_once 'models/Grade.php';
require_once 'models/Prediction.php';

// Load controllers
require_once 'controllers/StudentController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/GradeController.php';
require_once 'controllers/PredictionController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php'; // INI YANG DITAMBAH

// Default controller dan action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'DashboardController';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Check authentication untuk halaman yang membutuhkan login
$publicPages = ['AuthController::login', 'AuthController::register'];
$currentPage = $controller . '::' . $action;

if (!in_array($currentPage, $publicPages) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?controller=AuthController&action=login');
    exit();
}

// Execute controller action
if (class_exists($controller)) {
    $controllerInstance = new $controller();
    if (method_exists($controllerInstance, $action)) {
        // Check jika method membutuhkan parameter ID
        if (isset($_GET['id'])) {
            $controllerInstance->$action($_GET['id']);
        } else {
            $controllerInstance->$action();
        }
    } else {
        // Jika method tidak ditemukan, redirect ke dashboard
        header('Location: index.php?controller=DashboardController&action=index');
        exit();
    }
} else {
    // Jika controller tidak ditemukan, redirect ke login
    header('Location: index.php?controller=AuthController&action=login');
    exit();
}
