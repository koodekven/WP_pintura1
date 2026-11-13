<?php
function fixhero_page_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_page_setting' , array(
        'title'      => esc_html__( 'Page Setting', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_page_default_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_page_default_logo',
			array(
			'label'      => esc_html__( 'Upload Page Logo', 'fixhero' ),
			'section'    => 'fixhero_page_setting',
			'settings'   => 'fixhero_page_default_logo',
			)
		)   
	);
	//End

	//Start Sticky Menu
	$fixhero_customizer->add_setting( 'fixhero_page_enable_sticky_menu', 
	array(
			'default'    => '0',
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_page_enable_sticky_menu',
			array(
				'type' => 'switch',
				'label' => esc_html__('Sticky Menu','fixhero'),
				'description' => esc_html__('You can show or hide sticky menu here','fixhero'),
				'section' => 'fixhero_page_setting'
			)
		)
	);
	//End Sticky Menu

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_page_header_menu_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_header_menu_bg_color',
            array(
                'label' => esc_html__('Header Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_page_setting',
                'settings' => 'fixhero_page_header_menu_bg_color',
            )
        )
    );
    //End

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_page_header_menu_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_header_menu_color',
            array(
                'label' => esc_html__('Header Menu Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_page_setting',
                'settings' => 'fixhero_page_header_menu_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'page_hr_0', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'page_hr_0', 
			array(
				'settings'		=> 'page_hr_0',
				'section'  		=> 'fixhero_page_setting',
			)
		)
	);
	//End separator

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_page_header_menu_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_header_menu_hover_color',
            array(
                'label' => esc_html__('Header Menu Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_page_setting',
                'settings' => 'fixhero_page_header_menu_hover_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'page_hr_1', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'page_hr_1', 
			array(
				'settings'		=> 'page_hr_1',
				'section'  		=> 'fixhero_page_setting',
			)
		)
	);
	//End separator

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_page_header_menu_active_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_header_menu_active_color',
            array(
                'label' => esc_html__('Header Menu Active Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_page_setting',
                'settings' => 'fixhero_page_header_menu_active_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'page_hr_2', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'page_hr_2', 
			array(
				'settings'		=> 'page_hr_2',
				'section'  		=> 'fixhero_page_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_page_sign_in_text_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_sign_in_text_color',
            array(
                'label'      => esc_html__('Text Color','fixhero'),
                'description'      => esc_html__('Select Text Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_sign_in_text_color',
            )
        )
    );
	//End Color

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_page_sign_in_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_sign_in_text_hover_color',
            array(
                'label'      => esc_html__('Hover Color','fixhero'),
                'description'      => esc_html__('Select Hover Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_sign_in_text_hover_color',
            )
        )
    );
	//End Color

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_page_download_border_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_download_border_color',
            array(
                'label'      => esc_html__('Button Border Color','fixhero'),
                'description'      => esc_html__('Select Button Border Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_download_border_color',
            )
        )
    );
	//End Color

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_page_download_text_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_download_text_color',
            array(
                'label'      => esc_html__('Button Link Color','fixhero'),
                'description'      => esc_html__('Select text Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_download_text_color',
            )
        )
    );
	//End Color

    //Start Color
    $fixhero_customizer->add_setting (
        'fixhero_page_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_download_text_hover_color',
            array(
                'label'      => esc_html__('Button Link Hover Color','fixhero'),
                'description'      => esc_html__('Select Text Hover Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_download_text_hover_color',
            )
        )
    );
    //End Color

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_page_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_page_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Hover Color','fixhero'),
                'description'      => esc_html__('Select Button Hover Color','fixhero'),
                'section'    => 'fixhero_page_setting',
                'settings'   => 'fixhero_page_download_btn_hover_color',
            )
        )
    );
	//End Color
}