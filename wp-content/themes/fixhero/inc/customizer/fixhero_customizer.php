<?php
if( !function_exists( 'fixhero_customizer_register' ) ){
	function fixhero_customizer_register( $fixhero_customizer ){
	/*-----------------------------
	Theme Options
	-----------------------------*/
	$fixhero_customizer->add_panel( 
		'fixhero_options_panel',
		array(
			'title'      => esc_html__( 'Fixhero Options', 'fixhero' ),
			'description'=> esc_html__( 'General options of fixhero', 'fixhero'),
			'priority'=> 20,
		)
	);

	/**
	 * General setting panel
	 * 
	 * @since 1.0.0
	 */
	
	fixhero_general_panel( $fixhero_customizer, 0 );
	//End General Setting


	 /**
	 * Start Preloader Style setting
	 * @since 1.0.0
	 */
	fixhero_preloader_panel( $fixhero_customizer, 82 );
	//End Preloader Style setting

	 /**
	 * Start Style setting
	 * @since 1.0.0
	 */
	fixhero_style_panel( $fixhero_customizer, 61 );

	fixhero_offcanvas_panel( $fixhero_customizer, 63 );
	

	/**
	 * Start Typography setting
	 * @since 1.0.0
	 */
	fixhero_typography_panel( $fixhero_customizer, 81 );
	//End Typography setting

	 /**
	 * Start Blog setting
	 * @since 1.0.0
	 */

	$fixhero_blog_panel = new PE_WP_Customize_Panel( $fixhero_customizer, 'fixhero_blog_setting', array(
		'title' => esc_html__( 'Blog Settings', 'fixhero' ),
		'panel' => 'fixhero_options_panel',
		'priority' => 100,
		)
	);
	$fixhero_customizer->add_panel( $fixhero_blog_panel );

	fixhero_blog_page_style_panel( $fixhero_customizer, 101 );
	fixhero_blog_single_style_panel( $fixhero_customizer, 102 );
	
	//End Blog setting
	 
	/**
	 * Start Team setting
	 * @since 1.0.0
	 */
	fixhero_team_panel( $fixhero_customizer, 121 );
	//End Team setting
 
	/**
	 * Start woocommerce settings
	 * @since 1.0.0
	 */
	fixhero_woocommerce_panel( $fixhero_customizer, 210 );
	//End woocommerce settings

	fixhero_custom_fonts_panel( $fixhero_customizer, 200 );
	

	/**
	 * Start 404 Page Setting
	 * @since 1.0.0
	 */
	fixhero_404_panel( $fixhero_customizer, 241 );
	//End 404 Page Setting
		
 	}
}
add_action( 'customize_register', 'fixhero_customizer_register' );