<?php
$pageTitle = 'افزودن مقالات';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container my-5">
    <form id="courseForm">
      <div class="form-row">
        <div class="form-group">
          <label for="title">عنوان مقاله</label>
          <input class="C-input" id="title" name="title" type="text" required>
        </div>
        <div class="form-group">
          <label for="summary">چکیده مقاله</label>
          <input class="C-input" id="summary" name="summary" type="text">
        </div>
      </div>
      <!-- معرفی -->
      <div class="form-group">
        <label for="description">معرفی و توضیحات مقاله</label>
        <textarea class="C-textarea" id="description" name="description"
          placeholder="توضیح کلی درباره مقاله">
                    </textarea>
      </div>
      <!-- سرفصل‌ها -->
      <div class="form-group">
        <div class="section-header">
          <div>
            <label>ریز عنوان ها</label>
            <small>ساختار کلی مقاله، فصل‌ها و مباحث اصلی.</small>
          </div>
          <button type="button" class="btn btn-primary btn-sm mt-3" id="addSectionBtn">➕ افزودن ریزعنوان
          </button>
        </div>
        <div class="dynamic-list" id="sectionsList">
          <!-- آیتم‌ها توسط JS اضافه می‌شوند -->
        </div>
      </div>
      <!-- دکمه -->
      <div class="actions">
        <button type="submit" class="btn btn-primary"> انتشار مقاله</button>
      </div>
    </form>
  </div>
</div>
</div>

<script src="/assets/js/create-article.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>