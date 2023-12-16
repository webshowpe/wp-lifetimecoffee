<?php
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
