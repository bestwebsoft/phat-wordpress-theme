<?php
/**
 * Phat functions and definitions
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 * The first function, phat_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 * @subpackage Phat
 * @since Phat 1.0
 */
// Makes jquerry work propper and adds comments script
function phat_modify_jquery() {
	if ( !is_admin() ) {
		wp_enqueue_script( 'jquery' );
    }
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

// connects phat plugins & styles for them
function phat_customplugs() {
	if ( ! is_admin() ) {
		wp_register_script( 'phat_scripts', get_template_directory_uri() . '/js/script.js', false );
		wp_enqueue_script( 'phat_scripts' );
		wp_register_style( 'jqPluginStyle', get_stylesheet_directory_uri() . '/css/selectcheckradio.css' );
		wp_enqueue_style( 'jqPluginStyle' );
        wp_register_style('phat_open_sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600&subset=cyrillic,latin');
        wp_enqueue_style( 'phat_open_sans');
        wp_register_style('phat_bevan', 'http://fonts.googleapis.com/css?family=Bevan');
        wp_enqueue_style( 'phat_bevan');
    }
}
// Register Theme Features
function phat_setup()  {
	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );
	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );	
	// Set custom thumbnail dimensions
	set_post_thumbnail_size( 580, 435, true );
	// Add theme support for Translation
	load_theme_textdomain( 'phat', get_template_directory() . '/languages' );	
	// Add theme support for Dinamic Sidebar
	if ( function_exists( 'register_sidebar' ) ){
		register_sidebar( array( 'name' => __( 'Phat_Sidebar', 'phat' ) ) ); 
	}
	// Add theme support Nav_Menu
	register_nav_menu( 'primary',__( 'Sidebar Menu', 'phat' ) );
	// Add theme support for Custom Background
    $background_args = array(
        'default-color'          => '262d32',
        'default-image'          => '',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $background_args );
	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style( '' );
	// Add theme support for Custopm Background
    $headargs = array( 'width' => 940, 'height' => 220, 'default-text-color' => 'fff','uploads' => true, );
    add_theme_support( 'custom-header', $headargs );
	// Set content width value based on the theme's design
	if ( ! isset( $content_width ) ){
		$content_width = 580;
	}
}
// It's to set backgrounds for pagination & post-divider divs if custom background has been set up
function phat_custom_background_cb() {

	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );
	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( ! $background && ! $color ){
        return;
	}
	$style = $color ? "background-color: #$color;" : '';
	if ( $background ) {
		$image = " background-image: url('$background');";
		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) ){
			$repeat = 'repeat';
		}
		$repeat = " background-repeat: $repeat;";
		$position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) ){
			$position = 'left';
		}
		$position = " background-position: top $position;";
		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) ){
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";
		$style .= $image . $repeat . $position . $attachment;
		}
	}
?>
<style type="text/css">
body,
.post-divider,
.pagination,
.search-results-background { <?php echo trim( $style ); ?> }
</style>
<?php
}

// adds excerpt read more link 
function phat_excerpt_read_more_link( $output ) {
	global $post;
	return $output .' <a href="'. get_permalink( $post->ID ) . '">' . __( 'Read more', 'phat' ) . '</a>';
}

// Makes comment form look better
function phat_comment_form ( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	
	else
		$id = $post_id;
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$args = wp_parse_args( $args );
	
	if ( ! isset( $args['format'] ) ) 
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5    = 'html5' === $args['format'];
		$fields   =  array(
			'author' => '<p class="comment-form-author">' . 
			            '<input id="author" name="author" type="text" placeholder="'. __( "Enter your name here*", "phat" ) . '"  value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email">' .
			            '<input id="email" name="email" placeholder="'. __( "Enter your email here*", "phat" ) . '" '.  ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url">' . 
			            '<input id="url" name="url" placeholder="'. __( "Website", "phat" ) . '" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
		$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'phat' ), '<span class="required">*</span>' );
	// Filter the default comment form fields.
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="'. __( "Enter your comment here", "phat" ) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'phat' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'phat' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'phat' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags"></p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply', 'phat' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'phat' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'phat' ),
		'label_submit'         => __( 'Submit', 'phat' ),
		'format'               => 'xhtml',
	);
	// Filter the comment form default arguments.
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
		if ( comments_open( $post_id ) ) :
			// Fires before the comment form.
			do_action( 'comment_form_before' );
			?>
			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
					echo $args['must_log_in'];
					do_action( 'comment_form_must_log_in_after' );
				else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php
						// Fires at the top of the comment form, inside the <form> tag.
						do_action( 'comment_form_top' );
						if ( is_user_logged_in() ) : 
							// Filter the 'logged in' message for the comment form for display.
							echo apply_filters( 'comment_form_logged_in', $args[ 'logged_in_as' ], $commenter, $user_identity );
							// Fires after the is_user_logged_in() check in the comment form.
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
						else : 
							echo $args['comment_notes_before'];
							// Fires before the comment fields in the comment form.
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								// Filter a comment form field for display.
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							// Fires after the comment fields in the comment form.
							do_action( 'comment_form_after_fields' );
						endif;
						// Filter the content of the comment textarea field for display.
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						// Fires at the bottom of the comment form, inside the closing </form> tag.
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			// Fires after the comment form.
			do_action( 'comment_form_after' );
		else :
			// Fires after the comment form if comments are closed.
			do_action( 'comment_form_comments_closed' );
		endif;
}

//Breadcrumbs function
function phat_breadcrumbs() {
  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '-'; // delimiter between crumbs
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  	$text['home']     = __( 'Home', 'phat' ); /* Link text "Home" */
	$text['category'] = __( 'Category:', 'phat' ) . ' %s'; /* Text for a category page */
	$text['search']   = __( 'Results for:', 'phat' ) . ' %s'; /* Text for the search results page */
	$text['tag']      = __( 'Tags:', 'phat' ) . ' %s'; /* Text for the tag page */
	$text['author']   = __( 'Autors posts:', 'phat' ) . ' %s'; /* Text for the autor page */
	$text['404']      = __( 'Error 404', 'phat' ); /* Text for the page 404 */
  global $post;
  $homeLink = home_url();
  if ( is_home() || is_front_page() ) {
    if ( $showOnHome == 1 ) 
    	echo '<div id="crumbs"><a href="' . $homeLink . '">' . sprintf( $text['home']) . '</a></div>';
	} else {
	    echo '<div id="crumbs"><a href="' . $homeLink . '">' . sprintf( $text['home'] ) . '</a> ' . $delimiter . ' ';
	    if ( is_category() ) {
			$thisCat = get_category( get_query_var( 'cat' ), false );
			if ( $thisCat->parent != 0 ) 
				echo get_category_parents( $thisCat->parent, TRUE, ' ' . $delimiter . ' ' );
				echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
	    } elseif ( is_search() ) {
			echo $before . sprintf( $text['search'], get_search_query() ) . $after;	
	    } elseif ( is_day() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'd' ) . $after;
	    } elseif ( is_month() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'F' ) . $after;	  
	    } elseif ( is_year() ) {
	      	echo $before . get_the_time( 'Y' ) . $after;	  
	    } elseif ( is_single() && ! is_attachment() ) {
	      	if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
	        if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	    	} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
				if ( $showCurrent == 0 ) 
					$cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
					echo $cats;
				if ( $showCurrent == 1 ) 
					echo $before . get_the_title() . $after;
	    	}
	    } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;
	    } elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat = get_the_category( $parent->ID ); $cat = $cat[0];
			echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
			echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
			if ( $showCurrent == 1 ) 
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after; 
	    } elseif ( is_page() && ! $post->post_parent ) {
	      	if ( $showCurrent == 1 ) 
	      		echo $before . get_the_title() . $after;
	    } elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
	      while ( $parent_id ) {
	        $page = get_page( $parent_id );
	        $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse( $breadcrumbs );
	      for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
	        	echo $breadcrumbs[ $i ];
	        if ( $i != count( $breadcrumbs )-1 ) 
	        	echo ' ' . $delimiter . ' ';
	      }
	      if ( $showCurrent == 1 ) 
	      	echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;	  
	    } elseif ( is_tag() ) {
	      	echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
	    } elseif ( is_author() ) {
	    	global $author;
	    	$userdata = get_userdata( $author );
	    	echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;
	    } elseif ( is_404() ) {
	    	echo $before . sprintf( $text['404'], '' ) . $after;
	    }
	    echo '</div>'; 
  	}
} // end phat_breadcrumbs()
// Maintains propper layout with bwsGallery
function phat_jsCrunch(){
	print "<script type='text/javascript'>
	(function($) {
		$(document).ready(function(){
		$('input[type=checkbox], input[type=radio]').customRadioCheck();
		});
		jQuery('.sidebar').insertBefore('#container');
		jQuery('footer').insertAfter('#wrapper');
		jQuery('#container').addClass('posts');
	})(jQuery);
</script>";
}
function phat_wp_title( $title, $sep ){
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	}
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'phat' ), max( $paged, $page ) );
	}
	return $title;
}

function phat_ru_titles() {
	if ( get_locale() == 'ru_RU' ) :
		print( 
			'<link href="http://fonts.googleapis.com/css?family=Lora:700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
			<style type="text/css">
			h1, h2, h3, h4, h5, h6,
			.sitename,
			.entry-content dt {
				font-family: Lora, serif !important;
			}
		</style>' );
	endif;
}
// Is to make jquery work good
add_action('init', 'phat_modify_jquery');
// connects my plugins & styles for them
add_action('init', 'phat_customplugs');
// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'phat_setup' );
// It's to set backgrounds for pagination & post-divider divs
add_action ('wp_head', 'phat_custom_background_cb');
// adds excerpt read more link 
add_filter('the_excerpt', 'phat_excerpt_read_more_link');
// Adds filter for breadcrumbs
add_filter( 'phat_breadcrumbs', 'phat_breadcrumbs');
// It's for propper layout with bwsgallery activated
add_action( 'wp_footer', 'phat_jsCrunch');
// It's for page title work propper 
add_filter( 'wp_title', 'phat_wp_title', 10, 2 );
add_action( 'wp_head', 'phat_ru_titles');
?>