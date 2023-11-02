<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lifetime Coffee</title>
  <?php wp_head(); ?>

  <style>
    .sec-hero {
      height: 828px;
      background-image: url("<?php echo get_template_directory_uri(); ?>/assets/imgs/heroover.jpg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      overflow: hidden;
    }

    .sec-trazabilidad {
      min-height: 670px;
      background-image: url("<?php echo get_template_directory_uri(); ?>/assets/imgs/fondo-yute.jpg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<body>
  <nav class="wrap-grande nav-desktop">
    <div class="wrap-container container">
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/svg/logo-inline.svg"
        alt="Logo de Lifetime Coffee" height="50px"
      >

      <?php
        wp_nav_menu(array(
          'menu_class' => 'main-menu',
          'menu_location' => 'top-desktop',
          'container' => '',
          'link_before' => '<span class="desktop-parrafo">',
          'link_after' => '</span>',
        ));
      ?>

      <div class="nav-actions">
        <a href="">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-carrito.svg">
        </a>
        <a href="">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-lupa.svg">
        </a>
      </div>
    </div>
  </nav>

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
            <div class="card-category">
              <img src=<?= $url_thumbnail ?> alt="">
              <?php btn_primary($categoria->name, get_term_link($categoria)); ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="wrap-container">
      <div class="sec-trazabilidad">
        <div class="cta">
          <h2 class="desktop-h1" style="color: var(--Fondo)">¿CÓMO PRODUCIMOS NUESTRO CAFÉ?</h2>
          <?php btn_primary("SABER MÁS", "https://diegoamorin.com") ?>
        </div>
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/imgs/cucharas-trazabilidad.png"
          alt="" width="970px" />
      </div>
    </div>
    <div class="wrap-container">
      <h2 class="desktop-h2">LOS PRODUCTOS DESTACADOS</h2>
    </div>
  </div>


  
  <?php wp_footer(); ?>
</body>
</html>
