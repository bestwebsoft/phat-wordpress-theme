<?php 
/**
 * The template for displaying Search Results pages.
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header(); 
get_sidebar();
if ( have_posts() ) : ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class="search-header">
				<?php printf( __( 'Search Results for: %s', 'phat' ), '<span>' . get_search_query() . '</span>' ); ?>
			</div> <!-- .search-header -->
		</div> <!-- .search-results-background -->
		<?php get_template_part( 'loop', 'search' ); ?>
	</div> <!-- .posts -->
</div>  <!-- .content -->
<?php get_footer() ?>

<?php else : ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class="search-header">
				<?php _e( 'Sorry, unfortunately, we could not find the requested querry.', 'phat' ); ?>
				<p><?php _e( 'You should try to find something else', 'phat' ); ?></p>
				<?php get_search_form(); ?>
			</div> <!-- #content404 -->
		</div> <!-- #container404 -->
<?php endif; ?>
	</div> <!-- .posts -->
</div>  <!-- .content -->
<?php get_footer(); ?>
