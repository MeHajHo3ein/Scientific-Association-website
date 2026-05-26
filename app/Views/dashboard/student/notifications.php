<?php
$pageTitle = 'پنل شخصی - اعلانات';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">پیام های دریافتی</h3>
    <?php if (empty($notifications)): ?>
      <div class="text-center mt-4">هیچ اعلانی برای شما وجود ندارد.</div>
    <?php else: ?>
      <?php foreach ($notifications as $notification): ?>
        <div class="bg-white p-4 border-3 border-primary border-start my-4">
          <div class="d-flex justify-content-between">
            <h3><?= htmlspecialchars($notification['title']) ?></h3>
            <span class="text-primary"><?= toJalali($notification['created_at'], 'Y/m/d') ?></span>
          </div>
          <p class="d-block"><?= nl2br(htmlspecialchars($notification['message'])) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>