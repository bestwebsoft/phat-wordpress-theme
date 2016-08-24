<?php
/**
 * The template for displaying Search Results pages.
 * @subpackage Phat
 * @since      Phat 1.0
 */
get_header();
get_sidebar(); ?>
	<div class='posts'>
		<?php if ( have_posts() ) :
			the_post(); ?>
			<div class="search-results-background">
				<div class="search-header">
					<?php _e( 'Search Results for: ', 'phat' );
					the_search_query(); ?>
				</div> <!-- .search-header -->
			</div> <!-- .search-results-background -->
			<?php rewind_posts();
			get_template_part( 'loop', 'search' );
		else : ?>
			<div class="search-results-background">
				<div class="search-header">
					<?php _e( 'Sorry, unfortunately, we could not find the requested query.', 'phat' ); ?>
					<p><?php _e( 'You should try to find something else', 'phat' ); ?></p>
					<?php get_search_form(); ?>
				</div> <!-- .search-header -->
			</div> <!-- .search-results-background -->
		<?php endif; ?>
	</div> <!-- .posts -->
<?php get_footer();
