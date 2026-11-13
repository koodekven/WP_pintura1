<?php
/**
 * Latest Blog Slider Widget.
 *
 * Prelements Elementor widget that retrieve all blog post into slider style.
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

class Rsaddon_Elementor_Pro_latest_Blog_Slider_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Prelements Blog Slider widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'prelements-blog-slider';
    }       

    /**
     * Get widget title.
     *
     * Retrieve Prelements Blog Slider widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Latest Blog Slider', 'prelements' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Prelements Blog Slider widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-slider-1';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Prelements Blog Slider widget belongs to.
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
     * Register Prelements Blog Slider widget controls.
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
            'latest_blog_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'defaultlayout',              
                'options' => [
                    'defaultlayout' => 'Default',
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',
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
                    'transparent' => esc_html__( 'Transparent', 'prelements' ),
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
            'pre_blog_posts_offset',
            [
                'label'     => esc_html__( 'Offset', 'prelements' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'max'       => 20,
                'default'   => 0,
            ]
        );
        $this->add_control(
            'pre_posts_most_view',
            [
                'label'   => esc_html__( 'Most View', 'prelements' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''                          => esc_html__( 'Default', 'prelements' ),
                    'bulldog_post_views_count'  => esc_html__( 'Most View', 'prelements' ),
                ],
                'default' => '',
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
            'per_page',
            [
                'label' => esc_html__( 'Item Limit', 'prelements' ),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( '6', 'prelements' ),
                'condition' => [ 'pre_blog_posts_is_manual_selection!' => 'yes' ], 
            ]
        );
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'min-height: {{SIZE}}{{UNIT}};',
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
                    'default' => esc_html__( 'Default', 'prelements' ),
                    'left' => esc_html__( 'Left', 'prelements' ),
                    'right' => esc_html__( 'Right', 'prelements' ),
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],             
            ]
        );
        $this->add_control(
            'image_position',
            [
                'label' => esc_html__( 'Position Relative', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'position_relative' => esc_html__( 'Relative', 'rsaddon' ),
                ],
                'condition' => [
                    'blog_image_show_hide' => 'yes',
                ],             
            ]
        );
        $this->add_control(
            'blog_thumbnail_align',
            [
                'label' => esc_html__( 'Align Content', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'prelements' ),
                    'center' => esc_html__( 'Center', 'prelements' ),
                ],
                'condition' => [
                    'blog_thumbnail' => ['left', 'right'],
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
                'label' => esc_html__( 'Meta Settings', 'prelements' ),
                'condition'=>[
                    'latest_blog_slider_style'=> ['defaultlayout','style2'],
                ]
            ]
        );
        $this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Show Meta', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        );
        $this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Show Category', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
                ]                
            ]
        );
        $this->add_control(
            'blog_commetns_count_hide',
            [
                'label' => esc_html__( 'Show Comments Count', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'textdomain' ),
                'label_off' => esc_html__( 'Hide', 'textdomain' ),
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    'latest_blog_slider_style'=>'defaultlayout',
                ]
            ]
        );
        $this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Show Author Image', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],    
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'author_meta' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
                ]            
            ]
        );
        $this->add_control(
            'author_icon',
            [
                'label' => __( 'Author Icon', 'prelements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fi fi-rr-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'author_meta' => 'yes',
                    'blog_avatar_show_hide!' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
                ]
            ]
        );

        $this->add_control(
            'show_category_icon',
            [
                'label' => __( 'Category', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => 'no',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
                ]
            ]
        );
        $this->add_control(
            'category_icon',
            [
                'label' => __( 'Category Icon', 'prelements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fi fi-rr-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'show_category_icon' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
            'reverse_meta',
            [
                'label' => __( 'Meta Reverse (Horizontal)', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => '',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    'latest_blog_slider_style'=>'defaultlayout',
                ]
            ]
        );
        $this->add_control(
            'meta_equal_space',
            [
                'label' => __( 'Meta Equal Spacing', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'prelements' ),
                'label_off' => __( 'Hide', 'prelements' ),
                'default' => '',
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    'latest_blog_slider_style'=>'defaultlayout',
                ],            
            ]
        );
        $this->add_control(
            'author_meta_position',
            [
                'label' => esc_html__( 'Author Position', 'prelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Default', 'prelements' ),
                    'style2' => esc_html__( 'Top', 'prelements' ),
                ], 
                'condition' => [
                    'blog_meta_show_hide' => 'yes',
                    'latest_blog_slider_style'=>'defaultlayout',
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
                    'latest_blog_slider_style'=>'defaultlayout',
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
                'condition' => [
                    'latest_blog_slider_style'=>'defaultlayout',
                ],            
            ]
        );
        $this->end_controls_section();


        //Content Settings Here
        $this->start_controls_section(
            '_content_settings',
            [
                'label' => esc_html__( 'Description Settings', 'prelements' ),
            ]
        );  

        $this->add_control(
            'blog_content_show_hide',
            [
                'label' => esc_html__( 'Show Description', 'prelements' ),
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
                'label' => esc_html__( 'Description Limit', 'prelements' ),
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
                'label' => esc_html__( 'Button Settings', 'prelements' ),
            ]
        );

        $this->add_control(
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'Show', 'prelements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'label_on' => esc_html__( 'Show', 'prelements' ),
                    'label_off' => esc_html__( 'Hide', 'prelements' ),
                ],                
            ]
        );

        $this->add_control(
            'blog_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'prelements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
                'placeholder' => esc_html__( 'Button Text', 'prelements' ),
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
                'label' => esc_html__( 'Svg Icon Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-btn svg' => 'width: {{SIZE}}{{UNIT}}; display:inline-block;',
                    '{{WRAPPER}} .blog-btn svg' => 'height: {{SIZE}}{{UNIT}};',
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
                   '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn.icon-before svg' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
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
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_icon!' => '',
                ]
            ]
        );
        $this->add_control(
            'btn_alignment_comments_notification',
            [
                'label' => esc_html__( 'It is working only when comments are open', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'blog_commetns_count_hide' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'btn_alignment_comments_open',
            [
                'label' => esc_html__( 'Button Alignment', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'rsaddon' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'display:flex; align-items:center; justify-content: {{VALUE}};',
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'prelements' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item',
                
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
            '_blog__spacing',
            [
                'label' => esc_html__( 'Blog Item Spacing', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
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
        
        $this->add_responsive_control(
            'default_blog_content_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
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
            'default_blog_content_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_item_border_radiuss',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .blog-inner-wrap .pre-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'default_blog_full_border',
                'selector' => '{{WRAPPER}} .blog-inner-wrap',
            ]
        );

        $this->add_control(
			'blog_shodow_heading',
			[
				'label' => esc_html__( 'Content Shadow', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_content_box_shadow',
                'label' => esc_html__( 'Content Shadow', 'prelements' ),
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a,{{WRAPPER}} .prelements-blog-grid .pre-cat-list a' => 'background: {{VALUE}};',

                ],               
            ]
        );

        $this->add_control(
            'blog_cat_color',
            [
                'label' => esc_html__( 'Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a' => 'color: {{VALUE}};',

                ],               
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cate_typography',
                'label' => esc_html__( 'Typography', 'prelements' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a',
            ]
        );

        $this->add_responsive_control(
            'cats_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a, {{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-cat-list a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list' => 'left: {{SIZE}}{{UNIT}};',                   
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list' => 'top: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_cate_style' => 'style1',
                ]
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'thumnail_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style2 .pre-blog-item.style2 .blog-inner-wrap .pre-image-wrap:before',
                'condition' => [
                    'latest_blog_slider_style' => 'style2',
                ],
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'blog_meta_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta-slider i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta-slider svg' => 'fill: {{VALUE}};',
                ],                
            ]
        );        
        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__( 'Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta-slider' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta-slider a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-meta-slider svg' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'blog_author_hover_text_color',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pre-blog-item .pre-blog-meta-slider a:Hover' => 'color: {{VALUE}};',
                ],
                'condition'=>[
                    'latest_blog_slider_style!'=>'style1',
                ],             
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_meta_bg_color',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta-slider',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.pre-blog-meta-style2 .pre-image-wrap .pre-blog-meta-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ],
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta-slider' => 'left: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]  
            ]
        );
        $this->add_responsive_control(
            'blog_top_date_position',
            [
                'label' => esc_html__( 'Date Position (Top/Bottom)', 'prelements' ),
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
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-blog-meta-slider' => 'bottom: {{SIZE}}{{UNIT}};',                   
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]  
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
                '{{WRAPPER}} .prelements-blog-grid .pre-blog-item.pre-blog-meta-style2 .pre-image-wrap .pre-blog-meta-slider' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]  
            ]
        );
        $this->add_responsive_control(
            'icons_margin',
            [
                'label' => esc_html__( 'Icon Margin (Only Use Icon)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-meta-slider,{{WRAPPER}} .prelements-blog-grid .pre-cat-list a',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author__typography',
                'label' => esc_html__( 'Author Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a',
                'condition'=>[
                    'latest_blog_slider_style'=>'style1',
                ],

            ]
        );
        $this->add_control(
            'author__meta_border_radius',
            [
                'label' => esc_html__( 'Author Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                 'condition'=>[
                    'latest_blog_slider_style'=>'style1',
                ],
            ]
        );
        $this->add_control(
            'blog_author___text_color',
            [
                'label' => esc_html__( 'Author Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-admin-top-position' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-admin-top-position .pre-admin:before' => 'background: {{VALUE}};',
                ],
                'condition'=>[
                    'latest_blog_slider_style!'=>'style1',
                ],             
            ]
        );
        $this->add_control(
            'blog_author___text_color_hover',
            [
                'label' => esc_html__( 'Author Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-admin-top-position:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-admin-top-position:hover .pre-admin:before' => 'background: {{VALUE}};',
                ],
                'condition'=>[
                    'latest_blog_slider_style!'=>'style1',
                ],             
            ]
        );
        $this->add_responsive_control(
            'author_image_width',
            [
                'label' => esc_html__( 'Author Image Width', 'rsaddon' ),
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
        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => esc_html__( 'Meta Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'meta_padding',
            [
                'label' => esc_html__( 'Meta Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider,
                    {{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-blog-meta-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'meta_background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => 
                '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider, 
                {{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-blog-meta-slider,
                {{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a',
            ]
        );
        $this->add_control(
			'meta_display_inline',
			[
				'label' => esc_html__( 'Display Inline', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'rsaddon' ),
					'inline' => esc_html__( 'Inline', 'rsaddon' ),
					'inline' => esc_html__( 'Block', 'rsaddon' ),
					'inline-block'  => esc_html__( 'Inline Block', 'rsaddon' ),
				],
				'selectors' => [
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider' => 'display: {{VALUE}};',
				],
			]
		);
        $this->add_control(
			'meta_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta-slider,{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-blog-meta-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comments_typo',
                'label' => esc_html__( 'Comments Typography', 'rsaddon' ),
                'selector' => 
                    '{{WRAPPER}} .blog-btn-part .comments-wrapper span',
                'condition' =>[
                    'blog_commetns_count_hide' =>'yes',
                ],
            ]
        );
        $this->add_control(
            'comments_color',
            [
                'label' => esc_html__( 'Comments Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-btn-part .comments-wrapper span.comments-count' => 'color: {{VALUE}};',
                ],
                'condition' =>[
                    'blog_commetns_count_hide' =>'yes',
                ],            
            ]
        );
        $this->add_control(
            'comments_icon_color',
            [
                'label' => esc_html__( 'Comments Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-btn-part .comments-wrapper span.comments-icon svg path' => 'fill: {{VALUE}};',
                ],
                'condition' =>[
                    'blog_commetns_count_hide' =>'yes',
                ],             
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

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_title_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a:hover',
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
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .blog-inner-wrap .pre-blog-content',
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
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'prelements' ),
                'selector' => 
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content p.pre-content',
            ]
        );
        $this->add_responsive_control(
            'blog_content_padding',
            [
                'label' => esc_html__( 'Padding', 'prelements' ),
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
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content p.pre-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_area_border',
                'selector' => '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part',
            ]
        );
        $this->add_responsive_control(
            'btn_area_padding',
            [
                'label' => esc_html__( 'Button Area Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-blog-grid .pre-blog-item .pre-blog-content .blog-btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_btn_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn',
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
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg' => 'path: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover .btn-txt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'blog_btn_hover_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pre-blog-item .pre-blog-content .blog-btn:hover',
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

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        //start slider settings
        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => esc_html__( 'Slider Settings', 'prelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_responsive_control(
            'blog_left_right_spacing',
            [
                'label' => esc_html__( 'Item Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                '{{WRAPPER}} .prelements-addon-slider .blog-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_left_right_margin',
            [
                'label' => esc_html__( 'Item Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                '{{WRAPPER}} .prelements-blog-grid .pre-blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'prelements' ), 
                    '2' => esc_html__( '2 Column', 'prelements' ),
                    '3' => esc_html__( '3 Column', 'prelements' ),
                    '4' => esc_html__( '4 Column', 'prelements' ),
                    '6' => esc_html__( '6 Column', 'prelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Desktops > 991px', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'prelements' ), 
                    '2' => esc_html__( '2 Column', 'prelements' ),
                    '3' => esc_html__( '3 Column', 'prelements' ),
                    '4' => esc_html__( '4 Column', 'prelements' ),
                    '6' => esc_html__( '6 Column', 'prelements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'prelements' ), 
                    '2' => esc_html__( '2 Column', 'prelements' ),
                    '3' => esc_html__( '3 Column', 'prelements' ),
                    '4' => esc_html__( '4 Column', 'prelements' ),
                    '6' => esc_html__( '6 Column', 'prelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'prelements' ), 
                    '2' => esc_html__( '2 Column', 'prelements' ),
                    '3' => esc_html__( '3 Column', 'prelements' ),
                    '4' => esc_html__( '4 Column', 'prelements' ),
                    '6' => esc_html__( '6 Column', 'prelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'prelements' ),
                    '2' => esc_html__( '2 Item', 'prelements' ),
                    '3' => esc_html__( '3 Item', 'prelements' ),
                    '4' => esc_html__( '4 Item', 'prelements' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'prelements' ),
                    'false' => esc_html__( 'Disable', 'prelements' ),              
                ],
                'separator' => 'before',             
            ]
        );
        $this->add_control(
            'dots_bg',
            [
                'label' => esc_html__( 'Background', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-dots li button' => 'background: {{VALUE}};',],
                'condition' => [
                    'slider_dots' => 'true'
                ],
            ]
        );
        $this->add_control(
            'dots_bg_active',
            [
                'label' => esc_html__( 'Background Active', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-dots li:hover button, {{WRAPPER}} .prelements-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',],
                'condition' => [
                    'slider_dots' => 'true'
                ],
            ]
        );
        $this->add_responsive_control(
            'navigation_dots_normal_width',
            [
                'label' => esc_html__( 'Dots Normal Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'navigation_dots_active_hover_width',
            [
                'label' => esc_html__( 'Dots Active/Hover Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-addon-slider .slick-dots li:hover button,{{WRAPPER}} .prelements-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'navigation_dots_height',
            [
                'label' => esc_html__( 'Dots Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-addon-slider .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'dots_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .prelements-addon-slider .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'left_position',
            [
                'label'      => esc_html__( 'Left Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'bottom_position',
            [
                'label'      => esc_html__( 'Bottom Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_dots' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'dots_align',
            [
                'label' => esc_html__( 'Dots Alignment', 'prelements' ),
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
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}}'
                ],
            ]
        );
        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'prelements' ),
                    'false' => esc_html__( 'Disable', 'prelements' ),              
                ],
                'separator' => 'before',                            
            ]            
        );
        $this->add_control( 'btn_border_gradiant', 
        [
			'label' => esc_html__( 'Gradiant Enable', 'rsaddon' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'btn_border_gradiant_enable' => esc_html__( 'Enable', 'rsaddon' ),
				'' => esc_html__( 'Disable', 'rs-addon' ),
			],
            'condition' => [
                'slider_nav' => 'true'
            ],
		] );
        $this->start_controls_tabs( '_tabs_global' );
        // Normal Start
        $this->start_controls_tab(
            'arrow_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'arrow_bg',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-next, {{WRAPPER}} .prelements-addon-slider .slick-prev, {{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:after' => 'background: {{VALUE}};',],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_control(
            'arrow_icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-prev:before, {{WRAPPER}} .prelements-addon-slider .slick-next:before' => 'color: {{VALUE}};',],

                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_control(
			'gradiant_icon_heading',
			[
				'label' => esc_html__( 'Gradiant Icon Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'gradiant_icon_color',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:before',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_icon_border_r',
                'selector' => '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev',
            ]
        );
        $this->add_control(
			'gradiant_border_heading',
			[
				'label' => esc_html__( 'Gradiant Border Color', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'gradiant_border',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow',
                'condition' => [
                    'btn_border_gradiant' => 'btn_border_gradiant_enable'
                ],
			]
		);
        $this->end_controls_tab(); // Normal End 
                
            // Hover Start
            $this->start_controls_tab(
                'arrow_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
            $this->add_control(
                'arrow_bg_hover',
                [
                    'label' => esc_html__( 'Background', 'prelements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-next:hover, {{WRAPPER}} .prelements-addon-slider .slick-prev:hover, {{WRAPPER}} .prelements-addon-slider .slick-next:hover:before' => 'background: {{VALUE}};',],
                    'condition' => [
                        'slider_nav' => 'true'
                    ],
                ]
            );
            $this->add_control(
                'gradiant_bg_hover_heading',
                [
                    'label' => esc_html__( 'Gradiant Hover Background', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'arrow_gradiant_bg_hover',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:hover::after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_control(
                'gradiant_icon_hover_heading',
                [
                    'label' => esc_html__( 'Gradiant Icon Hover Color', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'icon_hover_gradiant_color',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .prelements-unique-slider.btn_border_gradiant_enable .slick-arrow:hover::before',
                    'condition' => [
                        'btn_border_gradiant' => 'btn_border_gradiant_enable'
                    ],
                ]
            );
            $this->add_control(
                'arrow_icon_color_hover',
                [
                    'label' => esc_html__( 'Color', 'prelements' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => ['{{WRAPPER}} .prelements-addon-slider .slick-prev:hover:before, {{WRAPPER}} .prelements-addon-slider .slick-next:hover:before' => 'color: {{VALUE}};',],

                    'condition' => [
                        'slider_nav' => 'true'
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'arrow_icon_border_r_hover',
                    'selector' => '{{WRAPPER}} .slick-next:hover, {{WRAPPER}} .slick-prev:hover',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'arrow_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                     '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; width: auto; height: auto;',
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .slick-next, {{WRAPPER}} .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
            ]
        );

        $this->add_responsive_control(
            'left_position_arrow',
            [
                'label'      => esc_html__( 'Prev Arrow Position (X)', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bottom_position_arrow',
            [
                'label'      => esc_html__( 'Prev Arrow Position (Y)', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_position_arrow_next',
            [
                'label'      => esc_html__( 'Next Arrow Position (X)', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bottom_position_arrow_next',
            [
                'label'      => esc_html__( 'Next Arrow Position (Y)', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'slider_nav' => 'true'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'prelements' ),
                    'false' => esc_html__( 'Disable', 'prelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'prelements' ),
                    '2000' => esc_html__( '2 Seconds', 'prelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'prelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'prelements' ), 
                    '5000' => esc_html__( '5 Seconds', 'prelements' ), 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'prelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'prelements' ),
                    'false' => esc_html__( 'Disable', 'prelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'prelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'prelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'prelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'prelements' ), 
                    '2000' => esc_html__( '2 Seconds', 'prelements' ), 
                    '1000' => esc_html__( '1 Seconds', 'prelements' ),     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'prelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'prelements' ),
                    'false' => esc_html__( 'Disable', 'prelements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->end_controls_section(); 

        //end slider settings   
    }

    /**
     * Render Prelements Blog Slider widget output on the frontend.
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
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];

         if ( is_rtl() ):
          $rtl= 'true';
       else:
          $rtl= 'false';
       endif;


        $show_category_icon   = $settings['show_category_icon'];
        $category_icon   = $settings['category_icon'];
       
        $unique = rand(100,31120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');
        $grayscale = $settings['blog_image_show_grayscale'];
        $no_grayscale = !empty($grayscale) ? 'grayscale' : 'no-grayscale'
        ?>
        <style>
         .slick-dotted.slick-slider{
            margin-bottom:0 !important;
        }
        @media only screen and (max-width: 767px) {
          .prelements-unique-slider .slick-dots{
            display: none !important;

            }
        }
        
        </style>
            <div class="prelements-unique-slider prelements-blog-grid <?php echo esc_html($settings['image_position']); ?> blog-grid <?php echo esc_attr( $no_grayscale);?> <?php echo esc_html($settings['btn_border_gradiant']); ?> <?php echo esc_html($settings['latest_blog_slider_style']);?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">

            <?php if('defaultlayout' !== $settings['latest_blog_slider_style']){ 
                ?>
                <div id="prelements-slick-slider-<?php echo esc_attr($unique); ?>" class="prelements-addon-slider">
                    <?php 
                        if('style1' == $settings['latest_blog_slider_style']){
                            include plugin_dir_path(__FILE__)."/style1.php";
                        }
                        elseif('style2' == $settings['latest_blog_slider_style']){ 
                            include plugin_dir_path(__FILE__)."/style2.php";
                        }
                    ?>
                
                </div>
            <?php }?>


            <!-- Default Old Style -->
            <?php if('defaultlayout' == $settings['latest_blog_slider_style']){ ?> 
                <div id="prelements-slick-slider-<?php echo esc_attr($unique); ?>" class="prelements-addon-slider">
                    
                    <?php                        
                        $cat = $settings['category'];
                        $select = $settings['select_posts'];
                        
                        global  $paged;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        if(empty($cat)){
                            $prelements_query = new wp_Query(array(
                                'post_type'         => 'post',                                
                                'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
                                'posts_per_page'    => $settings['per_page'],
                                'offset'            => $settings['pre_blog_posts_offset'],
                                'meta_key'          => $settings['pre_posts_most_view'],
                                'paged'             => $paged,
                                'post__in'          => $select,  
                                'meta_query' => array(
                                    array(
                                        'key'     => 'editor_post',        
                                        'compare' => 'NOT EXISTS'
                                    ),
                                ),                
                            ));   
                        }   
                        else{
                            $prelements_query = new wp_Query(array(
                                    'post_type'         => 'post',
                                    'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
                                    'posts_per_page'    => $settings['per_page'],
                                    'offset'            => $settings['pre_blog_posts_offset'],
                                    'meta_key'          => $settings['pre_posts_most_view'],
                                    'paged'             => $paged,
                                    'post__in'          => $select,
                                    'meta_query' => array(
                                        array(
                                            'key'     => 'editor_post',        
                                            'compare' => 'NOT EXISTS'
                                        ),
                                    ),
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field'    => 'slug', 
                                            'terms'    => $cat 
                                        ),
                                    )
                            ));   
                        }                      

                        
                        while($prelements_query->have_posts()): $prelements_query->the_post(); 

                            $full_date       = get_the_date('M j, Y');
                            $blog_date       = get_the_date('M j, Y');
                            $blog_only_date  = get_the_date('j');
                            $blog_only_month = get_the_date('M');
                            $post_admin      = get_the_author();

                            
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
                        
                        
                        <div class="pre-blog-item  <?php echo esc_html($settings['blog_content_postion_style']);?> pre-blog-meta-<?php echo esc_html($settings['blog_meta_style']);?> <?php echo esc_html($settings['blog_category_style']);?>">
                            <div class="blog-inner-wrap pre-thum-<?php echo esc_html($settings['blog_thumbnail']);?> pre-meta-<?php echo esc_html($settings['blog_meta_alignment']);?> rs__<?php echo esc_html($settings['blog_thumbnail_align']);?> eql-space-<?php echo esc_html($settings['meta_equal_space']);?>">
                                <div class="pre-image-wrap">
                                    <?php if ( 'yes' === $settings['blog_image_show_hide'] ){ ?>
                                        <a class="pre-pointer-events" href="<?php the_permalink();?>">
                                            <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                                        </a>
                                    <?php } ?>                                       
                                    <?php if ( 'yes' === $settings['blog_meta_show_hide'] ){ ?>
                                        <?php if ( 'yes' === $settings['author_meta'] ){ ?>
                                            <?php if(!empty($post_admin)){ ?>
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="pre-admin-top-position">
                                                <span class="pre-admin">
                                                    <?php if ( 'yes' === $settings['blog_avatar_show_hide'] ){ ?>
                                                    
                                                        <em class="pre-avatar-image"><?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?></em>
                                                    
                                                    <?php } else {
                                                        if ( $settings['author_icon'] ):
                                                            Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] );
                                                        endif; 
                                                    } ?>
                                                <?php echo esc_html($post_admin);?></span>
                                            </a>
                                            <?php } ?>
                                        <?php } 

                                    } ?>                                          
                                    <?php if ( 'yes' === $settings['blog_cat_show_hide'] ){ ?>
                                        <?php if(($settings['blog_cate_style'] == 'style1') ){ ?>
                                            <div class="pre-cat-list">
                                                <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>
                                            </div>
                                        <?php } ?>
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
                                                <div class="pre-blog-meta-slider pre-reverse-meta">                                                      
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
                                                            <?php 
                                                           echo esc_html($post_admin);?></span>
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
                                                <div class="pre-blog-meta-slider">
                                                    <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                        <?php if(!empty($full_date)){ ?>
                                                            <span class="pre-date">
                                                                <?php if ( $settings['date_icon'] ):
                                                                    Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                endif; ?> 
                                                                <?php echo esc_html($full_date);?></span>
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
                                                                <?php echo esc_html($post_admin);?></span>
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
                                                <div class="pre-blog-meta-slider pre-reverse-meta">                                                      
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
                                                                <?php echo esc_html($post_admin);?></span>
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
                                                <div class="pre-blog-meta-slider">
                                                    <?php if ( 'yes' === $settings['date_meta'] ){ ?>
                                                        <?php if(!empty($full_date)){ ?>
                                                            <span class="pre-date">
                                                                <?php if ( $settings['date_icon'] ):
                                                                    Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] );
                                                                endif; ?> 
                                                                <?php echo esc_html($full_date);?> </span> -
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <?php if('style1' == $settings['author_meta_position']) { ?>
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
                                                            <?php echo esc_html($post_admin);?></span>
                                                        </a>
                                                        <?php } ?>
                                                    <?php } } ?>

                                                    <?php if ( 'yes' === $settings['blog_cat_show_hide'] ){ ?>
                                                        <?php if(($settings['blog_cate_style'] == 'style2') ){ ?>
                                                            <span class="pre-cat-list">
                                                                <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>
                                                            </span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                    <?php } } ?>
                                                                            
                                    <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                                        <h3 class="pre-post-title 22"><a class="pre-pointer-events" href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $limits, '' ); ?></a></h3>                                        
                                    <?php } ?>

                                <?php } ?>

                                <!-- End if Reverse Meta Vertical -->

                                   

                                    <?php if ( 'yes' === $settings['blog_content_show_hide'] ){ ?>
                                        <p class="pre-content"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                                    <?php } ?>

                                    
                                    <?php if ( 'yes' === $settings['blog_readmore_show_hide'] ){ ?>
                                        <?php if(!empty($settings['blog_btn_text'])){ ?>
                                            <div class="blog-btn-part">
                                                <?php 
                                                    if ( 'yes' === $settings['blog_commetns_count_hide'] ) :
                                                        ?>
                                                        <div class="comments-wrapper">
                                                            <span class="comments-icon"><svg width="14" height="14" viewBox="0 0 14 14"  xmlns="http://www.w3.org/2000/svg"><path d="M2.97 8.83317L0 11.1665V0.833171C0 0.65636 0.0702379 0.48679 0.195262 0.361766C0.320286 0.236742 0.489856 0.166504 0.666667 0.166504H10.6667C10.8435 0.166504 11.013 0.236742 11.1381 0.361766C11.2631 0.48679 11.3333 0.65636 11.3333 0.833171V8.83317H2.97ZM2.50867 7.49984H10V1.49984H1.33333V8.42317L2.50867 7.49984ZM4.66667 10.1665H11.4913L12.6667 11.0898V4.1665H13.3333C13.5101 4.1665 13.6797 4.23674 13.8047 4.36177C13.9298 4.48679 14 4.65636 14 4.83317V13.8332L11.03 11.4998H5.33333C5.15652 11.4998 4.98695 11.4296 4.86193 11.3046C4.7369 11.1796 4.66667 11.01 4.66667 10.8332V10.1665Z" fill="#F79C53"/></svg></span>
                                                            <span class="comments-count"><?php echo get_comments_number( '0', '1', '%' ).' ';  _e('Comments') ?></span>
                                                        </div>
                                                        <?php
                                                    endif;
                                                ?>

                                                
                                                <?php  
                                                    $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                ?>
                                                    <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                        <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>          
                                                        <?php 
                                                            if(!empty($settings['blog_btn_icon'])) : 
                                                                Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
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
                                                        <span class="btn-txt"><?php echo esc_html__('Read More', 'prelements'); ?></span>
                                                        <?php 
                                                            if(!empty($settings['blog_btn_icon'])) : 
                                                                Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                                            endif; 
                                                        ?>
                                                    </a>

                                            </div>
                                      <?php  }
                                    } ?>

                                </div>
                            </div>
                        </div>

                        <?php
                        endwhile;
                        wp_reset_query(); 
                        ?>

                </div>
            <?php }?> 
            <!-- End Default Old Style -->
                <div class="prelements-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div> 
            <script type="text/javascript"> 
            jQuery(document).ready(function(){
                jQuery( '.prelements-addon-slider' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.prelements-unique-slider').find('.prelements-slider-conf').attr('data-conf'));               
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
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: parseInt(slider_conf.col_md),
                        }
                    }, 
                    {
                        breakpoint: 881,
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
}