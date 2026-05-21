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
  ];

  if (strpos($currentUri, '/panel/students/edit/') === 0) {
    return 'بازگشت به صفحه قبلی';
  }

  if (strpos($currentUri, '/panel/teachers/edit/') === 0) {
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
    '/panel/articles',
    '/panel/articles/create',
    '/panel/offline-courses',
    '/panel/students',
    '/panel/teachers',
    '/panel/admins',
  ];

  if ($currentUri === '/panel/students/create') {
    return '/panel/students';
  }

  if (strpos($currentUri, '/panel/students/edit/') === 0) {
    return '/panel/students';
  }

  if ($currentUri === '/panel/teachers/create') {
    return '/panel/teachers';
  }

  if (strpos($currentUri, '/panel/teachers/edit/') === 0) {
    return '/panel/teachers';
  }

  if (in_array($currentUri, $panelPages)) {
    return '/panel';
  }

  return '/';
}
