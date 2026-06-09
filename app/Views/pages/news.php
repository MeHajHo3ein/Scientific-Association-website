<?php
$pageTitle = 'انجمن علمی دانشگاه خوارزمی(شهرضا) - خبرها';
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>اخبار و اطلاعیه‌ها</h1>
    <p>آخرین اخبار رسمی، اطلاعیه‌های مهم و به‌روزرسانی‌های انجمن</p>
  </div>
  <br />
</div>

<!--Main-->
<div class="container border-5 border-start border-primary">
  <!-- Announcements -->
  <div class="row mt-5">
    <div
      class="col-lg-2 col-sm-2 bg-primary text-center align-self-start text-white h3 rounded-end-4"
      id="announcement">
      اطلاعیه‌
    </div>
    <?php if (empty($announcements)): ?>
      <div class="text-center">هیچ اطلاعیه‌ای وجود ندارد.</div>
    <?php else: ?>
      <?php foreach ($announcements as $index => $item): ?>
        <?php if ($index === 0): ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h2 class=""><?= htmlspecialchars($item['title']) ?></h2>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h4 class=""><?= htmlspecialchars($item['title']) ?></h4>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- News -->
  <div class="row mt-5">
    <div
      class="col-lg-2 col-sm-2 bg-primary text-center align-self-start text-white h3 rounded-end-4"
      id="news">
      خبرها
    </div>
    <?php if (empty($news)): ?>
      <div class="text-center">هیچ خبری وجود ندارد.</div>
    <?php else: ?>
      <?php foreach ($news as $index => $item): ?>
        <?php if ($index === 0): ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h2 class=""><?= htmlspecialchars($item['title']) ?></h2>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h4 class=""><?= htmlspecialchars($item['title']) ?></h4>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Events -->
  <div class="row mt-5">
    <div
      class="col-lg-2 col-sm-2 bg-primary text-center align-self-start text-white h3 rounded-end-4"
      id="events">
      رویدادها
    </div>
    <?php if (empty($events)): ?>
      <div class="text-center">هیچ رویدادی وجود ندارد.</div>
    <?php else: ?>
      <?php foreach ($events as $index => $item): ?>
        <?php if ($index === 0): ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h2 class=""><?= htmlspecialchars($item['title']) ?></h2>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div class="col-lg-10 col-sm-10">
            <div class="card shadow-sm border-0 rounded-3 mx-1 my-3">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <div class="d-flex justify-content-between">
                  <h4 class=""><?= htmlspecialchars($item['title']) ?></h4>
                  <h5 class="text-primary"><?= toJalali($item['created_at'], 'Y/m/d') ?></h5>
                </div>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($item['content'])) ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>