<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - مقالات';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$article = $article ?? [];
?>

<!--Main-->
<div class="hero-margin">
  <br />
  <br />
  <div class="container">
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p class="text-secondary p-3">
      <span>نویسنده:</span>
      <span><?= htmlspecialchars($article['author_name']) ?></span>
      --
      <span>زمان مطالعه:</span>
      <?php
      $readTimeRaw = strlen($article['content']) / 300;
      $readTime = max(1, ceil($readTimeRaw));
      ?>
      <span><?= toPersianNumber($readTime) ?> دقیقه</span>
      --
      <span><?= toJalali($article['created_at'], 'Y/m/d') ?></span>
    </p>

    <p class="bg-white border-5 border-primary border-start p-3 rounded-3">
      <?= htmlspecialchars($article['summary'] ?? mb_substr($article['content'], 0, 200)) ?>
    </p>
    <p>
      <?= nl2br(htmlspecialchars($article['content'])) ?>
    </p>

    <?php if (!empty($sections)): ?>
      <?php foreach ($sections as $section): ?>
        <h5 class="border-5 border-primary border-start p-3">
          <?= htmlspecialchars($section['title']) ?>
        </h5>
        <p class="p-3 text-justify">
          <?= nl2br(htmlspecialchars($section['description'])) ?>
        </p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>