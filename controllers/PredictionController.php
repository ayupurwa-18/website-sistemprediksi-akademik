<?php
class PredictionController
{
    private $predictionModel;
    private $studentModel;

    public function __construct()
    {
        $this->predictionModel = new Prediction();
        $this->studentModel = new Student();
    }

    public function index()
    {
        $students = $this->studentModel->getAllStudents();
        $predictions = [];
        $student = null;

        if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
            $studentId = $_GET['student_id'];
            $student = $this->studentModel->getStudentById($studentId);
            $predictions = $this->predictionModel->predictStudentPerformance($studentId);
        }

        require_once 'views/prediction/index.php';
    }

    public function classPerformance()
    {
        $class = isset($_GET['class']) ? $_GET['class'] : '10A';
        $performance = $this->predictionModel->getClassPerformance($class);

        require_once 'views/prediction/class.php';
    }
}
