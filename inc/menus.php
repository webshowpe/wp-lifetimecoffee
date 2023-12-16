<?php
/*--------------------------------------------------------------
## Encolar las diferentes ubicaciones de los menus
--------------------------------------------------------------*/
function lifetime_set_menu_locations() {
  $locations = array(
    "top-desktop" => "Menú que aparece en el menú principal en el formato PC",
    "bottom-desktop" => "Menú que aparece en el footer en el extremo derecho",
  );

  register_nav_menus($locations);
}

add_action('after_setup_theme', 'lifetime_set_menu_locations');
