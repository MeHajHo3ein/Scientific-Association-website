<?php

namespace App\Models;

use PDO;

class TeacherManagement
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all teachers
  public function getAllTeachers()
  {
    $query = "SELECT * FROM users WHERE role = 'teacher' ORDER BY id ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get teacher by id
  public function getTeacherById($id)
  {
    $query = "SELECT * FROM users WHERE id = :id AND role = 'teacher'";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Create teacher
  public function createTeacher($data)
  {
    $query = "INSERT INTO users (full_name, mobile, email, password, role, image) 
                  VALUES (:full_name, :mobile, :email, :password, 'teacher', :image)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Edir teacher
  public function editTeacher($id, $data)
  {
    $query = "UPDATE users SET full_name = :full_name, mobile = :mobile, email = :email, image = :image 
                  WHERE id = :id AND role = 'teacher'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute(array_merge($data, [':id' => $id]));
  }

  // Edit password (optional)
  public function editPassword($id, $password)
  {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = :password WHERE id = :id AND role = 'teacher'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $id,
    ]);
  }

  // Update user role (change from admin to student/admin)
  public function updateRole($id, $newRole)
  {
    $query = "UPDATE users SET role = :role WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':role' => $newRole,
      ':id' => $id
    ]);
  }

  // Delete teacher
  public function deleteTeacher($id)
  {
    $query = "DELETE FROM users WHERE id = :id AND role = 'teacher'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get all teachers with pagination
  public function getAllTeachersPaginated($limit, $offset)
  {
    $query = "SELECT * FROM users WHERE role = 'teacher' ORDER BY id ASC LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total teachers count
  public function getTotalTeachersCount()
  {
    $query = "SELECT COUNT(*) as total FROM users WHERE role = 'teacher'";
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
