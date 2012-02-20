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
				<li style="list-style: none">
					<h3 class="widget-title">
						<?php the_title(); ?>, <?php echo $dw_year ?>
					</h3> </li>
					     <li><?php echo $dw_materials; ?></li>
						 <li><?php echo $dw_dimensions; ?></li>
													     
			</ul> 
			
			<?php
			
			$args = array(
						'numberposts' => -1,
						'post_type' => 'page', 
						'post_status' => 'publish',
						'post_parent' => 69,
						'orderby'     => 'title',
						'order'       => 'ASC'
						);
					global $post;
					$program_pages = get_posts($args);
					foreach($program_pages as $post) :
					   setup_postdata($post); 
					 ?>
</li>
<li>
<a href="<?php the_permalink(); ?>"><?php // the_title(); ?></a>
</li><?php endforeach; ?>
		</div><!-- #primary .widget-area -->
		<?php
					// A second sidebar for widgets, just because.
					if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				</li><?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->
		<?php endif; ?>