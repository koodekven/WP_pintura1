<?php
function fixhero_scroll_bar_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_scroll_bar_setting', array(
        'title'    => esc_html__('Scroll Bar Setting', 'fixhero'),
        'priority' => $priority,
        'panel'    => 'fixhero_options_panel',
    ));

    //Start enabal global setting
    $fixhero_customizer->add_setting('fixhero_scroll_bar_enabel',
        array(
            'default' => '1',
            'sanitize_callback' => 'fixhero_sanitize_integer',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Customize_Switch_Control(
            $fixhero_customizer,
            'fixhero_scroll_bar_enabel',
            array(
                'type'        => 'switch',
                'label'       => esc_html__('Show ScrollBar', 'fixhero'),
                'description' => esc_html__('You can show or hide ScrollBar', 'fixhero'),
                'section'     => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End enabal global setting

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_0',
            array(
                'settings' => 'scroll_bar_hr_0',
                'section'  => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_color',
        array(
            'default' => '#6722B5',
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_bar_color',
            array(
                'label'       => esc_html__('ScrollBar Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section'     => 'fixhero_scroll_bar_setting',
                'settings'    => 'fixhero_scroll_bar_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_1',
            array(
                'settings' => 'scroll_bar_hr_1',
                'section'  => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_rail_bg',
        array(
            'default' => '#000000',
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_scroll_bar_rail_bg',
            array(
                'label'       => esc_html__('Rail Background', 'fixhero'),
                'description' => esc_html__('Enter Rail Background color', 'fixhero'),
                'section'     => 'fixhero_scroll_bar_setting',
                'settings'    => 'fixhero_scroll_bar_rail_bg',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_3',
            array(
                'settings' => 'scroll_bar_hr_3',
                'section'  => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_cursor_width',
        array(
            'default' => esc_html__('14', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_scroll_bar_cursor_width', array(
        'section'     => 'fixhero_scroll_bar_setting',
        'label'       => esc_html__('Cursor Width', 'fixhero'),
        'description' => esc_html__('Enter Cursor Width', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_scroll_bar_cursor_width',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_4',
            array(
                'settings' => 'scroll_bar_hr_4',
                'section' => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_cursor_min_width',
        array(
            'default' => esc_html__('120', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_scroll_bar_cursor_min_width', array(
        'section'     => 'fixhero_scroll_bar_setting',
        'label'       => esc_html__('Cursor Min Height', 'fixhero'),
        'description' => esc_html__('Enter Cursor Min Height', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_scroll_bar_cursor_min_width',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_5',
            array(
                'settings' => 'scroll_bar_hr_5',
                'section' => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_cursor_scroll_speed',
        array(
            'default' => esc_html__('60', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_scroll_bar_cursor_scroll_speed', array(
        'section'     => 'fixhero_scroll_bar_setting',
        'label'       => esc_html__('Scroll Speed', 'fixhero'),
        'description' => esc_html__('Enter Scroll Speed', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_scroll_bar_cursor_scroll_speed',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_6',
            array(
                'settings' => 'scroll_bar_hr_6',
                'section' => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

    //Start container size
    $fixhero_customizer->add_setting(
        'fixhero_scroll_bar_cursor_scroll_step',
        array(
            'default' => esc_html__('110', 'fixhero'),
            'transport' => 'refresh',
        )
    );

    $fixhero_customizer->add_control('fixhero_scroll_bar_cursor_scroll_step', array(
        'section'     => 'fixhero_scroll_bar_setting',
        'label'       => esc_html__('Mouse Scroll Step', 'fixhero'),
        'description' => esc_html__('Enter Mouse Scroll Step', 'fixhero'),
        'type'        => 'text',
        'setting'     => 'fixhero_scroll_bar_cursor_scroll_step',
    ));
    //End container size

    //Start separator
    $fixhero_customizer->add_setting(
        'scroll_bar_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'scroll_bar_hr_7',
            array(
                'settings' => 'scroll_bar_hr_7',
                'section'  => 'fixhero_scroll_bar_setting',
            )
        )
    );
    //End separator

}
