<?php

namespace App\Core;

class Validator
{
  // public function validateMobile($mobile)
  // {
  //   $mobile = preg_replace('/\s+/', '', $mobile);
  //   $mobile = preg_replace('/[^0-9]/', '', $mobile);

  //   $pattern = '/^09[0-9]{9}$/';

  //   if (preg_match($pattern, $mobile)) {
  //     return $mobile;
  //   }
  //   return false;
  // }

  // public function validateEmail($email)
  // {
  //   $pattern = '/^[a-zA-Z0-9._%+-]+@gmail\.com$/';

  //   if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match($pattern, $email)) {
  //     return $email;
  //   }
  //   return false;
  // }

  // public function validatePassword($password)
  // {
  //   return strlen($password) >= 8;
  // }

  // Validate 14-digit student number format
  public function validateStudentNumber($student_number)
  {
    return preg_match('/^[0-9]{14}$/', $student_number);
  }
}
