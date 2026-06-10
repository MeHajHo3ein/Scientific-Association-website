  <!-- Toast Container -->
  <?php if (isset($showToasts) && $showToasts): ?>
    <div class="toast-container position-fixed top-0 start-0 p-3">
      <!-- Login success toast -->
      <?php if (isset($_SESSION['show_welcome']) && $_SESSION['show_welcome']): ?>
        <div id="loginToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              <?= htmlspecialchars($_SESSION['full_name'] ?? 'کاربر') ?> عزیز، خوش برگشتی! ورود موفقیت‌آمیز بود.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      <?php endif; ?>

      <!-- Registration success -->
      <?php if (isset($_SESSION['just_registered']) && $_SESSION['just_registered']): ?>
        <div id="registerToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              <?= htmlspecialchars($_SESSION['registered_name'] ?? 'کاربر') ?> عزیز، ثبت‌نام شما با موفقیت انجام شد! به انجمن علمی کامپیوتر خوش آمدید.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <!-- Scripts -->

  <?php if (isset($showToasts) && $showToasts): ?>
    <?php
    $showLoginToast = isset($_SESSION['show_welcome']) && $_SESSION['show_welcome'];
    $showRegisterToast = isset($_SESSION['just_registered']) && $_SESSION['just_registered'];
    ?>
    <?php if ($showLoginToast || $showRegisterToast): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          <?php if ($showLoginToast): ?>
            const loginToastEl = document.getElementById('loginToast');
            if (loginToastEl) {
              const toast = new bootstrap.Toast(loginToastEl, {
                delay: 4000
              });
              toast.show();
            }
          <?php endif; ?>

          <?php if ($showRegisterToast): ?>
            const registerToastEl = document.getElementById('registerToast');
            if (registerToastEl) {
              const toast = new bootstrap.Toast(registerToastEl, {
                delay: 5000
              });
              toast.show();
            }
          <?php endif; ?>
        });
      </script>
    <?php endif; ?>
    <?php
    // Clear toast flags after displaying
    unset($_SESSION['show_welcome']);
    unset($_SESSION['just_registered']);
    unset($_SESSION['registered_name']);
    ?>
  <?php endif; ?>

  <div class="loader-wrapper">
    <div class="loader" id="loader"></div>
  </div>

  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/script.js"></script>
  <script src="/assets/js/live-search.js"></script>
  </body>

  </html>