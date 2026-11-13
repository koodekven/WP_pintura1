<?php
function fixhero_breadcrumb_style_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_breadcrumb_style_setting', array(
        'title' => esc_html__('Breadcrumb Settings', 'fixhero'),
        'priority' => $priority,
        'panel' => 'fixhero_options_panel',
    ));

    //Start Hide
	$fixhero_customizer->add_setting( 'fixhero_page_hide_banner', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_page_hide_banner',
			array(
				'type' => 'switch',
				'label' => esc_html__('Hide Banner','fixhero'),
				'description' => esc_html__('You can show or hide ','fixhero'),
				'section' => 'fixhero_breadcrumb_style_setting'
			)
		)
	);
	//End Hide

    //Start separator
    $fixhero_customizer->add_setting(
        'breadcrumb_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'breadcrumb_hr_0',
            array(
                'settings' => 'breadcrumb_hr_0',
                'section' => 'fixhero_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Hide
	$fixhero_customizer->add_setting( 'fixhero_page_hide_breadcrumb', 
	array(
		'default'    => 0,
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_page_hide_breadcrumb',
			array(
				'type' => 'switch',
				'label' => esc_html__('Show Breadcrumb','fixhero'),
				'description' => esc_html__('You want to show breadcrumb click ON','fixhero'),
				'section' => 'fixhero_breadcrumb_style_setting'
			)
		)
	);
	//End Hide

    //Start separator
    $fixhero_customizer->add_setting(
        'breadcrumb_hr_110',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'breadcrumb_hr_110',
            array(
                'settings' => 'breadcrumb_hr_110',
                'section' => 'fixhero_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_breadcrumb_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_breadcrumb_bg_color',
            array(
                'label' => esc_html__('Backgroud Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_breadcrumb_style_setting',
                'settings' => 'fixhero_breadcrumb_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'breadcrumb_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'breadcrumb_hr_1',
            array(
                'settings' => 'breadcrumb_hr_1',
                'section' => 'fixhero_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start default Page Banner
	$fixhero_customizer->add_setting(
		'fixhero_page_banner', 
		array(
		'transport'		=> 'refresh'
		)
	);
	$fixhero_customizer->add_control(
		new WP_Customize_Image_Control(
		$fixhero_customizer,
		'fixhero_page_banner',
			array(
			'label'      => esc_html__( 'Page Banner', 'fixhero' ),
			'section'    => 'fixhero_breadcrumb_style_setting',
			'settings'   => 'fixhero_page_banner',
			)
		)   
	);
	//End default Page Banner

    //Start separator
    $fixhero_customizer->add_setting(
        'breadcrumb_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'breadcrumb_hr_2',
            array(
                'settings' => 'breadcrumb_hr_2',
                'section' => 'fixhero_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Blog Page Custom Title
	$fixhero_customizer->add_setting(
		'fixhero_page_custom_title',
		array(
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('fixhero_page_custom_title', array(
        'section'	=> 'fixhero_breadcrumb_style_setting',
        'label'		=> esc_html__( 'Page Custom Title', 'fixhero' ),
        'description' => esc_html__( 'Enter Page Title Here', 'fixhero' ),
        'type'		=> 'text',
        'setting'	=> 'fixhero_page_custom_title'
    ));
	//End Blog Page Custom Title

    //Start separator
    $fixhero_customizer->add_setting(
        'breadcrumb_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'breadcrumb_hr_3',
            array(
                'settings' => 'breadcrumb_hr_3',
                'section' => 'fixhero_breadcrumb_style_setting',
            )
        )
    );
    //End separator

    //Start Blog Page Custom Description
	$fixhero_customizer->add_setting(
		'fixhero_page_custom_description',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_page_custom_description', array(
        'section'	=> 'fixhero_breadcrumb_style_setting',
        'label'		=> esc_html__( 'Page Banner Description', 'fixhero' ),
        'description' => esc_html__( 'Enter Page Description Here', 'fixhero' ),
        'type'		=> 'textarea',
        'setting'	=> 'fixhero_page_custom_description'
    ));
	//End Blog Page Custom Description

}
