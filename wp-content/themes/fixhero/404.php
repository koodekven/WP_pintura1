<?php
get_header('404');
$error_bg = !empty( get_theme_mod( 'fixhero_404_page_bg' ) ) ? 'style="background:url('.get_theme_mod( 'fixhero_404_page_bg' ).')"': '';
$fixhero_404_title = get_theme_mod( 'fixhero_404_title' );
$fixhero_404_text = get_theme_mod( 'fixhero_404_text' );
$fixhero_404_home_button_label = get_theme_mod( 'fixhero_404_home_button_label' );
?>

<div class="page-error" <?php echo wp_kses_post( $error_bg ); ?>>
    <div class="container">
        <div id="content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">    
                    <section class="error-404 not-found">    
                        <div class="page-content">
                            <h2>
                                <span>
                                    
                                    <?php
                                        if(!empty($fixhero_404_title)){
                                            echo esc_html($fixhero_404_title);
                                        }
                                        else{
                                            echo esc_html__( '404', 'fixhero' ); 
                                        }
                                    ?>
                                </span>                      
                                <?php

                                 if(!empty($fixhero_404_text)){
                                      echo esc_html($fixhero_404_text);
                                 }
                                 else{
                                  echo esc_html__( 'Opps! the page you requested was not found.', 'fixhero' ); }
                                 ?>
                            </h2>
                            <a class="readon" href="<?php echo esc_url( home_url('/') ); ?>">
                                <?php
                                 if(!empty($fixhero_404_home_button_label)){
                                     echo esc_html($fixhero_404_home_button_label);
                                 }
                                 else{
                                     esc_html_e('Back To Homepage', 'fixhero'); 
                                  }
                                ?>
                            </a>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->    
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>   
</div> <!-- .page-error -->
<?php
get_footer('404');