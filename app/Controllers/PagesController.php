<?php

namespace App\Controllers;

class PagesController
{
  public function courses()
  {
    require_once '../app/Views/pages/courses.php';
  }

  public function offline_courses()
  {
    require_once '../app/Views/pages/offline-courses.php';
  }

  public function articles()
  {
    require_once '../app/Views/pages/articles.php';
  }

  public function news()
  {
    require_once '../app/Views/pages/news.php';
  }
}
