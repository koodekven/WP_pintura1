<?php
function fixhero_preloader_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_preloader_setting' , array(
        'title'      => esc_html__( 'Preloader Setting', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

    //Start Show Top Bar
	$fixhero_customizer->add_setting( 'fixhero_enable_preloader', 
	array(
		'default'    		=> '0', 
		) 
	);
	
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_enable_preloader',
			array(
				'type' 			=> 'switch',
				'label' 		=> esc_html__( 'Show Preloader','fixhero' ),
				'description' 	=> esc_html__( 'You can show or hide preloader','fixhero' ),
				'section' 		=> 'fixhero_preloader_setting'
			)
		)
	);
	//End Show Top Bar

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_0', 
			array(
				'settings'		=> 'separator_0',
				'section'  		=> 'fixhero_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Background Color
	$fixhero_customizer->add_setting (
        'fixhero_preloader_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_preloader_bg_color',
            array(
                'label'      => esc_html__('Preloader Background Color','fixhero'),
                'section'    => 'fixhero_preloader_setting',
                'settings'   => 'fixhero_preloader_bg_color',
            )
        )
    );
	//End Preloader Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_1', 
			array(
				'settings'		=> 'separator_1',
				'section'  		=> 'fixhero_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Border Color
	$fixhero_customizer->add_setting (
        'fixhero_preloader_border_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_preloader_border_color',
            array(
                'label'      => esc_html__('Preloader Border Color','fixhero'),
                'section'    => 'fixhero_preloader_setting',
                'settings'   => 'fixhero_preloader_border_color',
            )
        )
    );
	//End Preloader Border Color

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_2', 
			array(
				'settings'		=> 'separator_2',
				'section'  		=> 'fixhero_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Animate Circle Color
	$fixhero_customizer->add_setting (
        'fixhero_preloader_animate_circle_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_preloader_animate_circle_color',
            array(
                'label'      => esc_html__('Preloader Animate Circle Color','fixhero'),
                'section'    => 'fixhero_preloader_setting',
                'settings'   => 'fixhero_preloader_animate_circle_color',
            )
        )
    );
	//End Preloader Animate Circle Color

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
				'section'  		=> 'fixhero_preloader_setting',
			)
		)
	);
	//End separator

	//Start Preloader Image
	$fixhero_customizer->add_setting(
		'fixhero_preloader_image', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_preloader_image',
			array(
			'label'      => esc_html__( 'Preloader Image', 'fixhero' ),
			'section'    => 'fixhero_preloader_setting',
			'settings'   => 'fixhero_preloader_image',
			)
		)   
	);
	//End Preloader Image
}