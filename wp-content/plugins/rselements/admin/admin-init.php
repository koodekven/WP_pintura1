<?php

class RS_Elements_Addon_Control
{

    private $rselements_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'rselements_add_plugin_page'));
        add_action('admin_init', array($this, 'rselements_page_init'));
        add_action('admin_enqueue_scripts', array($this, 'rselements_admin_scripts'));
    }

    public function rselements_admin_scripts()
    {
        wp_register_style('rselements-admin-styles', RSADDON_DIR_URL_PRO . 'admin/assets/css/rselements-admin.css', array(), null);
        wp_enqueue_style('rselements-admin-styles');
    }


    public function rselements_add_plugin_page()
    {
        add_menu_page(
            'RS Elements Setting',
            'RS Elements',
            'manage_options',
            'rselements-addon-settings',
            array($this, 'rselements_create_admin_page'),
            'dashicons-xing',
            6
        );
    }

    /**
     *
     */
    public function rselements_create_admin_page()
    {
        $this->rselements_options = get_option('rselements_addon_option');


?>
        <div class="wrap">
            <form class="rselements-form" method="post" action="options.php">
                <?php
                settings_fields('rselements_addon_group');
                do_settings_sections('rselements-addon-field');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }


    public function rselements_page_init()
    {

        /**
         * Sanitize callback
         */
        register_setting(
            'rselements_addon_group',
            'rselements_addon_option',
            array($this, 'rselements_sanitize')
        );

        add_settings_section(
            'rselements_post_type_section_field_id',
            esc_html__('Active Custom Post', 'rsaddon'),
            array($this, 'rselements_section_info'),
            'rselements-addon-field'
        );

        add_settings_section(
            'rselements_section_field_id',
            esc_html__('Deactivate elements for better performance', 'rsaddon'),
            array($this, 'rselements_section_info'),
            'rselements-addon-field'
        );

        /**
         * Team
         */
        add_settings_field(
            'rs_team_post',
            esc_html__('Teams', 'rsaddon'),
            array($this, 'rselements_team_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Portfolio
         */
        add_settings_field(
            'rs_portfolio_post',
            esc_html__('Portfolio', 'rsaddon'),
            array($this, 'rselements_portfolio_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Testimonials
         */
        add_settings_field(
            'rs_testimonials_post',
            esc_html__('Testimonials', 'rsaddon'),
            array($this, 'rselements_testimonials_setting'),
            'rselements-addon-field',
            'rselements_post_type_section_field_id',
            array('class' => 'rselements_addon_field')
        );


        /**
         * Heading addon control
         */
        add_settings_field(
            'rs_heading',
            esc_html__('RS Heading', 'rsaddon'),
            array($this, 'rselements_heading_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Img Comparison addon control
         */
        add_settings_field(
            'rs_img_comparison',
            esc_html__('RS Image Comparison', 'rsaddon'),
            array($this, 'rselements_img_comparison_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Animated heading control
         */
        add_settings_field(
            'rs_animated_heading',
            esc_html__('RS Animated Heading', 'rsaddon'),
            array($this, 'rselements_animated_heading_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Team Grid control
         */
        add_settings_field(
            'rs_team_gread',
            esc_html__('RS Team Grid', 'rsaddon'),
            array($this, 'rselements_team_gread_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Full Width Slider control
         */
        add_settings_field(
            'rs_full_width_slider',
            esc_html__('RS Full Width Slider', 'rsaddon'),
            array($this, 'rselements_full_width_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Full Width Slider control
         */
        add_settings_field(
            'rs_team_slider',
            esc_html__('RS Team Slider', 'rsaddon'),
            array($this, 'rselements_team_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Grid
         */
        add_settings_field(
            'rs_portfolio_grid',
            esc_html__('RS Portfolio Grid', 'rsaddon'),
            array($this, 'rselements_portfolio_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Filter
         */
        add_settings_field(
            'rs_portfolio_filter',
            esc_html__('RS Portfolio Filter', 'rsaddon'),
            array($this, 'rselements_portfolio_filter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Portfolio Slider
         */
        add_settings_field(
            'rs_portfolio_slider',
            esc_html__('RS Portfolio Slider', 'rsaddon'),
            array($this, 'rselements_portfolio_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Counter
         */
        add_settings_field(
            'rs_counter',
            esc_html__('RS Counter', 'rsaddon'),
            array($this, 'rselements_counter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Cost Calculator
         */
        add_settings_field(
            'rs_cost_calculator',
            esc_html__('RS Cost Calculator', 'rsaddon'),
            array($this, 'rselements_cost_calculator_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Services Grid
         */
        add_settings_field(
            'rs_service_grid',
            esc_html__('RS Services Grid', 'rsaddon'),
            array($this, 'rselements_service_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Services Slider
         */
        add_settings_field(
            'rs_service_slider',
            esc_html__('RS Services Slider', 'rsaddon'),
            array($this, 'rselements_service_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Video
         */
        add_settings_field(
            'rs_video',
            esc_html__('RS Video', 'rsaddon'),
            array($this, 'rselements_video_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Pricing Table
         */
        add_settings_field(
            'rs_pricing_table',
            esc_html__('RS Pricing Table', 'rsaddon'),
            array($this, 'rselements_pricing_table_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Pricing Table Slider
         */
        add_settings_field(
            'rs_pricing_table_slider',
            esc_html__('RS Pricing Table Slider', 'rsaddon'),
            array($this, 'rselements_pricing_table_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Pricing Switcher
         */
        add_settings_field(
            'rs_pricing_switcher',
            esc_html__('RS Pricing Switcher', 'rsaddon'),
            array($this, 'rselements_pricing_switcher_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Button
         */
        add_settings_field(
            'rs_button',
            esc_html__('RS Button', 'rsaddon'),
            array($this, 'rselements_button_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Logo Showcase
         */
        add_settings_field(
            'rs_logo_showcase',
            esc_html__('RS Logo Showcase', 'rsaddon'),
            array($this, 'rselements_logo_showcase_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * CTA
         */
        add_settings_field(
            'rs_cta',
            esc_html__('RS CTA', 'rsaddon'),
            array($this, 'rselements_cta_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Testimonial Grid
         */
        add_settings_field(
            'rs_testimonial_grid',
            esc_html__('RS Testimonial Grid', 'rsaddon'),
            array($this, 'rselements_testimonial_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Testimonial Slider
         */
        add_settings_field(
            'rs_testimonial_slider',
            esc_html__('RS Testimonial Slider', 'rsaddon'),
            array($this, 'rselements_testimonial_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Testimonial Slider Two
         */
        add_settings_field(
            'rs_testimonial_slider_two',
            esc_html__('RS Testimonial Slider Two', 'rsaddon'),
            array($this, 'rselements_testimonial_slider_two_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Flip Box
         */
        add_settings_field(
            'rs_flip_box',
            esc_html__('RS Flip Box', 'rsaddon'),
            array($this, 'rselements_flip_box_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Tab
         */
        add_settings_field(
            'rs_tab',
            esc_html__('RS Tab', 'rsaddon'),
            array($this, 'rselements_tab_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Advance Tab
         */
        add_settings_field(
            'rs_advance_tab',
            esc_html__('RS Advance Tab', 'rsaddon'),
            array($this, 'rselements_advance_tab_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Icon Box
         */
        add_settings_field(
            'rs_icon_box',
            esc_html__('RS Icon Box', 'rsaddon'),
            array($this, 'rselements_icon_box_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Blog Grid
         */
        add_settings_field(
            'rs_blog_grid',
            esc_html__('RS Blog Grid', 'rsaddon'),
            array($this, 'rselements_blog_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Blog Slider
         */
        add_settings_field(
            'rs_blog_slider',
            esc_html__('RS Blog Slider', 'rsaddon'),
            array($this, 'rselements_blog_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Number Grid
         */
        add_settings_field(
            'rs_number_grid',
            esc_html__('RS Number Grid', 'rsaddon'),
            array($this, 'rselements_number_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Fluent Form
         */
        add_settings_field(
            'rs_fluent_form',
            esc_html__('RS Fluent Form', 'rsaddon'),
            array($this, 'rselements_fluent_form_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Progress Bar
         */
        add_settings_field(
            'rs_progress_bar',
            esc_html__('RS Progress Bar', 'rsaddon'),
            array($this, 'rselements_progress_bar_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Progress Pie
         */
        add_settings_field(
            'rs_progress_pie',
            esc_html__('RS Progress Pie', 'rsaddon'),
            array($this, 'rselements_progress_pie_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );


        /**
         * Contact Box
         */
        add_settings_field(
            'rs_contact_box',
            esc_html__('RS Contact Box', 'rsaddon'),
            array($this, 'rselements_contact_box_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Tooltip
         */
        add_settings_field(
            'rs_tooltip',
            esc_html__('RS Tooltip', 'rsaddon'),
            array($this, 'rselements_tooltip_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Static Product
         */
        add_settings_field(
            'rs_static_product',
            esc_html__('RS Static Product', 'rsaddon'),
            array($this, 'rselements_static_product_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * FAQ
         */
        add_settings_field(
            'rs_faq',
            esc_html__('RS FAQ', 'rsaddon'),
            array($this, 'rselements_faq_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Image Showcase
         */
        add_settings_field(
            'rs_image_showcase',
            esc_html__('RS Image Showcase', 'rsaddon'),
            array($this, 'rselements_image_showcase_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Circle Service
         */
        add_settings_field(
            'rs_circle_service',
            esc_html__('RS Circle Service', 'rsaddon'),
            array($this, 'rselements_circle_service_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Image Hover Effect
         */
        add_settings_field(
            'rs_image_hover_effect',
            esc_html__('RS Image Hover Effect', 'rsaddon'),
            array($this, 'rselements_image_hover_effect_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Features List
         */
        add_settings_field(
            'rs_features_list',
            esc_html__('RS Features List', 'rsaddon'),
            array($this, 'rselements_features_list_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Brochures 
         */
        add_settings_field(
            'rs_brochures',
            esc_html__('RS Brochures', 'rsaddon'),
            array($this, 'rselements_brochures_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Dual Button
         */
        add_settings_field(
            'rs_dual_button',
            esc_html__('RS Dual Button', 'rsaddon'),
            array($this, 'rselements_dual_button_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Image Parallax
         */
        add_settings_field(
            'rs_image_parallax',
            esc_html__('RS Image Parallax', 'rsaddon'),
            array($this, 'rselements_image_parallax_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Image Animation Shape
         */
        add_settings_field(
            'rs_image_animation_shape',
            esc_html__('RS Image Animation Shape', 'rsaddon'),
            array($this, 'rselements_image_animation_shape_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Breadcrumb
         */
        add_settings_field(
            'rs_breadcrumb',
            esc_html__('RS Breadcrumb', 'rsaddon'),
            array($this, 'rselements_breadcrumb_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Accordion
         */
        add_settings_field(
            'rs_accordion',
            esc_html__('RS Accordion', 'rsaddon'),
            array($this, 'rselements_accordion_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
        /**
         * Newsletter
         */
        add_settings_field(
            'rs_newsletter',
            esc_html__('RS Newsletter', 'rsaddon'),
            array($this, 'rselements_newsletter_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Hover Tab
         */
        add_settings_field(
            'rs_hover_tab',
            esc_html__('RS Hover Tab', 'rsaddon'),
            array($this, 'rselements_hover_tab_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * App ScreenSlider
         */
        add_settings_field(
            'rs_app_screen_slider',
            esc_html__('RS Apps Screeen Slider', 'rsaddon'),
            array($this, 'rselements_screenslider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * roadmap slider
         */
        add_settings_field(
            'rs_roadmap_slider',
            esc_html__('RS Roadmap Slider', 'rsaddon'),
            array($this, 'rselements_roadmap_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Latest Blog Grid
         */
        add_settings_field(
            'rs_latest_blog_grid',
            esc_html__('RS Latest Blog Grid', 'rsaddon'),
            array($this, 'rselements_latest_blog_grid_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Latest Blog Slider
         */
        add_settings_field(
            'rs_latest_blog_sliders',
            esc_html__('RS Latest Blog Slider', 'rsaddon'),
            array($this, 'rs_latest_blog_sliders_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Post Navigation
         */
        add_settings_field(
            'rs_post_navigation',
            esc_html__('RS Post Navigation', 'rsaddon'),
            array($this, 'rs_post_navigation_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * Post Navigation
         */
        add_settings_field(
            'rs_step_flow',
            esc_html__('RS Step Flow', 'rsaddon'),
            array($this, 'rs_step_flow_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * marquee slider
         */
        add_settings_field(
            'rs_marquee_slider',
            esc_html__('RS Marquee Slider', 'rsaddon'),
            array($this, 'rs_marquee_slider_setting'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * marquee logo text slider
         */
        add_settings_field(
            'rs_marquee_logo_text_slider',
            esc_html__('Marquee Logo & Text Slider', 'rsaddon'),
            array($this, 'rs_marquee_logo_text_slider_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * marquee logo text slider
         */
        add_settings_field(
            'rs_services_filter',
            esc_html__('RS Service Filter', 'rsaddon'),
            array($this, 'rs_services_filter_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Pricing list 
         */
        add_settings_field(
            'rs_pricing_list',
            esc_html__('RS Pricing List', 'rsaddon'),
            array($this, 'rs_pricing_list_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Isotope Filter
         */
        add_settings_field(
            'rs_isotope_filter',
            esc_html__('RS Isotope Filter', 'rsaddon'),
            array($this, 'rs_isotope_filter_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Service List
         */
        add_settings_field(
            'rs_services_list',
            esc_html__('RS Service List', 'rsaddon'),
            array($this, 'rs_services_list_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Service Search
         */
        add_settings_field(
            'rs_services_search',
            esc_html__('RS Service Search', 'rsaddon'),
            array($this, 'rs_services_search_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Fluent Forms Custom
         */
        add_settings_field(
            'rs_fluent_form_custom',
            esc_html__('RS Fluent Forms Custom', 'rsaddon'),
            array($this, 'rs_fluent_form_custom_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS hotspots showcase
         */
        add_settings_field(
            'rs_hotspots_showcase',
            esc_html__('RS Hotspot Showcase', 'rsaddon'),
            array($this, 'rs_hotspots_showcase_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

        /**
         * RS Social Icon
         */
        add_settings_field(
            'rs_social_icon',
            esc_html__('RS Social Icon', 'rsaddon'),
            array($this, 'rs_social_icon_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

         /**
         * RS Service Tab
         */
        add_settings_field(
            'rs_service_tab',
            esc_html__('RS Service Repeater', 'rsaddon'),
            array($this, 'rs_service_tab_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );

         /**
         * RS Header offcanvas
         */
        add_settings_field(
            'rs_header_offcanvas',
            esc_html__('RS Header Offcanvas', 'rsaddon'),
            array($this, 'rs_header_offcanvas_settings'),
            'rselements-addon-field',
            'rselements_section_field_id',
            array('class' => 'rselements_addon_field')
        );
    }

    /**
     * Sanitize all form
     */
    public function rselements_sanitize($input_addon)
    {
        $rs_addon_arg = array();


        // rs Header Offcanvas
        if (isset($input_addon['rs_header_offcanvas_settings'])) {
            $rs_addon_arg['rs_header_offcanvas_settings'] = sanitize_text_field($input_addon['rs_header_offcanvas_settings']);
        }

        // rs Service Tab
        if (isset($input_addon['rs_service_tab_settings'])) {
            $rs_addon_arg['rs_service_tab_settings'] = sanitize_text_field($input_addon['rs_service_tab_settings']);
        }

        // rs social icon
        if (isset($input_addon['rs_social_icon_settings'])) {
            $rs_addon_arg['rs_social_icon_settings'] = sanitize_text_field($input_addon['rs_social_icon_settings']);
        }
        //Team
        if (isset($input_addon['rs_team_post'])) {
            $rs_addon_arg['rs_team_post'] = sanitize_text_field($input_addon['rs_team_post']);
        }
        //Portfolio
        if (isset($input_addon['rs_portfolio_post'])) {
            $rs_addon_arg['rs_portfolio_post'] = sanitize_text_field($input_addon['rs_portfolio_post']);
        }
        //Testimonials
        if (isset($input_addon['rs_testimonials_post'])) {
            $rs_addon_arg['rs_testimonials_post'] = sanitize_text_field($input_addon['rs_testimonials_post']);
        }
        //Heading
        if (isset($input_addon['rs_heading_setting'])) {
            $rs_addon_arg['rs_heading_setting'] = sanitize_text_field($input_addon['rs_heading_setting']);
        }
        // Img Comparison
        if (isset($input_addon['rs_img_comparison_setting'])) {
            $rs_addon_arg['rs_img_comparison_setting'] = sanitize_text_field($input_addon['rs_img_comparison_setting']);
        }
        //Animated Heading
        if (isset($input_addon['rs_animated_heading_setting'])) {
            $rs_addon_arg['rs_animated_heading_setting'] = sanitize_text_field($input_addon['rs_animated_heading_setting']);
        }
        //Team Grid
        if (isset($input_addon['rs_team_gread_setting'])) {
            $rs_addon_arg['rs_team_gread_setting'] = sanitize_text_field($input_addon['rs_team_gread_setting']);
        }
        //Full Width Slider
        if (isset($input_addon['rs_full_width_slider_setting'])) {
            $rs_addon_arg['rs_full_width_slider_setting'] = sanitize_text_field($input_addon['rs_full_width_slider_setting']);
        }
        //Team Slider
        if (isset($input_addon['rs_team_slider_setting'])) {
            $rs_addon_arg['rs_team_slider_setting'] = sanitize_text_field($input_addon['rs_team_slider_setting']);
        }
        //Portfolio Grid 
        if (isset($input_addon['rs_portfolio_grid_setting'])) {
            $rs_addon_arg['rs_portfolio_grid_setting'] = sanitize_text_field($input_addon['rs_portfolio_grid_setting']);
        }
        //Portfolio Filter 
        if (isset($input_addon['rs_portfolio_filter_setting'])) {
            $rs_addon_arg['rs_portfolio_filter_setting'] = sanitize_text_field($input_addon['rs_portfolio_filter_setting']);
        }
        //Portfolio Slider 
        if (isset($input_addon['rs_portfolio_slider_setting'])) {
            $rs_addon_arg['rs_portfolio_slider_setting'] = sanitize_text_field($input_addon['rs_portfolio_slider_setting']);
        }
        //Counter 
        if (isset($input_addon['rs_counter_setting'])) {
            $rs_addon_arg['rs_counter_setting'] = sanitize_text_field($input_addon['rs_counter_setting']);
        }
        //Cost Calculator 
        if (isset($input_addon['rs_cost_calculator_setting'])) {
            $rs_addon_arg['rs_cost_calculator_setting'] = sanitize_text_field($input_addon['rs_cost_calculator_setting']);
        }
        //Services Grid 
        if (isset($input_addon['rs_service_grid_setting'])) {
            $rs_addon_arg['rs_service_grid_setting'] = sanitize_text_field($input_addon['rs_service_grid_setting']);
        }
        //Services Slider 
        if (isset($input_addon['rs_service_slider_setting'])) {
            $rs_addon_arg['rs_service_slider_setting'] = sanitize_text_field($input_addon['rs_service_slider_setting']);
        }
        //Video 
        if (isset($input_addon['rs_video_setting'])) {
            $rs_addon_arg['rs_video_setting'] = sanitize_text_field($input_addon['rs_video_setting']);
        }
        //Pricing Table 
        if (isset($input_addon['rs_pricing_table_setting'])) {
            $rs_addon_arg['rs_pricing_table_setting'] = sanitize_text_field($input_addon['rs_pricing_table_setting']);
        }
        //Pricing Table Slider
        if (isset($input_addon['rs_pricing_table_slider_setting'])) {
            $rs_addon_arg['rs_pricing_table_slider_setting'] = sanitize_text_field($input_addon['rs_pricing_table_slider_setting']);
        }
        //Pricing Switcher 
        if (isset($input_addon['rs_pricing_switcher_setting'])) {
            $rs_addon_arg['rs_pricing_switcher_setting'] = sanitize_text_field($input_addon['rs_pricing_switcher_setting']);
        }
        //Button
        if (isset($input_addon['rs_button_setting'])) {
            $rs_addon_arg['rs_button_setting'] = sanitize_text_field($input_addon['rs_button_setting']);
        }
        //Logo Showcase
        if (isset($input_addon['rs_logo_showcase_setting'])) {
            $rs_addon_arg['rs_logo_showcase_setting'] = sanitize_text_field($input_addon['rs_logo_showcase_setting']);
        }
        //CTA
        if (isset($input_addon['rs_cta_setting'])) {
            $rs_addon_arg['rs_cta_setting'] = sanitize_text_field($input_addon['rs_cta_setting']);
        }
        //Testimonial Grid
        if (isset($input_addon['rs_testimonial_grid_setting'])) {
            $rs_addon_arg['rs_testimonial_grid_setting'] = sanitize_text_field($input_addon['rs_testimonial_grid_setting']);
        }
        //Testimonial Slider
        if (isset($input_addon['rs_testimonial_slider_setting'])) {
            $rs_addon_arg['rs_testimonial_slider_setting'] = sanitize_text_field($input_addon['rs_testimonial_slider_setting']);
        }
        //Testimonial Slider Two
        if (isset($input_addon['rs_testimonial_slider_two_setting'])) {
            $rs_addon_arg['rs_testimonial_slider_two_setting'] = sanitize_text_field($input_addon['rs_testimonial_slider_two_setting']);
        }
        //Flip Box
        if (isset($input_addon['rs_flip_box_setting'])) {
            $rs_addon_arg['rs_flip_box_setting'] = sanitize_text_field($input_addon['rs_flip_box_setting']);
        }
        //Tab
        if (isset($input_addon['rs_tab_setting'])) {
            $rs_addon_arg['rs_tab_setting'] = sanitize_text_field($input_addon['rs_tab_setting']);
        }
        //Advance Tab
        if (isset($input_addon['rs_advance_tab_setting'])) {
            $rs_addon_arg['rs_advance_tab_setting'] = sanitize_text_field($input_addon['rs_advance_tab_setting']);
        }
        //Icon Box
        if (isset($input_addon['rs_icon_box_setting'])) {
            $rs_addon_arg['rs_icon_box_setting'] = sanitize_text_field($input_addon['rs_icon_box_setting']);
        }
        //Blog Grid
        if (isset($input_addon['rs_blog_grid_setting'])) {
            $rs_addon_arg['rs_blog_grid_setting'] = sanitize_text_field($input_addon['rs_blog_grid_setting']);
        }
        //Blog Slider
        if (isset($input_addon['rs_blog_slider_setting'])) {
            $rs_addon_arg['rs_blog_slider_setting'] = sanitize_text_field($input_addon['rs_blog_slider_setting']);
        }
        //Number Grid
        if (isset($input_addon['rs_number_grid_setting'])) {
            $rs_addon_arg['rs_number_grid_setting'] = sanitize_text_field($input_addon['rs_number_grid_setting']);
        }
        //Fluent Form
        if (isset($input_addon['rs_fluent_form_setting'])) {
            $rs_addon_arg['rs_fluent_form_setting'] = sanitize_text_field($input_addon['rs_fluent_form_setting']);
        }
        //Progress Bar
        if (isset($input_addon['rs_progress_bar_setting'])) {
            $rs_addon_arg['rs_progress_bar_setting'] = sanitize_text_field($input_addon['rs_progress_bar_setting']);
        }
        //Progress Pie
        if (isset($input_addon['rs_progress_pie_setting'])) {
            $rs_addon_arg['rs_progress_pie_setting'] = sanitize_text_field($input_addon['rs_progress_pie_setting']);
        }
        //Contact Box
        if (isset($input_addon['rs_contact_box_setting'])) {
            $rs_addon_arg['rs_contact_box_setting'] = sanitize_text_field($input_addon['rs_contact_box_setting']);
        }
        //Tooltip
        if (isset($input_addon['rs_tooltip_setting'])) {
            $rs_addon_arg['rs_tooltip_setting'] = sanitize_text_field($input_addon['rs_tooltip_setting']);
        }
        //Static Product
        if (isset($input_addon['rs_static_product_setting'])) {
            $rs_addon_arg['rs_static_product_setting'] = sanitize_text_field($input_addon['rs_static_product_setting']);
        }
        //FAQ
        if (isset($input_addon['rs_faq_setting'])) {
            $rs_addon_arg['rs_faq_setting'] = sanitize_text_field($input_addon['rs_faq_setting']);
        }
        //Image Showcase
        if (isset($input_addon['rs_image_showcase_setting'])) {
            $rs_addon_arg['rs_image_showcase_setting'] = sanitize_text_field($input_addon['rs_image_showcase_setting']);
        }
        //Circle Service
        if (isset($input_addon['rs_circle_service_setting'])) {
            $rs_addon_arg['rs_circle_service_setting'] = sanitize_text_field($input_addon['rs_circle_service_setting']);
        }
        //Image Hover Effect
        if (isset($input_addon['rs_image_hover_effect_setting'])) {
            $rs_addon_arg['rs_image_hover_effect_setting'] = sanitize_text_field($input_addon['rs_image_hover_effect_setting']);
        }
        //Features List
        if (isset($input_addon['rs_features_list_setting'])) {
            $rs_addon_arg['rs_features_list_setting'] = sanitize_text_field($input_addon['rs_features_list_setting']);
        }
        //Brochures
        if (isset($input_addon['rs_brochures_setting'])) {
            $rs_addon_arg['rs_brochures_setting'] = sanitize_text_field($input_addon['rs_brochures_setting']);
        }
        //Dual Button
        if (isset($input_addon['rs_dual_button_setting'])) {
            $rs_addon_arg['rs_dual_button_setting'] = sanitize_text_field($input_addon['rs_dual_button_setting']);
        }
        //Image Parallax
        if (isset($input_addon['rs_image_parallax_setting'])) {
            $rs_addon_arg['rs_image_parallax_setting'] = sanitize_text_field($input_addon['rs_image_parallax_setting']);
        }
        //Image Animation Shape
        if (isset($input_addon['rs_image_animation_shape_setting'])) {
            $rs_addon_arg['rs_image_animation_shape_setting'] = sanitize_text_field($input_addon['rs_image_animation_shape_setting']);
        }
        //Breadcrumb
        if (isset($input_addon['rs_breadcrumb_setting'])) {
            $rs_addon_arg['rs_breadcrumb_setting'] = sanitize_text_field($input_addon['rs_breadcrumb_setting']);
        }
        //Accordion
        if (isset($input_addon['rs_accordion_setting'])) {
            $rs_addon_arg['rs_accordion_setting'] = sanitize_text_field($input_addon['rs_accordion_setting']);
        }
        //Newsletter
        if (isset($input_addon['rs_newsletter_setting'])) {
            $rs_addon_arg['rs_newsletter_setting'] = sanitize_text_field($input_addon['rs_newsletter_setting']);
        }
        //Hover Tab
        if (isset($input_addon['rs_hover_tab_setting'])) {
            $rs_addon_arg['rs_hover_tab_setting'] = sanitize_text_field($input_addon['rs_hover_tab_setting']);
        }

        //Hover Tab
        if (isset($input_addon['rs_screen_slider_setting'])) {
            $rs_addon_arg['rs_screen_slider_setting'] = sanitize_text_field($input_addon['rs_screen_slider_setting']);
        }

        //roadmap slider
        if (isset($input_addon['rs_roadmap_slider_setting'])) {
            $rs_addon_arg['rs_roadmap_slider_setting'] = sanitize_text_field($input_addon['rs_roadmap_slider_setting']);
        }

        //Latest Blog Grid
        if (isset($input_addon['rs_latest_blog_grid_setting'])) {
            $rs_addon_arg['rs_latest_blog_grid_setting'] = sanitize_text_field($input_addon['rs_latest_blog_grid_setting']);
        }

        //Latest Blog Slider
        if (isset($input_addon['rs_latest_blog_slider_setting'])) {
            $rs_addon_arg['rs_latest_blog_slider_setting'] = sanitize_text_field($input_addon['rs_latest_blog_slider_setting']);
        }

        //Post Navigation
        if (isset($input_addon['rs_post_navigation_setting'])) {
            $rs_addon_arg['rs_post_navigation_setting'] = sanitize_text_field($input_addon['rs_post_navigation_setting']);
        }

        // step flow widget

        if (isset($input_addon['rs_step_flow_setting'])) {
            $rs_addon_arg['rs_step_flow_setting'] = sanitize_text_field($input_addon['rs_step_flow_setting']);
        }

        // step flow widget

        if (isset($input_addon['rs_marquee_slider_setting'])) {
            $rs_addon_arg['rs_marquee_slider_setting'] = sanitize_text_field($input_addon['rs_marquee_slider_setting']);
        }

        // marquee logo text slider
        if (isset($input_addon['rs_marquee_logo_text_slider_settings'])) {
            $rs_addon_arg['rs_marquee_logo_text_slider_settings'] = sanitize_text_field($input_addon['rs_marquee_logo_text_slider_settings']);
        }

        // rs services tab
        if (isset($input_addon['rs_services_filter_settings'])) {
            $rs_addon_arg['rs_services_filter_settings'] = sanitize_text_field($input_addon['rs_services_filter_settings']);
        }

        // rs pricing list
        if (isset($input_addon['rs_pricing_list_settings'])) {
            $rs_addon_arg['rs_pricing_list_settings'] = sanitize_text_field($input_addon['rs_pricing_list_settings']);
        }

        // rs isotope filter
        if (isset($input_addon['rs_isotope_filter_settings'])) {
            $rs_addon_arg['rs_isotope_filter_settings'] = sanitize_text_field($input_addon['rs_isotope_filter_settings']);
        }

        // rs services list
        if (isset($input_addon['rs_services_list_settings'])) {
            $rs_addon_arg['rs_services_list_settings'] = sanitize_text_field($input_addon['rs_services_list_settings']);
        }

        // rs services search
        if (isset($input_addon['rs_services_search_settings'])) {
            $rs_addon_arg['rs_services_search_settings'] = sanitize_text_field($input_addon['rs_services_search_settings']);
        }

        // rs fluent form custom
        if (isset($input_addon['rs_fluent_form_custom_settings'])) {
            $rs_addon_arg['rs_fluent_form_custom_settings'] = sanitize_text_field($input_addon['rs_fluent_form_custom_settings']);
        }

        // rs hotspots showcase settings
        if (isset($input_addon['rs_hotspots_showcase_settings'])) {
            $rs_addon_arg['rs_hotspots_showcase_settings'] = sanitize_text_field($input_addon['rs_hotspots_showcase_settings']);
        }




        return $rs_addon_arg;
    }

    /**
     * Print the Section text
     */
    public function rselements_section_info()
    {
        //print 'Enter your settings below:';
    }

    

    /**
     * rs header offcanvas settings
     */
    public function rs_header_offcanvas_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_header_offcanvas_settings]" id="rs_header_offcanvas_settings" value="rs_header_offcanvas" %s/>',
                (isset($this->rselements_options['rs_header_offcanvas_settings']) && $this->rselements_options['rs_header_offcanvas_settings']) == 'rs_header_offcanvas' ? 'checked' : ''
            );
            ?>
            <label for="rs_header_offcanvas_settings"></label>
        </div>
    <?php
    }


    /**
     * rs service tab settings
     */
    public function rs_service_tab_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_tab_settings]" id="rs_service_tab_settings" value="rs_service_tab" %s/>',
                (isset($this->rselements_options['rs_service_tab_settings']) && $this->rselements_options['rs_service_tab_settings']) == 'rs_service_tab' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_tab_settings"></label>
        </div>
    <?php
    }


    /**
     * rs hotspots settings
     */
    public function rs_hotspots_showcase_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_hotspots_showcase_settings]" id="rs_hotspots_showcase_settings" value="rs_hotspots_showcase" %s/>',
                (isset($this->rselements_options['rs_hotspots_showcase_settings']) && $this->rselements_options['rs_hotspots_showcase_settings']) == 'rs_hotspots_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rs_hotspots_showcase_settings"></label>
        </div>
    <?php
    }

    /**
     * rs social settings
     */
    public function rs_social_icon_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_social_icon_settings]" id="rs_social_icon_settings" value="rs_social_icon" %s/>',
                (isset($this->rselements_options['rs_social_icon_settings']) && $this->rselements_options['rs_social_icon_settings']) == 'rs_social_icon' ? 'checked' : ''
            );
            ?>
            <label for="rs_social_icon_settings"></label>
        </div>
    <?php
    }

    

    /**
     * rs fluent form
     */
    public function rs_fluent_form_custom_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_fluent_form_custom_settings]" id="rs_fluent_form_custom_settings" value="rs_fluent_form_custom" %s/>',
                (isset($this->rselements_options['rs_fluent_form_custom_settings']) && $this->rselements_options['rs_fluent_form_custom_settings']) == 'rs_fluent_form_custom' ? 'checked' : ''
            );
            ?>
            <label for="rs_fluent_form_custom_settings"></label>
        </div>
    <?php
    }

    /**
     * rs services search
     */
    public function rs_services_search_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_services_search_settings]" id="rs_services_search_settings" value="rs_services_search" %s/>',
                (isset($this->rselements_options['rs_services_search_settings']) && $this->rselements_options['rs_services_search_settings']) == 'rs_services_search' ? 'checked' : ''
            );
            ?>
            <label for="rs_services_search_settings"></label>
        </div>
    <?php
    }

    /**
     * rs isotope filter
     */
    public function rs_services_list_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_services_list_settings]" id="rs_services_list_settings" value="rs_services_list" %s/>',
                (isset($this->rselements_options['rs_services_list_settings']) && $this->rselements_options['rs_services_list_settings']) == 'rs_services_list' ? 'checked' : ''
            );
            ?>
            <label for="rs_services_list_settings"></label>
        </div>
    <?php
    }

    /**
     * rs isotope filter
     */
    public function rs_isotope_filter_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_isotope_filter_settings]" id="rs_isotope_filter_settings" value="rs_isotope_filter" %s/>',
                (isset($this->rselements_options['rs_isotope_filter_settings']) && $this->rselements_options['rs_isotope_filter_settings']) == 'rs_isotope_filter' ? 'checked' : ''
            );
            ?>
            <label for="rs_isotope_filter_settings"></label>
        </div>
    <?php
    }

    /**
     * pricing list
     */
    public function rs_pricing_list_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_list_settings]" id="rs_pricing_list_settings" value="rs_pricing_list" %s/>',
                (isset($this->rselements_options['rs_pricing_list_settings']) && $this->rselements_options['rs_pricing_list_settings']) == 'rs_pricing_list' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_list_settings"></label>
        </div>
    <?php
    }

    /**
     * services tab
     */
    public function rs_services_filter_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_services_filter_settings]" id="rs_services_filter_settings" value="rs_services_filter" %s/>',
                (isset($this->rselements_options['rs_services_filter_settings']) && $this->rselements_options['rs_services_filter_settings']) == 'rs_services_filter' ? 'checked' : ''
            );
            ?>
            <label for="rs_services_filter_settings"></label>
        </div>
    <?php
    }

    /**
     * marquee slider
     */
    public function rs_marquee_logo_text_slider_settings()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_marquee_logo_text_slider_settings]" id="rs_marquee_logo_text_slider_settings" value="rs_marquee_logo_text_slider" %s/>',
                (isset($this->rselements_options['rs_marquee_logo_text_slider_settings']) && $this->rselements_options['rs_marquee_logo_text_slider_settings']) == 'rs_marquee_logo_text_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_marquee_logo_text_slider_settings"></label>
        </div>
    <?php
    }

    /**
     * marquee slider
     */
    public function rs_marquee_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_marquee_slider_setting]" id="rs_marquee_slider_setting" value="rs_marquee_slider" %s/>',
                (isset($this->rselements_options['rs_marquee_slider_setting']) && $this->rselements_options['rs_marquee_slider_setting']) == 'rs_marquee_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_marquee_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Team
     */
    public function rselements_team_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_post]" id="rs_team_post" value="rs_team_post" %s/>',
                (isset($this->rselements_options['rs_team_post']) && $this->rselements_options['rs_team_post']) == 'rs_team_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_post"></label>
        </div>
    <?php
    }

    /**
     * Portfolio
     */
    public function rselements_portfolio_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_post]" id="rs_portfolio_post" value="rs_portfolio_post" %s/>',
                (isset($this->rselements_options['rs_portfolio_post']) && $this->rselements_options['rs_portfolio_post']) == 'rs_portfolio_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_post"></label>
        </div>
    <?php
    }

    /**
     * Testimonials
     */
    public function rselements_testimonials_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_testimonials_post]" id="rs_testimonials_post" value="rs_testimonials_post" %s/>',
                (isset($this->rselements_options['rs_testimonials_post']) && $this->rselements_options['rs_testimonials_post']) == 'rs_testimonials_post' ? 'checked' : ''
            );
            ?>
            <label for="rs_testimonials_post"></label>
        </div>
    <?php
    }


    /**
     * Heading field
     */
    public function rselements_heading_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_heading_setting]" id="rs_heading_setting" value="rselement_heading" %s/>',
                (isset($this->rselements_options['rs_heading_setting']) && $this->rselements_options['rs_heading_setting']) == 'rselement_heading' ? 'checked' : ''
            );
            ?>
            <label for="rs_heading_setting"></label>
        </div>
    <?php
    }

    /**
     * Image Comparison
     */
    public function rselements_img_comparison_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_img_comparison_setting]" id="rs_img_comparison_setting" value="rselement_img_comparison" %s/>',
                (isset($this->rselements_options['rs_img_comparison_setting']) && $this->rselements_options['rs_img_comparison_setting']) == 'rselement_img_comparison' ? 'checked' : ''
            );
            ?>
            <label for="rs_img_comparison_setting"></label>
        </div>
    <?php
    }
    /**
     * Animated Heading
     */
    public function rselements_animated_heading_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_animated_heading_setting]" id="rs_animated_heading_setting" value="rselement_animated_heading" %s/>',
                (isset($this->rselements_options['rs_animated_heading_setting']) && $this->rselements_options['rs_animated_heading_setting']) == 'rselement_animated_heading' ? 'checked' : ''
            );
            ?>
            <label for="rs_animated_heading_setting"></label>
        </div>
    <?php
    }

    /**
     * Team Grid
     */
    public function rselements_team_gread_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_gread_setting]" id="rs_team_gread_setting" value="rselement_team_gread" %s/>',
                (isset($this->rselements_options['rs_team_gread_setting']) && $this->rselements_options['rs_team_gread_setting']) == 'rselement_team_gread' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_gread_setting"></label>
        </div>
    <?php
    }

    /**
     * Full Width Slider
     */
    public function rselements_full_width_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_full_width_slider_setting]" id="rs_full_width_slider_setting" value="rselement_full_width_slider" %s/>',
                (isset($this->rselements_options['rs_full_width_slider_setting']) && $this->rselements_options['rs_full_width_slider_setting']) == 'rselement_full_width_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_full_width_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Team Slider
     */
    public function rselements_team_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_team_slider_setting]" id="rs_team_slider_setting" value="rselement_team_slider" %s/>',
                (isset($this->rselements_options['rs_team_slider_setting']) && $this->rselements_options['rs_team_slider_setting']) == 'rselement_team_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_team_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Grid
     */
    public function rselements_portfolio_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_grid_setting]" id="rs_portfolio_grid_setting" value="rselement_portfolio_grid" %s/>',
                (isset($this->rselements_options['rs_portfolio_grid_setting']) && $this->rselements_options['rs_portfolio_grid_setting']) == 'rselement_portfolio_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Filter
     */
    public function rselements_portfolio_filter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_filter_setting]" id="rs_portfolio_filter_setting" value="rselement_portfolio_filter" %s/>',
                (isset($this->rselements_options['rs_portfolio_filter_setting']) && $this->rselements_options['rs_portfolio_filter_setting']) == 'rselement_portfolio_filter' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_filter_setting"></label>
        </div>
    <?php
    }

    /**
     * Portfolio Slider
     */
    public function rselements_portfolio_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_portfolio_slider_setting]" id="rs_portfolio_slider_setting" value="rselement_portfolio_slider" %s/>',
                (isset($this->rselements_options['rs_portfolio_slider_setting']) && $this->rselements_options['rs_portfolio_slider_setting']) == 'rselement_portfolio_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_portfolio_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Counter
     */
    public function rselements_counter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_counter_setting]" id="rs_counter_setting" value="rselement_counter" %s/>',
                (isset($this->rselements_options['rs_counter_setting']) && $this->rselements_options['rs_counter_setting']) == 'rselement_counter' ? 'checked' : ''
            );
            ?>
            <label for="rs_counter_setting"></label>
        </div>
    <?php
    }

    /**
     * Cost Calculator
     */
    public function rselements_cost_calculator_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_cost_calculator_setting]" id="rs_cost_calculator_setting" value="rselement_cost_calculator" %s/>',
                (isset($this->rselements_options['rs_cost_calculator_setting']) && $this->rselements_options['rs_cost_calculator_setting']) == 'rselement_cost_calculator' ? 'checked' : ''
            );
            ?>
            <label for="rs_cost_calculator_setting"></label>
        </div>
    <?php
    }

    /**
     * Services Grid
     */
    public function rselements_service_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_grid_setting]" id="rs_service_grid_setting" value="rselement_service_grid" %s/>',
                (isset($this->rselements_options['rs_service_grid_setting']) && $this->rselements_options['rs_service_grid_setting']) == 'rselement_service_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Services Slider
     */
    public function rselements_service_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_service_slider_setting]" id="rs_service_slider_setting" value="rselement_service_slider" %s/>',
                (isset($this->rselements_options['rs_service_slider_setting']) && $this->rselements_options['rs_service_slider_setting']) == 'rselement_service_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_service_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Video
     */
    public function rselements_video_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_video_setting]" id="rs_video_setting" value="rselement_video" %s/>',
                (isset($this->rselements_options['rs_video_setting']) && $this->rselements_options['rs_video_setting']) == 'rselement_video' ? 'checked' : ''
            );
            ?>
            <label for="rs_video_setting"></label>
        </div>
    <?php
    }

    /**
     * Pricing Table
     */
    public function rselements_pricing_table_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_table_setting]" id="rs_pricing_table_setting" value="rselement_pricing_table" %s/>',
                (isset($this->rselements_options['rs_pricing_table_setting']) && $this->rselements_options['rs_pricing_table_setting']) == 'rselement_pricing_table' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_table_setting"></label>
        </div>
    <?php
    }

    /**
     * Pricing Table Slider
     */
    public function rselements_pricing_table_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_table_slider_setting]" id="rs_pricing_table_slider_setting" value="rselement_pricing_table_slider" %s/>',
                (isset($this->rselements_options['rs_pricing_table_slider_setting']) && $this->rselements_options['rs_pricing_table_slider_setting']) == 'rselement_pricing_table_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_table_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Pricing Switcher
     */
    public function rselements_pricing_switcher_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_pricing_switcher_setting]" id="rs_pricing_switcher_setting" value="rselement_pricing_switcher" %s/>',
                (isset($this->rselements_options['rs_pricing_switcher_setting']) && $this->rselements_options['rs_pricing_switcher_setting']) == 'rselement_pricing_switcher' ? 'checked' : ''
            );
            ?>
            <label for="rs_pricing_switcher_setting"></label>
        </div>
    <?php
    }

    /**
     * Button
     */
    public function rselements_button_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_button_setting]" id="rs_button_setting" value="rselement_button" %s/>',
                (isset($this->rselements_options['rs_button_setting']) && $this->rselements_options['rs_button_setting']) == 'rselement_button' ? 'checked' : ''
            );
            ?>
            <label for="rs_button_setting"></label>
        </div>
    <?php
    }

    /**
     * Logo Showcase
     */
    public function rselements_logo_showcase_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_logo_showcase_setting]" id="rs_logo_showcase_setting" value="rselement_logo_showcase" %s/>',
                (isset($this->rselements_options['rs_logo_showcase_setting']) && $this->rselements_options['rs_logo_showcase_setting']) == 'rselement_logo_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rs_logo_showcase_setting"></label>
        </div>
    <?php
    }

    /**
     * CTA
     */
    public function rselements_cta_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_cta_setting]" id="rs_cta_setting" value="rselement_cta" %s/>',
                (isset($this->rselements_options['rs_cta_setting']) && $this->rselements_options['rs_cta_setting']) == 'rselement_cta' ? 'checked' : ''
            );
            ?>
            <label for="rs_cta_setting"></label>
        </div>
    <?php
    }

    /**
     * Testimonial Grid
     */
    public function rselements_testimonial_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_testimonial_grid_setting]" id="rs_testimonial_grid_setting" value="rselement_testimonial_grid" %s/>',
                (isset($this->rselements_options['rs_testimonial_grid_setting']) && $this->rselements_options['rs_testimonial_grid_setting']) == 'rselement_testimonial_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_testimonial_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Testimonial Slider
     */
    public function rselements_testimonial_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_testimonial_slider_setting]" id="rs_testimonial_slider_setting" value="rselement_testimonial_slider" %s/>',
                (isset($this->rselements_options['rs_testimonial_slider_setting']) && $this->rselements_options['rs_testimonial_slider_setting']) == 'rselement_testimonial_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_testimonial_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Testimonial Slider Two
     */
    public function rselements_testimonial_slider_two_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_testimonial_slider_two_setting]" id="rs_testimonial_slider_two_setting" value="rselement_testimonial_slider_two" %s/>',
                (isset($this->rselements_options['rs_testimonial_slider_two_setting']) && $this->rselements_options['rs_testimonial_slider_two_setting']) == 'rselement_testimonial_slider_two' ? 'checked' : ''
            );
            ?>
            <label for="rs_testimonial_slider_two_setting"></label>
        </div>
    <?php
    }

    /**
     * Flip Box
     */
    public function rselements_flip_box_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_flip_box_setting]" id="rs_flip_box_setting" value="rselement_flip_box" %s/>',
                (isset($this->rselements_options['rs_flip_box_setting']) && $this->rselements_options['rs_flip_box_setting']) == 'rselement_flip_box' ? 'checked' : ''
            );
            ?>
            <label for="rs_flip_box_setting"></label>
        </div>
    <?php
    }

    /**
     * Tab
     */
    public function rselements_tab_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_tab_setting]" id="rs_tab_setting" value="rselement_tab" %s/>',
                (isset($this->rselements_options['rs_tab_setting']) && $this->rselements_options['rs_tab_setting']) == 'rselement_tab' ? 'checked' : ''
            );
            ?>
            <label for="rs_tab_setting"></label>
        </div>
    <?php
    }

    /**
     * Advance Tab
     */
    public function rselements_advance_tab_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_advance_tab_setting]" id="rs_advance_tab_setting" value="rselement_advance_tab" %s/>',
                (isset($this->rselements_options['rs_advance_tab_setting']) && $this->rselements_options['rs_advance_tab_setting']) == 'rselement_advance_tab' ? 'checked' : ''
            );
            ?>
            <label for="rs_advance_tab_setting"></label>
        </div>
    <?php
    }

    /**
     * Icon Box
     */
    public function rselements_icon_box_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_icon_box_setting]" id="rs_icon_box_setting" value="rselement_icon_box" %s/>',
                (isset($this->rselements_options['rs_icon_box_setting']) && $this->rselements_options['rs_icon_box_setting']) == 'rselement_icon_box' ? 'checked' : ''
            );
            ?>
            <label for="rs_icon_box_setting"></label>
        </div>
    <?php
    }

    /**
     * Blog Grid
     */
    public function rselements_blog_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_blog_grid_setting]" id="rs_blog_grid_setting" value="rselement_blog_grid" %s/>',
                (isset($this->rselements_options['rs_blog_grid_setting']) && $this->rselements_options['rs_blog_grid_setting']) == 'rselement_blog_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_blog_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Blog Slider
     */
    public function rselements_blog_slider_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_blog_slider_setting]" id="rs_blog_slider_setting" value="rselement_blog_slider" %s/>',
                (isset($this->rselements_options['rs_blog_slider_setting']) && $this->rselements_options['rs_blog_slider_setting']) == 'rselement_blog_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_blog_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Number Grid
     */
    public function rselements_number_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_number_grid_setting]" id="rs_number_grid_setting" value="rselement_number_grid" %s/>',
                (isset($this->rselements_options['rs_number_grid_setting']) && $this->rselements_options['rs_number_grid_setting']) == 'rselement_number_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_number_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Fluent Form
     */
    public function rselements_fluent_form_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_fluent_form_setting]" id="rs_fluent_form_setting" value="rselement_fluent_form" %s/>',
                (isset($this->rselements_options['rs_fluent_form_setting']) && $this->rselements_options['rs_fluent_form_setting']) == 'rselement_fluent_form' ? 'checked' : ''
            );
            ?>
            <label for="rs_fluent_form_setting"></label>
        </div>
    <?php
    }

    /**
     * Progress Bar
     */
    public function rselements_progress_bar_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_progress_bar_setting]" id="rs_progress_bar_setting" value="rselement_progress_bar" %s/>',
                (isset($this->rselements_options['rs_progress_bar_setting']) && $this->rselements_options['rs_progress_bar_setting']) == 'rselement_progress_bar' ? 'checked' : ''
            );
            ?>
            <label for="rs_progress_bar_setting"></label>
        </div>
    <?php
    }

    /**
     * Progress Pie
     */
    public function rselements_progress_pie_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_progress_pie_setting]" id="rs_progress_pie_setting" value="rselement_progress_pie" %s/>',
                (isset($this->rselements_options['rs_progress_pie_setting']) && $this->rselements_options['rs_progress_pie_setting']) == 'rselement_progress_pie' ? 'checked' : ''
            );
            ?>
            <label for="rs_progress_pie_setting"></label>
        </div>
    <?php
    }

    /**
     * Contact Box
     */
    public function rselements_contact_box_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_contact_box_setting]" id="rs_contact_box_setting" value="rselement_contact_box" %s/>',
                (isset($this->rselements_options['rs_contact_box_setting']) && $this->rselements_options['rs_contact_box_setting']) == 'rselement_contact_box' ? 'checked' : ''
            );
            ?>
            <label for="rs_contact_box_setting"></label>
        </div>
    <?php
    }

    /**
     * Tooltip
     */
    public function rselements_tooltip_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_tooltip_setting]" id="rs_tooltip_setting" value="rselement_tooltip" %s/>',
                (isset($this->rselements_options['rs_tooltip_setting']) && $this->rselements_options['rs_tooltip_setting']) == 'rselement_tooltip' ? 'checked' : ''
            );
            ?>
            <label for="rs_tooltip_setting"></label>
        </div>
    <?php
    }

    /**
     * Static Product
     * 
     */
    public function rselements_static_product_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_static_product_setting]" id="rs_static_product_setting" value="rselement_static_product" %s/>',
                (isset($this->rselements_options['rs_static_product_setting']) && $this->rselements_options['rs_static_product_setting']) == 'rselement_static_product' ? 'checked' : ''
            );
            ?>
            <label for="rs_static_product_setting"></label>
        </div>
    <?php
    }

    /**
     * FAQ
     */
    public function rselements_faq_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_faq_setting]" id="rs_faq_setting" value="rselement_faq" %s/>',
                (isset($this->rselements_options['rs_faq_setting']) && $this->rselements_options['rs_faq_setting']) == 'rselement_faq' ? 'checked' : ''
            );
            ?>
            <label for="rs_faq_setting"></label>
        </div>
    <?php
    }

    /**
     * Image Showcase
     */
    public function rselements_image_showcase_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_image_showcase_setting]" id="rs_image_showcase_setting" value="rselement_image_showcase" %s/>',
                (isset($this->rselements_options['rs_image_showcase_setting']) && $this->rselements_options['rs_image_showcase_setting']) == 'rselement_image_showcase' ? 'checked' : ''
            );
            ?>
            <label for="rs_image_showcase_setting"></label>
        </div>
    <?php
    }

    /**
     * Circle Service
     */
    public function rselements_circle_service_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_circle_service_setting]" id="rs_circle_service_setting" value="rselement_circle_service" %s/>',
                (isset($this->rselements_options['rs_circle_service_setting']) && $this->rselements_options['rs_circle_service_setting']) == 'rselement_circle_service' ? 'checked' : ''
            );
            ?>
            <label for="rs_circle_service_setting"></label>
        </div>
    <?php
    }

    /**
     * Image Hover Effect
     */
    public function rselements_image_hover_effect_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_image_hover_effect_setting]" id="rs_image_hover_effect_setting" value="rselement_image_hover_effect" %s/>',
                (isset($this->rselements_options['rs_image_hover_effect_setting']) && $this->rselements_options['rs_image_hover_effect_setting']) == 'rselement_image_hover_effect' ? 'checked' : ''
            );
            ?>
            <label for="rs_image_hover_effect_setting"></label>
        </div>
    <?php
    }

    /**
     * Features List
     */
    public function rselements_features_list_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_features_list_setting]" id="rs_features_list_setting" value="rselement_features_list" %s/>',
                (isset($this->rselements_options['rs_features_list_setting']) && $this->rselements_options['rs_features_list_setting']) == 'rselement_features_list' ? 'checked' : ''
            );
            ?>
            <label for="rs_features_list_setting"></label>
        </div>
    <?php
    }

    /**
     * Brochures
     */
    public function rselements_brochures_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_brochures_setting]" id="rs_brochures_setting" value="rselement_brochures" %s/>',
                (isset($this->rselements_options['rs_brochures_setting']) && $this->rselements_options['rs_brochures_setting']) == 'rselement_brochures' ? 'checked' : ''
            );
            ?>
            <label for="rs_brochures_setting"></label>
        </div>
    <?php
    }

    /**
     * Dual Button
     */
    public function rselements_dual_button_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_dual_button_setting]" id="rs_dual_button_setting" value="rselement_dual_button" %s/>',
                (isset($this->rselements_options['rs_dual_button_setting']) && $this->rselements_options['rs_dual_button_setting']) == 'rselement_dual_button' ? 'checked' : ''
            );
            ?>
            <label for="rs_dual_button_setting"></label>
        </div>
    <?php
    }

    /**
     * Image Parallax
     */
    public function rselements_image_parallax_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_image_parallax_setting]" id="rs_image_parallax_setting" value="rselement_image_parallax" %s/>',
                (isset($this->rselements_options['rs_image_parallax_setting']) && $this->rselements_options['rs_image_parallax_setting']) == 'rselement_image_parallax' ? 'checked' : ''
            );
            ?>
            <label for="rs_image_parallax_setting"></label>
        </div>
    <?php
    }

    /**
     * Image Animation Shape
     */
    public function rselements_image_animation_shape_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_image_animation_shape_setting]" id="rs_image_animation_shape_setting" value="rselement_image_animation_shape" %s/>',
                (isset($this->rselements_options['rs_image_animation_shape_setting']) && $this->rselements_options['rs_image_animation_shape_setting']) == 'rselement_image_animation_shape' ? 'checked' : ''
            );
            ?>
            <label for="rs_image_animation_shape_setting"></label>
        </div>
    <?php
    }

    /**
     * Breadcrumb
     */
    public function rselements_breadcrumb_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_breadcrumb_setting]" id="rs_breadcrumb_setting" value="rselement_breadcrumb" %s/>',
                (isset($this->rselements_options['rs_breadcrumb_setting']) && $this->rselements_options['rs_breadcrumb_setting']) == 'rselement_breadcrumb' ? 'checked' : ''
            );
            ?>
            <label for="rs_breadcrumb_setting"></label>
        </div>
    <?php
    }

    /**
     * Accordion
     */
    public function rselements_accordion_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_accordion_setting]" id="rs_accordion_setting" value="rselement_accordion" %s/>',
                (isset($this->rselements_options['rs_accordion_setting']) && $this->rselements_options['rs_accordion_setting']) == 'rselement_accordion' ? 'checked' : ''
            );
            ?>
            <label for="rs_accordion_setting"></label>
        </div>
    <?php
    }

    /**
     * Newsletter
     */
    public function rselements_newsletter_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_newsletter_setting]" id="rs_newsletter_setting" value="rselement_newsletter" %s/>',
                (isset($this->rselements_options['rs_newsletter_setting']) && $this->rselements_options['rs_newsletter_setting']) == 'rselement_newsletter' ? 'checked' : ''
            );
            ?>
            <label for="rs_newsletter_setting"></label>
        </div>
    <?php
    }

    /**
     * Hover Tabs
     */
    public function rselements_hover_tab_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_hover_tab_setting]" id="rs_hover_tab_setting" value="rselement_hover_tab" %s/>',
                (isset($this->rselements_options['rs_hover_tab_setting']) && $this->rselements_options['rs_hover_tab_setting']) == 'rselement_hover_tab' ? 'checked' : ''
            );
            ?>
            <label for="rs_hover_tab_setting"></label>
        </div>
    <?php
    }

    /**
     * Apps ScreenSlider
     */
    public function rselements_screenslider_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_screen_slider_setting]" id="rs_screen_slider_setting" value="rselement_screen_slider" %s/>',
                (isset($this->rselements_options['rs_screen_slider_setting']) && $this->rselements_options['rs_screen_slider_setting']) == 'rselement_screen_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_screen_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * roadmap slider
     */
    public function rselements_roadmap_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_roadmap_slider_setting]" id="rs_roadmap_slider_setting" value="rselement_roadmap_slider" %s/>',
                (isset($this->rselements_options['rs_roadmap_slider_setting']) && $this->rselements_options['rs_roadmap_slider_setting']) == 'rselement_roadmap_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_roadmap_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Latest Blog Grid
     */
    public function rselements_latest_blog_grid_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_latest_blog_grid_setting]" id="rs_latest_blog_grid_setting" value="rselement_latest_blog_grid" %s/>',
                (isset($this->rselements_options['rs_latest_blog_grid_setting']) && $this->rselements_options['rs_latest_blog_grid_setting']) == 'rselement_latest_blog_grid' ? 'checked' : ''
            );
            ?>
            <label for="rs_latest_blog_grid_setting"></label>
        </div>
    <?php
    }

    /**
     * Latest Blog Slider
     */
    public function rs_latest_blog_sliders_setting()
    {
    ?>
        <div class="checkbox">
            <?php

            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_latest_blog_slider_setting]" id="rs_latest_blog_slider_setting" value="rselement_latest_blog_slider" %s/>',
                (isset($this->rselements_options['rs_latest_blog_slider_setting']) && $this->rselements_options['rs_latest_blog_slider_setting']) == 'rselement_latest_blog_slider' ? 'checked' : ''
            );
            ?>
            <label for="rs_latest_blog_slider_setting"></label>
        </div>
    <?php
    }

    /**
     * Post Navigation
     */
    public function rs_post_navigation_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_post_navigation_setting]" id="rs_post_navigation_setting" value="rselement_post_navigation" %s/>',
                (isset($this->rselements_options['rs_post_navigation_setting']) && $this->rselements_options['rs_post_navigation_setting']) == 'rselement_post_navigation' ? 'checked' : ''
            );
            ?>
            <label for="rs_post_navigation_setting"></label>
        </div>
    <?php
    }

    /**
     * RS Step Flow
     */
    public function rs_step_flow_setting()
    {
    ?>
        <div class="checkbox">
            <?php
            printf(
                '<input type="checkbox" name="rselements_addon_option[rs_step_flow_setting]" id="rs_step_flow_setting" value="rselement_step_flow" %s/>',
                (isset($this->rselements_options['rs_step_flow_setting']) && $this->rselements_options['rs_step_flow_setting']) == 'rselement_step_flow' ? 'checked' : ''
            );
            ?>
            <label for="rs_step_flow_setting"></label>
        </div>
<?php
    }

}

if (is_admin())
    new RS_Elements_Addon_Control();
