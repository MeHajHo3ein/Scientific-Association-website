<div class="loader-wrapper">
  <div class="loader" id="loader"></div>
</div>

<script>
  function fetchAdminUnreadTicketsCount() {
    fetch('/api/tickets/count')
      .then(response => response.json())
      .then(data => {
        const badge = document.getElementById('ticketBadge');
        if (badge && data.count > 0) {
          badge.textContent = data.count;
          badge.style.display = 'inline-block';
        } else if (badge) {
          badge.style.display = 'none';
        }
      })
      .catch(error => console.error('Error fetching tickets count:', error));
  }

  if (document.getElementById('ticketBadge')) {
    fetchAdminUnreadTicketsCount();
    setInterval(fetchAdminUnreadTicketsCount, 30000);
  }
</script>

<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/admin.js"></script>
<script src="/assets/js/script.js"></script>
</body>

</html>