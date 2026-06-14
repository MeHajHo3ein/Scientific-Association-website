<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - گواهی';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$exams = $exams ?? [];
$certificate = $certificate ?? null;
$error = $error ?? null;
$code = $_GET['code'] ?? '';

$isLoggedIn = isset($_SESSION['user_id']);
$isStudent = $isLoggedIn && ($_SESSION['role'] === 'student');
?>

<!-- Error -->
<?php if ($error): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= htmlspecialchars($error) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<!-- Success Alert for Certificate View -->
<?php if ($certificate): ?>
  <div id="myAlert" class="alert alert-success alert-dismissible fixed-top m-3 fade show" role="alert">
    <strong>گواهی معتبر است!</strong><br>
    این گواهی برای <strong><?= htmlspecialchars($certificate['student_name']) ?></strong> صادر شده است.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['success']) ?>
<?php endif; ?>

<?php if (isset($_SESSION['exam_error'])): ?>
  <div id="myAlert" class="alert alert-danger alert-dismissible fixed-top m-3 fade show" role="alert">
    <?= $_SESSION['exam_error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php unset($_SESSION['exam_error']); ?>
<?php endif; ?>


<!-- Hero -->
<div class="hero-margin">
  <br />
  <br />
  <div
    class="container text-center bg-white shadow-lg p-5 rounded-3 border-5 border-primary border-start">
    <h1>صحت‌سنجی گواهی‌نامه</h1>
    <p>
      برای بررسی اعتبار گواهی، کد یکتا را وارد کنید. سپس به صفحه نتیجه صحت‌سنجی منتقل
      می‌شوید.
    </p>
    <form class="d-flex mx-auto my-3 my-xxl-0 search-box" action="/certificates/verify" role="search" method="GET">
      <input
        class="form-control rounded-3 mx-4"
        type="search"
        name="code"
        placeholder="کد گواهی را وارد کنید..."
        value="<?= htmlspecialchars($code) ?>" />
      <button class="btn btn-primary rounded-3" type="submit">
        بررسی
      </button>
    </form>
  </div>
  <br />
</div>

<!--Main-->
<div class="container">
  <h3 class="text py-3">دروسی که با قبولی در آن‌ها گواهی صادر می‌شود</h3>

  <?php if (empty($exams)): ?>
    <div class="text-center">هیچ آزمونی برای دریافت گواهی وجود ندارد.</div>
  <?php else: ?>
    <?php foreach ($exams as $exam): ?>
      <div class="card rounded-3 border-0 shadow-sm mt-4">
        <div class="card-body bg-white border-5 border-primary border-start rounded-3">
          <h4 class="card-title"><?= htmlspecialchars($exam['title']) ?></h4>
          <p class="text-muted">
            <span>دوره: <?= htmlspecialchars($exam['course_name']) ?></span> |
            <span>مدرس: <?= htmlspecialchars($exam['teacher_name']) ?></span> |
            <span>حداقل نمره قبولی: <?= $exam['pass_score'] ?>%</span>
          </p>
          <div class="d-flex justify-content-between flex-sm-row flex-column">
            <p class="card-text">برای دریافت گواهی معتبر، در <?= htmlspecialchars($exam['title']) ?> شرکت کنید و نمره قبولی کسب کنید.</p>
            <?php if (!$isLoggedIn): ?>
              <a
                href="/certificates/exam/<?= $exam['id'] ?>"
                class="btn btn-outline-primary border-1 rounded-3">
                شروع آزمون
              </a>
            <?php elseif (!$isStudent): ?>
              <!-- <button class="btn btn-outline-secondary border-1 rounded-3" disabled>
                فقط دانشجویان می‌توانند در آزمون شرکت کنند
              </button> -->
              <a
                href="/certificates/exam/<?= $exam['id'] ?>"
                class="btn btn-outline-primary border-1 rounded-3">
                شروع آزمون
              </a>
            <?php else: ?>
              <a
                href="/certificates/exam/<?= $exam['id'] ?>"
                class="btn btn-outline-primary border-1 rounded-3">
                شروع آزمون
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<br>
<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>