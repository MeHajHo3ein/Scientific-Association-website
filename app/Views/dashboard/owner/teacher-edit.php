<?php
$pageTitle = 'پنل شخصی - ویرایش استاد';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);

$teacher = $teacher ?? null;
if (!$teacher) {
  $_SESSION['error'] = 'استاد یافت نشد.';
  redirect('/panel/teachers');
}
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
  <h3 class="text-primary">ویرایش استاد</h3>

  <!-- Main Content -->
  <div class="container my-5">
    <form class="form-control" action="/panel/teachers/update/<?= $teacher['id'] ?>" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12 my-3">
          <label for="T-image">عکس </label>
          <input class="C-input" id="T-image" name="T-image" type="file" accept="image/*">
          <small>فرمت‌های مجاز: jpg, png, webp — حداکثر 2MB</small>
          <div class="form-group">
            <label>پیش‌نمایش تصویر</label>
            <div class="image-preview" id="imagePreview">
              <?php if (!empty($teacher['image'])): ?>
                <img src="/uploads/teachers/<?= $teacher['image'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
              <?php else: ?>
                <img src="/assets/img/logo.png" style="width: 100%; height: 100%; object-fit: cover;">
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="name">نام و نام خانوادگی</label>
          <input
            type="text"
            class="C-input text-start"
            id="full_name"
            name="full_name"
            placeholder="ممد جعفرزاده"
            minlength="3"
            value="<?= htmlspecialchars($old_input['full_name'] ?? $teacher['full_name']); ?>"
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
            value="<?= htmlspecialchars($old_input['mobile'] ?? $teacher['mobile']); ?>"
            maxlength="11"
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
            value="<?= htmlspecialchars($old_input['email'] ?? $teacher['email']); ?>"
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
            oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '')" />
        </div>
        <div class="form-group" id="">
          <label for="role"> تغییر سطح دسترسی به:</label>
          <select class="C-select" id="role" name="role">
            <option value="">انتخاب کنید...</option>
            <option value="student" <?= ($admin['role'] ?? '') === 'student' ? 'selected' : '' ?>>دانشجو</option>
            <option value="admin" <?= ($admin['role'] ?? '') === 'admin' ? 'selected' : '' ?>>ادمین</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary d-block w-100 mt-4">
        ثبت تغییرات
      </button>
    </form>
  </div>
</div>

<script>
  const imageInput = document.getElementById('T-image');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) {
      imagePreview.innerHTML = 'بدون تصویر';
      imagePreview.style.background = '#f5f5f5';
      imagePreview.style.display = 'flex';
      imagePreview.style.alignItems = 'center';
      imagePreview.style.justifyContent = 'center';
      return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
      imagePreview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
      imagePreview.style.background = 'transparent';
      imagePreview.style.display = 'block';
      imagePreview.style.padding = '0';
    };
    reader.readAsDataURL(file);
  });

  document.getElementById('toggle-admin-view').addEventListener('change', function(e) {
    const passwordInput = document.getElementById('password');
    passwordInput.type = e.target.checked ? 'text' : 'password';
  });
</script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>