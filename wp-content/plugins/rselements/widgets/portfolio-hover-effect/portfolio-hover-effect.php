<?php
/**
 * Elementor rsgallery Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


defined('ABSPATH') || die();

class Rsaddon_Portfolio_Hover_Effect_Widget extends \Elementor\Widget_Base
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
		return 'rsportfolio_hover_effect';
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
		return __('RS Portfolio Grid 2', 'rsaddon');
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
		return 'glyph-icon flaticon-grid';
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

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__('Content', 'rsaddon'),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'separator' => 'before',
			]

		);
		$this->add_control(
			'per_page',
			[
				'label' => esc_html__('Project Show Per Page', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pre_posts_sort',
			[
				'label'   => esc_html__('Post Order', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__('ASC', 'rsaddon'),
					'DESC' => esc_html__('DESC', 'rsaddon'),
				],
				'default' => 'DESC',
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label' => esc_html__('Item Gap', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-flex .rs-portfolio-inner' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'item_height',
			[
				'label' => esc_html__('Item Height', 'rsaddon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-portfolio-flex .rs-grid-item' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_show_hide',
			[
				'label' => esc_html__('Button Show/Hide', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'btn__selected_icon',
			[
				'label' => __('Icon', 'rsaddon'),
				'type' => Controls_Manager::ICONS,
				'condition' => ['button_show_hide' => 'yes']
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__('Title Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-item--title a' => 'color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Title Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-item--title a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .rs-item--meta .rs-item--title a:hover' => 'color: {{VALUE}};',
				],
			]

		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-item--title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rs-item--title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-item--title a,{{WRAPPER}} .rs-item--title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			[
				'label' => esc_html__('Category Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'Category_color',
			[
				'label' => esc_html__('Category Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-item--category a' => 'color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'Category_color_hover',
			[
				'label' => esc_html__('Category Hover Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-item--category a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .rs-item--meta .rs-item--category a:hover' => 'color: {{VALUE}};',
				],
			]

		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label' => esc_html__('Category Margin', 'rsaddon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .rs-item--category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'Category_typography',
				'label' => esc_html__('Category Typography', 'rsaddon'),
				'selector' => '{{WRAPPER}} .rs-item--category a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style',
			[
				'label' => esc_html__('Arrow Style', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label' => esc_html__('Arrow BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn' => 'background: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'arrow_icon_color',
			[
				'label' => esc_html__('Arrow Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn svg' => 'fill: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'arrow_jpverbg_color',
			[
				'label' => esc_html__('Arrow Hover BG Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn:hover' => 'background: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'arrow_icon_hovercolor',
			[
				'label' => esc_html__('Arrow Hover Icon Color', 'rsaddon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-grid-item .btn-part .portfolio-btn:hover svg' => 'fill: {{VALUE}};',

				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'portfolio_bg_style',
			[
				'label' => esc_html__('Background Overlay', 'rsaddon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rs-portfolio-flex .rs-grid-item:before',
			]
		);

		$this->end_controls_section();
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

		$settings = $this->get_settings_for_display();

?>
		<div class="rs-portfolio-flex">
			<div class="rs-portfolio-inner">
				<?php
				include plugin_dir_path(__FILE__) . "/style1.php";
				?>
			</div>
		</div>

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
} ?>