<?php
/**
 * The Sidebar containing the primary widget area.
 * @subpackage Phat
 * @since Phat 1.0
 */
?>
<div class='sidebar'>
	<div class="widget">
		<div class='phat-menu'>
			<nav>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'phat-menu' ) ); ?>
			</nav>
		</div> <!-- .phat-menu' -->
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Phat_Sidebar' ) ):
		endif; ?>
	</div> <!-- .widget -->
</div> <!-- .sidebar -->