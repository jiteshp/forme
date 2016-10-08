<?php 
/**
 * Landing Page Sidebar template.
 *
 * Displays the widgets in the landing page sidebar if available.
 *
 * @package Forme
 * @since 1.0.0
 */
if( is_active_sidebar( 'sidebar-landing' ) ): ?>
	<aside id="sidebar" class="widget-area col-xs-12 col-md-5" role="complementary">
		<?php dynamic_sidebar( 'sidebar-landing' ); ?>
	</aside>
<?php endif; ?>