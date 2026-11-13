<?php
function fixhero_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_style_setting' , array(
        'title'      => esc_html__( 'Theme Style Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );


	//Start Body Background Color
	$fixhero_customizer->add_setting (
        'fixhero_style_primary_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_style_primary_color',
            array(
                'label'       => esc_html__('Theme Primary Color','fixhero'),
                'description' => esc_html__('Pic Color','fixhero'),
                'section'     => 'fixhero_style_setting',
                'settings'    => 'fixhero_style_primary_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
    	'style_hr_21', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $fixhero_customizer->add_control(
    	new fixhero_Separator_Control(
    		$fixhero_customizer, 
    		'style_hr_21', 
    		array(
    			'settings'		=> 'style_hr_21',
    			'section'  		=> 'fixhero_style_setting',
    		)
    	)
    );
    //End separator

	$fixhero_customizer->add_setting (
        'fixhero_style_gradient_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_style_gradient_color',
            array(
                'label'       => esc_html__('Theme 2nd Gradient Color','fixhero'),
                'description' => esc_html__('Pic Color','fixhero'),
                'section'     => 'fixhero_style_setting',
                'settings'    => 'fixhero_style_gradient_color',
            )
        )
    );
	//End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'style_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'style_hr_2', 
			array(
				'settings'		=> 'style_hr_2',
				'section'  		=> 'fixhero_style_setting',
			)
		)
	);
	//End separator

	//Start Body Background Color
	$fixhero_customizer->add_setting (
        'fixhero_style_secondaer_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_style_secondaer_color',
            array(
                'label'       => esc_html__('Theme Secondary Color','fixhero'),
                'description' => esc_html__('Pic Color','fixhero'),
                'section'     => 'fixhero_style_setting',
                'settings'    => 'fixhero_style_secondaer_color',
            )
        )
    );
	//End Body Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'style_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'style_hr_3', 
			array(
				'settings'		=> 'style_hr_3',
				'section'  		=> 'fixhero_style_setting',
			)
		)
	);
	//End separator
}