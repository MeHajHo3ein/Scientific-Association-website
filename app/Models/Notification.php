<?php

namespace App\Models;

use PDO;

class Notification
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get all notifications on admin/teacher panel
  public function getAllNotifications($userId = null, $role = null)
  {
    $query = "SELECT n.*, u.full_name as creator_name
              FROM notifications n
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

  // Get user notification (for students)
  public function getUserNotifications($userId)
  {
    $query = "SELECT n.*, 
                  CASE WHEN unr.id IS NOT NULL THEN unr.is_read ELSE 0 END as user_read
                  FROM notifications n
                  LEFT JOIN user_notification_read unr ON n.id = unr.notification_id AND unr.user_id = :user_id
                  WHERE n.target_role = 'student'
                  ORDER BY n.created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get unread count for student
  public function getUnreadCount($userId)
  {
    $query = "SELECT COUNT(*) as count 
              FROM notifications n
              LEFT JOIN user_notification_read unr ON n.id = unr.notification_id AND unr.user_id = :user_id
              WHERE n.target_role = 'student'
              AND (unr.id IS NULL OR unr.is_read = 0)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':user_id' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
  }

  // Create notification
  public function create($data)
  {
    $query = "INSERT INTO notifications (title, message, target_role, created_by) 
              VALUES (:title, :message, :target_role, :created_by)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Mark as read notification
  public function markAsRead($notificationId, $userId)
  {
    $query = "SELECT id FROM user_notification_read 
              WHERE notification_id = :notification_id AND user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':notification_id' => $notificationId,
      ':user_id' => $userId
    ]);

    if ($stmt->rowCount() > 0) {
      $query = "UPDATE user_notification_read 
                SET is_read = 1, read_at = NOW() 
                WHERE notification_id = :notification_id AND user_id = :user_id";
    } else {
      $query = "INSERT INTO user_notification_read (notification_id, user_id, is_read, read_at) 
                VALUES (:notification_id, :user_id, 1, NOW())";
    }

    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':notification_id' => $notificationId,
      ':user_id' => $userId
    ]);
  }

  // Delete notification
  public function delete($id, $userId = null, $role = null)
  {
    if ($role === 'teacher' && $userId) {
      $query = "DELETE FROM notifications WHERE id = :id AND created_by = :user_id";
      $stmt = $this->db->prepare($query);
      return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }

    $query = "DELETE FROM notifications WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get notification by id
  public function getById($id, $userId = null, $role = null)
  {
    $query = "SELECT * FROM notifications WHERE id = :id";

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

  // Get all notifications with pagination
  public function getAllNotificationsPaginated($limit, $offset, $userId = null, $role = null)
  {
    $query = "SELECT n.*, 
              CASE 
                  WHEN u.full_name IS NOT NULL THEN u.full_name 
                  ELSE 'سیستم' 
              END as creator_name
              FROM notifications n
              LEFT JOIN users u ON n.created_by = u.id";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE n.created_by = :user_id";
    }

    $query .= " ORDER BY n.created_at DESC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($query);

    if ($role === 'teacher' && $userId) {
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    }

    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total notifications count
  // public function getTotalNotificationsCount($userId = null, $role = null)
  // {
  //   $query = "SELECT COUNT(*) as total FROM notifications n";

  //   if ($role === 'teacher' && $userId) {
  //     $query .= " WHERE n.created_by = :user_id";
  //   }

  //   $stmt = $this->db->prepare($query);
  //   if ($role === 'teacher' && $userId) {
  //     $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
  //   }
  //   $stmt->execute();
  //   $result = $stmt->fetch(PDO::FETCH_ASSOC);
  //   return $result['total'] ?? 0;
  // }

  // Get total notifications count
  public function getTotalNotificationsCount($userId = null, $role = null)
  {
    $query = "SELECT COUNT(*) as total FROM notifications n";

    if ($role === 'teacher' && $userId) {
      $query .= " WHERE n.created_by = :user_id";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    } else {
      $stmt = $this->db->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] ?? 0;
  }

  // Get user notifications with pagination (for students)
  public function getUserNotificationsPaginated($userId, $limit, $offset)
  {
    $query = "SELECT n.*, 
                  CASE WHEN unr.id IS NOT NULL THEN unr.is_read ELSE 0 END as user_read
                  FROM notifications n
                  LEFT JOIN user_notification_read unr ON n.id = unr.notification_id AND unr.user_id = :user_id
                  WHERE n.target_role = 'student'
                  ORDER BY n.created_at DESC
                  LIMIT :limit OFFSET :offset";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get total user notifications count
  public function getUserNotificationsCount($userId)
  {
    $query = "SELECT COUNT(*) as count 
              FROM notifications n
              LEFT JOIN user_notification_read unr ON n.id = unr.notification_id AND unr.user_id = :user_id
              WHERE n.target_role = 'student'";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':user_id' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
  }
}
