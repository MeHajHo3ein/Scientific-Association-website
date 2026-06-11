<?php

namespace App\Controllers;

use App\Models\Setting;
use PDOException;

class SettingController
{
  private $settingModel;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
      show403();
    }

    $this->settingModel = new Setting();
  }

  // Display settings page
  public function index()
  {
    $settings = $this->settingModel->getAll();
    $socialMedias = $this->settingModel->getAllSocialMedias();
    require_once '../app/Views/dashboard/owner/settings.php';
  }

  // Update site name
  public function updateSiteName()
  {
    $siteName = trim($_POST['site_name'] ?? '');

    if (empty($siteName)) {
      $_SESSION['error'] = "مشکلی در تغییر تنظیمات بخش <strong>نام سایت</strong> بوجود آمده.";
      redirect('/panel/settings');
    }

    try {
      $this->settingModel->set('site_name', $siteName);
      $_SESSION['success'] = "تنظیمات بخش <strong>نام سایت</strong> تغییر کرد.";
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/settings');
  }

  // Update logo
  public function updateLogo()
  {
    if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/settings/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $ext = pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
      $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

      if (!in_array(strtolower($ext), $allowedExt)) {
        $_SESSION['error'] = 'فرمت فایل مجاز نیست. فرمت‌های مجاز: jpg, png, webp, svg';
        redirect('/panel/settings');
      }

      $filename = 'logo_' . time() . '.' . $ext;
      $filepath = $uploadDir . $filename;
      move_uploaded_file($_FILES['site_logo']['tmp_name'], $filepath);

      $logoPath = '/uploads/settings/' . $filename;
      $this->settingModel->set('site_logo', $logoPath);
      $_SESSION['success'] = "تنظیمات بخش <strong>لوگو</strong> تغییر کرد.";
    } else {
      $_SESSION['error'] = 'لطفاً یک فایل انتخاب کنید.';
    }

    redirect('/panel/settings');
  }

  // Update contact information
  public function updateContact()
  {
    $phone = trim($_POST['contact_phone'] ?? '');
    $email = trim($_POST['contact_email'] ?? '');
    $address = trim($_POST['contact_address'] ?? '');
    $hours = trim($_POST['contact_hours'] ?? '');

    try {
      if (!empty($phone)) $this->settingModel->set('contact_phone', $phone);
      if (!empty($email)) $this->settingModel->set('contact_email', $email);
      if (!empty($address)) $this->settingModel->set('contact_address', $address);
      if (!empty($hours)) $this->settingModel->set('contact_hours', $hours);

      $_SESSION['success'] = "تنظیمات بخش <strong>اطلاعات تماس</strong> تغییر کرد.";
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/settings');
  }

  // Add social media
  public function addSocialMedia()
  {
    $name = trim($_POST['social_name'] ?? '');
    $link = trim($_POST['social_link'] ?? '');

    if (empty($name) || empty($link)) {
      $_SESSION['error'] = 'نام و لینک شبکه اجتماعی الزامی است.';
      redirect('/panel/settings');
    }

    try {
      $this->settingModel->addSocialMedia($name, $link);
      $_SESSION['success'] = "شبکه اجتماعی <strong>{$name}</strong> با موفقیت اضافه شد.";
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/settings');
  }

  // Update social media
  public function updateSocialMedias()
  {
    $socialData = [];

    for ($i = 1; $i <= 3; $i++) {
      $name = trim($_POST["social_name_$i"] ?? '');
      $link = trim($_POST["social_link_$i"] ?? '');
      $id = trim($_POST["social_id_$i"] ?? '');

      if (!empty($name) && !empty($link)) {
        if (!empty($id)) {
          $this->settingModel->updateSocialMedia($id, $name, $link);
        } else {
          $this->settingModel->addSocialMedia($name, $link);
        }
      } elseif (!empty($id) && empty($name) && empty($link)) {
        $this->settingModel->deleteSocialMedia($id);
      }
    }

    $_SESSION['success'] = "تنظیمات بخش <strong>شبکه‌های اجتماعی</strong> تغییر کرد.";
    redirect('/panel/settings');
  }

  // Delete social media
  public function deleteSocialMedia($id)
  {
    $social = $this->settingModel->getSocialMediaById($id);
    if (!$social) {
      $_SESSION['error'] = 'شبکه اجتماعی یافت نشد.';
      redirect('/panel/settings');
    }

    try {
      $this->settingModel->deleteSocialMedia($id);
      $_SESSION['success'] = "شبکه اجتماعی <strong>{$social['name']}</strong> با موفقیت حذف شد.";
    } catch (PDOException $e) {
      $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
    }

    redirect('/panel/settings');
  }
}
