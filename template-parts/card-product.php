<a class="card-product" href="<?= esc_url($args['link_to']) ?>">
  <img 
    src="<?= esc_url($args['link_image']) ?>"
    alt="<?= esc_html($args['title']) ?>"
  />
  <div class="desc-product">
    <h4 class="desktop-parrafo"><?= esc_html($args['title']) ?></h4>
    <hr/>
    <span>S/. <?= esc_html($args['price']) ?></span>
  </div>
</a>
