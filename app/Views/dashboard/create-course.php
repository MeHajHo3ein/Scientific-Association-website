<?php
$pageTitle = 'افزودن دوره';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container my-5">
    <form id="courseForm">
      <div class="form-row">
        <div class="form-group">
          <label for="title">نام دوره</label>
          <input class="C-input" id="title" name="title" type="text" required>
        </div>
        <div class="form-group">
          <label for="level">سطح</label>
          <select class="C-select" id="level" name="level" required>
            <option value="">انتخاب کنید...</option>
            <option value="beginner">مبتدی</option>
            <option value="intermediate">متوسط</option>
            <option value="advanced">پیشرفته</option>
          </select>
        </div>
        <div class="form-group">
          <label for="price">هزینه (تومان)</label>
          <input class="C-input" id="price" name="price" type="number" min="0" step="1000" required>
          <small class="C-small">اگر 0 وارد کنید، دوره رایگان در نظر گرفته می‌شود.</small>
        </div>
        <div class="form-group">
          <label for="duration">مدت دوره (ساعت / جلسه)</label>
          <input class="C-input" id="duration" name="duration" type="text"
            placeholder="مثلاً 20 ساعت یا 10 جلسه">
        </div>
      </div>
      <!-- مدرس و تصویر -->
      <div class="form-row">
        <div class="form-group">
          <label for="instructor">مدرس</label>
          <select class="C-select" id="instructor" name="instructorId" required>
            <option value="">انتخاب کنید...</option>
            <option value="1">حسام جعفری</option>
            <option value="2">دکتر رضایی</option>
            <option value="3">مهندس کریمی</option>
          </select>
        </div>
        <div class="form-group">
          <label for="image">عکس دوره</label>
          <input class="C-input" id="image" name="image" type="file" accept="image/*">
          <small>فرمت‌های مجاز: jpg, png, webp — حداکثر 2MB</small>
        </div>
        <div class="form-group">
          <label>پیش‌نمایش تصویر</label>
          <div class="image-preview" id="imagePreview">
            بدون تصویر
          </div>
        </div>
      </div>
      <!-- معرفی -->
      <div class="form-group">
        <label for="description">معرفی و توضیحات دوره</label>
        <textarea class="C-textarea" id="description" name="description"
          placeholder="توضیح کلی درباره دوره، اهداف، مخاطبین و...">
                    </textarea>
      </div>
      <!-- پیش‌نیازها -->
      <div class="form-group">
        <div class="section-header">
          <div>
            <label>پیش‌نیازها</label>
            <small>مواردی که بهتر است دانشجو قبل از شروع دوره بلد باشد.</small>
          </div>
          <button type="button" class="btn btn-primary btn-sm mt-3" id="addPrereqBtn">➕ افزودن پیش‌نیاز
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
          <button type="button" class="btn btn-primary btn-sm mt-3" id="addSectionBtn">➕ افزودن سرفصل
          </button>
        </div>

        <div class="dynamic-list" id="sectionsList">
          <!-- آیتم‌ها توسط JS اضافه می‌شوند -->
        </div>
      </div>

      <!-- دکمه -->
      <div class="actions">
        <button type="submit" class="btn btn-primary"> انتشار دوره</button>
      </div>
    </form>
  </div>
</div>
</div>

<script src="/assets/js/create-course.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>