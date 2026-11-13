<?php
/**
 * Elementor RS Couter Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSCounter_Widget extends \Elementor\Widget_Base {

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
		return 'rs-counter';
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
		return esc_html__( 'RS Counter', 'rsaddon' );
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
		return 'glyph-icon flaticon-count';
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
		return [ 'counter' ];
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
			'section_counter',
			[
				'label' => esc_html__( 'Counter', 'rsaddon' ),
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
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon')				
				],											
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Counter Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
					'style4' => esc_html__( 'Style 4', 'rsaddon'),
					'style5' => esc_html__( 'Style 5', 'rsaddon'),
				],
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Counter Number', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Number Prefix', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Prefix', 'rsaddon' ),
				'separator' => 'before',
				'condition'=>[
					'style!'=>'style5',
				],
			]
			
		);

		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Number Suffix', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 'Suffix',
				'separator' => 'before',
			]
		);
		$this->add_control( 'count_down_skew', [
			'label' => esc_html__( 'Count Down Skew', 'rs-addon' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'skew_enable' => esc_html__( 'Enable', 'rs-addon' ),
				'' => esc_html__( 'Disable', 'rs-addon' ),
			],
			'condition'=>[
					'style!'=>'style5',
			],
		] );
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'skew_bg',
                'label' => esc_html__( 'Skew Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
				'condition'=>[
					'count_down_skew'=>'skew_enable',
				],
                'selector' => '{{WRAPPER}} .counter-top-area.skew_enable:after',
            ]
        );
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Counter Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Happy Clients', 'rsaddon' ),
				'placeholder' => esc_html__( 'Clients', 'rsaddon' ),
				'separator' => 'before',
			]
			
		);
		$this->add_control(
			'show_subtitle',
			[
				'label' => esc_html__( 'Show SubTitle', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default'=>'no',
				'condition'=>[
					'style!'=>'style5',
				],
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Sub Title', 'rsaddon' ),
				'separator' => 'before',
				'condition'=>[
					'show_subtitle'=>'yes',
					'style!'=>'style5',
				],
			]
			
		);
		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',			
				'options' => [
					'' => esc_html( 'Select','rsaddon' ),					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);
		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
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
                    '{{WRAPPER}} .counter-top-area' => 'text-align: {{VALUE}}'
                ],                
				'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'content__align_for_style_two',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__( 'Space Evenly', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],

                ],
                'default' => 'space-evenly',
                'condition' => [
                    'style' => 'style2',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'box_horizontal_align',
            [
                'label' => esc_html__( 'Box Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__( 'Inline', 'rsaddon' ),
                        'icon' => 'eicon-post-list',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-posts-grid',
                    ],
                ],
				'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .count-text' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
				'condition' => [
                    'style' => 'style2',
                ],
            ]
        );
		$this->add_responsive_control(
            'box_vertical_align',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .count-text' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_column_align',
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
				'default' => 'row',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .count-text' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );


		$this->end_controls_section();

		$this->start_controls_section(
			'counter_wrapper_style',
			[
				'label' => esc_html__( 'Wrapper', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'textdomain' ),
				'selector' => '{{WRAPPER}} .counter-top-area',
			]
		);
		$this->add_responsive_control(
			'wrapper_width',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-top-area, {{WRAPPER}} .counter' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_height_style_five',
			[
				'label' => esc_html__( 'Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'style'=>'style5',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_width_before_style_five',
			[
				'label' => esc_html__( 'Wrapper Before e Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'style'=>'style5',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_height_before_style_five',
			[
				'label' => esc_html__( 'Wrapper Before Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'style'=>'style5',
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
					'{{WRAPPER}} .counter-top-area, .counter-top-area.skew_enable:after, {{WRAPPER}} .counter:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .counter-top-area, {{WRAPPER}} .counter:before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background',
				'label' => esc_html__( 'Background', 'textdomain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .counter-top-area, {{WRAPPER}} .counter:before',
			]
		);
		$this->add_responsive_control(
		    'wrapper_margin',
		    [
		        'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-top-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'wrapper_padding',
		    [
		        'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-top-area, {{WRAPPER}} .counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Number', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'show_gradient',
            [
				'label'        => esc_html__( 'Show Gradient Color', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'=>[
					'style!'=>'style5',
				],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
        	[
        		'name' => 'background_gradient',
        		'label' => esc_html__( 'Background', 'rsaddon' ),
        		'types' => [ 'classic', 'gradient' ],
        		'selector' => '{{WRAPPER}} .rs-gradient-yes .rs-counter-list .count-text span.rs-counter, {{WRAPPER}} .rs-gradient-yes .rs-counter-list .count-text span.prefix, {{WRAPPER}} .rs-gradient-yes .rs-counter-list .count-text span.suffix',
        		'condition' => [
        			'show_gradient' => 'yes',
        		],
        	]
        );
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span, {{WRAPPER}} .counter .count-number span.rs-counter' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'number_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .counter-top-area:hover .count-number span,{{WRAPPER}} .counter .count-number span.rs-counter:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_number',
				'selector' => '{{WRAPPER}} .count-number .rs-counter,{{WRAPPER}} .counter .count-number span.rs-counter',
			]
		);
		$this->add_responsive_control(
		    'number_top_spacing',
		    [
		    	'label' => esc_html__( 'Padding', 'rsaddon' ),
		    	'type' => Controls_Manager::DIMENSIONS,
		    	'size_units' => [ 'px', 'em', '%' ],
		    	'selectors' => [
		    	    '{{WRAPPER}} .count-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		    	],
		    	'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'number_style_five_margin',
		    [
		    	'label' => esc_html__( 'Margin', 'rsaddon' ),
		    	'type' => Controls_Manager::DIMENSIONS,
		    	'size_units' => [ 'px', 'em', '%' ],
		    	'selectors' => [
		    	    '{{WRAPPER}} .counter .count-number span.rs-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		    	],
		    	'condition'=>[
					'style'=>'style5',
				],

		    ]
		);
		$this->add_control(
			'prefix_color',
			[
				'label' => esc_html__( 'Prefix Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span.prefix' => 'color: {{VALUE}};',
				],
				'condition'=>[
					'style!'=>'style5',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Prefix Typography', 'rsaddon' ),
				'name' => 'typography_prefix',
				'selector' => '{{WRAPPER}} .count-number span.prefix',
				'condition'=>[
					'style!'=>'style5',
				],
			]
		);
		$this->add_control(
			'sufix_color',
			[
				'label' => esc_html__( 'Suffix Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span.suffix, {{WRAPPER}} .counter .count-number span.plusss' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Suffix Typography', 'rsaddon' ),
				'name' => 'typography_suffix',
				'selector' => '{{WRAPPER}} .count-number span.suffix, {{WRAPPER}} .counter .count-number span.plusss',
			]
		);

		$this->add_control(
            'underline_number_color',
            [
                'label' => esc_html__( 'Underline Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-counter-list .count-text span.rs-counter:after' => 'background: {{VALUE}};',
                ],
                'condition'=>[
					'style!'=>'style5',
				],               
            ]
        );
		$this->add_responsive_control(
		    'prefix_number_position',
		    [
				'label'      => esc_html__( 'Prefix & Suffix Top/Bottom Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-counter-list .count-number span.prefix, {{WRAPPER}} .counter .count-number span.plusss' => 'bottom: {{SIZE}}{{UNIT}}; position: relative;',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style!'=>'style5',
				], 
		    ]
		);
		$this->add_responsive_control(
		    'prefix_number_horizontal_position',
		    [
				'label'      => esc_html__( 'Prefix & Suffix Left/Right Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-counter-list .count-number span.prefix, {{WRAPPER}} .counter .count-number span.plusss' => 'left: {{SIZE}}{{UNIT}}; position: relative;',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style!'=>'style5',
				], 
		    ]
		);
		$this->add_responsive_control(
		    'suffex_number_position_top_bottom_for_style_five',
		    [
				'label'      => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .count-number span.plusss' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style'=>'style5',
				], 
		    ]
		);
		$this->add_responsive_control(
		    'suffex_number_position_left__for_style_five',
		    [
				'label'      => esc_html__( 'Suffix Left', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .count-number span.plusss' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style'=>'style5',
				], 
		    ]
		);
		$this->add_responsive_control(
		    'suffex_number_position_right__for_style_five',
		    [
				'label'      => esc_html__( 'Suffix Right', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .count-number span.plusss' => 'right: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style'=>'style5',
				], 
		    ]
		);
		$this->add_responsive_control(
		    'underline_number_position',
		    [
				'label'      => esc_html__( 'Underline Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-counter-list .count-text span.rs-counter:after' => 'bottom: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_control(
			'stroke_color_yes_no',
			[
				'label'   => esc_html__( 'Stroke Color Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [					
					'enable' => esc_html__( 'Enable', 'rsaddon'),
					'disable' => esc_html__( 'Disable', 'rsaddon'),
				],
				'condition'=>[
					'style!'=>'style5',
				],
			]
		);
        $this->add_control(
			'stroke_number_color',
			[
				'label' => esc_html__( 'Stroke Inside Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-fill-color: {{VALUE}};',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);
        $this->add_control(
			'stroke_outside_number_color',
			[
				'label' => esc_html__( 'Stroke Outside Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);
        $this->add_control(
			'stroke_number_width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],			
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-stroke-width: {{SIZE}}px;',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);
		$this->add_responsive_control(
		    'shape_bg_style4',
		    [
		    	'label' => esc_html__( 'Shape Background', 'rsaddon' ),
		    	'type' => Controls_Manager::COLOR,
		    	'condition' => [
		    		'style' => 'style4',
		    	],
		    	'selectors' => [
		    	    '{{WRAPPER}} .counter-top-area.style4:after' => 'background: {{VALUE}};',
		    	],
		    ]
		);
		$this->add_control(
			'clip_yes_no',
			[
				'label'   => esc_html__( 'clip Background Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [					
					'enable' => esc_html__( 'Enable', 'rsaddon'),
					'disable' => esc_html__( 'Disable', 'rsaddon'),
				],
				'condition'=>[
					'style!'=>'style5',
				],
			]
		);
		$this->add_control(
			'item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .counter-top-area' => 'background: {{VALUE}};',
				],
				'condition' => [
		            'clip_yes_no' => 'enable'
		        ],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_wrapper_border',
				'selector' => '{{WRAPPER}} .counter-top-area.style2 .count-text',
				'condition' =>[
					'style'=>'style2', 
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .count-text .title, {{WRAPPER}} .counter h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter h3, {{WRAPPER}} .counter h3::before, {{WRAPPER}} .counter h3::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .counter h3::before, {{WRAPPER}} .counter h3::after' => 'background:darken( {{VALUE}} , 10% );',
				],
			]
		);
		$this->add_control(
			'title_connect_bg_color',
			[
				'label' => esc_html__( 'Connect Shape Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter h3::before, {{WRAPPER}} .counter h3::after' => 'background:{{VALUE}};',
				],
				'condition' =>[
					'style'=>'style5', 
				]
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .counter-top-area:hover .count-text .title,{{WRAPPER}} {{WRAPPER}} .counter h3:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',				
				'selector' => '{{WRAPPER}} .count-text .title, {{WRAPPER}} .counter h3',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Sub Title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-counter-list .subtitle' => 'color: {{VALUE}};',
				],
				'condition' =>[
					'style!'=>'style5', 
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_subtitle',				
				'selector' => '{{WRAPPER}} .rs-counter-list .subtitle',
				'condition' =>[
					'style!'=>'style5', 
				]
			]
		);
		$this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .count-text .title, {{WRAPPER}} .counter h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'title_padding',
		    [
		        'label' => esc_html__( 'Title Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .count-text .title, {{WRAPPER}} .counter h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'subtitle_margin',
		    [
		        'label' => esc_html__( 'SubTitle Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-counter-list .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' =>[
					'style!'=>'style5',
				]
		    ]
		);
		$this->add_responsive_control(
		    'title_number_wrapper_padding',
		    [
		        'label' => esc_html__( 'Title & Number Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' =>[
					'style'=>'style5',
				]
		    ]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'icon_align',
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
                    '{{WRAPPER}} .counter-icon' => 'text-align: {{VALUE}}'
                ],                
				'separator' => 'before',
				'condition'=>[
					'style!'=>'style5',
				],
            ]
        );
        $this->add_responsive_control(
            'icon_alignment_position',
            [
                'label' => esc_html__( 'Icon Align Position', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],

                ],
                'condition' => [
                    'style' => 'style2',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon' => 'align-self: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_icon',				
				'selector' => '{{WRAPPER}} .counter-icon i, {{WRAPPER}} .counter .counter-icon',
		        'condition' => [
		            'icon_type' => 'icon',
		        ],
			]
		);
		$this->add_responsive_control(
		    'icon_width',
		    [
		        'label' => esc_html__( 'Icon/Image Part Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .counter-icon svg' => 'width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .counter .counter-icon' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_height',
		    [
		        'label' => esc_html__( 'Icon/Image Part Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .counter-icon svg' => 'height: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .counter .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Icon/Image Part Line Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon, {{WRAPPER}} .counter-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .counter .counter-icon' => 'line-height: {{SIZE}}{{UNIT}};',
		        ],              
		    ]
		);
		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon img, {{WRAPPER}} .counter .counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                  'icon_type' => 'image'
                ],
		    ]
		);
		$this->add_responsive_control(
		    'image_height',
		    [
		        'label' => esc_html__( 'Image Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon img, {{WRAPPER}} .counter .counter-icon img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                  'icon_type' => 'image'
                ],
		    ]
		);
		$this->add_responsive_control(
		    'image_vertical_position',
		    [
				'label'      => esc_html__( 'Image Vertical Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon img' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'image_horizontal_position',
		    [
				'label'      => esc_html__( 'Image Horizontal Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 500,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon img' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Icon Part Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'Icon Part Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition'=>[
					'style!'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'icon_wrapper_margin_style_five',
		    [
		        'label' => esc_html__( 'Icon/Image Wrapper Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%','custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition'=>[
					'style'=>'style5',
				],
		    ]
		);
		$this->add_responsive_control(
		    'icon__margin_style_five',
		    [
		        'label' => esc_html__( 'Icon/Image Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%','custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .counter-icon > * ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition'=>[
					'style'=>'style5',
				],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
		        'name' => 'icon_part_bg_for_style_five',
		        'label' => esc_html__( 'Background', 'rsaddon' ),
		        'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .counter .counter-icon',
		        'condition'=>[
					'style'=>'style5',
				],
		    ]
		);
		$this->add_control(
		    'icon_part_border_radius_for_style_five',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%','custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->start_controls_tabs( 'back_part_btn_tabs' );

		    $this->start_controls_tab(
		        'icon_tabs_normal',
		        [
		            'label' => esc_html__( 'Normal', 'rsaddon' ),
		            'condition'=>[
						'style!'=>'style5',
				    ],
		        ]
		    );
		    	$this->add_group_control(
		    	    Group_Control_Border::get_type(),
		    	    [
		    	        'name' => 'icon_part_border',
		    	        'selector' => '{{WRAPPER}} .counter-icon',
		    	        'condition'=>[
							'style!'=>'style5',
				    	],
		    	    ]
		    	);

				$this->add_control(
				    'icon_part_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				        'condition'=>[
							'style!'=>'style5',
				    	],
				    ]
				);

		    	$this->add_group_control(
		    	    Group_Control_Box_Shadow::get_type(),
		    	    [
		    	        'name' => 'icon_part_box_shadow',
		    	        'selector' => '{{WRAPPER}} .counter-icon',
		    	        'condition'=>[
							'style!'=>'style5',
				    	],
		    	    ]
		    	);

				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,				
						'selectors' => [
							'{{WRAPPER}} .counter-icon i' => 'color: {{VALUE}};',
						],
						'condition'=>[
								'style!'=>'style5',
				    	],
					]
				);

				$this->add_control(
					'icon_border_color',
					[
						'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,				
						'selectors' => [
							'{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'border-color: {{VALUE}};',
						],
						'condition'=>[
								'style!'=>'style5',
				    	],
					]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
				    [
				        'name' => 'icon_part_bg',
				        'label' => esc_html__( 'Background', 'rsaddon' ),
				        'types' => [ 'classic', 'gradient' ],
				        'selector' => '{{WRAPPER}} .counter-icon',
				        'condition'=>[
								'style!'=>'style5',
				    	],
				    ]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
			    'icon_tabs_hover',
			    [
			        'label' => esc_html__( 'Hover', 'rsaddon' ),
			        'condition'=>[
			        	'style!'=>'style5',
			        ],
			    ]
			);
				$this->add_group_control(
				    Group_Control_Border::get_type(),
				    [
				        'name' => 'icon_part_hover_border',
				        'selector' => '{{WRAPPER}} .counter-top-area:hover .counter-icon',
				        'condition'=>[
								'style!'=>'style5',
				    	],
				    ]
				);

				$this->add_control(
				    'icon_part_hover_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .counter-top-area:hover .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				        'condition'=>[
								'style!'=>'style5',
				    	],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Box_Shadow::get_type(),
				    [
				        'name' => 'icon_part_hover_box_shadow',
				        'selector' => '{{WRAPPER}} .counter-top-area:hover .counter-icon',
				        'condition'=>[
								'style!'=>'style5',
				    	],
				    ]
				);

				$this->add_control(
					'icon_hover_color',
					[
						'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,				
						'selectors' => [
							'{{WRAPPER}} .counter-top-area:hover .counter-icon i' => 'color: {{VALUE}};',
						],
						'condition'=>[
								'style!'=>'style5',
				    	],
					]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
				    [
				        'name' => 'icon_part_hover_bg',
				        'label' => esc_html__( 'Background', 'rsaddon' ),
				        'types' => [ 'classic', 'gradient' ],
				        'selector' => '{{WRAPPER}} .counter-icon',
				        'condition'=>[
								'style!'=>'style5',
				    	],
				    ]
				);

		    $this->end_controls_tab();
		$this->end_controls_tabs();
	$this->end_controls_section();
	$this->start_controls_section(
			'ovarlay_bg_style',
			[
				'label' => esc_html__( 'Ovarlay Background Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style2',
				],
			]
	);
	$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after',
			]
	);
	$this->add_responsive_control(
			'overlay_bg__width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
	);
	$this->add_responsive_control(
			'overlay_bg__height',
			[
				'label' => esc_html__( 'Height', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
	);
	$this->add_control(
			'overlay_bg_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	);
	$this->add_responsive_control(
		    'overlay_horizontal_position',
		    [
				'label'      => esc_html__( 'Horizontal Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
	);
	$this->add_responsive_control(
		    'overlay_vertical_position',
		    [
				'label'      => esc_html__( 'Vertical Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-top-area.style2 .rs-counter-list .counter-icon:after' => 'bottom: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
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
		$this->add_inline_editing_attributes( 'suffix', 'basic' );
        $this->add_render_attribute( 'suffix', 'class', 'suffix' );	

        $this->add_inline_editing_attributes( 'number', 'basic' );
        $this->add_render_attribute( 'number', 'class', 'rs-counter' );

        $this->add_inline_editing_attributes( 'prefix', 'basic' );
        $this->add_render_attribute( 'prefix', 'class', 'prefix' );	

        $this->add_inline_editing_attributes( 'subtitle', 'basic' );
        $this->add_render_attribute( 'subtitle', 'class', 'subtitle' );
		$this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title' );
		
		?>
			<?php if ( "style1" == $settings['style'] || "style2" == $settings['style'] || "style3" == $settings['style'] || "style4" == $settings['style'] ){ ?>
			<div class="counter-top-area <?php echo esc_html($settings['count_down_skew']); ?>  <?php echo esc_attr( $settings['style']);?> rs-gradient-<?php echo esc_attr( $settings['show_gradient']);?> clip_<?php echo esc_attr( $settings['clip_yes_no']);?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">
			    <div class="rs-counter-list">
				<?php if(!empty($settings['subtitle']) || 'yes' === $settings['show_subtitle']) : ?>
				    		<span <?php echo esc_attr($this->print_render_attribute_string('subtitle'));?>>  <?php echo esc_html($settings['subtitle']);?> </span>	
				<?php endif; ?>
			    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
			    		<div class="counter-icon">
				    		<?php if(!empty($settings['selected_icon'])) : ?>
								<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				    		<?php endif; ?>

				    		<?php if(!empty($settings['selected_image'])) :?>
				    			<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
				    		<?php endif;?>
			    		</div>	

			    	<?php } ?>
			    		       
				    <div class="count-text">
				    	<div class="count-number">
				    		<?php if($settings['suffix']) :?><span <?php echo esc_attr($this->print_render_attribute_string('suffix'));?>><?php echo esc_html($settings['suffix']);?></span><?php endif; ?>
				    			<span <?php echo esc_attr($this->print_render_attribute_string('number'));?>> <?php echo esc_html($settings['number']);?></span>
				    		<?php if($settings['prefix']) :?><span <?php echo esc_attr($this->print_render_attribute_string('prefix'));?>><?php echo esc_html($settings['prefix']);?></span><?php endif; ?>
				    	</div>

				    	<?php if(!empty($settings['title'])) : ?>
				    		<span <?php echo esc_attr($this->print_render_attribute_string('title'));?>><?php echo wp_kses_post($settings['title']);?></span>	
				    	<?php endif; ?>	

				    </div>
				</div>
			</div>
			<?php } ?>
		
			<?php if ( "style5" == $settings['style'] ){ ?>
				<div class="counter">
	                <div class="counter-icon">
	                    <?php if(!empty($settings['selected_icon'])) : ?>
								<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					    <?php endif; ?>
					    <?php if(!empty($settings['selected_image'])) :?>
					    		<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/>
					    <?php endif;?>
	                </div>
	                <div class="count-number">
	                	<span class="rs-counter"><?php echo esc_html($settings['number']);?></span>
	                	<span class="plusss"><?php echo esc_html($settings['prefix']);?></span>
	                </div>
	                <h3><?php echo esc_html($settings['title']);?></h3>
            </div>
			<?php } ?>
		<?php
	}
}
