<?php
function fixhero_blog_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_blog_setting' , array(
        'title'      => esc_html__( 'Blog Setting', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_hr_1', 
			array(
				'settings'		=> 'blog_hr_1',
				'section'  		=> 'fixhero_blog_setting',
			)
		)
	);
	//End separator
}