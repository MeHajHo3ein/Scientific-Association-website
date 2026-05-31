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
    '/panel/articles',
    '/panel/articles/create',
    '/panel/offline-courses',
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
    '/panel/articles',
    '/panel/articles/create',
    '/panel/offline-courses',
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

  if (in_array($currentUri, $panelPages)) {
    return '/panel';
  }

  return '/';
}

function toPersianNumber($number)
{
  $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
  $number = max(1, ceil($number));
  return str_replace(range(0, 9), $persianDigits, (string)$number);
}

function toJalali($date, $format = 'Y/m/d')
{
  $timestamp = strtotime($date);

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

  $year = date('Y', $timestamp);
  $month = date('n', $timestamp);
  $day = date('j', $timestamp);

  $jalaliYear = $year - 621;
  $jalaliMonth = $month;
  $jalaliDay = $day;

  if ($jalaliMonth > 6) {
    $jalaliDay--;
  }

  $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

  $persianYear = str_replace(array_keys($persianDigits), array_values($persianDigits), (string)$jalaliYear);
  $persianMonth = str_replace(array_keys($persianDigits), array_values($persianDigits), str_pad($jalaliMonth, 2, '0', STR_PAD_LEFT));
  $persianDay = str_replace(array_keys($persianDigits), array_values($persianDigits), str_pad($jalaliDay, 2, '0', STR_PAD_LEFT));

  if ($format == 'Y/m/d') {
    return $persianYear . '/' . $persianMonth . '/' . $persianDay;
  } elseif ($format == 'd F Y') {
    $persianDayNum = str_replace(array_keys($persianDigits), array_values($persianDigits), (string)$jalaliDay);
    return $persianDayNum . ' ' . $jalaliMonths[$jalaliMonth - 1] . ' ' . $persianYear;
  }

  return $persianYear . '/' . $persianMonth . '/' . $persianDay;
}

// display 403 error
function show403()
{
  http_response_code(403);
  require_once '../app/Views/errors/403.php';
  exit;
}
