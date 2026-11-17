<footer class="site-footer">
    <div class="container footer-main">
        <div class="footer-brand">
            <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( vb_asset( 'logo-dark.svg' ) ); ?>" alt="Ver Brindes"></a>
            <?php endif; ?>
            <p><?php echo esc_html( vb_setting( 'footer_text' ) ); ?></p>
            <div class="socials">
                <?php foreach ( array( 'facebook' => 'Facebook', 'skype' => 'Skype', 'whatsapp' => 'WhatsApp' ) as $key => $label ) :
                    if ( ! vb_setting( $key ) ) { continue; }
                    $url = 'whatsapp' === $key ? vb_whatsapp() : vb_setting( $key ); ?>
                    <a href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( $label ); ?>"><i class="fa-brands fa-<?php echo esc_attr( 'facebook' === $key ? 'facebook-f' : $key ); ?>" aria-hidden="true"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <h3>Atendimento</h3>
            <?php if ( vb_setting( 'whatsapp' ) ) : ?><a href="<?php echo esc_url( vb_whatsapp() ); ?>"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> <?php echo esc_html( vb_setting( 'whatsapp' ) ); ?></a><?php endif; ?>
            <?php if ( vb_setting( 'email' ) ) : ?><a href="<?php echo esc_url( 'mailto:' . vb_setting( 'email' ) ); ?>"><i class="fa-solid fa-envelope" aria-hidden="true"></i> <?php echo esc_html( vb_setting( 'email' ) ); ?></a><?php endif; ?>
            <?php if ( vb_setting( 'phone' ) ) : ?><a href="<?php echo esc_url( 'tel:+' . vb_phone_digits( vb_setting( 'phone' ) ) ); ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> <?php echo esc_html( vb_setting( 'phone' ) ); ?></a><?php endif; ?>
        </div>
        <div>
            <h3>Endereço</h3>
            <?php if ( vb_setting( 'maps' ) ) : ?>
                <a href="<?php echo esc_url( vb_setting( 'maps' ) ); ?>"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?php echo nl2br( esc_html( vb_setting( 'address' ) ) ); ?></a>
            <?php else : ?><p><?php echo nl2br( esc_html( vb_setting( 'address' ) ) ); ?></p><?php endif; ?>
        </div>
        <div>
            <h3>LGPD</h3>
            <?php if ( has_nav_menu( 'footer' ) ) :
                wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'container_aria_label' => 'Links do rodapé', 'depth' => 1 ) );
            else :
                the_privacy_policy_link();
                foreach ( array( 'politica-de-cookies', 'termos-de-uso' ) as $slug ) {
                    $legal = get_page_by_path( $slug );
                    if ( $legal && 'publish' === $legal->post_status ) {
                        printf( '<a href="%s">%s</a>', esc_url( get_permalink( $legal ) ), esc_html( get_the_title( $legal ) ) );
                    }
                }
            endif; ?>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>© <?php echo esc_html( wp_date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>. Todos os direitos reservados.</p>
        <p><?php echo esc_html( vb_setting( 'footer_credit' ) ); ?></p>
    </div>
</footer>
<?php if ( vb_setting( 'whatsapp' ) ) : ?>
    <a class="whatsapp-float" href="<?php echo esc_url( vb_whatsapp() ); ?>" aria-label="Falar pelo WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
<?php endif; ?>
<?php wp_footer(); ?>
</body></html>
