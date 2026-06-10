<?php

namespace App\Controllers;

use App\Models\Neas;
use PDOException;

class NeasController
{
  private $neasModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->neasModel = new Neas();
  }

  // Display NEA in neas page
  public function index()
  {
    $news = $this->neasModel->getItemsByCategory('news');
    $events = $this->neasModel->getItemsByCategory('event');
    $announcements = $this->neasModel->getItemsByCategory('announcement');
    require_once '../app/Views/pages/neas.php';
  }

  // Display item list (for admin/teacher panel)
  public function adminIndex()
  {
    $this->checkAdminOrTeacherAuth();
    $items = $this->neasModel->getAllItems();
    $role = $_SESSION['role'] ?? 'teacher';

    switch ($role) {
      case 'owner':
        require_once '../app/Views/dashboard/owner/neas.php';
        break;
      case 'admin':
        require_once '../app/Views/dashboard/admin/neas.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/neas.php';
        break;
    }
  }

  // Display create form for only teacher
  public function showCreateForm()
  {
    $this->checkTeacherAuth();
    require_once '../app/Views/dashboard/teacher/neas-create.php';
  }

  // Store items
  public function store()
  {
    $this->checkTeacherAuth();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('/panel/neas');
    }

    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $category = $_POST['category'] ?? 'announcement';

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان الزامی است.';
    }

    if (empty($content)) {
      $errors['content'] = 'متن الزامی است.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect('/panel/neas/create');
    }

    try {
      $data = [
        ':title' => $title,
        ':content' => $content,
        ':category' => $category,
        ':created_by' => $_SESSION['user_id']
      ];

      if ($this->neasModel->create($data)) {
        $_SESSION['success'] = 'مطلب با موفقیت اضافه شد.';
      } else {
        $_SESSION['error'] = 'خطا در افزودن مطلب.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/neas');
  }

  // Delete item
  public function delete($id)
  {
    $this->checkAdminOrTeacherAuth();

    $item = $this->neasModel->getItemById($id);
    if (!$item) {
      $_SESSION['error'] = 'مطلب یافت نشد.';
      redirect('/panel/neas');
    }

    try {
      if ($this->neasModel->delete($id)) {
        $_SESSION['success'] = 'مطلب با موفقیت حذف شد.';
      } else {
        $_SESSION['error'] = 'خطا در حذف مطلب.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/neas');
  }

  private function checkTeacherAuth()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
      show403();
    }
  }

  private function checkAdminOrTeacherAuth()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $role = $_SESSION['role'] ?? 'student';
    if ($role !== 'owner' && $role !== 'admin' && $role !== 'teacher') {
      show403();
    }
  }
}
