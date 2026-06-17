<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - مقالات';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$articles = $articles ?? [];
$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div class="container text-center">
    <h1>مقالات</h1>
    <p>مرجع تخصصی مقالات علوم کامپیوتر و برنامه‌نویسی</p>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <div id="articlesContainer">
    <?php if (empty($articles)): ?>
      <div class="text-center">هیچ مقاله‌ای منتشر نشده است.</div>
    <?php else: ?>
      <?php $firstArticle = array_shift($articles); ?>
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body bg-white border-start border-primary border-5 rounded-3">
          <h3 class="card-title py-2"><?= htmlspecialchars($firstArticle['title']) ?></h3>
          <p class="card-subtitle text-secondary py-2">
            <span>نویسنده:</span>
            <span><?= htmlspecialchars($firstArticle['author_name']) ?></span>
            |
            <span><?= toJalali($firstArticle['created_at'], 'Y/m/d') ?></span>
          </p>
          <p class="card-text py-2">
            <?= htmlspecialchars(mb_substr($firstArticle['summary'] ?? $firstArticle['content'], 0, 200)) ?>...
          </p>
          <a href="/articles/<?= urlencode($firstArticle['slug']) ?>" class="text-primary link-dark text-decoration-none py-2 h5">ادامه مطلب</a>
        </div>
      </div>
      <br>
      <div class="row">
        <?php foreach ($articles as $article): ?>
          <div class="col-lg-6 col-sm-12 article-item" data-id="<?= $article['id'] ?>">
            <div class="card border-0 shadow-sm rounded-3">
              <div class="card-body bg-white dotted">
                <h4 class="card-title py-2"><?= htmlspecialchars($article['title']) ?></h4>
                <p class="card-subtitle text-secondary py-2">
                  <span>نویسنده:</span>
                  <span><?= htmlspecialchars($article['author_name']) ?></span>
                  |
                  <span><?= toJalali($article['created_at'], 'Y/m/d') ?></span>
                </p>
                <p class="card-text py-2"><?= htmlspecialchars(mb_substr($article['summary'] ?? $article['content'], 0, 150)) ?>...</p>
                <a href="/articles/<?= urlencode($article['slug']) ?>" class="text-primary link-dark text-decoration-none py-2">ادامه مطلب</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
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

  function renderArticles(items, page, perPage) {
    const container = document.getElementById('articlesContainer');

    if (!items || items.length === 0) {
      container.innerHTML = '<div class="text-center">هیچ مقاله‌ای منتشر نشده است.</div>';
      return;
    }

    const firstArticle = items.shift();

    let html = `
      <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body bg-white border-start border-primary border-5 rounded-3">
          <h3 class="card-title py-2">${escapeHtml(firstArticle.title)}</h3>
          <p class="card-subtitle text-secondary py-2">
            <span>نویسنده:</span>
            <span>${escapeHtml(firstArticle.author_name)}</span>
            |
            <span>${escapeHtml(firstArticle.created_at_fa)}</span>
          </p>
          <p class="card-text py-2">${escapeHtml(firstArticle.summary)}...</p>
          <a href="/articles/${escapeHtml(firstArticle.slug)}" class="text-primary link-dark text-decoration-none py-2 h5">ادامه مطلب</a>
        </div>
      </div>
      <br>
      <div class="row">
    `;

    items.forEach((item) => {
      html += `
        <div class="col-lg-6 col-sm-12 article-item" data-id="${item.id}">
          <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body bg-white dotted">
              <h4 class="card-title py-2">${escapeHtml(item.title)}</h4>
              <p class="card-subtitle text-secondary py-2">
                <span>نویسنده:</span>
                <span>${escapeHtml(item.author_name)}</span>
                |
                <span>${escapeHtml(item.created_at_fa)}</span>
              </p>
              <p class="card-text py-2">${escapeHtml(item.summary)}...</p>
              <a href="/articles/${escapeHtml(item.slug)}" class="text-primary link-dark text-decoration-none py-2">ادامه مطلب</a>
            </div>
          </div>
        </div>
      `;
    });

    html += '</div>';
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

    const container = document.getElementById('articlesContainer');

    fetch(`/api/public/articles/list?page=${page}`)
      .then(res => res.json())
      .then(data => {
        if (data.success === false) throw new Error(data.message || 'خطا در بارگذاری');
        currentPage = data.page;
        renderArticles(data.items, data.page, PER_PAGE);
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