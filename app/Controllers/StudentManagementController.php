<?php

namespace App\Controllers;

use App\Models\StudentManagement;
use PDOException;

class StudentManagementController
{
  private $studentModel;

  public function __construct()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      redirect('/auth/login');
    }

    $this->studentModel = new StudentManagement();
  }

  // Show students list
  public function index()
  {
    $students = $this->studentModel->getAllStudents();
    require_once '../app/Views/dashboard/admin/students.php';
  }

  // Show create form
  public function showCreateForm()
  {
    require_once '../app/Views/dashboard/admin/student-create.php';
  }

  // Show edit form
  public function showEditForm($id)
  {
    $student = $this->studentModel->getStudentById($id);
    if (!$student) {
      $_SESSION['error'] = 'دانشجو یافت نشد.';
      redirect('/panel/students');
    }

    require_once '../app/Views/dashboard/admin/student-edit.php';
  }

  // Store add student
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
    } elseif ($this->studentModel->isEmailExist($email)) {
      $errors['email_duplicate'] = 'تکراری است.';
    }

    if (empty($mobile)) {
      $errors['mobile'] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors['mobile'] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    } elseif ($this->studentModel->isMobileExist($mobile)) {
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
      redirect('/panel/students/create');
    }

    try {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $data = [
        ':full_name' => $full_name,
        ':mobile' => $mobile,
        ':email' => $email,
        ':password' => $hashed_password,
      ];

      if ($this->studentModel->createStudent($data)) {
        $_SESSION['success'] = 'کاربر ' . htmlspecialchars($full_name) . ' با موفقیت اضافه شد.';
      } else {
        $_SESSION['error'] = 'خطا در افزودن دانشجو.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/students');
  }

  // Edit student
  public function update($id)
  {
    $student = $this->studentModel->getStudentById($id);
    if (!$student) {
      $_SESSION['error'] = 'دانشجو یافت نشد.';
      redirect('/panel/students');
    }

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
    } elseif ($this->studentModel->isEmailExist($email, $id)) {
      $errors['email_duplicate'] = 'تکراری است.';
    }

    if (empty($mobile)) {
      $errors['mobile'] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors['mobile'] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    } elseif ($this->studentModel->isMobileExist($mobile, $id)) {
      $errors['mobile_duplicate'] = 'تکراری است.';
    }

    if (!empty($password) && strlen($password) < 8) {
      $errors['password'] = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect("/panel/students/edit/{$id}");
    }

    try {
      $data = [
        ':full_name' => $full_name,
        ':mobile' => $mobile,
        ':email' => $email,
      ];

      $profileUpdated = $this->studentModel->editStudent($id, $data);
      $passwordUpdated = true;

      if (!empty($password)) {
        $passwordUpdated = $this->studentModel->editPassword($id, $password);
      }

      if ($profileUpdated && $passwordUpdated) {
        $_SESSION['success'] = 'اطلاعات کاربر ' . htmlspecialchars($full_name) . ' با موفقیت تغییر کرد.';
      } else {
        $_SESSION['error'] = 'خطا در ویرایش اطلاعات.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/students');
  }

  // Delete student
  public function deleteStudent($id)
  {
    $student = $this->studentModel->getStudentById($id);
    if (!$student) {
      $_SESSION['error'] = 'دانشجو یافت نشد.';
      redirect('/panel/students');
    }

    try {
      if ($this->studentModel->deleteStudent($id)) {
        $_SESSION['success'] = 'کاربر ' .  htmlspecialchars($student['full_name']) . ' با موفقیت حذف شد.';
      } else {
        $_SESSION['error'] = 'خطا در حذف دانشجو.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس : ' . $e->getMessage();
    }

    redirect('/panel/students');
  }
}
