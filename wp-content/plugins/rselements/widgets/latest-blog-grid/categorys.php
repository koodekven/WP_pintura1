<?php 
$category = get_the_category(get_the_ID());
foreach($category as $cat) { 
$cate_bg     = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_color  = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_bg = ($cate_bg) ? "Style=background:$cate_bg" : "" ;
$cate_color = ($cate_color) ? "Style=color:$cate_color" : "" ;
?>
<?php if( "borders" == $settings['blog_category_style'] ){ ?>

<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" <?php echo esc_html($cate_color); ?> >
<?php if($content_reverse == '2') {

        if(!empty( $settings['category_icon']['value']) ) {
            \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
        }else{
            ?>
                <i class="ri-bookmark-line"></i>
            <?php 
        }
} ?>
<?php echo esc_html($cat->name);?></a>

<?php } elseif ( "background" == $settings['blog_category_style'] ) { ?>

<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" <?php echo esc_html($cate_bg); ?> >
    <?php 
        if ( $settings['category_icon'] ):
            ?>
            <span class="cat-icon">
                <?php 
                
                if(!empty($settings['category_icon']['value'])) {
                    \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
                } else { ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6" fill="none"><path d="M3 0L5.59808 1.5V4.5L3 6L0.401924 4.5V1.5L3 0Z" fill="url(#paint0_linear_878_83<?php echo $count;?>)"></path><defs><linearGradient id="paint0_linear_878_83<?php echo $count;?>" x1="-3.93273e-08" y1="0.803572" x2="6.33755" y2="1.30989" gradientUnits="userSpaceOnUse"><stop stop-color="#513DE8" offset="1"></stop><stop offset="1" stop-color="#8366E3"></stop></linearGradient></defs></svg>
                <?php } ?>
            </span>
            <?php
        endif; 
    ?> 
    <?php 
        if($content_reverse == '2') :
            ?><i class="ri-bookmark-line"></i><?php 
        endif;
    ?>
<?php echo esc_html($cat->name);?>
</a>

<?php } else {
 ?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>"<?php echo esc_html($cate_color); ?> >
    <?php if($content_reverse == '2') {

        if(!empty( $settings['category_icon']['value']) ) {
            \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
        }elseif( !empty($settings['category_img_sec__']['url']) ){
            ?>
              <img src="<?php echo esc_url( $settings['category_img_sec__']['url'] );?>" alt="image"/>
            <?php
        } else{
        ?>
            <i class="ri-bookmark-line"></i>
        <?php 
        }
    } ?>
<?php echo esc_html($cat->name);?>
</a>

<?php } ?>
<?php } ?>


 