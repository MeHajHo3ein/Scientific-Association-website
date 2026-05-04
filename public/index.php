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

// Student Panel
$router->get('/panel/courses', [DashboardController::class, 'studentCourses']);
$router->get('/panel/certificates', [DashboardController::class, 'studentCertificates']);
$router->get('/panel/notifications', [DashboardController::class, 'studentNotifications']);

// Logout route
$router->get('/logout', [AuthController::class, 'logout']);

// Process the current request
$router->dispatch();
