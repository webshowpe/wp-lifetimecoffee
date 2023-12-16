<?php
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


/*--------------------------------------------------------------
Solicitud AJAX que renderiza resultado de un filtro por "molienda",
"proceso" o "tostado"
--------------------------------------------------------------*/
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
    'posts_per_page' => 9, // Igual que custom_product_cat_query() sino problema en paginacion.
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

      get_template_part('template-parts/card', 'product', array(
        "title" => $product->get_name(),
        "link_image" => wp_get_attachment_url($product->get_image_id()),
        "link_to" => $product->get_permalink(),
        "price" => $product->get_regular_price()
      ));
    }
  } else {
    // Mostrar un mensaje si no hay productos
    echo '<span>No hay productos en esta categoría.</span>';
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
