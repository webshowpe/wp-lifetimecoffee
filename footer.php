<footer class="wrap-grande">
      <div class="wrap-container sec-footer">
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">UBICACIÓN</h4>
          <ul>
            <li class="desktop-parrafo">VILLA RICA / PASCO / PERÚ</li>
          </ul>
        </div>
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">CONTACTO</h4>
          <ul>
            <li>
              <a href="#"><span class="desktop-parrafo">+51 943 496 591</span></a>
            </li>
            <li>
              <a href="#"><span class="desktop-parrafo">contacto@lifetimecoffee.pe</span></a>
            </li>
          </ul>
        </div>
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">REDES SOCIALES</h4>
          <ul>
            <li><a href="#"><span class="desktop-parrafo">FACEBOOK</span></a></li>
            <a href="#"><span class="desktop-parrafo">INSTAGRAM</span></a>
          </ul>
        </div>
        <div class="col">
          <?php
            wp_nav_menu(array(
              'menu_class' => 'bottom-menu',
              'theme_location' => 'bottom-desktop',
              'container' => '',
              'link_before' => '<h4 class="desktop-parrafo" style="text-transform: uppercase;">',
              'link_after' => '</h4>',
            ));
          ?>
        </div>
      </div>
      <div class="wrap-container sec-copyright">
        <span class="desktop-span">© LIFETIME COFFEE <?php echo date('Y'); ?> - TODOS LOS DERECHOS RESERVADOS</span>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
