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
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Testimonial_custom_Slider_Widget extends \Elementor\Widget_Base {

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
        return 'rs-testimonial-slider-two';
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
        return esc_html__( 'RS Testimonial Slider Two', 'rsaddon' );
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
				'default' => 'default_scheme',				
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
                ],
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

        $this->add_control(
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
                'prefix_class' => 'rs-testimonial--',
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .rs-testimonial .testimonial-informations' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
			'testimonial_word_show',
			[
				'label' => esc_html__( 'Content Limit', 'prelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '20', 'prelements' ),
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
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-contents span img' => 'width: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .quote-icon' => 'width: {{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [
                    'icon_type' => 'image',
                ]
            ]
        );
        $this->add_responsive_control(
            'normal_quote_opacity',
            [
                'label' => esc_html__( 'Normal Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial2 .rs-addon-slider .testimonial-items .item-contents img' => 'opacity: {{SIZE}}!important;',                   
                ],
                'condition' => [
                    'icon_type' => 'image',
                    'testimonial_style'=>'style3'

                ]
            ]
        );
        $this->add_responsive_control(
            'hover_quote_opacity',
            [
                'label' => esc_html__( 'Hover Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial2 .rs-addon-slider .testimonial-items:hover .item-contents img' => 'opacity: {{SIZE}}!important;',                   
                ],
                'condition' => [
                    'icon_type' => 'image',
                    'testimonial_style'=>'style3'

                ]
            ]
        );
        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__( 'Quote Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS, 
                'condition' => [
                    'icon_type' => 'icon'
                ]            
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
            'show_service__title',
            [
                'label' => esc_html__( 'Show Service Title', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'textdomain' ),
                'label_off' => esc_html__( 'Hide', 'textdomain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
			'service_title',
			[
				'label' => esc_html__( 'Service Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Services:',
				'separator' => 'before',
                'condition'=>[
                    'show_service__title'=>'yes'
                ]
			]
			
		);
        $this->add_control(
            'desc_word_limit',
            [
                'label' => esc_html__( 'Description Word Limit', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'rsaddon' ),
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
                'separator' => 'before',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .testimonial-contents' => 'display: {{VALUE}};',
                ],
                'condition'=>[
                    'testimonial_style'=>'style1',
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
                'condition'=>[
                    'testimonial_style'=>'style1',
                    'box_horizontal_align'=>'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .testimonial-contents' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

         $this->start_controls_section(
            '_section_ratings',
            [
                'label' => esc_html__( 'Ratings/ Second Quote Image', 'rsaddon' ),
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
                'condition'     =>[
                    'testimonial_style!'=>'style5',
                ]
            ]
        );
        $this->add_control(
            'show_quote_img',
            [
                'label'        => esc_html__( 'Second Quote Image', 'rsaddon' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_responsive_control(
            'rating_bottom_position',
            [
                'label'      => esc_html__( 'Bottom Gap', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
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
        $this->add_control(
            'quote_img__',
            [
                'label' => esc_html__( 'Quote Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,
                'condition' => [
                    'show_quote_img' => 'yes'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'quote_img__width',
            [
                'label' => esc_html__( 'Second Quote Img Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' =>0 ,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .testimonial-contents .second-quote img, {{WRAPPER}} .testimonial-items.testimonial-style5 .testimonial-item .testimonial-contents .icon-service-title img' => 'width: {{SIZE}}{{UNIT}}; height:auto;',                    
                ],

                'condition' => [
                    'show_quote_img' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'quote_img__top_bottom_position',
            [
                'label' => esc_html__( 'Second Quote Img Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .testimonial-contents .second-quote' => 'bottom: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
                    'show_quote_img' => 'yes',
                    'testimonial_style!'=>'style5'
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
                   
                ],
                'toggle' => false,
                'default' => '',
                'prefix_class' => 'rs-testimonial--',
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots' => 'text-align: {{VALUE}}'
                ],
               'condition' => [
                'slider_dots' => 'true',
               ],
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );
            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                    'condition' => [
                     'slider_dots' => 'true',
                    ],
                ]
            ); 

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'gradient_bg_color_dots',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots li button',
                    'condition' => [
                     'slider_dots' => 'true',
                    ],
                ]
            );

            $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_hover_tab',
                    [
                        'label' => esc_html__( 'Active', 'rsaddon' ),
                        'condition' => [
                         'slider_dots' => 'true',
                        ],
                    ]
                ); 

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'gradient_bg_colordots_active',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-dots li.slick-active button',
                        'condition' => [
                         'slider_dots' => 'true',
                        ],
                    ]
                );

            $this->end_controls_tab();
        $this->end_controls_tabs();

       

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
            'slider_fade',
            [
                'label'   => esc_html__( 'Fade', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'true',           
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

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .rsaddon-unique-slider .testimonial-items' => 'margin-left:{{SIZE}}{{UNIT}};',     
                    '{{WRAPPER}} .rsaddon-unique-slider .testimonial-items' => 'margin-right:{{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 

         $this->add_responsive_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-addon-slider .testimonial-item' => 'margin-bottom:{{SIZE}}{{UNIT}};',                    
                ],
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

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item:hover .testimonial-info .testimonial-name' => 'color: {{VALUE}};',             

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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-title',                    
            ]
        );

        $this->add_responsive_control(
            'designation_padding',
            [
                'label' => esc_html__( 'Designation Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-nav-style2 .item .testimonial-name, {{WRAPPER}} .testimonial-content, {{WRAPPER}} .rs-testimonial .testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Area Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-nav-style2 .item .testimonial-name, {{WRAPPER}} .testimonial-content,{{WRAPPER}} .rsaddon-unique-slider .testimonial-info .testimonial-name, {{WRAPPER}} .rs-testimonial .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'service_title_style_title',
            [
                'label' => esc_html__( 'Service Style Title ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    'testimonial_style'=>'style5',
                ],
            ]
        );
        $this->add_control(
            'service_title_color_',
            [
                'label' => esc_html__( 'Service Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .testimonial-items.testimonial-style5 .testimonial-item .testimonial-contents .icon-service-title span' => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'testimonial_style'=>'style5',
                ],              
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'service_title_typo',
                'label' => esc_html__( 'Service Title Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .testimonial-items.testimonial-style5 .testimonial-item .testimonial-contents .icon-service-title span',
                'condition'=>[
                    'testimonial_style'=>'style5',
                ],                    
            ]
        );
        $this->add_responsive_control(
            'service_title_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items.testimonial-style5 .testimonial-item .testimonial-contents .icon-service-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'=>[
                    'testimonial_style'=>'style5',
                ],
            ]
        );
        $this->add_responsive_control(
            'service_title__margin',
            [
                'label' => esc_html__( 'Service Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-items.testimonial-style5 .testimonial-item .testimonial-contents .icon-service-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'=>[
                    'testimonial_style'=>'style5',
                ],
            ]
        );
        $this->add_control(
            'service_align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                   
                ],
                'toggle' => false,
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-name-desc' => 'text-align: {{VALUE}}!important',
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
        $this->add_control(
            'content_hover_color',
            [
                'label' => esc_html__( 'Content Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item:hover .item-contents p' => 'color: {{VALUE}};',                    

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
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item .item-contents p, {{WRAPPER}} .rs-testimonial .rs-addon-slider.sliders-restimon3 .testimonial-items .inrs:after',
            ]
        );
        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item p',
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
                'label' => esc_html__( 'Image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
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
                    '{{WRAPPER}} .image-wrap img' => 'width: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
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
                    '{{WRAPPER}} .image-wrap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
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
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .image-wrap img' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_left_position',
            [
                'label' => esc_html__( 'Left Position', 'rsaddon' ),
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
                    '{{WRAPPER}} .image-wrap img' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'align_left__right_authors',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Block', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'inline-flex' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex' => [
                        'title' => esc_html__( 'Flex', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                   
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .image-wrap' => 'display:{{VALUE}}; '
                ]
               
            ]
        );
        $this->add_responsive_control(
            'auth_img_margin__',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .image-wrap' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'testi_image_border',
		        'selector' => '{{WRAPPER}} .image-wrap img',
		    ]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testi_image_box_shadow',
				'selector' => '{{WRAPPER}} .image-wrap img'
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Category', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['testimonial_style' => 'style1']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'serivce_typography',
                'label' => esc_html__( 'Service Title Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-addon-slider .testimonial-informations h3',                     
            ]
        );
        $this->add_responsive_control(
            'service_title_margin',
            [
                'label' => esc_html__( 'Service Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .testimonial-informations h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'service_title_color',
            [
                'label' => esc_html__( 'Service Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rs-addon-slider .testimonial-informations h3' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'service_title_hover_color',
            [
                'label' => esc_html__( 'Service Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rs-addon-slider .testimonial-item:hover .testimonial-informations h3' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-informations .testimonial-cat a' => 'color: {{VALUE}};',                    

                ],                
            ]
        );
        $this->add_control(
            'cat_hover_color',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .testimonial-item:hover .testimonial-informations .testimonial-cat a' => 'color: {{VALUE}};',                    

                ],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => esc_html__( 'Category Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .testimonial-informations .testimonial-cat a'
            ]
        );
        $this->add_responsive_control(
            'category_margin',
            [
                'label' => esc_html__( 'Content Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-informations .testimonial-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

         $this->start_controls_section(
            'section_quote_style',
            [
                'label' => esc_html__( 'Quote Icon', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'testimonial_style!'=>'style5'
                ]
            ]
        );
         $this->add_control(
            'align_left__right_rating',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                   
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .ratings' => 'display:flex; align-items:center; justify-content: {{VALUE}}; '
                ]
               
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-contents span i' => 'color: {{VALUE}};',             
                    '{{WRAPPER}} .testimonial-items .testimonial-item .testimonial-contents .quote-icon svg path' => 'fill: {{VALUE}};',             

                ],                
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [           
                    '{{WRAPPER}} .testimonial-items:hover .testimonial-item .testimonial-contents .quote-icon svg path' => 'fill: {{VALUE}}!important;',             

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
                    '{{WRAPPER}} .item-contents span i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        
        $this->add_responsive_control(
            'icon_quote_svg_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
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
                    '{{WRAPPER}} .testimonial-item .testimonial-contents .quote-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon_quote_svg_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
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
                    '{{WRAPPER}} .testimonial-item .testimonial-contents .quote-icon svg' => 'height: {{SIZE}}{{UNIT}};',
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
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .item-contents span img, {{WRAPPER}} .item-contents span i' => 'top: {{SIZE}}{{UNIT}}; position:absolute',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'icon_position_left',
            [
                'label' => esc_html__( 'Icon Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                   
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .item-contents span img, {{WRAPPER}} .item-contents span i' => 'left: {{SIZE}}%; position:absolute',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'quote_icon_opacity',
            [
                'label' => esc_html__( 'Quote Icon Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .rs-testimonial2 .rs-addon-slider .testimonial-items .item-contents img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_arrow_style',
            [
                'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_nav'=>'true',
                ]
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
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_font_typography_style_two',
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow',
                'condition'=>[
                    'testimonial_style'=>'style2',
                ] 
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:before, {{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow,{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow svg path' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'arrow_color_hover',
            [
                'label' => esc_html__( 'Arrow Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover:before, {{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-arrow:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .custom-nav .slick-arrow:hover svg path' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => esc_html__( 'Arrow Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow' => 'background: {{VALUE}};',  
                ],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]              
            ]
        );
        $this->add_control(
            'arrow_bg_color_hover',
            [
                'label' => esc_html__( 'Arrow Hover Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover' => 'background: {{VALUE}};',  
                ],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]             
            ]
        );

        $this->add_control(
            'ars_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev' => 'border-color: {{VALUE}};',
                ],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
            ]
        );
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'ars_border_color',
		        'selector' => '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev',
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
		    ]
		);

        $this->add_control(
            'ars_border_color_hover',
            [
                'label' => esc_html__( 'Border hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-next:hover, {{WRAPPER}} .rs-testimonial .rs-addon-slider .slick-prev:hover' => 'border-color: {{VALUE}};',
                ],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-testimonial-dots-style2 .slick-next, {{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-testimonial-dots-style2 .slick-prev, {{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow',
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
            ]
        );
        $this->add_responsive_control(
			'arrow_opacity_noraml',
			[
				'label' => esc_html__( 'Arrow Opacity (Normal)', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
                        'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-addon-slider .slick-next' => 'opacity: {{SIZE}} !important; visibility: unset !important;',
				],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
			]
		);
        $this->add_responsive_control(
			'arrow_opacity_hover',
			[
				'label' => esc_html__( 'Arrow Opacity (Hover)', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
                        'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider:hover .slick-prev, {{WRAPPER}} .rs-addon-slider:hover .slick-next' => 'opacity: {{SIZE}} !important; visibility: unset !important;',
				],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
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
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-addon-slider .slick-next' => 'width: {{SIZE}}{{UNIT}}; display: flex; justify-content: center;',
				],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
			]
		);
        $this->add_responsive_control(
            'arrow_padding___',
            [
                'label' => esc_html__( ' Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],  
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition'=>[
                    'testimonial_style'=>'style2',
                ]
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
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .rs-addon-slider .slick-next' => 'height: {{SIZE}}{{UNIT}}; display: flex; align-items: center;',
				],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
			]
		);
        
        $this->add_control(
			'arrow_options',
			[
				'label' => esc_html__( 'Arrow Position', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'arrow_position_maker',
			[
				'label' => esc_html__( 'Arrow Position Style', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'custom' => esc_html__( 'Custom', 'rsaddon' ),
				],
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
			]
		);

		$this->add_responsive_control(
			'arrow_prev_x_select',
			[
				'label' => esc_html__( 'Prev Position X', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'left' => esc_html__( 'Left', 'rsaddon' ),
					'right' => esc_html__( 'Right', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_left_position',
			[
				'label' => esc_html__( 'Prev Left Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'left',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_right_position',
			[
				'label' => esc_html__( 'Prev Right Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'right',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);

		$this->add_responsive_control(
			'arrow_prev_y_select',
			[
				'label' => esc_html__( 'Prev Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'top' => esc_html__( 'Top', 'rsaddon' ),
					'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_top_position',
			[
				'label' => esc_html__( 'Prev Top Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'top',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_bottom_position',
			[
				'label' => esc_html__( 'Prev Bottom Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'bottom',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);

		$this->add_responsive_control(
			'arrow_next_x_select',
			[
				'label' => esc_html__( 'Next Position X', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'left' => esc_html__( 'Left', 'rsaddon' ),
					'right' => esc_html__( 'Right', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_left_position',
			[
				'label' => esc_html__( 'Next Left Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'left',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_next_right_position',
			[
				'label' => esc_html__( 'Next Right Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'right',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
		
		$this->add_responsive_control(
			'arrow_next_y_select',
			[
				'label' => esc_html__( 'Next Position Y', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'top' => esc_html__( 'Top', 'rsaddon' ),
					'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
				],
				'condition' => [
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_top_position',
			[
				'label' => esc_html__( 'Next Top Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'top',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
		$this->add_responsive_control(
			'arrow_next_bottom_position',
			[
				'label' => esc_html__( 'Next Bottom Position', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
					'{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'bottom',
					'arrow_position_maker' => 'custom',
                    'testimonial_style!'=>'style2',
		        ]
			]
		);
        $this->add_responsive_control(
            'arrow_top_bottom_style_two',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
                ],
                'condition'=>[
                    'testimonial_style'=>'style2',
                ]
            ]
        );
        $this->add_responsive_control(
            'arrow_left_right_style_two',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
                ],
                'condition'=>[
                    'testimonial_style'=>'style2',
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
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

          $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => esc_html__( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide.slick-center:before, {{WRAPPER}} .rs-testimonial .testimonial-item',
                
            ]
        ); 

        $this->add_control(
            'hover_background_testimonial',
            [
                'label' => esc_html__( 'Testimonial Hover BG', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_hoverbackgrounds',
                'label' => esc_html__( 'Hover Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item:hover',
                
            ]
        ); 

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item',
            ]
        );    

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial-dots-style2 .slick-slide.slick-center:before, {{WRAPPER}} .rs-testimonial .testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_boxes_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-items .testimonial-item',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_style_arrow',
            [
                'label' => esc_html__( 'Slider Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'testimonial_style!'=>'style2',
                ]
            ]
        );
        $this->add_control(
            'arrow_optionsd',
            [
                'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-next' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',
                ],                
            ]
        );

         $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__( 'Bullet Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );
        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],         
            ]
        );
        $this->add_control(
            'navigation_dot_icon_dotbackground',
            [
                'label' => esc_html__( 'Normal Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'background: {{VALUE}};',

                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],               
            ]
        );

        $this->add_control(
            'testi_dots_hover_color',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Dots Hover Color', 'prelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'navigation_dot_icon_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover,{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button',
                'condition'=>[
                    'slider_dots'=>'true',
                ],
			]
		);
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

                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom:-{{SIZE}}{{UNIT}};',                    
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );
       
        $this->add_responsive_control(
            'bullet_spacing_bottom_custom',
            [
                'label' => esc_html__( 'Bullet margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nav_bullet_alignment',
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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'text-align: {{VALUE}}'
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ]
            ]
        );
        $this->add_responsive_control(
            'bullet_horizontal_align',
            [
                'label' => esc_html__( 'Bullet Style (Inline / Block)', 'rsaddon' ),
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
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'bullet_vertical_align',
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
                'condition' => [
                    'bullet_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'vullet_h_align',
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
                    'bullet_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bullet_custome_width',
            [
                'label' => esc_html__( 'Normal Bullet Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',                    
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );
        $this->add_control(
            'bullet_normalcustome_width',
            [
                'label' => esc_html__( 'Active/Hover Bullet Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'width: {{SIZE}}{{UNIT}};',                    
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',                    
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );
        $this->add_control(
            'bullet_custome_height',
            [
                'label' => esc_html__( 'Normal Bullet Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',                    
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );
        $this->add_control(
            'bullet_active_height',
            [
                'label' => esc_html__( 'Active Bullet Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',                    
                ],
                'condition'=>[
                    'slider_dots'=>'true',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet__top_bottom_position',
            [
                'label' => esc_html__( 'Bullet Bottom/Top Position', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet__left_right_position',
            [
                'label' => esc_html__( 'Bullet Left/Right Position', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
  

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
        $testimonial_style = $settings['testimonial_style'];
        $slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $service_title          = $settings['service_title'];

        if ( is_rtl() ):
           $rtl= 'true';
        else:
           $rtl= 'false';
        endif;
        
        $unique = rand(2012,35120);

        if(!empty($settings['testimonial_word_show'])){
            $limit = $settings['testimonial_word_show'];
        }
        else{
            $limit = 100;
        }

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');   

        ?>  
            <div class="rsaddon-unique-slider rs-testimonial-grid rs-testimonial2 rs-testimonial rs_nav_dost">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider">
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

                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';

                            $cats_show = get_the_term_list( $best_wp->ID, 'testimonial-category', ' ', '<span class="separator">,</span> ');

                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }

                            if( $testimonial_style == 'style1' ) {
                        ?>                           
                          
                        <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
                            <div class="testimonial-item">                               
                                <div class="testimonial-contents">
                                    <div class="testimonial-top-content">
                                        <div class="testimonial-left-content"> 
                                            <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>                                   
                                                <div class="image-wrap">  
                                                                               
                                                    <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                                </div>  
                                                <?php endif;?> 
                                                <div class="testimonial-info">  
                                                    <?php if(get_the_title()):?>                         
                                                    <span class="testimonial-name"><?php the_title();?></span>
                                                    <?php endif;?>
                                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                        <span class="ratings">
                                                            
                                                            <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                                        </span>
                                                    <?php endif;?> 
                                                </div>
                                            </div>
                                            <?php if(!empty($settings['selected_image']['url'])) :?>
                                                <div class="quote-icon"><img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/></div>
                                            <?php endif; ?>
                                            <?php if(!empty($settings['quote_icon'])) : ?>
                                            <span class="quote-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                        <?php endif; ?>
                                            
                                            
                                    </div>
                                    <div class="item-contents">
                                        <p>
                                        <?php
                                        echo wp_trim_words( get_the_content(), $limit, '...' ); 
                                        ?> 
                                        </p>
                                    </div> 
                                    <?php if('yes'=== $settings['show_service__title']){?>
                                        <div class="testimonial-informations">
                                            <h3><?php echo esc_html($service_title);?></h3>                                          
                                            <?php if( $designation ):?>
                                                <span class="testimonial-cat"><?php echo $cats_show;?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php }?>                            
                                </div>               
                            </div>
                        </div>
                        <?php } elseif( $testimonial_style == 'style2' ) { ?>
                        <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
                            <div class="testimonial-item">                               
                                <div class="testimonial-contents">    

                                    <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                        <div class="image-wrap">                                    
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>      
                                        </div>
                                    <?php endif;?>

                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                        <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                    <?php endif;?>

                                    <div class="item-contents">
                                        <?php if(!empty($settings['quote_icon'])) : ?>
                                            <span><?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty($settings['selected_image']['url'])) :?>
                                            <span><img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/></span>
                                        <?php endif; ?>
                                           
                                          <p><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                                           
                                       <?php ?> 
                                    </div>

                                    <div class="testimonial-informations">                                          
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
                        <?php } elseif( $testimonial_style == 'style4' ) { ?>
                            <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> testimonial-style4 color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
                            <div class="testimonial-item">                               
                                <div class="testimonial-contents">
                                    <div class="item-contents">
                                        <div class="testimonial-quote-rating">
                                            <?php if(!empty($settings['quote_icon'])) : ?>
                                                <span><?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                            <?php endif; ?>
                                            <?php if(!empty($settings['selected_image']['url'])) :?>
                                                <span><img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/></span>
                                            <?php endif; ?>
                                            <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                <div class="ratings">
                                                    <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                                </div>
                                            <?php endif;?> 
                                        </div>

                                        <?php if(!empty($settings['desc_word_limit'])) { ?>
                                            <p><?php echo wp_trim_words( get_the_content(), $settings['desc_word_limit'], '' ); ?></p>
                                        <?php } else { ?>
                                            <p>
                                            <?php
                                        echo wp_trim_words( get_the_content(), $limit, '...' ); 
                                          //  the_content();
                                        ?> 
                                        </p>
                                        <?php } ?>
                                    </div> 

                                    

                                    <div class="testimonial-informations"> 
                                        <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                            <div class="image-wrap">                                    
                                                <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>    
                                            </div>
                                        <?php endif;?>  
                                        <div class="testimonial-name-desc">                                        
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
                        <?php }elseif($testimonial_style == 'style5'){?>
                            <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> testimonial-style5 color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
                            <div class="testimonial-item">                               
                                <div class="testimonial-contents">
                                    <div class="item-contents">
                                        <?php if(!empty($settings['quote_icon'])) { ?>
                                            <span class="icon-service-title">
                                                
                                                    <?php if( !empty($settings['quote_img__']['url']) &&   $settings['show_quote_img'] == 'yes'  ) {?>
                                                        <div class="watermark-quote">
                                                            <img src="<?php echo esc_url( $settings['quote_img__']['url'] );?>" alt="image"/>
                                                        </div>
                                                    <?php }?>
                                                    <?php if('yes'=== $settings['show_service__title'] ){?>
                                                        <span><?php echo esc_html($service_title);?></span> 
                                                    <?php }?>
                                                <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                        <?php } ?>
                                        <?php if(!empty($settings['selected_image']['url']) ) {?>
                                            <span class="icon-service-title">
                                                
                                                    <?php if( !empty($settings['quote_img__']['url']) && $settings[ 'show_quote_img'] =='yes'  ){?>
                                                        <div class="watermark-quote">
                                                            <img src="<?php echo esc_url( $settings['quote_img__']['url'] );?>" alt="image"/>
                                                        </div>
                                                    <?php }?>
                                                    <?php if( 'yes'=== $settings['show_service__title']){?>
                                                        <span><?php echo esc_html($service_title);?></span> 
                                                    <?php }?>
                                                <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
                                            </span>
                                        <?php } ?>

                                        <?php if(!empty($settings['desc_word_limit'])) { ?>
                                            <p><?php echo wp_trim_words( get_the_content(), $settings['desc_word_limit'], '' ); ?></p>
                                        <?php } else { ?>
                                            <p> <?php echo wp_trim_words( get_the_content(), $limit, '...' );?> </p>
                                        <?php } ?>
                                    </div> 

                                    <?php if( 'yes' == $settings['show_ratings']  && $ratings != ''): ?>
                                        <div class="ratings">
                                            <img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" />
                                        </div>
                                    <?php endif;?> 

                                    <div class="testimonial-informations"> 
                                        <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                            <div class="image-wrap">                                    
                                                <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>      
                                            </div>
                                        <?php endif;?>  
                                        <div class="testimonial-name-desc">                                        
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

                        <?php } else { ?>
                        
                        <div class="testimonial-items <?php echo esc_attr( $settings['align'] );?> testimonial-style3 color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
                            <div class="testimonial-item">                               
                                <div class="testimonial-contents">
                                    <div class="item-contents">
                                        <?php if(!empty($settings['quote_icon'])) { ?>
                                            <span>
                                                <?php \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </span>
                                        <?php } ?>
                                        <?php if(!empty($settings['selected_image']['url'])) {?>
                                            <span>
                                                <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
                                            </span>
                                        <?php } ?>

                                        <?php if(!empty($settings['desc_word_limit'])) { ?>
                                            <p><?php echo wp_trim_words( get_the_content(), $settings['desc_word_limit'], '' ); ?></p>
                                        <?php } else { ?>
                                            <p> <?php echo wp_trim_words( get_the_content(), $limit, '...' );?> </p>
                                        <?php } ?>
                                    </div> 

                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                        <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" alt="ratings" /></div>
                                    <?php endif;?> 

                                    <div class="testimonial-informations"> 
                                        <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                            <div class="image-wrap">                                    
                                                <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>     
                                            </div>
                                        <?php endif;?>  
                                        <div class="testimonial-name-desc">                                        
                                            <?php if(get_the_title()):?>                         
                                                <div class="testimonial-name"><?php the_title();?></div>
                                            <?php endif;?>
                                            <?php if( $designation ):?>
                                                <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <?php if( $settings['show_quote_img'] == 'yes' && $ratings != '' && !empty($settings['quote_img__']['url'])): ?>
                                        <div class="second-quote">
                                            <img src="<?php echo esc_url( $settings['quote_img__']['url'] );?>" alt="image"/>
                                        </div>
                                    <?php endif;?>
                                </div>               
                            </div>
                        </div>
                        <?php  
                        } 
                        endwhile;
                        wp_reset_query(); 

                     ?>  
                </div>
                
                <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>

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
                    prevArrow:"<button type='button' class='slick-prev pull-left'><i class='ri-arrow-left-line'></i></button>",
                    nextArrow:"<button type='button' class='slick-next pull-right'><i class='ri-arrow-right-line'></i></button>",
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
            <?php if ( "style2" == $settings['testimonial_style'] ) { ?>
                <script>
                    jQuery(document).ready(function(){
                        jQuery(
                            '.rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .slick-prev, .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .slick-next').wrapAll('<div class="custom-nav"></div>'
                        );
                        jQuery(
                            '.rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .slick-prev').html('<svg width="13" height="14" viewBox="0 0 13 14" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 7.8125H13V6.1875H6.5V0.5L0 7L6.5 13.5V7.8125Z" fill="white"/></svg> Prev'
                        );
                        jQuery(
                            '.rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .slick-next').html('Next <svg width="13" height="14" viewBox="0 0 13 14" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 7.8125H0V6.1875H6.5V0.5L13 7L6.5 13.5V7.8125Z" fill="#fff"/></svg>'
                        );
                    });
                </script>
            <?php } ?>
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