<?php
function fixhero_portfolio_panel($fixhero_customizer, $priority){
    $fixhero_customizer->add_section('fixhero_portfolio_setting', array(
        'title'    => esc_html__('Portfolio Settings', 'fixhero'),
        'priority' => $priority,
        'panel'    => 'fixhero_options_panel',
    ));

    //Start enabal
    $fixhero_customizer->add_setting('fixhero_enable_portfolio_page_banner',
    array(
        'default' => 0
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Customize_Switch_Control(
        $fixhero_customizer,
        'fixhero_enable_portfolio_page_banner',
        array(
            'type'        => 'switch',
            'label'       => esc_html__('Show Portfolio Page Banner', 'fixhero'),
            'description' => esc_html__('You can select banner show or hide', 'fixhero'),
            'section'     => 'fixhero_portfolio_setting',
        )
    )
    );
    //End enabal

    //Start separator
    $fixhero_customizer->add_setting(
    'portfolio_hr_00',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Separator_Control(
        $fixhero_customizer,
        'portfolio_hr_00',
        array(
            'settings' => 'portfolio_hr_00',
            'section' => 'fixhero_portfolio_setting',
        )
    )
    );
    //End separator

    //Start enabal
    $fixhero_customizer->add_setting('fixhero_enable_portfolio_breadcrumb',
    array(
        'default' => 0
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Customize_Switch_Control(
        $fixhero_customizer,
        'fixhero_enable_portfolio_breadcrumb',
        array(
            'type'        => 'switch',
            'label'       => esc_html__('Show Breadcrumb', 'fixhero'),
            'description' => esc_html__('You want to show breadcrumb click ON', 'fixhero'),
            'section'     => 'fixhero_portfolio_setting',
        )
    )
    );
    //End enabal

    //Start separator
    $fixhero_customizer->add_setting(
    'portfolio_hr_0',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Separator_Control(
        $fixhero_customizer,
        'portfolio_hr_0',
        array(
            'settings' => 'portfolio_hr_0',
            'section' => 'fixhero_portfolio_setting',
        )
    )
    );
    //End separator

    //Start default header logo
    $fixhero_customizer->add_setting(
    'fixhero_portfolio_banner_image',
    array(
        'transport' => 'refresh',
    )
    );
    $fixhero_customizer->add_control(
    new WP_Customize_Image_Control(
        $fixhero_customizer,
        'fixhero_portfolio_banner_image',
        array(
            'label'    => esc_html__('Portfolio Single Page Banner Image', 'fixhero'),
            'section'  => 'fixhero_portfolio_setting',
            'settings' => 'fixhero_portfolio_banner_image',
        )
    )
    );
    //End default logo

    //Start separator
    $fixhero_customizer->add_setting(
    'portfolio_hr_1',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Separator_Control(
        $fixhero_customizer,
        'portfolio_hr_1',
        array(
            'settings' => 'portfolio_hr_1',
            'section' => 'fixhero_portfolio_setting',
        )
    )
    );
    //End separator

    //Start Body Background Color
    $fixhero_customizer->add_setting(
    'fixhero_portfolio_bg_color'
    );
    $fixhero_customizer->add_control(
    new WP_Customize_Color_Control(
        $fixhero_customizer,
        'fixhero_portfolio_bg_color',
        array(
            'label'       => esc_html__('Sinlge Portfolio Body Backgroud Color', 'fixhero'),
            'description' => esc_html__('Pick body background color', 'fixhero'),
            'section'     => 'fixhero_portfolio_setting',
            'settings'    => 'fixhero_portfolio_bg_color',
        )
    )
    );
    //End Body Background Color

    //Start separator
    $fixhero_customizer->add_setting(
    'portfolio_hr_2',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Separator_Control(
        $fixhero_customizer,
        'portfolio_hr_2',
        array(
            'settings' => 'portfolio_hr_2',
            'section' => 'fixhero_portfolio_setting',
        )
    )
    );
    //End separator

    //Start Logo Height
    $fixhero_customizer->add_setting(
    'fixhero_portfolio_banner_title',
    array(
        'transport' => 'refresh',
    )
    );
    $fixhero_customizer->add_control('fixhero_portfolio_banner_title', array(
    'section' => 'fixhero_portfolio_setting',
    'label'   => esc_html__('Portfolio Single Banner Title', 'fixhero'),
    'type'    => 'text',
    'setting' => 'fixhero_portfolio_banner_title',
    ));
    //End Logo Height

    //Start separator
    $fixhero_customizer->add_setting(
    'portfolio_hr_04',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_html',
    )
    );
    $fixhero_customizer->add_control(
    new fixhero_Separator_Control(
        $fixhero_customizer,
        'portfolio_hr_04',
        array(
            'settings' => 'portfolio_hr_04',
            'section' => 'fixhero_portfolio_setting',
        )
    )
    );
    //End separator

    //Start
    $fixhero_customizer->add_setting(
    'fixhero_portfolio_banner_text',
    array(
        'transport' => 'refresh',
    )
    );
    $fixhero_customizer->add_control('fixhero_portfolio_banner_text', array(
    'section' => 'fixhero_portfolio_setting',
    'label'   => esc_html__('Portfolio Single Banner Text', 'fixhero'),
    'type'    => 'textarea',
    'setting' => 'fixhero_portfolio_banner_text',
    ));
    //End
}
