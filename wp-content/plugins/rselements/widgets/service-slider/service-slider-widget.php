<?php

/**
 * Logo widget class
 *
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;


defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RSservices_Slider_Widget extends \Elementor\Widget_Base
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
        return 'rs-service-slider';
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
        return esc_html__('RS Service Slider', 'rsaddon');
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
        return 'eicon-gallery-grid';
    }


    public function get_categories()
    {
        return ['rsaddon_category'];
    }

    public function get_keywords()
    {
        return ['service'];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Service Item', 'rsaddon'),
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
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Scheme', 'rsaddon'),
					'secondary_scheme' => esc_html__('Secondary Scheme', 'rsaddon'),
                    'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon'),
				],
			]
		);

        $this->add_control(
            'services_style',
            [
                'label'   => esc_html__('Services Style', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Style 1', 'rsaddon'),
                    '2' => esc_html__('Style 2', 'rsaddon'),
                    '3' => esc_html__('Style 3', 'rsaddon'),
                    '4' => esc_html__('Style 4', 'rsaddon'),
                    '5' => esc_html__('Style 5', 'rsaddon'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__('Name', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'number_',
            [
                'label' => esc_html__('Number', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'rsaddon'),
                'placeholder' => esc_html__('01', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'rsaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__('Description', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,
            ]
        );
        $repeater->add_control(
            'icon_image',
            [
                'label' => esc_html__('Icon Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'service_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );

        $this->add_control(
            'read__more',
            [
                'label' => esc_html__('Button Text', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__('Read More', 'rsaddon'),
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'label' => __('Icon', 'rsaddon'),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'show_read_icon' => 'yes',
                    'show_read' => 'yes',
                    'services_style' => ['1', '4', '5'],

                ],
            ]
        );
        $this->end_controls_section();

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
                'default' => '3',
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
                'default' => '3',
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
                'default' => '2',
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
                'default' => '1',
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
                'default' => '2',
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
                'default' => '3000',
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
                'default' => '3000',
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
                    '{{WRAPPER}} .rs-addon-slider .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__('Item Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rsaddon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'rsaddon'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img' => 'text-align: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin_slid',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_border',
                'selector' => '{{WRAPPER}} .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'selector' => '{{WRAPPER}} .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider.services-style2 .rs-service-slider, {{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider'
            ]
        );
        $this->add_control(
            'gradiant_bg_hover_color_title',
            [
                'label' => esc_html__('Hover Gradiant Background  Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => esc_html__('Background Hover Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider:hover'
            ]
        );
        $this->add_control(
            'normal_bg_hover_color_title',
            [
                'label' => esc_html__('Hover Normal Background  Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'normal_bg_hover_color_',
            [
                'label' => esc_html__('Normel Hover Bckgorund Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['services_style' => '1']
            ]
        );

        $this->add_control(
            'line_bg_background',
            [
                'label' => esc_html__('Line Background', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['services_style' => '3']
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'line_background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-3 .service-title-holder:after',
                'condition' => ['services_style' => '3']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'item_center_mode_style',
            [
                'label' => esc_html__('Item Center Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_centerMode' => 'true',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'active_background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider'
            ]
        );
        $this->add_control(
            'center_icon_bg_color_title',
            [
                'label' => esc_html__('Icon Background', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'services_style' => '5',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'center_icon_bg_color_',
                'label' => esc_html__('Icon Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .slick-center .rs-service-slider .service-img .rs-step-icon, {{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .slick-center .rs-service-slider .service-img::after, {{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .slick-center .rs-service-slider .service-img::before',
                'condition' => [
                    'services_style' => '5',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'icon__center__hover__css_filters',
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .slick-center .rs-service-slider .service-img .rs-step-icon img',
                'condition' => [
                    'services_style' => '5',
                ],
            ]
        );
        $this->add_control(
            'center_title_color_title',
            [
                'label' => esc_html__('Title And Description Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
                'condition' => [
                    'services_style' => '5',
                ],
            ]
        );
        $this->add_control(
            'centertitle_text__color',
            [
                'label' => esc_html__('Center Title Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .service-title .title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'centertitle_content__color',
            [
                'label' => esc_html__('Center Description Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .service-desc .description' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'center_btn_title',
            [
                'label' => esc_html__('Button Section', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'active_btn_background',
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .read__more a, {{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .slick-center .rs-service-slider .service-title-holder .read__more a'
            ]
        );
        $this->add_control(
            'btn__center_text__color',
            [
                'label' => esc_html__('Center Button Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .read__more a .custom-blog-btn, {{WRAPPER}} .rs-addon-slider.rs-services-slider.service-style-5 .slick-center .rs-service-slider .read__more a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .read__more a .custom-blog-btn svg path, {{WRAPPER}} .rs-addon-slider.rs-services-slider.service-style-5 .slick-center .rs-service-slider .read__more a svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'center_read_border_color',
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .slick-center .rs-service-slider .read__more a',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'icon_style__',
            [
                'label' => esc_html__('Icon Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'services_style' => ['5', '2'],
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'icon__css_filters',
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img .rs-step-icon img,{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon img',
            ]
        );
        $this->add_responsive_control(
            'icon__wrapper_image_width_style_five',
            [
                'label' => esc_html__('Image Wrapper Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img .rs-step-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => ['5','2']
                ]
            ]
        );
        $this->add_responsive_control(
            'icon__wrapper_image_height_style_five',
            [
                'label' => esc_html__('Image Wrapper Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img .rs-step-icon' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => ['5','2']
                ]
            ]
        );
        $this->add_responsive_control(
            'icon___image_width',
            [
                'label' => esc_html__('Image Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img .rs-step-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon___image_height',
            [
                'label' => esc_html__('Image Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img .rs-step-icon img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon___background_color',
                'label' => esc_html__('Background', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .rs-service-slider .service-img .rs-step-icon, {{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .rs-service-slider .service-img::after, {{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .rs-service-slider .service-img::before,{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Icon Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-5.rs-addon-slider .rs-service-slider .service-img .rs-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_hover_color_title',
            [
                'label' => esc_html__('Icon Hover Background  Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'icon__hover__css_filters',
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-img .rs-step-icon img,{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon img',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon___hover_background_color',
                'label' => esc_html__('Background', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-img .rs-step-icon, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-img::before, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-img::after,{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon:hover'
            ]
        );
        $this->add_responsive_control(
            'icon_positonleft_width',
            [
                'label' => esc_html__('Icon Top Position', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .rs-service-slider .rs-step-icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['services_style' => '2']
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            '_img_sett_ings',
            [
                'label' => esc_html__('Image Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
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
        $this->add_control(
            'image_display_position',
            [
                'label' => esc_html__('Image Inline/Block', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'inline-flex' => [
                        'title' => esc_html__('Inline Block', 'rsaddon'),
                        'icon' => 'eicon-editor-close',
                    ],
                    'block' => [
                        'title' => esc_html__('Block', 'rsaddon'),
                        'icon' => 'eicon-check',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}  .rs-service-slider .service-img' => 'display: {{VALUE}}; justify-content:center; align-items:center;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_align',
            [
                'label' => esc_html__('Alignment', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '0' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    '0 auto' => [
                        'title' => esc_html__('Center', 'rsaddon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    '0 0 0 auto' => [
                        'title' => esc_html__('Right', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a' => 'margin: {{VALUE}}',
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a img' => 'margin: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'serv_image_width',
            [
                'label' => esc_html__('Image Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style!' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'serv_image_height',
            [
                'label' => esc_html__('Image Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style!' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'serv_image_width_style_five',
            [
                'label' => esc_html__('Image Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.service-style-5 .rs-service-slider .service-img img.rs-grid-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'serv_image_height_style_five',
            [
                'label' => esc_html__('Image Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.service-style-5 .rs-service-slider .service-img img.rs-grid-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'serv_image_wrapper_width',
            [
                'label' => esc_html__('Image Wrapper Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style!' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'serv_image_wrapper_height',
            [
                'label' => esc_html__('Image Wrapper Height', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style!' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_wrapper_border_radius',
            [
                'label' => esc_html__('Wrapper Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style!' => '5'
                ]
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img img, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__('Background', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img a',
                'condition' => ['services_style!' => '4']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color_style_four',
                'label' => esc_html__('Background', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-img',
                'condition' => ['services_style' => '4']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_title_style_grid_',
            [
                'label' => esc_html__('Title Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title__area__',
            [
                'label' => esc_html__('Title Area', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => '1'
                ],
            ]
        );

        $this->add_responsive_control(
            'title_area__padding',
            [
                'label' => esc_html__('Area Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => '1'
                ],
            ]
        );
        $this->add_responsive_control(
            'title_area__margin',
            [
                'label' => esc_html__('Area Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => '1'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_area__border',
                'selector' => '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => '1'
                ],
            ]
        );
        $this->add_control(
            'title___title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__('H1', 'rsaddon'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__('H2', 'rsaddon'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__('H3', 'rsaddon'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__('H4', 'rsaddon'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__('H5', 'rsaddon'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__('H6', 'rsaddon'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}}  .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title .title',
                'separator'   => 'before',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title a:hover .title, {{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-title .title:hover,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title .title:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'title_icon_area_',
            [
                'label' => esc_html__('Title Icon/Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_area_width',
            [
                'label' => esc_html__('Icon Area Width', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_area__height',
            [
                'label' => esc_html__('Icon Area Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon__area__bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon,{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'icon__area__active_bg_',
            [
                'label' => esc_html__('Active Area Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.rs-addon-slider .slick-center .rs-service-slider .service-title-holder .service-title .rs-step-icon' => 'background-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => '1'
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_area_border_radius',
            [
                'label' => esc_html__('Icon Area Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__width',
            [
                'label' => esc_html__('Icon Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'icon___height',
            [
                'label' => esc_html__('Icon Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .service-title .rs-step-icon img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'icon__leftx_postion',
            [
                'label' => esc_html__('Icon X Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon__bottomy_postion',
            [
                'label' => esc_html__('Icon Y Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-img .rs-step-icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'number_title',
            [
                'label' => esc_html__('Number Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_responsive_control(
            'number__align',
            [
                'label' => esc_html__('Number Alignment', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rsaddon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'rsaddon'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .numbering' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'number_color__',
            [
                'label' => esc_html__('Number Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .numbering span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_responsive_control(
            'number_hover__color__',
            [
                'label' => esc_html__('Hover Number Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider:hover .rs-service-slider:hover .numbering span' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_responsive_control(
            'number_bg__color',
            [
                'label' => esc_html__('Number Background Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering ' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1']
                ],
            ]
        );
        $this->add_responsive_control(
            'number_bg_hover___color',
            [
                'label' => esc_html__('Hover Number Background Color ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering ' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number__typography',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span, {{WRAPPER}} .rs-services-slider .rs-service-slider .numbering span',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering span, {{WRAPPER}} .rs-services-slider .rs-service-slider .numbering span',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_control(
            'number_text_stork_hover_title',
            [
                'label' => esc_html__('Text Stork Hover Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_hover_stroke_color',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .numbering span, {{WRAPPER}} .rs-services-slider .rs-service-slider:hover .numbering span',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__bottom__position',
            [
                'label' => esc_html__('Number Bottom Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1', '4']
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__right__position',
            [
                'label' => esc_html__('Number Right Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1']
                ],
            ]
        );
        $this->add_responsive_control(
            'number_area__width_height_lineheight',
            [
                'label' => esc_html__('Number Width, Height, Line Height ', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; display:flex; align-items:center; justify-content:center;',
                ],
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1']
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'number_area_border',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering',
                'condition' => [
                    'show_title' => 'yes',
                    'services_style' => ['1']
                ],
            ]
        );
        $this->add_responsive_control(
            'number_area_border_radius',
            [
                'label' => esc_html__('Number Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .numbering' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => '1',
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_desc_style_grid',
            [
                'label' => esc_html__('Description Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'show_desc',
            [
                'label' => esc_html__('Show Description', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}}  .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p.description,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .service-desc',
                'separator'   => 'before',
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p.description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .service-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_margin_',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p.description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .service-desc p.description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_area__margin_',
            [
                'label' => esc_html__('Area Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .rs-services-slider .rs-service-slider .service-title-holder .service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}  .rs-services-slider.service-style-2 .service-title-holder .service-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider.rs-services-slider .rs-service-slider .service-desc p.description' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .service-desc p.description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_content_style',
            [
                'label' => esc_html__('Content Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_position_select',
            [
                'label' => esc_html__('Content Style Position', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Select', 'rsaddon'),
                    'relative' => esc_html__('Relative', 'rsaddon'),
                    'absolute'  => esc_html__('Absolute', 'rsaddon'),
                    'unset' => esc_html__('Unset', 'rsaddon'),

                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'position: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_part_bg',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder',
            ]
        );
        $this->add_control(
            'content_part_active__bg',
            [
                'label' => esc_html__('Active Background', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.rs-addon-slider .slick-center .rs-service-slider .service-title-holder' => 'background-color: {{VALUE}}!important;',
                ],
                'condition' => ['services_style' => '1']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_part_border',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder',
            ]
        );
        $this->add_responsive_control(
            'content_part_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_part_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_top_bottom_position',
            [
                'label' => esc_html__('Content Top Bottom Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['services_style' => '1']
            ]
        );
        $this->add_responsive_control(
            'content_left__position',
            [
                'label' => esc_html__('Content Left Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['services_style' => '1']
            ]
        );
        $this->add_responsive_control(
            'content_right__position',
            [
                'label' => esc_html__('Content Right Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['services_style' => '1']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_read_style_',
            [
                'label' => esc_html__('Read More Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'show_read',
            [
                'label' => esc_html__('Show Read More', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'show_read_icon',
            [
                'label' => esc_html__('Show Icon', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rsaddon'),
                'label_off' => esc_html__('Hide', 'rsaddon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon__margin',
            [
                'label' => esc_html__('Icon Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                    'show_read_icon' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a svg, {{WRAPPER}} .rs-service-slider .read__more a i  ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'read_typography',
                'label' => esc_html__('Typography', 'rsaddon'),
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more a .custom-blog-btn,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a',
                'separator'   => 'before',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__background_psudo',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more a::before',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__background',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more a, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider .service-title-holder .read__more a, {{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_color',
            [
                'label' => esc_html__('Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a .custom-blog-btn,
                     {{WRAPPER}} .rs-service-slider .read__more a,
                     {{WRAPPER}} .rs-service-slider .read__more a .custom-blog-btn i:before,
                     {{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-service-slider .read__more a .custom-blog-btn svg path, {{WRAPPER}} .rs-service-slider .read__more a svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'read_margin',
            [
                'label' => esc_html__('Margin', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-1 .rs-service-slider .service-title-holder .read__more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_padding',
            [
                'label' => esc_html__('Padding', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'show_read' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} {{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'read_border',
                'selector' => '{{WRAPPER}} .rs-service-slider .read__more a,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'hover_heading',
            [
                'label' => esc_html__('Hover Style', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hover_read_more_border',
                'selector' => '{{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .read__more a, {{WRAPPER}} .rs-services-slider .rs-service-slider .service-title-holder .read__more a:hover',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'read_color_hover',
            [
                'label' => esc_html__('Button Hover Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a:hover .custom-blog-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-service-slider .read__more a:hover .custom-blog-btn svg path' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'read__wrapper_color_hover',
            [
                'label' => esc_html__('Wrapper Hover Button Text Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider:hover .read__more a .custom-blog-btn, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-title-holder .read__more a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-service-slider:hover .read__more a .custom-blog-btn svg path, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-title-holder .read__more a svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'read__background_hover',
                'label' => esc_html__('Background Color', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-service-slider:hover .read__more a,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a:hover, {{WRAPPER}} .rs-services-slider.service-style-5 .rs-service-slider:hover .service-title-holder .read__more a',
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_border_color_hover',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-slider .read__more a:hover,{{WRAPPER}} .rs-services-slider.service-style-2 .service-title-holder .read__more a:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_style',
            [
                'label' => esc_html__('Icon Hover Effect', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''  => esc_html__('Select', 'rsaddon'),
                    'transformx'  => esc_html__('Translate X', 'rsaddon'),
                    'transformroatate' => esc_html__('Rotate', 'rsaddon'),
                ],
                'condition' => [
                    'show_read' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'transform_readmore_btn_rotate',
            [
                'label' => esc_html__('Transform Rotate', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                        'step' => 1

                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-1 .rs-service-slider .service-title-holder .read__more a:hover svg, {{WRAPPER}} .rs-services-slider .rs-service-slider:hover .service-title-holder .read__more a svg ' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'services_style' => ['1', '4'],
                    'icon_hover_style' => 'transformroatate'
                ],

            ]
        );
        $this->add_control(
            'transform_readmore_btn_translate',
            [
                'label' => esc_html__('Translate X', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1

                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-services-slider.service-style-1 .rs-service-slider .service-title-holder .read__more a:hover svg' => 'transform: translateX( {{SIZE}}{{UNIT}} );',
                ],
                'condition' => [
                    'show_read' => 'yes',
                    'services_style' => '1',
                    'icon_hover_style' => 'transformx'
                ],

            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__('Slider Style', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_control(
            'arrow_options',
            [
                'label' => esc_html__('Arrow Style', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'arrow_default_show_enable',
            [
                'label' => esc_html__('Arrow Show Enable?', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'arrow_show_disable',
                'options' => [
                    'arrow_show_enable'  => esc_html__('Arrow Default Show', 'rsaddon'),
                    'arrow_show_disable' => esc_html__('Arrow Hover Show', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__('Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-next' => 'background: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label' => esc_html__('Arrow Hover Background', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'arrow_hover_background_color',
                'label' => esc_html__('Background', 'rsaddon'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-arrow:hover',
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__('Icon Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'navigation_arrow_hover_icon_color',
            [
                'label' => esc_html__('Icon Hover Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-arrow:hover:before' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_left_position',
            [
                'label' => esc_html__('Arrow Left Previous Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'services_style' => '3'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_top_position',
            [
                'label' => esc_html__('Arrow Top Previsious Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-prev' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    'services_style' => '3'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_right_position',
            [
                'label' => esc_html__('Arrow Right Next Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-next' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'services_style' => '3'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_top_girtht_position',
            [
                'label' => esc_html__('Arrow Right Next Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .rs-addon-slider .slick-next' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
                'condition' => [
                    'services_style' => '3'
                ],
            ]
        );



        // Bullet Style Start
        $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__('Bullet Style', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'bullet__align',
            [
                'label' => esc_html__('Bullet Alignment', 'rsaddon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rsaddon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rsaddon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rsaddon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'rsaddon'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_slider_dots');

        // Normal Bullet Start
        $this->start_controls_tab(
            'slider_dots_normal_tab',
            [
                'label' => esc_html__('Normal', 'rsaddon'),
            ]
        );
        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__('Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'background: {{VALUE}};',

                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_height_custom',
            [
                'label' => esc_html__('Bullet Height', 'rsaddon'),
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
                'label' => esc_html__('Bullet Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_active_hover_width_custom',
            [
                'label' => esc_html__('Bullet Active/Hover Width', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_border_radius_custom',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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
                'label' => esc_html__('Active', 'rsaddon'),
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'navigation_dot_icon_background_active',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots li:hover button,{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button',
            ]
        );

        $this->add_responsive_control(
            'bullet_active_width_custom',
            [
                'label' => esc_html__('Bullet Width', 'rsaddon'),
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
                'label' => esc_html__('Border Color', 'rsaddon'),
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
                'label' => esc_html__('Top Gap', 'rsaddon'),
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
            'bullet_right__spacing_custom',
            [
                'label' => esc_html__('Right Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bullet_left__spacing_custom',
            [
                'label' => esc_html__('Left Gap', 'rsaddon'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Bullet Style End

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $services_style         = $settings['services_style'];
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
        $arrow_default_show_enable = $settings['arrow_default_show_enable'];

        if ( is_rtl() ):
          $rtl= 'true';
       else:
          $rtl= 'false';
       endif;
        $unique = rand(2012, 35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');

        if (empty($settings['service_list'])) {
            return;
        }


?>
        <div class="rsaddon-unique-slider">
            <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider rs-addon-slider-<?php echo $unique; ?> rs-services-slider <?php echo esc_attr($arrow_default_show_enable); ?> service-style-<?php echo $services_style; ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">

                <?php
                foreach ($settings['service_list'] as $index => $item) :

                    $image = wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']);
                    $title        = !empty($item['name']) ? $item['name'] : '';
                    $nnumber        = !empty($item['number_']) ? $item['number_'] : '';
                    $title_tag    = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
                    $description  = !empty($item['description']) ? $item['description'] : '';
                    $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';
                    $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';


                    if ($services_style == '1') {
                ?>
                        <div class="grid-item">
                            <div class="rs-service-slider">
                                <div class="service-img">
                                    <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>><img class="rs-grid-img" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($item['name']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>"></a>
                                </div>
                                <div class="service-title-holder">

                                    <!-- Name And Icon -->
                                    <?php if (!empty($item['name'])) { ?>
                                        <?php if ('yes' === $settings['show_title']) { ?>
                                            <div class="service-title">
                                                <?php if (!empty($item['icon_image']['url'])) { ?>
                                                    <div class="rs-step-icon">
                                                        <img decoding="async" src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>">
                                                    </div>
                                                <?php } ?>
                                                <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                    <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- Name And Icon End -->

                                    <!-- Description -->
                                    <?php if (!empty($item['description'])) : ?>
                                        <?php if ('yes' === $settings['show_desc']) : ?>
                                            <div class="service-desc">
                                                <p class="description"> <?php echo esc_html($description); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- Description End -->

                                    <!-- Button Style -->
                                    <?php if (!empty($settings['show_read'])) { ?>
                                        <div class="read__more">
                                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                <span class="custom-blog-btn">
                                                    <?php echo esc_html($settings['read__more']); ?>
                                                    <?php if (!empty($settings['show_read_icon']) && !empty($settings['btn_icon'])) { ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    <?php } ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- Button Style End -->

                                    <!-- Number Style Start -->
                                    <?php if (!empty($item['number_'])) : ?>
                                        <div class="numbering">
                                            <span><?php echo esc_html($nnumber); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Number Style End -->
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($services_style == '2') { ?>
                        <div class="grid-item">
                            <div class="rs-service-slider">
                                <?php if (!empty($image)) { ?>
                                    <div class="service-img">
                                        <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>><img class="rs-grid-img" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($item['name']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>"></a>
                                        <?php if (!empty($item['icon_image']['url'])) :
                                            $icon_image = wp_get_attachment_image_url($item['icon_image']['id'], 'full');
                                        ?>
                                            <div class="rs-step-icon">
                                                <img decoding="async" src="<?php echo esc_url($icon_image); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>


                                <div class="service-title-holder">
                                    <?php if (!empty($item['name'])) : ?>
                                        <?php if ('yes' === $settings['show_title']) : ?>
                                            <div class="service-title">
                                                <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                    <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item['description'])) : ?>
                                        <?php if ('yes' === $settings['show_desc']) : ?>
                                            <div class="service-desc">
                                                <p class="description"> <?php echo esc_html($description); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- Button Style -->
                                    <?php if (!empty($settings['show_read'])) { ?>
                                        <div class="read__more">
                                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                <?php echo esc_html($settings['read__more']); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- Button Style End -->
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($services_style == '3') { ?>
                        <div class="grid-item">
                            <div class="rs-service-slider">
                                <div class="service-title-holder">
                                    <?php if (!empty($image)) { ?>
                                        <div class="icon-image">
                                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>><img class="rs-grid-img" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($item['name']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>"></a>
                                        </div>
                                    <?php  } ?>
                                    <?php if (!empty($item['name'])) : ?>
                                        <?php if ('yes' === $settings['show_title']) : ?>
                                            <div class="service-title">
                                                <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                    <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php } elseif ($services_style == '4') { ?>
                        <div class="grid-item">
                            <div class="rs-service-slider">
                                <!-- Number Style Start -->
                                <?php if (!empty($item['number_'])) : ?>
                                    <div class="numbering">
                                        <span><?php echo esc_html($nnumber); ?></span>
                                    </div>
                                <?php endif; ?>
                                <!-- Number Style End -->
                                <?php if (!empty($image)) { ?>
                                    <div class="service-img">
                                        <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>><img class="rs-grid-img" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($item['name']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>"></a>
                                    </div>
                                <?php  } ?>
                                <div class="service-title-holder">
                                    <!-- Name And Icon -->
                                    <?php if (!empty($item['name'])) { ?>
                                        <?php if ('yes' === $settings['show_title']) { ?>
                                            <div class="service-title">
                                                <?php if (!empty($settings['icon_image']['url'])) { ?>
                                                    <div class="rs-step-icon">
                                                        <img decoding="async" src="<?php echo esc_url($settings['icon_image']['url']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>">
                                                    </div>
                                                <?php } ?>
                                                <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                    <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- Name And Icon End -->

                                    <!-- Description -->
                                    <?php if (!empty($item['description'])) : ?>
                                        <?php if ('yes' === $settings['show_desc']) : ?>
                                            <div class="service-desc">
                                                <p class="description"> <?php echo esc_html($description); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- Description End -->

                                    <!-- Button Style -->
                                    <?php if (!empty($settings['show_read'])) { ?>
                                        <div class="read__more">
                                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                <span class="custom-blog-btn">
                                                    <?php echo esc_html($settings['read__more']); ?>
                                                    <?php if (!empty($settings['show_read_icon']) && !empty($settings['btn_icon'])) { ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                    <?php } ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- Button Style End -->

                                </div>
                            </div>
                        </div>
                    <?php } elseif ($services_style == '5') { ?>
                        <div class="grid-item">
                            <div class="rs-service-slider">
                                <?php if (!empty($image)) { ?>
                                    <div class="service-img">
                                        <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>><img class="rs-grid-img" src="<?php echo esc_url($image); ?>" title="<?php echo esc_attr($item['name']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>"></a>
                                        <?php if (!empty($item['icon_image']['url'])) :
                                            $icon_image = wp_get_attachment_image_url($item['icon_image']['id'], 'full');
                                        ?>
                                            <div class="rs-step-icon">
                                                <img decoding="async" src="<?php echo esc_url($icon_image); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                <div class="service-title-holder">
                                    <?php if (!empty($item['name'])) : ?>
                                        <?php if ('yes' === $settings['show_title']) : ?>
                                            <div class="service-title">
                                                <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                    <<?php echo esc_attr($title_tag); ?> class="title"> <?php echo esc_attr($title); ?></<?php echo esc_attr($title_tag); ?>>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item['description'])) : ?>
                                        <?php if ('yes' === $settings['show_desc']) : ?>
                                            <div class="service-desc">
                                                <p class="description"> <?php echo esc_html($description); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <!-- Button Style -->
                                    <?php if (!empty($settings['show_read'])) { ?>
                                        <div class="read__more">
                                            <a href="<?php echo esc_url($link); ?>" <?php echo wp_kses_post($target); ?>>
                                                <?php echo esc_html($settings['read__more']); ?>
                                                <?php if (!empty($settings['show_read_icon']) && !empty($settings['btn_icon'])) { ?>
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <!-- Button Style End -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php endforeach; ?>

            </div>
            <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.rs-addon-slider-<?php echo $unique; ?>').each(function(index) {
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
