<?php
function fixhero_typography_panel( $fixhero_customizer, $priority ){
    $fixhero_customizer->add_section( 'fixhero_typography_setting' , array(
        'title'      => esc_html__( 'Typography Settings', 'fixhero' ),
        'priority'   => $priority,
        'panel'		 => 'fixhero_options_panel'
    ) );

	$rs_custom_fonts = get_terms([
		'taxonomy'   => 'rs_custom_fonts',
		'hide_empty' => false,
	]);


	$rs_custom_font_key = [];
	$rs_custom_font_val = [];
	if( is_array( $rs_custom_fonts ) ){
		foreach( $rs_custom_fonts as $rs_custom_font ){
			array_push( $rs_custom_font_key, $rs_custom_font->name );
			array_push( $rs_custom_font_val, $rs_custom_font->name );
		}
	}

	
	$font_choices_custom = array_combine( array_map(function($el) use ($rs_custom_font_val) {
		return $rs_custom_font_val[$el];
	}, array_keys($rs_custom_font_key)), array_values($rs_custom_font_key));


	if( is_array( $rs_custom_fonts ) && !empty( $rs_custom_fonts ) ){
		array_unshift( $font_choices_custom, esc_html__( 'Custom Font', 'fixhero') );
	}
	

	$font_choices_google = [
		'google'              => esc_html__( 'Google Fonts', 'fixhero'),
		'Space Grotesk'     => esc_html__( 'Space Grotesk', 'fixhero'),
		'Open Sans'           => esc_html__( 'Open Sans', 'fixhero'),
		'Oswald'              => esc_html__( 'Oswald', 'fixhero'),
		'Playfair Display'    => esc_html__( 'Playfair Display', 'fixhero'),
		'Montserrat'          => esc_html__( 'Montserrat', 'fixhero'),
		'Nunito Sans'         => esc_html__( 'Nunito Sans', 'fixhero'),
		'Inter'               => esc_html__( 'Inter', 'fixhero'),
		'Rajdhani'              => esc_html__( 'Rajdhani', 'fixhero'),
		'Comfortaa'           => esc_html__( 'Comfortaa', 'fixhero'),
		'Raleway'             => esc_html__( 'Raleway', 'fixhero'),
		'Droid Sans'          => esc_html__( 'Droid Sans', 'fixhero'),
		'Lato'                => esc_html__( 'Lato', 'fixhero'),
		'Arvo'                => esc_html__( 'Arvo', 'fixhero'),
		'Lora'                => esc_html__( 'Lora', 'fixhero'),
		'Poppins'             => esc_html__( 'Poppins', 'fixhero'),
		'Merriweather'        => esc_html__( 'Merriweather', 'fixhero'),
		'Oxygen'              => esc_html__( 'Oxygen', 'fixhero'),
		'PT Serif'            => esc_html__( 'PT Serif', 'fixhero'),
		'PT Sans'             => esc_html__( 'PT Sans', 'fixhero'),
		'PT Sans Narrow'      => esc_html__( 'PT Sans Narrow', 'fixhero'),
		'Public Sans'         => esc_html__( 'Public Sans', 'fixhero'),
		'Cabin'               => esc_html__( 'Cabin', 'fixhero'),
		'Fjalla One'          => esc_html__( 'Fjalla One', 'fixhero'),
		'Francois One'        => esc_html__( 'Francois One', 'fixhero'),
		'Josefin Sans'        => esc_html__( 'Josefin Sans', 'fixhero'),
		'Libre Baskerville'   => esc_html__( 'Libre Baskerville', 'fixhero'),
		'Arimo'               => esc_html__( 'Arimo', 'fixhero'),
		'Ubuntu'              => esc_html__( 'Ubuntu', 'fixhero'),
		'Bitter'              => esc_html__( 'Bitter', 'fixhero'),
		'Droid Serif'         => esc_html__( 'Droid Serif', 'fixhero'),
		'Roboto'              => esc_html__( 'Roboto', 'fixhero'),
		'Open Sans Condensed' => esc_html__( 'Open Sans Condensed', 'fixhero'),
		'Roboto Condensed'    => esc_html__( 'Roboto Condensed', 'fixhero'),
		'Roboto Slab'         => esc_html__( 'Roboto Slab', 'fixhero'),
		'Yanone Kaffeesatz'   => esc_html__( 'Yanone Kaffeesatz', 'fixhero'),
		'Rokkitt'             => esc_html__( 'Rokkitt', 'fixhero'),
		'Saira Condensed'             => esc_html__( 'Saira Condensed', 'fixhero'),
		'Oxanium'             => esc_html__( 'Oxanium', 'fixhero'),
		'Manrope'             => esc_html__( 'Manrope', 'fixhero'),
	]; 

	$font_choices = array_merge( $font_choices_custom, $font_choices_google );

	$font_weight = [
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
		'ty_header_0',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_header_0', 
			array(
				'label'			=> esc_html__( 'Header Typography', 'fixhero' ),
				'settings'		=> 'ty_header_0',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_header_01', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_header_01', 
			array(
				'settings'		=> 'separator_header_01',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting( 'fixhero_header_font');
	$fixhero_customizer->add_control( 'fixhero_header_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your desired font for the header.', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_header_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_header_font_size', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'fixhero' ),
		'description'	=> esc_html__( 'Header font size (15px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_header_font_size'
	));
	//End

	//Start
	$fixhero_customizer->add_setting( 'header_fixhero_fonts_info', array(
			'default' => '400'
		)
	);
	$fixhero_customizer->add_control( 'header_fixhero_fonts_info', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'fixhero' ),
			'description' => __( 'Select Header font Weight', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'ty_body_0',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_body_0', 
			array(
				'label'			=> esc_html__( 'Body Typography', 'fixhero' ),
				'settings'		=> 'ty_body_0',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_body_01', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_body_01', 
			array(
				'settings'		=> 'separator_body_01',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting( 'fixhero_body_font', array(
		'fixhero_body_font',
		array(
			'transport'		=> 'refresh',
		)
	) );
	$fixhero_customizer->add_control( 'fixhero_body_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __( 'Select your desired font for the body.', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_body_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_body_font_size', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'fixhero' ),
		'description'	=> esc_html__( 'Body font size (15px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_body_font_size'
	));
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_fonts_info', array(
			'default' => '400'
		)
	);
	$fixhero_customizer->add_control( 'fixhero_fonts_info', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'fixhero' ),
			'description' => __( 'Select Body font Weight', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_1', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_1', 
			array(
				'settings'		=> 'separator_ty_1',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_0',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_0', 
			array(
				'label'			=> esc_html__( 'Heading Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_0',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_heading_font', array(
		'default' => esc_html__( 'Nunito Sans', 'fixhero' )
	) );
	$fixhero_customizer->add_control( 'fixhero_heading_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'All Heading Font', 'fixhero' ),
			'description' => __( 'Select your desired font for the heading.', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_1',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_1', 
			array(
				'label'			=> esc_html__( 'H1 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_1',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h1_font');
	$fixhero_customizer->add_control( 'fixhero_h1_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	 //Start
	 $fixhero_customizer->add_setting(
		'fixhero_h1_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h1_font_size', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'fixhero' ),
        'description'	=> esc_html__( 'Global H1 font size (55px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h1_font_size'
    ));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h1_font_weight',
	);
	$fixhero_customizer->add_control( 'fixhero_h1_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'fixhero' ),
			'description' => __( 'Select h1 font weight', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h1_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h1_line_height', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
        'description'	=> esc_html__( 'Global H1 font line height (30px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h1_line_height'
    ));

 	$fixhero_customizer->add_setting (
        'fixhero_style_h1_color',
    );
    $fixhero_customizer->add_control(
        new WP_Customize_Color_Control(
            $fixhero_customizer,
            'fixhero_style_h1_color',
            array(
                'label'       => esc_html__('H1 Color','fixhero'),
                'description' => esc_html__('Select Color','fixhero'),
                'section'     => 'fixhero_typography_setting',
                'settings'    => 'fixhero_style_h1_color',
            )
        )
    );
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_2', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_2', 
			array(
				'settings'		=> 'separator_ty_2',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_2',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_2', 
			array(
				'label'			=> esc_html__( 'H2 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_2',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h2_font');
	$fixhero_customizer->add_control( 'fixhero_h2_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h2_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h2_font_size', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'fixhero' ),
        'description'	=> esc_html__( 'Global H2 font size (55px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h2_font_size'
    ));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h2_font_weight',
		array(
			'transport'		=> 'refresh',
		)
	);
	$fixhero_customizer->add_control( 'fixhero_h2_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'fixhero' ),
			'description' => __( 'Select h2 font weight', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h2_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h2_line_height', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
        'description'	=> esc_html__( 'Global H2 font line height (30px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h2_line_height'
    ));

	$fixhero_customizer->add_setting (
       'fixhero_style_h2_color',
   	);
   	$fixhero_customizer->add_control(
       new WP_Customize_Color_Control(
           $fixhero_customizer,
           'fixhero_style_h2_color',
           array(
               'label'       => esc_html__('H2 Color','fixhero'),
               'description' => esc_html__('Select Color','fixhero'),
               'section'     => 'fixhero_typography_setting',
               'settings'    => 'fixhero_style_h2_color',
           )
       )
   	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_3', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_3', 
			array(
				'settings'		=> 'separator_ty_3',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_3',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_3', 
			array(
				'label'			=> esc_html__( 'H3 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_3',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h3_font');
	$fixhero_customizer->add_control( 'fixhero_h3_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h3_font_size',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h3_font_size', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Size', 'fixhero' ),
        'description'	=> esc_html__( 'Global H3 font size (55px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h3_font_size'
    ));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h3_font_weight',
	);
	$fixhero_customizer->add_control( 'fixhero_h3_font_weight', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Weight', 'fixhero' ),
			'description' => __( 'Select h3 font weight', 'fixhero' ),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h3_line_height',
		array(
			'transport'		=> 'refresh',
		)
	 );
	 $fixhero_customizer->add_control('fixhero_h3_line_height', array(
        'section'		=> 'fixhero_typography_setting',
        'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
        'description'	=> esc_html__( 'Global H3 font line height (30px)', 'fixhero' ),
        'type'			=> 'text',
        'setting'	    => 'fixhero_h3_line_height'
    ));

	$fixhero_customizer->add_setting (
       'fixhero_style_h3_color',
   	);
   	$fixhero_customizer->add_control(
       new WP_Customize_Color_Control(
           $fixhero_customizer,
           'fixhero_style_h3_color',
           array(
               'label'       => esc_html__('H3 Color','fixhero'),
               'description' => esc_html__('Select Color','fixhero'),
               'section'     => 'fixhero_typography_setting',
               'settings'    => 'fixhero_style_h3_color',
           )
       )
   	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_4', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_4', 
			array(
				'settings'		=> 'separator_ty_4',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_4',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_4', 
			array(
				'label'			=> esc_html__( 'H4 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_4',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h4_font');
	$fixhero_customizer->add_control( 'fixhero_h4_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h4_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_h4_font_size', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'fixhero' ),
		'description'	=> esc_html__( 'Global H4 font size (55px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_h4_font_size'
	));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h4_font_weight',
	);
	$fixhero_customizer->add_control( 'fixhero_h4_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'fixhero' ),
		'description' => __( 'Select h4 font weight', 'fixhero' ),
		'section'     => 'fixhero_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h4_line_height',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_h4_line_height', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
		'description'	=> esc_html__( 'Global H4 font line height (30px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_h4_line_height'
	));

	$fixhero_customizer->add_setting (
       'fixhero_style_h4_color',
   	);
   	$fixhero_customizer->add_control(
       new WP_Customize_Color_Control(
           $fixhero_customizer,
           'fixhero_style_h4_color',
           array(
               'label'       => esc_html__('H4 Color','fixhero'),
               'description' => esc_html__('Select Color','fixhero'),
               'section'     => 'fixhero_typography_setting',
               'settings'    => 'fixhero_style_h4_color',
           )
       )
   	);
	//End

	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_5', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_5', 
			array(
				'settings'		=> 'separator_ty_5',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator	

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_5',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_5', 
			array(
				'label'			=> esc_html__( 'H5 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_5',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h5_font');
	$fixhero_customizer->add_control( 'fixhero_h5_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h5_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_h5_font_size', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'fixhero' ),
		'description'	=> esc_html__( 'Global H5 font size (32px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_h5_font_size'
	));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h5_font_weight',
	);
	$fixhero_customizer->add_control( 'fixhero_h5_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'fixhero' ),
		'description' => __( 'Select h5 font weight', 'fixhero' ),
		'section'     => 'fixhero_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h5_line_height',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_h5_line_height', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
		'description'	=> esc_html__( 'Global H5 font line height (30px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_h5_line_height'
	));

	$fixhero_customizer->add_setting (
       'fixhero_style_h5_color',
   	);
   	$fixhero_customizer->add_control(
       new WP_Customize_Color_Control(
           $fixhero_customizer,
           'fixhero_style_h5_color',
           array(
               'label'       => esc_html__('H5 Color','fixhero'),
               'description' => esc_html__('Select Color','fixhero'),
               'section'     => 'fixhero_typography_setting',
               'settings'    => 'fixhero_style_h5_color',
           )
       )
   	);
	//End
	
	//Start separator
	$fixhero_customizer->add_setting(
		'separator_ty_6', 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			'separator_ty_6', 
			array(
				'settings'		=> 'separator_ty_6',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End separator

	//Start
	$fixhero_customizer->add_setting(
		'ty_heading_6',
	);
	$fixhero_customizer->add_control(
		new fixhero_Heading_Control(
			$fixhero_customizer, 
			'ty_heading_6', 
			array(
				'label'			=> esc_html__( 'H6 Typography', 'fixhero' ),
				'settings'		=> 'ty_heading_6',
				'section'  		=> 'fixhero_typography_setting',
			)
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting( 'fixhero_h6_font');
	$fixhero_customizer->add_control( 'fixhero_h6_font', array(
			'type'        => 'select',
			'label'       => esc_html__( 'Font Family', 'fixhero' ),
			'description' => __('Select your heading font family', 'fixhero'),
			'section'     => 'fixhero_typography_setting',
			'choices'     => $font_choices
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h6_font_size',
		array(
			'transport'		=> 'refresh',
		)
		);
		$fixhero_customizer->add_control('fixhero_h6_font_size', array(
		'section'		=> 'fixhero_typography_setting',
		'label'			=> esc_html__( 'Font Size', 'fixhero' ),
		'description'	=> esc_html__( 'Global H6 font size (25px)', 'fixhero' ),
		'type'			=> 'text',
		'setting'	    => 'fixhero_h6_font_size'
	));
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h6_font_weight',
	);
	$fixhero_customizer->add_control( 'fixhero_h6_font_weight', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Font Weight', 'fixhero' ),
		'description' => __( 'Select h6 font weight', 'fixhero' ),
		'section'     => 'fixhero_typography_setting',
		'choices'     => $font_weight
		)
	);
	//End

	//Start
	$fixhero_customizer->add_setting(
		'fixhero_h6_line_height',
		array(
			'transport'		=> 'refresh',
		)
	);
	$fixhero_customizer->add_control('fixhero_h6_line_height', array(
	'section'		=> 'fixhero_typography_setting',
	'label'			=> esc_html__( 'Font Line Height', 'fixhero' ),
	'description'	=> esc_html__( 'Global H6 font line height (30px)', 'fixhero' ),
	'type'			=> 'text',
	'setting'	    => 'fixhero_h6_line_height'
	));

	$fixhero_customizer->add_setting (
       'fixhero_style_h6_color',
   	);
   	$fixhero_customizer->add_control(
       	new WP_Customize_Color_Control(
           $fixhero_customizer,
           'fixhero_style_h6_color',
           	array(
               'label'       => esc_html__('H6 Color','fixhero'),
               'description' => esc_html__('Select Color','fixhero'),
               'section'     => 'fixhero_typography_setting',
               'settings'    => 'fixhero_style_h6_color',
           	)
       	)
   	);
	//End
}