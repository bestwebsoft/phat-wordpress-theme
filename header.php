<?php
/**
 * The Header for Phat theme.
 * Displays all of the <head> section and everything up till <div class="content">
 * @subpackage Phat
 * @since      Phat 1.0
 */ ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id='wrapper'>
	<?php if ( get_header_image() ) { ?>
		<div class="header-image">
			<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		</div>
	<?php } ?>
	<header class='masthead' role="banner">
		<div class='logo'>
			<div class='sitename'>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" style="color:#<?php header_textcolor(); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div> <!-- .sitename -->
			<div class='sitedescription'>
				<p><?php bloginfo( 'description' ); ?></p>
			</div> <!-- .sitedescription -->
		</div> <!-- .logo -->
		<div class='breadcrumbs-container'>
			<div class='breadcrumbs'>
				<?php echo apply_filters( 'phat_breadcrumbs', 'phat_breadcrumbs' ); ?>
			</div> <!-- .breadcrumbs -->
		</div> <!-- .breadcrumbs-container -->
	</header> <!-- .header -->
	<div class='content'>
