function updateNotificationCount() {
  fetch("/api/notifications/count")
    .then((response) => response.json())
    .then((data) => {
      const badge = document.getElementById("notificationBadge");
      if (badge) {
        const count = data.count || 0;
        badge.textContent = count;
        badge.style.display = count > 0 ? "inline-block" : "none";
      }
    })
    .catch((err) => console.log("خطا:", err));
}

if (document.getElementById("notificationBadge")) {
  updateNotificationCount();
  setInterval(updateNotificationCount, 30000);
}
