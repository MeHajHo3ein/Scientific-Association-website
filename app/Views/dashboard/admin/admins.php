<?php
$pageTitle = 'پنل شخصی - مدیران شبکه';
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
  <h3 class="text-primary">مدیران شبکه</h3>
  <a href="/panel/admins/create" class="btn btn-primary my-1 d-block w-100">افزودن</a>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>نام و نام خانوادگی</th>
        <th>شماره موبایل</th>
        <th>ایمیل</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($admins)): ?>
        <tr>
          <td colspan="7" class="text-center">هیچ ادمینی یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($admins as $index => $admin): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($admin['full_name']); ?></td>
            <td><?= htmlspecialchars($admin['mobile']); ?></td>
            <td><?= htmlspecialchars($admin['email']); ?></td>
            <td class="">
              <a href="/panel/admins/edit/<?= $admin['id'] ?>" class="btn btn-primary">ویرایش</a>
              <?php if ($admin['id'] != $_SESSION['user_id']): ?>
                <a href="/panel/admins/delete/<?= $admin['id'] ?>" class="btn btn-danger" onclick="return confirm('آیا از حذف این ادمین مطمئن هستید؟')">حذف</a>
              <?php else: ?>
                <button class="btn btn-secondary" disabled>حذف</button>
              <?php endif; ?>
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