<?php
/**
 * Post archive template. 
 *
 * Displays post index for author, category, date & tag archives.
 *
 * @package Forme
 * @since 1.0.0
 */
get_header(); ?>
	
	<div id="content" class="site-content">
		<div class="page-header">
			<div class="container">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
		</div>
		
		<div class="page-content">
			<div class="container">
				<div class="row">
					<main id="main" class="content-area col-xs-12 col-md-8" role="main">
						<?php
							if( have_posts() ) {
								while( have_posts() ) {
									the_post();
									get_template_part( 'template-parts/content' );
								}
							}
							else {
								get_template_part( 'template-parts/content', 'none' );
							}
						?>
					</main>
					
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
		
		<?php if( 1 < $wp_query->max_num_pages ): ?>
			<div class="page-footer">
				<div class="container">
					<?php
						the_posts_pagination( array(
							'prev_text' 		 => __( '&larr;<span class="screen-reader-text">Previous page</span>', 'forme' ),
							'next_text' 		 => __( '<span class="screen-reader-text">Next page</span>&rarr;', 'forme' ),
							'before_page_number' => __( '<span class="screen-reader-text">Page</span>', 'forme' ),
						) );
					?>
				</div>
			</div>
		<?php endif; ?>
	</div>
	
<?php get_footer(); ?>