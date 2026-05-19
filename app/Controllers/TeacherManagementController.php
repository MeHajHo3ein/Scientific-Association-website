<?php

namespace App\Controllers;

use App\Models\TeacherManagement;

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
}
