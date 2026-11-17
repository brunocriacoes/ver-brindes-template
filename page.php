<?php get_header(); ?>
<main id="conteudo" tabindex="-1">
    <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class( 'legal' ); ?>>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_post_thumbnail() && ! post_password_required() ) : the_post_thumbnail( 'large', array( 'class' => 'entry-cover' ) ); endif; ?>
            <div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
