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
console.log(categorias);

categorias.forEach((category) => {
    if (category.id === categoriaActual) {
        category.classList.add("selected");
    }
});
