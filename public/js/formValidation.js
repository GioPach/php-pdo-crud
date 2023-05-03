//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Global Form State => everything is true = can be submitted
//*                   => something is false = cannot

import { getElenco } from "./elenco.js";

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
const formState = {
  nome: false,
  descricao: false,
  diretor: false,
  elenco: false,
};

export const getCurrentFormState = () => formState;
export const setElencoState = (isValid) => {
  formState.elenco = isValid;
};

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Validation Methods
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==

const isValid = (field) => field == true;
const minTwoCharacters = (string) => string.length >= 2;
export const validateNomePessoa = (nome) => {
  const partesNome = nome.trim().split(" ");
  return partesNome.length >= 2 && partesNome.every(minTwoCharacters);
};
const validateText = (text) => text.trim().length >= 10 && text.length <= 100;

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
};

//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==
//* Methods used only on form submission
//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==//=-=-=-=-=-=-=-==

/**
 * Guarantees that all fields follow the rules defined
 * to submit the form
 * @param {HTMLElement} form
 * @returns result of validation
 */
export function validateForm() {
  document.querySelector('input[name="elenco"]').value = getElenco().join(", ");
  return Object.values(formState).every(isValid);
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

export function enableButtonOnAtorList(state) {
  const button = document.querySelector('button[type="submit"]');
  if (Object.values(state).every(isValid)) {
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
  if (!this.name.includes("elenco")) {
    let validation = false;
    if (rules[this.name](this.value)) validation = true;
    updateFieldState(this, validation);
    formState[this.name] = validation;
  }
  checkButtonEnabling();
}

const getLabel = (field) => {
  if (field.classList.contains("iconed")) {
    return field.parentElement.parentElement.querySelector("label");
  }
  return field.parentElement.querySelector("label");
};

/**
 * Used to trigger the validation classes tuned by
 * isValid boolean attribute.
 * @param {HTMLElement} field input or textarea
 */
export const updateFieldState = (field, isValid) => {
  const fieldLabel = getLabel(field);
  field.setAttribute("isvalid", isValid);
  fieldLabel.setAttribute("isvalid", isValid);
};
