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

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;
    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $files = $this->fileModel->getAllFilesPaginated($userId, $role, $perPage, $offset);
    $totalFiles = $this->fileModel->getTotalFilesCount($userId, $role);
    $totalPages = ceil($totalFiles / $perPage);

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
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $publicFiles = $this->fileModel->getPublishedFilesPaginated($perPage, $offset);
    $totalFiles = $this->fileModel->getTotalPublishedFilesCount();
    $totalPages = ceil($totalFiles / $perPage);

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

  // Get offline courses list for AJAX pagination
  public function getOfflineCoursesList()
  {
    header('Content-Type: application/json');

    $this->checkAdminOrTeacherAuth();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $items = $this->fileModel->getAllFilesPaginated($userId, $role, $perPage, $offset);
    $totalItems = $this->fileModel->getTotalFilesCount($userId, $role);
    $totalPages = ceil($totalItems / $perPage);

    $formattedItems = [];
    foreach ($items as $item) {
      $formattedItems[] = [
        'id' => $item['id'],
        'title' => $item['title'],
        'lesson' => $item['lesson'],
        'teacher_name' => $item['teacher_name'],
        'file_type' => $item['file_type'],
        'price' => $item['price'] > 0 ? number_format($item['price']) . ' تومان' : 'رایگان',
        'created_at_fa' => toJalali($item['created_at'], 'Y/m/d')
      ];
    }

    echo json_encode([
      'success' => true,
      'items' => $formattedItems,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalItems' => $totalItems
    ]);
  }

  // Get public offline courses list for AJAX pagination
  public function getPublicOfflineCoursesList()
  {
    header('Content-Type: application/json');

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $items = $this->fileModel->getPublishedFilesPaginated($perPage, $offset);
    $totalItems = $this->fileModel->getTotalPublishedFilesCount();
    $totalPages = ceil($totalItems / $perPage);

    $formattedItems = [];
    foreach ($items as $item) {
      $formattedItems[] = [
        'id' => $item['id'],
        'title' => $item['title'],
        'lesson' => $item['lesson'],
        'teacher_name' => $item['teacher_name'],
        'file_type' => $item['file_type'],
        'file_link' => $item['file_link'],
        'price_formatted' => $item['price'] > 0 ? number_format($item['price']) . ' تومان' : 'رایگان',
        'price' => $item['price']
      ];
    }

    echo json_encode([
      'success' => true,
      'items' => $formattedItems,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalItems' => $totalItems
    ]);
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
