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
  public function getAllNotifications()
  {
    $query = "SELECT * FROM notifications ORDER BY created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get user notification
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
    $query = "INSERT INTO notifications (title, message, target_role) VALUES (:title, :message, :target_role)";
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
  public function delete($id)
  {
    $query = "DELETE FROM notifications WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get notification by id
  public function getById($id)
  {
    $query = "SELECT * FROM notifications WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
