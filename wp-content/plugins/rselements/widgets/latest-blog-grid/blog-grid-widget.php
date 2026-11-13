<?php
/**
 * Latest Blog Grid.
 *
 * Prelements Elementor widget that load blog post into grid style.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_latest_Blog_Grid_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve prelements Blog Grid widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'prelements_blog';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve Prelements Blog Grid widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Latest Blog Grid', 'prelements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog Grid widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-blogging';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Blog Grid widget belongs to.
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
	 * Register Blog Grid widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$category_dropdown[0] = 'Select Category';		
		$terms  = get_terms( array( 'taxonomy' => "category", 'fields' => 'id=>name' ) );		
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

	    $post_dropdown[0] = 'Select Post';
        $prelements_query = new wp_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => '-1',                                          
        )); 

        if ( $prelements_query->have_posts() ):
            while($prelements_query->have_posts()): $prelements_query->the_post();       
                $id    = get_the_ID($prelements_query->ID);
                $title = get_the_title($prelements_query->ID);
                $post_dropdown[$id] = $title;
            endwhile;
            wp_reset_query(); 
        endif;    

	   
        //Default Settings Here
		$this->start_controls_section(
			'_section_settings',
			[
				'label' => esc_html__( 'Default Settings', 'prelements' ),
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
	            'blog_content_postion_style',
	            [
	                'label' => esc_html__( 'Blog Layout', 'prelements' ),
	                'type' => Controls_Manager::SELECT,
	                'default' => 'default',
	                'options' => [
	                    'default' => esc_html__( 'Default', 'prelements' ),
                        'style_two' => esc_html__( 'Style 2', 'prelements' ),
	                    'transparent' => esc_html__( 'Style 3', 'prelements' ),
	                    'style_4' => esc_html__( 'Style 4', 'prelements' ),
	                    'style_5' => esc_html__( 'Style 5', 'prelements' ),
	                ],                
	            ]
	        );

	        $this->add_control(
	            'pre_blog_posts_is_manual_selection',
	            [
	                'label' => esc_html__( 'Select posts by:', 'prelements' ),
	                'type' => Controls_Manager::SELECT,
	                'default' => '',
	                'options' => [
	                    'recent'    => esc_html__( 'Recent Post', 'prelements' ),
	                    'yes'       => esc_html__( 'Selected Post', 'prelements' ),
	                    ''        => esc_html__( 'Category Post', 'prelements' ),
	                ],
	            ]
	        ); 

                

        $this->add_control(
            'category',
            [
                'label'   => esc_html__( 'Category', 'prelements' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,                 
                'options' => $this->getCategories(),
                'multiple' => true, 
                'condition' => [ 'pre_blog_posts_is_manual_selection' => '' ],      
            ]
        );

        $this->add_control(
            'select_posts',
            [
                'label'   => esc_html__( 'Select Posts', 'prelements' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,         
                'options' => [      
                        
                ]+ $post_dropdown,
                'multiple' => true, 
                'condition' => [ 'pre_blog_posts_is_manual_selection' => 'yes' ],      
            ]
        );

        $this->add_control(
            'pre_posts_order_by',
            [
                'label'   => esc_html__( 'Order by', 'prelements' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'date'          => esc_html__( 'Date', 'prelements' ),
                    'title'         => esc_html__( 'Title', 'prelements' ),
                    'author'        => esc_html__( 'Author', 'prelements' ),
                    'modified'      => esc_html__( 'Modified', 'prelements' ),
                    'comment_count' => esc_html__( 'Comments', 'prelements' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'pre_posts_sort',
            [
                'label'   => esc_html__( 'Order', 'prelements' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'prelements' ),
                    'DESC' => esc_html__( 'DESC', 'prelements' ),
                ],
                'default' => 'DESC',
            ]
        );

	
		$this->add_control(
			'blog_columns',
			[
				'label'   => esc_html__( 'Columns', 'prelements' ),
				'type'    => Controls_Manager::SELECT,	
                'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'prelements' ),
					'4' => esc_html__( '3 Column', 'prelements' ),
					'3' => esc_html__( '4 Column', 'prelements' ),
					'2' => esc_html__( '6 Column', 'prelements' ),
					'12' => esc_html__( '1 Column', 'prelements' ),					
				],		
			]
		);
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '6',         
                'options' => [
                    '6' => esc_html__( '2 Column', 'prelements' ),
                    '4' => esc_html__( '3 Column', 'prelements' ),
                    '3' => esc_html__( '4 Column', 'prelements' ),
                    '2' => esc_html__( '6 Column', 'prelements' ),
                    '12' => esc_html__( '1 Column', 'prelements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '6',         
                'options' => [
                    '6' => esc_html__( '2 Column', 'prelements' ),
                    '4' => esc_html__( '3 Column', 'prelements' ),
                    '3' => esc_html__( '4 Column', 'prelements' ),
                    '2' => esc_html__( '6 Column', 'prelements' ),
                    '12' => esc_html__( '1 Column', 'prelements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Item Limit', 'prelements' ),
				'type' => Controls_Manager::NUMBER,
                'dynamic' => [ 'active' => true ],
				'default' => esc_html__( '6', 'prelements' ),
                'condition' => [ 'pre_blog_posts_is_manual_selection!' => 'yes' ], 
			]
		);

        $this->add_control(
            'content_image_reverse',
            [
                'label'   => esc_html__( 'Content Image Reverse', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 12,            
                'options' => [
                    '1' => esc_html__( 'Default', 'prelements' ),
                    '2' => esc_html__( 'Reverse', 'prelements' ),       
                ],      
            ]
        );   

// .prelements-blog-grid .pre-blog-item .blog-inner-wrap

        $this->end_controls_section();


        //Thumbnail Settings Here
        $this->start_controls_section(
            '_images_settings',
            [
                'label' => esc_html__( 'Thumbnail Settings', 'prelements' ),
            ]
        );  

        $this->add_control(
            'blog_image_show_hide',
            [
                'label' => esc_html__( 'Show Thumbnail', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
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
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],
            ]
        );  

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label' => esc_html__( 'Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ], 
            ]
        );
        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label' => esc_html__( 'Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'Height: {{SIZE}}{{UNIT}}; object-fit:cover;',
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ], 
            ]
        );

        $this->add_control(
            'blog_thumbnail',
            [
                'label' => esc_html__( 'Thumbnail Position', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'rsaddon' ),
                    'left' => esc_html__( 'Left', 'prelements' ),
                    'right' => esc_html__( 'Right', 'rsaddon' ),
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],             
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label' => esc_html__( 'Content Alignments', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => esc_html__( 'Top', 'prelements' ),
                    'rs__center' => esc_html__( 'Center', 'rsaddon' ),
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],             
            ]
        );

        $this->add_control(
            'show_message_quote',
            [
                'label' => esc_html__( 'Show Message Quote', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        //Title Settings Here
        $this->start_controls_section(
            '_title_settings',
            [
                'label' => esc_html__( 'Title Settings', 'prelements' ),
            ]
        ); 

        $this->add_control(
            'blog_title_show_hide',
            [
                'label' => esc_html__( 'Title', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        ); 

        $this->add_control(
            'blog_title_word_show',
            [
                'label' => esc_html__( 'Word Limit', 'prelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '200', 'prelements' ),
                'condition' => [
                    'blog_title_show_hide' => 'yes',
                ]
            ]
        );  

        $this->end_controls_section();


        //Meta Settings Here
        $this->start_controls_section(
            '_meta_settings',
            [
                'label' => esc_html__( 'Meta Settings', 'rsaddon' ),
            ]
        );	

        $this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Show Meta', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );
        $this->add_control(
            'show_read_time',
            [
                'label' => esc_html__( 'Show Read Time', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]   

            ]
        );


		$this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Show Category', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]                
            ]
        );		

        $this->add_control(
            'author_meta',
            [
                'label' => __( 'Author', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => 'yes',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Show Author Image', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],    
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'author_meta' => 'yes',
                ]            
            ]
        );
        $this->add_control(
            'author_icon',
            [
                'label' => __( 'Author Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fi fi-rr-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'author_meta' => 'yes',
                    'blog_avatar_show_hide!' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'author__img__icon',
            [
                'label' => esc_html__( 'Author Image Icon', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'author_meta' => 'yes',
                    'blog_avatar_show_hide!' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'posted_by',
            [
                'label' => esc_html__( 'Posted By ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type your title here', 'rsaddon' ),
                 'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'year_meta',
            [
                'label' => __( 'Year', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => 'yes',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'date_by',
            [
                'label' => esc_html__( 'Year By ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Type your title here', 'rsaddon' ),
                 'condition' => [
                    'year_meta' => 'yes',

                ]
            ]
        );
        $this->add_control(
            'date_meta',
            [
                'label' => __( 'Date', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => 'yes',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'date_icon',
            [
                'label' => __( 'Date Icon', 'prelements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fi fi-rr-calendar',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'date_meta' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'category_meta',
            [
                'label' => __( 'Category Icon', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => 'yes',
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'category_icon',
            [
                'label' => __( 'Category Icon', 'prelements' ),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                    'category_meta' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'category_img_sec__',
            [
                'label' => esc_html__( 'Category Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'category_meta' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'reverse_meta',
            [
                'label' => __( 'Meta Reverse (Horizontal)', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => '',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'reverse_meta_vertical',
            [
                'label' => __( 'Meta Reverse (Vertical)', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => '',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_svg_width',
            [
                'label' => esc_html__( 'Width (SVG Image)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ], 
            ]
        );
        $this->add_control(
            'meta_icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta.pre-reverse-meta .pre-date svg, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta.pre-reverse-meta a span.pre-admin svg' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ],            
            ]
        );

        $this->add_responsive_control(
            'svg_margin',
            [
                'label' => esc_html__( 'Margin (SVG Image)', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_meta_alignment',
            [
                'label' => esc_html__( 'Meta Alignment', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inlines',
                'options' => [
                    'inlines' => esc_html__( 'Inline', 'prelements' ),
                    'blocks' => esc_html__( 'Block', 'prelements' ),
                ], 
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ],            
            ]
        );

        $this->add_control(
            'blog_meta_style',
            [
                'label' => esc_html__( 'Meta Position', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Default', 'prelements' ),
                    'style2' => esc_html__( 'Top', 'prelements' ),
                ], 
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                ],            
            ]
        );

        $this->add_control(
            'blog_cate_style',
            [
                'label' => esc_html__( 'Category Position', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style2',
                'options' => [
                    'style1' => esc_html__( 'Default', 'prelements' ),
                    'style2' => esc_html__( 'Bottom', 'prelements' ),
                ], 
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ],            
            ]
        );

        $this->add_control(
            'blog_category_style',
            [
                'label' => esc_html__( 'Category Layout', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'prelements' ),
                    'background' => esc_html__( 'Background', 'prelements' ),
                    'borders' => esc_html__( 'Border', 'prelements' ),
                ],             
            ]
        );

        $this->end_controls_section();


        //Content Settings Here
        $this->start_controls_section(
            '_content_settings',
            [
                'label' => esc_html__( 'Content Settings', 'prelements' ),
            ]
        );  

		$this->add_control(
            'blog_content_show_hide',
            [
                'label' => esc_html__( 'Show Content', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        );

		$this->add_control(
			'blog_word_show',
			[
				'label' => esc_html__( 'Content Limit', 'prelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '20', 'prelements' ),
				'separator' => 'before',
				'condition' => [
                    'blog_content_show_hide' => 'yes',
                ]
			]
		);

        $this->end_controls_section();


        //Button Settings Here
        $this->start_controls_section(
            '_button_settings',
            [
                'label' => esc_html__( 'Button Settings', 'rsaddon' ),
            ]
        );

		$this->add_control(
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                ],                
            ]
        );

        $this->add_control(
            'show_author_in_button',
            [
                'label' => esc_html__( 'Show Author In Button', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'condition'=>[
                    'blog_readmore_show_hide'=> 'yes'
                ]
            ]
        );
        $this->add_control(
            'blog_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
                'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );
		$this->add_control(
			'blog_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'prelements' ),
				'type' => Controls_Manager::ICONS,								
				'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]			
			]
		);

        $this->add_responsive_control(
            'blog_btn_icon_svg_width',
            [
                'label' => esc_html__( 'Icon Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .blog-btn svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-btn svg' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-btn i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

		$this->add_responsive_control(
		    'blog_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing (X)', 'prelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'blog_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-before svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-after svg' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'btn_icon_top_btm_position',
            [
                'label' => esc_html__( 'Icon Position (Y)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-before i' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-after i' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-before svg' => 'top: {{SIZE}}{{UNIT}} position: relative;;',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-after svg' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'prelements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => esc_html__( 'Before', 'prelements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => esc_html__( 'After', 'prelements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => [
                    'blog_btn_icon!' => '',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_pagination_settings',
            [
                'label' => esc_html__( 'Pagination Settings', 'prelements' ),
            ]
        );

        $this->add_control(
            'blog_pagination_show_hide',
            [
                'label' => esc_html__( 'Show Pagination', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        );
				
		$this->end_controls_section();


        //Default Style Here
		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Default Style', 'prelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'prelements' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content',
                
            ]
        );

        $this->add_responsive_control(
            'bg_height',
            [
                'label' => esc_html__( 'Overlay Background Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap .pre-image-wrap:before' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item',
            ]
        );
        

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Item Shadow', 'prelements' ),
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item',
            ]
        );	

        $this->add_responsive_control(
            'blog_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'align_blog',
            [
                'label' => esc_html__( 'Alignment', 'prelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'prelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'prelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'prelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'prelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'text-align: {{VALUE}}'
                ],
            ]
        );  
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content .pre-blog-meta' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content h3.pre-post-title a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover .pre-blog-content .blog-btn-part .blog-btn' => 'color: {{VALUE}};',

                ],               
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => esc_html__( 'Background Hover', 'prelements' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item:hover, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-image-wrap:hover',
                
            ]
        );    
	    
        $this->add_responsive_control(
            'item_padding_contents',
            [
                'label' => esc_html__( 'Content Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_item_border_radiusgird',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Category Style Here
        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Category Style', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_cat_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a' => 'background: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'cat_icon_bg_color',
            [
                'label' => esc_html__( 'Category Background Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a .cat-icon' => 'background: {{VALUE}};',
                ],               
            ]
        );  
        $this->add_control(
            'blog_cat_color',
            [
                'label' => esc_html__( 'Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a,{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a' => 'color: {{VALUE}};',

                ],               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cate_typography',
                'label' => esc_html__( 'Typography', 'prelements' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a,{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a',
            ]
        );

        $this->add_responsive_control(
            'cats_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cats_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cats_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_cat_position_left',
            [
                'label' => esc_html__( 'Position (Left/Right)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_cate_style' => 'style1',
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_cat_position_top',
            [
                'label' => esc_html__( 'Position (Top/Bottom)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list' => 'top: calc(100% + {{SIZE}}{{UNIT}});',                   
                ],
                'condition' => [
                    'blog_cate_style' => 'style1',
                ]
            ]
        );

        // category icon bg width height
        $this->add_control(
            'category_icon_bg_heading ',
            [
                'label' => esc_html__( 'Category Icon Bg Width & Height', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'category_icon_bg_width',
            [
                'label' => esc_html__( 'Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a .cat-icon, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a img' => 'width: {{SIZE}}{{UNIT}};',               
                ],
            ]
        );
        $this->add_responsive_control(
            'category_icon_bg___height',
            [
                'label' => esc_html__( 'Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a .cat-icon, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a img' => 'height: {{SIZE}}{{UNIT}};',                   
                                   
                ],

            ]
        );

        $this->add_responsive_control(
            'category_icon_bg_line_height',
            [
                'label' => esc_html__( 'Line Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a .cat-icon' => 'line-height: {{SIZE}}{{UNIT}};',                   
                                   
                ],

            ]
        );

        $this->end_controls_section();

        //Thumbnail Style Here
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Thumbnail Style', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'blog_image_show_grayscale',
            [
                'label' => esc_html__( 'Show Grayscale at Hover', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-image-wrap:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'msg_quote_heading',
            [
                'label' => esc_html__( 'Message Quote Style', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition'=>[
                    'show_message_quote'=> 'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'message_quote_bg',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .pre-image-wrap .blog-message-quote',
                'condition'=>[
                    'show_message_quote'=> 'yes'
                ]
            ]
        );
        $this->add_control(
            'message_quote_icon_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-image-wrap .blog-message-quote svg path' => 'fill: {{VALUE}};',
                ],
                'condition'=>[
                    'show_message_quote'=> 'yes'
                ]           
            ]
        );

        $this->add_control(
            'image_overlay_bg',
            [
                'label' => esc_html__( 'Image Overlay Background', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'image_overlay_background',
                'label' => esc_html__( 'Background', 'prelements' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_5 .pre-image-wrap:before, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-image-wrap::before',
                
            ]
        );

        $this->end_controls_section();

        //Meta Style Here
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => esc_html__( 'Meta Style', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'display: {{VALUE}};',
                ],
                'separator' => 'before',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'align-items: {{VALUE}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'flex-direction: {{VALUE}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size (Only Use Icon)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'blog_meta_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta svg' => 'fill: {{VALUE}};',
                ],                
            ]
        );        

        $this->add_control(
            'blog_meta_color_',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-meta svg' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'blog_meta_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-image-wrap .pre-blog-meta::after, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-image-wrap .pre-blog-meta::after' => 'border: 1px solid {{VALUE}};',
                ], 
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]               
            ]
        );
        $this->add_responsive_control(
            'dates_padding',
            [
                'label' => esc_html__( 'Date Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.pre-blog-meta-style2 .pre-image-wrap .pre-blog-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_meta_border_radius',
            [
                'label' => esc_html__( 'Date Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-image-wrap .pre-blog-meta::after, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-image-wrap .pre-blog-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_wrapper_min_width',
            [
                'label' => esc_html__( 'Date Wrapper Min Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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

                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.pre-blog-meta-style2 .pre-image-wrap .pre-blog-meta' => 'min-width: {{SIZE}}{{UNIT}}!important;',                   
                ],
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4' ,'transparent' ],
                ]  
            ]
        );
        $this->add_responsive_control(
            'blog4_date_position',
            [
                'label' => esc_html__( 'Date Position (Left/Right)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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

                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
                
            ]
        );
        $this->add_responsive_control(
            'blog_top_date_position',
            [
                'label' => esc_html__( 'Date Position From (Bottom)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta' => 'bottom: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_top_date_position_for_only_style_for',
            [
                'label' => esc_html__( 'Date Position From(Top)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta' => 'top: {{SIZE}}{{UNIT}}; bottom:unset!important;',                   
                ], 
            ]
        );
        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => esc_html__( 'Meta Date Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'spacific_date_typo',
                'label' => esc_html__( 'Spacific Date Typography', 'prelements' ),
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-meta .pre-date',
                'condition'=>[
                    'blog_content_postion_style' => [ 'style_4' ,'transparent' ],
                ],
                
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'spacific_month_typo',
                'label' => esc_html__( 'Spacific Month Typography', 'prelements' ),
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-meta .pre-month',
                'condition'=>[
                    'blog_content_postion_style' => [ 'style_4' ,'transparent' ],
                ],
            ]
        ); 

        $this->add_responsive_control(
            'blog_top_date_rotate',
            [
                'label' => esc_html__( 'Rotate', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                
                'selectors' => [
                '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.pre-blog-meta-style2 .pre-image-wrap .pre-blog-meta' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]  
            ]
        );

        $this->add_responsive_control(
            'icons_margin',
            [
                'label' => esc_html__( 'Icon Margin (Only Use Icon)', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__( 'Typography', 'prelements' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-meta',
            ]
        );

        $this->add_control(
            'author_style_title',
            [
                'label' => esc_html__( 'Author Style', 'prelements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_meta_typo',
                'label' => esc_html__( 'Author Meta Typography', 'prelements' ),
                'selector' =>
                    '{{WRAPPER}} .pre-blog-item.default.pre-blog-meta-style1 .blog-inner-wrap.pre-thum-default.pre-meta-inlines.top .pre-blog-content .pre-blog-meta a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .pre-blog-content .rs-single-year,{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-admin',
            ]
        );
        $this->add_control(
            'author_date_color',
            [
                'label' => esc_html__( 'Author & Year Meta Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .pre-blog-content .rs-single-year .d-o-t' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .pre-blog-content .rs-single-year' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-admin' => 'color: {{VALUE}};',
                ],             
            ]
        );

        $this->add_responsive_control(
            'author_image_width',
            [
                'label' => esc_html__( 'Author Image Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-avatar-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_icon_width',
            [
                'label' => esc_html__( 'Author Icon Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content img' => 'width: {{SIZE}}{{UNIT}}; height:auto;',
                ],
                'condition' => [
                    'author_meta' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'author_padding_',
            [
                'label' => esc_html__( 'Author Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'auhtor_area_border_radius',
            [
                'label' => esc_html__( 'Author Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'author__color_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta a',
            ]
        );
        $this->add_responsive_control(
            'blog_author_image_position_left',
            [
                'label' => esc_html__( 'Author Image Position (Left/Right)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-avatar-image img' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'blog_author_position_top',
            [
                'label' => esc_html__( 'Author Image Position (Top/Bottom)', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-avatar-image img' => 'top: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'media_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-avatar-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'time_dot_bg_heading',
            [
                'label' => esc_html__( 'Time Dot Background Color', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition'=>[
                    'show_read_time'=>'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'time_dot_bg_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pre-blog-meta .p-rtime .p-rtime-clip-path-wrapper',
                'condition'=>[
                    'show_read_time'=>'yes'
                ]
            ]
        );
        $this->add_control(
            'time_dot_heading',
            [
                'label' => esc_html__( 'Time Dot Color', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition'=>[
                    'show_read_time'=>'yes'
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'time_dot_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pre-blog-meta .p-rtime .p-rtime-clip-path-wrapper .p-rtime-clip-path',
                'condition'=>[
                    'show_read_time'=>'yes'
                ]
            ]
        );
        $this->end_controls_section();


        //Title Style Here
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title Style', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_title_show_hide' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a' => 'color: {{VALUE}};',

                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a:hover, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-blog-content .pre-post-title a:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover_line',
            [
                'label' => esc_html__( 'Line hover color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a:hover, {{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-blog-content .pre-post-title a:hover' => 'background-image: linear-gradient(to bottom, {{VALUE}} 0%, {{VALUE}} 100%);',
                ],                
            ]            
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'titlle_area_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title',
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'prelements' ),
				'selector' => 
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content h3.pre-post-title a, {{WRAPPER}} .pre-blog-item .pre-blog-content h3.pre-post-title, {{WRAPPER}} .pre-blog-item .pre-blog-content .pre-post-title',
			]
		);

        $this->add_responsive_control(
            'titles_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'titles_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'titles_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_area_position_notfication',
            [
                'label' => esc_html__( 'Title Area Position', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'title_area_vertical',
            [
                'label' => esc_html__( 'Area Vertical Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title' => 'top: {{SIZE}}{{UNIT}}; position:absolute;',                   
                ],

            ]
        );
        $this->add_responsive_control(
            'title_area_horizontal',
            [
                'label' => esc_html__( 'Area Horizontal Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-post-title' => 'left: {{SIZE}}{{UNIT}}; right:{{SIZE}}{{UNIT}};',                   
                ],

            ]
        );
        $this->end_controls_section();


        //Content Style Here
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content Style', 'prelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content p.pre-content' => 'color: {{VALUE}};',

                ], 
                'condition' => [
                    'blog_content_show_hide' => 'yes',
                ],               
            ]
        );

        $this->add_control(
            'content_color_bg',
            [
                'label' => esc_html__( 'Background', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content' => 'background: {{VALUE}};',

                ],               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'prelements' ),
                'condition' => [
                    'blog_content_show_hide' => 'yes',
                ],
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content p.pre-content',

            ]
        );
        $this->add_responsive_control(
		    'blog_content_padding',
		    [
		        'label' => esc_html__( 'Area Padding', 'prelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],

		    ]
		);
        $this->add_responsive_control(
            '_content_margin',
            [
                'label' => esc_html__( 'Area Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_content_description_margin',
            [
                'label' => esc_html__( 'Description Margin', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Content Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .blog-inner-wrap .pre-blog-content' => 'width: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );

        $this->add_control(
            'blog_content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-inner-wrap .pre-blog-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'label' => esc_html__( 'Item Shadow', 'prelements' ),
                'selector' => '{{WRAPPER}} .blog-inner-wrap .pre-blog-content',
            ]
        );
        $this->add_control(
            'content_title_h_heading',
            [
                'label' => esc_html__( 'Content Title Height & Second Hover Height', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_title_h_',
            [
                'label' => esc_html__( 'Content Title Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-blog-content .pre-post-title' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_title_hover_h_',
            [
                'label' => esc_html__( 'Content Title Hover Height ', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4:hover .blog-inner-wrap .pre-blog-content .pre-post-title' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_control(
            'content_description_h_heading',
            [
                'label' => esc_html__( 'Content Description Height & Second Hover Height', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_des_h_',
            [
                'label' => esc_html__( 'Content Description Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4 .blog-inner-wrap .pre-blog-content .pre-content' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_responsive_control(
            'content_desc_hover_h_',
            [
                'label' => esc_html__( 'Content Description Hover Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.style_4:hover .blog-inner-wrap .pre-blog-content .pre-content' => 'height: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_content_postion_style' => [ 'style_4'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content__border',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content',
            ]
        );
		$this->end_controls_section();


		//Read More Style Here
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button Style', 'prelements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ],
		    ]
		);

        $this->add_responsive_control(
            'butoon_area_view_style',
            [
                'label' => esc_html__( 'View Style', 'rsaddon' ),
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
                'condition'=>[
                    'show_author_in_button'=>'yes',
                ],
                'default' => 'inline-flex',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'display: {{VALUE}} !important;'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'butoon_area_alignment',
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
				'condition'=>[
                    'show_author_in_button'=>'yes',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'button_area_dirrection',
            [
                'label' => esc_html__( 'Area Direction', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                ],
                'condition'=>[
                    'show_author_in_button'=>'yes',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'flex-direction: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'blog_btn_area_margin',
            [
                'label' => esc_html__( 'Button Area Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'blog_btn_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'prelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'blog_btn_link_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'blog_btn_border',
                'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn',
            ]
        );
		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn',
		    ]
		);
		$this->add_control(
		    'blog_btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'prelements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_btn_box_shadow',
		        'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn',
		    ]
		);
		$this->add_control(
		    'hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);
		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_blog_btn_normal',
		    [
		        'label' => esc_html__( 'Normal', 'prelements' ),
		    ]
		);
		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-blog-content .blog-btn-part .blog-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'blog_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
		    '_blog_btn_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'prelements' ),
		    ]
		);
		$this->add_control(
		    'blog_btn_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover .btn-txt' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg' => 'path: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg path' => 'fill: {{VALUE}};',
                ],
		    ]
		);
		$this->add_control(
		    'blog_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content:hover .blog-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'blog_btn_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover, {{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->add_control(
		    'blog_btn_hover_border_color2',
		    [
		        'label' => esc_html__( 'Border Color 2', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);
        $this->add_control(
		    'blog_btn_hover_bg_color2',
		    [
		        'label' => esc_html__( 'Background Color 2', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		$this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'button_admin_text_heading',
            [
                'label' => esc_html__( 'Button Admin Typography', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' =>[
                    'show_author_in_button'=> 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_admin_text_typography',
                'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn-part .admin-text',
                'condition' =>[
                    'show_author_in_button'=> 'yes',
                ]
            ]
        );
        $this->add_control(
            'admin_img_margin',
            [
                'label' => esc_html__( 'Admin Image Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-avatar-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' =>[
                    'show_author_in_button'=> 'yes',
                ]
            ]
        );

		$this->end_controls_section();



		// Start Blog Pagination Style
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
		    'blog_pagi_color',
		    [
		        'label' => esc_html__( 'Color', 'prelements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers' => 'color: {{VALUE}};',
		        ],		        
		    ]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_pagiesc_html__bg_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers',
            ]
        );
        $this->add_control(
            'blog_pagi_active_color',
            [
                'label' => esc_html__( 'Active Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links a.next.page-numbers, {{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links a.prev.page-numbers, {{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links span.current' => 'color: {{VALUE}} !important;',
                ],              
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_pagiesc_html__bg_active_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links a.next.page-numbers, {{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links a.prev.page-numbers, {{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links span.current',
            ]
        );
        $this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Alignment', 'prelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'prelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'prelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'prelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'prelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-pagination-area .nav-links' => 'justify-content: {{VALUE}}'
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-pagination-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border__',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_icon_font_type',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .prelements-pagination-area .nav-links .page-numbers i',
            ]
        );
		$this->end_controls_section();

		// End Blog Pagination Style

	}

	/**
	 * Render Blog Grid widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display(); 
        $grayscale = $settings['blog_image_show_grayscale'];
        $content_reverse = $settings['content_image_reverse'];
        $blog_content_postion_style = $settings['blog_content_postion_style'];

        if($content_reverse == '2') { ?>
            <style>
                .prelements-blog-grid .pre-blog-item .blog-inner-wrap {
                    display: flex;
                    flex-direction: column-reverse;
                }
            </style>
       <?php }

          

        $no_grayscale = !empty($grayscale) ? 'grayscale' : 'no-grayscale'?>
			<div class="prelements-blog-grid blog-grid <?php echo esc_attr( $no_grayscale);?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">
				<div class="row">
				 	<?php                        

				        $cat = $settings['category'];
                        $select = $settings['select_posts'];
                        if ( 'yes' === $settings['blog_pagination_show_hide'] ){ 
							global  $paged;
					        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							if(empty($cat)){
					        	$prelements_query = new wp_Query(array(
				        			'post_type'      => 'post',
                                    'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
									'posts_per_page' => $settings['per_page'],
									'paged'          => $paged,
									'post__in' => $select,					
								));	  
					        }   
					        else{
					        	$prelements_query = new wp_Query(array(
					        			'post_type'      => 'post',
                                        'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
										'posts_per_page' => $settings['per_page'],
										'paged'          => $paged,
										'post__in' => $select,
										'tax_query'      => array(
									        array(
												'taxonomy' => 'category',
												'field'    => 'slug', 
												'terms'    => $cat 
									        ),
									    )
								));	  
					        }
					    }

					    else{

						    if(empty($cat)){
					        	$prelements_query = new wp_Query(array(
					        		'post_type'      => 'post',
                                    'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
									'posts_per_page' => $settings['per_page'],	
                                    'post__in' => $select,			
								));	  
					        }   
					        else{
					        	$prelements_query = new wp_Query(array(
					        			'post_type'      => 'post',
                                        'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
										'posts_per_page' => $settings['per_page'],
                                        'post__in' => $select,
										'tax_query'      => array(
									        array(
												'taxonomy' => 'category',
												'field'    => 'slug', 
												'terms'    => $cat 
									        ),
									    )
								));	  
					        }
					    }
				        $count = 1;
						while($prelements_query->have_posts()): $prelements_query->the_post(); 

                            $full_date              = get_the_date('M j, Y');
                            $full_date_by_year      = get_the_date('d / m / Y');
                            $blog_date              = get_the_date('M j, Y');
                            $post_admin             = get_the_author();

                            // Break Blog Format
                            $_date = get_the_date('j F');
                            $_dateParts = explode(' ', $_date);
                            $_day = $_dateParts[0];
                            $_month = $_dateParts[1];

                            // Only Year
                            $_year = get_the_date("Y");
                            

							
							if(!empty($settings['blog_word_show'])){
								$limit = $settings['blog_word_show'];
							}
							else{
								$limit = 20;
							}

	                        
	                        if(!empty($settings['blog_title_word_show'])){
	                            $limits = $settings['blog_title_word_show'];
	                        }
	                        else{
	                            $limits = 200;
	                        }

                            $thumbnail_id_elem = $settings['after_image']['id'];
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                            if ( empty( $thumbnail_alt ) ) {
                                $thumbnail_alt = get_the_title( $thumbnail_id );
                            }

						?>
						
						<div class="col-md-<?php echo esc_html($settings['col_md']);?> col-sm-<?php echo esc_html($settings['col_sm']);?> col-lg-<?php echo esc_html($settings['blog_columns']);?>">
							<div class="pre-blog-item <?php echo esc_html($settings['blog_content_postion_style']);?> pre-blog-meta-<?php echo esc_html($settings['blog_meta_style']);?> <?php echo esc_html($settings['blog_category_style']);?>">
								<div class="blog-inner-wrap pre-thum-<?php echo esc_html($settings['blog_thumbnail']);?> pre-meta-<?php echo esc_html($settings['blog_meta_alignment']);?> <?php echo esc_html($settings['content_alignment']);?>">
									<div class="pre-image-wrap">
                                        
                                        <?php if ('yes' === $settings['blog_image_show_hide']){ ?>                                            
    										<a class="pre-pointer-events" href="<?php the_permalink();?>">
                                                <?php if ('yes' === $settings['show_message_quote']){ ?>
                                                    <span class="blog-message-quote">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"  xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.70371 13.1768L7.90054e-06 14L0.823208 10.2963C0.28108 9.28226 -0.00172329 8.14985 7.90054e-06 7C7.90054e-06 3.1339 3.13391 0 7 0C10.8661 0 14 3.1339 14 7C14 10.8661 10.8661 14 7 14C5.85015 14.0017 4.71774 13.7189 3.70371 13.1768Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                                <?php } ?>
    											<?php echo  wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
    										</a>
                                        <?php } ?>


                                        <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                                        <?php if ( 'yes' === $settings['date_meta'] ){ ?>
										<?php if(($settings['blog_meta_style'] == 'style2') ){ ?>
											<div class="pre-blog-meta">
												<?php if(!empty($_day) && !empty($_month)){ ?>
                                                    <span class="pre-date"><?php echo esc_html($_day);?></span>
                                                    <span class="pre-month"><?php echo esc_html($_month);?></span>
												<?php } ?>
											</div>
										<?php } } } ?>											
										
                                        <?php if ( 'yes' === $settings['blog_cat_show_hide'] ){ ?>
                                           
                                                <div class="pre-cat-list">
                                                    <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>

                                                </div>
                                        <?php } ?>
									</div>	

									<div class="pre-blog-content">
                                    <!-- If Reverse Meta Vertical -->

                                    <?php if ( 'yes' === $settings['reverse_meta_vertical'] ){ ?>

                                        <?php if ( 'yes' === $settings['blog_cat_show_hide'] ){ ?>
                                            <?php if(($settings['blog_cate_style'] == 'style2') ){ ?>
                                                <div class="pre-cat-list">
                                                    <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                                            <h3 class="pre-post-title"><a class="pre-pointer-events" href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $limits, '' ); ?></a></h3>                                        
                                        <?php } ?>


                                        <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                                            <?php if(($settings['blog_meta_style'] == 'style1') ){ ?>
                                                <?php if ( 'yes' === $settings['reverse_meta'] ){ ?>
                                                    <div class="pre-blog-meta pre-reverse-meta">                                                      
                                                        <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                                            <?php if(!empty($post_admin)){ ?>
                                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                                <span class="pre-admin">
                                                                    <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                                    
                                                                        <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                                    
                                                                    <?php } else {
                                                                        if ( $settings['author_icon'] ):
                                                                            Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                                        endif; 
                                                                    } ?>
                                                                <?php echo esc_html($settings['posted_by']); echo esc_html($post_admin);?>
                                                                </span>
                                                            </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                            <?php if(!empty($full_date)){ ?>
                                                                <span class="pre-date">
                                                                    <?php if ( $settings['date_icon'] ):
                                                                        Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                    endif; ?> 
                                                                    <?php echo esc_html($full_date);?></span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="pre-blog-meta">
                                                        <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                            <?php if(!empty($full_date)){ ?>
                                                                <span class="pre-date">
                                                                    <?php if ( $settings['date_icon'] ):
                                                                        Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                    endif; ?> 
                                                                    <?php echo esc_html($full_date);?></span>
                                                                    <?php 
                                                                        if ( 'yes' === $settings['show_read_time'] ):
                                                                            ?>
                                                                                <span class="p-rtime">
                                                                                    <span class="p-rtime-clip-path-wrapper">
                                                                                        <span class="p-rtime-clip-path"></span>
                                                                                    </span>
                                                                                    <?php $this->post_read_time(); ?>
                                                                                </span>
                                                                            <?php
                                                                        endif;
                                                                    ?>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                                            <?php if(!empty($post_admin)){ ?>
                                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                                    <span class="pre-admin">
                                                                        <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                                        
                                                                            <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                                        
                                                                        <?php } else {
                                                                            if ( $settings['author_icon'] ):
                                                                                Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                                            endif; 
                                                                        } ?>
                                                                        <?php if(!empty($post_admin)){ ?> 
                                                                            <?php echo esc_html($settings['posted_by']); echo esc_html($post_admin);?>
                                                                        <?php }?>    
                                                                    </span>
                                                                </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                        <?php } } ?> 

                                    <!-- else Reverse Meta Vertical -->

                                    <?php } else { ?>

                                        <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                                            <?php if(($settings['blog_meta_style'] == 'style1') ){ ?>
                                                <?php if ( 'yes' === $settings['reverse_meta'] ){ ?>
                                                    <div class="pre-blog-meta pre-reverse-meta">                                                      
                                                        <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                                            <?php if(!empty($post_admin)){ ?>
                                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                                    <span class="pre-admin">
                                                                        <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                                        
                                                                            <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                                        
                                                                        <?php } else {
                                                                            if ( $settings['author_icon'] ):
                                                                                Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                                            endif; 
                                                                        } ?>
                                                                    <?php echo esc_html($settings['posted_by']); echo esc_html($post_admin);?></span>
                                                                </a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                            <?php if(!empty($full_date_by_year)){ ?>
                                                                <span class="pre-date">
                                                                    <?php if ( $settings['date_icon'] ):
                                                                        Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                    endif; ?> 
                                                                    <?php echo esc_html($full_date_by_year);?></span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="pre-blog-meta">
                                                        <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                            <?php if(!empty($full_date)){ ?>
                                                                <span class="pre-date">
                                                                    <?php if ( $settings['date_icon'] ):
                                                                        Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                    endif; ?> 
                                                                    <?php echo esc_html($full_date);?></span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if( $blog_content_postion_style != 'style_5') { ?>
                                                        <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                                            <?php if(!empty($post_admin)){ ?>
                                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                                    <span class="pre-admin">
                                                                        <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                                        
                                                                            <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                                        
                                                                        <?php } else {
                                                                            if ( $settings['author_icon'] ):
                                                                                Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                                            endif; 
                                                                        } ?>
                                                                    <?php  echo esc_html($post_admin);?>
                                                                </span>
                                                                </a>
                                                            <?php } ?>
                                                        <?php } } ?>
                                                    </div>
                                                <?php } ?>
                                        <?php } } ?>

                                        <!-- ====== -->
                                      
                                        
                                        <?php

                                        if( $blog_content_postion_style != 'style_5') {
                                        // Authot Img Icon
                                            if ("yes" === $settings['author_meta']) {
                                    
                                                if(!empty( $settings['author_icon']['value']) ) {
                                                    \Elementor\Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                }elseif( !empty($settings['author__img__icon']['url']) ){
                                                    ?>
                                                      <img src="<?php echo esc_url( $settings['author__img__icon']['url'] );?>" alt="image"/>
                                                    <?php
                                                }

                                            }

                                            // Year By
                                            if ('yes' ===  $settings['year_meta']) {

                                                if(!empty($_year) ){ 
                                                    ?>
                                                        <span class="rs-single-year"><span class="d-o-t"></span><?php echo esc_html($settings['date_by']); echo esc_html($_year);?></span>
                                                    <?php
                                                }
                                           }
                                        }

                                        ?>
                                               
                                        <!-- ====== -->
                                                                                
                                        <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                                            <h3 class="pre-post-title"><a class="pre-pointer-events" href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $limits, '' ); ?></a></h3>                                        
                                        <?php } ?>
                                        <?php if( $blog_content_postion_style == 'style_5') { ?>
                                            <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                                <?php if(!empty($post_admin)){ ?>
                                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                        <span class="pre-admin">
                                                            <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                            
                                                                <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                            
                                                            <?php } else {
                                                                if ( $settings['author_icon'] ):
                                                                    Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                                endif; 
                                                            } ?>
                                                        <?php  echo esc_html($post_admin);?>
                                                    </span>
                                                    </a>
                                                <?php } ?>
                                            <?php } } ?>


                                    <?php } ?>

                                    <!-- End if Reverse Meta Vertical -->

                                       

                                        <?php if ( 'yes' === $settings['blog_content_show_hide'] ){ ?>
    								  		<p class="pre-content"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
    									<?php } ?>

    									
                                        <?php if ( 'yes' === $settings['blog_readmore_show_hide'] ){ ?>

                                            <?php if(!empty($settings['blog_btn_text'])){ ?>
                                                <div class="blog-btn-part">
                                                    <?php if( 'yes' == $settings['show_author_in_button'] ): ?>
                                                        <a class="pre-admin" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                            <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                            <span class="admin-text"><?php echo esc_html($settings['posted_by']); echo esc_html($post_admin);?></span>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php  
                                                        $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                    ?>
                                                        <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                            <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>
                                                            <?php 
                                                                if(!empty($settings['blog_btn_icon']['value'])) : 
                                                                    Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                                                else: ?>
                                                                     <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g clip-path="url(#clip0_878_88<?php echo $count;?>)"><path d="M7.5 8.125H2.5V6.875H7.5V2.5L12.5 7.5L7.5 12.5V8.125Z" fill="#513DE8"></path></g><defs><clipPath id="clip0_878_88<?php echo $count;?>"><rect width="15" height="15" fill="white"></rect></clipPath></defs></svg>
                                                                <?php 
                                                                endif; 
                                                            ?>
                                                           
                                                        </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="blog-btn-part">

                                                    <?php  
                                                        $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                    ?>
                                                        <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                            <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>
                                                            <?php 
                                                                if(!empty($settings['blog_btn_icon']['value'])) : 
                                                                    Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                                                else: ?>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"><g clip-path="url(#clip0_878_88<?php echo $count;?>)"><path d="M7.5 8.125H2.5V6.875H7.5V2.5L12.5 7.5L7.5 12.5V8.125Z" fill="#513DE8"></path></g><defs><clipPath id="clip0_878_88<?php echo $count;?>"><rect width="15" height="15" fill="white"></rect></clipPath></defs></svg>
                                                                <?php 
                                                                endif; 
                                                            ?>
                                                        </a>
                                                </div>
                                          <?php  } } ?>
									</div>
						  		</div>
					  		</div>
						</div>
						<?php
						$count++;
                    endwhile;

						wp_reset_query();  ?>

                    <?php //} ?>
				</div>
				<?php 
					$paginate = paginate_links( array(
					    'total' => $prelements_query->max_num_pages,
                        'prev_text' => __('<i class="ri-arrow-left-fill"></i>', 'rsaddon'),
                        'next_text' => __('<i class="ri-arrow-right-fill"></i>', 'rsaddon'),
                        'type'      => 'plain',
                        'format'    => '?paged=%#%',
                        'before_page_number' => '0',
					));

					if(!empty($paginate ) && ( 'yes' === $settings['blog_pagination_show_hide'])){ ?>
						<div class="prelements-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
				<?php } ?>

			</div>
              
		<?php
	}

    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'post' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'category',
                'hide_empty'  => true            
            ) );           
         
  
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }

    public function post_read_time() {
        // get the post content
        $content = get_post_field( 'post_content' );
        // count the words
        $word_count = str_word_count( strip_tags( $content ) );
        // reading time itself
        $readingtime = ceil($word_count / 30);
        if ($readingtime == 1) {
            $timer = " min read";
        } else {
        $timer = " min read"; // or your version :) I use the same wordings for 1 minute of reading or more
        }
        // I'm going to print 'X minute read' above my post
        $totalreadingtime = $readingtime . $timer;
        echo $totalreadingtime;
    }
 
}