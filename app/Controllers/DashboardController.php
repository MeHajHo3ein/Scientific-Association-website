<?php

namespace App\Controllers;

class DashboardController
{
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }
    require_once '../app/Views/dashboard/index.php';
  }

  public function showCreateCourse()
  {
    require_once '../app/Views/dashboard/create-course.php';
  }
}
