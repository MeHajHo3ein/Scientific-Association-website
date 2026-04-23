<?php

namespace App\Controllers;

class HomeController
{
  // Display homepage view
  public function index()
  {
    require_once '../app/Views/home/index.php';
  }
}
