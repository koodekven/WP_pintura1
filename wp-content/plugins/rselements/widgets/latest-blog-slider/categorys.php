<?php 
$category = get_the_category(get_the_ID());
foreach($category as $cat) { 
$cate_bg     = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_color  = get_term_meta($cat->cat_ID, 'category_bg_color', true);
$cate_bg = ($cate_bg) ? "Style=background:$cate_bg" : "" ;
$cate_color = ($cate_color) ? "Style=color:$cate_color" : "" ;
?>
<?php if( "borders" == $settings['blog_category_style'] ){ ?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" <?php echo esc_html($cate_color); ?>><?php echo esc_html($cat->name);?></a>                                                   
<?php } elseif ( "background" == $settings['blog_category_style'] ) { ?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>" <?php echo esc_html($cate_bg); ?> ><?php echo esc_html($cat->name);?></a>
<?php } else { ?>
<a href="<?php echo esc_url( get_category_link($cat->term_id) ); ?>">
    <?php if($show_category_icon == 'yes') { 
         \Elementor\Icons_Manager::render_icon( $settings['category_icon'], [ 'aria-hidden' => 'true' ] );
     }?>
    <?php echo esc_html($cat->name);?>
</a>
<?php } ?>
<?php } ?>