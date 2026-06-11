<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - دروس';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
$navbarRounded = 'rounded-bottom-3';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$webdevCourses = $webdevCourses ?? [];
$networkCourses = $networkCourses ?? [];
$aiCourses = $aiCourses ?? [];
$programmingCourses = $programmingCourses ?? [];
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>لیست دوره‌ها</h1>
    <p>تمام دوره‌های آموزشی در حوزه برنامه‌نویسی، وب، شبکه و هوش مصنوعی</p>
  </div>
  <div class="container d-flex justify-content-center">
    <a href="#network" class="btn btn-outline-primary mx-2 rounded-3">شبکه</a>
    <a href="#webdev" class="btn btn-outline-primary mx-2 rounded-3">توسعه وب</a>
    <a href="#ai" class="btn btn-outline-primary mx-2 rounded-3">هوش مصنوعی</a>
    <a href="#prog" class="btn btn-outline-primary mx-2 rounded-3">برنامه نویسی</a>
  </div>
  <br />
</div>

<!-- Main -->
<div class="container">

  <!-- webdev -->
  <h4 id="webdev" class="my-3">توسعه وب</h4>
  <div class="row">
    <?php if (empty($webdevCourses)): ?>
      <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
    <?php else: ?>
      <?php foreach ($webdevCourses as $course): ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
            <div
              class="card-body border-start border-primary border-5 rounded-3">
              <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
              <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
              <p class="card-text">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($course['instructor_name']); ?></span>
              </p>
              <p class="card-text">
                <span>سطح:</span>
                <span>
                  <?php
                  $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                  echo $levels[$course['level']] ?? 'متوسط';
                  ?>
                </span>
              </p>
              <p class="card-text">
                <span>هزینه:</span>
                <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
              </p>
              <p class="card-text">
                <span>مدت دوره:</span>
                <span><?= htmlspecialchars($course['duration']); ?></span>
              </p>
              <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                مشاهده جزئیات
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- network -->
  <h4 id="network" class="my-3">شبکه</h4>
  <div class="row">
    <?php if (empty($networkCourses)): ?>
      <div class="col-12">
        <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
      </div>
    <?php else: ?>
      <?php foreach ($networkCourses as $course): ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
            <div
              class="card-body border-start border-primary border-5 rounded-3">
              <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
              <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
              <p class="card-text">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($course['instructor_name']); ?></span>
              </p>
              <p class="card-text">
                <span>سطح:</span>
                <span>
                  <?php
                  $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                  echo $levels[$course['level']] ?? 'متوسط';
                  ?>
                </span>
              </p>
              <p class="card-text">
                <span>هزینه:</span>
                <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
              </p>
              <p class="card-text">
                <span>مدت دوره:</span>
                <span><?= htmlspecialchars($course['duration']); ?></span>
              </p>
              <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                مشاهده جزئیات
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- ai -->
  <h4 id="ai" class="my-3">هوش مصنوعی</h4>
  <div class="row">
    <?php if (empty($aiCourses)): ?>
      <div class="col-12">
        <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
      </div>
    <?php else: ?>
      <?php foreach ($aiCourses as $course): ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
            <div
              class="card-body border-start border-primary border-5 rounded-3">
              <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
              <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
              <p class="card-text">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($course['instructor_name']); ?></span>
              </p>
              <p class="card-text">
                <span>سطح:</span>
                <span>
                  <?php
                  $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                  echo $levels[$course['level']] ?? 'متوسط';
                  ?>
                </span>
              </p>
              <p class="card-text">
                <span>هزینه:</span>
                <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
              </p>
              <p class="card-text">
                <span>مدت دوره:</span>
                <span><?= htmlspecialchars($course['duration']); ?></span>
              </p>
              <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                مشاهده جزئیات
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- programming -->
  <h4 id="prog" class="my-3">برنامه نویسی</h4>
  <div class="row">
    <?php if (empty($programmingCourses)): ?>
      <div class="col-12">
        <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
      </div>
    <?php else: ?>
      <?php foreach ($programmingCourses as $course): ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
            <div
              class="card-body border-start border-primary border-5 rounded-3">
              <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
              <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
              <p class="card-text">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($course['instructor_name']); ?></span>
              </p>
              <p class="card-text">
                <span>سطح:</span>
                <span>
                  <?php
                  $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                  echo $levels[$course['level']] ?? 'متوسط';
                  ?>
                </span>
              </p>
              <p class="card-text">
                <span>هزینه:</span>
                <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
              </p>
              <p class="card-text">
                <span>مدت دوره:</span>
                <span><?= htmlspecialchars($course['duration']); ?></span>
              </p>
              <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                مشاهده جزئیات
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>