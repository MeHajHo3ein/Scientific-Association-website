<!-- Footer -->
<footer class="bg-dark">
  <div class="container py-3 border-bottom">
    <div class="row text-white d-flex">
      <div class="col-lg-4 col-sm-12 text-white">
        <h5><?= htmlspecialchars(setting('site_name', 'انجمن علمی کامپیوتر')) ?></h5>
        <p class="text-justify">
          انجمن علمی دانشجویان کامپیوتر، برگزارکننده دوره‌ها و رویدادهای علمی و پژوهشی
          در حوزه فناوری اطلاعات و مهندسی کامپیوتر.
        </p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center">
        <h5>لینک‌های مفید</h5>
        <a class="d-block link-primary text-decoration-none text-white" href="/register">عضویت در انجمن</a>
        <a class="d-block link-primary text-decoration-none text-white" href="/certificates">استعلام گواهینامه</a>
        <a class="d-block link-primary text-decoration-none text-white" href="/offline-courses">فایل‌های آموزشی</a>
        <a class="d-block link-primary text-decoration-none text-white" href="/contactus">تماس با ما</a>
      </div>
      <div class="col-lg-4 col-sm-12 text-center">
        <h5>شبکه‌های اجتماعی</h5>
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
          <?php foreach ($socialMedias as $social): ?>
            <a class="d-block link-primary text-decoration-none text-white mb-1" href="<?= htmlspecialchars($social['link']) ?>" target="_blank"><?= htmlspecialchars($social['name']) ?></a>
          <?php endforeach; ?>
        <?php else: ?>
          <span class="d-block text-white">هیچ شبکه اجتماعی ای تعریف نشده</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="text-white text-center p-3">
    © <?= htmlspecialchars(setting('site_name', 'انجمن علمی رشته کامپیوتر')) ?> - دانشگاه خوارزمی(شهرضا)
  </div>
</footer>