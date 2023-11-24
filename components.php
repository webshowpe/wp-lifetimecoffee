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
function banner_oscuro($title, $imagename) {
  $text = esc_html($title);
  $imagename = esc_html($imagename);

  ?>
    <div class="sec-trazabilidad">
      <div class="cta">
        <h2 class="desktop-h1" style="color: var(--Fondo)"><?= $title ?></h2>
        <?php btn_primary("SABER MÁS", "https://diegoamorin.com") ?>
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


function lifetime_checkbox($label, $name, $value) {
  ?>
  <div style="display: flex; align-items: center; gap: 15px;">
    <div class="custom-check">
      <input type="checkbox" id=<?= $value ?> name=<?= $name ?> value=<?= $value ?>>
      <svg class="icon-check" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.01 2.50879L5.99625 13.5113L0.99 8.50504L0 9.49504L5.99625 15.5025L18 3.49879L17.01 2.50879Z" fill="#4A4A4A"/>
      </svg>
    </div>
    <label for=<?= $value ?>>
      <?= $label ?>
    </label>
  </div>
  <?php
}
