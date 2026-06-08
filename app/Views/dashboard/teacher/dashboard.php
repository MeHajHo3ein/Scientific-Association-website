<?php
$pageTitle = 'پنل شخصی';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$isTeacher = (isset($_SESSION['role']) && $_SESSION['role'] === 'teacher');
$isTeacherUpdated = ($isTeacher && isset($_SESSION['profile_updated']) && $_SESSION['profile_updated'] == 1);
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <!--Hero-->
    <p class="bg-white my-3 p-3 text-dark">
      <span><?= htmlspecialchars($_SESSION['full_name'] ?? "کاربر"); ?></span>
      خوش آمدید به پنل مدیریت انجمن علمی.
    </p>
    <p class="bg-white my-3 p-3 text-dark">
      از منوی سمت راست بخش مورد نظر را انتخاب کنید.
    </p>
    <!-- Dashboard -->
    <div class="card shadow-sm p-4 border-0">
      <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">اطلاعات حساب کاربری</h4>
      </div>

      <!-- *** Alert *** -->
      <!-- Success -->
      <?php if (isset($_SESSION['success'])): ?>
        <div id="myAlert" class="alert alert-success alert-dismissible fade m-3 show" role="alert">
          <?= $_SESSION['success']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <!-- Error -->
      <?php if (isset($_SESSION['error'])): ?>
        <div id="myAlert" class="alert alert-danger alert-dismissible fade m-3 show" role="alert">
          <?= $_SESSION['error']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <!-- Info -->
      <?php if (isset($_SESSION['info'])): ?>
        <div id="myAlert" class="alert alert-info alert-dismissible fade m-3 show" role="alert">
          <?= $_SESSION['info']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['info']); ?>
      <?php endif; ?>

      <!-- Warning -->
      <?php if (isset($_SESSION['warning'])): ?>
        <div id="myAlert" class="alert alert-info alert-dismissible fade m-3 show" role="alert">
          <?= $_SESSION['warning']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <!-- Only Teacher - Before update -->
      <?php if ($isTeacher && !$isTeacherUpdated): ?>
        <div id="myAlert" class="alert alert-info alert-dismissible fade m-3 show" role="alert">
          شما فقط <strong> یک دفعه</strong> می توانید اطلاعات خود را تغییر دهید.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <!-- Only Teacher - After update -->
      <?php if ($isTeacherUpdated && !isset($_SESSION['success']) && !isset($_SESSION['warning'])): ?>
        <div id="myAlert" class="alert alert-info alert-dismissible fade m-3 show" role="alert">
          شما قبلاً اطلاعات خود را ویرایش کرده‌اید. امکان ویرایش مجدد وجود ندارد.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <form id="registerForm" action="/panel/update-profile" method="POST" novalidate>
        <!-- Full Name -->
        <div class="mb-3">
          <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>
          <div class="input-group">
            <span class="input-group-text bg-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor"
                class="text-secondary"
                viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
              </svg>
            </span>
            <input
              type="text"
              class="form-control rounded-end-2"
              id="fullName"
              name="fullName"
              placeholder="نام کامل خود را وارد کنید"
              value="<?= htmlspecialchars($_SESSION['full_name'] ?? "کاربر"); ?>"
              required
              minlength="3"
              <?= $isTeacherUpdated ? 'disabled' : ''; ?> />
            <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>
            <div class="valid-feedback">نام معتبر است.</div>
          </div>
        </div>
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-medium">ایمیل</label>
          <div class="input-group">
            <span class="input-group-text bg-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor"
                class="text-secondary"
                viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z" />
              </svg>
            </span>
            <input
              type="email"
              class="form-control rounded-end-2"
              id="email"
              name="email"
              placeholder="example@gmail.com"
              value="<?= htmlspecialchars($_SESSION['email']); ?>"
              required
              <?= $isTeacherUpdated ? 'disabled' : ''; ?> />
            <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>
            <div class="valid-feedback">ایمیل معتبر است.</div>
          </div>
        </div>
        <!--Phone Number-->
        <div class="mb-3">
          <label for="mobile" class="form-label fw-medium">شماره تلفن</label>
          <div class="input-group">
            <span class="input-group-text bg-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor"
                class="text-secondary"
                viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z" />
              </svg>
            </span>
            <input
              type="tel"
              class="form-control rounded-end-2"
              id="mobile"
              name="mobile"
              placeholder="09xxxxxxxxx"
              value="<?= htmlspecialchars($_SESSION['mobile']); ?>"
              maxlength="11"
              required
              <?= $isTeacherUpdated ? 'disabled' : ''; ?> />
            <div class="invalid-feedback">لطفاً یک شماره معتبر وارد کنید.</div>
            <div class="valid-feedback">شماره معتبر است.</div>
          </div>
        </div>
        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label fw-medium">رمز عبور</label>
          <div class="input-group">
            <span class="input-group-text bg-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor"
                class="text-secondary"
                viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
              </svg>
            </span>
            <input
              type="password"
              class="form-control border-end-0"
              id="password"
              name="password"
              placeholder="حداقل ۸ کاراکتر"
              minlength="8"
              <?= $isTeacherUpdated ? 'disabled' : ''; ?> />
            <button class="input-group-text toggle-password bg-white" type="button" id="togglePassword"
              aria-label="نمایش رمز">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor"
                class="text-secondary" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
              </svg>
            </button>
          </div>
          <!-- Strength bar -->
          <div class="strength-bar mt-2">
            <div class="strength-fill" id="strengthFill"></div>
          </div>
          <div class="mt-1">
            <small id="strengthLabel" class="text-muted"></small>
          </div>
          <div class="invalid-feedback d-block small" id="passwordError"></div>
          <p class="text-secondary">
            اگر نمی‌خواهید رمزتان تغییر کند، این فیلد را
            <span class="text-dark text-decoration-underline">خالی</span> بگذارید.
          </p>
        </div>
        <!-- Submit -->
        <?php if (!$isTeacherUpdated): ?>
          <button type="submit" class="btn btn-primary w-100 fw-semibold py-2" id="submitBtn">
            ثبت‌تغییرات
          </button>
        <?php else: ?>
          <button type="button" class="btn btn-secondary w-100 fw-semibold py-2" style="cursor: not-allowed;">
            امکان ویرایش وجود ندارد
          </button>
        <?php endif; ?>
      </form>
    </div>

  </div>
</div>

<script src="/assets/js/dashboard-profile.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>