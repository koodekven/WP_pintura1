<?php use Elementor\Icons_Manager; ?>

                    
<?php                        
    $cat = $settings['category'];
    $select = $settings['select_posts'];
    
    global  $paged;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if(empty($cat)){
        $prelements_query = new wp_Query(array(
            'post_type'         => 'post',                                
            'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
            'posts_per_page'    => $settings['per_page'],
            'offset'            => $settings['pre_blog_posts_offset'],
            'meta_key'          => $settings['pre_posts_most_view'],
            'paged'             => $paged,
            'post__in'          => $select,  
            'meta_query' => array(
                array(
                    'key'     => 'editor_post',        
                    'compare' => 'NOT EXISTS'
                ),
            ),                
        ));   
    }   
    else{
        $prelements_query = new wp_Query(array(
                'post_type'         => 'post',
                'orderby'           => array( $settings['pre_posts_order_by'] => $settings['pre_posts_sort'] ),
                'posts_per_page'    => $settings['per_page'],
                'offset'            => $settings['pre_blog_posts_offset'],
                'meta_key'          => $settings['pre_posts_most_view'],
                'paged'             => $paged,
                'post__in'          => $select,
                'meta_query' => array(
                    array(
                        'key'     => 'editor_post',        
                        'compare' => 'NOT EXISTS'
                    ),
                ),
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug', 
                        'terms'    => $cat 
                    ),
                )
        ));   
    }                      

    
    while($prelements_query->have_posts()): $prelements_query->the_post(); 

        $full_date       = get_the_date('F j, Y');
        $blog_date       = get_the_date('M j, Y');
        $blog_only_date  = get_the_date('j');
        $blog_only_month = get_the_date('M');
        $post_admin      = get_the_author();

        
        if(!empty($settings['blog_word_show'])){
            $limit = $settings['blog_word_show'];
        }
        else{
            $limit = 20;
        }

        
        if(!empty($settings['blog_title_word_show'])){
            $limits = $settings['blog_title_word_show'];
        }
        else{
            $limits = 200;
        }

        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
        if ( empty( $thumbnail_alt ) ) {
            $thumbnail_alt = get_the_title( $thumbnail_id );
        }

    ?>
        <div class="pre-blog-item <?php echo esc_html($settings['latest_blog_slider_style']);?>  <?php echo esc_html($settings['blog_content_postion_style']);?> pre-blog-meta-<?php echo esc_html($settings['blog_meta_style']);?> <?php echo esc_html($settings['blog_category_style']);?>">
            <div class="blog-inner-wrap pre-thum-<?php echo esc_html($settings['blog_thumbnail']);?> pre-meta-<?php echo esc_html($settings['blog_meta_alignment']);?> rs__<?php echo esc_html($settings['blog_thumbnail_align']);?> eql-space-<?php echo esc_html($settings['meta_equal_space']);?>">

                <!-- Image Wrapper Section -->
                <div class="pre-image-wrap">

                    <?php if ( 'yes' === $settings['blog_image_show_hide'] ){ ?>
                        <a class="pre-pointer-events" href="<?php the_permalink();?>">
                        <?php echo wp_get_attachment_image( $thumbnail_id, $settings['thumbnail_size'], false, ['alt' => $thumbnail_alt] ); ?>
                        </a>
                    <?php } ?>

                    <!-- Under Image Meta Section -->
                    <div class="pre-blog-meta-slider">
                        <?php if(!empty($full_date)){ ?>
                            <span class="pre-date">
                                <?php Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] ); ?> 
                                <?php echo esc_html($full_date);?>
                                </span> <?php _e('-','rsaddon');?>
                        <?php } ?>
                        <span class="pre-cat-list">
                            <?php include plugin_dir_path(__FILE__)."/categorys.php"; ?>
                        </span>
                    </div>
                    <!-- Under Image Meta Section End -->
                    <?php if(!empty($post_admin)){ ?>
                        <div class="pre-admin-wrapper">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <span class="pre-admin">
                                   <?php _e('By  ','rsaddon'); echo esc_html($post_admin);?>
                                </span>
                            </a>
                        </div>
                    <?php } ?>
                    
                </div>
                <!-- Image Wrapper Section End -->

                <!-- Blog Content Section -->
                <div class="pre-blog-content">                              
                    <?php if ( 'yes' === $settings['blog_title_show_hide'] ){ ?>
                        <h3 class="pre-post-title"><a class="pre-pointer-events" href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $limits, '' ); ?></a></h3>                                        
                    <?php } ?>
                    <?php if ( 'yes' === $settings['blog_content_show_hide'] ){ ?>
                        <p class="pre-content"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                    <?php } ?>

                    
                    <?php if ( 'yes' === $settings['blog_readmore_show_hide'] ){ ?>
                        <?php if(!empty($settings['blog_btn_text'])){ ?>
                            <div class="blog-btn-part">
                                <?php  
                                    $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                ?>
                                    <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                        <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>          
                                        <?php 
                                            if(!empty($settings['blog_btn_icon'])) : 
                                                Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                            endif; 
                                        ?>
                                    </a>

                            </div>
                        <?php } else { ?>
                            <div class="blog-btn-part">
                                <?php  
                                    $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                ?>
                                    <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                        <span class="btn-txt"><?php echo esc_html__('Read More', 'prelements'); ?></span>
                                        <?php 
                                            if(!empty($settings['blog_btn_icon'])) : 
                                                Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] );
                                            endif; 
                                        ?>
                                    </a>

                            </div>
                      <?php  }
                    } ?>
                </div>
                <!-- End Blog Content Section -->

            </div>
        </div>

    <?php
        endwhile;
    wp_reset_query(); 
?>