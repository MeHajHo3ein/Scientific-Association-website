<?php
$pageTitle = 'پنل شخصی - افزودن استاد';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<!-- Alerts-->
<?php if (!empty($errors)): ?>
  <!-- Mobile duplicate error -->
  <?php if (isset($errors['mobile_duplicate'])): ?>
    <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
      <strong>شماره تلفن </strong> <?= htmlspecialchars($errors['mobile_duplicate']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Email duplicate error -->
  <?php if (isset($errors['email_duplicate'])): ?>
    <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
      <strong>ایمیل </strong> <?= htmlspecialchars($errors['email_duplicate']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>
<?php endif; ?>

<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">افزودن استاد</h3>

  <!-- Main Content -->
  <div class="container my-5">
    <form class="form-control" action="/panel/teachers/store" method="POST">
      <div class="row">
        <div class="col-md-6">
          <label class="form-label" for="full_name">نام و نام خانوادگی</label>
          <input
            type="text"
            class="C-input text-start"
            id="full_name"
            name="full_name"
            placeholder="ممد جعفرزاده"
            minlength="3"
            value="<?= htmlspecialchars($old_input['full_name'] ?? ''); ?>"
            required />
        </div>
        <div class="col-md-6">
          <label class="form-label" for="mobile">شماره تلفن</label>
          <input
            type="tel"
            class="C-input"
            id="mobile"
            name="mobile"
            placeholder="09xxxxxxxxx"
            maxlength="11"
            value="<?= htmlspecialchars($old_input['mobile'] ?? ''); ?>"
            required />
        </div>
        <div class="col-md-6 mt-3">
          <label class="form-label" for="email">ایمیل</label>
          <input
            type="email"
            class="C-input"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            value="<?= htmlspecialchars($old_input['email'] ?? ''); ?>"
            required />
        </div>
        <div class="col-md-6 mt-3">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="password">رمز عبور</label>
            <div>
              <label class="form-label" for="toggle-admin-view">نمایش رمز</label>
              <input
                class="form-check-input"
                type="checkbox"
                name="Show-pass"
                id="toggle-admin-view" />
            </div>
          </div>
          <input
            type="password"
            class="C-input text-end"
            id="password"
            name="password"
            placeholder="Aa-Zz,1-9"
            oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')"
            required />
        </div>
      </div>
      <button type="submit" class="btn btn-primary d-block w-100 mt-4">
        افزودن
      </button>
    </form>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>