<?php
$pageTitle = 'پنل شخصی';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$settings = $settings ?? [];
?>

<!-- Alerts-->
<div>
  <!-- Success -->
  <?php if (isset($_SESSION['success'])): ?>
    <div id="myAlert" class="alert alert-success alert-dismissible fade show m-3" role="alert">
      <?= $_SESSION['success']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <!-- Error -->
  <?php if (isset($_SESSION['error'])): ?>
    <div id="myAlert" class="alert alert-danger alert-dismissible fade show m-3" role="alert">
      <?= $_SESSION['error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
</div>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">تنظیمات سیستم</h3>

  <!-- Name -->
  <form action="/panel/settings/site-name" method="POST" id="rename-site" class="mt-2">
    <label for="site_name" class="form-label">نام سایت</label>
    <input
      type="text"
      class="form-control rounded-end-2"
      id="site_name"
      name="site_name"
      placeholder="نام مورد نظر خود را برای تغییر وارد کنید"
      value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>"
      minlength="3" />
    <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>
    <button type="submit" class="btn btn-primary w-100 mt-4" id="rename-submitBtn">
      ثبت‌ تغییرات
    </button>
  </form>

  <hr />

  <!-- Image -->
  <form action="/panel/settings/logo" method="POST" enctype="multipart/form-data" class="mt-2">
    <label for="site_logo" class="form-label">عکس سایت</label>
    <input
      type="file"
      class="form-control rounded-end-2"
      id="site_logo"
      name="site_logo"
      placeholder="عکس مورد نظر خود را برای تغییر وارد کنید"
      accept="image/jpeg,image/png,image/webp,image/svg+xml,image" />
    <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
    <button type="submit" class="btn btn-primary w-100 mt-4" id="img-submitBtn">
      ثبت‌ تغییرات
    </button>
  </form>

  <hr />

  <!-- Contact Us -->
  <form action="/panel/settings/contact" method="POST" class="mt-2">
    <div class="row">
      <div class="col-md-6 col-sm-12 mt-2">
        <label for="contact_phone" class="form-label">اطلاعات تماس</label>
        <input
          type="tel"
          class="form-control rounded-end-2"
          id="contact_phone"
          name="contact_phone"
          placeholder="شماره مورد نظر خود را برای تغییر وارد کنید"
          value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>"
          maxlength="11" />
        <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
      </div>

      <div class="col-md-6 col-sm-12 mt-2">
        <label for="contact_email" class="form-label">اطلاعات ایمیل</label>
        <input
          type="email"
          class="form-control rounded-end-2"
          id="contact_email"
          name="contact_email"
          placeholder="ایمیل مورد نظر خود را برای تغییر وارد کنید"
          value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>"
          minlength="3" />
        <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
      </div>

      <div class="col-md-12 col-sm-12 mt-2">
        <label for="contact_address" class="form-label">اطلاعات آدرس</label>
        <input
          type="text"
          class="form-control rounded-end-2"
          id="contact_address"
          name="contact_address"
          placeholder="آدرس مورد نظر خود را برای تغییر وارد کنید"
          value="<?= htmlspecialchars($settings['contact_address'] ?? '') ?>"
          minlength="3" />
        <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
      </div>
    </div>
    <button
      type="submit"
      class="btn btn-primary w-100 mt-4"
      id="contactus-submitBtn">
      ثبت‌ تغییرات
    </button>
  </form>

  <hr />

  <!-- Social Medias -->
  <form action="/panel/settings/social/update" method="POST" id="social-medias-site" class="mt-2">
    <div class="row">
      <?php
      $socialMedias = $socialMedias ?? [];
      for ($i = 0; $i < 3; $i++) {
        $social = $socialMedias[$i] ?? ['id' => '', 'name' => '', 'link' => ''];
        $num = $i + 1;
      ?>

        <div class="col-md-4 col-sm-12 mt-2">
          <label for="social_name_<?= $num ?>" class="form-label">نام شبکه اجتماعی</label>
          <input
            type="text"
            class="form-control rounded-end-2"
            id="social_name_<?= $num ?>"
            name="social_name_<?= $num ?>"
            placeholder="نام مورد نظر خود را برای تغییر وارد کنید"
            value="<?= htmlspecialchars($social['name'] ?? '') ?>"
            minlength="3" />
          <label for="social_link_<?= $num ?>" class="form-label">لینک شبکه اجتماعی</label>
          <input
            type="url"
            class="form-control rounded-end-2"
            id="social_link_<?= $num ?>"
            name="social_link_<?= $num ?>"
            placeholder="لینک مورد نظر خود را وارد کنید"
            value="<?= htmlspecialchars($social['link'] ?? '') ?>"
            minlength="3" />
          <input type="hidden" name="social_id_<?= $num ?>" value="<?= $social['id'] ?? '' ?>">
          <small class="C-small">اگر قصد تغییر ندارید، ورودی را خالی بگزارید.</small>
        </div>
      <?php } ?>
    </div>

    <button
      type="submit"
      class="btn btn-primary w-100 mt-4"
      id="social-medias-submitBtn">
      ثبت‌ تغییرات
    </button>
  </form>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>