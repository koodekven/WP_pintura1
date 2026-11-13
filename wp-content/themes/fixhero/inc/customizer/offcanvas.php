<?php
function fixhero_offcanvas_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_offcanvas_pt_setting', array(
        'title' => esc_html__('Offcanvas Settings', 'fixhero'),
        'priority' => $priority,
        'panel' => 'fixhero_options_panel',
    ));


    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_over_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_over_bg_color',
            array(
                'label' => esc_html__('Offcanvas Overlay Bg', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_over_bg_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_0', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_0', 
            array(
                'settings'      => 'offcanvas_hr_0',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_bg_color',
            array(
                'label' => esc_html__('Offcanvas Bg', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_bg_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_1', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_1', 
            array(
                'settings'      => 'offcanvas_hr_1',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_text_color',
            array(
                'label' => esc_html__('Offcanvas Text Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_text_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_2', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_2', 
            array(
                'settings'      => 'offcanvas_hr_2',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_link_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_link_hover_color',
            array(
                'label' => esc_html__('Offcanvas Link Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_link_hover_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_3', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_3', 
            array(
                'settings'      => 'offcanvas_hr_3',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_icon_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_icon_color',
            array(
                'label' => esc_html__('Offcanvas Icon Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_icon_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_4', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_4', 
            array(
                'settings'      => 'offcanvas_hr_4',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_close_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_close_bg_color',
            array(
                'label' => esc_html__('Offcanvas Close Bg Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_close_bg_color',
            )
        )
    );

    //Start separator
    $fixhero_customizer->add_setting(
        'offcanvas_hr_5', 
        array(
            'default'           => '',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'offcanvas_hr_5', 
            array(
                'settings'      => 'offcanvas_hr_5',
                'section'       => 'fixhero_offcanvas_pt_setting',
            )
        )
    );
    //End separator

    $fixhero_customizer->add_setting(
        'fixhero_offcanvas_close_icon_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_offcanvas_close_icon_color',
            array(
                'label' => esc_html__('Offcanvas Close Icon Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_offcanvas_pt_setting',
                'settings' => 'fixhero_offcanvas_close_icon_color',
            )
        )
    );

}
