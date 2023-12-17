<?php get_header(); ?>

<div class="mobile-popup-filter">
  <div class="content">
    <h2 class="desktop-h2">Filtros de búsqueda</h2>
    <div class="filtros">
      <?php get_template_part("template-parts/filters", "coffee", [
        "prefix" => "mobile",
      ]); ?>
    </div>
    <a href="" class="btn-primary">
      <span class="desktop-parrafo">Aceptar</span>
    </a>
  </div>
</div>

<div class="wrap-grande">
  <header class="wrap-container sec-cat-hero">
    <span class="desktop-parrafo" style="color: var(--Texto-Secundario);">
      CATEGORÍA
    </span>
    <h1 class="desktop-h1">
      <?php single_cat_title();?>
    </h1>
  </header>
  <?php if (is_tax('product_cat', 'cafes')): ?>
    <div class="wrap-container sec-filter-mobile">
      <div class="filter">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
          <path d="M18 1.125V3.0498L11.25 9.7998V16.875H6.75V9.7998L0 3.0498V1.125H18ZM16.875 2.25H1.125V2.5752L7.875 9.3252V15.75H10.125V9.3252L16.875 2.5752V2.25Z" fill="#4A4A4A"/>
        </svg>
        <span class="desktop-span">FILTRAR</span>
      </div>
    </div>
  <?php endif; ?>
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

      <?php get_template_part("template-parts/filters", "coffee", [
        "prefix" => "desktop"
      ]); ?>
    </aside>
    <section class="product-section">
    <?php if (have_posts()) : ?>
      <div class="product-list">
        <?php 
          while (have_posts()) {
            the_post();
            $product = wc_get_product();

            get_template_part('template-parts/card', 'product', array(
              "title" => $product->get_name(),
              "link_image" => wp_get_attachment_url($product->get_image_id()),
              "link_to" => $product->get_permalink(),
              "price" => $product->get_regular_price()
            ));
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
