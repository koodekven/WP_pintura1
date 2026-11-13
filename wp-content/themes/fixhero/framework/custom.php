<?php
/*
dynamic css file. please don't edit it. it's update automatically when settins changed
*/
add_action('wp_head', 'fixhero_custom_colors', 160);

function fixhero_custom_colors() { ?>
    <style>

        /* Container Size */
        <?php if(!empty(get_theme_mod('fixhero_container_size'))){ ?>
            .container {
                max-width: <?php echo esc_attr( get_theme_mod('fixhero_container_size') ); ?>;
            }
        <?php } ?>

        /**
         * Body Typography
         */
        <?php if(!empty(get_theme_mod('fixhero_body_font'))){ 
            ?>
            html, body{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_body_font') ); ?>
            }
        <?php } ?>
        
        <?php if(!empty(get_theme_mod('fixhero_body_font_size'))){
            ?>
            html, body{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_body_font_size') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_fonts_info'))){ 
            ?>
            html, body{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_fonts_info') ); ?>
            }
        <?php } ?>
        /**
         * Heading Typography
         */
        <?php if(!empty(get_theme_mod('fixhero_heading_font'))){ ?>
            h1, h2, h3, h4, h5, h6{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_heading_font') ); ?>
            }
        <?php } ?>
        /* H1 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h1_font'))){ 
            ?>
            .prelements-heading .title-inner h1.title,
            h1{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h1_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h1_font_size'))){ 
            ?>
            .prelements-heading .title-inner h1.title,
            h1{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h1_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h1_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h1.title,
            h1{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h1_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h1_line_height'))){ 
            ?>
            .prelements-heading .title-inner h1.title,
            h1{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h1_line_height') ); ?>
            }
        <?php } ?>

        /* H2 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h2_font'))){ 
            ?>
            .prelements-heading .title-inner h2.title,
            h2{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h2_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h2_font_size'))){ 
            ?>
            .prelements-heading .title-inner h2.title,
            h2{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h2_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h2_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h2.title,
            h2{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h2_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h2_line_height'))){ 
            ?>
            .prelements-heading .title-inner h2.title,
            h2{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h2_line_height') ); ?>
            }
        <?php } ?>

        /* H3 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h3_font'))){ 
            ?>
            .prelements-heading .title-inner h3.title,
            h3{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h3_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h3_font_size'))){ 
            ?>
            .prelements-heading .title-inner h3.title,
            h3{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h3_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h3_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h3.title,
            h3{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h3_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h3_line_height'))){ 
            ?>
            .prelements-heading .title-inner h3.title,
            h3{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h3_line_height') ); ?>
            }
        <?php } ?>

        /* H4 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h4_font'))){ 
            ?>
            .prelements-heading .title-inner h4.title,
            h4{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h4_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h4_font_size'))){ 
            ?>
            .prelements-heading .title-inner h4.title,
            h4{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h4_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h4_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h4.title,
            h4{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h4_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h4_line_height'))){ 
            ?>
            .prelements-heading .title-inner h4.title,
            h4{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h4_line_height') ); ?>
            }
        <?php } ?>

        /* H5 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h5_font'))){ 
            ?>
            .prelements-heading .title-inner h5.title,
            h5{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h5_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h5_font_size'))){ 
            ?>
            .prelements-heading .title-inner h5.title,
            h5{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h5_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h5_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h5.title,
            h5{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h5_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h5_line_height'))){ 
            ?>
            .prelements-heading .title-inner h5.title,
            h5{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h5_line_height') ); ?>
            }
        <?php } ?>

        /* H6 Typography */
        <?php if(!empty(get_theme_mod('fixhero_h6_font'))){ 
            ?>
            .prelements-heading .title-inner h6.title,
            h6{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_h6_font') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h6_font_size'))){ 
            ?>
            .prelements-heading .title-inner h6.title,
            h6{
                font-size:<?php echo esc_attr( get_theme_mod('fixhero_h6_font_size') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h6_font_weight'))){ 
            ?>
            .prelements-heading .title-inner h6.title,
            h6{
                font-weight:<?php echo esc_attr( get_theme_mod('fixhero_h6_font_weight') ); ?>
            }
        <?php } ?>
        <?php if(!empty(get_theme_mod('fixhero_h6_line_height'))){ 
            ?>
            .prelements-heading .title-inner h6.title,
            h6{
                line-height:<?php echo esc_attr( get_theme_mod('fixhero_h6_line_height') ); ?>
            }
        <?php } ?>


        /* Start dynamic style for header section */
        <?php if(!empty(get_theme_mod('fixhero_header_font'))){ ?>
            #rs-header{
                font-family:<?php echo esc_attr( get_theme_mod('fixhero_header_font') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('header_fixhero_fonts_info'))){ ?>
            #rs-header{
                font-weight:<?php echo esc_attr( get_theme_mod('header_fixhero_fonts_info') ); ?>
            }
        <?php } ?>


        <?php if(!empty(get_theme_mod('fixhero_style_h1_color'))){ ?>
            .prelements-heading .title-inner h1.title,
            h1{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h1_color') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_h2_color'))){ ?>
            .prelements-heading .title-inner h2.title,
            h2{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h2_color') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_h3_color'))){ ?>
            .prelements-heading .title-inner h3.title,
            .bs-sidebar .widget_block h2, .bs-sidebar .widget-title,
            .bs-sidebar .recent-post-widget .post-desc a,
            .full-blog-content .blog-title a,
            h3{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h3_color') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_h4_color'))){ ?>
            .prelements-heading .title-inner h4.title,
            h4{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h4_color') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_h5_color'))){ ?>
            .prelements-heading .title-inner h5.title,
            h5{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h5_color') ); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_h6_color'))){ ?>
            .prelements-heading .title-inner h6.title,
            h6{
                color:<?php echo esc_attr( get_theme_mod('fixhero_style_h6_color') ); ?>
            }
        <?php } ?>


        <?php if(!empty(get_theme_mod('fixhero_blog_page_bg_color'))){ ?>
            .rs-blog.blog-page,
            body.search-results, 
            body.single-rs-service-area, 
            body.single-post, body.search-no-results,
            body.single-post, body.blog, body.archive{
                background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_blog_page_bg_color')); ?>
            }
        <?php } ?>

        <?php if(!empty(get_theme_mod('fixhero_style_gradient_color'))){ ?>
            .rs-btn a,
            .rs-blog .blog-item .blog-button a:hover{
                background-image: linear-gradient(90deg, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> 0%, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_gradient_color')); ?> 100%);
            }
        <?php } ?>

        /* Start Dynamic Style for Primary Color */
        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-service-search-form button:hover,            
            .rs-service-search-form,
            .service-item-area .service-item:first-child,
            .rs-portfolio-style2 .grid-item .portfolio-item .portfolio-content .p-title a .title-icons:hover,
            .rs-step-flow-working-process .step-number,
            .rs-portfolio-style2 .grid-item .portfolio-item .portfolio-content .p-category a,
            .service-item-area .service-item:before,
            .rs-btn.style12 a:before,
            .rs-btn.style11 a,
            .btm-cate,
            .bs-sidebar .widget_search button, .bs-sidebar .bs-search button,
            .pagination-area .nav-links span.current,
            .bs-sidebar .widget_categories#categories-2 ul li:hover,
            .bs-sidebar .tagcloud a:hover,
            .widget_medvillsocialiconwi_widget .footer_social li a:hover,
            .rs-blog .blog-item .blog-button a:hover,
            .rs-video.style2 .rs-icon-inners .animate-border .popup-border, .rs-video .popup-videos, .rs-video .popup-videos:before,
            .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta a,
            .rs-header-btn .rs-btn.style11 a,
            .comment-respond .form-submit #submit,
            .counter .counter-icon,
            .counter h3,
            .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-admin-top-position,
            .rs-price-table.style-2 .rs-pricing-table-header:after,
            .rs-primary-bg-child > *,
            .rs-price-table.style-2,
            .rs-portfolio-style1 .portfolio-item .portfolio-details .p-title a .title-icons:hover,
            .team-grid-style8 .team-inner-wrap .image-wrap .plus_team .social-icons1 .social-icon:hover,
            div.rs-accordion-area.style2 .accordion-button > span,
            .rs-primary-bg,
            .social-primary .elementor-social-icon:hover,
            .rs-addon-cost-calculator .result-area .total p,
            .rs-portfolio-style1 .portfolio-item .portfolio-details .p-category a,
            .rs-price-table.style-2 .rs-pricing-table-btn,
            .counter h3::before, .counter h3::after,
            .team-grid-style10 .team-inner-wrap .image-wrap .social-icons1 a:hover,
            .rs-portfolio-style1 .portfolio-item .portfolio-details .p-category a:hover,
            .rs-blog-details .bs-info.tags a,
            .variable--bg--color > div,
            .prelements-blog-grid .prelements-pagination-area .nav-links span.current,
            .rs-blog-details .bs-info.tags a:hover,
            .social-primary .elementor-social-icon:hover,
            .comment-respond .form-submit #submit:hover,
            .rs-addon-slider .slick-dots li.slick-active button,
            .team-grid-style4 .team-item .team-content .social-icons a:hover i,
            .rs_button.style6 .rs_button, .rs-btn.style6 .rs_button,
            .rs-addon-services.style11 .services-inner .service-progress-bar:after,
            div.beforeandafter div.drag::after,
            div.beforeandafter div.drag::before,
            .prelements-blog-grid .pre-blog-item .pre-image-wrap .pre-cat-list a,
            div.beforeandafter div.drag,
            .primary-bg,
            .mfp-close-btn-in .mfp-close,
            .rs-addon-services.style12 .services-inner .icon_img,
            .rs_button.style6 .rs_button,
            .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .btn-part .portfolio-btn:hover,
            .prelements-heading.style2 .pre-heading-line1:before,
            .prelements-heading.style2 .pre-heading-line1:after,
            .elementor-widget-container:hover .prelements-heading.style2 .pre-heading-line1:before,
            .elementor-widget-container:hover .prelements-heading.style2 .pre-heading-line1:after,
            .rs-social-menu ul li a:hover,
            .rs-btn a,
            .rs-portfolio-style4 .portfolio-item .portfolio-content:before,
            .rs-portfolio-style4 .portfolio-item .portfolio-content:after,
            .rsaddon-unique-slider .slick-arrow,
            .rs-addon-slider .slick-dots li.slick-active button,
            .prelements-heading.style6 .title-inner span.sub-text::before,
            .prelements-heading.style6 .title-inner span.sub-text::after,
            .prelements-heading.style7 .title-inner span.sub-text::before,
            .prelements-heading.style7 .title-inner span.sub-text::after,
            .rs-portfolio-style3 .grid-item .portfolio-item .portfolio-content .p-category a,
            .rs-btn.style11 a:before,
            .rs-service-search-form.primary_color .search-wrap button,
            .rs-service-search-form.secondary_color .search-wrap button:hover,
            body.error404 .page-error .site-main .page-content .readon,
            .rs-blog .blog-item.rs-flat .blog-button a,
            .rsaddon-unique-slider.rs-testimonial2 .rs-addon-slider .custom-nav .slick-arrow,
            .rs-circle-service-box .main-image:before,
            .rs-portfolio-slider .rs-addon-sliders.slick-dots2 .slick-dots li.slick-active button:after,
            .elementor-social-icon-hover-primary-bg .elementor-social-icons-wrapper a.elementor-social-icon:hover,
            .service_single_wrap .widget_nav_menu ul li:hover,
            .rs-breadcrumbs-meta-elementor,
            .service-cta-box .service-cta-content > h3,
            .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-admin-wrapper a,
            .prelements-unique-slider.prelements-blog-grid.style1 .pre-blog-item.style1 .blog-inner-wrap .pre-image-wrap .pre-blog-meta-slider,
            .rs-service-search-form button
            {
                background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .window-tab-content-list-wrapper .window-tab-content-list li::before {
                background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-portfolio-style2 .grid-item .portfolio-item .portfolio-content .p-category a:hover,
            .rs-portfolio-style2 .grid-item .portfolio-item .portfolio-content .p-title a:hover,
            .counter-top-area.style2 .rs-counter-list .count-number span,
            div.rs-accordion-area .tab-title span,
            .rs-btn.style12 a,
            .fixhero-social-custom .elementor-widget-container .elementor-social-icon:hover i,
            .rs-heading-primary .title,
            .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a:hover,
            .rs-primary-color,
            .rs-addon-services.style4 .services-inner .btn-part a.services-btn:hover,
            .rs-addon-services.style5 .services-inner .btn-part a.services-btn,
            .testimonial-style4.color_default_scheme .testimonial-item .testimonial-informations .testimonial-name,
            .step-flow-style2.color_default_scheme .rs-step-flow-icon-box-icon .step-number-top .step-right-text,
            .rs-addon-services.style3 .services-inner .content_part .services-title .title:hover *,
            .full-blog-content .blog-title a:hover,            
            .rs-portfolio-style1 .portfolio-item .portfolio-details .p-title a:hover,             
            .team-grid-style8 .team-inner-wrap .team-name a:hover,
            .service-border-menu .hfe-nav-menu__layout-horizontal .menu-item a.hfe-menu-item:hover, 
            .service-border-menu .hfe-nav-menu__layout-horizontal .menu-item a.hfe-menu-item:hover:before, 
            .service-border-menu .hfe-nav-menu__layout-horizontal .menu-item a.hfe-menu-item.highlighted, 
            .service-border-menu .hfe-nav-menu__layout-horizontal .menu-item a.hfe-menu-item:focus,
            .bs-sidebar .recent-post-widget .post-desc span svg,
            .check-arrow li:before,
            .team-grid-style10 .team-inner-wrap .image-wrap .social-icons1 a,
            .social-light .elementor-social-icon:hover i,
            .rs-portfolio-style3 .portfolio-item .p-category a,
            .rs-portfolio-style3 .portfolio-item .p-title a:hover,
            .bs-sidebar .recent-post-widget .post-desc a:hover,
            .rs-brochures .brochures-content ul li a:hover .rs-feature-text,
            .rs-features-list-content li i,
            .team-grid-style10 .team-inner-wrap .team-name a:hover,
            .rs-portfolio-style2.color_default_scheme .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-title a,
            .rs-portfolio-style2.color_default_scheme .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-title a:hover,
            .hfe-layout-vertical .right-arrow-style2 ul .menu-item a:after,
            .rs-portfolio-style2 .rs-addon-sliders .slick-arrow:hover:before,
            .portfolio-filter.rs-portfolio-style9 .portfolio-item .p-title a:hover,
            div.beforeandafter div.drag div.draghandle::before,
            .page-error .content-area h2 span,
            .rs-offcanvas-area .right_menu_togle .contact-area li i,
            .rs-offcanvas-area .right_menu_togle .footer_social li a:hover i:before,
            .rs-offcanvas-area .right_menu_togle a:hover,
            .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .btn-part .portfolio-btn i,
            .rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a,
            .prelements-blog-grid .pre-blog-item .pre-blog-content .pre-blog-meta i,
            .rs-circle-service-box .service-icons-wrapper .rs-icon .rs-icon-text a:hover,
            .rs-circle-service-box .service-icons-wrapper .rs-icon i,
            header .search_icons i,
            .elementor-social-icon-hover-primary2 .elementor-social-icon:hover i,
            .rs-contact-box.color_light_scheme .address-text div > .des a:hover,
            .elementor-social-icon-hover-primary .elementor-social-icons-wrapper a.elementor-social-icon:hover i,
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item a:hover,
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item a:hover:before,
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item.current-menu-item a.hfe-menu-item,
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item.current-menu-item a.hfe-menu-item:before,
            .prelements-heading .title-inner span.sub-text
            {
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-hover-primary-link-inner a:hover,
            .rs-addon-services.style5 .services-inner .btn-part a.services-btn:hover,
            .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .rs-item--meta .rs-item--title a:hover,
            .rs-portfolio-flex .rs-portfolio-inner .rs-grid-item .rs-item--meta .rs-item--category a:hover,
            .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a:hover, 
            .prelements-blog-grid .pre-blog-item.transparent .blog-inner-wrap .pre-blog-content .pre-post-title a:hover,
            .rs-addon-services.style12 .services-inner .services-title a:hover,
            .rs-addon-services .services-inner .services-title a:hover,
            .custom-footer-color .hfe-nav-menu ul li a:hover, 
            .footer-copyright-area .hfe-nav-menu ul li a:hover
            {
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-portfolio-style2 .portfolio-item.rsportfolio-grid-style2 .portfolio-details .title-icons svg path,
            .rs-portfolio-style1 .portfolio-item .portfolio-details .p-title a .title-icons svg path,
            .rs-portfolio-style3 .grid-item .portfolio-item .portfolio-content .p-title a .title-icons svg path,
            .rs-portfolio-style3 .portfolio-item .portfolio-content .p-icon a svg path,
            .rs-circle-service-box .service-icons-wrapper .rs-icon svg path,
            div.rs-accordion-area .accordion-button:not(.collapsed) svg path,      
            .window-banner-btn:hover svg path,
            .rs-portfolio-style2 .grid-item .portfolio-item .portfolio-content .p-title a .title-icons svg path
            {
                fill:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>
            }
        <?php endif; ?>
        
        /* Cost Calculator Start */
        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=checkbox]:before {
                box-shadow: inset 1.1em 1.1em <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
            .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-webkit-slider-thumb {
                box-shadow: 0px 0px 10px 0px <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
            .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type=range]::-moz-range-thumb {
                box-shadow: 0px 0px 10px 0px <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
        <?php endif; ?>
        /* Cost Calculator End */

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-addon-slider .slick-dots li.slick-active button,
            .rs-portfolio-style2 .rs-addon-sliders .slick-arrow:hover,
            .prelements-heading.style14 .title,
            .widget_medvillsocialiconwi_widget .footer_social li a:hover,
            .rs-blog .blog-item .blog-button a:hover,
            .rs-btn.style12 a:hover,
            blockquote,
            .team-grid-style10 .team-inner-wrap:hover .image-wrap img,
            .social-primary .elementor-social-icon:hover,
            .step-flow-style2 .rs-step-flow-icon-box-icon .rs-step-icon:before,
            .rs-addon-cost-calculator .cost_calculator .area-ctrol input[type="checkbox"],
            div.beforeandafter div.drag div.draghandle,
           .rs-social-menu ul li a:hover,
           .elementor-social-icon-hover-primary-bg .elementor-social-icons-wrapper a.elementor-social-icon:hover,
           .elementor-social-icon-hover-primary2 .elementor-social-icon:hover,
           .rs-portfolio-slider .rs-addon-sliders.slick-dots2 .slick-dots li.slick-active button,
            .default-icon-showhide:hover{
                border-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .primary-border-color,
            .default-icon-showhide:hover{
                border-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
            .rs-blog .blog-item:not(.rs-flat) .blog-button a:hover,
            .rs-social-menu ul li a:hover {
                background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
                background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
                border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
            }
        <?php endif; ?>
        /* End Start Dynamic Style for Primary Color */


        /* Start Dynamic Style for Preloader Section */
        <?php if(!empty(get_theme_mod('fixhero_preloader_bg_color'))) : ?>
            #pre-load{
                background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_preloader_bg_color')); ?>
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_preloader_border_color'))) : ?>
            .loader .loader-container{
                border-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_preloader_border_color')); ?>
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_preloader_animate_circle_color'))) : ?>
            .loader .loader-container:before{
                border-top-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_preloader_animate_circle_color')); ?>
            }
        <?php endif; ?>
        /* End Dynamic Style for Preloader Section */

        /* Start Dynamic Style for 404 Page */
        <?php if(!empty(get_theme_mod('fixhero_404_text_color'))) : ?>
            .page-error .content-area h2,
            .page-error .content-area h2 span{
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_404_text_color')); ?>
            }
        <?php endif; ?>
        <?php if(!empty(get_theme_mod('fixhero_404_btn_bg_color'))) : ?>
            .page-error .readon{
                background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_404_btn_bg_color')); ?>
            }
        <?php endif; ?>
        <?php if(!empty(get_theme_mod('fixhero_404_btn_text_color'))) : ?>
            .page-error .readon{
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_404_btn_text_color')); ?>
            }
        <?php endif; ?>
        /* End Dynamic Style for 404 Page */

        <?php if(!empty(get_theme_mod('fixhero_scroll_top_bg_color'))) { ?>
            <?php if(!empty(get_theme_mod('fixhero_scroll_top_bg_color'))) : ?>
                #scrollUp i{
                    background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_scroll_top_bg_color')); ?>
                }
            <?php endif; ?>
        <?php } else { ?>
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                #scrollUp i{
                    background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>
                }
            <?php endif; ?>
        <?php } ?>
        
        <?php if(!empty(get_theme_mod('fixhero_scroll_top__color'))) : ?>
            #scrollUp i{
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_scroll_top__color')); ?>
            }
        <?php endif; ?>

        <?php if(!empty(get_theme_mod('fixhero_scroll_top_bg_color_hover'))) : ?>
            #scrollUp i:hover{
                background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_scroll_top_bg_color_hover')); ?>
            }
        <?php endif; ?>
        
        <?php if(!empty(get_theme_mod('fixhero_scroll_top__color_hover'))) : ?>
            #scrollUp i:hover{
                color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_scroll_top__color_hover')); ?>
            }
        <?php endif; ?>

        /* Start Dynamic Style for Heading Color */
        <?php if(!empty(get_theme_mod('fixhero_style_h3_color'))) : ?>
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item a,
            .service-border-menu .hfe-nav-menu nav ul.hfe-nav-menu li.menu-item a:before,
            .rs-contact-box.color_dark_scheme .address-text div > a,
            .rs-contact-box.color_dark_scheme .address-text div > .des,
            .rs-contact-box.color_dark_scheme .address-text div > .des a,
            .rs-contact-box.color_primary_scheme .address-text div > a,
            .rs-contact-box.color_primary_scheme .address-text div > .des,
            .rs-contact-box.color_primary_scheme .address-text div > .des a,
            .rs-contact-box.color_primary_scheme .address-icon i,
            .rs-team-slider.team-slider-style9 .team-inner-wrap .team-content .team-name a,
            .rs-contact-box.color_socondary_scheme .address-text div > a,
            .rs-contact-box.color_socondary_scheme .address-text div > .des,
            .rs-contact-box.color_socondary_scheme .address-text div > .des a,
            .rs-contact-box.color_socondary_scheme .address-icon i,
            .rs-contact-box.color_gradient_scheme .address-text div > a,
            .rs-contact-box.color_gradient_scheme .address-text div > .des,
            .rs-contact-box.color_gradient_scheme .address-text div > .des a,
            .team-grid-style7.color_secondary_scheme .team-item .team-inner-wrap .team-content h3.team-name a,
            .team-grid-style7.color_primary_scheme .team-item .team-inner-wrap .team-content h3.team-name a,
            .rs-addon-services.style9.secondary_scheme .services-inner .content_part .services-title .title a,
            .rs-addon-services.style9.primary_scheme .services-inner .content_part .services-title .title a,
            .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a,
            .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a i,
            .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a,
            .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a i,
            .rs-services-slider.color_gradient_scheme.service-style-2 .service-title .title,
            .team-slider-style10.color_primary_scheme  .team-item .team-content h3.team-name a,
            .team-slider-style10.color_secondary_scheme  .team-item .team-content h3.team-name a,
            .prelements-blog-grid .pre-blog-item .pre-blog-content h3.pre-post-title a,
            .rs-services-slider.service-style-5 .rs-service-slider .service-title-holder .service-title .title,
            .rs-addon-services.style12 .services-title .title a,
            .team-grid-style6 .team-item .team-content h3.team-name a {
                color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_h3_color')); ?>;
            }

            .rs-contact-box.color_dark_scheme .address-icon:before,
            .rs-contact-box.color_dark_scheme .address-icon:after {
                background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_h3_color')); ?>;
            }

            .rs-contact-box.color_socondary_scheme .address-icon svg path,
            .rs-contact-box.color_dark_scheme .address-icon svg path,
            .rs-contact-box.color_primary_scheme .address-icon svg path,
            .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a svg path,
            .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a svg path {
                fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_h3_color')); ?>;
            }
        <?php endif; ?>
        /* End Dynamic Style for Heading Color */


        /* Start Dynamic Style for Primary Color */
            /* Common Hooks Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .primary-bg,
                .primary-bg-child > div {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .primary-color,
                .primary-icon-list i {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .header-logo-skew::before {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .primary-border {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Common Hooks End */

            /* Video Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-video.color_primary_scheme .popup-videos:before,
                .rs-video.color_primary_scheme .popup-videos {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Video End */

            /* Feature List Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-features-list-content.color_primary_scheme li i {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Feature List End */

            /* Counter Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .counter-top-area.style2.color_primary_scheme {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Counter End */

            /* Progress Bar Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-skill-bar.style1.color_primary_scheme .skillbar {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-skill-bar.style1.color_primary_scheme .skillbar .skillbar-bar {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Progress Bar End */

            /* Accordion Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-accordion-area.secondary_primary_scheme .accordion-item .accordion-header .accordion-button span,
                .rs-accordion-area.primary_secondary_scheme .accordion-item .accordion-header .accordion-button {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Accordion End */

            /* Heading Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .prelements-heading.color_secondary_scheme .title-inner .title span:nth-of-type(2)::after,
                .prelements-heading.color_secondary_scheme2 .title-inner .sub-text,
                .prelements-heading.color_primary_scheme2 .title-inner .title span,
                .prelements-heading.color_primary_scheme .title-inner .title span {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Heading End */

            /* Contact Form Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .fluentform-widget-wrapper.color_light_scheme .frm-fluent-form .ff-btn-submit:hover,
                .fluentform-widget-wrapper.color_dark_scheme .frm-fluent-form .ff-btn-submit:hover,
                .fluentform-widget-wrapper.color_secondary_scheme .frm-fluent-form .ff-btn-submit:hover,
                .fluentform-widget-wrapper.color_primary_scheme .frm-fluent-form .ff-btn-submit {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Contact Form End */



            /* Offcanvas Start */


            <?php if(!empty(get_theme_mod('fixhero_offcanvas_bg_color'))) : ?>
                .rs-offcanvas-area nav.right_menu_togle{
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_bg_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_bg_color')); ?>;
                }
            <?php endif; ?>

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_over_bg_color'))) : ?>
                body .rsoffwrap{
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_over_bg_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_over_bg_color')); ?>;
                    opacity: 0.9;
                }
            <?php endif; ?>   

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_text_color'))) : ?>
                .rs-offcanvas-area .right_menu_togle h4, 
                .rs-offcanvas-area .right_menu_togle .footer_social li a i:before,
                .rs-offcanvas-area .right_menu_togle .footer_social li a,
                .rs-offcanvas-area .right_menu_togle a,
                .rs-offcanvas-area .right_menu_togle{
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_text_color')); ?>;
                }
            <?php endif; ?>  

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_link_hover_color'))) : ?>
                .rs-offcanvas-area .right_menu_togle .footer_social li a:hover,
                body .widget_medvillsocialiconwi_widget .footer_social li a:hover,
                body .rs-offcanvas-area .right_menu_togle .footer_social li a:hover i:before,
                .rs-offcanvas-area .right_menu_togle a:hover{
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_link_hover_color')); ?>;
                }
            <?php endif; ?> 

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_icon_color'))) : ?>
                .rs-offcanvas-area .right_menu_togle .contact-area li i{
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_icon_color')); ?>;
                }
            <?php endif; ?> 

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_close_bg_color'))) : ?>
                .rsoffwrap-close{
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_close_bg_color')); ?>;
                }
            <?php endif; ?>  

            <?php if(!empty(get_theme_mod('fixhero_offcanvas_close_icon_color'))) : ?>
                .rsoffwrap-close i{
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_offcanvas_close_icon_color')); ?>;
                }
            <?php endif; ?>      
            

            /* Offcanvas End */



            /* Team Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .team-grid-style7.color_primary_scheme .team-item:not(.reverse_team) .team-inner-wrap .team-content .plus_team .social-icons1,
                .team-grid-style7.color_primary_scheme .team-item:not(.reverse_team) .team-inner-wrap .team-content .plus_team i.ri-share-line,
                .team-grid-style2.color_primary_scheme .team-inner-wrap .team-content,
                .team-grid-style9.color_primary_scheme .team-item .team-inner-wrap .share-icon-wrapper .social-icons1 a i,
                .team-grid-style9.color_primary_scheme .team-item .team-inner-wrap .team-content .plus_team i,
                .team-grid-style9.color_secondary_scheme .team-item .team-inner-wrap .team-content .plus_team i:hover,
                .team-grid-style8.color_primary_scheme .team-inner-wrap .image-wrap .plus_team i.ri-share-line,
                .team-grid-style6.color_primary_scheme .team-item .social-icons a:hover i,
                .rs-team-slider.team-slider-style9.color_primary_scheme .plus_team i.ri-share-line,
                .rs-team-slider.team-slider-style9.color_primary_scheme .plus_team .social-icons1 i:hover,
                .team-grid-style8.color_primary_scheme .team-inner-wrap .image-wrap .plus_team .social-icons1 .social-icon:hover,
                .team-grid-style7.color_secondary_scheme .team-item .team-inner-wrap .team-content,
                .team-grid-style7.color_primary_scheme .team-item.reverse_team .team-inner-wrap .team-content .plus_team .social-icons1 .social-icon:hover,
                .team-grid-style7.color_primary_scheme .team-item.reverse_team .team-inner-wrap .team-content .plus_team i.ri-share-line {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .team-grid-style7.color_primary_scheme .team-item.reverse_team .team-inner-wrap .team-content {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .team-grid-style2.color_secondary_scheme .team-inner-wrap .team-content .social-icons a:hover,
                .team-grid-style2.color_secondary_scheme .team-inner-wrap .team-content .team-name a:hover,
                .team-slider-style10.color_primary_scheme  .team-item .team-content h3.team-name a:hover,
                .rs-team-slider.team-slider-style9.color_primary_scheme .team-inner-wrap .team-content .team-name a:hover,
                .rs-team-slider.team-slider-style9.color_gradient_scheme .team-inner-wrap .team-content .team-name a:hover,
                .team-slider-style10.color_secondary_scheme  .team-item .team-content h3.team-name a:hover,
                .team-slider-style10.color_primary_scheme  .team-content-inner .team-content .plus_team .social-icons1 a:hover i,
                .team-slider-style10.color_primary_scheme .team-item .team-inner-wrap .team-content .plus_team i.ri-share-line:hover,
                .team-grid-style8.color_primary_scheme .team-inner-wrap .team-name a:hover,
                .team-grid-style7.color_primary_scheme .team-item.reverse_team .team-inner-wrap .team-content h3.team-name a:hover,
                .team-grid-style7.color_primary_scheme .team-item .team-inner-wrap .team-content h3.team-name a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Team End */

            /* Price table Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper,
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .rs-pricing-table-btn:hover,
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .rs-pricing-table-btn,
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .btn-part a,
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .btn-part a:hover,
                .rs-price-table-slider.color_primary_scheme .slick-dots li.slick-active button,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-btn:hover,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-btn,
                .rs-price-table.color_primary_scheme.style-1 {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .get-currency,
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper .pricing-price .get-price,
                .rs-price-table.color_secondary_scheme.style-1 .btn-bottom-text p,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-currency,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-price-text,
                .rs-price-table-slider.color_gradient_scheme .pricing-wrapper .pricing-price .get-price,
                .rs-price-table.color_gradient_scheme.style-1 .btn-bottom-text p,
                .rs-price-table.color_gradient_scheme.style-1 .rs-pricing-table-currency,
                .rs-price-table.color_gradient_scheme.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag,
                .rs-price-table.color_gradient_scheme.style-1 .rs-pricing-table-price-text {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-price-table-slider.color_primary_scheme .slick-dots li.slick-active button,
                .rs-price-table.color_secondary_scheme.style-1:after,
                .rs-price-table.color_gradient_scheme.style-1:after,
                .rs-price-table-slider.color_gradient_scheme .pricing-wrapper:after,
                .rs-price-table.color_secondary_scheme.style-1 .short-desc {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-features-list li i,
                .rs-price-table.color_secondary_scheme.style-1 .rs-pricing-table-features-list li svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Price table End */

            /* Hotspot Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-hotspots.color_primary_scheme .pre-circle-ripple:before {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-hotspots.color_primary_scheme .pre-circle-ripple:after {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Hotspot End */

            /* Button Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-btn.style6.primary_color a,
                .rs-btn.style6.secondary_color a:hover,
                .rs-btn.style13.secondary_color a:hover,
                .rs-btn.style13.primary_color a,
                .rs-btn.style11.primary_color a,
                .rs-btn.style11.primary_color a:hover,
                .rs-btn.style11.secondary_color a:before {
                    background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-btn.style10.secondary_color a:hover,
                .rs-btn.style10.secondary_color a:hover i,
                .rs-btn.style6.primary_color a:hover {
                    color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-btn.style10.secondary_color a:hover svg path {
                    fill:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Button End */

            /* Service Area Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-search-form-area input[type=submit],
                .rs-service-areas .service-item .service-item-inner .rs-service-thumb .rs-service-categorys a {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-service-areas .service-item .service-item-inner .service-normal-text ul li i:before,
                .rs-service-areas .service-item .service-item-inner .service-normal-text .rs-service-title a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Service Area End */

            /* Service Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider .service-img:after,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider .service-img .rs-step-icon,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider .service-img:before,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider .service-title-holder .read__more a,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider:hover .service-img:after,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider:hover .service-img .rs-step-icon,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider:hover .service-img:before,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider:hover .service-title-holder .read__more a,
                .rs-services-slider.service-style-4.color_secondary_scheme .rs-service-slider,
                .rs-services-slider.service-style-4.color_primary_scheme .slick-center .rs-service-slider,
                .rs-services-slider.service-style-4.color_primary_scheme .rs-service-slider:hover,
                .rs-addon-services.style10.primary_scheme .numbering,
                .rs-addon-services.style9.primary_scheme .services-inner .content_part .icon_style,
                .rs-addon-services.style7.secondary_scheme .services-inner .numbering,
                .rs-addon-services.style7.primary_scheme .services-inner .media_wrap .media-cmn,
                .rs-addon-services.style7.primary_scheme .services-inner:hover .numbering,
                .rs-addon-services.style7.secondary_scheme .services-inner:hover .media_wrap .media-cmn,
                .rs-addon-services.style4.primary_scheme .services-inner .content_part .btn-part a,
                .rs-addon-services.style4.primary_scheme:before {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-addon-services-tab-hovereffect.color_primary_scheme .services-inner .content_part_hover:after,
                .rs-addon-services-tab-hovereffect.color_primary_scheme .services-inner .content_part {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-services-slider.service-style-1.color_primary_scheme .rs-service-slider .service-title-holder .numbering {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-addon-services.style9.primary_scheme .services-inner .content_part .services-title .title a:hover,
                .rs-addon-services.style9.secondary_scheme .services-inner .content_part .services-title .title a:hover,
                .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a:hover,
                .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a:hover i,
                .rs-services-slider.service-style-1.color_primary_scheme .rs-service-slider .service-title-holder .numbering span,
                .rs-addon-services.style4.secondary_scheme .services-inner .content_part .btn-part a:hover,
                .rs-addon-services.style1.primary_scheme .services-inner:hover .btn-part a,
                .rs-services-slider.color_gradient_scheme.service-style-2 .service-title .title:hover,
                .rs-addon-services.style1.primary_scheme .services-inner:hover .numbering {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-addon-services.style9.primary_scheme .services-inner .content_part .btn-part a:hover svg path,
                .rs-addon-services.style1.primary_scheme .services-inner:hover .btn-part a svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Service End */

            /* Blog Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .prelements-blog-grid.color_primary_scheme .pre-blog-item .pre-blog-meta-slider i {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Blog End */

            /* Contact Box Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-contact-box.color_primary_scheme .address-item .address-icon {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-contact-box.color_dark_scheme .address-text div > .des a:hover,
                .rs-contact-box.color_primary_scheme2 .address-item .address-icon i,
                .rs-contact-box.color_primary_scheme2 .address-item .address-text div > a,
                .rs-contact-box.color_primary_scheme2 .address-item .address-text div > .des,
                .rs-contact-box.color_primary_scheme2 .address-item .address-text div > a:hover:not(.des),
                .rs-contact-box.color_primary_scheme2 .address-item .address-text div > .des:hover:not(.des),
                .rs-contact-box.color_light_scheme .address-item .address-text div > a:hover,
                .rs-contact-box.color_dark_scheme .address-item .address-text div > a:hover,
                .rs-contact-box.color_hover_scheme .address-item .address-text div > a:hover,
                .rs-contact-box.color_primary_scheme .address-item .address-text a:hover:not(.des),
                .rs-contact-box.color_primary_scheme .address-item .address-text .des:hover:not(.des),
                .rs-contact-box.color_gradient_scheme .address-item .address-text div > a:hover,
                .rs-contact-box.color_gradient_scheme .address-item .address-text div > .des a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-contact-box.color_light_scheme .address-icon svg path,
                .rs-contact-box.color_primary_scheme2 .address-item .address-icon svg path,
                .rs-contact-box.color_primary_scheme .address-item .address-icon svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-contact-box.color_primary_scheme .address-item .address-icon {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Contact Box End */

            /* Testimonial Slider Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-testimonial .testimonial-style3.color_primary_scheme .testimonial-item {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .testimonial-style4.color_primary_scheme .testimonial-item {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .testimonial-style4.color_secondary_scheme .testimonial-item .testimonial-informations .testimonial-name {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Testimonial Slider End */

            /* Step Flow Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .step-flow-style2.color_primary_scheme .rs-step-flow-icon-box-icon .step-number-top .step-right-text {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Step Flow End */

            /* Portfolio Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-portfolio-style9.color_primary_scheme .portfolio-filter button:hover,
                .rs-portfolio-style9.color_primary_scheme .portfolio-filter button.active,
                .rs-isotope-portfolio.color_secondary_scheme .filters ul li,
                .rs-isotope-portfolio.color_primary_scheme .filters ul li:hover,
                .rs-isotope-portfolio.color_primary_scheme .filters ul li.is-checked {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rs-portfolio-style2.color_primary_scheme  .portfolio-item.rsportfolio-grid-style2 .portfolio-details .p-title a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> !important;
                }
            <?php endif; ?>
            /* Portfolio End */

            /* Advance Tab Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rstab-main.color_primary_scheme .window-tab-content-list-wrapper .window-tab-content-list li::before,
                .rstab-main.color_primary_scheme .tab-menu-wrapper .nav-tabs .nav-link:hover,
                .rstab-main.color_primary_scheme .tab-menu-wrapper .nav-tabs .nav-link.active {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
                .rstab-main.color_primary_scheme .content--teb-area .content--left-area .rs-btn a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Advance Tab End */
        /* End Dynamic Style for Primary Color */

        /* Start Dynamic Style for Secondary Color */
            /* Common Hooks Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .secondary-bg,
                .header-logo-skew,
                .secondary-bg-child > div,
                .header-shape:after {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .secondary-color,
                .secondary-icon-list i {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .secondary-border {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Common Hooks End */

            /* Video Start */
            <?php if(!empty(get_theme_mod('fixhero_style_primary_color'))) : ?>
                .rs-video.color_primary_scheme .popup-videos:before,
                .rs-video.color_primary_scheme .popup-videos {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?>;
                }
            <?php endif; ?>
            /* Video End */

            /* Feature List Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-features-list-content.color_secondary_scheme li i {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Feature List End */

            /* Counter Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .counter-top-area.style2.color_secondary_scheme {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Counter End */

            /* Progress Bar Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-skill-bar.style1.color_secondary_scheme .skillbar {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-skill-bar.style1.color_secondary_scheme .skillbar .skillbar-bar {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Progress Bar End */

            /* Step Flow Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .step-flow-style2.color_secondary_scheme .rs-step-flow-icon-box-icon .step-number-top .step-right-text {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Step Flow End */

            /* Hotspot Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-hotspots.color_secondary_scheme .pre-circle-ripple:before {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-hotspots.color_secondary_scheme .pre-circle-ripple:after {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Hotspot End */

            /* Accordion Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-accordion-area.secondary_primary_scheme .accordion-item .accordion-header .accordion-button,
                .rs-accordion-area.primary_secondary_scheme .accordion-item .accordion-header .accordion-button span {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Accordion End */

            /* Contact Box Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-contact-box.color_socondary_scheme .address-item .address-icon {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-contact-box.color_socondary_scheme2 .address-item .address-icon i,
                .rs-contact-box.color_socondary_scheme2 .address-item .address-text div > a,
                .rs-contact-box.color_socondary_scheme2 .address-item .address-text div > .des,
                .rs-contact-box.color_socondary_scheme2 .address-item .address-text div > a:hover:not(.des),
                .rs-contact-box.color_socondary_scheme2 .address-item .address-text div > .des:hover:not(.des),
                .rs-contact-box.color_socondary_scheme .address-item .address-text a:hover:not(.des),
                .rs-contact-box.color_socondary_scheme .address-item .address-text .des:hover:not(.des) {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-contact-box.color_socondary_scheme2 .address-item .address-icon svg path,
                .rs-contact-box.color_socondary_scheme .address-item .address-icon svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-contact-box.color_socondary_scheme .address-item .address-icon  {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Contact Box End */

            /* Service Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider .service-img:after,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider .service-img .rs-step-icon,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider .service-img:before,
                .rs-services-slider.service-style-5.color_secondary_scheme .rs-service-slider .service-title-holder .read__more a,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider:hover .service-img:after,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider:hover .service-img .rs-step-icon,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider:hover .service-img:before,
                .rs-services-slider.service-style-5.color_primary_scheme .rs-service-slider:hover .service-title-holder .read__more a,
                .rs-services-slider.service-style-4.color_primary_scheme .rs-service-slider,
                .rs-services-slider.service-style-4.color_secondary_scheme .slick-center .rs-service-slider,
                .rs-services-slider.service-style-4.color_secondary_scheme .rs-service-slider:hover,
                .rs-addon-services.style10.secondary_scheme .numbering,
                .rs-addon-services.style9.secondary_scheme .services-inner .content_part .icon_style,
                .rs-addon-services.style7.primary_scheme .services-inner .numbering,
                .rs-addon-services.style7.secondary_scheme .services-inner .media_wrap .media-cmn,
                .rs-addon-services.style7.secondary_scheme .services-inner:hover .numbering,
                .rs-addon-services.style7.primary_scheme .services-inner:hover .media_wrap .media-cmn,
                .rs-addon-services.style4.socondary_scheme .services-inner .content_part .btn-part a,
                .rs-addon-services.style4.socondary_scheme:before {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-addon-services-tab-hovereffect.color_secondary_scheme .services-inner .content_part_hover:after,
                .rs-addon-services-tab-hovereffect.color_secondary_scheme .services-inner .content_part {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-services-slider.service-style-1.color_secondaryscheme .rs-service-slider .service-title-holder .numbering {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a:hover,
                .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a:hover i,
                .rs-services-slider.service-style-1.color_secondary_scheme .rs-service-slider .service-title-holder .numbering span,
                .rs-addon-services.style4.primary_scheme .services-inner .content_part .btn-part a:hover,
                .rs-addon-services.style1.socondary_scheme .services-inner:hover .btn-part a,
                .rs-addon-services.style1.socondary_scheme .services-inner:hover .numbering {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }

                .rs-addon-services.style9.secondary_scheme .services-inner .content_part .btn-part a:hover svg path,
                .rs-addon-services.style1.socondary_scheme .services-inner:hover .btn-part a svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Service End */

            /* Contact Form Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .fluentform-widget-wrapper.color_primary_scheme .frm-fluent-form .ff-btn-submit:hover,
                .fluentform-widget-wrapper.color_secondary_scheme .frm-fluent-form .ff-btn-submit {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Contact Form End */

            /* Price table Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-price-table-slider.color_secondary_scheme .pricing-wrapper,
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .rs-pricing-table-btn:hover,
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .rs-pricing-table-btn,
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .btn-part a,
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .btn-part a:hover,
                .rs-price-table-slider.color_secondary_scheme .slick-dots li.slick-active button,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-btn:hover,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-btn,
                .rs-price-table.color_secondary_scheme.style-1 {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .get-currency,
                .rs-price-table-slider.color_primary_scheme .pricing-wrapper .pricing-price .get-price,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-currency,
                .rs-price-table.color_primary_scheme.style-1 .btn-bottom-text p,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-price .rs-pricing-table-price-tag,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-price-text {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-price-table-slider.color_secondary_scheme .slick-dots li.slick-active button,
                .rs-price-table.color_primary_scheme.style-1:after,
                .rs-price-table.color_primary_scheme.style-1 .short-desc {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-features-list li i,
                .rs-price-table.color_primary_scheme.style-1 .rs-pricing-table-features-list li svg path {
                    fill: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Price table End */

            /* Heading Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .prelements-heading.color_primary_scheme .title-inner .title span:nth-of-type(2)::after,
                .prelements-heading.color_primary_scheme2 .title-inner .sub-text,
                .prelements-heading.color_secondary_scheme2 .title-inner .title span,
                .prelements-heading.color_secondary_scheme .title-inner .title span {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Heading End */

            /* Button Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-btn.style6.primary_color a:hover,
                .rs-btn.style6.secondary_color a,
                .rs-btn.style13.secondary_color a,
                .rs-btn.style13.primary_color a:hover,
                .rs-btn.style11.secondary_color a,
                .rs-btn.style11.secondary_color a:hover,
                .rs-btn.style11.primary_color a:before,
                .rs-service-search-form.primary_color .search-wrap button:hover,
                .rs-service-search-form.secondary_color .search-wrap button {
                    background-color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    background:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-btn.style10.primary_color a:hover,
                .rs-btn.style10.primary_color a:hover i,
                .rs-btn.style6.secondary_color a:hover {
                    color:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rs-btn.style10.primary_color a:hover svg path {
                    fill:<?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Button End */

            /* Team Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .team-grid-style2.color_primary_scheme .team-inner-wrap .team-content .social-icons a:hover,
                .team-grid-style2.color_primary_scheme .team-inner-wrap .team-content .team-name a:hover,
                .team-grid-style8.color_secondary_scheme .team-inner-wrap .team-name a:hover,
                .rs-team-slider.team-slider-style9.color_secondary_scheme .team-inner-wrap .team-content .team-name a:hover,
                .team-grid-style7.color_secondary_scheme .team-item .team-inner-wrap .team-content h3.team-name a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .team-grid-style7.color_secondary_scheme .team-item.reverse_team .team-inner-wrap .team-content {
                    border-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .team-grid-style7.color_secondary_scheme .team-item:not(.reverse_team) .team-inner-wrap .team-content .plus_team .social-icons1,
                .team-grid-style7.color_secondary_scheme .team-item:not(.reverse_team) .team-inner-wrap .team-content .plus_team i.ri-share-line,
                .team-grid-style2.color_secondary_scheme .team-inner-wrap .team-content,
                .team-grid-style6.color_secondary_scheme .team-item .social-icons a:hover i,
                .team-grid-style9.color_primary_scheme .team-item .team-inner-wrap .share-icon-wrapper .social-icons1 a:hover i,
                .team-grid-style9.color_secondary_scheme .team-item .team-inner-wrap .share-icon-wrapper .social-icons1 a i,
                .team-grid-style9.color_secondary_scheme .team-item .team-inner-wrap .team-content .plus_team i,
                .team-grid-style9.color_primary_scheme .team-item .team-inner-wrap .team-content .plus_team i:hover,
                .team-grid-style8.color_secondary_scheme .team-inner-wrap .image-wrap .plus_team i.ri-share-line,
                .team-grid-style8.color_secondary_scheme .team-inner-wrap .image-wrap .plus_team .social-icons1 .social-icon:hover,
                .team-grid-style7.color_primary_scheme .team-item .team-inner-wrap .team-content,
                .rs-team-slider.team-slider-style9.color_secondary_scheme .plus_team i.ri-share-line,
                .rs-team-slider.team-slider-style9.color_secondary_scheme .plus_team .social-icons1 i:hover,
                .team-grid-style7.color_secondary_scheme .team-item.reverse_team .team-inner-wrap .team-content .plus_team i.ri-share-line,
                .team-grid-style7.color_secondary_scheme .team-item.reverse_team .team-inner-wrap .team-content .plus_team .social-icons1 .social-icon:hover {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Team End */

            /* Portfolio Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rs-portfolio-style9.color_secondary_scheme .portfolio-filter button:hover,
                .rs-portfolio-style9.color_secondary_scheme .portfolio-filter button.active,
                .rs-isotope-portfolio.color_primary_scheme .filters ul li,
                .rs-isotope-portfolio.color_secondary_scheme .filters ul li:hover,
                .rs-isotope-portfolio.color_secondary_scheme .filters ul li.is-checked {
                    background: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Portfolio End */

            /* Testimonial Slider Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .testimonial-style4.color_secondary_scheme .testimonial-item {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .testimonial-style4.color_primary_scheme .testimonial-item .testimonial-informations .testimonial-name {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Testimonial Slider End */

            /* Advance Tab Start */
            <?php if(!empty(get_theme_mod('fixhero_style_secondaer_color'))) : ?>
                .rstab-main.color_secondary_scheme .window-tab-content-list-wrapper .window-tab-content-list li::before,
                .rstab-main.color_secondary_scheme .tab-menu-wrapper .nav-tabs .nav-link:hover,
                .rstab-main.color_secondary_scheme .tab-menu-wrapper .nav-tabs .nav-link.active {
                    background-color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
                .rstab-main.color_secondary_scheme .content--teb-area .content--left-area .rs-btn a:hover {
                    color: <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_secondaer_color')); ?>;
                }
            <?php endif; ?>
            /* Advance Tab End */
        /* End Dynamic Style for Secondary Color */


        /* Start Dynamic Style for Gradient Color */
        <?php if(!empty(get_theme_mod('fixhero_style_gradient_color'))) { ?>
            /* Normal */
            .gradient-bg,
            .gradient-bg-child > div,
            .rs-btn.gradient_bg_color a.rs_button,
            .color_gradient_scheme .title-inner .sub-text,
            .rs-features-list-content.color_gradient_scheme .list-feature-image img,
            .rs-contact-box.color_gradient_scheme .address-icon,
            .rs-video.color_gradient_scheme .popup-videos,
            .rs-addon-services-tab.color_gradient_scheme .services-tab-inner.active:before,
            .rs-services-slider.color_gradient_scheme.service-style-2 .rs-service-slider .rs-step-icon,
            .prelements-heading.style2.color_gradient_scheme .pre-heading-line1:after,
            .prelements-heading.style2.color_gradient_scheme .pre-heading-line1:before,
            .rs-team-slider.team-slider-style9.color_gradient_scheme .plus_team i.ri-share-line,
            .rs-team-slider.team-slider-style9.color_gradient_scheme .plus_team .social-icons1 i,
            .rs-price-table.color_gradient_scheme.style-1 .rs-pricing-table-btn,
            .rs-accordion-area.gradient_scheme .accordion-item .accordion-header .accordion-button > span,
            .rs-team-grid.team-grid-style2.color_gradient_scheme .team-inner-wrap .team-content,
            .rs-price-table-slider.color_gradient_scheme .pricing-wrapper .btn-part a,
            .rs-breadcrumbs-meta-elementor,
            .bs-sidebar .widget_categories#categories-2 ul li:hover,
            .rs-blog-details .bs-info.tags a,
            .btm-cate,
            .bs-sidebar .tagcloud a:hover,
            .bs-sidebar .widget_search button,
            .bs-sidebar .bs-search button,
            .comment-respond .form-submit #submit,
            .team-grid-style4.color_gradient_scheme .team-item .team-content,
            .fluentform-widget-wrapper.color_gradient_scheme .frm-fluent-form .ff-btn-submit,
            .rs-services-slider.color_gradient_scheme.service-style-2 .service-title-holder .read__more a:hover,
            #scrollUp i,
            .rs-video.color_gradient_scheme .popup-videos:before,
            .rs-services-slider.service-style-3.color_gradient_scheme .service-title-holder:after {
                background: linear-gradient(90deg, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> 0%, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_gradient_color')); ?> 100%);
            }

            /* Hover */
            .rs-btn.gradient_bg_color a.rs_button:hover,
            #scrollUp i:hover,
            .elementor-widget-container:hover .prelements-heading.style2.color_gradient_scheme .pre-heading-line1:before,
            .elementor-widget-container:hover .prelements-heading.style2.color_gradient_scheme .pre-heading-line1:after,
            .rs-price-table-slider.color_gradient_scheme .pricing-wrapper .btn-part a:hover,
            .rs-price-table.color_gradient_scheme.style-1 .rs-pricing-table-btn:hover,
            .comment-respond .form-submit #submit:hover,
            .bs-sidebar .widget_search button:hover,
            .bs-sidebar .bs-search button:hover,
            .rs-blog-details .bs-info.tags a:hover,
            .rs-team-slider.team-slider-style9.color_gradient_scheme .plus_team .social-icons1 i:hover,
            .fluentform-widget-wrapper.color_gradient_scheme .frm-fluent-form .ff-btn-submit:hover {
                background: linear-gradient(90deg, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_gradient_color')); ?> 0%, <?php echo sanitize_hex_color(get_theme_mod('fixhero_style_primary_color')); ?> 100%);
            }
        <?php } ?>
        /* End Dynamic Style for Gradient Color */

    </style>

    <?php 
    if(!empty(get_theme_mod('fixhero_custom_font_file'))){
        $custom_font_file_path = get_theme_mod('fixhero_custom_font_file');
        $custom_font_info = pathinfo($custom_font_file_path);
        $custom_font_file_name = $custom_font_info['filename'];
        $custom_font_file_name = str_replace('-', '', $custom_font_file_name);
        ?>
        <style>

            <?php if(!empty(get_theme_mod('fixhero_custom_font_file'))){ ?>           
                @font-face {
                    font-family: '<?php echo esc_attr($custom_font_file_name); ?>';
                    src: url('<?php echo esc_url(get_theme_mod('fixhero_custom_font_file')); ?>');
                }
            <?php } ?>

            <?php if(!empty(get_theme_mod('fixhero_custom_font_file'))){ ?>           
                body{
                    font-family: '<?php echo esc_attr($custom_font_file_name); ?>', sans-serif;
                }
            <?php } ?>

            <?php if(!empty(get_theme_mod('fixhero_custom_body_font_weight'))){ ?>
                body, 
                html{
                    font-weight:<?php echo esc_attr( get_theme_mod('fixhero_custom_body_font_weight') ); ?>
                }
            <?php } ?>

        </style>
    <?php }

    if(!empty(get_theme_mod('fixhero_title_custom_font_file'))){
        $headeing_custom_font_file_path = get_theme_mod('fixhero_title_custom_font_file');
        $heading_custom_font_info = pathinfo($headeing_custom_font_file_path);
        $heading_custom_font_file_name = $heading_custom_font_info['filename'];
        $heading_custom_font_file_name = str_replace('-', '', $heading_custom_font_file_name);
        ?>
        <style>

            <?php if(!empty(get_theme_mod('fixhero_title_custom_font_file'))){ ?>           
                @font-face {
                    font-family: '<?php echo esc_attr($heading_custom_font_file_name); ?>';
                    src: url('<?php echo esc_url(get_theme_mod('fixhero_title_custom_font_file')); ?>');
                }
            <?php } ?>

            <?php if(!empty(get_theme_mod('fixhero_title_custom_font_file'))){ ?>           
                h1, h2, h3, h4, h5, h6{
                    font-family: '<?php echo esc_attr($heading_custom_font_file_name); ?>', sans-serif !important;
                }
            <?php } ?>

            <?php if(!empty(get_theme_mod('fixhero_custom_title_font_weight'))){ ?>
                h1, h2, h3, h4, h5, h6{
                    font-weight:<?php echo esc_attr( get_theme_mod('fixhero_custom_title_font_weight') ); ?> !important;
                }
            <?php } ?>

        </style>
    <?php }
}