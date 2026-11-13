<?php
/**
 * Tab widget class
 *
 */
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;


defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Advance_Tab_Widget extends \Elementor\Widget_Base {
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
        return 'rs-tab-advanced';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RS Advance Tab', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-tabs-1';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'tab', 'vertical', 'icon', 'horizental' ];
    }

	protected function register_controls() {
        $category_dropdown[0] = 'Select Template';
        $best_wp = new wp_Query(array(
        'post_type'      => 'rselements_pro',
        'posts_per_page' => -1
                                         
        ));  

         while($best_wp->have_posts()): $best_wp->the_post(); 

            $title = get_the_title();
            $id = get_the_ID();
            $category_dropdown[$id] = $title;

         endwhile; 
         wp_reset_query();  
      

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'rsaddon' ),
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

        $repeater = new Repeater();
        $repeater->add_control(
            	'item_style',
            	[
            		'label' => esc_html__( 'Tab Style', 'rsaddon' ),
            		'type' => \Elementor\Controls_Manager::SELECT,
            		'default' => 'style_1',
            		'options' => [
            			'style_1' => esc_html__( 'Style 1', 'rsaddon' ),
            			'style_2' => esc_html__( 'Style 2', 'rsaddon' ),
            		],
            	]
		);
        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title & Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Title', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'icon_type_enroll',
            [
                'label' => esc_html__( 'Selct Icon Type', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'rsaddon' ),
                    'svg' => esc_html__( 'Svg', 'rsaddon' ),
                    'img' => esc_html__( 'Img', 'rsaddon' ),
                ],
            ]
        );

        $repeater->add_control(
            'tab_icon',
            [
                'label'       => esc_html__( 'Title Icon', 'rsaddon' ),
                'label_block' => true,
                'type'        => Controls_Manager::ICON,
                'options'     => rsaddon_pro_get_icons(),
                'condition'   => [
                    'icon_type_enroll' => 'normal'
                ]
            ]
        );

        $repeater->add_control(
		    'tab_icon_svg',
		    [
		        'label' => __( 'Tab Menu Svg Icons', 'prelements' ),
		        'type' => Controls_Manager::ICONS,
		        'default' => [
		            'value' => '',
		            'library' => '',
		        ],
				'condition' => [
					'icon_type_enroll' => 'svg'
				],
		    ]
		);
        $repeater->add_control(
            'tab_icon__img',
            [
                'label'       => esc_html__( 'Tab Menu Img Icons', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'icon_type_enroll' => 'img'
                ],
            ]
        );
        $repeater->add_responsive_control(
            'tab_menu_img_icon__height',
            [
                'label' => esc_html__( 'Name Image Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link  img' => 'height: {{SIZE}}{{UNIT}} !important',
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link .menu-first-item img, {{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link .menu-second-icon img ' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
            ]
        );
        $repeater->add_control(
            'tab_icon_two_img',
            [
                'label'       => esc_html__( 'Tab Menu Img Second Icons', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'icon_type_enroll' => 'img',
                    'item_style'       => 'style_1'
                ],
            ]
        );
        $repeater->add_responsive_control(
            'tab_menu__second_icon_img_height',
            [
                'label' => esc_html__( 'Name Image Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link .menu-second-icon img ' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
                'condition' => [
                    'icon_type_enroll' => 'img',
                    'item_style'       => 'style_1'
                ],
            ]
        );
        


        $repeater->add_control(
            'selected_image_title',
            [
                'label'       => esc_html__( 'Title Image (Ex:Content Title)', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
      

        $repeater->add_control(
            'tab_content_title',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Title', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content_title__color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content--left-area h2' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tab_content_title!' => '',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_content_title_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .content--left-area h2',
                'separator'   => 'before',
                'condition' => [
                    'tab_content_title!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'       => esc_html__( 'Content', 'rsaddon' ),
                'default'     => esc_html__( 'Tab Content', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Content', 'rsaddon' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'tab_content_btn',
            [
                'label'       => esc_html__( 'Button', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content_btn_link',
            [
                'label'       => esc_html__( 'Button Link', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Button Link', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content_btn2',
            [
                'label'       => esc_html__( 'Button 2', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Button 2 Text', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content_btn_link2',
            [
                'label'       => esc_html__( 'Button Link 2', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Button Link 2', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'selected_imagetab',
            [
                'label'       => esc_html__( 'Content Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label'       => esc_html__( 'Service Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => ['item_style' => 'style_2']
            ]
        );

        $repeater->add_control(
            'service_esc',
            [
                'label'       => esc_html__( 'Service Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
               'condition' => ['item_style' => 'style_2']
            ]
        );

        $repeater->add_control(
            'service_title_2',
            [
                'label'       => esc_html__( 'Service Title 2', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
               'condition' => ['item_style' => 'style_2']
            ]
        );

        $repeater->add_control(
            'service_esc_2',
            [
                'label'       => esc_html__( 'Service Description 2', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'condition' => ['item_style' => 'style_2']
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs Items', 'rsaddon' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__( 'Tab #1', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tab #2', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],

                    [
                        'tab_title'   => esc_html__( 'Tab #3', 'rsaddon' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__( 'View', 'rsaddon' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );


        $this->add_control(
            'tabs_item_width',
            [
                'label' => esc_html__( 'Tab Menu Item Full', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'full_tab_item',
                'options' => [
                    'full_tab_item' => esc_html__( 'Yes', 'rsaddon' ),
                    'no_item_menu' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

         $this->add_responsive_control(
            'menu_item_alignment',
            [
                'label' => esc_html__( 'Menu Alignment', 'rsaddon' ),
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
                    '{{WRAPPER}} .rstab-main.no_item_menu' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'tabs_item_width' => 'no_item_menu',
                ],
            ]
        );

        $this->add_responsive_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    '' => esc_html__( 'Default', 'rsaddon' ),
                    'horizontal' => esc_html__( 'Horizontal', 'rsaddon' ),
                    'vertical' => esc_html__( 'Vertical', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'full_box_flex_direction',
            [
                'label' => esc_html__( 'Flex Direction', 'rsaddon' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'type_vertical_align',
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
					'type' => 'vertical',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.vertical' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //start title styling

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__( 'Top Menu', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'all_menu_wrapper_control',
			[
				'label' => esc_html__( 'Menu Wrapper Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
					'type' => 'horizontal',
				],
			]
		);

        $this->add_responsive_control(
            'all_menu_wrapper_view_style',
            [
                'label' => esc_html__( 'View Style (Inline / Block)', 'rsaddon' ),
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
                'condition' => [
					'type' => 'horizontal',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_v_align',
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
				'default' => 'start',
				'condition' => [
					'all_menu_wrapper_view_style' => 'flex',
                    'type' => 'horizontal',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_flex_direction',
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
					'all_menu_wrapper_view_style' => 'flex',
                    'type' => 'horizontal',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_wrapper_h_align',
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

                ],
				'default' => 'flex-start',
				'condition' => [
					'all_menu_wrapper_view_style' => 'flex',
					'all_menu_wrapper_flex_direction' => ['row', 'row-reverse'],
                    'type' => 'horizontal',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'type' => 'horizontal',
				],
			]
		);

        $this->add_control(
			'all_menu_border_heading',
			[
				'label' => esc_html__( 'Menu Wrapper Border', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'all_menu_border',
                'selector' => '{{WRAPPER}} .nav-tabs',              
            ]
        );
        // Menu Wrapper Settings End

        $this->add_control(
			'menu_items_settings',
			[
				'label' => esc_html__( 'Menu Items Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
					'type' => 'horizontal',
				],
                'separator' => 'before'
			]
		);
        $this->add_responsive_control(
		    'menu_item_width',
		    [
		        'label' => esc_html__( 'Menu Items Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .nav-tabs .nav-link' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'horizontal',
                ]
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link',
            ]
        );

        $this->add_responsive_control(
            'navigation_area_width',
            [
                'label' => esc_html__( 'Navigation Area Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_width',
            [
                'label' => esc_html__( 'Navigation Item Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
		    'tab_title_spacing_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'tab_title_spacing_margin',
		    [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type'  => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);   
        
        $this->add_responsive_control(
		    'tab_title_spacing_margin_last_child',
		    [
                'label' => esc_html__( 'Margin (Last Child)', 'rsaddon' ),
                'type'  => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [],
                ],
                'default' => [
                    'size' => 0,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tab_icon_bg_border',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link'                
            ]
        );

        $this->add_control(
            'tab_hover_border_color',
            [
                'label' => esc_html__( 'Hover Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover' => 'border-color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'tab_active_border_color',
            [
                'label' => esc_html__( 'Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active' => 'border-color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link'
            ]
        );

        $this->add_responsive_control(
            'tab_title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                     'space-between' => [
                        'title' => esc_html__( 'Spa', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs' => 'align-items: {{VALUE}}',
                ]
            ]
        );
         $this->add_responsive_control(
            'align_justify',
            [
                'label' => esc_html__( 'Justify  Alignment', 'rsaddon' ),
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
                     'space-between' => [
                        'title' => esc_html__( 'Spa', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_bubble_position_vertical',
            [
                'label' => esc_html__( 'Bubble Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active:after' => 'top: {{SIZE}}%;',                   
                ],

                'condition' => [
                    'tab_design' => 'bubble',
                    'type' => 'vertical'
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_title_area_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_icon_text_v_align',
            [
                'label' => esc_html__( 'Icon/Text Vertical Align', 'rsaddon' ),
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
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'display: inline-flex; align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_icon_text_x_align',
            [
                'label' => esc_html__( 'Icon/Text Horizontal Align', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                     'space-between' => [
                        'title' => esc_html__( 'Space Between', 'rsaddon' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
				'default' => 'start',
				'condition' => [
					'menu_icon_text_v_align' => ['flex-start', 'center', 'flex-end'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        // Bubble Arrow Style Start
        $this->add_control(
			'tab_bottom_arrow_design_hedding',
			[
				'label' => esc_html__( 'Tab Bottom Arrow', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'type' => 'horizontal',
				],
                'separator' => 'before'
			]
		);
        $this->add_control(
            'tab_bottom_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'color: {{VALUE}};',
                ],               
            ]
        );
        $this->add_control(
            'tab_bottom_arrow_color_hover',
            [
                'label' => esc_html__( 'Arrow Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'type' => 'horizontal',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:hover:after' => 'color: {{VALUE}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'tab_bottom_arrow_design',
            [
                'label' => esc_html__( 'Arrow ( Show / Hide)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'unset' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-close',
                    ],
                ],
                'toggle' => true,
                'condition' => [
                    'type' => 'horizontal',
				],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
		    'tab_bottom_arrow_size',
		    [
		        'label' => esc_html__( 'Arrow Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'font-size: {{SIZE}}px;',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
		    ]
		);
        $this->add_responsive_control(
		    'tab_bottom_arrow_position_y',
		    [
		        'label' => esc_html__( 'Position Y (Top)', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
		    ]
		);
        $this->add_responsive_control(
		    'tab_bottom_arrow_position_x',
		    [
		        'label' => esc_html__( 'Position X (Left)', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%', 'custom' ],
				'range' => [
					'%' => [
						'min' => -150,
						'max' => 150,
					],
				],
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main.horizontal .nav-tabs .nav-link:after' => 'transform: translateX(-{{SIZE}}{{UNIT}}); left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'tab_bottom_arrow_design' => 'unset',
                    'type' => 'horizontal',
                ]
		    ]
		);
        // Bubble Arrow Style End

        // Button Icon Style Start
        $this->add_control(
			'menu_icon_settings_hedding_start',
			[
				'label' => esc_html__( 'Icon Settings', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
			]
		);
        $this->add_responsive_control(
            'menu_icon_show_hide',
            [
                'label' => esc_html__( 'Menu Icon ( Show / Hide)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'unset' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-close',
                    ],
                ],
                'default' => 'unset',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-link i, {{WRAPPER}} .nav-tabs .nav-link svg' => 'display: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'menu_icon_color',
            [
                'label' => esc_html__( 'Icon Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i',
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
			]
		);
        $this->add_responsive_control(
		    'svg_icon_size',
		    [
		        'label' => esc_html__( 'Svg Icon Size', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
		    ]
		);
        $this->add_responsive_control(
		    'menu_icon_padding',
		    [
		        'label' => esc_html__( 'Icon Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i, {{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
		    ]
		);
        $this->add_responsive_control(
		    'menu_icon_margin',
		    [
		        'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link i, {{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link svg,{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ]
		    ]
		);
        $this->add_control(
			'all_menu_inner_wrapper_control',
			[
				'label' => esc_html__( 'Menu Inner Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
					'menu_icon_show_hide' => 'unset'
				]
			]
		);
        $this->add_responsive_control(
            'all_menu_inner_wrapper_view_style',
            [
                'label' => esc_html__( 'View Style (Inline / Block)', 'rsaddon' ),
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
                'condition' => [
					'menu_icon_show_hide' => 'unset'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_v_align',
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
				'default' => 'start',
				'condition' => [
					'all_menu_inner_wrapper_view_style' => 'flex',
                    'menu_icon_show_hide' => 'unset'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_flex_direction',
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
					'all_menu_inner_wrapper_view_style' => 'flex',
                    'menu_icon_show_hide' => 'unset'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_h_align',
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

                ],
				'default' => 'start',
				'condition' => [
					'all_menu_inner_wrapper_view_style' => 'flex',
					'all_menu_inner_wrapper_flex_direction' => ['row', 'row-reverse'],
                    'menu_icon_show_hide' => 'unset'
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'all_menu_inner_wrapper_t_align',
            [
                'label' => esc_html__( 'Text Alignment', 'rsaddon' ),
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
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'all_menu__align',
            [
                'label' => esc_html__( 'Menu Alignment ( Will work if the view style is block )', 'rsaddon' ),
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
                'condition' => [
                    'all_menu_inner_wrapper_view_style!' => 'flex'
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav.nav-tabs ' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        // Button Icon Style End

        $this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->start_controls_tabs( '_tabs_title_icon' );

        $this->start_controls_tab(
            'tab_icon_bg_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'ti_menu_background_color',
            [
                'label' => esc_html__( 'Title Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link' => 'background-color: {{VALUE}};',                      
                ],
            ]
        );

        $this->add_control(
            'tmenu_background_full',
            [
                'label' => esc_html__( 'Title Area Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main' => 'background-color: {{VALUE}};',                                   
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_bg_hover_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );
        $this->add_control(
            'tab_active_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active)' => 'color: {{VALUE}};',
                ],
               
            ]
        );
        $this->add_control(
            'ti_hover_menu_background_color',
            [
                'label' => esc_html__( 'Title Hover Bg Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [ 
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active)' => 'background-color: {{VALUE}};',                                 
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_area_padding_hover',
            [
                'label' => esc_html__( 'Title Area Padding (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'menu_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active) i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active) svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'menu_img_icon_hover_color',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link:hover:not(.active) img',
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_bg_hover_tab',
            [
                'label' => esc_html__( 'Active', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link.active' => 'color: {{VALUE}};',
                ],
               
            ]
        );

        $this->add_control(
            'ti_active_menu_background_color',
            [
                'label' => esc_html__( 'Title Active Bg Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [ 
                    '{{WRAPPER}} .rstab-main .tab-menu-wrapper .nav-tabs .nav-link.active' => 'background-color: {{VALUE}};',                                 
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_area_padding_active',
            [
                'label' => esc_html__( 'Title Area Padding (Active)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'menu_icon_color_active',
            [
                'label' => esc_html__( 'Icon Color (Active)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active svg path' => 'fill: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'menu_img_icon__active_color',
                'selector' => '{{WRAPPER}} .tab-menu-wrapper .nav-tabs .nav-link.active img',
                'condition' => [
                    'menu_icon_show_hide' => 'unset'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //start content styling
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content Part Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_area_width',
            [
                'label' => esc_html__( 'Content Area Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab-content' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_horizontal_align',
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
                    '{{WRAPPER}} .content--teb-area' => 'display: {{VALUE}};',
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
				'default' => 'start',
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(


		    'text_part_width',
		    [
		        'label' => esc_html__( 'Text Part Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ '%', 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .content--left-area .desc_btn_wrapper' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
		    ]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .title' => 'color: {{VALUE}};',
                ],               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content .title',                
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',                
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_bg',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',            
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'textdomain' ),
				'selector' => '{{WRAPPER}} .rstab-main .tab-content',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_bg_border',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',               
            ]
        );


         $this->add_responsive_control(
            'tab_content_align',
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
                'separator' => 'before',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_top_gap',
            [
                'label' => esc_html__( 'Content Top Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],                
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );  

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
		    'content_wrapper_padding',
		    [
		        'label' => esc_html__( 'Content Box Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
					'type' => 'horizontal',
				]
		    ]
		);

        $this->add_responsive_control(
            'content_paddings',
            [
                'label' => esc_html__( 'Content Padding (Left Area)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tab_content_border_radius_inner',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; overflow: hidden !important;',
                ],
            ]
        );

        $this->add_control(
			'content_inner_settings',
			[
				'label' => esc_html__( 'Content Inner Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_unner_bg',
                'selector' => '{{WRAPPER}} .tab-pane',
                'separator' => 'before',            
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_inner_shadow',
				'label' => esc_html__( 'Box Shadow', 'textdomain' ),
				'selector' => '{{WRAPPER}} .tab-pane',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_bg_inner_border',
                'selector' => '{{WRAPPER}} .tab-pane',
            ]
        );

        $this->add_responsive_control(
		    'content_inner_radius',
		    [
		        'label' => esc_html__( 'Inner Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tab-pane' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden !important;',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'content_horizontal_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'display: {{VALUE}};',
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_vertical_align',
            [
                'label' => esc_html__( 'Content Vertical Align', 'rsaddon' ),
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
				'default' => 'start',
				'condition' => [
					'content_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'content_inner_padding',
		    [
		        'label' => esc_html__( 'Content Inner Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .content--left-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
        $this->add_control(
			'image_part_settings',
			[
				'label' => esc_html__( 'Side Image Part Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
            'content_image_box_margin',
            [
                'label' => esc_html__( 'Content Img Box Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_image_box_padding',
            [
                'label' => esc_html__( 'Content Img Box Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_img_b_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .image--right-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden !important;',
                ],
            ]
        );
        $this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Side Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .image--right-area img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'image_height',
		    [
		        'label' => esc_html__( 'Side Image Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .image--right-area img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
			'title_image_settings',
			[
				'label' => esc_html__( 'Title Image Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
            'title_image_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content_part_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
		    'title_image_width',
		    [
		        'label' => esc_html__( 'Title Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .content_part_image img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'title_image_height',
		    [
		        'label' => esc_html__( 'Title Image Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .content_part_image img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
			'title_part_settings',
			[
				'label' => esc_html__( 'Title Part Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
		    'title_part_width',
		    [
		        'label' => esc_html__( 'Title Part Width', 'rsaddon' ),
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
		            '{{WRAPPER}} .title' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'title_part_padding',
		    [
		        'label' => esc_html__( 'Title Part Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'title_part_margin',
		    [
		        'label' => esc_html__( 'Title Part Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'title_part_border',
		        'selector' => '{{WRAPPER}} .title',
		    ]
		);

        $this->add_control(
			'desc_btn_part_settings',
			[
				'label' => esc_html__( 'Desc/Button Part Settings', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
		    'desc_btn_part_width',
		    [
		        'label' => esc_html__( 'Desc/Button Part Width', 'rsaddon' ),
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
		            '{{WRAPPER}} .desc_btn_wrapper' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'desc_wrapper_margin',
		    [
		        'label' => esc_html__( 'Desc Margin Wrapper', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .desc_btn_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Desc Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .desc_btn_wrapper p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
		    'desc_btn_part_padding',
		    [
		        'label' => esc_html__( 'Desc/Button Part Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .desc_btn_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'desc_btn_part_margin',
		    [
		        'label' => esc_html__( 'Desc/Button Part Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .desc_btn_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'desc_btn_part_border',
		        'selector' => '{{WRAPPER}} .desc_btn_wrapper',
		    ]
		);

        $this->add_responsive_control(
            'content_box_flex_direction',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
		    'content_content_inner_padding',
		    [
		        'label' => esc_html__( 'Desc Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .content--teb-area .content--left-area .desc_btn_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

        $this->end_controls_section();

        // Content Button Style Start
        $this->start_controls_section(
            'section_content_button_style',
            [
                'label' => esc_html__( 'Content Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_control(
			'button_wrapper_heading',
			[
				'label' => esc_html__( 'Button Wrapper Settings', 'textdomain' ),
				'type' => Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
            'content_button_box_view_style',
            [
                'label' => esc_html__( 'View Style (Inline / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .content--teb-area .button-handle' => 'display: {{VALUE}}; flex-wrap: wrap;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_button_box_v_align',
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
				'default' => 'start',
				'condition' => [
					'content_button_box_view_style' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .button-handle' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_button_box_flex_direction',
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
					'content_button_box_view_style' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .button-handle' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_button_box_h_align',
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

                ],
				'default' => 'start',
				'condition' => [
					'content_button_box_view_style' => 'flex',
					'content_button_box_flex_direction' => ['row', 'row-reverse'],
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .button-handle' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .button-handle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        // Button icon
        $this->add_control(
			'button_icon_hedding',
			[
				'label' => esc_html__( 'Button Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
			]
		);
        $this->add_control(
            'button_icon_show_hide',
            [
                'label' => esc_html__( 'Icon Show / Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'button_icon_v_align',
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
                    'button_icon_show_hide' => 'yes',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a' => 'align-items: {{VALUE}}; display: inline-flex;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_content_btn_icon_typography',
                'condition' => [
                    'button_icon_show_hide' => 'yes',
                ],
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .content--teb-area .content--left-area .rs-btn a i',
            ]
        );
        $this->add_responsive_control(
            'tab_content_btn_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'button_icon_show_hide' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_content_btn_icon_margin_hover',
            [
                'label' => esc_html__( 'Margin (Hover)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'condition' => [
                    'button_icon_show_hide' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        // Button Elements Settings
        $this->add_control(
			'button_elements_heading',
			[
				'label' => esc_html__( 'Button Elements Settings', 'textdomain' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before'
			]
		);

        // Content Button First/Last
        $this->start_controls_tabs( '_content_button_first_last' );
            // First
            $this->start_controls_tab(
                'content_button_first',
                [
                    'label' => esc_html__( 'Button (1st)', 'rsaddon' ),
                ]
            );
            $this->add_responsive_control(
                'button_first_width',
                [
                    'label' => esc_html__( '1st Button Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'content_button_box_view_style' => 'flex'
                    ]
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tab_content_btn_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}}  .content--teb-area .content--left-area .rs-btn a',
                ]
            );
            $this->add_control(
                'tab_content_btn__color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn__color_hover',
                [
                    'label' => esc_html__( 'Text Color (Hover)', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn__color_bg',
                [
                    'label' => esc_html__( 'Background Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn__color_bg_hovber',
                [
                    'label' => esc_html__( 'Background Color (Hover)', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'btn_gradiant_bg_title',
                [
                    'label' => esc_html__('Button Gradiant', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'tbn_gradiant__background',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a',
                ]
            );
            $this->add_control(
                'btn_hover__gradiant_bg_title',
                [
                    'label' => esc_html__('Button Hover  Gradiant', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                ]
            );
             $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'btn_gradiant_hover__background',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'content_button_border',
                    'selector' => '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a'                
                ]
            );

            $this->add_control(
                'content_button_border_color_hover',
                [
                    'label' => esc_html__( 'Border Color Hover', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'tab_content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'tab_content_btn_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'tab_content_btn_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn_icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'button_icon_show_hide' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a i' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn_icon_color_hover',
                [
                    'label' => esc_html__( 'Icon Color (Hover)', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'button_icon_show_hide' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn a:hover i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_tab();

            // Last
            $this->start_controls_tab(
                'content_button_last',
                [
                    'label' => esc_html__( 'Button (2nd)', 'rsaddon' ),
                ]
            );
            $this->add_responsive_control(
                'button_last_width',
                [
                    'label' => esc_html__( '2nd Button Width', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'content_button_box_view_style' => 'flex'
                    ]
                ]
            );
            $this->add_control(
                'tab_content_btn__color_last',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn__color_last_hover',
                [
                    'label' => esc_html__( 'Text Color Hover', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'content_button_border_color_last',
                [
                    'label' => esc_html__( 'Border Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'content_button_border_color_hover_last',
                [
                    'label' => esc_html__( 'Border Color Hover', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn__color_bg_last',
                [
                    'label' => esc_html__( 'Bg Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_control(
                'tab_content_btn__color_bg_hover_last',
                [
                    'label' => esc_html__( 'Bg Color Hover', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn_icon_color_last',
                [
                    'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'button_icon_show_hide' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a i' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'tab_content_btn_icon_color_hover_last',
                [
                    'label' => esc_html__( 'Icon Color (Hover)', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'button_icon_show_hide' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one a:hover i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'tab_content_btn_margin_last_one',
                [
                    'label' => esc_html__( 'Margin (2nd)', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .content--teb-area .content--left-area .rs-btn.last-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        // Content Button Style End

        $this->start_controls_section(
            'section_service_style',
            [
                'label' => esc_html__( 'Service Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'service_title_color',
            [
                'label' => esc_html__( 'Service Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'service_title_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-title',
                'separator'   => 'before',
            ]
        );
        $this->add_responsive_control(
            'service_title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'service_desc_color',
            [
                'label' => esc_html__( 'Service Description Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'service_desc_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-desc',
                'separator'   => 'before',
            ]
        );
        $this->add_responsive_control(
            'service_desc_margin',
            [
                'label' => esc_html__( 'Desscription Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item .service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'service_before_background_color',
            [
                'label' => esc_html__( 'Before Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area .service-single-item:before' => 'background-color: {{VALUE}};',                      
                ],
            ]
        );

        $this->add_responsive_control(
            'service_title_padding',
            [
                'label' => esc_html__( 'Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .service-bottom-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $tabs = $this->get_settings_for_display('tabs');  
        $settings = $this->get_settings_for_display();  
        $id_int = substr( $this->get_id_int(), 0, 3 ); 

        $unique = rand(2012,3554120);
        ?>

    
    <div class="rstab-main <?php echo esc_attr($settings['type']); ?> <?php echo esc_attr($settings['tabs_item_width']); ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>"> 
        <nav class="tab-menu-wrapper">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <?php
                
                $x= 0;
                $arial_lebel = 1;
                foreach ( $tabs as $index => $item ) :
                    $x++;

                    if($x == 1){
                        $active_tab = 'active';
                    }else{
                        $active_tab = '';
                    }

                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                    $tab_img_icon    = !empty($item['tab_icon__img']['url']) ? '<img class="nor_img" src="'. $item['tab_icon__img']['url']. '" alt="'. Control_Media::get_image_alt($item['tab_icon__img']) .'" />' : '';
                    $tab_img_two_icon    = !empty($item['tab_icon_two_img']['url']) ? '<img class="nor_img" src="'. $item['tab_icon_two_img']['url']. '" alt="'. Control_Media::get_image_alt($item['tab_icon_two_img']) .'" />' : '';
                    
                    

                    $this->add_render_attribute( $tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-title', 'elementor-tab-desktop-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ] );

                    $icon = !empty($item['tab_icon']) ? '<i class="'.$item['tab_icon'].'"></i>': '';
                    
                    ?>
                <button class="nav-link <?php echo esc_attr($active_tab); ?>" id="nav-home-<?php echo esc_attr($arial_lebel);?>" data-bs-toggle="tab" data-bs-target="#tab<?php echo esc_html( $arial_lebel );?>" type="button" role="tab" aria-controls="nav-home-<?php echo esc_attr($arial_lebel);?>" aria-selected="true">
                <div class="menu-first-item">
                    <?php 
                        if(!empty($item['tab_icon_svg'])){   
                            Icons_Manager::render_icon( $item['tab_icon_svg'], [ 'aria-hidden' => 'true' ] ); 
                        } elseif(!empty($item['tab_icon__img'])){
                            echo $tab_img_icon;
                        }else {
                            echo $icon;
                        }
                    ?>
                    <?php echo esc_html($item['tab_title']); ?>
                </div>
                
                <div class="menu-second-icon">
                    <?php 
                        if(!empty($item['tab_icon_two_img'])){
                            echo $tab_img_two_icon;
                        }
                    ?>
                </div>
                    
                </button>

                <?php $arial_lebel++; endforeach; ?>   
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <?php
                $x = 0;
                $arial_lebel = 1;
                foreach ( $tabs as $index => $item ) :
                    $tab_count = $index + 1;
                    $x++;
                    if($x == 1){
                        $active_tab = 'show active';
                    }else{
                        $active_tab = '';
                    }
                    $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                    $tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

                    $titleimg_content    = !empty($item['selected_image_title']['url']) ? '<img class="nor_img" src="'. $item['selected_image_title']['url']. '" alt="'. Control_Media::get_image_alt($item['selected_image_title']) .'" />' : '';
                    $this->add_render_attribute( $tab_content_setting_key, [
                        'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
                        'data-tab' => $tab_count,
                        'role' => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ] );

                    $this->add_render_attribute( $tab_title_mobile_setting_key, [
                        'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                    ] );

                    $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' ); 
                    $selected_imagetab    = !empty($item['selected_imagetab']['url']) ? '<div class="image--right-area"><img class="nor_imgs" src="'. $item['selected_imagetab']['url']. '" alt="'. Control_Media::get_image_alt($item['selected_imagetab']) .'" /></div>' : '';   


                    ?>
                <div class="tab-pane fade <?php echo esc_attr($active_tab);?>" id="tab<?php echo esc_html($arial_lebel);?>" role="tabpanel" aria-labelledby="nav-home-<?php echo esc_attr($arial_lebel);?>">
                        

                    <?php
                        if (empty($item['selected_imagetab']['url'])) {
                            $fulls = 'full-sec';
                        } else {
                            $fulls = 'half-sec';
                        }
                        ?>
                    <div class="content--teb-area <?php echo esc_attr($fulls); ?>">
                        <?php echo $selected_imagetab; ?>

                        <div class="content--left-area">

                            <?php if(!empty($item['selected_image_title'])){?>
                                <div class="content_part_image">
                                    <?php echo $titleimg_content; ?>
                                </div>
                            <?php } ?>

                            <?php if(!empty($item['tab_content_title'])){?>
                                <div class="title"><?php echo $this->parse_text_editor( $item['tab_content_title'] ); ?></div>
                            <?php } ?>
                            <div class="desc_btn_wrapper">
                                <?php if(!empty($item['tab_content'])){?>
                                    <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                <?php } ?>
                                <div class="button-handle">
                                    <?php if(!empty($item['tab_content_btn'])){?>
                                        <div class="rs-btn first-one">
                                            <a href="<?php echo esc_url( $item['tab_content_btn_link'] ); ?>" class="rs_button">
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn'] ); ?> 
                                                <?php if('yes' == $settings['button_icon_show_hide']){ ?>
                                                    <i class="ri-arrow-right-line"></i>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($item['tab_content_btn2'])){?>
                                        <div class="rs-btn last-one">
                                            <a href="<?php echo esc_url( $item['tab_content_btn_link2'] ); ?>" class="rs_button">
                                                <?php echo $this->parse_text_editor( $item['tab_content_btn2'] ); ?> 
                                                <?php if('yes' == $settings['button_icon_show_hide']){ ?>
                                                    <i class="ri-arrow-right-line"></i>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php if($item['item_style'] == 'style_2') { ?>
                        <div class="service-bottom-area">
                            <div class="service-single-item">
                                <div class="service-title">
                                    <?php echo esc_html($item['service_title']);?> 
                                </div>
                                <div class="service-desc">
                                    <?php  echo $item['service_esc'];?> 
                                </div>
                            </div>
                            <div class="service-single-item">
                                <div class="service-title">
                                    <?php echo esc_html($item['service_title_2']);?> 
                                </div>
                                <div class="service-desc">
                                    <?php echo $item['service_esc_2'];?> 
                                </div>
                            </div>
                        </div>
                        <?php  } ?>
                    </div>
                </div>
            
            <?php $arial_lebel++; endforeach; ?>
        </div>
    </div>



   
        <?php
    }
}