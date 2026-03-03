<?php
class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllStudents()
    {
        $this->db->query('SELECT * FROM students ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getStudentById($id)
    {
        $this->db->query('SELECT * FROM students WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addStudent($data)
    {
        $this->db->query('INSERT INTO students (name, nis, class) VALUES (:name, :nis, :class)');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nis', $data['nis']);
        $this->db->bind(':class', $data['class']);

        return $this->db->execute();
    }

    public function updateStudent($data)
    {
        $this->db->query('UPDATE students SET name = :name, nis = :nis, class = :class WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':nis', $data['nis']);
        $this->db->bind(':class', $data['class']);

        return $this->db->execute();
    }

    public function deleteStudent($id)
    {
        $this->db->query('DELETE FROM students WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getTotalStudents()
    {
        $this->db->query('SELECT COUNT(*) as total FROM students');
        $result = $this->db->single();
        return $result->total;
    }

    public function getRecentStudents()
    {
        $this->db->query('SELECT * FROM students ORDER BY created_at DESC LIMIT 5');
        return $this->db->resultSet();
    }
}
