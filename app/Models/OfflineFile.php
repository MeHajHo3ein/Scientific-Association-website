<?php

namespace App\Models;

use PDO;

class OfflineFile
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all files (for admin/teacher panel)
  public function getAllFiles()
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id
              ORDER BY f.created_at ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get files by teacher id
  public function getFilesByTeacher($teacherId)
  {
    $query = "SELECT * FROM offline_files 
              WHERE teacher_id = :teacher_id 
              ORDER BY created_at ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':teacher_id' => $teacherId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get all files for public page with limit
  public function getPublishedFiles($limit = null)
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id
              ORDER BY f.created_at DESC";

    if ($limit) {
      $query .= " LIMIT " . intval($limit);
    }

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get file by id
  public function getFileById($id)
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id
              WHERE f.id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Create new file
  public function create($data)
  {
    $query = "INSERT INTO offline_files (title, lesson, teacher_id, file_link, file_type, price) 
              VALUES (:title, :lesson, :teacher_id, :file_link, :file_type, :price)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Delete file
  public function delete($id)
  {
    $query = "DELETE FROM offline_files WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get file type from extension
  public static function getFileTypeFromUrl($url)
  {
    $ext = strtolower(pathinfo($url, PATHINFO_EXTENSION));

    $ext = preg_replace('/[^a-z0-9]/', '', $ext);

    if (!empty($ext)) {
      return strtoupper($ext);
    }

    return 'FILE';
  }
}
