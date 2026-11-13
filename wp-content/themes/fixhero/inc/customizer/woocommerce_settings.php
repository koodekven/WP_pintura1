<?php
function fixhero_woocommerce_panel($fixhero_customizer, $priority)
{
    $fixhero_customizer->add_section('fixhero_shop_setting', array(
        'title'    => esc_html__('Woocommerce Settings', 'fixhero'),
        'priority' => $priority,
        'panel'    => 'fixhero_options_panel',
    ));
    
    //Start
    $fixhero_customizer->add_setting( 'fixhero_shop_page_sidebar_setting', array(
        'default'           => 'shop_no_sidebar',
        'transport'         => 'postMessage',
    ) );
    $fixhero_customizer->add_control( 'fixhero_shop_page_sidebar_setting', array(
        'label'   => esc_html__( 'Sidebar Setting', 'fixhero' ),
        'section' => 'fixhero_shop_setting',
        'type'    => 'select',
        'choices' => array(
            'shop_no_sidebar'    => esc_html__( 'Full Wide', 'fixhero' ),
            'shop_left_sidebar'  => esc_html__( 'Left Sidebar', 'fixhero' ),
            'shop_right_sidebar' => esc_html__( 'Right Sidebar', 'fixhero' ),
        ),
    ) );
    //End

    //Start separator
    $fixhero_customizer->add_setting(
        'woocommerce_hr_02',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'woocommerce_hr_02',
            array(
                'settings' => 'woocommerce_hr_02',
                'section' => 'fixhero_shop_setting',
            )
        )
    );
    //End separator

    //Start
	 $fixhero_customizer->add_setting(
		'wc_num_product',
		array(
			'default' => esc_html__( '9', 'fixhero' ),
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('wc_num_product', array(
        'section'	    => 'fixhero_shop_setting',
        'label'		     => esc_html__( 'Number of Products', 'fixhero' ),
        'description' => esc_html__( 'Show number of products per page', 'fixhero' ),
        'type'		      => 'text',
        'setting'	    => 'wc_num_product'
    ));
	//End

    //Start separator
    $fixhero_customizer->add_setting(
        'woocommerce_hr_03',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'woocommerce_hr_03',
            array(
                'settings' => 'woocommerce_hr_03',
                'section' => 'fixhero_shop_setting',
            )
        )
    );
    //End separator

    //Start
	 $fixhero_customizer->add_setting(
		'wc_num_product_per_row',
		array(
			'default' => esc_html__( '3', 'fixhero' ),
			'transport'		=> 'refresh',
		)
	 );

	 $fixhero_customizer->add_control('wc_num_product_per_row', array(
        'section'	    => 'fixhero_shop_setting',
        'label'		     => esc_html__( 'Number of Row', 'fixhero' ),
        'description' => esc_html__( 'Show number of prodcts per row', 'fixhero' ),
        'type'		      => 'text',
        'setting'	    => 'wc_num_product_per_row'
    ));
	//End

    //Start separator
    $fixhero_customizer->add_setting(
        'woocommerce_hr_04',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        )
    );
    $fixhero_customizer->add_control(
        new fixhero_Separator_Control(
            $fixhero_customizer,
            'woocommerce_hr_04',
            array(
                'settings' => 'woocommerce_hr_04',
                'section' => 'fixhero_shop_setting',
            )
        )
    );
    //End separator
}