<?php
function fixhero_button_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_button_setting' , array(
        'title'      => esc_html__( 'Button Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start Background Color
    $fixhero_customizer->add_setting(
        'fixhero_button_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_button_bg_color',
            array(
                'label' => esc_html__('Button Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_button_setting',
                'settings' => 'fixhero_button_bg_color',
            )
        )
    );
    //End Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_style_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_style_hr_0', 
			array(
				'settings'		=> 'button_style_hr_0',
				'section'  		=> 'fixhero_button_setting',
			)
		)
	);
	//End separator

	//Start Background Color
    $fixhero_customizer->add_setting(
        'fixhero_button_bg_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_button_bg_hover_color',
            array(
                'label' => esc_html__('Button Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_button_setting',
                'settings' => 'fixhero_button_bg_hover_color',
            )
        )
    );
    //End Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_style_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_style_hr_1', 
			array(
				'settings'		=> 'button_style_hr_1',
				'section'  		=> 'fixhero_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_button_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_button_text_color',
            array(
                'label' => esc_html__('Button Text Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_button_setting',
                'settings' => 'fixhero_button_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_style_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_style_hr_2', 
			array(
				'settings'		=> 'button_style_hr_2',
				'section'  		=> 'fixhero_button_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_button_hover_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_button_hover_text_color',
            array(
                'label' => esc_html__('Button Text Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_button_setting',
                'settings' => 'fixhero_button_hover_text_color',
            )
        )
    );
    //End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'button_style_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'button_style_hr_3', 
			array(
				'settings'		=> 'button_style_hr_3',
				'section'  		=> 'fixhero_button_setting',
			)
		)
	);
	//End separator

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_button_border_radius',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_button_border_radius', array(
        'section' => 'fixhero_button_setting',
        'label' => esc_html__('Button Border Radius', 'fixhero'),
        'description' => esc_html__('Border Radius example(5px)', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_button_border_radius',
    ));
    //End container size
}