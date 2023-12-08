/*--------------------------------------------------------------
## Sección: Hero del producto
## Funcionalidad: Aumentar y disminuir el valor de cantidad 
   de un producto mediante botones
--------------------------------------------------------------*/
const cuantityField = document.querySelector(".product-quantity-box");

const iconMas = cuantityField.querySelector(".icon-mas");
const iconMenos = cuantityField.querySelector(".icon-menos");
const inputField = cuantityField.querySelector("input[type='number']");

iconMas.addEventListener("click", () => {
    inputField.value++;
});
iconMenos.addEventListener("click", () => {
    inputField.value--;
});


/*--------------------------------------------------------------
## Sección: Hero del producto
## Funcionalidad: Agregar el producto actual al carrito mediante ajax
--------------------------------------------------------------*/
const linkAddToCart = document.getElementById("link-add-to-cart");

linkAddToCart.addEventListener("click", (e) => {
    e.preventDefault();

    // Obtener ID del producto
    let id_producto = linkAddToCart.getAttribute("product-id");
    let cantidad_producto = inputField.value;

    // Agregar espado de loader
    linkAddToCart.innerHTML = `
        <svg class="loader" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 1.6875C4.962 1.6875 1.6875 4.962 1.6875 9C1.6875 13.038 4.962 16.3125 9 16.3125V14.4847C7.91543 14.4846 6.85526 14.1629 5.95354 13.5602C5.05181 12.9576 4.34903 12.1011 3.93405 11.099C3.51907 10.097 3.41053 8.99441 3.62216 7.93069C3.83379 6.86697 4.35607 5.88988 5.12298 5.12298C5.88988 4.35607 6.86697 3.83379 7.93069 3.62216C8.99441 3.41053 10.097 3.51907 11.099 3.93405C12.1011 4.34903 12.9576 5.05181 13.5602 5.95354C14.1629 6.85526 14.4846 7.91543 14.4847 9H16.3125C16.3125 4.962 13.038 1.6875 9 1.6875Z" fill="black" fill-opacity="0.9"/>
        </svg>
        <span class="desktop-parrafo">
            Agregando
        </span>
    `;

    // Solicitud a admin-ajax en la accion add_product_to_cart
    fetch(ajax_object.ajax_url, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'action': 'add_product_to_cart',
            'product_id': id_producto,
            'quantity': cantidad_producto,
        }),
    })
    .then(response => response.text())
    .then(resultado => {
        const $cartSpan = document.getElementById("cart-num-items");
        $cartSpan.innerText = resultado;
        
        // Mostrar mensaje de successfully
        linkAddToCart.innerHTML = `
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.01 2.50879L5.99625 13.5113L0.99 8.50504L0 9.49504L5.99625 15.5025L18 3.49879L17.01 2.50879Z" fill="black"/>
            </svg>
            <span class="desktop-parrafo">
                Producto agregado correctamente
            </span>
        `;
        linkAddToCart.style.backgroundColor = "#B0D0A1";

        // Volver al estilo inicial
        setTimeout(() => {
            linkAddToCart.innerHTML = `
                <span class="desktop-parrafo">
                    Agregar al carrito
                </span>
            `;
            linkAddToCart.style.backgroundColor = "var(--Amarillo-Golden)";
        }, 3500);
    })
    .catch(error => {
        console.log("Error en la peticion", error)
    });
});
