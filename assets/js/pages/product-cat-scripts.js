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
        let arrayFilters = []; // Guardar los checkbox marcados: filtros.

        $('input[type="checkbox"]:checked').each(function () {
            arrayFilters.push({
                taxonomy: $(this).attr("name"),
                term: $(this).val(),
            });
        });

        // Agregar loader en cada llamada AJAX
        $('.product-list').html(`
            <div style="position: sticky; top: 20px; display: flex; justify-content: center;align-items: center; height: 50vh; width: 100%; max-width:950px;">
                <svg class="loader" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30 5.625C16.54 5.625 5.625 16.54 5.625 30C5.625 43.46 16.54 54.375 30 54.375V48.2825C26.3848 48.282 22.8509 47.2095 19.8451 45.2007C16.8394 43.1919 14.4968 40.3369 13.1135 36.9968C11.7302 33.6567 11.3684 29.9814 12.0739 26.4356C12.7793 22.8899 14.5202 19.6329 17.0766 17.0766C19.6329 14.5202 22.8899 12.7793 26.4356 12.0739C29.9814 11.3684 33.6567 11.7302 36.9968 13.1135C40.3369 14.4968 43.1919 16.8394 45.2007 19.8451C47.2095 22.8509 48.282 26.3848 48.2825 30H54.375C54.375 16.54 43.46 5.625 30 5.625Z" fill="black" fill-opacity="0.9"/>
                </svg>
            </div>
        `);
        $(".product-pagination").html("");

        // Desplazar hacia arriba con animación
        var posicionTopProductList = $('.product-list').offset().top;
        var heightNavegacion = $('.nav-desktop').height();
        $('html, body').animate({ scrollTop: posicionTopProductList - heightNavegacion }, 'slow');

        // Solicitud AJAX
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
