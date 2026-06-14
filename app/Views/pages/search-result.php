<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - خانه';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$query = $_GET['q'] ?? '';
$type = $_GET['type'] ?? 'all';
$category = $_GET['category'] ?? 'all';
$results = $results ?? [];
$totalItems = $totalItems ?? 0;

$categories = [
  'all' => 'همه',
  'network' => 'شبکه',
  'webdev' => 'توسعه وب',
  'ai' => 'هوش مصنوعی',
  'programming' => 'برنامه نویسی'
];
?>

<br />
<br />

<!--Search Bar-->
<div class="container mb-4 hero-margin">
  <div class="bg-white border-5 rounded-3 p-3 shadow-lg border-start border-primary">
    <h5 class="mb-3">نتایج جستجو</h5>
    <form id="search-form" class="row g-3" action="/search" method="GET">

      <div class="col-md-6">
        <label class="form-label small">عبارت جستجو</label>
        <input
          id="search-query"
          name="q"
          type="text"
          class="form-control border-2"
          placeholder="مثلاً: Python"
          value="<?= htmlspecialchars($query) ?>" />
      </div>

      <div class="col-md-3">
        <label class="form-label small">نوع محتوا</label>
        <select id="search-type" name="type" class="form-select border-2" onchange="this.form.submit()">
          <option value="all" <?= $type == 'all' ? 'selected' : '' ?>>همه</option>
          <option value="course" <?= $type == 'course' ? 'selected' : '' ?>>دوره</option>
          <option value="article" <?= $type == 'article' ? 'selected' : '' ?>>مقاله</option>
          <option value="resource" <?= $type == 'resource' ? 'selected' : '' ?>>فایل</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label small" for="search-category">دسته‌بندی</label>
        <select id="search-category" name="category" class="form-select border-2" onchange="this.form.submit()">
          <?php foreach ($categories as $key => $name): ?>
            <option value="<?= $key ?>" <?= $category == $key ? 'selected' : '' ?>><?= $name ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-outline-primary border-1 w-100">جستجو</button>
      </div>
    </form>

    <?php if (!empty($query)): ?>
      <p class="small text-muted mt-2">
        عبارت <span id="search-term-label" class="fw-bold">– <?= htmlspecialchars($query) ?></span>
      </p>
    <?php endif; ?>
  </div>
</div>

<!-- RESULT COUNT  -->
<div class="container mb-3">
  <span id="result-count-label" class="text-muted small">
    <?php if (!empty($query)): ?>
      <?= number_format($totalItems) ?> نتیجه یافت شد
    <?php endif; ?>
  </span>
</div>

<!--  RESULTS  -->
<div class="container d-flex flex-column gap-3" id="search-results">
  <?php if (empty($results)): ?>
    <div class="text-center">
      <?php if (empty($query)): ?>
        هیچ محتوایی یافت نشد.
      <?php else: ?>
        هیچ نتیجه‌ای برای "<?= htmlspecialchars($query) ?>" یافت نشد.
      <?php endif; ?>
    </div>
  <?php else: ?>
    <?php foreach ($results as $item): ?>
      <div class="card rounded-3">
        <div class="card-body">
          <?php
          $badgeClass = 'bg-secondary';
          $badgeText = '';
          $linkUrl = '#';
          $subtitle = '';
          $subtitleValue = '';

          switch ($item['content_type']) {
            case 'course':
              $badgeClass = 'bg-primary';
              $badgeText = 'دوره';
              $linkUrl = '/courses/' . urlencode($item['slug']);
              $levels = ['beginner' => 'مبتدی', 'intermediate' => 'متوسط', 'advanced' => 'پیشرفته'];
              $subtitle = 'سطح';
              $subtitleValue = $levels[$item['level']] ?? 'متوسط';
              $detailLink = 'مشاهده دوره';
              $highlightedTitle = highlightText($item['title'], $query);
              $description = htmlspecialchars(mb_substr(strip_tags($item['description'] ?? ''), 0, 200));
              break;
            case 'article':
              $badgeClass = 'bg-danger';
              $badgeText = 'مقاله';
              $linkUrl = '/articles/' . urlencode($item['slug']);
              $subtitle = 'نویسنده';
              $subtitleValue = htmlspecialchars($item['author_name'] ?? 'نامشخص');
              $detailLink = 'مطالعه مقاله';
              $highlightedTitle = highlightText($item['title'], $query);
              $description = htmlspecialchars(mb_substr(strip_tags($item['description'] ?? $item['content'] ?? ''), 0, 200));
              break;
            case 'resource':
              $badgeClass = 'bg-warning';
              $badgeText = 'فایل';
              $linkUrl = $item['file_link'] ?? '#';
              $subtitle = 'نوع فایل';
              $subtitleValue = htmlspecialchars($item['file_type'] ?? 'FILE');
              $detailLink = 'دانلود';
              $highlightedTitle = highlightText($item['title'], $query);
              $description = htmlspecialchars(mb_substr(strip_tags($item['description'] ?? ''), 0, 200));
              break;
            default:
              $badgeClass = 'bg-secondary';
              $badgeText = 'محتوا';
              $linkUrl = '#';
              $subtitle = '';
              $subtitleValue = '';
              $detailLink = 'مشاهده';
              $highlightedTitle = htmlspecialchars($item['title'] ?? '');
              $description = '';
          }
          ?>
          <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
          <h5 class="mt-2"><?= $highlightedTitle ?></h5>
          <?php if (!empty($subtitle)): ?>
            <p class="text-muted mb-1"><?= $subtitle ?>: <?= $subtitleValue ?></p>
          <?php endif; ?>
          <p class="mb-2"><?= $description ?>...</p>
          <a href="<?= $linkUrl ?>" class="text-primary link-success text-decoration-none" target="<?= $badgeText == 'فایل' ? '_blank' : '_self' ?>"><?= $detailLink ?></a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<br>

<!-- <script src="/assets/js/search.js"></script> -->
<!-- <script src="/assets/js/live-search.js"></script> -->

<script src="/assets/js/notification-api.js"></script>

<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>