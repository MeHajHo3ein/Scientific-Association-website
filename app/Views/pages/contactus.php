<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - ارتباط با ما';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>ارتباط با ما</h1>
    <p>برای دریافت اطلاعات بیشتر، همکاری یا ارسال پیشنهادات با ما در تماس باشید.</p>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-12 mt-1">
      <div class="bg-white p-5 rounded-3 w-100 h-100">
        <h4 class="text-primary">اطلاعات تماس</h4>
        <h5 class="">ایمیل رسمی:</h5>
        <p class="h4 text-secondary text-wrap"><?= htmlspecialchars(setting('contact_email', 'cs.science.association@university.ac.ir')) ?></p>
        <h5 class="">آدرس:</h5>
        <p class="text-secondary"><?= htmlspecialchars(setting('contact_address', 'دانشکده مهندسی کامپیوتر – طبقه دوم – دفتر انجمن علمی')) ?></p>
        <h5 class="">تلفن:</h5>
        <p class="text-secondary"><?= htmlspecialchars(setting('contact_phone', '03137747312')) ?></p>
        <h5 class="">ساعات پاسخ‌گویی:</h5>
        <p class="text-secondary">شنبه تا چهارشنبه | ۸ الی ۱۴</p>
        <h4 class="text-primary">شبکه‌های اجتماعی</h4>
        <?php
        $socialMedias = [];
        try {
          $settingModel = new App\Models\Setting();
          $socialMedias = $settingModel->getAllSocialMedias();
        } catch (Exception $e) {
          $socialMedias = [];
        }
        ?>
        <?php if (!empty($socialMedias)): ?>
          <div class="d-flex p-4 justify-content-between">
            <?php foreach ($socialMedias as $social): ?>
              <a href="<?= htmlspecialchars($social['link']) ?>" class="text-primary link-dark text-decoration-none" target="_blank"><?= htmlspecialchars($social['name']) ?></a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <span class="d-block text-muted">هیچ شبکه اجتماعی ای تعریف نشده</span>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 mt-1">
      <div class="bg-white p-5 rounded-3 w-100 h-100">
        <form class="d-block mx-auto search-box">
          <h4 class="text-primary">ارسال پیام</h4>
          <input
            class="form-control rounded-2 mt-4"
            placeholder="نام و نام خانوادگی را وارد کنید..." />
          <input
            class="form-control rounded-2 mt-4"
            placeholder=" ایمیل دانشگاهی خود را وارد کنید..." />
          <input
            class="form-control rounded-2 mt-4"
            placeholder="موضوع پیام را وارد کنید..." />
          <textarea
            name=""
            id=""
            cols=""
            rows=""
            class="form-control form rounded-2 mt-4 text-dark"
            placeholder="متن پیام خود را وارد کنید...">
              </textarea>
          <button class="btn btn-primary rounded-3 mt-4 w-100" type="submit">
            ارسال
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>