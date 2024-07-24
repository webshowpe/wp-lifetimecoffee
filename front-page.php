<?php get_header(); ?>
  <div class="wrap-grande sec-hero">
    <video autoplay muted loop id="myVideo">
      <source
        src="<?php echo get_template_directory_uri(); ?>/assets/videos/herovideo.webm"
        type="video/webm">
    </video>
    <div class="wrap-container">
      <h1 class="desktop-h1 txt-hero">Café de calidad para toda la vida</h1>
      <?php
        get_template_part("template-parts/btn-primary", "", [
          "link" => get_term_link('cafes', 'product_cat'),
          "text" => "COMPRAR CAFÉ"
        ]);
      ?>
    </div>
  </div>

  <div class="wrap-grande sec-envios-scroll">
    <ul class="wrapper-envios-scroll">
      <li class="desktop-parrafo">ENVÍOS A TODO EL PERÚ</li>
      <li class="desktop-parrafo">ENVÍOS A TODO EL PERÚ</li>
      <li class="desktop-parrafo">ENVÍOS A TODO EL PERÚ</li>
      <li class="desktop-parrafo">ENVÍOS A TODO EL PERÚ</li>
      <li class="desktop-parrafo">ENVÍOS A TODO EL PERÚ</li>
    </ul>
  </div>

  <div class="wrap-grande">
    <div class="wrap-container sec-cuidamos">
      <div class="sec-part part-1">
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/imgs/hombre-sujetando-taza.jpg"
          alt="Mano sujetando una taza de café apoyado en una mesa" />
        <div class="wrapper-text">
          <h2 class="desktop-h1">CUIDAMOS EL MEDIO AMBIENTE</h2>
          <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur. Sit nunc at turpis aliquam risus. Libero viverra id dui volutpat amet vitae ornare vel eros.</p>
        </div>
      </div>
      <div class="sec-part part-2">
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/imgs/mujer-sujetando-taza.jpg"
          alt="Mano sujetando una taza de café apoyado en una mesa" />
        <div class="wrapper-text">
          <h2 class="desktop-h1">CUIDAMOS DE TI</h2>
          <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur. Sit nunc at turpis aliquam risus. Libero viverra id dui volutpat amet vitae ornare vel eros.</p>
        </div>
      </div>
    </div>
    <img class="deco deco-cafe" src="<?php echo get_template_directory_uri(); ?>/assets/imgs/deco-cafe1.png" width="526px" height="auto" />
  </div>

  <hr/>

  <div class="wrap-grande">
    <div class="wrap-container sec-categories">
      <h2 class="desktop-h2">LO QUE TE OFRECEMOS</h2>
      <?php 
      
      $categorias_woocom = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
      ]);

      if (!empty($categorias_woocom)): ?>
        <div class="cards">
          <?php foreach($categorias_woocom as $categoria):?>
            <?php $thumbnail_id = get_term_meta($categoria->term_id, 'thumbnail_id', true); ?>
            <div class="card-category" link="<?php echo get_term_link($categoria); ?>">
              <?php
                if (wp_get_attachment_image($thumbnail_id, 'medium') != ''):
                  echo wp_get_attachment_image($thumbnail_id, 'medium', array(
                    'alt' => "Categoría de " . $categoria->name
                  ));
              ?>
              <?php else: ?>
                  <img src=<?= wc_placeholder_img_src() ?> alt="Categoría de <?= $categoria->name ?>" /> 
              <?php endif; ?>
              <?php get_template_part("template-parts/btn-primary", "", [
                "link" => get_term_link($categoria),
                "text" => $categoria->name
              ]); ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="wrap-container sec-trazabilidad-wrapper">
      <?php
        $id_pag_trazabilidad = esc_attr(get_option('lf_settings_theme')['id_pag_traz']);

        get_template_part("template-parts/banner", "oscuro", array(
          'title' => '¿CÓMO PRODUCIMOS NUESTRO CAFÉ?',
          'link' => get_permalink($id_pag_trazabilidad),
          'cta' => 'SABER MÁS',
          'imagename' => 'cucharas-trazabilidad.webp'
        ));
      ?>
    </div>
    <div class="wrap-container sec-prod-dest">
      <img class="deco deco-cafe-3" src="<?php echo get_template_directory_uri(); ?>/assets/imgs/deco-cafe2.png" alt="">
      <h2 class="desktop-h2">LOS PRODUCTOS DESTACADOS</h2>
      <div class="cards-products">
        <?php
          /* Obtener 16 últimos productos destacados
            Referencia: https://stackoverflow.com/a/46247028
          */
          $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'name',
            'terms' => 'featured',
            'operator' => 'IN',
          );

          $query = new WP_Query([
            'post_type' => 'product', // Tipo de publicación para productos de WooCommerce
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => 16, // Limitar a los 16 productos más recientes
            'order_by' => 'date', // Ordenar por fecha
            'order' => 'DESC', // En orden descendente (los más recientes primero)
            'tax_query' => $tax_query
          ]);

          if ($query->have_posts()) {
            while ($query->have_posts()) {
              $query->the_post();
              
              // Obtener el objeto de producto de WooCommerce con el ID
              global $product;
              $product = wc_get_product(get_the_ID());

              get_template_part('template-parts/card', 'product', array(
                "title" => get_the_title(),
                "thumbnail_id" => get_post_thumbnail_id( get_the_ID() ),
                "link_to" => get_permalink(),
                "price" => $product->get_regular_price()
              ));
            }

            wp_reset_postdata();
          } else {
            echo "<span>No hay productos destacados disponibles</span>";
          }
        ?>
      </div>
    </div>
  </div>

  <hr class="divider-prod-desc-reviews" />

  <div class="wrap-grande">
    <div class="wrap-container sec-reviews">
      <h2 class="desktop-h2">¿QUÉ DICEN SOBRE NOSOTROS?</h2>
      <div class="reviews">
        <div class="review">
          <div>
            <p class="desktop-parrafo">
              Es increíble poder ver de dónde viene cada producto gracias a la trazabilidad en blockchain. Me da mucha más confianza en lo que estoy comprando.
            </p>
            <p class="desktop-parrafo name">
              Carlos Serrano
            </p>
          </div>
          <img
            src="<?php echo get_template_directory_uri() . "/assets/imgs/carlos-serrano.jpg" ?>"
            alt="Cliente #1"
            class="img-review"
          />
        </div>
        <div class="review">
          <div>
            <p class="desktop-parrafo">
            La trazabilidad en blockchain es una gran innovación. Saber que puedo verificar el origen de mis productos en cualquier momento es tranquilizador y eficiente.
            </p>
            <p class="desktop-parrafo name">
              Jorge Acevedo Ramirez
            </p>
          </div>
          <img 
            src="<?php echo get_template_directory_uri() . "/assets/imgs/jorge-acevedo.jpg" ?>"
            alt="Cliente #2"
            class="img-review"
          />
        </div>
      </div>
    </div>
    <img
      src="<?php echo get_template_directory_uri() . "/assets/imgs/deco-cafe4.png"?>"
      width="526px"
      class="deco deco-cafe4"
    />
  </div>

  <hr class="divider-reviews-cta"/>

  <div class="wrap-grande">
    <div class="wrap-container">
      <?php get_template_part("template-parts/faqs"); ?>
    </div>
    <div class="wrap-container sec-cta-wrapper">
      <?php
        get_template_part("template-parts/banner", "oscuro", array(
          'title' => 'ENCUENTRA EL CAFÉ QUE MÁS TE GUSTE',
          'link' => get_term_link('cafes', 'product_cat'),
          'cta' => 'COMPRAR CAFÉ',
          'imagename' => 'productos-cafe-cta.webp'
        ));
      ?>
    </div>
  </div>
<?php get_footer(); ?>
