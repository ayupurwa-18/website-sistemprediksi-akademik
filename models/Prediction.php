<?php
class Prediction
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function predictStudentPerformance($studentId, $subject = null)
    {
        // Ambil semua nilai siswa
        $this->db->query('SELECT * FROM grades WHERE student_id = :student_id' .
            ($subject ? ' AND subject = :subject' : ''));
        $this->db->bind(':student_id', $studentId);
        if ($subject) {
            $this->db->bind(':subject', $subject);
        }
        $grades = $this->db->resultSet();

        if (empty($grades)) {
            return null;
        }

        $predictions = [];

        foreach ($grades as $grade) {
            // Bobot untuk prediksi: Kehadiran 15%, UH1 15%, UH2 15%, UTS 25%, UAS 30%
            $weighted_score = (
                ($grade->attendance * 0.15) +
                ($grade->uh1 * 0.15) +
                ($grade->uh2 * 0.15) +
                ($grade->uts * 0.25) +
                ($grade->uas * 0.30)
            );

            // Prediksi berdasarkan weighted score
            if ($weighted_score >= 85) {
                $prediction = "Sangat Baik";
                $recommendation = "Pertahankan prestasi yang excellent!";
                $color = "success";
            } elseif ($weighted_score >= 75) {
                $prediction = "Baik";
                $recommendation = "Tingkatkan lagi untuk mencapai hasil terbaik";
                $color = "info";
            } elseif ($weighted_score >= 65) {
                $prediction = "Cukup";
                $recommendation = "Perlu lebih banyak belajar dan berlatih";
                $color = "warning";
            } else {
                $prediction = "Perlu Perhatian";
                $recommendation = "Memerlukan bimbingan khusus dan perhatian lebih";
                $color = "danger";
            }

            $predictions[] = [
                'subject' => $grade->subject,
                'attendance' => $grade->attendance,
                'uh1' => $grade->uh1,
                'uh2' => $grade->uh2,
                'uts' => $grade->uts,
                'uas' => $grade->uas,
                'weighted_score' => round($weighted_score, 2),
                'prediction' => $prediction,
                'recommendation' => $recommendation,
                'color' => $color,
                'semester' => $grade->semester,
                'school_year' => $grade->school_year
            ];
        }

        return $predictions;
    }

    public function getClassPerformance($class)
    {
        $this->db->query('SELECT g.*, s.name as student_name, s.nis 
                         FROM grades g 
                         JOIN students s ON g.student_id = s.id 
                         WHERE s.class = :class 
                         ORDER BY s.name, g.subject');
        $this->db->bind(':class', $class);
        $grades = $this->db->resultSet();

        $classPerformance = [];
        $subjectPerformance = [];

        foreach ($grades as $grade) {
            $weighted_score = (
                ($grade->attendance * 0.15) +
                ($grade->uh1 * 0.15) +
                ($grade->uh2 * 0.15) +
                ($grade->uts * 0.25) +
                ($grade->uas * 0.30)
            );

            if (!isset($classPerformance[$grade->student_id])) {
                $classPerformance[$grade->student_id] = [
                    'student_name' => $grade->student_name,
                    'nis' => $grade->nis,
                    'scores' => [],
                    'average' => 0
                ];
            }

            $classPerformance[$grade->student_id]['scores'][] = $weighted_score;

            // Performance per mata pelajaran
            if (!isset($subjectPerformance[$grade->subject])) {
                $subjectPerformance[$grade->subject] = [
                    'scores' => [],
                    'average' => 0
                ];
            }
            $subjectPerformance[$grade->subject]['scores'][] = $weighted_score;
        }

        // Hitung rata-rata
        foreach ($classPerformance as &$student) {
            $student['average'] = round(array_sum($student['scores']) / count($student['scores']), 2);
        }

        foreach ($subjectPerformance as &$subject) {
            $subject['average'] = round(array_sum($subject['scores']) / count($subject['scores']), 2);
        }

        return [
            'students' => $classPerformance,
            'subjects' => $subjectPerformance
        ];
    }

    // METHOD BARU UNTUK SISWA YANG PERLU PERHATIAN
    public function getStudentsNeedAttention()
    {
        $this->db->query('SELECT s.id, s.name, s.class, s.nis,
                         AVG((g.attendance * 0.15 + g.uh1 * 0.15 + g.uh2 * 0.15 + g.uts * 0.25 + g.uas * 0.30)) as average
                         FROM students s
                         JOIN grades g ON s.id = g.student_id
                         GROUP BY s.id
                         HAVING average < 65
                         ORDER BY average ASC
                         LIMIT 10');

        $results = $this->db->resultSet();
        $students = [];

        foreach ($results as $result) {
            $students[] = [
                'id' => $result->id,
                'name' => $result->name,
                'class' => $result->class,
                'nis' => $result->nis,
                'average' => round($result->average, 1)
            ];
        }

        return $students;
    }
}
