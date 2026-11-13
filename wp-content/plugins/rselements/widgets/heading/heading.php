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
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Heading_Widget extends \Elementor\Widget_Base {

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
		return 'rs-heading';
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
	public function get_title() {
		return esc_html__( 'RS Heading', 'rsaddon' );
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
	public function get_icon() {
		return 'glyph-icon flaticon-letter';
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
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Heading Info', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'choose_color_scheme',
			[
				'label'   => esc_html__( 'Choose Color Scheme', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'primary_scheme',				
				'options' => [
					'default_scheme' => esc_html__('Default Scheme', 'rsaddon'),
					'primary_scheme' => esc_html__('Primary Scheme', 'rsaddon'),
					'primary_scheme2' => esc_html__('Primary Scheme 2', 'rsaddon'),
					'secondary_scheme' => esc_html__('Secondary Scheme', 'rsaddon'),
					'secondary_scheme2' => esc_html__('Secondary Scheme 2', 'rsaddon'),
					'gradient_scheme' => esc_html__('Gradient Scheme', 'rsaddon'),
				],											
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Heading Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'rsaddon'),
					'default2' => esc_html__( 'Default Reverse', 'rsaddon'),
					'style1'  => esc_html__( 'Intro Border Right', 'rsaddon'),
					'style2'  => esc_html__( 'Border Bottom', 'rsaddon'),
					'style3'  => esc_html__( 'Intro Border Left', 'rsaddon' ),
					'style4'  => esc_html__( 'Border Top', 'rsaddon' ),					
					'style6'  => esc_html__( 'Border Top Left', 'rsaddon' ),
					'style7'  => esc_html__( 'Border Top Right', 'rsaddon' ),
					'style8'  => esc_html__( 'Boder Left Vertical Style', 'rsaddon' ),
					'style9'  => esc_html__( 'Heading Image Style', 'rsaddon' ),
					'style5'  => esc_html__( 'Heading Bracket Style', 'rsaddon' ),
					'style10' => esc_html__( 'Heading Left Rotate Style', 'rsaddon' ),
					'style11' => esc_html__( 'Heading Right Rotate Style', 'rsaddon' ),
					'style12' => esc_html__( 'Left Vertical Border', 'rsaddon' ),
					'style13' => esc_html__( 'Left Right Icon', 'rsaddon' ),
					'style14' => esc_html__( 'Left Border', 'rsaddon' ),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sub_left_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition'=>[
					'style'=> 'style13',
				],
				
			]
		);
		$this->add_control(
			'sub_right_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition'=>[
					'style'=> 'style13',
				],
				
			]
		);
		$this->add_responsive_control(
            'sub_image_margin',
            [
                'label' => esc_html__( 'Image Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'=>[
					'style'=> 'style13',
				],
            ]
        );
		$this->add_responsive_control(
            'subimage_height',
            [
                'label' => esc_html__( 'Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'height: {{SIZE}}{{UNIT}};',
                ],
				'condition'=>[
					'style'=> 'style13',
				],
               
            ]
        );
		$this->add_responsive_control(
            'subimage_width',
            [
                'label' => esc_html__( 'Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text img' => 'width: {{SIZE}}{{UNIT}};',
                ],
				'condition'=>[
					'style'=> 'style13',
				],
               
            ]
        );
		$this->add_control(
			'animate_style',
			[
				'label'   => esc_html__( 'Animate Border Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'default'  => esc_html__( 'Select', 'rsaddon'),
					'style1'  => esc_html__( 'Animate Border Bottom One', 'rsaddon'),
					'style2'  => esc_html__( 'Animate Border Bottom Two', 'rsaddon'),	
					'style3'  => esc_html__( 'Animate Border Left & Right One', 'rsaddon'),	
					'style4'  => esc_html__( 'Animate Border Left & Right Two', 'rsaddon'),
					'intro-move-x'  => esc_html__( 'intro Move-X', 'rsaddon'),
				],
			]
		);
		$this->add_control(
            'dots_show_hide',
            [
                'label' => esc_html__( 'Dot Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'dots_bg',
                'label' => esc_html__( 'Dots Bg', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .prelements-heading.dots_yes .title-inner .title:before',
		        'condition'	=>[
		        	'style!'=>['style6','style7']
		        ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'top_left_border_bg',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .prelements-heading.style6 .title-inner span.sub-text::before, {{WRAPPER}} .prelements-heading.style6 .title-inner span.sub-text::after, {{WRAPPER}} .prelements-heading.style7 .title-inner span.sub-text::before, {{WRAPPER}} .prelements-heading.style7 .title-inner span.sub-text::after',
		        'condition'	=>[
		        	'style'=>['style6','style7']
		        ]
            ]
        );
		$this->add_responsive_control(
            'dots_show_position',
            [
                'label' => esc_html__( 'Position Y', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
                'show_label' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.dots_yes .title-inner .title::before' => 'top: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );
       
		$this->add_control(
            'border_color_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Color', 'prelements' ),
                'separator' => 'before',
				'condition' => [
					'animate_style' => ['style1', 'style2', 'style3', 'style4'],
				],
            ]
        );
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'animate_border_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-heading .pre-heading-line,{{WRAPPER}} .prelements-heading.style2 .pre-heading-line1:after',
				'condition' => [
					'animate_style' => ['style1', 'style2', 'style3', 'style4'],
				],
			]
		);
		$this->add_control(
            'animate_dot_color_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Dot Color', 'prelements' ),
                'separator' => 'before',
				'condition' => [
					'animate_style' => ['style1', 'style2', 'style3', 'style4'],
				],
            ]
        );
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'animate_dot_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-heading .pre-heading-line:before,{{WRAPPER}} .prelements-heading .pre-heading-line1:before,{{WRAPPER}} .prelements-heading.style2 .pre-heading-line1:before',
				'condition' => [
					'animate_style' => ['style1', 'style2', 'style3', 'style4'],
				],
			]
		);

		$this->add_control(
            'animate_border_color_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Color (Hover)', 'prelements' ),
                'separator' => 'before',
				'condition' => [
					'animate_style' => ['style1', 'style3'],
				],
            ]
        );
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'animate_border_color_hover',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .pre-heading-line1:before,{{WRAPPER}} .elementor-widget-container:hover .prelements-heading.style2 .pre-heading-line1:before',
				'condition' => [
					'animate_style' => ['style1', 'style3'],
				],
			]
		);

		$this->add_control(
            'animated_border_color_hover_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Dot Color (Hover)', 'prelements' ),
                'separator' => 'before',
				'condition' => [
					'animate_style' => ['style1', 'style3'],
				],
            ]
        );
		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'animated_border_color_hover',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .pre-heading-line1:after,{{WRAPPER}} .elementor-widget-container:hover .prelements-heading.style2 .pre-heading-line1:after',
				'condition' => [
					'animate_style' => ['style1', 'style2', 'style3', 'style4'],
				],
				'condition' => [
					'animate_style' => ['style1', 'style3'],
				],
			]
		);


		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Heading Text', 'prelements' ),
				'type' => Controls_Manager::TEXTAREA,
				'description'	=> esc_html__( 'Hightlight Title Settings will be worked, If you use this <span>Text</span> format', 'prelements' ),
				'default' => esc_html__( 'Heading Style', 'prelements' ),				
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Select Heading Tag', 'prelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [						
					'h1' => esc_html__( 'H1', 'prelements'),
					'h2' => esc_html__( 'H2', 'prelements'),
					'h3' => esc_html__( 'H3', 'prelements' ),
					'h4' => esc_html__( 'H4', 'prelements' ),
					'h5' => esc_html__( 'H5', 'prelements' ),
					'h6' => esc_html__( 'H6', 'prelements' ),					
				],
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__( 'Sub Heading Text', 'prelements' ),
				'type'      => Controls_Manager::TEXTAREA,				
				'default'   => esc_html__( 'Sub Heading', 'prelements' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Heading Image', 'prelements' ),
				'type'  => Controls_Manager::MEDIA,					
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image_postition',
			[
				'label'   => esc_html__( 'Select Image Position', 'prelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [						
					'top' => esc_html__( 'Top', 'prelements'),
					'bottom' => esc_html__( 'Bottom', 'prelements'),						
					
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'watermark',
			[
				'label' => esc_html__( 'Watermark Text', 'prelements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Watermark', 'prelements' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content',
			[
				'label'   => esc_html__( 'Description', 'prelements' ),
				'type'    => Controls_Manager::WYSIWYG,
				'rows'    => 10,			
			]
		);
		$this->add_responsive_control(
            'heading_align',
            [
                'label' => esc_html__( 'Alignment', 'prelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'prelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'prelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'prelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'prelements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
		$this->end_controls_section();


		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading Style', 'prelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
	    $this->add_control(
            'title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'prelements' ),
                'separator' => 'before',
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'prelements' ),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title',
			]
		);
		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'title_stroke_color',
            [
                'label' => esc_html__( 'Title Stroke Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title' => '-webkit-text-stroke: 1px {{VALUE}}!important;',
                ],                
            ]
        );
		$this->add_control(
			'heading_gradient_setting',
			[
				'label'   => esc_html__( 'Heading Gradient Color', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subnormal_color',
				'options' => [					
					'heading_normal_color' => esc_html__( 'Normal Color', 'rsaddon'),
					'heading_gradient_color' => esc_html__( 'Gradient Color', 'rsaddon'),
				],
			]
		);
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_title_color_gradient',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-heading.heading_gradient_color .title-inner .title',
                'condition' => [
					'heading_gradient_setting' => 'heading_gradient_color',
				],
            ]
        );
        $this->add_control(
            'title_fill_stroke_color',
            [
                'label' => esc_html__( 'Title Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title' => '-webkit-text-fill-color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title',
			]
		);
        $this->add_control(
            'sub_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Sub Title', 'prelements' ),
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography', 'prelements' ),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .sub-text',
			]
		);
		$this->add_control(
			'gradient_setting',
			[
				'label'   => esc_html__( 'Subtitle Gradient Color', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'subnormal_color',
				'options' => [					
					'subnormal_color' => esc_html__( 'Normal Color', 'rsaddon'),
					'subgradient_color' => esc_html__( 'Gradient Color', 'rsaddon'),
				],
			]
		);
		$this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'color: {{VALUE}};',
                ],              
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_color_gradient',
                'label' => esc_html__( 'Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-heading .title-inner .sub-text',
                'condition' => [
					'gradient_setting' => 'subgradient_color',
				],
            ]
        );
		$this->add_control(
            'subtitle_bg_color',
            [
                'label' => esc_html__( 'Subtitle background', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'background: {{VALUE}};',
                ],                
            ]
        );
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => esc_html__( 'Subtitle Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__( 'Subtitle Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
        	'sub_border_radius',
        	[
        		'label' => __( 'Border Radius', 'elementor' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', '%' ],
        		'selectors' => [
        			'{{WRAPPER}} .prelements-heading .title-inner .sub-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );
        $this->add_control(
            'des_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'prelements' ),
                'separator' => 'before',
            ]
        ); 
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__( 'Description Typography', 'prelements' ),
				'selector' => '{{WRAPPER}} .prelements-heading .description p',
				'selector' => '{{WRAPPER}} .prelements-heading .description',
			]
		);
		$this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Description Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .description' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prelements-heading .description p' => 'color: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'desc__hover__color',
            [
                'label' => esc_html__( 'Description Hover Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .description p a:hover' => 'color: {{VALUE}}!important;',
                    
                ],                
            ]
        );

        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Description Margin', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .description p, {{WRAPPER}} .prelements-heading .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__( 'Description Padding', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_style_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style', 'rsaddon' ),
                'separator' => 'before',
				'condition' => [
					'style!' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
		    'border_position_x',
		    [
				'label'      => esc_html__( 'Position X', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style2:after'                        => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style1 .description:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after' => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style2 .title-inner .title:before'   => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after' => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .title-inner:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .description:after'           => 'left: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style!' => 'style4',
				]
		    ]
		);

		$this->add_responsive_control(
		    'border_position_y',
		    [
				'label'      => esc_html__( 'Position Y', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style2:after'                        => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style1 .description:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after' => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style2 .title-inner .title:before'   => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after' => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .title-inner:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .description:after'           => 'top: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style!' => 'style4',
				]
		    ]
		);

		$this->add_responsive_control(
		    'border_width',
		    [
				'label'      => esc_html__( 'Width', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style2:after'                        => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style1 .description:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after' => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style2 .title-inner .title:before'   => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after' => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .title-inner:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .description:after'           => 'width: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style!' => 'style4',
				]
		    ]
		);

		$this->add_responsive_control(
		    'border_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style2:after'                        => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style1 .description:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after' => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style2 .title-inner .title:before'   => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after' => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .title-inner:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .prelements-heading.style8 .description:after'           => 'height: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style!' => 'style4',
				]
		    ]
		);

		$this->add_responsive_control(
		    'border_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style2:after'                        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style1 .description:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style2 .title-inner .title:before'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style8 .title-inner:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .prelements-heading.style8 .description:after'           => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'style!' => 'style4',
				]
		    ]
		);
		$this->add_control(
            'before_border_color',
            [
                'label' => esc_html__( 'Border Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style14 .title' => 'border-color: {{VALUE}};',
                ], 
				'condition' => [
					'style' => 'style14',
				]	               
            ]
        );

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_border_color',
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => ' {{WRAPPER}} .prelements-heading.style2:after, {{WRAPPER}} .prelements-heading.style1 .description:after, {{WRAPPER}} .prelements-heading.style6 .title-inner .sub-text:after, {{WRAPPER}} .prelements-heading.style4 .title-inner h2:before, {{WRAPPER}} .prelements-heading.style2 .title-inner .title:before, {{WRAPPER}} .prelements-heading.style7 .title-inner .sub-text:after, {{WRAPPER}} .prelements-heading.style8 .title-inner:after, {{WRAPPER}} .prelements-heading.style8 .description:after',
				'condition' => [
					'style!' => 'style4',
				]
            ]
        );

		// Controls For Style 4
		$this->add_control(
            'border_global_control_style4_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style Universal', 'rsaddon' ),
                'separator' => 'before',
				'condition' => [
					'style' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
		    'border_style4_width',
		    [
				'label'      => esc_html__( 'Width', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after, {{WRAPPER}} .prelements-heading.style4 .title-inner .title:before' => 'width: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style' => 'style4',
				]
		    ]
		);
		$this->add_responsive_control(
		    'border_style4_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after, {{WRAPPER}} .prelements-heading.style4 .title-inner .title:before' => 'height: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style' => 'style4',
				]
		    ]
		);
		$this->add_responsive_control(
		    'style4_border_position_y',
		    [
				'label'      => esc_html__( 'Position Y', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .prelements-heading.style4 .title-inner .title:after' => 'top: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style' => 'style4',
				]
		    ]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style4_border_background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .prelements-heading.style4 .title-inner .title:after',
				'condition' => [
					'style' => 'style4',
				]
			]
		);
		$this->add_responsive_control(
			'style4_border_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before, {{WRAPPER}} .prelements-heading.style4 .title-inner .title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		// Before
		$this->add_control(
            'border_style4_heading_before',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style (Before)', 'rsaddon' ),
                'separator' => 'before',
				'condition' => [
					'style' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
            'border_style4_heading_before_show_hide',
            [
                'label' => esc_html__( 'Before (Show/Hide)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-editor-close',
                    ],
                ],
				'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before' => 'display: {{VALUE}} !important;',
                ],
				'condition' => [
					'style' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
		    'style4_border_position_left',
		    [
				'label'      => esc_html__( 'Position X (Left)', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before' => 'left: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_before_show_hide' => 'block',
				]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'shape_border_style4_before',
		        'selector' => '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before',
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_before_show_hide' => 'block',
				]
		    ]
		);
		$this->add_responsive_control(
		    'style4_border_before_z_index',
		    [
				'label'      => esc_html__( 'Z-Index', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:before' => 'z-index: {{SIZE}} !important;',
		        ],
				'range' => [
					'px' => [
						'max' => 100,
						'min' => -100,
					],
				],
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_before_show_hide' => 'block',
				]
		    ]
		);
		// After
		$this->add_control(
            'border_style4_heading_after',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Border Style (After)', 'rsaddon' ),
                'separator' => 'before',
				'condition' => [
					'style' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
            'border_style4_heading_after_show_hide',
            [
                'label' => esc_html__( 'After (Show/Hide)', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'eicon-editor-close',
                    ],
                ],
				'default' => 'none',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after' => 'display: {{VALUE}} !important;',
                ],
				'condition' => [
					'style' => 'style4',
				]
            ]
        );
		$this->add_responsive_control(
		    'style4_border_position_right',
		    [
				'label'      => esc_html__( 'Position X (Right)', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => 0,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after' => 'right: {{SIZE}}{{UNIT}} !important;',
		        ],
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_after_show_hide' => 'block',
				]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'shape_border_style4_after',
		        'selector' => '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after',
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_after_show_hide' => 'block',
				]
		    ]
		);
		$this->add_responsive_control(
		    'style4_border_after_z_index',
		    [
				'label'      => esc_html__( 'Z-Index', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading.style4 .title-inner .title:after' => 'z-index: {{SIZE}} !important;',
		        ],
				'range' => [
					'px' => [
						'max' => 100,
						'min' => -100,
					],
				],
				'condition' => [
					'style' => 'style4',
					'border_style4_heading_after_show_hide' => 'block',
				]
		    ]
		);
		// Controls For Style 4

		$this->end_controls_section();

		$this->start_controls_section(
			'title_highlight_style',
			[
				'label' => esc_html__( 'Highlight Title', 'prelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hightlight_typography',
				'label' => esc_html__( 'Hightlight Typography', 'prelements' ),
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title span',
			]
		);
		$this->add_control(
			'highlight_setting',
			[
				'label'   => esc_html__( 'Select Highlight Color', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal_color',
				'options' => [					
					'normal_color' => esc_html__( 'Normal Color', 'rsaddon'),
					'gradient_color' => esc_html__( 'Gradient Color', 'rsaddon'),
					'stroke_color' => esc_html__( 'Stroke Color', 'rsaddon'),
				],
			]
		);
		$this->add_control(
            'highlight_color',
            [
                'label' => esc_html__( 'Highlight Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span, {{WRAPPER}} .prelements-heading .title-inner .title span a' => 'color: {{VALUE}};',
                ], 
                'condition' => [
					'highlight_setting' => 'normal_color',
				],	               
            ]
        );
		$this->add_control(
            'underline_color',
            [
                'label' => esc_html__( 'Underline Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span:not(.watermark):after' => 'background: {{VALUE}};',
                ], 
                'condition' => [
					'highlight_setting' => 'normal_color',
				],	               
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'high_light_border_color',
				'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title span:nth-of-type(2)::after',
			]
		);
		$this->add_responsive_control(
		    'high_light_border_bottom_position',
		    [
				'label'      => esc_html__( 'Border Bottom Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [

		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading .title-inner .title span:nth-of-type(2)::after'=> 'bottom: {{SIZE}}{{UNIT}}',
		            
		        ],
				
		    ]
		);
		$this->add_control(
            'highlight_title_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => '-webkit-text-stroke: 2px {{VALUE}};',
                ],  
				'condition' => [
					'highlight_setting' => 'stroke_color',
				],              
            ]
        );
        $this->add_control(
            'hightlight_title_fill_stroke_color',
            [
                'label' => esc_html__( 'Highlight Stroke Fill Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => '-webkit-text-fill-color: {{VALUE}};',
                ], 
				'condition' => [
					'highlight_setting' => 'stroke_color',
				],               
            ]
        );
		$this->add_responsive_control(
            'highlight_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ],  
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'highlight_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', 'custom' ], 
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'highlight_color_gradient',
                'label' => esc_html__( 'Highlight Gradient Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-heading .title-inner .title span',
                'condition' => [
					'highlight_setting' => 'gradient_color',
				],
            ]
        ); 
		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'hightlight_shape_color',
                'label' => esc_html__( 'Hightlight Shape', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .prelements-heading .title span:nth-child(2)::after',
            ]
        );
		$this->add_responsive_control(
            'hightlight_width',
            [
                'label' => esc_html__( 'Text Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => 'width: {{SIZE}}{{UNIT}}; display: inline-block;',
                ],
                
            ]
        );
		$this->add_control(
            'hightlight_align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading .title-inner .title span' => 'text-align: {{VALUE}}'
                ],
            ]
        );

		$this->add_control(
            'hover_after_underline_color',
            [
                'label' => esc_html__( 'Hover After Underline Color', 'prelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .free-estimate-underline .prelements-heading span a:after' => 'background: {{VALUE}};',
                ], 	               
            ]
        );

        $this->add_control(
            'watermark_style_position',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Watermark Position', 'rsaddon' ),
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
		    'watermark_position_style__x',
		    [
				'label'      => esc_html__( 'Watermark Position X', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [

		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading .title-inner span.watermark'=> 'left: {{SIZE}}{{UNIT}} !important;',
		            
		        ],
				
		    ]
		);
		$this->add_responsive_control(
		    'watermark_position_style__y',
		    [
				'label'      => esc_html__( 'Watermark Position Y', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
		        'range' => [
		            '%' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .prelements-heading .title-inner span.watermark' => 'top: {{SIZE}}{{UNIT}};',
		    	],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'title_image_style',
			[
				'label' => esc_html__( 'Image Settings', 'prelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style9',
				],
			]

		);
		$this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style9 .title-inner img' => 'width: {{SIZE}}{{UNIT}};',                    
                ],

              
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style9 .title-inner .title-img > img' => 'height: {{SIZE}}{{UNIT}};',
                ],
               
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'prelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .prelements-heading.style9 .title-inner .title-img > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
              
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
	protected function render() {

		$settings = $this->get_settings_for_display(); 

		$heading_gradient_setting = $settings['heading_gradient_setting'];

		$watermark_text = ($settings['watermark']) ? '<span class="watermark">'.($settings['watermark']).'</span>' : '';

		$main_title   = ($settings['title']) ? '<'.$settings['title_tag'].' class="title"><span class="watermark">'.$settings['watermark'].'</span>'.wp_kses_post($settings['title']).'</'.$settings['title_tag'].'>' : '';

		
		if( "style4"==	$settings['style'] || "style4 Lite"== $settings['style'] || "style6"== $settings['style'] || "style6 Lite"==$settings['style'] || "style7" == $settings['style'] || "style7 Lite"== $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text">'.($settings['subtitle']).'</span>' : '';
		}
		elseif ( "style5" == $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text title-upper">[ <span class="sub-text title-upper">'.($settings['subtitle']).'</span> ] </span>' : '';
		}
		elseif("style3" == $settings['animate_style']){
			$sub_text       = ($settings['subtitle'])  ? '<span class="sub-text"> <span class="pre-heading-line1"></span>'.($settings['subtitle']) .'</span>' : '';
		}
		elseif("style4" == $settings['animate_style']){
			$sub_text       = ($settings['subtitle'])  ? '<span class="sub-text"> <span class="pre-heading-line"></span>'.($settings['subtitle']) .'</span>' : '';
		}
		elseif ("style13" == $settings['style']){
			$right_img = '';
			if(!empty($settings['sub_right_image']['url']) ) {
				$right_img = '<img src="' . $settings['sub_right_image']['url'] . '" alt="icon">';
			}
			
			if(!empty($settings['sub_left_image']['url'])){
				$sub_text = ($settings['subtitle'])  ? '<span class="sub-text"> 
				<img src="' . $settings['sub_left_image']['url'] . '" alt="icon"> '.'  '.($settings['subtitle']).'  ' .$right_img. '</span>' : '';
			} else {
				$sub_text = ($settings['subtitle'])  ? '<span class="sub-text"> <i class="ri-tools-fill"></i>  '.($settings['subtitle']).'</span>' : '';
			}
			

		}
		else{
			$sub_text       = ($settings['subtitle'])  ? '<span class="sub-text ">'.($settings['subtitle']) .'</span>' : '';
		}


		$titleimg    = $settings['image'] ? '<img src="' . $settings['image']['url'] . '" alt="icon">' : '';

		$topimage    = $settings['image_postition'] == 'top' ? ' '.$titleimg .'' : '';

		$bottomimage = $settings['image_postition'] == 'bottom' ? '<div class="title-img bottom-img">'.$titleimg .'</div>' : "";


		$h_align = '';
		if (!empty($settings['heading_align'])) {
			$h_align = $settings['heading_align'];
		}

		

		if( "style9" == $settings['style'] ){
			$main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title" ><span class="watermark">'.$settings['watermark'].'</span>'.($settings['title']).'</'.$settings['title_tag'].'>' : '';
		}
        // Fill $html var with data
      ?>

        <div class="prelements-heading <?php echo esc_attr($settings['style']);?> color_<?php echo esc_html($settings['choose_color_scheme']);?> animate-<?php echo esc_attr($settings['animate_style']);?> <?php echo esc_attr($h_align);?> <?php echo esc_attr($settings['highlight_setting']);?>  <?php echo esc_attr($settings['gradient_setting']);?> dots_<?php echo esc_attr($settings['dots_show_hide']);?> <?php echo esc_attr($heading_gradient_setting);?>">
        	<div class="title-inner">      		
	            <?php
	            
					if ( "style9" == $settings['style'] && !empty( $settings['image']['url'] ) ) {
						echo wp_kses_post($topimage) ;
					}
					if ( "style13" == $settings['style'] || isset($settings['sub_right_image']['url']) ) {
						echo wp_kses_post($sub_text) ;
					}
					if( ("style4"  != $settings['style']) && ("style13"  != $settings['style']) && ("default2" != $settings['style'])){
						echo wp_kses_post($sub_text);
					}
					// default style
					echo wp_kses_post($main_title);

					if( "default2"  == $settings['style'] ){
						echo wp_kses_post($sub_text);
					}
					
					if (!empty("style9" == $settings['style']) && !empty($bottomimage)) {
						echo wp_kses_post($bottomimage) ;
					}
					
				?>
				<?php if( "style1" == $settings['animate_style'] ){?>
					<div class="pre-heading-line1"></div>
				<?php } ?>

				<?php if( "style2" == $settings['animate_style'] ){?>
					<div class="pre-heading-line"></div>
				<?php } ?>
	        </div>
	        <?php if ($settings['content']) { ?>
            	<div class="description">
            		<?php if( "style12" == $settings['style'] ){ ?>
            			<div class="draw-line start-draw"></div>
            		<?php } ?>
            		<?php echo wp_kses_post($settings['content']);?>  
            	</div>
        	<?php } ?>
        </div>
        <?php 		
	}
} ?>