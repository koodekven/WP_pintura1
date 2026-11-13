<?php
function fixhero_separator( $fixhero_customizer, $section_id, $setting_id ){
    $fixhero_customizer->add_setting(
		$setting_id, 
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		)
	);
	$fixhero_customizer->add_control(
		new fixhero_Separator_Control(
			$fixhero_customizer, 
			$setting_id, 
			array(
				'settings'		=> 'blog_page_hr_3',
				'section'  		=> $section_id,
			)
		)
	);
}