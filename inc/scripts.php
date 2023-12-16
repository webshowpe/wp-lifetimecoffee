<?php
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

