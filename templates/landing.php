<?php 
/**
 * Template name: Landing Template
 *
 * Displays a landing page & it's sidebar. Comments are not shown on this page.
 *
 * @package Forme
 * @since 1.0.0
 */
get_header(); ?>
	
	<div id="content" class="site-content">
		<?php while( have_posts() ): the_post(); ?>
			<div class="page-content">
				<div class="container">
					<div class="row">
						<main id="main" class="content-area col-xs-12 col-md-7" role="main">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</main>
						
						<?php get_sidebar( 'landing' ); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	
<?php get_footer(); ?>