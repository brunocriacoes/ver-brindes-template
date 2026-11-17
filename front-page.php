<?php get_header(); ?>
<main id="conteudo" tabindex="-1">
<section id="inicio" class="hero parallax-hero"><div class="hero-shade"></div><div class="container hero-grid">
      <div class="hero-copy"><p class="eyebrow">BRINDES QUE CRIAM CONEXÕES</p><h1>Sua marca no <em>centro</em> das atenções.</h1><p class="hero-text">Produtos personalizados que transformam cada experiência em lembrança.</p><a href="#destaques" class="button primary">Conhecer produtos <i class="fa-solid fa-arrow-right"></i></a></div>
      <div class="parallax-stage" aria-label="Produtos personalizados Ver Brindes"><img class="parallax-product product-shirt" src="<?php echo esc_url( vb_asset( 'camiseta.png' ) ); ?>" alt="Camiseta personalizada Ver Brindes"><img class="parallax-product product-cup" src="<?php echo esc_url( vb_asset( 'copo.png' ) ); ?>" alt="Copo personalizado Ver Brindes"><img class="parallax-product product-mug" src="<?php echo esc_url( vb_asset( 'caneca.png' ) ); ?>" alt="Caneca personalizada Ver Brindes"></div>
    </div></section>
<section class="trust"><div class="container trust-grid"><div><b>01</b><span>Atendimento<br>consultivo</span></div><div><b>02</b><span>Produção com<br>qualidade</span></div><div><b>03</b><span>Entrega para<br>todo o Brasil</span></div><div><b>04</b><span>Projetos sob<br>medida</span></div></div></section>
<section id="categorias" class="section categories"><div class="container"><div class="section-head"><div><p class="eyebrow">ENCONTRE O BRINDE IDEAL</p><h2>Feito para cada <em>momento.</em></h2></div><a href="<?php echo esc_url( vb_catalog_url() ); ?>" class="text-link">Ver todos os produtos <span>→</span></a></div><div class="category-grid">
            <?php $terms = get_categories( array( 'number' => 4, 'orderby' => 'count', 'order' => 'DESC' ) );
            $examples = array( 'Corporativo' => 'Para equipes que fazem acontecer.', 'Eventos' => 'Experiências que dão o que falar.', 'Sustentáveis' => 'Escolhas que fazem sentido.', 'Datas especiais' => 'Presentes que criam conexões.' );
            $position = 0;
            foreach ( $terms ?: $examples as $key => $item ) :
                ++$position;
                $name = $terms ? $item->name : $key;
                $description = $terms ? $item->description : $item;
                $url = $terms ? get_category_link( $item ) : vb_catalog_url(); ?>
                <a href="<?php echo esc_url( $url ); ?>" class="category-tile c<?php echo esc_attr( $position ); ?>">
                    <span><?php echo esc_html( sprintf( '%02d', $position ) ); ?></span>
                    <h3><?php echo esc_html( $name ); ?></h3>
                    <?php if ( $description ) : ?><p><?php echo esc_html( wp_strip_all_tags( $description ) ); ?></p><?php endif; ?>
                    <b aria-hidden="true">→</b>
                </a>
            <?php endforeach; ?>
        </div></div></section>
<section id="destaques" class="section products"><div class="container"><div class="section-head"><div><p class="eyebrow">SELEÇÃO VER BRINDES</p><h2>Produtos que <em>encantam.</em></h2></div><div class="carousel-controls"><button class="round-btn" type="button" id="prev" aria-controls="product-track" aria-label="Produtos anteriores"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button><button class="round-btn" type="button" id="next" aria-controls="product-track" aria-label="Próximos produtos"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button></div></div><div id="product-track" class="product-track" tabindex="0" aria-label="Produtos em destaque">
        <?php
        $featured = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 8, 'no_found_rows' => true ) );
        if ( $featured->have_posts() ) :
            while ( $featured->have_posts() ) :
                $featured->the_post();
                get_template_part( 'parts/card' );
            endwhile;
            wp_reset_postdata();
        else :
            get_template_part( 'parts/demo' );
        endif; ?>
    </div></div></section>
<section id="como-funciona" class="how"><div class="container how-grid"><div><p class="eyebrow">SIMPLIFICAMOS O PROCESSO</p><h2>Da ideia ao brinde,<br><em>sem complicação.</em></h2><a href="#contato" class="button primary">Começar um projeto <span>→</span></a></div><ol><li><b>01</b><div><h3>Conte sua ideia</h3><p>Você nos fala o que precisa e para quem é.</p></div></li><li><b>02</b><div><h3>Criamos juntos</h3><p>Indicamos os melhores produtos e personalizações.</p></div></li><li><b>03</b><div><h3>Você surpreende</h3><p>Entregamos tudo pronto para a sua marca brilhar.</p></div></li></ol></div></section>
<div id="sobre">
<?php if ( is_page() && have_posts() ) : the_post(); ?>
<?php if ( trim( get_the_content() ) ) : ?>
    <div class="container entry-content institutional"><?php the_content(); wp_link_pages(); ?></div>
<?php else : ?>
<section class="quote-section"><div class="container"><p class="eyebrow">VER BRINDES</p><blockquote>“Acreditamos que um brinde não é só um produto. É uma lembrança da sua marca na vida de alguém.”</blockquote><div class="signature"><span>VB</span><p>Feito com propósito,<br><strong>para marcas que querem marcar.</strong></p></div></div></section>
<?php endif; else : ?>
<section class="quote-section"><div class="container"><p class="eyebrow">VER BRINDES</p><blockquote>“Acreditamos que um brinde não é só um produto. É uma lembrança da sua marca na vida de alguém.”</blockquote><div class="signature"><span>VB</span><p>Feito com propósito,<br><strong>para marcas que querem marcar.</strong></p></div></div></section>
<?php endif; ?>
</div>
<?php get_template_part( 'parts/contact-cta' ); ?>
</main>
<?php get_footer(); ?>
