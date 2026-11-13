<?php
function fixhero_social_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_social_setting', 
		array(
			'title'       => esc_html__( 'Social Icons', 'fixhero' ),
			'panel'		  =>'fixhero_options_panel',			
			'priority'    => $priority, 
			'capability'  => 'edit_theme_options',
			'description' => esc_html__('Allows you to customize social icons.', 'fixhero'), 
		) 
	);

    // Facebook
    $fixhero_customizer->add_setting( 'fixhero_facebook' , array(
        'transport'   => 'refresh',
    ) );
    $fixhero_customizer->add_control('fixhero_facebook', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Facebook', 'fixhero' ),
        'setting'		=> 'fixhero_facebook'
    ));		
    // Twitter
    $fixhero_customizer->add_setting( 'fixhero_twitter' , array(
    'transport'   => 'refresh',
    ) );
    $fixhero_customizer->add_control('fixhero_twitter', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Twitter', 'fixhero' ),
        'setting'		=> 'fixhero_twitter'
    ));
    // instagram
    $fixhero_customizer->add_setting('fixhero_instagram', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_instagram', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Instagram', 'fixhero' ),
        'setting'		=> 'fixhero_instagram'
    ));
    // soundcloud
    $fixhero_customizer->add_setting('fixhero_soundcloud', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_soundcloud', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Soundcloud', 'fixhero' ),
        'setting'		=> 'fixhero_soundcloud'
    ));
    //  YouTube
    $fixhero_customizer->add_setting('fixhero_youtube', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_youtube', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'YouTube', 'fixhero' ),
        'setting'		=> 'fixhero_youtube'
    ));
    // linkedin
    $fixhero_customizer->add_setting('fixhero_linkedin', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_linkedin', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Linkedin', 'fixhero' ),
        'setting'		=> 'fixhero_linkedin'
    ));
    // vimeo
    $fixhero_customizer->add_setting('fixhero_vimeo', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_vimeo', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Vimeo', 'fixhero' ),
        'setting'		=> 'fixhero_vimeo'
    ));
    //  pinterest-p
    $fixhero_customizer->add_setting('fixhero_pinterest', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_pinterest', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Pinterest', 'fixhero' ),
        'setting'		=> 'fixhero_pinterest'
    ));
    // tumblr
    $fixhero_customizer->add_setting('fixhero_tumblr', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_tumblr', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Tumblr', 'fixhero' ),
        'setting'		=> 'fixhero_tumblr'
    ));
    // flickr
    $fixhero_customizer->add_setting('fixhero_flickr', array(
        'transport'		=> 'refresh'
    ));
    $fixhero_customizer->add_control('fixhero_flickr', array(
        'section'		=> 'fixhero_social_setting',
        'label'			=> esc_html__( 'Flickr', 'fixhero' ),
        'setting'		=> 'fixhero_flickr'
    ));
}