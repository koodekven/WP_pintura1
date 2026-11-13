<?php
function fixhero_mouse_pointer_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_mouse_pt_setting', array(
        'title' => esc_html__('Mouse Pointer Setting', 'fixhero'),
        'priority' => $priority,
        'panel' => 'fixhero_options_panel',
    ));

    //Start enabal global setting
    $fixhero_customizer->add_setting('fixhero_mouse_pt_enabel_pointer',
        array(
            'default' => '1',
            'sanitize_callback' => 'fixhero_sanitize_integer',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Customize_Switch_Control(
            $fixhero_customizer,
            'fixhero_mouse_pt_enabel_pointer',
            array(
                'type' => 'switch',
                'label' => esc_html__('Show Pointer', 'fixhero'),
                'description' => esc_html__('You can show or hide Mouse Pointer', 'fixhero'),
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End enabal global setting

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_0',
            array(
                'settings' => 'mouse_pt_hr_0',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_mouse_pt_pointer_border_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_mouse_pt_pointer_border_color',
            array(
                'label' => esc_html__('Pointer Border', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_mouse_pt_setting',
                'settings' => 'fixhero_mouse_pt_pointer_border_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_1',
            array(
                'settings' => 'mouse_pt_hr_1',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_mouse_pt_border_width',
        array(
            'default' => esc_html__('2', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_mouse_pt_border_width', array(
        'section' => 'fixhero_mouse_pt_setting',
        'label' => esc_html__('Border Width', 'fixhero'),
        'description' => esc_html__('Enter Pointer Border Width', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_mouse_pt_border_width',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_2',
            array(
                'settings' => 'mouse_pt_hr_2',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_mouse_pt_pointer_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_mouse_pt_pointer_bg_color',
            array(
                'label' => esc_html__('Pointer Background', 'fixhero'),
                'description' => esc_html__('Enter Pointer Background color', 'fixhero'),
                'section' => 'fixhero_mouse_pt_setting',
                'settings' => 'fixhero_mouse_pt_pointer_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_4',
            array(
                'settings' => 'mouse_pt_hr_4',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator	

	//Start container size
	$fixhero_customizer->add_setting(
		'fixhero_mouse_pt_diameter',
		array(
			'default' => esc_html__('40', 'fixhero'),
			'transport' => 'refresh',
		)
	);

	$fixhero_customizer->add_control('fixhero_mouse_pt_diameter', array(
		'section' => 'fixhero_mouse_pt_setting',
		'label' => esc_html__('Diameter', 'fixhero'),
		'description' => esc_html__('Enter Pointer diameter Size', 'fixhero'),
		'type' => 'text',
		'setting' => 'fixhero_mouse_pt_diameter',
	));
	//End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_5',
            array(
                'settings' => 'mouse_pt_hr_5',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator	

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_mouse_pt_pointer_speed',
        array(
            'default' => esc_html__('4', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_mouse_pt_pointer_speed', array(
        'section' => 'fixhero_mouse_pt_setting',
        'label' => esc_html__('Pointer Speed', 'fixhero'),
        'description' => esc_html__('Enter Pointer Scale Size', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_mouse_pt_pointer_speed',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_6',
            array(
                'settings' => 'mouse_pt_hr_6',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator

	//Start container size
    $fixhero_customizer->add_setting(
        'fixhero_mouse_pt_hover_scale',
        array(
            'default' => esc_html__('1.3', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_mouse_pt_hover_scale', array(
        'section' => 'fixhero_mouse_pt_setting',
        'label' => esc_html__('Hover Scale', 'fixhero'),
        'description' => esc_html__('Enter Pointer Scale Size', 'fixhero'),
        'type' => 'text',
        'setting' => 'fixhero_mouse_pt_hover_scale',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'mouse_pt_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'mouse_pt_hr_7',
            array(
                'settings' => 'mouse_pt_hr_7',
                'section' => 'fixhero_mouse_pt_setting',
            )
        )
    );
    //End separator

}
