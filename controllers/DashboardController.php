<?php
class DashboardController
{
    private $studentModel;
    private $gradeModel;
    private $userModel;
    private $predictionModel;

    public function __construct()
    {
        $this->studentModel = new Student();
        $this->gradeModel = new Grade();
        $this->userModel = new User();
        $this->predictionModel = new Prediction();
    }

    public function index()
    {
        if ($_SESSION['user_role'] == 'admin') {
            // Data untuk Admin
            $totalStudents = $this->studentModel->getTotalStudents();
            $totalGrades = $this->gradeModel->getTotalGrades();
            $totalTeachers = $this->userModel->getTotalTeachers();
            $recentStudents = $this->studentModel->getRecentStudents();
            $averageScores = $this->gradeModel->getAverageScores();

            // Data prediksi need attention untuk admin
            $studentsNeedAttention = $this->predictionModel->getStudentsNeedAttention();
        } else {
            // Data untuk Guru
            $totalStudents = $this->studentModel->getTotalStudents();
            $totalGrades = $this->gradeModel->getTotalGrades();
            $recentGrades = $this->gradeModel->getRecentGrades();
            $averageScores = $this->gradeModel->getAverageScores();

            // Data prediksi untuk guru
            $studentsNeedAttention = $this->predictionModel->getStudentsNeedAttention();
        }

        require_once 'views/dashboard/index.php';
    }
}
