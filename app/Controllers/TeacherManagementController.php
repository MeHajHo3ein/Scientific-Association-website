<?php

namespace App\Controllers;

use App\Models\TeacherManagement;
use PDOException;

class TeacherManagementController
{
  private $teacherModel;

  public function __construct()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      redirect('/auth/login');
    }

    $this->teacherModel = new TeacherManagement();
  }

  // Show teachers list
  public function index()
  {
    $teachers = $this->teacherModel->getAllTeachers();
    require_once '../app/Views/dashboard/admin/teachers.php';
  }

  // Show create form
  public function showCreateForm()
  {
    require_once '../app/Views/dashboard/admin/teacher-create.php';
  }

  // Store add teacher
  public function store()
  {
    $full_name = trim($_POST['full_name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (empty($full_name) || strlen($full_name) < 3) {
      $errors['full_name'] = 'نام و نام خانوادگی باید حداقل ۳ کاراکتر باشد.';
    }

    if (empty($email)) {
      $errors['email'] = 'ایمیل الزامی است.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
      $errors['email'] = 'ایمیل معتبر نیست. باید از سرویس gmail.com استفاده کنید.';
    } elseif ($this->teacherModel->isEmailExist($email)) {
      $errors['email_duplicate'] = 'تکراری است.';
    }

    if (empty($mobile)) {
      $errors['mobile'] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors['mobile'] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    } elseif ($this->teacherModel->isMobileExist($mobile)) {
      $errors['mobile_duplicate'] = 'تکراری است.';
    }

    if (empty($password)) {
      $errors['password'] = 'رمز عبور الزامی است.';
    } elseif (strlen($password) < 8) {
      $errors['password'] = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect('/panel/teachers/create');
    }

    try {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $data = [
        ':full_name' => $full_name,
        ':mobile' => $mobile,
        ':email' => $email,
        ':password' => $hashed_password,
      ];

      if ($this->teacherModel->createTeacher($data)) {
        $_SESSION['success'] = 'کاربر ' . htmlspecialchars($full_name) . ' با موفقیت اضافه شد.';
      } else {
        $_SESSION['error'] = 'خطا در افزودن استاد.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/teachers');
  }
}
