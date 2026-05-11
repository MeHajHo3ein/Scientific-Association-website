<?php

namespace App\Controllers;

use App\Models\User;
use PDOException;

class ProfileController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new User();
  }

  // Proccess profile update
  public function update()
  {
    $this->checkAuth();

    $full_name = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $password = $_POST['password'] ?? '';
    $userId = $_SESSION['user_id'];

    // Check if teacher has already updated
    if ($_SESSION['role'] === 'teacher') {
      if ($this->userModel->hasUpdatedProfile($userId)) {
        $_SESSION['warning'] = 'شما قبلاً اطلاعات خود را ویرایش کرده‌اید و تنها <strong>یک بار</strong> می‌توانید تغییر دهید.';
        redirect('/panel');
      }
    }

    $errors = [];

    // Validate full name
    if (empty($full_name)) {
      $errors[] = 'نام و نام خانوادگی الزامی است.';
    } elseif (strlen($full_name) < 3) {
      $errors[] = 'نام و نام خانوادگی باید حداقل ۳ کاراکتر باشد.';
    }

    // Validate email
    if (empty($email)) {
      $errors[] = 'ایمیل الزامی است.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
      $errors[] = 'ایمیل معتبر نیست. باید از سرویس gmail.com استفاده کنید.';
    }

    // Validate mobile
    if (empty($mobile)) {
      $errors[] = 'شماره تلفن الزامی است.';
    } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
      $errors[] = 'شماره تلفن معتبر نیست. (مثال: 09xxxxxxxxx)';
    }

    // Validate password
    if (!empty($password) && strlen($password) < 8) {
      $errors[] = 'رمز عبور باید حداقل 8 کاراکتر باشد.';
    }

    if (!empty($errors)) {
      $_SESSION['error'] = implode('<br>', $errors);
      redirect('/panel');
    }

    try {
      $currentUser = $this->userModel->findById($userId);

      if (!$currentUser) {
        $_SESSION['error'] = 'کاربر یافت نشد';
        redirect('/panel');
      }

      // Track which fields changed
      $changedFields = [];
      $profileChanged = false;
      $passwordChanged = false;

      // Check each field individually
      if ($currentUser['full_name'] !== $full_name) {
        $changedFields[] = [
          'name' => 'نام و نام خانوادگی',
          'old' => $currentUser['full_name'],
          'new' => $full_name
        ];
        $profileChanged = true;
      }

      if ($currentUser['email'] !== $email) {
        $changedFields[] = [
          'name' => 'ایمیل',
          'old' => $currentUser['email'],
          'new' => $email
        ];
        $profileChanged = true;
      }

      if ($currentUser['mobile'] !== $mobile) {
        $changedFields[] = [
          'name' => 'شماره تلفن',
          'old' => $currentUser['mobile'],
          'new' => $mobile
        ];
        $profileChanged = true;
      }

      // Check password change
      if (!empty($password)) {
        $passwordChanged = true;
      }

      // If nothing changed
      if (!$profileChanged && !$passwordChanged) {
        $_SESSION['info'] = 'هیچ تغییری در اطلاعات شما ایجاد نشده است.';
        redirect('/panel');
      }

      // Check email unique (only if changed)
      if ($currentUser['email'] !== $email) {
        if ($this->userModel->isEmailExist($email, $userId)) {
          $_SESSION['error'] = 'این ایمیل قبلاً توسط کاربر دیگری ثبت شده است.';
          redirect('/panel');
        }
      }

      // Check mobile unique (only if changed)
      if ($currentUser['mobile'] !== $mobile) {
        if ($this->userModel->isMobileExist($mobile, $userId)) {
          $_SESSION['error'] = 'این شماره تلفن قبلاً توسط کاربر دیگری ثبت شده است.';
          redirect('/panel');
        }
      }

      // Update profile if changed
      $profileUpdated = true;
      $passwordUpdated = true;

      if ($profileChanged) {
        $profileData = [
          'full_name' => $full_name,
          'email' => $email,
          'mobile' => $mobile,
        ];
        $profileUpdated = $this->userModel->updateProfile($userId, $profileData);
      }

      // Update password if provided
      if ($passwordChanged) {
        $passwordUpdated = $this->userModel->updatePassword($userId, $password);
      }

      if ($profileUpdated && $passwordUpdated) {
        // Mark profile as updated
        $this->userModel->markProfileAsUpdated($userId);

        // Update session with new data
        $_SESSION['full_name'] = $full_name;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;
        $_SESSION['profile_updated'] = 1;

        // Build success message with details
        $messages = [];

        // Add messages for each changed field
        foreach ($changedFields as $field) {
          $messages[] = "{$field['name']} به <strong>{$field['new']}</strong> تغییر کرد.";
        }

        // Add password change message
        if ($passwordChanged) {
          $messages[] = "رمز عبور با موفقیت تغییر کرد.";
        }

        $_SESSION['success'] = implode('<br>', $messages);
      } else {
        $_SESSION['error'] = 'خطا در به‌روزرسانی اطلاعات. لطفاً مجدداً تلاش کنید.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس : ' . $e->getMessage();
    }

    redirect('/panel');
  }

  private function checkAuth()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/auth/login');
    }
  }
}
