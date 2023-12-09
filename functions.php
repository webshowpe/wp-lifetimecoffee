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


/*--------------------------------------------------------------
Configurar paginación en las categorías de productos (WP_Query principal)
Mas información: https://wordpress.stackexchange.com/a/298775
--------------------------------------------------------------*/
function custom_product_cat_query($query) {
  if (!is_admin() && $query->is_tax("product_cat")){
    $query->set('posts_per_page', 9);
  }
}

add_action('pre_get_posts', 'custom_product_cat_query');



// Funcion para manejar solicitudes AJAX con paginación

function filter_products_by_attributes() {
  // Slug de la categoria actual
  $slug_category = $_POST['slug_category'];
  // Traemos el objeto de terms junto con su tipo de taxonomia
  $array_filters = isset($_POST['array_filters']) ? $_POST['array_filters'] : array();
  // Página actual en la paginacion
  $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

  // Configuramos los argumentos para la consulta de productos
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => 9, // Igual que en custom_product_cat_query() sino problema en paginacion.
    'paged' => $page,
    'tax_query' => array(
      array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $slug_category
      ),
    ),
  );

  if (!empty($array_filters)) {
    $tax_query = array('relation' => 'AND');

    $terms_pa_molienda = array();
    $terms_pa_proceso = array();
    $terms_pa_tostado = array();

    foreach ($array_filters as $filter) {
      if ($filter["taxonomy"] == "pa_molienda") {
        array_push($terms_pa_molienda, $filter["term"]);
      } else if ($filter["taxonomy"] == "pa_proceso") {
        array_push($terms_pa_proceso, $filter["term"]);
      } else if ($filter["taxonomy"] == "pa_tostado") {
        array_push($terms_pa_tostado, $filter["term"]);
      }
    }

    if (!empty($terms_pa_molienda)) {
      $tax_query[] = array(
        'taxonomy' => "pa_molienda",
        'field' => 'slug',
        'terms' => $terms_pa_molienda,
      );
    }
    if (!empty($terms_pa_proceso)) {
      $tax_query[] = array(
        'taxonomy' => "pa_proceso",
        'field' => 'slug',
        'terms' => $terms_pa_proceso,
      );
    }
    if (!empty($terms_pa_tostado)) {
      $tax_query[] = array(
        'taxonomy' => "pa_tostado",
        'field' => 'slug',
        'terms' => $terms_pa_tostado,
      );
    }

    $args['tax_query'][] = $tax_query;
  }

  // EJEMPLO DE SALIDA DEL TAX_QUERY
  // array(2) {
  //   [0]=> array(3) {
  //     ["taxonomy"]=> string(11) "product_cat"
  //     ["field"]=> string(4) "slug"
  //     ["terms"]=> string(5) "cafes"
  //   }
  //   [1]=> array(3) {
  //     ["relation"]=> string(3) "AND"                    <- AND
  //     [0]=> array(3) {
  //       ["taxonomy"]=> string(11) "pa_molienda"
  //       ["field"]=> string(4) "slug"
  //       ["terms"]=> array('fino', 'medio')              <- OR
  //     }
  //     [2]=> array(3) {
  //       ["taxonomy"]=> string(11) "pa_proceso"
  //       ["field"]=> string(4) "slug"
  //       ["terms"]=> array('honey', 'lavado', 'natural') <- OR
  //     }
  //   }
  // }

  // Realizar la consulta de productos
  $products_query = new WP_Query($args);

  // Iniciar el almacenamiento de búfer de salida
  ob_start();

  // Verificar si hay productos en la consulta
  if ($products_query->have_posts()) {
    // Iterar sobre los productos y mostrar la tarjeta de producto
    while($products_query->have_posts()) {
      $products_query->the_post();
      $product = wc_get_product();

      tarjeta_producto(
        title: $product->get_name(),
        url_image: wp_get_attachment_url($product->get_image_id()),
        url: $product->get_permalink(),
        price: $product->get_regular_price()
      );
    }
  } else {
    // Mostrar un mensaje si no hay productos
    echo '<span>No hay productos en esta categoría.</span>' . var_dump($args['tax_query']);
  }

  // Obtener el contenido del búfer y limpiar el búfer
  $output = ob_get_clean();

  // Obtener paginación
  $pagination = paginate_links(array(
    'total' => $products_query->max_num_pages,
    'current' => $page,
    'format' => '?page=%#%',
  ));

  // Enviar una respuesta JSON con los productos y la paginación
  wp_send_json_success(
    array('products' => $output, 'pagination' => $pagination)
  );
}

add_action('wp_ajax_filter_products', 'filter_products_by_attributes');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_by_attributes');
