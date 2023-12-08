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
  $parent_style = 'general-style';

  // Encolar en todo el tema
  wp_enqueue_style(
    $parent_style,
    get_template_directory_uri() . '/assets/css/general-style.css',
    array(), $version, 'all'
  );

  wp_enqueue_script(
    'general-script',
    get_template_directory_uri() . '/assets/js/general-script.js',
    array(), $version, true
  );

  // Agregar objeto ajax_object para el javascript general con la ruta de admin-ajax.html
  wp_localize_script(
    'general-script', 'ajax_object',
    ['ajax_url' => admin_url("admin-ajax.php")]
  );

  // Encolar en front_page.php
  if (is_front_page()) {
    // Estilos y script de página
    wp_enqueue_style(
      'home-style',
      get_template_directory_uri() . '/assets/css/pages/home-styles.css',
      array($parent_style), $version, 'all'
    );

    wp_enqueue_script(
      'home-script',
      get_template_directory_uri() . '/assets/js/pages/home-scripts.js',
      array('general-script'), $version, true
    );

    // Cargar componente product-card
    wp_enqueue_style(
      'product-card',
      get_template_directory_uri() . '/assets/css/components/product-card.css',
      array($parent_style), $version, 'all'
    );

    // Cargar componente acordeon
    wp_enqueue_style(
      'acordeon',
      get_template_directory_uri() . '/assets/css/components/acordeon.css',
      array($parent_style), $version, 'all'
    );
    wp_enqueue_script(
      'acordeon',
      get_template_directory_uri() . '/assets/js/components/acordeon.js',
      array(), $version, true
    );
  }

  // Encolar en taxonomy-product_cat.php
  if (is_tax('product_cat')) {
    // Estilos y scripts de página
    wp_enqueue_style(
      'productcatstyle',
      get_template_directory_uri() . '/assets/css/pages/product-cat-styles.css',
      array($parent_style), $version, 'all'
    );
    wp_enqueue_script(
      'productcatscript',
      get_template_directory_uri() . '/assets/js/pages/product-cat-scripts.js',
      array('general-script'), $version, true
    );

    // Cargar componente product-card
    wp_enqueue_style(
      'product-card',
      get_template_directory_uri() . '/assets/css/components/product-card.css',
      array($parent_style), $version, 'all'
    );
  }

  // Encolar en single-product.php
  if (is_singular( 'product' )) {
    // Estilos y scripts de página
    wp_enqueue_style(
      'product-detail-style',
      get_template_directory_uri() . '/assets/css/pages/product-detail-styles.css',
      array($parent_style), $version, 'all'
    );
    wp_enqueue_script(
      'product-detail-script',
      get_template_directory_uri() . '/assets/js/pages/product-detail-scripts.js',
      array('general-script'), $version, true
    );
    
    // Cargar componente product-card
    wp_enqueue_style(
      'product-card',
      get_template_directory_uri() . '/assets/css/components/product-card.css',
      array($parent_style), $version, 'all'
    );

    // Cargar componente acordeon
    wp_enqueue_style(
      'acordeon',
      get_template_directory_uri() . '/assets/css/components/acordeon.css',
      array($parent_style), $version, 'all'
    );
    wp_enqueue_script(
      'acordeon',
      get_template_directory_uri() . '/assets/js/components/acordeon.js',
      array(), $version, true
    );
  }

  // Encolar en el carrito de compras de woocommerce
  if (is_cart()) {
    wp_enqueue_script(
      'cart-page-script',
      get_template_directory_uri() . '/assets/js/pages/cart-page-scripts.js',
      array('general-script'), $version, true
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


/*--------------------------------------------------------------
## Agregar campos personalizados a producto de woocommerce
--------------------------------------------------------------*/
function lifetime_add_customfields_to_wooproduct() {
  // Origen del producto
  woocommerce_wp_text_input(
    array(
      "id" => "_product_origin",
      "placeholder" => "Origen del producto",
      "label" => "Origen",
      "desc_tip" => true
    )
  );
  // Puntos de taza para el producto de café
  woocommerce_wp_text_input(
    array(
      "id" => "_product_cup_points",
      "placeholder" => "Puntos de taza",
      "label" => "Puntos de taza",
      "type" => "number",
      "custom_attributes" => array(
        "step" => 0.01,
        "min" => 0
      )
    )
  );
}

add_action('woocommerce_product_options_general_product_data', 'lifetime_add_customfields_to_wooproduct');


/*--------------------------------------------------------------
## Guardar campos personalizados de producto de woocommerce
--------------------------------------------------------------*/
function lifetime_save_customfields_wooproduct($post_id) {
  $wooproduct_origin = isset($_POST["_product_origin"]) ? sanitize_text_field( $_POST["_product_origin"] ) : "";
  $wooproduct_cup_points = isset($_POST["_product_cup_points"]) ? sanitize_text_field( $_POST["_product_cup_points"] ) : "";

  update_post_meta($post_id, '_product_origin', $wooproduct_origin);
  update_post_meta($post_id, '_product_cup_points', $wooproduct_cup_points);
}

add_action('woocommerce_process_product_meta', 'lifetime_save_customfields_wooproduct');


/*--------------------------------------------------------------
## Registrar el AJAX que se encarga de agregar un producto al carrito
--------------------------------------------------------------*/
function lifetime_add_product_to_cart() {
  $product_id = $_POST["product_id"];
  $quantity = $_POST["quantity"];

  WC()->cart->add_to_cart($product_id, $quantity);

  // Devolver el nuevo conteo de elementos del carrito
  echo WC()->cart->get_cart_contents_count();

  wp_die();
}

add_action('wp_ajax_add_product_to_cart', 'lifetime_add_product_to_cart');
add_action('wp_ajax_nopriv_add_product_to_cart', 'lifetime_add_product_to_cart');

/*--------------------------------------------------------------
## Registrar el AJAX que se encarga de actualizar el conteo de elementos del carrito
--------------------------------------------------------------*/
function lifetime_update_count_cart() {
  echo WC()->cart->get_cart_contents_count();
  wp_die();
}

add_action('wp_ajax_update_count_cart', 'lifetime_update_count_cart');
add_action('wp_ajax_nopriv_update_count_cart', 'lifetime_update_count_cart');
