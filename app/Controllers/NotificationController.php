<?php

namespace App\Controllers;

use App\Models\Notification;
use PDOException;

class NotificationController
{
  private $notificationModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->notificationModel = new Notification();
  }

  // Display notification page for all rules 
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'student';

    if ($role === 'student') {
      $notifications = $this->notificationModel->getUserNotifications($_SESSION['user_id']);

      foreach ($notifications as $notification) {
        if (!$notification['user_read']) {
          $this->notificationModel->markAsRead($notification['id'], $_SESSION['user_id']);
        }
      }

      $notifications = $this->notificationModel->getUserNotifications($_SESSION['user_id']);
      require_once '../app/Views/dashboard/student/notifications.php';
    } elseif ($role === 'teacher') {
      $notifications = $this->notificationModel->getAllNotifications();
      require_once '../app/Views/dashboard/teacher/notifications.php';
    } elseif ($role === 'admin') {
      $notifications = $this->notificationModel->getAllNotifications();
      require_once '../app/Views/dashboard/admin/notifications.php';
    } else {
      show403();
    }
  }

  // Display create form notification
  public function showCreateForm()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'teacher';

    if ($role !== 'teacher') {
      show403();
    }

    require_once '../app/Views/dashboard/teacher/notification-create.php';
  }

  // Save new notification (just students)
  public function store()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'student';

    if ($role !== 'teacher') {
      show403();
    }

    $title = trim($_POST['title'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $target_role = 'student';

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان اعلان الزامی است.';
    }

    if (empty($message)) {
      $errors['message'] = 'متن اعلان الزامی است.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect('/panel/notifications/create');
    }

    try {
      $data = [
        ':title' => $title,
        ':message' => $message,
        ':target_role' => $target_role
      ];

      if ($this->notificationModel->create($data)) {
        $_SESSION['success'] = 'اعلان با موفقیت ارسال شد.';
      } else {
        $_SESSION['error'] = 'خطا در انتشار اعلان.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/notifications');
  }

  // Delete notification
  public function delete($id)
  {
    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'teacher')) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'student';

    if ($role !== 'admin' && $role !== 'teacher') {
      show403();
    }

    $notification = $this->notificationModel->getById($id);
    if (!$notification) {
      $_SESSION['error'] = 'اعلان یافت نشد.';
      redirect('/panel/notifications');
    }

    try {
      if ($this->notificationModel->delete($id)) {
        $_SESSION['success'] = 'اعلان با موفقیت حذف شد.';
      } else {
        $_SESSION['error'] = 'خطا در حذف اعلان.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/notifications');
  }

  // Get unread count (for notification button)
  public function getUnreadCount()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
      echo json_encode(['count' => 0]);
      return;
    }

    $count = $this->notificationModel->getUnreadCount($_SESSION['user_id']);
    echo json_encode(['count' => $count]);
  }
}
