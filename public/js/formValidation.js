//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Global Form State => everything is true = can be submitted
//*                   => something is false = cannot
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
const formState = {
  nome: false,
  descricao: false,
  diretor: false,
  elenco: false,
};

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Validation Methods
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==

const isValid = (field) => field == true;
const minTwoCharacters = (string) => string.length >= 2;
const validateNomePessoa = (nome) => {
  const partesNome = nome.split(" ");
  return partesNome.length >= 2 && partesNome.every(minTwoCharacters);
};
const validateText = (text) => text.length >= 10 && text.length <= 100;

const validateElenco = (text) => {
  const nomesAtores = text.split(",").map((nome) => nome.trim());
  return nomesAtores.length >= 2 && nomesAtores.every(validateNomePessoa);
};

/**
 * Object to map which validation method
 * will be used for each form entry
 * (alternative for switch case)
 *
 * Invoking the method:
 *    rules["nome"] => gets the validation method for this field
 *    rules["nome"](value) => execs validation method with the param passed
 */
const rules = {
  nome: minTwoCharacters,
  descricao: validateText,
  diretor: validateNomePessoa,
  elenco: validateElenco,
};

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Methods used only on form submission
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==

/**
 * Used only on form submission
 * @param {FormData} formData object to serialize all form fields
 * @returns result of validation
 */
function validateAllFields(formData) {
  const validation = [];
  for (let [key, value] of formData.entries()) {
    validation.push(rules[key](value));
  }
  return validation;
}

/**
 * Guarantees that all fields follow the rules defined
 * to submit the form
 * @param {HTMLElement} form
 * @returns result of validation
 */
export function validateForm(form) {
  const formData = new FormData(form);
  return validateAllFields(formData).every(isValid);
}

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Live methods to tell the user if everything is right
//* while scoping the data to be submtited
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==

/**
 * Checks if formState is valid to enable submission
 * on every input change
 */
function checkButtonEnabling() {
  const button = document.querySelector('button[type="submit"]');
  if (Object.values(formState).every(isValid)) {
    button.disabled = false;
  } else {
    button.disabled = true;
  }
}

/**
 * Used to perform live validation, triggering
 * the classes for the value being entered by the user
 * and updating the formState global object.
 *
 ** "this" is the field itself passed during the
 ** addEventListener forEach loop (used at index.js)
 * @param {HTMLElement} form input or textarea
 */
export function validateField() {
  checkButtonEnabling();
  let validation = false;
  if (rules[this.name](this.value)) validation = true;
  updateFieldState(this, validation);
  formState[this.name] = validation;
  console.clear();
  console.log("validating field:", this.name, ", valid:", validation);
  console.log(formState);
  checkButtonEnabling();
}

/**
 * Used to trigger the validation classes tuned by
 * isValid boolean attribute.
 * @param {HTMLElement} field input or textarea
 */
const updateFieldState = (field, isValid) => {
  const fieldLabel = field.parentElement.querySelector("label");
  if (isValid) {
    field.setAttribute("isvalid", true);
    fieldLabel.setAttribute("isvalid", true);
  } else {
    field.setAttribute("isvalid", false);
    fieldLabel.setAttribute("isvalid", false);
  }
};
