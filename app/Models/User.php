<?php

namespace App\Models;

use PDO;

class User
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Insert new user record into database
  public function create($data)
  {
    $query = "INSERT INTO users (full_name, mobile, email, password, role)
                          VALUES (:full_name, :mobile, :email, :password, :role)
    ";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Find user by Id
  public function findById($id)
  {
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get total students count for homepage
  public function getTotalStudentsCount()
  {
    $query = "SELECT COUNT(*) as total FROM users WHERE role = 'student'";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }

  // Update user profile
  public function updateProfile($id, $data)
  {
    $query = "UPDATE users SET full_name = :full_name, email = :email, mobile = :mobile WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':full_name' => $data['full_name'],
      ':email' => $data['email'],
      ':mobile' => $data['mobile'],
      ':id' => $id,
    ]);
  }

  // Update password
  public function updatePassword($id, $newPassword)
  {
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = :password WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':password' => $hashed_password,
      ':id' => $id,
    ]);
  }

  // Mark profile as updated
  public function markProfileAsUpdated($id)
  {
    $query = "UPDATE users SET profile_updated = 1 WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Check if user has already updated profile
  public function hasUpdatedProfile($id)
  {
    $query = "SELECT profile_updated FROM users WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result && $result['profile_updated'] == 1;
  }

  // Check if email is already exist
  public function isEmailExist($email, $userId)
  {
    $query = "SELECT id FROM users WHERE email = :email AND id != :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':email' => $email,
      ':id' => $userId,
    ]);
    return $stmt->rowCount() > 0;
  }

  // Check if mobile is already exist
  public function isMobileExist($mobile, $userId)
  {
    $query = "SELECT id FROM users WHERE mobile = :mobile AND id != :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':mobile' => $mobile,
      ':id' => $userId,
    ]);
    return $stmt->rowCount() > 0;
  }
}
