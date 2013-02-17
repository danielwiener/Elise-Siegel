<?php
/*
Template Name: Artwork Image Grid
*/
/**
 * The template for displaying the Thumbnails of the 10 most recent Project Pages in a Grid.
 *
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0  
 */

get_header(); ?>

		<div id="container" class="single-attachment">
			<div id="content" role="main">
				<div id="image_grid">
					<ul>		
<?php  
	$pageslug = $post->post_name;
	$recent_args = array(
		'posts_per_page' => -1,
		'post_type' => 'page',
		'post_status' => 'publish',
	//	'ignore_sticky_posts' => 1,
		'post_parent' => 69,
		'orderby' => 'menu_order',
		'order' => 'ASC'
		);
		$artworks_query = New WP_Query($recent_args);
	//query_posts($recent_args);
			if ( $artworks_query->have_posts() ) while ( $artworks_query->have_posts() ) : $artworks_query->the_post(); ?>
			      
				<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('tn-200'); ?></a><br><?php // echo $post->menu_order; ?></li>
			      
			<?php endwhile; ?>
					</ul>
				</div> <!-- #image_grid -->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
