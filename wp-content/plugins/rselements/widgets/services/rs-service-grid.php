<?php
/**
 *
 * @since 1.0.0
 */
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSservices_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rs-service-grid';
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
		return esc_html__( 'RS Services Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-support';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {
					 
		// ----------------------------------------  Service Global Card  ------------------------------
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Services Global', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'primary_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Color', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Color', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon')				
				],											
			]
		);
		$this->add_control(
			'services_style',
			[
				'label'   => esc_html__( 'Services Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [					
					'1' => esc_html__( 'Style 1', 'rsaddon'),
                    '2' => esc_html__( 'Style 2', 'rsaddon'),
                    '3' => esc_html__( 'Style 3', 'rsaddon'),
                    '4' => esc_html__( 'Style 4', 'rsaddon'),
                    '5' => esc_html__( 'Style 5', 'rsaddon'),
                    '6' => esc_html__( 'Style 6', 'rsaddon'),
                    '7' => esc_html__( 'Style 7', 'rsaddon'),
                    '8' => esc_html__( 'Style 8', 'rsaddon'),
                    '9' => esc_html__( 'Style 9', 'rsaddon'),
                    '10' => esc_html__( 'Style 10', 'rsaddon'),
                    '11' => esc_html__( 'Style 11', 'rsaddon'),
                    '12' => esc_html__( 'Style 12', 'rsaddon'),
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
                    '{{WRAPPER}} .services-inner' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
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
                    '{{WRAPPER}} .services-inner' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
                'condition' => [
                    'services_style!' => '3',
                ]
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
                    '{{WRAPPER}} .services-inner' => 'align-items: {{VALUE}};',
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
                    '{{WRAPPER}} .services-inner' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'flex_box_h_align',
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
				'default' => 'flex-start',
				'condition' => [
					'box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .services-inner' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section(); // Service Global End

		// ----------------------------------------  Service Numbering Start ------------------------------
		$this->start_controls_section(
			'_service_numbering',
			[
				'label' => esc_html__( 'Numbering', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'services_style' => ['1','6','7','8','10'],
				]
			]
		);
		$this->add_control(
            'numbering_show_hide',
            [
                'label' => esc_html__( 'Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
		$this->add_control(
			'numbering_txt',
			[
				'label'       => esc_html__( 'Number', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				// 'label_block' => true,
				'placeholder' => esc_html__( '01', 'rsaddon' ),
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);
		$this->end_controls_section(); //End Service Numbering


		// ----------------------------------------  Service Style Four Feature List ------------------------------
		$this->start_controls_section(
			'service_feature_list',
			[
				'label' => esc_html__( 'Feature', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'services_style' => '4',
				]
			]
		);
		$this->add_control(
		    'feature_title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'rsaddon' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'rsaddon' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'rsaddon' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'rsaddon' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'rsaddon' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'rsaddon' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'rsaddon' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h2',
		        'toggle' => false,
		    ]
		);
		$this->add_control(
            'feature_title',
            [
                'label'       => esc_html__( 'Feature Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Feature Title', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'feature_image',
            [
                'label' => esc_html__( 'Feature Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,  
                'separator' => 'before',
            ]
        ); 
		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
            ]
        );  
        $repeater = new Repeater();
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '100GB free space with hosting', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
			'feature_list_link',
			[
				'label' => esc_html__( 'Link', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'rsaddon' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
        $repeater->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',            
                'options' => [                  
                    'icon' => esc_html__( 'Icon', 'rsaddon'),
                    'image' => esc_html__( 'Image', 'rsaddon'),        
                    'feature_icons' => esc_html__( 'Icons', 'rsaddon'),        
                ],
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(),
                'default' => 'fa fa-check',  
                'condition' => [
                    'icon_type' => 'icon',
                ],              
            ]
        );
        $repeater->add_control(
			'feature_icons',
			[
				'label' => esc_html__( 'Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
                    'icon_type' => 'feature_icons',
                ],  
			]
		);
        $repeater->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
                
                'condition' => [
                    'icon_type' => 'image',
                ], 
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( '100GB Free Space with Hosting', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'feature_list_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'text' => esc_html__( 'Responsive Features List', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'feature_list_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'text' => esc_html__( 'Auto Renew After Finish', 'rsaddon' ),
                        'icon' => 'fa fa-close',
                        'feature_list_link' => [
                            'url' => '#',
                        ], 
                    ],
                    [
                        'text' => esc_html__( 'Hurry UP! RSElements Now Free', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'feature_list_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->end_controls_section();//End Service Style Four Feature List

		//  Feature Image Control For Style6 Start
		$this->start_controls_section(
			'feature_image_control_section_style6',
			[
				'label' => esc_html__( 'Feature Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'services_style' => '6'
				]
			]
		);
		$this->add_control(
            'feature_image_show_hide_style6',
            [
                'label' => esc_html__( 'Image Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
		$this->add_control(
			'select_feature_image_style6',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'feature_image_show_hide_style6' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		//  Feature Image Control For Style6 End

		// ----------------------------------------  Service Icon & Image Start ------------------------------
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'icon_image_show_hide',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
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
					'icon_image_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
		    'selected_icon',
		    [
		        'label' => __( 'Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => '',
		            'library' => '',
		        ],
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'icon',
				],
		    ]
		);
		$this->add_control(
		    'selected_icon_hover',
		    [
		        'label' => __( 'Hover Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => '',
		            'library' => '',
		        ],
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'icon',
					'services_style' => '2'
				],
		    ]
		);
       
		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Feature Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',

				],
			]
		);
		
		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail12',
                'default' => 'large',
                'separator' => 'before',
				'condition' => [
					'services_style' => '12'
				],
            ]
        );  
        $this->add_responsive_control(
            'icon_image_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .image_style img' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'icon_type' => 'image',
                    
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_image_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .image_style img' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'icon_type' => 'image',
                    
                ]
            ]
        );
		$this->add_control(
			'icon_bg_enable',
			[
				'label'   => esc_html__( 'Icon Background', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [					
					'default' => esc_html__( 'Default', 'rsaddon'),
                    'icon-background' => esc_html__( 'Icon Background', 'rsaddon'),
				],
				'condition' => ['services_style' => '1']
			]
		);
		$this->add_control(
			'icon_img_style_three',
			[
				'label' => esc_html__( 'Icon Option', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
			]
		);
		$this->add_control(
			'overlay_icon_type',
			[
				'label'   => esc_html__( 'Select Image Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'images',			
				'options' => [					
					'icons' => esc_html__( 'Icon', 'rsaddon'),
					'images' => esc_html__( 'Image', 'rsaddon'),
				],
				'condition' => [
					'services_style' => ['3','9'],
					'icon_image_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
		    'overlay_selected_icon',
		    [
		        'label' => __( 'Icons', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => '',
		            'library' => '',
		        ],
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'icons',
					'services_style' => ['3','9'],
					
				],
		    ]
		);
		$this->add_control(
			'overlay_image',
			[
				'label' => esc_html__( 'Choose Image Here', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'images',
					'services_style' => '3',
					'services_style' => '2',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_image_style_two',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services.style2 .services-inner .media_wrap .overly_style_icon_normal',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'images',
					'services_style' => '2',
				],
			]
		);
		$this->add_control(
			'overlay_image_style_two_hove_heading',
			[
				'label' => esc_html__( 'Hover Background', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'images',
					'services_style' => '2',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_image_style_two_hover',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services.style2 .services-inner:hover .media_wrap .overly_style_icon_normal',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'images',
					'services_style' => '2',
				],
			]
		);
		$this->add_control(
			'overlay_image_style_two_show',
			[
				'label' => esc_html__( 'Show Icon Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'=>[
                    'services_style' => ['2'],
                ],
				
			]
		);
		$this->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Icon Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'overlay_icon_type' => 'images',
					'services_style' => ['3','9','12'],
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'service_border_enabel_border',
		        'selector' => '{{WRAPPER}} .rs-addon-services.style6 .services-inner.yes .media-cmn:after',
				'condition' => [
					'services_style' => '6',
				],
		    ]
		);
		$this->end_controls_section();// Service Icon & Image End
		 
		// ----------------------------------------  Service Title & Description Start ------------------------------
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title & Description', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_position_top',
			[
				'label' => esc_html__( 'Title Position Top', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'True', 'rsaddon' ),
				'label_off' => esc_html__( 'False', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'services_style' => ['8','9'],
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Services Title',
				'placeholder' => esc_html__( 'Services Title', 'rsaddon' ),
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'title_link',
			[	'label_block' => true,
				'label' => esc_html__( 'Title Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '#', 'rsaddon' ),			
			]
		);
		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'yes' => esc_html__( 'Yes', 'rsaddon'),					

				],
			]
		);
		$this->add_control(
		    'title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'rsaddon' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'rsaddon' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'rsaddon' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'rsaddon' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'rsaddon' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'rsaddon' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'rsaddon' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h2',
		        'toggle' => false,
		    ]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,				
				'default' => esc_html__( 'Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rsaddon' ),
				'separator' => 'before',
			]			
		);
		$this->end_controls_section(); // Service Title & Description End

		// ----------------------------------------  Content Part Alignment Start ------------------------------
		$this->start_controls_section(
			'content_part_alignment',
			[
				'label' => esc_html__( 'Content Part Alignment', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'services_style!' => '3',
                ]
			]
		);
		$this->add_responsive_control(
            'content_box_horizontal_align',
            [
                'label' => esc_html__( 'Content Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .content_part' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'content_box_vertical_align',
            [
                'label' => esc_html__( 'Vertical Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
				'default' => 'flex-start',
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content_part' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_column_align',
            [
                'label' => esc_html__( 'Box Column', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
				'default' => 'column',
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content_part' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section(); // Content Part Alignment End
		
		// ----------------------------------------  Service Button Start ------------------------------
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'services_style!' => '3',
                ]
			]
		);
		$this->add_control(
            'button_show_hide',
            [
                'label' => esc_html__( 'Button Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
		$this->add_responsive_control(
            'button__align',
            [
                'label' => esc_html__( 'Button Style (Inline / Block)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
					'flex' => [
                        'title' => esc_html__( 'Flex', 'rsaddon' ),
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
                    '{{WRAPPER}} .content_part .btn-part a' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
				'condition' => [
					'button_show_hide' => 'yes',
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
				'default' => 'flex-start',
				'condition' => [
					'button__align' => 'flex',
					'button_show_hide' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content_part .btn-part a' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_flex_direction',
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
					'button__align' => 'flex',
					'button_show_hide' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content_part .btn-part a' => 'flex-direction: {{VALUE}};',
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
				'default' => 'flex-start',
				'condition' => [
					'button__align' => 'flex',
					'button_show_hide' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content_part .btn-part a' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'btn_writing_mode',
            [
                'label' => esc_html__( 'Writing Mode', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'unset' => [
                        'title' => esc_html__( 'Default', 'rsaddon' ),
                        'icon' => 'eicon-animation-text',
                    ],
                    'vertical-rl' => [
                        'title' => esc_html__( 'Vertical-rl', 'rsaddon' ),
                        'icon' => 'eicon-redo',
                    ],

                ],
				'default' => 'unset',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .btn-part' => 'writing-mode: {{VALUE}};',
                ],
                'condition' => [
                    'button_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}} .rs-addon-services .services-inner .content_part .btn-part a' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-services .services-inner .content_part .btn-part' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
				'condition' => [
					'button_show_hide' => 'yes',
				]
            ]
        );
		$this->add_control(
            'default_icon_show_hide',
            [
                'label' => esc_html__( 'Default Icon', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style' => '3',
				]
            ]
        );
		$this->add_control(
			'btn__icon_type',
			[
				'label'   => esc_html__( 'Select Button Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',			
				'options' => [					
					'default' => esc_html__( 'Default', 'rsaddon'),
					'icon' => esc_html__( 'Icon', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
					'default_icon_show_hide!' => 'yes',
				],
			]
		);
		$this->add_control(
		    'btn__selected_icon',
		    [
		        'label' => __( 'Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
				'condition' => [
					'button_show_hide' => 'yes',
				],
		    ]
		);
		$this->add_control(
			'button_icon_postion',
			[
				'label'   => esc_html__( 'Icon Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',			
				'options' => [					
					'left' => esc_html__( 'Left', 'rsaddon'),
					'right' => esc_html__( 'Right', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
		    '_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Margin Left', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg' => 'margin-left: {{SIZE}}{{UNIT}};',
						            
		        ],
		        'condition' => [
					'button_show_hide' => 'yes',
				],	
		    ]
		);	
		$this->add_control(
		    '_btn_icon_spacing_right',
		    [
		        'label' => esc_html__( 'Icon Margin Right', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
					'{{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
						            
		        ],
		        'condition' => [
					'button_show_hide' => 'yes',
				],	
		    ]
		);
		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Read More', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'button_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( '#', 'rsaddon' ),
				'condition' => [
					'button_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
			'services_btn_link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'yes' => esc_html__( 'Yes', 'rsaddon'),
				],
				'condition' => [
					'button_show_hide' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_icon_bg_border',
			[
				'label' => esc_html__( 'Show Icon Bg & Border', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style' => '1',
				],
			]
		);
		$this->add_control(
			'button_icon_default_show_hide',
			[
				'label' => esc_html__( 'Default Icon Show/Hide?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_show_hide' => 'yes',
					'services_style' => '1',
				],
			]
		);
		$this->end_controls_section(); // Service Button End
		/**
         * Style Tab
         * ------------------------------ Icon / Image Global Style ------------------------------
         *
         */
		$this->start_controls_section(
		    '_section_area_style',
		    [
		        'label' => esc_html__( 'Global Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'services_style!' => '3',
                ]
		    ]
		);

		$this->add_responsive_control(
		    'item_padding_area',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'item_margin_area',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'shape_enable',
			[
				'label' => esc_html__( 'Shape Enable?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['services_style' => '1']
			]
		);
		// ----------------------------------------  Global Style Hover & Normal Tab Start ------------------------------
		$this->start_controls_tabs( '_tabs_global' );
			// Normal Start
			$this->start_controls_tab(
				'style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'rsaddon' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'global_background',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner',
				]
			);
			$this->add_responsive_control(
				'item_border_radius_area',
				[
					'label' => esc_html__( 'Border Radius', 'rsaddon' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .rs-addon-services .services-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
						'{{WRAPPER}} .rs-addon-services.style1 .services-inner.gradient-border-enable:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'item_border',
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'services_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner'
				]
			);
			$this->end_controls_tab(); // Normal End 
			
			// Hover Start
			$this->start_controls_tab(
				'style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'rsaddon' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'global_background_hover',
					'label' => esc_html__( 'Background', 'rsaddon' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover',
				]
			);
			$this->add_control(
			'hover_bg_img_heading',
				[
					'label' => esc_html__( 'Hover Bg Image', 'rsaddon' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			
			$this->add_responsive_control(
				'item_border_radius_area_hover',
				[
					'label' => esc_html__( 'Border Radius', 'rsaddon' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .rs-addon-services .services-inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
						'{{WRAPPER}} .rs-addon-services.style1 .services-inner.gradient-border-enable:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'items_border_hover',
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'services_box_shadow_hover',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover'
				]
			);
			$this->end_controls_tab();// Hover End
			
		$this->end_controls_tabs();// Global Style Hover & Normal Tab End

		
		$this->add_control(
			'item_transition',
			[
				'label' => esc_html__( 'Transition', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner, {{WRAPPER}} .media-cmn, {{WRAPPER}} .media-cmn img, {{WRAPPER}} .services-title .title a, {{WRAPPER}} .desc-text, {{WRAPPER}} .btn-part a, {{WRAPPER}} .btn-part a i, {{WRAPPER}} .btn-part a svg, {{WRAPPER}} .btn-part a svg path' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);
		$this->add_control(
			'image_overlay_color',
			[
				'label' => esc_html__( 'Image Overlay Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_overlay_hover_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-addon-services.style3 .services-inner .media_wrap .overly_icon_hover:after, {{WRAPPER}} .rs-addon-services.style3 .services-inner .media_wrap .overly_icon_normal:after, {{WRAPPER}} .rs-addon-services.style3 .services-inner .media_wrap .overly_icon_normal',
			]
		);
		
		$this->add_control(
			'animate_border_on_hover_style1_heading',
			[
				'label' => esc_html__( 'Animate Border On Hover', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'services_style' => '1'
				],
			]
		);
		$this->add_responsive_control(
            'animate_border_on_hover_style1',
            [
                'label'   => esc_html__( 'Border', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'condition' => [
					'services_style' => '1'
				],
                'options' => [
                    'none' => esc_html__( 'Hide', 'rsaddon' ),
                    'block' => esc_html__( 'Show', 'rsaddon' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style1 .services-inner:after' => 'display: {{VALUE}}'
				],
            ]
        );
        $this->add_responsive_control(
            'animate_border_on_hover_style1_height',
            [
                'label' => esc_html__( 'Border Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'condition' => [
					'services_style' => '1',
					'animate_border_on_hover_style1' => 'block'
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style1 .services-inner:after' => 'height: {{SIZE}}{{UNIT}};',                    
                ],
            ]
        );
        $this->add_control(
			'animate_border_on_hover_style1_color',
			[
				'label' => esc_html__( 'Border Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'services_style' => '1',
					'animate_border_on_hover_style1' => 'block'
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services.style1 .services-inner:after' => 'background: {{VALUE}}',
				],
			]
		);



		$this->end_controls_section();// Service Global Style End

		// ----------------------------------------  Numbering Style Start ------------------------------
		$this->start_controls_section(
			'_service_numbering_style',
			[
				'label' => esc_html__( 'Numbering', 'rsaddon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'numbering_show_hide' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
            'number_align',
            [
                'label' => esc_html__( 'Number Alignment', 'rsaddon' ),
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
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'text-align: {{VALUE}}',
                ]
            ]
        );
		$this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .numbering' => 'color: {{VALUE}}!important;',                   
                ],
            ]
        );
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'number_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .numbering',
		    ]
		);	

		$this->add_control(
		    'number_hover_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Hover Background', 'rsaddon' ),
		        'separator' => 'before',
		    ]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'number_hover_bg',
                'selector' => '{{WRAPPER}} .services-inner:hover .numbering',
            ]
        );
		$this->add_control(
            'number_hover_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-inner:hover .numbering' => 'color: {{VALUE}}!important;',                   
                ],
            ]
        );

		$this->add_control(
		    'hover_animation_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Hover Border', 'rsaddon' ),
		        'separator' => 'before',
		    ]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'number_hover_animationbg',
                'selector' => '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before',
            ]
        );


		$this->add_responsive_control(
		    'number_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .numbering' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'number_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .numbering' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'number_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .numbering' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'number_border',
		        'selector' => '{{WRAPPER}} .numbering',
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'number_box_shadow',
		        'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .numbering'
		    ]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'number_bg',
                'selector' => '{{WRAPPER}} .numbering,{{WRAPPER}} .number-border-animation .rs-addon-services .services-inner .numbering span::before,{{WRAPPER}} .number-border-animation .rs-addon-services .services-inner .numbering span::after',
            ]
        );
        $this->add_control(
            'number_bg_solid',
            [
                'label' => esc_html__( 'Number Background Solid', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .numbering,{{WRAPPER}} .number-border-animation .rs-addon-services .services-inner .numbering span::before,{{WRAPPER}} .number-border-animation .rs-addon-services .services-inner .numbering span::after' => 'background: {{VALUE}} !important;',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_opacity',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering' => 'opacity: {{SIZE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_opacity_hover',
            [
                'label' => esc_html__( 'Opacity ( Hover )', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner:hover .numbering' => 'width: {{SIZE}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
        $this->add_responsive_control(
            'number_line_height',
            [
                'label' => esc_html__( 'Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'line-height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_position_y',
            [
                'label' => esc_html__( 'Position Y (Top)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'top: {{SIZE}}{{UNIT}}; bottom: unset; position: absolute;',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_position_y_bottom',
            [
                'label' => esc_html__( 'Position Y (Bottom)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'bottom: {{SIZE}}{{UNIT}}; top: unset; position: absolute;',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_position_x',
            [
                'label' => esc_html__( 'Position X (Left)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'left: {{SIZE}}{{UNIT}}; right: unset;  position: absolute;',                   
                ],
            ]
        );
		$this->add_responsive_control(
            'number_position_x_right',
            [
                'label' => esc_html__( 'Position X (Right)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .numbering' => 'right: {{SIZE}}{{UNIT}}; left: unset;  position: absolute;',                   
                ],
            ]
        );
		$this->add_control(
			'number_before_border_enable',
			[
				'label' => esc_html__( 'Before Border Enable', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'before_number_bg',
                'selector' => '{{WRAPPER}} .rs-addon-services .services-inner .numbering',
				'condition' => ['number_before_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'beofre_number_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['number_before_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'before_number_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['number_before_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'before_number_position_y',
            [
                'label' => esc_html__( 'Position Y', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',                   
                ],
				'condition' => ['number_before_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'before_number_position_x',
            [
                'label' => esc_html__( 'Position X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['number_before_border_enable' => 'yes']
            ]
        );

		$this->add_responsive_control(
		    'before_border_radius_number',
		    [
		        'label' => esc_html__( 'Number Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner .numbering:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
		    ]
		);

		$this->add_control(
			'number_border_top_heading',
			[
				'label' => esc_html__( 'Number Border Top', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'services_style' => '6',
				],
				
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'number_top_border',
		        'selector' => '{{WRAPPER}} .rs-addon-services.style6 .media_wrap',
				'condition' => [
					'services_style' => '6',
				],
		    ]
		);

		$this->add_control(
			'number_border_right_heading',
			[
				'label' => esc_html__( 'Number Border Right', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'services_style' => '6',
				],
				
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'number_top_border_content',
		        'selector' => '{{WRAPPER}} .rs-addon-services.style6 .services-inner .content_part',
				'condition' => [
					'services_style' => '6',
				],
		    ]
		);

		

		$this->end_controls_section();// Numbering Style End

		// ----------------------------------------  Feature Image Style Section Style 6 ------------------------------
		$this->start_controls_section(
			'_service_feature_image_section_6',
			[
				'label' => esc_html__( 'Feature Image', 'rsaddon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'services_style' => '6',
				]
			]
		);
		$this->add_responsive_control(
		    'feature_image_padding_6',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style6 .feature-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'feature_image_margin_6',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style6 .feature-img-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'feature_image_radius_6',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style6 .feature-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => '_feature_image_box_shadow_6',
		        'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-services.style6 .feature-img-wrapper'
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => '_feature_image_border_6',
		        'selector' => '{{WRAPPER}} .rs-addon-services.style6 .feature-img-wrapper',
		    ]
		);
		$this->end_controls_section();// Feature Image Style End
		
		// ----------------------------------------  Icon Style Start ------------------------------
		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
		$this->add_responsive_control(
            'icon_alignments',
            [
                'label' => esc_html__( 'Icon Alignment', 'rsaddon' ),
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
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .media_wrap' => 'text-align: {{VALUE}}'
                ],
                'condition' => [
                    'services_style!' => '3'
                ]
            ]
        );
        $this->add_responsive_control(
            'media_hover_transition',
            [
                'label' => esc_html__( 'Media Transition', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -10,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-inner .media-cmn,
                     {{WRAPPER}} .services-inner .media-cmn img,
                     {{WRAPPER}} .services-inner .media-cmn i,
                     {{WRAPPER}} .services-inner .media-cmn svg' => 'transition: all {{SIZE}}s !important;',
                ],
            ]
        );
        $this->add_control(
            'media_custom_wrapper_overflow',
            [
                'label' => esc_html__( 'Wrapper Overflow', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'visible' => esc_html__( 'Visible', 'rsaddon' ),
                    'hidden' => esc_html__( 'Hidden', 'rsaddon' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .media-cmn' => 'overflow: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'media_custom_size_yes_no',
            [
                'label' => esc_html__( 'Icon Wrapper Custom Size', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'rsaddon' ),
                'label_off' => esc_html__( 'No', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'services_style!' => '3'
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_holder__wrapper_width',
            [
                'label' => esc_html__( 'Icon Holder Wrapper Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'condition' => [
                    'media_custom_size_yes_no' => 'yes',
                    'services_style'=>'7',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style7 .media_wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_wrapper__holder_box_display',
            [
                'label' => esc_html__( 'Holder Wrapper Display', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'block' => esc_html__( 'Block', 'rsaddon' ),
                    'inline-block' => esc_html__( 'Inline Block', 'rsaddon' ),
                    'flex' => esc_html__( 'Flex', 'rsaddon' ),
                    'inline-flex' => esc_html__( 'Inline Flex', 'rsaddon' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style7 .media_wrap' => 'display: {{VALUE}};',
                ],
                'condition' => [
                    'media_custom_size_yes_no' => 'yes',
                    'services_style'=>'7',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon__holder__bg_color',
                'label' => esc_html__( 'Icon Holder Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-services.style7 .media_wrap',
                'condition' => [
                   'media_custom_size_yes_no' => 'yes',
                    'services_style'=>'7',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_holder__media_border',
                'selector' => '{{WRAPPER}} .rs-addon-services.style7 .media_wrap',
                'condition' => [
                    'media_custom_size_yes_no' => 'yes',
                    'services_style'=>'7',
                ]
            ]
        );
        $this->add_responsive_control(
            'holder__wrapper_media_border_radius',
            [
                'label' => esc_html__( 'Image Wrapper Holder Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style7 .media_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'services_style' => '7'
                ]
            ]
        );
		$this->add_responsive_control(
		    'icon_wrapper_width',
		    [
		        'label' => esc_html__( 'Icon Wrapper Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -300,
		                'max' => 300,
		            ],
		        ],
				'default' =>[
					'unit'=>'px',
					'size'=>'100',
				],
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .service-four .feature-image' => 'width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services.style12 .services-inner .icon_img' => 'width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .media-cmn' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_wrapper_height',
		    [
		        'label' => esc_html__( 'Icon Wrapper Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -300,
		                'max' => 300,
		            ],
		        ],
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .service-four .feature-image' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services.style12 .services-inner .icon_img' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .media-cmn' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_wrapper_image_width_custom',
		    [
		        'label' => esc_html__( 'Image  Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -300,
		                'max' => 300,
		            ],
		        ],
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
		        'selectors' => [
		            '{{WRAPPER}} .media_wrap .media-cmn img, .services-inner .service-four .feature-image img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_wrapper_image_height_custom',
		    [
		        'label' => esc_html__( 'Image  Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -300,
		                'max' => 300,
		            ],
		        ],
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
		        'selectors' => [
		            '{{WRAPPER}} .media_wrap .media-cmn img, .services-inner .service-four .feature-image img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
            '_icon_alignments_for_width',
            [
                'label' => esc_html__( 'Icon Wrapper Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '0' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    '0 auto' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    '0 0 0 auto' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
                'selectors' => [
                    '{{WRAPPER}} .media-cmn' => 'margin: {{VALUE}}'
                ],
            ]
        );
		$this->add_responsive_control(
            'icon_box_display',
            [
                'label' => esc_html__( 'Display', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'block' => esc_html__( 'Block', 'rsaddon' ),
					'inline-block' => esc_html__( 'Inline Block', 'rsaddon' ),
					'flex' => esc_html__( 'Flex', 'rsaddon' ),
					'inline-flex' => esc_html__( 'Inline Flex', 'rsaddon' ),
				],
                'selectors' => [
                    '{{WRAPPER}} .media-cmn' => 'display: {{VALUE}};',
                ],
				'condition' => [
					'media_custom_size_yes_no' => 'yes',
				],
            ]
        );
		$this->add_responsive_control(
            'icon_box_y_align',
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
				'default' => 'center',
				'condition' => [
					'icon_box_display' => ['flex', 'inline-flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .media-cmn' => 'align-items: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'icon_box_x_align',
            [
                'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],

                ],
				'default' => 'center',
				'condition' => [
					'icon_box_display' => ['flex', 'inline-flex'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .media-cmn' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		// Floating Image Cotrol Start
		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'services_style!' => '3'
                ]
			]
		);
		$this->add_control(
			'icon_image_position_haeding',
			[
				'label' => esc_html__( 'Position Of Icon/Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_image_position',
            [
				'label' => esc_html__( 'Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
				'default' => 'unset',
				'options' => [
					'unset' => esc_html__( 'Default', 'rsaddon' ),
					'relative' => esc_html__( 'Relative', 'rsaddon' ),
					'absolute' => esc_html__( 'Absolute', 'rsaddon' ),
				],
				'selectors' => [
		            '{{WRAPPER}} .services-inner .media_wrap' => 'position: {{VALUE}};',
		        ],
                'condition' => [
                    'services_style!' => '3'
                ]
			]
		);
		$this->add_control(
			'icon_image_position_x',
			[
				'label' => esc_html__( 'Move X From', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Left', 'rsaddon' ),
					'right' => esc_html__( 'Right', 'rsaddon' ),
				],
				'condition' => [
					'icon_image_position!' => 'unset',
				],
			]
		);
		$this->add_responsive_control(
		    'icon_image_position_x_left',
		    [
				'label'      => esc_html__( 'Left', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .media_wrap, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'left: {{SIZE}}{{UNIT}}; right:unset;',
		        ],
		        'condition'=>[
					'icon_image_position!' => 'unset',
		        	'icon_image_position_x' => 'left',
		        ]
		    ]
		);
		$this->add_responsive_control(
		    'icon_image_position_x_right',
		    [
				'label'      => esc_html__( 'Right', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .media_wrap, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'right: {{SIZE}}{{UNIT}}; left:unset;',
		        ],
		        'condition'=>[
					'icon_image_position!' => 'unset',
		        	'icon_image_position_x' => 'right',
		        ]
		    ]
		);
		$this->add_control(
			'icon_image_position_y',
			[
				'label' => esc_html__( 'Move Y From', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' => esc_html__( 'Top', 'rsaddon' ),
					'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
				],
				'condition' => [
					'icon_image_position!' => 'unset',
				],
			]
		);
		$this->add_responsive_control(
		    'icon_image_position_y_top',
		    [
				'label'      => esc_html__( 'Top', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .media_wrap, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'top: {{SIZE}}{{UNIT}}; bottom:unset;',
		        ],
		        'condition'=>[
					'icon_image_position!' => 'unset',
		        	'icon_image_position_y' => 'top',
		        ]
		    ]
		);
		$this->add_responsive_control(
		    'icon_image_position_y_bottom',
		    [
				'label'      => esc_html__( 'Bottom', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner .media_wrap, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'bottom: {{SIZE}}{{UNIT}}; top:unset;',
		        ],
		        'condition'=>[
					'icon_image_position!' => 'unset',
		        	'icon_image_position_y' => 'bottom',
		        ]
		    ]
		);

		$this->add_control(
			'icon_border_style',
			[
				'label' => esc_html__( 'Icon Border Enable?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['services_style' => '6']
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'services_style!' => '3'
                ]
			]
		);
		// Floating Image Cotrol End

			$this->start_controls_tabs( '_icons_tabs_section' );

				$this->start_controls_tab(
					'icon_tab_normal_color',
					[
						'label' => esc_html__( 'Normal', 'rsaddon' ),
                        'condition' => [
                            'services_style!' => '3'
                        ]
					]
				);
				
				$this->add_group_control(
					\Elementor\Group_Control_Css_Filter::get_type(),
					[
						'name' => 'redox_service_icon_css_filters',
						'selector' => '{{WRAPPER}} .services-inner .media_wrap .image_style img',
                        'condition' => [
                            'services_style!' => '3'
                        ]
					]
				);

				
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'media_box_shadow',
						'exclude' => [
							'box_shadow_position',
						],
						'selector' => '{{WRAPPER}} .media-cmn',
                        'condition' => [
                            'services_style!' => '3'
                        ]
					]
				);
				
				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .media-cmn svg' => 'fill: {{VALUE}} !important',
							'{{WRAPPER}} .media-cmn svg' => 'stroke: {{VALUE}} !important',
							'{{WRAPPER}} .media-cmn i' => 'color: {{VALUE}} !important',
							
						],
						'condition' => [
							'icon_type' => 'icon'
						]
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon__bg_color',
						'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .media-cmn, {{WRAPPER}} .rs-addon-services.style9 .media_wrap, {{WRAPPER}} .rs-addon-services.style12 .services-inner .icon_img, {{WRAPPER}} .rs-addon-services.style7 .services-inner .media_wrap .media-cmn',
                        'condition' => [
                            'services_style!' => '3',
                            'icon_bg_enable!' => 'icon-background'
                        ]
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon__background_color',
						'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rs-addon-services.style1 .services-inner.icon-background .media_wrap .image_style:before',
                        'condition' => [
                            'services_style' => '1',
                            'icon_bg_enable' => 'icon-background'
                        ]
					]
				);
				$this->add_responsive_control(
					'img_scale_normal',
					[
						'label' => esc_html__( 'Image Zoom', 'rsaddon' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => -10,
								'max' => 10,
								'step' => 0.1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .services-inner .media-cmn img,
                             {{WRAPPER}} .services-inner .media-cmn i,
                             {{WRAPPER}} .services-inner .media-cmn svg' => 'transform: scale({{SIZE}})',
						],
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'icon_tab_hover_color',
					[
						'label' => esc_html__( 'Hover', 'rsaddon' ),
                        'condition' => [
                            'services_style!' => '3'
                        ]
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Css_Filter::get_type(),
					[
						'name' => 'tekone_service_icon_hover_css_filters',
						'selector' => '{{WRAPPER}} .services-inner:hover .media_wrap img, {{WRAPPER}} .rs-addon-services.style7 .services-inner:hover .media_wrap .media-cmn img',
                        'condition' => [
                            'services_style!' => '3'
                        ]
					]
				);
				$this->add_control(
					'icon_hover_color',
					[
						'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn svg' => 'fill: {{VALUE}} !important',
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn svg' => 'stroke: {{VALUE}} !important',
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn i' => 'color: {{VALUE}} !important',
						],
						'condition' => [
							'icon_type' => 'icon'
						]
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon_hover_bg_color',
						'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover .media-cmn, {{WRAPPER}} .rs-addon-services.style7 .services-inner:hover .media_wrap .media-cmn',
						'condition' => [
                            'services_style!' => '3',
                            'icon_bg_enable!' => 'icon-background'
                        ]
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'icon_hover_background_color',
						'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rs-addon-services.style1 .services-inner.icon-background:hover .media_wrap .image_style:before',
						'condition' => [
                            'services_style' => '1',
                            'icon_bg_enable' => 'icon-background'
                        ]
					]
				);
                $this->add_responsive_control(
                    'img_scale_hover',
                    [
                        'label' => esc_html__( 'Image Zoom (Hover)', 'rsaddon' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => -10,
                                'max' => 10,
                                'step' => 0.1,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .services-inner:hover .media-cmn img,
                             {{WRAPPER}} .services-inner:hover .media-cmn i,
                             {{WRAPPER}} .services-inner:hover .media-cmn svg' => 'transform: scale({{SIZE}})',
                        ],
                    ]
                );
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->add_responsive_control(
		    'icon_width_size',
		    [
		        'label' => esc_html__( 'Icon Svg Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .media-cmn svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services .btn-part svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
				],
				'separator'=>'before',
		    ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .media-cmn i',
                'condition' => [
                    'services_style!' => '3'
                ]
			]
		);
        $this->add_control(
            'icon_wrapper_bg__color_title',
            [
                'label' => esc_html__( 'Icon Wrapper Background Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'services_style' => ['3']
                ]
                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'icon__wrapper__bg_color',
                'selector' => '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style',
                 'condition' => [
                    'services_style' => ['3']
                ]
            ]
        );
		$this->add_control(
			'icon_overlay_color',
			[
				'label' => esc_html__( 'Icon Overlay Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_overlay_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style,{{WRAPPER}} .rs-addon-services.style9 .services-inner .content_part .icon_style',
				'condition' => [
                    'services_style' => ['3','9']
                ]
			]
		);
		$this->add_responsive_control(
		    'media_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .media-cmn, {{WRAPPER}} .services-inner .service-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'services_style!' => ['3','9']
                ]
		    ]
		);

		$this->add_responsive_control(
		    'icon_margin_area',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .media_wrap, {{WRAPPER}} .services-inner .service-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'services_style!' => '3'
                ]
		    ]
		);
		$this->add_responsive_control(
		    'service_img_padding',
		    [
		        'label' => esc_html__( 'Image Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'services_style' => '9'
                ]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'media_border',
		        'selector' => '{{WRAPPER}} .media-cmn, .services-inner .service-heading',
                'condition' => [
                    'services_style!' => '3'
                ]
		    ]
		);
		$this->add_responsive_control(
		    'media_border_radius',
		    [
		        'label' => esc_html__( 'Image Wrapper Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .media-cmn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
                'condition' => [
                    'services_style!' => '3'
                ]
		    ]
		);
		$this->add_responsive_control(
		    'img_border_radius',
		    [
		        'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .media-cmn img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
                'condition' => [
                    'services_style!' => '3'
                ]
		    ]
		);
		$this->add_responsive_control(
		    'iconwrapper_padding',
		    [
		        'label' => esc_html__( 'Icon Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style6 .media_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'services_style' => '6']
		    ]
		);
		$this->add_control(
			'overlay_image_heading_style',
			[
				'label' => esc_html__( 'Position Icon & Image Option', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
			]
		);
		$this->add_responsive_control(
		    'ovarlay_img_width',
		    [
		        'label' => esc_html__( 'Overlay Icon Wrapper width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'width: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
				'separator'=>'before',
		    ]
		);
		$this->add_responsive_control(
		    'ovarlay_img_height',
		    [
		        'label' => esc_html__( 'Overlay Icon Wrapper Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style' => 'height: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
				'separator'=>'before',
		    ]
		);
		$this->add_control(
			'overlay_hover_image_heading_style',
			[
				'label' => esc_html__( 'Overlay Icon & Image Option', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
			]
		);
		$this->add_responsive_control(
		    'ovarlay_hover_img_width',
		    [
		        'label' => esc_html__( 'Overlay Icon width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style img, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style svg, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style i' => 'width: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
				'separator'=>'before',
		    ]
		);
		$this->add_responsive_control(
		    'ovarlay_hover_img_height',
		    [
		        'label' => esc_html__( 'Overlay Icon Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style img, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style svg, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .icon_style i' => 'height: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
					'icon_image_show_hide' => 'yes',
					'icon_type' => 'image',
					'services_style' => ['3','9'],
				],
				'separator'=>'before',
		    ]
		);

		$this->add_responsive_control(
            'icon_image_postion_left',
            [
                'label' => esc_html__( 'Icon Image Position X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style9 .services-inner .content_part .icon_style' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => [
					'services_style' => '9',
				],
            ]
        );

		$this->add_responsive_control(
            'icon_image_postion_top',
            [
                'label' => esc_html__( 'Icon Image Position Y', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style9 .services-inner .content_part .icon_style' => 'top: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => [
					'services_style' => '9',
				],
            ]
        );

		$this->add_control(
			'hr3',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
		            'services_style' => '6',
		        ],
			]
		);
		$this->add_control(
			'animate_border_heading_style6',
			[
				'label' => esc_html__( 'Animate Border', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'services_style' => '6',
				],
				
			]
		);
		$this->add_control(
			'animate_border_show_hide_style6',
			[
				'label'   => esc_html__( 'Animate Border', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'inline-block',				
				'options' => [
					'inline-block' => 'Show',
					'none' => 'Hide',
				],
				'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style6 .services-inner .content_part .media-cmn:after' => 'display: {{VALUE}}',
		        ],
				'condition' => [
                    'services_style' => '6',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'animate_border_border_style6',
				'selector' => '{{WRAPPER}} .rs-addon-services.style6 .services-inner .content_part .media-cmn:after',
				'condition' => [
                    'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
				],
			]
		);
		$this->add_control(
            'animate_border_border_radius_style6',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style6 .services-inner .content_part .media-cmn:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition' => [
                    'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
				],
            ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animate_border_bg_style6',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services.style6 .services-inner .content_part .media-cmn:after',
				'condition' => [
		            'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
		        ],
			]
		);
		$this->add_control(
			'animate_border_hover_heading_style6',
			[
				'label' => esc_html__( 'Animate Border (Hover)', 'textdomain' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
                    'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
				],
				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'animate_border_hover_bg_style6',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services.style6:hover .services-inner .content_part .media-cmn:after',
				'condition' => [
		            'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
		        ],
			]
		);
		$this->add_control(
            'animate_border_color_hover_style6',
            [
                'label' => esc_html__( 'Border Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style6:hover .services-inner .content_part .media-cmn:after' => 'border-color: {{VALUE}};',
                ], 
                'condition' => [
		            'services_style' => '6',
					'animate_border_show_hide_style6' => 'inline-block'
		        ],             
            ]
        );
		
		$this->end_controls_section(); //End Icon/Img Style
		
		// ----------------------------------------  Title Style ------------------------------
		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Title & Description', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Box Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content_part, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'content_margin',
		    [
		        'label' => esc_html__( 'Content Box Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content_part, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content_part .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'style_four_title_area_margin',
		    [
		        'label' => esc_html__( 'Title Area Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .service-heading .feature-content-style-four' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
					'services_style' => '4',
				],
		    ]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => '_content_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .content_part, services-title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part',
			]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .content_part, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part',
		    ]
		);
		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content_part, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .content_part, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part',
		    ]
		);
		$this->add_control(
		    'title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'rsaddon' ),
		        'separator' => 'before',
                'condition'=>[
                    'services_style!' => '3',
                ]
		    ]
		);

		// This Control Handle Title Color Switch Condition Based On Hover Box or Link ↓
		$this->add_control(
			'title_hover_color_based_on',
			[
				'label'   => esc_html__( 'Hover Color Based On', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'box',
				'options' => [					
					'box' => esc_html__( 'Box', 'rsaddon'),
					'link' => esc_html__( 'Link', 'rsaddon'),
				],
               


			]
		);
		// This Control Handle Title Color Switch Condition Based On Hover Box or Link ↑
		$this->add_control(
			'title_hover_transiation',
			[
				'label' => esc_html__( 'Hover Transiation', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						
						'step' => 0.1,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services .services-inner .services-title a' => 'transition: all {{SIZE}}s;',
				],
			]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-title .title, {{WRAPPER}} .services-title .title a, {{WRAPPER}} .rs-addon-services.style4 .services-inner .service-heading .feature-content a, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title a' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'title_spacing',
		    [
		        'label' => esc_html__( 'Title Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
                    '{{WRAPPER}} .services-title, {WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services.style7 .services-inner .content_part .services-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services.style11 .services-inner .content_part .services-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition'=>[
                     'services_style!' => '3',
                ]
		    ]
		);
		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
				'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner:hover .services-title a, {{WRAPPER}} .rs-addon-services .services-inner:hover .services-title > *,{{WRAPPER}} .rs-addon-services .services-inner:hover .services-title' => 'color: {{VALUE}}!important;',
		        ],
				'condition' => [
					'title_hover_color_based_on' => 'box',
                     'services_style!' => '3',
				]
		    ]
		);
		$this->add_control(
		    'title_hover_color_link_style',
		    [
		        'label' => esc_html__( 'Link Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
				'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner .services-title a:hover' => 'color: {{VALUE}}!important;',
		        ],
				'condition' => [
					'title_hover_color_based_on' => 'link',
                     'services_style!' => '3',

				]
		    ]
		);
        $this->add_control(
            'title_hover_color_for_style_three',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title a' => 'color: {{VALUE}}; ',
                ],
                'condition' => [
                     'services_style' => '3',
                ]
            ]
        );
        $this->add_control(
            'title_hover_color_link_for_style_three',
            [
                'label' => esc_html__( 'Link Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title:hover, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                     'services_style' => '3',
                ]
            ]
        );
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .services-title .title a',
		        
		    ]
		);
		$this->add_control(
		    'description_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);
		$this->add_responsive_control(
		    'description_spacing',
		    [
		        'label' => esc_html__( 'Description Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [ 
		            '{{WRAPPER}} .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services .services-inner .content_part .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .desc-text' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-inner:hover .desc-text' => 'color: {{VALUE}}',
		        ]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .desc-text, {{WRAPPER}} .rs-addon-services.style3 .services-inner .content_part .desc-text',
		    ]
		);
		$this->end_controls_section();//End Titlle & Description

// ---------------------------------------- Button Style Start ------------------------------
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'button_show_hide'=>'yes',
				]
		    ]
		);

		// This Control Handle Button Color Switch Condition Based On Hover Box or Link ↓
		$this->add_control(
			'button_hover_color_based_on',
			[
				'label'   => esc_html__( 'Hover Color Based On', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'box',
				'options' => [					
					'box' => esc_html__( 'Box', 'rsaddon'),
					'link' => esc_html__( 'Link', 'rsaddon'),
				]
			]
		);
		// This Control Handle Button Color Switch Condition Based On Hover Box or Link ↑
		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'icon_parent_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_parent_hover_margin',
		    [
		        'label' => esc_html__( 'Hover Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-inner:hover .btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
		    'btn_icon_typography',
		    [
		        'label' => esc_html__( 'Button Icon Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a svg path' => 'font-size: {{SIZE}}{{UNIT}};',
		            
		        ],
		        'condition' => [
					'services_style' => 'style1',
				],
				'separator'=>'before',
		    ]
		);
		$this->add_responsive_control(
		    'btn_normal_width',
		    [
		        'label' => esc_html__( 'Button  Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a' => 'width: {{SIZE}}{{UNIT}};',
		            
		        ],
				'separator'=>'before',
		    ]
		);
		$this->add_responsive_control(
		    'btn_svg_width',
		    [
		        'label' => esc_html__( 'Button Svg Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a svg' => 'width: {{SIZE}}{{UNIT}};',
		            
		        ],
				'separator'=>'before',
		    ]
		);
		
		$this->add_responsive_control(
		    'btn_svg_width2',
		    [
		        'label' => esc_html__( 'Button Svg Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a svg' => 'height: {{SIZE}}{{UNIT}};',
		            
		        ],
				'separator'=>'before',
		    ]
		);
		
		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .btn-part a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .btn-part a',
		    ]
		);
		$this->add_control(
		    '_hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);
			$this->start_controls_tabs( '_tabs_button' );

				$this->start_controls_tab(
					'_tab_button_normal',
					[
						'label' => esc_html__( 'Normal', 'rsaddon' ),
					]
				);
				$this->add_control(
					'link_color',
					[
						'label' => esc_html__( 'Text Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#6EC1E4',
						'selectors' => [
							'{{WRAPPER}} .btn-part a' => 'color: {{VALUE}};',
							'{{WRAPPER}} .btn-part svg' => 'fill: {{VALUE}};',
							'{{WRAPPER}} .btn-part svg path' => 'fill: {{VALUE}};',
							'{{WRAPPER}} .btn-part i' => 'color: {{VALUE}};',
							'{{WRAPPER}} .rs-addon-services.style5 .services-inner .btn-part a.services-btn' => 'color: {{VALUE}};'
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_bg_color',
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '
							{{WRAPPER}} .btn-part a,
							{{WRAPPER}} .rs-addon-services.style4.primary_scheme .services-inner .btn-part a.services-btn,
							{{WRAPPER}} .rs-addon-services.style4.secondary_scheme .services-inner .btn-part a.services-btn,
							{{WRAPPER}} .rs-addon-services.style5 .services-inner .btn-part a.services-btn
						',  
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_typography',
						'selector' => '{{WRAPPER}} .btn-part a,{{WRAPPER}} .rs-addon-services.style5 .services-inner .btn-part a.services-btn',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'button_border',
						'selector' => '{{WRAPPER}} .btn-part a',
					]
				);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'_tab_button_hover',
					[
						'label' => esc_html__( 'Hover', 'rsaddon' ),
					]
				);
				$this->add_control(
					'button_hover_color',
					[
						'label' => esc_html__( 'Text Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [							
							'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover svg path' => 'fill: {{VALUE}} !important;',
							'{{WRAPPER}} .rs-addon-services .services-inner .btn-part a.services-btn:hover i' => 'color: {{VALUE}} !important;',
						],
						'condition' => [
							'button_hover_color_based_on' => 'link',
						]
					]
				);
				$this->add_control(
					'button_hover_color_box',
					[
						'label' => esc_html__( 'Text Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [							
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn svg path' => 'fill: {{VALUE}} !important;',
							'{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn i' => 'color: {{VALUE}} !important;',
						],
						'condition' => [
							'button_hover_color_based_on' => 'box',
						]
					]
				);
				$this->add_control(
					'button_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn-part a:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .rs-addon-services.style5 .services-inner .btn-part a.services-btn:hover' => 'background-color: {{VALUE}};',
						],
						'condition' => [
							'button_hover_color_based_on' => 'link',
						]
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_hover_bg_color',
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .btn-part a:hover,{{WRAPPER}} .rs-addon-services.style5 .services-inner .btn-part a.services-btn:hover',
						'condition' => [
							'button_hover_color_based_on' => 'link',
						],  
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_hover_bg_color_box',
						'label' => esc_html__( 'Background', 'rsaddon' ),
						'types' => [ 'classic', 'gradient'],
						'selector' => '{{WRAPPER}} .rs-addon-services .services-inner:hover .btn-part a.services-btn',
						'condition' => [
							'button_hover_color_based_on' => 'box',
						],  
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_hover_typography',
						'selector' => '{{WRAPPER}} .services-inner:hover .btn-part a',
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'button_hoverborder',
						'selector' => '{{WRAPPER}} .btn-part a:hover',
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_border_top_bottom',
		    [
		        'label' => esc_html__( 'Border Top Bottom Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'services_style!' => '3',
                ]
		    ]
		);
		$this->add_control(
            'before_border_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Before Border', 'prelements' ),
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'top_bottom_border_enable',
			[
				'label' => esc_html__( 'Before Border Enable', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'inner_border_top_bg',
                'selector' => '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before',
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_control(
            'before_hover_border_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Before Hover Border Color', 'prelements' ),
                'separator' => 'before',
                'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'before_hover_inner_border_top_bg',
                'selector' => '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:hover:before',
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_responsive_control(
            'inner_border_bottom_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'innerborder_top_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_responsive_control(
            'before_inner_border_position_x',
            [
                'label' => esc_html__( 'Position X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'inner_border_top_position_y',
            [
                'label' => esc_html__( 'Position Y', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
		    'before_bordr_radius_number',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
				'separator' => 'before',
				'condition' => ['top_bottom_border_enable' => 'yes']
		    ]
		);
		$this->add_control(
            'after_border_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'After Border', 'rsaddon' ),
                'separator' => 'before',
                'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'after_inner_border_bottom_bg',
                'selector' => '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after',
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_control(
            'after_hover_border_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'After Hover Border Color', 'prelements' ),
                'separator' => 'before',
                'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'after_hover_inner_border_top_bg',
                'selector' => '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:hover:after',
				'condition' => ['top_bottom_border_enable' => 'yes'],
            ]
        );

		$this->add_responsive_control(
            'after_inner_border_bottom_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'after_innerborder_bottom_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'after_inner_border_bottom_position_y',
            [
                'label' => esc_html__( 'Position Y', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute;',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );
		$this->add_responsive_control(
            'after_bottom_position_x',
            [
                'label' => esc_html__( 'Position X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
				'condition' => ['top_bottom_border_enable' => 'yes']
            ]
        );

		$this->add_responsive_control(
		    'after_bordr_bottom_radius_number',
		    [
		        'label' => esc_html__( 'After Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.top_bottom_enable_before .services-inner:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            
		        ],
				'separator' => 'before',
				'condition' => ['top_bottom_border_enable' => 'yes']
		    ]
		);

		
		$this->end_controls_section();
		// ----------------------------------------  Service Feature Start ------------------------------
		$this->start_controls_section(
			'feature_style',
			[
				'label' => esc_html__( 'Feature Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'services_style' => '4',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'feature_list_bg',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list',
			]
		);
		$this->add_responsive_control(
		    'feature_list_bg_item_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'feature_list_bg_item_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
            'feature_list__heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Feature List Style', 'prelements' ),
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
		    'feature_list__padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'feature_list__margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
            'feature_list_li_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Feature List Text Style', 'prelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
		    'feature_list__li_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'feature_list__li_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'feature_list__li_text_typo',
		        'selector' => '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li a',
		    ]
		);
		$this->add_control(
            'feature_list__li_text_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li a' => 'color: {{VALUE}};',                   
                ],
            ]
        );
        $this->add_control(
            'feature_list__li_text_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style4 .services-inner ul.rs-features-list li:hover a' => 'color: {{VALUE}};',                   
                ],
            ]
        );
		$this->end_controls_section();// Service Feature End

		$this->start_controls_section(
		    '_progress_bar_style',
		    [
		        'label' => esc_html__( 'Progress Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_style' => '11']
		    ]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'progress_bar_border',
				'selector' => '{{WRAPPER}} .rs-addon-services.style11 .services-inner .service-progress-bar',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'after_progress_style',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-addon-services.style11 .services-inner .service-progress-bar:after',
			]
		);

		$this->add_responsive_control(
            'progress_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.style11 .services-inner .service-progress-bar:after' => 'height: {{SIZE}}{{UNIT}};',                   
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

		
		
		$this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title' );

        $this->add_inline_editing_attributes( 'text', 'basic' );
        $this->add_render_attribute( 'text', 'class', 'services-txt' );
        $this->add_inline_editing_attributes( 'services_btn_text', 'basic' );
        $this->add_render_attribute( 'services_btn_text','','');

		$bordr_enable = $settings['number_before_border_enable'];
		$button_icon_default_show_hide = $settings['button_icon_default_show_hide'];

		$icon_show_hide = '';

		if($button_icon_default_show_hide == 'yes') {
			$icon_show_hide = 'default-icon-showhide';
		}

		
		?>

		<div class="rs-addon-services style<?php echo esc_attr($settings['services_style']); ?> <?php echo esc_html($settings['choose_color_scheme']); ?>">
			<?php

				if('1' == $settings['services_style']){
					include plugin_dir_path(__FILE__)."/style1.php";
				}
				elseif('2' == $settings['services_style']){
					include plugin_dir_path(__FILE__)."/style2.php";
				}
                elseif('3' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style3.php";
                }
				elseif('4' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style4.php";
                }
				elseif('5' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style5.php";
                }
				elseif('6' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style6.php";
                }
				elseif('7' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style7.php";
                }elseif('8' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style8.php";
                }
				elseif('9' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style9.php";
                } elseif('10' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style10.php";
                }
				elseif('11' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style11.php";
                }
				elseif('12' == $settings['services_style']){
                    include plugin_dir_path(__FILE__)."/style12.php";
                }
			?>
		</div>
		
	<?php
	}
}
