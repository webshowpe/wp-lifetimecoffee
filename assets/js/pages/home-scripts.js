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

/*--------------------------------------------------------------
## Sección: Preguntas frecuentes
## Funcionalidad: Expandir pregunta frecuente de acuerdo al tamaño del contenido de respuesta
--------------------------------------------------------------*/

const faqsTitles = document.querySelectorAll(".faq > div");

faqsTitles.forEach((faq) => {
    faq.addEventListener("click", () => {
        faq.parentNode.classList.toggle("active");
        
        const faqContent = faq.nextElementSibling;

        if (faq.parentNode.classList.contains("active")) {
            faqContent.style.height = (faqContent.scrollHeight + 40) + "px";
        } else {
            faqContent.style.height = "0px";
        }
    });
});
