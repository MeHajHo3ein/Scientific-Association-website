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
  public function getAllItems()
  {
    $query = "SELECT n.*, u.full_name as author_name
                  FROM neas n
                  LEFT JOIN users u ON n.created_by = u.id
                  ORDER BY n.created_at ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get items by category (for news page)
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
  public function getItemById($id)
  {
    $query = "SELECT * FROM neas WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
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
  public function delete($id)
  {
    $query = "DELETE FROM neas WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }
}
