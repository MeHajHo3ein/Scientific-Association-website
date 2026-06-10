<?php

namespace App\Controllers;

use App\Models\Analytics;
use PDOException;

class AnalyticsController
{
  private $analyticsModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'owner' && $_SESSION['role'] !== 'admin')) {
      show403();
    }

    $this->analyticsModel = new Analytics();
  }

  // Display analytics page
  public function index()
  {
    $userStats = $this->analyticsModel->getUserStats();
    $contentStats = $this->analyticsModel->getContentStats();

    require_once '../app/Views/dashboard/owner/analytics.php';
  }

  // Get stats (for API)
  public function getStats()
  {
    header('Content-Type: application/json');

    $userStats = $this->analyticsModel->getUserStats();
    $contentStats = $this->analyticsModel->getContentStats();

    echo json_encode([
      'users' => $userStats,
      'contents' => $contentStats
    ]);
  }
}
