import AtorListItem from "./components/AtorListItem.js";
import RemoveButton from "./components/RemoveButton.js";

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

const handleAtorUx = (event) => {
  const inputAtor = assertTargetIsButton(
    event.target
  ).parentElement.querySelector("input");
  createAtorListItem(inputAtor);
  inputAtor.value = "";
  inputAtor.focus();
  return inputAtor;
};

export function addAtor(event) {
  const inputAtor = handleAtorUx(event);

  const elencoAtual = JSON.parse(localStorage.getItem("elenco"));
  elencoAtual.push(inputAtor.value);
  localStorage.setItem("elenco", JSON.stringify(elencoAtual));
}

function removeAtor(event) {
  const li = assertTargetIsButton(event.target).parentElement;
  li.parentElement.removeChild(li);

  //   const elencoAtual = JSON.parse(localStorage.getItem("elenco"));
  //   elencoAtual.push(inputAtor.value);
  //   localStorage.setItem("elenco", JSON.stringify(elencoAtual));
}
