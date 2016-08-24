<?php
/**
 * The template for displaying search form
 * @subpackage Phat
 * @since      Phat 1.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter search keyword', 'phat' ); ?>" value="<?php the_search_query(); ?>" />
	<button type="submit" value="" class="search-submit"></button>
</form>
