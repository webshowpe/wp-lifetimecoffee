/*--------------------------------------------------------------
## Sección: Navegación
--------------------------------------------------------------*/
const navegacion = document.querySelector(".nav-desktop");
const submenus = navegacion.querySelectorAll(".sub-menu");

submenus.forEach((submenu) => {
    // Agregar icono "arrow-down" si tiene un submenu
    const itemTriggerSubmenu = submenu.previousElementSibling;
    itemTriggerSubmenu.insertAdjacentHTML(
        "beforeend",
        `<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-down">
            <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z" fill="black"/>
        </svg>`
    );
    
    // Mostrar submenu debajo del elemento padre
    const posX = submenu.parentNode.offsetLeft;
    const posY = navegacion.offsetHeight;

    submenu.style.left = posX + "px";
    submenu.style.top = posY + "px";
});
