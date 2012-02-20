<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title></title>
	</head>
	<body>
		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<li style="list-style: none">
					<h3 class="widget-title">
						Projects
					</h3><?php
											/* When we call the dynamic_sidebar() function, it'll spit out
											 * the widgets for that widget area. If it instead returns false,
											 * then the sidebar simply doesn't exist, so we'll hard-code in
											 * some default sidebar stuff just in case.
											 */
											if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?><?php
													
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
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li><?php endforeach; ?>      
			</ul><?php endif; // end primary widget area ?>
		</div><!-- #primary .widget-area -->
		<?php
					// A second sidebar for widgets, just because.
					if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<li>this is the secondary widget
				</li><?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->
		<?php endif; ?>
	</body>
</html>
