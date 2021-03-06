<?php
/**
 * The template for displaying single artworks with related thumbnails on the right.
 *
 * Template Name: Artwork Page
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'artwork' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar('artwork'); ?>
<?php get_footer(); ?>
