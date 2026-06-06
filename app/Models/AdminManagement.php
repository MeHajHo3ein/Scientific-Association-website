<?php

namespace App\Models;

use PDO;

class AdminManagement
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all admins
  public function getAllAdmins()
  {
    $query = "SELECT * FROM users WHERE role = 'admin' ORDER BY id ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get admin by id
  public function getAdminById($id)
  {
    $query = "SELECT * FROM users WHERE id = :id AND role = 'admin'";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Create admin
  public function createAdmin($data)
  {
    $query = "INSERT INTO users (full_name, mobile, email, password, role)
            VALUES (:full_name, :mobile, :email, :password, 'admin')";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Edir admin
  public function editAdmin($id, $data)
  {
    $query = "UPDATE users SET full_name = :full_name, mobile = :mobile, email = :email WHERE id = :id AND role = 'admin'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute(array_merge($data, [':id' => $id]));
  }

  // Edit password (optional)
  public function editPassword($id, $password)
  {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = :password WHERE id = :id AND role = 'admin'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $id,
    ]);
  }

  // Update user role (change from admin to student/teacher)
  public function updateRole($id, $newRole)
  {
    $query = "UPDATE users SET role = :role WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':role' => $newRole,
      ':id' => $id
    ]);
  }

  // Delete admin
  public function deleteAdmin($id)
  {
    $query = "DELETE FROM users WHERE id = :id AND role = 'admin'";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
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
