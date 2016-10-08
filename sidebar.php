<?php 
/**
 * Sidebar template.
 *
 * Displays the widgets in the sidebar if available.
 *
 * @package Forme
 * @since 1.0.0
 */
if( is_active_sidebar( 'sidebar' ) ): ?>
	<aside id="sidebar" class="widget-area col-xs-12 col-md-4" role="complementary">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
<?php endif; ?>