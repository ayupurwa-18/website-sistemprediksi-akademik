<?php
class GradeController
{
    private $gradeModel;
    private $studentModel;

    public function __construct()
    {
        $this->gradeModel = new Grade();
        $this->studentModel = new Student();
    }

    public function index()
    {
        $grades = $this->gradeModel->getAllGrades();
        require_once 'views/grade/index.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'student_id' => trim($_POST['student_id']),
                'subject' => trim($_POST['subject']),
                'attendance' => trim($_POST['attendance']),
                'uh1' => trim($_POST['uh1']),
                'uh2' => trim($_POST['uh2']),
                'uts' => trim($_POST['uts']),
                'uas' => trim($_POST['uas']),
                'semester' => trim($_POST['semester']),
                'school_year' => trim($_POST['school_year'])
            ];

            if ($this->gradeModel->addGrade($data)) {
                header('Location: index.php?controller=GradeController&action=index');
            } else {
                die('Something went wrong');
            }
        } else {
            $students = $this->studentModel->getAllStudents();
            require_once 'views/grade/add.php';
        }
    }
}
