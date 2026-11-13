<?php
function fixhero_team_panel($fixhero_customizer, $priority){
    $fixhero_customizer->add_section('fixhero_slug_setting', array(
        'title'    => esc_html__('Post Type URL Change Settings', 'fixhero'),
        'priority' => $priority,
        'panel'    => 'fixhero_options_panel',
    ));

    //Start Portfolio Slug
    $fixhero_customizer->add_setting(
        'fixhero_portfolio_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_portfolio_slug', array(
        'section' => 'fixhero_slug_setting',
        'label'   => esc_html__('Portfolio Slug Change', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_portfolio_slug',
    ));
    //End Portfolio Slug


    //Start Team Slug
    $fixhero_customizer->add_setting(
        'fixhero_team_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_team_slug', array(
        'section' => 'fixhero_slug_setting',
        'label'   => esc_html__('Team Slug Change', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_team_slug',
    ));
    //End Team Slug

    //Start Testimonial Slug
    $fixhero_customizer->add_setting(
        'fixhero_service_slug',
        array(
            'transport' => 'refresh',
        )
    );
    $fixhero_customizer->add_control('fixhero_service_slug', array(
        'section' => 'fixhero_slug_setting',
        'label'   => esc_html__('Service Slug Change', 'fixhero'),
        'type'    => 'text',
        'setting' => 'fixhero_service_slug',
    ));
    //End Testimonial Slug

}
