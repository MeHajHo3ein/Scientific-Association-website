<?php
$pageTitle = 'پنل شخصی- افزودن اخبار - رویداد - اطلاعیه ها';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? [];
unset($_SESSION['errors'], $_SESSION['old_input']);
?>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <form class="form-control" action="/panel/neas/store" method="POST">
    <label class="form-label" for="title">عنوان</label>
    <input
      type="text"
      class="C-input"
      id="title"
      name="title"
      placeholder="عنوان مورد نظر"
      value="<?= htmlspecialchars($old_input['title'] ?? ''); ?>"
      required />

    <label for="content" class="form-label">متن</label>
    <input
      type="text"
      class="C-input"
      id="content"
      name="content"
      placeholder="متن مورد نظر"
      value="<?= htmlspecialchars($old_input['content'] ?? ''); ?>"
      required />

    <div class="form-group">
      <label for="category">دسته بندی</label>
      <select class="C-select" id="category" name="category" required>
        <option value="">انتخاب کنید...</option>
        <option value="events" <?= ($old_input['category'] ?? '') == 'events' ? 'selected' : '' ?>>رویداد</option>
        <option value="news" <?= ($old_input['category'] ?? '') == 'news' ? 'selected' : '' ?>>خبر</option>
        <option value="announcement" <?= ($old_input['category'] ?? '') == 'announcement' ? 'selected' : '' ?>>اطلاعیه</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-4" id="submitBtn">
      انتشار
    </button>
  </form>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>