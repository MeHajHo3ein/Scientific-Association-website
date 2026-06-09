<?php

namespace App\Controllers;

use App\Models\Course;
use PDOException;

class CourseController
{
  private $courseModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->courseModel = new Course();
  }

  // Display courses in homepage
  public function homeCourses()
  {
    return $this->courseModel->getPublishedCourses(3);
  }

  // Display courses in courses page
  public function index()
  {
    $webdevCourses = $this->courseModel->getCoursesByCategory('webdev');
    $networkCourses = $this->courseModel->getCoursesByCategory('network');
    $aiCourses = $this->courseModel->getCoursesByCategory('ai');
    $programmingCourses = $this->courseModel->getCoursesByCategory('programming');

    require_once '../app/Views/pages/courses.php';
  }

  // Display course detail
  public function show($slug)
  {
    $course = $this->courseModel->getCourseBySlug($slug);

    if (!$course) {
      http_response_code(404);
      require_once '../app/Views/errors/404.php';
      return;
    }

    $prerequisites = $this->courseModel->getCoursePrerequisites($course['id']);
    $syllabus = $this->courseModel->getCourseSyllabus($course['id']);

    require_once '../app/Views/pages/courses-detail.php';
  }

  // Display courses in admin panel
  public function adminIndex()
  {
    if (!isset($_SESSION['user_id'])) {
      redirect('/');
    }

    $courses = $this->courseModel->getAllCourses();
    $role = $_SESSION['role'] ?? 'student';

    switch ($role) {
      case 'owner':
        require_once '../app/Views/dashboard/owner/courses.php';
        break;
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

  // Display create courses form
  public function showCreateForm()
  {
    $this->checkTeacherAuth();
    require_once '../app/Views/dashboard/teacher/create-course.php';
  }

  // Store new course
  public function store()
  {
    $this->checkTeacherAuth();

    $title = trim($_POST['title'] ?? '');
    $level = $_POST['level'] ?? 'beginner';
    $category = $_POST['category'] ?? 'webdev';
    $price = intval($_POST['price'] ?? 0);
    $duration = trim($_POST['duration'] ?? '');
    $student_count = intval($_POST['student_count'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    $prerequisites = [];
    if (isset($_POST['prerequisites']) && is_array($_POST['prerequisites'])) {
      foreach ($_POST['prerequisites'] as $prereq) {
        if (!empty($prereq)) {
          $prerequisites[] = $prereq;
        }
      }
    }

    $syllabus = [];
    if (isset($_POST['syllabus']) && is_array($_POST['syllabus'])) {
      foreach ($_POST['syllabus'] as $section) {
        if (!empty($section['title']) || !empty($section['description'])) {
          $syllabus[] = [
            'title' => $section['title'],
            'description' => $section['description'],
            'video_link' => $section['video_link'] ?? null
          ];
        }
      }
    }

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'نام دوره الزامی است.';
    }

    if (empty($level)) {
      $errors['level'] = 'سطح دوره الزامی است.';
    }

    if (empty($description)) {
      $errors['description'] = 'توضیحات دوره الزامی است.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect('/panel/courses/create');
    }

    try {
      $slug = $this->courseModel->createUniqueSlug($title);

      $image = null;
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/courses/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
      }

      $data = [
        ':title' => $title,
        ':slug' => $slug,
        ':category' => $category,
        ':level' => $level,
        ':price' => $price,
        ':duration' => $duration,
        ':student_count' => $student_count,
        ':image' => $image,
        ':description' => $description,
        ':created_by' => $_SESSION['user_id']
      ];

      $courseId = $this->courseModel->create($data);

      if ($courseId) {
        $this->courseModel->savePrerequisites($courseId, $prerequisites);
        $this->courseModel->saveSyllabus($courseId, $syllabus);
        $_SESSION['success'] = "دوره <strong>{$title}</strong> با موفقیت اضافه شد.";
      } else {
        $_SESSION['error'] = 'خطا در ذخیره دوره.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/courses');
  }

  // Delete course
  public function delete($id)
  {
    $this->checkAdminOrTeacherAuth();

    $course = $this->courseModel->getCourseById($id);
    if (!$course) {
      $_SESSION['error'] = 'دوره یافت نشد.';
      redirect('/panel/courses');
    }

    try {
      if ($this->courseModel->delete($id)) {
        $_SESSION['success'] = "دوره <strong>{$course['title']}</strong> با موفقیت حذف شد.";
      } else {
        $_SESSION['error'] = 'خطا در حذف دوره.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/courses');
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
