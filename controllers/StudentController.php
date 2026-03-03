<?php
class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function index()
    {
        $students = $this->studentModel->getAllStudents();
        require_once 'views/student/index.php';
    }

    public function create()
    {
        // Hanya admin yang bisa tambah siswa
        if ($_SESSION['user_role'] != 'admin') {
            header('Location: index.php?controller=DashboardController&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'nis' => trim($_POST['nis']),
                'class' => trim($_POST['class'])
            ];

            if ($this->studentModel->addStudent($data)) {
                header('Location: index.php?controller=StudentController&action=index&success=student_created');
            } else {
                die('Something went wrong');
            }
        } else {
            require_once 'views/student/create.php';
        }
    }

    public function show($id)
    {
        $student = $this->studentModel->getStudentById($id);

        if (!$student) {
            die('Siswa tidak ditemukan');
        }

        require_once 'views/student/show.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'nis' => trim($_POST['nis']),
                'class' => trim($_POST['class'])
            ];

            if ($this->studentModel->updateStudent($data)) {
                header('Location: index.php?controller=StudentController&action=index');
            } else {
                die('Something went wrong');
            }
        } else {
            $student = $this->studentModel->getStudentById($id);
            require_once 'views/student/edit.php';
        }
    }

    public function delete($id)
    {
        if ($this->studentModel->deleteStudent($id)) {
            header('Location: index.php?controller=StudentController&action=index');
        } else {
            die('Something went wrong');
        }
    }
}
