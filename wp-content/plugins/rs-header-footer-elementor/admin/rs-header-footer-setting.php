<?php 
use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Group_Control_Box_Shadow;


defined('ABSPATH') || die();

class RS_Header_Footer_Setting {

    public function __construct()
    {
    	add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'rs_header_controls_section' ], 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'rs_header_controls_section' ], 1 );
		add_action( 'elementor/frontend/before_render', [ $this, 'rs_before_section_render' ], 1 );
    }

    public function rs_header_controls_section( Element_Base $get_element ) {
		$tabs_field = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $get_element->get_name()  || 'container' === $get_element->get_name() ) {
			$tabs_field = Controls_Manager::TAB_LAYOUT;
		}

		$get_element->start_controls_section(
			'_section_hfe_wrapper_setting',
			[
				'label' => __( 'RS Header Settings', 'rs-header-footer-elementor' ),
				'tab'   => $tabs_field,
			]
		);

		$get_element->add_control(
			'position_header',
			[
				'label'     => __( 'Select Position', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'no-position' 		=> __( 'Default', 'rs-header-footer-elementor' ),
					'absolute-position'  	=> __( 'Transparent', 'rs-header-footer-elementor' ),
				],
				'default'   => 'no-position',
			]
		);

		$get_element->add_control(
			'sticky_hide_elements',
			[
				'label'     => __( 'Select element hide of sticky (Note: This option works if the customizer sticky option is on.)', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'default' 		=> __( 'Default', 'rs-header-footer-elementor' ),
					'sticky-hide'  	=> __( 'Sticky Hide', 'rs-header-footer-elementor' ),
				],
				'default'   => 'default',
			]
		);

		$get_element->add_control(
		    'sticky_bg_color',
		    [
		        'label' => esc_html__( 'Sticky Bg Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .single-header.rs-enable-sticky.rs-header-sticky header.elementor-element' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$get_element->add_control(
			'sticky_shadow_enable_disable',
			[
				'label'     => __( 'Stick Shadow', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'show_shadow' 		=> __( 'Show Shadow', 'rs-header-footer-elementor' ),
					'hide_shadow'  	=> __( 'Hide Shadow', 'rs-header-footer-elementor' ),
				],
				'default'   => 'show_shadow',
			]
		);

		$get_element->end_controls_section();
	}

	public  function rs_before_section_render( Element_Base $get_element ) {
		$position_header = $get_element->get_settings_for_display( 'position_header' );
		$sticky_hide_elements = $get_element->get_settings_for_display( 'sticky_hide_elements' );
		$sticky_bg_color = $get_element->get_settings_for_display( 'sticky_bg_color' );
		$sticky_shadow_enable_disable = $get_element->get_settings_for_display( 'sticky_shadow_enable_disable' );

		if ( $position_header && ! empty( $position_header ) || $sticky_hide_elements && ! empty( $sticky_hide_elements )  || $sticky_shadow_enable_disable && ! empty( $sticky_shadow_enable_disable ) ) {
			$get_element->add_render_attribute(
				'_wrapper',
				[
					'class' => [ $sticky_hide_elements, $position_header, $sticky_shadow_enable_disable ],
				]
			);
		}

		if ( $sticky_bg_color && ! empty( $sticky_bg_color )) { ?>
			<style>					
				.single-header.rs-enable-sticky.rs-header-sticky header.elementor-element{
					background:<?php echo esc_attr($sticky_bg_color) ?> !important;
				}
			</style>
		<?php
		}
	}
}

new RS_Header_Footer_Setting();