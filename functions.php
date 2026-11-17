<?php
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    add_editor_style( 'assets/css/editor.css' );
    register_nav_menus( array( 'primary' => 'Menu principal', 'footer' => 'Links do rodapé' ) );
} );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'vb-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap', array(), null );
    wp_enqueue_style( 'vb-icons', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css', array(), '6.7.2' );
    wp_enqueue_style( 'vb-theme', get_stylesheet_uri(), array(), '1.0.0' );
    wp_enqueue_style( 'vb-layout', get_theme_file_uri( 'assets/css/layout.css' ), array( 'vb-theme', 'vb-fonts' ), '1.0.0' );
    wp_enqueue_style( 'vb-content', get_theme_file_uri( 'assets/css/content.css' ), array( 'vb-layout' ), '1.0.0' );
    if ( is_home() || is_archive() || is_search() ) {
        wp_enqueue_style( 'vb-catalog', get_theme_file_uri( 'assets/css/catalog.css' ), array( 'vb-layout' ), '1.0.0' );
    }
    foreach ( array( 'about', 'contact' ) as $page ) {
        if ( is_page_template( 'templates/' . $page . '.php' ) ) {
            wp_enqueue_style( 'vb-' . $page, get_theme_file_uri( 'assets/css/' . $page . '.css' ), array( 'vb-layout' ), '1.0.0' );
        }
    }
    wp_enqueue_script( 'vb-site', get_theme_file_uri( 'assets/js/site.js' ), array(), '1.0.0', array( 'strategy' => 'defer', 'in_footer' => true ) );
} );

function vb_asset( $name ) {
    return get_theme_file_uri( 'assets/images/' . $name );
}

function vb_settings() {
    return array(
        'whatsapp' => array( 'WhatsApp', '(11) 94773-5655', 'sanitize_text_field' ),
        'email' => array( 'E-mail', 'contato@verbrindes.com', 'sanitize_email' ),
        'phone' => array( 'Telefone', '(11) 4771-1522', 'sanitize_text_field' ),
        'address' => array( 'Endereço', "R. Cid Nelson Jordano, 672\nJd. Salete · Taboão da Serra - SP\nCEP 06787-360", 'sanitize_textarea_field' ),
        'maps' => array( 'URL do mapa', 'https://maps.google.com/?q=R.+Cid+Nelson+Jordano,+672,+Tabo%C3%A3o+da+Serra+-+SP', 'esc_url_raw' ),
        'facebook' => array( 'URL do Facebook', 'https://www.facebook.com/ver.brindes.50', 'esc_url_raw' ),
        'skype' => array( 'URL do Skype', 'https://join.skype.com/invite/Ver%20Brindes', 'esc_url_raw' ),
        'footer_text' => array( 'Descrição no rodapé', 'Brindes que aproximam pessoas e deixam sua marca presente.', 'sanitize_text_field' ),
        'footer_credit' => array( 'Crédito no rodapé', 'Desenvolvido para conectar.', 'sanitize_text_field' ),
    );
}

add_action( 'customize_register', function ( $customizer ) {
    $customizer->add_section( 'vb_contact', array( 'title' => 'Contatos e rodapé' ) );
    foreach ( vb_settings() as $key => list( $label, $default, $sanitize ) ) {
        $customizer->add_setting( 'vb_' . $key, array( 'default' => $default, 'sanitize_callback' => $sanitize ) );
        $customizer->add_control( 'vb_' . $key, array(
            'section' => 'vb_contact',
            'label' => $label,
            'type' => 'address' === $key ? 'textarea' : 'text',
        ) );
    }
} );

function vb_setting( $key ) {
    return get_theme_mod( 'vb_' . $key, vb_settings()[ $key ][1] );
}

function vb_phone_digits( $value ) {
    $digits = preg_replace( '/\D/', '', $value );
    return in_array( strlen( $digits ), array( 10, 11 ), true ) ? '55' . $digits : $digits;
}

function vb_whatsapp( $message = '' ) {
    $phone = vb_phone_digits( vb_setting( 'whatsapp' ) );
    if ( ! $phone ) {
        return home_url( '/#contato' );
    }
    return 'https://wa.me/' . $phone . ( $message ? '?text=' . rawurlencode( $message ) : '' );
}

function vb_catalog_url() {
    $page = (int) get_option( 'page_for_posts' );
    if ( 'page' === get_option( 'show_on_front' ) && $page && 'publish' === get_post_status( $page ) ) {
        return get_permalink( $page );
    }
    return add_query_arg( 's', '', home_url( '/' ) );
}

function vb_primary_fallback() {
    $links = array( 'Início' => home_url( '/' ), 'Categorias' => vb_catalog_url() );
    foreach ( array( 'sobre' => 'Sobre nós', 'contato' => 'Contato' ) as $slug => $label ) {
        $page = get_page_by_path( $slug );
        $links[ $label ] = $page && 'publish' === $page->post_status ? get_permalink( $page ) : home_url( '/#' . $slug );
    }
    echo '<ul>';
    foreach ( $links as $label => $url ) {
        printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
    }
    echo '</ul>';
}

function vb_category_links() {
    $active = is_category() ? get_queried_object_id() : 0;
    printf( '<a class="filter%s" href="%s"%s>Todos os produtos</a>', $active ? '' : ' active', esc_url( vb_catalog_url() ), $active ? '' : ' aria-current="page"' );
    foreach ( get_categories() as $term ) {
        $current = $active === $term->term_id;
        printf( '<a class="filter%s" href="%s"%s>%s <span>%s</span></a>', $current ? ' active' : '', esc_url( get_category_link( $term ) ), $current ? ' aria-current="page"' : '', esc_html( $term->name ), esc_html( number_format_i18n( $term->count ) ) );
    }
}
