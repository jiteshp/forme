<?php
/**
 * Page not found (404) error template. 
 *
 * Displayed when a singular post/page is not found.
 *
 * @package Forme
 * @since 1.0.0
 */
get_header(); ?>
	
	<div id="content" class="site-content">
		<div class="page-content">
			<div class="container">
				<div class="row">
					<main id="main" class="content-area col-xs-12 col-md-8" role="main">
						<div class="hentry">
							<header class="entry-header">
								<h1 class="entry-title"><?php _e( 'Page not found', 'forme' ); ?></h1>
							</header>
							
							<div class="entry-content">
								<p><?php _e( 'The page you&rsquo;re looking for couldn&rsquo;t be found. It may have been removed or moved elsewhere. Perhaps try a search.' ); ?></p>
							
								<?php get_search_form(); ?>
							</div>
						</div>
					</main>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>