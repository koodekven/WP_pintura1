<?php
function fixhero_main_menu_style_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_main_menu_setting' , array(
        'title'      => esc_html__( 'Main Menu Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_text_color',
            array(
                'label' => esc_html__('Menu Text Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_text_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_0', 
			array(
				'settings'		=> 'main_menu_hr_0',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_hover_color',
            array(
                'label' => esc_html__('Menu Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_hover_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_2', 
			array(
				'settings'		=> 'main_menu_hr_2',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_active_color',
        array(
            'default' => '#FFFFFF',
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_active_color',
            array(
                'label' => esc_html__('Menu Active Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_active_color',
            )
        )
    );
    //End


    //Start separator
    $fixhero_customizer->add_setting(
    	'main_menu_hr_1', 
    	array(
    		'default'           => '',
    		'sanitize_callback' => 'esc_html',
    	)
    );
    $fixhero_customizer->add_control(
    	new fixhero_Separator_Control(
    		$fixhero_customizer, 
    		'main_menu_hr_1', 
    		array(
    			'settings'		=> 'main_menu_hr_1',
    			'section'  		=> 'fixhero_main_menu_setting',
    		)
    	)
    );
    //End separator 


	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_color',
            array(
                'label' => esc_html__('Menu Dropdown Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_3', 
			array(
				'settings'		=> 'main_menu_hr_3',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_active_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_active_color',
            array(
                'label' => esc_html__('Menu Dropdown Active Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_active_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_4', 
			array(
				'settings'		=> 'main_menu_hr_4',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_hover_color',
            array(
                'label' => esc_html__('Menu Dropdown Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_hover_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_5', 
			array(
				'settings'		=> 'main_menu_hr_5',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_bg_color',
            array(
                'label' => esc_html__('Menu Dropdown Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_bg_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_6', 
			array(
				'settings'		=> 'main_menu_hr_6',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_hover_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_hover_bg_color',
            array(
                'label' => esc_html__('Menu Dropdown Hover Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_hover_bg_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_07', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_07', 
			array(
				'settings'		=> 'main_menu_hr_07',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_dropdown_border_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_main_menu_dropdown_border_color',
            array(
                'label' => esc_html__('Menu Dropdown Border Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_main_menu_setting',
                'settings' => 'fixhero_main_menu_dropdown_border_color',
            )
        )
    );
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_7', 
			array(
				'settings'		=> 'main_menu_hr_7',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 
	
	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_lr_gap',
        array(
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_main_menu_lr_gap', array(
        'section' => 'fixhero_main_menu_setting',
        'label' => esc_html__('Menu Item Left/Right Gap', 'fixhero'),
		'description' => esc_html__('For example 10px', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_main_menu_lr_gap',
    ));
    //End container size

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_8', 
			array(
				'settings'		=> 'main_menu_hr_8',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 
	
	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_top_gap',
        array(
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_main_menu_top_gap', array(
        'section' => 'fixhero_main_menu_setting',
        'label' => esc_html__('Menu Item Top Gap', 'fixhero'),
		'description' => esc_html__('For example 10px', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_main_menu_top_gap',
    ));
    //End container size

	//Start separator
	$fixhero_customizer->add_setting(
		'main_menu_hr_9', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'main_menu_hr_9', 
			array(
				'settings'		=> 'main_menu_hr_9',
				'section'  		=> 'fixhero_main_menu_setting',
			)
		)
	);
	//End separator 

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_main_menu_bottom_gap',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_main_menu_bottom_gap', array(
        'section' => 'fixhero_main_menu_setting',
        'label' => esc_html__('Menu Item Bottom Gap', 'fixhero'),
		'description' => esc_html__('For example 10px', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_main_menu_bottom_gap',
    ));
    //End container size

}