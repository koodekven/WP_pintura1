<?php
/**
 * Elementor rsgallery Widget.
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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Testimonial_Slider_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rs-testimonial-slider';
    }       

    /**
     * Get widget title.
     *
     * Retrieve rsgallery widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Testimonial Slider', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve rsgallery widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-slider-2';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the rsgallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    /**
     * Register rsgallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
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
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon'),
				],											
			]
		);

        $this->add_control(
            'testimonial_style',
            [
                'label'   => esc_html__( 'Select Testimonial Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'style2' => esc_html__( 'Style 2', 'rsaddon'),
                    'style3' => esc_html__( 'Style 3', 'rsaddon'),
                    'style4' => esc_html__( 'Style 4', 'rsaddon'),
                    'style5' => esc_html__( 'Style 5', 'rsaddon'),
                    'style6' => esc_html__( 'Style 6', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'gradient_setting',
            [
                'label'   => esc_html__( 'Gradient Color', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'gradient_disable',
                'options' => [                  
                    'gradient_enable' => esc_html__( 'Enable', 'rsaddon'),
                    'gradient_disable' => esc_html__( 'Disable', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'testimonial_category',
            [
                'label'   => esc_html__( 'Category', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT2,
                
                'options'   => $this->getCategories(),
                'multiple' => true, 
                'separator' => 'before',        
            ]

        );

        $this->add_control(
            'per_page',
            [
                'label' => esc_html__( 'Testimonial Show Per Page', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '5', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
                
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'toggle' => false,
                'default' => 'left',
                'separator' => 'before',
                'prefix_class' => 'rs-testimonial--',
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial' => 'text-align: {{VALUE}}'
                ]
               
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
                'toggle' => true,
                'condition' => [
					'testimonial_style' => 'style5',
				],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .inrs' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'box_vertical_align',
            [
                'label' => esc_html__( 'Box Vertical Align', 'rsaddon' ),
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
				'condition' => [
					'box_horizontal_align' => 'flex',
                    'testimonial_style' => 'style5',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .inrs' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_design',
            [
                'label' => esc_html__( 'Design', 'rsaddon' ),
                'type'  => Controls_Manager::SELECT,
                'label_block' => false,
                'separator' => 'before',
                'options' => [
                    'basic'  => esc_html__( 'Default', 'rsaddon' ),
                    'bubble' => esc_html__( 'Bubble', 'rsaddon' ),
                ],
                'default' => 'bubble',
                
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
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_width_qud',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '.testimonial-items .item-content img, {{WRAPPER}} .rs-testimonial .testimonial-item .item-content span img' => 'width: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Quote Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'default' => 'quote-right',    
                'condition' => [
                    'icon_type' => 'icon'
                ]            
            ]
        );
        $this->add_control(
            'show_hover_img',
            [
                'label'        => esc_html__( 'Show Hover Image', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'icon_type' => 'image',
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
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'selected_image_hover',
            [
                'label' => esc_html__( 'Choose Image (Hover)', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
                
                'condition' => [
                    'show_hover_img' => 'yes',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'testimonial_slider_skew', [
			'label' => esc_html__( 'Testimonial Box Skew', 'rs-addon' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'skew_enable' => esc_html__( 'Enable', 'rs-addon' ),
				'' => esc_html__( 'Disable', 'rs-addon' ),
			],
            'condition' => [
                'testimonial_style'=> 'style1',
            ],
		] );
        $this->add_control(
            'show_designation',
            [
                'label'        => esc_html__( 'Designation Show/Hide', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition' => [
                    'testimonial_style'=> 'style1',
                ],
            ]
        );
        $this->add_control(
            'show_country_info',
            [
                'label'        => esc_html__( 'Country Info Show/Hide', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'testimonial_style' => 'style1'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_ratings',
            [
                'label' => esc_html__( 'Ratings', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'show_ratings',
            [
                'label'        => esc_html__( 'Show', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'show_ratings_top_of_content',
            [
                'label'        => esc_html__( 'Rating on Top', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'testimonial_style' => 'style1',
                    'show_ratings' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
		    'rating_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; position: relative; z-index: 2;',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'rating_bottom_position',
            [
                'label'      => esc_html__( 'Bottom Gap', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .ratings' => 'padding-bottom: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
                    'show_ratings' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'rating_img_width',
            [
                'label' => esc_html__( ' Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide .ratings img' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',                    
                ],
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
       
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_client_logo',
            [
                'label' => esc_html__( 'Client Logo', 'rsaddon' ),
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->add_control(
            'show_client_logo',
            [
                'label'        => esc_html__( 'Show', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );

        $this->add_responsive_control(
            'client_logo_horizontal_align',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .client_logo_rating' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
                'condition' => [
                    'show_client_logo' => 'yes',
                ]
            ]
        );
		$this->add_responsive_control(
            'client_logo_vertical_align',
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
					'client_logo_horizontal_align' => 'flex',
                    'show_client_logo' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .client_logo_rating' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'client_logo_column_align',
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
					'client_logo_horizontal_align' => 'flex',
                    'show_client_logo' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .client_logo_rating' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'client_logo_box_h_align',
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
					'client_logo_horizontal_align' => 'flex',
                    'show_client_logo' => 'yes',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .client_logo_rating' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'client_logo_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .client_logo_rating .client_logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; position: relative; z-index: 2;',
		        ],
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
		    ]
		);
        $this->add_responsive_control(
            'logoclient_bottom_position',
            [
                'label'      => esc_html__( 'Bottom Gap', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .client_logo_rating' => 'padding-bottom: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->add_responsive_control(
            'client_logo_width',
            [
                'label' => esc_html__( 'Logo Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .client_logo_rating .client_logo' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',                    
                ],
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->end_controls_section();

         $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,               
            ]
        );
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',                            
            ]
        );
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                     
                ],
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',           
            ]
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'rsaddon' ),
                    '2' => esc_html__( '2 Item', 'rsaddon' ),
                    '3' => esc_html__( '3 Item', 'rsaddon' ),
                    '4' => esc_html__( '4 Item', 'rsaddon' ),                   
                ],
                'separator' => 'before',          
            ] 
        );      

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',                            
            ]            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',           
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                    '8000' => esc_html__( '8 Seconds', 'rsaddon' ), 
                    '10000' => esc_html__( '10 Seconds', 'rsaddon' ), 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'nav_vertical',
            [
                'label'   => esc_html__( 'Vertical Navigation', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
                            
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'fade_animation',
            [
                'label'   => esc_html__( 'Fade Animation', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Middle Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .testimonial-items, {{WRAPPER}} .rs-addon-slider .testimonial-item' => 'margin-left:{{SIZE}}{{UNIT}};',     
                    '{{WRAPPER}} .rs-addon-slider .testimonial-items, {{WRAPPER}} .rs-addon-slider .testimonial-item' => 'margin-right:{{SIZE}}{{UNIT}};',                    
                ],
                'separator' => 'before',
            ]
        ); 

         $this->add_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',                    
                ],
            ]
        );
        $this->add_responsive_control(
            'item_gap_inner',
            [
                'label' => esc_html__( 'Item Inner Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],  
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'testimonial_style' => 'style3',
                ]
            ]
        );     
        $this->end_controls_section();       

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Title/Designation/Ratings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-name' => 'color: {{VALUE}};',             

                ],                
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-name',                     
            ]
        );


        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rs-testimonial .testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'designation_margin',
            [
                'label' => esc_html__( 'Designation Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-title',                    
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-nav-style2 .item .testimonial-name, {{WRAPPER}} .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'title_position',
            [
                'label'   => esc_html__( 'Title/Ratings/Image ', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'bottom',            
                'options' => [
                    'top' => esc_html__( 'Above Content', 'rsaddon' ),
                    'bottom' => esc_html__( 'Below Content', 'rsaddon' ),                                  
                ],
                'separator' => 'before',                            
            ]
        );    
        $this->add_control(
            'inline_image_author',
            [
                'label'   => esc_html__( 'Inline Image & Author', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'inline_no',            
                'options' => [
                    'inline_no' => esc_html__( 'No', 'rsaddon' ),
                    'inline_yes' => esc_html__( 'Yes', 'rsaddon' ),                                  
                ],
                'separator' => 'before',                            
            ]
        );

        $this->add_control(
            'show_title_img',
            [
                'label'        => esc_html__( 'Title Show/Hide', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_des_img',
            [
                'label'        => esc_html__( 'Designation Show/Hide', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'title_subtitle_align_setting',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title Subtitle Align Settings', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_subtitle_display',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item.inline_no .testimonial-content .testimonial-information' => 'display: {{VALUE}} !important;',
                ]
            ]
        );
        $this->add_responsive_control(
            'testi_title_subtitle_vertical_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item.inline_no .testimonial-content .testimonial-information' => 'align-items: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'testi_content_align_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Content Align Settings', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'testi_content_display',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
				'default' => 'flex',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content, {{WRAPPER}} .bottom_part_wapper' => 'display: {{VALUE}} !important;',
                ]
            ]
        );
		$this->add_responsive_control(
            'testi_content_vertical_align',
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
					'testi_content_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content, {{WRAPPER}} .bottom_part_wapper' => 'align-items: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_content_flex_direction',
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
					'testi_content_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content, {{WRAPPER}} .bottom_part_wapper' => 'flex-direction: {{VALUE}} !important;',
                ],
            ]
        );
		$this->add_responsive_control(
            'testi_content_h_align',
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
					'testi_content_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content, {{WRAPPER}} .bottom_part_wapper' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
		    'bottom_avatar_info_wrap_padding',
		    [
		        'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .avatar_info_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
		    ]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Testimonial Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /**
         * Start testimonial content border gradient color
         */
        $this->add_control(
            'show_border_gradient_conent',
            [
                'label' => esc_html__( 'Show Boder Gradient', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'testimonial_style' => 'style5',
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_border_bg_gradient',
				'label' => esc_html__( 'Background Gradient', 'textdomain' ),
                'description' => esc_html__( 'Show border gradient color', 'textdomain' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .testimonial-items .inrs .item-content-bg-gradient',
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);

        $this->add_control(
			'before_content_border_bg',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_border_background',
				'label' => esc_html__( 'Background', 'textdomain' ),
                'description' => esc_html__( 'Show background color', 'textdomain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .testimonial-items .inrs .item-content-bg-gradient .item-content',
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        $this->add_control(
			'before_content_border_background',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        $this->add_responsive_control(
            'content_margin_container',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-contents' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
            ]
        );
        $this->add_control(
			'before_content_margin_container',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient_conent' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        /**
         * End testimonial content border gradient color
         */

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_content_box_shadow',
                'condition' => [
                    'show_border_gradient_conent!' => 'yes',
                ],
                'selector' => '{{WRAPPER}} .testimonial-items .inrs .item-content, {{WRAPPER}} .rs-testi_stylestyle2 .testimonial-item p',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial p' => 'color: {{VALUE}};',                    

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Content Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-testimonial p'
            ]
        );
        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => esc_html__( 'Content Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sliders-restimon3 .testimonial-items .inrs .item-content, {{WRAPPER}} .rs-testimonial .testimonial-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_margin',
            [
                'label' => esc_html__( 'Content Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial p, {{WRAPPER}} .sliders-restimon3 .testimonial-items .inrs .item-content, {{WRAPPER}} .rs-testimonial .testimonial-item p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content p, {{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs:after',
            ]
        );
        $this->add_control(
			'country_hover_bg_heading',
            [
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['testimonial_style' => 'style2']
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_hover_background',
                'label' => __( 'Hover Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-testimonial.gradient_enable .testimonial-item:not(.slick-center):before',
                'condition' => ['testimonial_style' => 'style2']
            ]
        );
        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .inrs .item-content-bg-gradient' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_border_radius_inner',
            [
                'label' => esc_html__( 'Border Radius Inner', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content, {{WRAPPER}} .rs-testi_stylestyle2 .testimonial-item p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testi_stylestyle2 .testimonial-item p',
            ]
        );
        $this->add_responsive_control(
            'name_spacing',
            [
                'label' => esc_html__( 'Content Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_image',
            [
                'label' => esc_html__( 'Image Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        //Start testimonial image boder gradient control
        $this->add_control(
            'show_border_gradient',
            [
                'label' => esc_html__( 'Show Boder Gradient', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'testimonial_style' => 'style5',
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_border_bg_gradient',
				'label' => esc_html__( 'Background Gradient', 'textdomain' ),
                'description' => esc_html__( 'Show border gradient color', 'textdomain' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .testimonial-items .inrs .testimonial-contents',
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        $this->add_control(
			'before_image_border_bg',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_border_background',
				'label' => esc_html__( 'Background', 'textdomain' ),
                'description' => esc_html__( 'Show background color', 'textdomain' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .testimonial-items .inrs .testimonial-contents .image-wrap',
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);

        $this->add_control(
			'before_image_border_background',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        $this->add_responsive_control(
            'image_margin_container',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-contents' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
            ]
        );
        $this->add_control(
			'before_image_margin_container',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'show_border_gradient' => 'yes',
                    'testimonial_style' => 'style5',
                ]
			]
		);
        /**
         * End testimonial image boder gradient control
        */

        $this->add_control(
            'show_images',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_nav_images',
            [
                'label' => esc_html__( 'Show Nav Image', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->add_control(
            'show_gradient_border',
            [
                'label'   => esc_html__( 'Gradient Border', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    'show_gradient_border' => esc_html__( 'Show', 'rsaddon'),
                    '' => esc_html__( 'Hide', 'rsaddon'),
                ],
                'condition' => [
                    'show_images' => 'yes',
                    'testimonial_style' => 'style2'
                ]
            ]
        );

        // Flex Elemnt start
        $this->add_responsive_control(
            'testi_avatar_content_display',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
				'default' => 'flex',
                'separator' => 'before',
                'toggle' => true,
                'condition' => [
                    'testimonial_style' => 'style2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testi_stylestyle2 .testimonial_wrapper .item-content .avatar_info_wrap' => 'display: {{VALUE}} !important;',
                ]
            ]
        );
		$this->add_responsive_control(
            'testi_avatar_content_vertical_align',
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
					'testi_avatar_content_display' => 'flex',
                    'testimonial_style' => 'style2'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testi_stylestyle2 .testimonial_wrapper .item-content .avatar_info_wrap' => 'align-items: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'testi_avatar_content_flex_direction',
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
					'testi_avatar_content_display' => 'flex',
                    'testimonial_style' => 'style2'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testi_stylestyle2 .testimonial_wrapper .item-content .avatar_info_wrap' => 'flex-direction: {{VALUE}} !important;',
                ],
            ]
        );
		$this->add_responsive_control(
            'testi_avatar_content_h_align',
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
					'testi_avatar_content_display' => 'flex',
                    'testimonial_style' => 'style2'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testi_stylestyle2 .testimonial_wrapper .item-content .avatar_info_wrap' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        // Flex Elemnt end
        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap img' => 'width: {{SIZE}}{{UNIT}} !important; height: auto !important;',                    
                ],

                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .image-wrap > img',
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]

        );
        $this->add_control(
            'before_image_border_style',
            [
                'label' => esc_html__( 'Before Image Border', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'before_img_border_enable' => esc_html__( 'Enable', 'rsaddon' ),
                ],
                'condition' => [
                    'testimonial_style'=> 'style1',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sliders-restimon3 .testimonial-items .inrs .testimonial-contents .image-wrap img, {{WRAPPER}} .rs-testimonial .image-wrap > img, {{WRAPPER}} .rsaddon-unique-slider.rs-testimonial.before_img_border_enable .testimonial-item .testimonial-content .image-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-contents .image-wrap, {{WRAPPER}} .testimonial-content .image-wrap, .rs-testimonial-nav-style2 .item .nav-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-contents .image-wrap img, {{WRAPPER}} .testimonial-content .image-wrap img, .rs-testimonial-nav-style2 .item .nav-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'image_border_setting_heading',
			[
				'label' => esc_html__( 'Image Border & BG', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
			]
		);
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'image_border_color2',
		        'selector' => '{{WRAPPER}} .rs-testimonial-nav-style2 .item img',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
		    ]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_circle_inner_color2',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-testimonial-nav-style2 .circular .inner',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
			]
		);
        $this->add_control(
            'before_img_bg_color_heading',
            [
                'label' => esc_html__( 'Before Image Background Color', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'before_image_border_style' => 'before_img_border_enable'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'before_img_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial.before_img_border_enable .testimonial-item .testimonial-content .image-wrap::after',
                'condition' => [
                    'before_image_border_style' => 'before_img_border_enable'
                ]
            ]
        );
        $this->add_control(
            'active_img_bg_color_heading',
            [
                'label' => esc_html__( 'Active Border Bg Color', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'before_image_border_style' => 'before_img_border_enable'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'before_img_bg_active_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial.before_img_border_enable .testimonial-item.slick-active .testimonial-content .image-wrap::after',
                'condition' => [
                    'before_image_border_style' => 'before_img_border_enable'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'before_img_bg__color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial.before_img_border_enable .testimonial-item .testimonial-content .image-wrap::after',
                'condition' => [
                    'before_image_border_style' => 'before_img_border_enable'
                ]
            ]
        );
        $this->add_control(
			'animation_border_setting_heading',
			[
				'label' => esc_html__( 'Animation Border (Progress)', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'animation_border_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-testimonial-nav-style2 .circle .bar .progress',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
			]
		);
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '.image-wrap > img',
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'title_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
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
               
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'title_left_position',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .testimonial-content' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style!' => 'style2',
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'testimonial_img_border_radius_contents',
            [
                'label' => esc_html__( 'Border Radius Content', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .testimonial-contents' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'testimonial_img_border_radius_inner',
            [
                'label' => esc_html__( 'Border Radius Inner', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .testimonial-contents .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Country Info Style Start
        $this->start_controls_section(
            'country_info_style',
            [
                'label' => esc_html__( 'Country Info Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_country_info' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'country_info_display',
            [
                'label' => esc_html__( 'Display Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .country_info' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ]
            ]
        );
		$this->add_responsive_control(
            'country_info_vertical_align',
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
					'country_info_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .country_info' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'country_info_flex_direction',
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
					'country_info_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .country_info' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'country_info_h_align',
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
					'country_info_display' => 'flex'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .country_info' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'country_info_text_align',
            [
                'label' => esc_html__( 'Text Align', 'rsaddon' ),
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
                    '{{WRAPPER}} .country_info' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
		    'country_info_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .country_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'country_info_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .country_info' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        // Flag Settings
        $this->add_control(
			'country_falg_heading',
            [
                'label' => esc_html__( 'Flag Setting', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
		    'c_flag_wrapper_border_radius',
		    [
		        'label' => esc_html__( 'Wrapper Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .country_info .country-flag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'c_flag_wrapper_width',
            [
                'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .country_info .country-flag' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
        $this->add_responsive_control(
            'c_flag_width',
            [
                'label' => esc_html__( 'Flag Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .country_info .country-flag img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',                   
                ],
            ]
        );
        $this->add_responsive_control(
            'c_flag_height',
            [
                'label' => esc_html__( 'Flag Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .country_info .country-flag img' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
        
        // Title Settings
        $this->add_control(
			'country_title_heading',
            [
                'label' => esc_html__( 'Title Setting', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'c_title_wrapper_width',
            [
                'label' => esc_html__( 'Wrapper Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
				'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .country_info .country-name' => 'flex: 0 0 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
        $this->add_control(
		    'c_title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .country_info .country-name' => 'color: {{VALUE}}',
		        ],
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'c_title_typography',
				'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .country_info .country-name',
			]
		);
        $this->add_responsive_control(
		    'c_title_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .country_info .country-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'c_title_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .country_info .country-name' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->end_controls_section();
        // Country Info Style End

        $this->start_controls_section(
            'section_quote_style',
            [
                'label' => esc_html__( 'Quote Icon', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'quote_icon_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .testimonial-items .quote-img-icon,{{WRAPPER}} .item-content span i',
			]
		);
        $this->add_responsive_control(
            'quote_icon_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .quote-img-icon,{{WRAPPER}} .item-content span i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_icon_opacity',
            [
                'label' => esc_html__( 'Quote Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					]
				],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .quote-img-icon,{{WRAPPER}} .item-content span i,{{WRAPPER}} .rs-testimonial .testimonial-item .item-content span img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_icon_width_custom',
            [
                'label' => esc_html__( 'Quote Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .quote-img-icon,{{WRAPPER}} .item-content span i,{{WRAPPER}} .rs-testimonial .testimonial-item .item-content span img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_icon_height_custom',
            [
                'label' => esc_html__( 'Quote Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items .quote-img-icon,{{WRAPPER}} .item-content span i,{{WRAPPER}} .rs-testimonial .testimonial-item .item-content span img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-content span i' => 'color: {{VALUE}};',             

                ],                
            ]
        );
        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .item-content span i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'icon_position',
            [
                'label' => esc_html__( 'Icon Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .item-content span i,{{WRAPPER}} .item-content .quote-img-icon' => 'top: {{SIZE}}{{UNIT}}; position:absolute; z-index: 3;',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon_position_left',
            [
                'label' => esc_html__( 'Icon Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-content span i,{{WRAPPER}} .item-content span.quote-img-icon' => 'left: {{SIZE}}{{UNIT}}; position:absolute',
                ],
                
            ]
        );
        
        $this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'active_img__css_filters',
				'selector' => '{{WRAPPER}} .slick-active .item-content span img',
                'condition' => [
                    'testimonial_style' => 'style1'
                ]
			]
		);
        $this->add_control(
			'current_quote_icon_heading',
			[
				'label' => esc_html__( 'Current Quote Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'style1'
                ]
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'current_img__css_filters',
				'selector' => '{{WRAPPER}} .slick-current .item-content span img',
                'condition' => [
                    'testimonial_style' => 'style1'
                ]
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_rac_style',
            [
                'label' => esc_html__( 'Bubble Arrow Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        

        $this->add_control(
            'arrow_bec_color',
            [
                'label' => esc_html__( 'Bubble Arrow Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content.bubble:after' => 'border-top-color: {{VALUE}};',  
                    '{{WRAPPER}} .rs-testi_stylestyle2 .item-content.bubble .testimonial-item:after' => 'border-top-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'bubble_position_x',
            [
                'label' => esc_html__( 'Bubble Position X', 'rsaddon' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' =>  1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content.bubble:after' => 'left: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testimonial--center .item-content.bubble:after'           => 'left: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testimonial--right .item-content.bubble:after'            => 'left: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testi_stylestyle2 .testimonial_wrapper .item-content.bubble .testimonial-item:after' => 'left: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [
                    '_design' => 'bubble'
                ]
            ]
        );
        $this->add_responsive_control(
            'bubble_position_y',
            [
                'label' => esc_html__( 'Bubble Position Y', 'rsaddon' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' =>  1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content.bubble:after' => 'bottom: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testimonial--center .item-content.bubble:after'           => 'bottom: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testimonial--right .item-content.bubble:after'            => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-testi_stylestyle2 .testimonial_wrapper .item-content.bubble .testimonial-item:after' => 'bottom: {{SIZE}}{{UNIT}};',                    
                    
                ],
                'condition' => [
                    '_design' => 'bubble'
                ]
            ]
        );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'section_boxes_style',
            [
                'label' => esc_html__( 'Testimonial Box Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
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
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'height: {{SIZE}}{{UNIT}};',                   
                ]
            ]
        );
        $this->add_responsive_control(
            'box_min_height',
            [
                'label' => esc_html__( 'Min Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
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
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'min-height: {{SIZE}}{{UNIT}};',                   
                ]
            ]
        );
        $this->add_responsive_control(
            'box_max_height',
            [
                'label' => esc_html__( 'Max Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
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
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'max-height: {{SIZE}}{{UNIT}};',                   
                ]
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testimonial .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style!' => 'style2'
                ]
            ]
        );
        $this->add_responsive_control(
            'box_padding2',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testimonial .testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide.slick-center:before, {{WRAPPER}} .rs-testimonial .testimonial-item' => 'background-color: {{VALUE}};',                    
                ],
            ]
        );  
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item',
            ]
        );
        $this->add_control(
            'box_current_border_color_heading',
            [
                'label' => esc_html__( 'Current Box Border Color', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'box_current_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item.slick-current' => 'border-color: {{VALUE}};',                    
                ],
            ]
        ); 
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testimonial, {{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide.slick-center:before, {{WRAPPER}} .rs-testimonial .testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_boxes_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs, {{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide.slick-center:before, {{WRAPPER}} .rs-testimonial .testimonial-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_style2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial',
                'condition' => [
                    'testimonial_style' => 'style2'
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'textdomain' ),
				'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs',
                'condition' => [
                    'testimonial_style' => 'style3',
                ],
			]
        );
        $this->add_control(
            'slick_box_active_heading',
            [
                'label' => esc_html__( 'Current Box Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'testimonial_style' => 'style1'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'active__box_shadow',
				'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-testimonial .slick-current',
                'condition' => [
                    'testimonial_style' => 'style1',
                ],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'active_bg',
                'label' => __( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial .slick-current',
                'condition' => [
                    'testimonial_style' => 'style1'
                ],
            ]
        );
        $this->add_control(
            'testimonial_info_heading',
            [
                'label' => esc_html__( 'Testimonial Information Padding', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'testimonial_information_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item.inline_yes .testimonial-content .testimonial-information' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'style1'
                ]
            ]
        );
        $this->end_controls_section();
        // Center Item Style Start
        $this->start_controls_section(
            'center_item_style_sec',
            [
                'label' => esc_html__( 'Center Item Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_centerMode' => 'true',
                ],
            ]
        );
        $this->add_control(
            'quote_setting_heading',
            [
                'label' => esc_html__( 'Quote Icon Setting', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'center_box_setting_heading',
            [
                'label' => esc_html__( 'Box Setting', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'center_item_bg',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .slick-center',
            ]
        );

        $this->add_responsive_control(
            'center_item_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-center' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'center_item_padding',
            [
                'label' => esc_html__( 'Border Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-center' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'center_item_border',
                'selector' => '{{WRAPPER}} .slick-center',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_testi_center_item_bshadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item.slick-center',
            ]
        );
        $this->add_control(
            'center_icon_image_setting_heading',
            [
                'label' => esc_html__( 'Icon/Image Setting', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'center_icon_image_css_filters',
                'selector' => '{{WRAPPER}} .slick-center .item-content span img',
            ]
        );
        $this->add_control(
            'center_content_setting_heading',
            [
                'label' => esc_html__( 'Content Setting', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'center_title_color',
            [
                'label' => esc_html__( 'Name Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-center .testimonial-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'center_designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-center .testimonial-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'center_desc_color',
            [
                'label' => esc_html__( 'Description Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-center p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'background_center_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} > .slick-center' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->end_controls_section();
        // Center Item Style End


        //  Item Style Start
        $this->start_controls_section(
            'leftright_item_style_sec',
            [
                'label' => esc_html__( 'Left Right Item Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'gradient_setting' => 'gradient_enable',
                ],
            ]
        );
        $this->add_control(
            'item_opacity',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .gradient_enable .testimonial-item:not(.slick-center)' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            'gradient_border',
            [
                'label' => esc_html__( 'Gradient Border Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_border_leftright',
                'label' => esc_html__( 'Gradient Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gradient_enable .testimonial-item:not(.slick-center)',
                
            ]
        );

        $this->add_control(
            'gradient_bg_lr',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_bg_leftright',
                'label' => esc_html__( 'Gradient Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gradient_enable .testimonial-item:not(.slick-center):before',
                
            ]
        );
        $this->end_controls_section();

        // Nav And Dot Style Start
        $this->start_controls_section(
            'section_arrow_bullet_style',
            [
                'label' => esc_html__( 'Slider Controller Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_style',
            [
                'label'   => esc_html__( 'Arrow Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'arrow_style1',
                'options' => [                  
                    'arrow_style1' => esc_html__( 'Style 1', 'rsaddon'),
                    'arrow_style2' => esc_html__( 'Style 2', 'rsaddon'),
                ],
            ]
        );

        // Arrow Start
        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:before' => 'color: {{VALUE}};',  
                ],                
            ]
        );

        $this->add_control(
            'arrow_normal_heading',
            [
                'label' => esc_html__( 'Arrow Background Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_normal_bg',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow',
            ]
        );


        $this->add_control(
            'arrow_hover_color',
            [
                'label' => esc_html__( 'Arrow Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover:before' => 'color: {{VALUE}};',  
                ],                
            ]
        );

        $this->add_control(
            'arrow_normal_heading_hover',
            [
                'label' => esc_html__( 'Arrow Hover Background Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_normal_bg_hover',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover',
            ]
        );

        $this->add_responsive_control(
            'arrow_font_size',
            [
                'label' => esc_html__( 'Arrow Font Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'arrow_opacity_normal',
            [
                'label' => esc_html__( 'Arrow Opacity (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'opacity: {{SIZE}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'arrow_opacity_hover',
            [
                'label' => esc_html__( 'Arrow Opacity (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider:hover .slick-arrow' => 'opacity: {{SIZE}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'arrow_width',
            [
                'label' => esc_html__( 'Arrow Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'arrow_height',
            [
                'label' => esc_html__( 'Arrow Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
		    'arrow_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        // Left Arrow Position Settings Start
        $this->add_control(
		    'arrow_position_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Arrow Position', 'rsaddon' ),
		        'separator' => 'before',
		    ]
		);
        $this->add_control(
			'prev_arrow_position',
			[
				'label'   => esc_html__( 'Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon'),
					'absolute' => esc_html__( 'Absolute', 'rsaddon'),
					'relative' => esc_html__( 'Relative', 'rsaddon'),
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-arrow' => 'position: {{VALUE}} !important;',
                ],
			]
		);


        $this->add_control(
		    'arrow_left_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Left Arrow Position Settings', 'rsaddon' ),
		        'separator' => 'before',
		    ]
		);
        $this->add_control(
			'prev_arrow_position_start_side_switcher',
			[
				'label'   => esc_html__( 'Move From', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Left', 'rsaddon'),
					'right' => esc_html__( 'Right', 'rsaddon'),
				],
			]
		);

        $this->add_responsive_control(
            'arrows_lefts_positions',
            [
                'label'      => esc_html__( 'Left Icon Horizontal Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
					'prev_arrow_position_start_side_switcher' => 'left',
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-prev, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'prev_arrows_rights_positions',
            [
                'label'      => esc_html__( 'Left Icon Horizontal Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
					'prev_arrow_position_start_side_switcher' => 'right',
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-prev, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrows_tops_positions',
            [
                'label'      => esc_html__( 'Left Icon Vertical Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-prev, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  
        // Left Arrow Position Settings End 

        // Right Arrow Position Settings Start
        $this->add_control(
		    'arrow_right_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Right Arrow Position Settings', 'rsaddon' ),
		        'separator' => 'before',
		    ]
		);
        $this->add_control(
			'next_arrow_position_start_side_switcher',
			[
				'label'   => esc_html__( 'Move From', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__( 'Left', 'rsaddon'),
					'right' => esc_html__( 'Right', 'rsaddon'),
				],
			]
		);
        $this->add_responsive_control(
            'arrows_rights_positions',
            [
                'label'      => esc_html__( 'Right Icon Horizontal Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
					'next_arrow_position_start_side_switcher' => 'right',
				],     
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-next, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next' => 'right: {{SIZE}}{{UNIT}}; left: unset !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'next_arrows_left_positions',
            [
                'label'      => esc_html__( 'Right Icon Horizontal Position (From Left)', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
					'next_arrow_position_start_side_switcher' => 'left',
				],     
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-next, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next' => 'left: {{SIZE}}{{UNIT}}; right: unset !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_tos_positions',
            [
                'label'      => esc_html__( 'Right Icon Vertical Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial .rs-testimonial-dots-style2 .slick-next, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Right Arrow Position Settings End
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ars_border',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-arrow',
            ]
        );

        $this->add_control(
            'ars_border_color_hover',
            [
                'label' => esc_html__( 'Border Color Hover', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Arrow End

        // Bullet Style Start
         $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__( 'Bullet Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'bullet_right',
			[
				'label' => esc_html__( 'Right', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'bullet_bottom',
			[
				'label' => esc_html__( 'Bottom', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'align_dots',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                    'center_align' => [
                        'title' => esc_html__( 'Top & Right Center', 'rsaddon' ),
                        'icon' => 'eicon-menu-bar',
                    ],
                   
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots' => 'text-align: {{VALUE}}'
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_wrap_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_slider_dots' );

        // Normal Bullet Start
        $this->start_controls_tab(
            'slider_dots_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'bullet_gradient',
            [
                'label' => esc_html__( 'Bullet Background', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'navigation_dot_icon_background',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
            ]
        );

        $this->add_responsive_control(
            'bullet_height_custom',
            [
                'label' => esc_html__( 'Bullet Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_normal_width_custom',
            [
                'label' => esc_html__( 'Bullet Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_border_radius_custom',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'bullet_border_custom',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'bullet_shadow_custom',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button'
            ]
        );

        $this->end_controls_tab();
        // Normal Bullet End

        // Active Bullet Start
        $this->start_controls_tab(
            'slider_dots_active_tab',
            [
                'label' => esc_html__( 'Active', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'navigation_dot_icon_background_active',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button, {{WRAPPER}} .rs-addon-slider .slick-dots li button:hover',
            ]
        );

        $this->add_responsive_control(
            'bullet_active_width_custom',
            [
                'label' => esc_html__( 'Bullet Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_dot_active_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Active Bullet End

        $this->add_responsive_control(
            'bullet_spacing_custom',
            [
                'label' => esc_html__( 'Top Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 25,
                ],          
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom: {{SIZE}}{{UNIT}};',                    
                ],
            ]
        );
        // Bullet Style End

        $this->end_controls_section();
        // Nav And Dot Style End

    }

    /**
     * Render rsgallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() {
        $settings = $this->get_settings_for_display();

        $slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'false' ? 'true' : 'false';
        $fade            = $settings['fade_animation'] === 'false' ? 'true' : 'false';
        $nav_vertical    = $settings['nav_vertical'] === 'false' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        
        if ( is_rtl() ){
           $rtl= 'true';
        } else {
           $rtl= 'false';
        }
        
        $unique = rand(2012,35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'nav_vertical' , 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'fade', 'col_lg', 'col_md', 'col_sm', 'col_xs');   

        ?>  
        <div class="rsaddon-unique-slider <?php echo esc_html($settings['testimonial_slider_skew']);?> rs-testimonial-grid rs-testimonial <?php echo esc_html($settings['before_image_border_style']);?>  rs-testi_style<?php echo esc_attr( $settings['testimonial_style'] );?> <?php if('true' == $settings['slider_centerMode']){?> rs-cenermore <?php } ?> <?php echo esc_attr( $settings['gradient_setting'] );?>  <?php echo esc_attr( $settings['arrow_style'] );?>">

            <!-- Start style 1 -->
            <?php if('style1' == $settings['testimonial_style']):?>  
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider ">
                    <?php

                        $url = plugin_dir_url( __FILE__ );
                        $cat = $settings['testimonial_category'];

                        if(empty($cat)){
                            $best_wp = new wp_Query(array(
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],                              
                            ));   
                        }   
                        else{
                            $best_wp = new wp_Query(array(
                                
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],              
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'testimonial-category',
                                        'field'    => 'slug', //can be set to ID
                                        'terms'    => $cat //if field is ID you can reference by cat/term number
                                    ),
                                )
                            ));   
                        }
                        while($best_wp->have_posts()): $best_wp->the_post();
                            $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                            $country_name  = !empty(get_post_meta( get_the_ID(), 'country_name', true )) ? get_post_meta( get_the_ID(), 'country_name', true ):'';

                            $flag_id = get_post_meta( get_the_ID(), 'country_flag_id', true );
                            $flag_url = wp_get_attachment_image_src( $flag_id, 'large' );

                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';

                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }
                            
                        ?>  
                        
                            
                        <div class="testimonial-item <?php echo esc_attr( $settings['align'] );?> <?php echo esc_attr( $settings['inline_image_author'] );?>"> 
                            <?php if('top' == $settings['title_position']) {?>                               
                                <div class="testimonial-content">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>  
                                    
                                    <div class="testimonial-information">

                                        <?php if($settings['inline_image_author'] == 'inline_no'): ?>

                                            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                            <?php endif;?> 

                                        <?php endif;?> 

                                        <?php if(get_the_title()):?>                         
                                            <div class="testimonial-name"><?php the_title();?></div>
                                        <?php endif;?>
                                        <?php if( $designation ):?>
                                            <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                        <?php endif; ?>

                                        <?php if($settings['inline_image_author'] == 'inline_yes'): ?>

                                            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                            <?php endif;?> 

                                        <?php endif;?> 
                                    </div>
                                    
                                </div>
                            <?php }?>   

                                <div class="item-content <?php echo esc_attr($settings['_design']);?>">

                                    <?php if(!empty($settings['icon'])) : ?>
                                        <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                                    <?php endif; ?>

                                    

                                    <?php if(!empty($settings['selected_image'])) :?>
                                        <span class="quote-img-icon">
                                            <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" class="normal__img" alt="image"/>

                                            <?php if(!empty($settings['selected_image_hover']['url'])) {?>
                                                <img src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" class="hover__img" alt="image"/>
                                            <?php } ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if('yes' == $settings['show_ratings_top_of_content']){ ?>
                                        <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                            <div class="ratings">
                                                <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                            </div>
                                        <?php endif; ?>
                                    <?php } ?>
                                    
                                    <!-- Testimonial Description Start -->
                                    <?php the_content(); ?>
                                    <!-- Testimonial Description Start -->
                                        
                                </div>  

                            <?php if('bottom' == $settings['title_position']) {?>
                                <?php if($settings['inline_image_author'] == 'inline_yes'): ?>
                                    <?php if('yes' !== $settings['show_ratings_top_of_content']){ ?>
                                        <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                            <div class="ratings">
                                                <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                            </div>
                                        <?php endif;?> 
                                    <?php } ?> 

                                <?php endif;?>                                  
                                <div class="testimonial-content">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>  
                                    
                                        <div class="testimonial-information">

                                            <?php if($settings['inline_image_author'] == 'inline_no'): ?>
                                                <?php if('yes' !== $settings['show_ratings_top_of_content']){ ?>
                                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                        <div class="ratings">
                                                            <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                                        </div>
                                                    <?php endif;?> 
                                                <?php } ?> 

                                            <?php endif;?>  

                                            <?php if(get_the_title()):?>                         
                                                <div class="testimonial-name"><?php the_title();?></div>
                                            <?php endif;?>
                                            <?php if($settings['show_designation'] == 'yes'): ?>
                                                <?php if( $designation ):?>
                                                    <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <!-- Country Info Start -->
                                            <?php if('yes' == $settings['show_country_info']){ ?>
                                                <div class="country_info">
                                                    <div class="country-flag">
                                                        <?php  if ( !empty($flag_url[0]) ) {
                                                            echo '<img src="' . esc_url( $flag_url[0] ) . '" alt="img">';
                                                        } ?>
                                                    </div>
                                                    <?php if( $country_name ):?>
                                                        <span class="country-name"> <?php echo esc_html( $country_name );?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php } ?>
                                            <!-- Country Info Start -->
                                        </div>
                                    
                                </div>
                            <?php }?>                       
                        </div>
                            
                        <?php   
                        endwhile;
                        wp_reset_query(); 

                        ?>  
                </div>
            <?php endif; ?>
            <!-- End style 1 -->

            <!-- Start style 4 -->
            <?php if('style4' == $settings['testimonial_style']):?>  
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider testimonial-item-style4 color_<?php echo esc_html($settings['choose_color_scheme']); ?>" >
                    <?php

                        $url = plugin_dir_url( __FILE__ );
                        $cat = $settings['testimonial_category'];
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        if(empty($cat)){
                            $best_wp = new wp_Query(array(
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],                              
                            ));   
                        }   
                        else{
                            $best_wp = new wp_Query(array(
                                
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],              
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'testimonial-category',
                                        'field'    => 'slug', //can be set to ID
                                        'terms'    => $cat //if field is ID you can reference by cat/term number
                                    ),
                                )
                            ));   
                        }

                        while($best_wp->have_posts()): $best_wp->the_post();
                            $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';

                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }
                            
                        ?>                           
                            
                        <div class="testimonial-item <?php echo esc_attr( $settings['align'] );?> <?php echo esc_attr( $settings['inline_image_author'] );?>"> 
                            <?php if('top' == $settings['title_position']) {?>                               
                                <div class="testimonial-content">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>  
                                    
                                        <div class="testimonial-information">

                                            <?php if(get_the_title()):?>                         
                                                <div class="testimonial-name"><?php the_title();?></div>
                                            <?php endif;?>
                                            <?php if( $designation ):?>
                                                <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                            <?php endif; ?>


                                                <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                    <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                                <?php endif;?> 

                                        </div>
                                    
                                </div>
                            <?php }?>  

                            <div class="item-content <?php echo esc_attr($settings['_design']);?>">

                                <?php if(!empty($settings['icon'])) : ?>
                                    <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                                <?php endif; ?>

                                <?php if(!empty($settings['selected_image'])) :?>
                                    <span class="quote-img-icon">
                                        <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" class="normal__img" alt="image"/>
                                        <?php if(!empty($settings['selected_image_hover']['url'])) {?>
                                            <img src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" class="hover__img" alt="image"/>
                                        <?php } ?>
                                    </span>
                                <?php endif;

                                    the_content();
                                ?>  
                            </div>  

                            <?php if('bottom' == $settings['title_position']) {?>                               
                                <div class="testimonial-content">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>  
                                    
                                        <div class="testimonial-information">

                                            <?php if(get_the_title()):?>                         
                                                <div class="testimonial-name"><?php the_title();?></div>
                                            <?php endif;?>

                                            <?php if( $designation ):?>
                                                <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                            <?php endif; ?>

                                            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                            <?php endif;?>

                                        </div>
                                </div>
                            <?php }?>                       
                        </div>
                            
                        <?php   
                        endwhile;
                        wp_reset_query(); 

                        ?>  
                </div>
            <?php endif; ?>
            <!-- End style 4 -->

            <!-- Start style 3 -->
            <?php if('style3' == $settings['testimonial_style']):?>  

                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider sliders-restimon3" >
                    <?php
                        $url = plugin_dir_url( __FILE__ );
                        $cat = $settings['testimonial_category'];
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        if(empty($cat)){
                            $best_wp = new wp_Query(array(
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],                              
                            ));   
                        }   
                        else{
                            $best_wp = new wp_Query(array(
                                
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],              
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'testimonial-category',
                                        'field'    => 'slug', //can be set to ID
                                        'terms'    => $cat //if field is ID you can reference by cat/term number
                                    ),
                                )
                            ));   
                        }

                        while($best_wp->have_posts()): $best_wp->the_post();
                            $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';
                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';
                            
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }
                        ?>                           
                            
                        <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> <?php echo esc_attr( $settings['inline_image_author'] );?>"> 
                            <div class="inrs">                                                                  
                                <div class="testimonial-contents">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>                                         
                                </div>
                                
                                <div class="item-content <?php echo esc_attr($settings['_design']);?>">

                                    <?php if(!empty($settings['icon'])) : ?>
                                        <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['selected_image']['url'])) :?>
                                        <span class="quote-img-icon">
                                            
                                            <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" class="normal__img" alt="image"/>

                                            <?php if(!empty($settings['selected_image_hover']['url'])) {?>
                                                <img src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" class="hover__img" alt="image"/>
                                            <?php } ?>
                                        </span>
                                    <?php endif;
                                        the_content();
                                    ?> 
                                    <?php if($settings['show_title_img'] == 'yes' || $settings['show_des_img'] == 'yes'){ ?>
                                        <div class="testimonial-informations">      
                                            <?php if($settings['show_title_img'] == 'yes'): ?>                           
                                                <?php if(get_the_title()):?>                         
                                                    <div class="testimonial-name"><?php the_title();?></div>
                                                <?php endif;?>
                                            <?php endif;?>

                                            <?php if($settings['show_des_img'] == 'yes'): ?>
                                                <?php if( $designation ):?>
                                                    <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                <?php endif; ?>
                                            <?php endif;?>
                                        </div> 
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                            
                        <?php   
                        endwhile;
                        wp_reset_query(); 

                        ?>  
                    
                </div>
            <?php endif; ?>
            <!-- End style 3 -->

            <!-- Start style 5 -->
            <?php if('style5' == $settings['testimonial_style']):?>  
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider sliders-restimon3" >
                    <?php
                        $url = plugin_dir_url( __FILE__ );
                        $cat = $settings['testimonial_category'];
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        if(empty($cat)){
                            $best_wp = new wp_Query(array(
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],                              
                            ));   
                        }   
                        else{
                            $best_wp = new wp_Query(array(
                            
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],              
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'testimonial-category',
                                        'field'    => 'slug', //can be set to ID
                                        'terms'    => $cat //if field is ID you can reference by cat/term number
                                    ),
                                )
                            ));   
                        }

                        while($best_wp->have_posts()): $best_wp->the_post();
                            $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';
                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';
                            
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }
                        ?>                           
                        
                        <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?>  <?php echo esc_attr( $settings['inline_image_author'] );?>"> 
                            <div class="inrs">                                                              
                                <div class="testimonial-contents">                                   
                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap" >                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </div>
                                    <?php endif;?>                                         
                                </div>
                                
                                <div class="item-content-bg-gradient">
                                    <div class="item-content <?php echo esc_attr($settings['_design']);?>">
                                        <?php if(!empty($settings['icon'])) : ?>
                                            <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                                        <?php endif; ?>
                                        <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                            <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                        <?php endif;?>

                                        <?php if(!empty($settings['selected_image']['url'])) :?>
                                            <span class="quote-img-icon">
                                                
                                                <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" class="normal__img" alt="image"/>

                                                <?php if(!empty($settings['selected_image_hover']['url'])) {?>
                                                    <img src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" class="hover__img" alt="image"/>
                                                <?php } ?>
                                            </span>
                                        <?php endif;
                                            the_content();
                                        ?> 
                                        <?php if($settings['show_title_img'] == 'yes' || $settings['show_des_img'] == 'yes'){ ?>
                                        <div class="testimonial-informations">      
                                            <?php if($settings['show_title_img'] == 'yes'): ?>                           
                                                <?php if(get_the_title()):?>                         
                                                    <div class="testimonial-name"><?php the_title();?></div>
                                                <?php endif;?>
                                            <?php endif;?>

                                            <?php if($settings['show_des_img'] == 'yes'): ?>
                                                <?php if( $designation ):?>
                                                    <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                <?php endif; ?>
                                            <?php endif;?>
                                        </div> 
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php   
                        endwhile;
                        wp_reset_query(); 
                    ?>
                </div>
            <?php endif; ?>
            <!-- End style 5 -->

            <!-- Start style 2 -->
            <?php if('style2' == $settings['testimonial_style']) : $show_client_logo = $settings['show_client_logo']; ?>  
                <div class="testimonial_wrapper nav_vertical_<?php echo esc_html($settings['nav_vertical']); ?>">
                    <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="slider-for rs-testimonial-dots-style2" >
                        <?php
                            $url = plugin_dir_url( __FILE__ );
                            $cat = $settings['testimonial_category'];
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            if(empty($cat)){
                                $best_wp = new wp_Query(array(
                                    'post_type'      => 'testimonials',
                                    'posts_per_page' => $settings['per_page'],                              
                                ));   
                            }   
                            else{
                                $best_wp = new wp_Query(array(
                                    
                                    'post_type'      => 'testimonials',
                                    'posts_per_page' => $settings['per_page'],              
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'testimonial-category',
                                            'field'    => 'slug', //can be set to ID
                                            'terms'    => $cat //if field is ID you can reference by cat/term number
                                        ),
                                    )
                                ));   
                            }
                            while($best_wp->have_posts()): $best_wp->the_post();
                                $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                                $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';
                                $client_logo  = !empty(get_post_meta( get_the_ID(), 'custom_meta_upload', true )) ? get_post_meta( get_the_ID(), 'custom_meta_upload', true ):'';

                                $thumbnail_id = get_post_thumbnail_id();
                                $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                                if ( empty( $thumbnail_alt ) ) {
                                    $thumbnail_alt = get_the_title( $thumbnail_id );
                                }
                                
                            ?>   
                            <div class="testimonial-item <?php echo esc_attr( $settings['align'] );?> <?php echo esc_attr( $settings['inline_image_author'] );?>">
                                <div class="item-content <?php echo esc_attr($settings['_design']);?>">

                                    <?php if(!empty($settings['icon'])) : ?>
                                        <span><i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i></span>
                                    <?php endif; ?>

                                    <?php if(!empty($settings['selected_image'])) :?>
                                        <span class="quote-img-icon">
                                            <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" class="normal__img" alt="image"/>
                                            <?php if(!empty($settings['selected_image_hover']['url'])) {?>
                                                <img src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" class="hover__img" alt="image"/>
                                            <?php } ?>
                                        </span>
                                    <?php endif;?>
                                    
                                    <?php 
                                    $rs_content = get_the_content();
                                    if(!empty($rs_content)): ?>
                                        <div class="testimonial-item"> <p><?php echo esc_html($rs_content); ?></p> </div>
                                    <?php endif; ?>
                                    <div class="avatar_info_wrap">
                                        <?php if($settings['show_images'] == 'yes' ): ?>
                                            <div class="image-wrap <?php echo esc_attr( $settings['show_gradient_border'] );?>">
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="bottom_part_wapper">
                                            <div class="client_logo_rating">
                                            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                            <?php endif;?> 
                                            
                                            <?php if($show_client_logo == 'yes') { ?>
                                                <div class="client_logo"><img src="<?php echo esc_url($client_logo); ?>" alt="client logo" /></div>
                                                <?php } ?>
                                            </div> 

                                            <div class="author-inner">
                                                <?php if(get_the_title()):?>                        
                                                    <div class="testimonial-name"><?php the_title();?></div>
                                                <?php endif;?>
                                                <?php if( $designation ):?>
                                                    <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>                  
                            </div>
                                
                            <?php   
                            endwhile;
                            wp_reset_query(); 

                            ?>  
                    </div>
                    <?php if($settings['show_nav_images'] == 'yes' ): ?>
                        <div class="slider-nav rs-testimonial-nav-style2">
                            <?php
                                $url = plugin_dir_url( __FILE__ );
                                $cat = $settings['testimonial_category'];
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                                if(empty($cat)){
                                    $best_wp = new wp_Query(array(
                                        'post_type'      => 'testimonials',
                                        'posts_per_page' => $settings['per_page'],                              
                                    ));   
                                }   
                                else{
                                    $best_wp = new wp_Query(array(
                                        
                                        'post_type'      => 'testimonials',
                                        'posts_per_page' => $settings['per_page'],              
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'testimonial-category',
                                                'field'    => 'slug', //can be set to ID
                                                'terms'    => $cat //if field is ID you can reference by cat/term number
                                            ),
                                        )
                                    ));   
                                }

                                while($best_wp->have_posts()): $best_wp->the_post();
                                    $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                                    $thumbnail_id = get_post_thumbnail_id();
                                    $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                                    if ( empty( $thumbnail_alt ) ) {
                                        $thumbnail_alt = get_the_title( $thumbnail_id );
                                    }
                                ?> 
                                
                                <div class="item">
                                    <div class="nav-image">
                                        <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        <div class="circle">
                                            <div class="circular">
                                                <div class="inner"></div>
                                                <div class="circle">
                                                    <div class="bar left">
                                                    <div class="progress"></div>
                                                    </div>
                                                    <div class="bar right">
                                                    <div class="progress"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php   
                                endwhile;
                                wp_reset_query(); 

                                ?> 
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <!-- End style 2 -->
            <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
        </div>

        <!-- Javascript Section -->

        <?php if(('style1' == $settings['testimonial_style']) || ('style3' == $settings['testimonial_style']) || ('style5' == $settings['testimonial_style'])):?>  
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    jQuery( '.rs-addon-slider' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                   
                    if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
                    jQuery('#'+slider_id).not('.slick-initialized').slick({
                    slidesToShow    : parseInt(slider_conf.col_lg),
                    centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
                    infinite        : true,
                    dots            : (slider_conf.sliderDots)  == "true" ? true : false,
                    arrows          : (slider_conf.sliderNav) == "true" ? true : false,
                    autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
                    slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                    centerPadding   : '15px',
                    autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
                    pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
                    loop : true,
                    responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_md),
                        }
                    }, 
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_sm),
                        }
                    }, 
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: parseInt(slider_conf.col_xs),
                        }
                    }, ]
                    });
                }
       
             });
                });
            </script>
        <?php endif; ?>

        <?php if(('style4' == $settings['testimonial_style'])):?>  
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    jQuery( '.rs-addon-slider' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                   
                    if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
                    jQuery('#'+slider_id).not('.slick-initialized').slick({
                    slidesToShow    : parseInt(slider_conf.col_lg),
                    centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
                    dots            : (slider_conf.sliderDots)  == "true" ? true : false,
                    arrows          : (slider_conf.sliderNav) == "true" ? true : false,
                    autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
                    slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                    centerPadding   : '15px',
                    autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
                    pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
                    loop : false,
                    rtl: <?php echo $rtl; ?>,
                    responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_md),
                        }
                    }, 
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_sm),
                        }
                    }, 
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: parseInt(slider_conf.col_xs),
                        }
                    }, ]
                    });
                }
       
             });
                });
            </script>
        <?php endif; ?>

        <?php if('style2' == $settings['testimonial_style']):?> 
            <script type="text/javascript"> 
                jQuery(document).ready(function(){

                    jQuery( '.slider-for' ).each(function( index ) { 
                    var slider_id       = jQuery(this).attr('id');     
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                    var sliderfor = jQuery('.slider-for');
                    if(sliderfor.length){
                        jQuery('.slider-for').slick({
                            slidesToShow    : parseInt(slider_conf.col_lg),
                            slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                            arrows  : (slider_conf.sliderNav) == "true" ? true : false,
                            centerMode : (slider_conf.centerMode) == "false" ? true : false,
                            fade : (slider_conf.fade) == "false" ? true : false,
                            asNavFor: '.slider-nav',
                            responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: parseInt(slider_conf.col_md),
                                }
                            }, 
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: parseInt(slider_conf.col_sm),
                                }
                            }, 
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    slidesToShow: parseInt(slider_conf.col_xs),
                                }
                            },]
                        });
                    }
                    var slidernav = jQuery('.slider-nav');
                    if(slidernav.length){
                        jQuery('.slider-nav').slick({
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            asNavFor: '.slider-for',
                            dots    : (slider_conf.sliderDots)  == "true" ? true : false,
                            arrows  : false,
                            vertical: (slider_conf.nav_vertical) == "false" ? true : false,
                            centerMode : true,
                            centerPadding: '0',
                            focusOnSelect: true,
                            directionNav: true,
                            autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
                            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
                            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
                            responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 4,
                                }
                            }, 
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 4,
                                }
                            }, 
                            {
                                breakpoint: 768,
                                settings: {
                                    arrows: false,
                                    slidesToShow: 4,
                                }
                            },]
                        });
                    }  
       
             });
                });
            </script>

        <?php endif; ?>

        <!-- Javascript Section End -->

        <?php
    }
    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'testimonials' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'testimonial-category',
                'hide_empty'  => true            
            ) );  
            
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}?>