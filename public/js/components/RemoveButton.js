export default function RemoveButton(removeAtor) {
  const button = document.createElement("button");
  button.classList.add("btn-ator", "remove-ator");
  const icon = document.createElement("i");
  icon.classList.add("fa", "fa-minus");
  button.appendChild(icon);
  button.type = "button";
  button.addEventListener("click", removeAtor);
  return button;
}
