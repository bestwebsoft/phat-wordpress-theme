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
		<?php if ( is_active_sidebar( 'phat-sidebar' ) ) {
			dynamic_sidebar( 'phat-sidebar' );
		} ?>
	</div> <!-- .widget -->
</div> <!-- .sidebar -->
