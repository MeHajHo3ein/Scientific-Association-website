<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - دروس';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$course = $course ?? [];
?>

<!-- Content -->
<div class="container">
  <div class="row hero-margin align-items-center d-flex flex-row-reverse">
    <div class="col-lg-6 col-sm-12 justify-content-center p-5">
      <img
        src="<?= $course['image'] ? '/uploads/courses/' . $course['image'] : '/assets/img/logo.png' ?>"
        alt="image of course"
        class="img-fluid rounded-3" />
    </div>

    <div class="col-lg-6 col-sm-12 text-center">
      <h2><?= htmlspecialchars($course['title']) ?></h2>
      <span>مدرس:</span>
      <span><?= htmlspecialchars($course['instructor_name']) ?></span>
      |
      <span class="">سطح: </span>
      <span><?= $course['level'] == 'beginner' ? 'مبتدی' : ($course['level'] == 'intermediate' ? 'متوسط' : 'پیشرفته') ?></span>
      |
      <span class="">مدت دوره:</span>
      <span><?= htmlspecialchars($course['duration']) ?></span>
    </div>
  </div>

  <hr />

  <div
    class="card shadow-sm p-3 my-5 bg-white border-start border-primary border-5 rounded-3 border-0">
    <div class="card-body">
      <h4 class="card-title">معرفی دوره</h4>
      <p class="card-text"><?= nl2br(htmlspecialchars($course['description'])) ?></p>
    </div>
  </div>

  <div
    class="card shadow-sm p-3 my-5 bg-white border-start border-primary border-5 rounded-3 border-0">
    <div class="card-body">
      <h4 class="card-title">پیش‌نیازها</h4>
      <?php if (empty($prerequisites)): ?>
        <p class="card-text">هیچ پیش‌نیازی لازم نیست — مناسب برای شروع از صفر.</p>
      <?php else: ?>
        <ul class="">
          <?php foreach ($prerequisites as $prereq): ?>
            <li><?= htmlspecialchars($prereq['title']) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <div
    class="card shadow-sm p-3 my-5 bg-white border-start border-primary border-5 rounded-3 border-0">
    <div class="card-body row align-self-start">
      <h4 class="card-title">مدرس دوره</h4>
      <div class="col-lg-3">
        <img
          src="<?= !empty($course['image']) ? '/uploads/teachers/' . htmlspecialchars($course['instructor_image']) : '/assets/img/logo.png' ?>"
          alt="image of Teacher"
          class="img-fluid rounded-circle Teachers-icon" style="object-fit: cover; width: 120px; height: 120px;" />
      </div>
      <div class="col-lg-9">
        <p class="h4"><?= htmlspecialchars($course['instructor_name']) ?></p>
        <p class="text-secondary"><?= htmlspecialchars($course['instructor_bio'] ?? 'مدرس دوره') ?></p>
      </div>
    </div>
  </div>

  <div
    class="card shadow-sm p-3 my-5 bg-white border-start border-primary border-5 rounded-3 border-0">
    <div class="card-body">
      <h2 class="h2 text-center text-dark m-4 pt-5">سرفصل دوره</h2>
      <div class="container mb-5">
        <?php if (!empty($syllabus)): ?>
          <?php foreach ($syllabus as $index => $section): ?>
            <div class="accordion m-1" id="accordion-<?= $index ?>">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse-<?= $index ?>">
                    <?= htmlspecialchars($section['title']) ?>
                  </button>
                </h2>
                <div
                  class="accordion-collapse collapse"
                  id="collapse-<?= $index ?>"
                  data-bs-parent="#accordion-<?= $index ?>">
                  <div class="accordion-body">
                    <p><?= nl2br(htmlspecialchars($section['description'])) ?></p>
                    <?php if (!empty($section['video_link'])): ?>
                      <div class="mt-3">
                        <a href="<?= htmlspecialchars($section['video_link']); ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">
                          دانلود
                          <i class="fa fa-download"></i>
                        </a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-center">هنوز سرفصلی برای این دوره ثبت نشده است.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<br />
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>