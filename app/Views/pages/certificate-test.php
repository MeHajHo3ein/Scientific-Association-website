<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - گواهی';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$exam = $exam ?? [];
$questions = $questions ?? [];
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1><?= htmlspecialchars($exam['title'] ?? 'آزمون') ?></h1>
    <p>برای کسب گواهی‌نامه رسمی، به نمونه سؤالات زیر توجه کنید.</p>
  </div>
  <br />
</div>

<!--Main-->
<form action="/certificates/exam/submit" method="POST" id="examForm">
  <input type="hidden" name="exam_id" value="<?= $exam['id'] ?? 0 ?>">

  <div class="container">
    <?php if (empty($questions)): ?>
      <div class="text-center">هیچ سوالی برای این آزمون تعریف نشده است.</div>
    <?php else: ?>
      <?php foreach ($questions as $index => $question): ?>
        <div class="card rounded-3 mt-4">
          <div
            class="d-flex align-items-center bg-primary align-self-start text-center m-3 rounded-pill text-white">
            <span class="badge-size"><?= $index + 1 ?></span>
          </div>

          <div class="card-body">
            <h4 class="card-title"><?= nl2br(htmlspecialchars($question['question_text'])) ?></h4>

            <?php if ($question['question_type'] === 'codeoutput' && !empty($question['code_block'])): ?>
              <div class="bg-body-secondary text-end p-3 rounded-3">
                <code><?= htmlspecialchars($question['code_block']) ?></code>
              </div>
            <?php endif; ?>

            <div class="mt-4">
              <?php if ($question['question_type'] === 'truefalse'): ?>
                <?php $options = ['صحیح', 'غلط']; ?>
                <?php foreach ($options as $optIndex => $option): ?>
                  <button type="button" class="w-100 mt-3 card p-3 option-item text-start"
                    data-value="<?= $optIndex == 0 ? 'A' : 'B' ?>"
                    data-qid="<?= $question['id'] ?>">
                    <?= chr(65 + $optIndex) ?>) <?= htmlspecialchars($option) ?>
                  </button>
                <?php endforeach; ?>
                <input type="hidden" name="answers[<?= $question['id'] ?>]" id="answer_<?= $question['id'] ?>" value="">

              <?php elseif (in_array($question['question_type'], ['multiple', 'codeoutput']) && !empty($question['options'])): ?>
                <?php $options = json_decode($question['options'], true); ?>
                <?php foreach ($options as $optIndex => $option): ?>
                  <button type="button" class="w-100 mt-3 card p-3 option-item text-start" data-value="<?= chr(65 + $optIndex) ?>" data-qid="<?= $question['id'] ?>">
                    <?= chr(65 + $optIndex) ?>) <?= htmlspecialchars($option) ?>
                  </button>
                <?php endforeach; ?>
                <input type="hidden" name="answers[<?= $question['id'] ?>]" id="answer_<?= $question['id'] ?>" value="">

              <?php else: ?>
                <div class="mt-3">
                  <label class="form-label">پاسخ خود را وارد کنید:</label>
                  <textarea class="form-control" rows="3" name="answers[<?= $question['id'] ?>]" placeholder="خروجی کد مورد نظر را وارد کنید..."></textarea>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="card rounded-3 mt-4">
        <button type="submit" class="btn btn-outline-primary m-5" id="submitExamBtn">ارسال جواب ها</button>
      </div>
    <?php endif; ?>
  </div>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const optionItems = document.querySelectorAll('.option-item');

    optionItems.forEach(item => {
      item.addEventListener('click', function() {
        const qid = this.dataset.qid;
        const value = this.dataset.value;
        const hiddenInput = document.getElementById(`answer_${qid}`);

        if (hiddenInput) {
          hiddenInput.value = value;
        }

        const allOptions = document.querySelectorAll(`.option-item[data-qid="${qid}"]`);
        allOptions.forEach(opt => {
          opt.classList.remove('active', 'selected');
          opt.style.backgroundColor = '';
          opt.style.borderColor = '';
        });

        this.classList.add('active', 'selected');
        this.style.backgroundColor = '#e7f1ff';
        this.style.borderColor = '#0d6efd';
      });
    });
  });
</script>

<br>
<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>