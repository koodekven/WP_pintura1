<?php
/**
 * Pricing table widget class
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


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Pricing_Table_List extends \Elementor\Widget_Base {

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
        return 'rsprice_list';
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
        return esc_html__( 'RS Pricing List', 'rsaddon' );
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

       

      
        // Short Description End

        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__( 'Features', 'rsaddon' ),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'pricing_title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Exciting Feature', 'rsaddon' ),

            ]
        );

        $repeater->add_control(
            'pricing_text',
            [
                'label' => esc_html__( 'Pricing Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '$49.00', 'rsaddon' ),

            ]
        );

        $repeater->add_control(
            'per_sprt',
            [
                'label' => esc_html__( 'Per Square Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '/ Per Sq.ft', 'rsaddon' ),

            ]
        );
      

        $repeater->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',			
				'options' => [
					'' => esc_html( 'Select','rsaddon' ),					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
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
        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'pricing_title' => esc_html__( 'Awesome Features', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'pricing_title' => esc_html__( 'Responsive Pricing Table', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'pricing_title' => esc_html__( 'Yearly Subscribe', 'rsaddon' ),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'pricing_title' => esc_html__( 'Professional Design', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ pricing_title }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
		    '_wrapper_style',
		    [
		        'label' => esc_html__( 'Wrapper Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
        $this->add_control(
			'wrapper_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'wrapper_hover_bg_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
		    '_image_style',
		    [
		        'label' => esc_html__( 'Image Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
        $this->add_responsive_control(
            'pricing_image_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-icon-image .pricing-list-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pricing_image_height',
            [
                'label' => esc_html__( 'Image Height', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-icon-image .pricing-list-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
		    '_title_style',
		    [
		        'label' => esc_html__( 'Title Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-price-table-list .rs-pricing-list .pricing-title',
		    ]
		);
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .pricing-title' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->end_controls_section();
        $this->start_controls_section(
		    '_pricing_style',
		    [
		        'label' => esc_html__( 'Pricing Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'pricing_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-price-table-list .rs-pricing-list .pricing-sqrt-image',
		    ]
		);
        $this->add_control(
			'pricing_color',
			[
				'label' => esc_html__( 'Pricing Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-sqrt-image' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'pricing_color_hover',
			[
				'label' => esc_html__( 'Pricing Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .pricing-sqrt-image' => 'color: {{VALUE}}',
				],
			]
		);
		
        $this->add_responsive_control(
		    'pricing_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-sqrt-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'pricing_sqrt_typography',
		        'label' => esc_html__( 'Pricing Small Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-price-table-list .rs-pricing-list .pricing-sqrt-image span',
		    ]
		);
        $this->add_control(
			'pricing_sqrtcolor',
			[
				'label' => esc_html__( 'Pricing Small text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .pricing-sqrt-image span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'pricing_sqrtcolor_hover',
			[
				'label' => esc_html__( 'Pricing Small text Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .pricing-sqrt-image span' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
		    '_button_style',
		    [
		        'label' => esc_html__( 'Button Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'button_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn span',
		    ]
		);	


		$this->add_responsive_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'pricing_btn_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'button_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
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
			'button_text_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list .rs-pricing-table-btn' => 'background: {{VALUE}}',
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
			'button_text_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .rs-pricing-table-btn,{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .rs-pricing-table-btn i' => 'color: {{VALUE}}',
				],
			]
		);	

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-price-table-list .rs-pricing-list ul:hover .rs-pricing-table-btn' => 'background: {{VALUE}}',
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

        <div class="rs-price-table-list"> 
            <div class="rs-pricing-list">
            <?php
				foreach ( $settings['features_list'] as $item ) { 
                    $this->add_inline_editing_attributes( 'button_text', 'none' );
                    $this->add_render_attribute( 'button_text', 'class', 'rs-pricing-table-btn' );

                    $this->add_render_attribute( 'button_text', 'href', esc_url( $item['button_link']['url'] ) );
                    if ( ! empty( $item['button_link']['is_external'] ) ) {
                        $this->add_render_attribute( 'button_text', 'target', '_blank' );
                    }
                    if ( ! empty( $item['button_link']['nofollow'] ) ) {
                        $this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
                    }

                    $pricing_title = $item['pricing_title'];
                    $pricing_text = $item['pricing_text'];
                    $per_sprt = $item['per_sprt'];

                    ?>
                <ul>
                    <li class="pricing-icon-image">
                    <?php if( !empty($item['selected_icon']) || !empty($item['selected_image']['url'])){?>
                        <span class="pricing-list-icon">
                            <?php if(!empty($item['selected_icon'])) : ?>
                                <?php \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php endif; ?>

                            <?php if(!empty($item['selected_image'])) :?>
                                <img src="<?php echo esc_url($item['selected_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['selected_image'])); ?>"/>
                            <?php endif;?>
                        </span>
                        <span class="pricing-title"><?php echo esc_html($pricing_title);?></span>
		    			<?php } ?>
                    </li>
                    <li class="pricing-sqrt-image"><?php echo esc_html($pricing_text);?> <span><?php echo $per_sprt;?></span></li>
                    <li class="rs-pricing-btn">
                        <?php if ( $item['button_text'] ) : ?>
                        <div class="btn-part">
                            <a <?php $this->print_render_attribute_string( 'button_text' ); ?>>
                                <span class="btn_text"><?php echo esc_html( $item['button_text'] ); ?></span><i class="ri-arrow-right-fill"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                    </li>
                </ul>
               <?php } ?>
            </div>
        </div>
        <?php
    }
}
