<?php 
/**
 * The template used to display Tag Archive pages
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header();
get_sidebar(); ?>
	<div class='posts'>
		<div class="search-results-background">
			<div class='search-header'>	
				<?php printf( __( 'Tag Archives: %s', 'phat' ), '<span>' . single_tag_title( '', false ) . '</span>' );?>
			</div>
		</div> <!-- .search-results-background -->
			<?php get_template_part('loop', 'tag'); ?>
	</div> <!-- .posts-->
</div>  <!--Content div (with padding from js)-->
<?php get_footer() ?>