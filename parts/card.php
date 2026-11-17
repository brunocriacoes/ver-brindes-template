<?php
$catalog = ! empty( $args['catalog'] );
$terms = get_the_category();
$label = $terms ? $terms[0]->name : '';
$title = get_the_title() ?: 'Sem título';
?>
<article <?php post_class( $catalog ? 'catalog-card' : 'product' ); ?>>
    <div class="<?php echo $catalog ? 'catalog-image' : 'product-image product-photo'; ?>">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large' ); ?>
        <?php else : ?>
            <i class="fa-solid fa-gift card-placeholder" aria-hidden="true"></i>
        <?php endif; ?>
        <?php if ( $catalog && $label ) : ?><span><?php echo esc_html( $label ); ?></span><?php endif; ?>
    </div>
    <?php if ( $catalog ) : ?><div><?php endif; ?>
    <p class="product-type"><?php echo esc_html( $catalog ? ( 'post' === get_post_type() ? 'PERSONALIZÁVEL' : 'PÁGINA' ) : $label ); ?></p>
    <h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h3>
    <?php if ( 'post' === get_post_type() ) : ?>
        <a href="<?php echo esc_url( vb_whatsapp( 'Olá! Gostaria de um orçamento para ' . $title . '.' ) ); ?>">
            <?php echo $catalog ? 'Pedir orçamento' : 'Solicitar orçamento'; ?> <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
        </a>
    <?php endif; ?>
    <?php if ( $catalog ) : ?></div><?php endif; ?>
</article>
