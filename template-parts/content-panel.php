<section class="panel" style="background-image:url('<?php forme_featured_image_url( get_the_ID() ); ?>');">
	<div class="container">
		<div class="panel-entry">
			<div <?php post_class(); ?>>
				<?php 
					if( get_queried_object_id() == $post->ID || is_home() ) {
						the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
					}
					else {
						the_title( '<header class="entry-header"><h2 class="entry-title">', '</h2></header>' );
					}
				?>
				
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</section>