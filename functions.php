<?php
// Cargar los components
require('components.php');


// Declarar compatibilidad con Woocommerce
// Mas información: https://woocommerce.com/document/woocommerce-theme-developer-handbook/
function lifetime_add_woocommerce_support() {
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'lifetime_add_woocommerce_support');


// Cargar estilos del tema
function lifetime_load_styles_and_scripts() {
  $version = wp_get_theme()->get('Version');

  wp_enqueue_style(
    'generalstyle',
    get_template_directory_uri() . '/assets/css/general-style.css',
    array(), $version, 'all'
  );

  wp_enqueue_script(
    'generalscript',
    get_template_directory_uri() . '/assets/js/general-script.js',
    array(), $version, true
  );
}

add_action('wp_enqueue_scripts', 'lifetime_load_styles_and_scripts');


// Definir ubicaciones de menu
function lifetime_set_menu_locations() {
  $locations = array(
    "top-desktop" => "Menú que aparece en el menú principal en el formato PC"
  );

  register_nav_menus($locations);
}

add_action('after_setup_theme', 'lifetime_set_menu_locations');


