<?php
// Argumentos para este template part:
// - title
// - thumbnail_id
// - link_to
// - price
?>
<a class="card-product" href="<?= esc_url($args['link_to']) ?>">
  <?php
    if (wp_get_attachment_image($args['thumbnail_id'], 'medium') != ''):
      echo wp_get_attachment_image(
        $args['thumbnail_id'],
        'medium',
        array('alt' => $args['title'])
      );
  ?>
  <?php else: ?>
      <img src=<?= wc_placeholder_img_src() ?> alt="Categoría de <?= $args['title'] ?>" /> 
  <?php endif; ?>
  <div class="desc-product">
    <h4 class="desktop-parrafo"><?= esc_html($args['title']) ?></h4>
    <hr/>
    <span>S/. <?= esc_html($args['price']) ?></span>
  </div>
</a>
