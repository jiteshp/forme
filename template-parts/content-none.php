<div class="hentry no-results">
	<header class="entry-header">
		<h2 class="entry-title"><?php _e( 'Nothing found', 'forme' ); ?></h2>
	</header>
	
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'forme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'forme' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'forme' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</div>