import AtorListItem from "./components/AtorListItem.js";
import RemoveButton from "./components/RemoveButton.js";
import {
  enableButtonOnAtorList,
  setElencoState,
  getCurrentFormState,
} from "./formValidation.js";
import { validateNomePessoa } from "./formValidation.js";

const assertTargetIsButton = (target) => {
  if (target.tagName == "svg") {
    return target.parentElement;
  } else if (target.tagName == "path") {
    return target.parentElement.parentElement;
  }
  return target;
};

function createAtorListItem(inputAtor) {
  const li = AtorListItem(inputAtor.value);
  li.appendChild(RemoveButton(removeAtor));
  document.getElementById("elenco-list").appendChild(li);
}

export const getElenco = () => JSON.parse(localStorage.getItem("elenco"));

const getInputAtor = (event) =>
  assertTargetIsButton(event.target).parentElement.querySelector("input");

const updateFormState = (elencoAtual) => {
  const isValid = elencoAtual.length >= 2;

  const input = document.querySelector('input[name="elenco_input_list"]');
  const fieldLabel = input.parentElement.parentElement.querySelector("label");

  input.setAttribute("isvalid", isValid);
  fieldLabel.setAttribute("isvalid", isValid);

  setElencoState(isValid);
  enableButtonOnAtorList(getCurrentFormState());
};

export function addAtor(event) {
  const inputAtor = getInputAtor(event);

  const ator = inputAtor.value;
  if (validateNomePessoa(ator)) {
    createAtorListItem(inputAtor);
    const elencoAtual = getElenco();
    elencoAtual.push(ator);
    localStorage.setItem("elenco", JSON.stringify(elencoAtual));
    updateFormState(elencoAtual);
  }

  inputAtor.value = "";
  inputAtor.focus();
}

function removeAtor(event) {
  const li = assertTargetIsButton(event.target).parentElement;
  const ator = li.querySelector("span").textContent;

  const elencoAtual = getElenco().filter((atorSalvo) => atorSalvo != ator);
  localStorage.setItem("elenco", JSON.stringify(elencoAtual));

  li.parentElement.removeChild(li);
  updateFormState(elencoAtual);
}
