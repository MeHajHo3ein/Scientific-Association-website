<?php

namespace App\Controllers;

use App\Models\OfflineFile;
use PDOException;

class OfflineFileController
{
  private $fileModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->fileModel = new OfflineFile();
  }

  // Display files in owner/admin/teacher panels
  public function index()
  {
    $this->checkAdminOrTeacherAuth();

    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $files = $this->fileModel->getAllFiles($userId, $role);

    if ($role === 'admin') {
      require_once '../app/Views/dashboard/admin/offline-courses.php';
    } elseif ($role === 'owner') {
      require_once '../app/Views/dashboard/owner/offline-courses.php';
    } else {
      require_once '../app/Views/dashboard/teacher/offline-courses.php';
    }
  }

  // Show create form Files only for teacher
  public function showCreateForm()
  {
    $this->checkTeacherAuth();
    require_once '../app/Views/dashboard/teacher/create-offline-courses.php';
  }

  // Display files for public index
  public function publicIndex()
  {
    $publicFiles = $this->fileModel->getPublishedFiles();
    require_once '../app/Views/pages/offline-courses.php';
  }

  // Store new file
  public function store()
  {
    $this->checkTeacherAuth();

    $title = trim($_POST['title'] ?? '');
    $lesson = trim($_POST['lesson'] ?? '');
    $file_link = trim($_POST['file_link'] ?? '');
    $price = intval($_POST['price'] ?? 0);

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان الزامی است.';
    }

    if (empty($lesson)) {
      $errors['lesson'] = 'نام درس الزامی است.';
    }

    if (empty($file_link)) {
      $errors['file_link'] = 'لینک فایل الزامی است.';
    } elseif (!filter_var($file_link, FILTER_VALIDATE_URL)) {
      $errors['file_link'] = 'لینک وارد شده معتبر نیست.';
    }

    if (!empty($errors)) {
      $_SESSION['offline_errors'] = $errors;
      $_SESSION['offline_old'] = $_POST;
      redirect('/panel/create-offline-courses');
    }

    try {
      $fileType = OfflineFile::getFileTypeFromUrl($file_link);

      $data = [
        ':title' => $title,
        ':lesson' => $lesson,
        ':teacher_id' => $_SESSION['user_id'],
        ':file_link' => $file_link,
        ':file_type' => $fileType,
        ':price' => $price
      ];

      if ($this->fileModel->create($data)) {
        $_SESSION['offline_success'] = 'فایل <strong>' . htmlspecialchars($title) . '</strong> با موفقیت آپلود شد.';
      } else {
        $_SESSION['offline_error'] = 'خطا در افزودن فایل.';
      }
    } catch (PDOException $e) {
      $_SESSION['offline_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/offline-courses');
  }

  // Delete file
  public function delete($id)
  {
    $this->checkAdminOrTeacherAuth();

    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $file = $this->fileModel->getFileById($id, $userId, $role);
    if (!$file) {
      $_SESSION['offline_error'] = 'فایل یافت نشد یا شما اجازه حذف آن را ندارید.';
      redirect('/panel/offline-courses');
    }

    try {
      if ($this->fileModel->delete($id, $userId, $role)) {
        $_SESSION['offline_success'] = 'فایل <strong>' . htmlspecialchars($file['title']) . '</strong> با موفقیت حذف شد.';
      } else {
        $_SESSION['offline_error'] = 'خطا در حذف فایل.';
      }
    } catch (PDOException $e) {
      $_SESSION['offline_error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/offline-courses');
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
