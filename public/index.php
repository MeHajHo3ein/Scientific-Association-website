<?php

require_once '../Autoloader.php';
require_once '../app/Includes/functions.php';

// Start session if NOT already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

use App\Controllers\AdminManagementController;
use App\Controllers\AnalyticsController;
use App\Controllers\ArticleController;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\NeasController;
use App\Controllers\NotificationController;
use App\Controllers\OfflineFileController;
use App\Controllers\PagesController;
use App\Controllers\ProfileController;
use App\Controllers\SearchController;
use App\Controllers\StudentManagementController;
use App\Controllers\TeacherManagementController;
use App\Controllers\TicketController;
use App\Core\Router;

$router = new Router();

// Public routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/courses', [PagesController::class, 'courses']);
$router->get('/offline-courses', [OfflineFileController::class, 'publicIndex']);
$router->get('/articles', [ArticleController::class, 'index']);
$router->get('/neas', [NeasController::class, 'index']);
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

// Panel - Notifications (*** All Roles ***)
$router->get('/panel/notifications', [NotificationController::class, 'index']);
$router->get('/panel/notifications/create', [NotificationController::class, 'showCreateForm']);
$router->post('/panel/notifications/store', [NotificationController::class, 'store']);
$router->get('/panel/notifications/delete/{id}', [NotificationController::class, 'delete']);
$router->get('/api/notifications/count', [NotificationController::class, 'getUnreadCount']);

// Panel - Articles (*** Admin & Teacher ***)
$router->get('/articles/{slug}', [ArticleController::class, 'show']);
$router->get('/articles', [ArticleController::class, 'index']);

// Panel - Articles Management (*** Admin & Teacher ***)
$router->get('/panel/articles', [ArticleController::class, 'adminIndex']);
$router->get('/panel/articles/create', [ArticleController::class, 'showCreateForm']);
$router->post('/panel/articles/store', [ArticleController::class, 'store']);
$router->get('/panel/articles/delete/{id}', [ArticleController::class, 'delete']);

// Panel - Courses (*** Admin & Teacher ***)
$router->get('/courses', [CourseController::class, 'index']);
$router->get('/courses/{slug}', [CourseController::class, 'show']);

// Panel - Courses Management (*** Admin & Teacher ***)
$router->get('/panel/courses', [CourseController::class, 'adminIndex']);
$router->get('/panel/courses/create', [CourseController::class, 'showCreateForm']);
$router->post('/panel/courses/store', [CourseController::class, 'store']);
$router->get('/panel/courses/delete/{id}', [CourseController::class, 'delete']);

// Panel - Offline Courses Management (*** Admin & Teacher ***)
$router->get('/panel/offline-courses', [OfflineFileController::class, 'index']);
$router->get('/panel/offline-courses/create', [OfflineFileController::class, 'showCreateForm']);
$router->post('/panel/offline-courses/store', [OfflineFileController::class, 'store']);
$router->get('/panel/offline-courses/delete/{id}', [OfflineFileController::class, 'delete']);

// Panel - Neas (*** Admin & Teacher ***)
$router->get('/panel/neas', [NeasController::class, 'adminIndex']);
$router->get('/panel/neas/create', [NeasController::class, 'showCreateForm']);
$router->post('/panel/neas/store', [NeasController::class, 'store']);
$router->get('/panel/neas/delete/{id}', [NeasController::class, 'delete']);

// Panel - Admin (*** Student ***)
$router->get('/panel/students', [StudentManagementController::class, 'index']);
$router->get('/panel/students/create', [StudentManagementController::class, 'showCreateForm']);
$router->post('/panel/students/store', [StudentManagementController::class, 'store']);
$router->get('/panel/students/edit/{id}', [StudentManagementController::class, 'showEditForm']);
$router->post('/panel/students/update/{id}', [StudentManagementController::class, 'update']);
$router->get('/panel/students/delete/{id}', [StudentManagementController::class, 'deleteStudent']);

// Panel - Admin (*** Teacher ***)
$router->get('/panel/teachers', [TeacherManagementController::class, 'index']);
$router->get('/panel/teachers/create', [TeacherManagementController::class, 'showCreateForm']);
$router->post('/panel/teachers/store', [TeacherManagementController::class, 'store']);
$router->get('/panel/teachers/edit/{id}', [TeacherManagementController::class, 'showEditForm']);
$router->post('/panel/teachers/update/{id}', [TeacherManagementController::class, 'update']);
$router->get('/panel/teachers/delete/{id}', [TeacherManagementController::class, 'deleteTeacher']);

// Panel - Admin (*** Admin ***)
$router->get('/panel/admins', [AdminManagementController::class, 'index']);
$router->get('/panel/admins/create', [AdminManagementController::class, 'showCreateForm']);
$router->post('/panel/admins/store', [AdminManagementController::class, 'store']);
$router->get('/panel/admins/edit/{id}', [AdminManagementController::class, 'showEditForm']);
$router->post('/panel/admins/update/{id}', [AdminManagementController::class, 'update']);
$router->get('/panel/admins/delete/{id}', [AdminManagementController::class, 'deleteAdmin']);

// Panel - Tickets
$router->get('/panel/tickets', [TicketController::class, 'index']);
$router->post('/panel/tickets/store', [TicketController::class, 'store']);
$router->get('/panel/tickets/mark-read-admin/{id}', [TicketController::class, 'markAsReadByAdmin']);
$router->get('/panel/tickets/delete/{id}', [TicketController::class, 'delete']);
$router->get('/api/tickets/count', [TicketController::class, 'getUnreadCount']);

// Panel - Analytics (Owner & Admin)
$router->get('/panel/analytics', [AnalyticsController::class, 'index']);
$router->get('/api/analytics/stats', [AnalyticsController::class, 'getStats']);

// Search routes
$router->get('/search', [SearchController::class, 'search']);
$router->get('/api/live-search', [SearchController::class, 'liveSearch']);

$router->post('/panel/update-profile', [ProfileController::class, 'update']);

// Panel - Certificates (*** Student ***)
$router->get('/panel/certificates', [DashboardController::class, 'certificates']);

// Logout route
$router->get('/logout', [AuthController::class, 'logout']);

// Process the current request
$router->dispatch();
