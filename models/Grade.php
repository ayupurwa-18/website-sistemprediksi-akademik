<?php
class Grade
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addGrade($data)
    {
        $this->db->query('INSERT INTO grades (student_id, subject, attendance, uh1, uh2, uts, uas, semester, school_year) 
                         VALUES (:student_id, :subject, :attendance, :uh1, :uh2, :uts, :uas, :semester, :school_year)');

        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':attendance', $data['attendance']);
        $this->db->bind(':uh1', $data['uh1']);
        $this->db->bind(':uh2', $data['uh2']);
        $this->db->bind(':uts', $data['uts']);
        $this->db->bind(':uas', $data['uas']);
        $this->db->bind(':semester', $data['semester']);
        $this->db->bind(':school_year', $data['school_year']);

        return $this->db->execute();
    }

    public function getGradesByStudent($studentId)
    {
        $this->db->query('SELECT g.*, s.name as student_name, s.nis 
                         FROM grades g 
                         JOIN students s ON g.student_id = s.id 
                         WHERE g.student_id = :student_id 
                         ORDER BY g.subject, g.semester');
        $this->db->bind(':student_id', $studentId);
        return $this->db->resultSet();
    }

    public function getAllGrades()
    {
        $this->db->query('SELECT g.*, s.name as student_name, s.nis, s.class 
                         FROM grades g 
                         JOIN students s ON g.student_id = s.id 
                         ORDER BY s.class, s.name, g.subject');
        return $this->db->resultSet();
    }

    public function getGradeById($id)
    {
        $this->db->query('SELECT g.*, s.name as student_name, s.nis 
                         FROM grades g 
                         JOIN students s ON g.student_id = s.id 
                         WHERE g.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // TAMBAHKAN METHOD INI
    public function getTotalGrades()
    {
        $this->db->query('SELECT COUNT(*) as total FROM grades');
        $result = $this->db->single();
        return $result->total;
    }

    // Method tambahan untuk dashboard
    public function getRecentGrades()
    {
        $this->db->query('SELECT g.*, s.name as student_name 
                         FROM grades g 
                         JOIN students s ON g.student_id = s.id 
                         ORDER BY g.created_at DESC 
                         LIMIT 5');
        return $this->db->resultSet();
    }

    public function getAverageScores()
    {
        $this->db->query('SELECT 
                         AVG(attendance) as avg_attendance,
                         AVG(uh1) as avg_uh1,
                         AVG(uh2) as avg_uh2,
                         AVG(uts) as avg_uts,
                         AVG(uas) as avg_uas
                         FROM grades');
        return $this->db->single();
    }
}
