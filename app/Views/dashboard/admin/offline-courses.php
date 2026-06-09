<?php
$pageTitle = 'پنل شخصی - دانلود فایل';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Alert Messages -->
<!-- Success -->
<?php if (isset($_SESSION['offline_success'])): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['offline_success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['offline_success']); ?>
<?php endif; ?>

<!-- Delete -->
<?php if (isset($_SESSION['offline_error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['offline_error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['offline_error']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">فایل های قابل دانلود</h3>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>عنوان</th>
        <th>درس</th>
        <th>مدرس</th>
        <th>نوع فایل</th>
        <th>هزینه</th>
        <th>تاریخ انتشار</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($files)): ?>
        <tr>
          <td colspan="8" class="text-center">هیچ فایلی یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($files as $index => $file): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($file['title']) ?></td>
            <td><?= htmlspecialchars($file['lesson']) ?></td>
            <td><?= htmlspecialchars($file['teacher_name'] ?? $_SESSION['full_name']) ?></td>
            <td><?= htmlspecialchars($file['file_type']) ?></td>
            <td><?= $file['price'] > 0 ? number_format($file['price']) . ' تومان' : 'رایگان' ?></td>
            <td><?= toJalali($file['created_at'], 'Y/m/d') ?></td>
            <td class="">
              <a href="/panel/offline-courses/delete/<?= $file['id'] ?>" class="btn btn-danger" onclick="return confirm('آیا از حذف این فایل مطمئن هستید؟')">حذف</a>
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