<?php
use Elementor\Icons_Manager;
use Elementor\Control_Media;
?>
<div class="services-inner">
    <div class="content_part">
        <?php if(!empty($settings['selected_image'])) :?>
            <div class="image_style media-cmn">
                <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
            </div>
        <?php endif;?>
        <?php if(!empty($settings['title'])){ ?>
            <div class="services-title">                            
                <?php if(!empty($settings['title_link'])) : 
                    $link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
                ?>                                                                  
                <<?php echo esc_html($settings['title_tag']);?>  
                <?php  echo esc_attr($this->print_render_attribute_string( 'title' )); ?>>

                <a href="<?php echo esc_url($settings['title_link']);?>" <?php echo esc_attr($link_open); ?> >
                    <?php echo wp_kses_post($settings['title']);?>
                </a>
                </<?php echo esc_html($settings['title_tag']);?>>
                <?php else: ?>
                    <<?php echo esc_html($settings['title_tag']);?> <?php  echo esc_attr($this->print_render_attribute_string( 'title' )); ?>> <?php echo wp_kses_post($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
                <?php endif; ?>                         
            </div>
        <?php } ?>

        <div class="service-progress-bar"></div>

        <?php if(!empty($settings['description'])) : ?>
            <div class="desc-text">
                <?php echo esc_html($settings['description']);?>
            </div>
        <?php endif; ?>

        <?php if('yes' == $settings['button_show_hide']){ ?>
            <div class="btn-part">
                <?php 
                    $link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
                ?>
                <a class="services-btn" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post($link_open); ?>>
                <?php if('left' == $settings['button_icon_postion']){ ?>
                        <?php 
                            Icons_Manager::render_icon( $settings['btn__selected_icon'], [ 'aria-hidden' => 'true' ] ); 
                        } ?>
                <?php echo esc_html($settings['services_btn_text']);?>
                    <?php if('right' == $settings['button_icon_postion']){ ?>
                        <?php 
                            Icons_Manager::render_icon( $settings['btn__selected_icon'], [ 'aria-hidden' => 'true' ] ); 
                        } ?>
                    </a>
                </div>
        <?php } ?>

    </div>
</div>
