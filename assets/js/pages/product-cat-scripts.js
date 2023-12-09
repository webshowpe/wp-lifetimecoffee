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
let categoriaActualSlug = segmentos[segmentos.length - 2];

let categorias = document.querySelectorAll("a.category");

categorias.forEach((category) => {
    if (category.id === categoriaActualSlug) {
        category.classList.add("selected");
    }
});

/*--------------------------------------------------------------
## Sección: Paginación
## Funcionalidad: Cambiar texto de Next y Prev por iconos "<" ">"
--------------------------------------------------------------*/
function asignarIconosNextPrev() {
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
}
asignarIconosNextPrev();

/*--------------------------------------------------------------
## Sección: Productos y Paginación
## Funcionalidad: Mediante ajax enviar filtros y solicitar una nueva
   product_list y pagination
--------------------------------------------------------------*/
let currentPage = 1;

jQuery(document).ready(function($) {
    // Manejar el cambio de checkboxes de atributos mediante AJAX
    $('input[type="checkbox"]').change(function() {
        currentPage = 1;
        filterProducts();
    });

    // Manejar el cambio de página mediante AJAX
    $('.product-pagination').on('click', '.page-numbers', function(e) {
        e.preventDefault();
        
        if ($(this).hasClass('next')) {
            currentPage ++;
        } else if($(this).hasClass('prev')) {
            currentPage --;
        } else {
            currentPage = parseInt($(this).text());
        }
        filterProducts();
    });

    // Realizar funcion AJAX
    function filterProducts() {
        let arrayFilters = []; // Guardar los checkbox marcados "filtros".

        $('input[type="checkbox"]:checked').each(function () {
            arrayFilters.push({
                taxonomy: $(this).attr("name"),
                term: $(this).val(),
            });
        });

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'filter_products',
                slug_category: categoriaActualSlug,
                array_filters: arrayFilters,
                page: currentPage,
            },
            success: function(response) {
                // Actualizar la lista de productos y la paginación con la respuesta AJAX
                $('.product-list').html(response.data.products);
                $('.product-pagination').html(response.data.pagination);
            
                asignarIconosNextPrev();
            },
        });
    }
});
