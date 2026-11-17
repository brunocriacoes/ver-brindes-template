<?php
$items = array(
    array( 'caneca-01.jpeg', 'Caneca floral personalizada', 'Canecas', 'Caneca personalizada floral' ),
    array( 'camiseta.jpeg', 'Camiseta rosa personalizada', 'Vestuário', 'Camiseta personalizada' ),
    array( 'toalha-personalizada.jpeg', 'Toalha personalizada', 'Toalhas', 'Toalha personalizada' ),
    array( 'kit-caneca-toalha-chocolate-01.jpeg', 'Kit de caneca, toalha e chocolate', 'Kits', 'Kit presente personalizado' ),
    array( 'traveceiro-01.jpeg', 'Travesseiro personalizado', 'Conforto', 'Travesseiro personalizado' ),
    array( 'almofada-02.jpeg', 'Almofada personalizada', 'Decoração', 'Almofada personalizada' ),
    array( 'chaveiro-01.jpeg', 'Chaveiro personalizado', 'Lembranças', 'Chaveiro personalizado' ),
    array( 'kit-caneca-toalha-chocolate-01.jpeg', 'Caneca em kit personalizado', 'Canecas', 'Caneca para presentear' ),
);
foreach ( ! empty( $args['catalog'] ) ? $items : array_slice( $items, 0, 7 ) as list( $file, $alt, $term, $title ) ) :
    $url = vb_whatsapp( 'Olá! Gostaria de um orçamento para ' . $title . '.' );
    if ( ! empty( $args['catalog'] ) ) : ?>
        <article class="catalog-card">
            <div class="catalog-image"><img src="<?php echo esc_url( vb_asset( $file ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy"><span><?php echo esc_html( $term ); ?></span></div>
            <div><p>PERSONALIZÁVEL</p><h3><?php echo esc_html( $title ); ?></h3><a href="<?php echo esc_url( $url ); ?>">Pedir orçamento <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></div>
        </article>
    <?php else : ?>
        <article class="product">
            <div class="product-image product-photo"><img src="<?php echo esc_url( vb_asset( $file ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy"></div>
            <p class="product-type"><?php echo esc_html( $term ); ?></p><h3><?php echo esc_html( $title ); ?></h3>
            <a href="<?php echo esc_url( $url ); ?>">Solicitar orçamento <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        </article>
    <?php endif;
endforeach;
