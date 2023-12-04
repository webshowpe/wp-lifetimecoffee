/*--------------------------------------------------------------
## Sección: Envíos a todo el Perú
## Funcionalidad: Desplazamiento infinito de texto
## Guia: https://codepen.io/kevinpowell/pen/BavVLra
--------------------------------------------------------------*/

const scroll = document.querySelector(".sec-envios-scroll");

const scrollInner = scroll.querySelector(".wrapper-envios-scroll");

const scrollInnerContent = Array.from(scrollInner.children);

scrollInnerContent.forEach((item) => {
    const duplicatedItem = item.cloneNode(true);
    duplicatedItem.setAttribute("aria-hidden", true);

    scrollInner.appendChild(duplicatedItem);
});
