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

  public function certificates()
  {
    require_once '../app/Views/pages/certificates.php';
  }

  public function cult()
  {
    require_once '../app/Views/pages/cult.php';
  }

  public function contact_us()
  {
    require_once '../app/Views/pages/contactus.php';
  }

  public function about_us()
  {
    require_once '../app/Views/pages/aboutus.php';
  }
}
