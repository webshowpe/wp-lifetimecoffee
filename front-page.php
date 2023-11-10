<?php get_header(); ?>
  <div class="wrap-grande sec-hero">
    <div class="wrap-container">
      <h1 class="desktop-h1 txt-hero">Café de calidad para toda la vida</h1>
      <?php btn_primary('COMPRAR CAFÉ', 'https://diegoamorin.com'); ?>
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
    <img class="deco-cafe" src="<?php echo get_template_directory_uri(); ?>/assets/imgs/deco-cafe1.png" width="526px" height="auto" />
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
            <?php
              $thumbnail_id = get_term_meta($categoria->term_id, 'thumbnail_id', true);
              $url_thumbnail = wp_get_attachment_url($thumbnail_id);
            ?>
              <div class="card-category" link="<?php echo get_term_link($categoria); ?>">
                <img src=<?= $url_thumbnail ?> alt="Categoría de <?= $categoria->name ?>" />
                <?php btn_primary($categoria->name, get_term_link($categoria)); ?>
              </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="wrap-container">
      <?php banner_oscuro('¿CÓMO PRODUCIMOS NUESTRO CAFÉ?', 'cucharas-trazabilidad.png');  ?>
    </div>
    <div class="wrap-container sec-prod-dest">
      <img class="deco-cafe-3" src="<?php echo get_template_directory_uri(); ?>/assets/imgs/deco-cafe3.png" alt="">
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

          if ($query->have_posts()):
            while ($query->have_posts()):
              $query->the_post();
              
              // Obtener el objeto de producto de WooCommerce con el ID
              global $product;
              $product = wc_get_product(get_the_ID());
              ?>
              
              <a class="card-product" href="<?php echo get_permalink(); ?>">
                <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_title(); ?>">
                <div class="desc-product">
                  <h4 class="desktop-parrafo"><?php the_title();?></h4>
                  <hr/>
                  <span>S/. <?php echo $product->get_regular_price(); ?></span>
                </div>
              </a>
          <?php
            endwhile;
            wp_reset_postdata();
          else:
          ?>
            <span>No hay productos destacados disponibles</span>
          <?php endif; ?>
      </div>
    </div>
  </div>

  <hr/>

  <div class="wrap-grande">
    <div class="wrap-container sec-reviews">
      <h2 class="desktop-h2">¿QUÉ DICEN SOBRE NOSOTROS?</h2>
      <div class="reviews">
        <div class="review">
          <div>
            <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur. Sit nunc at turpis aliquam risus. Libero viverra id dui volutpat amet vitae ornare vel eros.</p>
            <p class="desktop-parrafo">Persona #1</p>
          </div>
          <img
            src="<?php echo get_template_directory_uri() . "/assets/imgs/persona1.png" ?>"
            alt="Cliente #1"
          />
        </div>
        <div class="review">
          <div>
            <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur. Sit nunc at turpis aliquam risus. Libero viverra id dui volutpat amet vitae ornare vel eros.</p>
            <p class="desktop-parrafo">Persona #1</p>
          </div>
          <img 
            src="<?php echo get_template_directory_uri() . "/assets/imgs/persona2.png" ?>"
            alt="Cliente #2"
          />
        </div>
      </div>
    </div>
    <img
      src="<?php echo get_template_directory_uri() . "/assets/imgs/deco-cafe4.png"?>"
      width="526px"
      class="deco-cafe4"
    />
  </div>

  <hr/>

  <div class="wrap-grande">
    <div class="wrap-container sec-faq">
      <h2 class="desktop-h2">ACLAREMOS TUS DUDAS</h2>
      <div class="faqs">
        <div class="faq">
          <div>
            <p class="desktop-parrafo-grande">¿Hacen envíos a todo el Perú?</p>
            <img src="<?php echo get_template_directory_uri() . "/assets/svg/30x30-arrow-down.svg" ?>" alt="">
          </div>
          <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit consectetur totam saepe id quae, voluptate, obcaecati temporibus alias unde dolore voluptatem aperiam placeat possimus! Labore est repudiandae sequi veniam aliquid?</p>
        </div>
        <div class="faq">
          <div>
            <p class="desktop-parrafo-grande">¿En cuantos días llega mi pedido?</p>
            <img src="<?php echo get_template_directory_uri() . "/assets/svg/30x30-arrow-down.svg" ?>" alt="">
          </div>
          <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit consectetur totam saepe id quae, voluptate, obcaecati temporibus alias unde dolore voluptatem aperiam placeat possimus! Labore est repudiandae sequi veniam aliquid?</p>
        </div>
        <div class="faq">
          <div>
            <p class="desktop-parrafo-grande">¿Cómo se manejan las devoluciones?</p>
            <img src="<?php echo get_template_directory_uri() . "/assets/svg/30x30-arrow-down.svg" ?>" alt="">
          </div>
          <p class="desktop-parrafo">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit consectetur totam saepe id quae, voluptate, obcaecati temporibus alias unde dolore voluptatem aperiam placeat possimus! Labore est repudiandae sequi veniam aliquid?</p>
        </div>
      </div>
    </div>
    <div class="wrap-container">
      <?php banner_oscuro('ENCUENTRA EL CAFÉ QUE MÁS TE GUSTE', 'productos-cafe-cta.png');  ?>
    </div>
  </div>
<?php get_footer(); ?>
