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
        background-image: url(
          "<?php echo get_template_directory_uri(); ?>/assets/imgs/heroover.jpg"
        );
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
      }

      .sec-trazabilidad {
        min-height: 670px;
        background-image: url(
          "<?php echo get_template_directory_uri(); ?>/assets/imgs/fondo-yute.jpg"
        );
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>
  <body>
    <nav class="wrap-grande nav-desktop">
      <div class="wrap-container">
        <a href="<?php echo home_url(); ?>">
            <img
            src="<?php echo get_template_directory_uri(); ?>/assets/svg/logo-inline.svg"
            alt="Logo de Lifetime Coffee" height="50px"
            >
        </a>

        <?php
          wp_nav_menu(array(
            'menu_class' => 'main-menu',
            'theme_location' => 'top-desktop',
            'container' => '',
            'link_before' => '<span class="desktop-parrafo">',
            'link_after' => '</span>',
          ));
        ?>

        <div class="nav-actions">
          <a href="" class="action-search">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-lupa.svg">
          </a>
          <?php
          if (is_plugin_active( 'woocommerce/woocommerce.php' )): 
            $carrito_url = esc_url(wc_get_cart_url());
          ?>
            <a href="<?= $carrito_url ?>" class="action-cart">
              <span class="desktop-span num-items" id="cart-num-items">
                <?php echo WC()->cart->get_cart_contents_count(); ?>
              </span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-carrito.svg">
            </a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
