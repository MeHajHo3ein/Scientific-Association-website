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
    $this->checkAdminAuth();
    $articles = $this->articleModel->getAllArticles();
    require_once '../app/Views/dashboard/admin/articles.php';
  }

  // Show create article form 
  public function showCreateForm()
  {
    $this->checkAdminAuth();
    require_once '../app/Views/dashboard/admin/create-article.php';
  }

  // Store new article
  public function store()
  {
    $this->checkAdminAuth();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('/panel/articles');
    }

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
    $this->checkAdminAuth();

    $article = $this->articleModel->getArticleById($id);
    if (!$article) {
      $_SESSION['error'] = 'مقاله یافت نشد.';
      redirect('/panel/articles');
    }

    try {
      if ($this->articleModel->delete($id)) {
        $_SESSION['success'] = "مقاله <strong>{$article['title']}</strong> با موفقیت حذف شد.";
      } else {
        $_SESSION['error'] = 'خطا در حذف مقاله.';
      }
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/articles');
  }

  private function checkAdminAuth()
  {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
      redirect('/auth/login');
    }
  }
}
