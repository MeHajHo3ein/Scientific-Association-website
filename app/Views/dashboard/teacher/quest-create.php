<?php
$pageTitle = 'پنل شخصی - سوالات امتحانی';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$errors = $_SESSION['exam_errors'] ?? [];
$old_input = $_SESSION['exam_data'] ?? [];
unset($_SESSION['exam_errors'], $_SESSION['exam_data']);

$fullName = $_SESSION['full_name'] ?? '';
?>

<!-- Alert Errors -->
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
  <h3 class="text-primary">طراحی سوالات امتحانی</h3>

  <form id="examForm" action="/panel/quests/store" method="POST">
    <!-- اطلاعات آزمون -->
    <div class="bg-white p-3 mt-2 rounded">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="title">عنوان آزمون</label>
          <input
            type="text"
            name="title"
            id="title"
            class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>"
            placeholder="مثال: آزمون نهایی PHP"
            minlength="0"
            value="<?= htmlspecialchars($old_input['title'] ?? '') ?>"
            required />
        </div>

        <div class="col-md-6">
          <label class="form-label" for="course_name">نام دوره</label>
          <input
            type="text"
            name="course_name"
            id="course_name"
            class="form-control <?= isset($errors['course_name']) ? 'is-invalid' : '' ?>"
            placeholder="مثال: برنامه‌نویسی PHP پیشرفته"
            minlength="0"
            value="<?= htmlspecialchars($old_input['course_name'] ?? '') ?>"
            required />
        </div>

        <div class="col-md-6">
          <label class="form-label" for="teacher_name">نام مدرس</label>
          <input
            type="text"
            name="teacher_name"
            id="teacher_name"
            class="form-control"
            value="<?= htmlspecialchars($fullName) ?>"
            disabled />
          <input type="hidden" name="teacher_name" value="<?= htmlspecialchars($fullName) ?>">
        </div>

        <div class="col-md-6">
          <label class="form-label" for="pass_score">حداقل نمره قبولی (درصد)</label>
          <input
            type="number"
            name="pass_score"
            id="pass_score"
            class="form-control"
            min="0"
            max="100"
            value="<?= htmlspecialchars($old_input['pass_score'] ?? '50') ?>" />
        </div>
      </div>
    </div>

    <!-- سوالات -->
    <div id="questionsContainer" class="bg-white p-3 mt-2 rounded">
      <div id="questionsList"></div>

      <div class="mt-2">
        <button type="button" class="btn btn-success w-100" onclick="addQuestion()">
          <i class="bi bi-plus-lg"></i> افزودن سؤال جدید
        </button>
      </div>
    </div>

    <div class="mt-2">
      <button type="submit" class="btn btn-primary w-100 mt-4" id="submitBtn">
        انتشار
      </button>
    </div>
  </form>
</div>

<script src="/assets/js/QuestCreate.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>