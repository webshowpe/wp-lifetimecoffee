<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifetime Coffee</title>
    <?php wp_head(); ?>

    <style>
      .sec-hero {
        background-image: url(
          "<?php echo get_template_directory_uri(); ?>/assets/imgs/heroover.jpg"
        );
      }

      .sec-banner-oscuro {
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
        <div class="icon-menu-hamburger">
          <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.83337 5V6.5625H21.5834V5H2.83337ZM2.83337 12.0833V13.6458H21.5834V12.0833H2.83337ZM2.83337 19.1667V20.7292H21.5834V19.1667H2.83337Z" fill="black"/>
          </svg>
        </div>

        <a href="<?php echo home_url(); ?>" class="logo">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/svg/logo-inline.svg"
            alt="Logo de Lifetime Coffee" height="50px"
          />
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
            <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-lupa.svg" class="icon30">
          </a>
          <?php
          if (is_plugin_active( 'woocommerce/woocommerce.php' )): 
            $carrito_url = esc_url(wc_get_cart_url());
          ?>
            <a href="<?= $carrito_url ?>" class="action-cart">
              <span class="desktop-span num-items" id="cart-num-items">
                <?php echo WC()->cart->get_cart_contents_count(); ?>
              </span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/30x30-carrito.svg" class="icon30">
            </a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
    <nav class="nav-movil">
      <div class="content">
        <div class="icon-close-menu">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.58295 3.75042L20.0821 20.2496M3.58295 20.2496L20.0821 3.75042" stroke="black" stroke-width="2.11111"/>
          </svg>
        </div>

        <?php
          wp_nav_menu(array(
            'menu_id' => 'popup-menu',
            'theme_location' => 'top-desktop',
            'container' => '',
            'link_before' => '<span class="desktop-parrafo">',
            'link_after' => '</span>',
          ));
        ?>
      </div>
    </nav>
