<?php

namespace App\Models;

use PDO;

class Neas
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all items (for admin/teacher panel)
  public function getAllItems($userId = null, $role = null)
  {
    $query = "SELECT n.*, u.full_name as author_name
              FROM neas n
              LEFT JOIN users u ON n.created_by = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE n.created_by = :user_id";
    }

    $query .= " ORDER BY n.created_at ASC";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->execute([':user_id' => $userId]);
    } else {
      $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get items by category (for neas page)
  public function getItemsByCategory($category)
  {
    $query = "SELECT n.*, u.full_name as author_name
              FROM neas n
              LEFT JOIN users u ON n.created_by = u.id
              WHERE n.category = :category
              ORDER BY n.created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':category' => $category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get item by id
  public function getItemById($id, $userId = null, $role = null)
  {
    $query = "SELECT * FROM neas WHERE id = :id";

    if ($role === 'teacher' && $userId) {
      $query .= " AND created_by = :user_id";
    }

    $stmt = $this->db->prepare($query);
    $params = [':id' => $id];
    if ($role === 'teacher' && $userId) {
      $params[':user_id'] = $userId;
    }
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get latest items by category with limit (for homepage)
  public function getLatestItemsByCategory($category, $limit)
  {
    $query = "SELECT n.*, u.full_name as author_name
              FROM neas n
              LEFT JOIN users u ON n.created_by = u.id
              WHERE n.category = :category
              ORDER BY n.created_at DESC
              LIMIT :limit";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Create new item
  public function create($data)
  {
    $query = "INSERT INTO neas (title, content, category, created_by)
              VALUES (:title, :content, :category, :created_by)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Delete item
  public function delete($id, $userId = null, $role = null)
  {
    if ($role === 'teacher' && $userId) {
      $query = "DELETE FROM neas WHERE id = :id AND created_by = :user_id";
      $stmt = $this->db->prepare($query);
      return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }

    $query = "DELETE FROM neas WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get all items with pagination (for admin/teacher panel)
  public function getAllItemsPaginated($userId = null, $role = null, $limit, $offset)
  {
    $query = "SELECT n.*, u.full_name as author_name
              FROM neas n
              LEFT JOIN users u ON n.created_by = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE n.created_by = :user_id";
    }

    $query .= " ORDER BY n.created_at ASC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total items count
  public function getTotalItemsCount($userId = null, $role = null)
  {
    $query = "SELECT COUNT(*) as total FROM neas n";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE n.created_by = :user_id";
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
