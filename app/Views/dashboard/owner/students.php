<?php
$pageTitle = 'پنل شخصی - دانشجویان';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Alert -->
<!-- Success -->
<?php if (isset($_SESSION['success'])): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!-- Error -->
<?php if (isset($_SESSION['error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">دانشجویان</h3>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>نام و نام خانوادگی</th>
        <th>شماره موبایل</th>
        <th>ایمیل</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($students)): ?>
        <tr>
          <td colspan="7" class="text-center">هیچ دانشجویی یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($students as $index => $student): ?>
          <tr>
            <td><?= $index + 1; ?></td>
            <td><?= htmlspecialchars($student['full_name']); ?></td>
            <td><?= htmlspecialchars($student['mobile']); ?></td>
            <td><?= htmlspecialchars($student['email']); ?></td>
            <td class="">
              <a href="/panel/students/edit/<?= $student['id'] ?>" class="btn btn-primary">ویرایش</a>
              <a href="/panel/students/edit/<?= $student['id'] ?>" class="btn btn-warning">تغییر سطح</a>
              <a href="/panel/students/delete/<?= $student['id'] ?>" class="btn btn-danger" onclick="return confirm('آیا از حذف این دانشجو مطمئن هستید؟')">حذف</a>
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