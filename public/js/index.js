import { validateField, validateForm } from "./formValidation.js";
import { addAtor } from "./elenco.js";

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

  document
    .querySelector(".add-ator")
    .addEventListener("click", (e) => addAtor(e));
}
