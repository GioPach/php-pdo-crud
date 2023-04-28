export default function AtorListItem(ator) {
  const li = document.createElement("li");
  const span = document.createElement("span");
  span.textContent = ator;
  li.appendChild(span);
  return li;
}
