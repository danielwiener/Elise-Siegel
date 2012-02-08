<?php
/**
 * The Sidebar containing the primary and secondary for the About Pages.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */
?>

		<div id="primary" class="widget-area" role="complementary">
			

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
?>
	
	   <?php
	   if ($post->post_parent == 69):
				$this_id = $post->ID;
				$parent_title = $post->post_title;
				$this_content  = $post->post_content;
				$this_content = wpautop($this_content);
				$this_content = wptexturize( $this_content);
				?>
				<h3 class="widget-title"><?php echo $parent_title; ?></h3> 
			<?php else:
				$this_id = $post->post_parent;
				$parent_title = get_the_title($post->post_parent);
				$child_title = $post->post_title;
				$parent_post = get_post($this_id);
				$this_content  = $parent_post->post_content;
				
				$this_content = wpautop($this_content);
				$this_content = wptexturize( $this_content);
				$parent_url = get_page_uri($this_id);     
 				?>
	            <h3 class="widget-title"><a href="<?php echo $parent_url; ?>"><?php echo $parent_title; ?></a></h3>
                 <h4>(<?php echo $child_title; ?>)</h4>
		        <?php 
	   
		
		endif; ?>
	<?php echo $this_content; ?>
	  <ul>
	<?php
	if ($post->post_parent == 69): 
	$args = array(
				'post_type' => 'page', 
				'post_status' => 'publish',
				'post_parent' => $this_id,  
				);
			global $post;
			$program_pages = get_posts($args);
			foreach($program_pages as $post) :
			   setup_postdata($post); 
			 ?>
			    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> >></a></li>
			 <?php endforeach; ?>
				</ul> 
				<?php
			      $builder = get_post_meta($this_id, Builder, true); ?>
					<?php if ($builder): ?>
						 <p><small><strong>Builder:</strong><br /><?php echo $builder; ?></small></p>
					<?php endif; ?>
					<?php 
					$photographer = get_post_meta($this_id, Photographer, true); ?>
						<?php if ($photographer): ?>
							 <p><small><strong>Photographer:</strong><br /><?php echo $photographer; ?></small></p>
						<?php endif; ?>
	          <?php else: ?>
		<p><a href="<?php echo $parent_url; ?>"><< Return to completed project.</a>
			   <?php endif; ?>
			 

		      
	   </div><!-- #primary .widget-area -->
     
<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>
