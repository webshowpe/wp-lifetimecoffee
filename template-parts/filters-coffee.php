<?php if (is_tax('product_cat', 'cafes')): ?>
  <?php
  // Obtener los atributos de los productos de WooCommerce
  $atributos_productos = wc_get_attribute_taxonomies();
  
  if ($atributos_productos): ?>
  
  <?php foreach ($atributos_productos as $atributo): ?>
      <?php 
      $nom_atributo = $atributo->attribute_name;

      if ($nom_atributo == "molienda" || $nom_atributo == "proceso" || $nom_atributo == "tostado"):
      ?>
      <div class="filter-<?= $atributo->attribute_name; ?>">
        <h4 class="desktop-parrafo" style="font-weight: 700; text-transform: uppercase;">
          <?= $atributo->attribute_label; ?>
        </h4>
        <?php 
        // Obtener los terms cada atributo de producto woocommerce
        $terms = get_terms(array(
          'taxonomy' => 'pa_' . $atributo->attribute_name,
          'hide_empty' => false,
        ));
        
        if ($terms && !is_wp_error( $terms )): ?>
          <div class="opciones">
            <?php foreach ($terms as $term): ?>
              <div style="display: flex; align-items: center; gap: 15px;">
                <div class="custom-check">
                  <input
                    type="checkbox"
                    id="<?php echo $args["prefix"] . "-" . $nom_atributo . "-" . $term->slug ?>"
                    data-term-id=<?= $term->term_id; ?>
                    name=<?= $term->taxonomy ?>
                    value=<?= $term->slug ?>
                  />
                  <svg class="icon-check" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.01 2.50879L5.99625 13.5113L0.99 8.50504L0 9.49504L5.99625 15.5025L18 3.49879L17.01 2.50879Z" fill="#4A4A4A"/>
                  </svg>
                </div>
                <label for="<?php echo $args["prefix"] . "-" . $nom_atributo . "-" . $term->slug ?>">
                  <?= $term->name ?>
                </label>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php else: ?>
    <span>No hay taxonomías de atributos disponibles.</span>
  <?php endif; ?>
<?php endif; ?>
