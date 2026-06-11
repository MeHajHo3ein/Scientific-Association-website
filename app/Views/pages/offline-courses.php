<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - دانلود دروس';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
$navbarRounded = 'rounded-bottom-3';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$publicFiles = $publicFiles ?? [];
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>لیست جزوه های قابل دانلود</h1>
    <p>امکان دانلود تمامی جزوه های مربوطه</p>
  </div>
  <br />
</div>

<!-- Main -->
<div class="container">
  <div class="row">
    <?php if (empty($publicFiles)): ?>
      <div class="col-12">
        <div class="text-center">هیچ فایلی برای دانلود وجود ندارد.</div>
      </div>
    <?php else: ?>
      <?php foreach ($publicFiles as $file): ?>
        <div class="col-lg-4 col-sm-12 ">
          <div class="m-5 card rounded-3 border-0">
            <div class="card-body border-start border-primary border-5 rounded-3 bg-white text-center">
              <h5 class="card-title mt-3"><?= htmlspecialchars($file['title']) ?></h5>
              <p class="card-text py-1">
                <span>درس:</span>
                <span><?= htmlspecialchars($file['lesson']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($file['teacher_name']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>نوع فایل:</span>
                <span><?= htmlspecialchars($file['file_type']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>هزینه:</span>
                <span><?= $file['price'] > 0 ? number_format($file['price']) . ' تومان' : 'رایگان' ?></span>
              </p>
              <a href="<?= htmlspecialchars($file['file_link']) ?>" class="btn btn-outline-primary border-1" target="_blank" rel="noopener noreferrer">
                دانلود
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>