<?php 
/**
 * Template name: Feature Image Template
 *
 * Displays a page with feature image & sidebar.
 *
 * @package Forme
 * @since 1.0.0
 */
get_header(); ?>
	
	<div id="content" class="site-content">
		<?php while( have_posts() ): the_post(); ?>
			<div class="feature-image" style="background-image:url('<?php forme_featured_image_url( get_the_ID() ); ?>');"></div>
			
			<div class="page-content">
				<div class="container">
					<div class="row">
						<main id="main" class="content-area col-xs-12 col-md-8" role="main">
							<?php get_template_part( 'template-parts/content', 'page' ); ?>
						</main>
						
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
			
			<?php if( comments_open() || get_comments_number() ): ?>
				<div class="page-footer">
					<div class="container">
						<?php comments_template(); ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
	
<?php get_footer(); ?>