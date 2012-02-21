<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */ 
	$dw_year =  get_post_meta($post->ID, "_dw_year", $single = true);
	$dw_dimensions =  get_post_meta($post->ID, "_dw_dimensions", $single = true);
	$dw_materials =  get_post_meta($post->ID, "_dw_materials", $single = true);
	$dw_optional_text =  get_post_meta($post->ID, "_dw_optional_text", $single = true); 
	
?>
		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<li>
					<h3 class="widget-title">
						<?php the_title(); ?>
					</h3> </li>
						 <li><?php echo $dw_year ?></li>
					     <li><?php echo $dw_materials; ?></li>
						 <li><?php echo $dw_dimensions; ?></li>
						<?php if ( $dw_optional_text ): ?>
							  <li><?php echo wpautop($dw_optional_text); ?></li>
						<?php endif ?>  
			</ul>
			<ul>
				<li>
					<?php   //this is going to get very complicated if we add more kinds of parent pages.
					$this_id = '';
					$parent_title = '';
					if ($post->post_parent == 69 ) { //a child of Sculpture but a parent page with children and thus related images
						$this_id = $post->ID; 
					}  else {
						$this_id = $post->post_parent;     // grand children pages of Sculpture but a parent page and with related images
						$parent_title = get_the_title($post->post_parent);
					}
					 
					
				    if ( $post->post_parent == 69 && !has_children($post->ID) ) {  //children of Sculpture but has no related images
				    	# do nothing
				    }   else {
						echo '<li><a href="' .  get_permalink( $this_id ) . '" title="' . $parent_title . '"><li>';
						echo get_the_post_thumbnail($this_id, 'small_proportional') . '</li></a>';
					
				    $tn_args = array(
				    	'posts_per_page'=>-1,
						'post_type' => 'page', 
						'post_status' => 'publish',
						'post_parent' => $this_id,
						'orderby' => 'menu_order',
						'order' => 'ASC'
				    );
					$tn_query = New WP_Query($tn_args);
				     	while ( $tn_query->have_posts() ) : $tn_query->the_post(); ?>
					 <li><a href="<?php the_permalink(); ?>" title="<?php the_title();  ?>"><?php the_post_thumbnail('small_proportional') ?></a></li>
					<?php endwhile;

					// Reset Post Data
					wp_reset_postdata();
				     }
					?>
				</li>
			</ul>
			
		</div><!-- #primary .widget-area -->