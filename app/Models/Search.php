<?php

namespace App\Models;

use PDO;

class Search
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  public function search($query, $type = 'all', $category = 'all', $limit = 10, $offset = 0)
  {
    $results = [];

    if ($type == 'all' || $type == 'course') {
      $courseQuery = "SELECT c.id, c.title, c.slug, c.description, c.image, c.level, c.price, c.duration, c.created_at,
                            'course' as content_type, u.full_name as author_name, c.category
                     FROM courses c
                     LEFT JOIN users u ON c.created_by = u.id
                     WHERE (c.title LIKE :query OR c.description LIKE :query)";

      if ($category != 'all' && !empty($category)) {
        $courseQuery .= " AND c.category = :category";
      }

      $courseQuery .= " ORDER BY c.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($courseQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);

      if ($category != 'all' && !empty($category)) {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
      }

      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $courses);
    }

    if ($type == 'all' || $type == 'article') {
      $articleQuery = "SELECT a.id, a.title, a.slug, a.summary as description, a.content, a.created_at,
                             'article' as content_type, u.full_name as author_name, NULL as level, NULL as price, NULL as duration, NULL as image, NULL as category
                      FROM articles a
                      LEFT JOIN users u ON a.author_id = u.id
                      WHERE (a.title LIKE :query OR a.summary LIKE :query OR a.content LIKE :query)
                      ORDER BY a.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($articleQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $articles);
    }

    if ($type == 'all' || $type == 'resource') {
      $fileQuery = "SELECT f.id, f.title, f.file_link, f.file_type, f.price, f.created_at,
                           'resource' as content_type, u.full_name as author_name, f.lesson as category, NULL as level, NULL as duration, NULL as image
                    FROM offline_files f
                    LEFT JOIN users u ON f.teacher_id = u.id
                    WHERE (f.title LIKE :query OR f.lesson LIKE :query)
                    ORDER BY f.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($fileQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $files);
    }

    usort($results, function ($a, $b) {
      return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    return $results;
  }

  public function getAllContent($type = 'all', $category = 'all', $limit = 10, $offset = 0)
  {
    $results = [];

    if ($type == 'all' || $type == 'course') {
      $courseQuery = "SELECT c.id, c.title, c.slug, c.description, c.image, c.level, c.price, c.duration, c.created_at,
                          'course' as content_type, u.full_name as author_name, c.category
                   FROM courses c
                   LEFT JOIN users u ON c.created_by = u.id";

      if ($category != 'all' && !empty($category)) {
        $courseQuery .= " WHERE c.category = :category";
      }

      $courseQuery .= " ORDER BY c.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($courseQuery);
      if ($category != 'all' && !empty($category)) {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
      }
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $courses);
    }

    if ($type == 'all' || $type == 'article') {
      $articleQuery = "SELECT a.id, a.title, a.slug, a.summary as description, a.content, a.created_at,
                           'article' as content_type, u.full_name as author_name, NULL as level, NULL as price, NULL as duration, NULL as image, NULL as category
                    FROM articles a
                    LEFT JOIN users u ON a.author_id = u.id
                    ORDER BY a.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($articleQuery);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $articles);
    }

    if ($type == 'all' || $type == 'resource') {
      $fileQuery = "SELECT f.id, f.title, f.file_link, f.file_type, f.price, f.created_at,
                         'resource' as content_type, u.full_name as author_name, f.lesson as category, NULL as level, NULL as duration, NULL as image
                  FROM offline_files f
                  LEFT JOIN users u ON f.teacher_id = u.id
                  ORDER BY f.created_at DESC LIMIT :limit OFFSET :offset";

      $stmt = $this->db->prepare($fileQuery);
      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();

      $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $results = array_merge($results, $files);
    }

    usort($results, function ($a, $b) {
      return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    return $results;
  }

  public function countAllContent($type = 'all', $category = 'all')
  {
    $total = 0;

    if ($type == 'all' || $type == 'course') {
      $courseQuery = "SELECT COUNT(*) as count FROM courses c";
      if ($category != 'all' && !empty($category)) {
        $courseQuery .= " WHERE c.category = :category";
      }
      $stmt = $this->db->prepare($courseQuery);
      if ($category != 'all' && !empty($category)) {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
      }
      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    if ($type == 'all' || $type == 'article') {
      $articleQuery = "SELECT COUNT(*) as count FROM articles";
      $stmt = $this->db->prepare($articleQuery);
      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    if ($type == 'all' || $type == 'resource') {
      $fileQuery = "SELECT COUNT(*) as count FROM offline_files";
      $stmt = $this->db->prepare($fileQuery);
      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    return $total;
  }

  public function countSearch($query, $type = 'all', $category = 'all')
  {
    $total = 0;

    if ($type == 'all' || $type == 'course') {
      $courseQuery = "SELECT COUNT(*) as count FROM courses c WHERE (c.title LIKE :query OR c.description LIKE :query)";

      if ($category != 'all' && !empty($category)) {
        $courseQuery .= " AND c.category = :category";
      }

      $stmt = $this->db->prepare($courseQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);

      if ($category != 'all' && !empty($category)) {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
      }

      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    if ($type == 'all' || $type == 'article') {
      $articleQuery = "SELECT COUNT(*) as count FROM articles a WHERE (a.title LIKE :query OR a.summary LIKE :query OR a.content LIKE :query)";
      $stmt = $this->db->prepare($articleQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    if ($type == 'all' || $type == 'resource') {
      $fileQuery = "SELECT COUNT(*) as count FROM offline_files f WHERE (f.title LIKE :query OR f.lesson LIKE :query)";
      $stmt = $this->db->prepare($fileQuery);
      $searchTerm = "%{$query}%";
      $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
      $stmt->execute();
      $total += $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    return $total;
  }

  public function liveSearch($query, $limit = 5)
  {
    $results = $this->search($query, 'all', 'all', $limit, 0);
    return array_slice($results, 0, $limit);
  }
}
