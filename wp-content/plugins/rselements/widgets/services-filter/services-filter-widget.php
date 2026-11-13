<?php
/**
 * Tab widget class
 *
 */
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;


defined( 'ABSPATH' ) || die();

class Rsaddon_Services_pro_Filter_Widget extends \Elementor\Widget_Base {
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
        return 'rs-tab-service';
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
        return esc_html__( 'RS Service Filter', 'rsaddon' );
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
      
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Service Tab Area', 'rsaddon' ),
            ]
        );

        $repeater = new Repeater();

        // Service Item One
        $repeater->add_control(
            'service_item_one',
            [
                'label' => esc_html__( 'Service Item One Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'name_image',
            [
                'label'       => esc_html__( 'Tab Name Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_name_img_height',
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} img' => 'height: {{SIZE}}{{UNIT}} !important',
                ],
            ]
        );

        $repeater->add_control(
            'tab_name',
            [
                'label'       => esc_html__( 'Tab Name', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        ); 


        // Service Item Two
        $repeater->add_control(
            'service_item_two',
            [
                'label' => esc_html__( 'Service Item Two Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image2',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title2',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description2',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button2',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link2',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Three
        $repeater->add_control(
            'service_item_three',
            [
                'label' => esc_html__( 'Service Item Three Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image3',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title3',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description3',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button3',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link3',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Four
        $repeater->add_control(
            'service_item_four',
            [
                'label' => esc_html__( 'Service Item Four Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image4',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title4',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description4',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button4',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link4',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Five
        $repeater->add_control(
            'service_item_five',
            [
                'label' => esc_html__( 'Service Item Five Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image5',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title5',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description5',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button5',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link5',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Six
        $repeater->add_control(
            'service_item_six',
            [
                'label' => esc_html__( 'Service Item Six Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image6',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title6',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description6',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button6',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link6',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Seven
        $repeater->add_control(
            'service_item_seven',
            [
                'label' => esc_html__( 'Service Item Seven Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image7',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title7',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description7',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button7',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link7',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );


        // Service Item Eight
        $repeater->add_control(
            'service_item_eight',
            [
                'label' => esc_html__( 'Service Item Eight Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'selected_image8',
            [
                'label'       => esc_html__( 'Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_title8',
            [
                'label'       => esc_html__( 'Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description8',
            [
                'label'       => esc_html__( 'Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button8',
            [
                'label'       => esc_html__( 'Read More', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link8',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs Items Here', 'rsaddon' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__( 'Tab #1', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'rsaddon' ),
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tab #2', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Working data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'rsaddon' ),
                    ],

                    [
                        'tab_title'   => esc_html__( 'Tab #3', 'rsaddon' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet.', 'rsaddon' ),
                    ],
                ],
                'title_field' => '{{{ tab_name }}}',
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
                ]
            ]
        );

        $this->add_responsive_control(
            'item_spacing_',
            [
                'label' => esc_html__( 'Item Spacing', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'nav_tabs_btn_title',
            [
                'label' => esc_html__( 'Nav Tab Button', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_name_typography',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button',
            ]
        );
        $this->add_control(
            'content_heading_title_typo',
            [
                'label' => esc_html__( 'Content Heading', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_heading_title',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap .title',
            ]
        );
        $this->add_control(
            'content_desc_title_typo',
            [
                'label' => esc_html__( 'Content Description', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_heading_desc',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap .description',
            ]
        );
        
        $this->add_responsive_control(
            'item_content_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap'
            ]
        );


        // Hover Normal tab start
        $this->start_controls_tabs(
            '_tabs_title_icon',
            [
                'separator' => 'before',
            ]
        );

        $this->start_controls_tab(
            'tab_icon_bg_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'tab_name_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'color: {{VALUE}};',
                    
                ],
            ]
        );


        $this->add_control(
            'name_background_color',
            [
                'label' => esc_html__( 'Tab Name Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.nav-link.active:after' => 'border-color: {{VALUE}} transparent !important;',                                  
                ],
            ]
        );

        $this->add_control(
            'name_border_color',
            [
                'label' => esc_html__( 'Tab Name Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'border-color: {{VALUE}};',                                           
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_normal_box_shadow',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button'
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
            'tab_name_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.active' => 'color: {{VALUE}};',
                ],              
            ]
        );

        $this->add_control(
            'tab_name_active_background_color',
            [
                'label' => esc_html__( 'Tab Name Active Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [ 
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.active' => 'background-color: {{VALUE}};',                                
                ],
            ]
        );

        $this->add_control(
            'name_border_active_color',
            [
                'label' => esc_html__( 'Tab Name Border Color (Active)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.nav-link.active:before' => 'border-top-color: {{VALUE}} !important;',                                           
                ],
            ]
        );

        $this->add_control(
            'name_border_active_bubble_color',
            [
                'label' => esc_html__( 'Tab Name Bubble Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.nav-link.active:after' => 'border-top-color: {{VALUE}} !important;',                                           
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'active_tab_menu_border',
                'selector' => '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button.nav-link.active',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'tab_name_width',
            [
                'label' => esc_html__( 'Navigation Width', 'rsaddon' ),
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
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_name_spacing_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
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
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_name_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_name_area_padding',
            [
                'label' => esc_html__( 'Tab Name Padding', 'rsaddon' ),
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
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-menu-wrapper .nav-tabs button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'item_bg',
            [
                'label' => esc_html__( 'Single Item Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap' => 'background: {{VALUE}} !important;',                                      
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap::before' => 'border-bottom: 36px solid {{VALUE}} !important;',                                      
                ],
            ]
        );
        $this->add_responsive_control(
            'img_border_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Content Section Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.service-filer-addon .tab-content .service-item .service-item-wrap .inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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


    <div class="rstab-main service-filer-addon"> 
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
                    $name_image = wp_get_attachment_image_url( $item['name_image']['id']) ?? '';
                    $name_alt = Control_Media::get_image_alt($item['name_image']);
                    $tab_name = !empty($item['tab_name']) ? $item['tab_name'] : '';
                    
                    ?>
                <button class="nav-link <?php echo esc_attr($active_tab); ?> <?php echo esc_attr( 'elementor-repeater-item-' . $item['_id'] ); ?>" id="nav-home-<?php echo esc_attr($arial_lebel);?>" data-bs-toggle="tab" data-bs-target="#tab<?php echo esc_html( $arial_lebel );?>" type="button" role="tab" aria-controls="nav-home-<?php echo esc_attr($arial_lebel);?>" aria-selected="true">                
                    
                    <?php if(!empty($name_image)){ ?>
                        <img src="<?php echo esc_url( $name_image ); ?>" alt="<?php echo esc_attr( $name_alt ); ?>">
                    <?php } ?>

                    <?php echo esc_html($item['tab_name']); ?>

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

                    
                    $image = wp_get_attachment_image_url( $item['selected_image']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt = Control_Media::get_image_alt($item['selected_image']);
                
                    $description = !empty($item['description']) ? $item['description'] : '';
                    $tab_title = !empty($item['tab_title']) ? $item['tab_title'] : '';
                    $button = !empty($item['button']) ? $item['button'] : '';
                    $target = !empty($item['link']['is_external']) ? 'target=_blank' : '';  
                    $link = !empty($item['link']['url']) ? $item['link']['url'] : '';


                    $image2 = wp_get_attachment_image_url( $item['selected_image2']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt2 = Control_Media::get_image_alt($item['selected_image2']);
                    $description2 = !empty($item['description2']) ? $item['description2'] : '';
                    $tab_title2 = !empty($item['tab_title2']) ? $item['tab_title2'] : '';
                    $button2 = !empty($item['button2']) ? $item['button2'] : '';
                    $target2 = !empty($item['link2']['is_external']) ? 'target=_blank' : '';  
                    $link2 = !empty($item['link2']['url']) ? $item['link2']['url'] : '';

                    $image3 = wp_get_attachment_image_url( $item['selected_image3']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt3 = Control_Media::get_image_alt($item['selected_image3']);
                    $description3 = !empty($item['description3']) ? $item['description3'] : '';
                    $tab_title3 = !empty($item['tab_title3']) ? $item['tab_title3'] : '';
                    $button3 = !empty($item['button3']) ? $item['button3'] : '';
                    $target3 = !empty($item['link3']['is_external']) ? 'target=_blank' : '';  
                    $link3 = !empty($item['link3']['url']) ? $item['link3']['url'] : '';

                    $image4 = wp_get_attachment_image_url( $item['selected_image4']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt4 = Control_Media::get_image_alt($item['selected_image4']);
                    $description4 = !empty($item['description4']) ? $item['description4'] : '';
                    $tab_title4 = !empty($item['tab_title4']) ? $item['tab_title4'] : '';
                    $button4 = !empty($item['button4']) ? $item['button4'] : '';
                    $target4 = !empty($item['link4']['is_external']) ? 'target=_blank' : '';  
                    $link4 = !empty($item['link4']['url']) ? $item['link4']['url'] : '';

                    $image5 = wp_get_attachment_image_url( $item['selected_image5']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt5 = Control_Media::get_image_alt($item['selected_image5']);
                    $description5 = !empty($item['description5']) ? $item['description5'] : '';
                    $tab_title5 = !empty($item['tab_title5']) ? $item['tab_title5'] : '';
                    $button5 = !empty($item['button5']) ? $item['button5'] : '';
                    $target5 = !empty($item['link5']['is_external']) ? 'target=_blank' : '';  
                    $link5 = !empty($item['link5']['url']) ? $item['link5']['url'] : '';

                    $image6 = wp_get_attachment_image_url( $item['selected_image6']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt6 = Control_Media::get_image_alt($item['selected_image6']);
                    $description6 = !empty($item['description6']) ? $item['description6'] : '';
                    $tab_title6 = !empty($item['tab_title6']) ? $item['tab_title6'] : '';
                    $button6 = !empty($item['button6']) ? $item['button6'] : '';
                    $target6 = !empty($item['link6']['is_external']) ? 'target=_blank' : '';  
                    $link6 = !empty($item['link6']['url']) ? $item['link6']['url'] : '';

                    $image7 = wp_get_attachment_image_url( $item['selected_image7']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt7 = Control_Media::get_image_alt($item['selected_image7']);
                    $description7 = !empty($item['description7']) ? $item['description7'] : '';
                    $tab_title7 = !empty($item['tab_title7']) ? $item['tab_title7'] : '';
                    $button7 = !empty($item['button7']) ? $item['button7'] : '';
                    $target7 = !empty($item['link7']['is_external']) ? 'target=_blank' : '';  
                    $link7 = !empty($item['link7']['url']) ? $item['link7']['url'] : '';

                    $image8 = wp_get_attachment_image_url( $item['selected_image8']['id'], $settings['thumbnail_size'] ) ?? '';
                    $alt8 = Control_Media::get_image_alt($item['selected_image8']);
                    $description8 = !empty($item['description8']) ? $item['description8'] : '';
                    $tab_title8 = !empty($item['tab_title8']) ? $item['tab_title8'] : '';
                    $button8 = !empty($item['button8']) ? $item['button8'] : '';
                    $target8 = !empty($item['link8']['is_external']) ? 'target=_blank' : '';  
                    $link8 = !empty($item['link8']['url']) ? $item['link8']['url'] : '';
                   
                ?>
                <div class="tab-pane fade <?php echo esc_attr($active_tab);?>" id="tab<?php echo esc_html($arial_lebel);?>" role="tabpanel" aria-labelledby="nav-home-<?php echo esc_attr($arial_lebel);?>">
                    
                    <div class="row">
                    	<?php if(!empty($item['tab_title']) || !empty($item['description']) || !empty($item['button']) || !empty($item['link'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image)){ ?>
		                    		    	<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr($alt); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title']) || !empty($item['description']) || !empty($item['button'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title'])){ ?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link);?>" <?php echo wp_kses_post($target);?>><?php echo $tab_title; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>
    	                    		        <?php if(!empty($item['description'])){?>
    	                    		            <div class="description"><?php echo $description; ?></div>
    	                    		        <?php } ?> 
    	                    		        <?php if(!empty($item['button'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link);?>" <?php echo wp_kses_post($target);?>> <?php echo $button; ?> <i class="ri-arrow-right-circle-line"></i> </a></div> 
    	                    		        <?php } ?>  
                                        </div> 
                                        <?php } ?>                                                   
	                    		    </div>
	                    		</div>
	                    	</div>
	                    <?php } ?>

                    	<?php if(!empty($item['tab_title2']) || !empty($item['description2']) || !empty($item['button2']) || !empty($item['link2'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image2)){ ?>
		                    		    	<img src="<?php echo esc_url( $image2 ); ?>" alt="<?php echo esc_attr($alt2); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title2']) || !empty($item['description2']) || !empty($item['button2'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title2'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link2);?>" <?php echo wp_kses_post($target2);?>><?php echo $tab_title2; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description2'])){?>
    	                    		            <div class="description"><?php echo $description2; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button2'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link2);?>" <?php echo wp_kses_post($target2);?>> <?php echo $button2; ?> <i class="ri-arrow-right-circle-line"></i> </a> </div>
    	                    		        <?php } ?> 
                                        </div>
                                        <?php } ?>                                                     
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>

                    	<?php if(!empty($item['tab_title3']) || !empty($item['description3']) || !empty($item['button3']) || !empty($item['link3'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image3)){ ?>
		                    		    	<img src="<?php echo esc_url( $image3 ); ?>" alt="<?php echo esc_attr($alt3); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title3']) || !empty($item['description3']) || !empty($item['button3'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title3'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link3);?>" <?php echo wp_kses_post($target3);?>><?php echo $tab_title3; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description3'])){?>
    	                    		            <div class="description"><?php echo $description3; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button3'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link3);?>" <?php echo wp_kses_post($target3);?>> <?php echo $button3; ?> <i class="ri-arrow-right-circle-line"></i> </a> </div>
    	                    		        <?php } ?>  
                                        </div> 
                                        <?php } ?>                                                   
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>

                    	<?php if(!empty($item['tab_title4']) || !empty($item['description4']) || !empty($item['button4']) || !empty($item['link4'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image4)){ ?>
		                    		    	<img src="<?php echo esc_url( $image4 ); ?>" alt="<?php echo esc_attr($alt4); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title4']) || !empty($item['description4']) || !empty($item['button4'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title4'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link4);?>" <?php echo wp_kses_post($target4);?>><?php echo $tab_title4; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description4'])){?>
    	                    		            <div class="description"><?php echo $description4; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button4'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link4);?>" <?php echo wp_kses_post($target4);?>> <?php echo $button4; ?> <i class="ri-arrow-right-circle-line"></i> </a> </div>
    	                    		        <?php } ?>
                                        </div> 
                                        <?php } ?>                                                     
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>

                    	<?php if(!empty($item['tab_title5']) || !empty($item['description5']) || !empty($item['button5']) || !empty($item['link5'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image5)){ ?>
		                    		    	<img src="<?php echo esc_url( $image5 ); ?>" alt="<?php echo esc_attr($alt5); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title5']) || !empty($item['description5']) || !empty($item['button5'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title5'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link5);?>" <?php echo wp_kses_post($target5);?>><?php echo $tab_title5; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description5'])){?>
    	                    		            <div class="description"><?php echo $description5; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button5'])){?>
    	                    		            <div class="button-here"> <a href="<?php echo esc_url($link5);?>" <?php echo wp_kses_post($target5);?>> <?php echo $button5; ?> <i class="ri-arrow-right-circle-line"></i> </a> </div>
    	                    		        <?php } ?> 
                                        </div> 
                                        <?php } ?>                                                    
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>


                    	<?php if(!empty($item['tab_title6']) || !empty($item['description6']) || !empty($item['button6']) || !empty($item['link6'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image6)){ ?>
		                    		    	<img src="<?php echo esc_url( $image6 ); ?>" alt="<?php echo esc_attr($alt6); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title6']) || !empty($item['description6']) || !empty($item['button6'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title6'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link6);?>" <?php echo wp_kses_post($target6);?>><?php echo $tab_title6; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description6'])){?>
    	                    		            <div class="description"><?php echo $description6; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button6'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link6);?>" <?php echo wp_kses_post($target6);?>> <?php echo $button6; ?> <i class="ri-arrow-right-circle-line"></i> </a></div> 
    	                    		        <?php } ?> 
                                        </div>  
                                        <?php } ?>                                                   
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>


                    	<?php if(!empty($item['tab_title7']) || !empty($item['description7']) || !empty($item['button7']) || !empty($item['link7'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image7)){ ?>
		                    		    	<img src="<?php echo esc_url( $image7 ); ?>" alt="<?php echo esc_attr($alt7); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title7']) || !empty($item['description7']) || !empty($item['button7'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title7'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link7);?>" <?php echo wp_kses_post($target7);?>><?php echo $tab_title7; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description7'])){?>
    	                    		            <div class="description"><?php echo $description7; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button7'])){?>
    	                    		            <div class="button-here"><a href="<?php echo esc_url($link7);?>" <?php echo wp_kses_post($target7);?>> <?php echo $button7; ?> <i class="ri-arrow-right-circle-line"></i> </a></div>
    	                    		        <?php } ?>  
                                        </div>
                                        <?php } ?>                                                    
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>


                    	<?php if(!empty($item['tab_title8']) || !empty($item['description8']) || !empty($item['button8']) || !empty($item['link8'])){ ?>
	                    	<div class="col-md-6 col-sm-6 col-lg-3">
	                    		<div class="service-item">                       
	                    		    <div class="service-item-wrap">
	                    		    	<?php if(!empty($image8)){ ?>
		                    		    	<img src="<?php echo esc_url( $image8 ); ?>" alt="<?php echo esc_attr($alt8); ?>">
		                    		    <?php } ?>
                                        <?php if(!empty($item['tab_title8']) || !empty($item['description8']) || !empty($item['button8'])){ ?>
                                        <div class="inner-wrap">
    	                    		        <?php if(!empty($item['tab_title8'])){?>
    	                    		            <h3 class="title">
    	                    		                <a href="<?php echo esc_url($link8);?>" <?php echo wp_kses_post($target8);?>><?php echo $tab_title8; ?></a>
    	                    		            </h3>
    	                    		        <?php } ?>

    	                    		        <?php if(!empty($item['description8'])){?>
    	                    		            <div class="description"><?php echo $description8; ?></div>
    	                    		        <?php } ?> 

    	                    		        <?php if(!empty($item['button8'])){?>
    	                    		            <div class="button-here"> <a href="<?php echo esc_url($link8);?>" <?php echo wp_kses_post($target8);?>> <?php echo $button8; ?> <i class="ri-arrow-right-circle-line"></i> </a> </div>
    	                    		        <?php } ?> 
                                        </div> 
                                        <?php } ?>                                                    
	                    		    </div>
	                    		</div>
	                    	</div>
                    	<?php } ?>

                    </div>   
                </div>
            
            <?php $arial_lebel++; endforeach; ?>
        </div>
    </div>

    <?php
    }
}

