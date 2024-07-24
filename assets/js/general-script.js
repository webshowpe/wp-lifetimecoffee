/*--------------------------------------------------------------
## Sección: Navegación Desktop y Móvil
## Funcionalidad: Agregar arrowdown al trigger de cada submenu
--------------------------------------------------------------*/
const itemsSubmenu = document.querySelectorAll(".menu-item-has-children");

itemsSubmenu.forEach((item) => {
    // Agregar icono "arrow-down" si tiene un submenu
    const itemTriggerSubmenu = item.querySelector("a");
    itemTriggerSubmenu.insertAdjacentHTML(
        "beforeend",
        `<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg" id="arrow-down">
        <path d="M9 14.469L1 6.46897L1.96897 5.5L9 12.531L16.031 5.5L17 6.46897L9 14.469Z" fill="black"/>
        </svg>`
    );
});

/*--------------------------------------------------------------
## Sección: Navegación Desktop y Móvil
## Funcionalidad: Abrir una nueva ventana para enlaces externos a la web
--------------------------------------------------------------*/
const menuLinks = document.querySelectorAll("#menu-menu-principal a");

menuLinks.forEach(link => {
    // Verifica si el enlace es externo
    if (link.hostname !== window.location.hostname) {
      link.setAttribute("target", "_blank");
    }
});


/*--------------------------------------------------------------
## Sección: Navegación Móvil
## Funcionalidad: Activar y ocultar menu móvil con los iconos
--------------------------------------------------------------*/
const $body = document.body;
const $iconHamburguer = document.querySelector(".icon-menu-hamburger");
const $iconCloseMenu = document.querySelector(".icon-close-menu");

$iconHamburguer.addEventListener("click", () => {
    $body.classList.add("active-mobile-menu");
});
$iconCloseMenu.addEventListener("click", () => {
    $body.classList.remove("active-mobile-menu");
});


/*--------------------------------------------------------------
## Sección: Navegación Móvil
## Funcionalidad: Ocultar menu móvil cuando se hace click en el área oscura
--------------------------------------------------------------*/
const $navMovil = document.querySelector(".nav-movil");
$navMovil.addEventListener("click", (event) => {
    if (event.target.classList.contains("nav-movil")) {
        $body.classList.remove("active-mobile-menu");
    }
});


/*--------------------------------------------------------------
## Sección: Navegación Móvil
## Funcionalidad: Funcionalidad de acordeón de los submenus móviles
--------------------------------------------------------------*/
const submenus = document.querySelectorAll(".sub-menu");

submenus.forEach(($submenu) => {
    const $trigger = $submenu.previousElementSibling;
    
    $trigger.addEventListener("click", () => {
        const $menuItem = $trigger.parentNode;

        $menuItem.classList.toggle("active");

        if ($menuItem.classList.contains("active")) {
            $submenu.style.height = $submenu.scrollHeight + "px";
        } else {
            $submenu.style.height = "0px";
        }
    });
});
