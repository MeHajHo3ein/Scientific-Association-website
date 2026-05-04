<!--Side-Bar-Btn-->
<nav class="navbar navbar-dark bg-secondary navbar-expand-xxl d-xxl-none px-3">
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="offcanvas"
    data-bs-target="#sidebar">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<div class="container-fluid">
  <!--Side-Bar-->
  <div class="row">
    <div
      class="offcanvas-xxl offcanvas-start bg-secondary text-white"
      tabindex="-1"
      id="sidebar">
      <div class="offcanvas-header d-md-none">
        <h5 class="offcanvas-title">منو</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body p-3">
        <ul class="navbar-nav">
          <h5 class="text-light p-3 text-center">پنل مدیریت</h5>
          <li class="nav-item">
            <a
              href="/"
              class="text-start btn my-1 btn-outline-light py-2 w-100 active">برگشت</a>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              ادمین ها
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              دانشجویان
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              مدرسین
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              دوره ها
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              مقاله ها
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 w-100">
              فایل های آموزش آفلاین
            </button>
          </li>
          <li class="nav-item">
            <button class="text-start btn my-1 btn-outline-light py-2 borde w-100">
              اعلانات
            </button>
          </li>
          <li class="nav-item">
            <a href="/logout">
              <button class="btn my-1 btn-danger text-light w-100">خروج</button>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>