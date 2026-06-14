let questionCounter = 0;

const defaultOptions = {
  truefalse: ["", ""],
  multiple: ["", "", "", ""],
};

function getOptionsHTML(questionNum, type) {
  let html = '<div class="row g-3 mt-2">';
  const labels = ["الف", "ب", "ج", "د"];
  let options = defaultOptions[type] || defaultOptions.multiple;

  for (let i = 0; i < options.length; i++) {
    if (i % 2 === 0) html += '<div class="col-md-6">';
    html += `
        <div class="mb-2">
            <label class="option-label">گزینه ${labels[i]}</label>
            <div class="input-group">
                <input type="text" class="form-control option-text" name="questions[${questionNum}][options][${i}]" placeholder="گزینه ${labels[i]}" value="${options[i]}">
                <span class="input-group-text">
                    <input class="form-check-input correct-radio" type="radio" name="questions[${questionNum}][correct_answer]" value="${String.fromCharCode(65 + i)}" aria-label="صحیح">
                    <span class="me-1">صحیح</span>
                </span>
            </div>
        </div>
        `;
    if (i % 2 === 1 || i === options.length - 1) html += "</div>";
  }
  html += "</div>";
  return html;
}

function renderOptions(questionNum, type) {
  const container = document.getElementById(`options-${questionNum}`);
  if (container) {
    container.innerHTML = getOptionsHTML(questionNum, type);
  }
}

function changeQuestionType(selectEl, questionNum) {
  const type = selectEl.value;
  const card = document.getElementById(`question-${questionNum}`);
  const codeSection = card.querySelector(".code-block-section");

  if (type === "codeoutput") {
    codeSection.classList.remove("d-none");
    renderOptions(questionNum, "multiple");
  } else {
    codeSection.classList.add("d-none");
    renderOptions(questionNum, type);
  }
}

function addQuestion() {
  const container = document.getElementById("questionsList");
  const questionNum = questionCounter;

  const div = document.createElement("div");
  div.className = "question-card border rounded p-3 mb-3";
  div.id = `question-${questionNum}`;
  div.innerHTML = `
    <div class="question-header d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-bold">سؤال ${questionCounter + 1}</h5>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeQuestion(${questionNum})" title="حذف">
                <i class="bi bi-x-lg"></i> حذف
            </button>
        </div>
    </div>
    <div class="p-0">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">نوع سوال</label>
                <select class="form-select question-type" name="questions[${questionNum}][type]" onchange="changeQuestionType(this, ${questionNum})">
                    <option value="truefalse">صحیح/غلط</option>
                    <option value="multiple" selected>چند گزینه‌ای</option>
                    <option value="codeoutput">خروجی کد</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">نمره سوال</label>
                <input type="number" class="form-control" min="1" value="1" name="questions[${questionNum}][score]">
            </div>
        </div>
        <div class="mt-3">
            <label class="form-label">متن سوال</label>
            <textarea class="form-control" rows="3" placeholder="متن سوال را وارد کنید..." name="questions[${questionNum}][text]" required></textarea>
        </div>
        <div class="code-block-section mt-3 d-none">
            <label class="form-label">بلوک کد</label>
            <textarea class="form-control" rows="3" placeholder="کد خود را اینجا وارد کنید..." name="questions[${questionNum}][code_block]"></textarea>
        </div>
        <div class="options-container" id="options-${questionNum}"></div>
    </div>
    `;

  container.appendChild(div);
  renderOptions(questionNum, "multiple");
  questionCounter++;
}

function removeQuestion(num) {
  const el = document.getElementById(`question-${num}`);
  if (el) {
    el.remove();
    renumberQuestions();
  }
}

function renumberQuestions() {
  const cards = document.querySelectorAll(".question-card");
  cards.forEach((card, index) => {
    const header = card.querySelector("h5");
    header.textContent = `سؤال ${index + 1}`;

    const inputs = card.querySelectorAll('[name^="questions["]');
    inputs.forEach((input) => {
      const oldName = input.getAttribute("name");
      const newName = oldName.replace(/questions\[\d+\]/, `questions[${index}]`);
      input.setAttribute("name", newName);
    });
  });
}

document.addEventListener("DOMContentLoaded", function () {
  addQuestion();
});
