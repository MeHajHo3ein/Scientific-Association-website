<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - گواهی';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center bg-white shadow-lg p-5 rounded-3 border-5 border-primary border-start ">
    <h1>صحت‌سنجی گواهی‌نامه</h1>
    <p>برای بررسی اعتبار گواهی، کد یکتا را وارد کنید. سپس به صفحه نتیجه صحت‌سنجی منتقل می‌شوید.</p>
    <form class="d-flex mx-auto my-3 my-xxl-0 search-box" role="search">
      <input
        class="form-control rounded-3 mx-4"
        type="search"
        placeholder="کد گواهی را وارد کنید..." />
      <a
        href="certificate-view.html"
        class="btn btn-primary rounded-3 "
        type="submit">
        بررسی
      </a>
    </form>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <h3 class="text py-3">
    دروسی که با قبولی در آن‌ها گواهی صادر می‌شود
  </h3>
  <div class="card rounded-3 border-0 shadow-sm mt-4">
    <div class="card-body bg-white border-5 border-primary border-start rounded-3">
      <h4 class="card-title">مبانی برنامه‌نویسی و الگوریتم</h4>
      <div class="d-flex justify-content-between flex-sm-row flex-column">
        <p class="card-text">مدرک معتبر سطح مقدماتی با تمرکز بر منطق برنامه‌نویسی، حل مسئله و
          ساخت پروژه‌های ساده.
        </p>
        <a href="certificate-test.html" class="btn btn-outline-primary border-1 rounded-3"> شروع آزمون</a>
      </div>
    </div>
  </div>
  <div class="card rounded-3 border-0 shadow-sm mt-4">
    <div class="card-body bg-white border-5 border-primary border-start rounded-3">
      <h4 class="card-title">مبانی برنامه‌نویسی و الگوریتم</h4>
      <div class="d-flex justify-content-between flex-sm-row flex-column">
        <p class="card-text">مدرک معتبر سطح مقدماتی با تمرکز بر منطق برنامه‌نویسی، حل مسئله و
          ساخت پروژه‌های ساده.
        </p>
        <a href="certificate-test.html" class="btn btn-outline-primary border-1 rounded-3"> شروع آزمون</a>
      </div>
    </div>
  </div>
  <div class="card rounded-3 border-0 shadow-sm mt-4">
    <div class="card-body bg-white border-5 border-primary border-start rounded-3">
      <h4 class="card-title">مبانی برنامه‌نویسی و الگوریتم</h4>
      <div class="d-flex justify-content-between flex-sm-row flex-column">
        <p class="card-text">مدرک معتبر سطح مقدماتی با تمرکز بر منطق برنامه‌نویسی، حل مسئله و
          ساخت پروژه‌های ساده.
        </p>
        <a href="certificate-test.html" class="btn btn-outline-primary border-1 rounded-3"> شروع آزمون</a>
      </div>
    </div>
  </div>


</div>

<br>
<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>