<?php $field_id = wp_unique_id( 'vb-search-' ); ?>
<form class="site-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only" for="<?php echo esc_attr( $field_id ); ?>">Buscar brindes</label>
    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
    <input id="<?php echo esc_attr( $field_id ); ?>" type="search" name="s" placeholder="Buscar brindes" value="<?php echo esc_attr( get_search_query( false ) ); ?>">
    <button type="submit" aria-label="Buscar"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
</form>
