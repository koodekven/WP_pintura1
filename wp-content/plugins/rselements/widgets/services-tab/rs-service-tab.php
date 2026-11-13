<?php

/**
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_RSservices_Tab_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'rs-service-tab';
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
	public function get_title()
	{
		return esc_html__('RS Service Repeater', 'rsaddon');
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
	public function get_icon()
	{
		return 'glyph-icon flaticon-support';
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
	public function get_categories()
	{
		return ['rsaddon_category'];
	}
	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		// ----------------------------------------  Service Global Card  ------------------------------
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__('Services Tab', 'rsaddon'),
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
			'services_tab_style',
			[
				'label'   => esc_html__('Services Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__('Style 1', 'rsaddon'),
					'2' => esc_html__('Style 2', 'rsaddon'),
				],
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
					'{{WRAPPER}} .services-tab-inner' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'item_style',
			[
				'label'   => esc_html__('Item Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__('Style 1', 'rsaddon'),
					'2' => esc_html__('Style 2', 'rsaddon'),
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Text', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Premium Quality Service', 'rsaddon'),
			]
		);
		$repeater->add_control(
			'number_text',
			[
				'label' => esc_html__('01', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('01', 'rsaddon'),
				'condition' => ['item_style!' => '2']
			]
		);

		$repeater->add_control(
			'title_link',
			[
				'label_block' => true,
				'label' => esc_html__('Title Link', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('#', 'rsaddon'),
				'condition' => ['item_style' => '2']
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'rsaddon'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rsaddon'),
				'separator' => 'before',
				'condition' => ['item_style' => '2']
			]
		);

		$repeater->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
                'condition' => ['item_style' => '2'] 
            ]
        );

		$repeater->add_control(
			'services_btn_text',
			[
				'label' => esc_html__('Button Text', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Read More', 'rsaddon'),
				'separator' => 'before',
				'condition' => ['item_style' => '2']
			]
		);
		$repeater->add_control(
			'services_btn_link',
			[
				'label' => esc_html__('Button Link', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__('#', 'rsaddon'),
				'condition' => ['item_style' => '2']
			]
		);


		$repeater->add_control(
			'icon_image',
			[
				'label' => esc_html__('Icon Image', 'rsaddon'),
				'type'  => Controls_Manager::MEDIA,
				'condition' => ['item_style' => '2']
			]
		);

		$repeater->add_control(
			'button_show_hide',
			[
				'label' => esc_html__('Button Show/Hide', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => ['item_style' => '2']
			]
		);

		$repeater->add_control(
			'btn__selected_icon',
			[
				'label' => __('Arrow Icon', 'prelements'),
				'type' => Controls_Manager::ICONS,
				'condition' => ['item_style' => '2']
			]
		);
		$repeater->add_control(
			'active_enable',
			[
				'label' => esc_html__('Active Enable?', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['item_style' => '2']
			]
		);
		$this->add_control(
			'tab_list',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'show_label' => false,
				'default' => [
					[
						'title' => esc_html__('100GB Free Space with Hosting', 'rsaddon'),
					],
					[
						'title' => esc_html__('Responsive Features List', 'rsaddon'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section(); //End Service Style Four Feature List

		$this->start_controls_section(
			'tab_style',
			[
				'label' => esc_html__('Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services-tab .services-tab-inner .content_part .title,{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .title,{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-title .title',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner .content_part .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-title .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Title Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner.active .content_part .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner:hover .content_part .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover .service-icon-title .title:hover' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner .content_part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .services-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'descriptin_style',
			[
				'label' => esc_html__('Description Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '2']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'descirption_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .desc-text',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'descirption_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .desc-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'descirption_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'shape_style',
			[
				'label' => esc_html__('Content Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '2']
			]
		);
		$this->add_responsive_control(
            'content_box_horizontal_align',
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
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'display: {{VALUE}};',
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
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Middle', 'rsaddon' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
				'default' => 'flex-start',
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'align-items: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box__h_align',
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
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_column_align',
            [
                'label' => esc_html__( 'Box Column', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__( 'Column', 'rsaddon' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'rsaddon' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Row', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'rsaddon' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
				'default' => 'column',
				'condition' => [
					'content_box_horizontal_align' => 'flex',
				],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'shape_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'shape_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'shape__background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part',
			]
		);
		$this->add_responsive_control(
			'shape_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
            'icon_img_width',
            [
                'label' => esc_html__( 'Icon Width', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .icon_style img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover .icon_style img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_image_height',
            [
                'label' => esc_html__( 'Icon Height', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part .icon_style img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover .icon_style img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__('Button Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '2']
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-btn',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner:hover .services-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_icon_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .services-btn i',
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'number_tab_style',
			[
				'label' => esc_html__('Number Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '1']
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-addon-services-tab .services-tab-inner .numbering',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner .numbering' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number_hover_color',
			[
				'label' => esc_html__('Number Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner.active .numbering span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hover_contetn_style',
			[
				'label' => esc_html__('Hover Content Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '2']
			]
		);

		$this->add_control(
			'hover_overlay_heading',
			[
				'label' => esc_html__( 'Hover Overlay Background', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'services_tab_style' => '2',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_service_bg',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover:after',
				'condition' => ['services_tab_style' => '2'],
			]
		);

		$this->add_responsive_control(
			'hover_contetn_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_contetn_title_and_icon_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover .service-icon-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'hover_content_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_content_container_width',
			[
				'label' => esc_html__( 'Container Width', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_content_position_top',
			[
				'label' => esc_html__( 'Top', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_content_position_bottom',
			[
				'label' => esc_html__( 'Bottom', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_content_position_left',
			[
				'label' => esc_html__( 'Left', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hover_content_position_right',
			[
				'label' => esc_html__( 'Right', 'rsaddon' ),
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
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .content_part_hover' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__('Image Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '2']
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab-hovereffect .services-inner .media_wrap .image_style img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'number_style',
			[
				'label' => esc_html__('Global Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['services_tab_style' => '1']
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_normal_bg',
				'label' => esc_html__('Background Color', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services-tab .services-tab-inner',
			]
		);

		$this->add_responsive_control(
			'global_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_heading',
			[
				'label' => esc_html__('Hover Background', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_hover_bg',
				'label' => esc_html__('Background Color', 'rsaddon'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-services-tab .services-tab-inner.active:before',
			]
		);

		$this->add_responsive_control(
			'global_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-services-tab .services-tab-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .rs-addon-services-tab .services-tab-inner',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
		{
		$settings = $this->get_settings_for_display();
		$services_tab_style = $settings['services_tab_style']; 
		?>
		<?php if ($services_tab_style == '1') { ?>
			<div class="rs-addon-services-tab color_<?php echo esc_html($settings['choose_color_scheme'])?>">
				<?php
				$count = 1;
				foreach ($settings['tab_list'] as $index => $feature) :

					$title = $feature['title'];
					$number_text = $feature['number_text'];
					$active = '';
					if ($count == '2') {
						$active = 'active';
					}

				?>
					<div class="services-tab-inner hoverable">
						<div class="numbering">
							<span><?php echo $number_text; ?></span>
						</div>
						<div class="content_part">
							<div class="services-title">
								<h2 class="title"> <?php echo $title; ?></h2>
							</div>
						</div>
					</div>
				<?php $count++;
				endforeach; ?>
			</div>
		<?php } elseif ($services_tab_style == '2') { ?>
			<div class="rs-addon-services-tab-hovereffect color_<?php echo esc_html($settings['choose_color_scheme'])?>">
				<?php
				$count = 1;
				foreach ($settings['tab_list'] as $index => $item) :
					$active_enable = $item['active_enable'];
					$active = ($active_enable == 'yes') ? 'active' : '';
					$title = $item['title'];
				?>

					<div class="services-inner  <?php echo esc_attr($active); ?>">
						<div class="content_part_hover">
							<div class="service-icon-title">
								<!-- Icon -->
								<?php if (!empty($item['icon_image'])) : ?>
									<div class="icon_style">
										<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>" />
									</div>
								<?php endif; ?>
								<?php if (!empty($item['title'])) { ?>
									<div class="services-title">
										<a href="<?php echo esc_url($item['title_link']); ?>" class="title">
											<?php echo wp_kses_post($item['title']); ?>
										</a>
									</div>
								<?php } ?>
							</div>
							<?php if (!empty($item['description'])) : ?>
								<div class="desc-text">
									<?php echo esc_html($item['description']); ?>
								</div>
							<?php endif; ?>
							<?php if ('yes' == $item['button_show_hide']) { ?>
								<div class="btn-part">
									<?php if(!empty($item['services_btn_link'])) { ?>
									<a class="services-btn" href="<?php echo esc_url($item['services_btn_link']); ?>">
									<?php } ?>
									<?php echo esc_html($item['services_btn_text']);?> <?php Icons_Manager::render_icon($item['btn__selected_icon'], ['aria-hidden' => 'true']); ?>
									<?php if(!empty($item['services_btn_link'])) { ?>
									</a>
									<?php } ?>
								</div>
							<?php } ?>
						</div>


						<div class="media_wrap">
							<?php if (!empty($item['selected_image']['url'])) { ?>


								<?php if (!empty($item['selected_image'])) : ?>
									<div class="image_style media-cmn">
										<img src="<?php echo esc_url($item['selected_image']['url']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['selected_image'])); ?>" />
									</div>
								<?php endif; ?>
							<?php } ?>
						</div>
						<div class="content_part">
							<!-- Icon -->
							<?php if (!empty($item['icon_image'])) : ?>
								<div class="icon_style">
									<img src="<?php echo esc_url($item['icon_image']['url']); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['icon_image'])); ?>" />
								</div>
							<?php endif; ?>
							<?php if (!empty($item['title'])) { ?>
								<div class="services-title">
									<a href="<?php echo esc_url($item['title_link']); ?>" class="title">
										<?php echo wp_kses_post($item['title']); ?>
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php $count++;
				endforeach; ?>

			</div>

		<?php } ?>
		<script type="text/javascript">
			jQuery(document).ready(function() {

				function tabHoverEffect(item) {
					// Define your condition here
					// For example, let's apply the hover effect only to elements with the class "hoverable"
					return jQuery(item).hasClass("hoverable");
				}
				jQuery(".services-tab-inner:eq(1)").addClass("active");
				jQuery(".services-tab-inner").hover(
					function() {
						// Mouse enter - check if the condition for hover effect is met
						if (tabHoverEffect(this)) {
							jQuery(this).addClass("active");
						}
					},
					function() {
						// Mouse leave - check if the condition for hover effect is met
						if (tabHoverEffect(this)) {
							jQuery(this).removeClass("active");
							jQuery(".services-tab-inner:eq(1)").addClass("active");

						}
					}
				);

			});
		</script>

<?php
	}
}
