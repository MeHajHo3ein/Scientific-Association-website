<?php
$pageTitle = 'پنل شخصی - گواهینامه ها';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$certificates = $certificates ?? [];
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">گواهی های قابل دریافت</h3>

    <?php if (empty($certificates)): ?>
      <div class="text-center">
        <p>شما هنوز هیچ گواهی دریافت نکرده‌اید.</p>
      </div>
    <?php else: ?>
      <div class="row">
        <?php foreach ($certificates as $cert): ?>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card d-flex p-0 mt-1 border-0">
              <div class="card-body border-5 border-start border-primary">
                <h5><?= htmlspecialchars($cert['exam_title'] ?? $cert['course_name'] ?? 'گواهی') ?></h5>
                <p class="p-2">
                  <span>نمره:</span>
                  <span><?= toPersianNumber($cert['percentage'] ?? 0) ?> از ۱۰۰</span>
                </p>
                <p class="p-2">
                  <span>تاریخ دریافت:</span>
                  <span><?= toJalali($cert['completed_at'] ?? date('Y-m-d H:i:s'), 'Y/m/d') ?></span>
                </p>
                <a href="/certificates/view/<?= $cert['id'] ?>" class="d-block text-decoration-none btn btn-outline-primary my-3 border-1">مشاهده</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>