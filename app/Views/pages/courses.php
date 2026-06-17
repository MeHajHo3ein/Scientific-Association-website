<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - دروس';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
$navbarRounded = 'rounded-bottom-3';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$webdevCourses = $webdevCourses ?? [];
$networkCourses = $networkCourses ?? [];
$aiCourses = $aiCourses ?? [];
$programmingCourses = $programmingCourses ?? [];
$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>لیست دوره‌ها</h1>
    <p>تمام دوره‌های آموزشی در حوزه برنامه‌نویسی، وب، شبکه و هوش مصنوعی</p>
  </div>
  <div class="container d-flex justify-content-center">
    <a href="#network" class="btn btn-outline-primary mx-2 rounded-3">شبکه</a>
    <a href="#webdev" class="btn btn-outline-primary mx-2 rounded-3">توسعه وب</a>
    <a href="#ai" class="btn btn-outline-primary mx-2 rounded-3">هوش مصنوعی</a>
    <a href="#prog" class="btn btn-outline-primary mx-2 rounded-3">برنامه نویسی</a>
  </div>
  <br />
</div>

<!-- Main -->
<div class="container">
  <div id="coursesContainer">

    <!-- webdev -->
    <h4 id="webdev" class="my-3">توسعه وب</h4>
    <div class="row">
      <?php if (empty($webdevCourses)): ?>
        <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
      <?php else: ?>
        <?php foreach ($webdevCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div
                class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']); ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span>
                    <?php
                    $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                    echo $levels[$course['level']] ?? 'متوسط';
                    ?>
                  </span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']); ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- network -->
    <h4 id="network" class="my-3">شبکه</h4>
    <div class="row">
      <?php if (empty($networkCourses)): ?>
        <div class="col-12">
          <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
        </div>
      <?php else: ?>
        <?php foreach ($networkCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div
                class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']); ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span>
                    <?php
                    $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                    echo $levels[$course['level']] ?? 'متوسط';
                    ?>
                  </span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']); ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- ai -->
    <h4 id="ai" class="my-3">هوش مصنوعی</h4>
    <div class="row">
      <?php if (empty($aiCourses)): ?>
        <div class="col-12">
          <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
        </div>
      <?php else: ?>
        <?php foreach ($aiCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div
                class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']); ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span>
                    <?php
                    $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                    echo $levels[$course['level']] ?? 'متوسط';
                    ?>
                  </span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']); ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- programming -->
    <h4 id="prog" class="my-3">برنامه نویسی</h4>
    <div class="row">
      <?php if (empty($programmingCourses)): ?>
        <div class="col-12">
          <div class="text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>
        </div>
      <?php else: ?>
        <?php foreach ($programmingCourses as $course): ?>
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
              <div
                class="card-body border-start border-primary border-5 rounded-3">
                <img src="<?= !empty($course['image']) ? '/uploads/courses/' . htmlspecialchars($course['image']) : '/assets/img/logo.png' ?>" alt="Course image" class="card-img-top rounded-3 mb-3" />
                <h5 class="card-title"><?= htmlspecialchars($course['title']); ?></h5>
                <p class="card-text">
                  <span>مدرس:</span>
                  <span><?= htmlspecialchars($course['instructor_name']); ?></span>
                </p>
                <p class="card-text">
                  <span>سطح:</span>
                  <span>
                    <?php
                    $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
                    echo $levels[$course['level']] ?? 'متوسط';
                    ?>
                  </span>
                </p>
                <p class="card-text">
                  <span>هزینه:</span>
                  <span><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان'; ?></span>
                </p>
                <p class="card-text">
                  <span>مدت دوره:</span>
                  <span><?= htmlspecialchars($course['duration']); ?></span>
                </p>
                <a href="/courses/<?= urlencode($course['slug']); ?>" class="btn btn-outline-primary border-1 rounded-3 d-block">
                  مشاهده جزئیات
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Pagination -->
  <div id="paginationContainer">
    <?php if ($totalPages > 1): ?>
      <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
          <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="#" data-page="<?= $page - 1 ?>">قبلی</a>
          </li>

          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="#" data-page="<?= $i ?>"><?= toPersianNumber($i) ?></a>
            </li>
          <?php endfor; ?>

          <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="#" data-page="<?= $page + 1 ?>">بعدی</a>
          </li>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
</div>

<script src="/assets/js/notification-api.js"></script>
<script>
  let currentPage = <?= (int)$page ?>;

  function toPersianNumberJS(num) {
    const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return String(num).split('').map(d => persianDigits[d] ?? d).join('');
  }

  function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function renderCourses(categories) {
    const container = document.getElementById('coursesContainer');

    let html = '';
    const categoryIds = ['webdev', 'network', 'ai', 'programming'];
    const categoryLabels = {
      webdev: 'توسعه وب',
      network: 'شبکه',
      ai: 'هوش مصنوعی',
      programming: 'برنامه نویسی'
    };
    const levels = {
      beginner: 'مبتدی',
      intermediate: 'متوسط',
      advanced: 'پیشرفته'
    };

    categoryIds.forEach(catId => {
      const courses = categories[catId] || [];
      html += `<h4 id="${catId}" class="my-3">${categoryLabels[catId]}</h4><div class="row">`;

      if (courses.length === 0) {
        html += `<div class="col-12 text-center">در حال حاضر هیچ دوره‌ای در این دسته وجود ندارد.</div>`;
      } else {
        courses.forEach(course => {
          const priceText = course.price > 0 ? Number(course.price).toLocaleString() + ' تومان' : 'رایگان';
          const levelText = levels[course.level] || 'متوسط';
          const imageSrc = course.image ? '/uploads/courses/' + escapeHtml(course.image) : '/assets/img/logo.png';

          html += `
            <div class="col-lg-3 col-md-6 col-sm-12 course-item" data-id="${course.id}">
              <div class="card shadow d-flex m-2 p-0 rounded-3 border-0">
                <div class="card-body border-start border-primary border-5 rounded-3">
                  <img src="${escapeHtml(imageSrc)}" alt="Course image" class="card-img-top rounded-3 mb-3" />
                  <h5 class="card-title">${escapeHtml(course.title)}</h5>
                  <p class="card-text">
                    <span>مدرس:</span>
                    <span>${escapeHtml(course.instructor_name)}</span>
                  </p>
                  <p class="card-text">
                    <span>سطح:</span>
                    <span>${levelText}</span>
                  </p>
                  <p class="card-text">
                    <span>هزینه:</span>
                    <span>${escapeHtml(priceText)}</span>
                  </p>
                  <p class="card-text">
                    <span>مدت دوره:</span>
                    <span>${escapeHtml(course.duration || '')}</span>
                  </p>
                  <a href="/courses/${escapeHtml(course.slug)}" class="btn btn-outline-primary border-1 rounded-3 d-block">
                    مشاهده جزئیات
                  </a>
                </div>
              </div>
            </div>
          `;
        });
      }
      html += '</div>';
    });

    container.innerHTML = html;
  }

  function renderPagination(page, totalPages) {
    const container = document.getElementById('paginationContainer');

    if (totalPages <= 1) {
      container.innerHTML = '';
      return;
    }

    let html = '<nav class="mt-3"><ul class="pagination justify-content-center">';
    html += `<li class="page-item ${page <= 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${page - 1}">قبلی</a></li>`;

    const startPage = Math.max(1, page - 2);
    const endPage = Math.min(totalPages, page + 2);

    if (startPage > 1) {
      html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
      if (startPage > 2) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }

    for (let i = startPage; i <= endPage; i++) {
      html += `<li class="page-item ${i === page ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${toPersianNumberJS(i)}</a></li>`;
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
      html += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${toPersianNumberJS(totalPages)}</a></li>`;
    }

    html += `<li class="page-item ${page >= totalPages ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${page + 1}">بعدی</a></li>`;
    html += '</ul></nav>';
    container.innerHTML = html;
  }

  function loadPage(page) {
    if (page < 1) return;
    if (page === currentPage) return;

    const container = document.getElementById('coursesContainer');

    fetch(`/api/public/courses/list?page=${page}`)
      .then(res => res.json())
      .then(data => {
        if (data.success === false) throw new Error(data.message || 'خطا در بارگذاری');
        currentPage = data.page;
        renderCourses(data.categories);
        renderPagination(data.page, data.totalPages);
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      })
      .catch(err => {
        console.error('خطا:', err);
        container.innerHTML = '<div class="text-center text-danger">خطا در بارگذاری داده‌ها</div>';
      });
  }

  document.addEventListener('click', function(e) {
    const link = e.target.closest('#paginationContainer a[data-page]');
    if (!link) return;
    e.preventDefault();
    const parentLi = link.closest('.page-item');
    if (parentLi && parentLi.classList.contains('disabled')) return;
    const page = parseInt(link.dataset.page);
    if (isNaN(page) || page === currentPage) return;
    loadPage(page);
  });
</script>

<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>