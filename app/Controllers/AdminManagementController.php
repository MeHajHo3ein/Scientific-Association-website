<?php

namespace App\Controllers;

use App\Models\AdminManagement;
use PDOException;

class AdminManagementController
{
  private $adminModel;

  public function __construct()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
      show403();
    }

    $this->adminModel = new AdminManagement();
  }

  // Show admins list
  public function index()
  {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $admins = $this->adminModel->getAllAdminsPaginated($perPage, $offset);
    $totalAdmins = $this->adminModel->getTotalAdminsCount();
    $totalPages = ceil($totalAdmins / $perPage);

    require_once '../app/Views/dashboard/owner/admins.php';
  }

  // Show create form
  public function showCreateForm()
  {
    require_once '../app/Views/dashboard/owner/admin-create.php';
  }

  // Show edit form
  public function showEditForm($id)
  {
    $admin = $this->adminModel->getAdminById($id);
    if (!$admin) {
      $_SESSION['error'] = 'ادمین یافت نشد.';
      redirect('/panel/admins');
    }

    require_once '../app/Views/dashboard/owner/admin-edit.php';
  }

  // Store add admin
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
    } elseif ($this->adminModel->isEmailExist($email)) {
      $errors['email_duplicate'] = 'تکراری است.';
    }

    if (empty($mobile)) {
      $errors['mobile'] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors['mobile'] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    } elseif ($this->adminModel->isMobileExist($mobile)) {
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
      redirect('/panel/admins/create');
    }

    try {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $data = [
        ':full_name' => $full_name,
        ':mobile' => $mobile,
        ':email' => $email,
        ':password' => $hashed_password,
      ];

      if ($this->adminModel->createAdmin($data)) {
        $_SESSION['success'] = 'کاربر ' . htmlspecialchars($full_name) . ' با موفقیت اضافه شد.';
      } else {
        $_SESSION['error'] = 'خطا در افزودن ادمین.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/admins');
  }

  // Edit teacher
  public function update($id)
  {
    $admin = $this->adminModel->getAdminById($id);
    if (!$admin) {
      $_SESSION['error'] = 'ادمین یافت نشد.';
      redirect('/panel/admins');
    }

    $full_name = trim($_POST['full_name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $new_role = $_POST['role'] ?? '';

    $errors = [];

    if (empty($full_name) || strlen($full_name) < 3) {
      $errors['full_name'] = 'نام و نام خانوادگی باید حداقل ۳ کاراکتر باشد.';
    }

    if (empty($email)) {
      $errors['email'] = 'ایمیل الزامی است.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
      $errors['email'] = 'ایمیل معتبر نیست. باید از سرویس gmail.com استفاده کنید.';
    } elseif ($this->adminModel->isEmailExist($email, $id)) {
      $errors['email_duplicate'] = 'تکراری است.';
    }

    if (empty($mobile)) {
      $errors['mobile'] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors['mobile'] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    } elseif ($this->adminModel->isMobileExist($mobile, $id)) {
      $errors['mobile_duplicate'] = 'تکراری است.';
    }

    if (!empty($password) && strlen($password) < 8) {
      $errors['password'] = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
    }

    $allowed_roles = ['teacher', 'student'];
    if (!empty($new_role) && !in_array($new_role, $allowed_roles)) {
      $errors['role'] = 'نقش انتخابی نامعتبر است.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect("/panel/admins/edit/{$id}");
    }

    try {
      $data = [
        ':full_name' => $full_name,
        ':mobile' => $mobile,
        ':email' => $email,
      ];

      $profileUpdated = $this->adminModel->editAdmin($id, $data);
      $passwordUpdated = true;
      $roleUpdated = true;

      if (!empty($password)) {
        $passwordUpdated = $this->adminModel->editPassword($id, $password);
      }

      $roleChanged = false;
      if (!empty($new_role) && $new_role !== 'admin') {
        $roleUpdated = $this->adminModel->updateRole($id, $new_role);
        $roleChanged = true;
      }

      if ($profileUpdated && $passwordUpdated && $roleUpdated) {
        $_SESSION['success'] = 'اطلاعات کاربر ' . htmlspecialchars($full_name) . ' با موفقیت تغییر کرد.';

        if ($roleChanged) {
          $roleNames = [
            'teacher' => 'استاد',
            'student' => 'دانشجو'
          ];
          $_SESSION['success'] = "سطح دسترسی کاربر به <strong>{$roleNames[$new_role]}</strong> تغییر کرد.";
        }
      } else {
        $_SESSION['error'] = 'خطا در ویرایش اطلاعات.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/admins');
  }

  // Delete admin
  public function deleteAdmin($id)
  {
    $admin = $this->adminModel->getAdminById($id);
    if (!$admin) {
      $_SESSION['error'] = 'ادمین یافت نشد.';
      redirect('/panel/admins');
    }

    try {
      if ($this->adminModel->deleteAdmin($id)) {
        $_SESSION['success'] = 'کاربر ' .  htmlspecialchars($admin['full_name']) . ' با موفقیت حذف شد.';
      } else {
        $_SESSION['error'] = 'خطا در حذف ادمین.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس : ' . $e->getMessage();
    }

    redirect('/panel/admins');
  }

  // Get admins list for AJAX pagination
  public function getAdminsList()
  {
    header('Content-Type: application/json');

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $admins = $this->adminModel->getAllAdminsPaginated($perPage, $offset);
    $totalAdmins = $this->adminModel->getTotalAdminsCount();
    $totalPages = ceil($totalAdmins / $perPage);

    // Format data for JSON response
    $formattedAdmins = [];
    foreach ($admins as $admin) {
      $formattedAdmins[] = [
        'id' => $admin['id'],
        'full_name' => $admin['full_name'],
        'mobile' => $admin['mobile'],
        'email' => $admin['email']
      ];
    }

    echo json_encode([
      'success' => true,
      'items' => $formattedAdmins,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalItems' => $totalAdmins
    ]);
  }
}
