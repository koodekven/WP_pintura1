<?php 
get_header();
$post_id      = get_the_id();
$author_id    = get_post_field ('post_author', $post_id);
$display_name = get_the_author_meta( 'display_name' , $author_id );
?>
    <div class="container"> 
        <div id="content">
            <?php
                //checking page layout
                $page_layout = get_theme_mod( 'fixhero_blog_single_sidebar_setting' );
                $col_side    = '';
                $col_letf    = '';
                if($page_layout == '2left'){
                    $col_side = '8';
                    $col_letf = 'left-sidebar';
                }
                else if($page_layout == '2right'){
                    $col_side = '8';
                }
                else{
                	$col_side = '12';
            	}
            ?>
          <!-- Blog Detail Start -->
            <div class="rs-blog-details rs-single-service-area">
                <div class="row padding-<?php echo esc_attr( $col_letf) ?>">
                    <div class="col-lg-<?php echo esc_attr( $col_side). ' ' .esc_attr( $col_letf) ?>">

                        <?php 
                            while ( have_posts() ) : the_post(); 
                            $rs_service_address      = get_post_meta( get_the_ID(), 'rs_service_address', true );
                            $rs_service_state        = get_post_meta( get_the_ID(), 'rs_service_state', true );
                            $rs_service_city        = get_post_meta( get_the_ID(), 'rs_service_city', true );
                            $rs_service_zip_code        = get_post_meta( get_the_ID(), 'rs_service_zip_code', true );
                        ?>     

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if(has_post_thumbnail()){ ?>
                                    <div class="bs-img rs--meta_service-single-bs-img">
                                        <?php the_post_thumbnail(); ?>   
                                        <?php if(!empty($rs_service_address) || !empty($rs_service_state) || !empty($rs_service_city) || !empty($rs_service_zip_code)){ ?>
                                            <div class="blog-meta">
                                                <ul class="rs--meta_service-single btm-cate">
                                                    <?php if(!empty($rs_service_state)): ?>
                                                        <li class="rs-service-state"> <i class="ri-flag-line"></i> <?php echo esc_html( $rs_service_state );?> </li>
                                                    <?php endif; ?>                                                 

                                                    <?php if(!empty($rs_service_city)): ?>
                                                        <li class="rs-service-city"><i class="ri-building-line"></i> <?php echo esc_html( $rs_service_city );?></li>
                                                    <?php endif; ?> 

                                                    <?php if(!empty($rs_service_address)): ?>
                                                        <li class="rs-service-location"><i class="ri-map-pin-line"></i> <?php echo esc_html( $rs_service_address );?></li>
                                                    <?php endif; ?>

                                                    <?php if(!empty($rs_service_zip_code)): ?>
                                                        <li class="rs-service-zip"> <?php esc_html_e('Zip Code:', 'fixhero'); ?> <?php echo esc_html( $rs_service_zip_code );?></li>
                                                    <?php endif; ?>                                                 
                                                </ul>
                                            </div>
                                        <?php } ?>                                                                             
                                    </div>
                                <?php } ?>
                                
                                <?php
                                    get_template_part( 'template-parts/post/content', get_post_format() );  
                                    $opening_hours        = get_post_meta( get_the_ID(), 'opening_hours', true ); 
                                ?>
                                <div class="clear-fix"></div>
                                    <?php
                                        $opening_hourss = (!empty($opening_hours)) ? 'no-full' : 'rs-full-wrap-map';
                                        $rs_map = (!empty($rs_service_address)) ? 'no-full' : 'rs-full-wrap-time';
                                    ?>
                                    <div class="rs--google-map-wrap <?php echo esc_attr($opening_hourss); ?> <?php echo esc_attr($rs_map); ?>">
                                        <?php if(!empty($rs_service_address)){ ?>
                                            <div class="rs--goole__map">
                                               <iframe width="100%" height="365"
                                                    src="https://maps.google.com/maps?q= <?php echo esc_attr($rs_service_address); ?> &t=&z=14&ie=UTF8&iwloc=&output=embed"
                                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                                </iframe> 
                                            </div>
                                        <?php } ?>
                                                                                
                                        <?php if ( $opening_hours ) : ?>
                                        <div class="rs--time-repeat">
                                            <ul>
                                                <?php foreach ( $opening_hours as $opening_hour ) { ?>
                                                    <?php if(!empty($opening_hour['day_title']) || !empty($opening_hour['start_hours'])){ ?>
                                                    <li>
                                                        <?php if($opening_hour['day_title'] != '') echo '<span class="opening_day">'. esc_attr( $opening_hour['day_title'] ) . '</span>'; ?>
                                                        <?php if($opening_hour['start_hours'] != '') echo '<span class="opening_time">'. esc_attr( $opening_hour['start_hours'] ) . ' '.__('-', 'fixhero').' '.esc_attr( $opening_hour['end_hours'] ).'</span>'; ?>                                                    
                                                    </li>
                                                    <?php } ?> 
                                                <?php } ?> 
                                            </ul>
                                        </div>
                                        <?php endif; ?>                                    
                                    </div>
                                    <div class="clear-fix"></div>  
                                    <?php get_template_part( 'pagination' ); ?>
                            </article> 
                        
                        <?php       
                        $author_meta = get_the_author_meta('description'); 
                        if( !empty($author_meta) ){
                        ?>
                            <div class="author-block">
                              <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 200);?> </div>
                              <div class="author-desc">
                                <h3 class="author-title">
                                  <?php the_author();?>
                                </h3>
                                <p>
                                  <?php   
                                    echo wpautop( get_the_author_meta( 'description' ) );
                                  ?>
                                </p>
                                <a href="<?php echo esc_url(get_the_author_meta('user_url'))?>" target="_blank">
                                  <?php echo esc_url(get_the_author_meta( 'user_url'))?></a> 
                                </div>
                            </div>
                            <!-- .author-block -->
                        <?php }
                                  
                        ?>
                        <?php 
                        $blog_author = '';
                        if($blog_author == ""){
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        }
                        endwhile; // End of the loop.
                        ?>
                    </div>
                  <?php
                    if( $page_layout == '2left' || $page_layout == '2right'): ?>
                        <div class="col-lg-4"> <div class="service_single_wrap bs-sidebar dynamic-sidebar"> <?php dynamic_sidebar('rs-projects-sidebars'); ?> </div></div>
                    <?php endif; ?>
                </div>
            </div>
          <!-- Blog Detail End --> 
        </div>
    </div>
<!-- .container -->
<?php
get_footer();