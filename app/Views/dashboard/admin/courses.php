<?php
$pageTitle = 'پنل شخصی - دوره ها';
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
  <h3 class="text-primary">دوره های بارگزاری شده</h3>
  <a href="/panel/courses/create" class="btn btn-primary d-block w-100 my-1">افزودن</a>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>عنوان</th>
        <th>مدرس</th>
        <th>هزینه</th>
        <th>مدت دوره</th>
        <th>تعداد دانشجو</th>
        <th>تاریخ انتشار</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($courses)): ?>
        <tr>
          <td colspan="9" class="text-center">هیچ دوره‌ای یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($courses as $index => $course): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($course['title']) ?></td>
            <td><?= htmlspecialchars($course['instructor_name']) ?></td>
            <td><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></td>
            <td><?= htmlspecialchars($course['duration']) ?></td>
            <td><?= number_format($course['student_count']) ?> نفر</td>
            <td><?= toJalali($course['created_at'], 'Y/m/d') ?></td>
            <td class="">
              <a href="/panel/courses/delete/<?= $course['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف این دوره مطمئن هستید؟')">حذف</a>
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