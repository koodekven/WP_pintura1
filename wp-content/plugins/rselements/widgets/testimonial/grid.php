<div class="rs-testimonial-grid rs-testimonial">
    <div class="row">
        <?php
            $url = plugin_dir_url( __FILE__ );

            $best_wp = new wp_Query(array(
                    'post_type'      => 'testimonials',
                    'posts_per_page' => $settings['per_page'],
                                    
            ));

            while($best_wp->have_posts()): $best_wp->the_post();
                $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';

                $thumbnail_id = get_post_thumbnail_id();
                $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
                if ( empty( $thumbnail_alt ) ) {
                    $thumbnail_alt = get_the_title( $thumbnail_id );
                }
                
            ?>
                
                <div class="col-lg-<?php echo esc_html($settings['testimonial_columns']);?>  col-xs-1">
                    <div class="testimonial-item"> 
                        <?php if('top' == $settings['title_position']) {?>                               
                            <div class="testimonial-content">                                   
                                <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                    <div class="image-wrap">                                    
                                        <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>                                                 
                                    </div>
                                <?php endif;?>  
                                
                                    <div class="testimonial-information">
                                        <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                            <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" /></div>
                                        <?php endif;?> 
                                        <?php if(get_the_title()):?>                         
                                            <div class="testimonial-name"><?php the_title();?></div>
                                        <?php endif;?>
                                        <?php if( $designation ):?>
                                            <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                        <?php endif; ?>
                                    </div>
                               
                            </div>
                        <?php }?>   

                        <div class="item-content <?php echo esc_attr($settings['_design']);?>"> 
                            <?php the_content();?>  
                        </div>  

                        <?php if('bottom' == $settings['title_position']) {?>                               
                            <div class="testimonial-content">                                   
                                <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                    <div class="image-wrap">                                    
                                        <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>                                                  
                                    </div>
                                <?php endif;?>  
                                
                                    <div class="testimonial-information">
                                        <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                            <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" /></div>
                                        <?php endif;?> 
                                        <?php if(get_the_title()):?>                         
                                            <div class="testimonial-name"><?php the_title();?></div>
                                        <?php endif;?>
                                        <?php if( $designation ):?>
                                            <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                        <?php endif; ?>
                                    </div>
                               
                            </div>
                        <?php }?>                       
                    </div>
                </div>
            <?php   
            endwhile;
            wp_reset_query();  
         ?>  
    </div>
</div>