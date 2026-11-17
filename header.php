<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( ! has_site_icon() ) : ?>
        <link rel="icon" href="<?php echo esc_url( vb_asset( 'ico.png' ) ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#conteudo">Pular para o conteúdo</a>
<div class="topbar"><div class="container">
    <span><i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i> Personalização que conecta marcas e pessoas</span>
    <a href="<?php echo esc_url( vb_whatsapp() ); ?>">Fale com um especialista <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
</div></div>
<header class="header"><div class="container header-inner">
    <div class="brand">
        <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' – início' ); ?>">
                <img class="logo dark-logo" src="<?php echo esc_url( vb_asset( 'logo-light.svg' ) ); ?>" alt="Ver Brindes">
                <img class="logo light-logo" src="<?php echo esc_url( vb_asset( 'logo-dark.svg' ) ); ?>" alt="">
            </a>
        <?php endif; ?>
    </div>
    <?php get_search_form(); ?>
    <nav id="nav" class="nav" aria-label="Navegação principal">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'vb_primary_fallback', 'depth' => 1 ) ); ?>
    </nav>
    <div class="header-actions">
        <div class="font-controls" role="group" aria-label="Tamanho do texto">
            <button id="font-minus" type="button" aria-label="Diminuir letras">A−</button>
            <button id="font-reset" type="button" aria-label="Tamanho padrão">A</button>
            <button id="font-plus" type="button" aria-label="Aumentar letras">A+</button>
        </div>
        <button id="theme-toggle" class="round-btn" type="button" aria-label="Modo escuro" aria-pressed="false"><i class="fa-solid fa-moon" aria-hidden="true"></i></button>
        <a class="quote small" href="<?php echo esc_url( vb_whatsapp() ); ?>">Pedir orçamento <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        <button id="menu-toggle" class="menu-btn" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="nav"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
    </div>
</div></header>
