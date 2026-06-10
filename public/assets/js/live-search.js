const searchInput = document.getElementById("search-input-live");
const resultsDiv = document.getElementById("live-results");
let timeout = null;

if (searchInput) {
  searchInput.addEventListener("input", function () {
    clearTimeout(timeout);

    let query = this.value.trim();

    if (query.length < 2) {
      if (resultsDiv) resultsDiv.style.display = "none";
      return;
    }

    timeout = setTimeout(() => {
      fetch("/api/live-search?q=" + encodeURIComponent(query))
        .then((res) => res.json())
        .then((data) => {
          if (resultsDiv) {
            resultsDiv.innerHTML = "";
            if (data.length > 0) {
              resultsDiv.style.display = "block";
              data.forEach((item) => {
                let div = document.createElement("div");
                div.className = "result-item";

                let url = "#";
                let target = "_self";
                let badgeText = "";
                let badgeClass = "";

                switch (item.type) {
                  case "course":
                    url = "/courses/" + encodeURIComponent(item.slug);
                    badgeText = "دوره";
                    badgeClass = "badge-course";
                    break;
                  case "article":
                    url = "/articles/" + encodeURIComponent(item.slug);
                    badgeText = "مقاله";
                    badgeClass = "badge-article";
                    break;
                  case "resource":
                    url = item.file_link || "#";
                    target = "_blank";
                    badgeText = "فایل";
                    badgeClass = "badge-file";
                    break;
                  default:
                    url = "#";
                }

                div.innerHTML = `
                  <div class="d-flex align-items-center justify-content-between">
                    <a href="${url}" target="${target}" class="flex-grow-1">${highlightText(item.title, query)}</a>
                    <span class="badge ${badgeClass} ms-2">${badgeText}</span>
                  </div>
                `;
                resultsDiv.appendChild(div);
              });
            } else {
              resultsDiv.style.display = "none";
            }
          }
        })
        .catch((error) => console.error("Error:", error));
    }, 400);
  });
}

function highlightText(text, query) {
  if (!query || query.length < 2) return escapeHtml(text);

  const keywords = query.trim().split(/\s+/);
  let highlighted = escapeHtml(text);

  keywords.forEach((keyword) => {
    if (keyword.length < 2) return;
    const regex = new RegExp(`(${escapeRegex(keyword)})`, "gi");
    highlighted = highlighted.replace(regex, "<mark>$1</mark>");
  });

  return highlighted;
}

function escapeHtml(text) {
  if (!text) return "";
  const div = document.createElement("div");
  div.textContent = text;
  return div.innerHTML;
}

function escapeRegex(string) {
  return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}
