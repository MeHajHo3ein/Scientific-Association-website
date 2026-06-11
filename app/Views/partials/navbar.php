<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$isActive = function ($path) use ($currentPath) {
  return $currentPath === $path ? 'custom-a-active' : '';
};
?>

<nav class="navbar navbar-expand-xxl fixed-top bg-white border-bottom shadow-lg<?= isset($navbarRounded) ? ' ' . $navbarRounded : '' ?>">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="<?= setting('site_logo', '/assets/img/logo.png') ?>" alt="logo" height="60" class="me-2 rounded-3" />
      <h5><?= htmlspecialchars(setting('site_name', 'انجمن علمی کامپیوتر')) ?></h5>
    </a>

    <!-- Hamburger Toggle -->
    <button
      class="navbar-toggler custom-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#nav-collapse">
      <span class="toggler-icon"></span>
    </button>

    <!-- Collapsed Content -->
    <div class="collapse navbar-collapse" id="nav-collapse">
      <!-- Menus -->
      <ul class="navbar-nav mx-auto text-center mb-2 mb-xxl-0">
        <li class="nav-item">
          <a href="/" class="nav-link custom-a <?= $isActive('/') ?>">خانه</a>
        </li>
        <li class="nav-item">
          <a href="/courses" class="nav-link custom-a <?= (strpos($currentPath, '/courses') === 0) ? 'custom-a-active' : '' ?>">دوره ها</a>
        </li>
        <li class="nav-item">
          <a href="/offline-courses" class="nav-link custom-a <?= $isActive('/offline-courses') ?>">آموزش های آفلاین</a>
        </li>
        <li class="nav-item">
          <a href="/articles" class="nav-link custom-a <?= (strpos($currentPath, '/articles') === 0) ? 'custom-a-active' : '' ?>">مقالات</a>
        </li>
        <li class="nav-item">
          <a href="/neas" class="nav-link custom-a <?= $isActive('/neas') ?>">اخبار و اطلاعیه ها</a>
        </li>
        <li class="nav-item">
          <a href="/certificates" class="nav-link custom-a <?= $isActive('/certificates') ?>">گواهینامه ها</a>
        </li>
        <!-- <li class="nav-item">
          <a href="/cult" class="nav-link custom-a <?= $isActive('/cult') ?>">انجمن</a>
        </li> -->
        <li class="nav-item">
          <a href="/contactus" class="nav-link custom-a <?= $isActive('/contactus') ?>">ارتباط با ما</a>
        </li>
        <li class="nav-item">
          <a href="/aboutus" class="nav-link custom-a <?= $isActive('/aboutus') ?>">درباره ما</a>
        </li>
      </ul>

      <!-- Search Bar -->
      <div class="live-search-container">
        <form class="d-flex mx-auto my-3 my-xxl-0 search-box" action="/search" method="GET" role="search">
          <input
            class="form-control rounded-start-4 rounded-end-0"
            type="search"
            name="q"
            id="search-input-live"
            autocomplete="off"
            placeholder="جستجو..."
            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" />
          <button class="btn btn-primary rounded-end-4 rounded-start-0" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </form>
        <div id="live-results"></div>
      </div>

      <!-- Displays user info if logged in -->
      <?php if (isset($_SESSION['user_id'])): ?>
        <a
          href="/panel"
          class="btn btn-outline-dark rounded-3 d-block p-2 me-lg-1 m-1">داشبورد</a>
        <a
          href="/logout"
          class="btn btn-outline-danger rounded-3 d-block p-2 me-lg-1 m-1">خروج</a>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'student'): ?>
          <a
            href="/panel/notifications"
            class="btn btn-outline-primary rounded-3 d-block p-2 me-lg-1 m-1 position-relative">
            <i class="fa fa-bell"></i>
            <!-- Badge -->
            <span
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">
              0
            </span>
          </a>
        <?php endif; ?>
      <?php else: ?>
        <a href="/login" class="btn btn-outline-primary rounded-3 d-block p-2 me-lg-1 m-1">ورود</a>
        <a href="/register" class="btn btn-outline-primary rounded-3 d-block p-2 me-lg-1 m-1">ثبت نام</a>
      <?php endif; ?>
    </div>
  </div>
</nav>