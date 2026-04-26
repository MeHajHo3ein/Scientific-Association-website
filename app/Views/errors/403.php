<?php
$pageTitle = 'Error 403';
include '../app/Views/layouts/header.php';
?>

<div class="container-fluid mb-5 mt-0">
  <div class="row d-flex justify-content-center align-items-center">
    <img src="/assets/img/403.png" alt="403-IMG" class="w-auto d-block" />
  </div>
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 text-justify text-center">
      <h1 class="">403</h1>
      <h2 class="text-danger">دسترسی محدود!</h2>
      <h2>این صفحه فقط برای کاربران مجاز در دسترس است.</h2>
      <h2>
        برگرد به صفحه
        <a href="index.html" class="link-dark text-primary"> اصلی </a>
      </h2>
    </div>
  </div>
</div>

<?php
include '../app/Views/layouts/footer.php';
?>