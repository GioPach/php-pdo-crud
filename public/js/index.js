import { validateField, validateForm } from "./formValidation.js";

document.addEventListener("DOMContentLoaded", () => {
  configForm();
});

function configForm() {
  const form = document.querySelector("form");
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateForm(form)) {
      form.submit();
    }
  });

  const fields = Array.from(document.querySelectorAll("input")).concat(
    Array.from(document.querySelectorAll("textarea"))
  );
  fields.forEach((field) => {
    field.addEventListener("input", validateField);
  });
}
