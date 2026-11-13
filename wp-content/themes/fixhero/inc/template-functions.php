<?php
/**
 * @author  rs-theme
 */
function fixhero_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'fixhero_body_classes' );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function fixhero_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'fixhero_pingback_header' );

/**  kses_allowed_html */

function fixhero_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'fixhero': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}

add_filter( 'wp_kses_allowed_html', 'fixhero_prefix_kses_allowed_html', 10, 2);

function fixhero_get_postTitleArray($postType = 'post' ) {
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    }else {
      $post_title_array['default'] = esc_html__( 'Default', 'fixhero' );
    }
    return $post_title_array;
}

function fixhero_studio_fonts_url() {
    $font_url = '';    
    $fixhero_body_font = get_theme_mod('fixhero_body_font', 'Arial, sans-serif');
    $fixhero_header_font = get_theme_mod('fixhero_header_font', 'Arial, sans-serif');
    $fixhero_heading_font = get_theme_mod('fixhero_heading_font', 'Arial, sans-serif');
    $fixhero_h1_font = get_theme_mod('fixhero_h1_font', 'Arial, sans-serif');
    $fixhero_h2_font = get_theme_mod('fixhero_h2_font', 'Arial, sans-serif');
    $fixhero_h3_font = get_theme_mod('fixhero_h3_font', 'Arial, sans-serif');
    $fixhero_h4_font = get_theme_mod('fixhero_h4_font', 'Arial, sans-serif');
    $fixhero_h5_font = get_theme_mod('fixhero_h5_font', 'Arial, sans-serif');
    $fixhero_h6_font = get_theme_mod('fixhero_h6_font', 'Arial, sans-serif');

    $font_families = array();

    if ( $fixhero_body_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_body_font;
    }

    if ( $fixhero_header_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_header_font;
    }

    if ( $fixhero_heading_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_heading_font;
    }

    if ( $fixhero_h1_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h1_font;
    }

    if ( $fixhero_h2_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h2_font;
    }

    if ( $fixhero_h3_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h3_font;
    }

    if ( $fixhero_h4_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h4_font;
    }

    if ( $fixhero_h5_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h5_font;
    }

    if ( $fixhero_h6_font !== 'Arial, sans-serif' ) {
        $font_families[] = $fixhero_h6_font;
    }

    if ( ! empty( $font_families ) ) {
        $font_url = add_query_arg( 'family', urlencode( implode( '|', $font_families ) . ':400,500,600,700,800,900&display=swap' ), "//fonts.googleapis.com/css" );
    } else {
        $font_url = add_query_arg( 'family', urlencode( 'Inter:400,500,600,700,800,900&display=swap' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

/*
Enqueue scripts and styles.
*/

function fixhero_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', fixhero_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'fixhero_studio_scripts' );




//Favicon Icon
function fixhero_site_icon() {
    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {          
    if(!empty(get_theme_mod('fixhero_favicon')))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(get_theme_mod('fixhero_favicon')); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'fixhero_site_icon');


//excerpt for specific section
function fixhero_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'fixhero' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'fixhero_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'fixhero_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  // Get post ID
  $post_id = $post->ID;

  // Check for custom excerpt
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  }
  // No custom excerpt...so lets generate one
  else {
    // Readmore link
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';
    // Check for more tag and return content if it exists
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }
    // No more tag defined so generate excerpt using wp_trim_words
    else {
      // Generate excerpt
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
      // Add readmore to excerpt if enabled
      if ( $readmore ) {
        $output .= apply_filters( 'fixhero_wpex_readmore_link', $readmore_link );
      }

    }

  }
  // Apply filters and echo
  return apply_filters( 'fixhero_wpex_get_excerpt', $output );
}


//Demo content file include here

function fixhero_import_files() {
    return array(

        // Handyman Main Demo

        array(
          'import_file_name'           => 'Handyman Group',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/handyman/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://handyman.fixherotheme.com/',    
        ),           


        // Handyman Main Onepage

        array(
          'import_file_name'           => 'Handyman Group Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/handyman/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/handyman/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://handyman.fixherotheme.com/onepage',    
        ),        


        // Plumbing Services

        array(
          'import_file_name'           => 'Plumbing Services',
          'categories'                 => array( 'Handyman Services', 'Multipages'),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/plumbing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://plumbing.fixherotheme.com/',    
        ),        


        // Plumbing Services Onepage

        array(
          'import_file_name'           => 'Plumbing Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages'),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/plumbing/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/plumbing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://plumbing.fixherotheme.com/onepage',    
        ),


        // AC Repair Services

        array(
          'import_file_name'           => 'AC Repair Services',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/ac/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/ac/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/ac/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/ac/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://ac.fixherotheme.com/',    
        ),   
        

        // AC Repair Services Onepage

        array(
          'import_file_name'           => 'AC Repair Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/ac/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/ac/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/ac/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/ac/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://ac.fixherotheme.com/onepage',    
        ),        


        // Carpenter Services

        array(
          'import_file_name'           => 'Carpenter Services',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/carpenter/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://carpenter.fixherotheme.com/',    
        ),


        // Carpenter Services Onepage

        array(
          'import_file_name'           => 'Carpenter Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/carpenter/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/carpenter/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://carpenter.fixherotheme.com/onepage',    
        ),




        // Electrical Services

        array(
          'import_file_name'           => 'Electrical Services',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/electric/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/electric/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/electric/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/electric/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://electric.fixherotheme.com/',    
        ),          


        // Electrical Services Onepage

        array(
          'import_file_name'           => 'Electrical Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/electric/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/electric/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/electric/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/electric/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://electric.fixherotheme.com/onepage',    
        ),        


        // Re-Construction Services

        array(
          'import_file_name'           => 'Construction Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/construction/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/construction/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/construction/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://constructions.fixherotheme.com/',    
        ),           


        // Re-Construction Services Onepage

        array(
          'import_file_name'           => 'Construction Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/construction/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/construction/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/construction/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/construction/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://constructions.fixherotheme.com/onepage',    
        ),        

        // Car Repair Services

        array(
          'import_file_name'           => 'Car Repair Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/car/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/car/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/car/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/car/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://car.fixherotheme.com/',    
        ),

        // Car Repair Services Onepage

        array(
          'import_file_name'           => 'Car Repair Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/car/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/car/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/car/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/car/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://car.fixherotheme.com/onepage',    
        ),



        // Gadget Repair Services

        array(
          'import_file_name'           => 'Gadget Repair Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/gadget/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://gadget.fixherotheme.com/',    
        ),        


        // Gadget Repair Services Onepage

        array(
          'import_file_name'           => 'Gadget Repair Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/gadget/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/gadget/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://gadget.fixherotheme.com/onepage',    
        ),
        

        // Painting Services

        array(
          'import_file_name'           => 'Painting Services',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/painting/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/painting/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/painting/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/painting/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://painting.fixherotheme.com/',    
        ),       


         // Painting Services Onepage

        array(
          'import_file_name'           => 'Painting Services Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/painting/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/painting/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/painting/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/painting/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://painting.fixherotheme.com/onepage',    
        ),

        // Windows And Doors

        array(
          'import_file_name'           => 'Windows And Doors',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/windows/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/windows/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/windows/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/windows/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://windows.fixherotheme.com/',    
        ),        


        // Windows And Doors Onepage

        array(
          'import_file_name'           => 'Windows And Doors Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/windows/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/windows/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/windows/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/windows/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://windows.fixherotheme.com/onepage',    
        ),

        // Cleaning Services

        array(
          'import_file_name'           => 'Cleaning Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/cleaning/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://cleaning.fixherotheme.com/',    
        ),        


        // Cleaning Services Onepage

        array(
          'import_file_name'           => 'Cleaning Services Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/cleaning/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/cleaning/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://cleaning.fixherotheme.com/onepage',    
        ),


        // Tiling & Flooring

        array(
          'import_file_name'           => 'Tiling And Flooring',
          'categories'                 => array( 'Handyman Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/tiling/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://tiling.fixherotheme.com/',    
        ),        


        // Tiling & Flooring Onepage

        array(
          'import_file_name'           => 'Tiling And Flooring Onepage',
          'categories'                 => array( 'Handyman Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/tiling/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/tiling/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://tiling.fixherotheme.com/onepage',    
        ),

        
        // Moving Services

        array(
          'import_file_name'           => 'Moving Services',
          'categories'                 => array( 'Repair Services' , 'Multipages'),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/moving/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/moving/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/moving/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/moving/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://moving.fixherotheme.com/',    
        ),
        
        // Moving Services Onepage

        array(
          'import_file_name'           => 'Moving Services Onepage',
          'categories'                 => array( 'Repair Services' , 'Onepages'),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/moving/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/moving/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/moving/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/moving/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://moving.fixherotheme.com/onepage',    
        ),
        

        // Gardening Services

        array(
          'import_file_name'           => 'Gardening Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/gardening/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://gardening.fixherotheme.com/',    
        ),           


        // Gardening Services Onepage

        array(
          'import_file_name'           => 'Gardening Services Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages'),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/gardening/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/gardening/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://gardening.fixherotheme.com/onepage',    
        ),        

        // Roofing Services

        array(
          'import_file_name'           => 'Roofing Services',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/roofing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://roofing.fixherotheme.com/',    
        ),         


        // Roofing Services Onepage

        array(
          'import_file_name'           => 'Roofing Services Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/roofing/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/roofing/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://roofing.fixherotheme.com/onepage',    
        ),        

        // TV Installation

        array(
          'import_file_name'           => 'TV Installation',
          'categories'                 => array( 'Repair Services', 'Multipages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/tv/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/tv/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/tv/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/tv/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://tv.fixherotheme.com/',    
        ),        

        // TV Installation Onepage

        array(
          'import_file_name'           => 'TV Installation Onepage',
          'categories'                 => array( 'Repair Services', 'Onepages' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/tv/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/tv/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/tv/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/tv/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://tv.fixherotheme.com/onepage',    
        ),

       // Handyman Main Demo RTL

        array(
          'import_file_name'           => 'Main Demo RTL',
          'categories'                 => array( 'Handyman Services', 'Multipages', 'RTL' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/rtl/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://rtl.fixherotheme.com',    
        ),
       // Handyman Main Demo RTL

        array(
          'import_file_name'           => 'Main Demo RTL Onepage ',
          'categories'                 => array( 'Handyman Services', 'Onepages', 'RTL' ),
          'import_file_url'            => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-content.xml',
          'import_widget_file_url'     => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-widgets.wie',  
          'import_customizer_file_url' => 'https://fixherotheme.com/pkg/demos/rtl/fixhero-customizer.dat',     
          'import_preview_image_url'   => 'https://fixherotheme.com/pkg/screens/rtl/screen.png',   
          'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'fixhero' ),
           'preview_url'                => 'https://rtl.fixherotheme.com/onepage',    
        ),



    );
}

add_filter( 'pt-ocdi/import_files', 'fixhero_import_files' );

function fixhero_set_import_id(){
    if(isset( $_GET['import'] )) {
        $import_demo_id =(int) $_GET['import'];
        unset($_COOKIE['import_id']);
        if(!isset($_COOKIE['import_id'])) {
            setcookie('import_id', $import_demo_id, time()+3600); 
        }  
    }
}  

add_action( 'init', 'fixhero_set_import_id');


function fixhero_after_import_setup() {
      // Assign menus to their locations.
    $main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' ); 
    set_theme_mod( 'nav_menu_locations', array(
          'menu-1' => $main_menu->term_id,              
        )
    );

    if(isset($_COOKIE['import_id'])) {

        $selected= (int)$_COOKIE['import_id']; 

         if($selected==0 || $selected==2 || $selected==4 || $selected==6 || $selected==8 || $selected==10 || $selected==12 || $selected==14 || $selected==16 || $selected==18 || $selected==20 || $selected==22 || $selected==24 || $selected==26 || $selected==28 || $selected==30 || $selected==32){
            $front_page_id = get_page_by_title( 'Home' ); 
        } else{
            $front_page_id = get_page_by_title( 'Onepage' ); 
        }

        $blog_page_id  = get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );


        if(class_exists('RevSlider'))
        {
            if($selected==6 || $selected==7) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/carpenter.zip");
                ob_get_clean();
            }            
            if($selected==12 || $selected==13) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/car-repair.zip");
                ob_get_clean();
            }

            if($selected==20 || $selected==21) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/cleaning-service.zip");
                ob_get_clean();
            }

            if($selected==8 || $selected==9) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/electricity.zip");
                ob_get_clean();
            }

            if($selected==14 || $selected==15) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/gadget.zip");
                ob_get_clean();
            }

            if($selected==26 || $selected==27) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/gardening.zip");
                ob_get_clean();
            }   
   
            if($selected==24 || $selected==25) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/moving-services.zip");
                ob_get_clean();
            }  


            if($selected==10 || $selected==11) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/re-construction.zip");
                ob_get_clean();
            } 

            if($selected==22 || $selected==23) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/tiling-slider.zip");
                ob_get_clean();
            }

            if($selected==18 || $selected==19) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/windows-slider.zip");
                ob_get_clean();
            }            

            if($selected==28 || $selected==29) {
                $slider = new RevSlider();
                ob_start();
                $slider->importSliderFromPost(true, true, get_template_directory()."/ocdi/sliders/roofing.zip");
                ob_get_clean();
            }
           
        }

    }
    unset($_COOKIE['import_id']);

}
add_action( 'pt-ocdi/after_import', 'fixhero_after_import_setup' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


/**
 * Mega Menu
 */
add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {
  $show_rs_mega_class = get_post_meta($item_id, '_show-fixhero-as-mega', true);
  ?>
  <p class="fixhero-show-as-button description description-wide">
    <label for="fixhero-menu-item-btns-<?php echo esc_attr ($item_id); ?>" >
      <input type="checkbox" 
        id="fixhero-menu-item-btns-<?php echo esc_attr ($item_id); ?>" 
        name="fixhero-menu-item-btns[<?php echo esc_attr ($item_id); ?>]" 
        <?php checked($show_rs_mega_class, true); ?> 
      /><?php echo esc_html__('Check Mega Menu', 'fixhero'); ?>
    </label>
  </p>
  <?php
}, 10, 2);

add_action('wp_update_nav_menu_item', function($menu_id, $fixhero_menu_item_db_id) {
  $fixhero_button_value = (isset($_POST['fixhero-menu-item-btns'][$fixhero_menu_item_db_id]) && $_POST['fixhero-menu-item-btns'][$fixhero_menu_item_db_id] === 'on') ? true : false;
  update_post_meta($fixhero_menu_item_db_id, '_show-fixhero-as-mega', $fixhero_button_value);
}, 10, 2);

add_filter('nav_menu_css_class', function($classes, $menu_item) {
  $show_rs_mega_class = get_post_meta($menu_item->ID, '_show-fixhero-as-mega', true);
  if ($show_rs_mega_class) {
    $classes[] = 'rs-mega-menu';
  }
  return $classes;
}, 10, 2);


update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );

