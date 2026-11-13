<?php
/**
 * Feature List
 *
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Service_Item_Widget extends \Elementor\Widget_Base {

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
        return 'rsservicelist';
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
        return esc_html__( 'RS Service List', 'rsaddon' );
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
        return [ 'list', 'title', 'service', 'heading', 'plan' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Service Item', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		); 


        $repeater = new Repeater();
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '100GB free space with hosting', 'rsaddon' ),
            ]
        );
        $repeater->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',            
                'options' => [                  
                    'icon' => esc_html__( 'Icon', 'rsaddon'),
                    'image' => esc_html__( 'Image', 'rsaddon'),         
                ],
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'text-domain' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ], 
            ]
        );
        $repeater->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type'  => Controls_Manager::MEDIA,             
                'condition' => [
                    'icon_type' => 'image',
                ], 
            ]
        );

        $repeater->add_control(
			'feature_list_link',
			[
				'label' => esc_html__( 'Link', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '#', 'rsaddon' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
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
                        'text' => esc_html__( 'Request Services', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'feature_list_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'text' => esc_html__( 'Responsive Servive List', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                        'feature_list_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->add_control(
			'service_item_gap',
			[
				'label' => esc_html__( 'Item Gap', 'rsaddon' ),
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
					'{{WRAPPER}} .service-item-area .service-item' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'Wrapper', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .service-item-area .service-item',
            ]
        );
        $this->add_control(
            'box_hover_bg',
            [
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .service-item-area .service-item:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .service-item-area .service-item'
            ]
        );       

        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator' => 'before', 
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_border',
                'selector' => '{{WRAPPER}} .service-item-area .service-item'                
            ]
        );
       $this->add_responsive_control(
            'features_item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();   

        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .service-item-area .service-item .service-icon-title span',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item .service-icon-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item .service-icon-title span' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item:hover .service-icon-title span' => 'color: {{VALUE}};',
                ],
            ]
        ); 
      


        $this->end_controls_section();  

        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon & image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
       
        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Svg Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item svg' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Svg Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item svg' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'icon_img_height',
            [
                'label' => esc_html__( 'Image Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item .service-icon-title img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );
        $this->add_responsive_control(
            'icon_img_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item .service-icon-title img' => 'width: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_arrow_icon',
            [
                'label' => esc_html__( 'Arrow', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_arrow_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item .arrow-btn i' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'icon_hover_arrow_color',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-item-area .service-item:hover .arrow-btn i' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_typography',
                'selector' => '{{WRAPPER}} .service-item-area .service-item .arrow-btn i',
            ]
        );

        $this->end_controls_section();
    }

  

	protected function render() {
        $settings = $this->get_settings_for_display();?> 

        <div class="service-item-area">
            <?php foreach ( $settings['features_list'] as $index => $feature ) : 

                $title_text = $feature['text'];

                $target       = !empty($feature['feature_list_link']['is_external']) ? 'target=_blank' : '';                    
				$link         = !empty($feature['feature_list_link']['url']) ? $feature['feature_list_link']['url'] : '';

                
                ?>
                <a href="<?php echo esc_url($link);?>"  class="service-item">
                    <div class="service-icon-title">
                    <?php if(!empty($feature['selected_image']['url'])) {  ?>
                        <img src="<?php echo esc_url( $feature['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($feature['selected_image'])); ?>">
                    <?php } else { ?>
                        <?php \Elementor\Icons_Manager::render_icon( $feature['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php } ?>
                        <span><?php echo $title_text;?></span>
                    </div>
                    <div class="arrow-btn"><i class="ri-arrow-right-line"></i></div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php
    }
}
