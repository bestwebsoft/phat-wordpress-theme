<?php
/**
 * The Template for displaying all single posts.
 * @subpackage Phat
 * @since      Phat 1.0
 */
get_header();
get_sidebar(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class='posts'>
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div class='entry'>
					<div class='entry-header'>
						<h1>
							<?php the_title() ?>
						</h1>
					</div> <!-- .entry-header -->
					<div class='entry-meta'>
						<?php _e( 'Posted on', 'phat' ); ?>
						<a href='<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>'><?php echo get_the_date(); ?></a>
						<?php _e( 'by', 'phat' ); ?>
						<a href='<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>'><?php the_author_meta( 'display_name' ); ?></a>
						<?php if ( has_category() ) {
							_e( 'in ', 'phat' );
							the_category( ', ' );
						} ?>
					</div> <!-- .entry-meta -->
					<div class='entry-content'>
						<?php the_content() ?>
					</div> <!-- .entry-content -->
					<?php wp_link_pages( array(
						'before' => '<div class="phat-page-links"><span>' . __( 'Pages: ', 'phat' ) . '</span>',
						'after'  => '</div>',
					) ); ?>
					<div class='entry-footer'>
						<?php if ( has_tag() ) :
							the_tags( '', ', ', '' );
							edit_post_link( __( 'Edit', 'phat' ), '<span>|</span> <span>', '</span>' );
						else :
							edit_post_link( __( 'Edit', 'phat' ) );
						endif ?>
					</div> <!-- .entry-footer -->
					<?php comments_template( '', false ); ?>
				</div> <!-- .entry -->
				<div class='post-divider'>
				</div> <!-- .post-divider -->
			<?php endwhile; ?>
			<div class='pagination'>
				<div class='left-pagination-link'><?php previous_post_link( '%link', '&laquo; ' . __( 'Previous entry', 'phat' ) ); ?> </div>
				<div class='right-pagination-link'><?php next_post_link( '%link', __( 'Next entry', 'phat' ) . ' &raquo;' ); ?></div>
			</div> <!-- .pagination -->
		<?php endif; ?>
	</div> <!-- .posts -->
</div> <!-- dinamic post class -->
<?php get_footer();
