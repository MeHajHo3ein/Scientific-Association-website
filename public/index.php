<?php

require_once '../Autoloader.php';
require_once '../app/Includes/functions.php';

// Start session if NOT already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\PagesController;
use App\Controllers\ProfileController;
use App\Controllers\StudentManagementController;
use App\Core\Router;

$router = new Router();

// Public routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/courses', [PagesController::class, 'courses']);
$router->get('/offline-courses', [PagesController::class, 'offline_courses']);
$router->get('/articles', [PagesController::class, 'articles']);
$router->get('/news', [PagesController::class, 'news']);
$router->get('/certificates', [PagesController::class, 'certificates']);
$router->get('/cult', [PagesController::class, 'cult']);
$router->get('/contactus', [PagesController::class, 'contact_us']);
$router->get('/aboutus', [PagesController::class, 'about_us']);

// Authentication routes - Registration
$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->get('/register', function () {
  redirect('/auth/register');
});

// Authentication routes - Login
$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/login', function () {
  redirect('/auth/login');
});

// Panel
$router->get('/panel', [DashboardController::class, 'index']);

// Panel - Courses (*** All Roles ***)
$router->get('/panel/courses', [DashboardController::class, 'courses']);

// Panel - Notifications (*** All Roles ***)
$router->get('/panel/notifications', [DashboardController::class, 'notifications']);

// Panel - Articles (*** Teacher & Admin ***)
$router->get('/panel/articles', [DashboardController::class, 'articles']);

// Panel - Offline Courses (*** Teacher & Admin ***)
$router->get('/panel/offline-courses', [DashboardController::class, 'offlineCourses']);

// Panel - Create Course (*** Teacher & Admin ***)
$router->get('/panel/courses/create', [DashboardController::class, 'showCreateCourse']);

// Panel - Create Article (*** Teacher & Admin ***)
$router->get('/panel/articles/create', [DashboardController::class, 'showCreateArticle']);

// Panel - Admin (*** Admin ***)
$router->get('/panel/students', [StudentManagementController::class, 'index']);
$router->get('/panel/students/create', [StudentManagementController::class, 'showCreateForm']);
$router->post('/panel/students/store', [StudentManagementController::class, 'store']);
$router->get('/panel/students/edit/{id}', [StudentManagementController::class, 'showEditForm']);
$router->post('/panel/students/update/{id}', [StudentManagementController::class, 'update']);
$router->get('/panel/students/delete/{id}', [StudentManagementController::class, 'deleteStudent']);

$router->get('/panel/teachers', [DashboardController::class, 'teachers']);
$router->get('/panel/admins', [DashboardController::class, 'admins']);

$router->post('/panel/update-profile', [ProfileController::class, 'update']);

// Panel - Certificates (*** Student ***)
$router->get('/panel/certificates', [DashboardController::class, 'certificates']);

// Logout route
$router->get('/logout', [AuthController::class, 'logout']);

// Process the current request
$router->dispatch();
