<?php

namespace App\Controllers;

class DashboardController
{
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

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

  // Student Pages
  public function studentCourses()
  {
    require_once '../app/Views/dashboard/student/courses.php';
  }

  public function studentCertificates()
  {
    require_once '../app/Views/dashboard/student/certificates.php';
  }

  public function studentNotifications()
  {
    require_once '../app/Views/dashboard/student/notifications.php';
  }

  public function showCreateCourse()
  {
    require_once '../app/Views/dashboard/create-course.php';
  }
}
