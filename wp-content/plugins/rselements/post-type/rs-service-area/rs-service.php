<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
class Rsaddon_Elementor_pro_rs_service{	

	public function __construct() {
		add_action( 'init', array( $this, 'rs_services_register_post_type' ) );
		add_action( 'init', array( $this, 'tr_create_service' ) );	
		add_action( 'save_post', array( $this, 'rsaddon_save_rs_services_meta' ) );
		add_action( 'manage_rs-service-area_posts_custom_column',   array( $this, 'custom_columns' ), 10, 2 );
		add_filter( 'manage_edit-rs-service-area_columns',          array( $this, 'edit_columns' ) );
		add_filter( 'manage_edit-rs-service-area_sortable_columns', array( $this, 'sortable_columns' ) );
	}


	// Register Portfolio Post Type
	function rs_services_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'RS Service Area', 'rsaddons'),
			'singular_name'      => esc_html__( 'RS Service', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Service', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Service', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Service', 'rsaddons'),
			'new_item'           => esc_html__( 'New Service', 'rsaddons'),
			'all_items'          => esc_html__( 'RS All Service Area', 'rsaddons'),
			'view_item'          => esc_html__( 'View Service', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Service', 'rsaddons'),
			'not_found'          => esc_html__( 'No Service found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Service found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Service:', 'rsaddons'),
			'menu_name'          => esc_html__( 'RS Service Area', 'rsaddons'),
		);

		$fixhero_service_slug = !empty(get_theme_mod('fixhero_service_slug')) ? get_theme_mod('fixhero_service_slug') : 'rs-service-area' ;
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite' => 		 array('slug' => $fixhero_service_slug,'with_front' => false),
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt', 'elementor' ),
		);
		register_post_type( 'rs-service-area', $args );
	}

	function tr_create_service() {
		
		register_taxonomy(
			'rs-service-area-category',
			'rs-service-area',
			array(
				'label' => esc_html__( 'Services Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
			)
		);
	}


	function edit_columns( $columns ) {	    
	    $columns['rs_service_address'] = __( 'Address', 'rsaddons' );
	    $columns['rs_service_city'] = __( 'City', 'rsaddons' );
	    $columns['rs_service_state'] = __( 'State', 'rsaddons' );
	    $columns['rs_service_zip_code'] = __( 'Zip Code', 'rsaddons' );	   
	    return $columns;
	}

    public function custom_columns( $column, $post_id ) {        
        switch ( $column ) {
            case 'rs_service_address':
                echo esc_html( get_post_meta( $post_id, 'rs_service_address', true ) );
			break; 
            case 'rs_service_city':
                echo esc_html( get_post_meta( $post_id, 'rs_service_city', true ) );
            break;
            case 'rs_service_state':
                echo esc_html( get_post_meta( $post_id, 'rs_service_state', true ) );
            break;
            case 'rs_service_zip_code':
                echo esc_html( get_post_meta( $post_id, 'rs_service_zip_code', true ) );
            break;
        }
    }

	function sortable_columns( $columns ) {
	    $custom = array(
	        'rs_service_address' => 'rs_service_address',
	        'rs_service_city' => 'rs_service_city',
	        'rs_service_state' => 'rs_service_state',
	        'rs_service_zip_code' => 'rs_service_zip_code'
	    );	   
	    return wp_parse_args( $custom, $columns );
	}
	 

	/*--------------------------------------------------------------
	 *			Save testimonial social meta
	*-------------------------------------------------------------*/
	function rsaddon_save_rs_services_meta( $post_id ) {		

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( isset($_POST['post_type']) && 'rs-service-area' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}
	}
	
}
new Rsaddon_Elementor_pro_rs_service();