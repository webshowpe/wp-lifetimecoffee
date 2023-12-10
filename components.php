<?php

// Botón principal
function btn_primary($text, $link) {
  $text = esc_html($text);
  $link = esc_html($link);

  ?>
    <a href="<?= $link ?>" class="btn-primary">
      <span class="desktop-parrafo"><?= $text ?></span>
      <svg xmlns="http://www.w3.org/2000/svg" width="61" height="9" viewBox="0 0 61 9" fill="none">
        <path d="M60.3535 4.85355C60.5488 4.65829 60.5488 4.34171 60.3535 4.14645L57.1716 0.964466C56.9763 0.769204 56.6597 0.769204 56.4645 0.964466C56.2692 1.15973 56.2692 1.47631 56.4645 1.67157L59.2929 4.5L56.4645 7.32843C56.2692 7.52369 56.2692 7.84027 56.4645 8.03553C56.6597 8.2308 56.9763 8.2308 57.1716 8.03553L60.3535 4.85355ZM0 5H60V4H0V5Z" fill="black"/>
      </svg>
    </a>
  <?php
}

// Banner de fondo yute
function banner_oscuro($title, $imagename, $link) {
  $text = esc_html($title);
  $imagename = esc_html($imagename);

  ?>
    <div class="sec-trazabilidad">
      <div class="cta">
        <h2 class="desktop-h1" style="color: var(--Fondo)"><?= $title ?></h2>
        <?php btn_primary("SABER MÁS", $link) ?>
      </div>
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/imgs/<?= $imagename ?>"
        alt="" width="970px" />
    </div>
  <?php
}

// Tarjeta de producto
function tarjeta_producto($title, $url_image, $url, $price) {
  ?>
  <a class="card-product" href="<?= $url ?>">
    <img src="<?= $url_image ?>" alt="<?= $title ?>">
    <div class="desc-product">
      <h4 class="desktop-parrafo"><?= $title ?></h4>
      <hr/>
      <span>S/. <?= $price ?></span>
    </div>
  </a>
  <?php
}


function lifetime_faqs() {
  ?>
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
  <?php
}
