<?php
// Cargar los components
require('components.php');

/*--------------------------------------------------------------
## Declarar compatibilidad con Woocommerce
## Mas información: https://woocommerce.com/document/woocommerce-theme-developer-handbook/
--------------------------------------------------------------*/
function lifetime_add_woocommerce_support() {
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'lifetime_add_woocommerce_support');


/*--------------------------------------------------------------
## Encolar los archivos css y javascript para cada parte del tema
--------------------------------------------------------------*/
function lifetime_load_styles_and_scripts() {
  $version = wp_get_theme()->get('Version');
  $parent_style = 'generalstyle';

  // Encolar en todo el tema
  wp_enqueue_style(
    $parent_style,
    get_template_directory_uri() . '/assets/css/general-style.css',
    array(), $version, 'all'
  );

  wp_enqueue_script(
    'generalscript',
    get_template_directory_uri() . '/assets/js/general-script.js',
    array(), $version, true
  );

  // Encolar en front_page.php
  if (is_front_page()) {
    wp_enqueue_style(
      'homestyle',
      get_template_directory_uri() . '/assets/css/pages/home-styles.css',
      array($parent_style), $version, 'all'
    );

    wp_enqueue_script(
      'homescript',
      get_template_directory_uri() . '/assets/js/pages/home-scripts.js',
      array(), $version, true
    );
  }

  // Encolar en la taxonomia de productos de woocommerce
  if (is_tax('product_cat')) {
    wp_enqueue_style(
      'productcatstyle',
      get_template_directory_uri() . '/assets/css/pages/product-cat-styles.css',
      array($parent_style), $version, 'all'
    );

    wp_enqueue_script(
      'productcatscript',
      get_template_directory_uri() . '/assets/js/pages/product-cat-scripts.js',
      array(), $version, true
    );
  }
}

add_action('wp_enqueue_scripts', 'lifetime_load_styles_and_scripts');


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
