<?php
/**
 * The main Index template.
 * @subpackage Phat
 * @since      Phat 1.0
 */
get_header();
get_sidebar(); ?>
	<div class='posts'>
		<?php get_template_part( 'loop' ); ?>
	</div> <!-- .posts -->
<?php get_footer();
