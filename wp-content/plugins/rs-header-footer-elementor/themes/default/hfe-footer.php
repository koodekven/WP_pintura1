<?php
/**
 * @since 1.0.0
 */
if( is_404() ){
    return;
} else {
    do_action( 'hfe_footer_before' );
    do_action( 'hfe_footer' );
} ?>
</div><!-- #page -->
<?php 
if(!empty(get_theme_mod('fixhero_enable_go_to_top'))){
?>
 <!-- start scrollUp  -->
<div id="scrollUp">
    <i class="ri-arrow-up-s-line"></i>
</div>   
<?php } 
wp_footer(); ?>
</body>
</html> 
