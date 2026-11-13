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

class Rsaddon_Portfolio_Isotope_Filter_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$dir = plugin_dir_url(__FILE__);
		
		wp_register_script( 'portfolio-isotope-script-pkgd', $dir.'isotope.pkgd.min.js', [ 'elementor-frontend' ], time(), true );
		wp_register_script( 'portfolio-isotope-script', $dir.'portfolio-isotope.js', [ 'elementor-frontend' ], time(), true );
		
	}
  
	
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
		return 'rsportfolio-isotope-filter-widget';
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
		return __( 'RS Isotope Filter', 'rsaddon' );
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
		return 'glyph-icon flaticon-spreadsheet';
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
	public function get_style_depends() {
		return [ 'rselements-portfolio-isotope-filter' ];
	}
	public function get_script_depends() {
		return [ 'portfolio-isotope-script-pkgd','portfolio-isotope-script' ];
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
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon')				
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
			'show_filter',
			[
				'label'   => esc_html__( 'Show Filter', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_show',	
                'separator' => 'before',
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',
				],
			]
		);
		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Filter Default Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
				'separator' => 'before',
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
					'1' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
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
		$this->add_responsive_control(
			'item_spacing_',
			[
				'label' => esc_html__( 'Item Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'filter_bottom_spacing',
			[
				'label' => esc_html__( 'Filter Bottom Gap', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-isotope-portfolio .filters ul' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		); 
		
		$this->add_responsive_control(
			'item_height',
			[
				'label'      => esc_html__( 'Item Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-isotope-portfolio .portfolio-item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
				
		$this->end_controls_section();

		$this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Menu Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_filter' => 'filter_show',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
			]
		);
		
		
        $this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'nav_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

		$this->add_control(
            'menu_color',
            [
                'label' => esc_html__( 'Menu Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .filters ul li' => 'color: {{VALUE}};',                   
                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-isotope-portfolio .filters ul li',

            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'nav_hover_tab',
            [
                'label' => esc_html__( 'Acive', 'rsaddon' ),
            ]
        );

		$this->add_control(
            'menu_active_color',
            [
                'label' => esc_html__( 'Menu Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                	'{{WRAPPER}} .rs-isotope-portfolio .filters ul li.is-checked,{{WRAPPER}} .rs-isotope-portfolio .filters ul li:hover' => 'color: {{VALUE}};',                
                ],                
            ]
        );

		

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_active_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-isotope-portfolio .filters ul li.is-checked,{{WRAPPER}} .rs-isotope-portfolio .filters ul li:hover',

            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();


        $this->add_responsive_control(
		    'menu_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-isotope-portfolio .filters ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'menu_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-isotope-portfolio .filters ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-isotope-portfolio .filters ul li',                    
			]
		);

		$this->add_responsive_control(
		    'menu_filter_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-isotope-portfolio .filters ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
            'align_filter',
            [
                'label' => esc_html__( 'Alignment Filter Menu', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-isotope-portfolio .filters ul' => 'justify-content: {{VALUE}}'
                ],
				'separator' => 'before',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
            ]
        );

		$this->add_responsive_control(
		    'tab_menu_filter_margin',
		    [
		        'label' => esc_html__( 'Item Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-isotope-portfolio .filters ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Content Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-title a, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-title a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-title a:hover, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-title a:hover' => 'color: {{VALUE}};',                    
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
		            '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-title, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-title a, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-title a',                    
			]
		);
		 $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Category Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-category a, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-category a',
			]
		);
        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-category a, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-category a' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .grid .grid-item .portfolio-item .portfolio-content .p-category a:hover, {{WRAPPER}} .rs-isotope-portfolio .portfolio-item .portfolio-content .p-category a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );
		
        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .portfolio-item::before' => 'background: {{VALUE}};',

                ],                
            ]
        );

		$this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Button Bg Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .portfolio-content .arrow-btn' => 'background: {{VALUE}};',                    
                ],              
            ] 
        ); 

		$this->add_control(
            'button_icon_color',
            [
                'label' => esc_html__( 'Button Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .portfolio-content .arrow-btn i' => 'color: {{VALUE}};',                    
                ],              
            ] 
        );

		$this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__( 'Button Bg Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .portfolio-content .arrow-btn:hover' => 'background: {{VALUE}};',                    
                ],              
            ] 
        ); 

		$this->add_control(
            'button_icon_color_hover',
            [
                'label' => esc_html__( 'Button Icon Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-isotope-portfolio .portfolio-content .arrow-btn:hover i' => 'color: {{VALUE}};',                    
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

	$taxonomy ="";

	?>
	<div class="rs-isotope-portfolio color_<?php echo esc_html($settings['choose_color_scheme']); ?>">
			<div class="row">
				<div class="col-md-12">
					<div class="filters">
						<ul>
						<li class="is-checked" data-filter="*"><?php echo esc_html($settings['filter_title']);?></li>
						<?php $taxonomy = "portfolio-category";
							$select_cat = $settings['portfolio_category'];
							if(is_array($select_cat) || is_object($select_cat) ) {
								foreach ($select_cat as $catid) {
								
								$term = get_term_by('slug', $catid, $taxonomy);
								$term_name  =  $term->name;
								$term_slug  =  $term->slug;
						?>
						<li data-filter=".<?php echo esc_html($term_slug);?>"><?php echo esc_html($term_name);?></li>
						<?php  } } ?>
						</ul>
					</div>
				</div>
				<div class="col-md-12">
					<div class="rows gridsd data-isotope='{ "itemSelector": ".grid-item", "masonry": { "columnWidth": 200 } }'">
							<?php 
							include plugin_dir_path(__FILE__)."/portfolio-item.php";
						?>
					</div>
				</div>	
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

	
}