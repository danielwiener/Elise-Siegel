<?php
/*
Template Name: Project Pages
*/
/**
 * The template for displaying the Project Pages.
 *
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */

get_header(); ?>
<?php get_sidebar('project');
?>
		<div id="container">
			<div id="content" role="main">
				
			
				
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					
						<div id="projects">
						<?php  nerdy_get_images('pinky', '0', '0'); ?>
						
						<div id="main_image">
						<?php the_post_thumbnail('large'); ?>
						<div id="loader" class="loading"></div>
						</div><?php
						$display_image_title = '';
						$args = array(
							'post_type' => 'attachment',
							'numberposts' => -1,
							'post_status' => null,
							'post_parent' => $post->ID,
							'include' => get_post_thumbnail_id()
							); 
						$attachments = get_posts($args);
						if ($attachments) {
							foreach ($attachments as $attachment) {
								$display_image_title = apply_filters('the_title', $attachment->post_title);
							}
						}
						?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- #projects -->
				   
				</div><!-- #post-## -->

				<?php // comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
