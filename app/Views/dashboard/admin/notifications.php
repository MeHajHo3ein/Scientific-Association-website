<?php
$pageTitle = 'پنل شخصی - اعلانات';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';
?>


<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">فایل های بارگزاری شده</h3>
    <!-- Modal -->
    <button class="btn btn-primary w-100" onclick="openModal('addnotif')">
      افزودن
    </button>
    <div id="addnotif" class="modal">
      <form class="form-control container">
        <label class="form-label">عنوان پیام</label>
        <input class="d-block w-100" type="text">
        <label class="form-label">متن پیام</label>
        <input class="d-block w-100" type="text">
        <button type="submit" class="btn btn-success w-100 fw-semibold py-2 mt-5" id="submitBtn">
          ثبت‌
        </button>
        <button
          class="btn btn-danger my-1 w-100"
          onclick="closeModal('addnotif')">
          بستن
        </button>
      </form>
    </div>
    <!--Main Content-->
    <div class="bg-white p-4 border-3 border-primary border-start my-4">
      <div class="d-flex justify-content-between">
        <h3>عنوان</h3>
        <span class="text-primary">1404/10/2</span>
      </div>
      <p class="d-block">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum optio quas quis quod repellat! Ab
        animi perspiciatis reiciendis tenetur? Deserunt.
      </p>
      <button class="btn btn-outline-primary border-1" onclick="openModal('editnotif')">ویرایش</button>
      <button class="btn btn-outline-danger border-1">حذف</button>
      <div id="editnotif" class="modal">
        <form class="form-control container">
          <label class="form-label">عنوان پیام</label>
          <input class="d-block w-100" type="text">
          <label class="form-label">متن پیام</label>
          <input class="d-block w-100" type="text">
          <button type="submit" class="btn btn-success w-100 fw-semibold py-2 mt-5" id="submitBtn">
            ثبت‌
          </button>
          <button
            class="btn btn-danger my-1 w-100"
            onclick="closeModal('editnotif')">
            بستن
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>