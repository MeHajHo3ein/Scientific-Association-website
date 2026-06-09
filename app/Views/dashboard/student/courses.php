<?php
$pageTitle = 'پنل شخصی - دروس';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">دوره های خریداری شده</h3>

    <div class="row">
      <?php if (empty($purchasedCourses)): ?>
        <div class="col-12">
          <div class="text-center">شما هیچ دوره‌ای خریداری نکرده‌اید.</div>
        </div>
      <?php else: ?>
        <?php foreach ($purchasedCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card d-flex m-2 p-0 border-0 rounded-0">
              <div class="card-body border-start border-primary border-5">
                <img
                  src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>"
                  alt="C-img"
                  class="card-img-top rounded-0" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']) ?></span>
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
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']) ?></span>
                  <span>ساعت</span>
                </p>
                <a
                  href="/courses/<?= urlencode($course['slug']) ?>"
                  class="btn btn-outline-primary border-1 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>