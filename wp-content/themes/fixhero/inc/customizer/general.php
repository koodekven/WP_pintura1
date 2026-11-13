<?php
function fixhero_general_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section(
		'fixhero_general_section',
		array(
			'title'    => esc_html__( 'General Settings', 'fixhero' ),
			'priority' => $priority,
			'panel'    => 'fixhero_options_panel'
		)
	);


	//Start separator
	$fixhero_customizer->add_setting(
		'separator_14', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_14', 
			array(
				'settings'		=> 'separator_14',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start default header logo
	$fixhero_customizer->add_setting(
		'fixhero_default_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_default_logo',
			array(
			'label'      => esc_html__( 'Upload Default Logo', 'fixhero' ),
			'section'    => 'fixhero_general_section',
			'settings'   => 'fixhero_default_logo',
			)
		)   
	);
	//End default logo

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_15', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_15', 
			array(
				'settings'		=> 'separator_15',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_3', 
			array(
				'settings'		=> 'separator_3',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Logo Height
	$fixhero_customizer->add_setting(
		'fixhero_logo_height',
		array(
			'default' => esc_html__( '', 'fixhero' ),
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('fixhero_logo_height', array(
        'section'	=> 'fixhero_general_section',
        'label'		=> esc_html__( 'Logo Height', 'fixhero' ),
        'description' => esc_html__( 'Logo max height example(50px)', 'fixhero' ),
        'type'		=> 'text',
        'setting'	=> 'fixhero_logo_height'
    ));
	//End Logo Height

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_4', 
			array(
				'settings'		=> 'separator_4',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Sticky Menu
	$fixhero_customizer->add_setting( 'fixhero_enable_sticky_menu', 
	array(
			'default'    => '0',
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_enable_sticky_menu',
			array(
				'type' => 'switch',
				'label' => esc_html__('Sticky Menu','fixhero'),
				'description' => esc_html__('You can show or hide sticky menu here','fixhero'),
				'section' => 'fixhero_general_section'
			)
		)
	);
	//End Sticky Menu

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_9', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_9', 
			array(
				'settings'		=> 'separator_9',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Sticky logo
	$fixhero_customizer->add_setting(
		'fixhero_sticky_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_sticky_logo',
			array(
			'label'      => esc_html__( 'Upload Your Sticky Logo', 'fixhero' ),
			'section'    => 'fixhero_general_section',
			'settings'   => 'fixhero_sticky_logo',
			)
		)   
	);
	//End Sticky logo

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_7', 
			array(
				'settings'		=> 'separator_7',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Sticky Logo Height
	$fixhero_customizer->add_setting(
		'fixhero_sticky_logo_height',
		array(
			'default' => esc_html__( '25px', 'fixhero' ),
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('fixhero_sticky_logo_height', array(
        'section'	=> 'fixhero_general_section',
        'label'		=> esc_html__( 'Sticky Logo Height', 'fixhero' ),
        'description' => esc_html__( 'Sticky Logo max height example(20px)', 'fixhero' ),
        'type'		=> 'text',
        'setting'	=> 'fixhero_sticky_logo_height'
    ));
	//End Sticky Logo Height

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_8', 
			array(
				'settings'		=> 'separator_8',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start favicon
	$fixhero_customizer->add_setting(
		'fixhero_favicon', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_favicon',
			array(
			'label'      => esc_html__( 'Upload Favicon', 'fixhero' ),
			'section'    => 'fixhero_general_section',
			'settings'   => 'fixhero_favicon',
			)
		)   
	);
	//End favicon

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_10', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_10', 
			array(
				'settings'		=> 'separator_10',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Show off Canvas
	$fixhero_customizer->add_setting( 'fixhero_enable_go_to_top', 
	array(
		'default'    => '0',
		) 
	);
	
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_enable_go_to_top',
			array(
				'type' => 'switch',
				'label' => esc_html__('Go to Top','fixhero'),
				'description' => esc_html__('You can show or hide here','fixhero'),
				'section' => 'fixhero_general_section'
			)
		)
	);
	//End Show off Canvas


	//Start Go to Top Background Color
	$fixhero_customizer->add_setting (
        'fixhero_scroll_top_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_top_bg_color',
            array(
                'label'      => esc_html__('Go to Top Background Color','fixhero'),
                'section'    => 'fixhero_general_section',
                'settings'   => 'fixhero_scroll_top_bg_color',
            )
        )
    );
	//End Go to Top Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_11', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_11', 
			array(
				'settings'		=> 'separator_11',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$fixhero_customizer->add_setting (
        'fixhero_scroll_top__color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_top__color',
            array(
                'label'      => esc_html__('Go to Top Color','fixhero'),
                'section'    => 'fixhero_general_section',
                'settings'   => 'fixhero_scroll_top__color',
            )
        )
    );
	//End Go to Top Background Color


	//Start separator
	$fixhero_customizer->add_setting(
		'separator_13', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_13', 
			array(
				'settings'		=> 'separator_13',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$fixhero_customizer->add_setting (
        'fixhero_scroll_top_bg_color_hover'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_top_bg_color_hover',
            array(
                'label'      => esc_html__('Go to Top Background Color (Hover)','fixhero'),
                'section'    => 'fixhero_general_section',
                'settings'   => 'fixhero_scroll_top_bg_color_hover',
            )
        )
    );
	//End Go to Top Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_12', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_12', 
			array(
				'settings'		=> 'separator_12',
				'section'  		=> 'fixhero_general_section',
			)
		)
	);
	//End separator

	//Start Go to Top Background Color
	$fixhero_customizer->add_setting (
        'fixhero_scroll_top__color_hover'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_top__color_hover',
            array(
                'label'      => esc_html__('Go to Top Color (Hover)','fixhero'),
                'section'    => 'fixhero_general_section',
                'settings'   => 'fixhero_scroll_top__color_hover',
            )
        )
    );
	//End Go to Top Background Color
}