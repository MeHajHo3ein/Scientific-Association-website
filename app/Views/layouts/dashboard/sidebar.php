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
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'owner'): ?>
          <ul class="navbar-nav">
            <h5 class="text-light p-3 text-center">پنل مدیریت</h5>
            <li class="nav-item">
              <a
                href="<?= getBackButtonUrl(); ?>"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel') ? 'active' : '' ?>">
                <?= getBackButtonText(); ?>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/admins"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= (isActiveRoute('/panel/admins') || isActiveRoute('/panel/admins/create') || strpos($_SERVER['REQUEST_URI'], '/panel/admins/edit/') === 0) ? 'active' : ''; ?>">
                مدیران شبکه
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/students"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= (isActiveRoute('/panel/students') || strpos($_SERVER['REQUEST_URI'], '/panel/students/edit/') === 0) ? 'active' : '' ?>">
                دانشجویان
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/teachers"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= (isActiveRoute('/panel/teachers') || strpos($_SERVER['REQUEST_URI'], '/panel/teachers/edit/') === 0) ? 'active' : '' ?>">
                اساتید
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/courses"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/courses') ? 'active' : '' ?>">
                دوره ها
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/articles"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/articles') ? 'active' : '' ?>">
                مقالات
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/offline-courses"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/offline-courses') ? 'active' : '' ?>">
                فایل های قابل دانلود
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/notifications"
                class="text-start btn my-1 btn-outline-light py-2 borde w-100 <?= isActiveRoute('/panel/notifications') ? 'active' : '' ?>">
                اعلانات
              </a>
            </li>
            <li class="nav-item">
              <a
                href="/panel/neas"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/neas') ? 'active' : '' ?>">
                اخبار/رویداد/اطلاعیه
              </a>
            </li>
            <li>
              <a
                href="O-Analytics.html"
                class="text-start btn my-1 btn-outline-light py-2 w-100">
                آمار
              </a>
            </li>
            <li>
              <a
                href="O-Setting.html"
                class="text-start btn my-1 btn-outline-light py-2 w-100">
                تنظیمات سیستم
              </a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn my-1 btn-danger text-light w-100">خروج</a>
            </li>
          </ul>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <ul class="navbar-nav">
            <h5 class="text-light p-3 text-center">پنل مدیریت</h5>
            <li class="nav-item">
              <a
                href="<?= getBackButtonUrl(); ?>"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel') ? 'active' : ''; ?>"><?= getBackButtonText(); ?></a>
            </li>
            <li class="nav-item">
              <a href="/panel/students" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= (isActiveRoute('/panel/students') || isActiveRoute('/panel/students/create') || strpos($_SERVER['REQUEST_URI'], '/panel/students/edit/') === 0) ? 'active' : ''; ?>">
                دانشجویان
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/teachers" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= (isActiveRoute('/panel/teachers') || isActiveRoute('/panel/teachers/create') || strpos($_SERVER['REQUEST_URI'], '/panel/teachers/edit/') === 0) ? 'active' : ''; ?>">
                اساتید
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/courses" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/courses') || isActiveRoute('/panel/courses/create') ? 'active' : ''; ?>">
                دوره ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/articles" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/articles') || isActiveRoute('/panel/articles/create') ? 'active' : ''; ?>">
                مقالات
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/offline-courses" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/offline-courses') ? 'active' : ''; ?>">
                فایل های قابل دانلود
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/notifications" class="text-start btn my-1 btn-outline-light py-2 borde w-100 <?= isActiveRoute('/panel/notifications') || isActiveRoute('/panel/notifications/create') ? 'active' : ''; ?>">
                اعلانات
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/neas"
                class=" text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/neas') || isActiveRoute('/panel/neas/create') ? 'active' : ''; ?>">
                اخبار/رویداد/اطلاعیه
              </a>
            </li>
            <li>
              <a
                href="O-Analytics.html"
                class="text-start btn my-1 btn-outline-light py-2 w-100">
                آمار
              </a>
            </li>
            <li class="nav-item">
              <a href="./A-Tickets.html"
                class=" text-start btn my-1 btn-outline-light py-2 borde w-100 ">
                تیکت ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn my-1 btn-danger text-light w-100">خروج</a>
            </li>
          </ul>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'teacher'): ?>
          <ul class="navbar-nav">
            <h5 class="text-light p-3 text-center">پنل مدیریت</h5>
            <li class="nav-item">
              <a
                href="<?= getBackButtonUrl(); ?>"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel') ? 'active' : ""; ?>"><?= getBackButtonText(); ?></a>
            </li>
            <li class="nav-item">
              <a href="/panel/courses" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/courses') || isActiveRoute('/panel/courses/create') ? 'active' : ""; ?>">دوره ها</a>
            </li>
            <li class="nav-item">
              <a href="/panel/articles" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/articles') || isActiveRoute('/panel/articles/create') ? 'active' : ''; ?>">
                مقالات
              </a>

            </li>
            <li class="nav-item">
              <a href="/panel/offline-courses" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/offline-courses') ? 'active' : ""; ?>">فایل های قابل دانلود</a>
            </li>
            <li class="nav-item">
              <a href="/panel/notifications" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/notifications') || isActiveRoute('/panel/notifications/create') ? 'active' : ''; ?>">اعلانات</a>
            </li>
            <li class="nav-item">
              <a href="./T-Quests.html"
                class=" text-start btn my-1 btn-outline-light py-2 w-100 ">
                امتحانات
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/neas"
                class=" text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/neas') || isActiveRoute('/panel/neas/create') ? 'active' : ''; ?>">
                اخبار/رویداد/اطلاعیه
              </a>
            </li>
            <li class="nav-item">
              <a href="./T-Tickets.html"
                class=" text-start btn my-1 btn-outline-light py-2 borde w-100">
                تیکت ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn my-1 btn-danger text-light w-100">خروج</a>
            </li>
          </ul>
        <?php else: ?>
          <ul class="navbar-nav">
            <h5 class="text-light p-3 text-center">پنل مدیریت</h5>
            <li class="nav-item">
              <a
                href="<?= getBackButtonUrl(); ?>"
                class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel') ? 'active' : ''; ?>"><?= getBackButtonText(); ?></a>
            </li>
            <li class="nav-item">
              <a href="/panel/courses" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/courses') ? 'active' : ''; ?>">
                دوره ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/certificates" class="text-start btn my-1 btn-outline-light py-2 w-100 <?= isActiveRoute('/panel/certificates') ? 'active' : ''; ?>">
                گواهینامه ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/panel/notifications" class="text-start btn my-1 btn-outline-light py-2 borde w-100 <?= isActiveRoute('/panel/notifications') ? 'active' : ''; ?>">
                اعلانات
              </a>
            </li>
            <li class="nav-item">
              <a href="./S-Tickets.html"
                class=" text-start btn my-1 btn-outline-light py-2 borde w-100 ">
                تیکت ها
              </a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn my-1 btn-danger text-light w-100">
                خروج
              </a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>