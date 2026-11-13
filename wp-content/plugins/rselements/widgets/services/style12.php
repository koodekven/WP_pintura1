<?php
use Elementor\Icons_Manager;
use Elementor\Control_Media;
?>
<div class="services-inner <?php echo esc_attr($icon_show_hide);?> <?php echo esc_attr($settings['icon_bg_enable']);?>">

    <?php if('yes' == $settings['icon_image_show_hide']){ ?>
        <div class="media_wrap">
            <?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
                <?php if(!empty($settings['selected_icon'])) : ?>
                    <div class="icon_style media-cmn normal">
                        <?php     
                            Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); 
                        ?>
                    </div>
                <?php endif; ?>               

                <?php if(!empty($settings['selected_image'])) :?>
                    <div class="image_style media-cmn">
                        <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['selected_image'])); ?>"/>
                    </div>
                <?php endif;?>
            <?php } ?>

            <div class="content_part">
                <!-- Icon -->
                <?php if(!empty($settings['icon_image'])) : ?>
                    <div class="icon_img">
                        <img src="<?php echo esc_url( $settings['icon_image']['url'] );?>" alt="<?php echo esc_attr(Control_Media::get_image_alt($settings['icon_image'])); ?>"/>
                    </div>
                <?php endif; ?>
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
            </div>
        </div>
    <?php } ?>
</div>