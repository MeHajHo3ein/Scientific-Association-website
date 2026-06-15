<?php
$pageTitle = 'پنل شخصی - دوره ها';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$totalPages = $totalPages ?? 1;
$page = $page ?? 1;
$perPage = 12;
?>

<?php if (isset($_SESSION['success'])): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['success']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <h3 class="text-primary">دوره های بارگزاری شده</h3>
  <div
    id=""
    class="alert alert-warning text-black alert-dismissible m-3 fade show"
    role="alert">
    برای بارگزاری ویدیو/فایل های خود ابتدا وارد این سایت
    <a class="alert-link link-warning text-dark" href="www.example-upload-host.com">www.example-upload-host.com</a>
    شده و آموزش های این ویدیو
    <a
      class="alert-link link-warning text-dark"
      href="www.example-upload-host.com/training-vedio.mp4">training-vedio.mp4</a>
    را دنبال کرده و لینک های دریافتی خود را در قسمت مناسب جای گزاری کنید.
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"></button>
  </div>
  <a href="/panel/courses/create" class="btn btn-primary d-block w-100 my-1">افزودن</a>
  <div class="container overflow-auto">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>شماره</th>
          <th>عنوان</th>
          <th>مدرس</th>
          <th>هزینه</th>
          <th>دسته بندی</th>
          <th>مدت دوره</th>
          <th>تعداد دانشجو</th>
          <th>تاریخ انتشار</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody id="coursesTableBody">
        <?php if (empty($courses)): ?>
          <tr>
            <td colspan="9" class="text-center">هیچ دوره‌ای یافت نشد.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($courses as $index => $course): ?>
            <tr id="course-row-<?= $course['id'] ?>">
              <td><?= $index + 1 + (($page - 1) * $perPage) ?></td>
              <td><?= htmlspecialchars($course['title']) ?></td>
              <td><?= htmlspecialchars($course['instructor_name']) ?></td>
              <td><?= $course['price'] > 0 ? number_format($course['price']) . ' تومان' : 'رایگان' ?></td>
              <td><?= htmlspecialchars($course['category']) ?></td>
              <td><?= htmlspecialchars($course['duration']) ?></td>
              <td><?= number_format($course['student_count']) ?> نفر</td>
              <td><?= toJalali($course['created_at'], 'Y/m/d') ?></td>
              <td class="">
                <a href="/panel/courses/delete/<?= $course['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف این دوره مطمئن هستید؟')">حذف</a>
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
      <nav aria-label="Page navigation courseple" class="mt-3">
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

  function renderTable(courses, page, perPage) {
    const tbody = document.getElementById('coursesTableBody');

    if (!courses || courses.length === 0) {
      tbody.innerHTML = `<tr><td colspan="9" class="text-center">هیچ دوره‌ای یافت نشد.</td></tr>`;
      return;
    }

    let html = '';
    courses.forEach((course, idx) => {
      const number = (page - 1) * perPage + idx + 1;
      html += `
        <tr id="course-row-${course.id}">
          <td>${escapeHtml(number)}</td>
          <td>${escapeHtml(course.title)}</td>
          <td>${escapeHtml(course.instructor_name)}</td>
          <td>${escapeHtml(course.price)}</td>
          <td>${escapeHtml(course.category)}</td>
          <td>${escapeHtml(course.duration)}</td>
          <td>${escapeHtml(course.student_count)}</td>
          <td>${escapeHtml(course.created_at_fa)}</td>
          <td>
            <a href="/panel/courses/delete/${course.id}" class="btn btn-danger" onclick="return confirm('آیا از حذف این دوره مطمئن هستید؟')">حذف</a>
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

    const tbody = document.getElementById('coursesTableBody');
    fetch(`/api/courses/list?page=${page}`)
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