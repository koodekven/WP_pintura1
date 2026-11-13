<?php
/**
 * Elementor RS Couter Widget.
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RS_Fluent_Form_Widget extends \Elementor\Widget_Base {

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
        return 'rs-fluent-form';
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
        return esc_html__( 'RS Fluent Forms', 'rsaddon' );
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
        return [ 'counter' ];
    }
	protected function register_controls() {
		$this->start_controls_section(
			'_section_cf7',
			[
				'label' => esc_html__( 'RS Fluent Forms', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
        // contact-heading-title
        $this->add_control(
            'selected_form_id',
            [
                'label' => esc_html__( 'Chosse Your Form', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => esc_html__( '', 'rsaddon' ) ] + \rs_get_fluents_forms(),
            ]
        ); 
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => esc_html__( 'Form Fields', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'field_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'field_width_select',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'height: {{SIZE}}px; display: block;',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => esc_html__( 'Spacing Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_all_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} select:valid, {{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)',
            ]
        );

        $this->add_control(
            'field_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fluentform .ff-el-form-control' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} input[type=email]' => 'color: {{VALUE}}!important;',
                ],
            ]
        );        


        $this->add_control(
            'field_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} select:valid' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'field_focus_color',
            [
                'label' => esc_html__( 'Field Focus Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} body .ff-el-form-control:not(.ff-el-submit)' => 'color: {{VALUE}}!important;',
                ],
            ]
        );
        $this->add_control(
            'select_arrow_icon_color__hgth',
            [
                'label' => esc_html__( 'Select Arrow Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .select-full:after' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'placeholder_field_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} ::-webkit-input-placeholder,{{WRAPPER}} ::-moz-placeholder,{{WRAPPER}} ::placeholder',
            ]
        );

        $this->add_responsive_control(
            'input_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $this->add_control(
            'input_icon_text_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .ff-el-form .col-sm-12 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .ff-el-form .col-sm-6 i' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .contact-us-page .ff-el-form i' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'icon_focus_color',
            [
                'label' => esc_html__( 'Icon Focus Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit):focus .ff-el-form .col-sm-12 i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i,{{WRAPPER}} .wpcf7 .col-sm-6 i' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'icon_left_position',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .form-list i, {{WRAPPER}} .wpcf7 .col-sm-12 i,{{WRAPPER}} .wpcf7 .col-sm-6 i' => 'left: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'email_icon_top_position',
            [
                'label' => esc_html__( 'Email Top/Bottom Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .col-sm-12 p i.ri-mail-line' => 'top: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .wpcf7 .col-sm-6 p i.ri-mail-line' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'phone_icon_top_position',
            [
                'label' => esc_html__( 'Phone Top/Bottom Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .col-sm-12 p i.ri-phone-fill' => 'top: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .wpcf7 .col-sm-6 p i.ri-phone-fill' => 'top: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .wpcf7 .col-sm-6 p i' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'message_icon_top_position',
            [
                'label' => esc_html__( 'Textarea Top/Bottom Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 .col-sm-12 p i.ri-edit-line' => 'top: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        ); 

        $this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'selector' => '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)',
            ]
        );

        $this->add_control(
            'field__border_mac',
            [
                'label'   => esc_html__( 'Border Type (For Mac)', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    '' => esc_html__( 'None', 'rsaddon' ),
                    'solid' => esc_html__( 'Solid', 'rsaddon' ),
                    'double' => esc_html__( 'Double', 'rsaddon' ),
                    'dotted' => esc_html__( 'Dotted', 'rsaddon' ),
                    'dashed' => esc_html__( 'Dashed', 'rsaddon' ),
                    'groove' => esc_html__( 'Groove', 'rsaddon' ),
                ],
            ]
        );

        $this->add_control(
            'field__border_width',
            [
                'label'   => esc_html__( 'Border Width (For Mac)', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [                  
                    '1px' => esc_html__( '1', 'rsaddon' ),
                    '2px' => esc_html__( '2', 'rsaddon' ),
                    '3px' => esc_html__( '3', 'rsaddon' ),
                    '4px' => esc_html__( '4', 'rsaddon' ),
                    '5px' => esc_html__( '5', 'rsaddon' ),
                    '6px' => esc_html__( '6', 'rsaddon' ),
                    '7px' => esc_html__( '7', 'rsaddon' ),
                    '8px' => esc_html__( '8', 'rsaddon' ),
                    '9px' => esc_html__( '9', 'rsaddon' ),
                    '10px' => esc_html__( '10', 'rsaddon' ),
                    '11px' => esc_html__( '11', 'rsaddon' ),
                    '12px' => esc_html__( '12', 'rsaddon' ),
                ],
                'condition' => [
                    'field__border_mac!' => '',
                ]
            ]
        );

        $this->add_control(
            'field__border_color',
            [
                'label' => esc_html__( 'Color (For Mac)', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'field__border_mac!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'field_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .request-a-services select, {{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => esc_html__( 'Focus', 'rsaddon' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_focus_border',
                'selector' => '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit):focus, {{WRAPPER}} body div textarea:focus, {{WRAPPER}} input[type="text"]:focus, {{WRAPPER}} input[type="number"]:focus, {{WRAPPER}} input[type="password"]:focus, {{WRAPPER}} input[type="email"]:focus, {{WRAPPER}} input[type="search"]:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit):focus',
            ]
        );

        $this->add_control(
            'field_focus_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .request-a-services select, {{WRAPPER}} .ff-el-form-control:not(.ff-el-submit):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'cf7-form-label',
            [
                'label' => esc_html__( 'Form Fields Label', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__( 'Spacing Bottom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ff-el-form-control:not(.ff-el-submit)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr3',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'select',
            [
                'label' => esc_html__( 'Select', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'select_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .ff-el-input--content select' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'select_dropdown_icon_color',
            [
                'label' => esc_html__( 'Dropdown Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,            
                'selectors' => [
                    '{{WRAPPER}} .fluentform .ff-el-form-control' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'select_input_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} select.ff-el-form-control:not([size]):not([multiple])' => 'height: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'textarea',
            [
                'label' => esc_html__( 'Textarea', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'textarea_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} textarea.ff-el-form-control' => 'width: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );

        $this->add_responsive_control(
            'textarea_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} textarea.ff-el-form-control' => 'height: {{SIZE}}{{UNIT}} !important;',                    
                                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'submit',
            [
                'label' => esc_html__( 'Submit Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .ff-btn-submit' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-fluent-form .wpf_has_custom_css.ff-btn-submit' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ff-btn-submit,{{WRAPPER}} .rs-fluent-form .wpf_has_custom_css.ff-btn-submit',
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
                    '{{WRAPPER}} .ff-btn-submit:hover, {{WRAPPER}} .ff-btn-submit:focus,{{WRAPPER}} .rs-fluent-form .wpf_has_custom_css.ff-btn-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ff-btn-submit:hover, {{WRAPPER}} .ff-btn-submit:focus,{{WRAPPER}} .rs-fluent-form .wpf_has_custom_css.ff-btn-submit:hover,{{WRAPPER}} .rs-fluent-form .wpf_has_custom_css.ff-btn-submit:focus',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'field_width_btn',
            [
                'label' => esc_html__( 'Button Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ff-btn-submit' => 'width: {{SIZE}}{{UNIT}};',                    
                                    
                ],
            ]
        );
        $this->add_responsive_control(
            'submit_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .frm-fluent-form .ff-t-cell .ff_submit_btn_wrapper_custom button ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',                    
                ],
            ]
        );
        $this->add_responsive_control(
            'submit_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-btn-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .ff-btn-submit',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .ff-btn-submit',
            ]
        );
        $this->add_control(
            'submit_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .ff-btn-submit' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_box_shadow',
                'selector' => '{{WRAPPER}} .ff-btn-submit',
            ]
        );
        $this->add_control(
            'hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );
       
        $this->end_controls_section();


        $this->start_controls_section(
            'contact_from_error_msg',
            [
                'label' => esc_html__( 'Validation Message', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'success_message_validate_color',
            [
                'label' => esc_html__( 'Error Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ff-el-not-valid-tip' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .error text-danger' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_margin',
            [
                'label' => esc_html__( 'Error Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fluentform .ff-el-is-error .text-danger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .fluentform .ff-el-is-error .text-danger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_padding',
            [
                'label' => esc_html__( 'Error Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fluentform .ff-el-is-error .text-danger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_validate_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .fluentform .ff-el-is-error .text-danger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'errorb_ackground',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .fluentform .ff-el-is-error .text-danger',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'contact_from_success_msg',
            [
                'label' => esc_html__( 'Invalid Output', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'success_message_text_color',
            [
                'label' => esc_html__( 'Invalid Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.invalid .ff-el-response-output' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wpcf7 form.unaccepted .ff-el-response-output' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cf7_response_margin',
            [
                'label' => esc_html__( 'Invalid Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .ff-el-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_response_padding',
            [
                'label' => esc_html__( 'Invalid Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .ff-el-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_response_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form .ff-el-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'error_success_background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .wpcf7 .ff-el-form.invalid .ff-el-response-output',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'contact_cf7_from_success_msg',
            [
                'label' => esc_html__( 'Success Message', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cf7_from_success_responsetext_color',
            [
                'label' => esc_html__( 'Success Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ff-message-success' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'success_message_align',
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
                    '{{WRAPPER}} .ff-message-success' => 'text-align: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'success__field_border',
                'selector' => '{{WRAPPER}} .ff-message-success',
            ]
        );

        $this->add_responsive_control(
            'cf7_from_response_margin',
            [
                'label' => esc_html__( 'Success Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-message-success' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_from_response_padding',
            [
                'label' => esc_html__( 'Success Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-message-success' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cf7_from_response_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ff-message-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cf7_from_success_sent_background',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ff-message-success',
            ]
        );
        $this->end_controls_section();

        // 
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 
        
        ?>
        
        <div class="rs-fluent-form">
        <?php 
        if ( ! empty( $settings['selected_form_id'] ) ) {
            echo  do_shortcode( '[fluentform id="'.$settings['selected_form_id'].'"]');
        } ?>
        </div>
        <?php 
        $field__border_mac = $settings[ 'field__border_mac'] ?? '';
        $field__border_width = $settings[ 'field__border_width'] ?? '';
        $field__border_color = $settings[ 'field__border_color'] ?? '';
        if ( $field__border_mac && ! empty( $field__border_mac )) { ?>            
            <style type="text/css">
                body .ff-el-form-control:not(.ff-el-submit){
                    -webkit-border-before: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-after: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-start: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                    -webkit-border-end: <?php echo esc_attr($field__border_width) ?> <?php echo esc_attr($field__border_mac) ?> <?php echo esc_attr($field__border_color) ?> !important;
                }           
            </style>
            <?php
        }
    }
}