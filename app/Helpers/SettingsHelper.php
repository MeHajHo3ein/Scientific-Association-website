<?php

use App\Models\Setting;

if (!function_exists('setting')) {
  function setting($key, $default = null)
  {
    static $settings = null;

    if ($settings === null) {
      try {
        $settingModel = new Setting();
        $settings = $settingModel->getAll();
      } catch (Exception $e) {
        $settings = [];
      }
    }

    return $settings[$key] ?? $default;
  }
}
