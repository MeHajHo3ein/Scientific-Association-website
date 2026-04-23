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
