<?php
/**
 * Image widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Image_Showcase_Widget extends \Elementor\Widget_Base {
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
        return 'rs-image';
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
        return esc_html__( 'RS Image Showcase', 'rsaddon' );
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
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

        $this->add_control(
            'first_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,     
                'separator' => 'before',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'popup_animation',
            [
                'label' => esc_html__( 'Popup Effect', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'image_animation',
            [
                'label' => esc_html__( 'Animation', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'images_translate',
            [
                'label'   => esc_html__( 'Translate Position', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'veritcal',
                'options' => [                  
                    'veritcal' => esc_html__( 'Veritcal', 'rsaddon'),
                    'veritcal2' => esc_html__( 'Veritcal 2', 'rsaddon'),
                    'horizontal' => esc_html__( 'Horizontal', 'rsaddon'),
                    'horizontal2' => esc_html__( 'Horizontal 2', 'rsaddon'),
                    'rotated_style' => esc_html__( 'Rotated', 'rsaddon'),
                    'spin_style' => esc_html__( 'Spin', 'rsaddon'),
                    'scale_style' => esc_html__( 'Scale', 'rsaddon'),
                    'scale_style2' => esc_html__( 'Scale2', 'rsaddon'),
                    'move_leftright' => esc_html__( 'Move Left & Right', 'rsaddon'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'animation_start_from',
            [
                'label'   => esc_html__( 'Start From Reverse', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'disable',
                'options' => [                  
                    'enable' => esc_html__( 'Enable', 'rsaddon'),
                    'disable' => esc_html__( 'Disable', 'rsaddon'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'spin_style',
                    'images_translate' => 'veritcal2',
                ]
            ]
        );

        $this->add_responsive_control(
            'rs_image_duration',
            [

                'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .rs-image .rs-multi-image' => 'animation-duration: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'rs_image_delay',
            [

                'label' => esc_html__( 'Animation Delay', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .rs-image .rs-multi-image' => 'animation-delay: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'popup_animation_bg_heading',
            [
                'label' => esc_html__( 'Popup Effect Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'popup_animation' => 'yes',
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rs-image .pop-wrap .pop' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'image_parallax',
            [
                'label' => esc_html__( 'Parallax', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Enable', 'rsaddon' ),
                'label_off' => esc_html__( 'Disable', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
			'image_parallax_class',
			[
				'label'   => esc_html__( 'Parallax Item Class', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [					
					'1' => esc_html__( 'Item One', 'rsaddon'),
					'2' => esc_html__( 'Item Two', 'rsaddon'),
					'3' => esc_html__( 'Item Three', 'rsaddon'),
					'4' => esc_html__( 'Item Four', 'rsaddon'),
					'5' => esc_html__( 'Item Five', 'rsaddon'),
					'6' => esc_html__( 'Item Six', 'rsaddon'),
					'7' => esc_html__( 'Item Seven', 'rsaddon'),
					'8' => esc_html__( 'Item Eight', 'rsaddon'),
					'9' => esc_html__( 'Item Nine', 'rsaddon'),
					'10' => esc_html__( 'Item Ten', 'rsaddon'),
				],
                'condition' => [
                    'image_parallax' => 'yes',
                ]
			]
		);

        $this->add_control(
            'parallax_depth',
            [
                'label' => esc_html__('Movement Depth', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('0.7', 'rsaddon'),
                'label_block' => false,
                'placeholder' => esc_html__( '0.7', 'rsaddon' ),
                'condition' => [
                    'image_parallax' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => esc_html__( 'Gobal Style', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),             
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ]
            ]
        ); 
        $this->add_responsive_control(
            'image_max_width',
            [
                'label' => esc_html__( 'Image Max Width', 'rsaddon' ),             
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image img' => 'max-width: {{SIZE}}{{UNIT}}; height: auto;',
                ]
            ]
        ); 
        $this->add_responsive_control(
            'image_min_width',
            [
                'label' => esc_html__( 'Image Min Width', 'rsaddon' ),             
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image img' => 'min-width: {{SIZE}}{{UNIT}}; height: auto;',
                ]
            ]
        ); 
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        ); 
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'rsaddon' ),
				'selector' => '{{WRAPPER}} .rs-image img',
			]
		);
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'image_border',
		        'selector' => '{{WRAPPER}} .rs-image img',
		    ]
		);
        $this->add_control(
            'opacity',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .rs-image img' => 'opacity: {{SIZE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .rs-image img',
            ]
        );
        $this->add_control(
            'mix_blend_mode',
            [
                'label'   => esc_html__( 'Blend Mode', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'unset',
                'options' => [                  
                    'unset'         => esc_html__( 'Unset', 'rsaddon'),
                    'multiply'      => esc_html__( 'Multiply', 'rsaddon'),
                    'screen'        => esc_html__( 'Screen', 'rsaddon'),
                    'overlay'       => esc_html__( 'Overlay', 'rsaddon'),
                    'darken'        => esc_html__( 'Darken', 'rsaddon'),
                    'lighten'       => esc_html__( 'Lighten', 'rsaddon'),
                    'color_dodge'   => esc_html__( 'Color Dodge', 'rsaddon'),
                    'color_burn'    => esc_html__( 'Color Burn', 'rsaddon'),
                    'difference'    => esc_html__( 'Difference', 'rsaddon'),
                    'exclusion'     => esc_html__( 'Exclusion', 'rsaddon'),
                    'hue'           => esc_html__( 'Hue', 'rsaddon'),
                    'saturation'    => esc_html__( 'Saturation', 'rsaddon'),
                    'color'         => esc_html__( 'Color', 'rsaddon'),
                    'luminosity'    => esc_html__( 'Luminosity', 'rsaddon'),
                    'normal'        => esc_html__( 'Normal', 'rsaddon'),
                ]
            ]
        );
        $this->add_responsive_control(
            'pop_up__width',
            [
                'label' => esc_html__( 'Pop Up Width', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-image .pop-wrap' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    'popup_animation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'pop_up__heighy',
            [
                'label' => esc_html__( 'Pop Up Height', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-image .pop-wrap' => 'Height: {{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    'popup_animation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'pop_up__position_x',
            [
                'label' => esc_html__( 'Pop Up Position X', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-image .pop-wrap' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    'popup_animation' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'pop_up__position_y',
            [
                'label' => esc_html__( 'Pop Up Position Y', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-image .pop-wrap' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'=>[
                    'popup_animation' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="rs-image <?php echo esc_attr($settings['image_animation']); ?>">
            <?php if(!empty($settings['first_image']['url'])) : ?>
                <?php if('yes' !== $settings['image_parallax']){ ?>
                    <img class="rs-multi-image <?php echo esc_attr($settings['images_translate']); ?> reverse-<?php echo esc_attr($settings['animation_start_from']); ?> blend_<?php echo esc_attr($settings['mix_blend_mode']); ?>" src="<?php echo esc_url($settings['first_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['first_image'])); ?>"/>
                    <?php if('yes' == $settings['popup_animation']){?>
                        <div class="pop-wrap">
                            <div class="pop"></div>
                            <div class="pop"></div>
                            <div class="pop"></div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if('yes' == $settings['image_parallax']){ ?>

                        <div class="stuff<?php echo esc_attr($settings['image_parallax_class']); ?>">
                            <img data-depth="<?php echo esc_attr($settings['parallax_depth']); ?>" class="rs-multi-image <?php echo esc_attr($settings['images_translate']); ?> reverse-<?php echo esc_attr($settings['animation_start_from']); ?> blend_<?php echo esc_attr($settings['mix_blend_mode']); ?>" src="<?php echo esc_url($settings['first_image']['url']);?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['first_image'])); ?>"/>
                        </div>

                <?php } ?>
            <?php endif; ?>
        </div>   
        <?php if('yes' == $settings['image_parallax']){ ?>
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    if (jQuery(".stuff1").length) {
                        var stuff = jQuery('.stuff1').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff2").length) {
                        var stuff = jQuery('.stuff2').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff3").length) {
                        var stuff = jQuery('.stuff3').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff4").length) {
                        var stuff = jQuery('.stuff4').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff5").length) {
                        var stuff = jQuery('.stuff5').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff6").length) {
                        var stuff = jQuery('.stuff6').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff7").length) {
                        var stuff = jQuery('.stuff7').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff8").length) {
                        var stuff = jQuery('.stuff8').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff9").length) {
                        var stuff = jQuery('.stuff9').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                    if (jQuery(".stuff10").length) {
                        var stuff = jQuery('.stuff10').get(0);
                        var parallaxInstance = new Parallax(stuff);
                    }
                }); 
            </script>
        <?php } ?>  
    <?php
    }
}
