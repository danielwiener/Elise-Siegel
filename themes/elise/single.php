<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */

get_header(); ?>

		<div id="container" class="regular">
			<div id="content" role="main">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<h1 class="entry-title"><?php the_title(); ?></h1>
									<div class="entry-content">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								</div><!-- #post-## -->

								<div id="nav-below" class="navigation">
									<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title', TRUE ); ?></div>
									<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>', TRUE ); ?></div>
								</div><!-- #nav-below -->
<?php $dw_slug = $wp_query->query_vars['category_name']; ?>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php 		//global $post; // required
		  $dw_category = get_category_by_slug( $dw_slug );
		  $dw_category_link = get_category_link($dw_category->term_id); ?>
		<div id="primary" class="widget-area for_menus" role="complementary">
			<ul class="xoxo">

 			<li id="recent-posts-2" class="widget-container widget_recent_entries">		<h3 class="widget-title"><?php echo $dw_category->name; ?></h3>
				<ul>
					<?php 	/* FAQ Sidebar*/ 
						$args = array(
							'post_type' 		=> 'post',
							'post_status' 		=> 'publish',
							'category_name'		=> $dw_slug,
							'posts_per_page'	=> -1,
							'orderby'			=> 'date',
							"order"				=> 'DESC' 
						);
						$cat_query = New WP_Query($args);
					    while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
		</li>
		</ul>
		</div><!-- #primary .widget-area -->
<?php get_footer(); ?>
