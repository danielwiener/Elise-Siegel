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
		'posts_per_page' => 15,
		'post_type' => 'page',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'post_parent' => 69,
		'arderby' => 'menu_order',
		'order' => 'ASC'
		);
	query_posts($recent_args);
			if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			      
				<li><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('tn-150'); ?></a></li>
			      
			<?php endwhile; ?>
					</ul>
				</div> <!-- #image_grid -->
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
