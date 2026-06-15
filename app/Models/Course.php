<?php

namespace App\Models;

use PDO;

class Course
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get published courses (for courses page)
  public function getPublishedCourses($limit = null)
  {
    $query = "SELECT c.*, u.full_name as instructor_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id
              ORDER BY c.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($limit) {
      return array_slice($results, 0, $limit);
    }
    return $results;
  }

  // Get all courses (for admin/teacher panel)
  public function getAllCourses($userId = null, $role = null)
  {
    $query = "SELECT c.*, u.full_name as instructor_name, u.full_name as creator_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE c.created_by = :user_id";
    }

    $query .= " ORDER BY c.created_at ASC";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->execute([':user_id' => $userId]);
    } else {
      $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get course by slug
  public function getCourseBySlug($slug)
  {
    $slug = urldecode($slug);
    $query = "SELECT c.*, u.full_name as instructor_name, u.image as instructor_image
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id
              WHERE c.slug = :slug";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get course by id
  public function getCourseById($id, $userId = null, $role = null)
  {
    $query = "SELECT c.*, u.full_name as instructor_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id
              WHERE c.id = :id";

    if ($role === 'teacher' && $userId) {
      $query .= " AND c.created_by = :user_id";
    }

    $stmt = $this->db->prepare($query);
    $params = [':id' => $id];
    if ($role === 'teacher' && $userId) {
      $params[':user_id'] = $userId;
    }
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get courses by category
  public function getCoursesByCategory($category, $limit = null)
  {
    $query = "SELECT c.*, u.full_name as instructor_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id
              WHERE c.category = :category
              ORDER BY c.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute([':category' => $category]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($limit) {
      return array_slice($results, 0, $limit);
    }
    return $results;
  }

  // Get last course for hero section
  public function getLastCourse()
  {
    $query = "SELECT c.*, u.full_name as instructor_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id
              ORDER BY c.created_at DESC
              LIMIT 1";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Get course prerequisites
  public function getCoursePrerequisites($courseId)
  {
    $query = "SELECT * FROM course_prerequisites WHERE course_id = :course_id ORDER BY sort_order ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':course_id' => $courseId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get course syllabus
  public function getCourseSyllabus($courseId)
  {
    $query = "SELECT * FROM course_syllabus WHERE course_id = :course_id ORDER BY sort_order ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':course_id' => $courseId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Create course
  public function create($data)
  {
    $query = "INSERT INTO courses (title, slug, category , level, price, duration, student_count, image, description, created_by) 
              VALUES (:title, :slug, :category , :level, :price, :duration, :student_count, :image, :description, :created_by)";
    $stmt = $this->db->prepare($query);
    $stmt->execute($data);
    return $this->db->lastInsertId();
  }

  // Save prerequisites
  public function savePrerequisites($courseId, $prerequisites)
  {
    $query = "DELETE FROM course_prerequisites WHERE course_id = :course_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':course_id' => $courseId]);

    if (!empty($prerequisites)) {
      $query = "INSERT INTO course_prerequisites (course_id, title, sort_order) 
                VALUES (:course_id, :title, :sort_order)";
      $stmt = $this->db->prepare($query);

      foreach ($prerequisites as $index => $prereq) {
        if (!empty($prereq)) {
          $stmt->execute([
            ':course_id' => $courseId,
            ':title' => $prereq,
            ':sort_order' => $index
          ]);
        }
      }
    }
    return true;
  }

  // Save syllabus
  public function saveSyllabus($courseId, $syllabus)
  {
    $query = "DELETE FROM course_syllabus WHERE course_id = :course_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':course_id' => $courseId]);

    if (!empty($syllabus)) {
      $query = "INSERT INTO course_syllabus (course_id, title, description, video_link, sort_order) 
                VALUES (:course_id, :title, :description, :video_link, :sort_order)";
      $stmt = $this->db->prepare($query);

      foreach ($syllabus as $index => $section) {
        if (!empty($section['title']) || !empty($section['description'])) {
          $stmt->execute([
            ':course_id' => $courseId,
            ':title' => $section['title'],
            ':description' => $section['description'],
            ':video_link' => $section['video_link'] ?? null,
            ':sort_order' => $index
          ]);
        }
      }
    }
    return true;
  }

  // Delete course
  public function delete($id, $userId = null, $role = null)
  {
    if ($role === 'teacher' && $userId) {
      $query = "DELETE FROM courses WHERE id = :id AND created_by = :user_id";
      $stmt = $this->db->prepare($query);
      return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }

    $query = "DELETE FROM courses WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Create unique slug
  public function createUniqueSlug($title)
  {
    $slug = preg_replace('/[^\x{0600}-\x{06FF}\x{FB50}-\x{FDFF}\x{FE70}-\x{FEFF}a-zA-Z0-9]+/u', '-', $title);
    $slug = trim($slug, '-');

    if (empty($slug)) {
      $slug = 'course-' . time();
    }

    $originalSlug = $slug;
    $counter = 1;

    while ($this->isSlugExist($slug)) {
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }

  // Check is slug exist
  public function isSlugExist($slug, $excludeId = null)
  {
    $query = "SELECT id FROM courses WHERE slug = :slug";
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

  // Get all courses with pagination
  public function getAllCoursesPaginated($userId = null, $role = null, $limit, $offset)
  {
    $query = "SELECT c.*, u.full_name as instructor_name, u.full_name as creator_name
              FROM courses c
              LEFT JOIN users u ON c.created_by = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE c.created_by = :user_id";
    }

    $query .= " ORDER BY c.created_at ASC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);
    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total courses count
  public function getTotalCoursesCount($userId = null, $role = null)
  {
    $query = "SELECT COUNT(*) as total FROM courses c";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE c.created_by = :user_id";
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
