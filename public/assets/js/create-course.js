/* -------- Image Preview -------- */

const imageInput = document.getElementById("image");
const imagePreview = document.getElementById("imagePreview");

imageInput.addEventListener("change", () => {
  const file = imageInput.files[0];
  if (!file) {
    imagePreview.innerHTML = "بدون تصویر";
    return;
  }

  // Validation سایز و نوع
  const maxSize = 2 * 1024 * 1024; // 2MB
  if (!file.type.startsWith("image/")) {
    alert("فایل انتخاب‌شده تصویر نیست.");
    imageInput.value = "";
    imagePreview.innerHTML = "بدون تصویر";
    return;
  }
  if (file.size > maxSize) {
    alert("حجم تصویر نباید بیشتر از 2 مگابایت باشد.");
    imageInput.value = "";
    imagePreview.innerHTML = "بدون تصویر";
    return;
  }

  // نمایش پیش‌نمایش
  const reader = new FileReader();
  reader.onload = (e) => {
    imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="Course Image">';
  };
  reader.readAsDataURL(file);
});

/* -------- Dynamic Prerequisites -------- */

const prereqList = document.getElementById("prereqList");
const addPrereqBtn = document.getElementById("addPrereqBtn");

let prereqCounter = 0;

function addPrerequisite(value = "") {
  const wrapper = document.createElement("div");
  wrapper.className = "dynamic-item mb-2 p-2 border rounded";
  wrapper.dataset.type = "prerequisite";

  wrapper.innerHTML = `
    <div class="d-flex justify-content-between">
      <span>پیش‌نیاز</span>
      <button type="button" class="btn btn-danger btn-sm js-remove">حذف</button>
    </div>
    <input class="C-input w-100 mt-1" type="text" name="prerequisites[]" placeholder="مثلاً آشنایی با HTML" value="${value.replace(/"/g, "&quot;")}">
  `;

  prereqList.appendChild(wrapper);
  prereqCounter++;
}

addPrereqBtn.addEventListener("click", () => {
  addPrerequisite();
});

prereqList.addEventListener("click", (e) => {
  if (e.target.classList.contains("js-remove")) {
    const item = e.target.closest(".dynamic-item");
    if (item) item.remove();
  }
});

/* -------- Dynamic Sections  -------- */

const sectionsList = document.getElementById("sectionsList");
const addSectionBtn = document.getElementById("addSectionBtn");

let sectionCounter = 0;

function addSection(data = { title: "", description: "", download_link: "" }) {
  const wrapper = document.createElement("div");
  wrapper.className = "dynamic-item";
  wrapper.dataset.type = "section";

  wrapper.innerHTML = `
    <div class="dynamic-item-header">
      <span>سرفصل</span>
      <button type="button" class="btn btn-danger btn-sm js-remove">حذف</button>
    </div>
    <div class="form-group mt-2">
      <label>عنوان سرفصل</label>
      <input class="C-input w-100" type="text" name="syllabus[${sectionCounter}][title]" placeholder="مثلاً مقدمه‌ای بر دوره" value="${data.title.replace(/"/g, "&quot;")}">
    </div>
    <div class="form-group">
      <label>توضیح سرفصل</label>
      <textarea class="C-textarea w-100" name="syllabus[${sectionCounter}][description]" placeholder="در این بخش چه چیزهایی آموزش داده می‌شود؟">${data.description.replace(/"/g, "&quot;")}</textarea>
    </div>
    <div class="form-group">
      <label>لینک ویدیو</label>
      <input class="C-input" placeholder="لینک دریافتی خود از سایت هاست دانلودی خود را اینجا جایگزاری کنید.">${data.download_link}</input>
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
