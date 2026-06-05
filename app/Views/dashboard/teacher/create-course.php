<?php
$pageTitle = 'افزودن دوره';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['errors'] ?? [];
$old_input = $_SESSION['old_input'] ?? [];
$instructors = $instructors ?? [];
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
  <div class="container my-5">
    <form id="courseForm" action="/panel/courses/store" enctype="multipart/form-data" method="POST">
      <div class="form-row">
        <div class="form-group">
          <label for="title">نام دوره</label>
          <input type="text" class="C-input" id="title" name="title" value="<?= htmlspecialchars($old_input['title'] ?? ''); ?>" required />
        </div>

        <div class="form-group">
          <label for="level">سطح</label>
          <select class="C-select" id="level" name="level" required>
            <option value="">انتخاب کنید...</option>
            <option value="beginner" <?= ($old_input['level'] ?? '') == 'beginner' ? 'selected' : '' ?>>مبتدی</option>
            <option value="intermediate" <?= ($old_input['level'] ?? '') == 'intermediate' ? 'selected' : '' ?>>متوسط</option>
            <option value="advanced" <?= ($old_input['level'] ?? '') == 'advanced' ? 'selected' : '' ?>>پیشرفته</option>
          </select>
        </div>

        <div class="form-group">
          <label for="price">هزینه (تومان)</label>
          <input
            type="number"
            class="C-input"
            id="price"
            name="price"
            min="0"
            step="1000"
            placeholder="رایگان"
            disabled />
          <!-- value="<?= htmlspecialchars($old_input['price'] ?? '') ?>" -->
          <!-- <small class="C-small">اگر 0 وارد کنید، دوره رایگان در نظر گرفته می‌شود.</small> -->
        </div>

        <div class="form-group">
          <label for="duration">مدت دوره (ساعت / جلسه)</label>
          <input
            type="text"
            class="C-input"
            id="duration"
            name="duration"
            value="<?= htmlspecialchars($old_input['duration'] ?? ''); ?>"
            placeholder="مثلاً 20 ساعت یا 10 جلسه" />
        </div>
      </div>

      <!-- Number-of-Student -->
      <div class="form-group">
        <label for="student_count">تعداد دانشجو</label>
        <select class="C-select" id="student_count" name="student_count">
          <option value="10" <?= ($old_input['student_count'] ?? '') == '10' ? 'selected' : '' ?>>10</option>
          <option value="20" <?= ($old_input['student_count'] ?? '') == '20' ? 'selected' : '' ?>>20</option>
          <option value="30" <?= ($old_input['student_count'] ?? '') == '30' ? 'selected' : '' ?>>30</option>
          <option value="40" <?= ($old_input['student_count'] ?? '') == '40' ? 'selected' : '' ?>>40</option>
          <option value="50" <?= ($old_input['student_count'] ?? '') == '50' ? 'selected' : '' ?>>50</option>
          <option value="100" <?= ($old_input['student_count'] ?? '') == '100' ? 'selected' : '' ?>>100</option>
          <option value="200" <?= ($old_input['student_count'] ?? '') == '200' ? 'selected' : '' ?>>200</option>
          <option value="300" <?= ($old_input['student_count'] ?? '') == '300' ? 'selected' : '' ?>>300</option>
        </select>
      </div>

      <!-- مدرس و تصویر -->
      <div class="form-row">
        <div class="form-group">
          <label for="image">عکس دوره</label>
          <input
            type="file"
            class="C-input"
            id="image"
            name="image"
            accept="image/*" />
          <small>فرمت‌های مجاز: jpg, png, webp — حداکثر 2MB</small>
        </div>

        <div class="form-group">
          <label>پیش‌نمایش تصویر</label>
          <div class="image-preview" id="imagePreview">بدون تصویر</div>
        </div>
      </div>

      <!-- معرفی -->
      <div class="form-group">
        <label for="description">معرفی و توضیحات دوره</label>
        <textarea class="C-textarea" id="description" name="description"
          placeholder="توضیح کلی درباره دوره، اهداف، مخاطبین و..."><?= htmlspecialchars($old_input['description'] ?? '') ?></textarea>
      </div>

      <!-- پیش‌نیازها -->
      <div class="form-group">
        <div class="section-header">
          <div>
            <label>پیش‌نیازها</label>
            <small>مواردی که بهتر است دانشجو قبل از شروع دوره بلد باشد.</small>
          </div>
          <button
            type="button"
            class="btn btn-primary btn-sm mt-3"
            id="addPrereqBtn">
            ➕ افزودن پیش‌نیاز
          </button>
        </div>

        <div class="dynamic-list" id="prereqList">
          <!-- آیتم‌ها توسط JS اضافه می‌شوند -->
        </div>
      </div>

      <!-- سرفصل‌ها -->
      <div class="form-group">
        <div class="section-header">
          <div>
            <label>سرفصل‌ها</label>
            <small>ساختار کلی دوره، فصل‌ها و مباحث اصلی.</small>
          </div>
          <button
            type="button"
            class="btn btn-primary btn-sm mt-3"
            id="addSectionBtn">
            ➕ افزودن سرفصل
          </button>
        </div>

        <div class="dynamic-list" id="sectionsList">
          <!-- آیتم‌ها توسط JS اضافه می‌شوند -->
        </div>
      </div>

      <!-- دکمه -->
      <div class="actions">
        <button type="submit" class="btn btn-primary">انتشار دوره</button>
      </div>
    </form>
  </div>
</div>

<script src="/assets/js/create-course.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>