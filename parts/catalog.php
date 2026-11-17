<?php
$query = get_search_query( false );
$is_catalog = is_home() || ( is_search() && '' === $query );
$show_demo = $is_catalog && ! have_posts() && ! is_paged();
$title = is_search() ? sprintf( 'Resultados para “%s”', $query ) : get_the_archive_title();
$description = is_category() ? term_description() : '';
?>
<?php if ( $is_catalog ) : ?>
<section class="category-intro"><div class="container"><p class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a><span>/</span> Categorias</p><p class="eyebrow">CATÁLOGO VER BRINDES</p><h1>Brindes para transformar<br><em>cada momento.</em></h1><p>Encontre produtos personalizados que dão forma à sua ideia — para presentear, aproximar e tornar a sua marca inesquecível.</p></div></section>
<?php else : ?>
    <section class="category-intro"><div class="container">
        <p class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a><span aria-hidden="true">/</span> <?php echo is_search() ? 'Busca' : 'Arquivo'; ?></p>
        <p class="eyebrow">CATÁLOGO VER BRINDES</p>
        <h1><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></h1>
        <?php if ( $description ) : ?><div class="archive-description"><?php echo wp_kses_post( $description ); ?></div><?php endif; ?>
    </div></section>
<?php endif; ?>
<section id="catalogo" class="catalog"><div class="container">
    <div class="catalog-head"><div>
        <p class="eyebrow"><?php echo $is_catalog ? 'ESCOLHA O SEU FAVORITO' : 'ENCONTRE O BRINDE IDEAL'; ?></p>
        <h2><?php echo $is_catalog ? 'Explore nossas <em>categorias.</em>' : 'Confira os <em>resultados.</em>'; ?></h2>
    </div><p><?php
        global $wp_query;
        $total = $show_demo ? 8 : (int) $wp_query->found_posts;
        echo esc_html( sprintf( 1 === $total ? '%s resultado' : '%s resultados', number_format_i18n( $total ) ) );
    ?></p></div>
    <div class="catalog-layout">
        <aside class="catalog-filter" aria-label="Categorias"><p>Filtrar por</p><div class="filter-list"><?php vb_category_links(); ?></div></aside>
        <div>
            <?php if ( have_posts() || $show_demo ) : ?>
                <div class="catalog-products">
                    <?php if ( $show_demo ) :
                        get_template_part( 'parts/demo', null, array( 'catalog' => true ) );
                    else :
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'parts/card', null, array( 'catalog' => true ) );
                        endwhile;
                    endif; ?>
                </div>
                <?php the_posts_pagination( array( 'prev_text' => 'Anterior', 'next_text' => 'Próxima', 'screen_reader_text' => 'Paginação de resultados' ) ); ?>
            <?php else : ?>
                <p>Nenhum resultado encontrado.</p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </div>
    </div>
</div></section>
<section class="category-cta"><div class="container"><div><p class="eyebrow">NÃO ENCONTROU O QUE PROCURA?</p><h2>Vamos criar um brinde<br><em>só para você.</em></h2></div><a href="<?php echo esc_url( vb_whatsapp() ); ?>" class="button whatsapp-cta"><i class="fa-brands fa-whatsapp"></i> Falar com consultor <span>→</span></a></div></section>
