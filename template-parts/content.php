<article id="entry-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ): ?>
		<p class="entry-image">
			<a href="<?php the_permalink(); ?>" class="image-link"><?php the_post_thumbnail(); ?></a>
		</p>
	<?php endif; ?>
	
	<header class="entry-header">
		<?php if(is_sticky()): ?>
			<div class="entry-meta">
				<span class="entry-sticky"><?php _e( 'Featured', 'forme' ); ?></span>
			</div>
		<?php endif; ?>
		
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header>
	
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>