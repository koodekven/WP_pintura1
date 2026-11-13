<?php
function fixhero_custom_fonts_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_custom_fonts_panel', array(
        'title'    => esc_html__('Custom Fonts Settings', 'fixhero'),
        'priority' => $priority,
        'panel'    => 'fixhero_options_panel',
    ));

    $font_weight = [
        'normal' => esc_html__('Normal', 'fixhero' ),
        '300' => esc_html__('300', 'fixhero' ),
        '400' => esc_html__('400', 'fixhero' ),
        '500' => esc_html__('500', 'fixhero' ),
        '600' => esc_html__('600', 'fixhero' ),
        '700' => esc_html__('700', 'fixhero' ),
        '800' => esc_html__('800', 'fixhero' ),
        '900' => esc_html__('900', 'fixhero' ),
    ];

    //Start
    $fixhero_customizer->add_setting(
        'fixhero_custom_font_file', 
        array(
        'transport'     => 'refresh'
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Upload_Control(
        $fixhero_customizer,
        'fixhero_custom_font_file',
            array(
            'label'      => esc_html__( 'Upload Body Font Here', 'fixhero' ),
            'section'    => 'fixhero_custom_fonts_panel',
            'settings'   => 'fixhero_custom_font_file',
            )
        )   
    );
    //End

    //Start
    $fixhero_customizer->add_setting( 'fixhero_custom_body_font_weight', array(
        'default' => 'normal'
    ));

    $fixhero_customizer->add_control( 'fixhero_custom_body_font_weight', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Font Weight', 'fixhero' ),
        'description' => __( 'Select font Weight', 'fixhero' ),
        'section'     => 'fixhero_custom_fonts_panel',
        'choices'     => $font_weight
    ));
    //End

    //Start separator
    $fixhero_customizer->add_setting(
        'separator_1', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer, 
            'separator_15', 
            array(
                'settings'      => 'separator_1',
                'section'       => 'fixhero_custom_fonts_panel',
            )
        )
    );
    //End separator

    //Start
    $fixhero_customizer->add_setting(
        'fixhero_title_custom_font_file', 
        array(
        'transport'     => 'refresh'
        )
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Upload_Control(
        $fixhero_customizer,
        'fixhero_title_custom_font_file',
            array(
            'label'      => esc_html__( 'Upload Heading Font Here', 'fixhero' ),
            'section'    => 'fixhero_custom_fonts_panel',
            'settings'   => 'fixhero_title_custom_font_file',
            )
        )   
    );
    //End

    //Start
    $fixhero_customizer->add_setting( 'fixhero_custom_title_font_weight', array(
        'default' => 'normal'
    ));
    
    $fixhero_customizer->add_control( 'fixhero_custom_title_font_weight', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Font Weight', 'fixhero' ),
        'description' => __( 'Select font Weight', 'fixhero' ),
        'section'     => 'fixhero_custom_fonts_panel',
        'choices'     => $font_weight
    ));
    //End
}
