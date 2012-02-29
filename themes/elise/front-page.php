<?php
/**
 * 
 *
 * A custom page template without sidebar.
 *
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */

get_header(); ?>

		<div id="container" class="single-attachment">
			<div id="content" role="main">
				<?php if( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						the_content();
					}
				} else {
					/* No posts found */
				} ?>
			   
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
