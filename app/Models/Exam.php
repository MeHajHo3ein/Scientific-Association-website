<?php

namespace App\Models;

use PDO;

class Exam
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get exams by teacher
  public function getExamsByTeacher($teacherId, $limit = null, $offset = 0)
  {
    $query = "SELECT e.*, 
              (SELECT COUNT(*) FROM exam_questions WHERE exam_id = e.id) as question_count
              FROM exams e
              WHERE e.teacher_id = :teacher_id
              ORDER BY e.created_at ASC";

    if ($limit) {
      $query .= " LIMIT :limit OFFSET :offset";
    }

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':teacher_id', $teacherId, PDO::PARAM_INT);
    if ($limit) {
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get exams count by teacher
  public function getExamsCountByTeacher($teacherId)
  {
    $query = "SELECT COUNT(*) as total FROM exams WHERE teacher_id = :teacher_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':teacher_id' => $teacherId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }

  // Get exam by id
  public function getExamById($id)
  {
    $query = "SELECT e.*, u.full_name as teacher_name
              FROM exams e
              LEFT JOIN users u ON e.teacher_id = u.id
              WHERE e.id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get all exams
  public function getAllExams()
  {
    $query = "SELECT e.*, u.full_name as teacher_name,
              (SELECT COUNT(*) FROM exam_questions WHERE exam_id = e.id) as question_count
              FROM exams e
              LEFT JOIN users u ON e.teacher_id = u.id
              ORDER BY e.created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get exam questions
  public function getExamQuestions($examId)
  {
    $query = "SELECT * FROM exam_questions WHERE exam_id = :exam_id ORDER BY sort_order ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':exam_id' => $examId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Create new exam
  public function createExam($data)
  {
    $query = "INSERT INTO exams (title, course_name, teacher_id, pass_score) 
            VALUES (:title, :course_name, :teacher_id, :pass_score)";
    $stmt = $this->db->prepare($query);

    if ($stmt->execute($data)) {
      return $this->db->lastInsertId();
    }

    return false;
  }

  // Create question
  public function createQuestion($data)
  {
    $query = "INSERT INTO exam_questions (exam_id, question_text, question_type, code_block, score, options, correct_answer, sort_order) 
              VALUES (:exam_id, :question_text, :question_type, :code_block, :score, :options, :correct_answer, :sort_order)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Delete exam
  public function deleteExam($id, $teacherId)
  {
    $query = "DELETE FROM exams WHERE id = :id AND teacher_id = :teacher_id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id, ':teacher_id' => $teacherId]);
  }

  // Get student result
  public function getStudentResult($examId, $studentId)
  {
    $query = "SELECT * FROM exam_results WHERE exam_id = :exam_id AND student_id = :student_id ORDER BY id DESC LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':exam_id' => $examId, ':student_id' => $studentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Save student answer
  public function saveAnswer($data)
  {
    $query = "INSERT INTO exam_answers (result_id, question_id, answer, is_correct) 
            VALUES (:result_id, :question_id, :answer, :is_correct)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  /// Save student result
  public function saveResult($data)
  {
    $query = "INSERT INTO exam_results (exam_id, student_id, score, total_score, percentage, is_passed, certificate_code) 
            VALUES (:exam_id, :student_id, :score, :total_score, :percentage, :is_passed, :certificate_code)";
    $stmt = $this->db->prepare($query);

    if ($stmt->execute($data)) {
      $id = $this->db->lastInsertId();
      if ($id && $id > 0) {
        return $id;
      }
    }

    return false;
  }

  // Get certificate by unique code
  public function getCertificateByCode($code)
  {
    $query = "SELECT er.*, e.title as exam_title, e.course_name, e.pass_score,
              u.full_name as student_name, t.full_name as teacher_name
              FROM exam_results er
              LEFT JOIN exams e ON er.exam_id = e.id
              LEFT JOIN users u ON er.student_id = u.id
              LEFT JOIN users t ON e.teacher_id = t.id
              WHERE er.certificate_code = :code AND er.is_passed = 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':code' => $code]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get student certificates for student panel
  public function getStudentCertificates($studentId)
  {
    $query = "SELECT er.*, e.title as exam_title, e.course_name, e.pass_score,
              t.full_name as teacher_name
              FROM exam_results er
              LEFT JOIN exams e ON er.exam_id = e.id
              LEFT JOIN users t ON e.teacher_id = t.id
              WHERE er.student_id = :student_id AND er.is_passed = 1
              ORDER BY er.completed_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':student_id' => $studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get certificate by id for student panel
  public function getCertificateById($resultId, $studentId)
  {
    $query = "SELECT er.*, e.title as exam_title, e.course_name, e.pass_score,
              u.full_name as student_name, t.full_name as teacher_name
              FROM exam_results er
              LEFT JOIN exams e ON er.exam_id = e.id
              LEFT JOIN users u ON er.student_id = u.id
              LEFT JOIN users t ON e.teacher_id = t.id
              WHERE er.id = :result_id AND er.student_id = :student_id AND er.is_passed = 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':result_id' => $resultId, ':student_id' => $studentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get existing student passed result (if existing)
  public function getExistingPassedResult($examId, $studentId)
  {
    $query = "SELECT er.id, er.*, e.title as exam_title, e.course_name, e.pass_score,
              u.full_name as student_name, t.full_name as teacher_name
              FROM exam_results er
              LEFT JOIN exams e ON er.exam_id = e.id
              LEFT JOIN users u ON er.student_id = u.id
              LEFT JOIN users t ON e.teacher_id = t.id
              WHERE er.exam_id = :exam_id 
              AND er.student_id = :student_id 
              AND er.is_passed = 1
              ORDER BY er.id DESC
              LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':exam_id' => $examId, ':student_id' => $studentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /// Has student taken exam
  public function hasStudentTakenExam($examId, $studentId)
  {
    $query = "SELECT COUNT(*) as count FROM exam_results WHERE exam_id = :exam_id AND student_id = :student_id AND is_passed = 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':exam_id' => $examId, ':student_id' => $studentId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return ($result['count'] ?? 0) > 0;
  }

  /// Generate unique code
  public function generateUniqueCode()
  {
    $numericPart = (string) rand(1000, 9999);

    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $alphaPart = '';
    for ($i = 0; $i < 4; $i++) {
      $alphaPart .= $chars[random_int(0, strlen($chars) - 1)];
    }

    $code = 'CERT-' . $numericPart . '-' . $alphaPart;

    $query = "SELECT COUNT(*) as count FROM exam_results WHERE certificate_code = :code";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':code' => $code]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (($result['count'] ?? 0) > 0) {
      return $this->generateUniqueCode();
    }
    return $code;
  }

  // Get student certificates with pagination
  public function getStudentCertificatesPaginated($studentId, $limit, $offset)
  {
    $query = "SELECT er.id, er.percentage, er.completed_at, e.title as exam_title, e.course_name, e.pass_score,
              t.full_name as teacher_name
              FROM exam_results er
              LEFT JOIN exams e ON er.exam_id = e.id
              LEFT JOIN users t ON e.teacher_id = t.id
              WHERE er.student_id = :student_id AND er.is_passed = 1
              ORDER BY er.completed_at DESC
              LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total student certificates count
  public function getStudentCertificatesCount($studentId)
  {
    $query = "SELECT COUNT(*) as total FROM exam_results WHERE student_id = :student_id AND is_passed = 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':student_id' => $studentId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }
}
