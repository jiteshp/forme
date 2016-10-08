<?php 
/**
 * Template name: Panels Template
 *
 * Displays a panel page, ideal for home & product pages. No comments are 
 * displayed on this page.
 *
 * @package Forme
 * @since 1.0.0
 */
get_header(); ?>
	
	<div id="content" class="site-content">
		<main id="main" class="content-area" role="main">
			<?php
				while( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'panel' );
					
					$children = new WP_Query( array(
						'no_found_rows'  => true,
						'order'  		 => 'ASC',
						'orderby'  		 => 'menu_order',
						'post_parent' 	 => $post->ID,
						'post_type'		 => 'page',
						'posts_per_page' => -1,
					) );
					
					if( $children->have_posts() ) {
						while( $children->have_posts() ) {
							$children->the_post();
							get_template_part( 'template-parts/content', 'panel' );
						}
						
						wp_reset_postdata();
					}
				}
			?>
		</main>
	</div>
	
<?php get_footer(); ?>