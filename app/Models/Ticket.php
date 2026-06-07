<?php

namespace App\Models;

use PDO;

class Ticket
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Create new ticket
  public function create($data)
  {
    $query = "INSERT INTO tickets (user_id, title, message) 
              VALUES (:user_id, :title, :message)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }

  // Get all tickets for admin
  public function getAllTickets()
  {
    $query = "SELECT t.*, u.full_name as user_name, u.email as user_email 
              FROM tickets t
              LEFT JOIN users u ON t.user_id = u.id
              ORDER BY 
                CASE WHEN t.is_read_admin = 0 THEN 0 ELSE 1 END,
                t.created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get user tickets (for student/teacher)
  public function getUserTickets($userId)
  {
    $query = "SELECT t.* 
              FROM tickets t
              WHERE t.user_id = :user_id
              ORDER BY t.created_at DESC";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get ticket by id
  public function getTicketById($id)
  {
    $query = "SELECT t.*, u.full_name as user_name, u.email as user_email 
              FROM tickets t
              LEFT JOIN users u ON t.user_id = u.id
              WHERE t.id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Mark ticket as read by admin
  public function markAsReadByAdmin($id)
  {
    $query = "UPDATE tickets SET is_read_admin = 1 WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Delete ticket
  public function deleteTicket($id)
  {
    $query = "DELETE FROM tickets WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get unread count for admin
  public function getUnreadCountForAdmin()
  {
    $query = "SELECT COUNT(*) as count FROM tickets WHERE is_read_admin = 0";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
  }
}
