<?php

namespace App\Controllers;

use App\Models\Search;
use PDOException;

class SearchController
{
  private $searchModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->searchModel = new Search();
  }

  public function index()
  {
    require_once '../app/Views/pages/search-result.php';
  }

  public function search()
  {
    $query = trim($_GET['q'] ?? '');
    $type = $_GET['type'] ?? 'all';
    $category = $_GET['category'] ?? 'all';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    $results = [];
    $totalItems = 0;
    $totalPages = 0;

    if (empty($query)) {
      $results = $this->searchModel->getAllContent($type, $category, $perPage, $offset);
      $totalItems = $this->searchModel->countAllContent($type, $category);
      $totalPages = ceil($totalItems / $perPage);
    } else {
      $results = $this->searchModel->search($query, $type, $category, $perPage, $offset);
      $totalItems = $this->searchModel->countSearch($query, $type, $category);
      $totalPages = ceil($totalItems / $perPage);
    }

    require_once '../app/Views/pages/search-result.php';
  }

  public function liveSearch()
  {
    header('Content-Type: application/json');

    $query = trim($_GET['q'] ?? '');
    $type = $_GET['type'] ?? 'all';
    $category = $_GET['category'] ?? 'all';
    $limit = 10;

    if (empty($query)) {
      echo json_encode([]);
      return;
    }

    $results = $this->searchModel->search($query, $type, $category, $limit, 0);

    $formattedResults = [];
    foreach ($results as $item) {
      $formattedResults[] = [
        'id' => $item['id'],
        'title' => $item['title'],
        'slug' => $item['slug'] ?? $item['id'],
        'description' => $item['description'] ?? $item['content'] ?? '',
        'type' => $item['content_type'],
        'level' => $item['level'] ?? null,
        'author_name' => $item['author_name'] ?? null,
        'file_type' => $item['file_type'] ?? null,
        'file_link' => $item['file_link'] ?? null,
        'url' => $this->getUrlByType($item['content_type'], $item['slug'] ?? $item['id']),
        'badge_class' => $this->getBadgeClassByType($item['content_type'])
      ];
    }

    echo json_encode($formattedResults);
  }

  private function getUrlByType($type, $slug)
  {
    switch ($type) {
      case 'course':
        return '/courses/' . urlencode($slug);
      case 'article':
        return '/articles/' . urlencode($slug);
      case 'resource':
        return '/offline-courses';
      default:
        return '#';
    }
  }

  private function getBadgeClassByType($type)
  {
    switch ($type) {
      case 'course':
        return 'bg-primary';
      case 'article':
        return 'bg-danger';
      case 'resource':
        return 'bg-warning';
      default:
        return 'bg-secondary';
    }
  }
}
