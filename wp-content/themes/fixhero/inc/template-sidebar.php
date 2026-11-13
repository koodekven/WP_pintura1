<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function fixhero_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fixhero' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This is sidebar area for blog post and single post.', 'fixhero' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Offcanvas Sidebar', 'fixhero' ),
		'id'            => 'rs-offcanvas-sidebar',
		'description'   => esc_html__( 'This is sidebar area for offcanvas.', 'fixhero' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Services Sidebar', 'fixhero' ),
		'id'            => 'rs-services-sidebar',
		'description'   => esc_html__( 'This is sidebar area for services.', 'fixhero' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Projects Sidebar', 'fixhero' ),
		'id'            => 'rs-projects-sidebars',
		'description'   => esc_html__( 'This is sidebar area for projects.', 'fixhero' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'fixhero' ),
			'id'            => 'sidebar_shop',
			'description'   => esc_html__( 'Sidebar Shop', 'fixhero' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}		
}
add_action( 'widgets_init', 'fixhero_widgets_init' );