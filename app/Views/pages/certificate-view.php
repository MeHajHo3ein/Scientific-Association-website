<?php
$siteName = setting('site_name', 'انجمن علمی دانشگاه خوارزمی(شهرضا)') . ' - گواهی';
$pageTitle = $pageTitle ?? $siteName;
$bodyClass = 'bg-secondary-subtle';
include '../app/Views/layouts/header.php';
include '../app/Views/partials/navbar.php';

$result = $result ?? [];
$studentName = $_SESSION['full_name'] ?? '';

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$baseUrl = $protocol . '://' . $host;
$verifyUrl = $baseUrl . '/certificates';
?>

<br>
<br>
<div class="container py-5">
  <?php if (!empty($result) && isset($result['is_passed']) && $result['is_passed'] == true): ?>
    <div id="certificate" class="certificate-container">
      <div class="certificate-border">
        <div class="certificate-content">
          <h1 class="certificate-title">گواهی‌نامه پایان دوره</h1>
          <p class="certificate-text">
            این گواهی تأیید می‌کند که دانشجو پس از طی ارزیابی نهایی، موفق به کسب نمره
            قبولی شده است
          </p>
          <p class="certificate-main">
            اینجانب
            <span class="highlight-name"> <?= htmlspecialchars($result['student_name'] ?? $studentName) ?> </span> با موفقیت دوره
            <span class="highlight-course"> <?= htmlspecialchars($result['course_name'] ?? '') ?> </span>
            را گذراندم
          </p>
          <div class="row mt-5">
            <div class="col-md-4">
              <p class="info-label">تاریخ صدور:</p>
              <p class="info-value"><?= toJalali($result['completed_at'] ?? date('Y-m-d H:i:s'), 'Y/m/d') ?></p>
            </div>
            <div class="col-md-4">
              <p class="info-label">نمره نهایی:</p>
              <p class="info-value"><?= toPersianNumber($result['percentage'] ?? 0) ?> از ۱۰۰</p>
            </div>
            <div class="col-md-4">
              <p class="info-label">مدرس:</p>
              <p class="info-value"><?= htmlspecialchars($result['teacher_name'] ?? '') ?></p>
            </div>
          </div>

          <div class="row mt-5 signatures">
            <div class="col-6">
              <p class="signature-label">مدیر برنامه</p>
              <div class="signature-line"></div>
              <p class="signature-label">مدیر برنامه</p>
            </div>
            <div class="col-6">
              <p class="signature-label">مدرس دوره</p>
              <div class="signature-line"></div>
              <p class="signature-label"><?= htmlspecialchars($result['teacher_name'] ?? 'مدرس دوره') ?></p>
            </div>
          </div>

          <div class="certificate-footer">
            <p class="footer-text">کد گواهی: <?= htmlspecialchars($result['certificate_code'] ?? 'هنوز تولید نشده') ?></p>
            <p class="footer-text">برای صحت‌سنجی: <?= $verifyUrl ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <button id="downloadBtn" class="btn btn-primary btn-lg">چاپ گواهی</button>
    </div>
  <?php else: ?>
    <div class="container py-5">
      <div class="alert alert-danger text-center">
        <h4>نتیجه آزمون</h4>
        <p>شما در این آزمون شرکت نکرده‌اید یا نتیجه‌ای یافت نشد.</p>
        <a href="/certificates" class="btn btn-primary">بازگشت به لیست آزمون‌ها</a>
      </div>
    </div>
  <?php endif; ?>
</div>

<script src="/assets/js/html2canvas.min.js.js"></script>
<script>
  function toPersianNumberJS(num) {
    const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return String(num).split('').map(d => persianDigits[d] ?? d).join('');
  }

  document.addEventListener("DOMContentLoaded", function() {
    const downloadBtn = document.getElementById("downloadBtn");
    const certificate = document.getElementById("certificate");

    if (downloadBtn && certificate) {
      downloadBtn.addEventListener("click", function() {
        downloadBtn.textContent = "در حال تولید...";
        downloadBtn.disabled = true;

        html2canvas(certificate, {
          scale: 2,
          backgroundColor: "#ffffff",
          logging: false,
          useCORS: true,
        }).then((canvas) => {
          const link = document.createElement("a");
          link.download = "certificate.png";
          link.href = canvas.toDataURL("image/png");
          link.click();

          downloadBtn.textContent = "چاپ گواهی";
          downloadBtn.disabled = false;
        }).catch(error => {
          console.error("Error generating certificate:", error);
          downloadBtn.textContent = "چاپ گواهی";
          downloadBtn.disabled = false;
          alert("خطا در تولید گواهی. لطفاً مجدداً تلاش کنید.");
        });
      });
    }
  });
</script>

<br>
<br>
<?php
include '../app/Views/partials/main-footer.php';
include '../app/Views/layouts/footer.php';
?>