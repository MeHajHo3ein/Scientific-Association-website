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
