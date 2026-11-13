<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class RS_Step_Flow extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rs-step-flow';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Step Flow', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'step flow', 'icon' ];
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Step Flow', 'rsaddon' ),
			]
		);

		$this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Color', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Color', 'rsaddon'),
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon'),
				],											
			]
		);

		$this->add_control(
			'step_flow_style',
			[
				'label'   => esc_html__( 'Step Flow Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [					
					'1' => esc_html__( 'Style 1', 'rsaddon'),
                    '2' => esc_html__( 'Style 2', 'rsaddon'),
				],
			]
		);


		$this->add_control(
			'step_number',
			[
				'label' => esc_html__( 'Step Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'step_number_text',
			[
				'label' => esc_html__( 'Step Number Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Title & Description', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'This is the heading', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your title', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
				'placeholder' => esc_html__( 'Enter your description', 'elementor' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'separator' => 'before',
			]
		);


		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'select_img_icon',
			[
				'label'   => esc_html__( 'Select Image/Icon', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
                    'image' => esc_html__( 'Image', 'rsaddon'),
				],
				'condition' => ['step_flow_style' => '2']
			]
		);

		$this->add_control(
			'step_icon',
			[
				'label' => __( 'Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => ['select_img_icon' => 'icon']
			]
		);

		$this->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
                
                'condition' => ['select_img_icon' => 'image'] 
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Number', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-working-process .step-number .step-left-number' => 'color: {{VALUE}};',
					'{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .step-number-top .step-right-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__( 'Number Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-step-flow-working-process .step-number .step-left-number',
				'condition' => ['step_flow_style' => '1']
			]
		);
		$this->add_responsive_control(
            'number_left_position',
            [
                'label' => esc_html__( 'Number Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                	'px' => [
                		'max' => 200,
                	],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-step-flow-working-process .step-number .step-left-number' => 'left: {{SIZE}}{{UNIT}};',

                ],    
				'condition' => ['step_flow_style' => '1']            
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_texttypography',
				'label' => esc_html__( 'Step Text Typography', 'rsaddon' ),
				'selector' => 
                    '{{WRAPPER}} .rs-step-flow-working-process .step-number .step-right-text,{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .step-number-top .step-right-text',
			]
		);


		$this->start_controls_tabs( 'number_colors' );

		$this->start_controls_tab(
			'number_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
				'condition' => ['step_flow_style' => '1']
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'number_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-step-flow-working-process .step-number',
				'condition' => ['step_flow_style' => '1']
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-working-process .step-number' => 'color: {{VALUE}};',
				],
				'condition' => ['step_flow_style' => '1'] 
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'number_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
				'condition' => ['step_flow_style' => '1']
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'hover_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-step-flow-working-process .step-number:hover',
				'condition' => ['step_flow_style' => '1']
			]
		);

		$this->add_control(
			'bg_hovertext_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-working-process .step-number:hover' => 'color: {{VALUE}};',
				],
				'condition' => ['step_flow_style' => '1']
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'number_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
		    'number__padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process .step-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => ['step_flow_style' => '1'] 
		    ]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-working-process .step-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => ['step_flow_style' => '1'] 
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper',
			[
				'label' => esc_html__( 'Wrapper', 'rsaddons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-step-flow-working-process',
			]
		);

		$this->add_responsive_control(
		    'wrapper_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'wrapper_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_hover_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-step-flow-working-process:hover',
			]
		);

		$this->add_responsive_control(
		    'wrapper_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'wrapper_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-working-process' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
		    'title_bottom_space',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-box-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rs-step-flow-box-title, {{WRAPPER}} .rs-step-flow-box-title a',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .rs-step-flow-box-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .rs-step-flow-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
		    'description__margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-step-flow-working-process .rs-step-flow-icon-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-icon-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .rs-step-flow-icon-box-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .rs-step-flow-icon-box-description',
			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-step-flow-icon-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_image_style',
			[
				'label' => esc_html__( 'Image/Icon', 'rsaddon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_color',
				'selector' => '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon:before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon',
			]
		);

		$this->add_responsive_control(
            'icon_wrapper_width',
            [
                'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'icon_wrapper_height',
            [
                'label' => esc_html__( 'Wrapper Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'icon_image_width',
            [
                'label' => esc_html__( 'Img Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon img' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'icon_image_height',
            [
                'label' => esc_html__( 'Img Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon img' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

		$this->add_responsive_control(
			'icon_wrapper_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$icon_tag = 'span';

		$step_flow_style = $settings['step_flow_style'];
		$step_number = $settings['step_number'];
		$step_number_text = $settings['step_number_text'];
		


		$this->add_render_attribute( 'description_text', 'class', 'rs-step-flow-icon-box-description' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );

		?>
		<div class="rs-step-flow-working-process step-flow-style<?php echo $step_flow_style;?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">
		<?php if($step_flow_style  == '1') { ?>
		
			
			<div class="rs-step-flow-icon-box-icon">
				<div class="step-number">
					<span class="step-left-number"><?php echo $step_number;?></span> <span class="step-right-text"><?php echo $step_number_text;?></span>
				</div>
			</div>
			
			<div class="rs-step-flow-icon-box-content">
				<<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?> class="rs-step-flow-box-title">
					<<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?> <?php $this->print_render_attribute_string( 'title_text' ); ?>>
						<?php $this->print_unescaped_setting( 'title_text' ); ?>
					</<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
				</<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?>>
				<?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
					<p <?php $this->print_render_attribute_string( 'description_text' ); ?>>
						<?php $this->print_unescaped_setting( 'description_text' ); ?>
					</p>
				<?php endif; ?>
			</div>
			<?php } elseif($step_flow_style  == '2') { 

				$select_img_icon = $settings['select_img_icon'];
				?>
				<div class="rs-step-flow-icon-box-icon">
					<div class="rs-step-icon">
						<?php 
						if($select_img_icon == 'icon') { 
							 \Elementor\Icons_Manager::render_icon( $settings['step_icon'], [ 'aria-hidden' => 'true' ] ); 

						} else { 
							if( !empty($settings['selected_image']['url']) ) { ?>
								<img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
							<?php }
						 }
						
						?>
					</div>
					<div class="step-number-top">
						<div class="step-right-text"><?php echo $step_number_text;?></div>
						<<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?> class="rs-step-flow-box-title">
						<<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?> 
						<?php $this->print_render_attribute_string( 'title_text' ); ?>>
							<?php $this->print_unescaped_setting( 'title_text' ); ?>
						</<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
					</<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?>>
					</div>
				</div>
				
				<div class="rs-step-flow-icon-box-content">
					<?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
						<p <?php $this->print_render_attribute_string( 'description_text' ); ?>>
							<?php $this->print_unescaped_setting( 'description_text' ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php } ?>
		</div>
		
		<?php
	}
}
