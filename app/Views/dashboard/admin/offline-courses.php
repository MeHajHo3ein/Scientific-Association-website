<?php
$pageTitle = 'پنل شخصی - فایل های آفلاین';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">فایل های قابل دانلود</h3>
    <button
      class="btn btn-primary my-1 w-100"
      onclick="openModal('addOF')">
      افزودن
    </button>
    <div class="row">
      <div class="col-lg-4 col-sm-12 ">
        <div class="m-5 card   border-0">
          <div class="card-body border-start border-primary border-5   bg-white text-center">
            <h5 class="card-title mt-3">Front-End</h5>
            <p class="card-text py-1">
              <span>درس:</span>
              <span>وب</span>
            </p>
            <p class="card-text py-1">
              <span>مدرس:</span>
              <span>حسام</span>
            </p>
            <p class="card-text py-1">
              <span>نوع فایل:</span>
              <span>ویدیو</span>
            </p>
            <p class="card-text py-1">
              <span>هزینه:</span>
              <span>رایگان</span>
            </p>
            <a href="" class="btn btn-outline-primary border-1 ">
              دانلود
            </a>
            <a href="" class="btn btn-outline-danger border-1 ">
              حذف
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 ">
        <div class="m-5 card   border-0">
          <div class="card-body border-start border-primary border-5   bg-white text-center">
            <h5 class="card-title mt-3">Front-End</h5>
            <p class="card-text py-1">
              <span>درس:</span>
              <span>وب</span>
            </p>
            <p class="card-text py-1">
              <span>مدرس:</span>
              <span>حسام</span>
            </p>
            <p class="card-text py-1">
              <span>نوع فایل:</span>
              <span>ویدیو</span>
            </p>
            <p class="card-text py-1">
              <span>هزینه:</span>
              <span>رایگان</span>
            </p>
            <a href="" class="btn btn-outline-primary border-1 ">
              دانلود
            </a>
            <a href="" class="btn btn-outline-danger border-1 ">
              حذف
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-12 ">
        <div class="m-5 card   border-0">
          <div class="card-body border-start border-primary border-5   bg-white text-center">
            <h5 class="card-title mt-3">Front-End</h5>
            <p class="card-text py-1">
              <span>درس:</span>
              <span>وب</span>
            </p>
            <p class="card-text py-1">
              <span>مدرس:</span>
              <span>حسام</span>
            </p>
            <p class="card-text py-1">
              <span>نوع فایل:</span>
              <span>ویدیو</span>
            </p>
            <p class="card-text py-1">
              <span>هزینه:</span>
              <span>رایگان</span>
            </p>
            <a href="" class="btn btn-outline-primary border-1 ">
              دانلود
            </a>
            <a href="" class="btn btn-outline-danger border-1 ">
              حذف
            </a>
          </div>
        </div>
      </div>
    </div>
    <div id="addOF" class="modal">
      <form class="form-control container">
        <div class="">
          <label for="file"> </label>
          <input class="C-input" id="file" name="file" type="file" accept="file/*">
        </div>
        <label class="form-label">عنوان</label>
        <input class="d-block w-100" type="text">
        <label class="form-label">درس</label>
        <input class="d-block w-100" type="text">
        <label class="form-label">مدرس</label>
        <input class="d-block w-100" type="text">
        <label class="form-label">هزینه</label>
        <input class="d-block w-100" type="text">
        <button type="submit" class="btn btn-success w-100 fw-semibold py-2 mt-5" id="submitBtn">
          ثبت‌
        </button>
        <button
          class="btn btn-danger my-1 w-100"
          onclick="closeModal('addOF')">
          بستن
        </button>
      </form>
    </div>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>