<?php /**
 * The Template for displaying page 404 (Not Found).
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header();
get_sidebar(); ?>
<div class='posts'>
	<div class="search-results-background">
		<div class="search-header">
			<?php _e( '404: Page not found', 'phat' ); ?>
			<p><?php _e( 'Sorry, unfortunately, we could not find the requested page.', 'phat' ); ?></p>
			<p><?php _e( 'Maybe try a search?', 'phat' ); ?></p>
			<?php get_search_form(); ?>
		</div> <!-- .search-header -->
	</div> <!-- .search-results-background -->
</div> <!-- .posts -->
</div> <!-- .content -->
<?php get_footer(); ?>
