<?php
$pageTitle = 'پنل شخصی - دانلود فایل';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<!-- Alert Messages -->
<!-- Success -->
<?php if (isset($_SESSION['offline_success'])): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['offline_success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['offline_success']); ?>
<?php endif; ?>

<!-- Delete -->
<?php if (isset($_SESSION['offline_error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['offline_error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['offline_error']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">فایل های قابل دانلود</h3>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>شماره</th>
          <th>عنوان</th>
          <th>درس</th>
          <th>مدرس</th>
          <th>نوع فایل</th>
          <th>هزینه</th>
          <th>تاریخ انتشار</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody id="filesTableBody">
        <?php if (empty($files)): ?>
          <tr>
            <td colspan="8" class="text-center">هیچ فایلی یافت نشد.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($files as $index => $file): ?>
            <tr id="file-row-<?= $file['id'] ?>">
              <td><?= $index + 1 + (($page - 1) * $perPage) ?></td>
              <td><?= htmlspecialchars($file['title']) ?></td>
              <td><?= htmlspecialchars($file['lesson']) ?></td>
              <td><?= htmlspecialchars($file['teacher_name'] ?? $_SESSION['full_name']) ?></td>
              <td><?= htmlspecialchars($file['file_type']) ?></td>
              <td><?= $file['price'] > 0 ? number_format($file['price']) . ' تومان' : 'رایگان' ?></td>
              <td><?= toJalali($file['created_at'], 'Y/m/d') ?></td>
              <td class="">
                <a href="/panel/offline-courses/delete/<?= $file['id'] ?>" class="btn btn-danger" onclick="return confirm('آیا از حذف این فایل مطمئن هستید؟')">حذف</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!--Pagination-->
  <div id="paginationContainer">
    <?php if ($totalPages > 1): ?>
      <nav aria-label="Page navigation articleple" class="mt-3">
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

  function renderTable(files, page, perPage) {
    const tbody = document.getElementById('filesTableBody');

    if (!files || files.length === 0) {
      tbody.innerHTML = `<tr><td colspan="8" class="text-center">هیچ فایلی یافت نشد.</td></tr>`;
      return;
    }

    let html = '';
    files.forEach((file, idx) => {
      const number = (page - 1) * perPage + idx + 1;
      html += `
        <tr id="file-row-${file.id}">
          <td>${escapeHtml(number)}</td>
          <td>${escapeHtml(file.title)}</td>
          <td>${escapeHtml(file.lesson)}</td>
          <td>${escapeHtml(file.teacher_name)}</td>
          <td>${escapeHtml(file.file_type)}</td>
          <td>${escapeHtml(file.price)}</td>
          <td>${escapeHtml(file.created_at_fa)}</td>
          <td>
            <a href="/panel/offline-courses/delete/${file.id}" class="btn btn-danger" onclick="return confirm('آیا از حذف این فایل مطمئن هستید؟')">حذف</a>
          </td>
        </tr>
      `;
    });
    tbody.innerHTML = html;
  }

  function renderPagination(page, totalPages) {
    const container = document.getElementById('paginationContainer');

    if (totalPages <= 1) {
      container.innerHTML = '';
      return;
    }

    let html = '<nav class="mt-3"><ul class="pagination justify-content-center">';

    html += `<li class="page-item ${page <= 1 ? 'disabled' : ''}">
              <a class="page-link" href="#" data-page="${page - 1}">قبلی</a>
            </li>`;

    const startPage = Math.max(1, page - 2);
    const endPage = Math.min(totalPages, page + 2);

    if (startPage > 1) {
      html += `<li class="page-item"><a class="page-link" href="#" data-page="1">${toPersianNumberJS(1)}</a></li>`;
      if (startPage > 2) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
    }

    for (let i = startPage; i <= endPage; i++) {
      html += `<li class="page-item ${i === page ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${toPersianNumberJS(i)}</a>
              </li>`;
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
      html += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${toPersianNumberJS(totalPages)}</a></li>`;
    }

    html += `<li class="page-item ${page >= totalPages ? 'disabled' : ''}">
              <a class="page-link" href="#" data-page="${page + 1}">بعدی</a>
            </li>`;

    html += '</ul></nav>';
    container.innerHTML = html;
  }

  function loadPage(page) {
    if (page < 1) return;
    if (page === currentPage) return;

    const tbody = document.getElementById('filesTableBody');
    fetch(`/api/offline-courses/list?page=${page}`)
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => {
        if (data.success === false) {
          throw new Error(data.message || 'خطا در بارگذاری');
        }
        currentPage = data.page;
        renderTable(data.items, data.page, PER_PAGE);
        renderPagination(data.page, data.totalPages);

        document.querySelector('.container.overflow-auto').scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      })
      .catch(err => {
        console.error('خطا در بارگذاری لیست:', err);
        tbody.innerHTML = `<tr><td colspan="5" class="text-center">خطا در بارگذاری داده‌ها</td></tr>`;
      });
  }

  document.addEventListener('click', function(e) {
    const link = e.target.closest('#paginationContainer a[data-page]');
    if (!link) return;

    e.preventDefault();
    e.stopPropagation();

    const parentLi = link.closest('.page-item');
    if (parentLi && parentLi.classList.contains('disabled')) return;

    const page = parseInt(link.dataset.page);
    if (isNaN(page)) return;
    if (page === currentPage) return;

    loadPage(page);
  });
</script>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>