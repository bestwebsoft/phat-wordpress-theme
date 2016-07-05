<?php
/**
 * The Template for displaying Archive.
 * @subpackage Phat
 * @since      Phat 1.0
 */
get_header();
get_sidebar();
if ( have_posts() ) {
	the_post();
} ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class='search-header'>
				<?php the_archive_title(); ?>
			</div>
		</div>
		<?php
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();
		get_template_part( 'loop', 'archive' ); ?>
	</div> <!-- .posts -->
<?php get_footer();
