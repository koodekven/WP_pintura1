<?php

/**
 * Elementor header offcanvas Widget jkjuiiugftyfytvhuj.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Offcanvas_Widget extends \Elementor\Widget_Base
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
        return 'rsoffcanvas';
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
        return esc_html__('RS Header Offcanvas', 'rsaddon');
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
        return 'glyph-icon flaticon-attach';
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

    protected function register_controls(){
        $this->start_controls_section(
            'rs_offcanvas_header_offcanvas_section_tab_style',
            [
                'label' => esc_html__('Offcanvas', 'rsaddons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_offcanvas_header_offcanvas_style_tabs');
        $this->start_controls_tab(
            'rs_offcanvas_header_offcanvas_style_hamburger_tab',
            [
                'label' => esc_html__('Hamburger', 'rsaddons')
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_color',
            [
                'label' => esc_html__('Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area .nav-expander i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area a.nav-expander' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_offcanvas_offcanvas_icon_hover_title',
            [
                'label' => __('Hover Color', 'rsaddons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_color_hover',
            [
                'label' => esc_html__('Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area .nav-expander:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'rsaddons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area ul .nav-link:hover' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'rs_offcanvas_text_font_hr',
            [
                'type'  => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_offcanvas_icon_font_size',
            [
                'label'         => esc_html__('Icon Size', 'rsaddons'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'default' => [
                    'unit' => 'px',
                    'size' => '20',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area .nav-expander i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_offcanvas_border',
                'selector' => '{{WRAPPER}} .rs-offcanvas-area a.nav-expander',
                'separator' => 'before',
            ]
        );

        // border radius
        $this->add_control(
            'rs_offcanvas_border_radius',
            [
                'label' => esc_html__('Border radius', 'rsaddons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area a.nav-expander' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_padding',
            [
                'label'         => esc_html__('Padding', 'rsaddons'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area a.nav-expander' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_offcanvas_margin',
            [
                'label'         => esc_html__('Margin', 'rsaddons'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-offcanvas-area a.nav-expander' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }


    protected function render()
    {
        $this->render_raw();
    }

    protected function render_raw()
    {
        $settings = $this->get_settings();

?>
        <div class="rs-offcanvas-area">
            <ul>
                <li class="nav-link pr-20">
                    <a id="nav-expander" class="nav-expander">
                        <i class="ri-menu-3-line"></i>
                    </a>
                </li>
            </ul>            
        </div>

<?php
    }
}
