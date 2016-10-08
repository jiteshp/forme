<?php
/**
 * Theme action hooks, filter hooks & functions.
 *
 * @package Forme
 * @since 1.0.0
 */
 
/**
 * Set the content width based on the theme's design.
 *
 * @since 1.0.0
 */
function forme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'forme_content_width', 720 );
}

add_action( 'after_setup_theme', 'forme_content_width' );
 
/**
 * Add support for various theme features.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'forme_setup' ) ) {
	function forme_setup() {
		load_theme_textdomain( 'forme', get_template_directory() . '/languages' );
		
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
			'height' 	  => 120,
			'width' 	  => 270,
		) );

		add_theme_support( 'html5', array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		) );
		
		add_theme_support( 'jetpack-responsive-videos' );
		
		add_theme_support( 'jetpack-testimonial' );
		
		add_theme_support( 'featured-content', array(
			'filter'     => 'forme_get_featured_content',
			'max_posts'  => 1,
			'post_types' => array( 'page' ),
		) );
		
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
		
		add_post_type_support( 'page', 'excerpt' );
		
		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'forme' ) );
	}
}

add_action( 'after_setup_theme', 'forme_setup' );
 
/**
 * Register theme widget areas.
 *
 * @since 1.0.0
 */
function forme_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'forme' ),
		'id'			=> 'sidebar',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
	
	register_sidebar( array(
		'name'			=> __( 'Landing Pages', 'forme' ),
		'id'			=> 'sidebar-landing',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h4 class="widget-title">',
		'after_title'	=> '</h4>',
	) );
}

add_action( 'widgets_init', 'forme_widgets_init' );
 
/**
 * Enqueue theme scripts & styles.
 *
 * @since 1.0.0
 */
function forme_scripts() {
	wp_enqueue_style( 'forme-style', get_stylesheet_uri(), array( 'dashicons' ) );
	
	$text_font_url = get_theme_mod( 'forme_text_font_url', 
		'https://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700' );
	wp_enqueue_style( 'forme-text-font', $text_font_url );

	$heading_font_url = get_theme_mod( 'forme_heading_font_url', 
		'https://fonts.googleapis.com/css?family=Hind:400,700' );
		
	if( $text_font_url != $heading_font_url ) {
		wp_enqueue_style( 'forme-heading-font', $heading_font_url );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', 
		array( 'jquery' ), null, true );
}

add_action( 'wp_enqueue_scripts', 'forme_scripts' );

/**
 * Register customizer options.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wpc
 */
function forme_customize_register( $wpc ) {
	$colors = array( 
		'forme_accent_color' => array(
			'active_callback'	=> '',
			'default'   		=> '#27AE60',
			'label'   			=> __( 'Accent Color', 'forme' ),
			'sanitize_callback' => 'sanitize_hex_color',
		),
		'forme_alt_accent_color' => array(
			'active_callback'	=> '',
			'default'   		=> '#1B7741',
			'label'   			=> __( 'Alternate Accent Color', 'forme' ),
			'sanitize_callback' => 'sanitize_hex_color',
		),
		'forme_panel_text_color' => array(
			'active_callback'	=> 'form_is_panel_page',
			'default'   		=> '#FFFFFF',
			'label'   			=> __( 'Panel Text Color', 'forme' ),
			'sanitize_callback' => 'sanitize_hex_color',
		),
	);
	
	foreach( $colors as $setting => $args ) {
		$wpc->add_setting( $setting, array(
			'default' => $args['default'],
		) );
		$wpc->add_control( new WP_Customize_Color_Control( $wpc, $setting, array(
			'active_callback' => $args['active_callback'],
			'label'   		  => $args['label'],
			'section' 		  => 'colors',
		) ) );
	}
	
	$wpc->add_section( 'forme_fonts', array(
		'priority'	=> 60,
		'title'		=> __( 'Fonts', 'forme' ),
	) );
	
	$wpc->add_setting( 'forme_heading_font_url', array(
		'default' 	=> 'https://fonts.googleapis.com/css?family=Hind:400,700',
	) );
	$wpc->add_control( new WP_Customize_Control( $wpc, 'forme_heading_font_url', array(
		'label'		=> __( 'Heading Font', 'forme' ),
		'section'	=> 'forme_fonts',
		'type'		=> 'select',
		'choices'	=> forme_get_fonts(),
	) ) );
	
	$wpc->add_setting( 'forme_text_font_url', array(
		'default' 	=> 'https://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700',
	) );
	$wpc->add_control( new WP_Customize_Control( $wpc, 'forme_text_font_url', array(
		'label'		=> __( 'Text Font', 'forme' ),
		'section'	=> 'forme_fonts',
		'type'		=> 'select',
		'choices'	=> forme_get_fonts(),
	) ) );
}

add_action( 'customize_register', 'forme_customize_register' );

/**
 * Output customizer.
 *
 * @since 1.0.0
 */
function forme_custom_styles() {
	$accent_color = get_theme_mod( 'forme_accent_color', '#27AE60' );
	$alt_accent_color = get_theme_mod( 'forme_alt_accent_color', '#1B7741' );
	$panel_text_color = get_theme_mod( 'forme_panel_text_color', '#FFFFFF' );
	$heading_font_url = get_theme_mod( 'forme_heading_font_url', 
		'https://fonts.googleapis.com/css?family=Hind:400,700' );
	$text_font_url = get_theme_mod( 'forme_text_font_url', 
		'https://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700' );
	$fonts = forme_get_fonts();
	
	ob_start(); ?>
<style type="text/css">
	body, input, select, textarea {
		font-family: '<?php echo $fonts[ $text_font_url ] ?>', serif;
	}
	
	<?php if( $heading_font_url != $text_font_url ): ?>
		#primary-menu,
		.entry-meta,
		.h1, h1, .h2, h2, .h3, h3, .h4, h4, .h5, h5, .h6, h6, 
		input[type=submit], button[type=submit], .more-link, .button, .button-min,
		.display-posts-listing-grid-2 .listing-item .title,
		.display-posts-listing-grid-3 .listing-item .title,
		.display-posts-listing-grid-4 .listing-item .title {
			font-family: '<?php echo $fonts[ $heading_font_url ] ?>', '<?php echo $fonts[ $text_font_url ] ?>', serif;
		}
	<?php endif; ?>
	
	blockquote {
		border-left-color: <?php echo $accent_color ?>;
	}
	
	a {
		border-bottom-color: <?php echo $accent_color ?>;
		color: <?php echo $accent_color ?>;
	}
	
	.colored,
	.display-posts-listing-grid-2 .listing-item .image:after,
	.display-posts-listing-grid-3 .listing-item .image:after,
	.display-posts-listing-grid-4 .listing-item .image:after,
	.image-link:after {
		color: <?php echo $accent_color ?>;
	}
	
	a:hover {
		border-bottom-color: <?php echo $alt_accent_color ?>;
		color: <?php echo $alt_accent_color ?>;
	}
	
	input[type=submit], 
	button[type=submit], 
	.button {
		background-color: <?php echo $accent_color ?>;
		border-color: <?php echo $accent_color ?>;
	}
	
	input[type=submit]:hover, 
	button[type=submit]:hover, 
	.button:hover {
		background-color: <?php echo $alt_accent_color ?>;
		border-color: <?php echo $alt_accent_color ?>;
	}
	
	.button-min, 
	.more-link {
		border-color: <?php echo $accent_color ?>;
		color: <?php echo $accent_color ?> !important;
	}
	
	
	.button-min:hover, 
	.more-link:hover {
		border-color: <?php echo $alt_accent_color ?>;
		color: <?php echo $alt_accent_color ?> !important;
	}
	
	.page-header, .widget_mailerlite_widget:before {
		background-color: <?php echo $accent_color ?>;
	}
	
	.panel-entry .hentry.has-post-thumbnail a, 
	.panel-entry .hentry.has-post-thumbnail, 
	.panel-entry .hentry.has-post-thumbnail .h1, 
	.panel-entry .hentry.has-post-thumbnail h1, 
	.panel-entry .hentry.has-post-thumbnail .h2, 
	.panel-entry .hentry.has-post-thumbnail h2, 
	.panel-entry .hentry.has-post-thumbnail .h3, 
	.panel-entry .hentry.has-post-thumbnail h3, 
	.panel-entry .hentry.has-post-thumbnail .h4, 
	.panel-entry .hentry.has-post-thumbnail h4, 
	.panel-entry .hentry.has-post-thumbnail .h5, 
	.panel-entry .hentry.has-post-thumbnail h5, 
	.panel-entry .hentry.has-post-thumbnail .h6, 
	.panel-entry .hentry.has-post-thumbnail h6 {
		color: <?php echo $panel_text_color ?>;
	}

	.panel-entry .hentry.has-post-thumbnail h2:after {
		border-color: <?php echo $panel_text_color ?>;
	}
</style> <?php
	echo ob_get_clean() . "\n\n";
}

add_action( 'wp_head', 'forme_custom_styles' );
 
/**
 * Customize excerpt length.
 *
 * @since 1.0.0
 * @param int $length Default maximum excerpt length in words
 * @return int
 */
function forme_excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'forme_excerpt_length' );
 
/**
 * Customize excerpt more tag.
 *
 * @since 1.0.0
 * @param string $more Default excerpt more tag
 * @return string
 */
function forme_excerpt_more( $more ) {
	global $post;
	
	return sprintf( '&hellip;<p><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( $post->ID ) ), __( 'Read More', 'forme' ) );
}

add_filter( 'excerpt_more', 'forme_excerpt_more' );
 
/**
 * Customize body classes.
 *
 * @since 1.0.0
 * @param array $class Default body classes
 * @return array
 */
function forme_body_class( $classes ) {
	if( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'forme-no-sidebar';
	}
	
	return $classes;
}

add_filter( 'body_class', 'forme_body_class' );

/**
 * Displays the custom logo.
 *
 * @since 1.0.0
 */
function forme_custom_logo() {
	if( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * Output the featured image url.
 *
 * @since 1.0.0
 * @param int $post_id The post ID for which to output the featured image url
 * @param string $size The size of the featured image url to output
 * @return boolean
 */
function forme_featured_image_url( $post_id = 0, $size = 'full' ) {
	if( ! $post_id ) {
		global $post;
		$post_id = $post->ID;
	}
	
	if( has_post_thumbnail( $post_id ) ) {
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$featured_image = wp_get_attachment_image_src( $thumbnail_id, $size );
		echo esc_url( $featured_image[0] );
	}
}

/**
 * Returns the featured content in an array.
 *
 * @since 1.0.0
 * @return array
 */
function forme_get_featured_content() {
	return apply_filters( 'forme_get_featured_content', array() );
}

/**
 * Checks if we have the minimum number of featured posts.
 *
 * @since 1.0.0
 * @param int $minimum Minimum number of featured posts
 * @return boolean
 */
function forme_has_featured_content( $minimum = 1 ) {
	if ( is_paged() ) {
        return false;
	}
 
    $minimum = absint( $minimum );
    $featured_posts = apply_filters( 'forme_get_featured_content', array() );
 
    if ( ! is_array( $featured_posts ) ) {
        return false;
	}
 
    if ( $minimum > count( $featured_posts ) ) {
        return false;
	}
 
    return true;
}

/**
 * Checks if this is a panel page.
 *
 * @since 1.0.0
 * @return boolean
 */
function form_is_panel_page() {
	if( is_page() && is_page_template( 'templates/panels.php' ) ) {
		return true;
	}
	
	return false;
}

/**
 * Returns a font array.
 *
 * @since 1.0.0
 * @return array
 */
function forme_get_fonts() {
	return array(
		'https://fonts.googleapis.com/css?family=Alegreya:400,400i,700'			  =>
			__( 'Alegreya', 'forme' ),
		'https://fonts.googleapis.com/css?family=Alegreya+Sans:400,400i,700'	  =>
			__( 'Alegreya Sans', 'forme' ),
		'https://fonts.googleapis.com/css?family=Archivo+Narrow:400,400i,700'	  =>
			__( 'Archivo Narrow', 'forme' ),
		'https://fonts.googleapis.com/css?family=Asap:400,400i,700'				  =>
			__( 'Asap', 'forme' ),
		'https://fonts.googleapis.com/css?family=Cambay:400,400i,700'			  =>
			__( 'Cambay', 'forme' ),
		'https://fonts.googleapis.com/css?family=Cardo:400,400i,700'			  =>
			__( 'Cardo', 'forme' ),
		'https://fonts.googleapis.com/css?family=Catamaran:400,400i,700'		  =>
			__( 'Catamaran', 'forme' ),
		'https://fonts.googleapis.com/css?family=Ek+Mukta:400,400i,700'			  =>
			__( 'Ek Mukta', 'forme' ),
		'https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,700'		  =>
			__( 'Fira Sans', 'forme' ),
		'https://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700' =>
			__( 'Gentium Book Basic', 'forme' ),
		'https://fonts.googleapis.com/css?family=Hind:400,700'					  =>
			__( 'Hind', 'forme' ),
		'https://fonts.googleapis.com/css?family=Lato:400,400i,700'				  =>
			__( 'Lato', 'forme' ),
		'https://fonts.googleapis.com/css?family=Montserrat:400,400i,700'		  =>
			__( 'Montserrat', 'forme' ),
		'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700'			  =>
			__( 'PT Sans', 'forme' ),
		'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700'			  =>
			__( 'PT Serif', 'forme' ),
		'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700'	  =>
			__( 'Source Sans Pro', 'forme' ),
		'https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,700'		  =>
			__( 'Source Serif Pro', 'forme' ),
	);
}