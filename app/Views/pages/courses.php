<?php
$pageTitle = 'انجمن علمی دانشگاه خوارزمی(شهرضا) - دروس';
$bodyClass = 'bg-secondary-subtle';
$navbarRounded = 'rounded-bottom-3';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
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
  <?php if (empty($courses)): ?>
    <div class="text-center">هیچ دوره‌ای یافت نشد.</div>
  <?php else: ?>
    <h4 id="webdev" class="my-3">توسعه وب</h4>
    <div class="row">
      <?php
      $webCourses = array_filter($courses, function ($c) {
        return stripos($c['title'], 'وب') !== false || stripos($c['title'], 'Front') !== false || stripos($c['title'], 'Web') !== false;
      });
      $webCourses = array_slice($webCourses, 0, 4);
      ?>
      <?php if (!empty($webCourses)): ?>
        <?php foreach ($webCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= $course['image'] ? '/uploads/courses' . $course['image'] : '/assets/img/logo.png' ?>" alt="C-img" class="card-img-top rounded-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']) ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span><?= $course['level'] == 'beginner' ? 'مبتدی' : ($course['level'] == 'intermediate' ? 'متوسط' : 'پیشرفته') ?></span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']) ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']) ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">هیچ دوره‌ای در این دسته یافت نشد.</div>
      <?php endif; ?>
    </div>

    <h4 id="network" class="my-3">شبکه</h4>
    <div class="row">
      <?php
      $networkCourses = array_filter($courses, function ($c) {
        return stripos($c['title'], 'شبکه') !== false || stripos($c['title'], 'Network') !== false;
      });
      $networkCourses = array_slice($networkCourses, 0, 4);
      ?>
      <?php if (!empty($networkCourses)): ?>
        <?php foreach ($networkCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= $course['image'] ? '/uploads/courses' . $course['image'] : '/assets/img/logo.png' ?>" alt="C-img" class="card-img-top rounded-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']) ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span><?= $course['level'] == 'beginner' ? 'مبتدی' : ($course['level'] == 'intermediate' ? 'متوسط' : 'پیشرفته') ?></span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']) ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']) ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">هیچ دوره‌ای در این دسته یافت نشد.</div>
      <?php endif; ?>
    </div>

    <h4 id="ai" class="my-3">هوش مصنوعی</h4>
    <div class="row">
      <?php
      $aiCourses = array_filter($courses, function ($c) {
        return stripos($c['title'], 'هوش') !== false || stripos($c['title'], 'AI') !== false || stripos($c['title'], 'مصنوعی') !== false;
      });
      $aiCourses = array_slice($aiCourses, 0, 4);
      ?>
      <?php if (!empty($aiCourses)): ?>
        <?php foreach ($aiCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= $course['image'] ? '/uploads/courses' . $course['image'] : '/assets/img/logo.png' ?>" alt="C-img" class="card-img-top rounded-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']) ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span><?= $course['level'] == 'beginner' ? 'مبتدی' : ($course['level'] == 'intermediate' ? 'متوسط' : 'پیشرفته') ?></span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']) ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']) ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">هیچ دوره‌ای در این دسته یافت نشد.</div>
      <?php endif; ?>
    </div>

    <h4 id="prog" class="my-3">برنامه نویسی</h4>
    <div class="row">
      <?php
      $progCourses = array_filter($courses, function ($c) {
        return stripos($c['title'], 'برنامه') !== false || stripos($c['title'], 'Python') !== false || stripos($c['title'], 'جاوا') !== false;
      });
      $progCourses = array_slice($progCourses, 0, 4);
      ?>
      <?php if (!empty($progCourses)): ?>
        <?php foreach ($progCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= $course['image'] ? '/uploads/courses' . $course['image'] : '/assets/img/logo.png' ?>" alt="C-img" class="card-img-top rounded-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']) ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span><?= $course['level'] == 'beginner' ? 'مبتدی' : ($course['level'] == 'intermediate' ? 'متوسط' : 'پیشرفته') ?></span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']) ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']) ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">هیچ دوره‌ای در این دسته یافت نشد.</div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>