<?php

namespace App\Controllers;

use App\Models\User;

class DashboardController
{
  private $userModel;
  public function __construct()
  {
    $this->userModel = new User();
  }

  public function index()
  {
    $this->checkAuth();

    $user = $this->userModel->findById($_SESSION['user_id']);
    if (!$user) {
      session_destroy();
      redirect('/auth/login');
    }

    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['role'] = $user['role'];

    $role = $_SESSION['role'] ?? 'student';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/dashboard.php';
        break;
      case 'teacher':
        require_once '../app/Views/dashboard/teacher/dashboard.php';
        break;
      default:
        require_once '../app/Views/dashboard/student/dashboard.php';
        break;
    }
  }

  // Courses
  public function courses()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'student';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/courses.php';
        break;
      case 'teacher':
        require_once '../app/Views/dashboard/teacher/courses.php';
        break;
      default:
        require_once '../app/Views/dashboard/student/courses.php';
        break;
    }
  }

  // Notifications
  public function notifications()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'student';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/notifications.php';
        break;
      case 'teacher':
        require_once '../app/Views/dashboard/teacher/notifications.php';
        break;
      default:
        require_once '../app/Views/dashboard/student/notifications.php';
        break;
    }
  }

  // Student-only pages
  public function certificates()
  {
    $this->checkAuth();
    require_once '../app/Views/dashboard/student/certificates.php';
  }

  // Teacher-only pages
  public function articles()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'teacher';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/articles.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/articles.php';
        break;
    }
  }

  public function offlineCourses()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'teacher';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/offline-courses.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/offline-courses.php';
        break;
    }
  }

  public function showCreateCourse()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'teacher';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/create-course.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/create-course.php';
        break;
    }
  }

  public function showCreateArticle()
  {
    $this->checkAuth();
    $role = $_SESSION['role'] ?? 'teacher';

    switch ($role) {
      case 'admin':
        require_once '../app/Views/dashboard/admin/create-article.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/create-article.php';
        break;
    }
  }

  // Admin-only pages
  public function students()
  {
    $this->checkAuth();
    require_once '../app/Views/dashboard/admin/students.php';
  }

  public function teachers()
  {
    $this->checkAuth();
    require_once '../app/Views/dashboard/admin/teachers.php';
  }

  public function admins()
  {
    $this->checkAuth();
    require_once '../app/Views/dashboard/admin/admins.php';
  }

  private function checkAuth()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }
  }
}
