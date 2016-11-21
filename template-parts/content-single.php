<article id="entry-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<span class="entry-category">
				<?php the_category( ', ' ); ?>
			</span>
			
			<span class="entry-author">
				<?php _e( 'By ', 'forme' ); the_author_link(); ?>
			</span>
		</div>
	</header>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
	<?php the_tags( '<footer class="entry-footer entry-meta entry-tags">' . __( 'Tags: ', 'forme' ), ', ', '</footer>' ); ?>
</article>