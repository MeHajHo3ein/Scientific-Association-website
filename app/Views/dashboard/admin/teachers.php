<?php
$pageTitle = 'پنل شخصی - استادان';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <div class="row table-responsive overflow-visible">
      <h3 class="text-primary">مدرسین</h3>
      <table class="table table-bordered table-hover table-striped">
        <tr>
          <th>شماره</th>
          <th>نام و نام خانوادگی</th>
          <th>شماره موبایل</th>
          <th>ایمیل</th>
          <th>رمزعبور</th>
          <th>عملیات</th>
        </tr>
        <tr>
          <td>1</td>
          <td>حسام</td>
          <td>25</td>
          <td>Front-End Developer</td>
          <td>Front-End Developer</td>
          <td class="">
            <button class="btn btn-primary" onclick="openModal('editStudent')">ویرایش</button>
            <button class="btn btn-danger">حدف</button>
          </td>
        </tr>
      </table>
      <button class="btn btn-primary" onclick="openModal('addStudent')">افزودن</button>
      <div id="editStudent" class="modal">
        <div class="card shadow-sm rounded-4 p-4 border-primary">
          <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">ویرایش حساب کاربری</h4>
          </div>
          <form id="registerForm" novalidate>
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
                  placeholder="نام کامل خود را وارد کنید"
                  required
                  minlength="3">
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
                  placeholder="example@email.com"
                  required>
                <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>
                <div class="valid-feedback">ایمیل معتبر است.</div>
              </div>
            </div>
            <!--phone number-->
            <div class="mb-3">
              <label for="phonenumber" class="form-label fw-medium">شماره تلفن</label>
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
                  id="phonenumber"
                  placeholder="09131234567"
                  required>
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
                  class="form-control"
                  id="password"
                  placeholder="حداقل ۸ کاراکتر"
                  required
                  minlength="8">
              </div>
              <!-- Strength bar -->
              <div class="strength-bar mt-2">
                <div class="strength-fill" id="strengthFill"></div>
              </div>
              <div class="mt-1">
                <small id="strengthLabel" class="text-muted"></small>
              </div>
              <div class="invalid-feedback d-block small" id="passwordError"></div>
            </div>
            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">
              ثبت‌
            </button>
            <button
              class="btn btn-danger my-1 w-100"
              onclick="closeModal('editStudent')">
              بستن
            </button>
          </form>
        </div>

      </div>
      <div id="addStudent" class="modal">
        <div class="card shadow-sm rounded-4 p-4 border-primary">
          <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">افزودن حساب کاربری</h4>
          </div>
          <form id="registerForm" novalidate>
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
                  placeholder="نام کامل خود را وارد کنید"
                  required
                  minlength="3">
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
                  placeholder="example@email.com"
                  required>
                <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>
                <div class="valid-feedback">ایمیل معتبر است.</div>
              </div>
            </div>
            <!--phone number-->
            <div class="mb-3">
              <label for="phonenumber" class="form-label fw-medium">شماره تلفن</label>
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
                  id="phonenumber"
                  placeholder="09131234567"
                  required>
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
                  class="form-control"
                  id="password"
                  placeholder="حداقل ۸ کاراکتر"
                  required
                  minlength="8">
              </div>
              <!-- Strength bar -->
              <div class="strength-bar mt-2">
                <div class="strength-fill" id="strengthFill"></div>
              </div>
              <div class="mt-1">
                <small id="strengthLabel" class="text-muted"></small>
              </div>
              <div class="invalid-feedback d-block small" id="passwordError"></div>
            </div>
            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">
              ثبت‌
            </button>
            <button
              class="btn btn-danger my-1 w-100"
              onclick="closeModal('editStudent')">
              بستن
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script src="/assets/js/register.js"></script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>