<?php
$pageTitle = 'انجمن علمی دانشگاه خوارزمی(شهرضا) - انجمن';
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>انجمن</h1>
    <p>انجمن تخصصی مقالات علوم کامپیوتر و برنامه‌نویسی دانشگاه خوارزمی(شهرضا)</p>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <h3 class="my-3">استادان عضو انجمن</h3>
  <div
    class="row rounded-3 border-5 bg-white p-4 shadow-sm border-start border-primary align-items-center">
    <div class="col-lg-6 col-sm-12 text-center">
      <h2>نام : حسام رحیمی</h2>
      <p class="h5">سن : 20</p>
      <p class="h5">رشته تحصیلی : کامپیوتر</p>
      <p class="h5">سطح تحصیلات : فوق دیپلم</p>
      <p class="h5">
        دوره های در حال تدریس :
        <span>python</span>
        ,
        <span>Java</span>
      </p>
    </div>
    <div class="col-lg-6 col-sm-12 d-flex justify-content-center">
      <img
        src="/assets/img/logo(whit%20text).png"
        alt="T-IMG"
        class="rounded-3 w-50 h-100" />
    </div>
  </div>
  <div class="row mt-5">
    <h4>برترین دانشجویان انجمن</h4>
    <div class="col-lg-4 col-sm-12">
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-3">
        <img
          src="/assets/img/logo(whit%20text).png"
          class="img-thumbnail border-0"
          alt="ST_Img" />
        <hr />
        <h4>حسام رحیمی</h4>
        <p class="h5">
          تعداد گواهی دریافتی:
          <span>5</span>
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12">
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-3">
        <img
          src="/assets/img/logo(whit%20text).png"
          class="img-thumbnail border-0"
          alt="ST_Img" />
        <hr />
        <h4>حسام رحیمی</h4>
        <p class="h5">
          تعداد گواهی دریافتی:
          <span>4</span>
        </p>
      </div>
    </div>
    <div class="col-lg-4 col-sm-12">
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-3">
        <img
          src="/assets/img/logo(whit%20text).png"
          class="img-thumbnail border-0"
          alt="ST_Img" />
        <hr />
        <h4>حسام رحیمی</h4>
        <p class="h5">
          تعداد گواهی دریافتی:
          <span>3</span>
        </p>
      </div>
    </div>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>