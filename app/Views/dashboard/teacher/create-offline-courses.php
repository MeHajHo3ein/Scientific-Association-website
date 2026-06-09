<?php
$pageTitle = 'پنل شخصی - دانلود فایل';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['offline_errors'] ?? [];
$old_input = $_SESSION['offline_old'] ?? [];
unset($_SESSION['offline_errors'], $_SESSION['offline_old']);
?>

<?php if (!empty($errors)): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <ul class="mb-0">
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <form class="form-control" action="/panel/offline-courses/store" method="POST">

    <label for="file_link" class="form-label">فایل</label>
    <input
      class="C-input"
      id="file_link"
      name="file_link"
      type="text"
      placeholder="لینک دریافتی خود از سایت هاست دانلودی خود را اینجا جایگزاری کنید."
      value="<?= htmlspecialchars($old_input['file_link'] ?? '') ?>"
      required />

    <label class="form-label" for="title">عنوان</label>
    <input
      class="C-input"
      id="title"
      name="title"
      type="text"
      placeholder="عنوان مورد نظر"
      value="<?= htmlspecialchars($old_input['title'] ?? '') ?>"
      required />

    <label class="form-label" for="lesson">درس</label>
    <input
      class="C-input"
      id="lesson"
      name="lesson"
      type="text"
      placeholder="نام درس"
      value="<?= htmlspecialchars($old_input['lesson'] ?? '') ?>"
      required />

    <div class="form-group">
      <label for="price">هزینه (تومان)</label>
      <input
        class="C-input"
        id="price"
        name="price"
        type="number"
        min="0"
        step="1000"
        placeholder="رایگان"
        disabled />
      <!--                <small class="C-small">اگر 0 وارد کنید، دوره رایگان در نظر گرفته می‌شود.</small>-->
    </div>
    <button type="submit" class="btn btn-primary w-100 mt-4" id="submitBtn">
      ثبت
    </button>
  </form>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>