<?php
function fixhero_sign_in_button_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_sign_in_button_setting' , array(
        'title'      => esc_html__( 'Sign In Button Style', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_bg_color',
            array(
                'label' => esc_html__('Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_0', 
			array(
				'settings'		=> 'button_hr_0',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_border_color_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_border_color_color',
            array(
                'label' => esc_html__('Border Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_border_color_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_1', 
			array(
				'settings'		=> 'button_hr_1',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_icon_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_icon_bg_color',
            array(
                'label' => esc_html__('Icon Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_icon_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_2', 
			array(
				'settings'		=> 'button_hr_2',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_hover_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_hover_bg_color',
            array(
                'label' => esc_html__('Hover Background', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_hover_bg_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_3', 
			array(
				'settings'		=> 'button_hr_3',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_hover_border_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_hover_border_color',
            array(
                'label' => esc_html__('Hover Border Colo', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_hover_border_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_4', 
			array(
				'settings'		=> 'button_hr_4',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_text_color',
            array(
                'label' => esc_html__('Text Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_5', 
			array(
				'settings'		=> 'button_hr_5',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_hover_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sign_in_button_hover_text_color',
            array(
                'label' => esc_html__('Hover Text Colo', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sign_in_button_setting',
                'settings' => 'fixhero_sign_in_button_hover_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_6', 
			array(
				'settings'		=> 'button_hr_6',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_sign_in_button_border_radius',
        array(
			'default'           => '62px',
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_sign_in_button_border_radius', array(
        'section' => 'fixhero_sign_in_button_setting',
        'label' => esc_html__('Button Border Radius', 'fixhero'),
        'description' => esc_html__('Border Radius example(5px)', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_sign_in_button_border_radius',
    ));
    //End container size

	//Start separator
	$fixhero_customizer->add_setting(
		'button_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_hr_7', 
			array(
				'settings'		=> 'button_hr_7',
				'section'  		=> 'fixhero_sign_in_button_setting',
			)
		)
	);
	//End separator
}