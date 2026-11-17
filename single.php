<?php get_header(); ?>
<main id="conteudo" tabindex="-1">
<?php while ( have_posts() ) : the_post(); ?>
    <article <?php post_class( 'legal' ); ?>>
        <p class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( vb_catalog_url() ); ?>">Catálogo</a></p>
        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
            <span><?php the_author_posts_link(); ?></span>
            <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            <span><?php the_category( ', ' ); ?></span>
        </div>
        <?php if ( has_post_thumbnail() && ! post_password_required() ) : the_post_thumbnail( 'large', array( 'class' => 'entry-cover' ) ); endif; ?>
        <div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
        <?php if ( ! post_password_required() ) :
            $share_url = rawurlencode( get_permalink() );
            $share_text = rawurlencode( get_the_title() . ' ' . get_permalink() );
        ?>
            <div class="article-actions">
                <a class="button primary" href="<?php echo esc_url( vb_whatsapp( 'Olá! Gostaria de um orçamento para ' . get_the_title() . '.' ) ); ?>">Pedir orçamento <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                <div class="share" aria-label="Compartilhar" role="group">
                    <span>Compartilhar</span>
                    <a class="round-btn" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url ); ?>" aria-label="Compartilhar no Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                    <a class="round-btn" href="<?php echo esc_url( 'https://wa.me/?text=' . $share_text ); ?>" aria-label="Compartilhar no WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                    <a class="round-btn" href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $share_url ); ?>" aria-label="Compartilhar no LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                </div>
            </div>
        <?php endif; ?>
    </article>
    <?php
    $ids = wp_get_post_categories( get_the_ID() );
    if ( $ids && ! post_password_required() ) :
        $related = new WP_Query( array( 'category__in' => $ids, 'post__not_in' => array( get_the_ID() ), 'posts_per_page' => 4, 'ignore_sticky_posts' => true, 'no_found_rows' => true ) );
        if ( $related->have_posts() ) : ?>
            <section class="section products"><div class="container">
                <div class="section-head"><h2>Artigos <em>relacionados.</em></h2></div>
                <div class="related-grid"><?php while ( $related->have_posts() ) : $related->the_post(); get_template_part( 'parts/card' ); endwhile; ?></div>
            </div></section>
        <?php endif;
        wp_reset_postdata();
    endif; ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
