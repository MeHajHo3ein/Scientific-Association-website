<?php

namespace App\Controllers;

use App\Models\Ticket;
use PDOException;

class TicketController
{
  private $ticketModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->ticketModel = new Ticket();
  }

  // Display tickets for RBAC
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'student';

    if ($role === 'admin') {
      $tickets = $this->ticketModel->getAllTickets();
      require_once '../app/Views/dashboard/admin/tickets.php';
    } elseif ($role === 'teacher') {
      $tickets = $this->ticketModel->getUserTickets($_SESSION['user_id']);
      require_once '../app/Views/dashboard/teacher/tickets.php';
    } else {
      $tickets = $this->ticketModel->getUserTickets($_SESSION['user_id']);
      require_once '../app/Views/dashboard/student/tickets.php';
    }
  }

  // Store new ticket
  public function store()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $title = trim($_POST['title'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان تیکت الزامی است.';
    } elseif (strlen($title) < 3) {
      $errors['title'] = 'عنوان باید حداقل ۳ کاراکتر باشد.';
    }

    if (empty($message)) {
      $errors['message'] = 'متن تیکت الزامی است.';
    } elseif (strlen($message) < 3) {
      $errors['message'] = 'متن باید حداقل ۳ کاراکتر باشد.';
    }

    if (!empty($errors)) {
      $_SESSION['ticket_errors'] = $errors;
      $_SESSION['ticket_data'] = $_POST;
      redirect('/panel/tickets');
    }

    try {
      $data = [
        ':user_id' => $_SESSION['user_id'],
        ':title' => $title,
        ':message' => $message
      ];

      if ($this->ticketModel->create($data)) {
        $_SESSION['ticket_success'] = 'تیکت شما با موفقیت ارسال شد.';
      } else {
        $_SESSION['ticket_error'] = 'خطا در ارسال تیکت. لطفاً مجدداً تلاش کنید.';
      }
    } catch (PDOException $e) {
      $_SESSION['ticket_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/tickets');
  }

  // Mark as read by admin
  public function markAsReadByAdmin($id)
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      show403();
    }

    try {
      $this->ticketModel->markAsReadByAdmin($id);
    } catch (PDOException $e) {
      $_SESSION['ticket_error'] = 'خطا در علامت زدن تیکت.';
    }

    redirect('/panel/tickets');
  }

  // Delete ticket
  public function delete($id)
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      show403();
    }

    try {
      if ($this->ticketModel->deleteTicket($id)) {
        $_SESSION['ticket_success'] = 'تیکت با موفقیت حذف شد.';
      } else {
        $_SESSION['ticket_error'] = 'خطا در حذف تیکت.';
      }
    } catch (PDOException $e) {
      $_SESSION['ticket_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/tickets');
  }

  // Get unread count (for API)
  public function getUnreadCount()
  {
    if (!isset($_SESSION['user_id'])) {
      echo json_encode(['count' => 0]);
      return;
    }

    $role = $_SESSION['role'] ?? 'student';

    if ($role === 'admin') {
      $count = $this->ticketModel->getUnreadCountForAdmin();
    } else {
      $count = 0;
    }

    echo json_encode(['count' => $count]);
  }
}
