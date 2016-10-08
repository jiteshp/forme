<?php
/**
 * Header template.
 *
 * Displays a page's head section & the site header with branding & navigation.
 *
 * @package Forme
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'forme' ); ?></a>
	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="site-branding col-xs-12 col-md-4">
					<?php 
						forme_custom_logo();
						
						if( is_front_page() && is_home() && ! forme_has_featured_content() ): ?>
							<h1 class="site-title h2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else: ?>
							<p class="site-title h2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;
						
						$description = get_bloginfo( 'description', 'display' );
						if( $description || is_customize_preview() ): ?>
							<p class="site-description"><?php echo $description; ?></p>
						<?php endif;
					?>
				</div>
				
				<?php if( has_nav_menu( 'primary-menu' ) ): ?>
					<nav class="site-navigation col-xs-12 col-md-8" role="navigation">
						<button id="primary-menu-toggle"><span class="screen-reader-text"><?php _e( 'Menu', 'forme' ); ?></span></button>
						
						<?php 
							wp_nav_menu( array(
								'container'		 => false,
								'depth' 		 => 1,
								'menu_id' 		 => 'primary-menu',
								'theme_location' => 'primary-menu',
							) );
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</header>