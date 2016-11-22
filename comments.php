<?php
/**
 * Comments template.
 *
 * Displays the comments list (if available) & the comment form on a single
 * post/page.
 *
 * @package Forme
 * @since 1.0.0
 */
if( post_password_required() ) {
	return;
}
?>

<div id="comments" class="entry-comments">
	<?php if( have_comments() ): ?>
		<h2 id="comments-title">
			<?php comments_number( '', __( 'Comments', 'forme' ), __( '% Comments', 'forme' ) ); ?>
		</h2>
		
		<?php the_comments_navigation(); ?>
		
		<ol id="comments-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 60,
					'style' 	  => 'ol',
					'type' 	  	  => 'comment',
				) );
			?>
		</ol>
		
		<?php the_comments_navigation(); ?>
			
	<?php endif; ?>
	
	<?php 
		if( ! comments_open() && 
			get_comments_number() && 
			post_type_supports( get_post_type(), 'comments' ) ): ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'forme' ); ?></p>
	<?php endif; ?>
	
	<?php comment_form(); ?>
</div>