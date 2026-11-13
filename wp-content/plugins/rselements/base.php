<?php
final class Rsaddon_Elementor_Pro_Extension {
	const VERSION = '1.0.8';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.4';
	private static $_instance = null;


	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'rseleemnt_init' ] );
		register_activation_hook( RSADDON_PLUGIN_FILE, [$this,'rselements_plugin_activate'] );
	}

	public function i18n() {
		load_plugin_textdomain( 'rsaddon' );
	}

	public function rseleemnt_init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_register_plugin_styles' ] );		
		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_register_widget_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rselements_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rselements_register_plugin_admin_styles' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_studio_fonts_url' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'rs_elementor_js'] );

		$this->include_files();

	}

	public static function init() {

		static $_instance = false;


		$get_version = get_option( 'rselement_version' );
        $updated     = get_option( 'rselement_updated' );

        if ( $get_version < RSELEMENT_VERSION && !$updated ) {
			
			
			$all_elements_list = self::rselements_widget_list();

			update_option('rselements_addon_option',$all_elements_list);

			update_option( 'rselement_version', RSELEMENT_VERSION );	
			update_option( 'rselement_updated',false );	
			
        }

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function rselements_plugin_activate() {
        $all_elements_list = $this->rselements_widget_list();
		update_option("rs_heading_setting", "rselement_heading");
        update_option('rselements_addon_option',$all_elements_list);
    }


	public static function rselements_widget_list()
    {
        $rsall_elements = [

            'rs_portfolio_post' => 'rs_portfolio_post',
            'rs_testimonials_post' => 'rs_testimonials_post',
            'rs_team_post' => 'rs_team_post ',
            'rs_heading_setting' => 'rselement_heading',
            'rs_img_comparison_setting' => 'rselement_img_comparison',
            'rs_animated_heading_setting' => 'rselement_animated_heading',
            'rs_team_gread_setting' => 'rselement_team_gread',
            'rs_full_width_slider_setting' => 'rselement_full_width_slider',
            'rs_team_slider_setting' => 'rselement_team_slider',
            'rs_portfolio_grid_setting' => 'rselement_portfolio_grid',
            'rs_portfolio_filter_setting' => 'rselement_portfolio_filter',
            'rs_portfolio_slider_setting' => 'rselement_portfolio_slider',
            'rs_counter_setting' => 'rselement_counter',
            'rs_cost_calculator_setting' => 'rselement_cost_calculator',
            'rs_service_grid_setting' => 'rselement_service_grid',
            'rs_service_slider_setting' => 'rselement_service_grid',
            'rs_video_setting' => 'rselement_video',
            'rs_pricing_table_setting' => 'rselement_pricing_table',
            'rs_pricing_table_slider_setting' => 'rselement_pricing_table_slider',
            'rs_pricing_switcher_setting' => 'rselement_pricing_switcher',
            'rs_button_setting' => 'rselement_button',
            'rs_logo_showcase_setting' => 'rselement_logo_showcase',
            'rs_cta_setting' => 'rselement_cta',
            'rs_testimonial_grid_setting' => 'rselement_testimonial_grid',
            'rs_testimonial_slider_two_setting' => 'rselement_testimonial_slider_two',
            'rs_flip_box_setting' => 'rselement_flip_box',
            'rs_tab_setting' => 'rselement_tab',
            'rs_advance_tab_setting' => 'rselement_advance_tab',
            'rs_icon_box_setting' => 'rselement_icon_box',
            'rs_blog_grid_setting' => 'rselement_blog_grid',
            'rs_blog_slider_setting' => 'rselement_blog_slider',
            'rs_number_grid_setting' => 'rselement_number_grid',
            'rs_fluent_form_setting' => 'rselement_fluent_form',
            'rs_progress_bar_setting' => 'rselement_progress_bar',
            'rs_progress_pie_setting' => 'rselement_progress_pie',
            'rs_contact_box_setting' => 'rselement_contact_box',
            'rs_tooltip_setting' => 'rselement_tooltip',
            'rs_static_product_setting' => 'rselement_static_product',
            'rs_faq_setting' => 'rselement_faq',
            'rs_image_showcase_setting' => 'rselement_image_showcase',
            'rs_circle_service_setting' => 'rselement_circle_service',
            'rs_image_hover_effect_setting' => 'rselement_image_hover_effect',
            'rs_features_list_setting' => 'rselement_features_list',
            'rs_brochures_setting' => 'rselement_brochures',
            'rs_dual_button_setting' => 'rselement_dual_button',
            'rs_image_animation_shape_setting' => 'rselement_image_animation_shape',
            'rs_breadcrumb_setting' => 'rselement_breadcrumb',
            'rs_accordion_setting' => 'rselement_accordion',
            'rs_newsletter_setting' => 'rselement_newsletter',
            'rs_hover_tab_setting' => 'rselement_hover_tab',
            'rs_screen_slider_setting' => 'rselement_screen_slider',
            'rs_testimonial_slider_setting' => 'rselement_testimonial_slider',
            'rs_image_parallax_setting' => 'rselement_image_parallax',
            'rs_roadmap_slider_setting' => 'rselement_roadmap_slider',
            'rs_latest_blog_grid_setting' => 'rselement_latest_blog_grid',
            'rs_latest_blog_slider_setting' => 'rselement_latest_blog_slider',
            'rs_post_navigation_setting' => 'rs_post_navigation_setting',
            'rs_step_flow_setting' => 'rselement_step_flow',
            'rs_marquee_slider_setting' => 'rs_marquee_slider',
            'rs_marquee_logo_text_slider_settings' => 'rs_marquee_logo_text_slider',
            'rs_services_filter_settings' => 'rs_services_filter',
            'rs_pricing_list_settings' => 'rs_pricing_list',
            'rs_isotope_filter_settings' => 'rs_isotope_filter',
            'rs_services_search_settings' => 'rs_services_search',
            'rs_fluent_form_custom_settings' => 'rs_fluent_form_custom',
            'rs_hotspots_showcase_settings' => 'rs_hotspots_showcase',
            'rs_services_list_settings' => 'rs_services_list',
            'rs_social_icon_settings' => 'rs_social_icon',
            'rs_service_tab_settings' => 'rs_service_tab',
            'rs_header_offcanvas_settings' => 'rs_header_offcanvas',

        ];

        return $rsall_elements;
    }


	public function rs_elementor_js() {
		$dir = plugin_dir_url(__FILE__);
		wp_enqueue_script( 'rsaddons-offcanvas-js', $dir.'assets/js/custom.js', array('jquery'), '201513434', true);
	}

	function rselements_studio_fonts_url() {
          $font_url = '';
          
          /*
          Translators: If there are characters in your language that are not supported
          by chosen font(s), translate this to 'off'. Do not translate into your own language.
           */
          if ( 'off' !== _x( 'on', 'Google font: on or off', 'rsaddon' ) ) {
              $font_url = add_query_arg( 'family', urlencode( 'Open Sans: 400,500,600,700|Montserrat: 400,500,600,700' ), "//fonts.googleapis.com/css" );
          }
        return $font_url;
    }

	public function rselements_register_plugin_styles() {

		$dir = plugin_dir_url(__FILE__);
              
        wp_enqueue_style( 'rsaddons-floaticon', $dir.'assets/fonts/flaticon.css' );
        wp_enqueue_style( 'headding-title', $dir.'assets/css/headding-title.css' );
        wp_enqueue_style( 'rsaddons-pro', $dir.'assets/css/rsaddons.css');
		
		wp_enqueue_script( 'popper', $dir.'assets/js/popper.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'headding-title', $dir.'assets/js/headding-title.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'slick', $dir.'assets/js/slick.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'js-tilt-view', $dir.'assets/js/tilt.jquery.min.js', array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-ui', $dir.'assets/js/jquery-ui.js', array('jquery'), '201513434', true);
		wp_enqueue_script( 'parallax', $dir.'assets/js/parallax-effect.min.js', array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'ddbefore-and-after', $dir.'assets/js/ddbeforeandafter.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);
		wp_enqueue_script( 'rsaddons-marquee-js', $dir.'assets/js/jquery.marquee.min.js', array('jquery'), '201513434', true);
    }

	public function rselements_register_widget_styles(){
		$dir = plugin_dir_url(__FILE__);
		/**
         * Element css
         */
        $rselements_addon_setting = get_option( 'rselements_addon_option' );
        //Heading
        if( isset( $rselements_addon_setting['rs_heading_setting'] ) == 'rselement_heading' ){
            wp_enqueue_style( 'rselements-heading', $dir.'widgets/heading/heading.css' );
        }
        // Image Comparison
        if( isset( $rselements_addon_setting['rs_img_comparison_setting'] ) == 'rselement_img_comparison' ){
            wp_enqueue_style( 'rselements-img-comparison', $dir.'widgets/img-comparison/img-comparison.css' );
        }
		//Animated Heading
        if( isset( $rselements_addon_setting['rs_animated_heading_setting'] ) == 'rselement_animated_heading' ){
            wp_enqueue_style( 'rselements-animated_heading', $dir.'widgets/animated-heading/animated-heading.css' );
        }
		//Team Gread
        if( isset( $rselements_addon_setting['rs_team_gread_setting'] ) == 'rselement_team_gread' ){
            wp_enqueue_style( 'rselements-team_grid', $dir.'widgets/team-member/team-grid-widget.css' );
        }
		//Full Width Slider
        if( isset( $rselements_addon_setting['rs_full_width_slider_setting'] ) == 'rselement_full_width_slider' ){
            wp_enqueue_style( 'rselements-full_width_slider', $dir.'widgets/rs_slider/slider-widget.css' );
        }
		//Team Slider
        if( isset( $rselements_addon_setting['rs_team_slider_setting'] ) == 'rselement_team_slider' ){
            wp_enqueue_style( 'rselements-team_slider', $dir.'widgets/team-member-slider/team-slider-widget.css' );
        }
		//Portfolio Grid
        if( isset( $rselements_addon_setting['rs_portfolio_grid_setting'] ) == 'rselement_portfolio_grid' ){
            wp_enqueue_style( 'rselements-portfolio_grid', $dir.'widgets/portfolio-grid/portfolio-grid.css' );
        }
		//Portfolio Filter
        if( isset( $rselements_addon_setting['rs_portfolio_filter_setting'] ) == 'rselement_portfolio_filter' ){
            wp_enqueue_style( 'rselements-portfolio_filter', $dir.'widgets/portfolio-filter/portfolio-filter-widget.css' );
        }
		//Portfolio Slider
        if( isset( $rselements_addon_setting['rs_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ){
            wp_enqueue_style( 'rselements-portfolio_slider', $dir.'widgets/portfolio-slider/portfolio-slider.css' );
        }
		//Counter
        if( isset( $rselements_addon_setting['rs_counter_setting'] ) == 'rselement_counter' ){
            wp_enqueue_style( 'rselements-counter', $dir.'widgets/counter/counter.css' );
        }
		//Cost Calculator
        if( isset( $rselements_addon_setting['rs_cost_calculator_setting'] ) == 'rselement_cost_calculator' ){
            wp_enqueue_style( 'rselements-cost_calculator', $dir.'widgets/cost-calculator/cost-calculator.css' );
        }
		//Services Grid
        if( isset( $rselements_addon_setting['rs_service_grid_setting'] ) == 'rselement_service_grid' ){
            wp_enqueue_style( 'rselements-service_grid', $dir.'widgets/services/rs-service-grid.css' );
        }
		//Services Slider
        if( isset( $rselements_addon_setting['rs_service_slider_setting'] ) == 'rselement_service_grid' ){
            wp_enqueue_style( 'rselements-service_slider', $dir.'widgets/service-slider/service-slider-widget.css' );
        }
		//Video
        if( isset( $rselements_addon_setting['rs_video_setting'] ) == 'rselement_video' ){
            wp_enqueue_style( 'rselements-video', $dir.'widgets/video/rs-video.css' );
        }
		//Pricing Table
        if( isset( $rselements_addon_setting['rs_pricing_table_setting'] ) == 'rselement_pricing_table' ){
            wp_enqueue_style( 'rselements-pricing_table', $dir.'widgets/pricing-table/pricing-table.css' );
        }
		//Pricing Table Slider
        if( isset( $rselements_addon_setting['rs_pricing_table_slider_setting'] ) == 'rselement_pricing_table_slider' ){
            wp_enqueue_style( 'rselements-pricing_table_slider', $dir.'widgets/pricing-table-slider/pricing-table-slider.css' );
        }
		//Pricing Switcher
        if( isset( $rselements_addon_setting['rs_pricing_switcher_setting'] ) == 'rselement_pricing_switcher' ){
            wp_enqueue_style( 'rselements-pricing_switcher', $dir.'widgets/rs-pricing-table/rs-pricing-table.css' );
        }
		//Button
        if( isset( $rselements_addon_setting['rs_button_setting'] ) == 'rselement_button' ){
            wp_enqueue_style( 'rselements-button', $dir.'widgets/button/button.css' );
        }
		//Logo Showcase
        if( isset( $rselements_addon_setting['rs_logo_showcase_setting'] ) == 'rselement_logo_showcase' ){
            wp_enqueue_style( 'rselements-logo_widget', $dir.'widgets/logo-widget/logo-widget.css' );
        }
		//CTA
        if( isset( $rselements_addon_setting['rs_cta_setting'] ) == 'rselement_cta' ){
            wp_enqueue_style( 'rselements-cta', $dir.'widgets/cta/cta.css' );
        }
		//Testimonial Grid
        if( isset( $rselements_addon_setting['rs_testimonial_grid_setting'] ) == 'rselement_testimonial_grid' ){
            wp_enqueue_style( 'rselements-testimonial', $dir.'widgets/testimonial/testimonail-widget.css' );
        }
		//Testimonial Slider
        if( isset( $rselements_addon_setting['rs_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ){
            wp_enqueue_style( 'rselements-testimonial_slider', $dir.'widgets/testimonial-slider/testimonail-slider-widget.css' );
        }
		//Testimonial Slider 2
        if( isset( $rselements_addon_setting['rs_testimonial_slider_two_setting'] ) == 'rselement_testimonial_slider_two' ){
            wp_enqueue_style( 'rselements-testimonial_slider_two', $dir.'widgets/testimonial-slider-custom/testimonail-widget.css' );
        }
		//Flip Box
        if( isset( $rselements_addon_setting['rs_flip_box_setting'] ) == 'rselement_flip_box' ){
            wp_enqueue_style( 'rselements-flip_box', $dir.'widgets/flip-box/flip-box.css' );
        }
		//Tab
        if( isset( $rselements_addon_setting['rs_tab_setting'] ) == 'rselement_tab' ){
            wp_enqueue_style( 'rselements-tab', $dir.'widgets/tab/tab.css' );
        }
		//Advance Tab
        if( isset( $rselements_addon_setting['rs_advance_tab_setting'] ) == 'rselement_advance_tab' ){
            wp_enqueue_style( 'rselements-advance_tab', $dir.'widgets/advanced-tab/advanced-tab.css' );
        }
		//Icon Box
        if( isset( $rselements_addon_setting['rs_icon_box_setting'] ) == 'rselement_icon_box' ){
            wp_enqueue_style( 'rselements-icon_box', $dir.'widgets/iconbox/iconbox.css' );
        }
		//Blog Grid
        if( isset( $rselements_addon_setting['rs_blog_grid_setting'] ) == 'rselement_blog_grid' ){
            wp_enqueue_style( 'rselements-blog_grid', $dir.'widgets/blog-grid/blog-grid.css' );
        }
		//Blog Slider
        if( isset( $rselements_addon_setting['rs_blog_slider_setting'] ) == 'rselement_blog_slider' ){
            wp_enqueue_style( 'rselements-blog_slider', $dir.'widgets/blog-slider/blog-slider.css' );
        }
		//Number Grid
        if( isset( $rselements_addon_setting['rs_number_grid_setting'] ) == 'rselement_number_grid' ){
            wp_enqueue_style( 'rselements-number_grid', $dir.'widgets/number/number.css' );
        }
		//Fluent Form
        if( isset( $rselements_addon_setting['rs_fluent_form_setting'] ) == 'rselement_fluent_form' ){
            wp_enqueue_style( 'rselements-fluent-form', $dir.'widgets/fluent-form/fluent-form.css' );
        }
		//Progress Bar
        if( isset( $rselements_addon_setting['rs_progress_bar_setting'] ) == 'rselement_progress_bar' ){
            wp_enqueue_style( 'rselements-progress_bar', $dir.'widgets/progress/rs-progress.css' );
        }
		//Progress Pie
        if( isset( $rselements_addon_setting['rs_progress_pie_setting'] ) == 'rselement_progress_pie' ){
            wp_enqueue_style( 'rselements-progress_pie', $dir.'widgets/progress-pie/progress-pie.css' );
        }
		//Contact Box
        if( isset( $rselements_addon_setting['rs_contact_box_setting'] ) == 'rselement_contact_box' ){
            wp_enqueue_style( 'rselements-contact_box', $dir.'widgets/contact-box/contact-box.css' );
        }
		//Tooltip
        if( isset( $rselements_addon_setting['rs_tooltip_setting'] ) == 'rselement_tooltip' ){
            wp_enqueue_style( 'rselements-tooltip', $dir.'widgets/tooltip/rs-tooltip.css' );
        }
		//Static Product
        if( isset( $rselements_addon_setting['rs_static_product_setting'] ) == 'rselement_static_product' ){
            wp_enqueue_style( 'rselements-static_product', $dir.'widgets/static-product/static-product.css' );
        }
		//FAQ
        if( isset( $rselements_addon_setting['rs_faq_setting'] ) == 'rselement_faq' ){
            wp_enqueue_style( 'rselements-faq', $dir.'widgets/faq/faq.css' );
        }
		//Image Showcase
        if( isset( $rselements_addon_setting['rs_image_showcase_setting'] ) == 'rselement_image_showcase' ){
            wp_enqueue_style( 'rselements-image_showcase', $dir.'widgets/image-widget/image-widget.css' );
        }
        //Circle Service
        if( isset( $rselements_addon_setting['rs_circle_service_setting'] ) == 'rselement_circle_service' ){
            wp_enqueue_style( 'rselements-circle_service', $dir.'widgets/circle-service/circle-service-widget.css' );
        }
		//Image Hover Effect
        if( isset( $rselements_addon_setting['rs_image_hover_effect_setting'] ) == 'rselement_image_hover_effect' ){
            wp_enqueue_style( 'rselements-image_hover_effect', $dir.'widgets/image-hover-widget/image-hover-widget.css' );
        }
		//Features List
        if( isset( $rselements_addon_setting['rs_features_list_setting'] ) == 'rselement_features_list' ){
            wp_enqueue_style( 'rselements-features_list', $dir.'widgets/feature-list/feature-list.css' );
        }

        // Brochures
        if( isset( $rselements_addon_setting['rs_brochures_setting'] ) == 'rselement_brochures' ){
            wp_enqueue_style( 'rselements-brochures', $dir.'widgets/brochures/brochures.css' );
        }
        
		//Dual Button
        if( isset( $rselements_addon_setting['rs_dual_button_setting'] ) == 'rselement_dual_button' ){
            wp_enqueue_style( 'rselements-dual_button', $dir.'widgets/dual-button/dual-button.css' );
        }
		//Image Parallax
        // if( isset( $rselements_addon_setting['rselements_addon_option[rs_image_parallax_setting]'] ) == 'rselement_image_parallax' ){
        //     wp_enqueue_style( 'rselements-image_parallax', $dir.'widgets/image-animation/image-animation.css' );
        // }
		//Image Animation Shape
        if( isset( $rselements_addon_setting['rs_image_animation_shape_setting'] ) == 'rselement_image_animation_shape' ){
            wp_enqueue_style( 'rselements-image_animation_shape', $dir.'widgets/image-animation/image-animation.css' );
        }
		//Breadcrumb
        if( isset( $rselements_addon_setting['rs_breadcrumb_setting'] ) == 'rselement_breadcrumb' ){
            wp_enqueue_style( 'rselements-breadcrumb', $dir.'widgets/breadcrumb-widget/breadcrumb-widget.css' );
        }
		//Accordion
        if( isset( $rselements_addon_setting['rs_accordion_setting'] ) == 'rselement_accordion' ){
            wp_enqueue_style( 'rselements-accordion', $dir.'widgets/accordion/accordion.css' );
        }
		//Newsletter
        if( isset( $rselements_addon_setting['rs_newsletter_setting'] ) == 'rselement_newsletter' ){
            wp_enqueue_style( 'rselements-newsletter', $dir.'widgets/newsletter/newsletter.css' );
        }
		//Hover Tab
        if( isset( $rselements_addon_setting['rs_hover_tab_setting'] ) == 'rselement_hover_tab' ){
            wp_enqueue_style( 'rselements-hover_tab', $dir.'widgets/hover-tabs/hover-tabs.css' );
        }

		//Apps Screen Slider
        if( isset( $rselements_addon_setting['rs_screen_slider_setting'] ) == 'rselement_screen_slider' ){
            wp_enqueue_style( 'rselements-apps-screenshots', $dir.'widgets/apps-screenshots/apps-screenshots.css' );
        }
		
        //Roadmap Slider
		if( isset( $rselements_addon_setting['rs_roadmap_slider_setting'] ) == 'rselement_roadmap_slider' ){
			wp_enqueue_style( 'rselements-roadmap-widget', $dir.'widgets/roadmap/rs-roadmap.css' );
		}

        //Latest Blog Grid
        if( isset( $rselements_addon_setting['rs_latest_blog_grid_setting'] ) == 'rselement_latest_blog_grid' ){
            wp_enqueue_style( 'rselements-latest_blog', $dir.'widgets/latest-blog-grid/blog-grid.css' );
        }

        // services filter
        if( isset( $rselements_addon_setting['rs_services_filter_settings'] ) == 'rs_services_filter' ){
            wp_enqueue_style( 'rselements-services-filter', $dir.'widgets/services-filter/services-filter-widget.css' );
        }

        //Latest Blog Slider
        if( isset( $rselements_addon_setting['rs_latest_blog_slider_setting'] ) == 'rselement_latest_blog_slider' ){
            wp_enqueue_style( 'rselements-latest_blog_slider', $dir.'widgets/latest-blog-slider/blog-slider.css' );
        }

        //Post Navigation
        if( isset( $rselements_addon_setting['rs_post_navigation_setting'] ) == 'rselement_post_navigation' ){
            wp_enqueue_style( 'rselements-post_navigation', $dir.'widgets/post-navigation/post-navigation.css' );
        }

		// marquee slider widget
		if( isset( $rselements_addon_setting['rs_marquee_slider_setting'] ) == 'rs_marquee_slider' ){
			wp_enqueue_style( 'rselements-marquee-slider', $dir.'widgets/marquee-slider/marquee-slider-widget.css' );
		}

		// marquee slider logo text slider

		if( isset( $rselements_addon_setting['rs_marquee_logo_text_slider_settings'] ) == 'rs_marquee_logo_text_slider' ){
			wp_enqueue_style( 'rselements-marquee-logo-slider', $dir.'widgets/marquee-slider-logo/marquee-slider-widget.css' );

		}

		// Pricing table list
		if( isset( $rselements_addon_setting['rs_pricing_list_settings'] ) == 'rs_pricing_list' ) {
			wp_enqueue_style( 'rselements-pricing-list', $dir.'widgets/pricing-list/pricing-list.css' );
		}

		// step flow
        if( isset( $rselements_addon_setting['rs_step_flow_setting'] ) == 'rselement_step_flow' ){
			wp_enqueue_style( 'rselements-step-flow', $dir.'widgets/step-flow/step-flow.css' );
		}

		// rs services list
		if( isset( $rselements_addon_setting['rs_services_list_settings'] ) == 'rs_services_list' ) {
			wp_enqueue_style( 'rselements-service-item', $dir.'widgets/service-item/service-item.css' );
		}

		if( isset( $rselements_addon_setting['rs_services_search_settings'] ) == 'rs_services_search' ) {
			wp_enqueue_style( 'rselements-service-search-form', $dir.'widgets/service-form/service-form.css' );

		}

		if( isset( $rselements_addon_setting['rs_fluent_form_custom_settings'] ) == 'rs_fluent_form_custom' ) {
        	wp_enqueue_style( 'rselements-fluent-form-custom', $dir.'widgets/fluent-custom/fluent-form-custom.css' );
		}

		if( isset( $rselements_addon_setting['rs_social_icon_settings'] ) == 'rs_social_icon' ) {
			wp_enqueue_style( 'rselements-social-icons', $dir.'widgets/social-icons/rs-social-icons.css' );
		}
		if( isset( $rselements_addon_setting['rs_service_tab_settings'] ) == 'rs_service_tab' ) {
			wp_enqueue_style( 'rselements-service-tab', $dir.'widgets/services-tab/rs-service-tab.css' );
		}
		if( isset( $rselements_addon_setting['rs_header_offcanvas_settings'] ) == 'rs_header_offcanvas' ) {
			wp_enqueue_style( 'rselements-header-offcanvas', $dir.'widgets/header-offcanvas/header-offcanvas.css' );
		}
		wp_enqueue_style( 'rselements-portfolio-hover-effect', $dir.'widgets/portfolio-hover-effect/portfolio-hover-effect.css' );

		if( isset( $rselements_addon_setting['rs_isotope_filter_settings'] ) == 'rs_isotope_filter' ) {
			wp_enqueue_style( 'rselements-portfolio-isotope-filter', $dir.'widgets/portfolio-isotope-filter/portfolio-isotope-filter.css' );
		}

		

	}

    public function rselements_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rselements-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rselements-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function rselements_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rselements-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'rsaddon_category',
            [
                'title' => esc_html__( 'RS Elementor Addons', 'rsaddon' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

        $rselements_addon_setting = get_option( 'rselements_addon_option' );
        //Heading
        if( isset( $rselements_addon_setting['rs_heading_setting'] ) == 'rselement_heading' ) {
            require_once(__DIR__ . '/widgets/heading/heading.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new \Rsaddon_Elementor_pro_Heading_Widget());
        }
        //Image Comparison
        if( isset( $rselements_addon_setting['rs_img_comparison_setting'] ) == 'rselement_img_comparison' ) {
            require_once(__DIR__ . '/widgets/img-comparison/img-comparison.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new \Rsaddon_Elementor_Image_Comparison_Pro_Widget());
        }
		//Animated Hheading Setting
		if( isset( $rselements_addon_setting['rs_animated_heading_setting'] ) == 'rselement_animated_heading' ) {
			require_once( __DIR__ . '/widgets/animated-heading/animated-heading.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Animated_Heading_Widget());
		}
		//team grid
		if( isset( $rselements_addon_setting['rs_team_gread_setting'] ) == 'rselement_team_gread' ) {
			require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Team_Grid_Widget() );
		}
		//Full Width Slider
		if( isset( $rselements_addon_setting['rs_full_width_slider_setting'] ) == 'rselement_full_width_slider' ) {
			require_once( __DIR__ . '/widgets/rs_slider/slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Slider_Pro_Widget() );
		}
		//Team Slider
		if( isset( $rselements_addon_setting['rs_team_slider_setting'] ) == 'rselement_team_slider' ) {
			require_once( __DIR__ . '/widgets/team-member-slider/team-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Team_Slider_Pro_Widget() );
		}
		//Portfolio Grid
		if( isset( $rselements_addon_setting['rs_portfolio_grid_setting'] ) == 'rselement_portfolio_grid' ) {
			require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_pro_Grid_Widget() );
		}
		//Portfolio Filter
		if( isset( $rselements_addon_setting['rs_portfolio_filter_setting'] ) == 'rselement_portfolio_filter' ) {
			require_once( __DIR__ . '/widgets/portfolio-filter/portfolio-filter-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_pro_Filter_Widget() );
		}
		//Portfolio Slider
		if( isset( $rselements_addon_setting['rs_portfolio_slider_setting'] ) == 'rselement_portfolio_slider' ) {
			require_once( __DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_Slider_Pro_Widget() );	
		}
		//Counter
		if( isset( $rselements_addon_setting['rs_counter_setting'] ) == 'rselement_counter' ) {
			require_once( __DIR__ . '/widgets/counter/rs-counter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSCounter_Widget() );
		}
		// Cost Calculator
		if( isset( $rselements_addon_setting['rs_cost_calculator_setting'] ) == 'rselement_cost_calculator' ) {
			require_once( __DIR__ . '/widgets/cost-calculator/cost-calculator.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Cost_Calculator_Widget() );
		}
		//Service Grid
		if( isset( $rselements_addon_setting['rs_service_grid_setting'] ) == 'rselement_service_grid' ) {
			require_once( __DIR__ . '/widgets/services/rs-service-grid.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_Grid_Widget() );
		}
		//Service Slider
		if( isset( $rselements_addon_setting['rs_service_slider_setting'] ) == 'rselement_service_slider' ) {
			require_once( __DIR__ . '/widgets/service-slider/service-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_Slider_Widget() );
		}
		//Video
		if( isset( $rselements_addon_setting['rs_video_setting'] ) == 'rselement_video' ) {
			require_once( __DIR__ . '/widgets/video/rs-video.php');
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSvideo_Widget() );
		}
		//Pricing Table
		if( isset( $rselements_addon_setting['rs_pricing_table_setting'] ) == 'rselement_pricing_table' ) {
			require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Pricing_Table_Widget() );
		}
		//Pricing Table Slider
		if( isset( $rselements_addon_setting['rs_pricing_table_slider_setting'] ) == 'rselement_pricing_table_slider' ) {
			require_once( __DIR__ . '/widgets/pricing-table-slider/pricing-table-slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Pricing_Table_Slider_Widget() );
		}
		//Pricing Switcher
		if( isset( $rselements_addon_setting['rs_pricing_switcher_setting'] ) == 'rselement_pricing_switcher' ) {
			require_once( __DIR__ . '/widgets/rs-pricing-table/rs-pricing-table.php');
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Pricing_RS_Table_Widget() );
		}
		//Button
		if( isset( $rselements_addon_setting['rs_button_setting'] ) == 'rselement_button' ) {
			require_once( __DIR__ . '/widgets/button/button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Button_Widget() );

            require_once( __DIR__ . '/widgets/button/button-latest.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_latest_Button_Widget() );
		}
		//Logo Showcase
		if( isset( $rselements_addon_setting['rs_logo_showcase_setting'] ) == 'rselement_logo_showcase' ) {
			require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Logo_Showcase_Widget() );
		}
		//CTA
		if( isset( $rselements_addon_setting['rs_cta_setting'] ) == 'rselement_cta' ) {
			require_once( __DIR__ . '/widgets/cta/cta.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_CTA_Widget() );
		}
		//Testimonial Grid
		if( isset( $rselements_addon_setting['rs_testimonial_grid_setting'] ) == 'rselement_testimonial_grid' ) {
			require_once( __DIR__ . '/widgets/testimonial/testimonail-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Testimonial_Grid_Widget() );
		}
		//Testimonial Slider
		if( isset( $rselements_addon_setting['rs_testimonial_slider_setting'] ) == 'rselement_testimonial_slider' ) {
			require_once( __DIR__ . '/widgets/testimonial-slider/testimonail-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Testimonial_Slider_Widget() );
		}
		//Testimonial Slider Two
		if( isset( $rselements_addon_setting['rs_testimonial_slider_two_setting'] ) == 'rselement_testimonial_slider_two' ) {
			require_once( __DIR__ . '/widgets/testimonial-slider-custom/testimonail-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Testimonial_custom_Slider_Widget() );
		}
		//Flip Box
		if( isset( $rselements_addon_setting['rs_flip_box_setting'] ) == 'rselement_flip_box' ) {
			require_once( __DIR__ . '/widgets/flip-box/flip-box.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Flip_Box_Widget() );
		}
		//Tab
		if( isset( $rselements_addon_setting['rs_tab_setting'] ) == 'rselement_tab' ) {
			require_once( __DIR__ . '/widgets/tab/tab.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Tab_Widget() );
		}
		//Advance Tab
		if( isset( $rselements_addon_setting['rs_advance_tab_setting'] ) == 'rselement_advance_tab' ) {
			require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Advance_Tab_Widget() );
		}
		//Icon Box
		if( isset( $rselements_addon_setting['rs_icon_box_setting'] ) == 'rselement_icon_box' ) {
			require_once( __DIR__ . '/widgets/iconbox/rs-iconbox.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSIcon_Box_Widget() );
		}
		//Blog Grid
		if( isset( $rselements_addon_setting['rs_blog_grid_setting'] ) == 'rselement_blog_grid' ) {
			require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Blog_Grid_Widget() );
		}
		//Blog Slider
		if( isset( $rselements_addon_setting['rs_blog_slider_setting'] ) == 'rselement_blog_slider' ) {
			require_once( __DIR__ . '/widgets/blog-slider/blog-slider-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Blog_Slider_Widget() );
		}
		//Number Grid
		if( isset( $rselements_addon_setting['rs_number_grid_setting'] ) == 'rselement_number_grid' ) {
			require_once( __DIR__ . '/widgets/number/rs-number.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSnumber_Grid_Widget() );
		}
		// fluent-form
		if( isset( $rselements_addon_setting['rs_fluent_form_setting'] ) == 'rselement_fluent_form' ) {
			if( function_exists('wpFluentForm')) {
				require_once( __DIR__ . '/widgets/fluent-form/fluent-form.php' );
				\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RS_Fluent_Form_Widget() );
			}
		}
		//Progress Bar
		if( isset( $rselements_addon_setting['rs_progress_bar_setting'] ) == 'rselement_progress_bar' ) {
			require_once( __DIR__ . '/widgets/progress/rs-progress.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_progress_Widget() );	
		}
		//Progress Pie
		if( isset( $rselements_addon_setting['rs_progress_pie_setting'] ) == 'rselement_progress_pie' ) {
			require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Progress_Pie_Widget() );
		}
		//Contact Box
		if( isset( $rselements_addon_setting['rs_contact_box_setting'] ) == 'rselement_contact_box' ) {
			require_once( __DIR__ . '/widgets/contact-box/contact-box.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RScontactbox_Grid_Widget() );
		}
		//Tooltip
		if( isset( $rselements_addon_setting['rs_tooltip_setting'] ) == 'rselement_tooltip' ) {
			require_once( __DIR__ . '/widgets/tooltip/rs-tooltip.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSTooltip_Box_Widget() );
		}
		//Static Product
		if( isset( $rselements_addon_setting['rs_static_product_setting'] ) == 'rselement_static_product' ) {
			require_once( __DIR__ . '/widgets/static-product/static-product.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSStatic_Product_Widget() );
		}
		//FAQ
		if( isset( $rselements_addon_setting['rs_faq_setting'] ) == 'rselement_faq' ) {
			require_once( __DIR__ . '/widgets/faq/rs-faq.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Faq_Widget() );
		}
		//Image Showcase
		if( isset( $rselements_addon_setting['rs_image_showcase_setting'] ) == 'rselement_image_showcase' ) {
			require_once( __DIR__ . '/widgets/image-widget/image.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_Showcase_Widget() );
		}
        //Circle Service
        if( isset( $rselements_addon_setting['rs_circle_service_setting'] ) == 'rselement_circle_service' ) {
            require_once( __DIR__ . '/widgets/circle-service/circle-service.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Circle_Service_Widget() );
        }
		//Image Hover Effect
		if( isset( $rselements_addon_setting['rs_image_hover_effect_setting'] ) == 'rselement_image_hover_effect' ) {
			require_once( __DIR__ . '/widgets/image-hover-widget/image-hover-effect.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_Hover_Effect_Widget() );
		}
		//Features List
		if( isset( $rselements_addon_setting['rs_features_list_setting'] ) == 'rselement_features_list' ) {
			require_once( __DIR__ . '/widgets/feature-list/feature-list.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Features_List_Widget() );
		}
        //Brochures
        if( isset( $rselements_addon_setting['rs_brochures_setting'] ) == 'rselement_brochures' ) {
            require_once( __DIR__ . '/widgets/brochures/brochures.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Brochures_Widget() );
        }
		//Dual Button
		if( isset( $rselements_addon_setting['rs_dual_button_setting'] ) == 'rselement_dual_button' ) {
			require_once( __DIR__ . '/widgets/dual-button/dual-button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Pro_Dual_Button_Widget() );
		}
		//Image Parallax
		if( isset( $rselements_addon_setting['rs_image_parallax_setting'] ) == 'rselement_image_parallax' ) {
			require_once( __DIR__ . '/widgets/image-box/image.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_hover_Widget() );
		}
		//Image Animation Shape
		if( isset( $rselements_addon_setting['rs_image_animation_shape_setting'] ) == 'rselement_image_animation_shape' ) {
			require_once( __DIR__ . '/widgets/image-animation/image-animation.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Image_Animation_Effect_Widget() );
		}
		//Breadcrumb
		if( isset( $rselements_addon_setting['rs_breadcrumb_setting'] ) == 'rselement_breadcrumb' ) {
			require_once( __DIR__ . '/widgets/breadcrumb-widget/breadcrumb.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Breadcrumb_Widget() );
		}
		//Accordion
		if( isset( $rselements_addon_setting['rs_accordion_setting'] ) == 'rselement_accordion' ) {
			require_once( __DIR__ . '/widgets/accordion/rs-accordion.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Widget_Rs_Accordion_custom() );
		}
		//Newsletter
		if( isset( $rselements_addon_setting['rs_newsletter_setting'] ) == 'rselement_newsletter' ) {
			require_once( __DIR__ . '/widgets/newsletter/newsletter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSNewsLetter_Widget() );
		}
		//Hover Tab
		if( isset( $rselements_addon_setting['rs_hover_tab_setting'] ) == 'rselement_hover_tab' ) {
			require_once( __DIR__ . '/widgets/hover-tabs/hover-tabs.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_HoverTabs_Widget() );
		}

		//Apps Screen Slider
		if( isset( $rselements_addon_setting['rs_screen_slider_setting'] ) == 'rselement_screen_slider' ) {
			require_once( __DIR__ . '/widgets/apps-screenshots/apps-screenshots.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_pro_Apps_screenshots_Widget() );
		}
		
		// roadmap slider

		if( isset( $rselements_addon_setting['rs_roadmap_slider_setting'] ) == 'rselement_roadmap_slider' ){
			require_once( __DIR__ . '/widgets/roadmap/rs-roadmap.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RRoadmap_Widget() );
		}


        // Latest Blog Grid

        if( isset( $rselements_addon_setting['rs_latest_blog_grid_setting'] ) == 'rselement_latest_blog_grid' ){
            require_once( __DIR__ . '/widgets/latest-blog-grid/blog-grid-widget.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_latest_Blog_Grid_Widget() );
        }


        // Latest Blog Slider
        if( isset( $rselements_addon_setting['rs_latest_blog_slider_setting'] ) == 'rselement_latest_blog_slider' ){
            require_once( __DIR__ . '/widgets/latest-blog-slider/blog-slider-widget.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_latest_Blog_Slider_Widget() );
        }

		// step flow
        if( isset( $rselements_addon_setting['rs_step_flow_setting'] ) == 'rselement_step_flow' ){
            require_once( __DIR__ . '/widgets/step-flow/step-flow.php' );
            \Elementor\Plugin::instance()->widgets_manager->register( new \RS_Step_Flow() );
        }


		// marquee slider
		if( isset( $rselements_addon_setting['rs_marquee_slider_setting'] ) == 'rs_marquee_slider' ){
			require_once( __DIR__ . '/widgets/marquee-slider/marquee-slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Marquee_Slider_Widget() );
		}
		
		// marquee slider logo text slider

		if( isset( $rselements_addon_setting['rs_marquee_logo_text_slider_settings'] ) == 'rs_marquee_logo_text_slider' ){
			require_once( __DIR__ . '/widgets/marquee-slider-logo/marquee-slider.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Marquee_logo_text_Slider_Widget() );
		}

        // Services Filter
		if( isset( $rselements_addon_setting['rs_services_filter_settings'] ) == 'rs_services_filter' ){
			require_once( __DIR__ . '/widgets/services-filter/services-filter-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Services_pro_Filter_Widget() );
		}

		// Post Navigation
		if( isset( $rselements_addon_setting['rs_post_navigation_setting'] ) == 'rs_post_navigation' ) {
			require_once( __DIR__ . '/widgets/post-navigation/post-navigation.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Post_Navigation_Widget() );
		}

		// Pricing table list
		if( isset( $rselements_addon_setting['rs_pricing_list_settings'] ) == 'rs_pricing_list' ) {
			require_once( __DIR__ . '/widgets/pricing-list/pricing-list.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Pricing_Table_List() );
		}

		// rs isotope filter
		if( isset( $rselements_addon_setting['rs_isotope_filter_settings'] ) == 'rs_isotope_filter' ) {
			require_once( __DIR__ . '/widgets/portfolio-isotope-filter/portfolio-isotope-filter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_Isotope_Filter_Widget() );
		}

		// rs services list
		
		if( isset( $rselements_addon_setting['rs_services_list_settings'] ) == 'rs_services_list' ) {
			require_once( __DIR__ . '/widgets/service-item/service-item.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Pro_Service_Item_Widget() );

		}

		
		if( isset( $rselements_addon_setting['rs_services_search_settings'] ) == 'rs_services_search' ) {
			require_once( __DIR__ . '/widgets/service-form/service-form.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Service_Form_Widget() );
		}

		
		if( isset( $rselements_addon_setting['rs_fluent_form_custom_settings'] ) == 'rs_fluent_form_custom' ) {
			if( function_exists('wpFluentForm')) {
				require_once( __DIR__ . '/widgets/fluent-custom/FluentFormWidget.php' );
				\Elementor\Plugin::instance()->widgets_manager->register( new \rs__FluentFormWidget() );
			}
		}


        if( isset( $rselements_addon_setting['rs_hotspots_showcase_settings'] ) == 'rs_hotspots_showcase' ) {
			require_once( __DIR__ . '/widgets/hotspot-widget/hotspot.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \rselementsElementor_Pro_Hotspot_Showcase_Widget() );
		}
		// Register widget

		// rs social icons

		if( isset( $rselements_addon_setting['rs_social_icon_settings'] ) == 'rs_social_icon' ) {
			require_once( __DIR__ . '/widgets/social-icons/rs-social-icons.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_proSocial_Icons_Widget() );
		}


		// service tab
		if( isset( $rselements_addon_setting['rs_service_tab_settings'] ) == 'rs_service_tab' ) {
			require_once( __DIR__ . '/widgets/services-tab/rs-service-tab.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_RSservices_Tab_Widget() );
		}
		// header offcanvas widget
		
		if( isset( $rselements_addon_setting['rs_header_offcanvas_settings'] ) == 'rs_header_offcanvas' ) {
			require_once( __DIR__ . '/widgets/header-offcanvas/header-offcanvas.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Offcanvas_Widget() );
		}

		require_once( __DIR__ . '/widgets/portfolio-hover-effect/portfolio-hover-effect.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Portfolio_Hover_Effect_Widget() );
        
        require_once( __DIR__ . '/widgets/pagination/pagination.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_paginaiton_Widget() );

		
		

		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
	}
}
function rselement_addon()
{
	return Rsaddon_Elementor_Pro_Extension::init();
}

// kick-off the plugin
rselement_addon();