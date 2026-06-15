<?php

namespace App\Models;

use PDO;

class StudentManagement
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all students
  public function getAllStudents()
  {
    $query = "SELECT * FROM users WHERE role = 'student' ORDER BY id ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get student by id
  public function getStudentById($id)
  {
    $query = "SELECT * FROM users WHERE id = :id AND role = 'student'";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Create Student
  public function createStudent($data)
  {
    $query = "INSERT INTO users (full_name, mobile, email, password, role)
            VALUES (:full_name, :mobile, :email, :password, 'student')";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Edir student
  public function editStudent($id, $data)
  {
    $query = "UPDATE users SET full_name = :full_name, mobile = :mobile, email = :email WHERE id = :id AND role = 'student'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute(array_merge($data, [':id' => $id]));
  }

  // Edit password (optional)
  public function editPassword($id, $password)
  {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = :password WHERE id = :id AND role = 'student'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $id,
    ]);
  }

  // Update user role (change from admin to teacher/admin)
  public function updateRole($id, $newRole)
  {
    $query = "UPDATE users SET role = :role WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':role' => $newRole,
      ':id' => $id
    ]);
  }

  // Delete student
  public function deleteStudent($id)
  {
    $query = "DELETE FROM users WHERE id = :id AND role = 'student'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get all students with pagination
  public function getAllStudentsPaginated($limit, $offset)
  {
    $query = "SELECT * FROM users WHERE role = 'student' ORDER BY id ASC LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total students count
  public function getTotalStudentsCount()
  {
    $query = "SELECT COUNT(*) as total FROM users WHERE role = 'student'";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }

  // Is email exist
  public function isEmailExist($email, $userId = null)
  {
    $query = "SELECT id FROM users WHERE email = :email";
    if ($userId) {
      $query .= ' AND id != :id';
    }
    $stmt = $this->db->prepare($query);
    $params = [':email' => $email];
    if ($userId) {
      $params[':id'] = $userId;
    }
    $stmt->execute($params);
    return $stmt->rowCount() > 0;
  }

  // Is mobile exist
  public function isMobileExist($mobile, $userId = null)
  {
    $query = "SELECT id FROM users WHERE mobile = :mobile";
    if ($userId) {
      $query .= ' AND id != :id';
    }
    $stmt = $this->db->prepare($query);
    $params = [':mobile' => $mobile];
    if ($userId) {
      $params[':id'] = $userId;
    }
    $stmt->execute($params);
    return $stmt->rowCount() > 0;
  }
}
