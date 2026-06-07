<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\Neas;

class HomeController
{
  // Display homepage view
  public function index()
  {
    $articleModel = new Article();
    $homeArticles = $articleModel->getPublishedArticles(3);

    $courseModel = new Course();
    $homeCourses = $courseModel->getPublishedCourses(3);
    $lastCourse = $courseModel->getLastCourse();

    $neasModel = new Neas();
    $latestNews = $neasModel->getLatestItemsByCategory('news', 3);
    $latestEvents = $neasModel->getLatestItemsByCategory('event', 3);
    $latestAnnouncements = $neasModel->getLatestItemsByCategory('announcement', 3);

    require_once '../app/Views/home/index.php';
  }
}
