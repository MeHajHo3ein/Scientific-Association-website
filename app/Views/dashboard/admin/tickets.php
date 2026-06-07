<?php
$pageTitle = 'پنل شخصی - تیکت';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$tickets = $tickets ?? [];
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">تیکت های دریافتی</h3>
    <div class="row gy-3">
      <?php if (empty($tickets)): ?>
        <p class="bg-danger rounded-3 text-center text-white p-3">هیچ تیکتی وجود ندارد.</p>
      <?php else: ?>
        <?php foreach ($tickets as $ticket): ?>
          <div class="col-12 bg-primary-subtle p-3 rounded-3">
            <div class="container d-flex justify-content-between">
              <span class="row d-flex">
                <h5><?= htmlspecialchars($ticket['user_email']); ?></h5>
                <h5 class="mx-2"><?= htmlspecialchars($ticket['title']); ?></h5>
                <p><?= nl2br(htmlspecialchars($ticket['message'])); ?></p>
              </span>
              <span class="text-decoration-none text-sm-center text-black">
                <?= toJalali($ticket['created_at'], 'Y/m/d'); ?>
              </span>
            </div>

            <?php if ($ticket['is_read_admin'] == 0): ?>
              <a href="/panel/tickets/mark-read-admin/<?= $ticket['id'] ?>" class="btn btn-outline-warning text-black w-100 mb-2">
                علامت زدن به عنوان خوانده شده
              </a>
            <?php else: ?>
              <button class="btn btn-outline-success text-black w-100 mb-2" disabled>
                خوانده شده
              </button>
            <?php endif; ?>

            <a href="/panel/tickets/delete/<?= $ticket['id'] ?>" class="btn btn-outline-danger text-black w-100">
              حذف تیکت
            </a>

          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>