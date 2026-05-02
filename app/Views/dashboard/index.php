<?php
$pageTitle = 'پنل شخصی';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <!--popup-->
    <!--            <p class="alert alert-danger alert-dismissible show fade fixed-top">-->
    <!--                لطفا اطلاعات خود را کامل کنید-->
    <!--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
    <!--            </p>-->

    <!--***** Student View ***** -->
    <!--            <div class="card my-3 py-3">-->
    <!--                <div class="card-body py-3">-->
    <!--                    <h3>حسام، خوش اومدی 👋</h3>-->
    <!--                    <p class="h5 text-secondary">در اینجا می‌تونی دوره‌ها، رویدادها و وضعیت فعالیت‌هاتو ببینی.</p>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--***** Admin/Teacher View ***** -->

    <!--            <p class="bg-white my-3 p-3 text-dark">-->
    <!--                <span>حسام رحیمی</span>-->
    <!--                خوش آمدید به پنل مدیریت انجمن علمی.-->
    <!--            </p>-->
    <!--            <p class="bg-white my-3 p-3 text-dark">-->
    <!--                از منوی سمت راست بخش مورد نظر را انتخاب کنید.-->
    <!--            </p>-->

    <!--***** Dashboard ***** -->
    <!--                        <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                            <div class="text-center mb-4">-->
    <!--                                <h4 class="fw-bold text-dark mb-1">اطلاعات حساب کاربری</h4>-->
    <!--                            </div>-->
    <!--                            <form id="registerForm" novalidate>-->
    <!--                                &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                    <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                        <input-->
    <!--                                                type="text"-->
    <!--                                                class="form-control rounded-end-2"-->
    <!--                                                id="fullName"-->
    <!--                                                placeholder="نام کامل خود را وارد کنید"-->
    <!--                                                required-->
    <!--                                                minlength="3"-->
    <!--                                        >-->
    <!--                                        <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                        <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Email &ndash;&gt;-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                    <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                        <input-->
    <!--                                                type="email"-->
    <!--                                                class="form-control rounded-end-2"-->
    <!--                                                id="email"-->
    <!--                                                placeholder="example@email.com"-->
    <!--                                                required-->
    <!--                                        >-->
    <!--                                        <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                        <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash;Phone Number&ndash;&gt;-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                    <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                        <input-->
    <!--                                                type="number"-->
    <!--                                                class="form-control rounded-end-2"-->
    <!--                                                id="phon-number"-->
    <!--                                                placeholder="09131234567"-->
    <!--                                                required-->
    <!--                                        >-->
    <!--                                        <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                        <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Password &ndash;&gt;-->
    <!--                                <div class="mb-3">-->
    <!--                                    <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                    <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                        <input-->
    <!--                                                type="password"-->
    <!--                                                class="form-control border-end-0"-->
    <!--                                                id="password"-->
    <!--                                                placeholder="حداقل ۸ کاراکتر"-->
    <!--                                                required-->
    <!--                                                minlength="8"-->
    <!--                                        >-->
    <!--                                        <button class="input-group-text toggle-password bg-white" type="button" id="togglePassword"-->
    <!--                                                aria-label="نمایش رمز">-->
    <!--                                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                                 fill="currentColor"-->
    <!--                                                 class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                            </svg>-->
    <!--                                        </button>-->
    <!--                                    </div>-->
    <!--                                    &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                    <div class="strength-bar mt-2">-->
    <!--                                        <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                    </div>-->
    <!--                                    <div class="mt-1">-->
    <!--                                        <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                    </div>-->
    <!--                                    <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Submit &ndash;&gt;-->
    <!--                                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                    ثبت‌-->
    <!--                                </button>-->
    <!--                            </form>-->
    <!--                        </div>-->

    <!-- ***** Student-Content ***** -->
    <!--            <div class="row">-->
    <!--                <div class="col-lg-4  col-md-6 col-sm-12 mt-2">-->
    <!--                    <a class="card text-decoration-none" href="#ActiveCourses">-->
    <!--                        <div class="card-body">-->
    <!--                            <h5 class="text-primary text-center p-3">دوره‌های فعال</h5>-->
    <!--                            <h5 class="text-dark text-center p-3">2</h5>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                <div class="col-lg-4  col-md-6 col-sm-12 mt-2">-->
    <!--                    <a class="card text-decoration-none" href="#FutureEvents">-->
    <!--                        <div class="card-body">-->
    <!--                            <h5 class="text-primary text-center p-3">رویدادهای آینده</h5>-->
    <!--                            <h5 class="text-dark text-center p-3">2</h5>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                <div class="col-lg-4 col-md-6 col-sm-12 mt-2">-->
    <!--                    <a class="card text-decoration-none" href="#Certificates">-->
    <!--                        <div class="card-body">-->
    <!--                            <h5 class="text-primary text-center p-3">گواهی‌نامه‌ها</h5>-->
    <!--                            <h5 class="text-dark text-center p-3">2</h5>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <h4 class="mt-5 mb-3 border-bottom border-3 border-primary text-center" id="ActiveCourses">دوره‌های در-->
    <!--                    حال گذراندن</h4>-->
    <!--                <div class="col-lg-3 col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <img src="../src/img/logo.png" alt="C-img" class="card-img-top "/>-->
    <!--                            <h5 class="card-title">طراحی مدرن Front-End</h5>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدرس:</span>-->
    <!--                                <span>حسام</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>سطح:</span>-->
    <!--                                <span>متوسط</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدت دوره:</span>-->
    <!--                                <span>20</span>-->
    <!--                                <span>ساعت</span>-->
    <!--                            </p>-->
    <!--                            <a href="../courses-detail.html" class="btn btn-outline-primary d-block  ">-->
    <!--                                مشاهده-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3  col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <img src="../src/img/logo.png" alt="C-img" class="card-img-top "/>-->
    <!--                            <h5 class="card-title">طراحی مدرن Front-End</h5>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدرس:</span>-->
    <!--                                <span>حسام</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>سطح:</span>-->
    <!--                                <span>متوسط</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدت دوره:</span>-->
    <!--                                <span>20</span>-->
    <!--                                <span>ساعت</span>-->
    <!--                            </p>-->
    <!--                            <a href="../courses-detail.html" class="btn btn-outline-primary d-block  ">-->
    <!--                                مشاهده-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3  col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <img src="../src/img/logo.png" alt="C-img" class="card-img-top "/>-->
    <!--                            <h5 class="card-title">طراحی مدرن Front-End</h5>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدرس:</span>-->
    <!--                                <span>حسام</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>سطح:</span>-->
    <!--                                <span>متوسط</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدت دوره:</span>-->
    <!--                                <span>20</span>-->
    <!--                                <span>ساعت</span>-->
    <!--                            </p>-->
    <!--                            <a href="../courses-detail.html" class="btn btn-outline-primary d-block  ">-->
    <!--                                مشاهده-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-3 col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <img src="../src/img/logo.png" alt="C-img" class="card-img-top "/>-->
    <!--                            <h5 class="card-title">طراحی مدرن Front-End</h5>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدرس:</span>-->
    <!--                                <span>حسام</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>سطح:</span>-->
    <!--                                <span>متوسط</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text">-->
    <!--                                <span>مدت دوره:</span>-->
    <!--                                <span>20</span>-->
    <!--                                <span>ساعت</span>-->
    <!--                            </p>-->
    <!--                            <a href="../courses-detail.html" class="btn btn-outline-primary d-block  ">-->
    <!--                                مشاهده-->
    <!--                            </a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <h4 class="mt-5 mb-3 border-bottom border-3 border-primary text-center" id="FutureEvents">-->
    <!--                    رویداد های آینده-->
    <!--                </h4>-->
    <!--                <div class="card d-flex p-0 mt-1">-->
    <!--                    <div-->
    <!--                            class="card-body d-flex p-0 mt-1 justify-content-between align-items-center  p-3 "-->
    <!--                    >-->
    <!--                        <h5> کارگاه Git & GitHub </h5>-->
    <!--                        <h5 class="text-primary">10/12/1404</h5>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="card d-flex p-0 mt-1">-->
    <!--                    <div-->
    <!--                            class="card-body d-flex p-0 mt-1 justify-content-between align-items-center  p-3 "-->
    <!--                    >-->
    <!--                        <h5> کارگاه Git & GitHub </h5>-->
    <!--                        <h5 class="text-primary">10/12/1404</h5>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <h4 class="mt-5 mb-3 border-bottom border-3 border-primary text-center" id="Certificates">-->
    <!--                    گواهی های کسب شده-->
    <!--                </h4>-->
    <!--                <div class="col-lg-4 col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <h5> کارگاه Git & GitHub </h5>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>نمره:</span>-->
    <!--                                <span>89</span>-->
    <!--                            </p>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>تاریخ دریافت:</span>-->
    <!--                                <span>10/2/1404</span>-->
    <!--                            </p>-->
    <!--                            <a href="../certificate-view.html"-->
    <!--                               class="d-block text-decoration-none btn btn-outline-primary my-3">مشاهده</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-4 col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <h5> کارگاه Git & GitHub </h5>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>نمره:</span>-->
    <!--                                <span>89</span>-->
    <!--                            </p>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>تاریخ دریافت:</span>-->
    <!--                                <span>10/2/1404</span>-->
    <!--                            </p>-->
    <!--                            <a href="../certificate-view.html"-->
    <!--                               class="d-block text-decoration-none btn btn-outline-primary my-3">مشاهده</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-4 col-md-6 col-sm-12">-->
    <!--                    <div class="card d-flex p-0 mt-1">-->
    <!--                        <div-->
    <!--                                class="card-body"-->
    <!--                        >-->
    <!--                            <h5> کارگاه Git & GitHub </h5>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>نمره:</span>-->
    <!--                                <span>89</span>-->
    <!--                            </p>-->
    <!--                            <p class="p-2">-->
    <!--                                <span>تاریخ دریافت:</span>-->
    <!--                                <span>10/2/1404</span>-->
    <!--                            </p>-->
    <!--                            <a href="../certificate-view.html"-->
    <!--                               class="d-block text-decoration-none btn btn-outline-primary my-3">مشاهده</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!-- ***** Students/Edit ***** -->
    <!--            <div class="row table-responsive overflow-visible">-->
    <!--                <h3 class="text-primary">دانشجویان</h3>-->
    <!--                <table class="table table-bordered table-hover table-striped">-->
    <!--                    <tr>-->
    <!--                        <th>نام و نام خانوادگی</th>-->
    <!--                        <th>شماره موبایل</th>-->
    <!--                        <th>ایمیل</th>-->
    <!--                        <th>رمزعبور</th>-->
    <!--                        <th>عملیات</th>-->
    <!--                    </tr>-->
    <!--                    <tr>-->
    <!--                        <td>حسام</td>-->
    <!--                        <td>25</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td class="">-->
    <!--                            <button class="btn btn-primary" onclick="openModal('editStudent')">ویرایش</button>-->
    <!--                            <button class="btn btn-danger">حدف</button>-->
    <!--                        </td>-->
    <!--                    </tr>-->
    <!--                </table>-->
    <!--                <button class="btn btn-primary" onclick="openModal('addStudent')">افزودن</button>-->
    <!--                <div id="editStudent" class="modal">-->
    <!--                    <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                        <div class="text-center mb-4">-->
    <!--                            <h4 class="fw-bold text-dark mb-1">ویرایش حساب کاربری</h4>-->
    <!--                        </div>-->
    <!--                        <form id="registerForm" novalidate>-->
    <!--                            &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="text"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="fullName"-->
    <!--                                            placeholder="نام کامل خود را وارد کنید"-->
    <!--                                            required-->
    <!--                                            minlength="3"-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                    <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Email &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="email"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="email"-->
    <!--                                            placeholder="example@email.com"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                               fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                    <input-->
    <!--                                            type="number"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="phon-number"-->
    <!--                                            placeholder="09131234567"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Password &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="password"-->
    <!--                                            class="form-control border-end-0"-->
    <!--                                            id="password"-->
    <!--                                            placeholder="حداقل ۸ کاراکتر"-->
    <!--                                            required-->
    <!--                                            minlength="8"-->
    <!--                                    >-->
    <!--                                    <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                            id="togglePassword"-->
    <!--                                            aria-label="نمایش رمز">-->
    <!--                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                             fill="currentColor"-->
    <!--                                             class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                        </svg>-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                <div class="strength-bar mt-2">-->
    <!--                                    <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-1">-->
    <!--                                    <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                </div>-->
    <!--                                <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                            </div>-->
    <!--                            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                ثبت‌-->
    <!--                            </button>-->
    <!--                            <button-->
    <!--                                    class="btn btn-danger my-1 w-100"-->
    <!--                                    onclick="closeModal('editStudent')">-->
    <!--                                بستن-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--                <div id="addStudent" class="modal">-->
    <!--                    <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                        <div class="text-center mb-4">-->
    <!--                            <h4 class="fw-bold text-dark mb-1">افزودن حساب کاربری</h4>-->
    <!--                        </div>-->
    <!--                        <form id="registerForm" novalidate>-->
    <!--                            &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="text"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="fullName"-->
    <!--                                            placeholder="نام کامل خود را وارد کنید"-->
    <!--                                            required-->
    <!--                                            minlength="3"-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                    <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Email &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="email"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="email"-->
    <!--                                            placeholder="example@email.com"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                               fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                    <input-->
    <!--                                            type="number"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="phon-number"-->
    <!--                                            placeholder="09131234567"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Password &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="password"-->
    <!--                                            class="form-control border-end-0"-->
    <!--                                            id="password"-->
    <!--                                            placeholder="حداقل ۸ کاراکتر"-->
    <!--                                            required-->
    <!--                                            minlength="8"-->
    <!--                                    >-->
    <!--                                    <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                            id="togglePassword"-->
    <!--                                            aria-label="نمایش رمز">-->
    <!--                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                             fill="currentColor"-->
    <!--                                             class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                        </svg>-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                <div class="strength-bar mt-2">-->
    <!--                                    <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-1">-->
    <!--                                    <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                </div>-->
    <!--                                <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                            </div>-->
    <!--                            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                ثبت‌-->
    <!--                            </button>-->
    <!--                            <button-->
    <!--                                    class="btn btn-danger my-1 w-100"-->
    <!--                                    onclick="closeModal('editStudent')">-->
    <!--                                بستن-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--            </div>-->

    <!-- ***** Teachers/Edit ***** -->
    <!--            <div class="row table-responsive overflow-visible">-->
    <!--                <h3 class="text-primary">مدرسین</h3>-->
    <!--                <table class="table table-bordered table-hover table-striped">-->
    <!--                    <tr>-->
    <!--                        <th>نام و نام خانوادگی</th>-->
    <!--                        <th>شماره موبایل</th>-->
    <!--                        <th>ایمیل</th>-->
    <!--                        <th>رمزعبور</th>-->
    <!--                        <th>عملیات</th>-->
    <!--                    </tr>-->
    <!--                    <tr>-->
    <!--                        <td>حسام</td>-->
    <!--                        <td>25</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td class="">-->
    <!--                            <button class="btn btn-primary" onclick="openModal('editStudent')">ویرایش</button>-->
    <!--                            <button class="btn btn-danger">حدف</button>-->
    <!--                        </td>-->
    <!--                    </tr>-->
    <!--                </table>-->
    <!--                <button class="btn btn-primary" onclick="openModal('addStudent')">افزودن</button>-->
    <!--                <div id="editStudent" class="modal">-->
    <!--                    <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                        <div class="text-center mb-4">-->
    <!--                            <h4 class="fw-bold text-dark mb-1">ویرایش حساب کاربری</h4>-->
    <!--                        </div>-->
    <!--                        <form id="registerForm" novalidate>-->
    <!--                            &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="text"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="fullName"-->
    <!--                                            placeholder="نام کامل خود را وارد کنید"-->
    <!--                                            required-->
    <!--                                            minlength="3"-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                    <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Email &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="email"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="email"-->
    <!--                                            placeholder="example@email.com"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                               fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                    <input-->
    <!--                                            type="number"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="phon-number"-->
    <!--                                            placeholder="09131234567"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Password &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="password"-->
    <!--                                            class="form-control border-end-0"-->
    <!--                                            id="password"-->
    <!--                                            placeholder="حداقل ۸ کاراکتر"-->
    <!--                                            required-->
    <!--                                            minlength="8"-->
    <!--                                    >-->
    <!--                                    <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                            id="togglePassword"-->
    <!--                                            aria-label="نمایش رمز">-->
    <!--                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                             fill="currentColor"-->
    <!--                                             class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                        </svg>-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                <div class="strength-bar mt-2">-->
    <!--                                    <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-1">-->
    <!--                                    <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                </div>-->
    <!--                                <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                            </div>-->
    <!--                            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                ثبت‌-->
    <!--                            </button>-->
    <!--                            <button-->
    <!--                                    class="btn btn-danger my-1 w-100"-->
    <!--                                    onclick="closeModal('editStudent')">-->
    <!--                                بستن-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--                <div id="addStudent" class="modal">-->
    <!--                    <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                        <div class="text-center mb-4">-->
    <!--                            <h4 class="fw-bold text-dark mb-1">افزودن حساب کاربری</h4>-->
    <!--                        </div>-->
    <!--                        <form id="registerForm" novalidate>-->
    <!--                            &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="text"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="fullName"-->
    <!--                                            placeholder="نام کامل خود را وارد کنید"-->
    <!--                                            required-->
    <!--                                            minlength="3"-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                    <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Email &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="email"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="email"-->
    <!--                                            placeholder="example@email.com"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                               fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                    <input-->
    <!--                                            type="number"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="phon-number"-->
    <!--                                            placeholder="09131234567"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Password &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="password"-->
    <!--                                            class="form-control border-end-0"-->
    <!--                                            id="password"-->
    <!--                                            placeholder="حداقل ۸ کاراکتر"-->
    <!--                                            required-->
    <!--                                            minlength="8"-->
    <!--                                    >-->
    <!--                                    <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                            id="togglePassword"-->
    <!--                                            aria-label="نمایش رمز">-->
    <!--                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                             fill="currentColor"-->
    <!--                                             class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                        </svg>-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                <div class="strength-bar mt-2">-->
    <!--                                    <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-1">-->
    <!--                                    <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                </div>-->
    <!--                                <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                            </div>-->
    <!--                            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                ثبت‌-->
    <!--                            </button>-->
    <!--                            <button-->
    <!--                                    class="btn btn-danger my-1 w-100"-->
    <!--                                    onclick="closeModal('editStudent')">-->
    <!--                                بستن-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--            </div>-->

    <!-- ***** Admins/Edit ***** -->
    <!--            <div class="row table-responsive overflow-visible">-->
    <!--                <h3 class="text-primary">مدیران شبکه</h3>-->
    <!--                <table class="table table-bordered table-hover table-striped">-->
    <!--                    <tr>-->
    <!--                        <th>نام و نام خانوادگی</th>-->
    <!--                        <th>شماره موبایل</th>-->
    <!--                        <th>ایمیل</th>-->
    <!--                        <th>رمزعبور</th>-->
    <!--                        <th>عملیات</th>-->
    <!--                    </tr>-->
    <!--                    <tr>-->
    <!--                        <td>حسام</td>-->
    <!--                        <td>25</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td>Front-End Developer</td>-->
    <!--                        <td class="">-->
    <!--                            <button class="btn btn-primary" onclick="openModal('editStudent')">ویرایش</button>-->
    <!--                            <button class="btn btn-danger">حدف</button>-->
    <!--                        </td>-->
    <!--                    </tr>-->
    <!--                </table>-->
    <!--                <button class="btn btn-primary" onclick="openModal('addStudent')">افزودن</button>-->
    <!--                <div id="editStudent" class="modal">-->
    <!--                    <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                        <div class="text-center mb-4">-->
    <!--                            <h4 class="fw-bold text-dark mb-1">ویرایش حساب کاربری</h4>-->
    <!--                        </div>-->
    <!--                        <form id="registerForm" novalidate>-->
    <!--                            &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="text"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="fullName"-->
    <!--                                            placeholder="نام کامل خود را وارد کنید"-->
    <!--                                            required-->
    <!--                                            minlength="3"-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                    <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Email &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="email"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="email"-->
    <!--                                            placeholder="example@email.com"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                                <div class="input-group">-->
    <!--                                        <span class="input-group-text bg-white">-->
    <!--                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                               fill="currentColor"-->
    <!--                                               class="text-secondary"-->
    <!--                                               viewBox="0 0 16 16">-->
    <!--                                              <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                          </svg>-->
    <!--                                        </span>-->
    <!--                                    <input-->
    <!--                                            type="number"-->
    <!--                                            class="form-control rounded-end-2"-->
    <!--                                            id="phon-number"-->
    <!--                                            placeholder="09131234567"-->
    <!--                                            required-->
    <!--                                    >-->
    <!--                                    <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                    <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Password &ndash;&gt;-->
    <!--                            <div class="mb-3">-->
    <!--                                <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                                <div class="input-group">-->
    <!--                                    <span class="input-group-text bg-white">-->
    <!--                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"-->
    <!--                                           class="text-secondary"-->
    <!--                                           viewBox="0 0 16 16">-->
    <!--                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                      </svg>-->
    <!--                                    </span>-->
    <!--                                    <input-->
    <!--                                            type="password"-->
    <!--                                            class="form-control border-end-0"-->
    <!--                                            id="password"-->
    <!--                                            placeholder="حداقل ۸ کاراکتر"-->
    <!--                                            required-->
    <!--                                            minlength="8"-->
    <!--                                    >-->
    <!--                                    <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                            id="togglePassword"-->
    <!--                                            aria-label="نمایش رمز">-->
    <!--                                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                             fill="currentColor"-->
    <!--                                             class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                        </svg>-->
    <!--                                    </button>-->
    <!--                                </div>-->
    <!--                                &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                                <div class="strength-bar mt-2">-->
    <!--                                    <div class="strength-fill" id="strengthFill"></div>-->
    <!--                                </div>-->
    <!--                                <div class="mt-1">-->
    <!--                                    <small id="strengthLabel" class="text-muted"></small>-->
    <!--                                </div>-->
    <!--                                <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                            </div>-->
    <!--                            <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                                ثبت‌-->
    <!--                            </button>-->
    <!--                            <button-->
    <!--                                    class="btn btn-danger my-1 w-100"-->
    <!--                                    onclick="closeModal('editStudent')">-->
    <!--                                بستن-->
    <!--                            </button>-->
    <!--                        </form>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--            <div id="addStudent" class="modal">-->
    <!--                <div class="card shadow-sm rounded-4 p-4 border-primary">-->
    <!--                    <div class="text-center mb-4">-->
    <!--                        <h4 class="fw-bold text-dark mb-1">افزودن حساب کاربری</h4>-->
    <!--                    </div>-->
    <!--                    <form id="registerForm" novalidate>-->
    <!--                        &lt;!&ndash; Full Name &ndash;&gt;-->
    <!--                        <div class="mb-3">-->
    <!--                            <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>-->
    <!--                            <div class="input-group">-->
    <!--                                                <span class="input-group-text bg-white">-->
    <!--                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                                       fill="currentColor"-->
    <!--                                                       class="text-secondary"-->
    <!--                                                       viewBox="0 0 16 16">-->
    <!--                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>-->
    <!--                                                  </svg>-->
    <!--                                                </span>-->
    <!--                                <input-->
    <!--                                        type="text"-->
    <!--                                        class="form-control rounded-end-2"-->
    <!--                                        id="fullName"-->
    <!--                                        placeholder="نام کامل خود را وارد کنید"-->
    <!--                                        required-->
    <!--                                        minlength="3"-->
    <!--                                >-->
    <!--                                <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>-->
    <!--                                <div class="valid-feedback">نام معتبر است.</div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        &lt;!&ndash; Email &ndash;&gt;-->
    <!--                        <div class="mb-3">-->
    <!--                            <label for="email" class="form-label fw-medium">ایمیل</label>-->
    <!--                            <div class="input-group">-->
    <!--                                                <span class="input-group-text bg-white">-->
    <!--                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                                       fill="currentColor"-->
    <!--                                                       class="text-secondary"-->
    <!--                                                       viewBox="0 0 16 16">-->
    <!--                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>-->
    <!--                                                  </svg>-->
    <!--                                                </span>-->
    <!--                                <input-->
    <!--                                        type="email"-->
    <!--                                        class="form-control rounded-end-2"-->
    <!--                                        id="email"-->
    <!--                                        placeholder="example@email.com"-->
    <!--                                        required-->
    <!--                                >-->
    <!--                                <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        &lt;!&ndash;phon number&ndash;&gt;-->
    <!--                        <div class="mb-3">-->
    <!--                            <label for="phon-number" class="form-label fw-medium">شماره تلفن</label>-->
    <!--                            <div class="input-group">-->
    <!--                                                    <span class="input-group-text bg-white">-->
    <!--                                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                                           fill="currentColor"-->
    <!--                                                           class="text-secondary"-->
    <!--                                                           viewBox="0 0 16 16">-->
    <!--                                                          <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.522 1.01c.329.132.525.464.475.806l-.5 3.479a.678.678 0 0 1-.743.58l-1.635-.163a11.72 11.72 0 0 0 5.058 5.058l.163-1.635a.678.678 0 0 1 .58-.743l3.479-.5a.678.678 0 0 1 .806.475l1.01 2.522a.678.678 0 0 1-.166.737l-1.29 1.29c-.733.733-1.826.98-2.747.623a17.478 17.478 0 0 1-6.482-4.03 17.478 17.478 0 0 1-4.03-6.482c-.357-.921-.11-2.014.623-2.747l1.29-1.29z"/>-->
    <!--                                                      </svg>-->
    <!--                                                    </span>-->
    <!--                                <input-->
    <!--                                        type="number"-->
    <!--                                        class="form-control rounded-end-2"-->
    <!--                                        id="phon-number"-->
    <!--                                        placeholder="09131234567"-->
    <!--                                        required-->
    <!--                                >-->
    <!--                                <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>-->
    <!--                                <div class="valid-feedback">ایمیل معتبر است.</div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        &lt;!&ndash; Password &ndash;&gt;-->
    <!--                        <div class="mb-3">-->
    <!--                            <label for="password" class="form-label fw-medium">رمز عبور</label>-->
    <!--                            <div class="input-group">-->
    <!--                                                <span class="input-group-text bg-white">-->
    <!--                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                                       fill="currentColor"-->
    <!--                                                       class="text-secondary"-->
    <!--                                                       viewBox="0 0 16 16">-->
    <!--                                                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>-->
    <!--                                                  </svg>-->
    <!--                                                </span>-->
    <!--                                <input-->
    <!--                                        type="password"-->
    <!--                                        class="form-control border-end-0"-->
    <!--                                        id="password"-->
    <!--                                        placeholder="حداقل ۸ کاراکتر"-->
    <!--                                        required-->
    <!--                                        minlength="8"-->
    <!--                                >-->
    <!--                                <button class="input-group-text toggle-password bg-white" type="button"-->
    <!--                                        id="togglePassword"-->
    <!--                                        aria-label="نمایش رمز">-->
    <!--                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"-->
    <!--                                         fill="currentColor"-->
    <!--                                         class="text-secondary" viewBox="0 0 16 16">-->
    <!--                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>-->
    <!--                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>-->
    <!--                                    </svg>-->
    <!--                                </button>-->
    <!--                            </div>-->
    <!--                            &lt;!&ndash; Strength bar &ndash;&gt;-->
    <!--                            <div class="strength-bar mt-2">-->
    <!--                                <div class="strength-fill" id="strengthFill"></div>-->
    <!--                            </div>-->
    <!--                            <div class="mt-1">-->
    <!--                                <small id="strengthLabel" class="text-muted"></small>-->
    <!--                            </div>-->
    <!--                            <div class="invalid-feedback d-block small" id="passwordError"></div>-->
    <!--                        </div>-->
    <!--                        <button type="submit" class="btn btn-success w-100 fw-semibold py-2" id="submitBtn">-->
    <!--                            ثبت‌-->
    <!--                        </button>-->
    <!--                        <button-->
    <!--                                class="btn btn-danger my-1 w-100"-->
    <!--                                onclick="closeModal('editStudent')">-->
    <!--                            بستن-->
    <!--                        </button>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->

    <!-- ***** Courses ***** -->
    <!--            <div class="row table-responsive overflow-visible">-->
    <!--                <h3 class="text-primary"> دوره ها</h3>-->
    <!--                <table class="table table-bordered table-hover table-striped">-->
    <!--                    <tr>-->
    <!--                        <th>نام دوره</th>-->
    <!--                        <th>مدرس دوره</th>-->
    <!--                        <th>مجموع ساعت تدریس</th>-->
    <!--                        <th>عملیات</th>-->
    <!--                    </tr>-->
    <!--                    <tr>-->
    <!--                        <td>FT</td>-->
    <!--                        <td>hesam</td>-->
    <!--                        <td>255</td>-->
    <!--                        <td class="">-->
    <!--                            <button class="btn btn-danger">حدف</button>-->
    <!--                        </td>-->
    <!--                    </tr>-->
    <!--                </table>-->
    <!--                <a class="text-decoration-none btn btn-primary text-center" href="./course-create.html">افزودن</a>-->
    <!--            </div>-->
  </div>
</div>
</div>

<script src="/assets/js/register.js"></script>
<?php
include '../app/Views/layouts/dashboard/footer.php';
?>