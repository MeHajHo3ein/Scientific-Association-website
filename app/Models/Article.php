<?php

namespace App\Models;

use PDO;

class Article
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get publiced articles
  public function getPublishedArticles($limit = null)
  {
    $query = "SELECT a.*, u.full_name as author_name 
                  FROM articles a
                  LEFT JOIN users u ON a.author_id = u.id
                  ORDER BY a.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($limit) {
      return array_slice($results, 0, $limit);
    }
    return $results;
  }

  // Get all articles for admin/teacher panel
  public function getAllArticles($userId = null, $role = null)
  {
    $query = "SELECT a.*, u.full_name as author_name 
              FROM articles a
              LEFT JOIN users u ON a.author_id = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE a.author_id = :user_id";
    }

    $query .= " ORDER BY a.created_at ASC";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->execute([':user_id' => $userId]);
    } else {
      $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get article by slug for articles detail
  public function getArticleBySlug($slug)
  {
    $slug = urldecode($slug);

    $query = "SELECT a.*, u.full_name as author_name 
              FROM articles a
              LEFT JOIN users u ON a.author_id = u.id
              WHERE a.slug = :slug";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get article by id
  public function getArticleById($id, $userId = null, $role = null)
  {
    $query = "SELECT a.*, u.full_name as author_name 
              FROM articles a
              LEFT JOIN users u ON a.author_id = u.id
              WHERE a.id = :id";

    if ($role === 'teacher' && $userId) {
      $query .= " AND a.author_id = :user_id";
    }

    $stmt = $this->db->prepare($query);
    $params = [':id' => $id];
    if ($role === 'teacher' && $userId) {
      $params[':user_id'] = $userId;
    }
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get article sections
  public function getArticleSections($articleId)
  {
    $query = "SELECT * FROM article_sections WHERE article_id = :article_id ORDER BY sort_order ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':article_id' => $articleId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /// Create article
  public function create($data)
  {
    $query = "INSERT INTO articles (title, slug, summary, content, author_id) 
              VALUES (:title, :slug, :summary, :content, :author_id)";
    $stmt = $this->db->prepare($query);
    $stmt->execute($data);
    return $this->db->lastInsertId();
  }

  // save sections
  public function saveSections($articleId, $sections)
  {
    $query = "DELETE FROM article_sections WHERE article_id = :article_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':article_id' => $articleId]);

    if (!empty($sections)) {
      $query = "INSERT INTO article_sections (article_id, title, description, sort_order) 
                VALUES (:article_id, :title, :description, :sort_order)";
      $stmt = $this->db->prepare($query);

      foreach ($sections as $index => $section) {
        if (!empty($section['title']) || !empty($section['description'])) {
          $stmt->execute([
            ':article_id' => $articleId,
            ':title' => $section['title'],
            ':description' => $section['description'],
            ':sort_order' => $index
          ]);
        }
      }
    }
    return true;
  }

  /// Delete article
  public function delete($id, $userId = null, $role = null)
  {
    if ($role === 'teacher' && $userId) {
      $query = "DELETE FROM articles WHERE id = :id AND author_id = :user_id";
      $stmt = $this->db->prepare($query);
      return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }

    $query = "DELETE FROM articles WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Create unique slug
  public function createUniqueSlug($title)
  {
    $slug = preg_replace('/[^\x{0600}-\x{06FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}a-zA-Z0-9]+/u', '-', $title);
    $slug = trim($slug, '-');

    if (empty($slug)) {
      $slug = 'article-' . time();
    }

    $originalSlug = $slug;
    $counter = 1;

    while ($this->isSlugExist($slug)) {
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  // Is slug exist
  public function isSlugExist($slug, $excludeId = null)
  {
    $query = "SELECT id FROM articles WHERE slug = :slug";
    if ($excludeId) {
      $query .= " AND id != :id";
    }
    $stmt = $this->db->prepare($query);
    $params = [':slug' => $slug];
    if ($excludeId) {
      $params[':id'] = $excludeId;
    }
    $stmt->execute($params);
    return $stmt->rowCount() > 0;
  }

  // Get all articles with pagination
  public function getAllArticlesPaginated($userId = null, $role = null, $limit, $offset)
  {
    $query = "SELECT a.*, u.full_name as author_name 
              FROM articles a
              LEFT JOIN users u ON a.author_id = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE a.author_id = :user_id";
    }

    $query .= " ORDER BY a.created_at ASC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total articles count
  public function getTotalArticlesCount($userId = null, $role = null)
  {
    $query = "SELECT COUNT(*) as total FROM articles a";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE a.author_id = :user_id";
    }

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }

  // Get published articles with pagination
  public function getPublishedArticlesPaginated($limit, $offset)
  {
    $query = "SELECT a.*, u.full_name as author_name 
              FROM articles a
              LEFT JOIN users u ON a.author_id = u.id
              ORDER BY a.created_at DESC
              LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total published articles count
  public function getTotalPublishedArticlesCount()
  {
    $query = "SELECT COUNT(*) as total FROM articles";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }
}
