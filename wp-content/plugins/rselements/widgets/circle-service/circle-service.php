<?php
/**
 * Circle Service class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\POPOVER_TOGGLE;


defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Circle_Service_Widget extends \Elementor\Widget_Base {
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
        return 'rs-circle-service';
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
        return esc_html__( 'RS Circle Service', 'rsaddon' );
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
        return 'glyph-icon eicon-settings';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'service', 'circle', 'box', 'rs' ];
    }

	protected function register_controls() 
    {
        $this->register_general_controls();
        $this->register_wrapper_style_controls();
        $this->register_main_image_style_controls();
        $this->register_icon_box_wrapper_style_controls();
        $this->register_icon_style_controls();
        $this->register_text_style_controls();
    }

    protected function register_general_controls()
    {
        $this->start_controls_section(
            'section_circle_service_content',
            [
                'label' => __('Content', 'rsaddon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
            $this->add_responsive_control(
                'box_text_align',
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
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .rs-circle-service-box' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'auto_play',
                [
                    'label' => esc_html__( 'Auto Play', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'True', 'rsaddon' ),
                    'label_off' => esc_html__( 'False', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'animation_speed',
                [
                    'label' => esc_html__( 'Animation Speed (ms)', 'rsaddon' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 1200,
                    'condition' => [
                        'auto_play' => 'yes'
                    ]
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'icon_box_indivual_position_toggle',
                [
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label' => esc_html__( 'Box Position Controls', 'rsaddon' ),
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                ]
            );

            $repeater->start_popover();
                $repeater->add_responsive_control(
                    'icon_box_position_top_current',
                    [
                        'label' => esc_html__( 'Icon Box Top', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'icon_box_position_right_current',
                    [
                        'label' => esc_html__( 'Icon Box Right', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'icon_box_position_bottom_current',
                    [
                        'label' => esc_html__( 'Icon Box Bottom', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'icon_box_position_left_current',
                    [
                        'label' => esc_html__( 'Icon Box Left', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $repeater->end_popover();

            $repeater->add_control(
                'icon_current_item_background',
                [
                    'label' => esc_html__( 'Icon Box Background', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background: {{VALUE}};'
                    ]
                ]
            );

            // Icon
            $repeater->add_control(
                'icon_show',
                [
                    'label' => esc_html__( 'Icon Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'yes',
                ]
            );
            $repeater->add_control(
                'icon',
                [
                    'label' => esc_html__( 'Icon', 'rsaddon' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-cog',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'icon_show' => 'yes'
                    ]
                ]
            );
            $repeater->add_control(
                'icon_current_item_color',
                [
                    'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}};'
                    ],
                    'condition' => [
                        'icon_show' => 'yes'
                    ]
                ]
            );

            // Text
            $repeater->add_control(
                'text_show',
                [
                    'label' => esc_html__( 'Text Show', 'rsaddon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'rsaddon' ),
                    'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'yes',
                ]
            );
            $repeater->add_control(
                'text',
                [
                    'label' => esc_html__( 'Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Service', 'rsaddon' ),
                    'condition' => [
                        'text_show' => 'yes'
                    ]
                ]
            );
            $repeater->add_control(
                'text_current_item_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .rs-icon-text a' => 'color: {{VALUE}};'
                    ],
                    'condition' => [
                        'text_show' => 'yes'
                    ]
                ]
            );
            $repeater->add_control(
                'link',
                [
                    'label' => esc_html__('Link', 'rsaddon'),
                    'type' => Controls_Manager::URL,
                    'condition' => [
                        'text_show' => 'yes'
                    ]
                ]
            );
            $repeater->add_control(
                'text_indivual_position_toggle',
                [
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'label' => esc_html__( 'Text Position Controls', 'rsaddon' ),
                    'label_off' => esc_html__( 'Default', 'rsaddon' ),
                    'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                    'return_value' => 'yes',
                    'condition' => [
                        'text_show' => 'yes'
                    ]
                ]
            );

            $repeater->start_popover();
                $repeater->add_responsive_control(
                    'text_position_top_current',
                    [
                        'label' => esc_html__( 'Text Top', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .rs-icon-text' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_right_current',
                    [
                        'label' => esc_html__( 'Text Right', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .rs-icon-text' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_bottom_current',
                    [
                        'label' => esc_html__( 'Text Bottom', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .rs-icon-text' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_left_current',
                    [
                        'label' => esc_html__( 'Text Left', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .rs-icon-text' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                // Hover
                $repeater->add_control(
                    'text_position_options_hover_heading',
                    [
                        'label' => esc_html__( 'Hover Options', 'rsaddon' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_top_current_hover',
                    [
                        'label' => esc_html__( 'Text Top', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}:hover .rs-icon-text,
                            {{WRAPPER}} {{CURRENT_ITEM}}.active .rs-icon-text' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_right_current_hover',
                    [
                        'label' => esc_html__( 'Text Right', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}:hover .rs-icon-text,
                            {{WRAPPER}} {{CURRENT_ITEM}}.active .rs-icon-text' => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_bottom_current_hover',
                    [
                        'label' => esc_html__( 'Text Bottom', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}:hover .rs-icon-text,
                            {{WRAPPER}} {{CURRENT_ITEM}}.active .rs-icon-text' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'text_position_left_current_hover',
                    [
                        'label' => esc_html__( 'Text Left', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'custom' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}:hover .rs-icon-text,
                            {{WRAPPER}} {{CURRENT_ITEM}}.active .rs-icon-text' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $repeater->end_popover();

            $this->add_control(
                'services_list',
                [
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'show_label' => false,
                    'default' => [
                        [
                            'text' => esc_html__( 'AC Repair', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Plumbing', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Re-Construction', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Painting', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Home Renovation', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Carpenter', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Electrical', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Window & Door', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                        [
                            'text' => esc_html__( 'Gadget Repair', 'rsaddon' ),
                            'icon' => 'fas fa-cog',
                        ],
                    ],
                    'title_field' => '{{{ text }}}',
                ]
            );

            $this->add_control(
                'main_image',
                [
                    'label' => esc_html__('Main Image', 'rsaddon'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
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

        $this->end_controls_section();
    }

    protected function register_wrapper_style_controls()
    {
        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label'     => __('Wrapper Style', 'rsaddon'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_content_align',
            [
                'label' => esc_html__( 'Content Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'auto 0 0 0' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    '0 auto' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    '0 0 0 auto' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => '0 auto',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box' => 'margin: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_horizontal_align',
            [
                'label' => esc_html__( 'Box Style (Flex / Block)', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-circle-service-box' => 'display: {{VALUE}}; flex-direction: column;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'wrapper_vertical_align',
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
                'default' => 'center',
                'condition' => [
                    'wrapper_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_h_align',
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
                'default' => 'center',
                'condition' => [
                    'wrapper_horizontal_align' => 'flex',
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_main_image_style_controls()
    {
        $this->start_controls_section(
            'section_main_image_style',
            [
                'label'     => __('Main Image Style', 'rsaddon'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'main_image_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-circle-service-box .main-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'main_image_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-circle-service-box .main-image' => 'height: {{SIZE}}{{UNIT}}; width: auto;',
                ],
            ]
        );

        // Circle Optins
        $this->add_control(
            'main_image_circle_options_heading',
            [
                'label' => esc_html__( 'Circle Options', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_image_circle_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-circle-service-box .main-image:before',
            ]
        );
        $this->add_control(
            'main_image_circle_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .main-image:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'main_image_circle_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-circle-service-box .main-image:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'main_image_circle_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                    '{{WRAPPER}} .rs-circle-service-box .main-image:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'main_image_circle_opacity',
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
                'default' => [
                    'size' => 0.1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .main-image:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function register_icon_box_wrapper_style_controls()
    {
        $this->start_controls_section(
            'section_icon_box_wrapper_style',
            [
                'label'     => __('Icon Box Wrapper Style', 'rsaddon'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_box_wrapper_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 545,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_box_wrapper_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 545,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_box_wrapper_background',
                'types' => [ 'classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper',
            ]
        );

        $this->add_control(
            'icon_box_wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_wrapper_position_toggle',
            [
                'label' => esc_html__( 'Position Controls', 'rsaddon' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => esc_html__( 'Default', 'rsaddon' ),
                'label_on' => esc_html__( 'Custom', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->start_popover();
            $this->add_responsive_control(
                'icon_box_wrapper_position_top',
                [
                    'label' => esc_html__( 'Top', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'icon_box_wrapper_position_right',
                [
                    'label' => esc_html__( 'Right', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'icon_box_wrapper_position_bottom',
                [
                    'label' => esc_html__( 'Bottom', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'icon_box_wrapper_position_left',
                [
                    'label' => esc_html__( 'Left', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => -1000,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_popover();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_box_wrapper_border',
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_icon_style_controls()
    {
        $this->start_controls_section(
            'section_icon_style',
            [
                'label'     => __('Icon Style', 'rsaddon'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
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
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon-border',
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_text_style_controls()
    {
        $this->start_controls_section(
            'section_text_style',
            [
                'label'     => __('Text Style', 'rsaddon'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon .rs-icon-text',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon .rs-icon-text a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_color_hover',
            [
                'label' => esc_html__( 'Color ( Hover )', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-circle-service-box .service-icons-wrapper .rs-icon .rs-icon-text a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
    * Render the widget output on the frontend.
    *
    * Written in PHP and used to generate the final HTML.
    */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $image = wp_get_attachment_image_url( $settings['main_image']['id'], $settings['thumbnail_size']);
        $alt = Control_Media::get_image_alt($settings['main_image']);
        if ( ! $image ) {
            $image = Utils::get_placeholder_image_src();
            $alt = '';
        }
        ?>

        <div class="rs-circle-service-box">
            <div class="main-image">
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr($alt); ?>">
            </div>
            <ul class="service-icons-wrapper">
                <?php foreach ($settings['services_list'] as $index => $service) :
                    $link = !empty($service['link']['url']) ? $service['link']['url'] : '#'; ?>
                    <li class="rs-icon <?php echo esc_attr('elementor-repeater-item-' . $service['_id']); ?>">
                        <?php if('yes' == $service['icon_show']){ ?>
                            <?php if ($service['icon']) : ?>
                                    <?php
                                    Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true']);
                                    ?>

                            <?php endif; ?>
                        <?php } ?>
                        <?php if('yes' == $service['text_show']){ ?>
                            <div class="rs-icon-text"><a href="<?php echo esc_url($link);?>"><?php echo wp_kses_post($service['text']); ?></a></div>
                        <?php } ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if('yes' == $settings['auto_play']){ ?>
            <script>
                jQuery(document).ready(function() {
                    var switches = jQuery('.rs-circle-service-box .rs-icon');
                    var currentIndex = 0;
                    var interval;
                    var speed = <?php echo esc_html($settings['animation_speed']); ?>;

                    function startRotation() {
                        interval = setInterval(function() {
                            switches.eq(currentIndex).removeClass('active');
                            currentIndex = (currentIndex + 1) % switches.length;
                            switches.eq(currentIndex).addClass('active');
                        }, speed);
                    }
                    function stopRotation() {
                        clearInterval(interval);
                        switches.eq(currentIndex).removeClass('active');
                    }
                    startRotation();
                    switches.hover(
                        function() {
                            stopRotation();
                        },
                        function() {
                            startRotation();
                        }
                    );
                });
            </script>
        <?php } ?>
    <?php
    }
}
