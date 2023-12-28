<?php
require "inc/scripts.php";
require "inc/menus.php";
require "inc/custom-fields.php";
require "inc/ajax-filter-cat.php";
require "inc/custom-settings.php";

/*--------------------------------------------------------------
## Declarar compatibilidad con Woocommerce
## Mas información: https://woocommerce.com/document/woocommerce-theme-developer-handbook/
--------------------------------------------------------------*/
function lifetime_add_woocommerce_support() {
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'lifetime_add_woocommerce_support');


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
