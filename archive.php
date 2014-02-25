<?php
/**
 * The Template for displaying Archive.
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header();
get_sidebar();
if ( have_posts() ) the_post(); ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class='search-header'>	
				<?php if ( is_day() ) : 
					printf( __( 'Daily Archives:', 'phat' ) . ' %s', '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives:', 'phat' ) . ' %s', '<span>' . get_the_date( 'F Y' ) . '</span>' );
				elseif ( is_year() ) : 
					printf( __( 'Yearly Archives:', 'phat' ) . ' %s', '<span>' . get_the_date( 'Y' ) . '</span>' );
				else : 
					_e( 'Blog Archives:', 'phat' ); 
				endif; ?>
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
</div>  <!-- .content -->
<?php get_footer(); ?>