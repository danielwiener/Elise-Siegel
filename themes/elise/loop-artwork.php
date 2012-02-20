<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Elise Siegel
 * @since Elise Siegel 1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
					<?php
	$pagelist = get_pages('sort_column=menu_order&sort_order=asc&child_of=69');
	$pages = array();
	foreach ($pagelist as $page) {
	   $pages[] += $page->ID;
	}

	$current = array_search($post->ID, $pages);
	$prevID = $pages[$current-1];
	$nextID = $pages[$current+1];
	?>

	<div class="navigation">
	<?php if (!empty($prevID)) { ?>
	<div class="alignleft">
	<a href="<?php echo get_permalink($prevID); ?>"
	  title="<?php echo get_the_title($prevID); ?>">Previous</a>
	</div>
	<?php }
	if (!empty($nextID)) { ?>
	<div class="alignright">
	<a href="<?php echo get_permalink($nextID); ?>" 
	 title="<?php echo get_the_title($nextID); ?>">Next</a>
	</div>
	<?php } ?>
	</div><!-- .navigation -->
				</div><!-- #post-## -->
                  				
<?php endwhile; // end of the loop. ?>