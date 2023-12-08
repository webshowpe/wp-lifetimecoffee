<?php get_header(); ?>

<div class="wrap-grande">
  <header class="wrap-container sec-cat-hero">
    <span class="desktop-parrafo" style="color: var(--Texto-Secundario);">
      CATEGORÍA
    </span>
    <h1 class="desktop-h1">
      <?php single_cat_title();?>
    </h1>
  </header>
  <div class="wrap-container sec-body">
    <aside class="sidebar">
      <div class="filter-category">
        <h4 class="desktop-parrafo" style="font-weight: 700;">CATEGORÍAS</h4>
        <?php
        // Obtener categorias de productos y mostrarlas
        $product_categories = get_terms([
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
        ]);

        if (!empty($product_categories) && !is_wp_error( $product_categories )):
        ?>
          <div class="opciones">
            <?php foreach ($product_categories as $category): ?>
              <a href="<?= get_term_link( $category ); ?>" class="category desktop-parrafo" id='<?= $category->slug ?>'>
                <span><?= $category->name ?></span>
                <img src="<?php echo get_template_directory_uri() . '/assets/svg/18x18-arrow-down.svg' ?>" alt="">
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <span>NO hay categorías disponibles</span>
        <?php endif; ?>
      </div>

      <?php
      // Obtener los atributos de los productos de WooCommerce
      $atributos_productos = wc_get_attribute_taxonomies();
      
      if ($atributos_productos): ?>
      
      <?php foreach ($atributos_productos as $atributo): ?>
          <div>
            <h4 class="desktop-parrafo" style="font-weight: 700; text-transform: uppercase;">
              <?= $atributo->attribute_label; ?>
            </h4>

            <?php 
            // Obtener los terms cada atributo de producto woocommerce
            $terms = get_terms(array(
              'taxonomy' => 'pa_' . $atributo->attribute_name,
              'hide_empty' => false,
            ));
            
            if ($terms && !is_wp_error( $terms )): ?>
              <div class="opciones">
                <?php foreach ($terms as $term): ?>

                  <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="custom-check">
                      <input type="checkbox" id=<?= $term->slug ?> name=<?= $term->taxonomy ?> value=<?= $term->slug ?>>
                      <svg class="icon-check" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.01 2.50879L5.99625 13.5113L0.99 8.50504L0 9.49504L5.99625 15.5025L18 3.49879L17.01 2.50879Z" fill="#4A4A4A"/>
                      </svg>
                    </div>
                    <label for=<?= $term->slug ?>>
                      <?= $term->name ?>
                    </label>
                  </div>
                  
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

        <?php endforeach; ?>
      <?php else: ?>
        <span>No hay taxonomías de atributos disponibles.</span>
      <?php endif; ?>
    </aside>
    <section class="product-section">
    <?php if (have_posts()) : ?>
      <div class="product-list">
        <?php 
          while (have_posts()) {
            the_post();
            $product = wc_get_product();

            $urlimage_product = wp_get_attachment_url($product->get_image_id());

            tarjeta_producto(
                title: $product->get_name(),
                url_image: $urlimage_product,
                url: $product->get_permalink(),
                price: $product->get_regular_price()
            );
          }
          ?>
      </div>
      <div class="product-pagination">
        <?php 
          $links = paginate_links( array("type" => "array") );

          if (isset($links)) :
            foreach($links as $link ):
              echo $link;
            endforeach; 
          endif;
        ?>
      </div>
    <?php else: ?>
        <span>No hay productos en esta categoría.</span>
    <?php endif; ?>
  </section>
  </div>
</div>

<?php get_footer(); ?>
