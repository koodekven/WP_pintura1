<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\register_controls;

if ( ! defined( 'ABSPATH' ) ) die(); // Exit if accessed directly

class Rsaddon_Elementor_Image_Comparison_Pro_Widget extends \Elementor\Widget_Base {

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
		return 'rs-image-comparision';
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
		return esc_html__( 'Image Comparision', 'rsaddon' );
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
		return 'glyph-icon flaticon-slider-1';
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
			'image',
			[
				'label' => __( 'Image', 'rsaddon' )
			]
		);

	
		
		$this->add_control('before_image',
			[
				'label' => __( 'Before Image', 'rsaddon' ),
				'type' => Controls_Manager::MEDIA,
                
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'show_label' => true,
			]
		);

	

		$this->add_control(
			'image_head',
			[
				'label'     => __('', 'rsaddon'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control('after_image',
			[
				'label' => __( 'After Image', 'rsaddon' ),
				'type' => Controls_Manager::MEDIA,                
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
				'show_label' => true,
			]
		);

		
		$this->add_control(
			'separator_text',
			[
				'label'     => __('', 'rsaddon'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'comparision_boxes_height',
			[
				'label' => __( 'Image Comparision Height', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rs-image-comparision' => 'height: {{SIZE}}px !important;',
					
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'General', 'rsaddon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);		

		
		$this->add_control(
			'slider_bg_color',
			[
				'label'     => __('Slider Control Background', 'rsaddon'),
				'type'      => Controls_Manager::COLOR,			
				'selectors'    => [
					'{{WRAPPER}} div.drag div.draghandle' => 'background-color:{{VALUE}} !important;  '
				]
			]
		);
		$this->add_control(
			'slider_bg_width',
			[
				'label' => __( 'Slider Control Width', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} div.drag div.draghandle' => 'width: {{SIZE}}px;',
					
				],
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label'     => __('Separator Color', 'rsaddon'),
				'type'      => Controls_Manager::COLOR,			
				'selectors'    => [
					'{{WRAPPER}} div.drag' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} div.drag div.draghandle' => 'border-color:{{VALUE}} ',
					'{{WRAPPER}} div.drag div.draghandle::before' => 'color:{{VALUE}}'
				]
			]
		);	

		$this->add_control(
			'slider_separator_width',
			[
				'label' => __( 'Separator Width', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} div.drag' => 'width: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'slider_border_width',
			[
				'label' => __( 'Separator Border Width', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} div.drag div.draghandle' => 'border-width:{{SIZE}}px;',
					
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
		        'label_style',
			[
				'label'    =>  __('Label', 'rsaddon'),
				'tab'      => Controls_Manager::TAB_STYLE
			]
        );
        $this->add_responsive_control(
			'before_after_top_bottom_position',
			[
				'label' => esc_html__( 'Before/After (Top-Bottom) Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'before_right__position',
			[
				'label' => esc_html__( 'Before Right Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} div.beforeandafter div.drag::before' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'after_left_position',
			[
				'label' => esc_html__( 'After Left Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} div.beforeandafter div.drag::after' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_text_typography',
				'selector' => '{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __('Color', 'rsaddon'),
				'type'      => Controls_Manager::COLOR,
				'selectors'    => [
					'{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'color: {{VALUE}}',					
				]
			]
		);
		$this->add_control(
			'label_background_color',
			[
				'label'     => __('Background Color', 'rsaddon'),
				'type'      => Controls_Manager::COLOR,				
				'selectors'    => [
					'{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'background-color: {{VALUE}}',					
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'label_border',
				'label' => __( 'Box Border', 'rsaddon' ),
				'selector' =>'{{WRAPPER}} div.beforeandafter div.drag::before, {{WRAPPER}} div.beforeandafter div.drag::after',
			]
		);



		$this->add_control(
			'label_border_radius',
			[
				'label' => __( 'Border Radius', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px','%' ],
				'selectors' => [
					'{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					
				],
			]
		);
		$this->add_responsive_control(
            'before_after_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
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
                    '{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'width: {{SIZE}}{{UNIT}};',              
                ],
            ]
        );
        $this->add_responsive_control(
            'before_after_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
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
                    '{{WRAPPER}} div.beforeandafter div.drag::before,{{WRAPPER}} div.beforeandafter div.drag::after' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',              
                ],
            ]
        );
		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();        
		$unique = rand(12,35120);

		$before_img = $settings['before_image']['id'];
		$before_img_alt = get_post_meta( $before_img, '_wp_attachment_image_alt', true );
		if (empty($before_img_alt)) {
			$before_img_alt = get_the_title( $before_img );
		}

		$after_img = $settings['after_image']['id'];
		$after_img_alt = get_post_meta( $before_img, '_wp_attachment_image_alt', true );
		if (empty($after_img_alt)) {
			$after_img_alt = get_the_title( $after_img );
		}
		?>
        <div id="rscomprision-<?php echo $unique;?>" class="beforeandafter rs-image-comparision label-bottom" style="width: 100%;">

			<div class="before1">
				<?php echo wp_get_attachment_image( $before_img, 'before_image_size', false, ['alt' => $before_img_alt] ); ?>
			</div>

			<div class="after1">
				<?php echo wp_get_attachment_image( $after_img, 'after_image_size', false, ['alt' => $after_img_alt] ); ?>
			</div>

		</div>
		<script>
			jQuery(function(){ // after DOM has loaded
				bafinstance = new ddbeforeandafter({
						wrapperid: 'rscomprision-<?php echo $unique; ?>'
				})
			})
		</script>

        <?php
    }  
}