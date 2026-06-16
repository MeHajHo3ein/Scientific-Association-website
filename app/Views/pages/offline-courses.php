<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - دانلود دروس';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
$navbarRounded = 'rounded-bottom-3';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$publicFiles = $publicFiles ?? [];
$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>لیست جزوه های قابل دانلود</h1>
    <p>امکان دانلود تمامی جزوه های مربوطه</p>
  </div>
  <br />
</div>

<!-- Main -->
<div class="container">
  <div id="filesContainer" class="row">
    <?php if (empty($publicFiles)): ?>
      <div class="col-12">
        <div class="text-center">هیچ فایلی برای دانلود وجود ندارد.</div>
      </div>
    <?php else: ?>
      <?php foreach ($publicFiles as $file): ?>
        <div class="col-lg-4 col-sm-12 file-item" data-id="<?= $file['id'] ?>">
          <div class="m-5 card rounded-3 border-0">
            <div class="card-body border-start border-primary border-5 rounded-3 bg-white text-center">
              <h5 class="card-title mt-3"><?= htmlspecialchars($file['title']) ?></h5>
              <p class="card-text py-1">
                <span>درس:</span>
                <span><?= htmlspecialchars($file['lesson']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>مدرس:</span>
                <span><?= htmlspecialchars($file['teacher_name']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>نوع فایل:</span>
                <span><?= htmlspecialchars($file['file_type']) ?></span>
              </p>
              <p class="card-text py-1">
                <span>هزینه:</span>
                <span><?= $file['price'] > 0 ? number_format($file['price']) . ' تومان' : 'رایگان' ?></span>
              </p>
              <a href="<?= htmlspecialchars($file['file_link']) ?>" class="btn btn-outline-primary border-1" target="_blank" rel="noopener noreferrer">
                دانلود
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
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
  const PER_PAGE = 9;
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

  function formatPrice(price) {
    return price > 0 ? price.toLocaleString() + ' تومان' : 'رایگان';
  }

  function renderFiles(items, page, perPage) {
    const container = document.getElementById('filesContainer');

    if (!items || items.length === 0) {
      container.innerHTML = '<div class="col-12"><div class="text-center">هیچ فایلی برای دانلود وجود ندارد.</div></div>';
      return;
    }

    let html = '';
    items.forEach((item) => {
      html += `
        <div class="col-lg-4 col-sm-12 file-item" data-id="${item.id}">
          <div class="m-5 card rounded-3 border-0">
            <div class="card-body border-start border-primary border-5 rounded-3 bg-white text-center">
              <h5 class="card-title mt-3">${escapeHtml(item.title)}</h5>
              <p class="card-text py-1">
                <span>درس:</span>
                <span>${escapeHtml(item.lesson)}</span>
              </p>
              <p class="card-text py-1">
                <span>مدرس:</span>
                <span>${escapeHtml(item.teacher_name)}</span>
              </p>
              <p class="card-text py-1">
                <span>نوع فایل:</span>
                <span>${escapeHtml(item.file_type)}</span>
              </p>
              <p class="card-text py-1">
                <span>هزینه:</span>
                <span>${escapeHtml(item.price_formatted)}</span>
              </p>
              <a href="${escapeHtml(item.file_link)}" class="btn btn-outline-primary border-1" target="_blank" rel="noopener noreferrer">
                دانلود
              </a>
            </div>
          </div>
        </div>
      `;
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

    const container = document.getElementById('filesContainer');

    fetch(`/api/offline-courses/list?page=${page}`)
      .then(res => res.json())
      .then(data => {
        if (data.success === false) throw new Error(data.message || 'خطا در بارگذاری');
        currentPage = data.page;
        renderFiles(data.items, data.page, PER_PAGE);
        renderPagination(data.page, data.totalPages);
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      })
      .catch(err => {
        console.error('خطا:', err);
        container.innerHTML = '<div class="col-12"><div class="text-center text-danger">خطا در بارگذاری داده‌ها</div></div>';
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