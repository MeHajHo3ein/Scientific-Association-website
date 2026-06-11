<?php

namespace App\Models;

use PDO;

class Setting
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Get setting by key
  public function get($key)
  {
    $query = "SELECT value FROM settings WHERE `key` = :key";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':key' => $key]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['value'] : null;
  }

  // Get all settings
  public function getAll()
  {
    $query = "SELECT * FROM settings";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $settings = [];
    foreach ($results as $row) {
      $settings[$row['key']] = $row['value'];
    }
    return $settings;
  }

  // Set setting (update or insert)
  public function set($key, $value)
  {
    $query = "INSERT INTO settings (`key`, `value`) VALUES (:key, :value) 
              ON DUPLICATE KEY UPDATE `value` = :value";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':key' => $key,
      ':value' => $value
    ]);
  }

  // Update multiple settings
  public function updateMultiple($data)
  {
    $success = true;
    foreach ($data as $key => $value) {
      if (!$this->set($key, $value)) {
        $success = false;
      }
    }
    return $success;
  }

  // Get all social medias
  public function getAllSocialMedias()
  {
    $query = "SELECT * FROM settings_social_media ORDER BY id ASC";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Add social media
  public function addSocialMedia($name, $link)
  {
    $query = "INSERT INTO settings_social_media (name, link) 
              VALUES (:name, :link)";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':name' => $name,
      ':link' => $link
    ]);
  }

  // Update social media
  public function updateSocialMedia($id, $name, $link)
  {
    $query = "UPDATE settings_social_media SET name = :name, link = :link WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([
      ':name' => $name,
      ':link' => $link,
      ':id' => $id
    ]);
  }

  // Delete social media
  public function deleteSocialMedia($id)
  {
    $query = "DELETE FROM settings_social_media WHERE id = :id";
    $stmt = $this->db->prepare($query);
    return $stmt->execute([':id' => $id]);
  }

  // Get social media by id
  public function getSocialMediaById($id)
  {
    $query = "SELECT * FROM settings_social_media WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
