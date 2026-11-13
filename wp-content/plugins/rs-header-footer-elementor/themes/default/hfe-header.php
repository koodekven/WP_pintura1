<?php
/**
 * @author  rs-theme
 * @since   1.0.0
 * @version 1.0.0 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<!--Preloader start here-->
<?php
	if( is_404() ){
	return;
	} else {
    get_template_part( 'inc/header/preloader' ); 
	}
?>

<?php if ( is_active_sidebar( 'rs-offcanvas-sidebar' ) ) { ?>
	<div class="rs-offcanvas-area">
		<div class="rsoffwrap"></div>
		<!-- Canvas Menu start -->
		<nav class="right_menu_togle hidden-md">	
			<div class="rsoffwrap-close"> <i class="ri-close-line"></i> </div>	    
		    <?php dynamic_sidebar('rs-offcanvas-sidebar'); ?>		    
		</nav>
	</div>
<?php } ?>

<div id="page" class="hfeed site">

<?php 
$sticky = !empty(get_theme_mod('fixhero_enable_sticky_menu')) ? 'rs-enable-sticky' : ''; 
if( is_404() ){
	return;
} else {

	?>
	<header id="rs-header" class="single-header <?php echo esc_attr($sticky); ?>">
	    <div class="header-inner">
	    	<?php
	    		do_action( 'hfe_topbar' ); 
				do_action( 'hfe_header' );
			?>
		</div>
	</header>
	<?php do_action( 'hfe_header_after' ); ?>
	<?php
}