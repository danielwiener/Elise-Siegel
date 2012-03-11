<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */

get_header(); ?>

		<div id="container" class="full_width">
			<div id="content" role="main">


				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<!-- <div class="entry-content">  -->
										<div id="contact_box">
											<div id="contact">
										<?php the_content(); ?> 
											</div>
										</div>
									<!-- </div> --><!-- .entry-content -->
								</div><!-- #post-## -->


				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
