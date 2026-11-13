<?php
/**
 * Elementor RS Newsletter Widget.
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
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Service_Form_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'service-form-search';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Service Search', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-form';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'service-search', 'form', 'contact' ];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'prelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'button_color_scheme',
			[
				'label'   => esc_html__( 'Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal_color',
				'options' => [					
					'normal_color' => esc_html__( 'Normal Color', 'rsaddon'),
					'primary_color' => esc_html__( 'Primary Color', 'rsaddon'),
					'secondary_color' => esc_html__( 'Secondary Color', 'rsaddon'),
				],
			]
		);

        $this->add_control(
            'shortcode',
            [
                'label' => esc_html__( 'Shortcode Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Shortcode Here', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'placeholder',
			[
				'label'     => __( 'Placeholder', 'rsaddon' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Enter Service', 'rsaddon' ) . '...',
			]
		);

        $this->add_control(
			'search_label',
			[
				'label'     => __( 'Label Text', 'rsaddon' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Find Your Local Fixhero:', 'rsaddon' ),
			]
		);

        $this->add_control(
			'btn_text',
			[
				'label'     => __( 'Button Text', 'rsaddon' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Search Now', 'rsaddon' ),
			]
		);

        $this->add_control(
			'label_icons',
			[
				'label' => esc_html__( 'Label Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

        $this->add_control(
			'btn_search_icons',
			[
				'label' => esc_html__( 'Search Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

        $this->end_controls_section();
 
        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => esc_html__( 'Wrapper Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'input_btn_width',
			[
				'label' => esc_html__( 'Input Area Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .search-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'input_btn_max_width',
			[
				'label' => esc_html__( 'Input Area Max Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .search-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .rs-service-search-form',
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-service-search-form',
			]
		);

        $this->add_control(
            'placeholder_text_color',
            [
                'label'     => __('Placeholder Text Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form input::-webkit-input-placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_wrap_flex_wrap',
            [
                'label' => esc_html__( 'Flex Wrap', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'wrap' => [
                        'title' => esc_html__( 'Wrap', 'rsaddon' ),
                        'icon' => 'eicon-wrap',
                    ],
                    'nowrap' => [
                        'title' => esc_html__( 'No-Wrap', 'rsaddon' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form .search-wrap' => 'flex-wrap: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Label Style Start
        $this->start_controls_section(
            '_label',
            [
                'label' => esc_html__( 'Label', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'label_width',
			[
				'label' => esc_html__( 'Label Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .label-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'label_max_width',
			[
				'label' => esc_html__( 'Label Max Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .label-area' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .rs-service-search-form .label-area',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form .label-area' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form .label-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Label Style End

        $this->start_controls_section(
            'submit',
            [
                'label' => esc_html__( 'Submit Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Search Icon Size', 'prelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_text_typography',
                'selector' => '{{WRAPPER}} .rs-service-search-form button i,{{WRAPPER}} .rs-service-search-form button',
            ]
        );

        $this->add_control(
            'search_icon_color',
            [
                'label'     => __('Icon Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form button i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_hover_icon_color',
            [
                'label'     => __('Hover Icon Color', 'rsaddon'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form button:hover i' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .rs-service-search-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'button_width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'button_height',
			[
				'label' => esc_html__( 'Height', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );

            $this->add_control(
                'submit_color',
                [
                    'label' => esc_html__( 'Text Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .rs-service-search-form button' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'submits_gradiant_background',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .rs-service-search-form button',
                ]
            );

            $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'submits_gradiant_hover_background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rs-service-search-form button:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'field_style',
            [
                'label' => esc_html__( 'Field Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'placehoder_text_typography',
                'selector' => '{{WRAPPER}} ::-webkit-input-placeholder, {{WRAPPER}} ::-moz-input-placeholder,{{WRAPPER}} ::placeholder',
            ]
        );

        $this->add_control(
			'field_gap',
			[
				'label' => esc_html__( 'Field Gap', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .search-wrap ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'field_max_width',
			[
				'label' => esc_html__( 'Field Max Width', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .rs-service-search-form .search-input ' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        

        $this->add_responsive_control(
            'field_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form .search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form .search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'field_background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-service-search-form .search-input',
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__( 'Input Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-service-search-form input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_text_typography',
                'selector' => '{{WRAPPER}} .rs-service-search-form input[type="search"]',
            ]
        );

        $this->end_controls_section();
    }
    protected function render() {


        $settings = $this->get_settings_for_display();

        $btn_text = $settings['btn_text'];
        $search_label = $settings['search_label'];
        $placeholder = $settings['placeholder'];
        $btn_search_icons = $settings['btn_search_icons'];

		$this->add_render_attribute(
			'input',
			[
				'placeholder' => $settings['placeholder'],
				'class'       => 'hfe-search-form__input',
				'type'        => 'search',
				'name'        => 's',
				'title'       => __( 'Search', 'rsaddon' ),
				'value'       => get_search_query(),

			]
		);

		$this->add_render_attribute(
			'container',
			[
				'class' => [ 'hfe-search-form__container' ],
				'role'  => 'tablist',
			]
		);
        $title = !empty($_REQUEST['title']) ? $_REQUEST['title'] : ''; 
						
		?>
            <form role="search" class="search-form-style3 rs-service-search-form <?php echo $settings['button_color_scheme'] ?>" method="get" action="<?php echo esc_url( home_url( '/service-area/' ) ); ?>">
            <?php if(!empty($search_label)) { ?>
                <div class="label-area">
                    <?php 
                    if(!empty($settings['label_icons']['value'])) { 
                        \Elementor\Icons_Manager::render_icon( $settings['label_icons'], [ 'aria-hidden' => 'true' ] ); 
                    }
                    ?>
                    <label><?php echo $search_label;?></label>
                </div>
                <?php } ?>
                <div class="search-wrap">
                    <input type="search" placeholder="<?php echo $placeholder;?>" name="title" class="search-input" value="<?php echo esc_html( $title );?>" />
                    <input type="hidden" name="datashow" value="datashow">
                    <button type="submit"  value="Search">
                        <?php if(!empty($btn_text)) { 
                            echo $btn_text;
                         } else { ?>
                         <?php if( !empty($btn_search_icons['value'])) { 
                            \Elementor\Icons_Manager::render_icon( $btn_search_icons, [ 'aria-hidden' => 'true' ] ); 
                         } else { ?>
                        <i class="ri-search-line"></i>
                        <?php } ?>
                        <?php } ?>
                    </button>
                </div>
            </form>
        <?php
    }

}


