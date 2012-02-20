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
							  <li><?php echo $dw_optional_text; ?></li>
						<?php endif ?> 
						
			 
			</ul>
			
		</div><!-- #primary .widget-area -->