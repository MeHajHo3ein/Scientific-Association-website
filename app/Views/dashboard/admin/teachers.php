<?php
$pageTitle = 'پنل شخصی - استادان';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">استادان</h3>
  <a href="./Teacher-Create.html" class="btn btn-primary my-1 d-block w-100">افزودن</a>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>نام و نام خانوادگی</th>
        <th>شماره موبایل</th>
        <th>ایمیل</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($teachers)): ?>
        <tr>
          <td colspan="7" class="text-center">هیچ استادی یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($teachers as $index => $teacher): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($teacher['full_name']); ?></td>
            <td><?= htmlspecialchars($teacher['mobile']); ?></td>
            <td><?= htmlspecialchars($teacher['email']); ?></td>
            <td class="">
              <a href="./Teacher-Edit.html" class="btn btn-primary">ویرایش</a>
              <button class="btn btn-danger">حذف</button>
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