<?php
function fixhero_blog_page_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_blog_page_style_setting' , array(
        'title'      => esc_html__( 'Blog Page', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_blog_setting'
    ) );

	//Start default Page Banner
	$fixhero_customizer->add_setting(
		'fixhero_blog_page_bg', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_blog_page_bg',
			array(
			'label'      => esc_html__( 'Blog Page Image', 'fixhero' ),
			'section'    => 'fixhero_blog_page_style_setting',
			'settings'   => 'fixhero_blog_page_bg',
			)
		)   
	);
	//End default Page Banner

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_0', 
			array(
				'settings'		=> 'blog_page_hr_0',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator
	

	//Start Background Color
	$fixhero_customizer->add_setting (
        'fixhero_blog_page_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_blog_page_bg_color',
            array(
                'label'      => esc_html__('Body Backgroud Color','fixhero'),
                'description'      => esc_html__('Pick body background color','fixhero'),
                'section'    => 'fixhero_blog_page_style_setting',
                'settings'   => 'fixhero_blog_page_bg_color',
            )
        )
    );
	//End Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_1', 
			array(
				'settings'		=> 'blog_page_hr_1',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator


	//Start
	$fixhero_customizer->add_setting( 'fixhero_blog_page_sidebar_setting', array(
		'default'           => 'blog_no_sidebar',
		'transport'	        => 'postMessage',
	) );
	$fixhero_customizer->add_control( 'fixhero_blog_page_sidebar_setting', array(
		'label'   => esc_html__( 'Sidebar Setting', 'fixhero' ),
		'section' => 'fixhero_blog_page_style_setting',
		'type'    => 'select',
		'choices' => array(
			'blog_no_sidebar' => esc_html__( 'Full Width', 'fixhero' ),
			'blog_left_sidebar' => esc_html__( 'Left Sidebar', 'fixhero' ),
			'blog_right_sidebar'  => esc_html__( 'Right Sidebar', 'fixhero' ),
		),
	) );
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_4', 
			array(
				'settings'		=> 'blog_page_hr_4',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Author
	$fixhero_customizer->add_setting( 'fixhero_blog_page_hide_author', 
	array(
		'default'           => 0,
	)
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_page_hide_author',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Author','fixhero'),
				'description' => esc_html__('If you want to hide author click ON button','fixhero'),
				'section' => 'fixhero_blog_page_style_setting'
			)
		)
	);
	//End Hide Author

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_5', 
			array(
				'settings'		=> 'blog_page_hr_5',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$fixhero_customizer->add_setting( 'fixhero_blog_page_hide_date', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_page_hide_date',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Date','fixhero'),
				'description' => esc_html__('If you want to hide date click ON button','fixhero'),
				'section' => 'fixhero_blog_page_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_6', 
			array(
				'settings'		=> 'blog_page_hr_6',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Hide Date
	$fixhero_customizer->add_setting( 'fixhero_blog_page_hide_categiry', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_blog_page_hide_categiry',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Category','fixhero'),
				'description' => esc_html__('If you want to hide categoy click ON button','fixhero'),
				'section' => 'fixhero_blog_page_style_setting'
			)
		)
	);
	//End Hide Date

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_7', 
			array(
				'settings'		=> 'blog_page_hr_7',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start Blog Page Custom Title
	$fixhero_customizer->add_setting(
		'fixhero_blog_page_custom_read_more',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('fixhero_blog_page_custom_read_more', array(
        'section'	=> 'fixhero_blog_page_style_setting',
        'label'		=> esc_html__( 'Blog Read More Text', 'fixhero' ),
        'description' => esc_html__( 'Enter Blog Read More Here', 'fixhero' ),
        'type'		=> 'text',
        'setting'	=> 'fixhero_blog_page_custom_read_more'
    ));
	//End Blog Page Custom Title

	//Start separator
	$fixhero_customizer->add_setting(
		'blog_page_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'blog_page_hr_8', 
			array(
				'settings'		=> 'blog_page_hr_8',
				'section'  		=> 'fixhero_blog_page_style_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting( 'fixhero_blog_page_btn_setting', array(
	 	'default'           => 'rs-default',
	 	'transport'	        => 'postMessage',
	));

	$fixhero_customizer->add_control( 'fixhero_blog_page_btn_setting', array(
	 	'label'   => esc_html__( 'Button Setting', 'fixhero' ),
	 	'section' => 'fixhero_blog_page_style_setting',
	 	'type'    => 'select',
	 	'choices' => array(
	 		'rs-default' => esc_html__( 'Default Style', 'fixhero' ),
	 		'rs-border' => esc_html__( 'Border Style', 'fixhero' ),
	 		'rs-flat' => esc_html__( 'Flat Style', 'fixhero' )
	 	),
	));
	//End
}