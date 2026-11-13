<?php
/**
 * Rs Slider widget class
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
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class Rsaddon_Slider_Pro_Widget extends \Elementor\Widget_Base {
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
        return 'rs-sliders';
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
        return esc_html__( 'RS Full Width Slider', 'rsaddon' );
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
        return [ 'slider', 'slide', 'image' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            '_section_slider',
            [
                'label' => esc_html__( 'RS Slider', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Slide Shape', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'sliders_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    
                ]
            ]
        );        


        $this->end_controls_section();

        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
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
                ]
            ]
        );
   
            

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'true',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',                            
            ] 
        );
        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                ],
                'separator' => 'before',                            
            ]
            
        );
        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                    '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                    '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                    '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                    '1000' => esc_html__( '1 Seconds', 'rsaddon' ),     
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rsaddon' ),
                    'false' => esc_html__( 'Disable', 'rsaddon' ),
                ],
                'separator' => 'before',
                            
            ]    
        );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_img_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .grid-item .inner-container .slide-image img' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Wrapper  Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; overflow:hidden;',           
                ],
            ]
        );

        $this->add_control(
            'img_radius',
            [
                'label' => esc_html__( 'Image Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .grid-item .inner-container .slide-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important; overflow:hidden;',           
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'arrow_section',
            [
                'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_nav'=>'true'
                ],
            ]
        );

        $this->add_responsive_control(
            'nev_positions_left',
            [
                'label' => esc_html__( 'Left/Right Position (Left Arrow)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => -0,
                        'max' => 2000,
                    ],
                    '%'=>[
                        'min' => -0,
                        'max' => 1000,  
                    ]
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nev_positions_left_top',
            [
                'label' => esc_html__( 'Top/Bottom Position (Left Arrow)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => -0,
                        'max' => 2000,
                    ],
                    '%'=>[
                        'min' => -0,
                        'max' => 1000,  
                    ]
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .slick-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nev_positions_right',
            [
                'label' => esc_html__( 'Left/Right Position (Right Arrow)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => -0,
                        'max' => 2000,
                    ],
                    '%'=>[
                        'min' => -0,
                        'max' => 1000,  
                    ]
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'nev_right_positions_',
            [
                'label' => esc_html__( 'Top/Bottom Position (Right Arrow)', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px','%' ],
                'range' => [
                    'px' => [
                        'min' => -0,
                        'max' => 2000,
                    ],
                    '%'=>[
                        'min' => -0,
                        'max' => 1000,  
                    ]
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_control(
            'arrow_b_radius',
            [
                'label' => esc_html__( ' Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',           
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'arrow_icon_typo',
                'selector' => '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow::before',
            ]
        );

        $this->start_controls_tabs(
            'arrow_tabs'
        );

            $this->start_controls_tab(
                'arrow_style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'textdomain' ),
                ]
            );
                $this->add_control(
                    'arrow_icon_color',
                    [
                        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,            
                        'selectors' => [
                            '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow::before' => 'color: {{VALUE}}!important;',
                        ],
                        
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'arrow_background',
                        'label' => esc_html__( 'Arrow Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow',
                        
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'arrow_border',
                        'selector' => '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow',
                        
                    ]
                );
            

            $this->end_controls_tab();

            $this->start_controls_tab(
                'arrow_style_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'textdomain' ),
                ]
            );

                $this->add_control(
                    'arrow_hover_icon_color',
                    [
                        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,            
                        'selectors' => [
                            '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow:hover::before' => 'color: {{VALUE}}!important;',
                        ],
                        
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'arrow_hover_background',
                        'label' => esc_html__( 'Arrow Background', 'rsaddon' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow:hover',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'arrow_hover_border',
                        'selector' => '{{WRAPPER}} .rs__banner__slider .rs-addon-slider .slick-arrow:hover',
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

       


   		

   		
        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $slidesToShow    = 1;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = 1;
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = false;
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = false;
        $col_lg          = 1;


        $unique = rand(2012,35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderNav', 'infinite', 'col_lg');   

        if ( empty($settings['sliders_list'] ) ) {
            return;
        }
        ?>
       
            <div class="rsaddon-unique-slider rs__banner__slider">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider">                   
                        
                <?php

                	$total = count($settings['sliders_list']); 
                	$i = 1;

                    foreach ( $settings['sliders_list'] as $index => $item ) :
                        $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                        
                        if ( ! $image ) {
                            $image = Utils::get_placeholder_image_src();
                        }
                                        
                        ?>
                        <div class="grid-item">
                            <div  class="rs-slide">
                                <div class="slide-img">                                   
                                    
                                    <div class="slide_des">
	                                    <div class="inner-container">
                                            <div class="slide-image">
                                                <?php if(!empty($item['image']['url'])){?>
                                                    <img class="rs__banner_shap" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($item['image'])); ?>">
                                                <?php } ?>
                                            </div>
                                        </div>
	                                </div>
                                </div>
                            </div>
                        </div>           
                    <?php $i++; endforeach; ?>
                </div>
                <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
            </div>
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    jQuery( '.rs-addon-slider' ).each(function( index ) {        
                    var slider_id       = jQuery(this).attr('id'); 
                    var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
                   
                    if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
                    jQuery('#'+slider_id).not('.slick-initialized').slick({
                    slidesToShow    : parseInt(slider_conf.col_lg),
                    centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
                    dots            : (slider_conf.sliderDots)  == "true" ? true : false,
                    arrows          : (slider_conf.sliderNav) == "true" ? true : false,
                    autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
                    slidesToScroll  : parseInt(slider_conf.slidesToScroll),
                    centerPadding   : '0px',
                    autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
                    pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
                    loop : false,
                    });
                }
               
                });
            });
            </script>
        <?php }

}