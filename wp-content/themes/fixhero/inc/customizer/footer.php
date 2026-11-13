<?php
function fixhero_footer_panel( $fixhero_customizer, $prioriity ){
    $fixhero_customizer->add_section( 'fixhero_footer_options', 
    array(
        'title'       => esc_html__( 'Footer Settings', 'fixhero' ),
        'panel'		  =>'fixhero_options_panel',			
        'priority'    => $prioriity,
        'capability'  => 'edit_theme_options', 
    ) 
    );

    //Start default footer BG
	$fixhero_customizer->add_setting(
		'fixhero_footer_logo', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_footer_logo',
			array(
			'label'      => esc_html__( 'Upload Default Logo', 'fixhero' ),
			'section'    => 'fixhero_footer_options',
			'settings'   => 'fixhero_footer_logo',
			)
		)   
	);
	//End default footer BG

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_0', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_0', 
			array(
				'settings'		=> 'footer_hr_0',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

    //Start Footer Background Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_bg_color',
            array(
                'label'      => esc_html__('Footer Background Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_bg_color',
            )
        )
    );
	//End Footer Background Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_1', 
			array(
				'settings'		=> 'footer_hr_1',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Text Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_text_color',
            array(
                'label'      => esc_html__('Footer Text Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_text_color',
            )
        )
    );
	//End Footer Text Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_2', 
			array(
				'settings'		=> 'footer_hr_2',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Title Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_title_color',
		array(
			'transport'		=> 'refresh'
			)
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_title_color',
            array(
                'label'      => esc_html__('Footer Title Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_title_color',
            )
        )
    );
	//End Footer Title Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_3', 
			array(
				'settings'		=> 'footer_hr_3',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Link Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_link_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_link_color',
            array(
                'label'      => esc_html__('Footer Link Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_link_color',
            )
        )
    );
	//End Footer Link Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_4', 
			array(
				'settings'		=> 'footer_hr_4',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Link Hover Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_link_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_link_hover_color',
            array(
                'label'      => esc_html__('Footer Link Hover Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_link_hover_color',
            )
        )
    );
	//End Footer Link Hover Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_5', 
			array(
				'settings'		=> 'footer_hr_5',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button BG Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_button_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_button_text_color',
            array(
                'label'      => esc_html__('Footer Button Text Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_button_text_color',
            )
        )
    );
	//End Footer Button BG Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_6', 
			array(
				'settings'		=> 'footer_hr_6',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button BG Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_button_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_button_bg_color',
            array(
                'label'      => esc_html__('Footer Button Background Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_button_bg_color',
            )
        )
    );
	//End Footer Button BG Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_7', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_7', 
			array(
				'settings'		=> 'footer_hr_7',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//Start Footer Button Hover Color
	$fixhero_customizer->add_setting (
        'fixhero_footer_button_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_footer_button_hover_color',
            array(
                'label'      => esc_html__('Footer Button Hover Color','fixhero'),
                'section'    => 'fixhero_footer_options',
                'settings'   => 'fixhero_footer_button_hover_color',
            )
        )
    );
	//End Footer Button Hover Color

	//Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_8', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_8', 
			array(
				'settings'		=> 'footer_hr_8',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

    //Start footer logo size
	 $fixhero_customizer->add_setting(
		'fixhero_footer_logo_size',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('fixhero_footer_logo_size', array(
        'section'	=> 'fixhero_footer_options',
        'label'		=> esc_html__( 'Logo Size', 'fixhero' ),
        'description'=> esc_html__( 'Logo max height example(50px)', 'fixhero' ),
        'type'		=> 'text',
        'setting'	=> 'fixhero_footer_logo_size'
    ));
	//End footer logo size

    //Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_10', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_10', 
			array(
				'settings' => 'footer_hr_10',
				'section'  => 'fixhero_footer_options',
			)
		)
	);
	//End separator

    //footer Link
    $fixhero_customizer->add_setting('footer_link', array(
        'default'		=> '#',
        'transport'		=> 'refresh',
    ));
    $fixhero_customizer->add_control('footer_link', array(
        'section' 		=> 'fixhero_footer_options',
        'label'		 	=> esc_html__( 'Custom Link', 'fixhero' ),
        'type'		  	=> 'text',
        'setting' 		=> 'footer_link'
    ));

    //Start separator
	$fixhero_customizer->add_setting(
		'footer_hr_11', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'footer_hr_11', 
			array(
				'settings'		=> 'footer_hr_11',
				'section'  		=> 'fixhero_footer_options',
			)
		)
	);
	//End separator

	//footer copyright
	$fixhero_customizer->add_setting('fixhero_footer_copyright', array(
		'transport'		=> 'refresh',
	));
	$fixhero_customizer->add_control('fixhero_footer_copyright', array(
		'section'	=> 'fixhero_footer_options',
		'label'		=> esc_html__( 'Copyright', 'fixhero' ),
		'type'		=> 'textarea',
		'setting'	=> 'fixhero_footer_copyright'	
	));

}
