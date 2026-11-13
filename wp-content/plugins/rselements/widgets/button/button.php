<?php
/**
 * Elementor RS Button Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Button_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rs-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Button', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-menu';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
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
		return [ 'button' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => esc_html__( 'Select Button Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
					'style4' => esc_html__( 'Style 4', 'rsaddon'),
					'style5' => esc_html__( 'Style 5', 'rsaddon'),
					'style6' => esc_html__( 'Style 6', 'rsaddon'),
					'style7' => esc_html__( 'Style 7', 'rsaddon'),
					'style8' => esc_html__( 'Style 8', 'rsaddon'),
					'style9' => esc_html__( 'Style 9', 'rsaddon'),
					'style10' => esc_html__( 'Style 10', 'rsaddon'),
					'style11' => esc_html__( 'Style 11', 'rsaddon'),
					'style12' => esc_html__( 'Style 12', 'rsaddon'),
					'style13' => esc_html__( 'Style 13', 'rsaddon'),
				],
			]
		);
		
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'type_popup',
			[
				'label'   => esc_html__( 'Button Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [					
					'none' => esc_html__( 'Normal', 'rsaddon'),
					'videos' => esc_html__( 'Videos', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'gradient_setting',
			[
				'label'   => esc_html__( 'Button Color Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal_color',
				'options' => [					
					'normal_color' => esc_html__( 'Normal Scheme', 'rsaddon'),
					'gradient_color' => esc_html__( 'Gradient Scheme', 'rsaddon'),
					'primary_color' => esc_html__( 'Primary Scheme', 'rsaddon'),
					'secondary_color' => esc_html__( 'Secondary Scheme', 'rsaddon'),
					'gradient_bg_color' => esc_html__( 'Gradient Scheme', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__( ' Button Link', 'rsaddon' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-view-btn.rs-view-btn2, {{WRAPPER}} .rs-btn' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->add_control(
            'icon',
            [
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type'  => Controls_Manager::HEADING,               
            ]
        );

		$this->add_control(
            'show_icon',
            [
				'label'        => esc_html__( 'Show Icon', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

		$this->add_control(
			'btn_icon',
			[
				'label' => __( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
		    'btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Margin Left', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'px' => 10
		        ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => -50,
						'max' => 100,
					],
				],
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs_button svg' => 'margin-left: {{SIZE}}{{UNIT}};',	
						            
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);
		$this->add_responsive_control(
		    'btn_icon_spacing_top',
		    [
		        'label' => esc_html__( 'Icon Margin Top', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'px' => 10
		        ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
						'step' => 1
					],
					'%' => [
						'min' => -50,
						'max' => 100,
						'step' => 1
					],
				],
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn i' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs_button svg' => 'margin-top: {{SIZE}}{{UNIT}};',	
						            
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);	

		$this->add_responsive_control(
		    'btn_icon_spacing_right',
		    [
		        'label' => esc_html__( 'Icon Margin Right', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs_button svg' => 'margin-right: {{SIZE}}{{UNIT}};',	
						            
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);	

		$this->add_responsive_control(
		    'btn_icon_spacing_left',
		    [
		        'label' => esc_html__( 'Icon Spacing Left/Right', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => ''
		        ],
		        
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'left: {{SIZE}}{{UNIT}};',	
					'{{WRAPPER}} .rs_button svg' => 'left: {{SIZE}}{{UNIT}};',	          
		        ],
		        
		    ]
		);
		$this->add_control(
            'svg_icon',
            [
				'label' => esc_html__( 'SVG Icon', 'rsaddon' ),
				'type'  => Controls_Manager::HEADING,               
            ]
        );
		$this->add_control(
            'show_svg_icon',
            [
				'label'        => esc_html__( 'Show SVG Icon', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'no',
            ]
        );
        $this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [					
					'left' => esc_html__( 'Left Icon', 'rsaddon'),
					'right' => esc_html__( 'Right Icon', 'rsaddon'),
				],
			]
		);
		$this->end_controls_section();	


		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'button_view_style_align',
            [
                'label' => esc_html__( 'View Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-flex' => [
                        'title' => esc_html__( 'Inline', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'display: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => 'style9'
				]
            ]
        );
		$this->add_responsive_control(
            'button_view_style_align2',
            [
                'label' => esc_html__( 'View Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
				'default' => '',
                'options' => [
					'' => esc_html__( 'Default', 'rsaddon'),
					'block' => esc_html__( 'Block', 'rsaddon'),
					'inline-block' => esc_html__( 'Inline Block', 'rsaddon'),
					'flex' => esc_html__( 'Flex', 'rsaddon'),
					'inline-flex' => esc_html__( 'Inline Flex', 'rsaddon'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'display: {{VALUE}};',
                ],
				'condition' => [
					'button_style' => 'style9'
				]
            ]
        );
		$this->add_responsive_control(
            'button_vertical_align',
            [
                'label' => esc_html__( 'Vertical Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-align-end-v',
                    ],
                ],
				'condition' => [
					'button_view_style_align' => 'inline-flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_column_align',
            [
                'label' => esc_html__( 'Column Direction', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-v',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                ],
				'condition' => [
					'button_view_style_align' => 'inline-flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'button_h_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],

                ],
				'condition' => [
					'button_view_style_align' => 'inline-flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'btn_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );
		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-view-btn a, {{WRAPPER}} .rs-btn a,{{WRAPPER}} .rs-btn.style10 .rs_button:before' => 'color: {{VALUE}};',
		        ],
		        'condition' => [
					'gradient_setting!' => 'gradient_color',
				], 
		    ]
		);

		$this->add_control(
            'color_gradient_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button Gradient Color', 'prelements' ),
                'separator' => 'before',
                'condition' => [
					'gradient_setting' => 'gradient_color',
				],
            ]
        ); 

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'color_gradient',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
					'gradient_setting' => 'gradient_color',
				],
                'selector' => '{{WRAPPER}} .rs-btn.style4 .rs_button .btn_text, {{WRAPPER}} .rs-view-btn a .btn_text, {{WRAPPER}} .rs-btn a .btn_text',
                
            ]
        );

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);
		$this->add_responsive_control(
		    'button_style7_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn.style7 .rs_button span.btn_text ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'button_style' => 'style7'
				]
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-view-btn a, {{WRAPPER}} .rs-btn a',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn a',
				'condition' => [
					'button_style!' => 'style7',
					'button_style!' => 'style10',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_style10normal',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn.style10 .rs_button:before, {{WRAPPER}} .rs-btn.style10 .rs_button',
				'condition' => [
					'button_style' => 'style10',
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_style7_normal',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn.style7 .rs_button span.btn_text ',
				'condition' => ['button_style' => 'style7']
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .rs-btn a',
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);

		$this->add_control(
            'button_after_heading_border',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button After Border', 'prelements' ),
                'separator' => 'before',
				'condition' => [
					'button_style' => ['style7','style3']
				]
            ]
        );

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_after_border_',
		        'selector' => '{{WRAPPER}} .rs-btn.style7 .rs_button::after, {{WRAPPER}} .rs-btn.style3 a.rs_button::after',
				'condition' => [
					'button_style' => ['style7','style3']
				]
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a, {{WRAPPER}} .rs-btn.style3 a.rs_button::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);
		$this->add_control(
		    'button_style7_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn.style7 .rs_button span.btn_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
				'condition' => ['button_style' => 'style7']
		    ]
		);
		$this->add_responsive_control(
			'button_border_bottom_position',
			[
				'label' => esc_html__( 'Border Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-btn.style7 .rs_button::before' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_style' => 'style7']
			]
		);
		$this->add_responsive_control(
			'button_border_left_position',
			[
				'label' => esc_html__( 'Border Position X', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-btn.style7 .rs_button::before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_style' => 'style7']
			]
		);

		$this->add_responsive_control(
			'button_border_ddfwidth',
			[
				'label' => esc_html__( 'Border Width', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-btn.style7 .rs_button::before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_style' => 'style7']
			]
		);
		$this->add_responsive_control(
			'button_border_dfdfheight',
			[
				'label' => esc_html__( 'Border Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-btn.style7 .rs_button::before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['button_style' => 'style7']
			]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-btn a',
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_style_7shadow',
		        'selector' => '{{WRAPPER}} .rs-btn.style7 .btn_text',
				'condition' => [ 'button_style' => 'style7']
		    ]
		);
		$this->add_control(
		    'btn_border_color',
		    [
		        'label' => esc_html__( 'Button Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack .rs_btn__text span::after, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack .rs_btn__text span::before, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack .rs_btn__text::after, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack .rs_btn__text::before, {{WRAPPER}} .rs-btn.rs-btnblack .rs_btn__text::before, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack:hover .rs_btn__text span::after, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack:hover .rs_btn__text::after, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack:hover .rs_btn__text span::before, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack:hover .rs_btn__text::before, {{WRAPPER}} .rs-view-btn .rs-btn.rs-btnblack::before' => 'background-color: {{VALUE}};',
		        ],
		        'condition' => [
					'button_style' => 'style2',
				],
		    ]
		);
		$this->add_control(
		    'btn_circle_background',
		    [
		        'label' => esc_html__( 'Button Circle Background', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn.style5 .rs_button:before' => 'background: {{VALUE}} !important;',
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

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn.style4 .rs_button:hover .btn_text, {{WRAPPER}} .rs-view-btn a, {{WRAPPER}} .rs-btn a:hover,{{WRAPPER}} .rs-btn.style10 .rs_button:hover:before' => 'color: {{VALUE}} !important;',
		        ],
		        'condition' => [
					'gradient_setting!' => 'gradient_color',
				], 
		    ]
		);

		$this->add_control(
            'color_gradient_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button Gradient Color', 'prelements' ),
                'separator' => 'before',
                'condition' => [
					'gradient_setting' => 'gradient_color',
				],
            ]
        ); 

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'color_gradient_hover',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-btn.style4 .rs_button:hover .btn_text, {{WRAPPER}} .rs-view-btn a:hover .btn_text, {{WRAPPER}} .rs-btn a:hover .btn_text',
                'condition' => [
					'gradient_setting' => 'gradient_color',
				],
            ]
        );

		$this->add_responsive_control(
		    'link_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);
		$this->add_responsive_control(
		    'link_hover_style7_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn .btn_text:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => ['button_style' => 'style7']
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_hover_typography',
		        'selector' => '{{WRAPPER}} .rs-btn a:hover',
		    ]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_hover_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn.style4 .rs_button:hover, {{WRAPPER}} .rs-btn.style1 a:before, {{WRAPPER}} .rs-btn.style6 a:before, {{WRAPPER}} .rs-btn a:hover',
				'condition' => [
					'button_style!' => ['style7', 'style10', 'style11', 'style12'],
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_hover_before_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn.style10 .rs_button:hover,{{WRAPPER}} .rs-btn.style10 .rs_button:hover:before,{{WRAPPER}} .rs-btn.style11 a:before, {{WRAPPER}} .rs-btn.style12 a:before,{{WRAPPER}} .rs-header-btn .rs-btn.style11 a:before',
				'condition' => [
					'button_style' => ['style10','style11','style12'],
				]
			]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_hover_style7_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn .btn_text:hover',
				'condition' => ['button_style' => 'style7']
			]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_hover_border',
		        'selector' => '{{WRAPPER}} .rs-btn a:hover',
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_hover_style7_border',
		        'selector' => '{{WRAPPER}} .rs-btn .btn_text:hover',
				'condition' => ['button_style' => 'style7']
		    ]
		);

		$this->add_control(
            'button_after_hover_heading_border',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button Before Border', 'prelements' ),
                'separator' => 'before',
				'condition' => ['button_style' => 'style7']
            ]
        );

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_after_hover_border',
		        'selector' => '{{WRAPPER}} .rs-btn.style7 .rs_button:hover::before',
				'condition' => ['button_style' => 'style7']
		    ]
		);
		$this->add_control(
		    'button_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);
		
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-btn a:hover',
				'condition' => [
					'button_style!' => 'style7',
				]
		    ]
		);

		$this->add_control(
		    'btn_skew_',
		    [
		        'label' => esc_html__( 'Skew', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a:hover' => 'transform: skew({{SIZE}}deg);',		            	            
		        ],
		    ]
		);		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_icon',
		    [
		        'label' => esc_html__( 'Icon', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
            'svg_icon_button_width',
            [
                'label' => esc_html__( 'Button Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs_button .rs_btn_icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'svg_icon_button_height',
            [
                'label' => esc_html__( 'Button Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs_button .rs_btn_icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


		$this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-btn .rs_button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
					'button_style' => 'style4',
				],
                'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
            'svg_icon_width',
            [
                'label' => esc_html__( 'Svg Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-btn svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'svg_icon_height',
            [
                'label' => esc_html__( 'Svg Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-btn svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );   
		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-btn svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn .rs_button:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-btn .rs_button:hover svg path' => 'fill: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'icon_background',		
			[
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-btn a i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs_button .rs_btn_icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
		    'icon_hover_background',
			[
				'label' => esc_html__( 'Hover Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-btn a:hover i'=> 'background: {{VALUE}};',
					'{{WRAPPER}} .rs_button.popup-none:hover .rs_btn_icon'=> 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_gradiant',
                'label' => esc_html__( 'Gradiant Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-btn a:hover i',
            ]
        ); 

		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_button .rs_btn_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-btn svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'icon_button_border',
		        'selector' => '{{WRAPPER}} .rs_btn_icon, {{WRAPPER}} .rs-btn a i',
		    ]
		);
		$this->add_responsive_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius A', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-btn svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
		    'icon_hover_border_color',
		    [
		        'label' => esc_html__( 'Icon Hover Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a.rs_button:hover i' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'icon_hover_button_border',
		        'selector' => '{{WRAPPER}} .rs-btn a.rs_button:hover .rs_btn_icon',
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'icon_typography',
		        'selector' => '{{WRAPPER}} .rs-btn i, {{WRAPPER}} .rs-btn .rs_button i:before',
		    ]
		);

		$this->add_responsive_control(
		    'icon_margin_svg',
		    [
		        'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_button .rs_btn_icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'icon_top_position',
			[
				'label' => esc_html__( 'Icon Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-btn .rs_button i:before' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
	
		$settings = $this->get_settings_for_display();

		$btn_style = '';
		if('style7' == $settings['button_style']){ 
			$btn_style = 'btn_style7';
		}
		if('style8' == $settings['button_style']){ 
			$btn_style = 'btn_style8';
		}

		$this->add_inline_editing_attributes( 'btn_text', 'basic' );
        $this->add_render_attribute( 'btn_text', 'class', "btn_text $btn_style" );

	?>

		<?php if('style2' == $settings['button_style']){ ?>
			<div class="rs-view-btn rs-view-btn2 <?php echo $settings['gradient_setting'];?>"> 
				<a class="rs-btn rs-btnblack popup-<?php echo esc_attr( $settings['type_popup'] ); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>"> 
					<span class="rs_btn__text">
						<span class="btn_text"><?php echo esc_html($settings['btn_text']);?></span>
					</span> 
				</a>
			</div>
		<?php } else { ?>
			<div class="rs-btn <?php echo $settings['button_style'];?> <?php echo $settings['gradient_setting'];?>">
				<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : '';?>
				<a class="rs_button popup-<?php echo esc_attr( $settings['type_popup'] ); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>


					<?php if('left' == $settings['icon_align']){ ?>
						<?php if(!empty($settings['btn_icon'])) : ?>
							<?php
								if( $settings['btn_icon']['library'] == 'svg' ){
									?>
									<span class="rs_btn_icon">
										<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
									<?php
								}else{
									\Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
								}
							?>
						<?php endif; ?>
					<?php } ?>

					<?php if('style8' == $settings['button_style'] || 'style10' == $settings['button_style']){ ?>
						<span class="icon-reverse-wrapper">
							<?php } ?>
					<span <?php echo esc_attr($this->print_render_attribute_string('btn_text'));?> data-btn-text="<?php  echo esc_html($settings['btn_text']);?>">
					
						<?php  echo esc_html($settings['btn_text']);?>
						<?php if('style7' == $settings['button_style']){ ?>
							<?php if(!empty($settings['btn_icon'])) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							<?php endif; ?>
						<?php } ?>
					</span>

					<?php if('right' == $settings['icon_align'] && 'style7' != $settings['button_style'] && 'style8' != $settings['button_style']){ ?>
						<?php if(!empty($settings['btn_icon'])) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>
					<?php } ?>
					<?php if('right' == $settings['icon_align'] && 'style8' == $settings['button_style']){ ?>
						<?php if(!empty($settings['btn_icon'])) : ?>
							<span class="btn-icon">
							<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
							<span class="btn-icon">
							<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
					</span>
						<?php endif; ?>
					<?php } ?>
					<?php if(($settings['show_svg_icon'] == 'yes') ) : ?>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
					<?php endif; 

					?>
				</a>
			</div> 
		<?php } ?>

		<?php if('videos' == $settings['type_popup']){ ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.popup-videos').magnificPopup({
				        disableOn: 10,
				        type: 'iframe',
				        mainClass: 'mfp-fade',
				        removalDelay: 160,
				        preloader: false,
				        fixedContentPos: false,
				    }); 
				});
			</script>
		<?php } ?>   
	<?php 
	}
}