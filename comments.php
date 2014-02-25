<?php
/**
 * The template for displaying Comments.
 * @subpackage Phat
 * @since Phat 1.0
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area entry-content">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'phat' ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h3>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav role="navigation">
				<h5><?php _e( 'Comment navigation', 'phat' ); ?></h5>
				<div class='comment-nav'><?php previous_comments_link( __( '&larr; Older Comments', 'phat' ) ); ?></div>
				<div class='comment-nav'><?php next_comments_link( __( 'Newer Comments &rarr;', 'phat' ) ); ?></div>
			</nav><!-- nav -->
		<?php endif; // check for comment navigation ?>
		<ol id="phat-comment-list" class="comment-list">
			<?php wp_list_comments(); ?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav role="navigation">
				<h5><?php _e( 'Comment navigation', 'phat' ); ?></h5>
				<div><?php previous_comments_link( __( '&larr; Older Comments', 'phat' ) ); ?></div>
				<div><?php next_comments_link( __( 'Newer Comments &rarr;', 'phat' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation
	endif; // have_comments()
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.', 'phat' ); ?></p>
	<?php endif;
	phat_comment_form(); ?>
</div><!-- #comments -->