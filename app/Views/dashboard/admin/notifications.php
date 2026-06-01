<?php
$pageTitle = 'پنل شخصی - اعلانات';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<?php if (isset($_SESSION['success'])): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">اعلانات</h3>
  <div class="container">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>عنوان</th>
        <th>متن</th>
        <th>تاریخ انتشار</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($notifications)): ?>
        <tr>
          <td colspan="5" class="text-center">هیچ اعلانی یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($notifications as $index => $notification): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($notification['title']) ?></td>
            <td><?= htmlspecialchars(mb_substr($notification['message'], 0, 100)) ?></td>
            <td><?= toJalali($notification['created_at'], 'Y/m/d') ?></td>
            <td class="">
              <a href="/panel/notifications/delete/<?= $notification['id'] ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('آیا از حذف این اعلان مطمئن هستید؟')">حذف</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>