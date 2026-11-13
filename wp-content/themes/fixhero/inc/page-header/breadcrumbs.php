<?php
  $fixhero_page_banner = get_theme_mod( 'fixhero_page_banner' );
  $fixhero_page_breadcrumb_val = get_post_meta( get_the_ID(), 'fixhero_page_breadcrumb_val', true );

if( $fixhero_page_breadcrumb_val != 1 ){
  if($fixhero_page_banner !=''){
  ?>
  <div class="rs-breadcrumbs">
      <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url($fixhero_page_banner); ?>')">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumbs-inner">
                  <?php 
                    $fixhero_page_custom_title = get_theme_mod( 'fixhero_page_custom_title' );
                  ?>
                  <h1 class="page-title">
                    <?php if($fixhero_page_custom_title !=''){
                        echo esc_html($fixhero_page_custom_title);
                    } else {
                        the_title();
                    }
                    ?>
                  </h1>
                  <?php
                    $fixhero_page_custom_desc = get_theme_mod( 'fixhero_page_custom_description' );
                    if($fixhero_page_custom_desc !=''){
                  ?>  
                      <h6 class="intro-title">
                          <?php echo esc_html( $fixhero_page_custom_desc ); ?>
                      </h6>
                  <?php } ?>
                                  
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <?php }
  else{
  ?>
    <div class="rs-breadcrumbs  porfolio-details">
      <div class="rs-breadcrumbs-inner">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumbs-inner">
                <?php 
                  $fixhero_page_custom_title = get_theme_mod( 'fixhero_page_custom_title' );            
                ?>
                <h1 class="page-title">
                    <?php if($fixhero_page_custom_title !=''){
                        echo esc_html($fixhero_page_custom_title);
                    } else {
                        the_title();
                    }
                    ?>
                </h1>
                <?php
                  $fixhero_page_custom_desc = get_theme_mod( 'fixhero_page_custom_description' );
                  if($fixhero_page_custom_desc !=''){
                ?>  
                    <h6 class="intro-title">
                        <?php echo esc_html( $fixhero_page_custom_desc ); ?>
                    </h6>
                <?php } ?>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
    }
}