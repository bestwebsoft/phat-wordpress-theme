<?php
/**
 * The Template for displaying image attachment.
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
						<?php printf( __('Posted on', 'phat') ); ?> <a href='<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>'>
                    <?php the_time( 'j' ); printf( __( 'of', 'phat' ) ); the_time('F, Y'); ?></a>
					<?php printf( __( 'by', 'phat' ) ); ?><a href='<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>'><?php the_author_meta( 'display_name' ); ?></a> 
							<?php $metadata = wp_get_attachment_metadata();
							printf( __( 'Full size is %s pixels', 'phat' ), 
								sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									wp_get_attachment_url(),
									esc_attr( __( 'Link to full-size image', 'phat' ) ),
									$metadata['width'],
									$metadata['height']
								) 
							); ?>
					</div> <!-- .entry-meta -->
					<div class='entry-content'>
						<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php _e( 'Click to full-size image: ', 'phat' ) . the_title_attribute(); ?>" rel="attachment">
							<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
						</a>
                            <span class="phat-page-link-left"><?php previous_image_link( false, __( '&laquo; Previous Image' , 'phat' ) ); ?></span>
                            <span class="phat-page-link-right"><?php next_image_link( false, __( 'Next Image &raquo;' , 'phat' ) ); ?></span>
                        <div style="clear: both"></div>
                        <?php the_content(); ?>
					</div> <!-- .entry-content -->
					<?php wp_link_pages( 
						array( 
							'before' => '<div class="phat-page-links"><span>'.__( 'Pages: ', 'phat' ).'</span>',
							'after'  => '</div>'
						) 
					); ?>
					<div class='entry-footer'>
						<?php if (has_tag()) :
							the_tags( '', ', ', '' ); edit_post_link( __( 'Edit', 'phat' ), '<span>|</span> <span>', '</span>' );
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
			<?php previous_post_link( '%link', '&laquo; ' . __( 'Previous entry', 'phat' ) );
			next_post_link( '%link', __( 'Next entry', 'phat' ) . ' &raquo;' ); ?>
		</div> <!-- .pagination -->
		<?php endif; ?>
	</div> <!-- .posts -->
</div> <!-- dinamic post class -->
</div>  <!-- .content -->
<?php get_footer() ?>
