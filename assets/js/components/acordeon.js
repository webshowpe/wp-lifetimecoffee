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
