<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if ( ! function_exists( 'fixhero_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 

define( 'FIXHERO_THEME_DIR', get_template_directory() );
define( 'FIXHERO_THEME_URI', get_template_directory_uri() );
define( 'FIXHERO_THEME_SUB_DIR', FIXHERO_THEME_DIR.'/inc/' );
define( 'FIXHERO_THEME_CSS_DIR', FIXHERO_THEME_URI.'/css/' );
define( 'FIXHERO_THEME_JS_DIR', FIXHERO_THEME_URI.'/js/' );

function fixhero_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fixhero, use a find and replace
	 * to change 'fixhero' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fixhero', get_template_directory() . '/languages' );


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	
	
	function fixhero_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}
		
		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'fixhero_change_excerpt');


	// Limit Excerpt Length by number of Words
	function fixhero_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
		}
		function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'fixhero' ),		
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fixhero_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );

add_theme_support( 'align-wide' );	
}

endif;
add_action( 'after_setup_theme', 'fixhero_setup' );


/**
*Custom Image Size
*/

add_image_size( 'fixhero_portfolio-slider', 520, 640, true );
add_image_size( 'fixhero_portfolio-slider-four', 416, 340, true );
add_image_size( 'fixhero_blog-slider', 760, 560, true );
add_image_size( 'fixhero_blog-footer', 100, 100, true );
add_image_size( 'fixhero_team_size', 310, 270, true );
add_image_size( 'fixhero_team_slider_size', 308, 380, true );
add_image_size( 'fixhero_new_size', 406, 447, true );
add_image_size( 'fixhero_addom_team_round_style', 500, 500, true );
add_image_size( 'fixhero_portfolio-grid-item9', 416, 295, true );
add_image_size( 'fixhero_blog-list11-size', 625, 556, true );
add_image_size( 'fixhero_blog-list2-size', 625, 268, true );
add_image_size( 'fixhero_blog-list3-size', 296, 272, true );
add_image_size( 'fixhero_portfolio-image-grid-three', 416, 415, true );
add_image_size( 'fixhero_service-image-grid', 416, 350, true );
add_image_size( 'fixhero_service-carpenter-grid2', 355, 170, true );
add_image_size( 'fixhero_blog-grid-gadget', 407, 470, true );
add_image_size( 'fixhero_gardening-service1', 407, 338, true );
add_image_size( 'fixhero_gadget-service1', 405, 245, true );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fixhero_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fixhero_content_width', 640 );
}
add_action( 'after_setup_theme', 'fixhero_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/template-scripts.php';

/**
 * WooCommerce additions.
 */
require_once get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';


/**
 * Customizer additions.
 */
require_once FIXHERO_THEME_SUB_DIR.'/customizer/includes.php';


if ( is_admin() ) {
	require_once get_template_directory() . '/framework/ini/class-rstheme-licenser.php';
	require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/framework/tgm-config.php';
}

$licenseKey = get_option( "FixheroWordPressTheme_lic_Key", "" );
if ( ! empty( $licenseKey ) ) {
	require_once get_template_directory() . '/framework/custom.php';
}


/**
 * Registers an editor stylesheet for the theme.
 */
function fixhero_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'fixhero_theme_add_editor_styles' );


//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function fixhero_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'fixhero_wpb_move_comment_field_to_bottom' );	

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});


function fixhero_comment_textarea_placeholder( $args ) {
	$replace_comment = __('Comment*', 'fixhero');
	$args['comment_field']        = str_replace( '<textarea', '<textarea placeholder="'.$replace_comment.'"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'fixhero_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder
 *
 */
function fixhero_comment_form_fields( $fields ) {
	$replace_author = __('Name*', 'fixhero');
    $replace_email = __('Email*', 'fixhero');
    $website_url = __('Website', 'fixhero');
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="'.$replace_author.'"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="'.$replace_email.'"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="'.$website_url.'"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'fixhero_comment_form_fields' );