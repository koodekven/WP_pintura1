<?php
/**
 * Elementor RS video Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSvideo_Widget extends \Elementor\Widget_Base {

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
		return 'rs-video';
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
		return __( 'RS Video', 'rsaddon' );
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
		return 'glyph-icon flaticon-multimedia';
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
		return [ 'video' ];
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
				'label' => esc_html__( 'Content', 'rsaddon' ),
			]
		);

		$this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Scheme', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Scheme', 'rsaddon'),			
					'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon')				
				],											
			]
		);

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Title Alignment', 'rsaddon' ),
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
                'default'     => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-video' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_control(
			'rs_video_style',
			[
				'label'   => esc_html__( 'Select Video Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
					'style4' => esc_html__( 'Style 4 (Text Link)', 'rsaddon'),
					'style5' => esc_html__( 'External link (MP4 Video)', 'rsaddon'),
				],
			]
		);
	
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Enter Link Here', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__( 'Video link here', 'rsaddon' ),				
				'separator' => 'before',
			]
		);
	
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Background Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'separator' => 'before',
				'condition' => [
		            'rs_video_style' => ['style1', 'style2'],
		        ],
			]
		);

		$this->add_control(
            'show_svg_icon',
            [
				'label'        => esc_html__( 'Shape Show/Hide', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
		            'rs_video_style' => 'style4'
		        ],
            ]
        );

		$this->add_control(
			'rs_video_title',
			[
				'label' => esc_html__( 'Video Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'condition' => [
		            'rs_video_style' => 'style2'
		        ],
			]
		);

		$this->add_control(
			'section_icons',
			[
				'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'rs_video_style!' => 'style2',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'condition' => [
					'rs_video_style!' => ['style2','style4'],
				],
			]
		);

		$this->add_control(
		    'icon_show_hide4',
		    [
		        'label' => esc_html__( 'Icon Show/Hide', 'rsaddon' ),
		        'type' => Controls_Manager::SWITCHER,
		        'label_on' => esc_html__( 'Show', 'rsaddon' ),
		        'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        'condition' => [
		        	'rs_video_style' => 'style4',
		        ],
		        'return_value' => 'yes',
		        'default' => 'no',
		    ]
		);

		$this->add_control(
			'image_show_hide4',
			[
				'label' => esc_html__( 'Image Show/Hide', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'image_video_icon_style_4',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'image_show_hide4' => 'yes',
				],
			]
		);

		$this->add_control(
			'image_video_icon_style_4_width',
			[
				'label' => esc_html__( 'Image Gap Right', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .popup-text-video img' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_show_hide4' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
		    'icon_right_gap',
		    [
		        'label' => esc_html__( 'Icon Right Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'condition' => [
		        	'rs_video_style' => 'style4',
		        	'icon_show_hide4' => 'yes',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} i' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-smile-o',
				'condition' => [
					'icon_type' => 'icon',
					'rs_video_style!' => 'style2',
				],				
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
					'rs_video_style!' => ['style2','style4'],
				],
			]
		);

		$this->add_responsive_control(
		    'selected_image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video .popup-videos img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
					'icon_type' => 'image',
				],
		    ]
		);
		
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Video Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,	
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__( 'Add your video description here..', 'rsaddon' ),
				'separator' => 'before',
			]
			
		);

        $this->add_control(
			'writing_mode',
			[
				'label'   => esc_html__( 'Writing Mode', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [					
					'normal' => esc_html__( 'Normal', 'rsaddon'),
					'vertical_rl' => esc_html__( 'Vertical-rl', 'rsaddon'),
					'vertical_lr' => esc_html__( 'Vertical-lr', 'rsaddon'),
				],
			]
		);
		
		$this->end_controls_section();

				
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_style2',
			[
				'label' => esc_html__( 'Title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .video_title' => 'color: {{VALUE}};',
				],				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_text',				
				'selector' => '{{WRAPPER}} .video_title',
				
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Content Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .popup-text-video, {{WRAPPER}} .video-desc , {{WRAPPER}} .rs-video.style4 p' => 'color: {{VALUE}};',
				],

				
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Content Text Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .popup-text-video:hover, {{WRAPPER}} .video-desc:hover' => 'color: {{VALUE}};',
				],

				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',				
				'selector' => '{{WRAPPER}} .popup-text-video, {{WRAPPER}} .video-desc , {{WRAPPER}} .rs-video.style4 p',
				
			]
		);

		$this->add_responsive_control(
            'video_title_postion',
            [
                'label' => esc_html__( 'Content Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
               'range' => [
                   'px' => [
                       'min' => -500,
                       'max' => 500,
                   ],
               ],                
                'selectors' => [
                    '{{WRAPPER}} .popup-text-video, {{WRAPPER}} .rs-video .video-desc' => 'top: {{SIZE}}px;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'video_title_horaizontal',
            [
                'label' => esc_html__( 'Content Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
               'range' => [
                   'px' => [
                       'min' => -500,
                       'max' => 500,
                   ],
               ],                
                'selectors' => [
                    '{{WRAPPER}} .popup-text-video, {{WRAPPER}} .rs-video .video-desc' => 'left: {{SIZE}}px;',                   
                ],
            ]
        );

        $this->add_responsive_control(
		    'video_full_area_padding',
		    [
		        'label' => esc_html__( 'Area Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'video_inner_area_padding',
		    [
		        'label' => esc_html__( 'Inner Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'description_margin_style_four',
		    [
		        'label' => esc_html__( 'Description Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video.style4 p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
                	'rs_video_style' => 'style4',
                ],
		    ]
		);

		$this->add_control(
		    'gradient_border_enable',
		    [
		        'label' => esc_html__( 'Gradient Border Background', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'default' => 'disable',
		        'options' => [
		        	'enable' => esc_html__( 'Enable', 'rsaddon'),
		        	'disable' => esc_html__( 'Disable', 'rsaddon'),
		        ],
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_gradient_border',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
                	'gradient_border_enable' => 'enable',
                ],
                'selector' => '{{WRAPPER}} .gradient-border-enable a:after',
            ]
        );

		$this->add_responsive_control(
		    'video_height',
		    [
		        'label' => esc_html__( 'Video height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video .video-wrapper' => 'height: {{SIZE}}{{UNIT}};',
		        ],
				'condition' => [
                	'rs_video_style' => 'style5',
                ],
		    ]
		);

		$this->add_responsive_control(
		    'video_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video .video-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
                	'rs_video_style' => 'style5',
                ],
		    ]
		);
		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'gradient_icon_color',
		    [
		        'label' => esc_html__( 'Gradient Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'enable' => esc_html__( 'Enable', 'rsaddon'),
		        	'disable' => esc_html__( 'Disable', 'rsaddon'),
		        ],
		        'default' => 'disable',
		    ]
		);
		

		$this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
		        'name' => 'background',
		        'label' => __( 'Background', 'plugin-domain' ),
		        'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .rs-video i',
		        'condition' => [
		        	'gradient_icon_color' => 'enable',
		        ],
		    ]
		);

		$this->add_control(
			'icon_btn',
			[
				'label' => esc_html__( 'Button Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inner .rs-icon-btn a' => 'color: {{VALUE}};',
				],
				'condition' => [
		            'rs_video_style' => 'style2',
		            'gradient_icon_color' => 'disable',
		        ],
			]
		);


		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style4 a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gradient_icon_color' => 'disable',
				],
			]
		);

		$this->add_control(
			'icon_color_hoverd',
			[
				'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video.style4 a:hover i, {{WRAPPER}} .rs-video .rs-icon-inners .popup-text-video:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gradient_icon_color' => 'disable',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video.style4 a:hover i, {{WRAPPER}} .rs-video .rs-icon-inners .popup-text-video:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'gradient_icon_color' => 'disable',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_icon',				
				'selector' => '{{WRAPPER}} .rs-video .popup-videos i, {{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border i, {{WRAPPER}} .rs-video.style4 a i',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
		        'name' => 'popup_background',
		        'label' => __( 'Background', 'plugin-domain' ),
		        'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .rs-video .popup-videos, {{WRAPPER}} .rs-video .popup-videos:before, {{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border',
		    ]
		);


		$this->add_control(
			'icon_border',
			[
				'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video .overly-border' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border:after' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
            'video_icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .popup-videos' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rs-video .popup-videos:before' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-video .popup-videos:after' => 'width: {{SIZE}}{{UNIT}};',             
                    '{{WRAPPER}} .rs-video .popup-text-video img' => 'width: {{SIZE}}{{UNIT}};',             
                ],
            ]
        );

		$this->add_responsive_control(
            'video_icon_height',
            [
                'label' => esc_html__( 'Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .popup-videos' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-video .popup-videos:before' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-video .popup-videos:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'video_icon_postion_ver',
            [
                'label' => esc_html__( 'Icon Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .overly-border' => 'top: {{SIZE}}%;',                   
                    '{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border' => 'top: {{SIZE}}px;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'video_icon_postion_ht',
            [
                'label' => esc_html__( 'Icon Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .overly-border' => 'left: {{SIZE}}%;',                   
                    '{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border' => 'left: {{SIZE}}%;',                   
                ],
            ]
        );
        $this->add_responsive_control(
			'icon_left',
			[
				'label' => esc_html__( 'Icon Left Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_top',
			[
				'label' => esc_html__( 'Icon Top Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'video_close_icon_bg',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Close Icon Background', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

		$this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
		        'name' => 'close_icon_gradiant_background',
		        'label' => __( 'Background', 'rsaddon' ),
		        'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .mfp-close-btn-in .mfp-close',
		    ]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper',
			[
				'label' => esc_html__( 'Wrapper', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'wrapper_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video:before' => 'width: {{SIZE}}{{UNIT}};opacity:0.6;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'wrapper_height',
		    [
		        'label' => esc_html__( 'Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video:before' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bgim',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-video:before',
            ]
        );

		$this->add_responsive_control(
		    'video_wrapper_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
            'wrapper_opacity',
            [
                'label' => esc_html__( 'Wrapper Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-video:before' => 'opacity: {{SIZE}};',
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
		$rand = rand(12, 3330);

		$this->add_inline_editing_attributes( 'description', 'basic' );
        $this->add_render_attribute( 'description', 'class', 'video-desc' ); 

        $align = '';
		if (!empty($settings['align'])) {
			$align = $settings['align'];
		}

		?>
  		<div class="rs-video video-item-<?php echo esc_attr($rand);?> writing-<?php echo esc_html($settings['writing_mode']) ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?> <?php echo esc_html($align);?> gradient-border-<?php echo esc_attr($settings['gradient_border_enable']); ?> gradient-icon-<?php echo esc_attr($settings['gradient_icon_color']); ?> <?php echo esc_html($settings['rs_video_style']);?>" <?php if(!empty($settings['image']['url'])):?>style="background: url(<?php echo esc_url($settings['image']['url']);?>);"<?php endif;?>>


   				<?php if($settings['rs_video_style'] == 'style1') { ?>	
  						<div class="overly-border">
						    <?php if(!empty($settings['selected_icon'])) : ?>
				    			<a class="popup-videos icon-type" href="<?php echo esc_url($settings['video_link']);?>">
				    				<i class="ri-play-fill"></i>
				    			</a>
				    		<?php endif; ?>

				    		<?php if(!empty($settings['selected_image'])) :?>
				    			<a class="popup-videos image-type" href="<?php echo esc_url($settings['video_link']);?>"><img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/></a>
				    		<?php endif;?>
						</div>
				    <?php if( !empty( $settings['description'])) : ?>
				    	<div <?php echo $this->print_render_attribute_string('description'); ?>>
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif; ?>
				<?php }; ?>

				<?php if($settings['rs_video_style'] == 'style2') : ?>	
  					<span class="video_title"><?php echo esc_html($settings['rs_video_title']); ?></span>
				    <?php if( !empty( $settings['description'])) : ?>
				    	<div class="video-desc">
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif;?>
				    <div class="rs-icon-inners">
  						<?php if($settings['rs_video_style'] == 'style2'): ?>
	  						<div class="animate-border">
							    <a class="popup-border" href="<?php echo esc_url($settings['video_link']);?>">
									<i class="fa fa-play"></i>
								</a>
							</div>
  						<?php endif; ?>
					</div>
				<?php endif; ?>

   				<?php if($settings['rs_video_style'] == 'style3') { ?>	
					<div class="overly-border">
			    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
			    		<div class="icon-area">
				    		<?php if(!empty($settings['selected_icon'])) : ?>
				    			<a class="popup-videos icon-type" href="<?php echo esc_url($settings['video_link']);?>">
				    				<i class="ri-play-fill"></i>
				    			</a>
				    		<?php endif; ?>

				    		<?php if(!empty($settings['selected_image'])) :?>
				    			<a class="popup-videos image-type" href="<?php echo esc_url($settings['video_link']);?>">
				    				<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
				    			</a>
				    		<?php endif;?>
			    		</div>
			    	<?php }?>
					</div>
				    <?php if( !empty( $settings['description'])) : ?>
				    	<div <?php echo $this->print_render_attribute_string('description'); ?>>
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif; ?>

				<?php }; ?>


				<?php if($settings['rs_video_style'] == 'style4') { ?>	
			    	<?php if( !empty($settings['description'])){?>

			    		<?php if( !empty( $settings['description'])) : ?>
		    					<p><?php echo wp_kses_post($settings['description']); ?></p>
		    			<?php endif; ?>
			    		<a class="popup-text-video" href="<?php echo esc_url($settings['video_link']);?>">
			    			
			    			<?php if('yes' == $settings['icon_show_hide4']){?>
			    				<i class="<?php echo esc_html($settings['selected_icon']);?>"></i>
			    			<?php } ?>
							<?php echo '<img src="' . esc_url($settings['image_video_icon_style_4']['url']) . '" alt="' . esc_attr(Control_Media::get_image_alt($settings['image_video_icon_style_4'])) . '">'; ?>

		    			</a>
			    	<?php }?>
				<?php }; ?>


				<?php if($settings['rs_video_style'] == 'style5') { ?>
			    	<div class="video-wrapper">
						<video autoplay muted loop playsinline preload="metadata">
							<source src="<?php echo esc_url($settings['video_link']);?>">
						</video>
					</div>
				<?php }; ?>
				    
			</div>	


		<script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.popup-videos, .popup-text-video').magnificPopup({
			        disableOn: 10,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,
			        fixedContentPos: false
			    }); 
			});
		</script>
    
<?php 
	}
}