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
    inputField.value ++;
    let event = new Event("change");
    inputField.dispatchEvent(event);
});
iconMenos.addEventListener("click", () => {
    inputField.value --;
    let event = new Event("change");
    inputField.dispatchEvent(event);
});

const linkAddToCart = document.querySelector("#link-add-to-cart");

inputField.addEventListener("change", () => {
    if (linkAddToCart.href.includes("&quantity=")) {
        let divisiones = linkAddToCart.href.split("&quantity=");
        divisiones.pop();
        linkAddToCart.href = divisiones;
    }
    linkAddToCart.href = linkAddToCart.href + "&quantity=" + inputField.value;
});

