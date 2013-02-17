<?php 
 /**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 940;

//http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/ 
// add a favicon to your 
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

// FOR DEBUGGING WHICH TEMPLATE IS BEING USED.
// add_action('wp_head', 'show_template');
// function show_template() {
// 	global $template;
// 	print_r($template);
// }


/**
* kill the admin nag 
* http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/ 
*/
if (!current_user_can('edit_users')) {
	add_action('init', create_function('$a', "remove_action('init', 'wp_version_check');"), 2);
	add_filter('pre_option_update_core', create_function('$a', "return null;"));
} 

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Elise Siegel 0.5
 */
function twentyten_setup() {
	// removing filters from parent function.php file http://www.nohair.net/news/2011/wordpress-child-themes-and-removing-filters-in-functions-php/
	remove_filter('excerpt_more', 'twentyten_auto_excerpt_more');
 	remove_filter('get_the_excerpt', 'twentyten_custom_excerpt_more');
 	add_filter( 'excerpt_more', 'dw_auto_excerpt_more' );
	add_filter( 'get_the_excerpt', 'dw_custom_excerpt_more' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	//add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default thumbnail size
	add_image_size('pinky', 40, 40, true); // for pinky previews
	add_image_size('tn-200', 200, 200, false); // just in case
	add_image_size('tn-150', 150, 150, false); // just in case   
   	add_image_size('tn-300', 300, 300, false); // just in case 
	add_image_size('small_proportional', 75, 75, false);

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();   

	// Deleted changeable header stuff   
}
endif;

if ( ! function_exists( 'twentyten_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *  not using this, so empty, so parent theme does not call it.
 * Referenced via add_custom_image_header() in twentyten_setup().
 *
 */
	function twentyten_admin_header_style() {
	}
endif;

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *  not using this, so empty, so parent theme does not call it.
 */
	function twentyten_posted_on() {
	}
endif;
  



/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function dw_continue_reading_link() {
	return ' <br /><a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function dw_auto_excerpt_more( $more ) {
	return ' &hellip;' . dw_continue_reading_link();
}


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function dw_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= dw_continue_reading_link();
	}
	return $output;
} 



/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'dw_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dw_metaboxes( array $dw_meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_dw_';

	$dw_meta_boxes[] = array(
		'id'         => 'art_info',
		'title'      => 'Artwork Information',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
	    //'show_on' => array( 'key' => 'page-template', 'value' => 'page-artwork.php' ), //only shows on artwork pages, maybe figure out how to do parent page - Sculpture
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Year',
				'desc' => 'Please, enter the year.',
				'id'   => $prefix . 'year',
				'type' => 'text',
			),
			array(
				'name' => 'Materials',
				'desc' => 'Please, list the materials.',
				'id'   => $prefix . 'materials',
				'type' => 'text',
			),
			array(
				'name' => 'Dimensions',
				'desc' => 'Please, enter the dimensions.',
				'id'   => $prefix . 'dimensions',
				'type' => 'wysiwyg',
				'options' => array(	'textarea_rows' => 4, ),
			), 
			array(
				'name' => 'Optional Text',
				'desc' => 'Enter added text, links, etc., as needed.',
				'id'   => $prefix . 'optional_text',
				'type' => 'wysiwyg',
				'options' => array(	'textarea_rows' => 4, ),
			),   		
		),
	);


	// Add other metaboxes as needed

	return $dw_meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}


/*-----------------------------------------
Check if a page has any children / subpages
http://www.wpmayor.com/wordpress-hacks/check-if-a-page-has-any-children-or-subpages/
-----------------------------------------*/
 
function has_children($post_id) {
    $children = get_pages("child_of=$post_id");
    if( count( $children ) != 0 ) { return true; } // Has Children
    else { return false; } // No children
}

//add google analytics to footer
function add_google_analytics() {
echo '<script type="text/javascript">';
echo "\n";
echo '  var _gaq = _gaq || [];';
echo '  _gaq.push(["_setAccount", "UA-29640744-1"]);';
echo '  _gaq.push(["_trackPageview"]);';
echo "\n";
echo '  (function() {';
echo '    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;';
echo '    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";';
echo '    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);';
echo '  })();';
echo "\n";
echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');

 
// add_action('wp_head', 'show_template');
// function show_template() {
//     global $template;
//     print_r($template);
// } 