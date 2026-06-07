<?php
$pageTitle = 'پنل شخصی - تیکت';
include '../app/Views/layouts/dashboard/header.php';
include '../app/Views/layouts/dashboard/sidebar.php';

$tickets = $tickets ?? [];
?>

<!-- Main Content -->
<div class="col-md-10 offset-md-2 p-4">
  <div class="container">
    <h3 class="text-primary">تیکت های ارسالی</h3>

    <form
      action="/panel/tickets/store"
      id="ticket"
      class="mt-2 bg-white border-4 border-primary border-start rounded-3 p-4" method="POST">
      <label for="title" class="form-label">عنوان</label>
      <input
        type="text"
        class="form-control rounded-end-2 border-1"
        id="title"
        name="title"
        placeholder="عنوان مورد نظر خود را بنویسید."
        required
        minlength="3" />

      <label for="message" class="form-label">متن</label>
      <textarea
        type="text"
        class="form-control rounded-end-2 border-1"
        id="message"
        name="message"
        placeholder="متن مورد نظر خود را بنویسید."
        required
        minlength="3"></textarea>
      <button
        type="submit"
        class="btn btn-primary w-100 mt-4 border-1"
        id="ticket-submitBtn">
        ارسال
      </button>
    </form>

    <hr />

    <?php if (empty($tickets)): ?>
      <div class="text-center">شما هیچ تیکتی ارسال نکرده اید</div>
    <?php else: ?>
      <div class="row gy-3">
        <?php foreach ($tickets as $ticket): ?>
          <div class="col-12 bg-primary-subtle p-3 rounded-3">
            <div class="container d-flex justify-content-between">
              <span class="row d-flex">
                <h5 class="mx-2">
                  <?= htmlspecialchars($ticket['title']); ?>
                  <?php if ($ticket['is_read_admin'] == 0): ?>
                    <span class="badge bg-danger">خوانده نشده</span>
                  <?php else: ?>
                    <span class="badge bg-primary ">خوانده شده</span>
                  <?php endif; ?>
                </h5>
                <p><?= nl2br(htmlspecialchars($ticket['message'])); ?></p>
              </span>
              <span class="text-decoration-none text-sm-center text-black">
                <?= toJalali($ticket['created_at'], 'Y/m/d'); ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php
include '../app/Views/layouts/dashboard/footer.php';
?>