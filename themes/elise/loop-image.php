<?php
/**
 * The loop that displays an attachment.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-attachment.php.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		    	<!-- <?php if ( ! empty( $post->post_parent ) ) : ?>
		  					<p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo esc_attr( sprintf( __( 'Return to %s', 'twentyten' ), strip_tags( get_the_title( $post->post_parent ) ) ) ); ?>" rel="gallery"><?php
		  						/* translators: %s - title of parent post */
		  						printf( __( '<span class="meta-nav">&larr;</span> %s', 'twentyten' ), get_the_title( $post->post_parent ) );
		  					?></a></p>
		  				<?php endif; ?>    -->    

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- <h2 class="entry-title"> --><?php // the_title(); ?><!-- </h2> -->



					<div class="entry-content">
						<div class="entry-attachment">
<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	$this_image_id = ''; 
	$tn_navigation = '';
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
						   $this_image_id = $k;  
						   // 						 var_dump($attachment);
						 //echo '<br>---<br>';  
                        $tn_navigation .= '<a href="' . get_permalink($attachment->ID) . '">';
						$tn_navigation .= wp_get_attachment_image( $attachment->ID, 'small_proportional', '' ,array('class' => 'alignleft') );
	                    $tn_navigation .= '</a>';
	}
	$k++;
	$next_image_id = $this_image_id + 1;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $next_image_id ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $next_image_id ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
							$attachment_width  = apply_filters( 'twentyten_attachment_size', 1280 );
							$attachment_height = apply_filters( 'twentyten_attachment_height', 500 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image width, though I have set it up so the width is @750.
						?></a></p>
                         <div><?php echo $tn_navigation; ?></div> 
						<div id="nav-below" class="navigation">
							<div class="nav-previous"><?php previous_image_link( false ); ?></div>
							<div class="nav-next"><?php next_image_link( false ); ?></div>
						</div><!-- #nav-below -->
<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a> 
						
<?php endif; ?>
						</div><!-- .entry-attachment -->
						<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->

					<div class="entry-utility">

					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php comments_template(); ?>

<?php endwhile; // end of the loop. ?>