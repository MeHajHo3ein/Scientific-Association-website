<?php
$pageTitle = 'پنل شخصی - گواهینامه ها';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$certificates = $certificates ?? [];
$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">گواهی های قابل دریافت</h3>

    <div id="certificatesContainer" class="row">
      <?php if (empty($certificates)): ?>
        <div class="text-center">
          <p>شما هنوز هیچ گواهی دریافت نکرده‌اید.</p>
        </div>
      <?php else: ?>
        <?php foreach ($certificates as $cert): ?>
          <div class="col-lg-4 col-md-6 col-sm-12 certificate-item" data-id="<?= $cert['id'] ?>">
            <div class="card d-flex p-0 mt-1 border-0">
              <div class="card-body border-5 border-start border-primary">
                <h5><?= htmlspecialchars($cert['exam_title'] ?? $cert['course_name'] ?? 'گواهی') ?></h5>
                <p class="p-2">
                  <span>نمره:</span>
                  <span><?= toPersianNumber($cert['percentage'] ?? 0) ?> از ۱۰۰</span>
                </p>
                <p class="p-2">
                  <span>تاریخ دریافت:</span>
                  <span><?= toJalali($cert['completed_at'] ?? date('Y-m-d H:i:s'), 'Y/m/d') ?></span>
                </p>
                <a href="/certificates/view/<?= $cert['id'] ?>" class="d-block text-decoration-none btn btn-outline-primary my-3 border-1">مشاهده</a>
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
</div>

<script>
  const PER_PAGE = 12;
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

  function renderCertificates(items, page, perPage) {
    const container = document.getElementById('certificatesContainer');

    if (!items || items.length === 0) {
      container.innerHTML = '<div class="text-center"><p>شما هنوز هیچ گواهی دریافت نکرده‌اید.</p></div>';
      return;
    }

    let html = '';
    items.forEach((item, idx) => {
      html += `
        <div class="col-lg-4 col-md-6 col-sm-12 certificate-item" data-id="${item.id}">
          <div class="card d-flex p-0 mt-1 border-0">
            <div class="card-body border-5 border-start border-primary">
              <h5>${escapeHtml(item.exam_title)}</h5>
              <p class="p-2">
                <span>نمره:</span>
                <span>${toPersianNumberJS(item.percentage)} از ۱۰۰</span>
              </p>
              <p class="p-2">
                <span>تاریخ دریافت:</span>
                <span>${escapeHtml(item.completed_at_fa)}</span>
              </p>
              <a href="/certificates/view/${item.id}" class="d-block text-decoration-none btn btn-outline-primary my-3 border-1">مشاهده</a>
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

    const container = document.getElementById('certificatesContainer');

    fetch(`/api/certificates/list?page=${page}`)
      .then(res => res.json())
      .then(data => {
        if (data.success === false) throw new Error(data.message || 'خطا در بارگذاری');
        currentPage = data.page;
        renderCertificates(data.items, data.page, PER_PAGE);
        renderPagination(data.page, data.totalPages);
      })
      .catch(err => {
        console.error('خطا:', err);
        container.innerHTML = '<div class="text-center w-100 text-danger"><p>خطا در بارگذاری داده‌ها</p></div>';
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

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>