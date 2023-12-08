/*--------------------------------------------------------------
## Sección: Filtros de la categoría cafés
## Funcionalidad: Agregar clase "checked" o removerlo al checkbox personalizado
--------------------------------------------------------------*/
const checkboxes = document.querySelectorAll("input[type=checkbox]");


checkboxes.forEach((checkbox) => {

    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            checkbox.parentNode.classList.add("checked");
        } else {
            checkbox.parentNode.classList.remove("checked");
        }
    });
});

/*--------------------------------------------------------------
## Sección: Filtros de una categoría
## Funcionalidad: Marcar de color la categoria actual
--------------------------------------------------------------*/

let urlActual = window.location.href;
let segmentos = urlActual.split("/");
let categoriaActual = segmentos[segmentos.length - 2];

let categorias = document.querySelectorAll("a.category");

categorias.forEach((category) => {
    if (category.id === categoriaActual) {
        category.classList.add("selected");
    }
});

/*--------------------------------------------------------------
## Sección: Páginación
## Funcionalidad: Cambiar texto de Next y Prev por iconos "<" ">"
--------------------------------------------------------------*/
const $nextLink = document.querySelector("a.next");
const $prevLink = document.querySelector("a.prev");

if ($nextLink !== null) {
    $nextLink.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="Vector" d="M13.969 9L5.96897 17L5 16.031L12.031 9L5 1.96897L5.96897 1L13.969 9Z" fill="#4A4A4A"/>
        </svg>
    `;
}
if ($prevLink !== null) {
    $prevLink.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="Vector" d="M4.03103 9L12.031 1L13 1.96897L5.96897 9L13 16.031L12.031 17L4.03103 9Z" fill="#4A4A4A"/>
        </svg>
    `;
}
