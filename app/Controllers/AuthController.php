<?php

namespace App\Controllers;

require_once '../app/Includes/functions.php';

use App\Models\Database;
use App\Models\User;
use PDO;
use PDOException;

class AuthController
{
  private $userModel;

  public function __construct()
  {
    // Ensure session is active
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->userModel = new User();
  }

  // Display registration form
  public function showRegister()
  {
    $this->checkAuth();
    require_once '../app/Views/auth/register.php';
  }

  // Display login form
  public function showLogin()
  {
    $this->checkAuth();
    require_once '../app/Views/auth/login.php';
  }

  // Process registration form submission
  public function register()
  {
    if ($this->isPost()) {
      $full_name = trim($_POST['fullName'] ?? '');
      $mobile = trim($_POST['mobile'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';

      $errors = [];

      if (empty($full_name) || strlen($full_name) < 3) {
        $errors['fullName'] = 'نام باید حداقل ۳ کاراکتر باشد.';
      }

      if (empty($email)) {
        $errors['email'] = 'ایمیل را وارد کنید.';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        $errors['email'] = 'لطفاً یک ایمیل معتبر وارد کنید.';
      }

      if (empty($mobile)) {
        $errors['mobile'] = 'شماره موبایل را وارد کنید.';
      } elseif (!preg_match('/^09[0-9]{9}$/', $mobile)) {
        $errors['mobile'] = 'لطفاً یک شماره تلفن معتبر وارد کنید.';
      }

      if (empty($password)) {
        $errors['password'] = 'رمز عبور را وارد کنید.';
      } elseif (strlen($password) < 8) {
        $errors['password'] = 'رمز عبور باید حداقل ۸ کاراکتر باشد.';
      }

      if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_data'] = [
          'full_name' => $full_name,
          'mobile' => $mobile,
          'email' => $email
        ];
        $this->sendRegisterPage();
        return;
      }

      try {
        $database = new Database();
        $db = $database->getConnection();

        // Check if user already exists with same mobile or email
        $check_query = "SELECT id FROM users WHERE mobile = :mobile OR email = :email";
        $stmt = $db->prepare($check_query);
        $stmt->execute([
          ':mobile' => $mobile,
          ':email' => $email
        ]);

        if ($stmt->rowCount() > 0) {
          $_SESSION['register_errors']['general'] = "کاربری با این شماره تلفن یا ایمیل قبلاً ثبت‌نام کرده است.";
          $_SESSION['register_data'] = [
            'full_name' => $full_name,
            'mobile' => $mobile,
            'email' => $email
          ];
          $this->sendRegisterPage();
          return;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
          'full_name' => $full_name,
          'mobile' => $mobile,
          'email' => $email,
          'password' => $hashed_password,
          'role' => 'student'
        ];

        // Create new user record
        if ($this->userModel->create($data)) {
          // Fetch newly created user data
          $database = new Database();
          $db = $database->getConnection();
          $check_query = "SELECT * FROM users WHERE mobile = :mobile OR email = :email";
          $stmt = $db->prepare($check_query);
          $stmt->execute([
            ':mobile' => $mobile,
            ':email' => $email
          ]);
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set session variables for Logged-in user
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['full_name'] = $user['full_name'];
          $_SESSION['mobile'] = $user['mobile'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['just_registered'] = true;
          $_SESSION['registered_name'] = $full_name;
          redirect('/');
        } else {
          $_SESSION['register_errors']['general'] = 'خطا در ثبت‌نام. لطفاً مجدداً تلاش کنید.';
          $this->sendRegisterPage();
        }
      } catch (PDOException $e) {
        $_SESSION['register_errors']['general'] = 'خطای دیتابیس: ' . $e->getMessage();
        $this->sendRegisterPage();
      }
    }
  }

  // Process login form submission
  public function login()
  {
    if ($this->isPost()) {
      $username = trim($_POST['username'] ?? '');
      $password = $_POST['password'] ?? '';

      $errors = [];

      if (empty($username)) {
        $errors['username'] = 'لطفاً ایمیل یا شماره تلفن خود را وارد کنید.';
      } else {
        $input_type = detectedInputType($username);
        if (!$input_type) {
          $errors['username'] = 'لطفاً یک ایمیل یا شماره تلفن معتبر وارد کنید.';
        }
      }

      if (empty($password)) {
        $errors['password'] = 'رمز عبور را وارد کنید.';
      }

      if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_data'] = ['username' => $username];
        $this->sendLoginPage();
        return;
      }

      $input_type = detectedInputType($username);

      if ($input_type) {
        try {
          $database = new Database();
          $db = $database->getConnection();

          $query = "SELECT * FROM users WHERE ";
          if ($input_type == 'mobile') {
            $query .= " mobile = :username";
          } else {
            $query .= " email = :username";
          }

          $stmt = $db->prepare($query);
          $stmt->execute([
            ':username' => $username
          ]);

          if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
              // Set session variables for authenticated user
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['full_name'] = $user['full_name'];
              $_SESSION['mobile'] = $user['mobile'];
              $_SESSION['email'] = $user['email'];
              $_SESSION['role'] = $user['role'];
              $_SESSION['show_welcome'] = true;
              redirect('/');
              return;
            } else {
              $_SESSION['login_errors']['password'] = 'رمز عبور اشتباه است.';
              $_SESSION['login_data'] = ['username' => $username];
              $this->sendLoginPage();
            }
          } else {
            $_SESSION['login_errors']['username'] = 'کاربری با این مشخصات پیدا نشد.';
            $_SESSION['login_data'] = ['username' => $username];
            $this->sendLoginPage();
          }
        } catch (PDOException $e) {
          $_SESSION['login_errors']['username'] = 'خطای دیتابیس: ' . $e->getMessage();
          $this->sendLoginPage();
        }
      }
    }
  }

  // Check if current request method is POST
  private function isPost()
  {
    return $_SERVER['REQUEST_METHOD'] === "POST";
  }

  // Redirect authenticated users to homepage
  private function checkAuth()
  {
    if (isset($_SESSION['user_id'])) {
      redirect('/');
    }
  }

  // Redirect to register page
  private function sendRegisterPage()
  {
    redirect('/auth/register');
    return;
  }

  // Redirect to login page
  private function sendLoginPage()
  {
    redirect('/auth/login');
    return;
  }

  // Destroy session and Log user out
  public function logout()
  {
    session_destroy();
    redirect('/auth/login');
  }
}
