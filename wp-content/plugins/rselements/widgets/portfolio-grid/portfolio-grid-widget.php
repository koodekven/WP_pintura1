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
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Portfolio_pro_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rsportfolio';
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
		return __( 'RS Portfolio Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-grid';
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
			'portfolio_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',			
					'2' => 'Style 2',					
				],											
			]
		);
		$this->add_control(
			'portfolio_category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',		
			]

		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Project Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);
		$this->add_control(
            'blog_pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );
		$this->add_control(
            'pre_posts_sort',
            [
                'label'   => esc_html__( 'Post Order', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'rsaddon' ),
                    'DESC' => esc_html__( 'DESC', 'rsaddon' ),
                ],
                'default' => 'DESC',
            ]
        );
		$this->add_control(
			'categorie_position',
			[
				'label'   => esc_html__( 'Categorie Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',	
				'condition' => [
                	'portfolio_grid_style' => ['6']
                ],
                'separator' => 'before',
				'options' => [
					'top' => 'Top',
					'bottom' => 'Bottom',
				],
			]
		);
		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => '4',			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);
		$this->add_control(
			'portfolio_md_columns',
			[
				'label'   => esc_html__( 'Medium Device Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
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
			'portfolio_link_icon',
			[
				'label'   => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => 'Icon',
					'style2' => 'Image',				
				],
				'condition'=>[
					'icon_image_show_hide'=> 'yes'
				]										
			]
		);
		$this->add_control(
		    'selected_icon',
		    [
		        'label' => __( 'Icon', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => 'fas fa-plus',
		            'library' => 'reguler',
		        ],
		        'condition' => [
		            'portfolio_grid_style' => ['2', '1', '7','9'],
		            'portfolio_link_icon' => ['style1'],
		        ],
		    ]
		);
		$this->add_control(
			'selected_icon_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				'separator' => 'before',
				'condition' => [
				    'portfolio_link_icon' => ['style2'],
				]
			]
		);
		$this->add_responsive_control(
		    'selected_icon_image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a img, {{WRAPPER}} .rs-portfolio-style2 .portfolio-content a img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		        'condition' => [
		            'portfolio_link_icon' => ['style2'],
		        ]
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
		$this->add_responsive_control(
		    'show_icon_button',
		    [
		        'label' => esc_html__( 'Show Button', 'rsaddon' ),
		        'type' => \Elementor\Controls_Manager::SWITCHER,
		        'label_on' => esc_html__( 'Show', 'rsaddon' ),
		        'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        'return_value' => 'yes',
		        'default' => 'yes',
		        'separator' => 'before',
		        'condition' => [
		        	'portfolio_grid_style' => '8',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'show_button',
		    [
		        'label' => esc_html__( 'Show Button', 'rsaddon' ),
		        'type' => \Elementor\Controls_Manager::SWITCHER,
		        'label_on' => esc_html__( 'Show', 'rsaddon' ),
		        'label_off' => esc_html__( 'Hide', 'rsaddon' ),
		        'return_value' => 'yes',
		        'default' => 'no',
		        'separator' => 'before',
		        'condition' => [
		        	'portfolio_grid_style' => ['1']
		        ],
		    ]
		);
		$this->add_control(
			'read_more_text',
			[
				'label'       => esc_html__( 'Button Text', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'View More',
				'placeholder' => esc_html__( 'View More', 'rsaddon' ),
				'condition' => [
					'show_button' => 'yes',
				],	
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'brand_logo_img',
			[
				'label' => esc_html__( 'Logo Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				'separator' => 'before',
				'condition' => [
				    'portfolio_grid_style' => '9',
				]
			]
		);
        $this->add_responsive_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],			

				'selectors' => [
                    '{{WRAPPER}} .portfolio-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		); 
        $this->add_control(
			'gap_conditon',
			[
				'label' => esc_html__( 'left Right Gap', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					''   => 'Yes',
					'no-gutters' => 'No'				
				],	
				'default' => '',
			]
		); 

		$this->add_responsive_control(
            'background_border_radius',
            [
                'label' => esc_html__( 'Background & Image Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item .portfolio-img img, {{WRAPPER}} .portfolio-item  img,  {{WRAPPER}} .rs-portfolio-style8 .portfolio-item .portfolio-content, {{WRAPPER}} .portfolio-item, {{WRAPPER}} .portfolio-item .portfolio-content:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );
		$this->add_control(
			'show_logo_',
			[
				'label' => esc_html__( 'Show Logo', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'condition' => [
		        	'portfolio_grid_style' => '4',
		        ],
			]
		);

		$this->add_control(
			'brand_logo_text',
			[
				'label'       => esc_html__( 'Brand Text', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Roofio',
				'condition' => [
					'portfolio_grid_style' => '9',
				],	
				'separator'   => 'before',
			]
		);
				
		$this->end_controls_section();

		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a' => 'color: {{VALUE}} !important;',                   

                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a:hover' => 'color: {{VALUE}} !important;',                    
                ],                
            ]
        );
        $this->add_control(
		    'title_bg',
		    [
		        'label' => esc_html__( 'Title Bg Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'background: {{VALUE}};',                   

		        ],                
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .p-title, {{WRAPPER}} .portfolio-item .portfolio-details .p-title a',               
			]
		);
	    $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Title Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
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
                    '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'title_border_radius',
		    [
		        'label' => esc_html__( 'Title Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
       
		$this->add_control(
		    'category_color',
		    [
		        'label' => esc_html__( 'Category Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .p-category a, {{WRAPPER}} .p-category' => 'color: {{VALUE}} !important;',                   

		        ],                
		    ]
		);
		$this->add_control(
		    'category_bg_color',
		    [
		        'label' => esc_html__( 'Category Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .p-category a' => 'background: {{VALUE}};',                   

		        ],                
		    ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Category Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .p-category a, {{WRAPPER}} .p-title > .p-category > a',                    
			]
		);
        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a:hover' => 'color: {{VALUE}} !important;',                    
                ],                
            ]
            
        ); 
        $this->add_responsive_control(
		    'cat_margin',
		    [
		        'label' => esc_html__( 'Category Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category, {{WRAPPER}} .p-title .p-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'cat_padding',
		    [
		        'label' => esc_html__( 'Category Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'cat_border_radius',
		    [
		        'label' => esc_html__( 'Category Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-details .p-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_control(
            'read_more',
            [
                'label' => esc_html__( 'Read More Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item a' => 'color: {{VALUE}};',                    
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item a' => 'color: {{VALUE}};',                    
                ],             
            ]
            
        );
        $this->add_control(
            'read_more_hover_color',
            [
                'label' => esc_html__( 'Read More Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item a:hover' => 'color: {{VALUE}};',                    
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );
        $this->add_control(
            'content_bg',
            [
                'label' => esc_html__( 'Content Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content .portfolio-inner, {{WRAPPER}} .portfolio-details' => 'background: {{VALUE}};',                    
                ],
                'condition' => [
				    'portfolio_grid_style' => ['3', '1','9'],
				]              
            ]            
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style8 .portfolio-item .p-icon a, {{WRAPPER}} .rs-portfolio-style3 .portfolio-item .p-icon i, {{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img a, 
                    {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon a, 
                    {{WRAPPER}} .rs-portfolio-style7 .content-overlay a.link7, 
                    {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon a,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-details .portfolio-icon i' => 'color: {{VALUE}};',                    
                ],
                'condition' => [
				    'portfolio_grid_style' => [ '1'],
				    'show_button' => 'yes',
				],         
            ]            
        );
		$this->add_control(
            'border_icon_color',
            [
                'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-details .portfolio-icon' => 'border-color: {{VALUE}};',                    
                ],
				'condition' => [
					'portfolio_grid_style' => '9',
					'show_button' => 'yes',
				]               
            ]            
        );  
        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style8 .portfolio-item .p-icon a, {{WRAPPER}} .rs-portfolio-style3 .portfolio-item .p-icon, {{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a, {{WRAPPER}} .rs-portfolio-style7 .content-overlay a.link7, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img a,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-details .portfolio-icon' => 'background: {{VALUE}};',                    
                ],
                'condition' => [
				    'portfolio_grid_style' => [ '1'],
				    'show_button' => 'yes',
				],            
            ]            
        );
		$this->add_control(
            'icon_hover_bg_color',
            [
                'label' => esc_html__( 'Icon Hover Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-details .portfolio-icon:hover' => 'background: {{VALUE}};',                    
                ], 
				'condition' => ['portfolio_grid_style' => '9']             
            ]            
        );
		$this->add_control(
            'hover_icon_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-details .portfolio-icon:hover i' => 'color: {{VALUE}};',                    
                ],
				'condition' => ['portfolio_grid_style' => '9']               
            ]            
        );  

		$this->add_responsive_control(
            'p_icon_border_radius',
            [
                'label' => esc_html__( 'Icon Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',           
                ],
                'condition' => [
				    'portfolio_grid_style' => [ '1'],
				    'show_button' => 'yes',
				],             
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img a, {{WRAPPER}} .rs-portfolio-style7 .content-overlay a.link7, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img a',
				'condition' => [
				    'portfolio_grid_style' => [ '1'],
				    'show_button' => 'yes',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item, {{WRAPPER}} .portfolio-content:before, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before, {{WRAPPER}} .portfolio-content:before, {{WRAPPER}} .rs-portfolio-style7 .content-overlay:before,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item',

            ]
        );

        $this->add_control(
			'overlay_heading',
			[
				'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item:hover .portfolio-img:before, {{WRAPPER}} .rs-portfolio-style8 .portfolio-item .portfolio-content, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before, {{WRAPPER}} .portfolio-content:before, {{WRAPPER}} .rs-portfolio-style7 .content-overlay:before, {{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-content:before,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item:hover .portfolio-img:before,{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img:before',

            ]
        ); 

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Content Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

        $this->add_responsive_control(
		    'item_padding_area',
		    [
		        'label' => esc_html__( 'Content Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style1 .portfolio-details, {{WRAPPER}} .portfolio-item .portfolio-content,{{WRAPPER}} .rs-portfolio-style9 .portfolio-details, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'content_align',
		    [
		        'label' => esc_html__( 'Content Alignment', 'rsaddon' ),
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
		        'condition' => [
		        	'portfolio_grid_style' => '8',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-content' => 'text-align: {{VALUE}}',
		        ],
		    ]
		);



		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'selector' => '{{WRAPPER}} .portfolio-item .portfolio-details, {{WRAPPER}} .portfolio-item .portfolio-content',
		        'condition' => [
		        	'portfolio_grid_style' => ['8', '1'],
		        ],
		    ]
		);
        $this->end_controls_section();

        // Start Portfolio Pagination Style
		$this->start_controls_section(
		    '_blog_pagination_style',
		    [
		        'label' => esc_html__( 'Pagination Style', 'prelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);
		$this->add_control(
            'pagination_color',
            [
                'label' => esc_html__( 'Pagination Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links .page-numbers' => 'color: {{VALUE}};',                    
                ], 
                        
            ]            
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_pagiesc_html__bg_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pagination-area .nav-links .page-numbers',
            ]
        );

        
        $this->add_control(
            'pagination_color_active',
            [
                'label' => esc_html__( 'Pagination Current Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links span.current' => 'color: {{VALUE}};',                    
                ], 
                        
            ]            
        );
        $this->add_control(
            'pagination_icon_active_color',
            [
                'label' => esc_html__( 'Pagination Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links a.next.page-numbers, {{WRAPPER}} .pagination-area .nav-links a.prev.page-numbers' => 'color: {{VALUE}};',                    
                ], 
                             
            ]            
        );
        $this->add_control(
            'pagination_bg_color_active',
            [
                'label' => esc_html__( 'Pagination Active Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links span.current' => 'background: {{VALUE}};',                    
                ], 
                             
            ]            
        );
        $this->add_responsive_control(
		    'pagination_content_align',
		    [
		        'label' => esc_html__( 'Pagination Content Alignment', 'rsaddon' ),
		        'type' => Controls_Manager::CHOOSE,
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
		            '{{WRAPPER}} .pagination-area .nav-links' => 'justify-content: {{VALUE}}',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => esc_html__( 'Area Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_button margin',
            [
                'label' => esc_html__( 'Button Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'pagination_b_r',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pagination-area .nav-links .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border__',
                'selector' => '{{WRAPPER}} .pagination-area .nav-links .page-numbers',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_icon_font_type',
                'selector' => '{{WRAPPER}} .pagination-area .nav-links span.current.next.page-numbers:before, {{WRAPPER}} .pagination-area .nav-links span.current.prev.page-numbers:before, {{WRAPPER}} .pagination-area .nav-links a.next.page-numbers:before, {{WRAPPER}} .pagination-area .nav-links a.prev.page-numbers:before',  
            ]
        );

        $this->add_control(
			'active_prev_next_border',
			[
				'label' => esc_html__( 'Active & Current Border', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border__active_border',
                'selector' => '{{WRAPPER}} .pagination-area .nav-links .page-numbers.current',
            ]
        );
		$this->end_controls_section();

		// End Portfolio Pagination Style

		//Popup Style Setting
		$this->start_controls_section(
			'section_portfolio_grid_style',
			[
				'label' => esc_html__( 'Popup Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'popup_port_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );


        $this->add_control(
            'popup_port_content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );	

        $this->add_control(
            'popup_port_info_color',
            [
                'label' => esc_html__( 'Project Information Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );		

        $this->add_control(
            'popup_port_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
            
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'logo_image',
			[
				'label' => esc_html__( 'Logo Image Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
                	'portfolio_grid_style' => ['9']
                ],
			]
		);
		$this->add_control(
            'background_logo',
            [
                'label' => esc_html__( 'Logo Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img span' => 'background-color: {{VALUE}} !important;',                   

                ],                
            ]
        );
		$this->add_responsive_control(
            'logo_border_radius',
            [
                'label' => esc_html__( 'Logo Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );
		$this->add_responsive_control(
		    'Logo_width_img',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img span' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->add_responsive_control(
		    'Logo_width_height',
		    [
		        'label' => esc_html__( 'Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-style9 .portfolio-item .portfolio-img span' => 'Height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);
		$this->end_controls_section();

		$this->start_controls_section(
		    '_icon_image_style',
		    [
		        'label' => esc_html__( 'Icon/Image Style', 'prelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'icon_image_show_hide'=> 'yes'
				]	
		    ]
		);

		$this->add_control(
		    'title_icon_bg',
		    [
		        'label' => esc_html__( 'Icon Bg Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons' => 'background: {{VALUE}}!important;',                  
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons' => 'background: {{VALUE}}!important;',                  

		        ],                
		    ]
		);
		$this->add_control(
		    'title_icon_coloor',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons svg path' => 'fill: {{VALUE}};',                  
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons svg path ' => 'fill: {{VALUE}};',                  
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons i ' => 'color: {{VALUE}};', 
					'{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons svg path ' => 'fill: {{VALUE}}!important;',                  

		        ],                
		    ]
		);
		$this->add_control(
		    'title_icon_bg_hover',
		    [
		        'label' => esc_html__( 'Icon Bg Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons:hover' => 'background: {{VALUE}};',                   
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons:hover' => 'background: {{VALUE}}!important;',                   

		        ],                
		    ]
		);
		$this->add_control(
		    'title_icon_hover_coloor',
		    [
		        'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'separator' => 'before',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons:hover svg path' => 'fill: {{VALUE}};',                  
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons:hover svg path' => 'fill: {{VALUE}} !important;',                  
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons:hover i' => 'color: {{VALUE}};',                  

		        ],                
		    ]
		);
		$this->add_responsive_control(
		    'title__icon_space',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-item .portfolio-details .p-title a .title-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
		            '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
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

	$popup_port_title_color = !empty( $settings['popup_port_title_color']) ? 'style="color: '.$settings['popup_port_title_color'].'"' : '';
	$popup_port_content_color = !empty( $settings['popup_port_content_color']) ? 'style="color: '.$settings['popup_port_content_color'].'"' : '';
	$popup_port_info_color = !empty( $settings['popup_port_info_color']) ? 'style="color: '.$settings['popup_port_info_color'].'"' : '';
	$popup_port_background = !empty( $settings['popup_port_background']) ? 'style="background: '.$settings['popup_port_background'].'"' : '';

	

	?>
		<div class="rs-portfolio-style<?php echo esc_attr($settings['portfolio_grid_style']); ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?> rsaddon_pro_box">
			<div class="row <?php echo esc_html($settings['gap_conditon']);?>">

			    <?php 			

					if('1' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}
					elseif('2' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}
					
				?>
			</div>
		</div>
	
	<?php	

	}
	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'portfolios' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'portfolio-category',
             	'hide_empty'  => true            
         	) );  
         	
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}?>