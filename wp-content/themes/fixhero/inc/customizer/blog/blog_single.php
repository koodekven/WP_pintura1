<?php
function fixhero_blog_single_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_blog_single_style_setting' , array(
        'title'      => esc_html__( 'Blog Single', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_blog_setting'
    ) );


	//Start
	$fixhero_customizer->add_setting( 'fixhero_blog_single_sidebar_setting', array(
		'default'           => 'blog_single_no_sidebar',
		'transport'	        => 'postMessage',
	) );
	$fixhero_customizer->add_control( 'fixhero_blog_single_sidebar_setting', array(
		'label'   => esc_html__( 'Sidebar Setting', 'fixhero' ),
		'section' => 'fixhero_blog_single_style_setting',
		'type'    => 'select',
		'choices' => array(
			'blog_single_no_sidebar' => esc_html__( 'Full Width', 'fixhero' ),
			'2left' => esc_html__( 'Left Sidebar', 'fixhero' ),
			'2right'  => esc_html__( 'Right Sidebar', 'fixhero' ),
		),
	) );
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_single_hr_00', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_single_hr_00', 
			array(
				'settings'		=> 'blog_single_hr_00',
				'section'  		=> 'fixhero_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Author
	$fixhero_customizer->add_setting( 'fixhero_blog_single_hide_author', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_single_hide_author',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Author','fixhero'),
				'description' => esc_html__('You can show or hide Author','fixhero'),
				'section' => 'fixhero_blog_single_style_setting'
			)
		)
	);
	//End Hide Author

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_single_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_single_hr_1', 
			array(
				'settings'		=> 'blog_single_hr_1',
				'section'  		=> 'fixhero_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$fixhero_customizer->add_setting( 'fixhero_blog_single_hide_comment', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_single_hide_comment',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Comment','fixhero'),
				'description' => esc_html__('You can show or hide comment','fixhero'),
				'section' => 'fixhero_blog_single_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_single_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_single_hr_2', 
			array(
				'settings'		=> 'blog_single_hr_2',
				'section'  		=> 'fixhero_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Published
	$fixhero_customizer->add_setting( 'fixhero_blog_single_hide_published', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_single_hide_published',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Published','fixhero'),
				'description' => esc_html__('You can show or hide published','fixhero'),
				'section' => 'fixhero_blog_single_style_setting'
			)
		)
	);
	//End Hide Published

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_single_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_single_hr_3', 
			array(
				'settings'		=> 'blog_single_hr_3',
				'section'  		=> 'fixhero_blog_single_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Category
	$fixhero_customizer->add_setting( 'fixhero_blog_single_hide_categiry', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_single_hide_categiry',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Category','fixhero'),
				'description' => esc_html__('You can show or hide categiry','fixhero'),
				'section' => 'fixhero_blog_single_style_setting'
			)
		)
	);
	//End Hide Category

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_single_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_single_hr_4', 
			array(
				'settings'		=> 'blog_single_hr_4',
				'section'  		=> 'fixhero_blog_single_style_setting',
			)
		)
	);
	//End separator
}