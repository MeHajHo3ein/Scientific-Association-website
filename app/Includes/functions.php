<?php

// Detect input string is mobile number or email address
function detectedInputType($input)
{
  $input = trim($input);

  // Check for Iranian mobile number format (09xxxxxxxx)
  if (preg_match('/^09[0-9]{9}$/', $input)) {
    return 'mobile';
  }

  // Check for valid Gmail address
  if (filter_var($input, FILTER_VALIDATE_EMAIL) && preg_match('/@gmail\.com$/', $input)) {
    return 'email';
  }

  return false;
}

// HTTP redirect
function redirect($url)
{
  header("Location: $url");
  exit;
}

function isActiveRoute($route)
{
  $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $currentUri = rtrim($currentUri, '/');
  if (empty($currentUri)) {
    $currentUri = '/';
  }
  return $currentUri === $route;
}

function getBackButtonText()
{
  $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $currentUri = rtrim($currentUri, '/');
  if (empty($currentUri)) {
    $currentUri = '/';
  }

  if ($currentUri === '/panel') {
    return 'برگشت به صفحه اصلی';
  }

  $panelPages = [
    '/panel/courses',
    '/panel/courses/create',
    '/panel/certificates',
    '/panel/notifications',
    '/panel/notifications/create',
    '/panel/neas',
    '/panel/neas/create',
    '/panel/articles',
    '/panel/articles/create',
    '/panel/offline-courses',
    '/panel/offline-courses/create',
    '/panel/analytics',
    '/panel/settings',
    '/panel/tickets',
    '/panel/students',
    '/panel/students/create',
    '/panel/students/edit',
    '/panel/teachers',
    '/panel/teachers/create',
    '/panel/teachers/edit',
    '/panel/admins',
    '/panel/admins/create',
    '/panel/admins/edit',
  ];

  if (strpos($currentUri, '/panel/students/edit/') === 0) {
    return 'بازگشت به صفحه قبلی';
  }

  if (strpos($currentUri, '/panel/teachers/edit/') === 0) {
    return 'بازگشت به صفحه قبلی';
  }

  if (strpos($currentUri, '/panel/admins/edit/') === 0) {
    return 'بازگشت به صفحه قبلی';
  }

  if (in_array($currentUri, $panelPages)) {
    return 'بازگشت به صفحه قبلی';
  }

  return 'برگشت به صفحه اصلی';
}

function getBackButtonUrl()
{
  $currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $currentUri = rtrim($currentUri, '/');
  if (empty($currentUri)) {
    $currentUri = '/';
  }

  $panelPages = [
    '/panel/courses',
    '/panel/courses/create',
    '/panel/certificates',
    '/panel/notifications',
    '/panel/notifications/create',
    '/panel/neas',
    '/panel/neas/create',
    '/panel/articles',
    '/panel/articles/create',
    '/panel/offline-courses',
    '/panel/offline-courses/create',
    '/panel/analytics',
    '/panel/settings',
    '/panel/tickets',
    '/panel/students',
    '/panel/teachers',
    '/panel/admins',
  ];

  // For Students
  if ($currentUri === '/panel/students/create') {
    return '/panel/students';
  }

  if (strpos($currentUri, '/panel/students/edit/') === 0) {
    return '/panel/students';
  }

  // For Teachers
  if ($currentUri === '/panel/teachers/create') {
    return '/panel/teachers';
  }

  if (strpos($currentUri, '/panel/teachers/edit/') === 0) {
    return '/panel/teachers';
  }

  // For Admins
  if ($currentUri === '/panel/admins/create') {
    return '/panel/admins';
  }

  if (strpos($currentUri, '/panel/admins/edit/') === 0) {
    return '/panel/admins';
  }

  // For Articles
  if ($currentUri === '/panel/articles/create') {
    return '/panel/articles';
  }

  // For Courses
  if ($currentUri === '/panel/courses/create') {
    return '/panel/courses';
  }

  // For Notifications
  if ($currentUri === '/panel/notifications/create') {
    return '/panel/notifications';
  }

  // For NEA
  if ($currentUri === '/panel/neas/create') {
    return '/panel/neas';
  }

  // For Offline Courses
  if ($currentUri === '/panel/offline-courses/create') {
    return '/panel/offline-courses';
  }

  if (in_array($currentUri, $panelPages)) {
    return '/panel';
  }

  return '/';
}

function toPersianNumber($number)
{
  $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
  $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
  $number = max(1, ceil($number));
  return str_replace($englishDigits, $persianDigits, (string)$number);
}

function toJalali($date, $format = 'Y/m/d')
{
  $timestamp = strtotime($date);
  if (!$timestamp) {
    return $date;
  }

  $gy = date('Y', $timestamp);
  $gm = date('m', $timestamp);
  $gd = date('d', $timestamp);

  $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
  $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
  $days = 355666 + (365 * $gy) + floor(($gy2 + 3) / 4) - floor(($gy2 + 99) / 100) + floor(($gy2 + 399) / 400) + $gd + $g_d_m[$gm - 1];
  $jy = -1595 + (33 * floor($days / 12053));
  $days %= 12053;
  $jy += 4 * floor($days / 1461);
  $days %= 1461;

  if ($days > 365) {
    $jy += floor(($days - 1) / 365);
    $days = ($days - 1) % 365;
  }

  if ($days < 186) {
    $jm = 1 + floor($days / 31);
    $jd = 1 + ($days % 31);
  } else {
    $jm = 7 + floor(($days - 186) / 30);
    $jd = 1 + (($days - 186) % 30);
  }

  $jy = (int)$jy;
  $jm = (int)$jm;
  $jd = (int)$jd;

  $jalaliMonths = [
    'فروردین',
    'اردیبهشت',
    'خرداد',
    'تیر',
    'مرداد',
    'شهریور',
    'مهر',
    'آبان',
    'آذر',
    'دی',
    'بهمن',
    'اسفند'
  ];

  $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
  $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

  $persianYear = str_replace($englishDigits, $persianDigits, (string)$jy);
  $persianMonth = str_replace($englishDigits, $persianDigits, str_pad($jm, 2, '0', STR_PAD_LEFT));
  $persianDay = str_replace($englishDigits, $persianDigits, str_pad($jd, 2, '0', STR_PAD_LEFT));

  if ($format == 'Y/m/d') {
    return $persianYear . '/' . $persianMonth . '/' . $persianDay;
  } elseif ($format == 'd F Y') {
    $persianDayNum = str_replace($englishDigits, $persianDigits, (string)$jd);
    $monthIndex = $jm - 1;
    return $persianDayNum . ' ' . $jalaliMonths[$monthIndex] . ' ' . $persianYear;
  }

  return $persianYear . '/' . $persianMonth . '/' . $persianDay;
}

// Highlight search keywords in text
function highlightText($text, $query, $highlightClass = 'bg-warning')
{
  if (empty($query) || empty($text)) {
    return htmlspecialchars($text);
  }

  $keywords = explode(' ', trim($query));
  $highlighted = htmlspecialchars($text);

  foreach ($keywords as $keyword) {
    if (strlen($keyword) < 2) continue;

    $pattern = '/' . preg_quote($keyword, '/') . '/iu';
    $replacement = '<span class="' . $highlightClass . ' fw-bold">$0</span>';
    $highlighted = preg_replace($pattern, $replacement, $highlighted);
  }

  return $highlighted;
}

// display 403 error
function show403()
{
  http_response_code(403);
  require_once '../app/Views/errors/403.php';
  exit;
}
