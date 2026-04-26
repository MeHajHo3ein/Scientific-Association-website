<?php
$pageTitle = 'Error 404';
include '../app/Views/layouts/header.php';
?>

<div class="container-fluid mb-5 mt-0">
  <div class="row d-flex justify-content-center align-items-center">
    <img src="/assets/img/404.png" alt="404-IMG" class="w-auto d-block" />
  </div>
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 text-justify text-center">
      <h1 class="">404</h1>
      <h2 class="">اوه! به نظر می‌رسد گم شدی</h2>
      <h2>صفحه‌ای که دنبالش هستی وجود ندارد.</h2>
      <h2>
        بیا برگردیم به صفحه
        <a href="/" class="link-dark text-primary"> اصلی </a>
      </h2>
    </div>
  </div>
</div>

<?php
include '../app/Views/layouts/footer.php';
?>