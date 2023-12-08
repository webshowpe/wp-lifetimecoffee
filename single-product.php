<?php get_header(); ?>
  <?php
    $product = wc_get_product(get_the_ID());

    $coffee_category_id = 16;

    function obtener_atributo_producto($product, $atributo) {
      // Obtener todos los atributos de un determinado producto
      $product_attributes = $product->get_attributes();

      if (isset($product_attributes[$atributo])) {
        // Obtener un atributo especifico
        $product_attribute = $product_attributes[$atributo];

        // Verificamos si esta definido, validando con WC_Product_Attribute
        if ($product_attribute instanceof WC_Product_Attribute) {
          $attribute_options = $product_attribute->get_options();
          
          foreach ($attribute_options as $option_id) {
            $opcion = get_term( $option_id );
            echo $opcion->name;
          }
        } 
      } else {
        echo "---";
      }
    }
  ?>

  
  <div class="wrap-grande">
    <div class="wrap-container sec-hero-product">
      <div class="izq-image">
        <img src="<?= wp_get_attachment_image_url($product->get_image_id(), 'large') ?>" alt="<?= $product->get_name() ?>">
      </div>
      <div class="der-details">
        <div class="infocard-header">
          <h1 class="desktop-h2" style="color: var(--Fondo)">
            <?php echo $product->get_name(); ?>
          </h1>
          <span class="desktop-h2 product-price">
            <?php echo wc_price($product->get_price()); ?>
          </span>
        </div>
        <div class="infocard-body">
          <?php if(has_term($coffee_category_id, 'product_cat', $product->id)):?>
          <div class="minicards">
            <div class="minicard">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.0823 54.2162C29.0739 54.2162 29.0655 54.2162 29.0571 54.2162C28.9095 54.2114 25.4019 54.0566 21.8871 51.0734C19.8435 49.3394 18.2199 47.0018 17.0595 44.1266C15.6291 40.583 14.9043 36.2042 14.9043 31.1126C14.9043 24.6638 16.3311 19.4006 19.1463 15.4658C21.3831 12.3398 23.9895 10.6718 26.2443 9.45138C26.8527 9.12258 27.9243 7.34418 28.4895 6.18738C28.6107 5.94018 28.8615 5.78418 29.1363 5.78418H29.1387C29.4147 5.78418 29.6655 5.94378 29.7855 6.19338C30.4239 7.52538 31.4295 9.13218 31.9419 9.40578C34.0515 10.5314 36.7635 12.2282 39.0159 15.3806C41.8323 19.3214 43.2603 24.6146 43.2603 31.1138C43.2603 36.2066 42.5355 40.5854 41.1051 44.1278C39.9447 47.003 38.3199 49.3394 36.2775 51.0746C32.7627 54.059 29.2551 54.2126 29.1075 54.2174C29.0991 54.2174 29.0907 54.2174 29.0823 54.2174V54.2162ZM29.1303 8.04138C28.5579 9.03258 27.7155 10.2914 26.9295 10.7162C24.0351 12.2834 16.3443 16.4438 16.3443 31.1102C16.3443 39.803 18.5583 46.3058 22.7487 49.913C25.7343 52.4834 28.7679 52.7522 29.0835 52.7738C29.3907 52.7534 32.4279 52.4858 35.4171 49.913C39.6063 46.3058 41.8215 39.803 41.8215 31.1102C41.8215 16.3046 34.1523 12.2138 31.2651 10.673C30.5079 10.2686 29.6895 9.02538 29.1315 8.04018L29.1303 8.04138Z" fill="#F1EEEA"/>
                <path d="M28.4125 6.50243L28.3633 53.4956L29.8033 53.4971L29.8525 6.50394L28.4125 6.50243Z" fill="#F1EEEA"/>
                <path d="M38.555 16.0871L28.7773 21.3057L29.4554 22.576L39.2331 17.3574L38.555 16.0871Z" fill="#F1EEEA"/>
                <path d="M41.8326 25.0241L28.7539 31.7168L29.4099 32.9987L42.4885 26.306L41.8326 25.0241Z" fill="#F1EEEA"/>
                <path d="M42.0292 35.628L28.7617 42.1938L29.4004 43.4845L42.6678 36.9186L42.0292 35.628Z" fill="#F1EEEA"/>
                <path d="M19.6077 16.0851L18.9297 17.3555L28.7074 22.5741L29.3854 21.3037L19.6077 16.0851Z" fill="#F1EEEA"/>
                <path d="M16.3318 25.0286L15.6758 26.3105L28.7544 33.0032L29.4104 31.7213L16.3318 25.0286Z" fill="#F1EEEA"/>
                <path d="M16.1328 35.622L15.4941 36.9126L28.7616 43.4784L29.4003 42.1878L16.1328 35.622Z" fill="#F1EEEA"/>
              </svg>
              <div>
                <span class="minicard-label desktop-span">VARIEDAD</span>
                <span class="minicard-value">
                  <?php obtener_atributo_producto($product, 'pa_variedad'); ?>
                </span>
              </div>
            </div>
            <div class="minicard">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.3371 41.873C22.8211 41.873 17.5195 36.5714 17.5195 30.0554C17.5195 23.5394 22.8211 18.2378 29.3371 18.2378C35.8531 18.2378 41.1547 23.5394 41.1547 30.0554C41.1547 36.5714 35.8531 41.873 29.3371 41.873ZM29.3371 19.6766C23.6143 19.6766 18.9595 24.3326 18.9595 30.0542C18.9595 35.7758 23.6155 40.4318 29.3371 40.4318C35.0587 40.4318 39.7147 35.7758 39.7147 30.0542C39.7147 24.3326 35.0587 19.6766 29.3371 19.6766Z" fill="#F1EEEA"/>
                <path d="M38.0168 51.7272C37.8908 51.7272 37.7648 51.6936 37.6532 51.6288L33.3176 49.092C30.8624 47.6556 27.8132 47.6556 25.3592 49.092L21.0224 51.6288C20.828 51.7428 20.5916 51.7584 20.3828 51.672C20.1752 51.5856 20.0192 51.4068 19.9616 51.1896L18.6896 46.3296C17.9696 43.5792 15.8132 41.4228 13.0616 40.7016L8.20163 39.4296C7.98323 39.372 7.80443 39.2172 7.71923 39.0084C7.63283 38.8008 7.64963 38.5632 7.76243 38.3688L10.2992 34.0332C11.7344 31.5792 11.7344 28.5288 10.2992 26.0748L7.76243 21.7392C7.64843 21.5448 7.63283 21.3084 7.71923 21.0996C7.80563 20.892 7.98443 20.736 8.20163 20.6784L13.0616 19.4064C15.812 18.6864 17.9684 16.53 18.6896 13.7784L19.9616 8.91842C20.0192 8.70002 20.174 8.52123 20.3828 8.43603C20.5904 8.34963 20.828 8.36643 21.0224 8.47923L25.358 11.016C27.812 12.4512 30.8624 12.4512 33.3164 11.016L37.652 8.47923C37.8464 8.36523 38.0828 8.34963 38.2916 8.43603C38.4992 8.52243 38.6552 8.70122 38.7128 8.91842L39.9848 13.7784C40.7048 16.5288 42.8612 18.6852 45.6116 19.4064L50.4716 20.6784C50.69 20.736 50.8688 20.8908 50.954 21.0996C51.0404 21.3072 51.0236 21.5448 50.9108 21.7392L48.374 26.0748C46.9388 28.5288 46.9388 31.5792 48.374 34.0332L50.9108 38.3688C51.0248 38.5632 51.0404 38.7996 50.954 39.0084C50.8676 39.216 50.6888 39.372 50.4716 39.4296L45.6116 40.7016C42.8612 41.4216 40.7048 43.578 39.9848 46.3296L38.7128 51.1896C38.6552 51.408 38.5004 51.5868 38.2916 51.672C38.2028 51.7092 38.1092 51.7272 38.0156 51.7272H38.0168ZM9.48683 38.2776L13.4276 39.3096C16.6808 40.1616 19.232 42.7116 20.084 45.9648L21.116 49.9056L24.632 47.8488C27.5348 46.1508 31.142 46.1508 34.0448 47.8488L37.5608 49.9056L38.5928 45.9648C39.4448 42.7116 41.9948 40.1604 45.248 39.3096L49.1888 38.2776L47.132 34.7616C45.434 31.8588 45.434 28.2516 47.132 25.3488L49.1888 21.8328L45.248 20.8008C41.9948 19.9488 39.4436 17.3988 38.5928 14.1456L37.5608 10.2048L34.0448 12.2616C31.142 13.9596 27.5348 13.9596 24.632 12.2616L21.116 10.2048L20.084 14.1456C19.232 17.3988 16.682 19.95 13.4276 20.8008L9.48683 21.8328L11.5436 25.3488C13.2416 28.2516 13.2416 31.8588 11.5436 34.7616L9.48683 38.2776Z" fill="#F1EEEA"/>
              </svg>
              <div>
                <span class="minicard-label desktop-span">PROCESO</span>
                <span class="minicard-value">
                <?php obtener_atributo_producto($product, 'pa_proceso'); ?>
                </span>
              </div>
            </div>
            <div class="minicard">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.9053 54.1679C26.9165 54.1679 20.1641 51.6695 20.1641 42.3047C20.1641 35.2667 30.1037 25.0499 30.5273 24.6179C30.6629 24.4799 30.8477 24.4019 31.0409 24.4019H31.0457C31.2413 24.4031 31.4273 24.4835 31.5617 24.6251C31.9733 25.0571 41.6453 35.2727 41.6453 42.3047C41.6453 51.6695 34.8941 54.1679 30.9041 54.1679H30.9053ZM31.0349 26.1779C28.9853 28.3847 21.6053 36.7211 21.6053 42.3047C21.6053 46.1315 22.8041 48.9899 25.1681 50.7995C27.5045 52.5887 30.1505 52.7279 30.9053 52.7279C31.6601 52.7279 34.3061 52.5887 36.6425 50.7995C39.0065 48.9887 40.2053 46.1315 40.2053 42.3047C40.2053 36.7223 33.0365 28.3955 31.0337 26.1779H31.0349Z" fill="#F1EEEA"/>
                <path d="M30.9057 54.168C29.4597 54.168 24.3945 53.9016 19.9149 50.4708C17.8365 48.8796 16.2033 46.8396 15.0585 44.406C13.7325 41.5872 13.0605 38.2224 13.0605 34.404C13.0605 28.2372 14.8485 23.4012 16.3485 20.43C17.9817 17.196 19.6077 15.4344 19.6761 15.3612C19.8549 15.1704 20.1225 15.0912 20.3757 15.1536C20.4045 15.1608 21.0129 15.312 22.0473 15.606C26.4297 10.1208 30.8649 6.01563 30.9105 5.97363C31.1925 5.71443 31.6269 5.72043 31.9017 5.98803C31.9425 6.02883 36.0753 10.0788 40.1817 15.5052C45.7425 22.8516 48.6237 29.1024 48.7449 34.0824C48.7497 34.1892 48.7521 34.2972 48.7521 34.4052C48.7521 38.2236 48.0801 41.5884 46.7541 44.4072C45.6093 46.8408 43.9761 48.8808 41.8977 50.472C37.4169 53.9028 32.3517 54.1692 30.9057 54.1692V54.168ZM20.4561 16.662C19.9401 17.2884 18.7677 18.822 17.6085 21.1296C16.1901 23.952 14.5005 28.5468 14.5005 34.404C14.5005 48.8688 24.8133 52.728 30.9057 52.728C36.9981 52.728 47.311 48.8688 47.311 34.404C47.311 34.314 47.3085 34.224 47.3049 34.134V34.122C47.0637 24.0276 34.0833 10.2648 31.3821 7.50843C30.0741 8.76483 26.4249 12.3792 22.8753 16.8768C22.6941 17.1072 22.3905 17.2044 22.1097 17.1228C21.3813 16.9116 20.8125 16.7568 20.4549 16.662H20.4561Z" fill="#F1EEEA"/>
              </svg>
              <div>
                <span class="minicard-label desktop-span">TOSTADO</span>
                <span class="minicard-value">
                  <?php obtener_atributo_producto($product, 'pa_tostado'); ?>
                </span>
              </div>
            </div>
            <div class="minicard">
              <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.0246 41.9233C23.5086 41.9233 18.207 36.6217 18.207 30.1057C18.207 23.5897 23.5086 18.2881 30.0246 18.2881C36.5406 18.2881 41.8422 23.5897 41.8422 30.1057C41.8422 36.6217 36.5406 41.9233 30.0246 41.9233ZM30.0246 19.7269C24.3018 19.7269 19.647 24.3829 19.647 30.1045C19.647 35.8261 24.303 40.4821 30.0246 40.4821C35.7462 40.4821 40.4022 35.8261 40.4022 30.1045C40.4022 24.3829 35.7462 19.7269 30.0246 19.7269Z" fill="#F1EEEA"/>
                <path d="M30.0251 51.8266C18.0467 51.8266 8.30273 42.0814 8.30273 30.1042C8.30273 18.127 18.0479 8.38184 30.0251 8.38184C42.0023 8.38184 51.7475 18.127 51.7475 30.1042C51.7475 42.0814 42.0023 51.8266 30.0251 51.8266ZM30.0251 9.82184C18.8411 9.82184 9.74273 18.9202 9.74273 30.1042C9.74273 41.2882 18.8411 50.3866 30.0251 50.3866C41.2091 50.3866 50.3075 41.2882 50.3075 30.1042C50.3075 18.9202 41.2091 9.82184 30.0251 9.82184Z" fill="#F1EEEA"/>
                <path d="M24.4234 45.5051C24.3898 45.5051 24.355 45.5027 24.3214 45.4979L13.543 43.9607L13.747 42.5351L24.319 44.0435L34.0546 39.6719L34.645 40.9859L24.7186 45.4427C24.625 45.4847 24.5254 45.5063 24.4234 45.5063V45.5051Z" fill="#F1EEEA"/>
                <path d="M19.1453 34.7234L14.6885 24.797C14.6333 24.6722 14.6129 24.5354 14.6321 24.401L16.1693 13.6226L17.5949 13.8254L16.0865 24.3974L20.4581 34.133L19.1441 34.7234H19.1453Z" fill="#F1EEEA"/>
                <path d="M25.9966 20.5369L25.4062 19.2229L35.3327 14.7661C35.4575 14.7109 35.5943 14.6905 35.7287 14.7097L46.5071 16.2469L46.303 17.6725L35.731 16.1641L25.9955 20.5357L25.9966 20.5369Z" fill="#F1EEEA"/>
                <path d="M43.8825 46.5876L42.4569 46.3848L43.9653 35.8128L39.5938 26.0772L40.9078 25.4868L45.3645 35.4132C45.4197 35.538 45.4401 35.6748 45.4209 35.8092L43.8837 46.5876H43.8825Z" fill="#F1EEEA"/>
              </svg>
              <div>
                <span class="minicard-label desktop-span">MOLIENDA</span>
                <span class="minicard-value">
                  <?php obtener_atributo_producto($product, 'pa_molienda'); ?>
                </span>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class="info-rows">
            <div class="row">
              <span class="desktop-parrafo-bold">ORIGEN</span>
              <span class="prod-value">
                <?php echo get_post_meta(get_the_ID(), '_product_origin', true); ?>
              </span>
            </div>
            <?php if(has_term($coffee_category_id, 'product_cat', $product->id)):?>
              <div class="row">
                <span class="desktop-parrafo-bold">PUNTOS DE TAZA</span>
                <span class="prod-value">
                  <?php echo get_post_meta(get_the_ID(), '_product_cup_points', true); ?> TOTAL
                </span>
              </div>
            <?php endif; ?>
            <div class="row">
              <span class="desktop-parrafo-bold">PESO</span>
              <span class="prod-value">
                500g
              </span>
            </div>
            <div class="row">
              <span class="desktop-parrafo-bold">CANTIDAD</span>
              <div class="product-quantity-box">
                <div class="icon-menos">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.19922 9H16.7992" stroke="#4A4A4A" stroke-width="1.4"/>
                  </svg>
                </div>
                <input
                  type="number" name="cantidad-producto"
                  id="cantidad-producto" class="desktop-parrafo"
                  value="1"
                />
                <div class="icon-mas">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.99922 1.2002V16.8002M1.19922 9.0002H16.7992" stroke="#4A4A4A" stroke-width="1.4"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>
          <a
            id="link-add-to-cart" href="" class="btn-primary"
            style="display: flex; justify-content: center;"
            product-id="<?= $product->id ?>"
          >
            <span class="desktop-parrafo">
              Agregar al carrito
            </span>
          </a>
        </div>
      </div>
    </div>
    <hr />
    <div class="wrap-container sec-prod-desc">
      <h3 class="desktop-h2">DESCRIPCIÓN</h3>
      <p>
        <?php echo $product->get_description(); ?>
      </p>
    </div>
    <hr />
    <?php if(has_term($coffee_category_id, 'product_cat', $product->id)):?>
      <div class="wrap-container" style="padding-top: 160px;">
        <?php banner_oscuro('¿CÓMO PRODUCIMOS NUESTRO CAFÉ?', 'cucharas-trazabilidad.png');  ?>
      </div>
    <?php endif; ?>
    <?php lifetime_faqs(); ?>
    <hr/>
    <div class="wrap-container sec-prod-relacionados">
      <h3 class="desktop-h2">TAMBIÉN TE PUEDE INTERESAR</h3>
      <div class="related-products">
      <?php 
      
        $productos_relacionados = wc_get_related_products($product->id, 4);

        if (!empty($productos_relacionados)) {
          foreach ($productos_relacionados as $producto_id) {
            $producto_relacionado = wc_get_product($producto_id);
            
            tarjeta_producto(
              title:      $producto_relacionado->get_name(),
              url_image:  wp_get_attachment_image_url($producto_relacionado->get_image_id()),
              url:        $producto_relacionado->get_permalink(),
              price:      $producto_relacionado->get_regular_price()
            );
          }
        }
      ?>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
