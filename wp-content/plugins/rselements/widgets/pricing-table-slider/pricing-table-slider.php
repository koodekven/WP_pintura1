<?php

/**
 * Pricing table slider widget class
 *
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Pricing_Table_Slider_Widget extends \Elementor\Widget_Base
{

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

    public function get_name()
    {
        return 'rsprice-slider';
    }


    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('RS Pricing Table Slider', 'rsaddon');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-price';
    }


    public function get_categories()
    {
        return ['rsaddon_category'];
    }

    public function get_keywords()
    {
        return ['pricing', 'table', 'package', 'product', 'plan', 'slider', 'price'];
    }

    // Register Controlls
    protected function register_controls()
    {
        $this->register_slider_item_controls();
        $this->register_slider_settings_controls();
        $this->register_slider_global_style_controls();
        $this->register_slider_overlayer_style_controls();
        $this->register_slider_title_style_controls();
        $this->register_slider_price_style_controls();
        $this->register_slider_desc_style_controls();
        $this->register_slider_button_style_controls();
        $this->register_slider_dot_style_controls();
        $this->register_slider_arrow_style_controls();
    }

    // Slider Repeater Elements Start
    protected function register_slider_item_controls()
    {
        $this->start_controls_section(
            '_section_pricing_items',
            [
                'label' => esc_html__('Pricing Items', 'rsaddon'),
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
                    'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon')				
				],											
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Price Items', 'rsaddon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'currency',
            [
                'label' => esc_html__( 'Currency Symbol', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
                'default' => esc_html__( '$', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '11.19', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'period',
            [
                'label' => esc_html__( 'Period', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per Month', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Capitalize on low hanging fruit to identify a ballpark value added activity.', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Request a Plumber', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '#', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'price_items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__('Pricing Title One', 'rsaddon'),
                    ],
                    [
                        'title' => esc_html__('Pricing Title Two', 'rsaddon'),
                    ],
                    [
                        'title' => esc_html__('Pricing Title Three', 'rsaddon'),
                    ],
                    [
                        'title' => esc_html__('Pricing Title Four', 'rsaddon'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }
    // Slider Repeater Elements End

    // Slider Dynamic Functions Start
    protected function register_slider_settings_controls()
    {
        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__('Desktops > 1199px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Desktops > 991px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 768px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__('Slide To Scroll', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Item', 'rsaddon'),
                    '2' => esc_html__('2 Item', 'rsaddon'),
                    '3' => esc_html__('3 Item', 'rsaddon'),
                    '4' => esc_html__('4 Item', 'rsaddon'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__('Navigation Dots', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__('Navigation Nav', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__('Autoplay', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__('Autoplay Slide Speed', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '1000' => esc_html__('1 Seconds', 'rsaddon'),
                    '2000' => esc_html__('2 Seconds', 'rsaddon'),
                    '3000' => esc_html__('3 Seconds', 'rsaddon'),
                    '4000' => esc_html__('4 Seconds', 'rsaddon'),
                    '5000' => esc_html__('5 Seconds', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__('Stop on Hover', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__('Autoplay Interval', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '5000' => esc_html__('5 Seconds', 'rsaddon'),
                    '4000' => esc_html__('4 Seconds', 'rsaddon'),
                    '3000' => esc_html__('3 Seconds', 'rsaddon'),
                    '2000' => esc_html__('2 Seconds', 'rsaddon'),
                    '1000' => esc_html__('1 Seconds', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__('Loop', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__('Center Mode', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rsaddon'),
                    'false' => esc_html__('Disable', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Gap', 'rsaddon'),
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
                    '{{WRAPPER}} .rs-addon-slider .slick-slide' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    // Slider Dynamic Functions End

    // Pricing Global Style Start
    protected function register_slider_global_style_controls()
    {
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__('Global Style', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                        '{{WRAPPER}}  .elementor-widget-container' => 'text-align: {{VALUE}}'
                    ]
                ]
            );
            $this->add_responsive_control(
                'general_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'default'   => [
                        'top' => 40,
                        'right' => 40,
                        'bottom' => 40,
                        'left' => 40,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'general_margin',
                [
                    'label' => esc_html__( 'Margin', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'general_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
            $this->start_controls_tabs( '_tabs_general' );
                $this->start_controls_tab(
                    'general_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'background_colord',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'general_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'general_border',
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper',
                    ]
                );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'general_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'background_hover_colordd',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper:hover',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'general_hover_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper:hover'
                    ]
                );
                $this->add_control(
                    'general_border_color_hover',
                    [
                        'label' => esc_html__( 'Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
    }
    // Pricing Global Style End

    // Pricing Overlayer Style Start
    protected function register_slider_overlayer_style_controls()
    {
        $this->start_controls_section(
            '_section_style_overlayer',
            [
                'label' => esc_html__('Overlayer Style', 'rsaddon'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'overlay_show_hide',
            [
                'label' => esc_html__( 'Show / Hide', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-close',
                    ],
                ],
                'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after' => 'display: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'overlay_border',
                'selector' => '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after',
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_bg',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after',
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_top',
            [
                'label' => esc_html__( 'Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_right',
            [
                'label' => esc_html__( 'Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->add_responsive_control(
            'overlay_position_left',
            [
                'label' => esc_html__( 'Left', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .pricing-wrapper::after' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'overlay_show_hide' => 'block',
                ],
            ]
        );
        $this->end_controls_section();
    }
    // Pricing Overlayer Style End

    // Pricing Title Style Start
    protected function register_slider_title_style_controls()
    {
        $this->start_controls_section(
            'section_header_style',
            [
                'label' => esc_html__('Header Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'header_align',
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
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
		    'header_margin',
		    [
		        'label' => esc_html__( 'Header Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'header_padding',
		    [
		        'label' => esc_html__( 'Header Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'header_border_radius',
            [
                'label' => esc_html__( 'Header Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->start_controls_tabs( '_tabs_header' );
            $this->start_controls_tab(
                'header_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'header_background_color',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'header_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header'
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'header_border',
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header',
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'header_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'header_background_hover_colord',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header:hover',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'header_hover_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header:hover'
                ]
            );
            $this->add_control(
                'header_border_color_hover',
                [
                    'label' => esc_html__( 'Border Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
			'_heading_title',
			[
				'label' => esc_html__( 'Title', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .title',
		    ]
		);
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .title' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-header .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->end_controls_section();
    }
    // Pricing Title Style End

    // Pricing Price Style Start
    protected function register_slider_price_style_controls()
    {
        $this->start_controls_section(
            'section_price_style',
            [
                'label' => esc_html__('Price Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'price_wrap_align',
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
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'pricing_all_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price',
		    ]
		);
        $this->add_control(
			'pricing_all_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price,
                    {{WRAPPER}} .rs-price-table-slider.color_primary_scheme .slider-item .pricing-wrapper .pricing-price .get-price,
                    {{WRAPPER}} .rs-price-table-slider.color_secondary_scheme .slider-item .pricing-wrapper .pricing-price .get-priceo' => 'color: {{VALUE}} !important;',
				],
			]
		);
        $this->add_responsive_control(
		    'price_wrap_margin',
		    [
		        'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'price_wrap_padding',
		    [
		        'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'price_wrap_border_radius',
            [
                'label' => esc_html__( 'Wrapper Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->start_controls_tabs( '_tabs_price_wrapper' );
            $this->start_controls_tab(
                'price_wrap_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'price_wrap_background_color',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'price_wrap_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price'
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'price_wrap_border',
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price',
                ]
            );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'price_wrap_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'price_wrap_background_hover_colord',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price:hover',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'price_wrap_hover_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price:hover'
                ]
            );
            $this->add_control(
                'price_wrap_border_color_hover',
                [
                    'label' => esc_html__( 'Border Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .pricing-price:hover' => 'border-color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        // Currency Part Start
        $this->add_control(
			'_heading_currency',
			[
				'label' => esc_html__( 'Currency', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'currency_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-currency',
		    ]
		);
        $this->add_control(
			'currency_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-currency,
                    {{WRAPPER}} .rs-price-table-slider.color_primary_scheme .slider-item .pricing-wrapper .get-currency,
                    {{WRAPPER}} .rs-price-table-slider.color_secondary_scheme .slider-item .pricing-wrapper .get-currency' => 'color: {{VALUE}} !important;',
				],
			]
		);
        $this->add_responsive_control(
		    'currency_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-currency' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'currency_position_top',
            [
                'label' => esc_html__( 'Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-currency' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
            ]
        );

        // Price Part Start
        $this->add_control(
			'_heading_price',
			[
				'label' => esc_html__( 'Price', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
        
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'price_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-price',
		    ]
		);
        $this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-price' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
		    'price_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'price_position_top',
            [
                'label' => esc_html__( 'Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-price' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
            ]
        );

        // Period Part Start
        $this->add_control(
			'_heading_period',
			[
				'label' => esc_html__( 'Period', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'period_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-period',
		    ]
		);
        $this->add_control(
			'period_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-period' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
		    'period_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
            'period_position_top',
            [
                'label' => esc_html__( 'Top', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .get-period' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
            ]
        );
        $this->end_controls_section();
    }
    // Pricing Price Style End

    // Pricing Description Style Start
    protected function register_slider_desc_style_controls()
    {
        $this->start_controls_section(
            'section_description_style',
            [
                'label' => esc_html__('Description Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'desc_wrap_align',
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
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'desc_wrap_margin',
            [
                'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_wrap_padding',
            [
                'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_wrap_border_radius',
            [
                'label' => esc_html__( 'Wrapper Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description',
            ]
        );
        $this->start_controls_tabs( '_tabs_desc_wrapper' );
            $this->start_controls_tab(
                'desc_wrap_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'desc_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'desc_wrap_background_color',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'desc_wrap_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description'
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'desc_wrap_border',
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description',
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'desc_wrap_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'desc_hover_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'desc_wrap_background_hover_colord',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description:hover',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'desc_wrap_hover_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description:hover'
                    ]
                );
                $this->add_control(
                    'desc_wrap_border_color_hover',
                    [
                        'label' => esc_html__( 'Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .description:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    // Pricing Description Style End

    // Pricing Button Style Start
    protected function register_slider_button_style_controls()
    {
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Button Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Button Wrapper Part Start
        $this->add_control(
			'_heading_btn_wrapper_part',
			[
				'label' => esc_html__( 'Button Wrapper', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);
        $this->add_responsive_control(
            'btn_wrap_align',
            [
                'label' => esc_html__( 'Wrapper Alignment', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'btn_wrap_margin',
            [
                'label' => esc_html__( 'Wrapper Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_wrap_padding',
            [
                'label' => esc_html__( 'Wrapper Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_wrapper_background_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part',
            ]
        );

        // Button Part Start
        $this->add_control(
			'_heading_btn_part',
			[
				'label' => esc_html__( 'Button Configuration', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
		);
        $this->add_responsive_control(
            'btn_align',
            [
                'label' => esc_html__( 'Button Text Alignment', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a'
            ]
        );
        $this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs( '_tabs_btn' );
            $this->start_controls_tab(
                'btn_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'btn_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a' => 'color: {{VALUE}};',
                        ],             
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'btn_background_color',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'btn_border',
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a',
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'btn_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'btn_hover_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a:hover' => 'color: {{VALUE}};',
                        ],             
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'btn_background_hover_colord',
                        'label' => esc_html__( 'Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a:hover',
                    ]
                );
                $this->add_control(
                    'btn_border_color_hover',
                    [
                        'label' => esc_html__( 'Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rs-price-table-slider .slider-item .pricing-wrapper .btn-part a:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    // Pricing Button Style End

    // Slider Arrow Style Start
    protected function register_slider_arrow_style_controls()
    {
        $this->start_controls_section(
            'section_slider_arrow_style',
            [
                'label' => esc_html__('Slider Arrow', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_nav' => 'true'
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
                
            ]
        );
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
            'arrow_color_hover',
            [
                'label' => esc_html__( 'Arrow Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow:hover:before' => 'color: {{VALUE}};',  
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
            ]
        );

        $this->add_control(
            'ars_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-addon-slider .slick-prev' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'ars_border_color',
		        'selector' => '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-addon-slider .slick-prev',
		    ]
		);

        $this->add_control(
            'ars_border_color_hover',
            [
                'label' => esc_html__( 'Border hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next:hover, {{WRAPPER}} .rs-addon-slider .slick-prev:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, {{WRAPPER}} .rs-addon-slider .slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pricing_arrow_box_shadow',
                'selector' => '{{WRAPPER}} .rsaddon-unique-slider .slick-arrow',
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
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'left',
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_prev_x_select' => 'right',
					'arrow_position_maker' => 'custom'
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
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'top',
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_prev_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
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
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'left',
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition'=>[
		        	'arrow_next_x_select' => 'right',
					'arrow_position_maker' => 'custom'
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
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'top',
					'arrow_position_maker' => 'custom'
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
					'{{WRAPPER}} .rs-addon-slider .slick-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition'=>[
		        	'arrow_next_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
		        ]
			]
		);
        $this->end_controls_section();
    }
    // Slider Arrow Style Start

    // Slider Dot Style Start
    protected function register_slider_dot_style_controls()
    {
        $this->start_controls_section(
            'section_slider_dot_style',
            [
                'label' => esc_html__('Slider Dots', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_dots' => 'true'
                ]
            ]
        );
        $this->add_control(
			'bullet_wrapper_box_style',
			[
				'label' => esc_html__( 'Bullet Wrapper Box Style', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bullet_wrapper_box_bg',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots',
			]
		);
		$this->add_responsive_control(
		    'bullet_wrapper_box_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'bullet_wrapper_box_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'bullet_wrapper_box_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    '_hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->add_control(
            'bullet_item_options',
            [
                'label' => esc_html__( 'Bullet Item Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
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

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'navigation_dot_icon_background',
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

        $this->add_control(
			'bullet_opacity_normal',
			[
				'label' => esc_html__( 'Opacity', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->add_control(
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
                'name'     => 'navigation_dot_icon_background_active',
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover, {{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button',
            ]
        );

        $this->add_responsive_control(
            'bullet_active_width_custom',
            [
                'label' => esc_html__( 'Bullet Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_active_height_custom',
            [
                'label' => esc_html__( 'Bullet Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'bullet_opacity_active',
			[
				'label' => esc_html__( 'Opacity', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
            'bullet_active_scale_custom',
            [
                'label' => esc_html__( 'Bullet Scale', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 0.1,
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'transform: scale({{SIZE}})',
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
         $this->add_responsive_control(
            'bullet_spacing_custom_position',
            [
                'label' => esc_html__( 'Top / Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'show_label' => true,               
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
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'top: {{SIZE}}{{UNIT}}; bottom:unset;',                    
                ],
            ]
        );
        $this->end_controls_section();
    }
    // Slider Dot Style Start

    protected function render(){
        ?>
            <?php

            $settings = $this->get_settings_for_display();

            $slidesToShow           = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
            $autoplaySpeed          = $settings['slider_autoplay_speed'];
            $interval               = $settings['slider_interval'];
            $slidesToScroll         = $settings['slides_ToScroll'];
            $slider_autoplay        = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
            $pauseOnHover           = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
            $sliderDots             = $settings['slider_dots'] == 'true' ? 'true' : 'false';
            $sliderNav              = $settings['slider_nav'] == 'true' ? 'true' : 'false';
            $infinite               = $settings['slider_loop'] === 'true' ? 'true' : 'false';
            $centerMode             = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
            $col_lg                 = $settings['col_lg'];
            $col_md                 = $settings['col_md'];
            $col_sm                 = $settings['col_sm'];
            $col_xs                 = $settings['col_xs'];

            if ( is_rtl() ):
               $rtl= 'true';
            else:
               $rtl= 'false';
            endif;
            $unique = rand(2012, 35120);

            $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');

            if (empty($settings['price_items'])) {
                return;
            }
            ?>
            <div class="rsaddon-unique-slider">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider rs-price-table-slider color_<?php echo esc_html($settings['choose_color_scheme']); ?>">
                    <?php
                    foreach ($settings['price_items'] as $index => $item) :
                        $title = !empty($item['title']) ? $item['title'] : '';
                        $currency = !empty($item['currency']) ? $item['currency'] : '';
                        $price = !empty($item['price']) ? $item['price'] : '';
                        $period = !empty($item['period']) ? $item['period'] : '';
                        $description = !empty($item['description']) ? $item['description'] : '';
                        $button_text = !empty($item['button_text']) ? $item['button_text'] : '';
                        $link = !empty($item['link']) ? $item['link'] : '';
                    ?>
                        <div class="slider-item">
                            <div class="pricing-wrapper">
                                <div class="pricing-header">
                                    <?php if ($item['title']) : ?>
                                        <h4 class="title">
                                            <?php echo esc_html($item['title']); ?>
                                        </h4>
                                    <?php endif; ?>
                                </div>
                                <div class="pricing-price">
                                    <?php if ($item['currency']) : ?>
                                        <span class="get-currency">
                                            <?php echo esc_html($item['currency']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($item['price']) : ?>
                                        <span class="get-price">
                                            <?php echo esc_html($item['price']); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($item['period']) : ?>
                                        <span class="get-period">
                                            <?php echo esc_html($item['period']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($item['description']) : ?>
                                    <div class="description">
                                        <?php echo wp_kses_post($item['description']); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="btn-part">
                                    <a href="<?php echo esc_html($item['link']); ?>"><?php echo esc_html($item['button_text']); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    ?>
                </div>
                <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('.rs-addon-slider').each(function(index) {
                        var slider_id = jQuery(this).attr('id');
                        var slider_conf = jQuery.parseJSON(jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));

                        if (typeof(slider_id) != 'undefined' && slider_id != '') {
                            jQuery('#' + slider_id).not('.slick-initialized').slick({
                                slidesToShow: parseInt(slider_conf.col_lg),
                                centerMode: (slider_conf.centerMode) == "true" ? true : false,
                                dots: (slider_conf.sliderDots) == "true" ? true : false,
                                arrows: (slider_conf.sliderNav) == "true" ? true : false,
                                autoplay: (slider_conf.slider_autoplay) == "true" ? true : false,
                                slidesToScroll: parseInt(slider_conf.slidesToScroll),
                                centerPadding: '15px',
                                autoplaySpeed: parseInt(slider_conf.autoplaySpeed),
                                pauseOnHover: (slider_conf.pauseOnHover) == "true" ? true : false,
                                loop: false,
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
                                    },
                                ]
                            });
                        }
                    });
                });
            </script>
        <?php
    }
}
