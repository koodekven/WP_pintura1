<?php
function fixhero_offcanvas_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_offcanvas_setting' , array(
        'title'      => esc_html__( 'Offcanvas Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start enabal
    $fixhero_customizer->add_setting('fixhero_enable_offcanvas',
		array(
			'default' => 0
		)
    );
    $fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_enable_offcanvas',
			array(
				'type' => 'switch',
				'label' => esc_html__('Show OFF Canvas', 'fixhero'),
				'description' => esc_html__('You can show or hide offcanvas', 'fixhero'),
				'section' => 'fixhero_offcanvas_setting',
			)
		)
    );
    //End enabal

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_00', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_00', 
			array(
				'settings'		=> 'offcanvas_hr_00',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start default header logo
	$fixhero_customizer->add_setting(
		'fixhero_offcanvas_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_offcanvas_logo',
			array(
			'label'      => esc_html__( 'Offcanvas Logo', 'fixhero' ),
			'section'    => 'fixhero_offcanvas_setting',
			'settings'   => 'fixhero_offcanvas_logo',
			)
		)   
	);
	//End default logo

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_0', 
			array(
				'settings'		=> 'offcanvas_hr_0',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_logo_height',
        array(
			'default'   => '50px',
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_offcanvas_logo_height', array(
        'section'     => 'fixhero_offcanvas_setting',
        'label'       => esc_html__('Logo Height', 'fixhero'),
        'description' => esc_html__('Logo max height example(50px)', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_offcanvas_logo_height',
    ));
    //End container size

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_1', 
			array(
				'settings'		=> 'offcanvas_hr_1',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Email Address
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_email_address',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_offcanvas_email_address', array(
        'section'     => 'fixhero_offcanvas_setting',
        'label'       => esc_html__('Email Address', 'fixhero'),
        'description' => esc_html__('Offcanvas email address', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_offcanvas_email_address',
    ));
    //End Email Address

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_email', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_email', 
			array(
				'settings'		=> 'offcanvas_hr_email',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Phone Number
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_phone_number',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_offcanvas_phone_number', array(
        'section'     => 'fixhero_offcanvas_setting',
        'label'       => esc_html__('Phone Number', 'fixhero'),
        'description' => esc_html__('Offcanvas phone number', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_offcanvas_phone_number',
    ));
    //End Phone Number

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_phone', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_phone', 
			array(
				'settings'		=> 'offcanvas_hr_phone',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Address
	$fixhero_customizer->add_setting('fixhero_offcanvas_address', array(
		'transport'		=> 'refresh',
	));
	$fixhero_customizer->add_control('fixhero_offcanvas_address', array(
		'section'	    => 'fixhero_offcanvas_setting',
		'label'			=> esc_html__( 'Address', 'fixhero' ),
		'description'	=> esc_html__('Offcanvas address', 'fixhero'),
		'type'		    => 'textarea',
		'setting'	    => 'fixhero_offcanvas_address'	
	));
	//End Address

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_address', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_address', 
			array(
				'settings'		=> 'offcanvas_hr_address',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_bg_color',
            array(
                'label'       => esc_html__('Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_3', 
			array(
				'settings'		=> 'offcanvas_hr_3',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_text_color',
            array(
                'label'       => esc_html__('Text Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_2', 
			array(
				'settings'		=> 'offcanvas_hr_2',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_social_icon_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_social_icon_color',
            array(
                'label'       => esc_html__('Social Icon Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_social_icon_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_4', 
			array(
				'settings'		=> 'offcanvas_hr_4',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
	$fixhero_customizer->add_setting(
		'fixhero_offcanvas_button_color'
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Color_Control(
			$fixhero_customizer,
			'fixhero_offcanvas_button_color',
			array(
				'label'       => esc_html__('Social Button Color', 'fixhero'),
				'description' => esc_html__('Pick color', 'fixhero'),
				'section'     => 'fixhero_offcanvas_setting',
				'settings'    => 'fixhero_offcanvas_button_color',
			)
		)
	);
	//End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_5', 
			array(
				'settings'		=> 'offcanvas_hr_5',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_button_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_button_hover_color',
            array(
                'label'       => esc_html__('Button hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_button_hover_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_6', 
			array(
				'settings'		=> 'offcanvas_hr_6',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_hamburger_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_hamburger_bg_color',
            array(
                'label'       => esc_html__('Hamburger Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_hamburger_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_7', 
			array(
				'settings'		=> 'offcanvas_hr_7',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_hamburger_icon_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_hamburger_icon_color',
            array(
                'label'       => esc_html__('Hamburger Icon Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_hamburger_icon_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'offcanvas_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'offcanvas_hr_8', 
			array(
				'settings'		=> 'offcanvas_hr_8',
				'section'  		=> 'fixhero_offcanvas_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_hamburger_clode_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_hamburger_clode_color',
            array(
                'label'       => esc_html__('Hamburger Close Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_offcanvas_setting',
                'settings'    => 'fixhero_offcanvas_hamburger_clode_color',
            )
        )
    );
    //End Body Background Color
}