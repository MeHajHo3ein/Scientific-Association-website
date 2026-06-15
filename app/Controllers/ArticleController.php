<?php

namespace App\Controllers;

use App\Models\Article;
use PDOException;

class ArticleController
{
  private $articleModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->articleModel = new Article();
  }

  // Show articles in homepage
  public function homeArticles()
  {
    return $this->articleModel->getPublishedArticles(3);
  }

  // Show articles in articles page
  public function index()
  {
    $articles = $this->articleModel->getPublishedArticles();
    require_once '../app/Views/pages/articles.php';
  }

  // Show articles detail
  public function show($slug)
  {
    $article = $this->articleModel->getArticleBySlug($slug);

    if (!$article) {
      http_response_code(404);
      require_once '../app/Views/errors/404.php';
      return;
    }

    $sections = $this->articleModel->getArticleSections($article['id']);

    require_once '../app/Views/pages/articles-detail.php';
  }

  // Show articles in admin panel
  public function adminIndex()
  {
    $this->checkAdminOrTeacherAuth();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;
    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $articles = $this->articleModel->getAllArticlesPaginated($userId, $role, $perPage, $offset);
    $totalCourses = $this->articleModel->getTotalArticlesCount($userId, $role);
    $totalPages = ceil($totalCourses / $perPage);

    switch ($role) {
      case 'owner':
        require_once '../app/Views/dashboard/owner/articles.php';
        break;
      case 'admin':
        require_once '../app/Views/dashboard/admin/articles.php';
        break;
      default:
        require_once '../app/Views/dashboard/teacher/articles.php';
        break;
    }
  }

  // Show create article form 
  public function showCreateForm()
  {
    $this->checkTeacherAuth();
    require_once '../app/Views/dashboard/teacher/create-article.php';
  }

  // Store new article
  public function store()
  {
    $this->checkTeacherAuth();

    $title = trim($_POST['title'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['description'] ?? '');

    // Sections
    $sections = [];
    if (isset($_POST['sections']) && is_array($_POST['sections'])) {
      foreach ($_POST['sections'] as $section) {
        if (!empty($section['title']) || !empty($section['description'])) {
          $sections[] = [
            'title' => $section['title'],
            'description' => $section['description']
          ];
        }
      }
    }

    $errors = [];

    if (empty($title)) {
      $errors['title'] = 'عنوان مقاله الزامی است.';
    }

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      $_SESSION['old_input'] = $_POST;
      redirect('/panel/articles/create');
    }

    try {
      $slug = $this->articleModel->createUniqueSlug($title);

      $data = [
        ':title' => $title,
        ':slug' => $slug,
        ':summary' => $summary,
        ':content' => $content,
        ':author_id' => $_SESSION['user_id']
      ];

      $articleId = $this->articleModel->create($data);

      if ($articleId) {
        $this->articleModel->saveSections($articleId, $sections);
        $_SESSION['success'] = "مقاله <strong>{$title}</strong> با موفقیت اضافه شد.";
      } else {
        $_SESSION['error'] = 'خطا در ذخیره مقاله.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/articles');
  }

  // Delete article
  public function delete($id)
  {
    $this->checkAdminOrTeacherAuth();

    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $article = $this->articleModel->getArticleById($id, $userId, $role);
    if (!$article) {
      $_SESSION['error'] = 'مقاله یافت نشد یا شما اجازه حذف آن را ندارید.';
      redirect('/panel/articles');
    }

    try {
      if ($this->articleModel->delete($id, $userId, $role)) {
        $_SESSION['success'] = "مقاله <strong>{$article['title']}</strong> با موفقیت حذف شد.";
      } else {
        $_SESSION['error'] = 'خطا در حذف مقاله.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/articles');
  }

  // Get articles list for AJAX pagination
  public function getArticlesList()
  {
    header('Content-Type: application/json');

    $this->checkAdminOrTeacherAuth();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 12;
    $offset = ($page - 1) * $perPage;

    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'] ?? 'teacher';

    $articles = $this->articleModel->getAllArticlesPaginated($userId, $role, $perPage, $offset);
    $totalArticles = $this->articleModel->getTotalArticlesCount($userId, $role);
    $totalPages = ceil($totalArticles / $perPage);

    // Format data for JSON response
    $formattedArticles = [];
    foreach ($articles as $article) {
      $formattedArticles[] = [
        'id' => $article['id'],
        'title' => $article['title'],
        'author_name' => $article['author_name'],
        'created_at_fa' => toJalali($article['created_at'], 'Y/m/d')
      ];
    }

    echo json_encode([
      'success' => true,
      'items' => $formattedArticles,
      'page' => $page,
      'totalPages' => $totalPages,
      'totalItems' => $totalArticles
    ]);
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
