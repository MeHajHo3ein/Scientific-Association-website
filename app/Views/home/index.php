<?php
$pageTitle = 'انجمن علمی دانشگاه خوارزمی(شهرضا) - خانه';
$showToasts = true;
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="bg-black hero-margin">
  <div class="container">
    <br />
    <div class="row">
      <div class="col-lg-6 col-sm-12 p-3">
        <h2 class="text-white text-justify p-3">انجمن علمی کامپیوتر</h2>
        <p class="h6 text-white p-3">
          برگزاری دوره‌های تخصصی برنامه‌نویسی، هوش مصنوعی، وب و شبکه، انتشار مقالات
          علمی و برگزاری رویدادهای آموزشی برای دانشجویان و علاقه‌مندان کامپیوتر.
        </p>
        <a href="/courses" class="btn btn-outline-primary rounded-3">مشاهده دوره‌ها</a>
        <a href="/register" class="btn btn-outline-primary rounded-3 m-3">عضویت در انجمن</a>
        <div>
          <span class="text-white mx-2">+۲۰ دوره فعال </span>
          <span class="text-white mx-2">+۳۰۰ عضو</span>
          <span class="text-white mx-2">گواهینامه معتبر دانشگاهی</span>
        </div>
      </div>
      <div
        class="bg-white col-lg-6 col-sm-12 rounded-3 justify-content-end py-4 border-start border-primary border-5">
        <h3 class="py-2 d-inline-block">دوره در حال ثبت‌نام</h3>
        <span class="badge bg-success rounded-3">در حال ثبت‌نام</span>

        <p>وب دولوپمنت با JavaScript و React</p>
        <p class="mx-2">
          مدرس:
          <span>دکتر الف</span>
        </p>
        <p class="mx-2">
          سطح:
          <span>متوسط</span>
        </p>
        <p class="mx-2">
          شروع:
          <span> ۲۰ اردیبهشت</span>
        </p>
        <a href="" class="link-primary text-decoration-none">مشاهده جزئیات دوره</a>
      </div>
    </div>
    <br />
  </div>
</div>

<!-- Starting Courses -->
<div class="bg-secondary-subtle py-5">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2 row">دوره‌های در حال برگزاری</h4>
      <p>منتخب دوره‌های فعال انجمن علمی کامپیوتر</p>
    </span>

    <a
      href="/courses"
      class="link-dark text-decoration-none text-sm-center text-primary">مشاهده همه دوره‌ها</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div
          class="bg-white py-3 rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برنامه‌نویسی پیشرفته با Python</h5>
          <p class="mx-2">
            مدرس:
            <span>دکتر الف</span>
          </p>
          <p class="mx-2">
            سطح:
            <span>متوسط</span>
          </p>
          <p class="text-justify">
            آموزش مفاهیم پیشرفته پایتون، کار با کتابخانه‌ها، تست و معماری نرم‌افزار.
          </p>
          <p class="d-flex justify-content-between">
            <span class="badge bg-success rounded-3">در حال ثبت‌نام</span>
            <span>رایگان</span>
          </p>
          <a href="/courses_detail" class="link-primary text-decoration-none">مشاهده جزئیات دوره</a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div
          class="bg-white py-3 rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برنامه‌نویسی پیشرفته با Python</h5>
          <p class="mx-2">
            مدرس:
            <span>دکتر الف</span>
          </p>
          <p class="mx-2">
            سطح:
            <span>متوسط</span>
          </p>
          <p class="text-justify">
            آموزش مفاهیم پیشرفته پایتون، کار با کتابخانه‌ها، تست و معماری نرم‌افزار.
          </p>
          <p class="d-flex justify-content-between">
            <span class="badge bg-warning rounded-3">نزدیک به تکمیل ظرفیت</span>
            <span>رایگان</span>
          </p>
          <a href="/courses_detail" class="link-primary text-decoration-none">مشاهده جزئیات دوره</a>
        </div>
      </div>

      <div class="col-lg-4 col-sm-12 rounded-3">
        <div
          class="bg-white py-3 rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برنامه‌نویسی پیشرفته با Python</h5>
          <p class="mx-2">
            مدرس:
            <span>دکتر الف</span>
          </p>
          <p class="mx-2">
            سطح:
            <span>متوسط</span>
          </p>
          <p class="text-justify">
            آموزش مفاهیم پیشرفته پایتون، کار با کتابخانه‌ها، تست و معماری نرم‌افزار.
          </p>
          <p class="d-flex justify-content-between">
            <span class="badge bg-primary rounded-3">در حال برگزاری</span>
            <span>رایگان</span>
          </p>
          <a href="/courses_detail" class="link-primary text-decoration-none">مشاهده جزئیات دوره</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Last Articles  -->
<div class="py-5">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2 row">آخرین مقالات و مطالب علمی</h4>
      <p>جدیدترین مقالات منتشر شده توسط اعضا و اساتید</p>
    </span>
    <a
      href="/articles"
      class="link-dark text-decoration-none text-sm-center text-primary">مشاهده همه مقالات</a>
  </div>
  <div class="container">
    <div class="row">
      <?php if (empty($homeArticles)): ?>
        <div class="col-12">
          <div class="text-center">هنوز مقاله‌ای منتشر نشده است.</div>
        </div>
      <?php else: ?>
        <?php foreach ($homeArticles as $article): ?>
          <div class="col-lg-4 col-sm-12">
            <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
              <h5><?= htmlspecialchars($article['title']) ?></h5>
              <p class="mx-2">
                <span>نویسنده: <?= htmlspecialchars($article['author_name']) ?></span>
                |
                <span>تاریخ: <?= toJalali($article['created_at'], 'Y/m/d') ?></span>
              </p>
              <p class="text-justify">
                <?= htmlspecialchars(mb_substr($article['summary'] ?? $article['content'], 0, 100)) ?>...
              </p>
              <a href="/articles/<?= urlencode($article['slug']) ?>" class="link-primary text-decoration-none">ادامه مطلب</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- News -->
<div class="py-5 bg-secondary-subtle">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2 row">آخرین اخبار و اطلاعیه‌ها</h4>
      <p>با جدیدترین رویدادها و اطلاعیه‌های انجمن همراه باشید</p>
    </span>
    <a
      href="/news"
      class="link-dark text-decoration-none text-sm-center text-primary">مشاهده همه اخبار</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div
          class="py-3 bg-white rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برگزاری کارگاه React برای دانشجویان</h5>
          <p class="mx-2">
            <span> ۱۴۰۳/۰۲/۱۰ </span>
            |
            <span>کارگاه</span>
          </p>
          <p class="text-justify">
            ثبت‌نام کارگاه فشرده React آغاز شد. ظرفیت محدود است
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div
          class="py-3 bg-white rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برگزاری کارگاه React برای دانشجویان</h5>
          <p class="mx-2">
            <span> ۱۴۰۳/۰۲/۱۰ </span>
            |
            <span>کارگاه</span>
          </p>
          <p class="text-justify">
            ثبت‌نام کارگاه فشرده React آغاز شد. ظرفیت محدود است
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div
          class="py-3 bg-white rounded-3 mb-3 p-3 border-start border-primary border-5">
          <h5>برگزاری کارگاه React برای دانشجویان</h5>
          <p class="mx-2">
            <span> ۱۴۰۳/۰۲/۱۰ </span>
            |
            <span>کارگاه</span>
          </p>
          <p class="text-justify">
            ثبت‌نام کارگاه فشرده React آغاز شد. ظرفیت محدود است
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Files for Download -->
<div class="py-5">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2 row">فایل‌های آموزشی جدید</h4>
      <p>PDF، ویدیو، اسلاید و پروژه‌های آموزشی تازه اضافه‌شده</p>
    </span>
    <a
      href="/offline-courses"
      class="link-dark text-decoration-none text-sm-center text-primary">
      مشاهده همه فایل‌ها
    </a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>اسلایدهای دوره Python پیشرفته</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>اسلاید</span>
            |
            <span> دسته:</span>
            <span>Programming</span>
          </p>
          <a href="" class="link-primary text-decoration-none">دانلود</a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>ویدیوی معرفی شبکه‌های عصبی</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>ویدیو</span>
            |
            <span> دسته:</span>
            <span>AI</span>
          </p>
          <a href="" class="link-primary text-decoration-none">دانلود</a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>PDF مبانی طراحی وب</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>PDF</span>
            |
            <span> دسته:</span>
            <span>Web</span>
          </p>
          <a href="" class="link-primary text-decoration-none">دانلود</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Teachers -->
<div class="py-5 bg-secondary-subtle">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2">اساتید و مدرسین انجمن</h4>
      <p>آشنایی با مدرسین دوره‌ها و اساتید مشاور</p>
    </span>
    <a
      href="/cult"
      class="link-dark text-decoration-none text-sm-center text-primary">
      رفتن به انجمن
    </a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="py-3 bg-white rounded-3 mb-3 p-3">
          <img src="/assets/img/logo(whit text).png" alt="" class="img-fluid" />
          <h5>دکتر الف</h5>
          <p class="mx-2">
            <span class="border-end">استاد مشاور</span>
            <span>هوش مصنوعی</span>
          </p>
          <p class="text-justify">email@example.com</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 bg-white rounded-3 mb-3 p-3">
          <img src="/assets/img/logo(whit text).png" alt="" class="img-fluid" />
          <h5>مهندس ب</h5>
          <p class="mx-2">
            <span>مدرس دوره‌های برنامه‌نویسی</span>
          </p>
          <p class="text-justify">linkedin.com/in/sample</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 bg-white rounded-3 mb-3 p-3">
          <img src="/assets/img/logo(whit text).png" alt="" class="img-fluid" />
          <h5>مهندس ب</h5>
          <p class="mx-2">
            <span>مدرس دوره‌های برنامه‌نویسی</span>
          </p>
          <p class="text-justify">linkedin.com/in/sample</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Events -->
<div class="py-5">
  <div class="container d-flex justify-content-between">
    <span class="row d-flex">
      <h4 class="mx-2 row">تقویم رویدادها</h4>
      <p>رویدادهای پیش رو و مهم انجمن</p>
    </span>
    <a
      href="/news/#events"
      class="link-dark text-decoration-none text-sm-center text-primary">جزئیات همه رویدادها</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>کارگاه Git و GitHub</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>کارگاه</span>
            |
            <span>تاریخ:</span>
            <span>۱۴۰۳/۰۳/۰۵</span>
          </p>
          <p class="text-justify">
            آموزش کاربردی کنترل نسخه و کار گروهی با Git و GitHub.
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>کارگاه Git و GitHub</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>کارگاه</span>
            |
            <span> تاریخ:</span>
            <span>۱۴۰۳/۰۳/۰۵</span>
          </p>
          <p class="text-justify">
            آموزش کاربردی کنترل نسخه و کار گروهی با Git و GitHub.
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 rounded-3">
        <div class="py-3 rounded-3 mb-3 p-3 border-start border-5">
          <h5>کارگاه Git و GitHub</h5>
          <p class="mx-2">
            <span> نوع:</span>
            <span>کارگاه</span>
            |
            <span> تاریخ:</span>
            <span>۱۴۰۳/۰۳/۰۵</span>
          </p>
          <p class="text-justify">
            آموزش کاربردی کنترل نسخه و کار گروهی با Git و GitHub.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Force to Join -->
<div class="bg-dark my-3">
  <div class="container py-3">
    <div class="row">
      <div class="col-lg-6 col-sm-12">
        <h5 class="text-white">عضو انجمن علمی کامپیوتر شوید</h5>
        <p class="text-white text-justify">
          با عضویت در انجمن، در دوره‌ها، رویدادها، مسابقات و پروژه‌های گروهی شرکت کنید
          و از مزایای ویژه دانشجویی بهره‌مند شوید.
        </p>
      </div>
      <div class="d-flex col-lg-6 col-sm-12 align-self-center justify-content-center">
        <a
          href="/register"
          class="btn btn-outline-primary rounded-3 p-2 me-lg-1 m-1">ثبت نام</a>
        <a
          href="/cult/#faq"
          class="btn btn-outline-warning rounded-3 p-2 me-lg-1 m-1">سؤالات متداول</a>
      </div>
    </div>
  </div>
</div>

<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>