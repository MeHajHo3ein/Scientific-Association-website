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

    <label class="form-label">دسته بندی</label>
    <div class="form-check">
      <input
        type="radio"
        class="form-check-input"
        name="category"
        value="event"
        id="Events"
        <?= ($old_input['category'] ?? '') == 'event' ? 'checked' : '' ?> />
      <label class="form-check-label" for="Events"> رویداد </label>
    </div>
    <div class="form-check">
      <input
        type="radio"
        class="form-check-input"
        name="category"
        value="news"
        id="News"
        <?= ($old_input['category'] ?? '') == 'news' ? 'checked' : '' ?> />
      <label class="form-check-label" for="News"> خبر </label>
    </div>
    <div class="form-check">
      <input
        type="radio"
        class="form-check-input"
        name="category"
        value="announcement"
        id="Announcements"
        checked
        <?= ($old_input['category'] ?? '') == 'announcement' ? 'checked' : '' ?> />
      <label class="form-check-label" for="Announcements"> اطلاعیه </label>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-4" id="submitBtn">
      انتشار
    </button>
  </form>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>