<?php
/**
 * Footer template.
 *
 * Displays the site copyright, generator & designer credits.
 *
 * @package Forme
 * @since 1.0.0
 */
?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<span class="copyright">
				<?php
					echo apply_filters( 'forme_copyright', sprintf(
						__( 'Copyright &copy; <a href="%1$s" rel="home">%2$s</a>', 'forme' ),
						esc_url( home_url( '/' ) ), get_bloginfo( 'name' )
					) );
				?>
			</span>
			
			<span class="generator">
				<?php _e( 'Powered by ', 'forme' ); ?>
				<a href="https://wordpress.org/" rel="generator"><?php _e( 'WordPress', 'forme' ); ?></a>
			</span>
			
			<span class="designer">
				<?php _e( 'Theme by ', 'forme' ); ?>
				<a href="http://fastbizmarketing.com/" rel="designer"><?php _e( 'FastBiz Marketing', 'forme' ); ?></a>
			</span>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
</body>
</html>