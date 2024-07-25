    <footer class="wrap-grande">
      <div class="wrap-container sec-footer">
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">UBICACIÓN</h4>
          <ul>
            <li class="desktop-parrafo">
              <a
                href="https://maps.app.goo.gl/S7UXjWkK1aTEnne19"
                target="_blank"
                style="display: flex; align-items: center; column-gap: 8px;"
              >
                <span>VILLA RICA / PASCO / PERÚ</span>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="MiniIcons">
                  <path id="Vector" d="M7.8575 4.6625H2V15.3125H12.65V9.455M9.9875 2H15.3125M15.3125 2V7.325M15.3125 2L7.8575 9.455" stroke="#4A4A4A" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                </svg>
              </a>
            </li>
          </ul>
        </div>
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">CONTACTO</h4>
          <ul>
            <li>
              <a href="tel:+51943496591" class="desktop-parrafo">
                +51 943 496 591
              </a>
            </li>
            <li>
              <a href="mailto:lifetimecoffeevr@gmail.com" class="desktop-parrafo">
                lifetimecoffeevr@gmail.com
              </a>
            </li>
          </ul>
        </div>
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">REDES SOCIALES</h4>
          <ul>
            <li>
              <a
                href="https://www.facebook.com/profile.php?id=100088870574925"
                class="desktop-parrafo"
                target="_blank"
              >
                FACEBOOK
              </a>
            </li>
            <li>
              <a href="#" class="desktop-parrafo">INSTAGRAM</a>
            </li>
          </ul>
        </div>
        <div class="col">
          <h4 class="desktop-parrafo" style="font-weight: 700;">POLÍTICAS</h4>
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
        <span class="desktop-span">
          © LIFETIME COFFEE <?php echo date('Y'); ?> - TODOS LOS DERECHOS RESERVADOS
        </span>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
