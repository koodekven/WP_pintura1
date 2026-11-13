<?php
function switch_control($fixhero_customizer){
    	//Start enabal global setting
	$fixhero_customizer->add_setting( 'fixhero_enable_global', 
	array(
		'default'    => '1', 
		'sanitize_callback' => 'fixhero_sanitize_integer'
		) 
	);
	$fixhero_customizer->add_control(
		new fixhero_Customize_Switch_Control(
			$fixhero_customizer,
			'fixhero_enable_global',
			array(
				'type' => 'switch',
				'label' => esc_html__('Enable Global Settings','fixhero'),
				'description' => esc_html__('If you enable global settings all option will be work only theme option','fixhero'),
				'section' => 'fixhero_general_section'
			)
		)
	);
	//End enabal global setting
}