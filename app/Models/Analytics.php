<?php

namespace App\Models;

use PDO;

class Analytics
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all user stats
  public function getUserStats()
  {
    $query = "SELECT 
                SUM(CASE WHEN role = 'student' THEN 1 ELSE 0 END) as students,
                SUM(CASE WHEN role = 'teacher' THEN 1 ELSE 0 END) as teachers,
                SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) as admins
              FROM users";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return [
      'students' => (int)($result['students'] ?? 0),
      'teachers' => (int)($result['teachers'] ?? 0),
      'admins' => (int)($result['admins'] ?? 0)
    ];
  }

  // Get all content stats
  public function getContentStats()
  {
    $stats = [];

    $query = "SELECT COUNT(*) as count FROM courses";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $stats['courses'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];

    $query = "SELECT COUNT(*) as count FROM articles";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $stats['articles'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];

    $query = "SELECT COUNT(*) as count FROM offline_files";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $stats['files'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];

    $query = "SELECT COUNT(*) as count FROM notifications";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $stats['notifications'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];

    $query = "SELECT COUNT(*) as count FROM neas";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $stats['neas'] = (int)$stmt->fetch(PDO::FETCH_ASSOC)['count'];

    return $stats;
  }
}
