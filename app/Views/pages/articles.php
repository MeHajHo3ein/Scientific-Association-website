<?php
$pageTitle = 'انجمن علمی دانشگاه خوارزمی(شهرضا) - مقالات';
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>مقالات</h1>
    <p>مرجع تخصصی مقالات علوم کامپیوتر و برنامه‌نویسی</p>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <?php if (empty($articles)): ?>
    <div class="text-center">هیچ مقاله‌ای منتشر نشده است.</div>
  <?php else: ?>
    <?php $firstArticle = array_shift($articles); ?>
    <div class="card border-0 shadow-sm rounded-3">
      <div class="card-body bg-white border-start border-primary border-5 rounded-3">
        <h3 class="card-title py-2"><?= htmlspecialchars($firstArticle['title']) ?></h3>
        <p class="card-subtitle text-secondary py-2">
          <span>نویسنده:</span>
          <span><?= htmlspecialchars($firstArticle['author_name']) ?></span>
          |
          <span><?= toJalali($firstArticle['created_at'], 'Y/m/d') ?></span>
        </p>
        <p class="card-text py-2">
          <?= htmlspecialchars(mb_substr($firstArticle['summary'] ?? $firstArticle['content'], 0, 200)) ?>...
        </p>
        <a href="/articles/<?= urlencode($firstArticle['slug']) ?>" class="text-primary link-dark text-decoration-none py-2 h5">ادامه مطلب</a>
      </div>
    </div>
    <br>
    <div class="row">
      <?php foreach ($articles as $article): ?>
        <div class="col-lg-6 col-sm-12">
          <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body bg-white dotted">
              <h4 class="card-title py-2"><?= htmlspecialchars($article['title']) ?></h4>
              <p class="card-subtitle text-secondary py-2">
                <span>نویسنده:</span>
                <span><?= htmlspecialchars($article['author_name']) ?></span>
                |
                <span><?= toJalali($article['created_at'], 'Y/m/d') ?></span>
              </p>
              <p class="card-text py-2"><?= htmlspecialchars(mb_substr($article['summary'] ?? $article['content'], 0, 150)) ?>...</p>
              <a href="/articles/<?= urlencode($article['slug']) ?>" class="text-primary link-dark text-decoration-none py-2">ادامه مطلب</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>