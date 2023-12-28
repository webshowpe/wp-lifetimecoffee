<?php
function lifetime_settings_theme() {
  // Registrando una nueva configuracion en la página "reading"
  register_setting('reading', 'lf_settings_theme');

  // Registrando una nueva sección en la página settings>reading
  add_settings_section(
    'lifetime_config_section',
    'Configuración del tema',
    'lifetime_config_section_cb',
    'reading'
  );

  // Campo para agregar el ID de la página de trazabilidad
  add_settings_field(
    'lifetime_id_page_traz',
    'ID de pag. de trazabilidad',
    'lifetime_id_page_traz_cb',
    'reading',
    'lifetime_config_section',
    [
      'label_for' => 'id_pag_traz',
      'class' => '',
    ]
  );

  // Campo para agregar el ID de la categoria de Café
  add_settings_field( 
    'lifetime_id_cat_coffee',
    'ID de cat. de café',
    'lifetime_id_cat_coffee_cb',
    'reading',
    'lifetime_config_section',
    [
      'label_for' => 'id_cat_coffee',
      'class' => '',
    ]
  );
}

add_action('admin_init', 'lifetime_settings_theme');


function lifetime_config_section_cb() {
  echo '<p>Seccion mi primera configuración</p>';
}
function lifetime_id_page_traz_cb($args) {
  $id_traz_label = $args['label_for'];
  $theme_settings = get_option('lf_settings_theme');
  
  if (isset($theme_settings[$id_traz_label])) {
    $id_traz_value = esc_attr($theme_settings[$id_traz_label]);
  } else {
    $id_traz_value = '';
  }

  $html = "<input type='number' name='lf_settings_theme[$id_traz_label]' value='$id_traz_value'>";
  echo $html;
}

function lifetime_id_cat_coffee_cb($args) {
  $id_cat_coffee_label = $args['label_for'];
  $theme_settings = get_option('lf_settings_theme');

  if (isset($theme_settings[$id_cat_coffee_label])) {
    $id_cat_coffee_value = esc_attr($theme_settings[$id_cat_coffee_label]);
  } else {
    $id_cat_coffee_value = '';
  }

  $html = "<input type='number' name='lf_settings_theme[$id_cat_coffee_label]' value='$id_cat_coffee_value'>";
  echo $html;
}
