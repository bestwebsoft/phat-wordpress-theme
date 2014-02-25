
<?php
/**
 * The loop that displays posts.
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 * @subpackage Phat
 * @since Phat 1.0
 *
 * If there are no posts to display, such as an empty archive page */
if ( ! have_posts() ) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id='container404'>
			<div id='head404'>
				<?php _e( '404: Page not found', 'phat' ); ?>
			</div>
			<div id='content404'>
				<p><?php _e( 'Sorry, there is no post yet.', 'phat' ); ?></p>
				<p><?php _e( 'Maybe try a search?', 'phat' ); ?></p>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
<?php endif; ?>

<?php $forfirst = 0;
if (have_posts()) : 
	while (have_posts()) : the_post();?>
		<div class='entry'>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class='entry-header'>
					<h1>
						<a href="<?php the_permalink(); ?>"><?php the_title()?></a>
					</h1>
				</div> <!-- .entry-header -->
				<div class='entry-meta'>
					<?php printf( __('Posted on ', 'phat') ); ?> <a href='<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ); ?>'>
                    <?php the_time( 'j' ); printf( __( ' of ', 'phat' ) ); the_time('F, Y'); ?></a>
					<?php printf( __( 'by ', 'phat' ) ); ?><a href='<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>'><?php the_author_meta( 'display_name' ); ?></a> <?php printf( __( 'in ', 'phat' ) );
                    the_category(', '); ?> 
				</div><!-- .entry-meta -->
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div> <!-- .entry-thumbnail -->
				<?php endif; //checks either it has feutered image set up ?>
				<div class='entry-content'>
					<?php if ( is_archive() || is_search() ) : // Displays excerpts for archives and search. ?>
						<?php the_excerpt(); ?>
					<?php else : ?>
						<?php the_content() ?>
					<?php endif; ?>
						<?php wp_link_pages(
							array(
								'before' => '<div class="phat-page-links"><span>'.__( 'Pages: ', 'phat' ).'</span>',
								'after'  => '</div>'
							) 
						);//makes paginated posts display pages
						if( $forfirst != 0 ) : ?>
							<a class='entry-meta' href="#">[<?php _e( 'Top', 'phat' ); ?>]</a>
						<?php endif;//cheks count of post on the page to display top link ?>
				</div><!-- .entry-content -->			
				<div class='entry-footer'>
					<?php if (has_tag()) : 
						the_tags( '', ', ', '' ); 
						edit_post_link( __( 'Edit', 'phat' ), '<span>|</span> <span>', '</span>' );
					else : 
						edit_post_link( __( 'Edit', 'phat' ));
					endif ?>
				</div>
			</div> <!-- dinamic div-class-->
		</div> <!-- . entry -->
		<div class='post-divider'>
		</div> <!-- .post-divider -->
		<?php $forfirst++; //adds 1 for counter count
	endwhile; ?>
	<div class='pagination'>
		<div class='left-pagination-link'><?php previous_posts_link(  '&laquo; ' . __( 'Previous entrys', 'phat' ) ); ?> </div>
		<div class='right-pagination-link'><?php next_posts_link(  __( 'Next entrys', 'phat' ) . ' &raquo;' ); ?></div>
	</div> <!-- .pagination -->
<?php endif; //have posts ?>