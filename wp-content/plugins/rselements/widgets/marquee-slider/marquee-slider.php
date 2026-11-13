<?php
/**
 * Marquee Slider Widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;



defined( 'ABSPATH' ) || die();

class Rsaddon_Marquee_Slider_Widget extends \Elementor\Widget_Base {
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
        return 'rs-marquee-slider';
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
        return esc_html__( 'RS Marquee Slider', 'rsaddon');
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
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'slider', 'marquee', 'marquee slider'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_marquee',
            [
                'label' => esc_html__( 'Marquee Slider', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'marquee_duration',
			[
				'label'       => esc_html__( 'Duration', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( '40000', 'rsaddon' ),
			]
		);

        $this->add_control(
			'marquee_gap',
			[
				'label'       => esc_html__( 'Item Gap', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        $this->add_control(
			'marquee_direction',
			[
				'label'   => esc_html__( 'Direction', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',			
				'options' => [					
					'left' => esc_html__( 'Left', 'rsaddon'),
					'right' => esc_html__( 'Right', 'rsaddon'),
				],
			]
		);
        $this->add_control(
			'marquee_pause_hover',
			[
				'label' => esc_html__( 'Pause On Hover?', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rsaddon' ),
				'label_off' => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'marquee_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]]
                ]
            ]
        );        
        $this->end_controls_section();

        $this->start_controls_section(
            '_marquee_image_style',
            [
                'label' => esc_html__( 'Image Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'marquee_image_width',
            [
                'label' => esc_html__( 'Image Width', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .marquee_wrapper .marquee_text img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'marquee_image_height',
            [
                'label' => esc_html__( 'Image Height', 'prelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .marquee_wrapper .marquee_text img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'marquee_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee_wrapper .marquee_text img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'marquee_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee_wrapper .marquee_text img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'marquee_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee_wrapper .marquee_text img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'selector' => '{{WRAPPER}} .marquee_wrapper .marquee_text img',
            ]
        ); 

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

      
        $marquee_duration    = ( $settings['marquee_duration'] != '' ) ? $settings['marquee_duration'] : '40000';
        $marquee_gap         = ( $settings['marquee_gap'] != '' ) ? $settings['marquee_gap'] : '0';
        $marquee_direction   = ( $settings['marquee_direction'] != '') ? $settings['marquee_direction'] : 'right';

        $marquee_pause_hover = ( $settings['marquee_pause_hover'] == 'yes') ? true : false;

        $unique = rand(2012,35120);

        if ( empty($settings['marquee_list'] ) ) {
            return;
        }
        
        /*----------marquee slider style-------
        -----------------------------*/
        ?>

        <!-- Marquee Slider For Demo Count Start -->
        <div class="marquee_wrapper">
            <div class="marquee_text" data-pause-on-hover="<?php echo esc_attr($marquee_pause_hover);?>" data-gap="<?php echo esc_attr($marquee_gap);?>" data-duration="<?php echo esc_attr($marquee_duration);?>" data-direction="<?php echo esc_attr($marquee_direction);?>">
            <?php
                foreach ( $settings['marquee_list'] as $index => $item ) :
                    $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                    $alt = Control_Media::get_image_alt($item['image']);
                    if ( ! $image ) {
                        $image = Utils::get_placeholder_image_src();
                    }
                    ?>
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                <?php endforeach; ?>
            </div> 
        </div>
        <!-- Marquee Slider For Demo Count End -->

        <script type="text/javascript"> 
            jQuery(document).ready(function(){
                if (!jQuery('.marquee_text').data('marquee-loaded')) {
                    if (jQuery(".marquee_text").not('initialized').length) { 
                        jQuery('.marquee_text').not('initialized').each(function(event) {
                            var direction = jQuery(this).data('direction');
                            var pauseOnHover = jQuery(this).data('pause-on-hover') === true;
                            var mouseDown = false;
                            var slider = jQuery(this).marquee({
                                direction: direction,
                                duration: jQuery(this).data('duration'),
                                gap: jQuery(this).data('gap'),
                                delayBeforeStart: 0,
                                duplicated: true,
                                startVisible: true,
                                pauseOnHover: pauseOnHover
                            });
                            jQuery(this).on('mousedown', function() {
                                mouseDown = true;
                                slider.marquee('pause');
                                jQuery(this).data('mouse-down', true);
                            });
                            
                            jQuery(this).on('mouseup', function() {
                                mouseDown = false;
                                if (!jQuery(this).data('mouse-dragged')) {
                                    slider.marquee('resume');
                                }
                                jQuery(this).data('mouse-down', false);
                                jQuery(this).data('mouse-dragged', false);
                            });
                            
                            jQuery(this).on('mousemove', function() {
                                if (mouseDown) {
                                    jQuery(this).data('mouse-dragged', true);
                                }
                            });
                        });

                        jQuery('.marquee_text').data('marquee-loaded', true);
                    }; 
                };
            });
        </script>
        <?php 
    }
}