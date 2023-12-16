<div class="sec-banner-oscuro">
  <div class="cta">
    <h2 class="desktop-h1" style="color: var(--Fondo)">
      <?= esc_html( $args['title'] ) ?>
    </h2>
    <?php get_template_part("template-parts/btn-primary", "", [
      "link" => $args['link'],
      "text" => $args['cta'],
    ]);?>
  </div>
  <img
    src="<?php echo get_template_directory_uri(); ?>/assets/imgs/<?= esc_html($args['imagename']) ?>"
    alt="" />
</div>
