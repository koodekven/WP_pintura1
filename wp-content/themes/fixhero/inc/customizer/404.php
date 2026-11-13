<?php
function fixhero_404_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_404_setting',
        array(
            'title'       => esc_html__('404 Page Settings', 'fixhero'),
            'panel'       => 'fixhero_options_panel',
            'priority'    => $priority,
            'capability'  => 'edit_theme_options',
            'description' => esc_html__('Allows you to customize 404 page.', 'fixhero'),
        )
    );

    //404
    $fixhero_customizer->add_setting('fixhero_404_title', array(
        'default'   => esc_html__('404', 'fixhero'),
        'transport' => 'refresh',
    ));
    $fixhero_customizer->add_control('fixhero_404_title', array(
        'label'       => esc_html__('Title', 'fixhero'),
        'description' => esc_html__('Enter title for 404 page', 'fixhero'),
        'section'     => 'fixhero_404_setting',
        'type'        => 'text',
        'setting'     => 'fixhero_404_title',
    ));

    //Start separator
    $fixhero_customizer->add_setting(
        '404_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            '404_hr_0',
            array(
                'settings' => '404_hr_0',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //404
    $fixhero_customizer->add_setting('fixhero_404_text', array(
        'default'   => esc_html__('Page Not Found', 'fixhero'),
        'transport' => 'refresh',
    ));
    $fixhero_customizer->add_control('fixhero_404_text', array(
        'label'       => esc_html__('Text', 'fixhero'),
        'description' => esc_html__('Enter text for 404 page', 'fixhero'),
        'section'     => 'fixhero_404_setting',
        'type'        => 'text',
        'setting'     => 'fixhero_404_text',
    ));
    //End

    //Start separator
    $fixhero_customizer->add_setting(
        '404_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            '404_hr_1',
            array(
                'settings' => '404_hr_1',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //404
    $fixhero_customizer->add_setting('fixhero_404_home_button_label', array(
        'default'   => esc_html__('Back to Homepage', 'fixhero'),
        'transport' => 'refresh',
    ));
    $fixhero_customizer->add_control('fixhero_404_home_button_label', array(
        'label'       => esc_html__('Back to Home Button Label', 'fixhero'),
        'description' => esc_html__('Enter label for "Back to Home" button', 'fixhero'),
        'section'     => 'fixhero_404_setting',
        'type'        => 'text',
        'setting'     => 'fixhero_404_home_button_label',
    ));
    //End

    //Start separator
    $fixhero_customizer->add_setting(
        '404_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            '404_hr_2',
            array(
                'settings' => '404_hr_2',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //Start default header logo
    $fixhero_customizer->add_setting(
        'fixhero_404_page_bg',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Image_Control(
            $fixhero_customizer,
            'fixhero_404_page_bg',
            array(
                'label'    => esc_html__('Upload 404 Page Bg', 'fixhero'),
                'section'  => 'fixhero_404_setting',
                'settings' => 'fixhero_404_page_bg',
            )
        )
    );
    //End default logo

    //Start separator
    $fixhero_customizer->add_setting(
        'team_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'team_hr_3',
            array(
                'settings' => 'team_hr_3',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_404_text_color',
        array(
            'default' => '#FFFFFF',
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_404_text_color',
            array(
                'label'       => esc_html__('Text Color', 'fixhero'),
                'description' => esc_html__('Text Color', 'fixhero'),
                'section'     => 'fixhero_404_setting',
                'settings'    => 'fixhero_404_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'team_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'team_hr_4',
            array(
                'settings' => 'team_hr_4',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //Start Color
    $fixhero_customizer->add_setting(
        'fixhero_404_btn_bg_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_404_btn_bg_color',
            array(
                'label'       => esc_html__('Button Background Color', 'fixhero'),
                'description' => esc_html__('choose button background color', 'fixhero'),
                'section'     => 'fixhero_404_setting',
                'settings'    => 'fixhero_404_btn_bg_color',
            )
        )
    );
    //End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'team_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'team_hr_5',
            array(
                'settings' => 'team_hr_5',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

    //Start Color
    $fixhero_customizer->add_setting(
        'fixhero_404_btn_text_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_404_btn_text_color',
            array(
                'label'       => esc_html__('Button Text Color', 'fixhero'),
                'description' => esc_html__('Choose button text color', 'fixhero'),
                'section'     => 'fixhero_404_setting',
                'settings'    => 'fixhero_404_btn_text_color',
            )
        )
    );
    //End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'team_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'team_hr_6',
            array(
                'settings' => 'team_hr_6',
                'section'  => 'fixhero_404_setting',
            )
        )
    );
    //End separator

}
