<?php
function fixhero_sticky_style_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_sticky_style_setting', array(
        'title' => esc_html__('Sticky Menu Settings', 'fixhero'),
        'priority' => $priority,
        'panel' => 'fixhero_options_panel',
    ));

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_bg_color',
            array(
                'label' => esc_html__('Sticky Menu Background Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_0',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_0',
            array(
                'label' => esc_html__('Menu', 'fixhero'),
                'settings' => 'sticky_menu_hr_0',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_text_color',
            array(
                'label' => esc_html__('Menu Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_1',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_1',
            array(
                'settings' => 'sticky_menu_hr_1',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_text_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_text_hover_color',
            array(
                'label' => esc_html__('Menu Hover Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_text_hover_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_2',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_2',
            array(
                'settings' => 'sticky_menu_hr_2',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_text_archive_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_text_archive_color',
            array(
                'label' => esc_html__('Menu Active Color', 'fixhero'),
                'description' => esc_html__('Pick color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_text_archive_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_3',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_3',
            array(
                'settings' => 'sticky_menu_hr_3',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_dropdown_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_dropdown_bg_color',
            array(
                'label' => esc_html__('Dropdown Menu Background Color', 'fixhero'),
                'description' => esc_html__('Pick bg color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_dropdown_bg_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_4',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_4',
            array(
                'settings' => 'sticky_menu_hr_4',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_dropdown_text_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_dropdown_text_color',
            array(
                'label' => esc_html__('Dropdown Menu Color', 'fixhero'),
                'description' => esc_html__('Pick text color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_dropdown_text_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_5',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_5',
            array(
                'settings' => 'sticky_menu_hr_5',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_dropdown_hover_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_dropdown_hover_color',
            array(
                'label' => esc_html__('Dropdown Menu Hover Color', 'fixhero'),
                'description' => esc_html__('Pick text color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_dropdown_hover_color',
            )
        )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_6',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_6',
            array(
                'settings' => 'sticky_menu_hr_6',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start
    $fixhero_customizer->add_setting(
        'fixhero_sticky_menu_dropdown_hover_bg_color'
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_menu_dropdown_hover_bg_color',
            array(
                'label' => esc_html__('Dropdown Menu Hover Background Color', 'fixhero'),
                'description' => esc_html__('Pick text color', 'fixhero'),
                'section' => 'fixhero_sticky_style_setting',
                'settings' => 'fixhero_sticky_menu_dropdown_hover_bg_color',
            )
        )
    );
    //End

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_7',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_7',
            array(
                'settings' => 'sticky_menu_hr_7',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_sign_in_text_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_sign_in_text_color',
            array(
                'label'      => esc_html__('Text Color','fixhero'),
                'description'      => esc_html__('Select Text Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_sign_in_text_color',
            )
        )
    );
	//End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_8',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_8',
            array(
                'settings' => 'sticky_menu_hr_8',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_sign_in_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_sign_in_text_hover_color',
            array(
                'label'      => esc_html__('Hover Color','fixhero'),
                'description'      => esc_html__('Select Hover Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_sign_in_text_hover_color',
            )
        )
    );
	//End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_9',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_9',
            array(
                'settings' => 'sticky_menu_hr_9',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_download_border_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_download_border_color',
            array(
                'label'      => esc_html__('Button Border Color','fixhero'),
                'description'      => esc_html__('Select Button Border Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_download_border_color',
            )
        )
    );
	//End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_10',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_10',
            array(
                'settings' => 'sticky_menu_hr_10',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_download_text_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_download_text_color',
            array(
                'label'      => esc_html__('Button Link Color','fixhero'),
                'description'      => esc_html__('Select text Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_download_text_color',
            )
        )
    );
	//End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_11',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_11',
            array(
                'settings' => 'sticky_menu_hr_11',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
    $fixhero_customizer->add_setting (
        'fixhero_sticky_download_text_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_download_text_hover_color',
            array(
                'label'      => esc_html__('Button Link Hover Color','fixhero'),
                'description'      => esc_html__('Select Text Hover Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_download_text_hover_color',
            )
        )
    );
    //End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_12',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_12',
            array(
                'settings' => 'sticky_menu_hr_12',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator
    
    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_download_btn_bg_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_download_btn_bg_color',
            array(
                'label'      => esc_html__('Button Background Color','fixhero'),
                'description'      => esc_html__('Select Button Hover Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_download_btn_bg_color',
            )
        )
    );
	//End Color

    //Start separator
    $fixhero_customizer->add_setting(
        'sticky_menu_hr_13',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'sticky_menu_hr_13',
            array(
                'settings' => 'sticky_menu_hr_13',
                'section' => 'fixhero_sticky_style_setting',
            )
        )
    );
    //End separator

    //Start Color
	$fixhero_customizer->add_setting (
        'fixhero_sticky_download_btn_hover_color',
        array(
            'default'     => ''
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_sticky_download_btn_hover_color',
            array(
                'label'      => esc_html__('Button Background Hover Color','fixhero'),
                'description'      => esc_html__('Select Button Hover Color','fixhero'),
                'section'    => 'fixhero_sticky_style_setting',
                'settings'   => 'fixhero_sticky_download_btn_hover_color',
            )
        )
    );
	//End Color
}
