/* -------- Dynamic Sections  -------- */

const sectionsList = document.getElementById("sectionsList");
const addSectionBtn = document.getElementById("addSectionBtn");

let sectionCounter = 0;

function addSection(data = { title: "", description: "" }) {
  const wrapper = document.createElement("div");
  wrapper.className = "dynamic-item";
  wrapper.dataset.type = "section";

  wrapper.innerHTML = `
        <div class="dynamic-item-header d-flex justify-content-between">
            <span>ریزعنوان</span>
            <button type="button" class="btn btn-danger btn-sm js-remove">حذف</button>
        </div>
        <div class="form-group">
            <label>ریزعنوان</label>
            <input class="C-input js-section-title" type="text" name="sections[${sectionCounter}][title]" value="${data.title.replace(/"/g, "&quot;")}">
        </div>
        <div class="form-group">
            <label>توضیحات</label>
            <textarea class="js-section-desc C-textarea" name="sections[${sectionCounter}][description]">${data.description.replace(/"/g, "&quot;")}</textarea>
        </div>
    `;

  sectionsList.appendChild(wrapper);
  sectionCounter++;
}

addSectionBtn.addEventListener("click", () => {
  addSection();
});

sectionsList.addEventListener("click", (e) => {
  if (e.target.classList.contains("js-remove")) {
    const item = e.target.closest(".dynamic-item");
    if (item) item.remove();
  }
});

const courseForm = document.getElementById("courseForm");

if (courseForm) {
  courseForm.addEventListener("submit", function (e) {
    const titleInput = document.getElementById("title");
    const title = titleInput?.value.trim() || "";

    if (!title) {
      e.preventDefault();
      alert("عنوان مقاله الزامی است.");
      return;
    }

    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn && !submitBtn.disabled) {
      submitBtn.disabled = true;
    }
  });
}
