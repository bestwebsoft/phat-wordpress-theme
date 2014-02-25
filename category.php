<?php
/**
 * The Template for displaying all category posts.
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header();
get_sidebar(); ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class='search-header'>	
				<?php printf( __( 'Category Archives: %s', 'phat' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			</div> <!-- .search-header -->
		</div> <!-- .search-results-background -->
	<?php get_template_part('loop', 'category'); ?>						
	</div> <!-- posts container-->
</div>  <!-- .content -->
<?php get_footer() ?>