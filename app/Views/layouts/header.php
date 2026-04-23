<?php
$pageTitle = $pageTitle ?? 'انجمن علمی کامپیوتر دانشگاه خوارزمی (شهرضا)';
?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://lib.arvancloud.ir/font-awesome/6.3.0/css/all.css" />
  <link rel="stylesheet" href="/assets/css/bootstrap.rtl.min.css" />
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="icon" href="/assets/img/ico.png" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
</head>

<body<?= isset($bodyClass) ? ' class="' . $bodyClass . '"' : '' ?>>