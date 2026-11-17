<?php get_header(); ?>
<main id="conteudo" tabindex="-1">
    <section class="legal missing">
        <p class="eyebrow">ERRO 404</p>
        <h1>Página não encontrada.</h1>
        <p>Busque um brinde ou volte para a página inicial.</p>
        <?php get_search_form(); ?>
        <a class="button primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    </section>
</main>
<?php get_footer(); ?>
