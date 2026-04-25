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
  <div
    class="row rounded-4 border-5 bg-white p-4 shadow-sm border-start border-primary align-items-center">
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
        class="rounded-4 w-50 h-100" />
    </div>
  </div>
  <div class="row mt-5">
    <h4>برترین دانشجویان انجمن</h4>
    <div class="col-lg-4 col-sm-12">
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-4">
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
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-4">
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
      <div class="m-5 p-5 bg-white border-5 border-primary border-start rounded-4">
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

<!-- Q and A -->
<h2 class="h2 text-center text-dark m-4 pt-5">سوالات متداول</h2>
<div class="container mb-5">
  <div class="accordion m-1" id="accordion-1">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button
          class="accordion-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapse-one">
          چگونه می‌توانم عضو انجمن علمی شوم؟
        </button>
      </h2>
      <div
        class="accordion-collapse collapse collapsed"
        id="collapse-one"
        data-bs-parent="accordion-1">
        <div class="accordion-body">
          برای عضویت کافی است فرم عضویت را در بخش عضویت سایت پر کنید. درخواست‌ها توسط
          شورای مرکزی بررسی و نتیجه از طریق ایمیل دانشگاهی اعلام می‌شود.
        </div>
      </div>
    </div>
  </div>
  <div class="accordion m-1" id="accordion-2">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button
          class="accordion-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapse-two">
          آیا عضویت در انجمن رایگان است؟
        </button>
      </h2>
      <div
        class="accordion-collapse collapse collapsed"
        id="collapse-two"
        data-bs-parent="accordion-2">
        <div class="accordion-body">
          بله، عضویت در انجمن علمی برای تمام دانشجویان دانشگاه رایگان است و هیچ
          هزینه‌ای دریافت نمی‌شود.
        </div>
      </div>
    </div>
  </div>
  <div class="accordion m-1" id="accordion-3">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button
          class="accordion-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapse-three">
          تفاوت بین عضو عادی و عضو فعال چیست؟
        </button>
      </h2>
      <div
        class="accordion-collapse collapse collapsed"
        id="collapse-three"
        data-bs-parent="accordion-3">
        <div class="accordion-body">
          اعضای عادی در سامانه ثبت‌نام می‌کنند و از اطلاعیه‌ها و برنامه‌ها آگاه
          می‌شوند، اما اعضای فعال به‌صورت مستمر در فعالیت‌ها، کارگاه‌ها یا پروژه‌های
          انجمن مشارکت دارند.
        </div>
      </div>
    </div>
  </div>
  <div class="accordion m-1" id="accordion-4">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button
          class="accordion-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapse-four">
          چطور می‌توانم در کارگاه‌ها و رویدادها شرکت کنم؟
        </button>
      </h2>
      <div
        class="accordion-collapse collapse collapsed"
        id="collapse-four"
        data-bs-parent="accordion-4">
        <div class="accordion-body">
          در بخش «رویدادها» زمان و جزئیات هر برنامه اعلام می‌شود. شما می‌توانید با
          ورود به داشبورد خود، رویداد مورد نظر را انتخاب و ثبت‌نام کنید.
        </div>
      </div>
    </div>
  </div>
  <div class="accordion m-1" id="accordion-5">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button
          class="accordion-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapse-five">
          آیا انجمن مدرک یا گواهی‌نامه صادر می‌کند؟
        </button>
      </h2>
      <div
        class="accordion-collapse collapse collapsed"
        id="collapse-five"
        data-bs-parent="accordion-5">
        <div class="accordion-body">
          بله، در پایان برخی دوره‌ها و مدارس تابستانی، برای شرکت‌کنندگان فعال
          گواهی‌نامه رسمی از طرف انجمن علمی صادر می‌شود.
        </div>
      </div>
    </div>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>