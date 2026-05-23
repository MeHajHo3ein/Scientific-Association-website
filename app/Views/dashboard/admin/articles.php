<?php
$pageTitle = 'پنل شخصی - مقالات';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
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
  <h3 class="text-primary">مقالات بارگزاری شده</h3>
  <a href="/panel/articles/create" class="btn btn-primary d-block w-100 my-1">افزودن</a>
  <div class="container overflow-auto">
    <!--            <div id="addarticles" class="modal fade show">-->
    <!--                <form class="form-control container">-->
    <!--                    <label class="form-label">عنوان مقاله</label>-->
    <!--                    <input class="d-block w-100" type="text">-->
    <!--                    <label class="form-label">چکیده مقاله</label>-->
    <!--                    <input class="d-block w-100" type="text">-->
    <!--                    <label class="form-label">متن مقاله</label>-->
    <!--                    <textarea class="d-block w-100" type="text"></textarea>-->
    <!--                    <button type="submit" class="btn btn-success w-100 fw-semibold py-2 mt-5" id="submitBtn">-->
    <!--                        ثبت‌-->
    <!--                    </button>-->
    <!--                    <button-->
    <!--                            class="btn btn-danger my-1 w-100"-->
    <!--                            onclick="closeModal('addarticles')">-->
    <!--                        بستن-->
    <!--                    </button>-->
    <!--                </form>-->
    <!--            </div>-->

    <!--            <div class="row mt-3">-->
    <!--                <div class="col-12">-->
    <!--                    <div class="card border-0 shadow-sm ">-->
    <!--                        <div class="card-body bg-white border-start border-primary border-5 ">-->
    <!--                            <h3 class="card-title py-2">آینده برنامه‌نویسی وب در عصر هوش مصنوعی</h3>-->
    <!--                            <p class="card-subtitle text-secondary py-2">-->
    <!--                                <span>نویسنده:</span>-->
    <!--                                <span>حسام کریمی</span>-->
    <!--                                |-->
    <!--                                <span>۱۴۰۵/۰۸/۲</span>-->
    <!--                            </p>-->
    <!--                            <p class="card-text py-2">-->
    <!--                                چگونه فناوری‌های هوش مصنوعی می‌توانند ساختار توسعه وب را در دهه آینده متحول-->
    <!--                                کنند؟-->
    <!--                            </p>-->
    <!--                            <div class="d-flex justify-content-between">-->
    <!--                                <a href="../../articles-detail.html"-->
    <!--                                   class="text-primary link-dark text-decoration-none py-2 h5">ادامه مطلب</a>-->
    <!--                                <button class="btn btn-outline-danger border-1 py-2 h5">حذف مطلب</button>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <table class="table table-bordered table-hover table-striped">
      <tr>
        <th>شماره</th>
        <th>عنوان</th>
        <th>نویسنده</th>
        <th>تاریخ انتشار</th>
        <th>عملیات</th>
      </tr>
      <?php if (empty($articles)): ?>
        <tr>
          <td colspan="6" class="text-center">هیچ مقاله ای یافت نشد.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($articles as $index => $article): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($article['title']); ?></td>
            <td><?= htmlspecialchars($article['author_name']); ?></td>
            <td><?= toJalali($article['created_at'], 'Y/m/d'); ?></td>
            <td class="">
              <a href="/panel/articles/delete/<?= $article['id'] ?>" class="btn btn-danger" onclick="return confirm('آیا از حذف این مقاله مطمئن هستید؟');">حذف</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>

  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>