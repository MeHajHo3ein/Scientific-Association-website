<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Course;

class HomeController
{
  // Display homepage view
  public function index()
  {
    $articleModel = new Article();
    $homeArticles = $articleModel->getPublishedArticles(3);

    $courseModel = new Course();
    $homeCourses = $courseModel->getPublishedCourses(3);

    require_once '../app/Views/home/index.php';
  }
}
