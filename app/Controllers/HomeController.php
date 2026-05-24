<?php

namespace App\Controllers;

use App\Models\Article;

class HomeController
{
  // Display homepage view
  public function index()
  {
    $articleModel = new Article();
    $homeArticles = $articleModel->getPublishedArticles(3);
    require_once '../app/Views/home/index.php';
  }
}
