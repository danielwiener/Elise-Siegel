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
				<div class="images"> 
                 
		          	 <?php
					     $slidetabs = '';
							$args = array(
								'order'          => 'ASC',
								'orderby' 		 => 'menu_order',
								'post_type'      => 'attachment',
								'post_parent'    => $post->ID,
								'post_mime_type' => 'image',
								'post_status'    => null,
								'numberposts'    => -1,
							);

							$attachments = get_posts($args);
							if ($attachments) :?> 
							<?php foreach ($attachments as $attachment) : ?>  
                                <div>
						   <a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($attachment->ID, 'full', false, false); ?></a>                            

                             </div> <!-- plain div -->  
						<?php $slidetabs .= '<a href="#"></a>'; ?>	
						<?php endforeach; ?>
								
							<?php endif; ?>
			      
				   <div class="slidetabs">
						<?php echo $slidetabs ?>
						</div>

					<!-- <div class="buttons">
						<button onClick='jQuery(".slidetabs").data("slideshow").play();'>Play</button>
						<button onClick='jQuery(".slidetabs").data("slideshow").stop();'>Stop</button>
					</div> -->


					<script language="JavaScript">
					// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
					jQuery.noConflict();
					jQuery(function()  {

					jQuery(".slidetabs").tabs(".images > div", {

						// enable "cross-fading" effect
						effect: 'fade',
						fadeOutSpeed: "slow",

						// start from the beginning after the last tab
						rotate: true

					// use the slideshow plugin. It accepts its own configuration
					}).slideshow({autoplay:true});
					});
					</script>

				   
             </div> <!-- #images -->
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
