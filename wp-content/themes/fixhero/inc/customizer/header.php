<?php
function fixhero_header_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_header_setting' , array(
        'title'      => esc_html__( 'Header Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_header_sign_in_text',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_header_sign_in_text', array(
        'section' => 'fixhero_header_setting',
        'label'   => esc_html__('Sign In', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_header_sign_in_text',
    ));
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_0', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_0', 
			array(
				'settings'		=> 'header_hr_0',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_sign_in_text_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_sign_in_text_color',
            array(
                'label'       => esc_html__('Text Color','fixhero'),
                'description' => esc_html__('Select Text Color','fixhero'),
                'section'     => 'fixhero_header_setting',
                'settings'    => 'fixhero_header_sign_in_text_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_1', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_1', 
			array(
				'settings'		=> 'header_hr_1',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_sign_in_text_hover_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_sign_in_text_hover_color',
            array(
                'label'       => esc_html__('Hover Color','fixhero'),
                'description' => esc_html__('Select Hover Color','fixhero'),
                'section'     => 'fixhero_header_setting',
                'settings'    => 'fixhero_header_sign_in_text_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_2', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_2', 
			array(
				'settings'		=> 'header_hr_2',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_header_sign_in_link',
        array(
			'default' => esc_html__( '#', 'fixhero' ),
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_header_sign_in_link', array(
        'section' => 'fixhero_header_setting',
        'label'   => esc_html__('Sign In Link', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_header_sign_in_link',
    ));
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_3', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_3', 
			array(
				'settings'		=> 'header_hr_3',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting( 'fixhero_header_sign_in_link_new_tab', 
	array(
		'default'    => '1',
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_header_sign_in_link_new_tab',
			array(
				'type'        => 'switch',
				'label'       => esc_html__('Open New Tab','fixhero'),
				'description' => esc_html__('Open the link document in a new window or tab','fixhero'),
				'section'     => 'fixhero_header_setting'
			)
		)
	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_4', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_4', 
			array(
				'settings'		=> 'header_hr_4',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_header_download_text',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_header_download_text', array(
        'section' => 'fixhero_header_setting',
        'label'   => esc_html__('Download', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_header_download_text',
    ));
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_5', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_5', 
			array(
				'settings'		=> 'header_hr_5',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_download_border_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_download_border_color',
            array(
                'label'      => esc_html__('Border Color','fixhero'),
                'description'      => esc_html__('Select Button Border Color','fixhero'),
                'section'    => 'fixhero_header_setting',
                'settings'   => 'fixhero_header_download_border_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_6', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_6', 
			array(
				'settings'		=> 'header_hr_6',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_download_text_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_download_text_color',
            array(
                'label'      => esc_html__('Text Color','fixhero'),
                'description'      => esc_html__('Select text Color','fixhero'),
                'section'    => 'fixhero_header_setting',
                'settings'   => 'fixhero_header_download_text_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_7', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_7', 
			array(
				'settings'		=> 'header_hr_7',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_download_text_hover_color',
            array(
                'label'      => esc_html__('Text Hover Color','fixhero'),
                'description'      => esc_html__('Select Text Hover Color','fixhero'),
                'section'    => 'fixhero_header_setting',
                'settings'   => 'fixhero_header_download_text_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_8', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_8', 
			array(
				'settings'		=> 'header_hr_8',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Color
	$fixhero_customizer->add_setting (
        'fixhero_header_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_header_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Hover Color','fixhero'),
                'description'      => esc_html__('Select Button Hover Color','fixhero'),
                'section'    => 'fixhero_header_setting',
                'settings'   => 'fixhero_header_download_btn_hover_color',
            )
        )
    );
	//End Color

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_9', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_9', 
			array(
				'settings'		=> 'header_hr_9',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start
    $fixhero_customizer->add_setting(
        'fixhero_header_download_link',
        array(
            'default' => esc_html__( '#', 'fixhero' ),
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_header_download_link', array(
        'section' => 'fixhero_header_setting',
        'label' => esc_html__('Download Link', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_header_download_link',
    ));
    //End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_10', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_10', 
			array(
				'settings'		=> 'header_hr_10',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Show Top Bar
	$fixhero_customizer->add_setting( 'fixhero_header_download_link_new_tab', 
	array(
		'default'    => '1',
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_header_download_link_new_tab',
			array(
				'type' => 'switch',
				'label' => esc_html__('Open New Tab','fixhero'),
				'description' => esc_html__('Open the link document in a new window or tab','fixhero'),
				'section' => 'fixhero_header_setting'
			)
		)
	);
	//End Show Top Bar

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_11', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_11', 
			array(
				'settings'		=> 'header_hr_11',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Meta Text Alignment
	$fixhero_customizer->add_setting( 'fixhero_header_width', array(
		'default'           => 'container',
		'transport'	        => 'postMessage',
	) );
	$fixhero_customizer->add_control( 'fixhero_header_width', array(
		'label'   => esc_html__( 'Header Area Width', 'fixhero' ),
		'section' => 'fixhero_header_setting',
		'type'    => 'select',
		'choices' => array(
			'container' => esc_html__( 'Container', 'fixhero' ),
			'container-fluid' => esc_html__( 'Container Fluid', 'fixhero' ),
			),
	));
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'header_hr_12', 
		array(
			'default'           => '',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'header_hr_12', 
			array(
				'settings'		=> 'header_hr_12',
				'section'  		=> 'fixhero_header_setting',
			)
		)
	);
	//End separator

	//Start Header Bg Color
	$fixhero_customizer->add_setting (
        'fixhero_style_header_bg_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_style_header_bg_color',
            array(
                'label'      => esc_html__('Header Bg Color','fixhero'),
                'description'      => esc_html__('Select Header Bg Color','fixhero'),
                'section'    => 'fixhero_header_setting',
                'settings'   => 'fixhero_style_header_bg_color',
            )
        )
    );
	//End Header Bg Color
}