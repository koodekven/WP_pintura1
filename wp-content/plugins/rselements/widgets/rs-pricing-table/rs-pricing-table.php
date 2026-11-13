<?php
/**
 * Pricing table widget class
 *
 */
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Pricing_RS_Table_Widget extends \Elementor\Widget_Base {

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
        return 'rsprices';
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
        return esc_html__( 'RS Pricing Switcher', 'rsaddon' );
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
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'pricing', 'table', 'package', 'product', 'plan' ];
    }

	protected function register_controls() {



        $this->start_controls_section(
            '_section_price',
            [
                'label' => esc_html__( 'Pricing Table', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        
        $this->add_control(
            'price_showhide',
            [
                'label' => esc_html__( 'Price Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'monthly_title',
            [
                'label' => esc_html__( 'Monthly Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Monthly',
                'condition' => [
					'price_showhide' => 'yes',
				],
            ]
        );

        $this->add_control(
            'yearly_title',
            [
                'label' => esc_html__( 'Yearly Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Yearly',
                'condition' => [
					'price_showhide' => 'yes',
				],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'monthly_options',
            [
                'label' => esc_html__( 'Monthly Pricing Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '$29.00', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Monthly', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Monthly Text', 'rsaddon' ),
            ]
        );
        
        $repeater->add_control(
            'badge',
            [
                'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'features',
            [
                'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'rows'    => 10, 
                'default' => esc_html__( '1 Users', 'rsaddon' ),          
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Get Started', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        //Yearly Content
        $repeater->add_control(
            'yearly_options',
            [
                'label' => esc_html__( 'Yearly Pricing Here', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'title_yearly',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'price_yearly',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '$59.00', 'rsaddon' ),
            ]
        );

        $repeater->add_control(
            'description_yearly',
            [
                'label' => esc_html__( 'Yearly', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Yearly Text', 'rsaddon' ),               
            ]
        );

        $repeater->add_control(
            'badge_yearly',
            [
                'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'features_yearly',
            [
                'label'   => esc_html__( 'Features (Use List Style)', 'rsaddon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'rows'    => 10,
                'default' => esc_html__( '1 Users', 'rsaddon' ),         
            ]
        );

        $repeater->add_control(
            'button_text_yearly',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Get Started', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'button_link_yearly',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'price_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_months',
            [
                'label' => esc_html__( 'Monthly & Yearly Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'pricing_align_style',
            [
                'label' => esc_html__( 'Pricing Alignment', 'rsaddon' ),
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
                'selectors' => [
                    '{{WRAPPER}}  .rs-pricing-container .pricing-switcher' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_colors_fie',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-switcher .fieldset',
            ]
        );

        $this->add_control(
			'pricing_switcher_position_heading',
			[
				'label' => esc_html__( 'Pricing Switcher Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_responsive_control(
			'pricing_switcher_position_y_top',
			[
				'label' => esc_html__( 'Top', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_x_right',
			[
				'label' => esc_html__( 'Right', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'right: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_y_bottom',
			[
				'label' => esc_html__( 'Bottom', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_responsive_control(
			'pricing_switcher_position_x_left',
			[
				'label' => esc_html__( 'Left', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'left: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);

        $this->add_control(
            'switcher_bg_heading',
            [
                'label' => esc_html__( 'Switcher Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'switcher_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-switcher .switch',
            ]
        );

        $this->add_control(
            'switcher_normal_color',
            [
                'label' => esc_html__( 'Switcher Color (Normal)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'switcher_active_color',
            [
                'label' => esc_html__( 'Switcher Color (Active)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset.mnt-ac .rs-mnt, .pricing-switcher .fieldset.mnt-acs .rs-yrs' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
			'fieldset_max_width',
			[
				'label' => esc_html__( 'Fieldset Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher .fieldset' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'yearly_position',
			[
				'label' => esc_html__( 'Yearly Left Position', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-switcher input[type=radio]:checked + label + .switch, .pricing-switcher input[type=radio]:checked + label:nth-of-type(n) + .switch' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'switcher_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .pricing-switcher label',
            ]
        );

        $this->add_responsive_control(
            'year_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'year_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-switcher .fieldset' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'price_menu_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-switcher .fieldset',
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'Item Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gradient_color_showhide',
            [
                'label'   => esc_html__( 'Gradient Color', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'gradient_disable',
                'options' => [                  
                    'gradient_enable' => esc_html__( 'Enable', 'rsaddon'),
                    'gradient_disable' => esc_html__( 'Disable', 'rsaddon'),
                ],
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
                    '{{WRAPPER}}  .rs-pricing-container' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li',
            ]
        );

        

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-wrapper > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-wrapper > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_style_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-list .pricing-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li',
            ]
        );

        $this->add_control(
            'box_shadow_hover_title',
            [
                'label' => esc_html__( 'Hover Box-show', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow_hover',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-wrapper > li:hover',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__( 'Header Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'headtitle_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header h3',
            ]
        );

        $this->add_responsive_control(
            'price_align',
            [
                'label' => esc_html__( 'Price Alignment', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'gradient_color' => 'gradient_disable',
                ], 
            ]
        );

        $this->add_control(
            'btn_border_gradient_heading_price',
            [
                'label' => esc_html__( 'Price Gradient Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'price_gradient_color',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gradient_enable .pricing-header .price',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Price Typography', 'rsaddon' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header .price',
            ]
        );

        $this->add_responsive_control(
            'title_paddings',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'des_list_color',
            [
                'label' => esc_html__( 'Description Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner span' => 'color: {{VALUE}}; opacity:1;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Description Typography', 'rsaddon' ),
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header .price-inner span',
            ]
        );

        $this->add_control(
            'short_desc_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_border',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-header:after' => 'background: {{VALUE}}; opacity:1;',
                ],
            ]
        );

        $this->add_control(
            'header_buttom_bg',
            [
                'label' => esc_html__( 'Header Bottom Border Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'header_buttom_grdient_bg',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-header:after',
            ]
        );

        $this->end_controls_section();

        // Badge Style Start
        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__( 'Badge Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'badge_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pricebadge' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'badge_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .pricebadge',
		        
		    ]
		);
        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricebadge' => 'color: {{VALUE}};',                   
                ],
            ]
        );
        $this->add_responsive_control(
		    'badge_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'badge_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'badge_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricebadge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'badge_background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricebadge',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .pricebadge',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricebadge'
            ]
        );
        $this->add_control(
			'badge_width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'badge_align_width_base',
            [
                'label' => esc_html__( 'Alignment (If Given Width)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => '',
                'options' => [
                    '' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    '0 auto' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    '0 0 0 auto' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'eicon-text-align-right',
                    ],
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .pricebadge' => 'margin: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
			'badge_position_heading',
			[
				'label' => esc_html__( 'Badge Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'badge_position_y_top',
			[
				'label' => esc_html__( 'Top', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'top: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_control(
			'badge_position_x_right',
			[
				'label' => esc_html__( 'Right', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'right: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_control(
			'badge_position_y_bottom',
			[
				'label' => esc_html__( 'Bottom', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'bottom: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);
        $this->add_control(
			'badge_position_x_left',
			[
				'label' => esc_html__( 'Left', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pricebadge' => 'left: {{SIZE}}{{UNIT}}; position: absolute;',
				],
			]
		);

        $this->end_controls_section();
        // Badge Style End

        $this->start_controls_section(
            '_section_style_body',
            [
                'label' => esc_html__( 'Pricing Body Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align_body',
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
                    '{{WRAPPER}}  .pricing-body' => 'text-align: {{VALUE}}'
                ]
            ]
        );



        $this->add_control(
            'des_features_color',
            [
                'label' => esc_html__( 'Features Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'des_close_features_color',
            [
                'label' => esc_html__( 'Close Features Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li.close-icon' => 'color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'icon_features_color',
            [
                'label' => esc_html__( 'Check Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body .features ul li:before' => 'color: {{VALUE}};',
                    'condition' => [
                        'gradient_color' => 'gradient_disable',
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_gradient',
            [
                'label' => esc_html__( 'Check Icon Gradient Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'check_icon_gradient',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .pricing-body .features ul li:before',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ],
            ]
        );



        $this->add_control(
            'icon_border_features_color',
            [
                'label' => esc_html__( 'Close Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-body .features ul li.close-icon:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => esc_html__( 'Features Typography', 'rsaddon' ),
                'name' => 'features_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li',
            ]
        );
        $this->add_control(
            'item_fea_desc_margin',
            [
                'label' => esc_html__( 'Margin (Per Item)', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body .features ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'body_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background__sd',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-footer a:before, {{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_control(
            'btn_border_gradient_heading',
            [
                'label' => esc_html__( 'Button Border Color', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_gradient_bg',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-footer a',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-footer a',
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-footer a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a',
            ]
        );

        $this->add_control(
            'gradient_color',
            [
                'label'   => esc_html__( 'Gradient Color', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'gradient_disable',
                'options' => [                  
                    'gradient_enable' => esc_html__( 'Enable', 'rsaddon'),
                    'gradient_disable' => esc_html__( 'Disable', 'rsaddon'),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hover',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container .pricing-wrapper > li:hover .pricing-footer a',
                'condition' => [
                    'gradient_color' => 'gradient_disable',
                ], 
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hover_gradientds',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-container.gradient_enable .pricing-wrapper > li:hover .pricing-footer a:before',
                'condition' => [
                    'gradient_color' => 'gradient_enable',
                ], 
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        

        <div class="pricing-container rs-pricing-container <?php echo esc_attr( $settings['gradient_color'] ); ?>">
             <?php if(($settings['price_showhide'] == 'yes') ){ ?>
                <div class="pricing-switcher">
                    <p class="fieldset mnt-ac" style="text-align:
                    center;">
                        <input type="radio" name="duration-1" value="monthly" id="monthly-1" checked>
                        <label for="monthly-1" id ="rsmnt" class="rs-mnt"><?php echo wp_kses_post($settings['monthly_title']);?>  </label>
                        <input type="radio" name="duration-1" value="yearly" id="yearly-1">
                        <label for="yearly-1" id ="rsyrs" class="rs-yrs"><?php echo wp_kses_post($settings['yearly_title']);?>  </label>
                        <span class="switch"></span>
                    </p>
                </div>
            <?php } ?>

            <ul class="pricing-list bounce-invert">
                <?php foreach ( $settings['price_list'] as $items => $item ) { ?>
                    <?php 
                        $title                  = !empty($item['title']) ? $item['title'] : '';                            
                        $price                  = !empty($item['price']) ? $item['price'] : '';                            
                        $description            = !empty($item['description']) ? $item['description'] : '';                            
                        $badge                  = !empty($item['badge']) ? $item['badge'] : '';                           
                        $features               = !empty($item['features']) ? $item['features'] : '';                            
                        $button_text            = !empty($item['button_text']) ? $item['button_text'] : '';                            
                        $target                 = !empty($item['button_link']['is_external']) ? 'target=_blank' : '';  
                        $button_link            = !empty($item['button_link']['url']) ? $item['button_link']['url'] : '';

                        $title_yearly           = !empty($item['title_yearly']) ? $item['title_yearly'] : '';                            
                        $price_yearly           = !empty($item['price_yearly']) ? $item['price_yearly'] : '';                            
                        $description_yearly     = !empty($item['description_yearly']) ? $item['description_yearly'] : '';
                        $badge_yearly           = !empty($item['badge_yearly']) ? $item['badge_yearly'] : ''; 
                        $features_yearly        = !empty($item['features_yearly']) ? $item['features_yearly'] : '';                            
                        $button_text_yearly     = !empty($item['button_text_yearly']) ? $item['button_text_yearly'] : '';       
                        $target                 = !empty($item['button_link_yearly']['is_external']) ? 'target=_blank' : '';  
                        $button_link_yearly     = !empty($item['button_link_yearly']['url']) ? $item['button_link_yearly']['url'] : '';

                    ?>
                    <li class="exclusive">
                        <ul class="pricing-wrapper"> 

                            <li data-type="monthly" class="is-visible">
                                <?php if(!empty($badge)){ ?>
                                    <div class="pricebadge"><?php echo esc_attr ($badge);?></div>
                                <?php } ?>
                                <header class="pricing-header">
                                    <h3><?php echo esc_attr ($title);?></h3>
                                    <div class="price-inner">
                                        <div class="price"><?php echo esc_attr ($price);?></div>
                                        <?php if(!empty($description)){ ?>
                                            <span><?php echo esc_attr ($description);?></span>
                                        <?php } ?>
                                    </div>
                                </header>

                                <div class="pricing-body">  
                                    <?php if(!empty($features)){ ?>
                                        <div class="features"><?php echo wp_kses_post ($features);?></div>
                                    <?php } ?>
                                </div>

                                <?php if(!empty($button_text)){ ?> 
                                <footer class="pricing-footer">
                                    <a href="<?php echo esc_url($button_link);?>" <?php echo wp_kses_post($target);?>><span><?php echo esc_attr ($button_text);?></span></a>
                                </footer>
                                <?php } ?>

                            </li>

                            <li data-type="yearly" class="is-hidden">
                                <?php if(!empty($badge_yearly)){ ?>
                                    <div class="pricebadge"><?php echo esc_attr ($badge_yearly);?></div>
                                <?php } ?>
                                <header class="pricing-header">
                                    <h3><?php echo esc_attr ($title_yearly);?></h3>

                                    <div class="price-inner">
                                        <div class="price"><?php echo esc_attr ($price_yearly);?></div>
                                        <?php if(!empty($description_yearly)){ ?>
                                            <span><?php echo esc_attr ($description_yearly);?></span>
                                        <?php } ?>
                                    </div>


                                </header>
                                <div class="pricing-body">                                    
                                    <div class="features"><?php echo wp_kses_post ($features_yearly);?></div>
                                </div>
                                <footer class="pricing-footer">
                                    <a href="<?php echo esc_url($button_link_yearly);?>" <?php echo wp_kses_post($target);?>><span><?php echo esc_attr ($button_text_yearly);?></span></a>
                                </footer>
                            </li>

                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
    }
}
