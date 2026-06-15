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
  public function getAllFiles($userId = null, $role = null)
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE f.teacher_id = :user_id";
    }

    $query .= " ORDER BY f.created_at ASC";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->execute([':user_id' => $userId]);
    } else {
      $stmt->execute();
    }
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
  public function getFileById($id, $userId = null, $role = null)
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id
              WHERE f.id = :id";

    if ($role === 'teacher' && $userId) {
      $query .= " AND f.teacher_id = :user_id";
    }

    $stmt = $this->db->prepare($query);
    $params = [':id' => $id];
    if ($role === 'teacher' && $userId) {
      $params[':user_id'] = $userId;
    }
    $stmt->execute($params);
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
  public function delete($id, $userId = null, $role = null)
  {
    if ($role === 'teacher' && $userId) {
      $query = "DELETE FROM offline_files WHERE id = :id AND teacher_id = :user_id";
      $stmt = $this->db->prepare($query);
      return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }

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

  // Get all files with pagination (for admin/teacher panel)
  public function getAllFilesPaginated($userId = null, $role = null, $limit, $offset)
  {
    $query = "SELECT f.*, u.full_name as teacher_name 
              FROM offline_files f
              LEFT JOIN users u ON f.teacher_id = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE f.teacher_id = :user_id";
    }

    $query .= " ORDER BY f.created_at ASC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total files count
  public function getTotalFilesCount($userId = null, $role = null)
  {
    $query = "SELECT COUNT(*) as total FROM offline_files f";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE f.teacher_id = :user_id";
    }

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }
}
