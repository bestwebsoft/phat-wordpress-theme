<?php /**
 * The Header for Phat theme.
 * Displays all of the <head> section and everything up till <div class="content">
 * @subpackage Phat
 * @since Phat 1.0
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
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id='wrapper'>
		<header class='masthead' role="banner">
				<div class='logo'>
					<div class='sitename'>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" style="color:#<?php header_textcolor(); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					</div> <!-- .sitename -->
					<div class='sitedescription'>
						<p ><?php bloginfo( 'description' ); ?></p>
					</div> <!-- .sitedescription -->
				</div> <!-- .logo -->
				<div class='breadcrumbs-container'>
					<div class='breadcrumbs'>
						<?php echo apply_filters( 'phat_breadcrumbs', 'phat_breadcrumbs' ); ?>
					</div> <!-- .breadcrumbs -->
				</div> <!-- .breadcrumbs-container -->
		</header> <!-- .header -->
		<div class='content'>
