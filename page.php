<?php
/**
 * The Template for displaying all page entryes.
 * @subpackage Phat
 * @since Phat 1.0
 */
get_header();
get_sidebar(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class='posts'>
		<?php if (have_posts()) :
			while (have_posts()) : the_post();?>
				<div class='entry'>
					<div class='entry-header'>
						<h1>
							<a href="<?php the_permalink(); ?>"><?php the_title()?></a>
						</h1>
					</div> <!-- .entry-header -->
					<div class='entry-meta'>
						<?php printf( __('Posted on ', 'phat') ); ?> <a href='<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>'>
	                    <?php the_time( 'j' ); printf( __( ' of ', 'phat' ) ); the_time('F, Y'); ?></a>
						<?php printf( __( 'by ', 'phat' ) ); ?><a href='<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>'><?php the_author_meta( 'display_name' ); ?></a>
					</div> <!-- .entry-meta -->
					<div class='entry-content'>
						<?php the_content() ?>
					</div> <!-- .entry-content -->
					<?php wp_link_pages( 
						array( 
							'before' => '<div class="phat-page-links"><span>'.__( 'Pages: ', 'phat' ).'</span>',
							'after'  => '</div>'
						) 
					); ?>
					<div class='entry-footer'>
						<?php if (has_tag()) :
							the_tags( '', ', ', '' );
							edit_post_link( __( 'Edit', 'phat' ), '<span>|</span> <span>', '</span>' );
						else :
							edit_post_link( __( 'Edit', 'phat' ));
						endif ?>
					</div> <!-- .entry-footer -->
					<?php comments_template( '', false ); ?>
				</div> <!-- .entry -->
		<div class='post-divider'>
		</div> <!-- .post-divider -->
		<?php endwhile; ?>
		<div class='pagination'>
		</div> <!-- .pagination -->
		<?php endif; ?>
	</div> <!-- .posts -->
</div> <!-- dinamic post class -->
</div>  <!-- .content -->
<?php get_footer() ?>
