<?php

/**
 * Elementor rsgallery Widget.
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
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined('ABSPATH') || die();

class Rsaddon_Portfolio_Slider_Pro_Widget extends \Elementor\Widget_Base
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
		return 'portfolio-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('RS Portfolio Slider', 'rsaddon');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'glyph-icon flaticon-slider-3';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['rsaddon_category'];
	}

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{


		$post_dropdown[0] = 'Select Portfolio';
		$wp_portfolio_query = new wp_Query(array(
			'post_type'      => 'portfolios',
			'posts_per_page' => '-1',
		));

		if ($wp_portfolio_query->have_posts()) :
			while ($wp_portfolio_query->have_posts()) : $wp_portfolio_query->the_post();
				$id    = get_the_ID($wp_portfolio_query->ID);
				$title = get_the_title($wp_portfolio_query->ID);
				$post_dropdown[$id] = $title;
			endwhile;
			wp_reset_query();
		endif;

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'rsaddon'),
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
					'default_scheme' => esc_html__('Default Color', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Color', 'rsaddon'),				
					'secondary_scheme' => esc_html__('Secondary Color', 'rsaddon')				
				],											
			]
		);

		$this->add_control(
			'portfolio_slider_style',
			[
				'label'   => esc_html__('Select Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2 ( Center Mode )',
					'3' => 'Style 3',
					'4' => 'Style 4',
					'5' => 'Style 5',
					'swiper' => 'Style ( Swiper )',
				],
			]
		);
		$this->add_control(
			'portfolio_is_manual_selection',
			[
				'label' => esc_html__('Select Portfolio by:', 'prelements'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'yes'       => esc_html__('Selected Portfolio', 'prelements'),
					''        => esc_html__('Category Portfolio', 'prelements'),
				],
			]
		);
		$this->add_control(
			'portfolio_category',
			[
				'label'   => esc_html__('Category', 'rsaddon'),
				'type'    => Controls_Manager::SELECT2,
				'default' => 0,
				'options' => $this->getCategories(),
				'multiple' => true,
				'condition' => ['portfolio_is_manual_selection' => ''],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'select_portfolio_item',
			[
				'label'   => esc_html__('Select Portfolio', 'prelements'),
				'type'    => Controls_Manager::SELECT2,
				'default' => 0,
				'options' => [] + $post_dropdown,
				'multiple' => true,
				'condition' => ['portfolio_is_manual_selection' => 'yes'],
			]
		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__('Portfolio Show Per Page', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('example 3', 'rsaddon'),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_title_icons',
			[
				'label' => esc_html__( 'Show Title Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'condition'=>[
					'portfolio_slider_style'=>'2'
				]
			]
		);
		$this->add_control(
			'title_icons',
			[
				'label' => esc_html__( 'Title Icon', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition'=>[
					'show_title_icons'=>'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'large',
				'separator' => 'before',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'cat_show_hide',
			[
				'label' => esc_html__( 'Show Category', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'btn__show_hide',
			[
				'label' => esc_html__( 'Button Show', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'btn__title',
			[
				'label' => esc_html__( 'Button Title', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View Project', 'rsaddon' ),
				'placeholder' => esc_html__( 'Button Title', 'rsaddon' ),
				'condition'=>[
					'btn__show_hide'=> 'yes'
				],
			]
		);
		$this->add_control(
			'btn__icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition'=>[
					'btn__show_hide'=> 'yes'
				],
			]
		);

		
		$this->add_control(
			'overlay_show_hide',
			[
				'label'   => esc_html__('Overlayer Show/Hide', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => [
					'show' => 'Show',
					'hide' => 'Hide',
				],
				'separator'=>'before',
				'condition' => [
					'portfolio_slider_style!' => '2'
				]
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
			'col_lg_2',
			[
				'label'   => esc_html__('Desktops < 1199px', 'rsaddon'),
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
			'slider_dots_style',
			[
				'label'   => esc_html__('Dots Style', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'rsaddon'),
					'2' => esc_html__('Style 2', 'rsaddon'),
				],
				'condition' => [
					'slider_dots' => 'true',
					'portfolio_slider_style!' => 'swiper'
				]
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
		$this->add_control(
			'slider_centers_pad_xl',
			[
				'label'   => esc_html__('Center Mode Padding (XL)', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'slider_centerMode' => 'true',
				]
			]
		);
		$this->add_control(
			'slider_centers_pad_lg',
			[
				'label'   => esc_html__('Center Mode Padding (LG)', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'slider_centerMode' => 'true',
				]
			]
		);
		$this->add_control(
			'slider_centers_pad_md',
			[
				'label'   => esc_html__('Center Mode Padding (MD)', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'slider_centerMode' => 'true',
				]
			]
		);
		$this->add_responsive_control(
			'item_gap_custom',
			[
				'label' => esc_html__('Item Gap', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_gap_custom_margin',
			[
				'label' => esc_html__('Item Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-sliders .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__('General Section', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'item_text_align',
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
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'text-align: {{VALUE}}'
					],
				]
			);
			$this->add_responsive_control(
				'item_display',
				[
					'label' => esc_html__( 'Display', 'rsaddon' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'rsaddon' ),
						'block' => esc_html__( 'Block', 'rsaddon' ),
						'inline-block' => esc_html__( 'Inline Block', 'rsaddon' ),
						'flex' => esc_html__( 'Flex', 'rsaddon' ),
						'inline-flex' => esc_html__( 'Inline Flex', 'rsaddon' ),
					],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_displa_y_align',
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
						'item_display' => ['flex', 'inline-flex'],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_display_x_align',
				[
					'label' => esc_html__( 'Horizontal Align', 'rsaddon' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'flex-start' => [
							'title' => esc_html__( 'Left', 'rsaddon' ),
							'icon' => 'eicon-align-start-h',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'rsaddon' ),
							'icon' => 'eicon-align-center-h',
						],
						'flex-end' => [
							'title' => esc_html__( 'Right', 'rsaddon' ),
							'icon' => 'eicon-align-end-h',
						],
						'space-between' => [
							'title' => esc_html__( 'Space Between', 'rsaddon' ),
							'icon' => 'eicon-justify-space-between-h',
						],
						'space-evenly' => [
							'title' => esc_html__( 'Space Evenly', 'rsaddon' ),
							'icon' => 'eicon-justify-space-evenly-h',
						],

					],
					'default' => 'center',
					'condition' => [
						'item_display' => ['flex', 'inline-flex'],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_display_column_align',
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
						'item_display' => ['flex', 'inline-flex'],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'flex-direction: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'item_bg',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-item'
					,
				]
			);
			$this->add_responsive_control(
				'item_margin',
				[
					'label' => esc_html__('Item Margin', 'rsaddon'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'portfolio_slider_style!' => 'swiper',
					],
				]
			);
			$this->add_responsive_control(
				'item_padding',
				[
					'label' => esc_html__('Item Padding', 'rsaddon'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'portfolio_slider_style!' => 'swiper',
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
						'{{WRAPPER}} .rs-portfolio .portfolio-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'item_border',
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-item'
					,
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'item_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-item'
					,
				]
			);
			$this->add_responsive_control(
				'slider_style_three_img__height_normal',
				[
					'label' => esc_html__('Normal Image Height', 'rsaddon'),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'size_units' => ['%', 'px'],
					'range' => [

						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'px' => [
							'min' => -1000,
							'max' => 1000,
						],
					],
					'condition' => [
						'portfolio_slider_style' => ['2'],
					],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio-style2 .grid-item.slick-active:not(.slick-center) .portfolio-item' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_style_three_img__height_',
				[
					'label' => esc_html__('Center Image Height', 'rsaddon'),
					'type' => Controls_Manager::SLIDER,
					'show_label' => true,
					'size_units' => ['%', 'px'],
					'range' => [

						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'px' => [
							'min' => -1000,
							'max' => 1000,
						],
					],
					'condition' => [
						'portfolio_slider_style' => ['2'],
					],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio-style2 .grid-item .portfolio-item' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		// Overlay Cntrol Start
		$this->start_controls_section(
			'overlay_options_section',
			[
				'tab' => Controls_Manager::TAB_STYLE,
				'label' => esc_html__('Overlay Options', 'rsaddon'),
				'condition' => [
					'overlay_show_hide' => 'show',
				],
			]
		);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'style_overly_bg',
					'label' => esc_html__('Background', 'rsaddon'),
					'types' => ['classic', 'gradient'],
					'selector' => '{{WRAPPER}} .portfolio-img:after',
				]
			);
		$this->end_controls_section();
		// Overlay Cntrol End

		// image section start
		$this->start_controls_section(
			'section_slider_style_image',
			[
				'label' => esc_html__('Image Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'portfolio_slider_style!' => '2',
				],
			]
		);
			$this->add_responsive_control(
				'image_wrapper_width',
				[
					'label'      => esc_html__( 'Image Wrapper Width', 'rsaddon' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; min-width: auto !important;',
					],
				]
			);
			$this->add_responsive_control(
				'image__width',
				[
					'label'      => esc_html__( 'Image Width', 'rsaddon' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-img img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'image_wrapper_bg',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-img'
					,
				]
			);
			$this->add_responsive_control(
				'image_wrapper_margin',
				[
					'label' => esc_html__('Margin', 'rsaddon'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'image_wrapper_padding',
				[
					'label' => esc_html__('Padding', 'rsaddon'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'image_wrapper_border_radius',
				[
					'label' => esc_html__('Border Radius', 'rsaddon'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors' => [
						'{{WRAPPER}} .rs-portfolio .portfolio-img, {{WRAPPER}} .rs-portfolio-style5 .portfolio-item:hover .portfolio-img::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_wrapper_border',
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-img'
					,
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'image_wrapper_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '
						{{WRAPPER}} .rs-portfolio .portfolio-img'
					,
				]
			);
			$this->add_control(
				'image_hover_overlay_color_heading',
				[
					'label' => esc_html__( 'Image Hover Overlay Background', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'image_hover_overlay_color',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '
						{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-img::before'
					,
					'condition'	=>[
						'portfolio_slider_style'=>'5',
					]
				]
			);
		$this->end_controls_section();
		// image section end

		$this->start_controls_section(
			'section_slider_style_title',
			[
				'label' => esc_html__('Title / Category Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_wrapper_options_heading',
			[
				'label' => esc_html__( 'Content Wrapper Options', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
		    'content_wrapper_width',
		    [
				'label'      => esc_html__( 'Width', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'width: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}}; min-width: auto !important;',
		        ],
		    ]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_wrapper_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details'
				,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_wrapper_border',
				'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details'
				,
			]
		);
		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_wrapper_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '
					{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details'
				,
		    ]
		);
		$this->add_control(
			'content_position_options_heading',
			[
				'label' => esc_html__( 'Content Wrapper Position', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'content_position_options',
			[
				'label'   => esc_html__( 'Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [					
					'' => esc_html__( 'Defalut', 'rsaddon'),
                    'absolute' => esc_html__( 'Absolute', 'rsaddon'),
                    'relative' => esc_html__( 'Relative', 'rsaddon'),
				],
				'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'position: {{VALUE}};',
		        ],
			]
		);
		$this->add_responsive_control(
		    'content_wrapper_position_left',
		    [
				'label'      => esc_html__( 'Left', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'left: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'content_wrapper_position_right',
		    [
				'label'      => esc_html__( 'Right', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'right: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'content_wrapper_position_top',
		    [
				'label'      => esc_html__( 'Top', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'top: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'content_wrapper_position_bottom',
		    [
				'label'      => esc_html__( 'Bottom', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
				'condition' => [
					'content_position_options' => ['absolute', 'relative']
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider .portfolio-item .portfolio-content,
					{{WRAPPER}} .rs-portfolio.swiper .content-details' => 'bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);
		$this->add_control(
			'title_options_heading',
			[
				'label' => esc_html__( 'Title Options', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Title Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:hover .p-title a' => 'color: {{VALUE}};',
				],
			]

		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .p-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_bg',
			[
				'label' => esc_html__('Title Background', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'title__icon_color',
			[
				'label' => esc_html__('Title Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a svg path' => 'fill: {{VALUE}};',

				],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title__icon_hover__color',
			[
				'label' => esc_html__('Title Icon Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons:hover svg path' => 'fill: {{VALUE}};',

				],
				'condition' => [
					'show_title_icons'=>'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_icon_typho',
				'label' => esc_html__('Title Icon Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a i',
				'condition' => [
					'show_title_icons'=>'yes',
				],
			]
		);
		$this->add_responsive_control(
			'title_svg__icon_size_',
			[
				'label' => esc_html__('SVG Icon Size', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['%', 'px'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a  svg' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title__bg_color',
			[
				'label' => esc_html__('Title Icon Background', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_title_icons'=>'yes',
				],
			]
		);
		$this->add_control(
			'title__bg_hover_color',
			[
				'label' => esc_html__('Title Icon Background (Hover)', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons:hover' => 'background: {{VALUE}};',

				],
				'condition' => [
					'show_title_icons'=>'yes',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_width__',
			[
				'label' => esc_html__('Title Icon Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['%', 'px'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_height__',
			[
				'label' => esc_html__('Title Icon Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'size_units' => ['%', 'px'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_border_radius__',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_padding_',
			[
				'label' => esc_html__('Title Icon Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'title_icon_margin_',
			[
				'label' => esc_html__('Title Icon Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition' => [
					'show_title_icons'=>'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-title a .title-icons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->add_control(
			'category_options_heading',
			[
				'label' => esc_html__( 'Category', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => esc_html__('Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .p-category',
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_color',
			[
				'label' => esc_html__('Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_color_hover',
			[
				'label' => esc_html__('Color (Hover)', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:hover .p-category a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_bg_color',
			[
				'label' => esc_html__('Background', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'category_bg_hover_color',
			[
				'label' => esc_html__('Background (Hover)', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a:hover' => 'background: {{VALUE}};',

				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'category_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'cat_show_hide' => 'yes'
				]
			]
		);
		$this->add_control(
			'content_line_bg_color',
			[
				'label' => esc_html__('Line Background', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:after' => 'background: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '4']
			]
		);
		$this->add_control(
			'content_hoverbefore_bg_color',
			[
				'label' => esc_html__('Content Before Background', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-style4 .portfolio-item .portfolio-content:before' => 'background: {{VALUE}};',
				],
				'condition' => ['portfolio_slider_style' => '4']
			]
		);
		$this->end_controls_section();

		/**
		 * Swiper Scroll bar control scrollbat
		 */
		$this->start_controls_section(
			'swiper_scrollbar_section',
			[
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__('Scrollbar', 'rsaddon'),
				'condition' => [
					'portfolio_slider_style' => ['swiper'],
				],
			]
		);

		$this->add_control(
			'swiper_scrollbar_height',
			[
				'label' => esc_html__('Scrollbar Height', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio.swiper.swiper-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'swiper_scrollbar_bg_color',
			[
				'label' => esc_html__('Background Color', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio.swiper.swiper-horizontal > .swiper-scrollbar .swiper-scrollbar-drag' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'swiper_scrollbar_bg_width',
			[
				'label' => esc_html__('Background Width', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
				'default' => [
					'unit' => 'px',
					'size' => 220,
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio.swiper.swiper-horizontal > .swiper-scrollbar .swiper-scrollbar-drag' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'swiper_scrollbar_forground_color',
			[
				'label' => esc_html__('Forground Color', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio.swiper.swiper-horizontal > .swiper-scrollbar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Arrow Section Start
		$this->start_controls_section(
			'section_slider_style_arrow_ontrol',
			[
				'label' => esc_html__('Arrow Control', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_nav' => 'true'
				]
			]
		);

		// positioning start
		$this->add_control(
			'arrow_position_maker',
			[
				'label' => esc_html__('Arrow Position Style', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'custom' => esc_html__('Custom', 'rsaddon'),
				],
			]
		);
		$this->add_responsive_control(
			'arrow_prev_x_select',
			[
				'label' => esc_html__('Prev Position X', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'left' => esc_html__('Left', 'rsaddon'),
					'right' => esc_html__('Right', 'rsaddon'),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_left_position',
			[
				'label' => esc_html__('Prev Left Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition' => [
					'arrow_prev_x_select' => 'left',
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_right_position',
			[
				'label' => esc_html__('Prev Right Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition' => [
					'arrow_prev_x_select' => 'right',
					'arrow_position_maker' => 'custom'
				]
			]
		);

		$this->add_responsive_control(
			'arrow_prev_y_select',
			[
				'label' => esc_html__('Prev Position Y', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'top' => esc_html__('Top', 'rsaddon'),
					'bottom' => esc_html__('Bottom', 'rsaddon'),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_top_position',
			[
				'label' => esc_html__('Prev Top Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition' => [
					'arrow_prev_y_select' => 'top',
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_prev_bottom_position',
			[
				'label' => esc_html__('Prev Bottom Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-prev, {{WRAPPER}} .swiper .swiper-button-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition' => [
					'arrow_prev_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
				]
			]
		);

		$this->add_responsive_control(
			'arrow_next_x_select',
			[
				'label' => esc_html__('Next Position X', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'left' => esc_html__('Left', 'rsaddon'),
					'right' => esc_html__('Right', 'rsaddon'),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_left_position',
			[
				'label' => esc_html__('Next Left Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				],
				'condition' => [
					'arrow_next_x_select' => 'left',
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_right_position',
			[
				'label' => esc_html__('Next Right Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
				],
				'condition' => [
					'arrow_next_x_select' => 'right',
					'arrow_position_maker' => 'custom'
				]
			]
		);

		$this->add_responsive_control(
			'arrow_next_y_select',
			[
				'label' => esc_html__('Next Position Y', 'rsaddon'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'rsaddon'),
					'top' => esc_html__('Top', 'rsaddon'),
					'bottom' => esc_html__('Bottom', 'rsaddon'),
				],
				'condition' => [
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_top_position',
			[
				'label' => esc_html__('Next Top Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'top: {{SIZE}}{{UNIT}}; bottom: unset;',
				],
				'condition' => [
					'arrow_next_y_select' => 'top',
					'arrow_position_maker' => 'custom'
				]
			]
		);
		$this->add_responsive_control(
			'arrow_next_bottom_position',
			[
				'label' => esc_html__('Next Bottom Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
					'{{WRAPPER}} .rs-addon-sliders .slick-next, {{WRAPPER}} .swiper .swiper-button-next' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
				'condition' => [
					'arrow_next_y_select' => 'bottom',
					'arrow_position_maker' => 'custom'
				]
			]
		);
		// positioning end

		$this->add_control(
			'arrow_after_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
            'navigation_arrow_width',
            [
                'label' => esc_html__( 'Arrow Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'navigation_arrow_height',
            [
                'label' => esc_html__( 'Arrow Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'navigation_arrow_line_height',
            [
                'label' => esc_html__( 'Arrow Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'selector' => '
					{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev::before,
					{{WRAPPER}} .rs-addon-sliders .slick-next::before
				',
			]
		);

		$this->add_control(
			'arrow_border_radius_',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_border_padding_',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .swiper .swiper-button-next,
					{{WRAPPER}} .swiper .swiper-button-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-prev,
					{{WRAPPER}} .rs-addon-sliders .slick-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Arrow Hover Normal Tab Start
		$this->start_controls_tabs('_tabs_slider_arrow');
			// Normal Bullet Start
			$this->start_controls_tab(
				'slider_arrow_normal_tab',
				[
					'label' => esc_html__('Normal', 'rsaddon'),
				]
			);
				$this->add_control(
					'navigation_arrow_color',
					[
						'label' => esc_html__('Icon Color', 'rsaddon'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev::before,
							{{WRAPPER}} .rs-addon-sliders .slick-next::before' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'navigation_arrow_background',
						'types' => ['classic', 'gradient'],
						'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'nav_arrow_border',
						'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'arrow_shadow_custom',
						'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next,
							{{WRAPPER}} .swiper .swiper-button-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-prev,
							{{WRAPPER}} .rs-addon-sliders .slick-next
						',
					]
				);
			$this->end_controls_tab();

			// Hover Bullet Start
			$this->start_controls_tab(
				'slider_arrow_hover_tab',
				[
					'label' => esc_html__('Hover', 'rsaddon'),
				]
			);
				$this->add_control(
					'navigation_arrow_color_hover',
					[
						'label' => esc_html__('Icon Color', 'rsaddon'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover::before,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover::before' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'navigation_arrow_background_hover',
						'types' => ['classic', 'gradient'],
						'selector' => '
							{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover
						',
					]
				);
				$this->add_control(
					'nav_arrow_border_hover',
					[
						'label' => esc_html__('Border Color', 'rsaddon'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .swiper .swiper-button-next:hover,
							{{WRAPPER}} .swiper .swiper-button-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-prev:hover,
							{{WRAPPER}} .rs-addon-sliders .slick-next:hover' => 'border-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		// Arrow Hover Normal Tab End
		$this->end_controls_section();
		// Arrow Style End

		// Number Style For Style Five
		$this->start_controls_section(
			'number_style_for_style_five',
			[
				'label' => esc_html__('Number Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'portfolio_slider_style' => '5'
				]
			]
		);
        $this->add_responsive_control(
            'number_color__',
            [
                'label' => esc_html__( 'Number Color ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number span' => 'color: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'number_bg__color',
            [
                'label' => esc_html__( 'Number Background Color ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number' => 'background: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'number_bg_hover___color',
            [
                'label' => esc_html__( 'Hover Number Background Color ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item:hover .portfolio-number ' => 'background: {{VALUE}}',
                ],
                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number__typography',
                'selector' => '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number span',
                
            ]
        );
        
        $this->add_responsive_control(
            'number_top__position',
            [
                'label' => esc_html__( 'Number Top Position', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number' => 'top: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon__left__position',
            [
                'label' => esc_html__( 'Number Left Position', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number' => 'left: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'number_area__width_height_lineheight',
            [
                'label' => esc_html__( 'Number Width, Height, Line Height ', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'number_area_border',
                'selector' => '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number',
                
            ]
        );
        $this->add_responsive_control(
            'number_area_border_radius',
            [
                'label' => esc_html__( 'Number Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style5 .portfolio-item .portfolio-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                
            ]
        );
		$this->end_controls_section();
		//End  Number Style For Style Five





		// Bullet Style Start
		$this->start_controls_section(
			'section_slider_style_dots_ontrol',
			[
				'label' => esc_html__('Dots Control', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slider_dots' => 'true'
				]
			]
		);
		$this->add_responsive_control(
				'bullet_alignment_dots',
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
						'{{WRAPPER}} .rs-portfolio-slider ul.slick-dots' => 'text-align: {{VALUE}}'
					],
				]
			);
		
		$this->add_control(
			'bullet_wrapper_box_style',
			[
				'label' => esc_html__('Dots Wrapper Box', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bullet_wrapper_box_bg',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-addon-slider .slick-dots',
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_padding',
			[
				'label' => esc_html__('Padding', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_margin',
			[
				'label' => esc_html__('Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_wrapper_box_radius',
			[
				'label' => esc_html__('Border Radius', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
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
				'label' => esc_html__('Bullet Item Style', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
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
			'navigation_dot_inner_color',
			[
				'label' => esc_html__( 'Inner Dot Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'slider_dots_style' => '2',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_height_custom',
			[
				'label' => esc_html__('Inner Dot Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_inner_dot_normal_width_custom',
			[
				'label' => esc_html__('Inner Dot Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_border_radius',
			[
				'label' => esc_html__('Inner Dot Radius', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
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

		$this->add_control(
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
		$this->add_control(
			'navigation_dot_inner_color_active',
			[
				'label' => esc_html__( 'Inner Dot Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'slider_dots_style' => '2',
				],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_inner_dot_height_custom_active',
			[
				'label' => esc_html__('Inner Dot Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_inner_dot_active_width_custom',
			[
				'label' => esc_html__('Inner Dot Width', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover:after,
					{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button:after' => 'width: {{SIZE}}{{UNIT}};',
				],
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
				'label' => esc_html__('Bullet Width', 'rsaddon'),
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
				'label' => esc_html__('Bullet Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bullet_active_scale_custom',
			[
				'label' => esc_html__('Bullet Scale', 'rsaddon'),
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
			'bullet_spacing_custom_position',
			[
				'label' => esc_html__('Top Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
		$this->add_responsive_control(
			'bullet_spacing_custom_position_bottom',
			[
				'label' => esc_html__('Bottom Position', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
				'selectors' => [
					'{{WRAPPER}} .rs-addon-slider .slick-dots' => 'bottom: {{SIZE}}{{UNIT}}; top: unset;',
				],
			]
		);
		$this->end_controls_section();
		// Bullet Style End


		// Button Style Start
		$this->start_controls_section(
			'btn_style',
			[
				'label' => esc_html__('Button Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'btn__show_hide'=> 'yes'
				],
			]
		);

			$this->start_controls_tabs(
					'btn__style_tabs'
			);
				$this->start_controls_tab(
					'btn__style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'textdomain' ),
					]
				);
					$this->add_group_control(
					    Group_Control_Typography::get_type(),
					    [
					        'name' => 'btn_typography',
					        'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a',
					    ]
					);
					$this->add_control(
					    'btn_text_color',
					    [
					        'label' => esc_html__( 'Text Color', 'rsaddon' ),
					        'type' => Controls_Manager::COLOR,		      
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a' => 'color: {{VALUE}};',
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a svg path,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a svg path' => 'fill: {{VALUE}};',
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a i,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a i' => 'color: {{VALUE}};',
					        ],
					    ]
					);
					$this->add_group_control(
					    Group_Control_Background::get_type(),
						[
							'name' => 'btn_bg',
							'label' => esc_html__( 'Background', 'rsaddon' ),
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a',
						]
					);
					$this->add_control(
					    'button_brder_radius',
					    [
					        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
					        'type' => Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
					        ],
					    ]
					);
					$this->add_control(
					    'button__margin',
					    [
					        'label' => esc_html__( 'Margin', 'rsaddon' ),
					        'type' => Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
					        ],
					    ]
					);
					$this->add_responsive_control(
					    'button__padding',
					    [
					        'label' => esc_html__( 'Padding', 'rsaddon' ),
					        'type' => Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', 'em', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					        ],
					    ]
					);
					$this->add_control(
					    'icon__margin',
					    [
					        'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
					        'type' => Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a svg,{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a i,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a svg, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
					        ],
					    ]
					);

				$this->end_controls_tab();
				$this->start_controls_tab(
					'btn__style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'textdomain' ),
					]
				);

					$this->add_group_control(
					    Group_Control_Background::get_type(),
						[
							'name' => 'btn__hover_bg',
							'label' => esc_html__( 'Background', 'rsaddon' ),
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover',
						]
					);
					$this->add_control(
					    'btn__hover_text_color',
					    [
					        'label' => esc_html__( 'Text Color', 'rsaddon' ),
					        'type' => Controls_Manager::COLOR,		      
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover' => 'color: {{VALUE}};',
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover svg path,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover svg path' => 'fill: {{VALUE}};',
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover i,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover i' => 'color: {{VALUE}};',
					        ],
					    ]
					);
					
					$this->add_control(
					    'icon_hover___margin',
					    [
					        'label' => esc_html__( 'Icon Margin', 'rsaddon' ),
					        'type' => Controls_Manager::DIMENSIONS,
					        'size_units' => [ 'px', '%' ],
					        'selectors' => [
					            '{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover svg,{{WRAPPER}} .rs-portfolio .portfolio-item .portfolio-content .p-icon a:hover i,{{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover svg, {{WRAPPER}} .rs-portfolio.rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
					        ],
					    ]
					);
					$this->add_responsive_control(
						'icon_rotate__hover',
						[
							'label' => esc_html__( 'Icon Hover Rotate', 'rsaddon' ),
							'type' => \Elementor\Controls_Manager::SLIDER,
							'size_units' => [ 'deg' ],
							'range' => [
								'deg' => [
									'min' => 0,
									'max' => 360,
									'step' => 1,
								],
							],
							'default' => [
								'unit' => 'deg',
								'size' => '',
							],
							'selectors' => [
								'{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a:hover svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Button Style Ens
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings              = $this->get_settings_for_display();
		$slidesToShow          = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
		$autoplaySpeed         = $settings['slider_autoplay_speed'];
		$interval              = $settings['slider_interval'];
		$slidesToScroll        = $settings['slides_ToScroll'];
		$slider_autoplay       = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
		$pauseOnHover          = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
		$sliderDots            = $settings['slider_dots'] == 'true' ? 'true' : 'false';
		$sliderNav             = $settings['slider_nav'] == 'true' ? 'true' : 'false';
		$infinite              = $settings['slider_loop'] === 'true' ? 'true' : 'false';
		$centerMode            = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
		$col_lg                = $settings['col_lg'];
		$col_md                = $settings['col_md'];
		$col_sm                = $settings['col_sm'];
		$col_xs                = $settings['col_xs'];
		$col_lg_2                = $settings['col_lg_2'];
		$slider_centers_pad_xl = !empty($settings['slider_centers_pad_xl']) ? $settings['slider_centers_pad_xl'] : '400px';
		$slider_centers_pad_lg = !empty($settings['slider_centers_pad_lg']) ? $settings['slider_centers_pad_lg'] : '250px';
		$slider_centers_pad_md = !empty($settings['slider_centers_pad_md']) ? $settings['slider_centers_pad_md'] : '100px';

		if ( is_rtl() ):
		   $rtl= 'true';
		else:
		   $rtl= 'false';
		endif;

		$unique = rand(2012, 35120);

		$slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay', 'pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs', 'slider_centers_pad_xl', 'slider_centers_pad_lg', 'slider_centers_pad_md', 'col_lg_2');
		?>

		<?php if ('swiper' !== $settings['portfolio_slider_style']) { ?>
			<div class="rsaddon-unique-slider rs-addon-slider rs-portfolio-slider rs-portfolio rs-portfolio-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?>  overlay-<?php echo esc_attr($settings['overlay_show_hide']); ?> color_<?php echo esc_html($settings['choose_color_scheme']); ?>">

				<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-sliders slick-dots<?php echo esc_attr($settings['slider_dots_style']); ?>">
					<?php if ('1' == $settings['portfolio_slider_style']) {
						include plugin_dir_path(__FILE__) . "/style1.php";
					}
					elseif ('2' == $settings['portfolio_slider_style']) {
						include plugin_dir_path(__FILE__) . "/style2.php";
					}
					elseif ('3' == $settings['portfolio_slider_style']) {
						include plugin_dir_path(__FILE__) . "/style3.php";
					}
					elseif ('4' == $settings['portfolio_slider_style']) {
						include plugin_dir_path(__FILE__) . "/style4.php";
					}elseif ('5' == $settings['portfolio_slider_style']) {
						include plugin_dir_path(__FILE__) . "/style5.php";
					}
					?>
				</div>
				<div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
			</div>
		<?php } ?>

		<?php if ('swiper' !== $settings['portfolio_slider_style']) { ?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.rs-addon-sliders').each(function(index) {
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
								centerPadding: slider_conf.slider_centers_pad_xl,
								autoplaySpeed: parseInt(slider_conf.autoplaySpeed),
								pauseOnHover: (slider_conf.pauseOnHover) == "true" ? true : false,
								infinite: true,
								loop: (slider_conf.slider_loop) == "true" ? true : false,
								rtl: <?php echo $rtl; ?>,
								responsive: [{
										breakpoint: 1200,
										settings: {
											slidesToShow: parseInt(slider_conf.col_md),
											slidesToScroll: 1,
										}
									},
									{
										breakpoint: 1199,
										settings: {
											slidesToShow: parseInt(slider_conf.col_lg_2),
											centerPadding: slider_conf.slider_centers_pad_xl,
										}
									},
									{
										breakpoint: 992,
										settings: {
											slidesToShow: parseInt(slider_conf.col_sm),
											slidesToScroll: 1,
											centerPadding: slider_conf.slider_centers_pad_lg,
										}
									},
									{
										breakpoint: 768,
										settings: {
											arrows: false,
											slidesToShow: parseInt(slider_conf.col_xs),
											slidesToScroll: 1,
											centerPadding: slider_conf.slider_centers_pad_md,
										}
									},
									{
										breakpoint: 600,
										settings: {
											slidesToShow: 1,
											arrows: false,
											slidesToScroll: 1,
											centerPadding: '0px',
										}
									}
								]
							});
						}

					});
				});
			</script>
		<?php } ?>

		<?php if ('2' == $settings['portfolio_slider_style']) { ?>
			<script>
				jQuery(document).ready(function($) {
					jQuery('.slick-slide').on('click', function() {
						var slideIndex = jQuery(this).data('slick-index');
						jQuery('.rs-addon-sliders').slick('slickGoTo', slideIndex);
					});
				});
			</script>
		<?php } ?>

		<?php if ('swiper' == $settings['portfolio_slider_style']) { ?>
			<div class="swiper mySwiper rs-portfolio nav_<?php echo esc_attr($settings['slider_nav']); ?> dots_<?php echo esc_attr($settings['slider_dots']); ?>">
				<div class="swiper-wrapper">
					<?php include plugin_dir_path(__FILE__) . "/style-swiper.php"; ?>
				</div>
				<div class="swiper-scrollbar"></div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					var swiper = new Swiper(".mySwiper", {
						slidesPerView: 3,
						centeredSlides: false,
						slidesPerGroupSkip: 1,
						grabCursor: true,
						spaceBetween: 30,
						keyboard: {
							enabled: true,
						},
						breakpoints: {
							0: {
								slidesPerView: 1,
								spaceBetween: 30
							},
							768: {
								slidesPerView: 2,
								spaceBetween: 30
							},
							992: {
								slidesPerView: 3,
								spaceBetween: 30
							},
							1200: {
								slidesPerView: 3,
								spaceBetween: 30
							}
						},
						scrollbar: {
							el: ".swiper-scrollbar",
						},
						navigation: {
							nextEl: ".swiper-button-next",
							prevEl: ".swiper-button-prev",
						},
						pagination: {
							el: ".swiper-pagination",
							clickable: true,
						},
					});
				});
			</script>
		<?php } ?>
<?php
	}
	public function getCategories()
	{
		$cat_list = [];
		if (post_type_exists('portfolios')) {
			$terms = get_terms(array(
				'taxonomy'    => 'portfolio-category',
				'hide_empty'  => true
			));

			foreach ($terms as $post) {
				$cat_list[$post->slug]  = [$post->name];
			}
		}
		return $cat_list;
	}
}