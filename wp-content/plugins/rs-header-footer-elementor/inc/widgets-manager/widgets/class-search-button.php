<?php
namespace RSHFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Search_Button extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'hfe-search-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'RS Search', 'rs-header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor-circle';
	}

	/**
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hfe-frontend-js' ];
	}

	/**
	 * Register Search Button controls.
	 */
	protected function register_controls() {
		$this->register_general_content_controls();
		$this->register_search_style_controls();
	}
	/**
	 * Register Search General Controls.
	 */
	protected function register_general_content_controls() {
		$this->start_controls_section(
			'section_general_fields',
			[
				'label' => __( 'Search Box', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'        => __( 'Layout', 'rs-header-footer-elementor' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'icon',
				'options'      => [					
				'icon'      => __( 'Style 1', 'rs-header-footer-elementor' ),
				'style2'      => __( 'Style 2', 'rs-header-footer-elementor' ),
				'style3'      => __( 'Style 3', 'rs-header-footer-elementor' ),
				],
				'prefix_class' => 'hfe-search-layout-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'     => __( 'Placeholder', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Type & Hit Enter', 'rs-header-footer-elementor' ) . '...',
				'condition'	=> [
					'layout!'=> 'style3'
				],
			]
		);

		$this->add_responsive_control(
			'size',
			[
				'label'              => __( 'Size', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'size' => 50,
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-search-form__container' => 'min-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-search-submit'      => 'min-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-search-form__input' => 'padding-left: calc({{SIZE}}{{UNIT}} / 5); padding-right: calc({{SIZE}}{{UNIT}} / 5)',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
				'condition'	=> [
					'layout!'=> 'style3'
				],
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Register Search Style Controls.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function register_search_style_controls() {
		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Input', 'rs-header-footer-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'selector' => ' {{WRAPPER}} .rs_stickys_form.search-form .search-input, {{WRAPPER}} .search-form-style3 .search-wrap',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_responsive_control(
			'input_icon_size',
			[
				'label'              => __( 'Width', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'            => [
					'size' => 250,
				],
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .rs_stickys_form.search-form' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'          => [
					'layout' => 'icon',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
		    'input_position_x',
		    [
		        'label' => esc_html__( 'Position (X)', 'prelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_stickys_form.search-form' => 'right: {{SIZE}}{{UNIT}};',                   
		        ],
		        'condition'=> [
		        	'layout!' => 'style3'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'input_position',
		    [
		        'label' => esc_html__( 'Position (Y)', 'prelements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs_stickys_form.search-form ' => 'top: {{SIZE}}{{UNIT}};',                   
		        ], 
		        'condition'=> [
		        	'layout!' => 'style3'
		        ]
		    ]
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

			$this->start_controls_tab(
				'tab_input_normal',
				[
					'label'     => __( 'Normal', 'rs-header-footer-elementor' ),
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_control(
				'input_text_color',
				[
					'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input,{{WRAPPER}} .bs-search.search-form-style3 .search-wrap input' => 'color: {{VALUE}}',
					],
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_control(
				'input_placeholder_color',
				[
					'label'     => __( 'Placeholder Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input::placeholder, {{WRAPPER}} .bs-search.search-form-style3 .search-wrap input::placeholder' => 'color: {{VALUE}}',
					],
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_control(
				'input_background_color',
				[
					'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ededed',
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input, {{WRAPPER}} .bs-search.search-form-style3 .search-wrap input' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'input_box_shadow',
					'selector'  => '{{WRAPPER}} .rs_stickys_form.search-form .search-input, {{WRAPPER}} .bs-search.search-form-style3 .search-wrap input',
					'condition' => [
						'layout!' => ['icon','style3'],
					],
				]
			);
			$this->add_responsive_control(
				'border_radius',
				[
					'label'     => __( 'Border Radius', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default'   => [
						'size' => 3,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input, {{WRAPPER}} .bs-search.search-form-style3 .search-wrap input' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
					'separator' => 'before',
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_input_focus',
				[
					'label'     => __( 'Focus', 'rs-header-footer-elementor' ),
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_control(
				'input_placeholder_hover_color',
				[
					'label'     => __( 'Placeholder Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'global'    => [
						'default' => Global_Colors::COLOR_TEXT,
					],
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus::placeholder' => 'color: {{VALUE}}',
					],
					'condition' => [
						'layout!' => ['icon','style3'],
					],
				]
			);
			$this->add_control(
				'input_background_color_focus',
				[
					'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus, {{WRAPPER}} .bs-search.search-form-style3 .search-wrap input:focus' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'layout!' => 'icon',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'           => 'input_box_shadow_focus',
					'selector'       =>
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input',
					'fields_options' => [
						'box_shadow_type' => [
							'separator' => 'default',
						],
					],
					'condition'      => [
						'layout!' => ['icon','style3'],
					],
				]
			);
			$this->add_control(
				'input_border_color_focus',
				[
					'label'     => __( 'Border Color', 'rs-header-footer-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'border-color: {{VALUE}}',
					],
					'condition' => [
						'layout!' => ['icon','style3'],
					],
				]
			);
			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_text_color_focus',
			[
				'label'     => __( 'Text Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus, {{WRAPPER}} .search-form-style3 .bs-search input:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_text_background_color_focus',
			[
				'label'     => __( 'Background Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input:focus, {{WRAPPER}} .search-form-style3 .bs-search input:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_focus_border_radius',
			[
				'label'     => __( 'Border Radius', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .rs_stickys_form.search-form .search-input' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'layout' => 'icon',
				],
			]
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_toggle_style',
			[
				'label'     => __( 'Icon', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'icon',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_color' );

		$this->start_controls_tab(
			'tab_toggle_normal',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-search-icon-toggle i, {{WRAPPER}} .search_icons i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_hover',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-search-icon-toggle i:hover, {{WRAPPER}} .search_icons i:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_icon_size',
			[
				'label'              => __( 'Icon Size', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => [
					'size' => 15,
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-search-icon-toggle input[type=search]' => 'padding: 0 calc( {{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .hfe-search-icon-toggle i:before, {{WRAPPER}} .search_icons i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hfe-search-icon-toggle i, {{WRAPPER}} .hfe-search-icon-toggle' => 'width: {{SIZE}}{{UNIT}};',

				],
				'condition'          => [
					'layout' => 'icon',
				],
				'separator'          => 'before',
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_close_icon',
			[
				'label'     => __( 'Close Icon', 'rs-header-footer-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => ['icon','style3'],
				],
			]
		);

		$this->add_responsive_control(
			'close_icon_size',
			[
				'label'              => __( 'Size', 'rs-header-footer-elementor' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default'            => [
					'size' => '20',
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-search-form__container button#clear i:before,
					{{WRAPPER}} .hfe-search-icon-toggle button#clear i:before,
				{{WRAPPER}} .hfe-search-form__container button#clear-with-button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,

			]
		);

		$this->start_controls_tabs( 'close_icon_normal' );

		$this->start_controls_tab(
			'normal_close_button',
			[
				'label' => __( 'Normal', 'rs-header-footer-elementor' ),
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => esc_html__( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .search_icons.style2'				
			]
		);


		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '#7a7a7a',
				'selectors' => [
					'{{WRAPPER}} .hfe-search-form__container button#clear-with-button,
					{{WRAPPER}} .hfe-search-form__container button#clear,
					{{WRAPPER}} .search_icons .ri-search-line,
					{{WRAPPER}} .hfe-search-icon-toggle button#clear' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
		    'close_icon_color',
		    [
		        'label' => esc_html__( 'Close Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .ri-close-line:before' => 'color: {{VALUE}};',
		        ]
		    ]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_close_icon',
			[
				'label' => __( 'Hover', 'rs-header-footer-elementor' ),
			]
		);

		$this->add_control(
			'hover_close_icon_text',
			[
				'label'     => __( 'Color', 'rs-header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-search-form__container button#clear-with-button:hover,
					{{WRAPPER}} .search_icons .ri-search-line:hover,
					{{WRAPPER}} .hfe-search-form__container button#clear:hover,
					{{WRAPPER}} .hfe-search-icon-toggle button#clear:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// 

		$this->start_controls_section(
			'style_section_for_style_three',
			[
				'label' => esc_html__( 'Input & Button', 'rs-header-footer-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style3',
				],
			]
		);

			$this->start_controls_tabs(
				'style_three_input_tabs'
			);

				$this->start_controls_tab(
					'style_three_input_normal_tab',
					[
						'label' => esc_html__( 'Input', 'rs-header-footer-elementor' ),
					]
				);
					$this->add_responsive_control(
						's_t_input_padding',

							[
								'label' => esc_html__( 'Padding', 'textdomain' ),
								'type' => \Elementor\Controls_Manager::DIMENSIONS,
								'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
								'selectors' => [
									'{{WRAPPER}} .search-form-style3 .search-wrap input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 's_t_input_border',
							'selector' => '{{WRAPPER}} .search-form-style3 .search-wrap input',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'style_three_btn_tab',
					[
						'label' => esc_html__( 'Button', 'rs-header-footer-elementor' ),
					]
				);

					$this->add_responsive_control(
						's_t_btn_padding',

							[
								'label' => esc_html__( 'Padding', 'rs-header-footer-elementor' ),
								'type' => \Elementor\Controls_Manager::DIMENSIONS,
								'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
								'selectors' => [
									'{{WRAPPER}} .search-form-style3 .search-wrap button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
					);
					$this->add_control(
						's_t_btn_bg',
						[
							'label' => esc_html__( 'Background', 'rs-header-footer-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .search-form-style3 .search-wrap button' => 'background: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						's_t_btn_hover_bg',
						[
							'label' => esc_html__( 'Hover Background', 'rs-header-footer-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .search-form-style3 .search-wrap button:hover' => 'background: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						's_t_btn_icon color',
						[
							'label' => esc_html__( 'Icon Color', 'rs-header-footer-elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .search-form-style3 .search-wrap button i' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 's_t_btn_typo',
							'selector' => '{{WRAPPER}} .search-form-style3 .search-wrap button i::before',
						]
					);


				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		// 

		

	}
	/**
	 * Render Search button output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'input',
			[
				'placeholder' => $settings['placeholder'],
				'class'       => 'hfe-search-form__input',
				'type'        => 'search',
				'name'        => 's',
				'title'       => __( 'Search', 'rs-header-footer-elementor' ),
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


			if ( "style3" == $settings['layout'] ) {				
				?>
					<form role="search" class="bs-search search-form-style3" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					    <div class="search-wrap">
					    	
					        <input type="search" placeholder="<?php esc_attr_e( 'Searching Here...', 'rs-header-footer-elementor' ); ?>" name="s" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
					        <button type="submit"  value="Search"><i class="ri-search-line"></i></button>
					    </div>
					</form>
				<?php
			} else { ?>
				<div class="search_icons <?php echo esc_html($settings['layout']);?>">
					<i class="ri-close-line"></i>
					<i class="ri-search-line"></i>
				</div>

				<form role="search" class="bs-search search-form rs_stickys_form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				    <div class="search-wrap">
				    	<label class="screen-reader-text">
				    		<?php echo esc_html__( 'Search for:', 'rs-header-footer-elementor' ); ?>
				    	</label>
				        <input type="search" placeholder="<?php esc_attr_e( 'Searching...', 'rs-header-footer-elementor' ); ?>" name="s" class="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
				        <button type="submit"  value="Search"><i class="ri-search-line"></i></button>
				    </div>
				</form>
			<?php
		}
	}
}
