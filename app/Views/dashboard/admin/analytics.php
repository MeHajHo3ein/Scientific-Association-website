<?php
$pageTitle = 'پنل شخصی - آمار';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$userStats = $userStats ?? ['students' => 0, 'teachers' => 0, 'admins' => 0];
$contentStats = $contentStats ?? ['courses' => 0, 'articles' => 0, 'files' => 0, 'notifications' => 0, 'neas' => 0];
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">گزارش‌ها و آمار</h3>
  <div class="container overflow-auto">
    <div class="card shadow-sm mt-3">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">نمودار تعداد کابر های سایت</h5>
      </div>
      <div class="card-body">
        <div class="chart-container">
          <canvas id="UsersChart"
            data-students="<?= $userStats['students'] ?>"
            data-teachers="<?= $userStats['teachers'] ?>"
            data-admins="<?= $userStats['admins'] ?>">
          </canvas>
        </div>
      </div>
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">نمودار تعداد محتوا آپلودی داخل سایت</h5>
      </div>
      <div class="card-body">
        <div class="chart-container">
          <canvas id="ContentChart"
            data-courses="<?= $contentStats['courses'] ?>"
            data-articles="<?= $contentStats['articles'] ?>"
            data-files="<?= $contentStats['files'] ?>"
            data-notifications="<?= $contentStats['notifications'] ?>"
            data-neas="<?= $contentStats['neas'] ?>">
          </canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/assets/js/chart.js"></script>
<script src="/assets/js/Custom-chart.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>