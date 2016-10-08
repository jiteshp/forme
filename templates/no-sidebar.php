<?php 
/**
 * Template name: No Sidebar Template
 *
 * Displays a page without the sidebar.
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
						<main id="main" class="content-area col-xs-12" role="main">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</main>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	
<?php get_footer(); ?>